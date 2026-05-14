@extends('layouts.app')

@section('title', 'Dashboard - Ketua RT')
@section('breadcrumb-parent', 'RT')
@section('breadcrumb-current', 'Dashboard')

@section('content')
    {{-- Header --}}
    <div class="flex justify-between items-start mb-8">
        <div>
            <h1 class="font-manrope font-bold text-2xl" style="color: #191c1e;">Dashboard Ketua RT</h1>
            <p class="text-sm mt-1" style="color: #6d7a77;">Senin, 12 Mei 2026 — RT 06</p>
        </div>
        <button onclick="openPengumumanModal()"
                class="inline-flex items-center gap-2 text-white font-semibold px-5 py-2.5 rounded-xl text-sm transition-all hover:shadow-md"
                style="background: linear-gradient(135deg, #00685d, #008376);">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Buat Pengumuman
        </button>
    </div>

    {{-- Quick Stats --}}
    <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-[1.5rem] p-6 ambient-lift">
            <div class="w-11 h-11 rounded-xl flex items-center justify-center mb-4" style="background: rgba(0,104,93,0.10);">
                <svg class="w-5 h-5" style="color:#00685d;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 8.048M3 20.585a6 6 0 0112 0M15 12a4 4 0 110-8m6 8a6 6 0 01-12 0"/>
                </svg>
            </div>
            <p class="font-manrope font-bold text-3xl" style="color:#191c1e;">248</p>
            <p class="text-xs uppercase tracking-widest mt-1" style="color:#6d7a77;">Total Warga</p>
            <p class="text-xs mt-1" style="color:#00685d;">+3 bulan ini</p>
        </div>
        <div class="bg-white rounded-[1.5rem] p-6 ambient-lift">
            <div class="w-11 h-11 rounded-xl flex items-center justify-center mb-4" style="background: rgba(186,26,26,0.08);">
                <svg class="w-5 h-5" style="color:#ba1a1a;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
            </div>
            <p class="font-manrope font-bold text-3xl" style="color:#191c1e;">12</p>
            <p class="text-xs uppercase tracking-widest mt-1" style="color:#6d7a77;">Menunggu</p>
            <p class="text-xs mt-1" style="color:#ba1a1a;">Perlu ditindaklanjuti</p>
        </div>
        <div class="bg-white rounded-[1.5rem] p-6 ambient-lift">
            <div class="w-11 h-11 rounded-xl flex items-center justify-center mb-4" style="background: rgba(65,101,56,0.10);">
                <svg class="w-5 h-5" style="color:#416538;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                </svg>
            </div>
            <p class="font-manrope font-bold text-3xl" style="color:#191c1e;">87</p>
            <p class="text-xs uppercase tracking-widest mt-1" style="color:#6d7a77;">Surat Terbit</p>
            <p class="text-xs mt-1" style="color:#6d7a77;">April 2026</p>
        </div>
        <div class="bg-white rounded-[1.5rem] p-6 ambient-lift">
            <div class="w-11 h-11 rounded-xl flex items-center justify-center mb-4" style="background: rgba(43,100,133,0.10);">
                <svg class="w-5 h-5" style="color:#2b6485;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4v2m0-8h2m-2 0h-2"/>
                </svg>
            </div>
            <p class="font-manrope font-bold text-3xl" style="color:#191c1e;">3</p>
            <p class="text-xs uppercase tracking-widest mt-1" style="color:#6d7a77;">Aduan Aktif</p>
            <p class="text-xs mt-1" style="color:#ba1a1a;">Belum ditangani</p>
        </div>
    </div>

    {{-- Main Content --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
        {{-- Left: Pengajuan Terbaru --}}
        <div class="lg:col-span-2">
            <div class="bg-white rounded-[1.5rem] overflow-hidden">
                <div class="flex items-center justify-between px-8 pt-6 pb-4" style="border-bottom: 1px solid #eceef0;">
                    <h2 class="font-manrope font-bold text-base" style="color:#191c1e;">Pengajuan Surat Terbaru</h2>
                    <a href="{{ route('verifikasi.index') }}" class="text-xs font-semibold hover:text-[#008376]" style="color:#00685d;">Lihat semua →</a>
                </div>
                <div class="px-6 pb-6 space-y-2 mt-2">

                    {{-- Item 1: Menunggu --}}
                    <div class="flex items-center gap-4 px-4 py-4 rounded-xl transition-colors"
                         onmouseenter="this.style.backgroundColor='#f2f4f6'" onmouseleave="this.style.backgroundColor='transparent'">
                        <div class="w-9 h-9 rounded-xl flex items-center justify-center flex-shrink-0"
                             style="background: rgba(0,104,93,0.08);">
                            <span class="material-icons-outlined text-base" style="color:#00685d;">home</span>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-semibold" style="color:#191c1e;">Budi Santoso</p>
                            <p class="text-xs" style="color:#6d7a77;">Pengantar Domisili • 12 Apr 2026</p>
                        </div>
                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[11px] font-semibold flex-shrink-0"
                              style="background-color:#c7e7ff;color:#064c6b;">Menunggu</span>
                        <button onclick="openProsesModal('Budi Santoso','6400***0002','Surat Pengantar Domisili','12 Apr 2026')"
                                class="text-xs font-semibold px-3 py-1.5 rounded-lg transition-colors hover:text-white hover:bg-[#00685d] flex-shrink-0"
                                style="background-color:#eceef0;color:#3d4947;">Proses →</button>
                    </div>

                    {{-- Item 2: Menunggu --}}
                    <div class="flex items-center gap-4 px-4 py-4 rounded-xl transition-colors"
                         onmouseenter="this.style.backgroundColor='#f2f4f6'" onmouseleave="this.style.backgroundColor='transparent'">
                        <div class="w-9 h-9 rounded-xl flex items-center justify-center flex-shrink-0"
                             style="background: rgba(43,100,133,0.08);">
                            <span class="material-icons-outlined text-base" style="color:#2b6485;">work</span>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-semibold" style="color:#191c1e;">Siti Rahayu</p>
                            <p class="text-xs" style="color:#6d7a77;">Keterangan Usaha • 11 Apr 2026</p>
                        </div>
                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[11px] font-semibold flex-shrink-0"
                              style="background-color:#c7e7ff;color:#064c6b;">Menunggu</span>
                        <button onclick="openProsesModal('Siti Rahayu','6400***0015','Surat Keterangan Usaha','11 Apr 2026')"
                                class="text-xs font-semibold px-3 py-1.5 rounded-lg transition-colors hover:text-white hover:bg-[#00685d] flex-shrink-0"
                                style="background-color:#eceef0;color:#3d4947;">Proses →</button>
                    </div>

                    {{-- Item 3: Diproses --}}
                    <div class="flex items-center gap-4 px-4 py-4 rounded-xl transition-colors"
                         onmouseenter="this.style.backgroundColor='#f2f4f6'" onmouseleave="this.style.backgroundColor='transparent'">
                        <div class="w-9 h-9 rounded-xl flex items-center justify-center flex-shrink-0"
                             style="background: rgba(65,101,56,0.08);">
                            <span class="material-icons-outlined text-base" style="color:#416538;">verified_user</span>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-semibold" style="color:#191c1e;">Ahmad Fauzii</p>
                            <p class="text-xs" style="color:#6d7a77;">Tidak Mampu • 10 Apr 2026</p>
                        </div>
                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[11px] font-semibold flex-shrink-0"
                              style="background-color:#c5eeb5;color:#2d4f25;">Diproses</span>
                        <button onclick="openProsesModal('Ahmad Fauzii','6400***0031','Surat Tidak Mampu','10 Apr 2026')"
                                class="text-xs font-semibold px-3 py-1.5 rounded-lg transition-colors hover:text-white hover:bg-[#00685d] flex-shrink-0"
                                style="background-color:#eceef0;color:#3d4947;">Lihat →</button>
                    </div>

                    {{-- Item 4: Selesai --}}
                    <div class="flex items-center gap-4 px-4 py-4 rounded-xl transition-colors"
                         onmouseenter="this.style.backgroundColor='#f2f4f6'" onmouseleave="this.style.backgroundColor='transparent'">
                        <div class="w-9 h-9 rounded-xl flex items-center justify-center flex-shrink-0"
                             style="background: rgba(0,104,93,0.08);">
                            <span class="material-icons-outlined text-base" style="color:#00685d;">send</span>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-semibold" style="color:#191c1e;">Dewi Lestari</p>
                            <p class="text-xs" style="color:#6d7a77;">Pengantar Umum • 09 Apr 2026</p>
                        </div>
                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[11px] font-semibold flex-shrink-0"
                              style="background-color:#c5eeb5;color:#2d4f25;">Selesai</span>
                        <button onclick="openProsesModal('Dewi Lestari','6400***0044','Surat Pengantar Umum','09 Apr 2026')"
                                class="text-xs font-semibold px-3 py-1.5 rounded-lg transition-colors hover:text-white hover:bg-[#00685d] flex-shrink-0"
                                style="background-color:#eceef0;color:#3d4947;">Arsip →</button>
                    </div>
                </div>
            </div>

            {{-- Tren --}}
            <div class="bg-white rounded-[1.5rem] p-6 mt-6">
                <h3 class="font-manrope font-bold text-base mb-5" style="color:#191c1e;">Tren Pengajuan — April 2026</h3>
                <div class="space-y-4">
                    @foreach([['Pengantar Domisili',36,'80%','#00685d'],['Keterangan Usaha',21,'47%','#2b6485'],['Tidak Mampu',15,'34%','#416538'],['Pengantar Umum',15,'34%','#8b6914']] as [$label,$val,$w,$c])
                    <div>
                        <div class="flex justify-between mb-1.5">
                            <span class="text-sm font-medium" style="color:#3d4947;">{{ $label }}</span>
                            <span class="text-sm font-bold" style="color:#191c1e;">{{ $val }}</span>
                        </div>
                        <div class="w-full rounded-full h-2" style="background-color:#eceef0;">
                            <div class="h-2 rounded-full" style="width:{{ $w }};background-color:{{ $c }};"></div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- Right: Demografi + Notifikasi --}}
        <div class="space-y-6">
            <div class="bg-white rounded-[1.5rem] p-6">
                <h3 class="font-manrope font-bold text-base mb-4" style="color:#191c1e;">Demografi Warga</h3>
                <div id="pieChart" class="w-full h-48"></div>
                <div class="space-y-2 mt-4">
                    <div class="flex justify-between text-sm">
                        <span class="flex items-center gap-2"><span class="w-3 h-3 rounded-full inline-block" style="background:#00685d;"></span>Laki-laki</span>
                        <span class="font-semibold" style="color:#191c1e;">134 (54%)</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="flex items-center gap-2"><span class="w-3 h-3 rounded-full inline-block" style="background:#2b6485;"></span>Perempuan</span>
                        <span class="font-semibold" style="color:#191c1e;">114 (46%)</span>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-[1.5rem] p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="font-manrope font-bold text-base" style="color:#191c1e;">Notifikasi</h3>
                    <span class="text-[11px] font-semibold px-2 py-0.5 rounded-full" style="background-color:#ffdad6;color:#93000a;">3 Baru</span>
                </div>
                <div class="space-y-3">
                    <div class="flex items-start gap-3">
                        <div class="w-2 h-2 rounded-full mt-1.5 flex-shrink-0" style="background-color:#00685d;"></div>
                        <div><p class="text-sm font-semibold" style="color:#191c1e;">Pengajuan baru masuk</p><p class="text-xs" style="color:#6d7a77;">Budi Santoso — 2 menit lalu</p></div>
                    </div>
                    <div class="flex items-start gap-3">
                        <div class="w-2 h-2 rounded-full mt-1.5 flex-shrink-0" style="background-color:#ba1a1a;"></div>
                        <div><p class="text-sm font-semibold" style="color:#191c1e;">Aduan warga baru</p><p class="text-xs" style="color:#6d7a77;">Jalan rusak Blok H — 1 jam lalu</p></div>
                    </div>
                    <div class="flex items-start gap-3">
                        <div class="w-2 h-2 rounded-full mt-1.5 flex-shrink-0" style="background-color:#2b6485;"></div>
                        <div><p class="text-sm font-semibold" style="color:#191c1e;">Warga baru terdaftar</p><p class="text-xs" style="color:#6d7a77;">Siti Rahayu — 3 jam lalu</p></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- AKSES CEPAT --}}
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-5 mb-8">
        {{-- Template Surat --}}
        <a href="{{ route('template.index') }}" class="bg-white rounded-[1.5rem] p-5 ambient-lift group flex items-center gap-4">
            <div class="w-11 h-11 rounded-xl flex items-center justify-center flex-shrink-0 transition-transform group-hover:scale-110"
                 style="background: linear-gradient(135deg, rgba(0,104,93,0.12), rgba(0,104,93,0.05));">
                <svg class="w-5 h-5" style="color:#00685d;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                </svg>
            </div>
            <div class="min-w-0">
                <p class="font-semibold text-sm" style="color:#191c1e;">Template Surat</p>
                <p class="text-xs mt-0.5" style="color:#6d7a77;">Upload & kelola template untuk warga</p>
            </div>
            <svg class="w-4 h-4 ml-auto flex-shrink-0 transition-transform group-hover:translate-x-1" style="color:#bcc9c6;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
        </a>

        {{-- Verifikasi Pengajuan --}}
        <a href="{{ route('verifikasi.index') }}" class="bg-white rounded-[1.5rem] p-5 ambient-lift group flex items-center gap-4">
            <div class="w-11 h-11 rounded-xl flex items-center justify-center flex-shrink-0 transition-transform group-hover:scale-110"
                 style="background: linear-gradient(135deg, rgba(43,100,133,0.12), rgba(43,100,133,0.05));">
                <svg class="w-5 h-5" style="color:#2b6485;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 8h6m-6 4h4"/>
                </svg>
            </div>
            <div class="min-w-0">
                <p class="font-semibold text-sm" style="color:#191c1e;">Verifikasi Pengajuan</p>
                <p class="text-xs mt-0.5" style="color:#6d7a77;">Proses surat masuk dari warga</p>
            </div>
            <svg class="w-4 h-4 ml-auto flex-shrink-0 transition-transform group-hover:translate-x-1" style="color:#bcc9c6;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
        </a>

        {{-- Buat Pengumuman --}}
        <button onclick="openPengumumanModal()" class="bg-white rounded-[1.5rem] p-5 ambient-lift group flex items-center gap-4 text-left w-full">
            <div class="w-11 h-11 rounded-xl flex items-center justify-center flex-shrink-0 transition-transform group-hover:scale-110"
                 style="background: linear-gradient(135deg, rgba(65,101,56,0.12), rgba(65,101,56,0.05));">
                <svg class="w-5 h-5" style="color:#416538;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/>
                </svg>
            </div>
            <div class="min-w-0">
                <p class="font-semibold text-sm" style="color:#191c1e;">Buat Pengumuman</p>
                <p class="text-xs mt-0.5" style="color:#6d7a77;">Kirim pengumuman ke seluruh warga</p>
            </div>
            <svg class="w-4 h-4 ml-auto flex-shrink-0 transition-transform group-hover:translate-x-1" style="color:#bcc9c6;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
        </button>
    </div>

    {{-- MODAL PROSES PENGAJUAN --}}
    <div id="modal-proses" class="fixed inset-0 z-50 hidden items-center justify-center p-4"
         style="background-color:rgba(25,28,30,0.5);backdrop-filter:blur(4px);">
        <div class="w-full max-w-lg rounded-[1.5rem] shadow-2xl overflow-hidden" style="background-color:#fff;">
            <div class="flex items-center justify-between px-6 pt-6 pb-4" style="border-bottom:1px solid #eceef0;">
                <h2 class="font-manrope font-bold text-base" style="color:#191c1e;">Proses Pengajuan Surat</h2>
                <button onclick="closeProsesModal()" class="w-8 h-8 rounded-lg flex items-center justify-center hover:bg-[#eceef0]">
                    <svg class="w-4 h-4" style="color:#6d7a77;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            <div class="px-6 py-5 space-y-4">
                {{-- Info Warga --}}
                <div class="rounded-xl p-4" style="background-color:#f2f4f6;">
                    <div class="grid grid-cols-2 gap-3 text-sm">
                        <div><p class="text-xs" style="color:#6d7a77;">Nama Warga</p><p id="mp-nama" class="font-semibold mt-0.5" style="color:#191c1e;"></p></div>
                        <div><p class="text-xs" style="color:#6d7a77;">NIK</p><p id="mp-nik" class="font-semibold mt-0.5" style="color:#191c1e;"></p></div>
                        <div><p class="text-xs" style="color:#6d7a77;">Jenis Surat</p><p id="mp-surat" class="font-semibold mt-0.5" style="color:#191c1e;"></p></div>
                        <div><p class="text-xs" style="color:#6d7a77;">Tanggal</p><p id="mp-tgl" class="font-semibold mt-0.5" style="color:#191c1e;"></p></div>
                    </div>
                </div>
                {{-- Alur Instruksi --}}
                <div>
                    <p class="text-xs font-semibold uppercase tracking-widest mb-3" style="color:#6d7a77;">Alur Verifikasi</p>
                    <div class="space-y-3">
                        <div class="flex items-start gap-3">
                            <div class="w-6 h-6 rounded-full flex items-center justify-center text-xs font-bold text-white flex-shrink-0 mt-0.5" style="background:#00685d;">1</div>
                            <div>
                                <p class="text-sm font-semibold" style="color:#191c1e;">Download Surat Warga</p>
                                <p class="text-xs" style="color:#6d7a77;">Unduh surat yang telah diisi oleh warga.</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <div class="w-6 h-6 rounded-full flex items-center justify-center text-xs font-bold text-white flex-shrink-0 mt-0.5" style="background:#2b6485;">2</div>
                            <div>
                                <p class="text-sm font-semibold" style="color:#191c1e;">Verifikasi, TTD & Stempel</p>
                                <p class="text-xs" style="color:#6d7a77;">Periksa keabsahan data, tanda tangani, dan berikan stempel resmi RT 06.</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <div class="w-6 h-6 rounded-full flex items-center justify-center text-xs font-bold text-white flex-shrink-0 mt-0.5" style="background:#416538;">3</div>
                            <div>
                                <p class="text-sm font-semibold" style="color:#191c1e;">Upload & Selesaikan</p>
                                <p class="text-xs" style="color:#6d7a77;">Upload surat yang sudah ditandatangani, warga akan menerima notifikasi.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="px-6 pb-6 flex gap-3 flex-wrap">
                <button onclick="closeProsesModal()" class="flex-1 px-4 py-2.5 rounded-xl text-sm font-semibold" style="background-color:#eceef0;color:#3d4947;">Tutup</button>
                <a href="#" onclick="alert('File dummy — akan tersedia saat dokumen warga diunggah.')"
                   class="flex-1 inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl text-sm font-semibold text-white"
                   style="background:linear-gradient(135deg,#2b6485,#3a82a8);">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                    Download Surat
                </a>
                <button onclick="alert('Fitur tolak akan tersedia setelah terhubung ke backend.')"
                        class="flex-1 px-4 py-2.5 rounded-xl text-sm font-semibold"
                        style="background-color:#ffdad6;color:#93000a;">Tolak Pengajuan</button>
            </div>
        </div>
    </div>



    {{-- ═══════════════════════════════════════════════════════════════
         MODAL BUAT PENGUMUMAN
    ═══════════════════════════════════════════════════════════════ --}}
    <div id="modal-pengumuman" class="fixed inset-0 z-50 hidden items-center justify-center p-4"
         style="background-color:rgba(25,28,30,0.5);backdrop-filter:blur(4px);">
        <div class="w-full max-w-lg rounded-[1.5rem] shadow-2xl overflow-hidden" style="background-color:#fff;">
            {{-- Header --}}
            <div class="flex items-center justify-between px-6 pt-6 pb-4" style="border-bottom:1px solid #eceef0;">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-xl flex items-center justify-center" style="background:rgba(0,104,93,0.10);">
                        <svg class="w-4 h-4" style="color:#00685d;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/>
                        </svg>
                    </div>
                    <h2 class="font-manrope font-bold text-base" style="color:#191c1e;">Buat Pengumuman</h2>
                </div>
                <button onclick="closePengumumanModal()" class="w-8 h-8 rounded-lg flex items-center justify-center hover:bg-[#eceef0]">
                    <svg class="w-4 h-4" style="color:#6d7a77;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            {{-- Body --}}
            <form class="px-6 py-5 space-y-4" onsubmit="submitPengumuman(event)">
                <div>
                    <label class="text-xs font-semibold uppercase tracking-widest block mb-1.5" style="color:#6d7a77;">Judul Pengumuman</label>
                    <input type="text" id="peng-judul" placeholder="Cth: Gotong Royong RT 06 Minggu Ini"
                           class="w-full px-4 py-2.5 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#00685d]/20"
                           style="background-color:#f2f4f6;color:#191c1e;border:none;" required>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="text-xs font-semibold uppercase tracking-widest block mb-1.5" style="color:#6d7a77;">Kategori</label>
                        <select class="w-full px-4 py-2.5 rounded-xl text-sm focus:outline-none"
                                style="background-color:#f2f4f6;color:#191c1e;border:none;">
                            <option>Kegiatan RT</option>
                            <option>Keamanan</option>
                            <option>Administrasi</option>
                            <option>Kesehatan</option>
                            <option>Lingkungan</option>
                            <option>Lainnya</option>
                        </select>
                    </div>
                    <div>
                        <label class="text-xs font-semibold uppercase tracking-widest block mb-1.5" style="color:#6d7a77;">Sasaran</label>
                        <select class="w-full px-4 py-2.5 rounded-xl text-sm focus:outline-none"
                                style="background-color:#f2f4f6;color:#191c1e;border:none;">
                            <option>Semua Warga</option>
                            <option>Bapak-Bapak</option>
                            <option>Ibu-Ibu</option>
                            <option>Pemuda</option>
                        </select>
                    </div>
                </div>
                <div>
                    <label class="text-xs font-semibold uppercase tracking-widest block mb-1.5" style="color:#6d7a77;">Isi Pengumuman</label>
                    <textarea id="peng-isi" rows="4" placeholder="Tulis isi pengumuman untuk seluruh warga RT 06..."
                              class="w-full px-4 py-2.5 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#00685d]/20 resize-none"
                              style="background-color:#f2f4f6;color:#191c1e;border:none;" required></textarea>
                </div>
                <div class="rounded-xl p-3 flex items-start gap-2" style="background-color:#eceef0;">
                    <svg class="w-4 h-4 flex-shrink-0 mt-0.5" style="color:#6d7a77;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <p class="text-xs" style="color:#6d7a77;">Pengumuman akan tampil di dashboard semua warga RT 06 setelah dikirim.</p>
                </div>
                <div class="flex gap-3 pt-1">
                    <button type="button" onclick="closePengumumanModal()"
                            class="flex-1 px-4 py-2.5 rounded-xl text-sm font-semibold"
                            style="background-color:#eceef0;color:#3d4947;">Batal</button>
                    <button type="submit"
                            class="flex-1 px-4 py-2.5 rounded-xl text-sm font-semibold text-white hover:shadow-md transition-all"
                            style="background:linear-gradient(135deg,#00685d,#008376);">
                        <span id="peng-btn-text">Kirim Pengumuman</span>
                    </button>
                </div>
            </form>
        </div>
    </div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
