@extends('layouts.app')

@section('title', 'Dashboard - Ketua RT')
@section('breadcrumb-parent', 'RT')
@section('breadcrumb-current', 'Dashboard')

@section('content')
    {{-- Header --}}
    <div class="flex justify-between items-start mb-8">
        <div>
            <h1 class="font-manrope font-bold text-2xl" style="color: #191c1e;">Dashboard Ketua RT</h1>
            <p class="text-sm mt-1" style="color: #6d7a77;" id="rt-date-display">RT 06</p>
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

@php
    // Hitung hanya warga dengan role='warga', exclude RT
    $totalWarga = \App\Models\Warga::where('role', 'warga')->count();
    $menunggu = \App\Models\Pengajuan::where('status', 'pending')->count();
    $suratTerbit = \App\Models\Surat::count();
    $aduanAktif = 0;
    
    // Demografi berdasarkan gender real dari database
    $wargaLaki = \App\Models\Warga::where('role', 'warga')->where('gender', 'Laki-laki')->count();
    $wargaPerempuan = \App\Models\Warga::where('role', 'warga')->where('gender', 'Perempuan')->count();
    $persen_laki = $totalWarga > 0 ? round(($wargaLaki / $totalWarga) * 100) : 0;
    $persen_perempuan = $totalWarga > 0 ? round(($wargaPerempuan / $totalWarga) * 100) : 0;
    
    $latestPengajuan = \App\Models\Pengajuan::with('warga')->orderBy('created_at', 'desc')->take(4)->get();
    
    // Tren Pengajuan: 5 jenis surat terbanyak
    $top5Surat = \App\Models\Pengajuan::select('jenis_surat', \DB::raw('count(*) as total'))
        ->groupBy('jenis_surat')
        ->orderBy('total', 'desc')
        ->take(5)
        ->get();
    
    $totalPengajuan = \App\Models\Pengajuan::count();
    
    // Warna untuk tren
    $trendColors = ['#00685d', '#2b6485', '#416538', '#8b6914', '#ba1a1a'];
