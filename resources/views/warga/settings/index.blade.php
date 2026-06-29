@extends('layouts.app')

@section('title', 'Pengaturan Akun')
@section('breadcrumb-parent', 'Warga')
@section('breadcrumb-current', 'Pengaturan')

@push('styles')
<style>
    /* Tab navigation */
    .settings-tab {
        transition: all 0.2s ease;
        cursor: pointer;
        border-bottom: 2px solid transparent;
    }
    .settings-tab.active {
        color: #00685d;
        border-bottom-color: #00685d;
        font-weight: 600;
    }
    .settings-tab:not(.active):hover {
        color: #3d4947;
        border-bottom-color: #bcc9c6;
    }

    /* Panel transition */
    .settings-panel {
        display: none;
        animation: fadeIn 0.25s ease;
    }
    .settings-panel.active {
        display: block;
    }
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(6px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    /* Input styles */
    .settings-input {
        width: 100%;
        padding: 0.625rem 1rem;
        border-radius: 0.75rem;
        font-size: 0.875rem;
        background-color: #f2f4f6;
        color: #191c1e;
        border: 1.5px solid transparent;
        outline: none;
        transition: border-color 0.2s, background-color 0.2s;
    }
    .settings-input:focus {
        background-color: #fff;
        border-color: #00685d;
        box-shadow: 0 0 0 3px rgba(0, 104, 93, 0.12);
    }
    .settings-input.error {
        border-color: #ba1a1a;
        background-color: #fff;
    }

    /* Password strength indicator */
    .strength-bar {
        height: 4px;
        border-radius: 2px;
        transition: all 0.3s ease;
    }

    /* Avatar upload overlay */
    .avatar-overlay {
        opacity: 0;
        transition: opacity 0.2s;
    }
    .avatar-wrapper:hover .avatar-overlay {
        opacity: 1;
    }
</style>
@endpush

@section('content')

    {{-- PAGE HEADER --}}
    <div class="mb-8">
        <h1 class="font-manrope font-bold text-2xl" style="color: #191c1e;">Pengaturan Akun</h1>
        <p class="text-sm mt-1" style="color: #3d4947;">Kelola profil, keamanan, dan preferensi akun Anda.</p>
    </div>

    {{-- Flash Messages --}}
    @if(session('success'))
        <div class="mb-6 flex items-center gap-3 px-5 py-4 rounded-xl" style="background-color: #c5eeb5; color: #2d4f25;">
            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <p class="text-sm font-semibold">{{ session('success') }}</p>
        </div>
    @endif
    @if($errors->any())
        <div class="mb-6 flex items-start gap-3 px-5 py-4 rounded-xl" style="background-color: #ffdad6; color: #93000a;">
            <svg class="w-5 h-5 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.34 16.5c-.77.833.192 2.5 1.732 2.5z"/>
            </svg>
            <div>
                <p class="text-sm font-semibold mb-1">Ada kesalahan yang perlu diperbaiki:</p>
                <ul class="text-sm list-disc list-inside space-y-0.5">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">

        {{-- LEFT: Profile Summary Card --}}
        <div class="lg:col-span-4">
            <div class="bg-white rounded-[1.5rem] p-8 text-center sticky top-6">

                {{-- Avatar --}}
                <div class="relative inline-block mb-4">
                    <div class="avatar-wrapper relative w-24 h-24 mx-auto rounded-full overflow-hidden cursor-pointer"
                         onclick="document.getElementById('foto-input').click()">
                        @if($warga->foto_profil && file_exists(public_path('storage/' . $warga->foto_profil)))
                            <img src="{{ asset('storage/' . $warga->foto_profil) }}"
                                 alt="Foto Profil"
                                 class="w-full h-full object-cover"
                                 id="avatar-preview">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-3xl font-bold text-white"
                                 style="background: linear-gradient(135deg, #00685d, #008376);"
                                 id="avatar-initials">
                                {{ strtoupper(substr($warga->nama, 0, 1)) }}
                            </div>
                        @endif
                        {{-- Hover Overlay --}}
                        <div class="avatar-overlay absolute inset-0 flex items-center justify-center rounded-full"
                             style="background-color: rgba(0,0,0,0.45);">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                        </div>
                    </div>

                    {{-- Upload form (hidden) --}}
                    <form id="foto-form" method="POST"
                          action="{{ route('warga.settings.foto') }}"
                          enctype="multipart/form-data" class="hidden">
                        @csrf
                        <input type="file" id="foto-input" name="foto_profil"
                               accept="image/jpeg,image/png,image/jpg,image/webp"
                               onchange="previewFoto(this)">
                    </form>
                </div>

                <h2 class="font-manrope font-bold text-lg" style="color: #191c1e;">{{ $warga->nama }}</h2>
                <p class="text-sm mt-1" style="color: #6d7a77;">{{ $user->email }}</p>


                {{-- Quick Info --}}
                <div class="mt-6 space-y-3 text-left">
                    <div class="flex items-center gap-3 px-4 py-3 rounded-xl" style="background-color: #f2f4f6;">
                        <span class="material-icons-outlined text-lg flex-shrink-0" style="color: #6d7a77;">phone</span>
                        <div class="min-w-0">
                            <p class="text-[10px] font-medium uppercase tracking-widest" style="color: #6d7a77;">No. HP</p>
                            <p class="text-sm font-semibold truncate" style="color: #191c1e;">{{ $warga->no_hp ?? '—' }}</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3 px-4 py-3 rounded-xl" style="background-color: #f2f4f6;">
                        <span class="material-icons-outlined text-lg flex-shrink-0" style="color: #6d7a77;">home</span>
                        <div class="min-w-0">
                            <p class="text-[10px] font-medium uppercase tracking-widest" style="color: #6d7a77;">Alamat</p>
                            <p class="text-sm font-semibold truncate" style="color: #191c1e;">{{ $warga->alamat ?? '— Belum diisi' }}</p>
                        </div>
                    </div>
                </div>

                {{-- Foto upload note --}}
                <p class="text-[11px] mt-4" style="color: #bcc9c6;">
                    Klik foto untuk mengganti. Maks. 2 MB (JPG, PNG, WebP).
                </p>
            </div>
        </div>

        {{-- RIGHT: Settings Panels --}}
        <div class="lg:col-span-8">
            <div class="bg-white rounded-[1.5rem] overflow-hidden">

                {{-- Tab Navigation --}}
                <div class="flex border-b px-8" style="border-color: #eceef0;">
                    <button class="settings-tab active px-5 py-4 text-sm"
                            onclick="switchTab('profil', this)" id="tab-profil">
                        <span class="material-icons-outlined text-base align-middle mr-1.5">person</span>
                        Edit Profil
                    </button>
                    <button class="settings-tab px-5 py-4 text-sm" style="color: #6d7a77;"
                            onclick="switchTab('password', this)" id="tab-password">
                        <span class="material-icons-outlined text-base align-middle mr-1.5">lock</span>
                        Ubah Password
                    </button>
                </div>

                {{-- ══ PANEL 1: Edit Profil ══ --}}
                <div id="panel-profil" class="settings-panel active px-8 py-8">
                    <div class="flex items-center gap-2 mb-6">
                        <div class="w-8 h-8 rounded-lg flex items-center justify-center" style="background-color: rgba(0,104,93,0.10);">
                            <span class="material-icons-outlined text-base" style="color: #00685d;">edit</span>
                        </div>
                        <div>
                            <h3 class="font-manrope font-bold text-base" style="color: #191c1e;">Informasi Pribadi</h3>
                            <p class="text-xs" style="color: #6d7a77;">Perbarui data diri Anda yang tampil di sistem.</p>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('warga.settings.profil') }}" class="space-y-5">
                        @csrf

                        {{-- Nama --}}
                        <div>
                            <label class="block text-xs font-semibold uppercase tracking-widest mb-1.5"
                                   style="color: #6d7a77;">Nama Lengkap <span style="color: #ba1a1a;">*</span></label>
                            <input type="text" name="nama"
                                   value="{{ old('nama', $warga->nama) }}"
                                   placeholder="Masukkan nama lengkap"
                                   class="settings-input {{ $errors->has('nama') ? 'error' : '' }}"
                                   required>
                            @error('nama')
                                <p class="text-xs mt-1" style="color: #ba1a1a;">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Email --}}
                        <div>
                            <label class="block text-xs font-semibold uppercase tracking-widest mb-1.5"
                                   style="color: #6d7a77;">Email <span style="color: #ba1a1a;">*</span></label>
                            <input type="email" name="email"
                                   value="{{ old('email', $warga->email) }}"
                                   placeholder="contoh@email.com"
                                   class="settings-input {{ $errors->has('email') ? 'error' : '' }}"
                                   required>
                            @error('email')
                                <p class="text-xs mt-1" style="color: #ba1a1a;">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- No HP --}}
                        <div>
                            <label class="block text-xs font-semibold uppercase tracking-widest mb-1.5"
                                   style="color: #6d7a77;">Nomor HP <span style="color: #ba1a1a;">*</span></label>
                            <input type="text" name="no_hp"
                                   value="{{ old('no_hp', $warga->no_hp) }}"
                                   placeholder="08xxxxxxxxxx"
                                   class="settings-input {{ $errors->has('no_hp') ? 'error' : '' }}"
                                   required>
                            @error('no_hp')
                                <p class="text-xs mt-1" style="color: #ba1a1a;">{{ $message }}</p>
                            @enderror
                            <p class="text-xs mt-1" style="color: #bcc9c6;">Format: 08xxxxxxxxxx atau +628xxxxxxxxx</p>
                        </div>

                        {{-- Alamat --}}
                        <div>
                            <label class="block text-xs font-semibold uppercase tracking-widest mb-1.5"
                                   style="color: #6d7a77;">Alamat Lengkap</label>
                            <textarea name="alamat" rows="3"
                                      placeholder="Jl. Contoh No. 1, RT 06..."
                                      class="settings-input resize-none {{ $errors->has('alamat') ? 'error' : '' }}"
                                      style="padding-top: 0.75rem;">{{ old('alamat', $warga->alamat) }}</textarea>
                            @error('alamat')
                                <p class="text-xs mt-1" style="color: #ba1a1a;">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Submit --}}
                        <div class="flex items-center justify-between pt-2">
                            <p class="text-xs" style="color: #bcc9c6;"><span style="color: #ba1a1a;">*</span> Wajib diisi</p>
                            <button type="submit"
                                    class="inline-flex items-center gap-2 px-6 py-2.5 rounded-xl text-sm font-semibold text-white transition-all hover:shadow-md hover:-translate-y-0.5"
                                    style="background: linear-gradient(135deg, #00685d, #008376);">
                                <span class="material-icons-outlined text-base">save</span>
                                Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>

                {{-- ══ PANEL 2: Ubah Password ══ --}}
                <div id="panel-password" class="settings-panel px-8 py-8">
                    <div class="flex items-center gap-2 mb-6">
                        <div class="w-8 h-8 rounded-lg flex items-center justify-center" style="background-color: rgba(43,100,133,0.10);">
                            <span class="material-icons-outlined text-base" style="color: #2b6485;">lock</span>
                        </div>
                        <div>
                            <h3 class="font-manrope font-bold text-base" style="color: #191c1e;">Ubah Password</h3>
                            <p class="text-xs" style="color: #6d7a77;">Gunakan password yang kuat dan unik.</p>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('warga.settings.password') }}" class="space-y-5">
                        @csrf

                        {{-- Password Saat Ini --}}
                        <div>
                            <label class="block text-xs font-semibold uppercase tracking-widest mb-1.5"
                                   style="color: #6d7a77;">Password Saat Ini <span style="color: #ba1a1a;">*</span></label>
                            <div class="relative">
                                <input type="password" name="current_password" id="current-pw"
                                       placeholder="Masukkan password saat ini"
                                       class="settings-input pr-12 {{ $errors->has('current_password') ? 'error' : '' }}"
                                       required>
                                <button type="button" onclick="togglePw('current-pw', this)"
                                        class="absolute right-3 top-1/2 -translate-y-1/2 p-1">
                                    <span class="material-icons-outlined text-xl" style="color: #bcc9c6;">visibility_off</span>
                                </button>
                            </div>
                            @error('current_password')
                                <p class="text-xs mt-1" style="color: #ba1a1a;">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Password Baru --}}
                        <div>
                            <label class="block text-xs font-semibold uppercase tracking-widest mb-1.5"
                                   style="color: #6d7a77;">Password Baru <span style="color: #ba1a1a;">*</span></label>
                            <div class="relative">
                                <input type="password" name="password" id="new-pw"
                                       placeholder="Minimal 8 karakter"
                                       class="settings-input pr-12 {{ $errors->has('password') ? 'error' : '' }}"
                                       oninput="checkStrength(this.value)"
                                       required minlength="8">
                                <button type="button" onclick="togglePw('new-pw', this)"
                                        class="absolute right-3 top-1/2 -translate-y-1/2 p-1">
                                    <span class="material-icons-outlined text-xl" style="color: #bcc9c6;">visibility_off</span>
                                </button>
                            </div>
                            @error('password')
                                <p class="text-xs mt-1" style="color: #ba1a1a;">{{ $message }}</p>
                            @enderror

                            {{-- Strength Indicator --}}
                            <div class="mt-2 space-y-1.5" id="strength-wrap" style="display: none;">
                                <div class="flex gap-1">
                                    <div class="strength-bar flex-1" id="bar1" style="background-color: #e0e3e5;"></div>
                                    <div class="strength-bar flex-1" id="bar2" style="background-color: #e0e3e5;"></div>
                                    <div class="strength-bar flex-1" id="bar3" style="background-color: #e0e3e5;"></div>
                                    <div class="strength-bar flex-1" id="bar4" style="background-color: #e0e3e5;"></div>
                                </div>
                                <p class="text-[11px]" id="strength-text" style="color: #6d7a77;"></p>
                            </div>
                        </div>

                        {{-- Konfirmasi Password --}}
                        <div>
                            <label class="block text-xs font-semibold uppercase tracking-widest mb-1.5"
                                   style="color: #6d7a77;">Konfirmasi Password Baru <span style="color: #ba1a1a;">*</span></label>
                            <div class="relative">
                                <input type="password" name="password_confirmation" id="confirm-pw"
                                       placeholder="Ulangi password baru"
                                       class="settings-input pr-12"
                                       required>
                                <button type="button" onclick="togglePw('confirm-pw', this)"
                                        class="absolute right-3 top-1/2 -translate-y-1/2 p-1">
                                    <span class="material-icons-outlined text-xl" style="color: #bcc9c6;">visibility_off</span>
                                </button>
                            </div>
                        </div>

                        {{-- Tips --}}
                        <div class="rounded-xl p-4" style="background-color: #f2f4f6;">
                            <p class="text-xs font-semibold mb-1.5" style="color: #191c1e;">Tips password yang kuat:</p>
                            <ul class="text-xs space-y-1" style="color: #6d7a77;">
                                <li>✓ Minimal 8 karakter</li>
                                <li>✓ Kombinasi huruf besar dan kecil</li>
                                <li>✓ Tambahkan angka dan simbol (!@#$)</li>
                                <li>✓ Jangan gunakan tanggal lahir atau nama</li>
                            </ul>
                        </div>

                        {{-- Submit --}}
                        <div class="flex justify-end pt-2">
                            <button type="submit"
                                    class="inline-flex items-center gap-2 px-6 py-2.5 rounded-xl text-sm font-semibold text-white transition-all hover:shadow-md hover:-translate-y-0.5"
                                    style="background: linear-gradient(135deg, #2b6485, #3a82a8);">
                                <span class="material-icons-outlined text-base">lock_reset</span>
                                Ubah Password
                            </button>
                        </div>
                    </form>
                </div>

            </div>{{-- end .bg-white --}}
        </div>
    </div>

@endsection

@push('scripts')
<script>
// ── Tab switching ─────────────────────────────────────────────
function switchTab(tab, btn) {
    // Reset all tabs
    document.querySelectorAll('.settings-tab').forEach(t => {
        t.classList.remove('active');
        t.style.color = '#6d7a77';
    });
    // Reset all panels
    document.querySelectorAll('.settings-panel').forEach(p => p.classList.remove('active'));

    // Activate selected
    btn.classList.add('active');
    btn.style.color = '';
    document.getElementById('panel-' + tab).classList.add('active');

    // If switching to password tab and there are password errors, show it
}

// ── Auto-open panel based on errors ─────────────────────────────
document.addEventListener('DOMContentLoaded', function () {
    @if($errors->has('current_password') || $errors->has('password'))
        switchTab('password', document.getElementById('tab-password'));
    @endif
});

// ── Toggle password visibility ───────────────────────────────────
function togglePw(inputId, btn) {
    const input = document.getElementById(inputId);
    const icon  = btn.querySelector('.material-icons-outlined');
    if (input.type === 'password') {
        input.type = 'text';
        icon.textContent = 'visibility';
    } else {
        input.type = 'password';
        icon.textContent = 'visibility_off';
    }
}

// ── Password strength checker ────────────────────────────────────
function checkStrength(pw) {
    const wrap = document.getElementById('strength-wrap');
    const bars = [document.getElementById('bar1'), document.getElementById('bar2'),
                  document.getElementById('bar3'), document.getElementById('bar4')];
    const text = document.getElementById('strength-text');

    if (pw.length === 0) { wrap.style.display = 'none'; return; }
    wrap.style.display = 'block';

    let score = 0;
    if (pw.length >= 8)                       score++;
    if (/[A-Z]/.test(pw) && /[a-z]/.test(pw)) score++;
    if (/[0-9]/.test(pw))                     score++;
    if (/[^A-Za-z0-9]/.test(pw))             score++;

    const colors = ['#ba1a1a', '#e67e22', '#f1c40f', '#00685d'];
    const labels = ['Sangat Lemah', 'Lemah', 'Cukup Kuat', 'Sangat Kuat'];

    bars.forEach((bar, i) => {
        bar.style.backgroundColor = i < score ? colors[score - 1] : '#e0e3e5';
    });
    text.textContent = labels[score - 1] || '';
    text.style.color = colors[score - 1] || '#6d7a77';
}

// ── Foto profil preview & upload ─────────────────────────────────
function previewFoto(input) {
    if (!input.files || !input.files[0]) return;

    const file = input.files[0];
    const maxSize = 2 * 1024 * 1024; // 2 MB

    if (file.size > maxSize) {
        alert('Ukuran file terlalu besar. Maksimal 2 MB.');
        input.value = '';
        return;
    }

    const reader = new FileReader();
    reader.onload = function (e) {
        // Replace avatar display
        const wrapper = input.closest('.avatar-wrapper') ||
                        document.querySelector('.avatar-wrapper');
        const initials = document.getElementById('avatar-initials');
        const preview  = document.getElementById('avatar-preview');

        if (initials) {
            initials.outerHTML = `<img src="${e.target.result}" id="avatar-preview"
                class="w-full h-full object-cover" alt="Preview">`;
        } else if (preview) {
            preview.src = e.target.result;
        }
    };
    reader.readAsDataURL(file);

    // Auto-submit the hidden form
    document.getElementById('foto-form').submit();
}
</script>
@endpush
