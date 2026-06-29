<x-guest-layout>

    {{-- LEFT — Brand Panel --}}
    <div class="hidden lg:flex lg:w-1/2 relative overflow-hidden flex-col justify-between p-12 xl:p-16"
         style="background: linear-gradient(135deg, #00685d 0%, #008376 50%, #2A9D8F 100%);">

        <div class="absolute top-0 right-0 w-96 h-96 bg-white/5 rounded-full blur-3xl -translate-y-32 translate-x-32"></div>
        <div class="absolute bottom-0 left-0 w-80 h-80 bg-white/5 rounded-full blur-3xl translate-y-24 -translate-x-24"></div>
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-64 h-64 border border-white/10 rounded-full"></div>
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-96 h-96 border border-white/5 rounded-full"></div>

        <div class="relative z-10">
            <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                <div class="w-11 h-11 bg-white/15 backdrop-blur rounded-xl flex items-center justify-center border border-white/10 group-hover:bg-white/20 transition-all">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                </div>
                <span class="font-bold text-white text-lg tracking-tight" style="font-family: 'Manrope', sans-serif;">SIMART-06</span>
            </a>
        </div>

        <div class="relative z-10 max-w-md">
            <h1 class="font-extrabold text-3xl xl:text-4xl text-white leading-tight mb-4" style="font-family: 'Manrope', sans-serif;">
                Pulihkan Akses Akun Anda.
            </h1>
            <p class="text-white/70 text-base leading-relaxed">
                Kami akan mengirim tautan reset password ke email terdaftar. Proses aman dan berlaku terbatas untuk melindungi akun warga.
            </p>

            <div class="mt-8 space-y-3">
                <div class="flex items-center gap-3">
                    <div class="w-6 h-6 rounded-full bg-white/15 flex items-center justify-center flex-shrink-0">
                        <svg class="w-3.5 h-3.5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                        </svg>
                    </div>
                    <span class="text-sm text-white/70">Tautan dikirim ke email terdaftar</span>
                </div>
                <div class="flex items-center gap-3">
                    <div class="w-6 h-6 rounded-full bg-white/15 flex items-center justify-center flex-shrink-0">
                        <svg class="w-3.5 h-3.5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                        </svg>
                    </div>
                    <span class="text-sm text-white/70">Berlaku 1 jam sejak permintaan</span>
                </div>
                <div class="flex items-center gap-3">
                    <div class="w-6 h-6 rounded-full bg-white/15 flex items-center justify-center flex-shrink-0">
                        <svg class="w-3.5 h-3.5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                        </svg>
                    </div>
                    <span class="text-sm text-white/70">Password diperbarui di seluruh sistem</span>
                </div>
            </div>
        </div>

        <div class="relative z-10">
            <p class="text-xs text-white/40">&copy; {{ date('Y') }} SIMART-06. Semua hak dilindungi.</p>
        </div>
    </div>

    {{-- RIGHT — Form --}}
    <div class="w-full lg:w-1/2 flex flex-col justify-center items-center px-6 sm:px-12 lg:px-16 xl:px-24 py-12">
        <div class="w-full max-w-md">

            <div class="lg:hidden mb-10 flex items-center gap-3">
                <a href="{{ route('home') }}" class="flex items-center gap-3">
                    <div class="w-10 h-10 btn-civic-gradient rounded-xl flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                        </svg>
                    </div>
                    <span class="font-bold text-lg tracking-tight" style="font-family: 'Manrope', sans-serif; color: #191c1e;">SIMART-06</span>
                </a>
            </div>

            <div class="mb-6 flex items-center gap-3">
                <div class="w-12 h-12 rounded-2xl flex items-center justify-center flex-shrink-0" style="background: linear-gradient(135deg, rgba(0,104,93,0.10), rgba(0,104,93,0.04));">
                    <svg class="w-6 h-6" style="color: #00685d;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/>
                    </svg>
                </div>
                <div>
                    <h2 class="font-bold text-2xl" style="font-family: 'Manrope', sans-serif; color: #191c1e;">Lupa Password</h2>
                    <p class="text-sm mt-0.5" style="color: #3d4947;">Masukkan email untuk menerima tautan reset.</p>
                </div>
            </div>

            @if (session('status'))
            <div class="mb-6 rounded-xl p-4 flex items-start gap-3" style="background-color: #e8f5e9; border: 1px solid rgba(65, 101, 56, 0.15);">
                <div class="w-8 h-8 rounded-lg flex-shrink-0 flex items-center justify-center" style="background-color: rgba(65, 101, 56, 0.12);">
                    <svg class="w-4 h-4" style="color: #416538;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-semibold" style="color: #1b5e20;">Email terkirim</p>
                    <p class="text-xs mt-1 leading-relaxed" style="color: #416538;">{{ session('status') }}</p>
                </div>
            </div>
            @endif

            @if (session('reset_debug_url') && config('app.debug'))
            <div class="mb-6 rounded-xl p-5" style="background-color: #fff8e1; border: 1px solid rgba(249, 168, 37, 0.35);">
                <p class="text-sm font-semibold mb-1" style="color: #5d4037;">Uji lokal — buka halaman reset</p>
                <p class="text-xs mb-3" style="color: #6d5c4a;">Ini pengganti email saat belum pakai Gmail/SMTP. Klik tombol di bawah (sama seperti link di email nanti).</p>
                <a href="{{ session('reset_debug_url') }}"
                   class="inline-flex items-center justify-center w-full py-3 rounded-xl text-sm font-semibold text-white"
                   style="background: linear-gradient(135deg, #00685d, #008376);">
                    Buka Halaman Ganti Password →
                </a>
            </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <div class="mb-6">
                    <label for="email" class="block text-xs font-semibold uppercase tracking-wider mb-2" style="color: #3d4947; letter-spacing: 0.05rem;">
                        Alamat Email
                    </label>
                    <input
                        id="email"
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        placeholder="Masukkan alamat email terdaftar"
                        required
                        autofocus
                        autocomplete="email"
                        class="civic-input w-full px-4 py-3 rounded-xl text-sm @error('email') is-error @enderror"
                        style="background-color: #ffffff; color: #191c1e;"
                    >
                    @error('email')
                        <p class="mt-2 text-xs font-medium" style="color: #ba1a1a;">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit" class="btn-civic-gradient w-full text-white font-semibold py-3.5 rounded-xl text-sm transition-all hover:shadow-lg hover:-translate-y-0.5 active:translate-y-0">
                    Kirim Tautan Reset Password
                </button>
            </form>

            <div class="flex items-center gap-4 my-8">
                <div class="flex-1 h-px" style="background-color: #e0e3e5;"></div>
                <span class="text-xs font-medium" style="color: #6d7a77;">atau</span>
                <div class="flex-1 h-px" style="background-color: #e0e3e5;"></div>
            </div>

            <a href="{{ route('login') }}"
               class="flex items-center justify-center w-full py-3.5 rounded-xl text-sm font-semibold transition-all hover:-translate-y-0.5"
               style="background-color: #eceef0; color: #191c1e;">
                <span style="color: #00685d;">← Kembali ke Login</span>
            </a>

            <div class="mt-8 rounded-xl p-4" style="background-color: #eceef0;">
                <div class="flex items-start gap-3">
                    <div class="w-8 h-8 rounded-lg flex-shrink-0 flex items-center justify-center" style="background-color: rgba(43,100,133,0.10);">
                        <svg class="w-4 h-4" style="color: #2b6485;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs font-semibold mb-0.5" style="color: #191c1e;">Informasi Keamanan</p>
                        <p class="text-xs leading-relaxed" style="color: #3d4947;">Tautan reset hanya berlaku 1 jam. Jangan bagikan tautan kepada siapa pun. Periksa folder spam jika email belum masuk.</p>
                    </div>
                </div>
            </div>

            <x-footer-links />
        </div>
    </div>

</x-guest-layout>
