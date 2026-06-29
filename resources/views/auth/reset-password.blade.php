<x-guest-layout>

    {{-- LEFT — Brand Panel --}}
    <div class="hidden lg:flex lg:w-1/2 relative overflow-hidden flex-col justify-between p-12 xl:p-16"
         style="background: linear-gradient(135deg, #00685d 0%, #008376 50%, #2A9D8F 100%);">

        <div class="absolute top-0 right-0 w-96 h-96 bg-white/5 rounded-full blur-3xl -translate-y-32 translate-x-32"></div>
        <div class="absolute bottom-0 left-0 w-80 h-80 bg-white/5 rounded-full blur-3xl translate-y-24 -translate-x-24"></div>
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-64 h-64 border border-white/10 rounded-full"></div>

        <div class="relative z-10">
            <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                <div class="w-11 h-11 bg-white/15 backdrop-blur rounded-xl flex items-center justify-center border border-white/10">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                </div>
                <span class="font-bold text-white text-lg tracking-tight" style="font-family: 'Manrope', sans-serif;">SIMART-06</span>
            </a>
        </div>

        <div class="relative z-10 max-w-md">
            <h1 class="font-extrabold text-3xl xl:text-4xl text-white leading-tight mb-4" style="font-family: 'Manrope', sans-serif;">
                Buat Password Baru.
            </h1>
            <p class="text-white/70 text-base leading-relaxed">
                Gunakan kombinasi huruf dan angka yang kuat. Password baru akan langsung aktif untuk login dashboard warga.
            </p>
        </div>

        <div class="relative z-10">
            <p class="text-xs text-white/40">&copy; {{ date('Y') }} SIMART-06.</p>
        </div>
    </div>

    {{-- RIGHT — Form --}}
    <div class="w-full lg:w-1/2 flex flex-col justify-center items-center px-6 sm:px-12 lg:px-16 xl:px-24 py-12 overflow-y-auto">
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

            <h2 class="font-bold text-2xl mb-2" style="font-family: 'Manrope', sans-serif; color: #191c1e;">Reset Password</h2>
            <p class="text-sm mb-8" style="color: #3d4947;">Masukkan password baru untuk akun Anda.</p>

            @if (session('status'))
            <div class="mb-6 rounded-xl p-4 text-sm" style="background-color: #e8f5e9; color: #416538;">{{ session('status') }}</div>
            @endif

            <form method="POST" action="{{ route('password.update') }}">
                @csrf

                <input type="hidden" name="token" value="{{ $token ?? '' }}">

                <div class="mb-5">
                    <label for="email" class="block text-xs font-semibold uppercase tracking-wider mb-2" style="color: #3d4947; letter-spacing: 0.05rem;">
                        Alamat Email
                    </label>
                    <input
                        id="email"
                        type="email"
                        name="email"
                        value="{{ old('email', $email ?? '') }}"
                        placeholder="Masukkan alamat email Anda"
                        required
                        autofocus
                        autocomplete="email"
                        readonly
                        class="civic-input w-full px-4 py-3 rounded-xl text-sm @error('email') is-error @enderror"
                        style="background-color: #f7f9fb; color: #6d7a77;"
                    >
                    @error('email')
                        <p class="mt-2 text-xs font-medium" style="color: #ba1a1a;">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="password" class="block text-xs font-semibold uppercase tracking-wider mb-2" style="color: #3d4947; letter-spacing: 0.05rem;">
                        Password Baru
                    </label>
                    <div class="relative">
                        <input
                            id="password"
                            type="password"
                            name="password"
                            placeholder="Minimal 8 karakter"
                            required
                            autocomplete="new-password"
                            class="civic-input w-full px-4 py-3 rounded-xl text-sm pr-12 @error('password') is-error @enderror"
                            style="background-color: #ffffff; color: #191c1e;"
                        >
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
                    @error('token')
                        <p class="mt-2 text-xs font-medium" style="color: #ba1a1a;">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="password_confirmation" class="block text-xs font-semibold uppercase tracking-wider mb-2" style="color: #3d4947; letter-spacing: 0.05rem;">
                        Konfirmasi Password
                    </label>
                    <div class="relative">
                        <input
                            id="password_confirmation"
                            type="password"
                            name="password_confirmation"
                            placeholder="Ulangi password baru"
                            required
                            autocomplete="new-password"
                            class="civic-input w-full px-4 py-3 rounded-xl text-sm pr-12"
                            style="background-color: #ffffff; color: #191c1e;"
                        >
                        <button type="button" onclick="togglePassword('password_confirmation', this)" class="absolute right-3 top-1/2 -translate-y-1/2 p-1" style="color: #6d7a77;">
                            <svg class="w-5 h-5 eye-closed" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>
                            </svg>
                            <svg class="w-5 h-5 eye-open hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                        </button>
                    </div>
                </div>

                <button type="submit" class="btn-civic-gradient w-full text-white font-semibold py-3.5 rounded-xl text-sm transition-all hover:shadow-lg hover:-translate-y-0.5 active:translate-y-0">
                    Simpan Password Baru
                </button>
            </form>

            <div class="mt-8 text-center">
                <a href="{{ route('login') }}" class="text-xs font-semibold transition-colors hover:underline" style="color: #00685d;">
                    ← Kembali ke Login
                </a>
            </div>

            <x-footer-links />
        </div>
    </div>

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
