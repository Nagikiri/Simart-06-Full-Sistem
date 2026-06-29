@extends('layouts.app')

@section('title', 'Riwayat Pengajuan')
@section('breadcrumb-parent', 'Warga')
@section('breadcrumb-current', 'Riwayat')

@push('styles')
<style>
    @keyframes pulse-ring {
        0%, 100% { box-shadow: 0 0 0 6px rgba(0, 104, 93, 0.12); }
        50% { box-shadow: 0 0 0 10px rgba(0, 104, 93, 0.06); }
    }
    @keyframes slideDown {
        from { opacity: 0; transform: translateY(-8px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .detail-panel { animation: slideDown 0.25s ease-out; }

    .stepper-dot { width:28px; height:28px; border-radius:50%; display:flex; align-items:center; justify-content:center; flex-shrink:0; z-index:1; position:relative; transition:all 0.3s ease; }
    .stepper-dot.completed { background-color:#416538; color:#fff; }
    .stepper-dot.active { background:linear-gradient(135deg,#00685d,#008376); color:#fff; box-shadow:0 0 0 5px rgba(0,104,93,0.12); animation:pulse-ring 2s ease-in-out infinite; }
    .stepper-dot.pending { background-color:#e0e3e5; color:#6d7a77; }
    .stepper-dot.rejected { background-color:#ba1a1a; color:#fff; }
    .stepper-line { position:absolute; left:13px; top:28px; bottom:0; width:2px; background-color:#bcc9c6; }
    .stepper-line.completed { background:linear-gradient(180deg,#416538,#597e4f); }
    .stepper-line.active { background:linear-gradient(180deg,#416538,#bcc9c6); }

    .filter-tab { transition:all 0.2s ease; cursor:pointer; }
    .filter-tab.active { background-color:rgba(0,104,93,0.08); color:#00685d; font-weight:600; }
    .filter-tab:not(.active):hover { background-color:#f2f4f6; }

    .riwayat-card { transition:all 0.2s ease; border-left: 3px solid transparent; }
    .riwayat-card:hover { background-color:#f8fafa; }
    .riwayat-card.selected { background-color:rgba(0,104,93,0.04); border-left-color:#00685d; }
</style>
@endpush

@section('content')

    <section class="mb-6">
        <div class="mb-6">
            <h1 class="font-manrope font-bold text-2xl lg:text-3xl" style="color: #191c1e;">Riwayat Pengajuan</h1>
            <p class="text-sm mt-1" style="color: #3d4947;">Pantau status surat dan dokumen Anda secara real-time.</p>
        </div>

        {{-- Stats Cards --}}
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            <div class="bg-white rounded-2xl p-5 ambient-lift cursor-default">
                <div class="flex items-center gap-4">
                    <div class="w-11 h-11 rounded-xl flex items-center justify-center" style="background: linear-gradient(135deg, rgba(43,100,133,0.12), rgba(43,100,133,0.04));">
                        <span class="material-icons-outlined text-xl" style="color: #2b6485;">list_alt</span>
                    </div>
                    <div>
                        <span class="font-manrope font-bold text-2xl" style="color: #191c1e;">{{ $riwayat->count() }}</span>
                        <p class="text-[11px] font-medium uppercase tracking-widest" style="color: #6d7a77; letter-spacing: 0.05rem;">Total Pengajuan</p>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-2xl p-5 ambient-lift cursor-default">
                <div class="flex items-center gap-4">
                    <div class="w-11 h-11 rounded-xl flex items-center justify-center" style="background: linear-gradient(135deg, rgba(0,104,93,0.12), rgba(0,104,93,0.04));">
                        <span class="material-icons-outlined text-xl" style="color: #00685d;">pending</span>
                    </div>
                    <div>
                        <span class="font-manrope font-bold text-2xl" style="color: #191c1e;">{{ $riwayat->whereIn('status', ['pending', 'diproses'])->count() }}</span>
                        <p class="text-[11px] font-medium uppercase tracking-widest" style="color: #6d7a77; letter-spacing: 0.05rem;">Dalam Proses</p>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-2xl p-5 ambient-lift cursor-default">
                <div class="flex items-center gap-4">
                    <div class="w-11 h-11 rounded-xl flex items-center justify-center" style="background: linear-gradient(135deg, rgba(65,101,56,0.12), rgba(65,101,56,0.04));">
                        <span class="material-icons-outlined text-xl" style="color: #416538;">check_circle</span>
                    </div>
                    <div>
                        <span class="font-manrope font-bold text-2xl" style="color: #191c1e;">{{ $riwayat->where('status', 'selesai')->count() }}</span>
                        <p class="text-[11px] font-medium uppercase tracking-widest" style="color: #6d7a77; letter-spacing: 0.05rem;">Selesai</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- FULLSCREEN LIST --}}
    <section class="mb-8">
        <div class="bg-white rounded-[1.5rem] overflow-hidden shadow-sm border border-gray-100">
            <div class="px-6 lg:px-8 pt-6 pb-4 border-b border-gray-100">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center gap-2">
                        <span class="material-icons-outlined text-xl" style="color: #00685d;">list_alt</span>
                        <h2 class="font-manrope font-bold text-lg" style="color: #191c1e;">Daftar Pengajuan</h2>
                        <span class="inline-block px-2.5 py-0.5 rounded-full text-xs font-semibold" style="background-color: rgba(0,104,93,0.1); color: #00685d;">
                            {{ $riwayat->count() }}
                        </span>
                    </div>
                </div>

                {{-- Full Width Search Bar --}}
                <div class="relative w-full mb-4">
                    <span class="material-icons-outlined absolute left-4 top-1/2 -translate-y-1/2 text-lg text-gray-400">search</span>
                    <input type="text" id="search-input" placeholder="Cari berdasarkan jenis surat atau ID pengajuan..."
                           class="w-full pl-12 pr-4 py-3 rounded-xl text-sm focus:outline-none focus:ring-2 transition-all bg-gray-50 border border-gray-200"
                           style="--tw-ring-color: rgba(0,104,93,0.2);"
                           oninput="filterCards()">
                </div>

                {{-- Filter Tabs --}}
                <div class="flex gap-2 overflow-x-auto pb-1">
                    <button class="filter-tab active px-4 py-1.5 rounded-full text-xs font-medium whitespace-nowrap" data-filter="all" onclick="filterCards('all', this)">Semua</button>
                    <button class="filter-tab px-4 py-1.5 rounded-full text-xs font-medium whitespace-nowrap" data-filter="pending" onclick="filterCards('pending', this)">Menunggu</button>
                    <button class="filter-tab px-4 py-1.5 rounded-full text-xs font-medium whitespace-nowrap" data-filter="diproses" onclick="filterCards('diproses', this)">Diproses</button>
                    <button class="filter-tab px-4 py-1.5 rounded-full text-xs font-medium whitespace-nowrap" data-filter="selesai" onclick="filterCards('selesai', this)">Selesai</button>
                    <button class="filter-tab px-4 py-1.5 rounded-full text-xs font-medium whitespace-nowrap" data-filter="ditolak" onclick="filterCards('ditolak', this)">Ditolak</button>
                </div>
            </div>

            {{-- LIST --}}
            <div class="divide-y divide-gray-50" id="pengajuan-list">
                @forelse($riwayat as $item)
                    @php
                        $badgeColors = ['pending'=>'#fff0c2','diproses'=>'#c7e7ff','selesai'=>'#c5eeb5','ditolak'=>'#ffdad6'];
                        $textColors  = ['pending'=>'#7a5800','diproses'=>'#064c6b','selesai'=>'#2d4f25','ditolak'=>'#93000a'];
                        $bg = $badgeColors[$item->status] ?? '#c7e7ff';
                        $tc = $textColors[$item->status]  ?? '#064c6b';
                        $displayStatus = $item->status === 'pending' ? 'Menunggu' : ucfirst($item->status);
                    @endphp

                    {{-- Card Row --}}
                    <div class="riwayat-card data-card px-6 py-4 cursor-pointer"
                         data-status="{{ $item->status }}"
                         data-id="{{ $item->id_pengajuan }}"
                         data-title="{{ strtolower($item->jenis_surat) }}"
                         onclick="toggleDetail(this, {{ $item->id_pengajuan }})">

                        {{-- Summary Row --}}
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 rounded-xl flex items-center justify-center shrink-0" style="background: rgba(0,104,93,0.08);">
                                <span class="material-icons-outlined text-[#00685d] text-lg">description</span>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-semibold text-gray-900 truncate">{{ $item->jenis_surat }}</p>
                                <p class="text-xs text-gray-500 mt-0.5">{{ $item->created_at->format('d M Y') }} • ID: #RT06-{{ $item->id_pengajuan }}</p>
                            </div>
                            <div class="flex items-center gap-3 shrink-0">
                                <span class="hidden sm:inline-flex items-center px-3 py-1 rounded-full text-[11px] font-semibold"
                                      style="background-color: {{ $bg }}; color: {{ $tc }};">
                                    {{ $displayStatus }}
                                </span>
                                <span class="material-icons-outlined text-gray-400 text-lg transition-transform duration-200 detail-chevron">expand_more</span>
                            </div>
                        </div>

                        {{-- Detail Panel (hidden by default) --}}
                        <div class="detail-panel-content hidden mt-4 pl-14">
                            <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 mb-4">
                                <div class="rounded-xl p-3" style="background:#f2f4f6;">
                                    <p class="text-[10px] font-semibold uppercase tracking-widest text-gray-500 mb-1">ID Pengajuan</p>
                                    <p class="text-sm font-mono font-bold text-gray-900">#RT06-{{ $item->id_pengajuan }}</p>
                                </div>
                                <div class="rounded-xl p-3" style="background:#f2f4f6;">
                                    <p class="text-[10px] font-semibold uppercase tracking-widest text-gray-500 mb-1">Status</p>
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[11px] font-semibold"
                                          style="background-color: {{ $bg }}; color: {{ $tc }};">{{ $displayStatus }}</span>
                                </div>
                                <div class="rounded-xl p-3" style="background:#f2f4f6;">
                                    <p class="text-[10px] font-semibold uppercase tracking-widest text-gray-500 mb-1">Tanggal Ajuan</p>
                                    <p class="text-sm font-medium text-gray-900">{{ $item->created_at->format('d M Y') }}</p>
                                </div>
                                <div class="rounded-xl p-3" style="background:#f2f4f6;">
                                    <p class="text-[10px] font-semibold uppercase tracking-widest text-gray-500 mb-1">Pemohon</p>
                                    <p class="text-sm font-medium text-gray-900">{{ auth()->user()->name }}</p>
                                </div>
                            </div>

                            {{-- Mini Timeline --}}
                            <div class="rounded-xl p-4" style="background:#f2f4f6;">
                                <p class="text-[10px] font-semibold uppercase tracking-widest text-gray-500 mb-3">Status Terkini</p>
                                <div class="space-y-0 relative">
                                    @php
                                        $steps = [
                                            ['label'=>'Diajukan', 'desc'=>'Data telah diterima sistem', 'state'=>'completed', 'icon'=>'check'],
                                            ['label'=>'Diproses', 'desc'=>'Sedang diverifikasi Ketua RT', 'state'=>in_array($item->status,['diproses','selesai','ditolak']) ? 'completed' : 'pending', 'icon'=>'check'],
                                            ['label'=>$item->status==='ditolak' ? 'Ditolak' : 'Selesai', 'desc'=>$item->status==='selesai' ? 'Surat telah ditandatangani & dapat diunduh' : ($item->status==='ditolak' ? 'Pengajuan ditolak oleh RT' : 'Menunggu persetujuan RT'), 'state'=>$item->status==='selesai' ? 'completed' : ($item->status==='ditolak' ? 'rejected' : 'pending'), 'icon'=>$item->status==='selesai' ? 'task_alt' : ($item->status==='ditolak' ? 'close' : 'schedule')],
                                        ];
                                        if($item->status==='diproses') $steps[1]['state']='active';
                                        if($item->status==='pending') {
                                            $steps[0]['state']='completed';
                                            $steps[1]['state']='active';
                                        }
                                    @endphp
                                    @foreach($steps as $si => $step)
                                    <div class="relative pb-5 {{ $loop->last ? 'pb-0' : '' }}">
                                        @if(!$loop->last)
                                            <div class="stepper-line {{ $step['state']==='completed' ? 'completed' : ($step['state']==='active' ? 'active' : '') }}"></div>
                                        @endif
                                        <div class="flex items-start gap-3">
                                            <div class="stepper-dot {{ $step['state'] }}">
                                                <span class="material-icons-outlined text-xs">{{ $step['icon'] }}</span>
                                            </div>
                                            <div>
                                                <p class="text-sm font-bold text-gray-900">{{ $step['label'] }}</p>
                                                <p class="text-xs text-gray-500">{{ $step['desc'] }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>

                                {{-- Tombol Lihat Surat (only if selesai) --}}
                                @if($item->status === 'selesai')
                                @php $suratItem = $item->surat; @endphp
                                @if($suratItem && $suratItem->file_surat)
                                <div class="mt-3 flex gap-2">
                                    <button onclick="event.stopPropagation(); openSuratViewer('{{ route('pengajuan.download', $item) }}?inline=1', '{{ addslashes($item->jenis_surat) }}')"
                                            class="inline-flex items-center gap-2 px-4 py-2 rounded-xl text-xs font-bold text-white transition-all hover:shadow-md"
                                            style="background:linear-gradient(135deg,#00685d,#008376);">
                                        <span class="material-icons-outlined text-sm">visibility</span>
                                        Lihat Surat Resmi
                                    </button>
                                    <a href="{{ route('pengajuan.download', $item) }}"
                                       onclick="event.stopPropagation();"
                                       class="inline-flex items-center gap-2 px-4 py-2 rounded-xl text-xs font-semibold transition-all hover:bg-gray-200"
                                       style="background:#eceef0;color:#3d4947;">
                                        <span class="material-icons-outlined text-sm">download</span>
                                        Unduh
                                    </a>
                                </div>
                                @else
                                <div class="mt-3 px-3 py-2 rounded-xl text-xs" style="background:#e8f5e9;color:#1b5e20;">
                                    <span class="material-icons-outlined text-sm align-middle mr-1">check_circle</span>
                                    Surat sedang diproses RT. File akan tersedia segera.
                                </div>
                                @endif
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="px-8 py-14 text-center">
                        <div class="w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4 bg-gray-50">
                            <span class="material-icons-outlined text-4xl text-gray-400">inbox</span>
                        </div>
                        <h3 class="font-bold text-gray-900 mb-2">Belum Ada Pengajuan</h3>
                        <p class="text-sm text-gray-500 mb-6">Anda belum pernah mengajukan surat. Silakan buat pengajuan pertama Anda.</p>
                        <a href="{{ route('pengajuan.index') }}" class="inline-flex items-center gap-2 px-6 py-2.5 rounded-full bg-[#00685d] text-white font-semibold text-sm transition-all hover:bg-[#008376]">
                            <span class="material-icons-outlined text-sm">add</span> Buat Pengajuan
                        </a>
                    </div>
                @endforelse
            </div>

            {{-- Empty Search State --}}
            <div class="hidden px-8 py-12 text-center" id="empty-filter-state">
                <span class="material-icons-outlined mb-3 text-4xl text-gray-300">search_off</span>
                <h3 class="font-bold text-gray-900 mb-1">Tidak Ada Hasil</h3>
                <p class="text-sm text-gray-500">Pencarian Anda tidak menemukan hasil. Coba kata kunci lain.</p>
            </div>
        </div>
    </section>

@endsection

{{-- ═══ PDF VIEWER MODAL ═══ --}}
<div id="surat-viewer-modal" class="fixed inset-0 z-50 hidden items-center justify-center p-4"
     style="background-color:rgba(25,28,30,0.75);backdrop-filter:blur(6px);">
    <div class="w-full max-w-5xl h-[92vh] rounded-[1.5rem] shadow-2xl overflow-hidden flex flex-col bg-white">
        <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100 shrink-0">
            <div class="flex items-center gap-3">
                <span class="material-icons-outlined text-xl" style="color:#00685d;">description</span>
                <h2 class="font-manrope font-bold text-base text-gray-900" id="surat-modal-title">Pratinjau Surat Resmi</h2>
            </div>
            <button onclick="closeSuratViewer()" class="w-9 h-9 rounded-xl flex items-center justify-center hover:bg-gray-100 transition-colors">
                <span class="material-icons-outlined text-gray-500">close</span>
            </button>
        </div>
        <iframe id="surat-iframe" src="" class="w-full flex-1 border-0" title="Surat Resmi"></iframe>
    </div>
</div>

@push('scripts')
<script>
    let currentFilter = 'all';

    function filterCards(status, tabEl) {
        if (status !== undefined) {
            currentFilter = status;
            document.querySelectorAll('.filter-tab').forEach(el => el.classList.remove('active'));
            if (tabEl) tabEl.classList.add('active');
        }

        const keyword = document.getElementById('search-input').value.toLowerCase();
        const cards = document.querySelectorAll('.data-card');
        let visible = 0;

        cards.forEach(card => {
            const matchStatus = currentFilter === 'all' || card.dataset.status === currentFilter;
            const matchSearch = card.dataset.title.includes(keyword) || card.dataset.id.includes(keyword);
            card.style.display = matchStatus && matchSearch ? '' : 'none';
            if (matchStatus && matchSearch) visible++;
        });

        document.getElementById('empty-filter-state').classList.toggle('hidden', visible > 0);
    }

    function toggleDetail(el, id) {
        const panel = el.querySelector('.detail-panel-content');
        const chevron = el.querySelector('.detail-chevron');
        const isOpen = !panel.classList.contains('hidden');

        // Close all others
        document.querySelectorAll('.detail-panel-content').forEach(p => p.classList.add('hidden'));
        document.querySelectorAll('.detail-chevron').forEach(c => c.style.transform = '');
        document.querySelectorAll('.riwayat-card').forEach(c => c.classList.remove('selected'));

        if (!isOpen) {
            panel.classList.remove('hidden');
            chevron.style.transform = 'rotate(180deg)';
            el.classList.add('selected');
            setTimeout(() => el.scrollIntoView({ behavior: 'smooth', block: 'nearest' }), 50);
        }
    }

    // ─── PDF Viewer Modal ────────────────────────────────────────────────────
    function openSuratViewer(url, title) {
        document.getElementById('surat-modal-title').textContent = title || 'Surat Resmi';
        document.getElementById('surat-iframe').src = url;
        const m = document.getElementById('surat-viewer-modal');
        m.classList.remove('hidden');
        m.classList.add('flex');
        document.body.style.overflow = 'hidden';
    }
    function closeSuratViewer() {
        const m = document.getElementById('surat-viewer-modal');
        m.classList.add('hidden');
        m.classList.remove('flex');
        document.getElementById('surat-iframe').src = '';
        document.body.style.overflow = '';
    }
    document.getElementById('surat-viewer-modal').addEventListener('click', function(e) {
        if (e.target === this) closeSuratViewer();
    });
    document.addEventListener('keydown', e => { if (e.key === 'Escape') closeSuratViewer(); });
</script>
@endpush
