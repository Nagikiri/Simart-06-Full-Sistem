<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Process;

class NodeMailerService
{
    /**
     * Kirim email via skrip Node.js (nodemailer).
     */
    public function send(string $to, string $subject, string $html, ?string $text = null): bool
    {
        $script = base_path('scripts/send-email.mjs');

        if (! file_exists($script)) {
            Log::error('NodeMailer: scripts/send-email.mjs tidak ditemukan');

            return false;
        }

        $payload = json_encode([
            'to' => $to,
            'subject' => $subject,
            'html' => $html,
            'text' => $text ?? strip_tags($html),
            'smtp' => [
                'host' => config('mail.mailers.smtp.host'),
                'port' => (int) config('mail.mailers.smtp.port'),
                'secure' => config('mail.mailers.smtp.encryption') === 'ssl',
                'user' => config('mail.mailers.smtp.username'),
                'pass' => config('mail.mailers.smtp.password'),
            ],
            'from' => [
                'address' => config('mail.from.address'),
                'name' => config('mail.from.name'),
            ],
        ], JSON_THROW_ON_ERROR);

        $result = Process::timeout(30)->input($payload)->run([
            'node',
            $script,
        ]);

        if (! $result->successful()) {
            Log::error('NodeMailer gagal', [
                'stderr' => $result->errorOutput(),
                'stdout' => $result->output(),
            ]);

            return false;
        }

        return true;
    }
}
