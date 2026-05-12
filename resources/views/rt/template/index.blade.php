@extends('layouts.app')

@section('title', 'Template Surat')

@section('content')
<div class="py-8">
    <div class="max-w-6xl mx-auto">
        <h1 class="text-3xl font-bold text-gray-900 mb-8">Template Surat</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-teal-500">
                <h3 class="font-bold text-gray-900">Surat Domisili</h3>
                <p class="text-gray-600 text-sm mt-2">Template untuk surat keterangan domisili</p>
                <div class="mt-4 flex gap-2">
                    <a href="#" class="bg-blue-600 text-white px-4 py-2 rounded text-sm">Edit</a>
                    <a href="#" class="bg-gray-300 text-gray-700 px-4 py-2 rounded text-sm">Hapus</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
