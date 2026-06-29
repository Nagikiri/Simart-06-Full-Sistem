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

    {{-- Modal dihapus, diganti window.open --}}

@endsection

@push('scripts')
<script>
function openPdfViewer(url, title) {
    const w = 800;
    const h = 800;
    const left = (screen.width/2)-(w/2);
    const top = (screen.height/2)-(h/2);
    window.open(url, 'Preview', 'width='+w+',height='+h+',top='+top+',left='+left+',toolbar=no,menubar=no,scrollbars=yes,resizable=yes');
}
// Listeners removed as modal is removed
</script>
@endpush
