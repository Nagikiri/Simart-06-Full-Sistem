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
                {{-- Headline --}}
                <h1 class="font-manrope font-extrabold text-4xl sm:text-5xl lg:text-6xl text-white leading-tight mb-6 animate-fade-in-up animation-delay-100">
                    Selamat Datang di<br>
                    <span class="text-transparent bg-clip-text" style="background-image: linear-gradient(135deg, #00AA13, #38e54d); padding-bottom: 5px; display: inline-block;">SIMART-06</span>
                </h1>

                {{-- Subheadline --}}
                <p class="text-lg lg:text-xl text-white/80 leading-relaxed mb-10 max-w-2xl animate-fade-in-up animation-delay-200">
                    Website layanan administrasi digital untuk mempermudah urusan surat-menyurat warga. Cepat, transparan, dan tanpa antre.
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

            {{-- Benefits Grid — Symmetrical: 2 Top Cards (Equal), 1 Bottom Card (Full Width & Centered) --}}
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

                {{-- Card 1: Pengajuan Surat Digital (Top Left) --}}
                <div class="bg-civic-surface-lowest rounded-civic-xl p-8 lg:p-10 ambient-lift cursor-default group text-center">
                    <div class="w-16 h-16 mx-auto rounded-civic-xl bg-gradient-to-br from-civic-primary/10 to-brand-teal/5 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                        <svg class="w-8 h-8 text-civic-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                    <h3 class="font-manrope font-bold text-xl text-civic-on-surface mb-3">Pengajuan Surat Tanpa Antre</h3>
                    <p class="text-civic-on-surface-variant leading-relaxed text-sm text-justify">
                        Proses pembuatan berbagai macam surat pernyataan dan keterangan kini dapat dilakukan sepenuhnya secara digital. Anda cukup memilih jenis layanan surat yang tersedia, melengkapi form dari perangkat Anda, dan sistem akan mengirimkannya langsung ke Ketua RT untuk diverifikasi.
                    </p>
                </div>

                {{-- Card 2: Pantau Progres Real-Time (Top Right) --}}
                <div class="bg-civic-surface-lowest rounded-civic-xl p-8 lg:p-10 ambient-lift cursor-default group text-center">
                    <div class="w-16 h-16 mx-auto rounded-civic-xl bg-gradient-to-br from-brand-blue/10 to-brand-blue/5 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                        <svg class="w-8 h-8 text-brand-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h3 class="font-manrope font-bold text-xl text-civic-on-surface mb-3">Lacak Status Real-Time</h3>
                    <p class="text-civic-on-surface-variant leading-relaxed text-sm text-justify">
                        Anda tidak perlu lagi ke rumah Ketua RT untuk sekadar menanyakan progres surat. Terdapat fitur Riwayat yang interaktif dengan indikator visual step-by-step, memungkinkan Anda melihat apakah dokumen sedang direview, telah disetujui, atau sudah bisa diunduh secara online kapanpun.
                    </p>
                </div>

                {{-- Card 3: Integrasi Data Warga & Template Dokumen (Bottom Centered, Full Width) --}}
                <div class="lg:col-span-2 bg-civic-surface-lowest rounded-civic-xl p-10 lg:p-14 ambient-lift cursor-default group text-center">
                    <div class="w-20 h-20 mx-auto rounded-2xl bg-gradient-to-br from-brand-green/15 to-brand-green/5 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                        <svg class="w-10 h-10 text-brand-green" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                        </svg>
                    </div>
                    <h3 class="font-manrope font-bold text-2xl text-civic-on-surface mb-4">Manajemen Data Sentral & Sinkronisasi Otomatis</h3>
                    <p class="text-civic-on-surface-variant leading-relaxed max-w-3xl mx-auto text-justify">
                        SIMART-06 dirancang dengan arsitektur data dinamis yang mana seluruh format dan template persuratan dikelola langsung oleh Ketua RT melalui Dashboard terpusat. Apabila terdapat pembaruan terkait format maupun persyaratan, perubahan akan otomatis terefleksi ke seluruh akun Warga sehingga memastikan semua permohonan selalu sesuai dengan kebijakan lingkungan dan kelurahan terbaru.
                    </p>
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
                <span class="text-xs font-semibold text-civic-primary tracking-widest uppercase mb-3 block" style="letter-spacing: 0.08rem;">Layanan Surat</span>
                <h2 class="font-manrope font-bold text-3xl lg:text-4xl text-civic-on-surface mb-4">
                    Jenis Surat yang Tersedia
                </h2>
                <p class="text-civic-on-surface-variant text-base max-w-xl mx-auto">
                    Berikut adalah jenis-jenis surat pernyataan yang dapat Anda ajukan secara digital langsung dari rumah, tanpa perlu antre ke Ketua RT.
                </p>
            </div>

            {{-- Service Cards Grid --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-6">

                {{-- 1. Surat Pernyataan Belum Pernah Menikah --}}
                <div class="bg-civic-surface-lowest rounded-civic-xl p-6 ambient-lift cursor-default group text-center flex flex-col justify-between">
                    <div class="w-14 h-14 mx-auto rounded-civic-xl bg-gradient-to-br from-civic-primary/10 to-civic-primary/5 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                        <svg class="w-7 h-7 text-civic-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                        </svg>
                    </div>
                    <span class="font-manrope font-bold text-sm text-civic-primary block mb-2 leading-snug">Pernyataan Belum Pernah Menikah</span>
                    <p class="text-[11px] text-civic-on-surface-variant">Layanan administrasi status pernikahan</p>
                </div>

                {{-- 2. Surat Pernyataan Berpenghasilan Tidak Tetap --}}
                <div class="bg-civic-surface-lowest rounded-civic-xl p-6 ambient-lift cursor-default group text-center flex flex-col justify-between">
                    <div class="w-14 h-14 mx-auto rounded-civic-xl bg-gradient-to-br from-brand-blue/10 to-brand-blue/5 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                        <svg class="w-7 h-7 text-brand-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <span class="font-manrope font-bold text-sm text-brand-blue block mb-2 leading-snug">Pernyataan Berpenghasilan Tidak Tetap</span>
                    <p class="text-[11px] text-civic-on-surface-variant">Surat keterangan ekonomi dan pendapatan</p>
                </div>

                {{-- 3. Surat Pernyataan Jaminan Bertempat Tinggal --}}
                <div class="bg-civic-surface-lowest rounded-civic-xl p-6 ambient-lift cursor-default group text-center flex flex-col justify-between">
                    <div class="w-14 h-14 mx-auto rounded-civic-xl bg-gradient-to-br from-brand-green/10 to-brand-green/5 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                        <svg class="w-7 h-7 text-brand-green" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                        </svg>
                    </div>
                    <span class="font-manrope font-bold text-sm text-brand-green block mb-2 leading-snug">Pernyataan Jaminan Bertempat Tinggal</span>
                    <p class="text-[11px] text-civic-on-surface-variant">Layanan bukti validitas domisili</p>
                </div>

                {{-- 4. Surat Pernyataan Gaib --}}
                <div class="bg-civic-surface-lowest rounded-civic-xl p-6 ambient-lift cursor-default group text-center flex flex-col justify-between">
                    <div class="w-14 h-14 mx-auto rounded-civic-xl bg-gradient-to-br from-purple-500/10 to-purple-500/5 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                        <svg class="w-7 h-7 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                    </div>
                    <span class="font-manrope font-bold text-sm text-purple-600 block mb-2 leading-snug">Pernyataan Gaib (Ditinggal)</span>
                    <p class="text-[11px] text-civic-on-surface-variant">Surat pernyataan ditinggal pergi pasangan</p>
                </div>

                {{-- 5. SPTJM Kematian --}}
                <div class="bg-civic-surface-lowest rounded-civic-xl p-6 ambient-lift cursor-default group text-center flex flex-col justify-between">
                    <div class="w-14 h-14 mx-auto rounded-civic-xl bg-gradient-to-br from-amber-500/10 to-amber-500/5 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                        <svg class="w-7 h-7 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                    <span class="font-manrope font-bold text-sm text-amber-600 block mb-2 leading-snug">SPTJM Kebenaran Data Kematian</span>
                    <p class="text-[11px] text-civic-on-surface-variant">Pernyataan mutlak validasi data</p>
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
