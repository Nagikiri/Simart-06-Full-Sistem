{{-- Navigation Bar — Civic Curator: Minimal top header --}}
{{-- Rule: Keep it minimal: Breadcrumb and User Profile --}}
<nav class="sticky top-0 z-40 flex items-center justify-between px-6 lg:px-8 h-16" style="background-color: rgba(247,249,251,0.85); backdrop-filter: blur(16px); -webkit-backdrop-filter: blur(16px);">

    {{-- Left: Breadcrumb --}}
    <div class="flex items-center gap-2 text-sm">
        <span style="color: #6d7a77;">@yield('breadcrumb-parent', 'Dashboard')</span>
        @hasSection('breadcrumb-current')
            <svg class="w-4 h-4" style="color: #bcc9c6;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5l7 7-7 7"/>
            </svg>
            <span class="font-medium" style="color: #191c1e;">@yield('breadcrumb-current')</span>
        @endif
    </div>

    {{-- Right: User Profile --}}
    <div class="flex items-center gap-4">
        @auth
            @php
                $userRole = auth()->user()->role ?? 'warga';
                // For RT: load latest incoming pengajuan from warga
                // For Warga: load own pengajuan activity
                if ($userRole === 'rt') {
                    $notifItems = \App\Models\Pengajuan::with('warga')
                        ->orderBy('created_at', 'desc')
                        ->take(5)
                        ->get()
                        ->map(function ($p) {
                            return [
                                'title'  => 'Pengajuan masuk: ' . $p->jenis_surat,
                                'sub'    => ($p->warga->nama ?? 'Warga') . ' — ' . $p->created_at->diffForHumans(),
                                'color'  => $p->status === 'pending' ? '#ba1a1a' : '#00685d',
                                'unread' => $p->status === 'pending',
                            ];
                        });
                } else {
                    $notifItems = collect();
                    if (auth()->user()->warga) {
                        $pengajuanNotifs = auth()->user()->warga->pengajuan()
                            ->orderBy('updated_at', 'desc')
                            ->take(3)
                            ->get()
                            ->map(function ($p) {
                                $label = match ($p->status) {
                                    'selesai'  => 'Surat disetujui & siap diambil',
                                    'ditolak'  => 'Pengajuan ditolak',
                                    'diproses' => 'Pengajuan sedang diproses',
                                    default    => 'Pengajuan diterima sistem',
                                };
                                $color = match ($p->status) {
                                    'selesai'  => '#416538',
                                    'ditolak'  => '#ba1a1a',
                                    'diproses' => '#2b6485',
                                    default    => '#00685d',
                                };
                                return [
                                    'title'  => $label,
                                    'sub'    => $p->jenis_surat . ' — ' . $p->updated_at->diffForHumans(),
                                    'color'  => $color,
                                    'unread' => in_array($p->status, ['selesai', 'ditolak', 'diproses']),
                                    'timestamp' => $p->updated_at,
                                ];
                            });

                        $pengumumanNotifs = \App\Models\Pengumuman::orderBy('created_at', 'desc')
                            ->take(2)
                            ->get()
                            ->map(function ($p) {
                                return [
                                    'title'  => '📢 ' . $p->judul,
                                    'sub'    => 'Pengumuman RT — ' . $p->created_at->diffForHumans(),
                                    'color'  => '#2b6485',
                                    'unread' => true,
                                    'timestamp' => $p->created_at,
                                ];
                            });

                        $notifItems = $pengajuanNotifs->concat($pengumumanNotifs)->sortByDesc('timestamp')->take(5);
                    }
                }
                $unreadCount = $notifItems->where('unread', true)->count();
            @endphp

            {{-- ── Notification Bell + Dropdown ──────────────────────── --}}
            <div class="relative" id="notif-wrapper">
                <button id="notif-btn"
                    onclick="toggleNotif(event)"
                    class="relative p-2 rounded-lg transition-colors hover:bg-[#eceef0]"
                    aria-label="Notifikasi">
                    <svg class="w-5 h-5" style="color: #3d4947;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                              d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                    </svg>
                    {{-- Unread badge — only shown when there are unread items --}}
                    @if($unreadCount > 0)
                        <span id="notif-badge"
                              class="absolute top-1.5 right-1.5 w-2 h-2 rounded-full"
                              style="background-color: #ba1a1a;"></span>
                    @else
                        <span id="notif-badge"
                              class="absolute top-1.5 right-1.5 w-2 h-2 rounded-full hidden"
                              style="background-color: #ba1a1a;"></span>
                    @endif
                </button>

                {{-- Dropdown Panel --}}
                <div id="notif-dropdown"
                     class="hidden absolute right-0 mt-2 w-80 rounded-2xl shadow-2xl overflow-hidden z-50"
                     style="background-color: #fff; border: 1px solid #eceef0;">

                    {{-- Header --}}
                    <div class="flex items-center justify-between px-5 pt-4 pb-3"
                         style="border-bottom: 1px solid #eceef0;">
                        <h3 class="font-manrope font-bold text-sm" style="color: #191c1e;">Notifikasi</h3>
                        @if($unreadCount > 0)
                            <span class="text-[11px] font-semibold px-2 py-0.5 rounded-full"
                                  style="background-color: #ffdad6; color: #93000a;">{{ $unreadCount }} Baru</span>
                        @else
                            <span class="text-[11px] font-semibold px-2 py-0.5 rounded-full"
                                  style="background-color: #eceef0; color: #6d7a77;">0 Baru</span>
                        @endif
                    </div>

                    {{-- Notification Items --}}
                    <div class="divide-y" style="divide-color: #f2f4f6;">
                        @forelse($notifItems as $notif)
                            <div class="flex gap-3 px-5 py-3 cursor-pointer transition-colors hover:bg-[#f2f4f6]"
                                 @if(!$notif['unread']) style="opacity: 0.65;" @endif>
                                <div class="mt-1 w-2 h-2 rounded-full flex-shrink-0"
                                     style="background-color: {{ $notif['color'] }};"></div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm {{ $notif['unread'] ? 'font-semibold' : 'font-medium' }}" style="color: #191c1e;">{{ $notif['title'] }}</p>
                                    <p class="text-xs mt-0.5 truncate" style="color: #6d7a77;">{{ $notif['sub'] }}</p>
                                </div>
                            </div>
                        @empty
                            <div class="flex flex-col items-center justify-center px-5 py-8 text-center">
                                <svg class="w-8 h-8 mb-2" style="color: #bcc9c6;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                                </svg>
                                <p class="text-xs font-medium" style="color: #6d7a77;">Belum ada notifikasi</p>
                            </div>
                        @endforelse
                    </div>

                    {{-- Footer --}}
                    <div class="px-5 py-3 text-center" style="border-top: 1px solid #eceef0;">
                        @if($userRole === 'rt')
                            <a href="{{ route('verifikasi.index') }}" class="text-xs font-semibold transition-colors hover:text-[#008376]"
                               style="color: #00685d;">Lihat Semua Pengajuan →</a>
                        @else
                            <a href="{{ route('warga.riwayat') }}" class="text-xs font-semibold transition-colors hover:text-[#008376]"
                               style="color: #00685d;">Lihat Semua Riwayat →</a>
                        @endif
                    </div>
                </div>
            </div>
            {{-- ── End Notification ──────────────────────────────────── --}}

            {{-- User avatar + info --}}
            <div class="flex items-center gap-3">
                <div class="hidden sm:block text-right">
                    <p class="text-sm font-semibold" style="color: #191c1e;">{{ auth()->user()->name }}</p>
                    <p class="text-xs" style="color: #6d7a77;">{{ ucfirst(auth()->user()->role ?? 'Warga') }}</p>
                </div>
                <div class="w-9 h-9 rounded-full flex items-center justify-center text-xs font-semibold"
                     style="background-color: #eceef0; color: #00685d;">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>
            </div>

            {{-- Logout (hidden form) --}}
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                @csrf
            </form>
            <button onclick="document.getElementById('logout-form').submit()"
                    class="text-xs font-medium transition-colors hover:text-red-500"
                    style="color: #6d7a77;">
                Keluar
            </button>
        @else
            <a href="{{ route('login') }}" class="text-sm font-semibold transition-colors hover:text-[#008376]"
               style="color: #00685d;">Masuk</a>
            <a href="{{ route('register') }}"
               class="btn-civic-gradient text-white text-sm font-semibold px-5 py-2 rounded-xl transition-all hover:shadow-md">Daftar</a>
        @endauth
    </div>
</nav>

{{-- ── Notification Dropdown Script ──────────────────────────────────── --}}
<script>
function toggleNotif(e) {
    e.stopPropagation();
    const dropdown = document.getElementById('notif-dropdown');
    const badge    = document.getElementById('notif-badge');
    dropdown.classList.toggle('hidden');
    // Hide unread badge once opened
    if (!dropdown.classList.contains('hidden')) {
        badge.style.display = 'none';
    }
}
// Close when clicking outside
document.addEventListener('click', function(e) {
    const wrapper = document.getElementById('notif-wrapper');
    if (wrapper && !wrapper.contains(e.target)) {
        document.getElementById('notif-dropdown').classList.add('hidden');
    }
});
// Close on Escape
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        document.getElementById('notif-dropdown').classList.add('hidden');
    }
});
</script>

