@extends('layouts.app')

@section('title', 'Profil Saya')
@section('breadcrumb-parent', 'Warga')
@section('breadcrumb-current', 'Settings')

@section('content')

    {{-- PAGE HEADER --}}
    <div class="mb-8">
        <h1 class="font-manrope font-bold text-2xl" style="color: #191c1e;">Profil Saya</h1>
        <p class="text-sm mt-1" style="color: #3d4947;">Kelola informasi akun dan data pribadi Anda.</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- LEFT: Avatar + Quick Info --}}
        <div class="lg:col-span-1">
            <div class="bg-white rounded-[1.5rem] p-8 text-center">
                <div class="w-20 h-20 rounded-full mx-auto flex items-center justify-center text-2xl font-bold mb-4"
                     style="background: linear-gradient(135deg, #00685d, #008376); color: #fff;">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
                <h2 class="font-manrope font-bold text-lg" style="color: #191c1e;">{{ Auth::user()->name }}</h2>
                <p class="text-sm mt-1" style="color: #6d7a77;">Warga RT 06</p>
                <span class="inline-flex items-center mt-3 px-3 py-1 rounded-full text-[11px] font-semibold"
                      style="background-color: #c5eeb5; color: #2d4f25;">
                    ● Terverifikasi
                </span>
                <div class="mt-6">
                    <button onclick="openEditModal()"
                            class="w-full inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl text-sm font-semibold text-white transition-all hover:shadow-md"
                            style="background: linear-gradient(135deg, #00685d, #008376);">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                        Edit Profil
                    </button>
                </div>
            </div>
        </div>

        {{-- RIGHT: Detail Info --}}
        <div class="lg:col-span-2 space-y-4">
            <div class="bg-white rounded-[1.5rem] p-8">
                <h3 class="font-manrope font-bold text-base mb-6" style="color: #191c1e;">Informasi Pribadi</h3>
                <div class="space-y-5">
                    <div class="flex items-center justify-between py-3" style="border-bottom: 1px solid #eceef0;">
                        <div>
                            <p class="text-xs font-medium uppercase tracking-widest" style="color: #6d7a77;">Nama Lengkap</p>
                            <p class="text-sm font-semibold mt-1" style="color: #191c1e;">{{ Auth::user()->name }}</p>
                        </div>
                        <span class="material-icons-outlined text-lg" style="color: #bcc9c6;">person</span>
                    </div>
                    <div class="flex items-center justify-between py-3" style="border-bottom: 1px solid #eceef0;">
                        <div>
                            <p class="text-xs font-medium uppercase tracking-widest" style="color: #6d7a77;">Email</p>
                            <p class="text-sm font-semibold mt-1" style="color: #191c1e;">{{ Auth::user()->email }}</p>
                        </div>
                        <span class="material-icons-outlined text-lg" style="color: #bcc9c6;">email</span>
                    </div>
                    <div class="flex items-center justify-between py-3" style="border-bottom: 1px solid #eceef0;">
                        <div>
                            <p class="text-xs font-medium uppercase tracking-widest" style="color: #6d7a77;">NIK</p>
                            <p class="text-sm font-semibold mt-1" style="color: #191c1e;">{{ Auth::user()->nik ?? '— Belum diisi' }}</p>
                        </div>
                        <span class="material-icons-outlined text-lg" style="color: #bcc9c6;">badge</span>
                    </div>
                    <div class="flex items-center justify-between py-3">
                        <div>
                            <p class="text-xs font-medium uppercase tracking-widest" style="color: #6d7a77;">Alamat</p>
                            <p class="text-sm font-semibold mt-1" style="color: #191c1e;">{{ Auth::user()->alamat ?? '— Belum diisi' }}</p>
                        </div>
                        <span class="material-icons-outlined text-lg" style="color: #bcc9c6;">home</span>
                    </div>
                </div>
            </div>

            {{-- Keamanan Akun --}}
            <div class="bg-white rounded-[1.5rem] p-8">
                <h3 class="font-manrope font-bold text-base mb-4" style="color: #191c1e;">Keamanan Akun</h3>
                <div class="flex items-center justify-between py-3" style="border-bottom: 1px solid #eceef0;">
                    <div>
                        <p class="text-sm font-semibold" style="color: #191c1e;">Password</p>
                        <p class="text-xs mt-0.5" style="color: #6d7a77;">Terakhir diubah: —</p>
                    </div>
                    <button onclick="openPasswordModal()"
                            class="text-xs font-semibold px-4 py-2 rounded-xl transition-colors hover:bg-[#00685d] hover:text-white"
                            style="background-color: #eceef0; color: #3d4947;">
                        Ganti Password
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- MODAL EDIT PROFIL --}}
    <div id="modal-edit" class="fixed inset-0 z-50 hidden items-center justify-center p-4"
         style="background-color: rgba(25,28,30,0.5); backdrop-filter: blur(4px);">
        <div class="w-full max-w-lg rounded-[1.5rem] shadow-2xl overflow-hidden" style="background-color: #fff;">
            <div class="flex items-center justify-between px-6 pt-6 pb-4" style="border-bottom: 1px solid #eceef0;">
                <h2 class="font-manrope font-bold text-base" style="color: #191c1e;">Edit Profil</h2>
                <button onclick="closeEditModal()" class="w-8 h-8 rounded-lg flex items-center justify-center transition-colors hover:bg-[#eceef0]">
                    <svg class="w-4 h-4" style="color: #6d7a77;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            <form method="POST" action="{{ route('profile.update') }}" class="px-6 py-5 space-y-4">
                @csrf @method('PATCH')
                <div>
                    <label class="text-xs font-medium uppercase tracking-widest block mb-1.5" style="color: #6d7a77;">Nama Lengkap</label>
                    <input type="text" name="name" value="{{ Auth::user()->name }}" required
                           class="w-full px-4 py-2.5 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#00685d]/30"
                           style="background-color: #f2f4f6; color: #191c1e; border: none;">
                </div>
                <div>
                    <label class="text-xs font-medium uppercase tracking-widest block mb-1.5" style="color: #6d7a77;">Email</label>
                    <input type="email" name="email" value="{{ Auth::user()->email }}" required
                           class="w-full px-4 py-2.5 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#00685d]/30"
                           style="background-color: #f2f4f6; color: #191c1e; border: none;">
                </div>
                <div>
                    <label class="text-xs font-medium uppercase tracking-widest block mb-1.5" style="color: #6d7a77;">NIK</label>
                    <input type="text" name="nik" value="{{ Auth::user()->nik ?? '' }}" maxlength="16" placeholder="16 digit NIK"
                           class="w-full px-4 py-2.5 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#00685d]/30"
                           style="background-color: #f2f4f6; color: #191c1e; border: none;">
                </div>
                <div>
                    <label class="text-xs font-medium uppercase tracking-widest block mb-1.5" style="color: #6d7a77;">Alamat</label>
                    <textarea name="alamat" rows="2" placeholder="Alamat lengkap"
                              class="w-full px-4 py-2.5 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#00685d]/30 resize-none"
                              style="background-color: #f2f4f6; color: #191c1e; border: none;">{{ Auth::user()->alamat ?? '' }}</textarea>
                </div>
                <div class="flex gap-3 pt-2">
                    <button type="button" onclick="closeEditModal()"
                            class="flex-1 px-4 py-2.5 rounded-xl text-sm font-semibold"
                            style="background-color: #eceef0; color: #3d4947;">Batal</button>
                    <button type="submit"
                            class="flex-1 px-4 py-2.5 rounded-xl text-sm font-semibold text-white transition-all hover:shadow-md"
                            style="background: linear-gradient(135deg, #00685d, #008376);">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>

    {{-- MODAL GANTI PASSWORD --}}
    <div id="modal-password" class="fixed inset-0 z-50 hidden items-center justify-center p-4"
         style="background-color: rgba(25,28,30,0.5); backdrop-filter: blur(4px);">
        <div class="w-full max-w-md rounded-[1.5rem] shadow-2xl overflow-hidden" style="background-color: #fff;">
            <div class="flex items-center justify-between px-6 pt-6 pb-4" style="border-bottom: 1px solid #eceef0;">
                <h2 class="font-manrope font-bold text-base" style="color: #191c1e;">Ganti Password</h2>
                <button onclick="closePasswordModal()" class="w-8 h-8 rounded-lg flex items-center justify-center transition-colors hover:bg-[#eceef0]">
                    <svg class="w-4 h-4" style="color: #6d7a77;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            <form method="POST" action="{{ route('profile.update') }}" class="px-6 py-5 space-y-4">
                @csrf @method('PUT')
                <div>
                    <label class="text-xs font-medium uppercase tracking-widest block mb-1.5" style="color: #6d7a77;">Password Saat Ini</label>
                    <input type="password" name="current_password" required
                           class="w-full px-4 py-2.5 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#00685d]/30"
                           style="background-color: #f2f4f6; color: #191c1e; border: none;">
                </div>
                <div>
                    <label class="text-xs font-medium uppercase tracking-widest block mb-1.5" style="color: #6d7a77;">Password Baru</label>
                    <input type="password" name="password" required
                           class="w-full px-4 py-2.5 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#00685d]/30"
                           style="background-color: #f2f4f6; color: #191c1e; border: none;">
                </div>
                <div>
                    <label class="text-xs font-medium uppercase tracking-widest block mb-1.5" style="color: #6d7a77;">Konfirmasi Password Baru</label>
                    <input type="password" name="password_confirmation" required
                           class="w-full px-4 py-2.5 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#00685d]/30"
                           style="background-color: #f2f4f6; color: #191c1e; border: none;">
                </div>
                <div class="flex gap-3 pt-2">
                    <button type="button" onclick="closePasswordModal()"
                            class="flex-1 px-4 py-2.5 rounded-xl text-sm font-semibold"
                            style="background-color: #eceef0; color: #3d4947;">Batal</button>
                    <button type="submit"
                            class="flex-1 px-4 py-2.5 rounded-xl text-sm font-semibold text-white"
                            style="background: linear-gradient(135deg, #00685d, #008376);">Simpan</button>
                </div>
            </form>
        </div>
    </div>

@push('scripts')
<script>
function openEditModal()      { const m = document.getElementById('modal-edit');     m.classList.remove('hidden'); m.classList.add('flex'); document.body.style.overflow='hidden'; }
function closeEditModal()     { const m = document.getElementById('modal-edit');     m.classList.add('hidden'); m.classList.remove('flex'); document.body.style.overflow=''; }
function openPasswordModal()  { const m = document.getElementById('modal-password'); m.classList.remove('hidden'); m.classList.add('flex'); document.body.style.overflow='hidden'; }
function closePasswordModal() { const m = document.getElementById('modal-password'); m.classList.add('hidden'); m.classList.remove('flex'); document.body.style.overflow=''; }

['modal-edit','modal-password'].forEach(id => {
    document.getElementById(id).addEventListener('click', function(e) { if(e.target===this) { closeEditModal(); closePasswordModal(); } });
});
document.addEventListener('keydown', e => { if(e.key==='Escape'){ closeEditModal(); closePasswordModal(); } });
</script>
@endpush

@endsection
