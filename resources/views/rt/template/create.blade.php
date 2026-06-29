@extends('layouts.app')

@section('title', 'Buat Template Surat')
@section('breadcrumb-parent', 'Template')
@section('breadcrumb-current', 'Buat Baru')

@push('styles')
<style>
    #html-textarea {
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
</style>
@endpush

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="font-manrope font-bold text-2xl" style="color:#191c1e;">Buat Template Surat Baru</h1>
            <p class="text-sm mt-1" style="color:#6d7a77;">Tempel kode HTML template surat. Gunakan <code class="bg-gray-100 px-1 rounded text-emerald-700 text-xs">field_nama</code> sebagai placeholder kolom isian warga.</p>
        </div>
        <a href="{{ route('template.index') }}" class="px-4 py-2 rounded-xl text-sm font-semibold" style="background:#eceef0;color:#3d4947;">Kembali</a>
    </div>

    @if ($errors->any())
    <div class="mb-6 rounded-xl p-4" style="background:#ffdad6;color:#93000a;">
        <ul class="text-sm space-y-1">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
    </div>
    @endif

    {{-- Panduan --}}
    <div class="rounded-xl p-4 mb-6" style="background:#f0faf8; border:1px solid #b2dfd8;">
        <p class="text-xs font-bold mb-2" style="color:#00685d;">💡 Cara Membuat Template Baru</p>
        <ol class="text-xs space-y-1" style="color:#3d4947;">
            <li><strong>1.</strong> Pergi ke halaman daftar Template → klik <strong>"Duplikat"</strong> pada template yang sudah ada (cara tercepat & paling aman!).</li>
            <li><strong>2.</strong> Atau tempel kode HTML surat yang kamu buat. Pastikan menggunakan <code class="bg-gray-100 px-1 rounded text-red-600">&lt;span id="field_nama_lengkap"&gt;&lt;/span&gt;</code> untuk kolom yang harus diisi Warga.</li>
            <li><strong>3.</strong> Lihat contoh di template yang sudah ada dengan menekan tombol "Edit" lalu pindah ke tab "Kode HTML".</li>
        </ol>
    </div>

    <form method="POST" action="{{ route('template.store') }}">
        @csrf
        <div class="bg-white rounded-[1.5rem] p-8 ambient-lift space-y-5">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label class="block text-xs font-semibold uppercase tracking-wider mb-2" style="color:#3d4947;">Kode Jenis Surat</label>
                    <input type="text" name="jenis_surat" value="{{ old('jenis_surat') }}" required placeholder="surat_domisili"
                           class="w-full px-4 py-3 rounded-xl text-sm" style="background:#f7f9fb;border:1.5px solid #e5e7eb;">
                    <p class="text-[11px] mt-1" style="color:#bcc9c6;">Huruf kecil + underscore. Contoh: <code>surat_usaha</code></p>
                </div>
                <div>
                    <label class="block text-xs font-semibold uppercase tracking-wider mb-2" style="color:#3d4947;">Nama Surat</label>
                    <input type="text" name="nama_surat" value="{{ old('nama_surat') }}" required placeholder="Surat Keterangan Domisili"
                           class="w-full px-4 py-3 rounded-xl text-sm" style="background:#f7f9fb;border:1.5px solid #e5e7eb;">
                </div>
            </div>

            <div>
                <label class="block text-xs font-semibold uppercase tracking-wider mb-2" style="color:#3d4947;">Kode HTML Template</label>
                <textarea name="content" id="html-textarea" placeholder="Tempel kode HTML template surat di sini...">{{ old('content') }}</textarea>
            </div>

            <button type="submit" class="w-full py-3.5 rounded-xl text-sm font-semibold text-white" style="background:linear-gradient(135deg,#00685d,#008376);">
                Simpan Template Surat
            </button>
        </div>
    </form>
</div>
@endsection
