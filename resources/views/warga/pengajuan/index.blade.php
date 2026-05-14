@extends('layouts.app')

@section('title', 'Daftar Pengajuan')
@section('breadcrumb-parent', 'Warga')
@section('breadcrumb-current', 'Pengajuan')

@section('content')

    {{-- PAGE HEADER --}}
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

    {{-- STATS SUMMARY --}}
    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mb-8">
        <button onclick="filterStatus('semua')" data-filter="semua"
                class="filter-tab bg-white rounded-[1.5rem] p-5 ambient-lift text-left transition-all"
                style="outline: 2px solid #00685d;">
            <span class="font-manrope font-bold text-2xl" style="color: #191c1e;">5</span>
            <p class="text-xs font-medium uppercase tracking-wider mt-1" style="color: #6d7a77; letter-spacing: 0.05rem;">Total</p>
        </button>
        <button onclick="filterStatus('disetujui')" data-filter="disetujui"
                class="filter-tab bg-white rounded-[1.5rem] p-5 ambient-lift text-left transition-all">
            <span class="font-manrope font-bold text-2xl" style="color: #00685d;">3</span>
            <p class="text-xs font-medium uppercase tracking-wider mt-1" style="color: #6d7a77; letter-spacing: 0.05rem;">Disetujui</p>
        </button>
        <button onclick="filterStatus('menunggu')" data-filter="menunggu"
                class="filter-tab bg-white rounded-[1.5rem] p-5 ambient-lift text-left transition-all">
            <span class="font-manrope font-bold text-2xl" style="color: #2b6485;">1</span>
            <p class="text-xs font-medium uppercase tracking-wider mt-1" style="color: #6d7a77; letter-spacing: 0.05rem;">Menunggu</p>
        </button>
        <button onclick="filterStatus('ditolak')" data-filter="ditolak"
                class="filter-tab bg-white rounded-[1.5rem] p-5 ambient-lift text-left transition-all">
            <span class="font-manrope font-bold text-2xl" style="color: #ba1a1a;">1</span>
            <p class="text-xs font-medium uppercase tracking-wider mt-1" style="color: #6d7a77; letter-spacing: 0.05rem;">Ditolak</p>
        </button>
    </div>

    {{-- PENGAJUAN LIST --}}
    <div class="bg-white rounded-[1.5rem] overflow-hidden">
        {{-- Card Header with Filter --}}
        <div class="flex items-center justify-between px-8 pt-8 pb-4">
            <div>
                <h2 class="font-manrope font-bold text-lg" style="color: #191c1e;">Semua Pengajuan</h2>
                <p id="filter-label" class="text-xs mt-0.5" style="color: #6d7a77;">Menampilkan semua pengajuan</p>
            </div>
            <div class="flex items-center gap-2">
                <select id="filter-select" onchange="filterStatus(this.value)"
                        class="text-xs px-3 py-2 rounded-xl border-none focus:ring-2 focus:ring-[#00685d]/20"
                        style="background-color: #eceef0; color: #3d4947;">
                    <option value="semua">Semua Status</option>
                    <option value="disetujui">Disetujui</option>
                    <option value="menunggu">Menunggu</option>
                    <option value="ditolak">Ditolak</option>
                </select>
            </div>
        </div>

        {{-- List Items --}}
        <div class="px-6 pb-6 space-y-2" id="pengajuan-list">

            {{-- Item 1: Disetujui --}}
            <div class="pengajuan-item flex items-center gap-4 px-4 py-5 rounded-xl transition-colors"
                 data-status="disetujui"
                 style="background: transparent;"
                 onmouseenter="this.style.backgroundColor='#f2f4f6'" onmouseleave="this.style.backgroundColor='transparent'">
                <div class="w-11 h-11 rounded-xl flex items-center justify-center flex-shrink-0"
                     style="background: linear-gradient(135deg, rgba(0,104,93,0.10), rgba(0,104,93,0.04));">
                    <svg class="w-5 h-5" style="color: #00685d;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-semibold" style="color: #191c1e;">Surat Keterangan Domisili</p>
                    <p class="text-xs mt-0.5" style="color: #6d7a77;">Diajukan: 10 Apr 2026 • ID: #RT06-0042</p>
                </div>
                <span class="inline-flex items-center px-3 py-1 rounded-full text-[11px] font-semibold flex-shrink-0"
                      style="background-color: #c5eeb5; color: #2d4f25;">Disetujui</span>
                <button onclick="openPengajuanModal('Surat Keterangan Domisili','#RT06-0042','10 Apr 2026','Surat telah disetujui dan ditandatangani oleh Ketua RT 06.','disetujui')"
                        class="text-xs font-semibold transition-colors hover:text-[#008376] flex-shrink-0 ml-2"
                        style="color: #00685d;">Lihat →</button>
            </div>

            {{-- Item 2: Disetujui --}}
            <div class="pengajuan-item flex items-center gap-4 px-4 py-5 rounded-xl transition-colors"
                 data-status="disetujui"
                 style="background: transparent;"
                 onmouseenter="this.style.backgroundColor='#f2f4f6'" onmouseleave="this.style.backgroundColor='transparent'">
                <div class="w-11 h-11 rounded-xl flex items-center justify-center flex-shrink-0"
                     style="background: linear-gradient(135deg, rgba(65,101,56,0.10), rgba(65,101,56,0.04));">
                    <svg class="w-5 h-5" style="color: #416538;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                    </svg>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-semibold" style="color: #191c1e;">Surat Berkelakuan Baik</p>
                    <p class="text-xs mt-0.5" style="color: #6d7a77;">Diajukan: 08 Apr 2026 • ID: #RT06-0039</p>
                </div>
                <span class="inline-flex items-center px-3 py-1 rounded-full text-[11px] font-semibold flex-shrink-0"
                      style="background-color: #c5eeb5; color: #2d4f25;">Disetujui</span>
                <button onclick="openPengajuanModal('Surat Berkelakuan Baik','#RT06-0039','08 Apr 2026','Surat telah disetujui dan ditandatangani oleh Ketua RT 06.','disetujui')"
                        class="text-xs font-semibold transition-colors hover:text-[#008376] flex-shrink-0 ml-2"
                        style="color: #00685d;">Lihat →</button>
            </div>

            {{-- Item 3: Disetujui --}}
            <div class="pengajuan-item flex items-center gap-4 px-4 py-5 rounded-xl transition-colors"
                 data-status="disetujui"
                 style="background: transparent;"
                 onmouseenter="this.style.backgroundColor='#f2f4f6'" onmouseleave="this.style.backgroundColor='transparent'">
                <div class="w-11 h-11 rounded-xl flex items-center justify-center flex-shrink-0"
                     style="background: linear-gradient(135deg, rgba(0,104,93,0.10), rgba(0,104,93,0.04));">
                    <svg class="w-5 h-5" style="color: #00685d;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-semibold" style="color: #191c1e;">Surat Pengantar Umum</p>
                    <p class="text-xs mt-0.5" style="color: #6d7a77;">Diajukan: 05 Apr 2026 • ID: #RT06-0035</p>
                </div>
                <span class="inline-flex items-center px-3 py-1 rounded-full text-[11px] font-semibold flex-shrink-0"
                      style="background-color: #c5eeb5; color: #2d4f25;">Disetujui</span>
                <button onclick="openPengajuanModal('Surat Pengantar Umum','#RT06-0035','05 Apr 2026','Surat telah disetujui dan ditandatangani oleh Ketua RT 06.','disetujui')"
                        class="text-xs font-semibold transition-colors hover:text-[#008376] flex-shrink-0 ml-2"
                        style="color: #00685d;">Lihat →</button>
            </div>

            {{-- Item 4: Menunggu --}}
            <div class="pengajuan-item flex items-center gap-4 px-4 py-5 rounded-xl transition-colors"
                 data-status="menunggu"
                 style="background: transparent;"
                 onmouseenter="this.style.backgroundColor='#f2f4f6'" onmouseleave="this.style.backgroundColor='transparent'">
                <div class="w-11 h-11 rounded-xl flex items-center justify-center flex-shrink-0"
                     style="background: linear-gradient(135deg, rgba(43,100,133,0.10), rgba(43,100,133,0.04));">
                    <svg class="w-5 h-5" style="color: #2b6485;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 13.255A23.193 23.193 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-semibold" style="color: #191c1e;">Surat Keterangan Usaha</p>
                    <p class="text-xs mt-0.5" style="color: #6d7a77;">Diajukan: 08 Apr 2026 • ID: #RT06-0038</p>
                </div>
                <span class="inline-flex items-center px-3 py-1 rounded-full text-[11px] font-semibold flex-shrink-0"
                      style="background-color: #c7e7ff; color: #064c6b;">Menunggu</span>
                <button onclick="openPengajuanModal('Surat Keterangan Usaha','#RT06-0038','08 Apr 2026','Pengajuan sedang menunggu verifikasi dari Ketua RT 06.','menunggu')"
                        class="text-xs font-semibold transition-colors hover:text-[#008376] flex-shrink-0 ml-2"
                        style="color: #00685d;">Lihat →</button>
            </div>

            {{-- Item 5: Ditolak --}}
            <div class="pengajuan-item flex items-center gap-4 px-4 py-5 rounded-xl transition-colors"
                 data-status="ditolak"
                 style="background: transparent;"
                 onmouseenter="this.style.backgroundColor='#f2f4f6'" onmouseleave="this.style.backgroundColor='transparent'">
                <div class="w-11 h-11 rounded-xl flex items-center justify-center flex-shrink-0"
                     style="background: linear-gradient(135deg, rgba(186,26,26,0.08), rgba(186,26,26,0.03));">
                    <svg class="w-5 h-5" style="color: #ba1a1a;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                    </svg>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-semibold" style="color: #191c1e;">Surat Keterangan Tidak Mampu</p>
                    <p class="text-xs mt-0.5" style="color: #6d7a77;">Diajukan: 02 Apr 2026 • ID: #RT06-0030</p>
                </div>
                <span class="inline-flex items-center px-3 py-1 rounded-full text-[11px] font-semibold flex-shrink-0"
                      style="background-color: #ffdad6; color: #93000a;">Ditolak</span>
                <button onclick="openPengajuanModal('Surat Keterangan Tidak Mampu','#RT06-0030','02 Apr 2026','Ditolak: Dokumen pendukung tidak lengkap. Silakan ajukan kembali dengan melampirkan KTP dan KK.','ditolak')"
                        class="text-xs font-semibold transition-colors hover:text-[#008376] flex-shrink-0 ml-2"
                        style="color: #00685d;">Lihat →</button>
            </div>

            {{-- Empty state --}}
            <div id="empty-state" class="hidden py-12 text-center">
                <svg class="w-12 h-12 mx-auto mb-3" style="color: #bcc9c6;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                <p class="text-sm font-medium" style="color: #6d7a77;">Tidak ada pengajuan dengan status ini.</p>
            </div>
        </div>
    </div>

    {{-- MODAL DETAIL PENGAJUAN --}}
    <div id="modal-pengajuan" class="fixed inset-0 z-50 hidden items-center justify-center p-4"
         style="background-color: rgba(25,28,30,0.5); backdrop-filter: blur(4px);">
        <div class="w-full max-w-md rounded-[1.5rem] shadow-2xl overflow-hidden" style="background-color: #fff;">
            <div class="flex items-center justify-between px-6 pt-6 pb-4" style="border-bottom: 1px solid #eceef0;">
                <h2 class="font-manrope font-bold text-base" style="color: #191c1e;">Detail Pengajuan</h2>
                <button onclick="closePengajuanModal()" class="w-8 h-8 rounded-lg flex items-center justify-center transition-colors hover:bg-[#eceef0]">
                    <svg class="w-4 h-4" style="color: #6d7a77;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            <div class="px-6 py-5 space-y-4">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-medium uppercase tracking-widest" style="color: #6d7a77;">Jenis Surat</span>
                    <span id="pm-nama" class="text-sm font-semibold text-right max-w-[55%]" style="color: #191c1e;"></span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-xs font-medium uppercase tracking-widest" style="color: #6d7a77;">Nomor ID</span>
                    <span id="pm-id" class="text-xs font-mono" style="color: #6d7a77;"></span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-xs font-medium uppercase tracking-widest" style="color: #6d7a77;">Tanggal</span>
                    <span id="pm-tanggal" class="text-sm" style="color: #191c1e;"></span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-xs font-medium uppercase tracking-widest" style="color: #6d7a77;">Status</span>
                    <span id="pm-status"></span>
                </div>
                <div class="rounded-xl p-4" style="background-color: #f2f4f6;">
                    <p class="text-xs font-medium mb-1" style="color: #6d7a77;">Catatan dari RT</p>
                    <p id="pm-catatan" class="text-sm" style="color: #3d4947;"></p>
                </div>
            </div>
            <div class="px-6 pb-6 flex gap-3">
                <button onclick="closePengajuanModal()" class="flex-1 px-4 py-2.5 rounded-xl text-sm font-semibold" style="background-color: #eceef0; color: #3d4947;">Tutup</button>
                <a id="pm-download" href="#"
                   onclick="alert('File dummy — akan diganti dengan file asli saat tersedia.')"
                   class="flex-1 inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl text-sm font-semibold text-white"
                   style="background: linear-gradient(135deg, #00685d, #008376);">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                    </svg>
                    Download Surat
                </a>
            </div>
        </div>
    </div>

