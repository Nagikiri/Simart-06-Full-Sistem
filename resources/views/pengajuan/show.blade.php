@extends('layouts.app')

@section('title', 'Detail Pengajuan')

@section('content')
<div class="max-w-3xl mx-auto">
    <a href="{{ route('pengajuan.index') }}" class="text-sm font-semibold mb-4 inline-block" style="color:#00685d;">← Kembali</a>
    <h1 class="font-manrope font-bold text-2xl mb-2" style="color:#191c1e;">Detail Pengajuan #{{ $pengajuan->id_pengajuan }}</h1>
    <p class="text-sm mb-6" style="color:#6d7a77;">{{ ucwords(str_replace('_',' ',$pengajuan->jenis_surat)) }} — {{ $pengajuan->tanggal_pengajuan }}</p>

    <div class="bg-white rounded-[1.5rem] p-6 mb-6">
        <p class="text-xs mb-2" style="color:#6d7a77;">Status</p>
        @php
            $styles = [
                'pending' => ['bg'=>'#c7e7ff','color'=>'#064c6b','label'=>'Menunggu RT'],
                'selesai' => ['bg'=>'#e8f5e9','color'=>'#1b5e20','label'=>'Selesai'],
                'ditolak' => ['bg'=>'#ffdad6','color'=>'#93000a','label'=>'Ditolak'],
            ];
            $s = $styles[$pengajuan->status] ?? $styles['pending'];
        @endphp
        <span class="px-3 py-1 rounded-full text-xs font-semibold" style="background:{{ $s['bg'] }};color:{{ $s['color'] }};">{{ $s['label'] }}</span>
        @if($pengajuan->catatan)
        <p class="text-sm mt-4 p-3 rounded-xl" style="background:#ffdad6;color:#93000a;">Catatan RT: {{ $pengajuan->catatan }}</p>
        @endif
    </div>

    @if($pengajuan->file_dokumen)
    <div class="bg-white rounded-[1.5rem] p-6">
        <h2 class="font-manrope font-bold text-sm mb-4">Surat PDF Anda</h2>
        <a href="{{ route('pengajuan.download', $pengajuan) }}" class="inline-flex px-4 py-2 rounded-xl text-sm font-semibold text-white" style="background:#00685d;">Unduh PDF</a>
        @if($pengajuan->status === 'pending')
        <a href="{{ route('pengajuan.edit', $pengajuan) }}" class="inline-flex ml-2 px-4 py-2 rounded-xl text-sm font-semibold" style="background:#eceef0;color:#3d4947;">Edit & Kirim Ulang</a>
        @endif
    </div>
    @endif
</div>
@endsection
