@extends('layouts.app')

@section('title', 'Pengajuan Surat Baru')
@section('breadcrumb-parent', 'Pengajuan')
@section('breadcrumb-current', 'Buat Pengajuan')

@section('content')

    {{-- ═══════════════════════════════════════════════════════════════
         PAGE HEADER
    ═══════════════════════════════════════════════════════════════ --}}
    <div class="mb-8">
        <div class="flex items-center gap-3 mb-3">
            <a href="{{ route('pengajuan.index') }}" class="p-2 rounded-xl transition-colors hover:bg-[#eceef0]" style="color: #6d7a77;">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
            </a>
            <div>
                <h1 class="font-manrope font-bold text-2xl" style="color: #191c1e;">Pengajuan Surat Baru</h1>
                <p class="text-sm mt-1" style="color: #3d4947;">Lengkapi data berikut untuk mengajukan surat keterangan RT.</p>
            </div>
        </div>
    </div>

    {{-- ═══════════════════════════════════════════════════════════════
         FORM — enctype for file upload
    ═══════════════════════════════════════════════════════════════ --}}
    <form method="POST" action="{{ route('pengajuan.create') }}" enctype="multipart/form-data" id="pengajuanForm">
        @csrf

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">

            {{-- ══════════════════════════════════════════════════
                 LEFT COLUMN — Form Fields & Upload
            ══════════════════════════════════════════════════ --}}
            <div class="lg:col-span-7 space-y-6">

                {{-- ── Card: Data Pemohon ──────────────────────── --}}
                <div class="bg-white rounded-[1.5rem] p-8">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-10 h-10 rounded-xl flex items-center justify-center" style="background: linear-gradient(135deg, rgba(0,104,93,0.10), rgba(0,104,93,0.04));">
                            <svg class="w-5 h-5" style="color: #00685d;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                        </div>
                        <div>
                            <h2 class="font-manrope font-bold text-base" style="color: #191c1e;">Data Pemohon</h2>
                            <p class="text-xs" style="color: #6d7a77;">Informasi identitas pelapor</p>
                        </div>
                    </div>

                    <div class="space-y-5">
                        {{-- Nama Lengkap --}}
                        <div>
                            <label for="nama_lengkap" class="block text-xs font-semibold uppercase tracking-wider mb-2" style="color: #3d4947; letter-spacing: 0.05rem;">
                                Nama Lengkap
                            </label>
                            <input
                                id="nama_lengkap"
                                type="text"
                                name="nama_lengkap"
                                value="{{ old('nama_lengkap', auth()->user()->name ?? '') }}"
                                placeholder="Masukkan nama lengkap sesuai KTP"
                                required
                                class="w-full px-4 py-3 rounded-xl text-sm border transition-all focus:ring-2 focus:outline-none @error('nama_lengkap') border-[#ba1a1a] focus:ring-[#ba1a1a]/10 @else border-[#bcc9c6]/35 focus:border-[#00685d] focus:ring-[#00685d]/10 @enderror"
                                style="background-color: #fff; color: #191c1e;"
                            >
                            @error('nama_lengkap')
                                <p class="mt-2 text-xs font-medium" style="color: #ba1a1a;">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- NIK --}}
                        <div>
                            <label for="nik" class="block text-xs font-semibold uppercase tracking-wider mb-2" style="color: #3d4947; letter-spacing: 0.05rem;">
                                NIK (Nomor Induk Kependudukan)
                            </label>
                            <input
                                id="nik"
                                type="text"
                                name="nik"
                                value="{{ old('nik', auth()->user()->nik ?? '') }}"
                                placeholder="Masukkan 16 digit NIK"
                                required
                                maxlength="16"
                                inputmode="numeric"
                                class="w-full px-4 py-3 rounded-xl text-sm border transition-all focus:ring-2 focus:outline-none @error('nik') border-[#ba1a1a] focus:ring-[#ba1a1a]/10 @else border-[#bcc9c6]/35 focus:border-[#00685d] focus:ring-[#00685d]/10 @enderror"
                                style="background-color: #fff; color: #191c1e;"
                            >
                            @error('nik')
                                <p class="mt-2 text-xs font-medium" style="color: #ba1a1a;">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Alasan Pengajuan --}}
                        <div>
                            <label for="alasan_pengajuan" class="block text-xs font-semibold uppercase tracking-wider mb-2" style="color: #3d4947; letter-spacing: 0.05rem;">
                                Alasan Pengajuan
                            </label>
                            <textarea
                                id="alasan_pengajuan"
                                name="alasan_pengajuan"
                                rows="4"
                                placeholder="Jelaskan alasan atau keperluan pengajuan surat ini..."
                                required
                                class="w-full px-4 py-3 rounded-xl text-sm border transition-all focus:ring-2 focus:outline-none resize-none @error('alasan_pengajuan') border-[#ba1a1a] focus:ring-[#ba1a1a]/10 @else border-[#bcc9c6]/35 focus:border-[#00685d] focus:ring-[#00685d]/10 @enderror"
                                style="background-color: #fff; color: #191c1e;"
                            >{{ old('alasan_pengajuan') }}</textarea>
                            @error('alasan_pengajuan')
                                <p class="mt-2 text-xs font-medium" style="color: #ba1a1a;">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- ── Card: Upload Lampiran (Drag & Drop) ──────── --}}
                <div class="bg-white rounded-[1.5rem] p-8">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-10 h-10 rounded-xl flex items-center justify-center" style="background: linear-gradient(135deg, rgba(43,100,133,0.10), rgba(43,100,133,0.04));">
                            <svg class="w-5 h-5" style="color: #2b6485;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <div>
                            <h2 class="font-manrope font-bold text-base" style="color: #191c1e;">Lampiran Dokumen</h2>
                            <p class="text-xs" style="color: #6d7a77;">Upload KTP, KK, atau dokumen pendukung</p>
                        </div>
                    </div>

                    {{-- Drag & Drop Zone --}}
                    <div
                        id="dropZone"
                        class="relative rounded-2xl p-8 text-center cursor-pointer transition-all group border-2 border-dashed"
                        style="border-color: #bcc9c6; background-color: #f7f9fb;"
                        onclick="document.getElementById('dokumen').click()"
                    >
                        {{-- Icon --}}
                        <div class="w-14 h-14 mx-auto rounded-2xl flex items-center justify-center mb-4 transition-transform group-hover:scale-110" style="background: linear-gradient(135deg, rgba(0,104,93,0.08), rgba(0,104,93,0.03));">
                            <svg class="w-7 h-7" style="color: #00685d;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                            </svg>
                        </div>

                        <p class="text-sm font-semibold mb-1" style="color: #191c1e;">
                            Klik untuk unggah atau <span style="color: #00685d;">seret file ke sini</span>
                        </p>
                        <p class="text-xs" style="color: #6d7a77;">
                            Format PDF, JPG, atau PNG (Maks. 5MB)
                        </p>

                        {{-- Hidden file input --}}
                        <input
                            id="dokumen"
                            type="file"
                            name="dokumen[]"
                            multiple
                            accept=".pdf,.jpg,.jpeg,.png"
                            class="hidden"
                            onchange="handleFileSelect(this)"
                        >
                    </div>

                    {{-- File Preview Container --}}
                    <div id="filePreview" class="mt-4 space-y-2 hidden">
                    </div>

                    @error('dokumen')
                        <p class="mt-3 text-xs font-medium" style="color: #ba1a1a;">{{ $message }}</p>
                    @enderror
                    @error('dokumen.*')
                        <p class="mt-3 text-xs font-medium" style="color: #ba1a1a;">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- ══════════════════════════════════════════════════
                 RIGHT COLUMN — Jenis Surat + Info
            ══════════════════════════════════════════════════ --}}
            <div class="lg:col-span-5 space-y-6">

                {{-- ── Card: Pilih Jenis Surat ─────────────────── --}}
                <div class="bg-white rounded-[1.5rem] p-8">
                    <h2 class="font-manrope font-bold text-base mb-2" style="color: #191c1e;">Pilih Jenis Surat</h2>
                    <p class="text-xs mb-6" style="color: #6d7a77;">Tentukan jenis surat yang ingin diajukan</p>

                    @error('jenis_surat')
                        <p class="mb-4 text-xs font-medium px-3 py-2 rounded-xl" style="color: #93000a; background-color: #ffdad6;">{{ $message }}</p>
                    @enderror

                    <div class="space-y-3" id="jenisSuratOptions">
                        {{-- Option 1: Domisili --}}
                        <label class="surat-option flex items-start gap-4 px-4 py-4 rounded-xl cursor-pointer transition-all border-2"
                               style="border-color: transparent; background-color: #f7f9fb;"
                               data-value="domisili">
                            <input type="radio" name="jenis_surat" value="domisili" class="hidden" {{ old('jenis_surat') === 'domisili' ? 'checked' : '' }} required>
                            <div class="w-10 h-10 rounded-xl flex-shrink-0 flex items-center justify-center mt-0.5" style="background: linear-gradient(135deg, rgba(0,104,93,0.10), rgba(0,104,93,0.04));">
                                <svg class="w-5 h-5" style="color: #00685d;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm font-semibold" style="color: #191c1e;">Domisili</p>
                                <p class="text-xs mt-0.5" style="color: #6d7a77;">Surat keterangan tempat tinggal tetap atau sementara.</p>
                            </div>
                            <div class="surat-check w-5 h-5 rounded-full flex-shrink-0 flex items-center justify-center mt-1 opacity-0 transition-opacity" style="background-color: #00685d;">
                                <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                            </div>
                        </label>

                        {{-- Option 2: SKU --}}
                        <label class="surat-option flex items-start gap-4 px-4 py-4 rounded-xl cursor-pointer transition-all border-2"
                               style="border-color: transparent; background-color: #f7f9fb;"
                               data-value="usaha">
                            <input type="radio" name="jenis_surat" value="usaha" class="hidden" {{ old('jenis_surat') === 'usaha' ? 'checked' : '' }}>
                            <div class="w-10 h-10 rounded-xl flex-shrink-0 flex items-center justify-center mt-0.5" style="background: linear-gradient(135deg, rgba(43,100,133,0.10), rgba(43,100,133,0.04));">
                                <svg class="w-5 h-5" style="color: #2b6485;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 13.255A23.193 23.193 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm font-semibold" style="color: #191c1e;">Surat Keterangan Usaha</p>
                                <p class="text-xs mt-0.5" style="color: #6d7a77;">Kebutuhan administrasi pembukaan atau legalitas usaha.</p>
                            </div>
                            <div class="surat-check w-5 h-5 rounded-full flex-shrink-0 flex items-center justify-center mt-1 opacity-0 transition-opacity" style="background-color: #00685d;">
                                <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                            </div>
                        </label>

                        {{-- Option 3: SKTM --}}
                        <label class="surat-option flex items-start gap-4 px-4 py-4 rounded-xl cursor-pointer transition-all border-2"
                               style="border-color: transparent; background-color: #f7f9fb;"
                               data-value="tidak_mampu">
                            <input type="radio" name="jenis_surat" value="tidak_mampu" class="hidden" {{ old('jenis_surat') === 'tidak_mampu' ? 'checked' : '' }}>
                            <div class="w-10 h-10 rounded-xl flex-shrink-0 flex items-center justify-center mt-0.5" style="background: linear-gradient(135deg, rgba(65,101,56,0.10), rgba(65,101,56,0.04));">
                                <svg class="w-5 h-5" style="color: #416538;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm font-semibold" style="color: #191c1e;">Surat Keterangan Tidak Mampu</p>
                                <p class="text-xs mt-0.5" style="color: #6d7a77;">Keperluan keringanan biaya pendidikan atau kesehatan.</p>
                            </div>
                            <div class="surat-check w-5 h-5 rounded-full flex-shrink-0 flex items-center justify-center mt-1 opacity-0 transition-opacity" style="background-color: #00685d;">
                                <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                            </div>
                        </label>

                        {{-- Option 4: Pengantar --}}
                        <label class="surat-option flex items-start gap-4 px-4 py-4 rounded-xl cursor-pointer transition-all border-2"
                               style="border-color: transparent; background-color: #f7f9fb;"
                               data-value="pengantar">
                            <input type="radio" name="jenis_surat" value="pengantar" class="hidden" {{ old('jenis_surat') === 'pengantar' ? 'checked' : '' }}>
                            <div class="w-10 h-10 rounded-xl flex-shrink-0 flex items-center justify-center mt-0.5" style="background: linear-gradient(135deg, rgba(217,159,60,0.10), rgba(217,159,60,0.04));">
                                <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm font-semibold" style="color: #191c1e;">Surat Pengantar Umum</p>
                                <p class="text-xs mt-0.5" style="color: #6d7a77;">Pengantar untuk berbagai keperluan administratif.</p>
                            </div>
                            <div class="surat-check w-5 h-5 rounded-full flex-shrink-0 flex items-center justify-center mt-1 opacity-0 transition-opacity" style="background-color: #00685d;">
                                <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                            </div>
                        </label>
                    </div>
                </div>

                {{-- ── Info Box ────────────────────────────────── --}}
                <div class="rounded-[1.5rem] p-6" style="background-color: #eceef0;">
                    <h3 class="font-manrope font-bold text-sm mb-4" style="color: #191c1e;">Informasi Penting</h3>
                    <div class="space-y-3">
                        <div class="flex items-start gap-3">
                            <svg class="w-5 h-5 flex-shrink-0 mt-0.5" style="color: #00685d;" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            <p class="text-xs leading-relaxed" style="color: #3d4947;">Proses verifikasi oleh Ketua RT memakan waktu <strong>1×24 jam kerja</strong>.</p>
                        </div>
                        <div class="flex items-start gap-3">
                            <svg class="w-5 h-5 flex-shrink-0 mt-0.5" style="color: #00685d;" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            <p class="text-xs leading-relaxed" style="color: #3d4947;">Anda akan menerima <strong>notifikasi via WhatsApp</strong> setelah surat disetujui.</p>
                        </div>
                        <div class="flex items-start gap-3">
                            <svg class="w-5 h-5 flex-shrink-0 mt-0.5" style="color: #00685d;" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            <p class="text-xs leading-relaxed" style="color: #3d4947;">Pastikan dokumen yang diunggah <strong>terbaca dengan jelas</strong>.</p>
                        </div>
                    </div>
                </div>

                {{-- ── Action Buttons ──────────────────────────── --}}
                <div class="space-y-3">
                    {{-- Submit CTA --}}
                    <button
                        type="submit"
                        id="submitBtn"
                        class="w-full flex items-center justify-center gap-2 text-white font-semibold py-4 rounded-xl text-sm transition-all hover:shadow-lg hover:-translate-y-0.5 active:translate-y-0"
                        style="background: linear-gradient(135deg, #00685d 0%, #008376 100%);"
                        onclick="handleSubmit(this)"
                    >
                        {{-- Default state --}}
                        <span id="btnDefault" class="flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                            </svg>
                            Kirim Pengajuan
                        </span>
                        {{-- Loading state --}}
                        <span id="btnLoading" class="hidden flex items-center gap-2">
                            <svg class="w-5 h-5 animate-spin" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            Mengirim...
                        </span>
                    </button>

                    {{-- Cancel --}}
                    <a href="{{ route('pengajuan.index') }}"
                       class="w-full flex items-center justify-center py-3.5 rounded-xl text-sm font-semibold transition-all hover:-translate-y-0.5"
                       style="background-color: #eceef0; color: #3d4947;">
                        Batalkan
                    </a>
                </div>

                {{-- Tagline --}}
                <p class="text-center text-xs italic" style="color: #bcc9c6;">Melayani dengan Sepenuh Hati</p>
            </div>
        </div>
    </form>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {

    // ═══ Drag & Drop Handler ═══
    const dropZone = document.getElementById('dropZone');
    const fileInput = document.getElementById('dokumen');

    ['dragenter', 'dragover'].forEach(evt => {
        dropZone.addEventListener(evt, (e) => {
            e.preventDefault();
            dropZone.style.borderColor = '#00685d';
            dropZone.style.backgroundColor = 'rgba(0,104,93,0.03)';
        });
    });

    ['dragleave', 'drop'].forEach(evt => {
        dropZone.addEventListener(evt, (e) => {
            e.preventDefault();
            dropZone.style.borderColor = '#bcc9c6';
            dropZone.style.backgroundColor = '#f7f9fb';
        });
    });

    dropZone.addEventListener('drop', (e) => {
        fileInput.files = e.dataTransfer.files;
        handleFileSelect(fileInput);
    });

    // ═══ Jenis Surat Radio-Card Selection ═══
    document.querySelectorAll('.surat-option').forEach(label => {
        const radio = label.querySelector('input[type="radio"]');

        // Set initial state for old() values
        if (radio.checked) {
            label.style.borderColor = '#00685d';
            label.style.backgroundColor = 'rgba(0,104,93,0.03)';
            label.querySelector('.surat-check').style.opacity = '1';
        }

        label.addEventListener('click', () => {
            // Reset all
            document.querySelectorAll('.surat-option').forEach(opt => {
                opt.style.borderColor = 'transparent';
                opt.style.backgroundColor = '#f7f9fb';
                opt.querySelector('.surat-check').style.opacity = '0';
            });
            // Activate selected
            label.style.borderColor = '#00685d';
            label.style.backgroundColor = 'rgba(0,104,93,0.03)';
            label.querySelector('.surat-check').style.opacity = '1';
        });
    });
});

