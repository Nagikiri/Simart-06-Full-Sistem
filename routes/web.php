<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Home Page
Route::get('/', function () {
    return view('index');
})->name('home');

// Dashboard Routes
Route::middleware(['auth', 'verified'])->group(function () {
    // Role-based dashboards
    Route::get('/dashboard/warga', function () {
        return view('dashboard.warga');
    })->middleware('role:warga')->name('dashboard.warga');

    Route::get('/dashboard/rt', function () {
        return view('rt.dashboard');
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
    Route::get('/pengajuan', function () { return view('warga.pengajuan.index'); })->name('pengajuan.index');
    Route::get('/pengajuan/create', function () { return view('warga.pengajuan.create'); })->name('pengajuan.create');
    Route::get('/riwayat', function () { return view('warga.riwayat.index'); })->name('riwayat.index');
    Route::get('/template', function () { return view('warga.template.index'); })->name('warga.template');
    Route::get('/profile', function () { return view('warga.profile.index'); })->name('warga.profile');
});

// RT Routes
Route::middleware(['auth', 'verified', 'role:rt'])->prefix('rt')->group(function () {
    Route::get('/verifikasi', function () { return view('rt.verifikasi.index'); })->name('verifikasi.index');
    Route::get('/verifikasi/{id}', function () { return view('rt.verifikasi.show'); })->name('verifikasi.show');
    Route::get('/surat', function () { return view('rt.surat.index'); })->name('surat.index');
    Route::get('/warga', function () { return view('rt.warga.index'); })->name('warga.index');
    Route::get('/template', function () { return view('rt.template.index'); })->name('template.index');
    Route::get('/laporan', function () { return view('rt.laporan.index'); })->name('laporan.index');
    Route::get('/settings', function () { return view('rt.settings.index'); })->name('settings.index');
    Route::get('/profile', function () { return view('rt.profile.index'); })->name('rt.profile');
});

// Profile Routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
