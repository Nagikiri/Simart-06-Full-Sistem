@extends('layouts.app')

@section('title', 'Daftar Warga')

@section('content')
<div class="py-8">
    <div class="max-w-6xl mx-auto">
        <h1 class="text-3xl font-bold text-gray-900 mb-8">Daftar Warga</h1>

        <div class="bg-white rounded-lg shadow-md p-6">
            <table class="w-full">
                <thead>
                    <tr class="border-b">
                        <th class="px-4 py-2 text-left">Nama</th>
                        <th class="px-4 py-2 text-left">NIK</th>
                        <th class="px-4 py-2 text-left">Telepon</th>
                        <th class="px-4 py-2 text-left">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-4 py-3">Budi Santoso</td>
                        <td class="px-4 py-3">1234567890123456</td>
                        <td class="px-4 py-3">081234567890</td>
                        <td class="px-4 py-3"><span class="bg-green-100 text-green-800 px-2 py-1 rounded text-sm">Aktif</span></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
