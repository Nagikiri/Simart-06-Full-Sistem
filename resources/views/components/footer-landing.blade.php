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
{{-- Footer Landing Page — Civic Curator (Tonal dark, full info) --}}
<footer style="background-color: #2d3133;">
    <div class="max-w-7xl mx-auto px-6 lg:px-8 py-16">
        <div class="grid grid-cols-1 md:grid-cols-12 gap-12 mb-12">
            {{-- Brand --}}
            <div class="md:col-span-4">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-9 h-9 btn-civic-gradient rounded-civic-lg flex items-center justify-center">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                        </svg>
                    </div>
                    <span class="font-manrope font-bold text-white">SIMART-06</span>
                </div>
                <p class="text-sm text-gray-400 leading-relaxed max-w-xs">
                    Sistem Manajemen Administrasi Rukun Tetangga (SIMART) digital terpadu untuk RT 06. 
                    Hadir untuk mempermudah layanan administrasi warga secara transparan, cepat, responsif, dan efisien demi mewujudkan lingkungan yang rukun dan modern.
                </p>
            </div>

            {{-- Navigation --}}
            <div class="md:col-span-2">
                <h4 class="text-xs font-semibold text-gray-300 uppercase tracking-widest mb-4">Menu Warga</h4>
                <ul class="space-y-3">
                    @if(Auth::check() && Auth::user()->role == 'warga')
                        <li><a href="{{ route('dashboard') }}" class="text-sm text-gray-400 hover:text-white transition-colors">Beranda Dashboard</a></li>
                        <li><a href="{{ route('pengajuan.create') }}" class="text-sm text-gray-400 hover:text-white transition-colors">Buat Pengajuan Baru</a></li>
                        <li><a href="{{ route('warga.template') }}" class="text-sm text-gray-400 hover:text-white transition-colors">Download Template</a></li>
                        <li><a href="{{ route('warga.riwayat') }}" class="text-sm text-gray-400 hover:text-white transition-colors">Riwayat Pengajuan</a></li>
                        <li><a href="{{ route('warga.profile') }}" class="text-sm text-gray-400 hover:text-white transition-colors">Pengaturan Akun</a></li>
                    @else
                        <li><a href="#hero" class="text-sm text-gray-400 hover:text-white transition-colors">Beranda</a></li>
                        <li><a href="#benefits" class="text-sm text-gray-400 hover:text-white transition-colors">Keunggulan</a></li>
                        <li><a href="#services" class="text-sm text-gray-400 hover:text-white transition-colors">Layanan</a></li>
                        <li><a href="{{ route('login') }}" class="text-sm text-gray-400 hover:text-white transition-colors">Masuk Akun</a></li>
                        <li><a href="{{ route('register') }}" class="text-sm text-gray-400 hover:text-white transition-colors">Daftar Warga</a></li>
                    @endif
                </ul>
            </div>

            {{-- Layanan Warga --}}
            <div class="md:col-span-3">
                <h4 class="text-xs font-semibold text-gray-300 uppercase tracking-widest mb-4">Layanan Terpopuler</h4>
                <ul class="space-y-3">
                    @foreach($top5Surat as $surat)
                    <li>
                        <a href="{{ Auth::check() && Auth::user()->role == 'warga' ? route('warga.template') : '#services' }}" class="text-sm text-gray-400 hover:text-white transition-colors capitalize">
                            {{ str_replace('_', ' ', $surat) }}
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>

            {{-- Kontak --}}
            <div class="md:col-span-3">
                <h4 class="text-xs font-semibold text-gray-300 uppercase tracking-widest mb-4">Kontak RT</h4>
                <ul class="space-y-3 text-sm text-gray-400">
                    <li class="flex items-start gap-2">
                        <svg class="w-4 h-4 mt-0.5 text-gray-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        Jl. MT Haryono RT. 06 No 59 Damai Bahagia Balikpapan
                    </li>
                    <li class="flex items-start gap-2">
                        <svg class="w-4 h-4 mt-0.5 text-gray-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                        0852-1234-5678
                    </li>
                    <li class="flex items-start gap-2">
                        <svg class="w-4 h-4 mt-0.5 text-gray-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Sen–Jum: 08:00 – 17:00 WITA
                    </li>
                </ul>
            </div>
        </div>

        {{-- Bottom bar --}}
        <div class="border-t border-white/10 pt-8 flex flex-col sm:flex-row justify-between items-center gap-4">
            <p class="text-xs text-gray-500">&copy; {{ date('Y') }} SIMART-06. All rights reserved.</p>
            <div class="flex gap-6">
                <a href="{{ route('privacy') }}" class="text-xs text-gray-500 hover:text-gray-300 transition-colors">Privacy Policy</a>
                <a href="{{ route('terms') }}" class="text-xs text-gray-500 hover:text-gray-300 transition-colors">Terms of Service</a>
                <a href="#" class="text-xs text-gray-500 hover:text-gray-300 transition-colors">Help Center</a>
            </div>
        </div>
    </div>
</footer>
