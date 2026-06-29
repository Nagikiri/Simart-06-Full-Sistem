@extends('layouts.app')

@section('title', 'Dashboard Warga')
@section('breadcrumb-parent', 'Warga')
@section('breadcrumb-current', 'Dashboard')

@section('content')

    {{-- HERO SECTION --}}
    <section class="relative rounded-[1.5rem] overflow-hidden mb-8 ambient-lift" style="background: linear-gradient(135deg, var(--gradient-start) 0%, var(--gradient-end) 50%, #2A9D8F 100%);">
        <div class="absolute top-0 right-0 w-64 h-64 bg-white/10 rounded-full blur-3xl -translate-y-16 translate-x-16"></div>
        <div class="absolute bottom-0 left-0 w-48 h-48 bg-white/10 rounded-full blur-2xl translate-y-12 -translate-x-8"></div>
        <div class="relative z-10 px-8 lg:px-10 py-8 lg:py-10 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h1 class="font-manrope font-extrabold text-2xl lg:text-3xl text-white leading-tight mb-2">
                    Selamat Datang, {{ explode(' ', auth()->user()->name)[0] ?? 'Warga' }}! 👋
                </h1>
                <p class="text-white/90 text-sm lg:text-base font-medium">
                    Semoga harimu menyenangkan. 
                    @if(($stats['dalam_antrian'] ?? 0) > 0)
                        Kamu punya <span class="bg-white/20 px-2 py-0.5 rounded-lg font-bold">{{ $stats['dalam_antrian'] }} pengajuan</span> yang sedang diproses.
                    @else
                        Saat ini tidak ada pengajuan surat yang sedang diproses.
                    @endif
                </p>
            </div>
            <a href="{{ route('pengajuan.index') }}" class="glass-card text-white hover:text-white px-5 py-2.5 rounded-xl text-sm font-semibold inline-flex items-center gap-2 hover:-translate-y-1 transition-all duration-300" style="background: rgba(255,255,255,0.2); border-color: rgba(255,255,255,0.4);">
                <span class="material-icons-outlined text-lg">add_circle</span>
                Buat Surat Baru
            </a>
        </div>
    </section>

    {{-- STATS SECTION --}}
    <section class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-8">
        <div class="bg-white rounded-[1.5rem] p-6 ambient-lift shadow-sm">
            <div class="w-12 h-12 rounded-xl flex items-center justify-center mb-4" style="background: linear-gradient(135deg, rgba(65,101,56,0.12), rgba(65,101,56,0.04));">
                <span class="material-icons-outlined text-[#416538] text-2xl">check_circle</span>
            </div>
            <span class="font-bold text-3xl text-gray-900">{{ str_pad($stats['selesai'] ?? 0, 2, '0', STR_PAD_LEFT) }}</span>
            <p class="text-xs font-semibold uppercase tracking-widest mt-1 text-[#6d7a77]">Disetujui</p>
        </div>
        <div class="bg-white rounded-[1.5rem] p-6 ambient-lift shadow-sm">
            <div class="w-12 h-12 rounded-xl flex items-center justify-center mb-4" style="background: linear-gradient(135deg, rgba(43,100,133,0.12), rgba(43,100,133,0.04));">
                <span class="material-icons-outlined text-[#2b6485] text-2xl">pending</span>
            </div>
            <span class="font-bold text-3xl text-gray-900">{{ str_pad($stats['dalam_antrian'] ?? 0, 2, '0', STR_PAD_LEFT) }}</span>
            <p class="text-xs font-semibold uppercase tracking-widest mt-1 text-[#6d7a77]">Dalam Antrean</p>
        </div>
        <div class="bg-white rounded-[1.5rem] p-6 ambient-lift shadow-sm">
            <div class="w-12 h-12 rounded-xl flex items-center justify-center mb-4" style="background: linear-gradient(135deg, rgba(186,26,26,0.10), rgba(186,26,26,0.03));">
                <span class="material-icons-outlined text-[#ba1a1a] text-2xl">cancel</span>
            </div>
            <span class="font-bold text-3xl text-gray-900">{{ str_pad($stats['ditolak'] ?? 0, 2, '0', STR_PAD_LEFT) }}</span>
            <p class="text-xs font-semibold uppercase tracking-widest mt-1 text-[#6d7a77]">Ditolak</p>
        </div>
    </section>

    <div class="flex flex-col gap-8 mb-8">
        {{-- PENGUMUMAN RT (Full Width) --}}
        @if(isset($pengumuman) && count($pengumuman) > 0)
        <div class="bg-white rounded-[1.5rem] p-6 shadow-sm border border-gray-100 ambient-lift">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-lg font-bold text-gray-900 flex items-center gap-2">
                    <span class="material-icons-outlined text-[#00685d]">campaign</span>
                    Pengumuman RT 06
                </h2>
            </div>
            <div class="space-y-4 max-h-[300px] overflow-y-auto pr-2 custom-scrollbar">
                @foreach($pengumuman as $p)
                <div class="flex gap-4 p-5 rounded-xl border border-gray-100 bg-gray-50 hover:bg-white hover:shadow-md transition-all">
                    <div class="w-12 h-12 rounded-full flex items-center justify-center shrink-0" style="background: rgba(0,104,93,0.1);">
                        <span class="material-icons-outlined text-[#00685d]">campaign</span>
                    </div>
                    <div class="flex-1">
                        <div class="flex items-center justify-between gap-4 mb-1">
                            <h3 class="font-bold text-gray-900">{{ $p->judul }}</h3>
                            <span class="text-xs text-gray-500 whitespace-nowrap">{{ $p->created_at->diffForHumans() }}</span>
                        </div>
                        <div class="flex gap-2 mb-2">
                            <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-[#00685d]/10 text-[#00685d]">{{ $p->kategori }}</span>
                            <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-blue-100 text-blue-800">{{ $p->sasaran }}</span>
                        </div>
                        <p class="text-sm text-gray-600 leading-relaxed">{{ $p->isi }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif

        {{-- PENGAJUAN AKTIF (Full Width) --}}
        <div class="bg-white rounded-[1.5rem] p-6 shadow-sm border border-gray-100 ambient-lift">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-lg font-bold text-gray-900 flex items-center gap-2">
                    <span class="material-icons-outlined text-[#00685d]">description</span>
                    Pengajuan Aktif Anda
                </h2>
                @if(count($pengajuanAktif ?? []) > 0)
                    <a href="{{ route('warga.riwayat') }}" class="text-sm font-semibold text-[#00685d] hover:underline px-3 py-1 bg-gray-50 rounded-lg transition-colors hover:bg-[#00685d]/10">Lihat Semua</a>
                @endif
            </div>

            <div class="space-y-4 max-h-[400px] overflow-y-auto pr-2 custom-scrollbar">
                @forelse($pengajuanAktif ?? [] as $item)
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 p-5 rounded-xl border border-gray-100 bg-gray-50 hover:bg-white hover:shadow-md transition-all">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-full flex items-center justify-center shrink-0" style="background: rgba(0,104,93,0.1);">
                                <span class="material-icons-outlined text-[#00685d]">feed</span>
                            </div>
                            <div>
                                <p class="font-bold text-gray-900">{{ $item->jenis_surat }}</p>
                                <p class="text-xs text-gray-500 mt-1">Diajukan: {{ $item->created_at->format('d M Y') }}</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-4">
                            @php
                                $badge = match($item->status) {
                                    'selesai' => ['bg-green-100', 'text-green-800', 'Selesai'],
                                    'ditolak' => ['bg-red-100', 'text-red-800', 'Ditolak'],
                                    'diproses' => ['bg-blue-100', 'text-blue-800', 'Sedang Diproses'],
                                    default => ['bg-yellow-100', 'text-yellow-800', 'Menunggu']
                                };
                            @endphp
                            <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $badge[0] }} {{ $badge[1] }}">
                                {{ $badge[2] }}
                            </span>
                            <a href="{{ route('warga.riwayat') }}" class="text-xs font-bold text-[#00685d] hover:underline bg-[#00685d]/10 px-3 py-1.5 rounded-lg transition-colors hover:bg-[#00685d]/20">Lihat Detail</a>
                        </div>
                    </div>
                @empty
                    <div class="py-12 text-center bg-gray-50/50 rounded-[1.5rem] border-2 border-dashed border-gray-200 flex flex-col items-center justify-center">
                        {{-- Undraw-style Empty State SVG --}}
                        <svg class="w-48 h-48 mb-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2Z" fill="#F3F4F6"/>
                            <path d="M12 17C14.7614 17 17 14.7614 17 12H7C7 14.7614 9.23858 17 12 17Z" fill="#D1D5DB"/>
                            <circle cx="9.5" cy="10.5" r="1.5" fill="#9CA3AF"/>
                            <circle cx="14.5" cy="10.5" r="1.5" fill="#9CA3AF"/>
                            <path d="M12 16C13.6569 16 15 14.6569 15 13H9C9 14.6569 10.3431 16 12 16Z" fill="#9CA3AF"/>
                        </svg>
                        <h3 class="font-extrabold text-gray-900 text-xl mb-2">Wah, masih sepi nih! 🍃</h3>
                        <p class="text-sm text-gray-500 mb-6 max-w-md mx-auto font-medium">Kamu belum punya antrean pengajuan surat ke RT hari ini. Tekan tombol di bawah jika kamu mau buat pengajuan baru ya.</p>
                        <a href="{{ route('pengajuan.index') }}" class="btn-civic-gradient inline-flex items-center justify-center gap-2 px-6 py-3 rounded-full text-white font-semibold text-sm shadow-md">
                            <span class="material-icons-outlined text-sm">add_circle</span>
                            Buat Pengajuan Baru
                        </a>
                    </div>
                @endforelse
            </div>
        </div>

        {{-- PANDUAN & INFO (Full Width, Stacked) --}}
        <div class="bg-white rounded-2xl p-6 lg:p-8 shadow-sm border border-gray-100">
            <h3 class="font-bold text-xl text-gray-900 mb-6 flex items-center gap-2">
                <span class="material-icons-outlined text-[#00685d] text-2xl">help_outline</span>
                Panduan Mengajukan Surat
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 relative">
                <div class="p-6 rounded-xl bg-gray-50 border border-gray-100 text-center relative z-10">
                    <div class="w-12 h-12 rounded-full border-4 border-white bg-[#00685d] text-white font-bold text-lg flex items-center justify-center mx-auto mb-4 shadow-sm">1</div>
                    <h4 class="font-bold text-gray-900 mb-2">Pilih Jenis Surat</h4>
                    <p class="text-sm text-gray-600 leading-relaxed">Buka menu <b>Pengajuan</b>, lalu cari dan pilih template surat yang Anda butuhkan (misal: Surat Pengantar KTP).</p>
                </div>
                <div class="hidden md:block absolute top-12 left-[16%] right-[16%] h-0.5 bg-gray-200 z-0"></div>
                <div class="p-6 rounded-xl bg-gray-50 border border-gray-100 text-center relative z-10">
                    <div class="w-12 h-12 rounded-full border-4 border-white bg-[#00685d] text-white font-bold text-lg flex items-center justify-center mx-auto mb-4 shadow-sm">2</div>
                    <h4 class="font-bold text-gray-900 mb-2">Isi Data Langsung</h4>
                    <p class="text-sm text-gray-600 leading-relaxed">Ketikkan data Anda pada formulir isian di layar. Anda dapat melihat perubahan pada kertas surat secara <i>real-time</i> (Live Preview).</p>
                </div>
                <div class="p-6 rounded-xl bg-gray-50 border border-gray-100 text-center relative z-10">
                    <div class="w-12 h-12 rounded-full border-4 border-white bg-[#00685d] text-white font-bold text-lg flex items-center justify-center mx-auto mb-4 shadow-sm">3</div>
                    <h4 class="font-bold text-gray-900 mb-2">Kirim & Pantau</h4>
                    <p class="text-sm text-gray-600 leading-relaxed">Setelah menekan tombol Kirim, surat akan masuk antrean RT. Anda dapat mengecek status di kolom <b>Pengajuan Aktif</b> ini atau menu <b>Riwayat</b>.</p>
                </div>
            </div>
        </div>
        
        {{-- Info Banner --}}
        <div class="rounded-2xl p-6 bg-[#c7e7ff] text-[#064c6b] border border-[#a2d8ff]">
            <div class="flex items-start gap-4">
                <span class="material-icons-outlined text-2xl mt-0.5">info</span>
                <div>
                    <h4 class="font-bold text-base mb-2">Informasi Tambahan Terkait Pengajuan Dokumen</h4>
                    <p class="text-sm opacity-90 leading-relaxed">
                        Pengajuan surat administrasi yang masuk di luar jam kerja (setelah pukul 20:00 WIB) atau pada hari libur nasional akan diproses oleh Ketua RT pada hari kerja berikutnya. Pastikan nomor kontak pada profil Anda sudah diperbarui agar Ketua RT dapat menghubungi Anda jika terdapat data tambahan yang perlu diklarifikasi.
                    </p>
                </div>
            </div>
        </div>
    </div>

@push('styles')
<style>
    .custom-scrollbar::-webkit-scrollbar {
        width: 6px;
    }
    .custom-scrollbar::-webkit-scrollbar-track {
        background: #f1f1f1; 
        border-radius: 10px;
    }
    .custom-scrollbar::-webkit-scrollbar-thumb {
        background: #bcc9c6; 
        border-radius: 10px;
    }
    .custom-scrollbar::-webkit-scrollbar-thumb:hover {
        background: #00685d; 
    }
</style>
@endpush

@endsection
