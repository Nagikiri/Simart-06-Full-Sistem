# SIMART-06 — Sistem Manajemen RT 06

Aplikasi web administrasi surat-menyurat berbasis **Laravel** untuk RT 06, dibangun menggunakan desain sistem **Civic Curator**.

## Fitur Utama

### Dashboard Warga
- Pengajuan surat keterangan (Domisili, Usaha, Tidak Mampu, Pengantar Umum)
- Download template surat dari RT → isi sendiri → upload → ajukan
- Riwayat pengajuan dengan tracking status real-time
- Notifikasi dropdown di navbar
- Profile management (edit profil & ganti password via modal)

### Dashboard Ketua RT
- Verifikasi pengajuan surat masuk (3-tab: Pengajuan, Warga, Riwayat)
- Upload & manajemen template surat (PDF/DOCX) untuk diunduh warga
- Buat dan kirim pengumuman ke seluruh warga RT 06
- Statistik demografi warga dan tren pengajuan
- Pengaturan notifikasi & keamanan akun

## Tech Stack

| Layer | Teknologi |
|---|---|
| Backend | Laravel 11 |
| Frontend | Blade Templates + Tailwind CSS |
| Auth | Laravel Breeze |
| Icons | Google Material Icons Outlined |
| Chart | ApexCharts |
| Font | Manrope (Google Fonts) |

## Instalasi

```bash
# Clone repository
git clone https://github.com/username/simart-06.git
cd simart-06

# Install dependencies
composer install
npm install

# Setup environment
cp .env.example .env
php artisan key:generate

# Database
php artisan migrate
php artisan db:seed

# Build assets
npm run dev

# Jalankan server
php artisan serve
```

## Struktur Halaman

```
resources/views/
├── components/
│   ├── navbar.blade.php          # Navbar + dropdown notifikasi
│   ├── sidebar-warga.blade.php   # Sidebar dashboard warga
│   └── sidebar-rt.blade.php      # Sidebar dashboard RT
├── dashboard/
│   ├── warga.blade.php           # Dashboard utama warga
│   └── rt.blade.php              # Dashboard utama Ketua RT
├── warga/
│   ├── pengajuan/                # Daftar & form pengajuan surat
│   ├── riwayat/                  # Riwayat pengajuan
│   ├── template/                 # Download template surat
│   └── profile/                  # Profil & pengaturan warga
└── rt/
    ├── verifikasi/               # Proses pengajuan dari warga
    ├── template/                 # Upload & kelola template surat
    ├── settings/                 # Pengaturan RT & notifikasi
    └── dashboard.blade.php       # (legacy redirect)
```

## Status Pengembangan

- ✅ Frontend (Civic Curator Design System)
- ✅ Authentication (Login / Register / Role-based)
- ⏳ Backend Controllers (CRUD pengajuan, file storage)
- ⏳ Notifikasi real-time (Laravel Echo / Pusher)
- ⏳ File storage (Laravel Storage + S3/Local)

## Lisensi

MIT License — Proyek akademik untuk keperluan KKN/Tugas Akhir.