new ApexCharts(document.querySelector('#pieChart'), {
    chart:{ type:'donut', height:190 },
    colors:['#00685d','#2b6485'],
    series:[134,114], labels:['Laki-laki','Perempuan'],
    plotOptions:{ pie:{ donut:{ size:'75%' } } },
    dataLabels:{ enabled:false }, legend:{ show:false }
}).render();

function openProsesModal(nama, nik, surat, tgl) {
    document.getElementById('mp-nama').textContent  = nama;
    document.getElementById('mp-nik').textContent   = nik;
    document.getElementById('mp-surat').textContent = surat;
    document.getElementById('mp-tgl').textContent   = tgl;
    const m = document.getElementById('modal-proses');
    m.classList.remove('hidden'); m.classList.add('flex');
    document.body.style.overflow = 'hidden';
}
function closeProsesModal() {
    const m = document.getElementById('modal-proses');
    m.classList.add('hidden'); m.classList.remove('flex');
    document.body.style.overflow = '';
}

function openPengumumanModal() {
    const m = document.getElementById('modal-pengumuman');
    m.classList.remove('hidden'); m.classList.add('flex');
    document.body.style.overflow = 'hidden';
}
function closePengumumanModal() {
    const m = document.getElementById('modal-pengumuman');
    m.classList.add('hidden'); m.classList.remove('flex');
    document.body.style.overflow = '';
}

function submitPengumuman(e) {
    e.preventDefault();
    const judul = document.getElementById('peng-judul').value;
    const isi   = document.getElementById('peng-isi').value;
    if (!judul || !isi) return;
    const btn = document.getElementById('peng-btn-text');
    btn.textContent = 'Mengirim...';
    setTimeout(() => {
        closePengumumanModal();
        btn.textContent = 'Kirim Pengumuman';
        document.getElementById('peng-judul').value = '';
        document.getElementById('peng-isi').value = '';
        alert('Pengumuman "' + judul + '" berhasil dikirim ke semua warga RT 06.\n(Demo — akan terhubung ke backend saat sistem siap.)');
    }, 800);
}

document.getElementById('modal-proses').addEventListener('click', function(e){ if(e.target===this) closeProsesModal(); });
document.getElementById('modal-pengumuman').addEventListener('click', function(e){ if(e.target===this) closePengumumanModal(); });
document.addEventListener('keydown', e => {
    if(e.key==='Escape') { closeProsesModal(); closePengumumanModal(); }
});
</script>
@endpush

@endsection
