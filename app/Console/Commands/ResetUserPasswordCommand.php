<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Models\Warga;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class ResetUserPasswordCommand extends Command
{
    protected $signature = 'simart:reset-password {email} {password}';

    protected $description = 'Reset password akun (users + warga) — untuk perbaikan / testing';

    public function handle(): int
    {
        $email = $this->argument('email');
        $password = $this->argument('password');

        $user = User::where('email', $email)->first();
        if (! $user) {
            $this->error("Email tidak ditemukan di tabel users: {$email}");

            return self::FAILURE;
        }

        $user->password = $password;
        $user->email_verified_at = $user->email_verified_at ?? now();
        $user->save();

        $warga = Warga::where('email', $email)->first();
        if ($warga) {
            $warga->update(['password' => Hash::make($password)]);
        }

        $this->info("Password berhasil direset untuk: {$email}");

        return self::SUCCESS;
    }
}
