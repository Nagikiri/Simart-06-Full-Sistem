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
            <a href="{{ route('warga.riwayat') }}" class="p-2 rounded-xl transition-colors hover:bg-[#eceef0]" style="color: #6d7a77;">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
            </a>
            <div>
                <h1 class="font-manrope font-bold text-2xl" style="color: #191c1e;">Pengajuan Surat Baru</h1>
                <p class="text-sm mt-1" style="color: #3d4947;">Lengkapi data di form web berikut untuk mengajukan surat ke RT. Tidak perlu mengunduh dokumen apapun.</p>
            </div>
        </div>
    </div>

    {{-- ═══════════════════════════════════════════════════════════════
         FORM
    ═══════════════════════════════════════════════════════════════ --}}
    <form method="POST" action="{{ route('pengajuan.store') }}" id="pengajuanForm">
        @csrf

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">

            {{-- ══════════════════════════════════════════════════
                 LEFT COLUMN — Form Fields
            ══════════════════════════════════════════════════ --}}
            <div class="lg:col-span-6 space-y-6">

                {{-- ── Card: Pilih Jenis Surat ─────────────────── --}}
                <div class="bg-white rounded-[1.5rem] p-8">
                    <h2 class="font-manrope font-bold text-base mb-2" style="color: #191c1e;">Pilih Jenis Surat</h2>
                    <p class="text-xs mb-6" style="color: #6d7a77;">Tentukan jenis surat yang ingin diajukan</p>

                    @error('id_template')
                        <p class="mb-4 text-xs font-medium px-3 py-2 rounded-xl" style="color: #93000a; background-color: #ffdad6;">{{ $message }}</p>
                    @enderror

                    <div class="space-y-3 max-h-[300px] overflow-y-auto pr-2" id="jenisSuratOptions">
                        @foreach($templates as $index => $tmpl)
                        <label class="surat-option flex items-start gap-4 px-4 py-4 rounded-xl cursor-pointer transition-all border-2"
                               style="border-color: transparent; background-color: #f7f9fb;"
                               data-id="{{ $tmpl->id }}">
                            <input type="radio" name="id_template" value="{{ $tmpl->id }}" class="hidden" {{ old('id_template') == $tmpl->id ? 'checked' : '' }} required onchange="fetchPreview({{ $tmpl->id }})">
                            <div class="w-10 h-10 rounded-xl flex-shrink-0 flex items-center justify-center mt-0.5" style="background: linear-gradient(135deg, rgba(0,104,93,0.10), rgba(0,104,93,0.04));">
                                <span class="material-icons-outlined text-lg" style="color: #00685d;">description</span>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm font-semibold" style="color: #191c1e;">{{ $tmpl->nama_surat }}</p>
                            </div>
                            <div class="surat-check w-5 h-5 rounded-full flex-shrink-0 flex items-center justify-center mt-1 opacity-0 transition-opacity" style="background-color: #00685d;">
                                <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                            </div>
                        </label>
                        @endforeach
                    </div>
                </div>

                {{-- ── Card: Data Pemohon ──────────────────────── --}}
                <div class="bg-white rounded-[1.5rem] p-8 hidden" id="formPemohonCard">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-10 h-10 rounded-xl flex items-center justify-center" style="background: linear-gradient(135deg, rgba(0,104,93,0.10), rgba(0,104,93,0.04));">
                            <span class="material-icons-outlined text-lg" style="color: #00685d;">person</span>
                        </div>
                        <div>
                            <h2 class="font-manrope font-bold text-base" style="color: #191c1e;">Data Pemohon</h2>
                            <p class="text-xs" style="color: #6d7a77;">Lengkapi data berikut untuk diisikan ke surat</p>
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
                                oninput="updatePreview()"
                                class="w-full px-4 py-3 rounded-xl text-sm border transition-all focus:ring-2 focus:outline-none @error('nama_lengkap') border-[#ba1a1a] focus:ring-[#ba1a1a]/10 @else border-[#bcc9c6]/35 focus:border-[#00685d] focus:ring-[#00685d]/10 @enderror"
                                style="background-color: #fff; color: #191c1e;"
                            >
                        </div>

                        {{-- NIK --}}
                        <div>
                            <label for="nik" class="block text-xs font-semibold uppercase tracking-wider mb-2" style="color: #3d4947; letter-spacing: 0.05rem;">
                                NIK
                            </label>
                            <input
                                id="nik"
                                type="text"
                                name="nik"
                                value="{{ old('nik', auth()->user()->warga->nik ?? '') }}"
                                placeholder="Masukkan NIK KTP"
                                required
                                oninput="updatePreview()"
                                class="w-full px-4 py-3 rounded-xl text-sm border transition-all focus:ring-2 focus:outline-none @error('nik') border-[#ba1a1a] focus:ring-[#ba1a1a]/10 @else border-[#bcc9c6]/35 focus:border-[#00685d] focus:ring-[#00685d]/10 @enderror"
                                style="background-color: #fff; color: #191c1e;"
                            >
                        </div>

                        {{-- Tempat, Tanggal Lahir --}}
                        <div>
                            <label for="tempat_tanggal_lahir" class="block text-xs font-semibold uppercase tracking-wider mb-2" style="color: #3d4947; letter-spacing: 0.05rem;">
                                Tempat, Tanggal Lahir
                            </label>
                            <input
                                id="tempat_tanggal_lahir"
                                type="text"
                                name="tempat_tanggal_lahir"
                                value="{{ old('tempat_tanggal_lahir', auth()->user()->warga->tempat_lahir ? auth()->user()->warga->tempat_lahir . ', ' . auth()->user()->warga->tanggal_lahir : '') }}"
                                placeholder="Contoh: Balikpapan, 17 Agustus 1990"
                                required
                                oninput="updatePreview()"
                                class="w-full px-4 py-3 rounded-xl text-sm border transition-all focus:ring-2 focus:outline-none @error('tempat_tanggal_lahir') border-[#ba1a1a] focus:ring-[#ba1a1a]/10 @else border-[#bcc9c6]/35 focus:border-[#00685d] focus:ring-[#00685d]/10 @enderror"
                                style="background-color: #fff; color: #191c1e;"
                            >
                        </div>

                        {{-- Jenis Kelamin --}}
                        <div>
                            <label class="block text-xs font-semibold uppercase tracking-wider mb-2" style="color: #3d4947; letter-spacing: 0.05rem;">
                                Jenis Kelamin
                            </label>
                            <div class="flex gap-4">
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="radio" name="jenis_kelamin" value="Laki-laki" onchange="updatePreview()" required {{ old('jenis_kelamin', auth()->user()->warga->gender ?? '') == 'Laki-laki' ? 'checked' : '' }}>
                                    <span class="text-sm">Laki-laki</span>
                                </label>
                                <label class="flex items-center gap-2 cursor-pointer">
                                    <input type="radio" name="jenis_kelamin" value="Perempuan" onchange="updatePreview()" required {{ old('jenis_kelamin', auth()->user()->warga->gender ?? '') == 'Perempuan' ? 'checked' : '' }}>
                                    <span class="text-sm">Perempuan</span>
                                </label>
                            </div>
                        </div>

                        {{-- Agama & Pekerjaan --}}
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label for="agama" class="block text-xs font-semibold uppercase tracking-wider mb-2" style="color: #3d4947; letter-spacing: 0.05rem;">Agama</label>
                                <input id="agama" type="text" name="agama" value="{{ old('agama', auth()->user()->warga->agama ?? '') }}" placeholder="Agama" required oninput="updatePreview()" class="w-full px-4 py-3 rounded-xl text-sm border transition-all focus:ring-2 focus:outline-none @error('agama') border-[#ba1a1a] focus:ring-[#ba1a1a]/10 @else border-[#bcc9c6]/35 focus:border-[#00685d] focus:ring-[#00685d]/10 @enderror" style="background-color: #fff; color: #191c1e;">
                            </div>
                            <div>
                                <label for="pekerjaan" class="block text-xs font-semibold uppercase tracking-wider mb-2" style="color: #3d4947; letter-spacing: 0.05rem;">Pekerjaan</label>
                                <input id="pekerjaan" type="text" name="pekerjaan" value="{{ old('pekerjaan', auth()->user()->warga->pekerjaan ?? '') }}" placeholder="Pekerjaan" required oninput="updatePreview()" class="w-full px-4 py-3 rounded-xl text-sm border transition-all focus:ring-2 focus:outline-none @error('pekerjaan') border-[#ba1a1a] focus:ring-[#ba1a1a]/10 @else border-[#bcc9c6]/35 focus:border-[#00685d] focus:ring-[#00685d]/10 @enderror" style="background-color: #fff; color: #191c1e;">
                            </div>
                        </div>

                        {{-- Alamat --}}
                        <div>
                            <label for="alamat" class="block text-xs font-semibold uppercase tracking-wider mb-2" style="color: #3d4947; letter-spacing: 0.05rem;">
                                Alamat Lengkap
                            </label>
                            <textarea
                                id="alamat"
                                name="alamat"
                                rows="3"
                                placeholder="Masukkan alamat lengkap"
                                required
                                oninput="updatePreview()"
                                class="w-full px-4 py-3 rounded-xl text-sm border transition-all focus:ring-2 focus:outline-none resize-none @error('alamat') border-[#ba1a1a] focus:ring-[#ba1a1a]/10 @else border-[#bcc9c6]/35 focus:border-[#00685d] focus:ring-[#00685d]/10 @enderror"
                                style="background-color: #fff; color: #191c1e;"
                            >{{ old('alamat', auth()->user()->warga->alamat ?? '') }}</textarea>
                        </div>

                        {{-- Tujuan Surat --}}
                        <div>
                            <label for="tujuan_surat" class="block text-xs font-semibold uppercase tracking-wider mb-2" style="color: #3d4947; letter-spacing: 0.05rem;">
                                Tujuan / Keperluan Surat
                            </label>
                            <input
                                id="tujuan_surat"
                                type="text"
                                name="tujuan_surat"
                                value="{{ old('tujuan_surat') }}"
                                placeholder="Contoh: Persyaratan melamar pekerjaan"
                                required
                                oninput="updatePreview()"
                                class="w-full px-4 py-3 rounded-xl text-sm border transition-all focus:ring-2 focus:outline-none @error('tujuan_surat') border-[#ba1a1a] focus:ring-[#ba1a1a]/10 @else border-[#bcc9c6]/35 focus:border-[#00685d] focus:ring-[#00685d]/10 @enderror"
                                style="background-color: #fff; color: #191c1e;"
                            >
                        </div>
                        {{-- Dynamic Fields Container (Auto-generated based on selected template) --}}
                        <div id="dynamicFieldsContainer" class="space-y-5 mt-2"></div>
                    </div>
                </div>

                {{-- ── Action Buttons ──────────────────────────── --}}
                <div class="space-y-3 hidden" id="actionButtons">
                    <button
                        type="submit"
                        id="submitBtn"
                        class="w-full flex items-center justify-center gap-2 text-white font-semibold py-4 rounded-xl text-sm transition-all hover:shadow-lg hover:-translate-y-0.5 active:translate-y-0"
                        style="background: linear-gradient(135deg, #00685d 0%, #008376 100%);"
                        onclick="handleSubmit(this)"
                    >
                        <span id="btnDefault" class="flex items-center gap-2">
                            <span class="material-icons-outlined text-base">send</span>
                            Kirim Pengajuan
                        </span>
                        <span id="btnLoading" class="hidden flex items-center gap-2">
                            <svg class="w-5 h-5 animate-spin" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            Mengirim...
                        </span>
                    </button>
                    <a href="{{ route('warga.riwayat') }}"
                       class="w-full flex items-center justify-center py-3.5 rounded-xl text-sm font-semibold transition-all hover:-translate-y-0.5"
                       style="background-color: #eceef0; color: #3d4947;">
                        Batalkan
                    </a>
                </div>

            </div>

            {{-- ══════════════════════════════════════════════════
                 RIGHT COLUMN — HTML PREVIEW
            ══════════════════════════════════════════════════ --}}
            <div class="lg:col-span-6">
                <div class="bg-[#eceef0] rounded-[1.5rem] p-6 sticky top-6">
                    <div class="flex items-center gap-2 mb-4">
                        <span class="material-icons-outlined text-lg" style="color: #00685d;">visibility</span>
                        <h2 class="font-manrope font-bold text-sm uppercase tracking-wider" style="color: #191c1e;">Pratinjau Surat</h2>
                    </div>

                    <div id="previewContainer" class="bg-white rounded-xl shadow-sm p-4 lg:p-6 overflow-auto w-full max-h-[800px] flex items-center justify-center" style="min-height: 400px;">
                        <p class="text-sm text-center" style="color: #6d7a77;">Pilih jenis surat terlebih dahulu untuk melihat pratinjau kertas HVS.</p>
                    </div>
                </div>
            </div>

        </div>
    </form>

