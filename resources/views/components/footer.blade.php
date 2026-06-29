@php
    // Get Top 5 Surat for Footer
    $top5Surat = \App\Models\Pengajuan::select('jenis_surat', \DB::raw('count(*) as total'))
        ->groupBy('jenis_surat')
        ->orderBy('total', 'desc')
        ->take(5)
        ->pluck('jenis_surat');
    
    if ($top5Surat->isEmpty()) {
        $top5Surat = collect(['Surat Keterangan Domisili', 'Surat Keterangan Usaha', 'Surat Keterangan Tidak Mampu', 'Surat Pengantar Umum', 'Surat Keterangan Keluarga']);
    }
@endphp
<footer class="bg-white border-t border-gray-100 mt-auto w-full relative z-10 transition-all shadow-[0_-4px_6px_-1px_rgba(0,0,0,0.05)]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 lg:py-12">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 lg:gap-12">
            
            {{-- About --}}
            <div class="lg:col-span-1">
                <a href="{{ route('dashboard') }}" class="inline-flex items-center gap-2 mb-4">
                    <div class="w-8 h-8 rounded-lg flex items-center justify-center text-white font-bold text-sm"
                         style="background: linear-gradient(135deg, #00685d, #008376);">
                        S
                    </div>
                    <span class="font-manrope font-bold text-lg" style="color: #191c1e;">SIMART-06</span>
                </a>
                <p class="text-sm leading-relaxed" style="color: #6d7a77;">
                    Sistem Manajemen RT digital untuk RT 06. 
                    Memudahkan administrasi warga secara transparan dan efisien.
                </p>
            </div>

            {{-- Menus --}}
            <div>
                <h3 class="font-manrope font-bold text-base mb-4" style="color: #191c1e;">Menu</h3>
                <ul class="space-y-3">
                    <li><a href="{{ route('dashboard') }}" class="text-sm hover:text-[#00685d] transition-colors" style="color: #6d7a77;">Beranda</a></li>
                    <li><a href="{{ route('dashboard') }}" class="text-sm hover:text-[#00685d] transition-colors" style="color: #6d7a77;">Keunggulan</a></li>
                    <li><a href="{{ route('dashboard') }}" class="text-sm hover:text-[#00685d] transition-colors" style="color: #6d7a77;">Layanan</a></li>
                    @if(Auth::check() && Auth::user()->role == 'warga')
                    <li><a href="{{ route('pengajuan.create') }}" class="text-sm hover:text-[#00685d] transition-colors" style="color: #6d7a77;">Pengajuan Surat</a></li>
                    <li><a href="{{ route('warga.riwayat') }}" class="text-sm hover:text-[#00685d] transition-colors" style="color: #6d7a77;">Riwayat Surat</a></li>
                    @endif
                </ul>
            </div>

            {{-- Layanan Terpopuler --}}
            <div>
                <h3 class="font-manrope font-bold text-base mb-4" style="color: #191c1e;">Layanan Warga</h3>
                <ul class="space-y-3">
                    @foreach($top5Surat as $surat)
                    <li>
                        <a href="{{ Auth::check() && Auth::user()->role == 'warga' ? route('warga.template') : '#' }}" class="text-sm hover:text-[#00685d] transition-colors capitalize" style="color: #6d7a77;">
                            {{ str_replace('_', ' ', $surat) }}
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>

            {{-- Contact --}}
            <div>
                <h3 class="font-manrope font-bold text-base mb-4" style="color: #191c1e;">Kontak RT</h3>
                <ul class="space-y-3">
                    <li class="flex items-start gap-3">
                        <span class="material-icons-outlined text-lg mt-0.5" style="color: #00685d;">location_on</span>
                        <span class="text-sm leading-relaxed" style="color: #6d7a77;">Jl. MT Haryono RT. 06 No 59 Damai Bahagia Balikpapan</span>
                    </li>
                    <li class="flex items-center gap-3">
                        <span class="material-icons-outlined text-lg" style="color: #00685d;">phone</span>
                        <span class="text-sm" style="color: #6d7a77;">0852-1234-5678</span>
                    </li>
                    <li class="flex items-center gap-3">
                        <span class="material-icons-outlined text-lg" style="color: #00685d;">schedule</span>
                        <span class="text-sm" style="color: #6d7a77;">Sen–Jum: 08:00 – 17:00 WITA</span>
                    </li>
                </ul>
            </div>

        </div>

        <div class="border-t border-gray-100 mt-10 pt-6 flex flex-col md:flex-row items-center justify-between gap-4">
            <p class="text-xs" style="color: #6d7a77;">
                &copy; {{ date('Y') }} SIMART-06. All rights reserved.
            </p>
            <div class="flex flex-wrap gap-4 justify-center">
                <a href="{{ route('privacy') }}" class="text-xs hover:text-[#00685d] transition-colors" style="color: #6d7a77;">Privacy Policy</a>
                <a href="{{ route('terms') }}" class="text-xs hover:text-[#00685d] transition-colors" style="color: #6d7a77;">Terms of Service</a>
                <a href="#" class="text-xs hover:text-[#00685d] transition-colors" style="color: #6d7a77;">Help Center</a>
            </div>
        </div>
    </div>
</footer>
