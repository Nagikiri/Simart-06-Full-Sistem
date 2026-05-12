<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" style="background-color: #f7f9fb;">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'SIMART-06') - Sistem Manajemen RT 06</title>

    {{-- Fonts: Manrope (Headline) + Inter (Body) — Civic Curator Design System --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">

    {{-- Scripts --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* Civic Curator — Shared Dashboard Utilities */
        .btn-civic-gradient {
            background: linear-gradient(135deg, #00685d 0%, #008376 100%);
        }
        .btn-civic-gradient:hover {
            background: linear-gradient(135deg, #005048 0%, #00685d 100%);
        }
        .ambient-lift {
            transition: box-shadow 0.3s ease, transform 0.3s ease;
        }
        .ambient-lift:hover {
            box-shadow: 0px 12px 32px rgba(25, 28, 30, 0.06);
            transform: translateY(-2px);
        }
        /* No-Divider table rows — Civic Curator rule */
        .civic-table tbody tr {
            border: none;
        }
        .civic-table tbody tr:hover {
            background-color: #f2f4f6;
        }
    </style>
    @stack('styles')
</head>
<body class="font-inter antialiased" style="background-color: #f7f9fb; color: #191c1e;">
    <div class="flex h-screen overflow-hidden">
        {{-- Sidebar --}}
        @auth
            @if(auth()->user()->role === 'warga')
                @include('components.sidebar-warga')
            @elseif(auth()->user()->role === 'rt')
                @include('components.sidebar-rt')
            @endif
        @endauth

        {{-- Main Content Area --}}
        <div class="flex-1 flex flex-col overflow-hidden">
            {{-- Navbar --}}
            @include('components.navbar')

            {{-- Page Content --}}
            <main class="flex-1 overflow-y-auto">
                <div class="max-w-7xl mx-auto px-6 lg:px-8 py-8">
                    @yield('content')
                </div>
            </main>

            {{-- Footer --}}
            @include('components.footer')
        </div>
    </div>

    @stack('scripts')
</body>
</html>