@endsection

@push('scripts')
<script>
    let rawHtmlTemplate = '';

    document.addEventListener('DOMContentLoaded', function () {
        // ═══ Jenis Surat Radio-Card Selection ═══
        document.querySelectorAll('.surat-option').forEach(label => {
            const radio = label.querySelector('input[type="radio"]');

            if (radio.checked) {
                activateOption(label, radio);
            }

            label.addEventListener('click', () => activateOption(label, radio));
        });
    });

    function activateOption(label, radio) {
        document.querySelectorAll('.surat-option').forEach(opt => {
            opt.style.borderColor = 'transparent';
            opt.style.backgroundColor = '#f7f9fb';
            opt.querySelector('.surat-check').style.opacity = '0';
        });
        label.style.borderColor = '#00685d';
        label.style.backgroundColor = 'rgba(0,104,93,0.03)';
        label.querySelector('.surat-check').style.opacity = '1';
        radio.checked = true;
        fetchPreview(radio.value);
    }

    function fetchPreview(id) {
        // Show loading in preview
        const previewContainer = document.getElementById('previewContainer');
        previewContainer.innerHTML = '<div class="flex flex-col items-center"><svg class="w-8 h-8 animate-spin text-[#00685d]" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg><p class="mt-4 text-sm text-[#6d7a77]">Memuat pratinjau surat...</p></div>';

        // Fetch template from server
        fetch(`/warga/pengajuan/template-content/${id}`)
            .then(res => res.json())
            .then(data => {
                if(data.content) {
                    rawHtmlTemplate = data.content;
                    
                    // INJEKSI PINTAR (MAGIC)
                    // Cari kurung kosong dan injeksi [NAMA_RT] dan [NAMA_PEMOHON] secara in-memory
                    // Sehingga form isian akan otomatis digenerate persis seperti Surat Pernyataan Gaib (Template 8)
                    const bracketRegex = /\(\s*(?:&emsp;|&nbsp;|\.|_|\s|&#160;|<sup[^>]*>.*?<\/sup>){1,}\s*\)/ig;
                    let matches = rawHtmlTemplate.match(bracketRegex) || [];
                    
                    if (matches.length === 1) {
                        rawHtmlTemplate = rawHtmlTemplate.replace(/\(\s*(?:&emsp;|&nbsp;|\.|_|\s|&#160;|<sup[^>]*>.*?<\/sup>){1,}\s*\)/i, '([NAMA_PEMOHON])');
                    } else if (matches.length >= 2) {
                        rawHtmlTemplate = rawHtmlTemplate.replace(/\(\s*(?:&emsp;|&nbsp;|\.|_|\s|&#160;|<sup[^>]*>.*?<\/sup>){1,}\s*\)/i, '([NAMA_RT])');
                        rawHtmlTemplate = rawHtmlTemplate.replace(/\(\s*(?:&emsp;|&nbsp;|\.|_|\s|&#160;|<sup[^>]*>.*?<\/sup>){1,}\s*\)/i, '([NAMA_PEMOHON])');
                    }
                    
                    // Ganti "Ketua RT … Kelurahan" menjadi "Ketua RT [NOMOR_RT] Kelurahan"
                    rawHtmlTemplate = rawHtmlTemplate.replace(/Ketua RT\s*(?:…|\.{3,})\s*Kelurahan/gi, 'Ketua RT [NOMOR_RT] Kelurahan');
                    
                    document.getElementById('formPemohonCard').classList.remove('hidden');
                    document.getElementById('actionButtons').classList.remove('hidden');
                    generateDynamicFields();
                    updatePreview(); // Apply inputs
                }
            })
            .catch(err => {
                previewContainer.innerHTML = '<p class="text-sm text-red-500">Gagal memuat template.</p>';
            });
    }

    function generateDynamicFields() {
        const container = document.getElementById('dynamicFieldsContainer');
        container.innerHTML = '';
        
        const matches = rawHtmlTemplate.match(/\[([A-Z0-9_]+)\]/g) || [];
        const uniquePlaceholders = [...new Set(matches.map(m => m.replace(/\[|\]/g, '')))];
        
        // Static fields that already exist in the form
        const staticFields = [
            'NAMA', 'NAMA_LENGKAP', 'NAMA_WARGA', 'NIK', 'TTL', 'TEMPAT_LAHIR', 'TANGGAL_LAHIR', 
            'JENIS_KELAMIN', 'AGAMA', 'PEKERJAAN', 'ALAMAT', 'ALAMAT_LENGKAP', 'ALAMAT_WARGA', 
            'KEPERLUAN', 'TUJUAN_SURAT', 'KEPERLUAN_SURAT', 'NOMOR_RT'
        ];
        
        uniquePlaceholders.forEach(placeholder => {
            if (!staticFields.includes(placeholder)) {
                // Generate a pretty label from the placeholder
                let labelText = placeholder.replace(/_/g, ' ').toLowerCase();
                labelText = labelText.replace(/\b\w/g, l => l.toUpperCase());
                let inputPlaceholder = `Masukkan ${labelText}`;
                
                // Override khusus untuk nama penandatangan agar lebih jelas
                if (placeholder === 'NAMA_RT') {
                    labelText = 'Nama Ketua RT (Untuk Tanda Tangan)';
                    inputPlaceholder = 'Contoh: Junnior Pollaris';
                } else if (placeholder === 'NAMA_PEMOHON' || placeholder === 'NAMA_TTD') {
                    labelText = 'Nama Pembuat Pernyataan (Untuk Tanda Tangan)';
                    inputPlaceholder = 'Contoh: Budi Santoso';
                }
                
                const fieldHtml = `
                    <div>
                        <label for="dynamic_${placeholder}" class="block text-xs font-semibold uppercase tracking-wider mb-2" style="color: #3d4947; letter-spacing: 0.05rem;">
                            ${labelText}
                        </label>
                        <input
                            id="dynamic_${placeholder}"
                            type="text"
                            name="field_${placeholder}"
                            placeholder="${inputPlaceholder}"
                            required
                            oninput="updatePreview()"
                            class="w-full px-4 py-3 rounded-xl text-sm border transition-all focus:ring-2 focus:outline-none border-[#bcc9c6]/35 focus:border-[#00685d] focus:ring-[#00685d]/10"
                            style="background-color: #fff; color: #191c1e;"
                        >
                    </div>
                `;
                container.insertAdjacentHTML('beforeend', fieldHtml);
            }
        });
    }

    function updatePreview() {
        if(!rawHtmlTemplate) return;

        let html = rawHtmlTemplate;
        
        // Get Static Values
        const nama = document.getElementById('nama_lengkap').value || '[NAMA]';
        const alamat = document.getElementById('alamat').value || '[ALAMAT]';
        const tujuan = document.getElementById('tujuan_surat').value || '[KEPERLUAN]';
        const genderEl = document.querySelector('input[name="jenis_kelamin"]:checked');
        const jk = genderEl ? genderEl.value : '[JENIS_KELAMIN]';

        const nik = document.getElementById('nik')?.value || '[NIK]';
        const ttl = document.getElementById('tempat_tanggal_lahir')?.value || '[TTL]';
        const agama = document.getElementById('agama')?.value || '[AGAMA]';
        const pekerjaan = document.getElementById('pekerjaan')?.value || '[PEKERJAAN]';

        // Apply Static Replacements (covers multiple variations used in different templates)
        const staticMappings = {
            'NAMA': nama, 'NAMA_LENGKAP': nama, 'NAMA_WARGA': nama,
            'ALAMAT': alamat, 'ALAMAT_LENGKAP': alamat, 'ALAMAT_WARGA': alamat,
            'JENIS_KELAMIN': jk,
            'KEPERLUAN': tujuan, 'TUJUAN_SURAT': tujuan, 'KEPERLUAN_SURAT': tujuan,
            'NIK': nik, 'TTL': ttl, 'AGAMA': agama, 'PEKERJAAN': pekerjaan,
            'NOMOR_RT': '06'
        };

        for (const [placeholder, val] of Object.entries(staticMappings)) {
            const regex = new RegExp(`\\[${placeholder}\\]`, 'g');
            html = html.replace(regex, `<span style="color:#00685d; font-weight:bold;">${val}</span>`);
        }

        // Apply Dynamic Replacements
        const matches = rawHtmlTemplate.match(/\[([A-Z0-9_]+)\]/g) || [];
        const uniquePlaceholders = [...new Set(matches.map(m => m.replace(/\[|\]/g, '')))];
        
        const staticFields = Object.keys(staticMappings);

        uniquePlaceholders.forEach(placeholder => {
            if (!staticFields.includes(placeholder)) {
                const el = document.getElementById('dynamic_' + placeholder);
                const val = el && el.value ? el.value : `[${placeholder}]`;
                const regex = new RegExp(`\\[${placeholder}\\]`, 'g');
                html = html.replace(regex, `<span style="color:#00685d; font-weight:bold;">${val}</span>`);
            }
        });

        // Prepare Final HTML to send to backend for perfect PDF rendering (only if we want to save final HTML directly)
        // Here we create a hidden input to send the computed HTML to the controller
        let finalHtmlInput = document.getElementById('_html_final');
        if(!finalHtmlInput) {
            finalHtmlInput = document.createElement('input');
            finalHtmlInput.type = 'hidden';
            finalHtmlInput.name = '_html_final';
            finalHtmlInput.id = '_html_final';
            document.getElementById('pengajuanForm').appendChild(finalHtmlInput);
        }
        // Save the raw version of the HTML but with plain text (without spans) for backend processing if preferred. 
        // We'll leave it as is and the controller will do it, or we pass the computed one.
        // Actually, the controller replaces fields automatically using `data_tambahan`. So we don't strictly need `_html_final`.

        const previewContainer = document.getElementById('previewContainer');
        // Clear flex center styles for proper HTML render, make it fully responsive with overflow-auto
        previewContainer.className = "bg-white rounded-xl shadow-md p-3 lg:p-8 overflow-auto w-full border border-gray-200";
        previewContainer.innerHTML = html;
    }

    function handleSubmit(btn) {
        const form = document.getElementById('pengajuanForm');
        if (!form.checkValidity()) {
            form.reportValidity();
            return;
        }

        document.getElementById('btnDefault').classList.add('hidden');
        document.getElementById('btnLoading').classList.remove('hidden');
        btn.style.opacity = '0.7';
        btn.style.cursor = 'not-allowed';
    }
</script>
@endpush
