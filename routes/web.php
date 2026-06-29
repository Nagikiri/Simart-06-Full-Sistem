<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PengajuanController;
use App\Http\Controllers\RTController;
use App\Http\Controllers\WargaController;
use App\Http\Controllers\WargaSettingsController;
use Illuminate\Support\Facades\Route;

// Home Page
Route::get('/', function () {
    return view('index');
})->name('home');

Route::get('/privacy', function () {
    return view('privacy');
})->name('privacy');

Route::get('/terms', function () {
    return view('terms');
})->name('terms');

// Auth Routes
Route::get('/register', [AuthController::class, 'register'])->middleware('guest')->name('register');
Route::post('/register', [AuthController::class, 'store'])->middleware('guest')->name('register.store');
Route::get('/login', [AuthController::class, 'login'])->middleware('guest')->name('login');
Route::post('/login', [AuthController::class, 'authenticate'])->middleware('guest')->name('login.authenticate');
Route::post('/logout', [AuthController::class, 'destroy'])->middleware('auth')->name('logout');

// Password Reset Routes
Route::get('/forgot-password', [AuthController::class, 'forgotPassword'])->middleware('guest')->name('password.request');
Route::post('/forgot-password', [AuthController::class, 'sendResetLink'])->middleware('guest')->name('password.email');
Route::get('/reset-password/{token}', [AuthController::class, 'resetPassword'])->middleware('guest')->name('password.reset');
Route::post('/reset-password', [AuthController::class, 'updatePassword'])->middleware('guest')->name('password.update');

// Dashboard Routes
Route::middleware(['auth', 'verified'])->group(function () {
    // Role-based dashboards
    Route::get('/dashboard/warga', [WargaController::class, 'getDashboard'])
        ->middleware('role:warga')->name('dashboard.warga');

    Route::get('/dashboard/rt', function () {
        return view('dashboard.rt');
    })->middleware('role:rt')->name('dashboard.rt');

    // Redirect to appropriate dashboard
    Route::get('/dashboard', function () {
        $user = auth()->user();
        if ($user->role === 'rt') {
            return redirect()->route('dashboard.rt');
        }
        return redirect()->route('dashboard.warga');
    })->name('dashboard');
});

// Warga Routes
Route::middleware(['auth', 'verified', 'role:warga'])->prefix('warga')->group(function () {
    // Pengajuan
    Route::get('/pengajuan', [PengajuanController::class, 'index'])->name('pengajuan.index');
    Route::get('/pengajuan/create', [PengajuanController::class, 'create'])->name('pengajuan.create');
    Route::post('/pengajuan', [PengajuanController::class, 'store'])->name('pengajuan.store');
    Route::get('/pengajuan/{pengajuan}', [PengajuanController::class, 'show'])->name('pengajuan.show');
    Route::get('/pengajuan/{pengajuan}/edit', [PengajuanController::class, 'edit'])->name('pengajuan.edit');
    Route::put('/pengajuan/{pengajuan}', [PengajuanController::class, 'update'])->name('pengajuan.update');
    Route::delete('/pengajuan/{pengajuan}', [PengajuanController::class, 'destroy'])->name('pengajuan.destroy');
    Route::get('/pengajuan/{pengajuan}/download', [PengajuanController::class, 'downloadFile'])->name('pengajuan.download');
    Route::get('/pengajuan/template-content/{id}', [PengajuanController::class, 'getTemplateContent'])->name('pengajuan.template-content');
    Route::get('/pengajuan/template-pdf/{id}', [PengajuanController::class, 'templatePdf'])->name('pengajuan.template-pdf');
    // Allow warga to view template PDF inline for the create form iframe
    Route::get('/template-preview/{id}', [\App\Http\Controllers\TemplateSuratController::class, 'downloadFile'])->name('warga.template.preview');
    
    // Warga specific
    Route::get('/riwayat', [WargaController::class, 'getRiwayat'])->name('warga.riwayat');
    Route::get('/template', [WargaController::class, 'viewTemplates'])->name('warga.template');
    // Profile (view only)
    Route::get('/profile', [WargaController::class, 'show'])->name('warga.profile');
    Route::get('/profile/edit', [WargaController::class, 'edit'])->name('warga.profile.edit');
    Route::put('/profile', [WargaController::class, 'update'])->name('warga.profile.update');
    Route::get('/profile/password', [WargaController::class, 'showChangePasswordForm'])->name('warga.profile.password');
    Route::post('/profile/password', [WargaController::class, 'updatePassword'])->name('warga.profile.password.update');
    // Settings (new — Tier 1)
    Route::get('/settings', [WargaSettingsController::class, 'index'])->name('warga.settings');
    Route::post('/settings/profil', [WargaSettingsController::class, 'updateProfil'])->name('warga.settings.profil');
    Route::post('/settings/password', [WargaSettingsController::class, 'updatePassword'])->name('warga.settings.password');
    Route::post('/settings/foto', [WargaSettingsController::class, 'updateFoto'])->name('warga.settings.foto');
});

// RT Routes
Route::middleware(['auth', 'verified', 'role:rt'])->prefix('rt')->group(function () {
    Route::get('/verifikasi', [RTController::class, 'verifikasiIndex'])->name('verifikasi.index');
    Route::get('/verifikasi/{pengajuan}', [RTController::class, 'verifikasiShow'])->name('verifikasi.show');
    Route::post('/verifikasi/{pengajuan}/approve', [RTController::class, 'approve'])->name('verifikasi.approve');
    Route::post('/verifikasi/{pengajuan}/reject', [RTController::class, 'reject'])->name('verifikasi.reject');
    
    Route::get('/surat', [RTController::class, 'suratIndex'])->name('surat.index');
    Route::get('/surat/{surat}/download', [RTController::class, 'downloadSurat'])->name('surat.download');
    
    Route::get('/warga', [RTController::class, 'wargaIndex'])->name('warga.index');
    
    Route::get('/laporan', [RTController::class, 'laporanIndex'])->name('laporan.index');
    
    Route::resource('/template', \App\Http\Controllers\TemplateSuratController::class);
    Route::get('/template/{id}/file', [\App\Http\Controllers\TemplateSuratController::class, 'downloadFile'])->name('template.file');
    Route::get('/template/{id}/duplicate', [\App\Http\Controllers\TemplateSuratController::class, 'duplicate'])->name('template.duplicate');
    Route::get('/template/{id}/preview', [\App\Http\Controllers\TemplateSuratController::class, 'preview'])->name('template.preview');
    Route::get('/settings', function () { return view('rt.settings.index'); })->name('settings.index');
    Route::post('/settings/profil', [RTController::class, 'updateProfilRT'])->name('rt.settings.profil');
    Route::post('/settings/password', [RTController::class, 'updatePasswordRT'])->name('rt.settings.password');
    Route::post('/settings/foto', [RTController::class, 'updateFotoRT'])->name('rt.settings.foto');
    Route::post('/settings/ttd', [RTController::class, 'updateTandaTanganRT'])->name('rt.settings.ttd');
    Route::get('/profile', function () { return view('rt.profile.index'); })->name('rt.profile');
    Route::post('/pengumuman', [RTController::class, 'storePengumuman'])->name('pengumuman.store');
});

// Profile Routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
