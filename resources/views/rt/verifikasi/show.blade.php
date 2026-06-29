@extends('layouts.app')

@section('title', 'Verifikasi Pengajuan')
@section('breadcrumb-parent', 'Verifikasi')
@section('breadcrumb-current', '#'.$pengajuan->id_pengajuan)

@push('styles')
<style>
    .ttd-option {
        border: 2px solid #e5e7eb; border-radius: 1rem; padding: 0.75rem;
        cursor: pointer; transition: all 0.2s; margin-bottom: 0.5rem;
    }
    .ttd-option:hover, .ttd-option.selected { border-color: #00685d; background: #f0faf8; }
    .ttd-option input[type="radio"] { accent-color: #00685d; }
</style>
@endpush

@section('content')
<div class="max-w-7xl mx-auto mb-8">
    <a href="{{ route('verifikasi.index') }}" class="text-sm font-semibold inline-flex items-center gap-1 mb-4" style="color:#00685d;">← Kembali</a>
    <h1 class="font-manrope font-bold text-2xl" style="color:#191c1e;">Verifikasi Pengajuan</h1>
    <p class="text-sm mt-1" style="color:#6d7a77;">{{ $pengajuan->warga->nama ?? 'Warga' }} — {{ $pengajuan->jenis_surat }}</p>
</div>

@if(session('success'))
<div class="max-w-7xl mx-auto mb-4 p-4 rounded-xl text-sm" style="background:#e8f5e9;color:#1b5e20;">{{ session('success') }}</div>
@endif

<div class="max-w-7xl mx-auto" style="display: flex; flex-direction: row; gap: 1.5rem; align-items: flex-start;">

    {{-- LEFT: Preview Surat --}}
    <div style="flex: 1; min-width: 0; display: flex; flex-direction: column; gap: 1.5rem;">
        @if($pengajuan->template && $pengajuan->template->content)
        <div class="bg-white rounded-[1.5rem] overflow-hidden shadow-sm">
            <div class="px-6 py-4 border-b border-gray-100 flex items-center gap-2">
                <span class="material-icons-outlined text-xl" style="color:#2b6485;">description</span>
                <h2 class="font-manrope font-bold text-base" style="color:#191c1e;">Preview Surat (Sudah Diisi Warga)</h2>
                <span class="ml-auto text-xs text-gray-400">Pastikan isian warga sesuai sebelum menyetujui.</span>
            </div>
            <div class="p-6 bg-gray-50 flex justify-center">
                <div class="bg-white shadow-sm border border-gray-200 p-8" style="width: 210mm; min-height: 297mm; transform: scale(0.9); transform-origin: top center; font-family: 'Times New Roman', Times, serif;">
                    @php
                        $dataTambahan = $pengajuan->data_tambahan;
                        if (is_string($dataTambahan)) $dataTambahan = json_decode($dataTambahan, true) ?? [];
                        if (is_object($dataTambahan)) $dataTambahan = (array) $dataTambahan;
                        $dataTambahan = $dataTambahan ?: [];

                        if(isset($dataTambahan['_html_final']) && !empty($dataTambahan['_html_final'])) {
                            $htmlPreview = $dataTambahan['_html_final'];
                        } else {
                            $htmlPreview = $pengajuan->template->content;
                            foreach((array)$dataTambahan as $key => $val) {
                                if ($key === '_html_final') continue;
                                $cleanKey = str_starts_with($key, 'field_') ? substr($key, 6) : $key;
                                $htmlPreview = preg_replace('/(<span[^>]*id="field_' . preg_quote($cleanKey, '/') . '"[^>]*>)(.*?)(<\/span>)/i', '$1' . e($val) . '$3', $htmlPreview);
                            }
                        }
                    @endphp
                    {!! $htmlPreview !!}
                </div>
            </div>
        </div>
        @endif
    </div>

    {{-- RIGHT: Actions --}}
    <div style="width: 380px; flex-shrink: 0; position: sticky; top: 2rem; display: flex; flex-direction: column; gap: 1.25rem;">

        {{-- Info Pengajuan --}}
        <div class="bg-white rounded-[1.5rem] p-6">
            <h3 class="font-manrope font-bold text-sm mb-4" style="color:#191c1e;">Informasi Pengajuan</h3>
            <div class="space-y-3 text-sm" style="color:#3d4947;">
                <div class="flex justify-between">
                    <span class="text-xs font-semibold uppercase tracking-widest text-gray-400">ID</span>
                    <span class="font-mono font-bold text-gray-900">#RT06-{{ $pengajuan->id_pengajuan }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-xs font-semibold uppercase tracking-widest text-gray-400">Tanggal</span>
                    <span>{{ $pengajuan->tanggal_pengajuan }}</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-xs font-semibold uppercase tracking-widest text-gray-400">Status</span>
                    @php
                        $statusStyle = match($pengajuan->status) {
                            'selesai' => 'background:#c5eeb5;color:#2d4f25;',
                            'ditolak' => 'background:#ffdad6;color:#93000a;',
                            default   => 'background:#c7e7ff;color:#064c6b;',
                        };
                        $statusLabel = match($pengajuan->status) {
                            'selesai' => 'Selesai',
                            'ditolak' => 'Ditolak',
                            default   => 'Menunggu',
                        };
                    @endphp
                    <span class="px-2.5 py-1 rounded-full text-[11px] font-semibold" style="{{ $statusStyle }}">{{ $statusLabel }}</span>
                </div>
                @if($pengajuan->warga)
                <div class="pt-2 border-t border-gray-100">
                    <p class="text-xs font-semibold uppercase tracking-widest text-gray-400 mb-1">Warga</p>
                    <p class="font-semibold text-gray-900">{{ $pengajuan->warga->nama ?? 'Nama tidak tersedia' }}</p>
                    <p class="text-xs text-gray-500 mt-0.5">{{ $pengajuan->warga->alamat ?? 'Alamat tidak tersedia' }}</p>
                </div>
                @endif
            </div>
        </div>

        @if($pengajuan->status === 'pending')

        {{-- REJECT --}}
        <div class="bg-white rounded-[1.5rem] p-6">
            <h3 class="font-manrope font-bold text-sm mb-3" style="color:#ba1a1a;">Tolak Pengajuan</h3>
            <form method="POST" action="{{ route('verifikasi.reject', $pengajuan) }}">
                @csrf
                <textarea name="alasan_penolakan" required rows="3"
                          class="w-full px-4 py-2.5 rounded-xl text-sm mb-3 focus:outline-none focus:ring-2 focus:ring-[#ba1a1a]/20 resize-none"
                          style="background:#f2f4f6;border:none;"
                          placeholder="Berikan alasan penolakan..."></textarea>
                <button type="submit"
                        class="w-full py-2.5 rounded-xl text-sm font-semibold transition-all hover:opacity-80"
                        style="background:#ffdad6;color:#ba1a1a;">
                    Tolak Pengajuan
                </button>
            </form>
        </div>

        {{-- APPROVE --}}
        <div class="bg-white rounded-[1.5rem] p-6">
            <h3 class="font-manrope font-bold text-sm mb-3" style="color:#416538;">Setujui Pengajuan</h3>
            <p class="text-xs leading-relaxed mb-4" style="color:#6d7a77;">Pilih tanda tangan untuk dicetak di PDF.</p>
            
            <form method="POST" action="{{ route('verifikasi.approve', $pengajuan) }}" enctype="multipart/form-data">
                @csrf
                
                @php $rtWarga = auth()->user()->warga; @endphp
                @if($rtWarga && $rtWarga->tanda_tangan)
                <label class="ttd-option selected block">
                    <div class="flex items-start gap-3">
                        <input type="radio" name="ttd_mode" value="profil" checked onchange="switchTTD(this)" class="mt-1">
                        <div>
                            <p class="text-sm font-semibold" style="color:#191c1e;">Tanda Tangan Tersimpan</p>
                            <img src="{{ asset('storage/' . $rtWarga->tanda_tangan) }}" alt="TTD" class="max-h-10 mt-1 object-contain">
                        </div>
                    </div>
                </label>
                @endif

                <label class="ttd-option block {{ (!$rtWarga || !$rtWarga->tanda_tangan) ? 'selected' : '' }}">
                    <div class="flex items-start gap-3">
                        <input type="radio" name="ttd_mode" value="upload" {{ (!$rtWarga || !$rtWarga->tanda_tangan) ? 'checked' : '' }} onchange="switchTTD(this)" class="mt-1">
                        <div class="w-full">
                            <p class="text-sm font-semibold" style="color:#191c1e;">Upload TTD Baru</p>
                            <div id="upload-area" class="mt-2 {{ (!$rtWarga || !$rtWarga->tanda_tangan) ? '' : 'hidden' }}">
                                <input type="file" name="ttd_upload" accept="image/png,image/jpeg"
                                       class="w-full text-xs file:mr-2 file:py-1 file:px-3 file:rounded file:border-0 file:text-white"
                                       style="file:background:#00685d;" onchange="previewTTD(this)">
                                <img id="ttd-preview-img" src="" class="max-h-10 mt-2 hidden object-contain">
                            </div>
                        </div>
                    </div>
                </label>

                <label class="ttd-option block">
                    <div class="flex items-start gap-3">
                        <input type="radio" name="ttd_mode" value="text" onchange="switchTTD(this)" class="mt-1">
                        <div>
                            <p class="text-sm font-semibold" style="color:#191c1e;">Nama Saja (Teks)</p>
                        </div>
                    </div>
                </label>

                <button type="submit"
                        class="w-full mt-2 flex items-center justify-center gap-2 py-3 rounded-xl text-sm font-semibold text-white transition-all hover:shadow-lg"
                        style="background:linear-gradient(135deg,#416538,#5a8a47);">
                    <span class="material-icons-outlined text-base">verified</span>
                    Setujui & Terbitkan Surat
                </button>
            </form>
        </div>

        @else
        <div class="bg-white rounded-[1.5rem] p-6">
            <p class="text-sm" style="color:#6d7a77;">Pengajuan ini telah diproses dan berstatus <strong>{{ ucfirst($pengajuan->status) }}</strong>.</p>
            @if($pengajuan->catatan)
            <div class="mt-4 p-3 rounded-lg text-sm border-l-4 border-[#ba1a1a]" style="background:#ffdad6;color:#ba1a1a;">
                <span class="font-semibold block mb-1">Catatan Penolakan:</span>
                {{ $pengajuan->catatan }}
            </div>
            @endif
        </div>
        @endif

    </div>
</div>
@endsection

@push('scripts')
<script>
function switchTTD(radio) {
    document.querySelectorAll('.ttd-option').forEach(el => el.classList.remove('selected'));
    radio.closest('.ttd-option').classList.add('selected');
    const uploadArea = document.getElementById('upload-area');
    if (radio.value === 'upload') {
        uploadArea.classList.remove('hidden');
    } else {
        uploadArea.classList.add('hidden');
    }
}

function previewTTD(input) {
    if (!input.files[0]) return;
    const reader = new FileReader();
    reader.onload = e => {
        const img = document.getElementById('ttd-preview-img');
        img.src = e.target.result;
        img.classList.remove('hidden');
    };
    reader.readAsDataURL(input.files[0]);
}
</script>
@endpush
