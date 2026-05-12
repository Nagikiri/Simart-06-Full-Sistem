@extends('layouts.app')

@section('title', 'Dashboard Ketua RT')
@section('breadcrumb-parent', 'Ketua RT')
@section('breadcrumb-current', 'Dashboard')

@push('styles')
<style>
    /* ── Chart placeholder ─────────────────────────────────────── */
    .chart-bar {
        transition: all 0.6s cubic-bezier(0.34, 1.56, 0.64, 1);
        transform-origin: bottom;
    }
    .chart-bar:hover {
        filter: brightness(1.1);
        transform: scaleY(1.05);
    }

    /* ── Approval action buttons ───────────────────────────────── */
    .btn-approve {
        background: linear-gradient(135deg, #416538, #597e4f);
        color: #ffffff;
        transition: all 0.2s ease;
    }
    .btn-approve:hover {
        box-shadow: 0 4px 16px rgba(65, 101, 56, 0.3);
        transform: translateY(-1px);
    }
    .btn-reject {
        background-color: #ffdad6;
        color: #93000a;
        transition: all 0.2s ease;
    }
    .btn-reject:hover {
        background-color: #ffb4ab;
        transform: translateY(-1px);
    }

    /* ── Notification badge pulse ───────────────────────────────── */
    .notif-pulse {
        animation: notifPulse 2s ease-in-out infinite;
    }
    @keyframes notifPulse {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.15); }
    }

    /* ── Donut chart ───────────────────────────────────────────── */
    .donut-chart {
        border-radius: 50%;
        position: relative;
    }
    .donut-center {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        border-radius: 50%;
    }

    /* ── Slide-in animation ────────────────────────────────────── */
    @keyframes slideUp {
        from { opacity: 0; transform: translateY(12px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-slide-up {
        animation: slideUp 0.4s ease-out forwards;
    }
</style>
@endpush

@section('content')

    {{-- ═══════════════════════════════════════════════════════════════
         HERO — Welcome Section (Stitch: "Selamat pagi, Pak RT")
    ═══════════════════════════════════════════════════════════════ --}}
    <section class="relative rounded-[1.5rem] overflow-hidden mb-8" style="background: linear-gradient(135deg, #00685d 0%, #008376 50%, #2A9D8F 100%);">
        {{-- Decorative orbs --}}
        <div class="absolute top-0 right-0 w-64 h-64 bg-white/5 rounded-full blur-3xl -translate-y-16 translate-x-16"></div>
        <div class="absolute bottom-0 left-0 w-48 h-48 bg-white/5 rounded-full blur-2xl translate-y-12 -translate-x-8"></div>
        <div class="absolute top-1/2 right-24 w-32 h-32 border border-white/10 rounded-full"></div>

        <div class="relative z-10 px-8 lg:px-10 py-8 lg:py-10 flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
            <div>
                <div class="inline-flex items-center gap-2 bg-white/10 backdrop-blur rounded-full px-3 py-1 border border-white/10 mb-3">
                    <span class="w-2 h-2 rounded-full bg-green-400 animate-pulse"></span>
                    <span class="text-[11px] font-semibold text-white/80 uppercase tracking-wider">Panel Ketua RT</span>
                </div>
                <h1 class="font-manrope font-bold text-2xl lg:text-3xl text-white leading-tight mb-2">
                    Dashboard Overview
                </h1>
                <p class="text-white/70 text-sm lg:text-base">
                    Selamat pagi, {{ auth()->user()->name ?? 'Pak RT' }}. Pantau aktivitas warga hari ini.
                </p>
            </div>
            <div class="flex gap-3 self-start lg:self-auto">
                <a href="{{ route('verifikasi.index') }}"
                   class="inline-flex items-center gap-2 bg-white text-[#00685d] font-semibold px-5 py-2.5 rounded-xl text-sm shadow-lg hover:shadow-xl transition-all hover:-translate-y-0.5">
                    <span class="material-icons-outlined text-lg">assignment_turned_in</span>
                    Verifikasi Surat
                </a>
            </div>
        </div>
    </section>


    {{-- ═══════════════════════════════════════════════════════════════
         STATS CARDS — 4-column grid
    ═══════════════════════════════════════════════════════════════ --}}
    <section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 mb-8">
        {{-- Total Warga --}}
        <div class="bg-white rounded-[1.5rem] p-6 ambient-lift cursor-default">
            <div class="flex items-start justify-between mb-4">
                <div class="w-11 h-11 rounded-xl flex items-center justify-center" style="background: linear-gradient(135deg, rgba(43,100,133,0.12), rgba(43,100,133,0.04));">
                    <span class="material-icons-outlined text-xl" style="color: #2b6485;">groups</span>
                </div>
                <span class="inline-flex items-center gap-1 text-[11px] font-semibold" style="color: #416538;">
                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M12 7a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0V8.414l-4.293 4.293a1 1 0 01-1.414 0L8 10.414l-4.293 4.293a1 1 0 01-1.414-1.414l5-5a1 1 0 011.414 0L11 10.586 14.586 7H12z" clip-rule="evenodd"/></svg>
                    +3 baru
                </span>
            </div>
            <span class="font-manrope font-bold text-3xl" style="color: #191c1e;">248</span>
            <p class="text-xs font-medium uppercase tracking-widest mt-1" style="color: #6d7a77; letter-spacing: 0.06rem;">Total Warga Aktif</p>
        </div>

        {{-- Laporan Belum Dibaca --}}
        <div class="bg-white rounded-[1.5rem] p-6 ambient-lift cursor-default relative">
            <div class="absolute top-4 right-4">
                <span class="w-2.5 h-2.5 rounded-full notif-pulse inline-block" style="background-color: #ba1a1a;"></span>
            </div>
            <div class="flex items-start justify-between mb-4">
                <div class="w-11 h-11 rounded-xl flex items-center justify-center" style="background: linear-gradient(135deg, rgba(186,26,26,0.10), rgba(186,26,26,0.03));">
                    <span class="material-icons-outlined text-xl" style="color: #ba1a1a;">mark_email_unread</span>
                </div>
            </div>
            <span class="font-manrope font-bold text-3xl" style="color: #191c1e;">7</span>
            <p class="text-xs font-medium uppercase tracking-widest mt-1" style="color: #6d7a77; letter-spacing: 0.06rem;">Laporan Belum Dibaca</p>
        </div>

        {{-- Perlu Persetujuan --}}
        <div class="bg-white rounded-[1.5rem] p-6 ambient-lift cursor-default">
            <div class="flex items-start justify-between mb-4">
                <div class="w-11 h-11 rounded-xl flex items-center justify-center" style="background: linear-gradient(135deg, rgba(0,104,93,0.12), rgba(0,104,93,0.04));">
                    <span class="material-icons-outlined text-xl" style="color: #00685d;">pending_actions</span>
                </div>
            </div>
            <span class="font-manrope font-bold text-3xl" style="color: #191c1e;">12</span>
            <p class="text-xs font-medium uppercase tracking-widest mt-1" style="color: #6d7a77; letter-spacing: 0.06rem;">Perlu Persetujuan</p>
        </div>

        {{-- Surat Diterbitkan --}}
        <div class="bg-white rounded-[1.5rem] p-6 ambient-lift cursor-default">
            <div class="flex items-start justify-between mb-4">
                <div class="w-11 h-11 rounded-xl flex items-center justify-center" style="background: linear-gradient(135deg, rgba(65,101,56,0.12), rgba(65,101,56,0.04));">
                    <span class="material-icons-outlined text-xl" style="color: #416538;">task_alt</span>
                </div>
            </div>
            <span class="font-manrope font-bold text-3xl" style="color: #191c1e;">87</span>
            <p class="text-xs font-medium uppercase tracking-widest mt-1" style="color: #6d7a77; letter-spacing: 0.06rem;">Surat Diterbitkan</p>
        </div>
    </section>


    {{-- ═══════════════════════════════════════════════════════════════
         MAIN CONTENT — Two-column layout
         Left: Grafik + Antrean Persetujuan
         Right: Demografi + Notifikasi
    ═══════════════════════════════════════════════════════════════ --}}
    <section class="grid grid-cols-1 lg:grid-cols-12 gap-6 mb-8">

        {{-- ── LEFT COLUMN: Grafik Kas RT / Iuran Bulanan ─────────── --}}
        <div class="lg:col-span-8 space-y-6">

            {{-- Volume Pengajuan Surat (Bar Chart) --}}
            <div class="bg-white rounded-[1.5rem] p-8">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h2 class="font-manrope font-bold text-lg" style="color: #191c1e;">Volume Pengajuan Surat</h2>
                        <p class="text-xs mt-1" style="color: #6d7a77;">Data 6 bulan terakhir</p>
                    </div>
                    <div class="flex items-center gap-4">
                        <div class="flex items-center gap-1.5">
                            <span class="w-3 h-3 rounded" style="background: linear-gradient(135deg, #00685d, #008376);"></span>
                            <span class="text-[11px] font-medium" style="color: #6d7a77;">Disetujui</span>
                        </div>
                        <div class="flex items-center gap-1.5">
                            <span class="w-3 h-3 rounded" style="background-color: #c7e7ff;"></span>
                            <span class="text-[11px] font-medium" style="color: #6d7a77;">Diajukan</span>
                        </div>
                    </div>
                </div>

                {{-- Chart Area --}}
                <div class="flex items-end gap-3 h-48">
                    @php
                        $months = [
                            ['label' => 'Nov', 'diajukan' => 65, 'disetujui' => 55],
                            ['label' => 'Des', 'diajukan' => 45, 'disetujui' => 38],
                            ['label' => 'Jan', 'diajukan' => 70, 'disetujui' => 60],
                            ['label' => 'Feb', 'diajukan' => 80, 'disetujui' => 72],
                            ['label' => 'Mar', 'diajukan' => 55, 'disetujui' => 48],
                            ['label' => 'Apr', 'diajukan' => 90, 'disetujui' => 78],
                        ];
                    @endphp

                    @foreach($months as $m)
                    <div class="flex-1 flex flex-col items-center gap-1">
                        <div class="w-full flex gap-1 items-end" style="height: 160px;">
                            {{-- Diajukan bar --}}
                            <div class="flex-1 rounded-t-lg chart-bar cursor-pointer relative group"
                                 style="height: {{ $m['diajukan'] }}%; background-color: #c7e7ff;">
                                <div class="absolute -top-7 left-1/2 -translate-x-1/2 px-2 py-0.5 rounded text-[10px] font-bold opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap"
                                     style="background-color: #064c6b; color: #fff;">{{ round($m['diajukan'] * 0.87) }}</div>
                            </div>
                            {{-- Disetujui bar --}}
                            <div class="flex-1 rounded-t-lg chart-bar cursor-pointer relative group"
                                 style="height: {{ $m['disetujui'] }}%; background: linear-gradient(180deg, #00685d, #008376);">
                                <div class="absolute -top-7 left-1/2 -translate-x-1/2 px-2 py-0.5 rounded text-[10px] font-bold opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap"
                                     style="background-color: #00685d; color: #fff;">{{ round($m['disetujui'] * 0.87) }}</div>
                            </div>
                        </div>
                        <span class="text-[11px] font-medium mt-1" style="color: #6d7a77;">{{ $m['label'] }}</span>
                    </div>
                    @endforeach
                </div>
            </div>


            {{-- ── Antrean Persetujuan Akhir ──────────────────────── --}}
            <div class="bg-white rounded-[1.5rem] overflow-hidden">
                <div class="flex items-center justify-between px-8 pt-8 pb-4">
                    <div class="flex items-center gap-2">
                        <span class="material-icons-outlined text-xl" style="color: #00685d;">assignment_turned_in</span>
                        <h2 class="font-manrope font-bold text-lg" style="color: #191c1e;">Antrean Persetujuan Surat</h2>
                    </div>
                    <a href="{{ route('verifikasi.index') }}" class="text-xs font-semibold transition-colors hover:text-[#008376]" style="color: #00685d;">
                        Lihat Semua →
                    </a>
                </div>

                {{-- Approval List --}}
                <div class="px-6 pb-6 space-y-2">

                    {{-- Item 1 --}}
                    <div class="flex items-center gap-4 px-4 py-4 rounded-xl transition-colors" style="background: transparent;" onmouseenter="this.style.backgroundColor='#f2f4f6'" onmouseleave="this.style.backgroundColor='transparent'">
                        <div class="w-10 h-10 rounded-full flex items-center justify-center font-semibold text-sm flex-shrink-0" style="background: linear-gradient(135deg, rgba(0,104,93,0.12), rgba(0,104,93,0.04)); color: #00685d;">
                            AM
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-semibold" style="color: #191c1e;">Andi Maulana</p>
                            <p class="text-xs" style="color: #6d7a77;">Surat Keterangan Domisili • Blok C No. 12</p>
                        </div>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-semibold mr-2" style="background-color: #c7e7ff; color: #064c6b;">Menunggu</span>
                        <div class="flex gap-2 flex-shrink-0">
                            <button onclick="approveItem(this)" class="btn-approve px-3 py-1.5 rounded-lg text-xs font-semibold flex items-center gap-1">
                                <span class="material-icons-outlined text-sm">check</span>
                                Terima
                            </button>
                            <button onclick="rejectItem(this)" class="btn-reject px-3 py-1.5 rounded-lg text-xs font-semibold flex items-center gap-1">
                                <span class="material-icons-outlined text-sm">close</span>
                                Tolak
                            </button>
                        </div>
                    </div>

                    {{-- Item 2 --}}
                    <div class="flex items-center gap-4 px-4 py-4 rounded-xl transition-colors" style="background: transparent;" onmouseenter="this.style.backgroundColor='#f2f4f6'" onmouseleave="this.style.backgroundColor='transparent'">
                        <div class="w-10 h-10 rounded-full flex items-center justify-center font-semibold text-sm flex-shrink-0" style="background: linear-gradient(135deg, rgba(43,100,133,0.12), rgba(43,100,133,0.04)); color: #2b6485;">
                            SP
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-semibold" style="color: #191c1e;">Siti Pertiwi</p>
                            <p class="text-xs" style="color: #6d7a77;">Surat Keterangan Usaha • Blok A No. 04</p>
                        </div>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-semibold mr-2" style="background-color: #c7e7ff; color: #064c6b;">Menunggu</span>
                        <div class="flex gap-2 flex-shrink-0">
                            <button onclick="approveItem(this)" class="btn-approve px-3 py-1.5 rounded-lg text-xs font-semibold flex items-center gap-1">
                                <span class="material-icons-outlined text-sm">check</span>
                                Terima
                            </button>
                            <button onclick="rejectItem(this)" class="btn-reject px-3 py-1.5 rounded-lg text-xs font-semibold flex items-center gap-1">
                                <span class="material-icons-outlined text-sm">close</span>
                                Tolak
                            </button>
                        </div>
                    </div>

                    {{-- Item 3 --}}
                    <div class="flex items-center gap-4 px-4 py-4 rounded-xl transition-colors" style="background: transparent;" onmouseenter="this.style.backgroundColor='#f2f4f6'" onmouseleave="this.style.backgroundColor='transparent'">
                        <div class="w-10 h-10 rounded-full flex items-center justify-center font-semibold text-sm flex-shrink-0" style="background: linear-gradient(135deg, rgba(65,101,56,0.12), rgba(65,101,56,0.04)); color: #416538;">
                            BR
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-semibold" style="color: #191c1e;">Bambang Rudito</p>
                            <p class="text-xs" style="color: #6d7a77;">Surat Pengantar Nikah • Blok E No. 21</p>
                        </div>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-semibold mr-2" style="background-color: #c7e7ff; color: #064c6b;">Menunggu</span>
                        <div class="flex gap-2 flex-shrink-0">
                            <button onclick="approveItem(this)" class="btn-approve px-3 py-1.5 rounded-lg text-xs font-semibold flex items-center gap-1">
                                <span class="material-icons-outlined text-sm">check</span>
                                Terima
                            </button>
                            <button onclick="rejectItem(this)" class="btn-reject px-3 py-1.5 rounded-lg text-xs font-semibold flex items-center gap-1">
                                <span class="material-icons-outlined text-sm">close</span>
                                Tolak
                            </button>
                        </div>
                    </div>

                    {{-- Item 4 --}}
                    <div class="flex items-center gap-4 px-4 py-4 rounded-xl transition-colors" style="background: transparent;" onmouseenter="this.style.backgroundColor='#f2f4f6'" onmouseleave="this.style.backgroundColor='transparent'">
                        <div class="w-10 h-10 rounded-full flex items-center justify-center font-semibold text-sm flex-shrink-0" style="background: linear-gradient(135deg, rgba(186,26,26,0.08), rgba(186,26,26,0.03)); color: #ba1a1a;">
                            DR
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-semibold" style="color: #191c1e;">Dewi Rahmawati</p>
                            <p class="text-xs" style="color: #6d7a77;">Surat Tidak Mampu • Blok B No. 08</p>
                        </div>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-semibold mr-2" style="background-color: #c7e7ff; color: #064c6b;">Menunggu</span>
                        <div class="flex gap-2 flex-shrink-0">
                            <button onclick="approveItem(this)" class="btn-approve px-3 py-1.5 rounded-lg text-xs font-semibold flex items-center gap-1">
                                <span class="material-icons-outlined text-sm">check</span>
                                Terima
                            </button>
                            <button onclick="rejectItem(this)" class="btn-reject px-3 py-1.5 rounded-lg text-xs font-semibold flex items-center gap-1">
                                <span class="material-icons-outlined text-sm">close</span>
                                Tolak
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        {{-- ── RIGHT COLUMN: Demografi + Kas RT + Notifikasi ──────── --}}
        <div class="lg:col-span-4 space-y-6">

            {{-- Demografi Warga (Donut Chart) — Stitch --}}
            <div class="bg-white rounded-[1.5rem] p-8">
                <h2 class="font-manrope font-bold text-lg mb-1" style="color: #191c1e;">Demografi Warga</h2>
                <p class="text-xs mb-6" style="color: #6d7a77;">Distribusi jenis kelamin</p>

                <div class="flex justify-center mb-6">
                    <div class="donut-chart w-36 h-36" style="background: conic-gradient(#00685d 0deg 194deg, #2b6485 194deg 360deg);">
                        <div class="donut-center w-24 h-24 bg-white flex flex-col items-center justify-center">
                            <span class="font-manrope font-bold text-xl" style="color: #191c1e;">248</span>
                            <span class="text-[10px] font-medium uppercase tracking-widest" style="color: #6d7a77;">Total</span>
                        </div>
                    </div>
                </div>

                <div class="space-y-3">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <span class="w-3 h-3 rounded-sm" style="background-color: #00685d;"></span>
                            <span class="text-sm" style="color: #3d4947;">Laki-laki</span>
                        </div>
                        <span class="text-sm font-semibold" style="color: #191c1e;">134 (54%)</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <span class="w-3 h-3 rounded-sm" style="background-color: #2b6485;"></span>
                            <span class="text-sm" style="color: #3d4947;">Perempuan</span>
                        </div>
                        <span class="text-sm font-semibold" style="color: #191c1e;">114 (46%)</span>
                    </div>
                </div>
            </div>



            {{-- Notifikasi --}}
            <div class="bg-white rounded-[1.5rem] p-8">
                <div class="flex items-center justify-between mb-5">
                    <h2 class="font-manrope font-bold text-lg" style="color: #191c1e;">Notifikasi</h2>
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-bold" style="background-color: #ffdad6; color: #93000a;">3 baru</span>
                </div>

                <div class="space-y-4">
                    {{-- Notif 1 --}}
                    <div class="flex gap-3">
                        <div class="w-2 h-2 rounded-full mt-2 flex-shrink-0" style="background-color: #ba1a1a;"></div>
                        <div>
                            <p class="text-sm font-semibold" style="color: #191c1e;">Pengajuan baru masuk</p>
                            <p class="text-xs mt-0.5" style="color: #6d7a77;">Dewi Rahmawati — 2 menit lalu</p>
                        </div>
                    </div>

                    {{-- Notif 2 --}}
                    <div class="flex gap-3">
                        <div class="w-2 h-2 rounded-full mt-2 flex-shrink-0" style="background-color: #00685d;"></div>
                        <div>
                            <p class="text-sm font-semibold" style="color: #191c1e;">Surat domisili selesai diproses</p>
                            <p class="text-xs mt-0.5" style="color: #6d7a77;">Sistem Otomatis — 1 jam lalu</p>
                        </div>
                    </div>

                    {{-- Notif 3 --}}
                    <div class="flex gap-3">
                        <div class="w-2 h-2 rounded-full mt-2 flex-shrink-0" style="background-color: #2b6485;"></div>
                        <div>
                            <p class="text-sm font-semibold" style="color: #191c1e;">Warga baru mendaftar</p>
                            <p class="text-xs mt-0.5" style="color: #6d7a77;">Rini Handayani — 3 jam lalu</p>
                        </div>
                    </div>

                    {{-- Notif 4 --}}
                    <div class="flex gap-3">
                        <div class="w-2 h-2 rounded-full mt-2 flex-shrink-0" style="background-color: #416538;"></div>
                        <div>
                            <p class="text-sm font-semibold" style="color: #191c1e;">Laporan RT bulan lalu siap</p>
                            <p class="text-xs mt-0.5" style="color: #6d7a77;">Admin — Kemarin, 16:45</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    {{-- ═══════════════════════════════════════════════════════════════
         TREN PENGAJUAN — Horizontal bars (Stitch: Tren pengajuan)
    ═══════════════════════════════════════════════════════════════ --}}
    <section class="mb-8">
        <div class="bg-white rounded-[1.5rem] p-8">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h2 class="font-manrope font-bold text-lg" style="color: #191c1e;">Tren Pengajuan Surat</h2>
                    <p class="text-xs mt-1" style="color: #6d7a77;">Distribusi jenis surat bulan ini</p>
                </div>
                <div class="flex items-center gap-2 px-3 py-1.5 rounded-lg" style="background-color: #f2f4f6;">
                    <span class="material-icons-outlined text-sm" style="color: #6d7a77;">calendar_today</span>
                    <span class="text-xs font-medium" style="color: #3d4947;">April 2026</span>
                </div>
            </div>

            <div class="space-y-4">
                @php
                    $tren = [
                        ['name' => 'Pengantar Domisili', 'value' => 36, 'max' => 50, 'color' => '#00685d'],
                        ['name' => 'Keterangan Usaha', 'value' => 21, 'max' => 50, 'color' => '#2b6485'],
                        ['name' => 'Keterangan Tidak Mampu', 'value' => 15, 'max' => 50, 'color' => '#416538'],
                        ['name' => 'Pengantar Nikah', 'value' => 9, 'max' => 50, 'color' => '#008376'],
                        ['name' => 'Surat Lainnya', 'value' => 6, 'max' => 50, 'color' => '#6d7a77'],
                    ];
                @endphp

                @foreach($tren as $item)
                <div class="flex items-center gap-4">
                    <div class="w-44 flex-shrink-0">
                        <span class="text-sm font-medium" style="color: #191c1e;">{{ $item['name'] }}</span>
                    </div>
                    <div class="flex-1 rounded-full h-3 overflow-hidden" style="background-color: #eceef0;">
                        <div class="h-full rounded-full transition-all duration-700" style="width: {{ ($item['value'] / $item['max']) * 100 }}%; background-color: {{ $item['color'] }};"></div>
                    </div>
                    <span class="text-sm font-manrope font-bold w-8 text-right" style="color: #191c1e;">{{ $item['value'] }}</span>
                </div>
                @endforeach
            </div>
        </div>
    </section>


    {{-- ═══════════════════════════════════════════════════════════════
         INFO BANNER — Quick Links for RT
    ═══════════════════════════════════════════════════════════════ --}}
    <section class="mb-4">
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            <a href="{{ route('warga.index') }}" class="rounded-[1.5rem] p-6 ambient-lift group block" style="background-color: #eceef0;">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl flex items-center justify-center transition-transform group-hover:scale-110" style="background-color: rgba(43,100,133,0.10);">
                        <span class="material-icons-outlined text-lg" style="color: #2b6485;">person_search</span>
                    </div>
                    <div>
                        <p class="text-sm font-semibold" style="color: #191c1e;">Verifikasi Warga</p>
                        <p class="text-xs" style="color: #6d7a77;">Kelola data penduduk</p>
                    </div>
                </div>
            </a>
            <a href="{{ route('laporan.index') }}" class="rounded-[1.5rem] p-6 ambient-lift group block" style="background-color: #eceef0;">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl flex items-center justify-center transition-transform group-hover:scale-110" style="background-color: rgba(0,104,93,0.10);">
                        <span class="material-icons-outlined text-lg" style="color: #00685d;">assessment</span>
                    </div>
                    <div>
                        <p class="text-sm font-semibold" style="color: #191c1e;">Laporan Warga</p>
                        <p class="text-xs" style="color: #6d7a77;">Lihat laporan dan statistik</p>
                    </div>
                </div>
            </a>
            <a href="{{ route('template.index') }}" class="rounded-[1.5rem] p-6 ambient-lift group block" style="background-color: #eceef0;">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl flex items-center justify-center transition-transform group-hover:scale-110" style="background-color: rgba(65,101,56,0.10);">
                        <span class="material-icons-outlined text-lg" style="color: #416538;">description</span>
                    </div>
                    <div>
                        <p class="text-sm font-semibold" style="color: #191c1e;">Template Surat</p>
                        <p class="text-xs" style="color: #6d7a77;">Kelola format surat RT</p>
                    </div>
                </div>
            </a>
        </div>
    </section>

@endsection

@push('scripts')
<script>
    // ── Approve / Reject button logic ────────────────────────────
    function approveItem(btn) {
        const row = btn.closest('.flex.items-center.gap-4');
        const badge = row.querySelector('[class*="rounded-full"][class*="text-\\[10px\\]"]');
        const actionBtns = row.querySelectorAll('.btn-approve, .btn-reject');

        // Update badge
        badge.style.backgroundColor = '#c5eeb5';
        badge.style.color = '#2d4f25';
        badge.textContent = 'Disetujui';

        // Disable buttons with feedback
        actionBtns.forEach(b => {
            b.style.opacity = '0.4';
            b.style.pointerEvents = 'none';
        });

        // Brief highlight
        row.style.backgroundColor = 'rgba(65, 101, 56, 0.06)';
        setTimeout(() => { row.style.backgroundColor = 'transparent'; }, 1500);
    }

    function rejectItem(btn) {
        const row = btn.closest('.flex.items-center.gap-4');
        const badge = row.querySelector('[class*="rounded-full"][class*="text-\\[10px\\]"]');
        const actionBtns = row.querySelectorAll('.btn-approve, .btn-reject');

        // Update badge
        badge.style.backgroundColor = '#ffdad6';
        badge.style.color = '#93000a';
        badge.textContent = 'Ditolak';

        // Disable buttons with feedback
        actionBtns.forEach(b => {
            b.style.opacity = '0.4';
            b.style.pointerEvents = 'none';
        });

        // Brief highlight
        row.style.backgroundColor = 'rgba(186, 26, 26, 0.04)';
        setTimeout(() => { row.style.backgroundColor = 'transparent'; }, 1500);
    }
</script>
@endpush
