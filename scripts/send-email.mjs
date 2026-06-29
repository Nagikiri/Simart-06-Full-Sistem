import nodemailer from 'nodemailer';
import { readFileSync } from 'fs';

async function main() {
    const raw = readFileSync(0, 'utf8');
    const data = JSON.parse(raw);

    const transporter = nodemailer.createTransport({
        host: data.smtp.host || 'localhost',
        port: data.smtp.port || 587,
        secure: Boolean(data.smtp.secure),
        auth: data.smtp.user
            ? { user: data.smtp.user, pass: data.smtp.pass }
            : undefined,
    });

    await transporter.sendMail({
        from: `"${data.from.name}" <${data.from.address}>`,
        to: data.to,
        subject: data.subject,
        text: data.text,
        html: data.html,
    });

    console.log(JSON.stringify({ ok: true }));
}

main().catch((err) => {
    console.error(err.message || String(err));
    process.exit(1);
});
