@extends('layouts.app')

@section('title', 'Profil RT')

@section('content')
<div class="py-8">
    <div class="max-w-4xl mx-auto">
        <h1 class="text-3xl font-bold text-gray-900 mb-8">Profil RT Admin</h1>

        <div class="bg-white rounded-lg shadow-md p-8">
            <div class="space-y-4">
                <div class="py-3 border-b">
                    <p class="text-sm text-gray-600">Nama</p>
                    <p class="text-lg font-semibold text-gray-900">{{ Auth::user()->name }}</p>
                </div>
                <div class="py-3 border-b">
                    <p class="text-sm text-gray-600">Email</p>
                    <p class="text-lg font-semibold text-gray-900">{{ Auth::user()->email }}</p>
                </div>
                <div class="py-3">
                    <p class="text-sm text-gray-600">Role</p>
                    <p class="text-lg font-semibold text-gray-900">{{ Auth::user()->role }}</p>
                </div>
            </div>

            <div class="mt-8">
                <a href="{{ route('profile.edit') }}" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700">Edit Profil</a>
            </div>
        </div>
    </div>
</div>
@endsection
