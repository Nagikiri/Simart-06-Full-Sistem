@extends('layouts.app')

@section('title', 'Pengaturan Akun RT')
@section('breadcrumb-parent', 'Dashboard RT')
@section('breadcrumb-current', 'Pengaturan')

@push('styles')
<style>
    .settings-tab {
        transition: all 0.2s ease;
        cursor: pointer;
        border-bottom: 2px solid transparent;
        padding-bottom: 0.75rem;
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

    /* Strength meter */
    .strength-bar { height: 4px; border-radius: 999px; transition: width 0.35s, background-color 0.35s; }

    /* Avatar upload */
    .avatar-wrap { position: relative; display: inline-block; cursor: pointer; }
    .avatar-wrap:hover .avatar-overlay { opacity: 1; }
    .avatar-overlay {
        position: absolute; inset: 0; border-radius: 1rem;
        background: rgba(0,104,93,0.55); display: flex; align-items: center;
        justify-content: center; opacity: 0; transition: opacity 0.2s;
    }
</style>
@endpush

@section('content')

    {{-- PAGE HEADER --}}
    <div class="mb-8">
        <h1 class="font-manrope font-bold text-2xl" style="color: #191c1e;">Pengaturan Akun</h1>
        <p class="text-sm mt-1" style="color: #3d4947;">Kelola profil, keamanan, dan preferensi akun RT Anda.</p>
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
                <p class="text-sm font-semibold mb-1">Ada kesalahan:</p>
                <ul class="text-sm list-disc list-inside space-y-0.5">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">

        {{-- ── LEFT: Profile Card ──────────────────────────────────── --}}
        <div class="lg:col-span-4">
            {{-- Avatar Card --}}
            <div class="bg-white rounded-[1.5rem] p-8 text-center mb-6">
                {{-- Avatar with upload --}}
                @php $rtUser = auth()->user(); @endphp
                <form method="POST" action="{{ route('rt.settings.foto') }}" enctype="multipart/form-data" id="foto-form-rt">
                    @csrf
                    <div class="flex flex-col items-center gap-3">
                        <label class="avatar-wrap" for="foto-rt-input" title="Klik untuk ganti foto">
                            @if($rtUser->warga && $rtUser->warga->foto_profil)
                                <img src="{{ asset('storage/' . $rtUser->warga->foto_profil) }}"
                                     alt="Foto Profil RT"
                                     class="w-24 h-24 rounded-2xl object-cover shadow-md" id="foto-preview-rt">
                            @else
                                <div class="w-24 h-24 rounded-2xl flex items-center justify-center text-3xl font-bold text-white"
                                     style="background:linear-gradient(135deg,#00685d,#008376);" id="foto-initials-rt">
                                    {{ strtoupper(substr($rtUser->name ?? 'R', 0, 2)) }}
                                </div>
                                <img src="" alt="" class="w-24 h-24 rounded-2xl object-cover shadow-md hidden" id="foto-preview-rt">
                            @endif
                            <div class="avatar-overlay rounded-2xl">
                                <span class="material-icons-outlined text-white text-2xl">photo_camera</span>
                            </div>
                        </label>
                        <input type="file" id="foto-rt-input" name="foto_profil" accept="image/*" class="hidden">
                        <p class="text-xs" style="color: #6d7a77;">Klik foto untuk mengganti</p>
                    </div>
                </form>

                <h2 class="font-manrope font-bold text-lg mt-4" style="color:#191c1e;">{{ $rtUser->name ?? 'Ketua RT' }}</h2>
                <p class="text-sm mt-1" style="color:#6d7a77;">Ketua RT 06</p>
                <div class="mt-3 text-xs" style="color:#6d7a77;">
                    <p>{{ $rtUser->email }}</p>
                </div>
            </div>

            {{-- Pengaturan Notifikasi --}}
            <div class="bg-white rounded-[1.5rem] p-6">
                <h3 class="font-manrope font-bold text-sm mb-4" style="color:#191c1e;">Pengaturan Notifikasi</h3>
                <div class="space-y-1">
                    @foreach([
                        ['notif-1','Pengajuan surat masuk','Notifikasi saat warga mengajukan surat baru',true],
                        ['notif-2','Warga baru terdaftar','Notifikasi saat ada warga baru mendaftar',true],
                        ['notif-3','Aduan warga','Notifikasi saat ada aduan baru masuk',true],
                        ['notif-4','Pengumuman RT','Notifikasi saat ada pengumuman baru',false],
                    ] as [$id, $label, $desc, $checked])
                    <div class="flex items-center justify-between py-3" style="{{ !$loop->last ? 'border-bottom:1px solid #eceef0;' : '' }}">
                        <div class="flex-1 min-w-0 pr-4">
                            <p class="text-sm font-semibold" style="color:#191c1e;">{{ $label }}</p>
                            <p class="text-xs mt-0.5" style="color:#6d7a77;">{{ $desc }}</p>
                        </div>
                        <button type="button"
                                id="{{ $id }}"
                                role="switch"
                                aria-checked="{{ $checked ? 'true' : 'false' }}"
                                onclick="toggleSwitch('{{ $id }}')"
                                class="flex-shrink-0 relative inline-flex h-7 w-12 items-center rounded-full transition-colors duration-200 focus:outline-none"
                                style="background-color: {{ $checked ? '#00685d' : '#d1d5db' }};">
                            <span class="inline-block h-5 w-5 transform rounded-full bg-white shadow-md transition-transform duration-200"
                                  style="transform: translateX({{ $checked ? '22px' : '2px' }});"></span>
                        </button>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- ── RIGHT: Tabs ─────────────────────────────────────────── --}}
        <div class="lg:col-span-8">
            <div class="bg-white rounded-[1.5rem] overflow-hidden">
                {{-- Tab Nav --}}
                <div class="flex gap-6 px-8 pt-6" style="border-bottom: 1px solid #eceef0;">
                    <button class="settings-tab active text-sm pb-3" onclick="switchTab('profil', this)" id="tab-profil">
                        Edit Profil
                    </button>
                    <button class="settings-tab text-sm pb-3" onclick="switchTab('password', this)" id="tab-password">
                        Ubah Password
                    </button>
                    <button class="settings-tab text-sm pb-3" onclick="switchTab('ttd', this)" id="tab-ttd">
                        ✍️ Tanda Tangan
                    </button>
                </div>

                {{-- Panel: Edit Profil --}}
                <div class="settings-panel active px-8 py-6" id="panel-profil">
                    <form method="POST" action="{{ route('rt.settings.profil') }}">
                        @csrf
                        <div class="space-y-4">
                            {{-- Nama --}}
                            <div>
                                <label class="text-xs font-semibold uppercase tracking-widest block mb-1.5" style="color:#6d7a77;">Nama Lengkap</label>
                                <input type="text" name="name" value="{{ old('name', $rtUser->name) }}"
                                       class="settings-input @error('name') error @enderror"
                                       placeholder="Masukkan nama lengkap" required>
                                @error('name')<p class="text-xs mt-1" style="color:#ba1a1a;">{{ $message }}</p>@enderror
                            </div>

                            {{-- Email --}}
                            <div>
                                <label class="text-xs font-semibold uppercase tracking-widest block mb-1.5" style="color:#6d7a77;">Alamat Email</label>
                                <input type="email" name="email" value="{{ old('email', $rtUser->email) }}"
                                       class="settings-input @error('email') error @enderror"
                                       placeholder="email@contoh.com" required>
                                @error('email')<p class="text-xs mt-1" style="color:#ba1a1a;">{{ $message }}</p>@enderror
                            </div>

                            {{-- No HP --}}
                            <div>
                                <label class="text-xs font-semibold uppercase tracking-widest block mb-1.5" style="color:#6d7a77;">Nomor HP (WhatsApp)</label>
                                <input type="text" name="no_hp"
                                       value="{{ old('no_hp', $rtUser->warga->no_hp ?? '') }}"
                                       class="settings-input @error('no_hp') error @enderror"
                                       placeholder="08xxxxxxxxx">
                                @error('no_hp')<p class="text-xs mt-1" style="color:#ba1a1a;">{{ $message }}</p>@enderror
                            </div>

                            {{-- Alamat --}}
                            <div>
                                <label class="text-xs font-semibold uppercase tracking-widest block mb-1.5" style="color:#6d7a77;">Alamat</label>
                                <input type="text" name="alamat"
                                       value="{{ old('alamat', $rtUser->warga->alamat ?? '') }}"
                                       class="settings-input @error('alamat') error @enderror"
                                       placeholder="Jl. ...">
                                @error('alamat')<p class="text-xs mt-1" style="color:#ba1a1a;">{{ $message }}</p>@enderror
                            </div>

                            <div class="pt-2">
                                <button type="submit"
                                        class="px-6 py-2.5 rounded-xl text-sm font-semibold text-white transition-all hover:shadow-md"
                                        style="background:linear-gradient(135deg,#00685d,#008376);">
                                    Simpan Profil
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

                {{-- Panel: Tanda Tangan --}}
                <div class="settings-panel px-8 py-6" id="panel-ttd">
                    <div class="space-y-5">
                        <div>
                            <h3 class="font-bold text-sm mb-1" style="color:#191c1e;">Tanda Tangan Digital RT</h3>
                            <p class="text-xs" style="color:#6d7a77;">Upload file tanda tangan Anda (format PNG transparan, maks. 2MB). Tanda tangan ini akan otomatis tercetak di setiap surat yang Anda setujui.</p>
                        </div>

                        {{-- Preview TTD yang sudah ada --}}
                        @php $rt = auth()->user()->warga; @endphp
                        @if($rt && $rt->tanda_tangan)
                        <div class="rounded-xl p-4 flex items-center justify-between" style="background:#f0faf8; border:1px dashed #00685d;">
                            <div>
                                <p class="text-xs font-semibold mb-2" style="color:#00685d;">✅ Tanda tangan aktif saat ini:</p>
                                <img src="{{ asset('storage/' . $rt->tanda_tangan) }}" alt="Tanda Tangan RT" class="h-16 object-contain">
                            </div>
                        </div>
                        @else
                        <div class="rounded-xl p-4" style="background:#fff8e1; border:1px dashed #f59e0b;">
                            <p class="text-xs font-semibold" style="color:#92400e;">⚠️ Belum ada tanda tangan. Saat ini sistem menggunakan teks otomatis (nama RT) sebagai penanda di surat.</p>
                        </div>
                        @endif

                        <form method="POST" action="{{ route('rt.settings.ttd') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="space-y-4">
                                <div>
                                    <label class="text-xs font-semibold uppercase tracking-widest block mb-1.5" style="color:#6d7a77;">Upload Tanda Tangan Baru (PNG)</label>
                                    <input type="file" name="tanda_tangan" accept="image/png,image/jpeg" required
                                           class="w-full text-sm file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:font-semibold file:text-white"
                                           style="file:background:#00685d;">
                                    <p class="text-[11px] mt-1" style="color:#bcc9c6;">Disarankan: PNG dengan latar transparan. Ukuran ideal: 300x150px.</p>
                                </div>
                                <button type="submit"
                                        class="px-6 py-2.5 rounded-xl text-sm font-semibold text-white transition-all hover:shadow-md"
                                        style="background:linear-gradient(135deg,#00685d,#008376);">
                                    Simpan Tanda Tangan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                {{-- Panel: Ubah Password --}}
                <div class="settings-panel px-8 py-6" id="panel-password">
                    <form method="POST" action="{{ route('rt.settings.password') }}">
                        @csrf
                        <div class="space-y-4">
                            {{-- Password Lama --}}
                            <div>
                                <label class="text-xs font-semibold uppercase tracking-widest block mb-1.5" style="color:#6d7a77;">Password Saat Ini</label>
                                <input type="password" name="current_password"
                                       class="settings-input @error('current_password') error @enderror"
                                       placeholder="Masukkan password saat ini" autocomplete="current-password">
                                @error('current_password')<p class="text-xs mt-1" style="color:#ba1a1a;">{{ $message }}</p>@enderror
                            </div>

                            {{-- Password Baru --}}
                            <div>
                                <label class="text-xs font-semibold uppercase tracking-widest block mb-1.5" style="color:#6d7a77;">Password Baru</label>
                                <input type="password" name="password" id="pw-new-rt"
                                       class="settings-input @error('password') error @enderror"
                                       placeholder="Min. 8 karakter" autocomplete="new-password"
                                       oninput="checkStrength(this.value, 'strength-rt')">
                                @error('password')<p class="text-xs mt-1" style="color:#ba1a1a;">{{ $message }}</p>@enderror
                                {{-- Strength Meter --}}
                                <div class="mt-2 space-y-1">
                                    <div class="w-full rounded-full" style="background:#eceef0; height:4px;">
                                        <div id="strength-rt" class="strength-bar" style="width:0%;background:#ba1a1a;"></div>
                                    </div>
                                    <p id="strength-rt-label" class="text-[11px]" style="color:#6d7a77;"></p>
                                </div>
                            </div>

                            {{-- Konfirmasi --}}
                            <div>
                                <label class="text-xs font-semibold uppercase tracking-widest block mb-1.5" style="color:#6d7a77;">Konfirmasi Password Baru</label>
                                <input type="password" name="password_confirmation"
                                       class="settings-input"
                                       placeholder="Ulangi password baru" autocomplete="new-password">
                            </div>

                            <div class="pt-2">
                                <button type="submit"
                                        class="px-6 py-2.5 rounded-xl text-sm font-semibold text-white transition-all hover:shadow-md"
                                        style="background:linear-gradient(135deg,#00685d,#008376);">
                                    Ubah Password
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Keamanan / Sesi --}}
            <div class="bg-white rounded-[1.5rem] p-6 mt-6">
                <h3 class="font-manrope font-bold text-sm mb-4" style="color:#191c1e;">Keamanan Akun</h3>
                <div class="flex items-center justify-between py-3" style="border-bottom:1px solid #eceef0;">
                    <div>
                        <p class="text-sm font-semibold" style="color:#191c1e;">Sesi Aktif</p>
                        <p class="text-xs mt-0.5" style="color:#6d7a77;">Perangkat ini • Login terakhir hari ini</p>
                    </div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-xs font-semibold px-4 py-2 rounded-xl transition-colors"
                                style="background-color:#ffdad6;color:#93000a;">Keluar</button>
                    </form>
                </div>
            </div>
        </div>

    </div>

