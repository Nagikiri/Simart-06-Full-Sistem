@extends('layouts.app')

@section('title', 'Verifikasi & Pengajuan')
@section('breadcrumb-parent', 'RT')
@section('breadcrumb-current', 'Pengajuan')

@section('content')

    <div class="mb-6">
        <h1 class="font-manrope font-bold text-2xl" style="color:#191c1e;">Manajemen Pengajuan</h1>
        <p class="text-sm mt-1" style="color:#6d7a77;">Kelola pengajuan surat, verifikasi warga, dan riwayat proses.</p>
    </div>

    {{-- TAB NAVIGATION --}}
    <div class="flex gap-1 p-1 rounded-2xl mb-6 w-fit" style="background-color:#eceef0;">
        <button id="tab-btn-pengajuan" onclick="switchTab('pengajuan')"
                class="tab-btn px-5 py-2 rounded-xl text-sm font-semibold transition-all"
                style="background-color:#fff;color:#00685d;box-shadow:0 1px 4px rgba(0,0,0,0.08);">
            Pengajuan Surat
        </button>
        <button id="tab-btn-warga" onclick="switchTab('warga')"
                class="tab-btn px-5 py-2 rounded-xl text-sm font-semibold transition-all"
                style="color:#6d7a77;">
            Verifikasi Warga
        </button>
        <button id="tab-btn-riwayat" onclick="switchTab('riwayat')"
                class="tab-btn px-5 py-2 rounded-xl text-sm font-semibold transition-all"
                style="color:#6d7a77;">
            Riwayat
        </button>
    </div>

    {{-- TAB: PENGAJUAN SURAT --}}
    <div id="tab-pengajuan" class="tab-content">
        <div class="bg-white rounded-[1.5rem] overflow-hidden">
            <div class="flex items-center justify-between px-8 pt-6 pb-4" style="border-bottom:1px solid #eceef0;">
                <h2 class="font-manrope font-bold text-base" style="color:#191c1e;">Surat Masuk — Menunggu Proses</h2>
                <span class="text-[11px] font-semibold px-2.5 py-1 rounded-full" style="background-color:#ffdad6;color:#93000a;">2 Perlu Aksi</span>
            </div>
            <div class="px-6 pb-6 space-y-2 mt-2">

                <div class="flex items-center gap-4 px-4 py-4 rounded-xl transition-colors"
                     onmouseenter="this.style.backgroundColor='#f2f4f6'" onmouseleave="this.style.backgroundColor='transparent'">
                    <div class="w-10 h-10 rounded-xl flex items-center justify-center flex-shrink-0" style="background:rgba(0,104,93,0.08);">
                        <span class="material-icons-outlined text-base" style="color:#00685d;">home</span>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-semibold" style="color:#191c1e;">Budi Santoso</p>
                        <p class="text-xs mt-0.5" style="color:#6d7a77;">Surat Pengantar Domisili • 10 Apr 2026 • #RT06-0042</p>
                    </div>
                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[11px] font-semibold flex-shrink-0" style="background-color:#c7e7ff;color:#064c6b;">Menunggu</span>
                    <button onclick="openVerifModal('Budi Santoso','6400***0002','Surat Pengantar Domisili','10 Apr 2026','#RT06-0042')"
                            class="text-xs font-semibold px-3 py-1.5 rounded-lg hover:bg-[#00685d] hover:text-white flex-shrink-0 transition-colors"
                            style="background-color:#eceef0;color:#3d4947;">Proses →</button>
                </div>

                <div class="flex items-center gap-4 px-4 py-4 rounded-xl transition-colors"
                     onmouseenter="this.style.backgroundColor='#f2f4f6'" onmouseleave="this.style.backgroundColor='transparent'">
                    <div class="w-10 h-10 rounded-xl flex items-center justify-center flex-shrink-0" style="background:rgba(43,100,133,0.08);">
                        <span class="material-icons-outlined text-base" style="color:#2b6485;">work</span>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-semibold" style="color:#191c1e;">Siti Rahayu</p>
                        <p class="text-xs mt-0.5" style="color:#6d7a77;">Surat Keterangan Usaha • 11 Apr 2026 • #RT06-0041</p>
                    </div>
                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[11px] font-semibold flex-shrink-0" style="background-color:#c7e7ff;color:#064c6b;">Menunggu</span>
                    <button onclick="openVerifModal('Siti Rahayu','6400***0015','Surat Keterangan Usaha','11 Apr 2026','#RT06-0041')"
                            class="text-xs font-semibold px-3 py-1.5 rounded-lg hover:bg-[#00685d] hover:text-white flex-shrink-0 transition-colors"
                            style="background-color:#eceef0;color:#3d4947;">Proses →</button>
                </div>

                <div class="flex items-center gap-4 px-4 py-4 rounded-xl transition-colors"
                     onmouseenter="this.style.backgroundColor='#f2f4f6'" onmouseleave="this.style.backgroundColor='transparent'">
                    <div class="w-10 h-10 rounded-xl flex items-center justify-center flex-shrink-0" style="background:rgba(65,101,56,0.08);">
                        <span class="material-icons-outlined text-base" style="color:#416538;">verified_user</span>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-semibold" style="color:#191c1e;">Ahmad Fauzii</p>
                        <p class="text-xs mt-0.5" style="color:#6d7a77;">Surat Tidak Mampu • 10 Apr 2026 • #RT06-0040</p>
                    </div>
                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[11px] font-semibold flex-shrink-0" style="background-color:#c5eeb5;color:#2d4f25;">Diproses</span>
                    <button onclick="openVerifModal('Ahmad Fauzii','6400***0031','Surat Tidak Mampu','10 Apr 2026','#RT06-0040')"
                            class="text-xs font-semibold px-3 py-1.5 rounded-lg hover:bg-[#00685d] hover:text-white flex-shrink-0 transition-colors"
                            style="background-color:#eceef0;color:#3d4947;">Lihat →</button>
                </div>
            </div>
        </div>
    </div>

    {{-- TAB: VERIFIKASI WARGA --}}
    <div id="tab-warga" class="tab-content hidden">
        <div class="bg-white rounded-[1.5rem] overflow-hidden">
            <div class="flex items-center justify-between px-8 pt-6 pb-4" style="border-bottom:1px solid #eceef0;">
                <h2 class="font-manrope font-bold text-base" style="color:#191c1e;">Daftar Verifikasi Warga</h2>
                <span class="text-[11px] font-semibold px-2.5 py-1 rounded-full" style="background-color:#ffdad6;color:#93000a;">1 Menunggu</span>
            </div>
            <div class="px-6 pb-6 space-y-2 mt-2">

                {{-- Menunggu Verifikasi --}}
                <div class="flex items-center gap-4 px-4 py-4 rounded-xl transition-colors"
                     onmouseenter="this.style.backgroundColor='#f2f4f6'" onmouseleave="this.style.backgroundColor='transparent'">
                    <div class="w-10 h-10 rounded-full flex items-center justify-center flex-shrink-0 text-sm font-bold text-white" style="background:linear-gradient(135deg,#2b6485,#3a82a8);">R</div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-semibold" style="color:#191c1e;">Rudi Hermawan</p>
                        <p class="text-xs mt-0.5" style="color:#6d7a77;">NIK: 6400***0052 • Daftar: 12 Apr 2026</p>
                    </div>
                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[11px] font-semibold flex-shrink-0" style="background-color:#c7e7ff;color:#064c6b;">Menunggu Verifikasi</span>
                    <button onclick="alert('Fitur verifikasi warga akan tersedia setelah terhubung ke backend.')"
                            class="text-xs font-semibold px-3 py-1.5 rounded-lg hover:bg-[#00685d] hover:text-white flex-shrink-0 transition-colors"
                            style="background-color:#eceef0;color:#3d4947;">Verifikasi →</button>
                </div>

                {{-- Sudah Terverifikasi --}}
                <div class="flex items-center gap-4 px-4 py-4 rounded-xl transition-colors"
                     onmouseenter="this.style.backgroundColor='#f2f4f6'" onmouseleave="this.style.backgroundColor='transparent'">
                    <div class="w-10 h-10 rounded-full flex items-center justify-center flex-shrink-0 text-sm font-bold text-white" style="background:linear-gradient(135deg,#00685d,#008376);">B</div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-semibold" style="color:#191c1e;">Budi Santoso</p>
                        <p class="text-xs mt-0.5" style="color:#6d7a77;">NIK: 6400***0002 • Daftar: 01 Jan 2025</p>
                    </div>
                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[11px] font-semibold flex-shrink-0" style="background-color:#c5eeb5;color:#2d4f25;">Terverifikasi</span>
                    <button class="text-xs font-semibold px-3 py-1.5 rounded-lg flex-shrink-0" style="background-color:#eceef0;color:#6d7a77;" disabled>Selesai</button>
                </div>

                <div class="flex items-center gap-4 px-4 py-4 rounded-xl transition-colors"
                     onmouseenter="this.style.backgroundColor='#f2f4f6'" onmouseleave="this.style.backgroundColor='transparent'">
                    <div class="w-10 h-10 rounded-full flex items-center justify-center flex-shrink-0 text-sm font-bold text-white" style="background:linear-gradient(135deg,#00685d,#008376);">S</div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-semibold" style="color:#191c1e;">Siti Rahayu</p>
                        <p class="text-xs mt-0.5" style="color:#6d7a77;">NIK: 6400***0015 • Daftar: 15 Mar 2025</p>
                    </div>
                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[11px] font-semibold flex-shrink-0" style="background-color:#c5eeb5;color:#2d4f25;">Terverifikasi</span>
                    <button class="text-xs font-semibold px-3 py-1.5 rounded-lg flex-shrink-0" style="background-color:#eceef0;color:#6d7a77;" disabled>Selesai</button>
                </div>
            </div>
        </div>
    </div>

    {{-- TAB: RIWAYAT --}}
    <div id="tab-riwayat" class="tab-content hidden">
        <div class="bg-white rounded-[1.5rem] overflow-hidden">
            <div class="px-8 pt-6 pb-4" style="border-bottom:1px solid #eceef0;">
                <h2 class="font-manrope font-bold text-base" style="color:#191c1e;">Riwayat Pengajuan</h2>
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
                        <tr onmouseenter="this.style.backgroundColor='#f2f4f6'" onmouseleave="this.style.backgroundColor='transparent'">
                            <td class="px-8 py-4 text-sm font-semibold" style="color:#191c1e;">Dewi Lestari</td>
                            <td class="px-4 py-4 text-sm" style="color:#3d4947;">Pengantar Umum</td>
                            <td class="px-4 py-4 text-xs" style="color:#6d7a77;">09 Apr 2026</td>
                            <td class="px-4 py-4"><span class="inline-flex items-center px-2.5 py-1 rounded-full text-[11px] font-semibold" style="background-color:#c5eeb5;color:#2d4f25;">Selesai</span></td>
                        </tr>
                        <tr onmouseenter="this.style.backgroundColor='#f2f4f6'" onmouseleave="this.style.backgroundColor='transparent'">
                            <td class="px-8 py-4 text-sm font-semibold" style="color:#191c1e;">Rudi Hermawan</td>
                            <td class="px-4 py-4 text-sm" style="color:#3d4947;">Pengantar Domisili</td>
                            <td class="px-4 py-4 text-xs" style="color:#6d7a77;">08 Apr 2026</td>
                            <td class="px-4 py-4"><span class="inline-flex items-center px-2.5 py-1 rounded-full text-[11px] font-semibold" style="background-color:#ffdad6;color:#93000a;">Ditolak</span></td>
                        </tr>
                        <tr onmouseenter="this.style.backgroundColor='#f2f4f6'" onmouseleave="this.style.backgroundColor='transparent'">
                            <td class="px-8 py-4 text-sm font-semibold" style="color:#191c1e;">Ahmad Fauzii</td>
                            <td class="px-4 py-4 text-sm" style="color:#3d4947;">Berkelakuan Baik</td>
                            <td class="px-4 py-4 text-xs" style="color:#6d7a77;">05 Apr 2026</td>
                            <td class="px-4 py-4"><span class="inline-flex items-center px-2.5 py-1 rounded-full text-[11px] font-semibold" style="background-color:#c5eeb5;color:#2d4f25;">Selesai</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- MODAL PROSES VERIFIKASI --}}
    <div id="modal-verif" class="fixed inset-0 z-50 hidden items-center justify-center p-4"
         style="background-color:rgba(25,28,30,0.5);backdrop-filter:blur(4px);">
        <div class="w-full max-w-lg rounded-[1.5rem] shadow-2xl overflow-hidden" style="background-color:#fff;">
            <div class="flex items-center justify-between px-6 pt-6 pb-4" style="border-bottom:1px solid #eceef0;">
                <h2 class="font-manrope font-bold text-base" style="color:#191c1e;">Proses Pengajuan Surat</h2>
                <button onclick="closeVerifModal()" class="w-8 h-8 rounded-lg flex items-center justify-center hover:bg-[#eceef0]">
                    <svg class="w-4 h-4" style="color:#6d7a77;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
            <div class="px-6 py-5 space-y-4">
                <div class="rounded-xl p-4" style="background-color:#f2f4f6;">
                    <div class="grid grid-cols-2 gap-3 text-sm">
                        <div><p class="text-xs" style="color:#6d7a77;">Nama Warga</p><p id="mv-nama" class="font-semibold mt-0.5" style="color:#191c1e;"></p></div>
                        <div><p class="text-xs" style="color:#6d7a77;">NIK</p><p id="mv-nik" class="font-semibold mt-0.5" style="color:#191c1e;"></p></div>
                        <div><p class="text-xs" style="color:#6d7a77;">Jenis Surat</p><p id="mv-surat" class="font-semibold mt-0.5" style="color:#191c1e;"></p></div>
                        <div><p class="text-xs" style="color:#6d7a77;">ID Pengajuan</p><p id="mv-id" class="font-mono text-xs mt-0.5" style="color:#6d7a77;"></p></div>
                    </div>
                </div>
                <div>
                    <p class="text-xs font-semibold uppercase tracking-widest mb-3" style="color:#6d7a77;">Alur Verifikasi</p>
                    <div class="space-y-3">
                        <div class="flex items-start gap-3">
                            <div class="w-6 h-6 rounded-full flex items-center justify-center text-xs font-bold text-white flex-shrink-0" style="background:#00685d;">1</div>
                            <div><p class="text-sm font-semibold" style="color:#191c1e;">Download Surat Warga</p><p class="text-xs" style="color:#6d7a77;">Unduh dokumen yang dikirim warga.</p></div>
                        </div>
                        <div class="flex items-start gap-3">
                            <div class="w-6 h-6 rounded-full flex items-center justify-center text-xs font-bold text-white flex-shrink-0" style="background:#2b6485;">2</div>
                            <div><p class="text-sm font-semibold" style="color:#191c1e;">Verifikasi, TTD & Stempel</p><p class="text-xs" style="color:#6d7a77;">Periksa, tandatangani, dan berikan stempel RT 06.</p></div>
                        </div>
                        <div class="flex items-start gap-3">
                            <div class="w-6 h-6 rounded-full flex items-center justify-center text-xs font-bold text-white flex-shrink-0" style="background:#416538;">3</div>
                            <div><p class="text-sm font-semibold" style="color:#191c1e;">Upload & Selesaikan</p><p class="text-xs" style="color:#6d7a77;">Upload kembali — warga otomatis ternotifikasi.</p></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="px-6 pb-6 flex gap-3">
                <button onclick="closeVerifModal()" class="flex-1 px-4 py-2.5 rounded-xl text-sm font-semibold" style="background-color:#eceef0;color:#3d4947;">Tutup</button>
                <a href="#" onclick="alert('File dummy — akan tersedia saat dokumen warga diunggah.')"
                   class="flex-1 inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl text-sm font-semibold text-white"
                   style="background:linear-gradient(135deg,#00685d,#008376);">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                    Download Surat
                </a>
                <button onclick="alert('Fitur tolak tersedia setelah backend terhubung.')"
                        class="flex-1 px-4 py-2.5 rounded-xl text-sm font-semibold"
                        style="background-color:#ffdad6;color:#93000a;">Tolak</button>
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

function openVerifModal(nama, nik, surat, tgl, id) {
    document.getElementById('mv-nama').textContent  = nama;
    document.getElementById('mv-nik').textContent   = nik;
    document.getElementById('mv-surat').textContent = surat;
    document.getElementById('mv-id').textContent    = id;
    const m = document.getElementById('modal-verif');
    m.classList.remove('hidden'); m.classList.add('flex');
    document.body.style.overflow = 'hidden';
}
function closeVerifModal() {
    const m = document.getElementById('modal-verif');
    m.classList.add('hidden'); m.classList.remove('flex');
    document.body.style.overflow = '';
}
document.getElementById('modal-verif').addEventListener('click', function(e){ if(e.target===this) closeVerifModal(); });
document.addEventListener('keydown', e => { if(e.key==='Escape') closeVerifModal(); });
</script>
@endpush

@endsection
