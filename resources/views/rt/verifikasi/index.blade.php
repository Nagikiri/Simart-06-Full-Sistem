@extends('layouts.app')

@section('title', 'Verifikasi & Pengajuan')
@section('breadcrumb-parent', 'RT')
@section('breadcrumb-current', 'Pengajuan')

@section('content')

@php
    $pendingPengajuan = \App\Models\Pengajuan::with('warga')->where('status', 'pending')->orderBy('created_at', 'desc')->get();
    $riwayatPengajuan = \App\Models\Pengajuan::with('warga')->whereIn('status', ['selesai', 'ditolak'])->orderBy('updated_at', 'desc')->get();
@endphp

    {{-- HERO SECTION --}}
    <section class="relative rounded-[1.5rem] overflow-hidden mb-8 ambient-lift" style="background: linear-gradient(135deg, var(--gradient-start) 0%, var(--gradient-end) 50%, #2A9D8F 100%);">
        <div class="absolute top-0 right-0 w-64 h-64 bg-white/10 rounded-full blur-3xl -translate-y-16 translate-x-16"></div>
        <div class="absolute bottom-0 left-0 w-48 h-48 bg-white/10 rounded-full blur-2xl translate-y-12 -translate-x-8"></div>
        <div class="relative z-10 px-8 lg:px-10 py-8 lg:py-10 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h1 class="font-manrope font-extrabold text-2xl lg:text-3xl text-white leading-tight mb-2">
                    Selamat Datang, {{ explode(' ', auth()->user()->name)[0] ?? 'Pak RT' }}! 👋
                </h1>
                <p class="text-white/90 text-sm lg:text-base font-medium">
                    Semoga harimu menyenangkan. 
                    @if($pendingPengajuan->count() > 0)
                        Ada <span class="bg-white/20 px-2 py-0.5 rounded-lg font-bold">{{ $pendingPengajuan->count() }} antrean surat warga</span> yang perlu verifikasi segera.
                    @else
                        Saat ini tidak ada antrean surat masuk.
                    @endif
                </p>
            </div>
        </div>
    </section>

    {{-- TAB NAVIGATION --}}
    <div class="flex gap-1 p-1 rounded-2xl mb-6 w-fit" style="background-color:#eceef0;">
        <button id="tab-btn-pengajuan" onclick="switchTab('pengajuan')"
                class="tab-btn px-5 py-2 rounded-xl text-sm font-semibold transition-all shadow-sm"
                style="background-color:#fff;color:#00685d;">
            Pengajuan Surat Masuk
        </button>
        <button id="tab-btn-riwayat" onclick="switchTab('riwayat')"
                class="tab-btn px-5 py-2 rounded-xl text-sm font-semibold transition-all hover:bg-white/50"
                style="color:#6d7a77;">
            Riwayat Verifikasi
        </button>
    </div>

    {{-- TAB: PENGAJUAN SURAT --}}
    <div id="tab-pengajuan" class="tab-content page-fade-in">
        <div class="bg-white rounded-[1.5rem] overflow-hidden glass-card ambient-lift">
            <div class="flex items-center justify-between px-8 pt-6 pb-4" style="border-bottom:1px solid #eceef0;">
                <h2 class="font-bold text-lg" style="color:#191c1e;">Daftar Antrean Verifikasi</h2>
                <span class="text-[11px] font-bold px-3 py-1.5 rounded-full"
                      @if($pendingPengajuan->count() > 0)
                          style="background-color:#ffdad6;color:#93000a;"
                      @else
                          style="background-color:#eceef0;color:#6d7a77;"
                      @endif>
                    {{ $pendingPengajuan->count() }} Perlu Aksi
                </span>
            </div>
            <div class="px-6 pb-6 space-y-3 mt-4">

                @forelse($pendingPengajuan as $p)
                <div class="flex items-center gap-4 px-4 py-4 rounded-xl transition-all hover:-translate-y-1 hover:shadow-md border border-transparent hover:border-gray-100"
                     style="background-color: #fafbfc;">
                    <div class="w-12 h-12 rounded-xl flex items-center justify-center flex-shrink-0" style="background:rgba(0,104,93,0.08);">
                        <span class="material-icons-outlined text-xl" style="color:#00685d;">description</span>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-bold" style="color:#191c1e;">{{ $p->warga->user->name ?? 'Warga' }}</p>
                        <p class="text-[11px] font-medium mt-0.5" style="color:#6d7a77;">{{ $p->warga->alamat ?? 'Alamat tidak tersedia' }}</p>
                        <p class="text-xs mt-1.5 font-medium" style="color:#2b6485;">
                            <span class="bg-blue-50 text-blue-700 px-2 py-0.5 rounded-md text-[10px] uppercase font-bold mr-1">Tipe Surat</span>
                            {{ $p->jenis_surat }} • {{ $p->created_at ? $p->created_at->format('d M Y, H:i') : '-' }}
                        </p>
                    </div>
                    <a href="{{ route('verifikasi.show', $p->id_pengajuan) }}"
                       class="btn-civic-gradient text-white text-xs font-semibold px-5 py-2.5 rounded-lg flex-shrink-0 shadow-md">
                       Periksa Berkas
                    </a>
                </div>
                @empty
                <div class="py-12 text-center flex flex-col items-center justify-center">
                    {{-- Undraw-style Empty State SVG for RT --}}
                    <svg class="w-48 h-48 mb-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2Z" fill="#F3F4F6"/>
                        <path d="M8 12L11 15L16 9" stroke="#10B981" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <h3 class="font-extrabold text-[#191c1e] text-xl mb-2">Pekerjaan Selesai! 🎉</h3>
                    <p class="text-sm text-[#6d7a77] max-w-sm mx-auto font-medium">Wah mantap! Belum ada pengajuan surat warga yang perlu divalidasi saat ini. Silakan bersantai.</p>
                </div>
                @endforelse

            </div>
        </div>
    </div>

    {{-- TAB: RIWAYAT --}}
    <div id="tab-riwayat" class="tab-content hidden">
        @php
            $totalSelesai = $riwayatPengajuan->where('status','selesai')->count();
            $totalDitolak = $riwayatPengajuan->where('status','ditolak')->count();
            $totalRiwayat = $riwayatPengajuan->count();
        @endphp

        {{-- Statistics Cards --}}
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-6">
            <div class="bg-white rounded-2xl p-5">
                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 rounded-xl flex items-center justify-center" style="background: rgba(0,104,93,0.10);">
                        <span class="material-icons-outlined text-lg" style="color:#00685d;">list_alt</span>
                    </div>
                    <div>
                        <span class="font-manrope font-bold text-2xl" style="color:#191c1e;">{{ $totalRiwayat }}</span>
                        <p class="text-[11px] font-medium uppercase tracking-widest" style="color:#6d7a77;">Total Diproses</p>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-2xl p-5">
                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 rounded-xl flex items-center justify-center" style="background: rgba(65,101,56,0.10);">
                        <span class="material-icons-outlined text-lg" style="color:#416538;">task_alt</span>
                    </div>
                    <div>
                        <span class="font-manrope font-bold text-2xl" style="color:#191c1e;">{{ $totalSelesai }}</span>
                        <p class="text-[11px] font-medium uppercase tracking-widest" style="color:#6d7a77;">Selesai & Terbit</p>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-2xl p-5">
                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 rounded-xl flex items-center justify-center" style="background: rgba(186,26,26,0.08);">
                        <span class="material-icons-outlined text-lg" style="color:#ba1a1a;">cancel</span>
                    </div>
                    <div>
                        <span class="font-manrope font-bold text-2xl" style="color:#191c1e;">{{ $totalDitolak }}</span>
                        <p class="text-[11px] font-medium uppercase tracking-widest" style="color:#6d7a77;">Ditolak</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-[1.5rem] overflow-hidden">
            <div class="px-8 pt-6 pb-4" style="border-bottom:1px solid #eceef0;">
                <h2 class="font-manrope font-bold text-base" style="color:#191c1e;">Riwayat Pengajuan</h2>
                <p class="text-xs mt-1" style="color:#6d7a77;">Semua surat yang telah selesai diproses atau ditolak.</p>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full civic-table">
                    <thead>
                        <tr>
                            <th class="px-8 py-3 text-left text-[11px] font-semibold uppercase tracking-widest" style="color:#3d4947;">Warga</th>
                            <th class="px-4 py-3 text-left text-[11px] font-semibold uppercase tracking-widest" style="color:#3d4947;">Jenis Surat</th>
                            <th class="px-4 py-3 text-left text-[11px] font-semibold uppercase tracking-widest" style="color:#3d4947;">Tanggal</th>
                            <th class="px-4 py-3 text-left text-[11px] font-semibold uppercase tracking-widest" style="color:#3d4947;">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($riwayatPengajuan as $rp)
                        <tr onmouseenter="this.style.backgroundColor='#f2f4f6'" onmouseleave="this.style.backgroundColor='transparent'">
                            <td class="px-8 py-4 text-sm font-semibold" style="color:#191c1e;">{{ $rp->warga->nama ?? ($rp->warga->user->name ?? 'Warga') }}</td>
                            <td class="px-4 py-4 text-sm" style="color:#3d4947;">{{ $rp->jenis_surat }}</td>
                            <td class="px-4 py-4 text-xs" style="color:#6d7a77;">{{ $rp->updated_at ? $rp->updated_at->format('d M Y') : '-' }}</td>
                            <td class="px-4 py-4">
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[11px] font-semibold"
                                      @if($rp->status === 'selesai')
                                          style="background-color:#c5eeb5;color:#2d4f25;"
                                      @else
                                          style="background-color:#ffdad6;color:#93000a;"
                                      @endif>
                                    {{ $rp->status === 'selesai' ? 'Selesai' : 'Ditolak' }}
                                </span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center py-12 text-xs text-[#6d7a77]">Belum ada riwayat pengajuan surat.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@push('scripts')
<script>
function switchTab(name) {
    document.querySelectorAll('.tab-content').forEach(el => el.classList.add('hidden'));
    document.getElementById('tab-' + name).classList.remove('hidden');
    document.querySelectorAll('.tab-btn').forEach(btn => {
        btn.style.backgroundColor = 'transparent';
        btn.style.color = '#6d7a77';
        btn.style.boxShadow = 'none';
    });
    const active = document.getElementById('tab-btn-' + name);
    active.style.backgroundColor = '#fff';
    active.style.color = '#00685d';
    active.style.boxShadow = '0 1px 4px rgba(0,0,0,0.08)';
}
</script>
@endpush

@endsection
