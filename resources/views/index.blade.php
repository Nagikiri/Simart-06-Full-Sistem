@extends('layouts.landing')

@section('content')

    {{-- ═══════════════════════════════════════════════════
         HERO SECTION — Editorial, Asymmetric Layout
    ═══════════════════════════════════════════════════ --}}
    <section id="hero" class="relative pt-36 pb-20 lg:pt-44 lg:pb-28 overflow-hidden">
        {{-- Background Photo (semi-transparent) --}}
        <div class="absolute inset-0 z-0">
            <img
                src="{{ asset('images/contoh.jpg') }}"
                alt=""
                class="w-full h-full object-cover"
            >
            {{-- Dark overlay for semi-transparent effect --}}
            <div class="absolute inset-0 bg-gradient-to-b from-black/60 via-black/50 to-black/70"></div>
        </div>

        {{-- Decorative gradient orbs --}}
        <div class="absolute top-20 -left-32 w-96 h-96 bg-brand-teal/10 rounded-full blur-3xl z-[1]"></div>
        <div class="absolute bottom-0 right-0 w-80 h-80 bg-brand-blue/8 rounded-full blur-3xl z-[1]"></div>

        <div class="max-w-7xl mx-auto px-6 lg:px-8 relative z-10">
            <div class="max-w-3xl">
                {{-- Trust badge --}}
                <div class="inline-flex items-center gap-2 bg-white/90 backdrop-blur-sm rounded-full px-4 py-2 shadow-soft mb-8 animate-fade-in-up pulse-subtle">
                    <svg class="w-4 h-4 text-civic-primary" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    <span class="text-xs font-semibold text-civic-primary tracking-wide uppercase" style="letter-spacing: 0.05rem;">Secure & Private</span>
                </div>

                {{-- Headline --}}
                <h1 class="font-manrope font-extrabold text-4xl sm:text-5xl lg:text-6xl text-white leading-tight mb-6 animate-fade-in-up animation-delay-100">
                    Selamat Datang di<br>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r" style="--tw-gradient-from: #6ee7b7; --tw-gradient-to: #5eead4; background-image: linear-gradient(to right, #6ee7b7, #5eead4);">SIMART-06</span>
                </h1>

                {{-- Subheadline --}}
                <p class="text-lg lg:text-xl text-white/80 leading-relaxed mb-10 max-w-2xl animate-fade-in-up animation-delay-200">
                    Website Rukun Tetangga 006 Balikpapan untuk membantu mengelola administrasi warga.
                </p>

                {{-- CTA Buttons --}}
                <div class="flex flex-wrap gap-4 animate-fade-in-up animation-delay-300">
                    @auth
                        <a href="{{ route('dashboard') }}" class="btn-civic-gradient text-white font-semibold px-8 py-3.5 rounded-civic-xl text-sm shadow-ambient hover:shadow-lg transition-all hover:-translate-y-0.5">
                            Buka Dashboard
                        </a>
                    @else
                        <a href="{{ route('register') }}" class="btn-civic-gradient text-white font-semibold px-8 py-3.5 rounded-civic-xl text-sm shadow-ambient hover:shadow-lg transition-all hover:-translate-y-0.5">
                            Daftar Sebagai Warga
                        </a>
                        <a href="{{ route('login') }}" class="bg-white/10 backdrop-blur-sm border border-white/30 text-white font-semibold px-8 py-3.5 rounded-civic-xl text-sm hover:bg-white/20 transition-all hover:-translate-y-0.5">
                            Masuk Akun
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </section>

    {{-- ═══════════════════════════════════════════════════
         BENEFITS — Tonal Card Separation, No Borders
    ═══════════════════════════════════════════════════ --}}
    <section id="benefits" class="py-24 lg:py-32" style="background-color: #f2f4f6;">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            {{-- Section Header --}}
            <div class="max-w-2xl mb-16">
                <span class="text-xs font-semibold text-civic-primary tracking-widest uppercase mb-3 block" style="letter-spacing: 0.08rem;">Why SIMART-06</span>
                <h2 class="font-manrope font-bold text-3xl lg:text-4xl text-civic-on-surface leading-tight mb-4">
                    Digitalisasi Layanan Warga RT 06.
                </h2>
                <p class="text-civic-on-surface-variant text-base lg:text-lg leading-relaxed">
                    Kami menghadirkan kemudahan administrasi di genggaman Anda, agar urusan surat-menyurat tak lagi menyita waktu.
                </p>
            </div>

            {{-- Benefits Grid — Asymmetric (65/35 pattern) --}}
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">

                {{-- Card 1: Effortless Requests (larger) --}}
                <div class="lg:col-span-7 bg-civic-surface-lowest rounded-civic-xl p-8 lg:p-10 ambient-lift cursor-default group">
                    <div class="w-12 h-12 rounded-civic-lg bg-gradient-to-br from-civic-primary/10 to-brand-teal/5 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6 text-civic-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                    <h3 class="font-manrope font-bold text-xl text-civic-on-surface mb-3">Urus Surat Jadi Mudah</h3>
                    <p class="text-civic-on-surface-variant leading-relaxed">
                        Butuh surat pengantar atau domisili? Ajukan langsung dari HP tanpa perlu bolak-balik ke rumah pengurus
                    </p>
                </div>

                {{-- Card 2: Real-time Tracking --}}
                <div class="lg:col-span-5 bg-civic-surface-lowest rounded-civic-xl p-8 lg:p-10 ambient-lift cursor-default group">
                    <div class="w-12 h-12 rounded-civic-lg bg-gradient-to-br from-brand-blue/10 to-brand-blue/5 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6 text-brand-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h3 class="font-manrope font-bold text-xl text-civic-on-surface mb-3">Pantau Status</h3>
                    <p class="text-civic-on-surface-variant leading-relaxed">
                        Cek progres pengajuan Anda secara real-time. Anda akan menerima notifikasi otomatis saat surat sudah siap diambil atau ditandatangani.
                    </p>
                </div>

                {{-- Card 3: Digital Transparency (full width) --}}
                <div class="lg:col-span-12 bg-civic-surface-lowest rounded-civic-xl p-8 lg:p-10 ambient-lift cursor-default group">
                    <div class="lg:flex lg:items-start lg:gap-8">
                        <div class="w-12 h-12 rounded-civic-lg bg-gradient-to-br from-brand-green/15 to-brand-green/5 flex items-center justify-center mb-6 lg:mb-0 flex-shrink-0 group-hover:scale-110 transition-transform">
                            <svg class="w-6 h-6 text-brand-green" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-manrope font-bold text-xl text-civic-on-surface mb-3">Info Terkini</h3>
                            <p class="text-civic-on-surface-variant leading-relaxed max-w-2xl">
                                Akses pengumuman warga, jadwal kerja bakti, hingga agenda lingkungan terbaru agar tidak ketinggalan informasi penting.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ═══════════════════════════════════════════════════
         SERVICE PORTAL — Warga Actor Services
    ═══════════════════════════════════════════════════ --}}
    <section id="services" class="py-24 lg:py-32">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            {{-- Section Header --}}
            <div class="text-center mb-16">
                <span class="text-xs font-semibold text-civic-primary tracking-widest uppercase mb-3 block" style="letter-spacing: 0.08rem;">Service Portal</span>
                <h2 class="font-manrope font-bold text-3xl lg:text-4xl text-civic-on-surface mb-4">
                    Access all essential neighborhood documents<br class="hidden lg:block"> through our curated digital desk.
                </h2>
            </div>

            {{-- Service Cards Grid --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

                {{-- Surat Domisili --}}
                <div class="bg-civic-surface-lowest rounded-civic-xl p-8 ambient-lift cursor-default group text-center">
                    <div class="w-16 h-16 mx-auto rounded-civic-xl bg-gradient-to-br from-civic-primary/10 to-civic-primary/5 flex items-center justify-center mb-5 group-hover:scale-110 transition-transform">
                        <svg class="w-8 h-8 text-civic-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                        </svg>
                    </div>
                    <span class="font-manrope font-bold text-2xl text-civic-primary block mb-1">Domisili</span>
                    <p class="text-sm text-civic-on-surface-variant">Certificate of Residence</p>
                </div>

                {{-- Surat Usaha --}}
                <div class="bg-civic-surface-lowest rounded-civic-xl p-8 ambient-lift cursor-default group text-center">
                    <div class="w-16 h-16 mx-auto rounded-civic-xl bg-gradient-to-br from-brand-blue/10 to-brand-blue/5 flex items-center justify-center mb-5 group-hover:scale-110 transition-transform">
                        <svg class="w-8 h-8 text-brand-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 13.255A23.193 23.193 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <span class="font-manrope font-bold text-2xl text-brand-blue block mb-1">Usaha</span>
                    <p class="text-sm text-civic-on-surface-variant">Business Permit Letters</p>
                </div>

                {{-- Surat Keluarga --}}
                <div class="bg-civic-surface-lowest rounded-civic-xl p-8 ambient-lift cursor-default group text-center">
                    <div class="w-16 h-16 mx-auto rounded-civic-xl bg-gradient-to-br from-brand-green/10 to-brand-green/5 flex items-center justify-center mb-5 group-hover:scale-110 transition-transform">
                        <svg class="w-8 h-8 text-brand-green" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                    </div>
                    <span class="font-manrope font-bold text-2xl text-brand-green block mb-1">Keluarga</span>
                    <p class="text-sm text-civic-on-surface-variant">Family Administration</p>
                </div>

                {{-- Surat Karakter --}}
                <div class="bg-civic-surface-lowest rounded-civic-xl p-8 ambient-lift cursor-default group text-center">
                    <div class="w-16 h-16 mx-auto rounded-civic-xl bg-gradient-to-br from-amber-500/10 to-amber-500/5 flex items-center justify-center mb-5 group-hover:scale-110 transition-transform">
                        <svg class="w-8 h-8 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                    </div>
                    <span class="font-manrope font-bold text-2xl text-amber-600 block mb-1">Karakter</span>
                    <p class="text-sm text-civic-on-surface-variant">Good Conduct Statement</p>
                </div>
            </div>

            {{-- Warga quick-action link --}}
            @guest
            <div class="text-center mt-12">
                <a href="{{ route('register') }}" class="inline-flex items-center gap-2 text-sm font-semibold text-civic-primary hover:text-civic-primary-container transition-colors group">
                    Daftar sebagai Warga untuk mengajukan surat
                    <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                    </svg>
                </a>
            </div>
            @endguest
        </div>
    </section>

@endsection
