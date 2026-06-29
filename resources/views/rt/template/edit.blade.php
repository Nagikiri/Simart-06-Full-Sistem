@extends('layouts.app')

@section('title', 'Edit Template Surat')
@section('breadcrumb-parent', 'Template')
@section('breadcrumb-current', 'Edit')

@push('styles')
<style>
    .tab-btn { padding: 0.5rem 1.25rem; border-radius: 0.75rem; font-size: 0.8rem; font-weight: 600; cursor: pointer; border: none; transition: all 0.2s; }
    .tab-btn.active { background: #00685d; color: #fff; }
    .tab-btn:not(.active) { background: #eceef0; color: #3d4947; }
    .tab-btn:not(.active):hover { background: #d8dbdd; }

    #html-panel textarea {
        font-family: 'Courier New', Courier, monospace;
        font-size: 13px;
        line-height: 1.6;
        background: #1e2229;
        color: #abb2bf;
        border: none;
        border-radius: 0.75rem;
        padding: 1rem;
        resize: vertical;
        width: 100%;
        min-height: 500px;
    }

    /* Preview panel — reset ke tampilan surat resmi */
    #preview-panel .surat-preview {
        background: #fff;
        padding: 2cm 2.5cm;
        min-height: 600px;
        font-family: 'Times New Roman', Times, serif;
        font-size: 13pt;
        line-height: 1.6;
        color: #000;
        box-shadow: 0 4px 24px rgba(0,0,0,0.08);
        border-radius: 0.5rem;
    }
    #preview-panel .surat-preview table { width: 100%; border-collapse: collapse; }
</style>
@endpush

@section('content')
<div class="max-w-5xl mx-auto">

    {{-- Header --}}
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="font-manrope font-bold text-2xl" style="color:#191c1e;">Edit Template Surat</h1>
            <p class="text-sm mt-1" style="color:#6d7a77;">{{ $template->nama_surat }} <span class="opacity-50">({{ $template->jenis_surat }})</span></p>
        </div>
        <div class="flex gap-2">
            <a href="{{ route('template.index') }}" class="px-4 py-2 rounded-xl text-sm font-semibold" style="background:#eceef0;color:#3d4947;">Kembali</a>
        </div>
    </div>

    @if($errors->any())
    <div class="mb-5 rounded-xl p-4" style="background:#ffdad6;color:#93000a;">
        <ul class="text-sm space-y-1">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
    </div>
    @endif

    <form method="POST" action="{{ route('template.update', $template->id) }}" id="edit-form">
        @csrf
        @method('PUT')

        <div class="bg-white rounded-[1.5rem] p-6 ambient-lift space-y-5">

            {{-- Nama Surat --}}
            <div>
                <label class="block text-xs font-semibold uppercase tracking-wider mb-2" style="color:#3d4947;">Nama Surat</label>
                <input type="text" name="nama_surat" value="{{ old('nama_surat', $template->nama_surat) }}" required
                       class="w-full px-4 py-3 rounded-xl text-sm" style="background:#f7f9fb;border:1.5px solid #e5e7eb;">
            </div>

            {{-- Tab Toggle --}}
            <div>
                <div class="flex items-center justify-between mb-3">
                    <label class="block text-xs font-semibold uppercase tracking-wider" style="color:#3d4947;">Isi Template</label>
                    <div class="flex gap-2 p-1 rounded-xl" style="background:#f2f4f6;">
                        <button type="button" class="tab-btn active" id="btn-preview" onclick="switchTab('preview')">
                            👁️ Tampilan Visual
                        </button>
                        <button type="button" class="tab-btn" id="btn-html" onclick="switchTab('html')">
                            &lt;/&gt; Kode HTML
                        </button>
                    </div>
                </div>

                {{-- Panel Visual Preview --}}
                <div id="preview-panel">
                    <div class="surat-preview">
                        {!! old('content', $template->content) !!}
                    </div>
                    <p class="text-xs mt-2 text-center" style="color:#bcc9c6;">Ini tampilan visual surat. Klik tab "Kode HTML" untuk mengedit.</p>
                </div>

                {{-- Panel HTML Editor (tersembunyi) --}}
                <div id="html-panel" class="hidden">
                    <div class="flex items-center justify-between mb-3">
                        <div class="rounded-xl p-3 text-xs flex-1 mr-3" style="background:#f0faf8; border: 1px solid #b2dfd8; color:#3d4947;">
                            💡 <strong>Cara mengedit:</strong> Ubah teks dalam tag HTML. Jangan hapus tag <code style="background:#e8f0ef;padding:1px 4px;border-radius:3px;">&lt;span id="field_..."&gt;</code>.
                        </div>
                        <a href="{{ route('template.duplicate', $template->id) }}"
                           class="inline-flex items-center gap-2 px-4 py-3 rounded-xl text-xs font-semibold whitespace-nowrap transition-all"
                           style="background:#e0f2fe;color:#0369a1;border:1px solid #bae6fd;">
                            <span class="material-icons-outlined text-sm">content_copy</span>
                            Duplikat Surat Ini
                        </a>
                    </div>
                    <textarea name="content" id="html-textarea" onkeyup="syncPreview()">{{ old('content', $template->content) }}</textarea>
                </div>
            </div>

            {{-- Actions --}}
            <div class="flex gap-3 pt-2">
                <button type="submit"
                        class="flex-1 py-3.5 rounded-xl text-sm font-semibold text-white"
                        style="background:linear-gradient(135deg,#00685d,#008376);">
                    Simpan Perubahan
                </button>
                <a href="{{ route('template.index') }}"
                   class="px-6 py-3.5 rounded-xl text-sm font-semibold text-center"
                   style="background:#eceef0;color:#3d4947;">Batal</a>
            </div>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
function switchTab(tab) {
    const previewPanel = document.getElementById('preview-panel');
    const htmlPanel    = document.getElementById('html-panel');
    const btnPreview   = document.getElementById('btn-preview');
    const btnHtml      = document.getElementById('btn-html');

    if (tab === 'preview') {
        // Sync preview dari textarea sebelum ditampilkan
        syncPreview();
        previewPanel.classList.remove('hidden');
        htmlPanel.classList.add('hidden');
        btnPreview.classList.add('active');
        btnHtml.classList.remove('active');
    } else {
        previewPanel.classList.add('hidden');
        htmlPanel.classList.remove('hidden');
        btnHtml.classList.add('active');
        btnPreview.classList.remove('active');
    }
}

function syncPreview() {
    const htmlContent = document.getElementById('html-textarea').value;
    const previewDiv = document.querySelector('#preview-panel .surat-preview');
    if (previewDiv) previewDiv.innerHTML = htmlContent;
}
</script>
@endpush
