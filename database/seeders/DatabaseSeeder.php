<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Warga;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use \Illuminate\Database\Console\Seeds\WithoutModelEvents;

    public function run(): void
    {
        // ============================================================
        // KREDENSIAL TETAP (TIDAK RANDOM) - COCOK UNTUK DIBAGIKAN
        // ============================================================

        // 1. Seed semua template surat terlebih dahulu
        $this->call([
            SuratTemplateSeeder::class,
        ]);

        // 2. Buat akun RT Admin dengan kredensial tetap
        $rtEmail    = 'rt06@simart.local';
        $rtPassword = 'rtsimart06';
        $rtNama     = 'Ketua RT 06 - SIMART';
        $rtPhone    = '081234567890';

        if (!Warga::where('email', $rtEmail)->exists()) {
            Warga::create([
                'nama'     => $rtNama,
                'email'    => $rtEmail,
                'no_hp'    => $rtPhone,
                'password' => Hash::make($rtPassword),
                'role'     => 'rt',
                'gender'   => 'Laki-laki',
                'alamat'   => 'RT 06 / RW 11, Kelurahan Sepinggan Raya, Balikpapan',
            ]);
        }

        if (!User::where('email', $rtEmail)->exists()) {
            User::create([
                'name'              => $rtNama,
                'email'             => $rtEmail,
                'password'          => $rtPassword,
                'email_verified_at' => now(),
            ]);
        }

        // 3. Buat akun Warga Demo dengan kredensial tetap
        $wargaEmail    = 'warga@simart.local';
        $wargaPassword = 'wargasimart';
        $wargaNama     = 'Budi Santoso';
        $wargaPhone    = '082345678901';

        if (!Warga::where('email', $wargaEmail)->exists()) {
            Warga::create([
                'nama'     => $wargaNama,
                'email'    => $wargaEmail,
                'no_hp'    => $wargaPhone,
                'password' => Hash::make($wargaPassword),
                'role'     => 'warga',
                'gender'   => 'Laki-laki',
                'alamat'   => 'Jl. Sepinggan No. 12, RT 06/RW 11, Balikpapan',
            ]);
        }

        if (!User::where('email', $wargaEmail)->exists()) {
            User::create([
                'name'              => $wargaNama,
                'email'             => $wargaEmail,
                'password'          => $wargaPassword,
                'email_verified_at' => now(),
            ]);
        }

        // ============================================================
        // RINGKASAN KREDENSIAL - Tampil di console setelah seeder
        // ============================================================
        echo "\n";
        echo "=========================================================\n";
        echo "  SIMART-06 - DATABASE SEEDER BERHASIL\n";
        echo "=========================================================\n";
        echo "\n";
        echo "  [AKUN RT ADMIN]\n";
        echo "  Email    : " . $rtEmail . "\n";
        echo "  Password : " . $rtPassword . "\n";
        echo "\n";
        echo "  [AKUN WARGA DEMO]\n";
        echo "  Email    : " . $wargaEmail . "\n";
        echo "  Password : " . $wargaPassword . "\n";
        echo "\n";
        echo "=========================================================\n";
        echo "  Template Surat: " . \App\Models\SuratTemplate::count() . " template tersedia\n";
        echo "=========================================================\n\n";
    }
}