@push('scripts')
<script>
// ── Filter ──────────────────────────────────────────────────────
function filterStatus(status) {
    const items   = document.querySelectorAll('.pengajuan-item');
    const empty   = document.getElementById('empty-state');
    const label   = document.getElementById('filter-label');
    const select  = document.getElementById('filter-select');
    const tabs    = document.querySelectorAll('.filter-tab');

    select.value = status;
    tabs.forEach(t => t.style.outline = 'none');
    const activeTab = document.querySelector(`.filter-tab[data-filter="${status}"]`);
    if (activeTab) activeTab.style.outline = '2px solid #00685d';

    let visible = 0;
    items.forEach(item => {
        const match = status === 'semua' || item.dataset.status === status;
        item.style.display = match ? '' : 'none';
        if (match) visible++;
    });

    empty.style.display = visible === 0 ? 'block' : 'none';
    const labels = { semua: 'Menampilkan semua pengajuan', disetujui: 'Menampilkan pengajuan disetujui', menunggu: 'Menampilkan pengajuan menunggu', ditolak: 'Menampilkan pengajuan ditolak' };
    label.textContent = labels[status] || '';
}

// ── Modal ───────────────────────────────────────────────────────
const pmStyles = {
    disetujui: { bg: '#c5eeb5', color: '#2d4f25', label: 'Disetujui' },
    ditolak:   { bg: '#ffdad6', color: '#93000a', label: 'Ditolak' },
    menunggu:  { bg: '#c7e7ff', color: '#064c6b', label: 'Menunggu' },
    diproses:  { bg: '#c7e7ff', color: '#064c6b', label: 'Sedang Diproses' },
};

