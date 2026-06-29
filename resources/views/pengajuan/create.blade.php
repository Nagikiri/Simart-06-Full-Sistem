@extends('layouts.app')

@section('title', 'Form Pengajuan - ' . $template->nama_surat)
@section('breadcrumb-parent', 'Pengajuan')
@section('breadcrumb-current', 'Isi Data')

@push('styles')
<style>
/* Paper appearance */
#live-preview-container {
    font-family: 'Times New Roman', Times, serif !important;
    font-size: 12pt;
    line-height: 1.8;
    color: #000;
}
#live-preview-container * {
    font-family: 'Times New Roman', Times, serif !important;
}
/* Editable placeholder highlight */
.field-placeholder {
    display: inline;
    border-bottom: 1px solid #aaa;
    min-width: 80px;
    color: #888;
    font-style: italic;
    cursor: text;
    outline: none;
    transition: all 0.15s;
    padding: 0 2px;
}
.field-placeholder.active {
    color: #000;
    font-style: normal;
    border-bottom: 2px solid #00685d;
    background: rgba(0,104,93,0.04);
}
.field-placeholder.filled {
    color: #000;
    font-style: normal;
    border-bottom: 1px solid #00685d;
}
/* Form scrollbar */
#form-panel::-webkit-scrollbar { width: 4px; }
#form-panel::-webkit-scrollbar-track { background: #f1f5f4; border-radius: 10px; }
#form-panel::-webkit-scrollbar-thumb { background: #bcc9c6; border-radius: 10px; }
#form-panel::-webkit-scrollbar-thumb:hover { background: #00685d; }
/* Active input highlight */
.form-field-row.highlighted { background-color: rgba(0,104,93,0.06); border-radius: 8px; }
</style>
@endpush

