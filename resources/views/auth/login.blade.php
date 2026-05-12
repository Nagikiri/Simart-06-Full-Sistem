<x-guest-layout>

    {{-- ═══════════════════════════════════════════════════════════════
         LEFT COLUMN — Brand Panel (Hidden on mobile)
         Stitch: "Sistem Manajemen Warga yang Modern."
    ═══════════════════════════════════════════════════════════════ --}}
    <div class="hidden lg:flex lg:w-1/2 relative overflow-hidden flex-col justify-between p-12 xl:p-16"
         style="background: linear-gradient(135deg, #00685d 0%, #008376 50%, #2A9D8F 100%);">

        {{-- Decorative elements --}}
        <div class="absolute top-0 right-0 w-96 h-96 bg-white/5 rounded-full blur-3xl -translate-y-32 translate-x-32"></div>
        <div class="absolute bottom-0 left-0 w-80 h-80 bg-white/5 rounded-full blur-3xl translate-y-24 -translate-x-24"></div>
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-64 h-64 border border-white/10 rounded-full"></div>
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-96 h-96 border border-white/5 rounded-full"></div>

        {{-- Top: Logo --}}
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

        {{-- Center: Hero Text --}}
        <div class="relative z-10 max-w-md">
            <h1 class="font-extrabold text-3xl xl:text-4xl text-white leading-tight mb-4" style="font-family: 'Manrope', sans-serif;">
                Sistem Manajemen Warga yang Modern.
            </h1>
            <p class="text-white/70 text-base leading-relaxed">
                Memudahkan administrasi RT dengan transparansi digital dan aksesibilitas penuh bagi setiap warga.
            </p>

            {{-- Badge --}}
            <div class="mt-8 inline-flex items-center gap-2 bg-white/10 backdrop-blur rounded-full px-4 py-2 border border-white/10">
                <svg class="w-4 h-4 text-white/80" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
                <span class="text-xs font-semibold text-white/80 uppercase tracking-wider">Digitalisasi Kawasan Mandiri</span>
            </div>
        </div>

        {{-- Bottom: Social proof --}}
        <div class="relative z-10">
            <div class="flex items-center gap-3">
                {{-- Stacked avatars --}}
                <div class="flex -space-x-2">
                    <div class="w-8 h-8 rounded-full bg-white/20 border-2 border-white/30 flex items-center justify-center text-[10px] font-bold text-white">A</div>
                    <div class="w-8 h-8 rounded-full bg-white/20 border-2 border-white/30 flex items-center justify-center text-[10px] font-bold text-white">B</div>
                    <div class="w-8 h-8 rounded-full bg-white/20 border-2 border-white/30 flex items-center justify-center text-[10px] font-bold text-white">S</div>
                    <div class="w-8 h-8 rounded-full bg-white/15 border-2 border-white/20 flex items-center justify-center text-[10px] font-semibold text-white/70">+50</div>
                </div>
                <div>
                    <p class="text-xs text-white/50">Telah bergabung bulan ini</p>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══════════════════════════════════════════════════════════════
         RIGHT COLUMN — Login Form
         Stitch: "Selamat Datang" + NIK + Password
    ═══════════════════════════════════════════════════════════════ --}}
    <div class="w-full lg:w-1/2 flex flex-col justify-center items-center px-6 sm:px-12 lg:px-16 xl:px-24 py-12">
        <div class="w-full max-w-md">

            {{-- Mobile Logo (shown on small screens only) --}}
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

            {{-- Heading --}}
            <h2 class="font-bold text-2xl mb-2" style="font-family: 'Manrope', sans-serif; color: #191c1e;">Selamat Datang</h2>
            <p class="text-sm mb-8" style="color: #3d4947;">Gunakan akun Anda untuk mengakses dashboard warga.</p>

            {{-- Session Status --}}
            <x-auth-session-status class="mb-4" :status="session('status')" />

            {{-- ── LOGIN FORM ──────────────────────────────────── --}}
            <form method="POST" action="{{ route('login') }}">
                @csrf

                {{-- NIK Input --}}
                <div class="mb-5">
                    <label for="nik" class="block text-xs font-semibold uppercase tracking-wider mb-2" style="color: #3d4947; letter-spacing: 0.05rem;">
                        NIK (Nomor Induk Kependudukan)
                    </label>
                    <input
                        id="nik"
                        type="text"
                        name="nik"
                        value="{{ old('nik') }}"
                        placeholder="Masukkan 16 digit NIK Anda"
                        required
                        autofocus
                        autocomplete="username"
                        maxlength="16"
                        inputmode="numeric"
                        class="civic-input w-full px-4 py-3 rounded-xl text-sm @error('nik') is-error @enderror"
                        style="background-color: #ffffff; color: #191c1e;"
                    >
                    @error('nik')
                        <p class="mt-2 text-xs font-medium" style="color: #ba1a1a;">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Password Input --}}
                <div class="mb-5">
                    <label for="password" class="block text-xs font-semibold uppercase tracking-wider mb-2" style="color: #3d4947; letter-spacing: 0.05rem;">
                        Kata Sandi
                    </label>
                    <div class="relative">
                        <input
                            id="password"
                            type="password"
                            name="password"
                            placeholder="Masukkan kata sandi"
                            required
                            autocomplete="current-password"
                            class="civic-input w-full px-4 py-3 rounded-xl text-sm pr-12 @error('password') is-error @enderror"
                            style="background-color: #ffffff; color: #191c1e;"
                        >
                        {{-- Toggle password visibility --}}
                        <button type="button" onclick="togglePassword('password', this)" class="absolute right-3 top-1/2 -translate-y-1/2 p-1" style="color: #6d7a77;">
                            <svg class="w-5 h-5 eye-closed" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>
                            </svg>
                            <svg class="w-5 h-5 eye-open hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                        </button>
                    </div>
                    @error('password')
                        <p class="mt-2 text-xs font-medium" style="color: #ba1a1a;">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Remember Me + Lupa Sandi --}}
                <div class="flex items-center justify-between mb-6">
                    <label for="remember_me" class="inline-flex items-center cursor-pointer">
                        <input
                            id="remember_me"
                            type="checkbox"
                            name="remember"
                            class="w-4 h-4 rounded border-gray-300 focus:ring-2 transition-colors"
                            style="color: #00685d; --tw-ring-color: rgba(0,104,93,0.2);"
                        >
                        <span class="ml-2 text-sm" style="color: #3d4947;">Ingat saya</span>
                    </label>

                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-xs font-semibold transition-colors hover:underline" style="color: #00685d;">
                            Lupa Sandi?
                        </a>
                    @endif
                </div>

                {{-- Submit Button (Civic Gradient) --}}
                <button type="submit" class="btn-civic-gradient w-full text-white font-semibold py-3.5 rounded-xl text-sm transition-all hover:shadow-lg hover:-translate-y-0.5 active:translate-y-0">
                    Masuk ke Dashboard
                </button>
            </form>

            {{-- Divider --}}
            <div class="flex items-center gap-4 my-8">
                <div class="flex-1 h-px" style="background-color: #e0e3e5;"></div>
                <span class="text-xs font-medium" style="color: #6d7a77;">atau</span>
                <div class="flex-1 h-px" style="background-color: #e0e3e5;"></div>
            </div>

            {{-- Register Link --}}
            <a href="{{ route('register') }}"
               class="flex items-center justify-center w-full py-3.5 rounded-xl text-sm font-semibold transition-all hover:-translate-y-0.5"
               style="background-color: #eceef0; color: #191c1e;">
                Belum punya akun? <span class="ml-1" style="color: #00685d;">Daftar di sini</span>
            </a>

            {{-- Bantuan Verifikasi (Stitch) --}}
            <div class="mt-8 rounded-xl p-4" style="background-color: #eceef0;">
                <div class="flex items-start gap-3">
                    <div class="w-8 h-8 rounded-lg flex-shrink-0 flex items-center justify-center" style="background-color: rgba(43,100,133,0.10);">
                        <svg class="w-4 h-4" style="color: #2b6485;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs font-semibold mb-0.5" style="color: #191c1e;">Bantuan Verifikasi</p>
                        <p class="text-xs leading-relaxed" style="color: #3d4947;">Pastikan NIK Anda sesuai dengan yang terdaftar di Dukcapil untuk proses registrasi otomatis.</p>
                    </div>
                </div>
            </div>

            {{-- Footer Links --}}
            <x-footer-links />
        </div>
    </div>

    {{-- Toggle password script --}}
    <script>
        function togglePassword(id, btn) {
            const input = document.getElementById(id);
            const closed = btn.querySelector('.eye-closed');
            const open = btn.querySelector('.eye-open');
            if (input.type === 'password') {
                input.type = 'text';
                closed.classList.add('hidden');
                open.classList.remove('hidden');
            } else {
                input.type = 'password';
                closed.classList.remove('hidden');
                open.classList.add('hidden');
            }
        }
    </script>

</x-guest-layout>
