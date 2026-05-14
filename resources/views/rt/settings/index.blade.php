@extends('layouts.app')

@section('title', 'Pengaturan RT')
@section('breadcrumb-parent', 'RT')
@section('breadcrumb-current', 'Settings')

@section('content')

    <div class="mb-8">
        <h1 class="font-manrope font-bold text-2xl" style="color:#191c1e;">Pengaturan RT</h1>
        <p class="text-sm mt-1" style="color:#6d7a77;">Kelola informasi, notifikasi, dan keamanan akun RT 06.</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- LEFT: Profile RT --}}
        <div class="lg:col-span-1">
            <div class="bg-white rounded-[1.5rem] p-8 text-center">
                <div class="w-20 h-20 rounded-2xl mx-auto flex items-center justify-center text-3xl font-bold text-white mb-4"
                     style="background:linear-gradient(135deg,#00685d,#008376);">
                    RT
                </div>
                <h2 class="font-manrope font-bold text-lg" style="color:#191c1e;">{{ auth()->user()->name ?? 'Ketua RT' }}</h2>
                <p class="text-sm mt-1" style="color:#6d7a77;">Ketua RT 06 / RW 05</p>
                <div class="mt-3 space-y-1 text-xs" style="color:#6d7a77;">
                    <p>Periode: 2024 – 2027</p>
                    <p>{{ auth()->user()->email ?? 'rt06@example.com' }}</p>
                </div>
            </div>
        </div>

        {{-- RIGHT --}}
        <div class="lg:col-span-2 space-y-6">

            {{-- Informasi RT --}}
            <div class="bg-white rounded-[1.5rem] p-8">
                <h3 class="font-manrope font-bold text-base mb-5" style="color:#191c1e;">Informasi RT</h3>
                <div class="space-y-4">
                    <div>
                        <label class="text-xs font-medium uppercase tracking-widest block mb-1.5" style="color:#6d7a77;">Nama RT</label>
                        <input type="text" value="RT 06" readonly
                               class="w-full px-4 py-2.5 rounded-xl text-sm"
                               style="background-color:#f2f4f6;color:#191c1e;border:none;">
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="text-xs font-medium uppercase tracking-widest block mb-1.5" style="color:#6d7a77;">RW</label>
                            <input type="text" value="RW 05" readonly
                                   class="w-full px-4 py-2.5 rounded-xl text-sm"
                                   style="background-color:#f2f4f6;color:#191c1e;border:none;">
                        </div>
                        <div>
                            <label class="text-xs font-medium uppercase tracking-widest block mb-1.5" style="color:#6d7a77;">Kelurahan</label>
                            <input type="text" value="Sempaja Selatan" readonly
                                   class="w-full px-4 py-2.5 rounded-xl text-sm"
                                   style="background-color:#f2f4f6;color:#191c1e;border:none;">
                        </div>
                    </div>
                    <div>
                        <label class="text-xs font-medium uppercase tracking-widest block mb-1.5" style="color:#6d7a77;">Alamat Sekretariat</label>
                        <input type="text" value="Jl. Sempaja Selatan No. 6, Samarinda" readonly
                               class="w-full px-4 py-2.5 rounded-xl text-sm"
                               style="background-color:#f2f4f6;color:#191c1e;border:none;">
                    </div>
                    <div class="pt-2">
                        <button onclick="alert('Fitur edit informasi RT tersedia setelah backend terhubung.')"
                                class="px-5 py-2.5 rounded-xl text-sm font-semibold text-white hover:shadow-md transition-all"
                                style="background:linear-gradient(135deg,#00685d,#008376);">Simpan Perubahan</button>
                    </div>
                </div>
            </div>

            {{-- Notifikasi --}}
            <div class="bg-white rounded-[1.5rem] p-8">
                <h3 class="font-manrope font-bold text-base mb-5" style="color:#191c1e;">Pengaturan Notifikasi</h3>
                <div class="space-y-1">
                    @foreach([
                        ['notif-1','Pengajuan surat masuk','Notifikasi saat warga mengajukan surat baru',true],
                        ['notif-2','Warga baru terdaftar','Notifikasi saat ada warga baru mendaftar',true],
                        ['notif-3','Aduan warga','Notifikasi saat ada aduan baru masuk',true],
                        ['notif-4','Pengumuman RT','Notifikasi saat ada pengumuman baru',false],
                    ] as [$id, $label, $desc, $checked])
                    <div class="flex items-center justify-between py-4" style="{{ !$loop->last ? 'border-bottom:1px solid #eceef0;' : '' }}">
                        <div>
                            <p class="text-sm font-semibold" style="color:#191c1e;">{{ $label }}</p>
                            <p class="text-xs mt-0.5" style="color:#6d7a77;">{{ $desc }}</p>
                        </div>
                        {{-- Toggle Switch --}}
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

            {{-- Keamanan --}}
            <div class="bg-white rounded-[1.5rem] p-8">
                <h3 class="font-manrope font-bold text-base mb-5" style="color:#191c1e;">Keamanan Akun</h3>
                <div class="flex items-center justify-between py-3" style="border-bottom:1px solid #eceef0;">
                    <div>
                        <p class="text-sm font-semibold" style="color:#191c1e;">Password</p>
                        <p class="text-xs mt-0.5" style="color:#6d7a77;">Terakhir diubah: —</p>
                    </div>
                    <button onclick="alert('Fitur ganti password tersedia setelah backend terhubung.')"
                            class="text-xs font-semibold px-4 py-2 rounded-xl hover:bg-[#00685d] hover:text-white transition-colors"
                            style="background-color:#eceef0;color:#3d4947;">Ganti Password</button>
                </div>
                <div class="flex items-center justify-between py-3 mt-3">
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

@push('scripts')
<script>
function toggleSwitch(id) {
    const btn = document.getElementById(id);
    const isOn = btn.getAttribute('aria-checked') === 'true';
    btn.setAttribute('aria-checked', isOn ? 'false' : 'true');
    btn.style.backgroundColor = isOn ? '#d1d5db' : '#00685d';
    btn.querySelector('span').style.transform = isOn ? 'translateX(2px)' : 'translateX(22px)';
}
</script>
@endpush

@endsection