@section('content')
    {{-- Back + Title --}}
    <div class="mb-6 flex items-center gap-4">
        <a href="{{ route('pengajuan.index') }}" class="w-10 h-10 rounded-xl bg-white border border-gray-200 flex items-center justify-center text-gray-600 hover:bg-gray-50 transition-colors">
            <span class="material-icons-outlined">arrow_back</span>
        </a>
        <div>
            <h1 class="font-manrope font-bold text-xl lg:text-2xl text-gray-900">{{ $template->nama_surat }}</h1>
            <p class="text-sm text-gray-500">Isi kolom di kiri — surat di kanan terupdate otomatis secara real-time.</p>
        </div>
    </div>

    {{-- PROGRESS BAR --}}
    <div class="flex items-center gap-2 mb-6 max-w-sm">
        <div class="flex items-center gap-2 opacity-40">
            <span class="w-7 h-7 rounded-full flex items-center justify-center text-xs font-bold text-gray-500 bg-gray-200">1</span>
            <span class="text-xs font-semibold hidden sm:inline text-gray-500">Pilih Surat</span>
        </div>
        <div class="flex-1 h-0.5 bg-gray-200"></div>
        <div class="flex items-center gap-2">
            <span class="w-7 h-7 rounded-full flex items-center justify-center text-xs font-bold text-white shadow" style="background:linear-gradient(135deg,#00685d,#008376);">2</span>
            <span class="text-xs font-semibold hidden sm:inline" style="color:#00685d;">Isi Data</span>
        </div>
        <div class="flex-1 h-0.5 bg-gray-200"></div>
        <div class="flex items-center gap-2 opacity-40">
            <span class="w-7 h-7 rounded-full flex items-center justify-center text-xs font-bold text-gray-500 bg-gray-200">3</span>
            <span class="text-xs font-semibold hidden sm:inline text-gray-500">Kirim</span>
        </div>
    </div>

    <form method="POST" action="{{ route('pengajuan.store') }}" id="pengajuan-form" style="display: flex; flex-direction: row; gap: 1.5rem; align-items: flex-start;">
        @csrf
        <input type="hidden" name="id_template" value="{{ $template->id }}">
        {{-- Hidden inputs for each field will be injected by JS --}}
        <div id="hidden-fields-container" style="display: none;"></div>

        {{-- ════ KIRI: Formulir Isian ════ --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 flex flex-col" style="width: 350px; flex-shrink: 0; max-height: calc(100vh - 160px); position: sticky; top: 80px; z-index: 10;">
            <div class="px-6 pt-6 pb-4 border-b border-gray-100 shrink-0 flex flex-col items-center justify-center">
                <span class="material-icons-outlined text-[#00685d] text-3xl mb-2">edit_document</span>
                <h2 class="text-lg font-bold text-gray-900 text-center w-full">Formulir Isian</h2>
                <p class="text-xs text-gray-500 mt-1 text-center w-full">Ketik di kolom bawah → surat kanan terupdate otomatis</p>
            </div>

            <div id="form-panel" class="flex-1 overflow-y-auto px-4 py-4 space-y-3">
                <p class="text-xs text-gray-400 italic text-center py-4" id="form-loading-msg">
                    <span class="material-icons-outlined text-2xl text-gray-300 block mb-1">autorenew</span>
                    Memuat kolom formulir dari template...
                </p>
            </div>

            <div class="px-4 pb-4 pt-2 shrink-0 border-t border-gray-100">
                <button type="submit" id="btn-submit"
                        class="w-full flex items-center justify-center gap-2 py-3 rounded-xl font-bold text-white text-sm transition-all shadow-md hover:shadow-lg hover:-translate-y-0.5"
                        style="background:linear-gradient(135deg,#00685d,#008376);">
                    <span class="material-icons-outlined text-sm">send</span>
                    Kirim Pengajuan ke RT
                </button>
                <p class="text-[10px] text-gray-400 text-center mt-2">
                    <span class="material-icons-outlined" style="font-size:11px;vertical-align:middle;">lock</span>
                    Data terenkripsi & aman
                </p>
            </div>
        </div>

        {{-- ════ KANAN: Live Preview Surat ════ --}}
        <div style="flex: 1; min-width: 0;">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                {{-- Toolbar --}}
                <div class="flex items-center gap-3 px-5 py-3 border-b border-gray-100 bg-gray-50">
                    <div class="flex gap-1.5">
                        <span class="w-3 h-3 rounded-full bg-red-400"></span>
                        <span class="w-3 h-3 rounded-full bg-yellow-400"></span>
                        <span class="w-3 h-3 rounded-full bg-green-400"></span>
                    </div>
                    <span class="text-xs text-gray-500 font-medium flex-1 text-center">{{ $template->nama_surat }} — Pratinjau Langsung</span>
                    <span class="material-icons-outlined text-gray-400 text-base">description</span>
                </div>

                {{-- Letter preview --}}
                <div class="overflow-auto" style="max-height: calc(100vh - 200px);">
                    <div id="live-preview-container" style="transform-origin: top left; min-width: 210mm;">
                        @if($template->content)
                            {!! $template->content !!}
                        @else
                            <div class="p-12 text-center text-gray-400">
                                <span class="material-icons-outlined text-5xl mb-3 block">description</span>
                                <p class="font-semibold">Template belum tersedia</p>
                                <p class="text-sm mt-1">Hubungi Ketua RT untuk mengupload template surat.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const previewContainer = document.getElementById('live-preview-container');
    const formPanel        = document.getElementById('form-panel');
    const hiddenContainer  = document.getElementById('hidden-fields-container');
    const loadingMsg       = document.getElementById('form-loading-msg');

    if (!previewContainer) return;

    // ── Pre-fill defaults from user account ──────────────────────────────────
    const userDefaults = {
        nama: '{{ addslashes(auth()->user()->name ?? "") }}',
        alamat: '{{ addslashes(optional(auth()->user()->warga)->alamat ?? "") }}',
    };

    // ── Smart Template Pre-processor ──────────────────────────────────────────
    function smartPreProcess(root) {
        // 1. Find empty table cells that act as inputs (e.g., <td>Nama</td> <td>: </td>)
        const tds = root.querySelectorAll('td');
        tds.forEach(td => {
            const text = td.textContent.trim();
            if (text === ':' || text === '' || text === ':-') {
                const prevTd = td.previousElementSibling;
                const row = td.closest('tr');
                // Skip if this row ALREADY has a placeholder (e.g., [NAMA_LENGKAP])
                if (row && (row.textContent.includes('[') || row.querySelector('.field-placeholder'))) {
                    return;
                }

                if (prevTd) {
                    let labelText = prevTd.textContent.trim();
                    // Remove leading numbers like "1."
                    labelText = labelText.replace(/^\d+\.\s*/, '');
                    if (labelText.length > 1 && labelText.length < 50 && !labelText.includes('...')) {
                        const placeholderText = '[' + labelText.toUpperCase().replace(/[^A-Z0-9\s]/g, '_').trim() + ']';
                        
                        const span = document.createElement('span');
                        span.className = 'field-placeholder';
                        span.dataset.placeholder = placeholderText;
                        span.dataset.label = labelText;
                        span.textContent = placeholderText;
                        
                        td.innerHTML = text === '' ? '' : ': '; 
                        td.appendChild(span);
                    }
                }
            }
        });

        // 2. Find dots (........) in text nodes and convert them to explicit placeholders
        const walker = document.createTreeWalker(root, NodeFilter.SHOW_TEXT, null, false);
        const textNodes = [];
        let node;
        while ((node = walker.nextNode())) {
            if (node.parentElement && node.parentElement.classList.contains('field-placeholder')) continue;
            // Skip if the parent is a date/signature area that shouldn't be touched
            if (node.parentElement && node.parentElement.id && node.parentElement.id.includes('tanggal')) continue;
            if (node.nodeValue.match(/\.{5,}/)) textNodes.push(node);
        }

        textNodes.forEach(textNode => {
            const parent = textNode.parentNode;
            const text = textNode.nodeValue;
            const regex = /(\.{5,})/g;
            const fragment = document.createDocumentFragment();
            let match, lastIndex = 0;

            while ((match = regex.exec(text)) !== null) {
                if (match.index > lastIndex) {
                    fragment.appendChild(document.createTextNode(text.slice(lastIndex, match.index)));
                }

                // Determine label based on surrounding context
                let labelText = 'Isian Tambahan';
                const before = text.slice(0, match.index).trim() || (parent.textContent || '').trim();
                
                // If it's a signature line
                if (before.match(/(saksi|tanda tangan|kepala|ketua|rt|rw|pemohon)/i)) {
                    labelText = 'Nama Penandatangan';
                } else {
                    // Try to grab the last few words
                    let words = before.split(/\s+/).slice(-4).join(' ');
                    let lm = words.match(/([A-Za-z0-9\s]+)[:\s]*$/);
                    if (lm && lm[1].trim().length > 2 && lm[1].trim().length < 35) {
                        labelText = lm[1].trim();
                    } else if (before.length > 50) {
                        labelText = 'Keterangan Tambahan';
                    }
                }

                const placeholderText = '[' + labelText.toUpperCase().replace(/[^A-Z0-9\s]/g, '_').trim() + ']';
                const span = document.createElement('span');
                span.className = 'field-placeholder';
                span.dataset.placeholder = placeholderText;
                span.dataset.label = labelText;
                span.textContent = placeholderText;
                fragment.appendChild(span);

                lastIndex = regex.lastIndex;
            }
            if (lastIndex < text.length) {
                fragment.appendChild(document.createTextNode(text.slice(lastIndex)));
            }
            parent.replaceChild(fragment, textNode);
        });
    }

    // ── Auto-parse [PLACEHOLDER] in the preview ─────────────
    function autoParsePlaceholders(root) {
        const walker = document.createTreeWalker(root, NodeFilter.SHOW_TEXT, null, false);
        const nodes  = [];
        let node;
        while ((node = walker.nextNode())) {
            if (node.parentElement && node.parentElement.id && node.parentElement.id.startsWith('field_')) continue;
            // Only match placeholders inside square brackets e.g. [NAMA LENGKAP] (added by user or by smart pre-processor)
            if (node.nodeValue.match(/\[[^\]]+\]/)) {
                nodes.push(node);
            }
        }

        nodes.forEach(textNode => {
            const parent   = textNode.parentNode;
            const text     = textNode.nodeValue;
            const regex    = /(\[[^\]]+\])/g;
            const fragment = document.createDocumentFragment();
            let match, lastIndex = 0;

            while ((match = regex.exec(text)) !== null) {
                if (match.index > lastIndex) {
                    fragment.appendChild(document.createTextNode(text.slice(lastIndex, match.index)));
                }

                if (parent.id && parent.id.startsWith('field_')) {
                    fragment.appendChild(document.createTextNode(match[0]));
                } else if (parent.classList.contains('field-placeholder')) {
                    // Already a placeholder (from pre-processor)
                    fragment.appendChild(document.createTextNode(match[0]));
                } else {
                    let label = match[0].replace(/[\[\]]/g, '').toLowerCase()
                                        .replace(/_/g, ' ')
                                        .replace(/\//g, ' / ')
                                        .replace(/\b\w/g, c => c.toUpperCase());

                    const span       = document.createElement('span');
                    span.className   = 'field-placeholder';
                    span.dataset.placeholder = match[0];
                    span.dataset.label = label;
                    span.textContent = match[0];
                    fragment.appendChild(span);
                }
                lastIndex = regex.lastIndex;
            }
            if (lastIndex < text.length) {
                fragment.appendChild(document.createTextNode(text.slice(lastIndex)));
            }
            parent.replaceChild(fragment, textNode);
        });
    }

    // Run the processors
    smartPreProcess(previewContainer);
    autoParsePlaceholders(previewContainer);

    // ── Collect all interactive spans (id="field_*" OR class="field-placeholder") ──
    const allSpans = [
        ...Array.from(previewContainer.querySelectorAll('span[id^="field_"]')),
        ...Array.from(previewContainer.querySelectorAll('span.field-placeholder:not([id^="field_"])'))
    ];

    // Assign auto-ids to placeholder spans that don't have one
    let counter = 1;
    allSpans.forEach(span => {
        if (!span.id) {
            span.id = 'field_auto_' + (counter++);
        }
    });

    // Clear loading message
    if (loadingMsg) loadingMsg.remove();
    formPanel.innerHTML = '';

    if (allSpans.length === 0) {
        formPanel.innerHTML = '<p class="text-sm text-gray-400 text-center py-8 italic">Tidak ada field isian terdeteksi pada template ini.</p>';
    }

    // ── Build form inputs ────────────────────────────────────────────────────
    allSpans.forEach(span => {
        let origText = span.dataset.placeholder || span.textContent.trim();
        let labelStr = span.dataset.label || span.id.replace('field_', '').replace(/_/g, ' ');
        
        // If the text inside the span is a placeholder like [NAMA LENGKAP], use that for the label!
        if (origText.startsWith('[') && origText.endsWith(']')) {
            labelStr = origText.replace(/[\[\]]/g, '')
                               .replace(/_/g, ' ')
                               .replace(/\//g, ' / ')
                               .toLowerCase()
                               .replace(/\b\w/g, c => c.toUpperCase());
        } else {
            // Title case the ID based label
            labelStr = labelStr.toLowerCase().replace(/\b\w/g, c => c.toUpperCase());
        }

        const fieldId   = span.id;
        const lLower    = labelStr.toLowerCase();

        // Pre-fill logic
        let prefill = '';
        if (lLower.includes('nama lengkap') || lLower === 'nama warga' || lLower === 'nama pelapor' || lLower === 'nama penjamin')
            prefill = userDefaults.nama;
        if (lLower.includes('alamat') && !lLower.includes('calon') && !lLower.includes('tinggal') && !lLower.includes('penjamin'))
            prefill = userDefaults.alamat;

        // Row wrapper
        const row   = document.createElement('div');
        row.className = 'form-field-row px-2 py-2 transition-colors';

        // Label
        const lbl   = document.createElement('label');
        lbl.className = 'block text-[10px] font-bold uppercase tracking-wider text-gray-500 mb-1';
        lbl.textContent = labelStr;
        row.appendChild(lbl);

        // Determine input type
        const isTextarea = lLower.includes('alamat') || lLower.includes('perihal') ||
                           lLower.includes('keterangan') || lLower.includes('isi pernyataan');
        // Hanya jadikan type="date" jika benar-benar HANYA meminta tanggal (tidak meminta Tempat)
        const isDate = lLower.includes('tanggal') && !lLower.includes('hari') && !lLower.includes('tempat');

        let input;
        if (isTextarea) {
            input = document.createElement('textarea');
            input.rows = 2;
            input.className = 'w-full px-3 py-2 rounded-lg border border-gray-200 bg-gray-50 focus:bg-white focus:border-[#00685d] focus:ring-1 focus:ring-[#00685d]/20 text-sm transition-all resize-none';
        } else if (isDate) {
            input = document.createElement('input');
            input.type = 'date';
            input.className = 'w-full px-3 py-2 rounded-lg border border-gray-200 bg-gray-50 focus:bg-white focus:border-[#00685d] focus:ring-1 focus:ring-[#00685d]/20 text-sm transition-all';
        } else {
            input = document.createElement('input');
            input.type = 'text';
            input.className = 'w-full px-3 py-2 rounded-lg border border-gray-200 bg-gray-50 focus:bg-white focus:border-[#00685d] focus:ring-1 focus:ring-[#00685d]/20 text-sm transition-all';
            input.placeholder = 'Ketik ' + labelStr.toLowerCase() + '...';
        }
        input.name     = fieldId;
        input.required = !lLower.includes('keterangan tambahan') && !lLower.includes('catatan');

        // Pre-fill if applicable
        if (prefill) {
            input.value = prefill;
            span.textContent = prefill;
            span.classList.add('filled');
            span.classList.remove('field-placeholder');
        }

        // Live-update preview
        const updatePreview = () => {
            const val = (input.value || '').trim();
            if (val === '') {
                span.textContent = origText;
                span.classList.remove('filled');
                span.classList.add('field-placeholder');
            } else {
                span.textContent = val;
                span.classList.add('filled');
                span.classList.remove('field-placeholder');
            }
        };

        // Focus sync: highlight row AND span in letter
        input.addEventListener('focus', () => {
            row.classList.add('highlighted');
            span.style.background = 'rgba(0,104,93,0.08)';
            span.style.borderBottom = '2px solid #00685d';
        });
        input.addEventListener('blur', () => {
            row.classList.remove('highlighted');
            span.style.background = '';
            span.style.borderBottom = '';
        });
        input.addEventListener('input', updatePreview);
        if (isDate) input.addEventListener('change', updatePreview);

        row.appendChild(input);
        formPanel.appendChild(row);

        // Create matching hidden input for form submission
        const hidden = document.createElement('input');
        hidden.type  = 'hidden';
        hidden.name  = fieldId;
        hidden.id    = 'hidden_' + fieldId;
        if (prefill) hidden.value = prefill;
        hiddenContainer.appendChild(hidden);

        // Sync hidden on input
        input.addEventListener('input', () => { hidden.value = input.value; });
        if (isDate) input.addEventListener('change', () => { hidden.value = input.value; });
    });

    // ── Set today's date into tanggal_ttd span ───────────────────────────────
    const dateSpan = previewContainer.querySelector('#field_tanggal_ttd');
    if (dateSpan) {
        const today = new Date();
        const opts = { day: 'numeric', month: 'long', year: 'numeric' };
        dateSpan.textContent = today.toLocaleDateString('id-ID', opts);
        dateSpan.classList.add('filled');
    }

    // ── On submit: remove duplicate non-hidden named inputs & capture konten ──
    document.getElementById('pengajuan-form').addEventListener('submit', function () {
        // Capture the final HTML of the preview container exactly as it appears
        let finalHtml = previewContainer.innerHTML;
        
        // Remove any highlighted styles to ensure clean PDF
        finalHtml = finalHtml.replace(/background:\s*rgba\([^)]+\);?/g, '');
        finalHtml = finalHtml.replace(/border-bottom:\s*[^;]+;?/g, '');
        
        const htmlInput = document.createElement('input');
        htmlInput.type = 'hidden';
        htmlInput.name = '_html_final';
        htmlInput.value = finalHtml;
        this.appendChild(htmlInput);

        // Disable visible inputs so only hidden ones submit (avoiding duplicate keys)
        formPanel.querySelectorAll('input:not([type="hidden"]), textarea').forEach(el => {
            el.removeAttribute('name');
        });
    });
});
</script>
@endpush