@endsection

@push('scripts')
<script>
function switchTab(name, el) {
    document.querySelectorAll('.settings-panel').forEach(p => p.classList.remove('active'));
    document.querySelectorAll('.settings-tab').forEach(t => t.classList.remove('active'));
    document.getElementById('panel-' + name).classList.add('active');
    el.classList.add('active');
}

function toggleSwitch(id) {
    const btn = document.getElementById(id);
    const isOn = btn.getAttribute('aria-checked') === 'true';
    btn.setAttribute('aria-checked', isOn ? 'false' : 'true');
    btn.style.backgroundColor = isOn ? '#d1d5db' : '#00685d';
    btn.querySelector('span').style.transform = isOn ? 'translateX(2px)' : 'translateX(22px)';
}

function checkStrength(val, barId) {
    let score = 0;
    if (val.length >= 8) score++;
    if (/[A-Z]/.test(val)) score++;
    if (/[0-9]/.test(val)) score++;
    if (/[^A-Za-z0-9]/.test(val)) score++;
    const colors = ['#ba1a1a','#e8a000','#2b6485','#416538'];
    const labels = ['Lemah','Cukup','Kuat','Sangat Kuat'];
    const bar = document.getElementById(barId);
    const lbl = document.getElementById(barId + '-label');
    if (val.length === 0) { bar.style.width='0%'; lbl.textContent=''; return; }
    bar.style.width = (score * 25) + '%';
    bar.style.backgroundColor = colors[score - 1] || colors[0];
    lbl.textContent = labels[score - 1] || labels[0];
    lbl.style.color = colors[score - 1] || colors[0];
}

// Photo upload RT
const fotoInputRT = document.getElementById('foto-rt-input');
if (fotoInputRT) {
    fotoInputRT.addEventListener('change', function () {
        if (!this.files[0]) return;
        const reader = new FileReader();
        reader.onload = e => {
            const preview = document.getElementById('foto-preview-rt');
            const initials = document.getElementById('foto-initials-rt');
            preview.src = e.target.result;
            preview.classList.remove('hidden');
            if (initials) initials.classList.add('hidden');
        };
        reader.readAsDataURL(this.files[0]);
        document.getElementById('foto-form-rt').submit();
    });
}

// If URL has #password hash, open password tab
if (window.location.hash === '#password') {
    switchTab('password', document.getElementById('tab-password'));
}
</script>
@endpush
