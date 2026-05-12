{{-- Navigation — Civic Curator: Glassmorphism, No-Line Rule --}}
<nav class="glass-nav fixed top-0 left-0 right-0 z-50 border-b border-civic-outline-variant/10" id="mainNav">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <div class="flex justify-between items-center h-[72px]">
            {{-- Logo --}}
            <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                <div class="w-10 h-10 btn-civic-gradient rounded-civic-lg flex items-center justify-center shadow-soft transition-transform group-hover:scale-105">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                </div>
                <div>
                    <span class="font-manrope font-bold text-lg text-civic-on-surface tracking-tight">SIMART-06</span>
                    <span class="block text-[11px] text-civic-on-surface-variant tracking-wide uppercase font-medium" style="letter-spacing: 0.05rem;">Sistem Manajemen RT</span>
                </div>
            </a>

            {{-- Desktop Navigation Links --}}
            <div class="hidden md:flex items-center gap-8">
                <a href="#hero" class="text-sm font-medium text-civic-on-surface-variant hover:text-civic-primary transition-colors">Home</a>
                <a href="#benefits" class="text-sm font-medium text-civic-on-surface-variant hover:text-civic-primary transition-colors">Benefits</a>
                <a href="#services" class="text-sm font-medium text-civic-on-surface-variant hover:text-civic-primary transition-colors">Services</a>
            </div>

            {{-- Auth Buttons --}}
            <div class="flex items-center gap-3">
                @auth
                    <span class="hidden sm:inline text-sm text-civic-on-surface-variant">{{ Auth::user()->name }}</span>
                    <a href="{{ route('dashboard') }}" class="btn-civic-gradient text-white text-sm font-semibold px-5 py-2.5 rounded-civic-lg transition-all hover:shadow-ambient">
                        Dashboard
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-sm font-medium text-civic-outline hover:text-red-500 transition-colors ml-1">
                            Logout
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="text-sm font-semibold text-civic-primary hover:text-civic-primary-container transition-colors">
                        Masuk
                    </a>
                    <a href="{{ route('register') }}" class="btn-civic-gradient text-white text-sm font-semibold px-5 py-2.5 rounded-civic-lg transition-all hover:shadow-ambient">
                        Daftar Warga
                    </a>
                @endauth

                {{-- Mobile hamburger --}}
                <button id="mobileMenuBtn" class="md:hidden ml-2 p-2 rounded-civic text-civic-on-surface-variant hover:bg-civic-surface-high transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>
        </div>

        {{-- Mobile Menu --}}
        <div id="mobileMenu" class="hidden md:hidden pb-4">
            <div class="flex flex-col gap-2 bg-civic-surface-lowest rounded-civic-xl p-4 shadow-ambient">
                <a href="#hero" class="text-sm font-medium text-civic-on-surface-variant hover:text-civic-primary px-3 py-2 rounded-civic hover:bg-civic-surface-low transition-colors">Home</a>
                <a href="#benefits" class="text-sm font-medium text-civic-on-surface-variant hover:text-civic-primary px-3 py-2 rounded-civic hover:bg-civic-surface-low transition-colors">Benefits</a>
                <a href="#services" class="text-sm font-medium text-civic-on-surface-variant hover:text-civic-primary px-3 py-2 rounded-civic hover:bg-civic-surface-low transition-colors">Services</a>
            </div>
        </div>
    </div>
</nav>
