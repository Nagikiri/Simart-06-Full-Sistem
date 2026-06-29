{{-- Sidebar Warga â€” Civic Curator Design System --}}
{{-- No border rule: uses tonal surface-container-low as full-bleed vertical slab --}}
<aside class="w-[272px] flex-shrink-0 flex flex-col" style="background-color: #f2f4f6;">

    {{-- Brand Header --}}
    <div class="px-6 pt-7 pb-6">
        <a href="{{ route('home') }}" class="flex items-center gap-3 group">
            <div class="w-10 h-10 rounded-xl flex items-center justify-center shadow-sm btn-civic-gradient transition-transform group-hover:scale-105">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                </svg>
            </div>
            <div>
                <span class="font-manrope font-bold text-base tracking-tight" style="color: #191c1e;">SIMART-06</span>
                <span class="block text-[10px] font-medium uppercase tracking-widest" style="color: #3d4947; letter-spacing: 0.06rem;">Sistem Manajemen RT</span>
            </div>
        </a>
    </div>

    {{-- Navigation --}}
    <nav class="flex-1 px-4 space-y-1">

        {{-- Dashboard (unified â€” replaces old Home + Dashboard duplicate) --}}
        <a href="{{ route('dashboard.warga') }}"
           class="group flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium transition-all relative
                   {{ request()->routeIs('dashboard.warga') || request()->routeIs('dashboard') ? 'text-[#00685d] font-semibold' : 'text-[#3d4947] hover:text-[#00685d]' }}"
           style="{{ request()->routeIs('dashboard.warga') || request()->routeIs('dashboard') ? 'background-color: rgba(0,104,93,0.06);' : '' }}">
            {{-- Active indicator bar (Civic Curator: vertical 4px bar, no pill) --}}
            @if(request()->routeIs('dashboard.warga') || request()->routeIs('dashboard'))
                <span class="absolute left-0 top-2 bottom-2 w-1 rounded-r-full" style="background-color: #00685d;"></span>
            @endif
            <span class="material-icons-outlined text-xl {{ request()->routeIs('dashboard.warga') || request()->routeIs('dashboard') ? 'text-[#00685d]' : 'text-[#6d7a77] group-hover:text-[#00685d]' }}">dashboard</span>
            <span>Dashboard</span>
        </a>

        {{-- Pengajuan Surat --}}
        <a href="{{ route('pengajuan.index') }}"
           class="group flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium transition-all relative
                   {{ request()->routeIs('pengajuan.*') ? 'text-[#00685d] font-semibold' : 'text-[#3d4947] hover:text-[#00685d]' }}"
           style="{{ request()->routeIs('pengajuan.*') ? 'background-color: rgba(0,104,93,0.06);' : '' }}">
            @if(request()->routeIs('pengajuan.*'))
                <span class="absolute left-0 top-2 bottom-2 w-1 rounded-r-full" style="background-color: #00685d;"></span>
            @endif
            <span class="material-icons-outlined text-xl {{ request()->routeIs('pengajuan.*') ? 'text-[#00685d]' : 'text-[#6d7a77] group-hover:text-[#00685d]' }}">assignment</span>
            <span>Pengajuan</span>
        </a>

        {{-- Riwayat --}}
        <a href="{{ route('warga.riwayat') }}"
           class="group flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium transition-all relative
                   {{ request()->routeIs('warga.riwayat*') || request()->is('warga/riwayat*') ? 'text-[#00685d] font-semibold' : 'text-[#3d4947] hover:text-[#00685d]' }}"
           style="{{ request()->routeIs('warga.riwayat*') || request()->is('warga/riwayat*') ? 'background-color: rgba(0,104,93,0.06);' : '' }}">
            @if(request()->routeIs('warga.riwayat*') || request()->is('warga/riwayat*'))
                <span class="absolute left-0 top-2 bottom-2 w-1 rounded-r-full" style="background-color: #00685d;"></span>
            @endif
            <span class="material-icons-outlined text-xl {{ request()->routeIs('warga.riwayat*') || request()->is('warga/riwayat*') ? 'text-[#00685d]' : 'text-[#6d7a77] group-hover:text-[#00685d]' }}">history</span>
            <span>Riwayat</span>
        </a>

        {{-- Settings --}}
        <a href="{{ route('warga.settings') }}"
           class="group flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium transition-all relative
                   {{ request()->routeIs('warga.settings*') ? 'text-[#00685d] font-semibold' : 'text-[#3d4947] hover:text-[#00685d]' }}"
           style="{{ request()->routeIs('warga.settings*') ? 'background-color: rgba(0,104,93,0.06);' : '' }}">
            @if(request()->routeIs('warga.settings*'))
                <span class="absolute left-0 top-2 bottom-2 w-1 rounded-r-full" style="background-color: #00685d;"></span>
            @endif
            <span class="material-icons-outlined text-xl {{ request()->routeIs('warga.settings*') ? 'text-[#00685d]' : 'text-[#6d7a77] group-hover:text-[#00685d]' }}">settings</span>
            <span>Settings</span>
        </a>
    </nav>

    {{-- User Profile Card (bottom) --}}
    <div class="px-4 pb-6 mt-auto">
        <div class="flex items-center gap-3 px-4 py-3 rounded-xl" style="background-color: #eceef0;">
            <div class="w-10 h-10 rounded-full flex items-center justify-center font-semibold text-sm" style="background: linear-gradient(135deg, #00685d, #008376); color: #fff;">
                {{ strtoupper(substr(auth()->user()->name ?? 'W', 0, 1)) }}
            </div>
            <div class="flex-1 min-w-0">
                <p class="text-sm font-semibold truncate" style="color: #191c1e;">{{ auth()->user()->name ?? 'Warga' }}</p>
                <p class="text-xs truncate" style="color: #6d7a77;">{{ auth()->user()->alamat ?? 'RT 06 / RW 05' }}</p>
            </div>
        </div>
    </div>
</aside>
