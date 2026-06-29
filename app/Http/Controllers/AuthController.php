<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Warga;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Mail\ResetPasswordMail;
use App\Services\NodeMailerService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class AuthController extends Controller
{
    /**
     * Display the registration view.
     */
    public function register(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:warga'],
            'no_hp' => ['required', 'string', 'regex:/^(08|628|\+628)[0-9]{7,11}$/', 'unique:warga'],
            'gender' => ['required', 'in:Laki-laki,Perempuan'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // Create Warga entry (password di-hash manual — model tanpa cast hashed)
        $warga = Warga::create([
            'nama' => $request->name,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
            'gender' => $request->gender,
            'password' => Hash::make($request->password),
            'role' => 'warga',
        ]);

        // User: kirim password plain — model User punya cast 'hashed' (hindari double-hash)
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'email_verified_at' => now(),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard'))->with('success', 'Pendaftaran berhasil!');
    }

    /**
     * Display the login view.
     */
    public function login(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function authenticate(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required'],
        ]);

        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended(route('dashboard'));
        }

        return back()->withErrors([
            'email' => 'Email atau password tidak sesuai.',
        ])->onlyInput('email');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Logout berhasil!');
    }

    /**
     * Display the forgot password view.
     */
    public function forgotPassword(): View
    {
        return view('auth.forgot-password');
    }

    /**
     * Handle sending password reset link.
     */
    public function sendResetLink(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        $warga = null;
        $user = User::where('email', $request->email)->first();
        if (! $user) {
            $warga = Warga::where('email', $request->email)->first();
            if (!$warga) {
                return back()->withErrors(['email' => 'Email tidak ditemukan dalam sistem.']);
            }
            $user = User::where('email', $warga->email)->first();
            if (!$user) {
                return back()->withErrors(['email' => 'Email tidak ditemukan dalam sistem.']);
            }
        }

        $token = Str::random(64);

        \DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $request->email],
            [
                'token' => Hash::make($token),
                'created_at' => now(),
            ]
        );

        $resetUrl = url(route('password.reset', [
            'token' => $token,
            'email' => $request->email,
        ], false));

        $userName = $user->name ?? $warga->nama ?? 'Pengguna';
        $sent = false;

        if (config('mail.use_nodemailer', true)) {
            $mailer = app(NodeMailerService::class);
            $html = view('emails.reset-password', [
                'resetUrl' => $resetUrl,
                'userName' => $userName,
                'appName' => config('app.name'),
            ])->render();

            $sent = $mailer->send(
                $request->email,
                'Reset Password - '.config('app.name'),
                $html
            );
        }

        if (! $sent) {
            try {
                Mail::to($request->email)->send(new ResetPasswordMail($resetUrl, $userName));
                $sent = true;
            } catch (\Throwable $e) {
                report($e);
            }
        }

        if (! $sent && ! config('app.debug')) {
            return back()->withErrors([
                'email' => 'Gagal mengirim email. Periksa konfigurasi SMTP di .env dan pastikan Node.js terpasang.',
            ]);
        }

        $status = $sent
            ? 'Permintaan reset berhasil. Periksa kotak masuk (dan folder spam) untuk email berisi tautan reset.'
            : 'Email belum terkirim ke inbox (SMTP belum dikonfigurasi).';

        if ($sent && config('mail.default') === 'log') {
            $status .= ' Saat ini email hanya dicatat di storage/logs — bukan Gmail sungguhan.';
        }

        $redirect = back()->with('status', $status);

        // Mode development: selalu tampilkan link agar bisa uji tanpa SMTP
        if (config('app.debug')) {
            $redirect = $redirect->with('reset_debug_url', $resetUrl);
        }

        return $redirect;
    }

    /**
     * Display the reset password view.
     */
    public function resetPassword(Request $request, $token): View
    {
        return view('auth.reset-password', ['token' => $token, 'email' => $request->email]);
    }

    /**
     * Handle password reset.
     */
    public function updatePassword(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'token' => ['required'],
        ]);

        // Check if token is valid
        $tokenRecord = \DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->first();

        if (!$tokenRecord || !Hash::check($request->token, $tokenRecord->token)) {
            return back()->withErrors(['token' => 'Token tidak valid atau telah kadaluarsa.']);
        }

        // Check if token is not older than 1 hour
        if (now()->diffInMinutes($tokenRecord->created_at) > 60) {
            \DB::table('password_reset_tokens')->where('email', $request->email)->delete();
            return back()->withErrors(['token' => 'Token telah kadaluarsa. Silakan minta tautan reset baru.']);
        }

        // Find user and update password
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return back()->withErrors(['email' => 'Email tidak ditemukan.']);
        }

        $user->update(['password' => $request->password]);

        $warga = Warga::where('email', $request->email)->first();
        if ($warga) {
            $warga->update(['password' => Hash::make($request->password)]);
        }

        // Delete used token
        \DB::table('password_reset_tokens')->where('email', $request->email)->delete();

        return redirect('/login')->with('success', 'Password berhasil direset. Silakan login dengan password baru Anda.');
    }
}
