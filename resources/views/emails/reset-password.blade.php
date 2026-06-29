<div style="font-family:Inter,Arial,sans-serif;max-width:520px;margin:0 auto;padding:24px;color:#191c1e;">
    <h2 style="color:#00685d;margin:0 0 16px;">Reset Password {{ $appName }}</h2>
    <p>Halo {{ $userName }},</p>
    <p>Kami menerima permintaan reset password. Klik tombol berikut (berlaku 1 jam):</p>
    <p style="margin:28px 0;">
        <a href="{{ $resetUrl }}" style="background:#00685d;color:#fff;padding:14px 28px;border-radius:10px;text-decoration:none;font-weight:600;display:inline-block;">
            Reset Password Saya
        </a>
    </p>
    <p style="font-size:12px;color:#6d7a77;word-break:break-all;">Atau salin tautan: {{ $resetUrl }}</p>
    <p style="font-size:12px;color:#6d7a77;margin-top:24px;">Jika Anda tidak meminta reset, abaikan email ini.</p>
</div>