function openPengajuanModal(nama, id, tanggal, catatan, statusKey) {
    document.getElementById('pm-nama').textContent    = nama;
    document.getElementById('pm-id').textContent      = id;
    document.getElementById('pm-tanggal').textContent = tanggal;
    document.getElementById('pm-catatan').textContent = catatan;
    const s = pmStyles[statusKey] || pmStyles.menunggu;
    document.getElementById('pm-status').innerHTML =
        `<span class="inline-flex items-center px-3 py-1 rounded-full text-[11px] font-semibold"
               style="background-color:${s.bg};color:${s.color};">${s.label}</span>`;
    const btn = document.getElementById('pm-download');
    btn.style.display = (statusKey === 'disetujui' || statusKey === 'selesai') ? 'inline-flex' : 'none';
    const m = document.getElementById('modal-pengajuan');
    m.classList.remove('hidden'); m.classList.add('flex');
    document.body.style.overflow = 'hidden';
}

function closePengajuanModal() {
    const m = document.getElementById('modal-pengajuan');
    m.classList.add('hidden'); m.classList.remove('flex');
    document.body.style.overflow = '';
}

document.getElementById('modal-pengajuan').addEventListener('click', function(e) {
    if (e.target === this) closePengajuanModal();
});
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') closePengajuanModal();
});
</script>
@endpush

@endsection
