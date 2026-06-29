<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\Warga;

class WargaSettingsController extends Controller
{
    /**
     * Tampilkan halaman settings warga (Tier 1).
     */
    public function index()
    {
        $user  = Auth::user();
        $warga = $user->warga;

        if (!$warga) {
            abort(404, 'Data warga tidak ditemukan.');
        }

        return view('warga.settings.index', compact('user', 'warga'));
    }

    /**
     * Update profil pribadi (nama, email, no_hp, alamat).
     */
    public function updateProfil(Request $request)
    {
        $user  = Auth::user();
        $warga = $user->warga;

        if (!$warga) {
            abort(404, 'Data warga tidak ditemukan.');
        }

        $validated = $request->validate([
            'nama'  => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:warga,email,' . $warga->id_warga . ',id_warga',
            'no_hp' => 'required|string|max:20',
            'alamat' => 'nullable|string|max:500',
        ], [
            'nama.required'  => 'Nama lengkap wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.unique'   => 'Email sudah digunakan oleh akun lain.',
        ]);

        // Update tabel warga
        $warga->update([
            'nama'   => $validated['nama'],
            'email'  => $validated['email'],
            'no_hp'  => $validated['no_hp'],
            'alamat' => $validated['alamat'] ?? null,
        ]);

        // Sync tabel users (nama & email)
        $user->update([
            'name'  => $validated['nama'],
            'email' => $validated['email'],
        ]);

        return redirect()->route('warga.settings')
            ->with('success', 'Profil berhasil diperbarui!');
    }

    /**
     * Update password warga.
     */
    public function updatePassword(Request $request)
    {
        $user  = Auth::user();
        $warga = $user->warga;

        if (!$warga) {
            abort(404, 'Data warga tidak ditemukan.');
        }

        $request->validate([
            'current_password' => ['required', function ($attr, $value, $fail) use ($warga) {
                if (!Hash::check($value, $warga->password)) {
                    $fail('Password saat ini tidak sesuai.');
                }
            }],
            'password' => 'required|string|min:8|confirmed',
        ], [
            'password.min'       => 'Password baru minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);

        $hashedPassword = Hash::make($request->password);

        // Update tabel warga (manual hash — warga tidak pakai cast 'hashed')
        $warga->update(['password' => $hashedPassword]);

        // Update tabel users (kirim plain, User model punya cast 'hashed')
        $user->update(['password' => $request->password]);

        return redirect()->route('warga.settings')
            ->with('success', 'Password berhasil diubah!');
    }

    /**
     * Upload foto profil warga.
     */
    public function updateFoto(Request $request)
    {
        $user  = Auth::user();
        $warga = $user->warga;

        if (!$warga) {
            abort(404, 'Data warga tidak ditemukan.');
        }

        $request->validate([
            'foto_profil' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
        ], [
            'foto_profil.required' => 'Pilih file foto terlebih dahulu.',
            'foto_profil.image'    => 'File harus berupa gambar.',
            'foto_profil.max'      => 'Ukuran foto maksimal 2 MB.',
        ]);

        // Hapus foto lama jika ada
        if ($warga->foto_profil && Storage::disk('public')->exists($warga->foto_profil)) {
            Storage::disk('public')->delete($warga->foto_profil);
        }

        $path = $request->file('foto_profil')->store('foto-profil', 'public');

        $warga->update(['foto_profil' => $path]);

        return redirect()->route('warga.settings')
            ->with('success', 'Foto profil berhasil diperbarui!');
    }
}
