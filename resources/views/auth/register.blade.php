<x-guest-layout>

    {{-- ═══════════════════════════════════════════════════════════════
         LEFT COLUMN — Brand Panel (same as login, hidden on mobile)
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
                Bergabung dengan Komunitas Digital RT 06.
            </h1>
            <p class="text-white/70 text-base leading-relaxed">
                Daftarkan diri Anda sebagai warga untuk mengakses layanan surat, laporan keuangan, dan informasi RT secara real-time.
            </p>

            {{-- Checklist --}}
            <div class="mt-8 space-y-3">
                <div class="flex items-center gap-3">
                    <div class="w-6 h-6 rounded-full bg-white/15 flex items-center justify-center flex-shrink-0">
                        <svg class="w-3.5 h-3.5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                        </svg>
                    </div>
                    <span class="text-sm text-white/70">Pengajuan surat online 24 jam</span>
                </div>
                <div class="flex items-center gap-3">
                    <div class="w-6 h-6 rounded-full bg-white/15 flex items-center justify-center flex-shrink-0">
                        <svg class="w-3.5 h-3.5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                        </svg>
                    </div>
                    <span class="text-sm text-white/70">Lacak status pengajuan real-time</span>
                </div>
                <div class="flex items-center gap-3">
                    <div class="w-6 h-6 rounded-full bg-white/15 flex items-center justify-center flex-shrink-0">
                        <svg class="w-3.5 h-3.5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                        </svg>
                    </div>
                    <span class="text-sm text-white/70">Transparansi keuangan RT</span>
                </div>
            </div>
        </div>

        {{-- Bottom: Social proof --}}
        <div class="relative z-10">
            <p class="text-xs text-white/40">&copy; {{ date('Y') }} SIMART-06. Semua hak dilindungi.</p>
        </div>
    </div>

    {{-- ═══════════════════════════════════════════════════════════════
         RIGHT COLUMN — Register Form
    ═══════════════════════════════════════════════════════════════ --}}
    <div class="w-full lg:w-1/2 flex flex-col justify-center items-center px-6 sm:px-12 lg:px-16 xl:px-24 py-12 overflow-y-auto">
        <div class="w-full max-w-md">

            {{-- Mobile Logo --}}
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
            <h2 class="font-bold text-2xl mb-2" style="font-family: 'Manrope', sans-serif; color: #191c1e;">Daftar Akun Warga</h2>
            <p class="text-sm mb-8" style="color: #3d4947;">Lengkapi data berikut untuk mendaftarkan diri sebagai warga RT 06.</p>

            {{-- ── REGISTER FORM ──────────────────────────────── --}}
            <form method="POST" action="{{ route('register') }}">
                @csrf

                {{-- Nama Lengkap --}}
                <div class="mb-5">
                    <label for="name" class="block text-xs font-semibold uppercase tracking-wider mb-2" style="color: #3d4947; letter-spacing: 0.05rem;">
                        Nama Lengkap
                    </label>
                    <input
                        id="name"
                        type="text"
                        name="name"
                        value="{{ old('name') }}"
                        placeholder="Masukkan nama lengkap Anda"
                        required
                        autofocus
                        autocomplete="name"
                        class="civic-input w-full px-4 py-3 rounded-xl text-sm @error('name') is-error @enderror"
                        style="background-color: #ffffff; color: #191c1e;"
                    >
                    @error('name')
                        <p class="mt-2 text-xs font-medium" style="color: #ba1a1a;">{{ $message }}</p>
                    @enderror
                </div>

                {{-- No HP --}}
                <div class="mb-5">
                    <label for="no_hp" class="block text-xs font-semibold uppercase tracking-wider mb-2" style="color: #3d4947; letter-spacing: 0.05rem;">
                        Nomor Handphone (WhatsApp)
                    </label>
                    <input
                        id="no_hp"
                        type="text"
                        name="no_hp"
                        value="{{ old('no_hp') }}"
                        placeholder="Contoh: 08123456789"
                        required
                        inputmode="numeric"
                        class="civic-input w-full px-4 py-3 rounded-xl text-sm @error('no_hp') is-error @enderror"
                        style="background-color: #ffffff; color: #191c1e;"
                    >
                    <p class="mt-1 text-xs text-gray-500">Gunakan format Indonesia (diawali 08, 628, atau +628)</p>
                    @error('no_hp')
                        <p class="mt-2 text-xs font-medium" style="color: #ba1a1a;">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Email --}}
                <div class="mb-5">
                    <label for="email" class="block text-xs font-semibold uppercase tracking-wider mb-2" style="color: #3d4947; letter-spacing: 0.05rem;">
                        Email <span class="normal-case tracking-normal font-normal" style="color: #6d7a77;">(opsional, untuk notifikasi)</span>
                    </label>
                    <input
                        id="email"
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        placeholder="contoh@email.com"
                        autocomplete="email"
                        class="civic-input w-full px-4 py-3 rounded-xl text-sm @error('email') is-error @enderror"
                        style="background-color: #ffffff; color: #191c1e;"
                    >
                    @error('email')
                        <p class="mt-2 text-xs font-medium" style="color: #ba1a1a;">{{ $message }}</p>
                    @enderror
                </div>



                {{-- Jenis Kelamin --}}
                <div class="mb-5">
                    <label for="gender" class="block text-xs font-semibold uppercase tracking-wider mb-2" style="color: #3d4947; letter-spacing: 0.05rem;">
                        Jenis Kelamin
                    </label>
                    <select
                        id="gender"
                        name="gender"
                        required
                        class="civic-input w-full px-4 py-3 rounded-xl text-sm @error('gender') is-error @enderror"
                        style="background-color: #ffffff; color: #191c1e;"
                    >
                        <option value="" disabled {{ old('gender') ? '' : 'selected' }}>-- Pilih Jenis Kelamin --</option>
                        <option value="Laki-laki" {{ old('gender') === 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="Perempuan" {{ old('gender') === 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                    @error('gender')
                        <p class="mt-2 text-xs font-medium" style="color: #ba1a1a;">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Password row (2-col on sm+) --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 mb-5">
                    {{-- Kata Sandi --}}
                    <div>
                        <label for="password" class="block text-xs font-semibold uppercase tracking-wider mb-2" style="color: #3d4947; letter-spacing: 0.05rem;">
                            Kata Sandi
                        </label>
                        <div class="relative">
                            <input
                                id="password"
                                type="password"
                                name="password"
                                placeholder="Min. 8 karakter"
                                required
                                autocomplete="new-password"
                                class="civic-input w-full px-4 py-3 rounded-xl text-sm pr-11 @error('password') is-error @enderror"
                                style="background-color: #ffffff; color: #191c1e;"
                            >
                            <button type="button" onclick="togglePassword('password', this)" class="absolute right-3 top-1/2 -translate-y-1/2 p-0.5" style="color: #6d7a77;">
                                <svg class="w-4 h-4 eye-closed" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/></svg>
                                <svg class="w-4 h-4 eye-open hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                            </button>
                        </div>
                        @error('password')
                            <p class="mt-2 text-xs font-medium" style="color: #ba1a1a;">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Konfirmasi Sandi --}}
                    <div>
                        <label for="password_confirmation" class="block text-xs font-semibold uppercase tracking-wider mb-2" style="color: #3d4947; letter-spacing: 0.05rem;">
                            Konfirmasi Sandi
                        </label>
                        <div class="relative">
                            <input
                                id="password_confirmation"
                                type="password"
                                name="password_confirmation"
                                placeholder="Ulangi kata sandi"
                                required
                                autocomplete="new-password"
                                class="civic-input w-full px-4 py-3 rounded-xl text-sm pr-11"
                                style="background-color: #ffffff; color: #191c1e;"
                            >
                            <button type="button" onclick="togglePassword('password_confirmation', this)" class="absolute right-3 top-1/2 -translate-y-1/2 p-0.5" style="color: #6d7a77;">
                                <svg class="w-4 h-4 eye-closed" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/></svg>
                                <svg class="w-4 h-4 eye-open hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                            </button>
                        </div>
                    </div>
                </div>

                {{-- Terms checkbox --}}
                <div class="mb-6">
                    <label for="terms" class="inline-flex items-start cursor-pointer">
                        <input
                            id="terms"
                            type="checkbox"
                            name="terms"
                            required
                            class="w-4 h-4 rounded border-gray-300 mt-0.5 focus:ring-2 transition-colors"
                            style="color: #00685d; --tw-ring-color: rgba(0,104,93,0.2);"
                        >
                        <span class="ml-2 text-xs leading-relaxed" style="color: #3d4947;">
                            Saya menyetujui
                            <a href="#" class="underline font-medium" style="color: #00685d;">Syarat Ketentuan</a>
                            dan
                            <a href="#" class="underline font-medium" style="color: #00685d;">Kebijakan Privasi</a>
                            SIMART-06.
                        </span>
                    </label>
                </div>

                {{-- Submit Button --}}
                <button type="submit" class="btn-civic-gradient w-full text-white font-semibold py-3.5 rounded-xl text-sm transition-all hover:shadow-lg hover:-translate-y-0.5 active:translate-y-0">
                    Daftar Sebagai Warga
                </button>
            </form>

            {{-- Divider --}}
            <div class="flex items-center gap-4 my-8">
                <div class="flex-1 h-px" style="background-color: #e0e3e5;"></div>
                <span class="text-xs font-medium" style="color: #6d7a77;">sudah punya akun?</span>
                <div class="flex-1 h-px" style="background-color: #e0e3e5;"></div>
            </div>

            {{-- Login Link --}}
            <a href="{{ route('login') }}"
               class="flex items-center justify-center w-full py-3.5 rounded-xl text-sm font-semibold transition-all hover:-translate-y-0.5"
               style="background-color: #eceef0; color: #191c1e;">
                Masuk ke akun yang sudah ada
            </a>

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
