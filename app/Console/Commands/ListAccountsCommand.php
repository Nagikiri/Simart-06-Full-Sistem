<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Models\Warga;
use Illuminate\Console\Command;

class ListAccountsCommand extends Command
{
    protected $signature = 'simart:accounts';

    protected $description = 'Tampilkan semua akun terdaftar di database (users & warga)';

    public function handle(): int
    {
        $dbPath = database_path('database.sqlite');

        $this->info('=== SIMART — Akun di Database ===');
        $this->line('Koneksi: '.config('database.default'));
        $this->line('File: '.$dbPath);
        $this->line('Ada file: '.(file_exists($dbPath) ? 'Ya ('.number_format(filesize($dbPath)).' bytes)' : 'Tidak'));
        $this->newLine();

        $users = User::orderBy('id')->get();
        if ($users->isEmpty()) {
            $this->warn('Tabel users: KOSONG (belum ada yang daftar login)');
        } else {
            $this->table(
                ['ID', 'Email', 'Nama', 'Verifikasi Email', 'Dibuat'],
                $users->map(fn ($u) => [
                    $u->id,
                    $u->email,
                    $u->name,
                    $u->email_verified_at ? 'Ya' : 'Belum',
                    $u->created_at?->format('Y-m-d H:i'),
                ])
            );
        }

        $this->newLine();
        $wargas = Warga::orderBy('id_warga')->get();
        if ($wargas->isEmpty()) {
            $this->warn('Tabel warga: KOSONG');
        } else {
            $this->table(
                ['ID', 'Email', 'Nama', 'No HP', 'Role', 'Dibuat'],
                $wargas->map(fn ($w) => [
                    $w->id_warga,
                    $w->email,
                    $w->nama,
                    $w->no_hp,
                    $w->role ?? 'warga',
                    $w->created_at?->format('Y-m-d H:i'),
                ])
            );
        }

        $this->newLine();
        $this->info('Sinkronisasi User ↔ Warga:');
        foreach ($users as $u) {
            $ok = Warga::where('email', $u->email)->exists();
            $this->line($u->email.' → '.($ok ? '<fg=green>OK</>' : '<fg=red>TIDAK ADA di warga</>'));
        }

        return self::SUCCESS;
    }
}
