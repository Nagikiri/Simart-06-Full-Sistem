<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" style="background-color: #f7f9fb;">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Masuk') — SIMART-06</title>

    {{-- Fonts: Manrope (Headline) + Inter (Body) — Civic Curator --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .btn-civic-gradient {
            background: linear-gradient(135deg, #00685d 0%, #008376 100%);
        }
        .btn-civic-gradient:hover {
            background: linear-gradient(135deg, #005048 0%, #00685d 100%);
        }
        /* Ghost border for inputs — Civic Curator */
        .civic-input {
            border: 1px solid rgba(188, 201, 198, 0.35);
            transition: all 0.2s ease;
        }
        .civic-input:focus {
            border-color: #00685d;
            box-shadow: 0 0 0 3px rgba(0, 104, 93, 0.08);
            outline: none;
        }
        .civic-input.is-error {
            border-color: #ba1a1a;
            box-shadow: 0 0 0 3px rgba(186, 26, 26, 0.06);
        }
    </style>
</head>
<body class="antialiased" style="font-family: 'Inter', sans-serif; background-color: #f7f9fb; color: #191c1e;">
    <div class="min-h-screen flex">
        {{ $slot }}
    </div>
</body>
</html>