// ═══ File Select Preview ═══
function handleFileSelect(input) {
    const container = document.getElementById('filePreview');
    container.innerHTML = '';

    if (input.files.length > 0) {
        container.classList.remove('hidden');
        Array.from(input.files).forEach((file, index) => {
            const sizeKB = (file.size / 1024).toFixed(1);
            const isImage = file.type.startsWith('image/');
            const isPdf = file.type === 'application/pdf';

            const item = document.createElement('div');
            item.className = 'flex items-center gap-3 px-4 py-3 rounded-xl';
            item.style.backgroundColor = '#f7f9fb';
            item.innerHTML = `
                <div class="w-9 h-9 rounded-lg flex items-center justify-center flex-shrink-0" style="background-color: ${isImage ? 'rgba(0,104,93,0.08)' : 'rgba(43,100,133,0.08)'};">
                    ${isImage
                        ? '<svg class="w-4 h-4" style="color: #00685d;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>'
                        : '<svg class="w-4 h-4" style="color: #2b6485;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>'
                    }
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-xs font-medium truncate" style="color: #191c1e;">${file.name}</p>
                    <p class="text-[11px]" style="color: #6d7a77;">${sizeKB} KB</p>
                </div>
                <button type="button" onclick="removeFile(${index})" class="p-1 rounded-lg transition-colors hover:bg-red-50" style="color: #ba1a1a;">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            `;
            container.appendChild(item);
        });
    } else {
        container.classList.add('hidden');
    }
}

function removeFile(index) {
    const input = document.getElementById('dokumen');
    const dt = new DataTransfer();
    Array.from(input.files).forEach((file, i) => {
        if (i !== index) dt.items.add(file);
    });
    input.files = dt.files;
    handleFileSelect(input);
}

// ═══ Submit Loading State ═══
function handleSubmit(btn) {
    const form = document.getElementById('pengajuanForm');
    // Basic client-side check: at least jenis_surat is selected
    const selectedSurat = form.querySelector('input[name="jenis_surat"]:checked');
    if (!selectedSurat) return;

    document.getElementById('btnDefault').classList.add('hidden');
    document.getElementById('btnLoading').classList.remove('hidden');
    btn.disabled = true;
    btn.style.opacity = '0.7';
    btn.style.cursor = 'not-allowed';
}
</script>
@endpush
