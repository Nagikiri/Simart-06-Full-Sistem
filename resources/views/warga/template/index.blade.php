@extends('layouts.app')

@section('title', 'Template Surat')
@section('breadcrumb-parent', 'Warga')
@section('breadcrumb-current', 'Template Surat')

@section('content')

    {{-- HEADER --}}
    <div class="mb-8">
        <h1 class="font-manrope font-bold text-2xl" style="color: #191c1e;">Template Surat</h1>
        <p class="text-sm mt-1" style="color: #3d4947;">Download template, isi secara mandiri, lalu upload saat membuat pengajuan.</p>
    </div>

    {{-- ALUR PANDUAN --}}
    <div class="bg-white rounded-[1.5rem] p-6 mb-8">
        <h2 class="font-manrope font-bold text-sm mb-4" style="color: #191c1e;">Cara Mengajukan Surat</h2>
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            <div class="flex items-start gap-3">
                <div class="w-8 h-8 rounded-full flex items-center justify-center flex-shrink-0 text-sm font-bold text-white"
                     style="background: linear-gradient(135deg, #00685d, #008376);">1</div>
                <div>
                    <p class="text-sm font-semibold" style="color: #191c1e;">Download Template</p>
                    <p class="text-xs mt-0.5" style="color: #6d7a77;">Unduh template surat yang sesuai kebutuhan Anda.</p>
                </div>
            </div>
            <div class="flex items-start gap-3">
                <div class="w-8 h-8 rounded-full flex items-center justify-center flex-shrink-0 text-sm font-bold text-white"
                     style="background: linear-gradient(135deg, #2b6485, #3a82a8);">2</div>
                <div>
                    <p class="text-sm font-semibold" style="color: #191c1e;">Isi & Lengkapi</p>
                    <p class="text-xs mt-0.5" style="color: #6d7a77;">Isi data diri sesuai kebutuhan, pastikan informasi akurat.</p>
                </div>
            </div>
            <div class="flex items-start gap-3">
                <div class="w-8 h-8 rounded-full flex items-center justify-center flex-shrink-0 text-sm font-bold text-white"
                     style="background: linear-gradient(135deg, #416538, #5a8a4f);">3</div>
                <div>
                    <p class="text-sm font-semibold" style="color: #191c1e;">Upload & Ajukan</p>
                    <p class="text-xs mt-0.5" style="color: #6d7a77;">Upload surat yang sudah diisi saat membuat pengajuan baru.</p>
                </div>
            </div>
        </div>
    </div>

    {{-- TEMPLATE GRID --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($templates as $tmpl)
        <div class="bg-white rounded-[1.5rem] p-6 ambient-lift flex flex-col">
            <div class="w-12 h-12 rounded-2xl flex items-center justify-center mb-4"
                 style="background: linear-gradient(135deg, rgba(0,104,93,0.10), rgba(0,104,93,0.04));">
                <span class="material-icons-outlined text-xl" style="color: #00685d;">description</span>
            </div>
            <h3 class="font-manrope font-bold text-base mb-1" style="color: #191c1e;">{{ $tmpl->nama_surat }}</h3>
            <p class="text-xs mb-4 flex-1" style="color: #6d7a77;">{{ $tmpl->jenis_surat }}</p>
            <div class="flex gap-2 mt-auto">
                <a href="{{ route('template.file', $tmpl->id) }}"
                   class="flex-1 inline-flex items-center justify-center gap-1.5 px-3 py-2 rounded-xl text-xs font-semibold text-white transition-all hover:shadow-md"
                   style="background: linear-gradient(135deg, #00685d, #008376);">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                    </svg>
                    Download
                </a>
                <button type="button" onclick="openPdfViewer('{{ route('warga.template.preview', $tmpl->id) }}')"
                        class="px-3 py-2 rounded-xl text-xs font-semibold transition-colors hover:bg-[#00685d] hover:text-white"
                        style="background-color: #eceef0; color: #3d4947;">Preview</button>
            </div>
        </div>
        @empty
        <div class="col-span-3 text-center py-12">
            <p class="text-sm" style="color:#6d7a77;">Belum ada template yang tersedia dari RT.</p>
        </div>
        @endforelse
    </div>

@push('scripts')
<script>
function openPdfViewer(url) {
    const w = 800;
    const h = 800;
    const left = (screen.width/2)-(w/2);
    const top = (screen.height/2)-(h/2);
    window.open(url, 'Preview', 'width='+w+',height='+h+',top='+top+',left='+left+',toolbar=no,menubar=no,scrollbars=yes,resizable=yes');
}
</script>
@endpush

@endsection
