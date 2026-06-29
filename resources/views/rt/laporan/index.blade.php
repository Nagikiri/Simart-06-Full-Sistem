@extends('layouts.app')

@section('title', 'Laporan & Statistik')
@section('breadcrumb-parent', 'RT')
@section('breadcrumb-current', 'Laporan')

@section('content')
<div class="mb-8 flex items-center justify-between">
    <div>
        <h1 class="font-manrope font-bold text-2xl lg:text-3xl text-gray-900 mb-1">Statistik Pengajuan</h1>
        <p class="text-sm text-gray-500">Pantau aktivitas dan status pengajuan surat warga secara real-time.</p>
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    {{-- Total Pengajuan --}}
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex flex-col justify-between hover:shadow-md transition-shadow">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 rounded-full flex items-center justify-center bg-blue-50 text-blue-600">
                <span class="material-icons-outlined text-2xl">description</span>
            </div>
            <span class="text-xs font-semibold text-blue-600 bg-blue-100 px-2 py-1 rounded-full">Total</span>
        </div>
        <div>
            <h3 class="text-3xl font-bold text-gray-900">{{ $data['totalPengajuan'] }}</h3>
            <p class="text-sm text-gray-500 mt-1">Total Pengajuan</p>
        </div>
    </div>

    {{-- Pending --}}
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex flex-col justify-between hover:shadow-md transition-shadow">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 rounded-full flex items-center justify-center bg-yellow-50 text-yellow-600">
                <span class="material-icons-outlined text-2xl">hourglass_empty</span>
            </div>
            <span class="text-xs font-semibold text-yellow-600 bg-yellow-100 px-2 py-1 rounded-full">Menunggu</span>
        </div>
        <div>
            <h3 class="text-3xl font-bold text-gray-900">{{ $data['pending'] }}</h3>
            <p class="text-sm text-gray-500 mt-1">Pending (Belum Diproses)</p>
        </div>
    </div>

    {{-- Selesai --}}
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex flex-col justify-between hover:shadow-md transition-shadow">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 rounded-full flex items-center justify-center bg-green-50 text-green-600">
                <span class="material-icons-outlined text-2xl">check_circle</span>
            </div>
            <span class="text-xs font-semibold text-green-600 bg-green-100 px-2 py-1 rounded-full">Selesai</span>
        </div>
        <div>
            <h3 class="text-3xl font-bold text-gray-900">{{ $data['selesai'] }}</h3>
            <p class="text-sm text-gray-500 mt-1">Surat Disetujui</p>
        </div>
    </div>

    {{-- Ditolak --}}
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex flex-col justify-between hover:shadow-md transition-shadow">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 rounded-full flex items-center justify-center bg-red-50 text-red-600">
                <span class="material-icons-outlined text-2xl">cancel</span>
            </div>
            <span class="text-xs font-semibold text-red-600 bg-red-100 px-2 py-1 rounded-full">Ditolak</span>
        </div>
        <div>
            <h3 class="text-3xl font-bold text-gray-900">{{ $data['ditolak'] }}</h3>
            <p class="text-sm text-gray-500 mt-1">Surat Ditolak</p>
        </div>
    </div>
</div>

<div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 glass-card ambient-lift">
    <h2 class="text-lg font-bold text-gray-900 mb-4 flex items-center gap-2">
        <span class="material-icons-outlined text-[#00685d]">pie_chart</span>
        Ringkasan Keseluruhan
    </h2>
    <div class="w-full bg-gray-100 rounded-full h-4 mb-4 overflow-hidden flex shadow-inner">
        @if($data['totalPengajuan'] > 0)
            <div class="bg-green-500 h-4 transition-all duration-1000" style="width: {{ ($data['selesai'] / $data['totalPengajuan']) * 100 }}%" title="Selesai"></div>
            <div class="bg-yellow-400 h-4 transition-all duration-1000" style="width: {{ ($data['pending'] / $data['totalPengajuan']) * 100 }}%" title="Menunggu"></div>
            <div class="bg-red-500 h-4 transition-all duration-1000" style="width: {{ ($data['ditolak'] / $data['totalPengajuan']) * 100 }}%" title="Ditolak"></div>
        @else
            <div class="bg-gray-200 h-4 w-full"></div>
        @endif
    </div>
    <div class="flex flex-wrap justify-between md:justify-start gap-6 text-sm mt-4 font-semibold text-gray-700">
        <div class="flex items-center gap-2"><span class="w-3.5 h-3.5 rounded-full bg-green-500 shadow-sm"></span>Selesai</div>
        <div class="flex items-center gap-2"><span class="w-3.5 h-3.5 rounded-full bg-yellow-400 shadow-sm"></span>Menunggu</div>
        <div class="flex items-center gap-2"><span class="w-3.5 h-3.5 rounded-full bg-red-500 shadow-sm"></span>Ditolak</div>
    </div>
</div>
@endsection
