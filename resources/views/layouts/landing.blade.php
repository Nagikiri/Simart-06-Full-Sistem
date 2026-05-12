<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" style="background-color: #f7f9fb;">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="SIMART-06 — Sistem Manajemen RT digital. Ajukan surat, lacak pengajuan, dan kelola administrasi lingkungan secara online.">

    <title>@yield('title', 'SIMART-06 | Sistem Manajemen RT')</title>

    {{-- Fonts: Manrope (Headline) + Inter (Body) --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* ===== Civic Curator — Landing Page Utilities ===== */

        /* Smooth scrolling */
        html { scroll-behavior: smooth; }

        /* Signature gradient for primary CTA */
        .btn-civic-gradient {
            background: linear-gradient(135deg, #00685d 0%, #008376 100%);
        }
        .btn-civic-gradient:hover {
            background: linear-gradient(135deg, #005048 0%, #00685d 100%);
        }

        /* Glassmorphism navbar */
        .glass-nav {
            background: rgba(255, 255, 255, 0.80);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
        }

        /* Ghost border for inputs */
        .ghost-border {
            border: 1px solid rgba(188, 201, 198, 0.15);
        }

        /* Ambient lift on hover */
        .ambient-lift {
            transition: box-shadow 0.3s ease, transform 0.3s ease;
        }
        .ambient-lift:hover {
            box-shadow: 0px 12px 32px rgba(25, 28, 30, 0.06);
            transform: translateY(-4px);
        }

        /* Subtle entrance animation */
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(24px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in-up {
            animation: fadeInUp 0.7s ease-out forwards;
        }
        .animation-delay-100 { animation-delay: 0.1s; }
        .animation-delay-200 { animation-delay: 0.2s; }
        .animation-delay-300 { animation-delay: 0.3s; }
        .animation-delay-400 { animation-delay: 0.4s; }

        /* Floating badge pulse */
        @keyframes pulse-subtle {
            0%, 100% { opacity: 1; }
            50%      { opacity: 0.7; }
        }
        .pulse-subtle {
            animation: pulse-subtle 3s ease-in-out infinite;
        }
    </style>
    @stack('styles')
</head>

<body class="font-inter antialiased text-civic-on-surface" style="background-color: #f7f9fb;">

    {{-- Navigation --}}
    <x-navbar-landing />

    {{-- Page Content --}}
    @yield('content')

    {{-- Footer --}}
    <x-footer-landing />

    {{-- Scripts --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const btn  = document.getElementById('mobileMenuBtn');
            const menu = document.getElementById('mobileMenu');
            if (btn && menu) {
                btn.addEventListener('click', () => menu.classList.toggle('hidden'));
            }

            // Close mobile menu when a link is clicked
            menu?.querySelectorAll('a').forEach(link => {
                link.addEventListener('click', () => menu.classList.add('hidden'));
            });

            // Navbar background opacity on scroll
            const nav = document.getElementById('mainNav');
            window.addEventListener('scroll', () => {
                if (window.scrollY > 20) {
                    nav.classList.add('shadow-soft');
                } else {
                    nav.classList.remove('shadow-soft');
                }
            });
        });
    </script>
    @stack('scripts')
</body>
</html>
