<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * Redirect to role-specific profile page
     */
    public function edit()
    {
        $user = Auth::user();
        if ($user->role === 'rt') {
            return redirect()->route('rt.profile');
        }
        return redirect()->route('warga.profile');
    }

    /**
     * Update user profile
     */
    public function update(Request $request)
    {
        $user = Auth::user();
        if ($user->role === 'rt') {
            return redirect()->route('rt.profile')->with('success', 'Profil RT berhasil diperbarui!');
        }
        
        $warga = $user->warga;
        if (!$warga) {
            return redirect()->back()->withErrors(['error' => 'Data warga tidak ditemukan.']);
        }
        
        return app(WargaController::class)->update($request, $warga);
    }

    /**
     * Delete user profile
     */
    public function destroy(Request $request)
    {
        abort(403, 'Penghapusan akun dinonaktifkan.');
    }
}
