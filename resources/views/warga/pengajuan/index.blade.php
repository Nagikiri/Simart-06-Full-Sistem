@extends('layouts.app')

@section('title', 'Daftar Pengajuan')
@section('breadcrumb-parent', 'Warga')
@section('breadcrumb-current', 'Pengajuan')

@section('content')

    {{-- ═══════════════════════════════════════════════════════════════
         PAGE HEADER + CTA
    ═══════════════════════════════════════════════════════════════ --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
        <div>
            <h1 class="font-manrope font-bold text-2xl" style="color: #191c1e;">Daftar Pengajuan Surat</h1>
            <p class="text-sm mt-1" style="color: #3d4947;">Pantau semua pengajuan surat Anda di satu tempat.</p>
        </div>
        <a href="{{ route('pengajuan.create') }}"
           class="inline-flex items-center gap-2 text-white font-semibold px-6 py-3 rounded-xl text-sm transition-all hover:shadow-lg hover:-translate-y-0.5"
           style="background: linear-gradient(135deg, #00685d 0%, #008376 100%);">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Buat Pengajuan Baru
        </a>
    </div>

    {{-- ═══════════════════════════════════════════════════════════════
         STATS SUMMARY
    ═══════════════════════════════════════════════════════════════ --}}
    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mb-8">
        <div class="bg-white rounded-[1.5rem] p-5 ambient-lift">
            <span class="font-manrope font-bold text-2xl" style="color: #191c1e;">5</span>
            <p class="text-xs font-medium uppercase tracking-wider mt-1" style="color: #6d7a77; letter-spacing: 0.05rem;">Total</p>
        </div>
        <div class="bg-white rounded-[1.5rem] p-5 ambient-lift">
            <span class="font-manrope font-bold text-2xl" style="color: #00685d;">3</span>
            <p class="text-xs font-medium uppercase tracking-wider mt-1" style="color: #6d7a77; letter-spacing: 0.05rem;">Disetujui</p>
        </div>
        <div class="bg-white rounded-[1.5rem] p-5 ambient-lift">
            <span class="font-manrope font-bold text-2xl" style="color: #2b6485;">1</span>
            <p class="text-xs font-medium uppercase tracking-wider mt-1" style="color: #6d7a77; letter-spacing: 0.05rem;">Menunggu</p>
        </div>
        <div class="bg-white rounded-[1.5rem] p-5 ambient-lift">
            <span class="font-manrope font-bold text-2xl" style="color: #ba1a1a;">1</span>
            <p class="text-xs font-medium uppercase tracking-wider mt-1" style="color: #6d7a77; letter-spacing: 0.05rem;">Ditolak</p>
        </div>
    </div>

    {{-- ═══════════════════════════════════════════════════════════════
         PENGAJUAN LIST — No-Divider Cards (Civic Curator)
    ═══════════════════════════════════════════════════════════════ --}}
    <div class="bg-white rounded-[1.5rem] overflow-hidden">
        {{-- Card Header with Filter --}}
        <div class="flex items-center justify-between px-8 pt-8 pb-4">
            <h2 class="font-manrope font-bold text-lg" style="color: #191c1e;">Semua Pengajuan</h2>
            <div class="flex items-center gap-2">
                <select class="text-xs px-3 py-2 rounded-xl border-none focus:ring-2 focus:ring-[#00685d]/20" style="background-color: #eceef0; color: #3d4947;">
                    <option>Semua Status</option>
                    <option>Disetujui</option>
                    <option>Menunggu</option>
                    <option>Ditolak</option>
                </select>
            </div>
        </div>

        {{-- List Items --}}
        <div class="px-6 pb-6 space-y-2">

            {{-- Item 1: Disetujui --}}
            <div class="flex items-center gap-4 px-4 py-5 rounded-xl transition-colors cursor-pointer"
                 style="background: transparent;"
                 onmouseenter="this.style.backgroundColor='#f2f4f6'" onmouseleave="this.style.backgroundColor='transparent'">
                <div class="w-11 h-11 rounded-xl flex items-center justify-center flex-shrink-0" style="background: linear-gradient(135deg, rgba(0,104,93,0.10), rgba(0,104,93,0.04));">
                    <svg class="w-5 h-5" style="color: #00685d;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-semibold" style="color: #191c1e;">Surat Keterangan Domisili</p>
                    <p class="text-xs mt-0.5" style="color: #6d7a77;">Diajukan: 10 Apr 2026 • ID: #RT06-0042</p>
                </div>
                <span class="inline-flex items-center px-3 py-1 rounded-full text-[11px] font-semibold flex-shrink-0" style="background-color: #c5eeb5; color: #2d4f25;">
                    Disetujui
                </span>
                <a href="#" class="text-xs font-semibold transition-colors hover:text-[#008376] flex-shrink-0 ml-2" style="color: #00685d;">
                    Lihat →
                </a>
            </div>

            {{-- Item 2: Disetujui --}}
            <div class="flex items-center gap-4 px-4 py-5 rounded-xl transition-colors cursor-pointer"
                 style="background: transparent;"
                 onmouseenter="this.style.backgroundColor='#f2f4f6'" onmouseleave="this.style.backgroundColor='transparent'">
                <div class="w-11 h-11 rounded-xl flex items-center justify-center flex-shrink-0" style="background: linear-gradient(135deg, rgba(65,101,56,0.10), rgba(65,101,56,0.04));">
                    <svg class="w-5 h-5" style="color: #416538;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                    </svg>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-semibold" style="color: #191c1e;">Surat Berkelakuan Baik</p>
                    <p class="text-xs mt-0.5" style="color: #6d7a77;">Diajukan: 08 Apr 2026 • ID: #RT06-0039</p>
                </div>
                <span class="inline-flex items-center px-3 py-1 rounded-full text-[11px] font-semibold flex-shrink-0" style="background-color: #c5eeb5; color: #2d4f25;">
                    Disetujui
                </span>
                <a href="#" class="text-xs font-semibold transition-colors hover:text-[#008376] flex-shrink-0 ml-2" style="color: #00685d;">
                    Lihat →
                </a>
            </div>

            {{-- Item 3: Disetujui --}}
            <div class="flex items-center gap-4 px-4 py-5 rounded-xl transition-colors cursor-pointer"
                 style="background: transparent;"
                 onmouseenter="this.style.backgroundColor='#f2f4f6'" onmouseleave="this.style.backgroundColor='transparent'">
                <div class="w-11 h-11 rounded-xl flex items-center justify-center flex-shrink-0" style="background: linear-gradient(135deg, rgba(0,104,93,0.10), rgba(0,104,93,0.04));">
                    <svg class="w-5 h-5" style="color: #00685d;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-semibold" style="color: #191c1e;">Surat Pengantar Umum</p>
                    <p class="text-xs mt-0.5" style="color: #6d7a77;">Diajukan: 05 Apr 2026 • ID: #RT06-0035</p>
                </div>
                <span class="inline-flex items-center px-3 py-1 rounded-full text-[11px] font-semibold flex-shrink-0" style="background-color: #c5eeb5; color: #2d4f25;">
                    Disetujui
                </span>
                <a href="#" class="text-xs font-semibold transition-colors hover:text-[#008376] flex-shrink-0 ml-2" style="color: #00685d;">
                    Lihat →
                </a>
            </div>

            {{-- Item 4: Menunggu --}}
            <div class="flex items-center gap-4 px-4 py-5 rounded-xl transition-colors cursor-pointer"
                 style="background: transparent;"
                 onmouseenter="this.style.backgroundColor='#f2f4f6'" onmouseleave="this.style.backgroundColor='transparent'">
                <div class="w-11 h-11 rounded-xl flex items-center justify-center flex-shrink-0" style="background: linear-gradient(135deg, rgba(43,100,133,0.10), rgba(43,100,133,0.04));">
                    <svg class="w-5 h-5" style="color: #2b6485;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 13.255A23.193 23.193 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-semibold" style="color: #191c1e;">Surat Keterangan Usaha</p>
                    <p class="text-xs mt-0.5" style="color: #6d7a77;">Diajukan: 08 Apr 2026 • ID: #RT06-0038</p>
                </div>
                <span class="inline-flex items-center px-3 py-1 rounded-full text-[11px] font-semibold flex-shrink-0" style="background-color: #c7e7ff; color: #064c6b;">
                    Menunggu
                </span>
                <a href="#" class="text-xs font-semibold transition-colors hover:text-[#008376] flex-shrink-0 ml-2" style="color: #00685d;">
                    Lihat →
                </a>
            </div>

            {{-- Item 5: Ditolak --}}
            <div class="flex items-center gap-4 px-4 py-5 rounded-xl transition-colors cursor-pointer"
                 style="background: transparent;"
                 onmouseenter="this.style.backgroundColor='#f2f4f6'" onmouseleave="this.style.backgroundColor='transparent'">
                <div class="w-11 h-11 rounded-xl flex items-center justify-center flex-shrink-0" style="background: linear-gradient(135deg, rgba(186,26,26,0.08), rgba(186,26,26,0.03));">
                    <svg class="w-5 h-5" style="color: #ba1a1a;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                    </svg>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-semibold" style="color: #191c1e;">Surat Keterangan Tidak Mampu</p>
                    <p class="text-xs mt-0.5" style="color: #6d7a77;">Diajukan: 02 Apr 2026 • ID: #RT06-0030</p>
                </div>
                <span class="inline-flex items-center px-3 py-1 rounded-full text-[11px] font-semibold flex-shrink-0" style="background-color: #ffdad6; color: #93000a;">
                    Ditolak
                </span>
                <a href="#" class="text-xs font-semibold transition-colors hover:text-[#008376] flex-shrink-0 ml-2" style="color: #00685d;">
                    Lihat →
                </a>
            </div>
        </div>
    </div>

@endsection
