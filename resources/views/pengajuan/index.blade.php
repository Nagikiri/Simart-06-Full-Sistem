@extends('layouts.app')

@section('title', 'Pilih Jenis Surat')
@section('breadcrumb-parent', 'Warga')
@section('breadcrumb-current', 'Pengajuan Surat')

@section('content')
    <div class="mb-8">
        <h1 class="font-manrope font-bold text-2xl lg:text-3xl mb-2" style="color: #191c1e;">Pilih Jenis Surat</h1>
        <p class="text-sm" style="color: #6d7a77;">Pilih layanan surat pengantar yang Anda butuhkan.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($templates as $template)
            <a href="{{ route('pengajuan.create', ['template' => $template->id]) }}" class="block bg-white rounded-xl p-6 shadow-sm hover:shadow-md transition-all hover:-translate-y-1 border border-gray-100">
                <div class="w-12 h-12 rounded-full mb-4 flex items-center justify-center" style="background: linear-gradient(135deg, rgba(0,104,93,0.1), rgba(0,104,93,0.04));">
                    <span class="material-icons-outlined text-2xl" style="color: #00685d;">
                        @if(str_contains(strtolower($template->nama_surat), 'ktp')) badge
                        @elseif(str_contains(strtolower($template->nama_surat), 'kematian')) sentiment_very_dissatisfied
                        @elseif(str_contains(strtolower($template->nama_surat), 'domisili')) location_on
                        @else description
                        @endif
                    </span>
                </div>
                <h3 class="font-bold text-lg mb-2 text-gray-900">{{ $template->nama_surat }}</h3>
                <p class="text-sm text-gray-500">Klik untuk mulai mengisi formulir pengajuan surat ini secara digital tanpa perlu mengunduh dokumen.</p>
            </a>
        @empty
            <div class="col-span-full py-12 text-center bg-white rounded-xl border border-dashed border-gray-200">
                <span class="material-icons-outlined text-4xl mb-3 text-gray-400">inventory_2</span>
                <p class="text-gray-600 font-semibold">Belum ada template surat yang tersedia.</p>
            </div>
        @endforelse
    </div>
@endsection
