@extends('layouts.app')

@section('title', 'Riwayat Pengajuan')
@section('breadcrumb-parent', 'Warga')
@section('breadcrumb-current', 'Riwayat')

@push('styles')
<style>
    /* ── Stepper / Timeline ─────────────────────────────────────── */
    .stepper-line {
        position: absolute;
        left: 15px;
        top: 32px;
        bottom: 0;
        width: 2px;
        background-color: #bcc9c6;
    }
    .stepper-line.completed {
        background: linear-gradient(180deg, #416538, #597e4f);
    }
    .stepper-line.active {
        background: linear-gradient(180deg, #416538, #bcc9c6);
    }

    .stepper-dot {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        z-index: 1;
        position: relative;
        transition: all 0.3s ease;
    }
    .stepper-dot.completed {
        background-color: #416538;
        color: #ffffff;
    }
    .stepper-dot.active {
        background: linear-gradient(135deg, #00685d, #008376);
        color: #ffffff;
        box-shadow: 0 0 0 6px rgba(0, 104, 93, 0.12);
        animation: pulse-ring 2s ease-in-out infinite;
    }
    .stepper-dot.pending {
        background-color: #e0e3e5;
        color: #6d7a77;
    }
    .stepper-dot.rejected {
        background-color: #ba1a1a;
        color: #ffffff;
    }

    @keyframes pulse-ring {
        0%, 100% { box-shadow: 0 0 0 6px rgba(0, 104, 93, 0.12); }
        50% { box-shadow: 0 0 0 10px rgba(0, 104, 93, 0.06); }
    }

    /* ── Modal ──────────────────────────────────────────────────── */
    .modal-backdrop {
        background: rgba(25, 28, 30, 0.5);
        backdrop-filter: blur(8px);
    }
    .modal-panel {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
    }

    /* ── Filter Tabs ────────────────────────────────────────────── */
    .filter-tab {
        transition: all 0.2s ease;
        cursor: pointer;
    }
    .filter-tab.active {
        background-color: rgba(0, 104, 93, 0.08);
        color: #00685d;
        font-weight: 600;
    }
    .filter-tab:not(.active):hover {
        background-color: #f2f4f6;
    }

    /* ── Card hover ─────────────────────────────────────────────── */
    .riwayat-card {
        transition: all 0.3s ease;
    }
    .riwayat-card:hover {
        box-shadow: 0px 12px 32px rgba(25, 28, 30, 0.06);
        transform: translateY(-2px);
    }

    /* ── Empty state animation ──────────────────────────────────── */
    @keyframes float {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-12px); }
    }
    .float-animation {
        animation: float 4s ease-in-out infinite;
    }

    /* ── Slide-in animation for cards ───────────────────────────── */
    @keyframes slideUp {
        from { opacity: 0; transform: translateY(16px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .slide-up {
        animation: slideUp 0.4s ease-out forwards;
    }
    .slide-up:nth-child(1) { animation-delay: 0.05s; }
    .slide-up:nth-child(2) { animation-delay: 0.1s; }
    .slide-up:nth-child(3) { animation-delay: 0.15s; }
    .slide-up:nth-child(4) { animation-delay: 0.2s; }
    .slide-up:nth-child(5) { animation-delay: 0.25s; }
</style>
@endpush

@section('content')

    {{-- ═══════════════════════════════════════════════════════════════
         HEADER — Page Title & Summary Stats
         Stitch: "Riwayat Pengajuan" + stat counters
    ═══════════════════════════════════════════════════════════════ --}}
    <section class="mb-8">
        <div class="flex flex-col lg:flex-row lg:items-end lg:justify-between gap-4 mb-6">
            <div>
                <h1 class="font-manrope font-bold text-2xl lg:text-3xl" style="color: #191c1e;">Riwayat Pengajuan</h1>
                <p class="text-sm mt-1" style="color: #3d4947;">Pantau status surat dan dokumen Anda secara real-time.</p>
            </div>
            <a href="{{ route('pengajuan.create') }}"
               class="inline-flex items-center gap-2 btn-civic-gradient text-white font-semibold px-5 py-2.5 rounded-xl text-sm shadow-md hover:shadow-lg transition-all hover:-translate-y-0.5 self-start lg:self-auto">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Buat Pengajuan Baru
            </a>
        </div>

        {{-- Stats Cards --}}
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            {{-- Total Pengajuan --}}
            <div class="bg-white rounded-2xl p-5 ambient-lift cursor-default">
                <div class="flex items-center gap-4">
                    <div class="w-11 h-11 rounded-xl flex items-center justify-center" style="background: linear-gradient(135deg, rgba(43,100,133,0.12), rgba(43,100,133,0.04));">
                        <span class="material-icons-outlined text-xl" style="color: #2b6485;">list_alt</span>
                    </div>
                    <div>
                        <span class="font-manrope font-bold text-2xl" style="color: #191c1e;" id="stat-total">12</span>
                        <p class="text-[11px] font-medium uppercase tracking-widest" style="color: #6d7a77; letter-spacing: 0.05rem;">Total Pengajuan</p>
                    </div>
                </div>
            </div>

            {{-- Dalam Proses --}}
            <div class="bg-white rounded-2xl p-5 ambient-lift cursor-default">
                <div class="flex items-center gap-4">
                    <div class="w-11 h-11 rounded-xl flex items-center justify-center" style="background: linear-gradient(135deg, rgba(0,104,93,0.12), rgba(0,104,93,0.04));">
                        <span class="material-icons-outlined text-xl" style="color: #00685d;">pending</span>
                    </div>
                    <div>
                        <span class="font-manrope font-bold text-2xl" style="color: #191c1e;" id="stat-proses">3</span>
                        <p class="text-[11px] font-medium uppercase tracking-widest" style="color: #6d7a77; letter-spacing: 0.05rem;">Dalam Proses</p>
                    </div>
                </div>
            </div>

            {{-- Selesai --}}
            <div class="bg-white rounded-2xl p-5 ambient-lift cursor-default">
                <div class="flex items-center gap-4">
                    <div class="w-11 h-11 rounded-xl flex items-center justify-center" style="background: linear-gradient(135deg, rgba(65,101,56,0.12), rgba(65,101,56,0.04));">
                        <span class="material-icons-outlined text-xl" style="color: #416538;">check_circle</span>
                    </div>
                    <div>
                        <span class="font-manrope font-bold text-2xl" style="color: #191c1e;" id="stat-selesai">9</span>
                        <p class="text-[11px] font-medium uppercase tracking-widest" style="color: #6d7a77; letter-spacing: 0.05rem;">Selesai</p>
                    </div>
                </div>
            </div>
        </div>
    </section>


    {{-- ═══════════════════════════════════════════════════════════════
         MAIN CONTENT — Two-column layout
         Left: Daftar Pengajuan (list with filter tabs)
         Right: Status Terkini (stepper/timeline)
    ═══════════════════════════════════════════════════════════════ --}}
    <section class="grid grid-cols-1 lg:grid-cols-12 gap-6 mb-8">

        {{-- ── LEFT COLUMN: Daftar Pengajuan ──────────────────────── --}}
        <div class="lg:col-span-7">
            <div class="bg-white rounded-[1.5rem] overflow-hidden">
                {{-- Card Header with Filter Tabs --}}
                <div class="px-6 lg:px-8 pt-6 lg:pt-8 pb-4">
                    <div class="flex items-center justify-between mb-5">
                        <div class="flex items-center gap-2">
                            <span class="material-icons-outlined text-xl" style="color: #00685d;">list_alt</span>
                            <h2 class="font-manrope font-bold text-lg" style="color: #191c1e;">Daftar Pengajuan</h2>
                        </div>
                        {{-- Search --}}
                        <div class="relative hidden sm:block">
                            <span class="material-icons-outlined absolute left-3 top-1/2 -translate-y-1/2 text-lg" style="color: #6d7a77;">search</span>
                            <input type="text" id="search-input" placeholder="Cari surat..."
                                   class="pl-10 pr-4 py-2 rounded-xl text-sm w-48 focus:outline-none focus:ring-2 transition-all"
                                   style="background-color: #e6e8ea; color: #191c1e; --tw-ring-color: rgba(0,104,93,0.2);">
                        </div>
                    </div>

                    {{-- Filter Tabs --}}
                    <div class="flex gap-2 overflow-x-auto pb-1">
                        <button class="filter-tab active px-4 py-1.5 rounded-full text-xs font-medium whitespace-nowrap" style="color: #3d4947;" data-filter="all" onclick="filterCards('all', this)">
                            Semua
                        </button>
                        <button class="filter-tab px-4 py-1.5 rounded-full text-xs font-medium whitespace-nowrap" style="color: #3d4947;" data-filter="diproses" onclick="filterCards('diproses', this)">
                            Diproses
                        </button>
                        <button class="filter-tab px-4 py-1.5 rounded-full text-xs font-medium whitespace-nowrap" style="color: #3d4947;" data-filter="selesai" onclick="filterCards('selesai', this)">
                            Selesai
                        </button>
                        <button class="filter-tab px-4 py-1.5 rounded-full text-xs font-medium whitespace-nowrap" style="color: #3d4947;" data-filter="ditolak" onclick="filterCards('ditolak', this)">
                            Ditolak
                        </button>
                    </div>
                </div>

                {{-- Pengajuan List --}}
                <div class="px-4 lg:px-6 pb-6 space-y-2" id="pengajuan-list">

                    {{-- Item 1: Sedang Diproses (Active/Selected) --}}
                    <div class="riwayat-card flex items-center gap-4 px-4 py-4 rounded-xl cursor-pointer data-card"
                         data-status="diproses" data-id="8845" data-title="Surat Keterangan Tidak Mampu"
                         onclick="selectPengajuan(this)"
                         style="background-color: rgba(0,104,93,0.04); border-left: 3px solid #00685d;">
                        <div class="w-10 h-10 rounded-xl flex items-center justify-center flex-shrink-0" style="background: linear-gradient(135deg, rgba(0,104,93,0.10), rgba(0,104,93,0.04));">
                            <span class="material-icons-outlined text-lg" style="color: #00685d;">description</span>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-semibold truncate" style="color: #191c1e;">Surat Keterangan Tidak Mampu</p>
                            <p class="text-xs" style="color: #6d7a77;">12 Nov 2023 • ID: #RT06-8845</p>
                        </div>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-[11px] font-semibold flex-shrink-0" style="background-color: #c7e7ff; color: #064c6b;">
                            Diproses
                        </span>
                    </div>

                    {{-- Item 2: Selesai --}}
                    <div class="riwayat-card flex items-center gap-4 px-4 py-4 rounded-xl cursor-pointer transition-colors data-card"
                         data-status="selesai" data-id="8821" data-title="Surat Pengantar Domisili"
                         onclick="selectPengajuan(this)"
                         style="background: transparent;"
                         onmouseenter="if(!this.classList.contains('selected')) this.style.backgroundColor='#f2f4f6'"
                         onmouseleave="if(!this.classList.contains('selected')) this.style.backgroundColor='transparent'">
                        <div class="w-10 h-10 rounded-xl flex items-center justify-center flex-shrink-0" style="background: linear-gradient(135deg, rgba(65,101,56,0.10), rgba(65,101,56,0.04));">
                            <span class="material-icons-outlined text-lg" style="color: #416538;">home</span>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-semibold truncate" style="color: #191c1e;">Surat Pengantar Domisili</p>
                            <p class="text-xs" style="color: #6d7a77;">20 Jun 2024 • ID: #RT06-8821</p>
                        </div>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-[11px] font-semibold flex-shrink-0" style="background-color: #c5eeb5; color: #2d4f25;">
                            Selesai
                        </span>
                    </div>

                    {{-- Item 3: Selesai --}}
                    <div class="riwayat-card flex items-center gap-4 px-4 py-4 rounded-xl cursor-pointer transition-colors data-card"
                         data-status="selesai" data-id="8815" data-title="Surat Keterangan Berkelakuan Baik"
                         onclick="selectPengajuan(this)"
                         style="background: transparent;"
                         onmouseenter="if(!this.classList.contains('selected')) this.style.backgroundColor='#f2f4f6'"
                         onmouseleave="if(!this.classList.contains('selected')) this.style.backgroundColor='transparent'">
                        <div class="w-10 h-10 rounded-xl flex items-center justify-center flex-shrink-0" style="background: linear-gradient(135deg, rgba(65,101,56,0.10), rgba(65,101,56,0.04));">
                            <span class="material-icons-outlined text-lg" style="color: #416538;">verified_user</span>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-semibold truncate" style="color: #191c1e;">Surat Keterangan Berkelakuan Baik</p>
                            <p class="text-xs" style="color: #6d7a77;">18 Jun 2024 • ID: #RT06-8815</p>
                        </div>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-[11px] font-semibold flex-shrink-0" style="background-color: #c5eeb5; color: #2d4f25;">
                            Selesai
                        </span>
                    </div>

                    {{-- Item 4: Ditolak --}}
                    <div class="riwayat-card flex items-center gap-4 px-4 py-4 rounded-xl cursor-pointer transition-colors data-card"
                         data-status="ditolak" data-id="8790" data-title="Surat Keterangan Usaha (SKU)"
                         onclick="selectPengajuan(this)"
                         style="background: transparent;"
                         onmouseenter="if(!this.classList.contains('selected')) this.style.backgroundColor='#f2f4f6'"
                         onmouseleave="if(!this.classList.contains('selected')) this.style.backgroundColor='transparent'">
                        <div class="w-10 h-10 rounded-xl flex items-center justify-center flex-shrink-0" style="background: linear-gradient(135deg, rgba(186,26,26,0.08), rgba(186,26,26,0.03));">
                            <span class="material-icons-outlined text-lg" style="color: #ba1a1a;">work</span>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-semibold truncate" style="color: #191c1e;">Surat Keterangan Usaha (SKU)</p>
                            <p class="text-xs" style="color: #6d7a77;">15 Jun 2024 • ID: #RT06-8790</p>
                        </div>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-[11px] font-semibold flex-shrink-0" style="background-color: #ffdad6; color: #93000a;">
                            Ditolak
                        </span>
                    </div>

                    {{-- Item 5: Diproses --}}
                    <div class="riwayat-card flex items-center gap-4 px-4 py-4 rounded-xl cursor-pointer transition-colors data-card"
                         data-status="diproses" data-id="8778" data-title="Surat Keterangan Keluarga"
                         onclick="selectPengajuan(this)"
                         style="background: transparent;"
                         onmouseenter="if(!this.classList.contains('selected')) this.style.backgroundColor='#f2f4f6'"
                         onmouseleave="if(!this.classList.contains('selected')) this.style.backgroundColor='transparent'">
                        <div class="w-10 h-10 rounded-xl flex items-center justify-center flex-shrink-0" style="background: linear-gradient(135deg, rgba(0,104,93,0.10), rgba(0,104,93,0.04));">
                            <span class="material-icons-outlined text-lg" style="color: #00685d;">family_restroom</span>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-semibold truncate" style="color: #191c1e;">Surat Keterangan Keluarga</p>
                            <p class="text-xs" style="color: #6d7a77;">10 Jun 2024 • ID: #RT06-8778</p>
                        </div>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-[11px] font-semibold flex-shrink-0" style="background-color: #c7e7ff; color: #064c6b;">
                            Diproses
                        </span>
                    </div>

                    {{-- Item 6: Diproses --}}
                    <div class="riwayat-card flex items-center gap-4 px-4 py-4 rounded-xl cursor-pointer transition-colors data-card"
                         data-status="diproses" data-id="8899" data-title="Surat Pengantar Nikah"
                         onclick="selectPengajuan(this)"
                         style="background: transparent;"
                         onmouseenter="if(!this.classList.contains('selected')) this.style.backgroundColor='#f2f4f6'"
                         onmouseleave="if(!this.classList.contains('selected')) this.style.backgroundColor='transparent'">
                        <div class="w-10 h-10 rounded-xl flex items-center justify-center flex-shrink-0" style="background: linear-gradient(135deg, rgba(43,100,133,0.10), rgba(43,100,133,0.04));">
                            <span class="material-icons-outlined text-lg" style="color: #2b6485;">favorite</span>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-semibold truncate" style="color: #191c1e;">Surat Pengantar Nikah</p>
                            <p class="text-xs" style="color: #6d7a77;">05 Jun 2024 • ID: #RT06-8899</p>
                        </div>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-[11px] font-semibold flex-shrink-0" style="background-color: #c7e7ff; color: #064c6b;">
                            Diproses
                        </span>
                    </div>
                </div>

                {{-- ── EMPTY STATE (hidden by default) ────────────────── --}}
                <div class="hidden px-8 py-16 text-center" id="empty-state">
                    <div class="float-animation inline-block mb-6">
                        <div class="w-24 h-24 rounded-[2rem] flex items-center justify-center mx-auto" style="background: linear-gradient(135deg, rgba(0,104,93,0.08), rgba(42,157,143,0.04));">
                            <span class="material-icons-outlined" style="font-size: 48px; color: #00685d; opacity: 0.6;">inbox</span>
                        </div>
                    </div>
                    <h3 class="font-manrope font-bold text-lg mb-2" style="color: #191c1e;">Belum Ada Pengajuan</h3>
                    <p class="text-sm mb-6 max-w-sm mx-auto" style="color: #6d7a77;">
                        Anda belum pernah mengajukan surat atau dokumen apapun. Mulai dengan membuat pengajuan baru.
                    </p>
                    <a href="{{ route('pengajuan.create') }}"
                       class="inline-flex items-center gap-2 btn-civic-gradient text-white font-semibold px-6 py-3 rounded-xl text-sm shadow-md hover:shadow-lg transition-all hover:-translate-y-0.5">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        Buat Pengajuan Pertama
                    </a>
                </div>

                {{-- ── EMPTY FILTER STATE (hidden by default) ─────────── --}}
                <div class="hidden px-8 py-12 text-center" id="empty-filter-state">
                    <span class="material-icons-outlined mb-3" style="font-size: 40px; color: #bcc9c6;">filter_list_off</span>
                    <h3 class="font-manrope font-bold text-base mb-1" style="color: #191c1e;">Tidak Ada Data</h3>
                    <p class="text-sm" style="color: #6d7a77;">Tidak ditemukan pengajuan dengan filter ini.</p>
                </div>
            </div>
        </div>


        {{-- ── RIGHT COLUMN: Status Terkini (Stepper) ─────────────── --}}
        <div class="lg:col-span-5 space-y-6">

            {{-- Status Tracking Panel --}}
            <div class="bg-white rounded-[1.5rem] overflow-hidden" id="tracking-panel">
                {{-- Header --}}
                <div class="px-6 lg:px-8 pt-6 lg:pt-8 pb-4">
                    <div class="flex items-center gap-2 mb-1">
                        <span class="material-icons-outlined text-xl" style="color: #00685d;">timeline</span>
                        <h2 class="font-manrope font-bold text-lg" style="color: #191c1e;">Status Terkini</h2>
                    </div>
                    <div class="flex items-center gap-2 mt-3">
                        <span class="text-[11px] font-semibold uppercase tracking-widest" style="color: #6d7a77; letter-spacing: 0.05rem;">ID Pengajuan Terpilih</span>
                    </div>
                    <span class="font-mono text-sm font-bold mt-1 inline-block" style="color: #00685d;" id="tracking-id">#RT06-8845</span>
                    <p class="text-sm font-semibold mt-0.5" style="color: #191c1e;" id="tracking-title">Surat Keterangan Tidak Mampu</p>
                </div>

                {{-- Stepper Timeline --}}
                <div class="px-6 lg:px-8 pb-8" id="stepper-container">
                    {{-- Step 1: Submitted — Completed --}}
                    <div class="flex gap-4 relative pb-8">
                        <div class="stepper-line completed"></div>
                        <div class="stepper-dot completed">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>
                        <div class="flex-1 min-w-0 pt-1">
                            <p class="text-sm font-semibold" style="color: #191c1e;">Diajukan</p>
                            <p class="text-xs mt-0.5" style="color: #3d4947;">Data telah diterima sistem</p>
                            <p class="text-[11px] font-medium mt-1.5" style="color: #6d7a77;">12 Nov 2023, 09:15 WIB</p>
                        </div>
                    </div>

                    {{-- Step 2: Verified — Completed --}}
                    <div class="flex gap-4 relative pb-8">
                        <div class="stepper-line active"></div>
                        <div class="stepper-dot completed">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>
                        <div class="flex-1 min-w-0 pt-1">
                            <p class="text-sm font-semibold" style="color: #191c1e;">Diverifikasi Admin</p>
                            <p class="text-xs mt-0.5" style="color: #3d4947;">Kelengkapan berkas terverifikasi</p>
                            <p class="text-[11px] font-medium mt-1.5" style="color: #6d7a77;">12 Nov 2023, 14:30 WIB</p>
                        </div>
                    </div>

                    {{-- Step 3: Approved — Active (in progress) --}}
                    <div class="flex gap-4 relative pb-8">
                        <div class="stepper-line"></div>
                        <div class="stepper-dot active">
                            <span class="material-icons-outlined text-base">more_horiz</span>
                        </div>
                        <div class="flex-1 min-w-0 pt-1">
                            <p class="text-sm font-semibold" style="color: #00685d;">Disetujui Ketua RT</p>
                            <p class="text-xs mt-0.5" style="color: #3d4947;">Menunggu tanda tangan Ketua RT</p>
                            <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[10px] font-semibold mt-2" style="background-color: #c7e7ff; color: #064c6b;">
                                <span class="w-1.5 h-1.5 rounded-full animate-pulse" style="background-color: #064c6b;"></span>
                                Sedang Berlangsung
                            </span>
                        </div>
                    </div>

                    {{-- Step 4: Ready — Pending --}}
                    <div class="flex gap-4 relative">
                        <div class="stepper-dot pending">
                            <span class="material-icons-outlined text-base">download</span>
                        </div>
                        <div class="flex-1 min-w-0 pt-1">
                            <p class="text-sm font-medium" style="color: #6d7a77;">Siap Diambil</p>
                            <p class="text-xs mt-0.5" style="color: #bcc9c6;">Dokumen dapat diunduh atau diambil</p>
                        </div>
                    </div>
                </div>

                {{-- Action buttons --}}
                <div class="px-6 lg:px-8 pb-6 lg:pb-8 flex gap-3" id="action-buttons">
                    <button onclick="openDetailModal()"
                            class="flex-1 flex items-center justify-center gap-2 px-4 py-3 rounded-xl text-sm font-semibold transition-all hover:-translate-y-0.5"
                            style="background-color: #eceef0; color: #191c1e;">
                        <span class="material-icons-outlined text-lg">visibility</span>
                        Lihat Detail
                    </button>
                </div>
            </div>

            {{-- Help Card --}}
            <div class="rounded-[1.5rem] p-6" style="background-color: #eceef0;">
                <div class="flex items-start gap-3">
                    <div class="w-8 h-8 rounded-lg flex-shrink-0 flex items-center justify-center" style="background-color: rgba(43,100,133,0.10);">
                        <span class="material-icons-outlined text-base" style="color: #2b6485;">help_outline</span>
                    </div>
                    <div>
                        <p class="text-xs font-semibold mb-0.5" style="color: #191c1e;">Butuh Bantuan?</p>
                        <p class="text-xs leading-relaxed" style="color: #3d4947;">Hubungi pengurus RT melalui fitur chat langsung jika ada kendala dengan pengajuan Anda.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>


    {{-- ═══════════════════════════════════════════════════════════════
         DETAIL MODAL — Shows full document information
    ═══════════════════════════════════════════════════════════════ --}}
    <div id="detail-modal" class="fixed inset-0 z-50 hidden">
        <div class="modal-backdrop absolute inset-0" onclick="closeDetailModal()"></div>
        <div class="relative flex items-center justify-center min-h-screen p-4">
            <div class="modal-panel w-full max-w-lg rounded-[1.5rem] shadow-2xl relative z-10 overflow-hidden"
                 style="animation: slideUp 0.3s ease-out;">

                {{-- Modal Header --}}
                <div class="px-8 pt-8 pb-4 flex items-start justify-between">
                    <div>
                        <p class="text-[11px] font-semibold uppercase tracking-widest" style="color: #6d7a77; letter-spacing: 0.05rem;">Detail Pengajuan</p>
                        <h3 class="font-manrope font-bold text-xl mt-1" style="color: #191c1e;" id="modal-title">Surat Keterangan Tidak Mampu</h3>
                    </div>
                    <button onclick="closeDetailModal()" class="p-2 rounded-xl transition-colors hover:bg-[#eceef0]">
                        <span class="material-icons-outlined text-xl" style="color: #6d7a77;">close</span>
                    </button>
                </div>

                {{-- Modal Body --}}
                <div class="px-8 pb-6 space-y-5">
                    {{-- Info Grid --}}
                    <div class="grid grid-cols-2 gap-4">
                        <div class="rounded-xl p-4" style="background-color: #f2f4f6;">
                            <p class="text-[11px] font-medium uppercase tracking-widest mb-1" style="color: #6d7a77; letter-spacing: 0.04rem;">ID Pengajuan</p>
                            <p class="text-sm font-mono font-bold" style="color: #191c1e;" id="modal-id">#RT06-8845</p>
                        </div>
                        <div class="rounded-xl p-4" style="background-color: #f2f4f6;">
                            <p class="text-[11px] font-medium uppercase tracking-widest mb-1" style="color: #6d7a77; letter-spacing: 0.04rem;">Status</p>
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-[11px] font-semibold" id="modal-badge" style="background-color: #c7e7ff; color: #064c6b;">
                                Diproses
                            </span>
                        </div>
                        <div class="rounded-xl p-4" style="background-color: #f2f4f6;">
                            <p class="text-[11px] font-medium uppercase tracking-widest mb-1" style="color: #6d7a77; letter-spacing: 0.04rem;">Tanggal Ajuan</p>
                            <p class="text-sm font-medium" style="color: #191c1e;" id="modal-date">12 Nov 2023</p>
                        </div>
                        <div class="rounded-xl p-4" style="background-color: #f2f4f6;">
                            <p class="text-[11px] font-medium uppercase tracking-widest mb-1" style="color: #6d7a77; letter-spacing: 0.04rem;">Pemohon</p>
                            <p class="text-sm font-medium" style="color: #191c1e;">{{ auth()->user()->name ?? 'Budi Santoso' }}</p>
                        </div>
                    </div>

                    {{-- Keterangan --}}
                    <div class="rounded-xl p-4" style="background-color: #f2f4f6;">
                        <p class="text-[11px] font-medium uppercase tracking-widest mb-2" style="color: #6d7a77; letter-spacing: 0.04rem;">Keterangan</p>
                        <p class="text-sm leading-relaxed" style="color: #3d4947;" id="modal-description">
                            Surat keterangan tidak mampu untuk keperluan pendidikan anak. Dokumen telah diverifikasi oleh admin dan sedang menunggu persetujuan Ketua RT.
                        </p>
                    </div>

                    {{-- Progress --}}
                    <div>
                        <p class="text-[11px] font-medium uppercase tracking-widest mb-3" style="color: #6d7a77; letter-spacing: 0.04rem;">Progress</p>
                        <div class="w-full rounded-full h-2" style="background-color: #e0e3e5;">
                            <div class="h-2 rounded-full transition-all duration-500" id="modal-progress" style="width: 66%; background: linear-gradient(90deg, #416538, #597e4f);"></div>
                        </div>
                        <p class="text-xs font-medium mt-1.5 text-right" style="color: #6d7a77;" id="modal-progress-text">2 dari 4 tahap selesai</p>
                    </div>
                </div>

                {{-- Modal Footer --}}
                <div class="px-8 pb-8 flex gap-3" id="modal-actions">
                    <button onclick="closeDetailModal()"
                            class="flex-1 flex items-center justify-center gap-2 px-4 py-3 rounded-xl text-sm font-semibold transition-all"
                            style="background-color: #eceef0; color: #191c1e;">
                        Tutup
                    </button>
                    <button class="hidden flex-1 items-center justify-center gap-2 btn-civic-gradient text-white px-4 py-3 rounded-xl text-sm font-semibold transition-all hover:shadow-lg hover:-translate-y-0.5"
                            id="modal-download-btn" onclick="downloadSurat()">
                        <span class="material-icons-outlined text-lg">download</span>
                        Unduh Surat
                    </button>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
<script>
    // ── Data pengajuan (static demo — replace with real data from backend) ──
    const pengajuanData = {
        '8845': {
            id: '#RT06-8845',
            title: 'Surat Keterangan Tidak Mampu',
            status: 'diproses',
            date: '12 Nov 2023',
            description: 'Surat keterangan tidak mampu untuk keperluan pendidikan anak. Dokumen telah diverifikasi oleh admin dan sedang menunggu persetujuan Ketua RT.',
            progress: 66,
            progressText: '2 dari 4 tahap selesai',
            steps: [
                { label: 'Diajukan', desc: 'Data telah diterima sistem', time: '12 Nov 2023, 09:15 WIB', status: 'completed' },
                { label: 'Diverifikasi Admin', desc: 'Kelengkapan berkas terverifikasi', time: '12 Nov 2023, 14:30 WIB', status: 'completed' },
                { label: 'Disetujui Ketua RT', desc: 'Menunggu tanda tangan Ketua RT', time: null, status: 'active' },
                { label: 'Siap Diambil', desc: 'Dokumen dapat diunduh atau diambil', time: null, status: 'pending' },
            ]
        },
        '8821': {
            id: '#RT06-8821',
            title: 'Surat Pengantar Domisili',
            status: 'selesai',
            date: '20 Jun 2024',
            description: 'Surat pengantar domisili untuk keperluan administratif. Dokumen telah selesai diproses dan siap diunduh.',
            progress: 100,
            progressText: '4 dari 4 tahap selesai',
            steps: [
                { label: 'Diajukan', desc: 'Data telah diterima sistem', time: '20 Jun 2024, 08:00 WIB', status: 'completed' },
                { label: 'Diverifikasi Admin', desc: 'Kelengkapan berkas terverifikasi', time: '20 Jun 2024, 10:15 WIB', status: 'completed' },
                { label: 'Disetujui Ketua RT', desc: 'Ditandatangani oleh Ketua RT', time: '20 Jun 2024, 14:00 WIB', status: 'completed' },
                { label: 'Siap Diambil', desc: 'Dokumen dapat diunduh atau diambil', time: '20 Jun 2024, 15:30 WIB', status: 'completed' },
            ]
        },
        '8815': {
            id: '#RT06-8815',
            title: 'Surat Keterangan Berkelakuan Baik',
            status: 'selesai',
            date: '18 Jun 2024',
            description: 'Surat keterangan berkelakuan baik untuk keperluan melamar pekerjaan. Proses sudah selesai.',
            progress: 100,
            progressText: '4 dari 4 tahap selesai',
            steps: [
                { label: 'Diajukan', desc: 'Data telah diterima sistem', time: '18 Jun 2024, 09:00 WIB', status: 'completed' },
                { label: 'Diverifikasi Admin', desc: 'Kelengkapan berkas terverifikasi', time: '18 Jun 2024, 11:30 WIB', status: 'completed' },
                { label: 'Disetujui Ketua RT', desc: 'Ditandatangani oleh Ketua RT', time: '18 Jun 2024, 16:00 WIB', status: 'completed' },
                { label: 'Siap Diambil', desc: 'Dokumen dapat diunduh atau diambil', time: '19 Jun 2024, 08:00 WIB', status: 'completed' },
            ]
        },
        '8790': {
            id: '#RT06-8790',
            title: 'Surat Keterangan Usaha (SKU)',
            status: 'ditolak',
            date: '15 Jun 2024',
            description: 'Pengajuan surat keterangan usaha ditolak karena data usaha belum lengkap. Silakan ajukan kembali dengan dokumen yang lengkap.',
            progress: 25,
            progressText: 'Ditolak pada tahap verifikasi',
            steps: [
                { label: 'Diajukan', desc: 'Data telah diterima sistem', time: '15 Jun 2024, 10:00 WIB', status: 'completed' },
                { label: 'Ditolak Admin', desc: 'Data usaha belum lengkap', time: '15 Jun 2024, 15:45 WIB', status: 'rejected' },
                { label: 'Disetujui Ketua RT', desc: 'Tidak dapat dilanjutkan', time: null, status: 'pending' },
                { label: 'Siap Diambil', desc: 'Tidak dapat dilanjutkan', time: null, status: 'pending' },
            ]
        },
        '8778': {
            id: '#RT06-8778',
            title: 'Surat Keterangan Keluarga',
            status: 'diproses',
            date: '10 Jun 2024',
            description: 'Surat keterangan status keluarga untuk keperluan administrasi. Data sedang diverifikasi oleh admin.',
            progress: 33,
            progressText: '1 dari 4 tahap selesai',
            steps: [
                { label: 'Diajukan', desc: 'Data telah diterima sistem', time: '10 Jun 2024, 07:30 WIB', status: 'completed' },
                { label: 'Diverifikasi Admin', desc: 'Menunggu verifikasi berkas', time: null, status: 'active' },
                { label: 'Disetujui Ketua RT', desc: 'Menunggu tahap sebelumnya', time: null, status: 'pending' },
                { label: 'Siap Diambil', desc: 'Menunggu tahap sebelumnya', time: null, status: 'pending' },
            ]
        },
        '8899': {
            id: '#RT06-8899',
            title: 'Surat Pengantar Nikah',
            status: 'diproses',
            date: '05 Jun 2024',
            description: 'Surat pengantar nikah untuk keperluan KUA. Sudah diverifikasi admin dan menunggu persetujuan Ketua RT.',
            progress: 66,
            progressText: '2 dari 4 tahap selesai',
            steps: [
                { label: 'Diajukan', desc: 'Data telah diterima sistem', time: '05 Jun 2024, 09:00 WIB', status: 'completed' },
                { label: 'Diverifikasi Admin', desc: 'Kelengkapan berkas terverifikasi', time: '05 Jun 2024, 13:15 WIB', status: 'completed' },
                { label: 'Disetujui Ketua RT', desc: 'Menunggu tanda tangan Ketua RT', time: null, status: 'active' },
                { label: 'Siap Diambil', desc: 'Dokumen dapat diunduh atau diambil', time: null, status: 'pending' },
            ]
        }
    };

    // ── Select a pengajuan card ──────────────────────────────────
    function selectPengajuan(el) {
        const id = el.dataset.id;
        const data = pengajuanData[id];
        if (!data) return;

        // Reset all cards
        document.querySelectorAll('.data-card').forEach(card => {
            card.style.backgroundColor = 'transparent';
            card.style.borderLeft = 'none';
            card.classList.remove('selected');
        });

        // Highlight selected
        el.style.backgroundColor = 'rgba(0,104,93,0.04)';
        el.style.borderLeft = '3px solid #00685d';
        el.classList.add('selected');

        // Update tracking panel
        document.getElementById('tracking-id').textContent = data.id;
        document.getElementById('tracking-title').textContent = data.title;

        // Render stepper
        renderStepper(data.steps);

        // Update action buttons
        const actionDiv = document.getElementById('action-buttons');
        if (data.status === 'selesai') {
            actionDiv.innerHTML = `
                <button onclick="openDetailModal()" class="flex-1 flex items-center justify-center gap-2 px-4 py-3 rounded-xl text-sm font-semibold transition-all hover:-translate-y-0.5" style="background-color: #eceef0; color: #191c1e;">
                    <span class="material-icons-outlined text-lg">visibility</span>
                    Lihat Detail
                </button>
                <button onclick="downloadSurat()" class="flex-1 flex items-center justify-center gap-2 btn-civic-gradient text-white px-4 py-3 rounded-xl text-sm font-semibold transition-all hover:shadow-lg hover:-translate-y-0.5">
                    <span class="material-icons-outlined text-lg">download</span>
                    Unduh Surat
                </button>`;
        } else {
            actionDiv.innerHTML = `
                <button onclick="openDetailModal()" class="flex-1 flex items-center justify-center gap-2 px-4 py-3 rounded-xl text-sm font-semibold transition-all hover:-translate-y-0.5" style="background-color: #eceef0; color: #191c1e;">
                    <span class="material-icons-outlined text-lg">visibility</span>
                    Lihat Detail
                </button>`;
        }
    }

    // ── Render stepper steps ─────────────────────────────────────
    function renderStepper(steps) {
        const container = document.getElementById('stepper-container');
        container.innerHTML = '';

        steps.forEach((step, i) => {
            const isLast = i === steps.length - 1;
            const stepEl = document.createElement('div');
            stepEl.className = 'flex gap-4 relative' + (isLast ? '' : ' pb-8');

            // Line (except last step)
            let lineHtml = '';
            if (!isLast) {
                let lineClass = 'stepper-line';
                if (step.status === 'completed' && steps[i+1].status === 'completed') lineClass += ' completed';
                else if (step.status === 'completed' && (steps[i+1].status === 'active' || steps[i+1].status === 'rejected')) lineClass += ' active';
                lineHtml = `<div class="${lineClass}"></div>`;
            }

            // Dot
            let dotContent = '';
            let dotClass = 'stepper-dot ' + step.status;
            if (step.status === 'completed') {
                dotContent = `<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>`;
            } else if (step.status === 'active') {
                dotContent = `<span class="material-icons-outlined text-base">more_horiz</span>`;
            } else if (step.status === 'rejected') {
                dotContent = `<span class="material-icons-outlined text-base">close</span>`;
            } else {
                const icons = ['download', 'verified', 'done_all', 'check'];
                dotContent = `<span class="material-icons-outlined text-base">${icons[i] || 'circle'}</span>`;
            }

            // Label color
            let labelColor = '#191c1e';
            let labelWeight = 'font-semibold';
            if (step.status === 'active') { labelColor = '#00685d'; }
            else if (step.status === 'rejected') { labelColor = '#ba1a1a'; }
            else if (step.status === 'pending') { labelColor = '#6d7a77'; labelWeight = 'font-medium'; }

            // Time
            let timeHtml = '';
            if (step.time) {
                timeHtml = `<p class="text-[11px] font-medium mt-1.5" style="color: #6d7a77;">${step.time}</p>`;
            }

            // Active badge
            let badgeHtml = '';
            if (step.status === 'active') {
                badgeHtml = `<span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[10px] font-semibold mt-2" style="background-color: #c7e7ff; color: #064c6b;">
                    <span class="w-1.5 h-1.5 rounded-full animate-pulse" style="background-color: #064c6b;"></span>
                    Sedang Berlangsung
                </span>`;
            } else if (step.status === 'rejected') {
                badgeHtml = `<span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[10px] font-semibold mt-2" style="background-color: #ffdad6; color: #93000a;">
                    <span class="material-icons-outlined text-[10px]">error</span>
                    Ditolak
                </span>`;
            }

            // Desc color
            let descColor = step.status === 'pending' ? '#bcc9c6' : '#3d4947';

            stepEl.innerHTML = `
                ${lineHtml}
                <div class="${dotClass}">${dotContent}</div>
                <div class="flex-1 min-w-0 pt-1">
                    <p class="text-sm ${labelWeight}" style="color: ${labelColor};">${step.label}</p>
                    <p class="text-xs mt-0.5" style="color: ${descColor};">${step.desc}</p>
                    ${timeHtml}
                    ${badgeHtml}
                </div>
            `;
            container.appendChild(stepEl);
        });
    }

    // ── Filter cards ─────────────────────────────────────────────
    function filterCards(status, tabEl) {
        // Update active tab
        document.querySelectorAll('.filter-tab').forEach(t => t.classList.remove('active'));
        tabEl.classList.add('active');

        const cards = document.querySelectorAll('.data-card');
        let visibleCount = 0;

        cards.forEach(card => {
            if (status === 'all' || card.dataset.status === status) {
                card.style.display = 'flex';
                visibleCount++;
            } else {
                card.style.display = 'none';
            }
        });

        // Show/hide empty filter state
        document.getElementById('empty-filter-state').classList.toggle('hidden', visibleCount > 0);
    }

    // ── Search cards ─────────────────────────────────────────────
    document.getElementById('search-input')?.addEventListener('input', function(e) {
        const query = e.target.value.toLowerCase();
        document.querySelectorAll('.data-card').forEach(card => {
            const title = card.dataset.title.toLowerCase();
            const id = card.dataset.id.toLowerCase();
            card.style.display = (title.includes(query) || id.includes(query)) ? 'flex' : 'none';
        });
    });

    // ── Modal controls ───────────────────────────────────────────
    function openDetailModal() {
        const selectedCard = document.querySelector('.data-card.selected') || document.querySelector('.data-card');
        if (!selectedCard) return;

        const id = selectedCard.dataset.id;
        const data = pengajuanData[id];
        if (!data) return;

        // Populate modal
        document.getElementById('modal-title').textContent = data.title;
        document.getElementById('modal-id').textContent = data.id;
        document.getElementById('modal-date').textContent = data.date;
        document.getElementById('modal-description').textContent = data.description;
        document.getElementById('modal-progress').style.width = data.progress + '%';
        document.getElementById('modal-progress-text').textContent = data.progressText;

        // Badge
        const badge = document.getElementById('modal-badge');
        if (data.status === 'selesai') {
            badge.style.backgroundColor = '#c5eeb5';
            badge.style.color = '#2d4f25';
            badge.textContent = 'Selesai';
        } else if (data.status === 'ditolak') {
            badge.style.backgroundColor = '#ffdad6';
            badge.style.color = '#93000a';
            badge.textContent = 'Ditolak';
        } else {
            badge.style.backgroundColor = '#c7e7ff';
            badge.style.color = '#064c6b';
            badge.textContent = 'Diproses';
        }

        // Progress bar color
        const progressBar = document.getElementById('modal-progress');
        if (data.status === 'ditolak') {
            progressBar.style.background = 'linear-gradient(90deg, #ba1a1a, #ff897d)';
        } else if (data.status === 'selesai') {
            progressBar.style.background = 'linear-gradient(90deg, #416538, #597e4f)';
        } else {
            progressBar.style.background = 'linear-gradient(90deg, #00685d, #008376)';
        }

        // Download button
        const downloadBtn = document.getElementById('modal-download-btn');
        if (data.status === 'selesai') {
            downloadBtn.classList.remove('hidden');
            downloadBtn.classList.add('flex');
        } else {
            downloadBtn.classList.add('hidden');
            downloadBtn.classList.remove('flex');
        }

        document.getElementById('detail-modal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeDetailModal() {
        document.getElementById('detail-modal').classList.add('hidden');
        document.body.style.overflow = '';
    }

    function downloadSurat() {
        // Placeholder for actual download logic
        alert('Fitur unduh surat akan tersedia setelah integrasi backend.');
    }

    // Close modal on Escape key
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') closeDetailModal();
    });
</script>
@endpush
