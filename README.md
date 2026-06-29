# SIMART-06 — Sistem Manajemen RT

Aplikasi surat-menyurat administrasi RT berbasis Laravel 13.

---

## 🚀 Cara Setup (Fresh Install)

### 1. Clone / Extract Proyek
```bash
# Ekstrak zip ke folder, lalu masuk ke direktori proyek
cd simart-06
```

### 2. Install Dependensi
```bash
composer install
npm install
```

### 3. Konfigurasi Environment
```bash
# Salin file env
cp .env.example .env

# Generate app key
php artisan key:generate
```

Edit `.env`, sesuaikan koneksi database:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=simart
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Buat Database
Buka phpMyAdmin / DBeaver / MySQL CLI, buat database baru bernama `simart`.

### 5. Jalankan Migration & Seeder
```bash
php artisan migrate
php artisan db:seed
```

Seeder akan otomatis membuat:
- Semua tabel (via migration)
- 12 template surat
- Akun RT Admin
- Akun Warga Demo

### 6. Link Storage
```bash
php artisan storage:link
```

### 7. Jalankan Server
```bash
php artisan serve
```
Buka: **http://localhost:8000**

---

## 🔑 Kredensial Login

| Role | Email | Password |
|------|-------|----------|
| **Ketua RT** | `rt06@simart.local` | `rtsimart06` |
| **Warga Demo** | `warga@simart.local` | `wargasimart` |

---

## 🏗️ Alur Aplikasi

1. **Warga** login → pilih jenis surat → isi form → kirim ke RT
2. **RT** login → lihat daftar pengajuan → preview surat → klik **Setujui**
3. Sistem otomatis generate PDF bertanda tangan
4. **Warga** dapat melihat riwayat dan **mengunduh** PDF yang sudah jadi

---

## 🛠️ Tech Stack

- **Backend**: Laravel 13 (PHP 8.3)
- **Database**: MySQL
- **PDF**: barryvdh/laravel-dompdf
- **Frontend**: Blade + Vanilla CSS + TailwindCSS CDN

---

## ⚠️ Catatan Penting

- Pastikan ekstensi PHP `gd`, `fileinfo`, `pdo_mysql` aktif di Laragon/XAMPP
- Folder `storage/app/private` harus bisa ditulis (writable)
- Jika di Windows dengan Laragon, gunakan PHP 8.3
