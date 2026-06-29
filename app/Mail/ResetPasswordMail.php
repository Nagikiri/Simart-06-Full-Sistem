<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ResetPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public string $resetUrl,
        public string $userName = 'Pengguna',
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Reset Password - '.config('app.name'),
        );
    }

    public function content(): Content
    {
        return new Content(
            htmlString: $this->buildHtml(),
        );
    }

    protected function buildHtml(): string
    {
        $app = e(config('app.name'));

        return <<<HTML
        <div style="font-family:Inter,sans-serif;max-width:520px;margin:0 auto;padding:24px;">
            <h2 style="color:#00685d;">Reset Password {$app}</h2>
            <p>Halo {$this->userName},</p>
            <p>Kami menerima permintaan reset password untuk akun Anda. Klik tombol di bawah (berlaku 1 jam):</p>
            <p style="margin:24px 0;">
                <a href="{$this->resetUrl}" style="background:#00685d;color:#fff;padding:12px 24px;border-radius:8px;text-decoration:none;font-weight:600;">
                    Reset Password
                </a>
            </p>
            <p style="font-size:12px;color:#6d7a77;">Jika Anda tidak meminta reset, abaikan email ini.</p>
        </div>
        HTML;
    }
}
