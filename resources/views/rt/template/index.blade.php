@extends('layouts.app')

@section('title', 'Template Surat')
@section('breadcrumb-parent', 'RT')
@section('breadcrumb-current', 'Template Surat')

@section('content')

    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="font-manrope font-bold text-2xl" style="color:#191c1e;">Manajemen Template Surat</h1>
            <p class="text-sm mt-1" style="color:#6d7a77;">Kelola 12 template surat. Edit konten, duplikat untuk buat yang baru, atau hapus jika tidak diperlukan.</p>
        </div>
        <a href="{{ route('template.create') }}"
                class="inline-flex items-center gap-2 text-white font-semibold px-5 py-2.5 rounded-xl text-sm hover:shadow-md transition-all"
                style="background:linear-gradient(135deg,#00685d,#008376);">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Buat Template Baru
        </a>
    </div>

    @if(session('success'))
    <div class="mb-6 p-4 rounded-xl text-sm" style="background:#e8f5e9;color:#1b5e20;">{{ session('success') }}</div>
    @endif

    <div class="rounded-[1.5rem] p-5 mb-8 flex items-start gap-4" style="background-color:#eceef0;">
        <div class="w-9 h-9 rounded-xl flex items-center justify-center flex-shrink-0" style="background:rgba(43,100,133,0.12);">
            <span class="material-icons-outlined text-lg" style="color:#2b6485;">info</span>
        </div>
        <div>
            <p class="text-sm font-semibold" style="color:#191c1e;">Alur Template PDF</p>
            <p class="text-xs mt-0.5" style="color:#6d7a77;">1) RT upload PDF → 2) Warga pilih template & isi field di browser → 3) PDF terisi dikirim ke RT → 4) RT verifikasi & setujui.</p>
        </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($templates as $tmpl)
        <div class="bg-white rounded-[1.5rem] p-6 ambient-lift flex flex-col">
            <div class="w-12 h-12 rounded-2xl flex items-center justify-center mb-4" style="background:rgba(0,104,93,0.10);">
                <span class="material-icons-outlined text-xl" style="color:#00685d;">picture_as_pdf</span>
            </div>
            <h3 class="font-manrope font-bold text-base mb-1" style="color:#191c1e;">{{ $tmpl->nama_surat }}</h3>
            <p class="text-xs mb-1" style="color:#6d7a77;">{{ $tmpl->jenis_surat }}</p>
            <p class="text-xs mb-4 flex-1 truncate" style="color:#bcc9c6;">{{ $tmpl->file_name ?? 'Belum ada file' }}</p>
            <div class="flex gap-2 flex-wrap mt-auto">
                <button type="button" onclick="openPdfViewer('{{ route('template.preview', $tmpl->id) }}', '{{ addslashes($tmpl->nama_surat) }}')"
                   class="flex-1 text-center px-3 py-2 rounded-xl text-xs font-semibold text-white cursor-pointer" style="background:#2b6485;">Lihat Preview</button>
                <a href="{{ route('template.edit', $tmpl->id) }}"
                   class="flex-1 text-center px-3 py-2 rounded-xl text-xs font-semibold" style="background-color:#eceef0;color:#3d4947;">Edit</a>
                <form action="{{ route('template.destroy', $tmpl->id) }}" method="POST" onsubmit="return confirm('Hapus template ini?')">
                    @csrf @method('DELETE')
                    <button type="submit" class="px-3 py-2 rounded-xl text-xs font-semibold" style="background:#ffdad6;color:#93000a;">Hapus</button>
                </form>
            </div>
        </div>
        @empty
        <div class="col-span-3 text-center py-12">
            <p class="text-sm" style="color:#6d7a77;">Belum ada template. Klik <strong>Upload Template PDF</strong>.</p>
        </div>
        @endforelse
    </div>

    {{-- MODAL PREVIEW --}}
    <div id="pdf-viewer-modal" class="fixed inset-0 z-50 hidden items-center justify-center p-4 sm:p-6"
         style="background-color: rgba(25,28,30,0.6); backdrop-filter: blur(4px); overflow-y: auto;">
        
        <div class="w-full max-w-4xl bg-white rounded-[1.5rem] shadow-2xl overflow-hidden my-auto flex flex-col transition-all" style="max-height: 90vh;">
            
            {{-- HEADER --}}
            <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100 shrink-0 bg-white">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl flex items-center justify-center" style="background: rgba(0,104,93,0.1);">
                        <span class="material-icons-outlined text-xl" style="color: #00685d;">visibility</span>
                    </div>
                    <div>
                        <h2 class="font-manrope font-bold text-base" style="color:#191c1e;" id="pdf-modal-title">Pratinjau Surat</h2>
                        <p class="text-xs" style="color:#6d7a77;">Tampilan struktur asli HTML template</p>
                    </div>
                </div>
                <button onclick="closePdfViewer()" class="w-9 h-9 rounded-xl flex items-center justify-center hover:bg-gray-100 transition-colors">
                    <span class="material-icons-outlined" style="color:#6d7a77;">close</span>
                </button>
            </div>
            
            {{-- BODY (IFRAME) --}}
            <div class="relative flex-1 w-full bg-gray-50 p-0 m-0" style="overflow: hidden; min-height: 60vh;">
                <iframe id="pdf-iframe" src="" class="absolute inset-0 w-full h-full border-0" title="PDF Viewer"></iframe>
            </div>

            {{-- FOOTER --}}
            <div class="px-6 py-4 border-t border-gray-100 bg-white flex justify-end shrink-0">
                <button onclick="closePdfViewer()" class="px-6 py-2.5 rounded-xl text-sm font-semibold" style="background-color: #eceef0; color: #3d4947;">
                    Tutup Preview
                </button>
            </div>
            
        </div>
    </div>

@endsection

@push('scripts')
<script>
function openPdfViewer(url, title) {
    document.getElementById('pdf-modal-title').textContent = title;
    document.getElementById('pdf-iframe').src = url;
    const m = document.getElementById('pdf-viewer-modal');
    m.classList.remove('hidden');
    m.classList.add('flex');
    document.body.style.overflow = 'hidden';
}
function closePdfViewer() {
    const m = document.getElementById('pdf-viewer-modal');
    m.classList.add('hidden');
    m.classList.remove('flex');
    document.getElementById('pdf-iframe').src = '';
    document.body.style.overflow = '';
}
document.getElementById('pdf-viewer-modal').addEventListener('click', function(e) {
    if(e.target === this) closePdfViewer();
});
document.addEventListener('keydown', e => { if(e.key === 'Escape') closePdfViewer(); });
</script>
@endpush
