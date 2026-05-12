@extends('layouts.app')

@section('title', 'Dashboard')
@section('breadcrumb-parent', 'Dashboard')

@section('content')

    {{-- ═══════════════════════════════════════════════════════════════
         HERO — Welcome Section
         Gradient background matching primary → primary-container
    ═══════════════════════════════════════════════════════════════ --}}
    <section class="relative rounded-[1.5rem] overflow-hidden mb-8" style="background: linear-gradient(135deg, #00685d 0%, #008376 50%, #2A9D8F 100%);">
        {{-- Decorative orbs --}}
        <div class="absolute top-0 right-0 w-64 h-64 bg-white/5 rounded-full blur-3xl -translate-y-16 translate-x-16"></div>
        <div class="absolute bottom-0 left-0 w-48 h-48 bg-white/5 rounded-full blur-2xl translate-y-12 -translate-x-8"></div>

        <div class="relative z-10 px-8 lg:px-10 py-8 lg:py-10 flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
            <div>
                <h1 class="font-manrope font-bold text-2xl lg:text-3xl text-white leading-tight mb-2">
                    Selamat Datang, {{ auth()->user()->name ?? 'Pengguna' }}
                </h1>
                <p class="text-white/70 text-sm lg:text-base">
                    Pantau pengajuan surat dan kegiatan RT 06 hari ini.
                </p>
            </div>
            @if(auth()->user()->role === 'warga')
            <a href="{{ route('pengajuan.create') }}"
               class="inline-flex items-center gap-2 bg-white text-[#00685d] font-semibold px-6 py-3 rounded-xl text-sm shadow-lg hover:shadow-xl transition-all hover:-translate-y-0.5 self-start">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Buat Pengajuan Baru
            </a>
            @endif
        </div>
    </section>

    {{-- ═══════════════════════════════════════════════════════════════
         STATS CARDS — Dynamic based on role
    ═══════════════════════════════════════════════════════════════ --}}
    <section class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-8">
        {{-- Card 1 --}}
        <div class="bg-white rounded-[1.5rem] p-6 lg:p-8 ambient-lift cursor-default">
            <div class="flex items-start justify-between mb-4">
                <div class="w-11 h-11 rounded-xl flex items-center justify-center" style="background: linear-gradient(135deg, rgba(65,101,56,0.12), rgba(65,101,56,0.04));">
                    <svg class="w-5 h-5" style="color: #416538;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>
            <span class="font-manrope font-bold text-3xl lg:text-4xl" style="color: #191c1e;">12</span>
            <p class="text-xs font-medium uppercase tracking-widest mt-1" style="color: #6d7a77; letter-spacing: 0.06rem;">Disetujui</p>
        </div>

        {{-- Card 2 --}}
        <div class="bg-white rounded-[1.5rem] p-6 lg:p-8 ambient-lift cursor-default">
            <div class="flex items-start justify-between mb-4">
                <div class="w-11 h-11 rounded-xl flex items-center justify-center" style="background: linear-gradient(135deg, rgba(43,100,133,0.12), rgba(43,100,133,0.04));">
                    <svg class="w-5 h-5" style="color: #2b6485;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>
            <span class="font-manrope font-bold text-3xl lg:text-4xl" style="color: #191c1e;">03</span>
            <p class="text-xs font-medium uppercase tracking-widest mt-1" style="color: #6d7a77; letter-spacing: 0.06rem;">Dalam Antrean</p>
        </div>

        {{-- Card 3 --}}
        <div class="bg-white rounded-[1.5rem] p-6 lg:p-8 ambient-lift cursor-default">
            <div class="flex items-start justify-between mb-4">
                <div class="w-11 h-11 rounded-xl flex items-center justify-center" style="background: linear-gradient(135deg, rgba(186,26,26,0.10), rgba(186,26,26,0.03));">
                    <svg class="w-5 h-5" style="color: #ba1a1a;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.34 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                    </svg>
                </div>
            </div>
            <span class="font-manrope font-bold text-3xl lg:text-4xl" style="color: #191c1e;">01</span>
            <p class="text-xs font-medium uppercase tracking-widest mt-1" style="color: #6d7a77; letter-spacing: 0.06rem;">Perlu Revisi</p>
        </div>
    </section>

    {{-- ═══════════════════════════════════════════════════════════════
         SERVICE CARDS — Quick Action Grid
    ═══════════════════════════════════════════════════════════════ --}}
    <section class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-8">
        {{-- Buat Laporan --}}
        <a href="{{ route('pengajuan.create') }}" class="bg-white rounded-[1.5rem] p-6 lg:p-8 ambient-lift group block">
            <div class="w-14 h-14 rounded-2xl flex items-center justify-center mb-5 transition-transform group-hover:scale-110" style="background: linear-gradient(135deg, rgba(0,104,93,0.10), rgba(0,131,118,0.05));">
                <svg class="w-7 h-7" style="color: #00685d;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
            </div>
            <h3 class="font-manrope font-bold text-base mb-1" style="color: #191c1e;">Buat Laporan</h3>
            <p class="text-xs" style="color: #6d7a77;">Ajukan surat keterangan atau pengantar baru</p>
        </a>

        {{-- Riwayat Surat --}}
        <a href="{{ route('riwayat.index') }}" class="bg-white rounded-[1.5rem] p-6 lg:p-8 ambient-lift group block">
            <div class="w-14 h-14 rounded-2xl flex items-center justify-center mb-5 transition-transform group-hover:scale-110" style="background: linear-gradient(135deg, rgba(43,100,133,0.10), rgba(43,100,133,0.05));">
                <svg class="w-7 h-7" style="color: #2b6485;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                </svg>
            </div>
            <h3 class="font-manrope font-bold text-base mb-1" style="color: #191c1e;">Riwayat Surat</h3>
            <p class="text-xs" style="color: #6d7a77;">Lihat status dan riwayat pengajuan surat Anda</p>
        </a>

        {{-- Surat Pengantar --}}
        <a href="{{ route('pengajuan.create') }}" class="bg-white rounded-[1.5rem] p-6 lg:p-8 ambient-lift group block">
            <div class="w-14 h-14 rounded-2xl flex items-center justify-center mb-5 transition-transform group-hover:scale-110" style="background: linear-gradient(135deg, rgba(65,101,56,0.10), rgba(65,101,56,0.05));">
                <svg class="w-7 h-7" style="color: #416538;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                </svg>
            </div>
            <h3 class="font-manrope font-bold text-base mb-1" style="color: #191c1e;">Surat Pengantar</h3>
            <p class="text-xs" style="color: #6d7a77;">Minta surat pengantar domisili dan lainnya</p>
        </a>
    </section>

    {{-- ═══════════════════════════════════════════════════════════════
         INFO BANNER — Informasi Penting
    ═══════════════════════════════════════════════════════════════ --}}
    <section class="mb-4">
        <div class="rounded-[1.5rem] p-6 lg:p-8" style="background-color: #eceef0;">
            <div class="flex items-start gap-4">
                <div class="w-10 h-10 rounded-xl flex items-center justify-center flex-shrink-0" style="background-color: rgba(43,100,133,0.10);">
                    <svg class="w-5 h-5" style="color: #2b6485;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div>
                    <h3 class="font-manrope font-bold text-sm mb-1" style="color: #191c1e;">Informasi Penting</h3>
                    <p class="text-sm leading-relaxed" style="color: #3d4947;">
                        Jadwal Siskamling periode ini telah diperbarui. Mohon cek kehadiran Anda untuk menjaga keamanan lingkungan kita.
                    </p>
                </div>
            </div>
        </div>
    </section>
@endsection
