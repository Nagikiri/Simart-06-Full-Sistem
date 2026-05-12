{{-- Navigation Bar — Civic Curator: Minimal top header --}}
{{-- Rule: Keep it minimal: Breadcrumb and User Profile --}}
<nav class="sticky top-0 z-40 flex items-center justify-between px-6 lg:px-8 h-16" style="background-color: rgba(247,249,251,0.85); backdrop-filter: blur(16px); -webkit-backdrop-filter: blur(16px);">

    {{-- Left: Breadcrumb --}}
    <div class="flex items-center gap-2 text-sm">
        <span style="color: #6d7a77;">@yield('breadcrumb-parent', 'Dashboard')</span>
        @hasSection('breadcrumb-current')
            <svg class="w-4 h-4" style="color: #bcc9c6;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5l7 7-7 7"/>
            </svg>
            <span class="font-medium" style="color: #191c1e;">@yield('breadcrumb-current')</span>
        @endif
    </div>

    {{-- Right: User Profile --}}
    <div class="flex items-center gap-4">
        @auth
            {{-- Notification bell --}}
            <button class="relative p-2 rounded-lg transition-colors hover:bg-[#eceef0]">
                <svg class="w-5 h-5" style="color: #3d4947;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                </svg>
                {{-- Notification dot --}}
                <span class="absolute top-1.5 right-1.5 w-2 h-2 rounded-full" style="background-color: #ba1a1a;"></span>
            </button>

            {{-- User avatar + info --}}
            <div class="flex items-center gap-3">
                <div class="hidden sm:block text-right">
                    <p class="text-sm font-semibold" style="color: #191c1e;">{{ auth()->user()->name }}</p>
                    <p class="text-xs" style="color: #6d7a77;">{{ ucfirst(auth()->user()->role ?? 'Warga') }}</p>
                </div>
                <div class="w-9 h-9 rounded-full flex items-center justify-center text-xs font-semibold" style="background-color: #eceef0; color: #00685d;">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>
            </div>

            {{-- Logout (hidden form) --}}
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                @csrf
            </form>
            <button onclick="document.getElementById('logout-form').submit()" class="text-xs font-medium transition-colors hover:text-red-500" style="color: #6d7a77;">
                Keluar
            </button>
        @else
            <a href="{{ route('login') }}" class="text-sm font-semibold transition-colors hover:text-[#008376]" style="color: #00685d;">Masuk</a>
            <a href="{{ route('register') }}" class="btn-civic-gradient text-white text-sm font-semibold px-5 py-2 rounded-xl transition-all hover:shadow-md">Daftar</a>
        @endauth
    </div>
</nav>
