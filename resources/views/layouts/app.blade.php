<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" style="background-color: #f7f9fb;">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'SIMART-06') - Sistem Manajemen RT 06</title>

    {{-- Fonts: Plus Jakarta Sans for a premium modern startup look --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">

    {{-- Scripts --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* Modern Startup Design System */
        :root {
            --primary: #00685d;
            --primary-hover: #005048;
            --gradient-start: #00685d;
            --gradient-end: #008376;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #f7f9fb;
            color: #191c1e;
        }

        h1, h2, h3, h4, h5, h6, .font-manrope {
            font-family: 'Plus Jakarta Sans', sans-serif;
            letter-spacing: -0.02em;
        }

        /* 1. Page Transition Fade-In */
        .page-fade-in {
            animation: fadeInPage 0.4s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }
        @keyframes fadeInPage {
            0% { opacity: 0; transform: translateY(8px); }
            100% { opacity: 1; transform: translateY(0); }
        }

        /* 2. Glassmorphism & Drop Shadow / Ambient Lift */
        .glass-card {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
        }
        
        .ambient-lift {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .ambient-lift:hover {
            box-shadow: 0px 12px 32px rgba(25, 28, 30, 0.08);
            transform: translateY(-3px);
        }

        .btn-civic-gradient {
            background: linear-gradient(135deg, var(--gradient-start) 0%, var(--gradient-end) 100%);
            transition: all 0.3s ease;
        }
        .btn-civic-gradient:hover {
            box-shadow: 0 10px 20px -10px rgba(0, 104, 93, 0.5);
            transform: translateY(-2px);
        }

        /* 3. Global Loading Overlay */
        #global-loader {
            position: fixed;
            inset: 0;
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(4px);
            z-index: 9999;
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }
        #global-loader.active {
            opacity: 1;
            visibility: visible;
        }
        .loader-spinner {
            width: 48px;
            height: 48px;
            border: 4px solid rgba(0, 104, 93, 0.2);
            border-top-color: #00685d;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }
        @keyframes spin { 100% { transform: rotate(360deg); } }

        /* No-Divider table rows */
        .civic-table tbody tr { border: none; transition: background-color 0.2s ease; }
        .civic-table tbody tr:hover { background-color: #f2f4f6; }
    </style>
    @stack('styles')
</head>
<body class="antialiased">

    {{-- Global Loading Overlay --}}
    <div id="global-loader">
        <div class="flex flex-col items-center gap-3">
            <div class="loader-spinner"></div>
            <p class="text-sm font-semibold text-[#00685d]">Memproses...</p>
        </div>
    </div>
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
            <main class="flex-1 overflow-y-auto page-fade-in">
                <div class="max-w-7xl mx-auto px-6 lg:px-8 py-8">
                    @yield('content')
                </div>
            </main>

            {{-- Footer --}}
            @include('components.footer')
        </div>
    </div>

    <script>
        // Global loading overlay trigger for form submissions
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('form').forEach(form => {
                form.addEventListener('submit', function(e) {
                    // Ignore search/filter forms if they use GET
                    if (this.method && this.method.toUpperCase() === 'GET') return;
                    document.getElementById('global-loader').classList.add('active');
                });
            });
        });
    </script>
    @stack('scripts')
</body>
</html>
