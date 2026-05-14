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
                    {{-- Unread badge --}}
                    <span id="notif-badge"
                          class="absolute top-1.5 right-1.5 w-2 h-2 rounded-full"
                          style="background-color: #ba1a1a;"></span>
                </button>

                {{-- Dropdown Panel --}}
                <div id="notif-dropdown"
                     class="hidden absolute right-0 mt-2 w-80 rounded-2xl shadow-2xl overflow-hidden z-50"
                     style="background-color: #fff; border: 1px solid #eceef0;">

                    {{-- Header --}}
                    <div class="flex items-center justify-between px-5 pt-4 pb-3"
                         style="border-bottom: 1px solid #eceef0;">
                        <h3 class="font-manrope font-bold text-sm" style="color: #191c1e;">Notifikasi</h3>
                        <span class="text-[11px] font-semibold px-2 py-0.5 rounded-full"
                              style="background-color: #ffdad6; color: #93000a;">3 Baru</span>
                    </div>

                    {{-- Notification Items --}}
                    <div class="divide-y" style="divide-color: #f2f4f6;">

                        {{-- Item 1 — Unread --}}
                        <div class="flex gap-3 px-5 py-3 cursor-pointer transition-colors hover:bg-[#f2f4f6]">
                            <div class="mt-1 w-2 h-2 rounded-full flex-shrink-0" style="background-color: #00685d;"></div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-semibold" style="color: #191c1e;">Pengajuan baru masuk</p>
                                <p class="text-xs mt-0.5" style="color: #6d7a77;">Budi Santoso — Surat Domisili</p>
                                <p class="text-[11px] mt-1" style="color: #bcc9c6;">2 menit yang lalu</p>
                            </div>
                        </div>

                        {{-- Item 2 — Unread --}}
                        <div class="flex gap-3 px-5 py-3 cursor-pointer transition-colors hover:bg-[#f2f4f6]">
                            <div class="mt-1 w-2 h-2 rounded-full flex-shrink-0" style="background-color: #2b6485;"></div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-semibold" style="color: #191c1e;">Surat Anda telah disetujui</p>
                                <p class="text-xs mt-0.5" style="color: #6d7a77;">Surat Keterangan Berkelakuan Baik</p>
                                <p class="text-[11px] mt-1" style="color: #bcc9c6;">1 jam yang lalu</p>
                            </div>
                        </div>

                        {{-- Item 3 — Unread --}}
                        <div class="flex gap-3 px-5 py-3 cursor-pointer transition-colors hover:bg-[#f2f4f6]">
                            <div class="mt-1 w-2 h-2 rounded-full flex-shrink-0" style="background-color: #ba1a1a;"></div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-semibold" style="color: #191c1e;">Aduan warga baru</p>
                                <p class="text-xs mt-0.5" style="color: #6d7a77;">Jalan rusak Blok H perlu ditangani</p>
                                <p class="text-[11px] mt-1" style="color: #bcc9c6;">3 jam yang lalu</p>
                            </div>
                        </div>

                        {{-- Item 4 — Read --}}
                        <div class="flex gap-3 px-5 py-3 cursor-pointer transition-colors hover:bg-[#f2f4f6]" style="opacity: 0.6;">
                            <div class="mt-1 w-2 h-2 rounded-full flex-shrink-0" style="background-color: #bcc9c6;"></div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium" style="color: #191c1e;">Pengumuman Kerja Bakti</p>
                                <p class="text-xs mt-0.5" style="color: #6d7a77;">Minggu, 18 Mei 2026 pukul 07.00</p>
                                <p class="text-[11px] mt-1" style="color: #bcc9c6;">Kemarin</p>
                            </div>
                        </div>
                    </div>

                    {{-- Footer --}}
                    <div class="px-5 py-3 text-center" style="border-top: 1px solid #eceef0;">
                        <a href="#" class="text-xs font-semibold transition-colors hover:text-[#008376]"
                           style="color: #00685d;">Lihat Semua Notifikasi →</a>
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
