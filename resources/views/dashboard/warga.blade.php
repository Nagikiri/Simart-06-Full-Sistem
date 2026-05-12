@extends('layouts.app')

@section('title', 'Dashboard Warga')
@section('breadcrumb-parent', 'Warga')
@section('breadcrumb-current', 'Dashboard')

@section('content')

    {{-- ═══════════════════════════════════════════════════════════════
         HERO — Welcome Section (Stitch: "Selamat Datang, Pak Budi")
         Gradient background matching primary → primary-container
    ═══════════════════════════════════════════════════════════════ --}}
    <section class="relative rounded-[1.5rem] overflow-hidden mb-8" style="background: linear-gradient(135deg, #00685d 0%, #008376 50%, #2A9D8F 100%);">
        {{-- Decorative orbs --}}
        <div class="absolute top-0 right-0 w-64 h-64 bg-white/5 rounded-full blur-3xl -translate-y-16 translate-x-16"></div>
        <div class="absolute bottom-0 left-0 w-48 h-48 bg-white/5 rounded-full blur-2xl translate-y-12 -translate-x-8"></div>

        <div class="relative z-10 px-8 lg:px-10 py-8 lg:py-10 flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
            <div>
                <h1 class="font-manrope font-bold text-2xl lg:text-3xl text-white leading-tight mb-2">
                    Selamat Datang, {{ auth()->user()->name ?? 'Warga' }}
                </h1>
                <p class="text-white/70 text-sm lg:text-base">
                    Pantau pengajuan surat dan kegiatan RT 06 hari ini.
                </p>
            </div>
            <a href="{{ route('pengajuan.create') }}"
               class="inline-flex items-center gap-2 bg-white text-[#00685d] font-semibold px-6 py-3 rounded-xl text-sm shadow-lg hover:shadow-xl transition-all hover:-translate-y-0.5 self-start">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Buat Pengajuan Baru
            </a>
        </div>
    </section>

    {{-- ═══════════════════════════════════════════════════════════════
         STATS CARDS — (Stitch: 12 Disetujui, 03 Dalam Antrean, 01 Perlu Revisi)
         No borders — tonal separation via surface-lowest on surface bg
    ═══════════════════════════════════════════════════════════════ --}}
    <section class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-8">
        {{-- Disetujui --}}
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

        {{-- Dalam Antrean --}}
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

        {{-- Perlu Revisi --}}
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
         SERVICE CARDS — Quick Action Grid (Fokus Administrasi Surat)
    ═══════════════════════════════════════════════════════════════ --}}
    <section class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-8">
        {{-- Buat Pengajuan --}}
        <a href="{{ route('pengajuan.create') }}" class="bg-white rounded-[1.5rem] p-6 lg:p-8 ambient-lift group block">
            <div class="w-14 h-14 rounded-2xl flex items-center justify-center mb-5 transition-transform group-hover:scale-110" style="background: linear-gradient(135deg, rgba(0,104,93,0.10), rgba(0,131,118,0.05));">
                <svg class="w-7 h-7" style="color: #00685d;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
            </div>
            <h3 class="font-manrope font-bold text-base mb-1" style="color: #191c1e;">Buat Pengajuan</h3>
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
         MAIN CONTENT — Two-column layout
         Left: Daftar Pengajuan Aktif
         Right: Aktivitas Terkini + Kas RT
    ═══════════════════════════════════════════════════════════════ --}}
    <section class="grid grid-cols-1 lg:grid-cols-12 gap-6 mb-8">

        {{-- ── LEFT COLUMN: Daftar Pengajuan Aktif ──────────────── --}}
        <div class="lg:col-span-7">
            <div class="bg-white rounded-[1.5rem] overflow-hidden">
                {{-- Card Header --}}
                <div class="flex items-center justify-between px-8 pt-8 pb-4">
                    <h2 class="font-manrope font-bold text-lg" style="color: #191c1e;">Daftar Pengajuan Aktif</h2>
                    <a href="{{ route('pengajuan.index') }}" class="text-xs font-semibold transition-colors hover:text-[#008376]" style="color: #00685d;">
                        Lihat Semua
                    </a>
                </div>

                {{-- Pengajuan List — No-Divider Rule (Civic Curator) --}}
                <div class="px-6 pb-6 space-y-2">

                    {{-- Item 1: Sedang Diproses --}}
                    <div class="flex items-center gap-4 px-4 py-4 rounded-xl transition-colors cursor-pointer" style="background: transparent;" onmouseenter="this.style.backgroundColor='#f2f4f6'" onmouseleave="this.style.backgroundColor='transparent'">
                        <div class="w-10 h-10 rounded-xl flex items-center justify-center flex-shrink-0" style="background: linear-gradient(135deg, rgba(0,104,93,0.10), rgba(0,104,93,0.04));">
                            <svg class="w-5 h-5" style="color: #00685d;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                            </svg>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-semibold truncate" style="color: #191c1e;">Surat Pengantar Domisili</p>
                            <p class="text-xs" style="color: #6d7a77;">Diajukan: 20 Juni 2024 • ID: #RT06-8821</p>
                        </div>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-[11px] font-semibold flex-shrink-0" style="background-color: #c7e7ff; color: #064c6b;">
                            Sedang Diproses
                        </span>
                    </div>

                    {{-- Item 2: Selesai --}}
                    <div class="flex items-center gap-4 px-4 py-4 rounded-xl transition-colors cursor-pointer" style="background: transparent;" onmouseenter="this.style.backgroundColor='#f2f4f6'" onmouseleave="this.style.backgroundColor='transparent'">
                        <div class="w-10 h-10 rounded-xl flex items-center justify-center flex-shrink-0" style="background: linear-gradient(135deg, rgba(65,101,56,0.10), rgba(65,101,56,0.04));">
                            <svg class="w-5 h-5" style="color: #416538;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                            </svg>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-semibold truncate" style="color: #191c1e;">Surat Keterangan Berkelakuan Baik</p>
                            <p class="text-xs" style="color: #6d7a77;">Diajukan: 18 Juni 2024 • ID: #RT06-8815</p>
                        </div>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-[11px] font-semibold flex-shrink-0" style="background-color: #c5eeb5; color: #2d4f25;">
                            Selesai
                        </span>
                    </div>

                    {{-- Item 3: Ditolak --}}
                    <div class="flex items-center gap-4 px-4 py-4 rounded-xl transition-colors cursor-pointer" style="background: transparent;" onmouseenter="this.style.backgroundColor='#f2f4f6'" onmouseleave="this.style.backgroundColor='transparent'">
                        <div class="w-10 h-10 rounded-xl flex items-center justify-center flex-shrink-0" style="background: linear-gradient(135deg, rgba(186,26,26,0.08), rgba(186,26,26,0.03));">
                            <svg class="w-5 h-5" style="color: #ba1a1a;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 13.255A23.193 23.193 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-semibold truncate" style="color: #191c1e;">Surat Keterangan Usaha (SKU)</p>
                            <p class="text-xs" style="color: #6d7a77;">Diajukan: 15 Juni 2024 • ID: #RT06-8790</p>
                        </div>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-[11px] font-semibold flex-shrink-0" style="background-color: #ffdad6; color: #93000a;">
                            Ditolak
                        </span>
                    </div>
                </div>
            </div>
        </div>

        {{-- ── RIGHT COLUMN: Aktivitas Terkini + Kas RT ─────────── --}}
        <div class="lg:col-span-5 space-y-6">

            {{-- Aktivitas Terkini (Stitch) --}}
            <div class="bg-white rounded-[1.5rem] p-8">
                <h2 class="font-manrope font-bold text-lg mb-6" style="color: #191c1e;">Aktivitas Terkini</h2>

                <div class="space-y-5">
                    {{-- Activity 1: Kerja Bakti --}}
                    <div class="flex gap-4">
                        <div class="w-2 h-2 rounded-full mt-2 flex-shrink-0" style="background-color: #00685d;"></div>
                        <div>
                            <p class="text-sm font-semibold" style="color: #191c1e;">Kerja Bakti Minggu Ini</p>
                            <p class="text-xs mt-0.5" style="color: #6d7a77;">Diumumkan oleh Ketua RT • 2 Jam yang lalu</p>
                            <p class="text-xs mt-1 italic" style="color: #3d4947;">"Persiapan menyambut HUT RI ke-79..."</p>
                        </div>
                    </div>

                    {{-- Activity 2: Surat Selesai --}}
                    <div class="flex gap-4">
                        <div class="w-2 h-2 rounded-full mt-2 flex-shrink-0" style="background-color: #416538;"></div>
                        <div>
                            <p class="text-sm font-semibold" style="color: #191c1e;">Surat Domisili Selesai</p>
                            <p class="text-xs mt-0.5" style="color: #6d7a77;">Admin RT 06 • Kemarin, 14:20</p>
                        </div>
                    </div>

                    {{-- Activity 3: Pengajuan Disetujui --}}
                    <div class="flex gap-4">
                        <div class="w-2 h-2 rounded-full mt-2 flex-shrink-0" style="background-color: #2b6485;"></div>
                        <div>
                            <p class="text-sm font-semibold" style="color: #191c1e;">Pengajuan Disetujui</p>
                            <p class="text-xs mt-0.5" style="color: #6d7a77;">Admin RT 06 • 2 Hari yang lalu</p>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </section>

    {{-- ═══════════════════════════════════════════════════════════════
         RIWAYAT AKTIVITAS TERAKHIR — Table (Warga Only)
         Civic Curator "No-Divider" Table Rule
    ═══════════════════════════════════════════════════════════════ --}}
    @if(auth()->user()->role === 'warga')
    <section class="mb-8">
        <div class="bg-white rounded-[1.5rem] overflow-hidden">
            {{-- Header --}}
            <div class="flex items-center justify-between px-8 pt-8 pb-4">
                <h2 class="font-manrope font-bold text-lg" style="color: #191c1e;">Riwayat Aktivitas Terakhir</h2>
                <a href="{{ route('riwayat.index') }}" class="text-xs font-semibold transition-colors hover:text-[#008376]" style="color: #00685d;">
                    Lihat Semua →
                </a>
            </div>

            {{-- Table — No horizontal dividers, hover row highlight --}}
            <div class="overflow-x-auto">
                <table class="w-full civic-table">
                    <thead>
                        <tr>
                            <th class="px-8 py-3 text-left text-[11px] font-semibold uppercase tracking-widest" style="color: #3d4947; letter-spacing: 0.05rem;">Jenis Surat</th>
                            <th class="px-4 py-3 text-left text-[11px] font-semibold uppercase tracking-widest" style="color: #3d4947; letter-spacing: 0.05rem;">ID</th>
                            <th class="px-4 py-3 text-left text-[11px] font-semibold uppercase tracking-widest" style="color: #3d4947; letter-spacing: 0.05rem;">Tanggal</th>
                            <th class="px-4 py-3 text-left text-[11px] font-semibold uppercase tracking-widest" style="color: #3d4947; letter-spacing: 0.05rem;">Status</th>
                            <th class="px-8 py-3 text-right text-[11px] font-semibold uppercase tracking-widest" style="color: #3d4947; letter-spacing: 0.05rem;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- Row 1 --}}
                        <tr class="transition-colors cursor-pointer" style="border: none;" onmouseenter="this.style.backgroundColor='#f2f4f6'" onmouseleave="this.style.backgroundColor='transparent'">
                            <td class="px-8 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-lg flex items-center justify-center" style="background-color: rgba(0,104,93,0.08);">
                                        <span class="material-icons-outlined text-base" style="color: #00685d;">home</span>
                                    </div>
                                    <span class="text-sm font-medium" style="color: #191c1e;">Surat Pengantar Domisili</span>
                                </div>
                            </td>
                            <td class="px-4 py-4 text-xs font-mono" style="color: #6d7a77;">#RT06-8821</td>
                            <td class="px-4 py-4 text-xs" style="color: #6d7a77;">20 Jun 2024</td>
                            <td class="px-4 py-4">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-[11px] font-semibold" style="background-color: #c5eeb5; color: #2d4f25;">Selesai</span>
                            </td>
                            <td class="px-8 py-4 text-right">
                                <a href="#" class="text-xs font-semibold transition-colors hover:text-[#008376]" style="color: #00685d;">Lihat</a>
                            </td>
                        </tr>

                        {{-- Row 2 --}}
                        <tr class="transition-colors cursor-pointer" style="border: none;" onmouseenter="this.style.backgroundColor='#f2f4f6'" onmouseleave="this.style.backgroundColor='transparent'">
                            <td class="px-8 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-lg flex items-center justify-center" style="background-color: rgba(43,100,133,0.08);">
                                        <span class="material-icons-outlined text-base" style="color: #2b6485;">work</span>
                                    </div>
                                    <span class="text-sm font-medium" style="color: #191c1e;">Surat Keterangan Usaha</span>
                                </div>
                            </td>
                            <td class="px-4 py-4 text-xs font-mono" style="color: #6d7a77;">#RT06-8790</td>
                            <td class="px-4 py-4 text-xs" style="color: #6d7a77;">15 Jun 2024</td>
                            <td class="px-4 py-4">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-[11px] font-semibold" style="background-color: #ffdad6; color: #93000a;">Ditolak</span>
                            </td>
                            <td class="px-8 py-4 text-right">
                                <a href="#" class="text-xs font-semibold transition-colors hover:text-[#008376]" style="color: #00685d;">Lihat</a>
                            </td>
                        </tr>

                        {{-- Row 3 --}}
                        <tr class="transition-colors cursor-pointer" style="border: none;" onmouseenter="this.style.backgroundColor='#f2f4f6'" onmouseleave="this.style.backgroundColor='transparent'">
                            <td class="px-8 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-lg flex items-center justify-center" style="background-color: rgba(65,101,56,0.08);">
                                        <span class="material-icons-outlined text-base" style="color: #416538;">verified_user</span>
                                    </div>
                                    <span class="text-sm font-medium" style="color: #191c1e;">Surat Berkelakuan Baik</span>
                                </div>
                            </td>
                            <td class="px-4 py-4 text-xs font-mono" style="color: #6d7a77;">#RT06-8815</td>
                            <td class="px-4 py-4 text-xs" style="color: #6d7a77;">18 Jun 2024</td>
                            <td class="px-4 py-4">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-[11px] font-semibold" style="background-color: #c5eeb5; color: #2d4f25;">Selesai</span>
                            </td>
                            <td class="px-8 py-4 text-right">
                                <a href="#" class="text-xs font-semibold transition-colors hover:text-[#008376]" style="color: #00685d;">Lihat</a>
                            </td>
                        </tr>

                        {{-- Row 4 --}}
                        <tr class="transition-colors cursor-pointer" style="border: none;" onmouseenter="this.style.backgroundColor='#f2f4f6'" onmouseleave="this.style.backgroundColor='transparent'">
                            <td class="px-8 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-lg flex items-center justify-center" style="background-color: rgba(0,104,93,0.08);">
                                        <span class="material-icons-outlined text-base" style="color: #00685d;">family_restroom</span>
                                    </div>
                                    <span class="text-sm font-medium" style="color: #191c1e;">Surat Keterangan Keluarga</span>
                                </div>
                            </td>
                            <td class="px-4 py-4 text-xs font-mono" style="color: #6d7a77;">#RT06-8778</td>
                            <td class="px-4 py-4 text-xs" style="color: #6d7a77;">10 Jun 2024</td>
                            <td class="px-4 py-4">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-[11px] font-semibold" style="background-color: #c7e7ff; color: #064c6b;">Diproses</span>
                            </td>
                            <td class="px-8 py-4 text-right">
                                <a href="#" class="text-xs font-semibold transition-colors hover:text-[#008376]" style="color: #00685d;">Lihat</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
    @endif

    {{-- ═══════════════════════════════════════════════════════════════
         INFO BANNER — Informasi Penting (Stitch)
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
