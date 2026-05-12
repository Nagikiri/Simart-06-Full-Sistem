@extends('layouts.app')

@section('title', 'Verifikasi Pengajuan')

@section('content')
<div class="py-8">
    <div class="max-w-6xl mx-auto">
        <h1 class="text-3xl font-bold text-gray-900 mb-8">Verifikasi Pengajuan</h1>

        <div class="bg-white rounded-lg shadow-md p-6">
            <table class="w-full">
                <thead>
                    <tr class="border-b">
                        <th class="px-4 py-2 text-left">Warga</th>
                        <th class="px-4 py-2 text-left">Jenis Surat</th>
                        <th class="px-4 py-2 text-left">Tanggal</th>
                        <th class="px-4 py-2 text-left">Status</th>
                        <th class="px-4 py-2 text-left">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-4 py-3">Budi Santoso</td>
                        <td class="px-4 py-3">Domisili</td>
                        <td class="px-4 py-3">10 Apr 2026</td>
                        <td class="px-4 py-3"><span class="bg-amber-100 text-amber-800 px-2 py-1 rounded text-sm">Menunggu</span></td>
                        <td class="px-4 py-3"><a href="#" class="text-blue-600 hover:text-blue-800 text-sm">Proses</a></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