@endphp

    {{-- Quick Stats --}}
    <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-[1.5rem] p-6 ambient-lift">
            <div class="w-11 h-11 rounded-xl flex items-center justify-center mb-4" style="background: rgba(0,104,93,0.10);">
                <svg class="w-5 h-5" style="color:#00685d;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 8.048M3 20.585a6 6 0 0112 0M15 12a4 4 0 110-8m6 8a6 6 0 01-12 0"/>
                </svg>
            </div>
            <p class="font-manrope font-bold text-3xl" style="color:#191c1e;">{{ $totalWarga }}</p>
            <p class="text-xs uppercase tracking-widest mt-1" style="color:#6d7a77;">Total Warga</p>
            <p class="text-xs mt-1" style="color:#00685d;">Terdaftar aktif</p>
        </div>
        <div class="bg-white rounded-[1.5rem] p-6 ambient-lift">
            <div class="w-11 h-11 rounded-xl flex items-center justify-center mb-4" style="background: rgba(186,26,26,0.08);">
                <svg class="w-5 h-5" style="color:#ba1a1a;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
            </div>
            <p class="font-manrope font-bold text-3xl" style="color:#191c1e;">{{ $menunggu }}</p>
            <p class="text-xs uppercase tracking-widest mt-1" style="color:#6d7a77;">Menunggu</p>
            <p class="text-xs mt-1" style="color:#ba1a1a;">Perlu verifikasi</p>
        </div>
        <div class="bg-white rounded-[1.5rem] p-6 ambient-lift">
            <div class="w-11 h-11 rounded-xl flex items-center justify-center mb-4" style="background: rgba(65,101,56,0.10);">
                <svg class="w-5 h-5" style="color:#416538;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                </svg>
            </div>
            <p class="font-manrope font-bold text-3xl" style="color:#191c1e;">{{ $suratTerbit }}</p>
            <p class="text-xs uppercase tracking-widest mt-1" style="color:#6d7a77;">Surat Terbit</p>
            <p class="text-xs mt-1" style="color:#6d7a77;">Selesai diproses</p>
        </div>
        <div class="bg-white rounded-[1.5rem] p-6 ambient-lift">
            <div class="w-11 h-11 rounded-xl flex items-center justify-center mb-4" style="background: rgba(43,100,133,0.10);">
                <svg class="w-5 h-5" style="color:#2b6485;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4v2m0-8h2m-2 0h-2"/>
                </svg>
            </div>
            <p class="font-manrope font-bold text-3xl" style="color:#191c1e;">{{ $aduanAktif }}</p>
            <p class="text-xs uppercase tracking-widest mt-1" style="color:#6d7a77;">Aduan Aktif</p>
            <p class="text-xs mt-1" style="color:#6d7a77;">Belum ditangani</p>
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

                    @forelse($latestPengajuan as $p)
                    {{-- Dynamic Item - CSS Grid Layout --}}
                    <div class="grid grid-cols-1 md:grid-cols-12 gap-4 items-center bg-white p-5 rounded-xl border border-gray-100 shadow-sm hover:shadow-md transition-all mb-3">

                        {{-- Kolom Kiri: Profil Warga (4 cols) --}}
                        <div class="md:col-span-4 flex items-center gap-4">
                            <div class="w-10 h-10 rounded-full flex items-center justify-center flex-shrink-0"
                                 style="background: linear-gradient(135deg, rgba(0,104,93,0.12), rgba(0,104,93,0.05));">
                                <span class="material-icons-outlined text-lg" style="color:#00685d;">person</span>
                            </div>
                            <div class="min-w-0">
                                <p class="font-semibold text-gray-800 truncate">{{ $p->warga->user->name ?? 'Warga' }}</p>
                                <p class="text-sm text-gray-500 flex items-center gap-1 mt-0.5">
                                    <span class="material-icons-outlined" style="font-size:14px;">location_on</span>
                                    <span class="truncate">{{ $p->warga->alamat ?? 'Alamat tidak tersedia' }}</span>
                                </p>
                            </div>
                        </div>

                        {{-- Kolom Tengah: Detail Surat (5 cols) --}}
                        <div class="md:col-span-5">
                            <p class="font-medium text-blue-700 leading-tight">{{ $p->jenis_surat }}</p>
                            <p class="text-sm text-gray-400 mt-1 flex items-center gap-1">
                                <span class="material-icons-outlined" style="font-size:14px;">schedule</span>
                                {{ $p->created_at ? $p->created_at->format('d M Y, H:i') : '-' }}
                            </p>
                        </div>

                        {{-- Kolom Kanan: Tombol (3 cols) --}}
                        <div class="md:col-span-3 flex justify-end">
                            <a href="{{ route('verifikasi.show', $p->id_pengajuan) }}"
                               class="inline-flex items-center gap-2 px-4 py-2 rounded-xl text-sm font-semibold text-white transition-all hover:shadow-md"
                               style="background: linear-gradient(135deg, #00685d, #008376);">
                                <span class="material-icons-outlined text-sm">visibility</span>
                                Periksa Detail
                            </a>
                        </div>
                    </div>
                    @empty
                    <div class="flex flex-col items-center justify-center py-12 px-4 text-center">
                        <div class="w-16 h-16 rounded-2xl flex items-center justify-center mb-4 text-[#6d7a77]" style="background: rgba(109,122,119,0.08);">
                            <span class="material-icons-outlined text-3xl">inbox</span>
                        </div>
                        <h3 class="font-manrope font-bold text-sm text-[#191c1e] mb-1">Belum Ada Pengajuan</h3>
                        <p class="text-xs text-[#6d7a77]">Saat ini belum ada pengajuan surat masuk dari warga.</p>
                    </div>
                    @endforelse

                </div>
            </div>

            {{-- Tren --}}
            <div class="bg-white rounded-[1.5rem] p-6 mt-6">
                <h3 class="font-manrope font-bold text-base mb-5" style="color:#191c1e;">Tren Pengajuan</h3>
                <div class="space-y-4">
                    @if($totalPengajuan > 0 && $top5Surat->count() > 0)
                        @foreach($top5Surat as $index => $tren)
                        @php
                            $persen = round(($tren->total / $totalPengajuan) * 100);
                            $warna = $trendColors[$index % count($trendColors)];
                        @endphp
                        <div>
                            <div class="flex justify-between mb-1.5">
                                <span class="text-sm font-medium capitalize" style="color:#3d4947;">{{ str_replace('_', ' ', $tren->jenis_surat) }}</span>
                                <span class="text-sm font-bold" style="color:#191c1e;">{{ $tren->total }}</span>
                            </div>
                            <div class="w-full rounded-full h-2" style="background-color:#eceef0;">
                                <div class="h-2 rounded-full" style="width:{{ $persen }}%;background-color:{{ $warna }};"></div>
                            </div>
                        </div>
                        @endforeach
                    @else
                        <div class="text-center py-6 text-xs text-[#6d7a77]">Belum ada tren pengajuan terdeteksi.</div>
                    @endif
                </div>
            </div>
        </div>

        {{-- Right: Demografi + Notifikasi (side by side on same row) --}}
        <div class="space-y-6">
            {{-- Demografi & Notifikasi: stacked vertically --}}
            <div class="grid grid-cols-1 gap-6">
                <div class="bg-white rounded-[1.5rem] p-5">
                    <h3 class="font-manrope font-bold text-sm mb-3" style="color:#191c1e;">Demografi Warga</h3>
                    @if($totalWarga > 0)
                        <div id="pieChart" class="w-full h-36"></div>
                        <div class="space-y-1.5 mt-3">
                            <div class="flex justify-between text-xs">
                                <span class="flex items-center gap-1.5"><span class="w-2.5 h-2.5 rounded-full inline-block" style="background:#00685d;"></span>Laki-laki</span>
                                <span class="font-semibold" style="color:#191c1e;">{{ $wargaLaki }} ({{ $persen_laki }}%)</span>
                            </div>
                            <div class="flex justify-between text-xs">
                                <span class="flex items-center gap-1.5"><span class="w-2.5 h-2.5 rounded-full inline-block" style="background:#2b6485;"></span>Perempuan</span>
                                <span class="font-semibold" style="color:#191c1e;">{{ $wargaPerempuan }} ({{ $persen_perempuan }}%)</span>
                            </div>
                        </div>
                    @else
                        <div class="flex flex-col items-center justify-center py-6 text-center">
                            <span class="material-icons-outlined text-2xl text-[#6d7a77] mb-1">people_outline</span>
                            <p class="text-xs text-[#6d7a77]">Belum ada data warga.</p>
                        </div>
                    @endif
                </div>

                <div class="bg-white rounded-[1.5rem] p-5">
                    <div class="flex items-center justify-between mb-3">
                        <h3 class="font-manrope font-bold text-sm" style="color:#191c1e;">Notifikasi</h3>
                        <span class="text-[10px] font-semibold px-2 py-0.5 rounded-full" style="background-color:#eceef0;color:#6d7a77;">0 Baru</span>
                    </div>
                    {{-- Dummy list for notifications --}}
                    <div class="space-y-3 mt-4">
                        <div class="flex flex-col items-center justify-center py-6 text-center">
                            <span class="material-icons-outlined text-xl text-[#6d7a77] mb-1">notifications_off</span>
                            <p class="text-xs text-[#6d7a77]">Belum ada notifikasi baru hari ini.</p>
                        </div>
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
                        <div><p class="text-xs" style="color:#6d7a77;">Nomor HP</p><p id="mp-no_hp" class="font-semibold mt-0.5" style="color:#191c1e;"></p></div>
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
            <form method="POST" action="{{ route('pengumuman.store') }}" class="px-6 py-5 space-y-4">
                @csrf
                <div>
                    <label class="text-xs font-semibold uppercase tracking-widest block mb-1.5" style="color:#6d7a77;">Judul Pengumuman</label>
                    <input type="text" name="judul" id="peng-judul" placeholder="Cth: Gotong Royong RT 06 Minggu Ini"
                           class="w-full px-4 py-2.5 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#00685d]/20"
                           style="background-color:#f2f4f6;color:#191c1e;border:none;" required>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="text-xs font-semibold uppercase tracking-widest block mb-1.5" style="color:#6d7a77;">Kategori</label>
                        <select name="kategori" class="w-full px-4 py-2.5 rounded-xl text-sm focus:outline-none"
                                style="background-color:#f2f4f6;color:#191c1e;border:none;">
                            <option value="Kegiatan RT">Kegiatan RT</option>
                            <option value="Keamanan">Keamanan</option>
                            <option value="Administrasi">Administrasi</option>
                            <option value="Kesehatan">Kesehatan</option>
                            <option value="Lingkungan">Lingkungan</option>
                            <option value="Lainnya">Lainnya</option>
                        </select>
                    </div>
                    <div>
                        <label class="text-xs font-semibold uppercase tracking-widest block mb-1.5" style="color:#6d7a77;">Sasaran</label>
                        <select name="sasaran" class="w-full px-4 py-2.5 rounded-xl text-sm focus:outline-none"
                                style="background-color:#f2f4f6;color:#191c1e;border:none;">
                            <option value="Semua Warga">Semua Warga</option>
                            <option value="Bapak-Bapak">Bapak-Bapak</option>
                            <option value="Ibu-Ibu">Ibu-Ibu</option>
                            <option value="Pemuda">Pemuda</option>
                        </select>
                    </div>
                </div>
                <div>
                    <label class="text-xs font-semibold uppercase tracking-widest block mb-1.5" style="color:#6d7a77;">Isi Pengumuman</label>
                    <textarea name="isi" id="peng-isi" rows="3" placeholder="Tulis isi pengumuman untuk seluruh warga RT 06..."
                              class="w-full px-4 py-2.5 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#00685d]/20 resize-none"
                              style="background-color:#f2f4f6;color:#191c1e;border:none;" required></textarea>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="text-xs font-semibold uppercase tracking-widest block mb-1.5" style="color:#6d7a77;">Waktu Mulai <span class="text-red-500">*</span></label>
                        <input type="datetime-local" name="waktu_mulai" class="w-full px-4 py-2.5 rounded-xl text-sm focus:outline-none" style="background-color:#f2f4f6;color:#191c1e;border:none;" required>
                    </div>
                    <div>
                        <label class="text-xs font-semibold uppercase tracking-widest block mb-1.5" style="color:#6d7a77;">Waktu Selesai <span class="text-red-500">*</span></label>
                        <input type="datetime-local" name="waktu_selesai" class="w-full px-4 py-2.5 rounded-xl text-sm focus:outline-none" style="background-color:#f2f4f6;color:#191c1e;border:none;" required>
                    </div>
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
// Realtime date/time for RT dashboard
function updateRTDate() {
    const el = document.getElementById('rt-date-display');
    if (!el) return;
    const now = new Date();
    const days = ['Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'];
    const months = ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Ags','Sep','Okt','Nov','Des'];
    const day = days[now.getDay()];
    const date = now.getDate();
    const month = months[now.getMonth()];
    const year = now.getFullYear();
    const hours = String(now.getHours()).padStart(2,'0');
    const mins = String(now.getMinutes()).padStart(2,'0');
    el.textContent = `${day}, ${date} ${month} ${year} — ${hours}:${mins} WITA — RT 06`;
}
updateRTDate();
setInterval(updateRTDate, 30000);
const pieElement = document.querySelector('#pieChart');
if (pieElement) {
    new ApexCharts(pieElement, {
        chart:{ type:'donut', height:190 },
        colors:['#00685d','#2b6485'],
        series:[{{ $wargaLaki }}, {{ $wargaPerempuan }}], labels:['Laki-laki','Perempuan'],
        plotOptions:{ pie:{ donut:{ size:'75%' } } },
        dataLabels:{ enabled:false }, legend:{ show:false }
    }).render();
}

function openProsesModal(nama, no_hp, surat, tgl) {
    document.getElementById('mp-nama').textContent  = nama;
    document.getElementById('mp-no_hp').textContent   = no_hp;
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
