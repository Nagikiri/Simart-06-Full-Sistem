<?php

namespace App\Http\Controllers;

use App\Models\Pengajuan;
use App\Models\Surat;
use App\Services\NodeMailerService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class RTController extends Controller
{
    public function verifikasiIndex()
    {
        $pengajuan = Pengajuan::where('status', 'pending')
            ->with('warga')
            ->orderBy('created_at', 'asc')
            ->paginate(15);

        return view('rt.verifikasi.index', compact('pengajuan'));
    }

    public function verifikasiShow(Pengajuan $pengajuan)
    {
        $pengajuan->load(['warga', 'template']);

        return view('rt.verifikasi.show', compact('pengajuan'));
    }
    public function approve(Request $request, Pengajuan $pengajuan)
    {
        $autoNomor = 'RT06/RW11/' . date('m/Y') . '/' . substr(uniqid(), -4);

        $pengajuan->update(['status' => 'selesai']);

        // 1. Get the drafted HTML content from Warga
        $pengajuan->load('template');
        $dataTambahan = $pengajuan->data_tambahan ?? [];

        // Gunakan HTML final dari browser Warga jika tersedia, jika tidak fallback ke template asli
        if (isset($dataTambahan['_html_final']) && !empty($dataTambahan['_html_final'])) {
            $html = $dataTambahan['_html_final'];
        } else {
            $html = $pengajuan->template->content;
            
            // Peta field statis untuk format template baru
            $staticMappings = [
                'NAMA' => $dataTambahan['nama_lengkap'] ?? '',
                'NAMA_LENGKAP' => $dataTambahan['nama_lengkap'] ?? '',
                'NAMA_WARGA' => $dataTambahan['nama_lengkap'] ?? '',
                
                'NIK' => $dataTambahan['nik'] ?? '',
                
                'TTL' => $dataTambahan['tempat_tanggal_lahir'] ?? '',
                'TEMPAT_LAHIR' => $dataTambahan['tempat_tanggal_lahir'] ?? '',
                'TANGGAL_LAHIR' => $dataTambahan['tempat_tanggal_lahir'] ?? '',
                
                'JENIS_KELAMIN' => $dataTambahan['jenis_kelamin'] ?? '',
                
                'AGAMA' => $dataTambahan['agama'] ?? '',
                
                'PEKERJAAN' => $dataTambahan['pekerjaan'] ?? '',
                
                'ALAMAT' => $dataTambahan['alamat'] ?? '',
                'ALAMAT_LENGKAP' => $dataTambahan['alamat'] ?? '',
                'ALAMAT_WARGA' => $dataTambahan['alamat'] ?? '',
                
                'KEPERLUAN' => $dataTambahan['tujuan_surat'] ?? '',
                'TUJUAN_SURAT' => $dataTambahan['tujuan_surat'] ?? '',
                'KEPERLUAN_SURAT' => $dataTambahan['tujuan_surat'] ?? '',
                
                'NOMOR_RT' => '06',
            ];
            
            // Ganti "Ketua RT … Kelurahan" menjadi "Ketua RT [NOMOR_RT] Kelurahan" sebelum mapping berjalan
            $html = preg_replace('/Ketua RT\s*(?:…|\.{3,})\s*Kelurahan/i', 'Ketua RT [NOMOR_RT] Kelurahan', $html);
            
            foreach ($staticMappings as $placeholder => $value) {
                if (!empty($value)) {
                    $html = str_replace('[' . $placeholder . ']', e($value), $html);
                }
            }

            foreach ($dataTambahan as $key => $value) {
                if ($key === '_html_final') continue;
                $cleanKey = str_starts_with($key, 'field_') ? substr($key, 6) : $key;
                
                // Format template lama (dengan span id="field_...")
                $html = preg_replace('/(<span[^>]*id="field_' . preg_quote($cleanKey, '/') . '"[^>]*>)(.*?)(<\/span>)/i', '$1' . e($value) . '$3', $html);
                
                // Format template baru (dengan [NAMA_FIELD])
                $html = str_replace('[' . strtoupper($cleanKey) . ']', e($value), $html);
            }
        }

        // Fill nomor surat and tanggal
        $html = preg_replace('/(<span[^>]*id="nomor_surat"[^>]*>)(.*?)(<\/span>)/i', '$1' . e($autoNomor) . '$3', $html);
        $html = preg_replace('/(<span[^>]*id="tanggal_ttd"[^>]*>)(.*?)(<\/span>)/i', '$1' . e(now()->translatedFormat('d F Y')) . '$3', $html);

        // 2. Tentukan Tanda Tangan berdasarkan pilihan RT di modal
        $namaRT    = auth()->user()->name;
        $rtWarga   = auth()->user()->warga;
        $ttdMode   = $request->input('ttd_mode', 'text');
        $ttdHtml = '<div style="height:60px;display:flex;align-items:center;justify-content:center;">'
                 .'<span style="font-family:\'Brush Script MT\',cursive;font-size:28px;color:#191c1e;">'
                 . e($namaRT) .'</span></div>';

        if ($ttdMode === 'profil' && $rtWarga && $rtWarga->tanda_tangan && Storage::disk('public')->exists($rtWarga->tanda_tangan)) {
            // Gunakan gambar TTD dari profil RT
            $ttdPath = Storage::disk('public')->path($rtWarga->tanda_tangan);
            $ttdData = base64_encode(file_get_contents($ttdPath));
            $ttdMime = mime_content_type($ttdPath);
            // Setup variabel data gambar (akan dirender nanti)
            $ttdHtml = '<div style="text-align: center;"><img src="data:' . $ttdMime . ';base64,' . $ttdData . '" style="max-width:150px; max-height:60px; width:auto; height:auto; object-fit:contain; display:block; margin:0 auto;" alt="TTD RT" /></div>';

        } elseif ($ttdMode === 'upload' && $request->hasFile('ttd_upload')) {
            // Gunakan gambar TTD yang di-upload on-the-spot dari modal
            $uploadedFile = $request->file('ttd_upload');
            $ttdData = base64_encode(file_get_contents($uploadedFile->getRealPath()));
            $ttdMime = $uploadedFile->getMimeType();
            
            $ttdHtml = '<div style="text-align: center;"><img src="data:' . $ttdMime . ';base64,' . $ttdData . '" style="max-width:150px; max-height:60px; width:auto; height:auto; object-fit:contain; display:block; margin:0 auto;" alt="TTD RT" /></div>';

            // Simpan juga ke profil RT untuk dipakai lain kali (opsional)
            if ($rtWarga) {
                if ($rtWarga->tanda_tangan && Storage::disk('public')->exists($rtWarga->tanda_tangan)) {
                    Storage::disk('public')->delete($rtWarga->tanda_tangan);
                }
                $savedPath = $uploadedFile->store('tanda_tangan', 'public');
                $rtWarga->update(['tanda_tangan' => $savedPath]);
            }
        }
        // else: $ttdHtml tetap teks cursive (mode 'text' / fallback)

        // Remove Materai absolute box that breaks dompdf (the tiny white box)
        $html = preg_replace('/<div[^>]*>\s*<span[^>]*>Materai 10000<\/span>\s*<\/div>/is', '<br><br><span style="font-size:10px;">Materai 10000</span><br>', $html);

        // Handle signature children floats
        $count = 0;
        $html = preg_replace_callback('/(<div[^>]*width:\s*45%;[^>]*>)/i', function($m) use (&$count) {
            $count++;
            if ($count % 2 == 1) return '<div style="float: left; width: 45%; text-align: center;">';
            return '<div style="float: right; width: 45%; text-align: center;">';
        }, $html);

        // If there is a text-align: center div that is meant to be a signature block on the right
        // We will just float it right if it's the only one
        $html = preg_replace('/(<div[^>]*width:\s*40%;[^>]*>)/i', '<div style="float: right; width: 40%; text-align: center;">', $html);

        // Remove double padding that pushes signature out of the page
        $html = preg_replace('/padding:\s*2cm\s+2\.5cm;?/i', 'padding: 0;', $html);
        $html = preg_replace('/min-height:\s*297mm;?/i', '', $html);
        $html = preg_replace('/width:\s*210mm;?/i', 'width: 100%;', $html);

        // 3. Cari dan Ganti nama dalam kurung kosong (............) di bawah tanda tangan
        $namaPemohonTtd = !empty($dataTambahan['field_NAMA_PEMOHON']) ? $dataTambahan['field_NAMA_PEMOHON'] : (!empty($dataTambahan['field_NAMA_TTD']) ? $dataTambahan['field_NAMA_TTD'] : ($pengajuan->warga->user->name ?? 'Pemohon'));
        $namaRTTtd = !empty($dataTambahan['field_NAMA_RT']) ? $dataTambahan['field_NAMA_RT'] : ($namaRT ?? 'Ketua RT');
        
        // Regex pintar untuk mencari kurung kosong yang berisi titik, spasi, garis bawah, dll (termasuk jika hanya berisi 1 spasi atau kosong)
        $bracketRegex = '/\(\s*(?:&emsp;|&nbsp;|\.|_|\s|&#160;|<sup[^>]*>.*?<\/sup>){1,}\s*\)/i';
        preg_match_all($bracketRegex, $html, $matches);
        $bracketCount = count($matches[0]);
        
        if ($bracketCount === 1) {
            // Jika cuma ada 1 kurung, berarti hanya Pemohon (karena RT tidak tanda tangan di surat ini)
            $html = preg_replace($bracketRegex, '(<span style="font-weight:bold;">' . e($namaPemohonTtd) . '</span>)', $html, 1);
        } elseif ($bracketCount >= 2) {
            // Jika ada 2 kurung, sebelah kiri pasti RT, sebelah kanan pasti Pemohon
            $html = preg_replace($bracketRegex, '(<span style="font-weight:bold;">' . e($namaRTTtd) . '</span>)', $html, 1);
            $html = preg_replace($bracketRegex, '(<span style="font-weight:bold;">' . e($namaPemohonTtd) . '</span>)', $html, 1);
        }
        
        // 4. Injeksi Gambar Tanda Tangan RT (Hanya untuk surat yang membutuhkan)
        if (strpos($html, 'id="signature_area"') !== false) {
            $ttdHtmlArea = '<div style="height:64px;display:flex;align-items:center;justify-content:center;overflow:hidden;">'
                . '<img src="data:' . $ttdMime . ';base64,' . $ttdData . '" style="max-width:150px; max-height:60px; width:auto; height:auto; object-fit:contain; display:block; margin:0 auto;" alt="TTD RT" />'
                . '</div><div style="border-top:1px solid #000;padding-top:2px;"><p style="margin:0;font-size:11pt;text-align:center;"><strong>(' . e($namaRTTtd) . ')</strong></p></div>';
            $html = preg_replace('/(<div[^>]*id="signature_area"[^>]*>)(.*?)(<\/div>)/is', $ttdHtmlArea, $html);
        } else {
            // Gunakan DOMDocument untuk mencari posisi Ketua RT dan memasukkan TTD di kolom bawahnya secara organik
            $dom = new \DOMDocument();
            @$dom->loadHTML(mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8'), LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
            
            $xpath = new \DOMXPath($dom);
            // Cari node teks yang mengandung kata kunci "Ketua RT" atau "Ketua Rukun Tetangga"
            $textNodes = $xpath->query("//text()[contains(., 'Ketua RT') or contains(., 'Ketua Rukun Tetangga')]");
            
            $injected = false;
            foreach ($textNodes as $textNode) {
                // Cari TD ancestor (tabel tempat teks ini berada)
                $td = $textNode;
                while ($td !== null && $td->nodeName !== 'td') {
                    $td = $td->parentNode;
                }
                
                if ($td !== null) {
                    $tr1 = $td->parentNode;
                    // Lanjut ke baris berikutnya (tempat nama & ruang tanda tangan berada)
                    $tr2 = $tr1->nextSibling;
                    while ($tr2 !== null && $tr2->nodeName !== 'tr') {
                        $tr2 = $tr2->nextSibling;
                    }
                    
                    if ($tr2 !== null) {
                        // Cari index TD yang sejajar (vertikal)
                        $tdIndex = 0;
                        $temp = $td;
                        while ($temp->previousSibling !== null) {
                            $temp = $temp->previousSibling;
                            if ($temp->nodeName === 'td') $tdIndex++;
                        }
                        
                        $currIndex = 0;
                        $targetTd = null;
                        foreach ($tr2->childNodes as $child) {
                            if ($child->nodeName === 'td') {
                                if ($currIndex === $tdIndex) {
                                    $targetTd = $child;
                                    break;
                                }
                                $currIndex++;
                            }
                        }
                        
                        if ($targetTd !== null) {
                            // Hilangkan padding bawaan tabel dan margin ekstrem (menghindari penumpukan)
                            // Prompt meminta TANDA TANGAN TIDAK MENIMPA TEKS (KOTAK AMAN)
                            foreach ($targetTd->parentNode->childNodes as $sibling) {
                                if ($sibling->nodeName === 'td') {
                                    $style = $sibling->getAttribute('style');
                                    $style = preg_replace('/padding-top:\s*\d+px;?/', 'padding-top: 2px;', $style);
                                    if (strpos($style, 'padding-top') === false) {
                                        $style .= '; padding-top: 2px;';
                                    }
                                    $sibling->setAttribute('style', $style);
                                }
                            }
                            
                            // Gunakan KOTAK AMAN (tinggi tetap, max-height 60px) tanpa margin negatif
                            // Sesuai dengan instruksi A1 dari prompt.
                            // Gunakan $ttdHtml yang sudah digenerate di atas (bisa text mode atau image mode)
                            $frag = $dom->createDocumentFragment();
                            $frag->appendXML($ttdHtml);
                            
                            // Masukkan TTD di dalam kolom bawah, persis di atas teks namanya!
                            $targetTd->insertBefore($frag, $targetTd->firstChild);
                            $injected = true;
                            break; // Hanya inject sekali
                        }
                    }
                }
            }
            
            if ($injected) {
                $html = $dom->saveHTML();
            }
            // Jika tidak di-inject (karena template tidak butuh TTD RT, misalnya Surat Belum Pernah Menikah), biarkan saja!
        }
        // Wrap with proper HTML document structure for final PDF
        $fullDocument = '<!DOCTYPE html>
        <html>
        <head>
            <meta charset="utf-8">
            <title>Surat ' . $autoNomor . '</title>
            <style>
                @page { size: A4; margin: 1.2cm 1.6cm; }
                html, body { margin:0; padding:0; }
                body { background: #fff; font-family: "Times New Roman", Times, serif !important; color: #000; line-height: 1.35; font-size: 11.5pt; }
                table, tr, td, .sign-block, .signature-row { page-break-inside: avoid; }
                p { margin: 4px 0; }
                
                .mb-20, .mb-12, .mb-8 { margin-bottom: 18px !important; }
                .mb-6 { margin-bottom: 12px !important; }
                [style*="margin:0 0 60px"] { margin-bottom: 28px !important; }
                [id="signature_area"] { height: 60px !important; }
                .ttd-img { max-height:55px; max-width:140px; object-fit:contain; }
                table { width: 100%; border-collapse: collapse; }
                td { padding: 4px 0; vertical-align: top; }
                .kertas > div { width: auto !important; min-height: auto !important; padding: 0 !important; margin: 0 !important; box-sizing: content-box !important; }
                .w-\[210mm\] { width: 100% !important; }
                .text-center { text-align: center; }
                .border-b-2 { border-bottom: 2px solid black; }
                .pb-4 { padding-bottom: 16px; }
                .mb-6 { margin-bottom: 24px; }
                .mb-4 { margin-bottom: 16px; }
                .mb-8 { margin-bottom: 32px; }
                .mb-12 { margin-bottom: 48px; }
                .text-xl { font-size: 20px; }
                .text-lg { font-size: 18px; }
                .font-bold { font-weight: bold; }
                .uppercase { text-transform: uppercase; }
                .text-sm { font-size: 14px; }
                .underline { text-decoration: underline; }
                .w-full { width: 100%; }
                .ml-4 { margin-left: 16px; }
                .w-40 { width: 160px; }
                .py-1 { padding-top: 4px; padding-bottom: 4px; }
                .align-top { vertical-align: top; }
                .flex { display: flex; }
                .justify-end { justify-content: flex-end; }
                .justify-center { justify-content: center; }
                .pr-8 { padding-right: 32px; }
                .w-64 { width: 256px; }
                .mb-20 { margin-bottom: 80px; }
                .relative { position: relative; }
                .absolute { position: absolute; }
                .left-0 { left: 0; }
                .right-4 { right: 16px; }
                .w-24 { width: 96px; }
                .h-24 { height: 96px; }
                .w-32 { width: 128px; }
                .h-20 { height: 80px; }
                .border-2 { border: 2px solid; }
                .border-dashed { border-style: dashed; }
                .border-gray-300 { border-color: #d1d5db; }
                .rounded-full { border-radius: 50%; }
                .items-center { align-items: center; }
                .opacity-50 { opacity: 0.5; }
                .text-\[10px\] { font-size: 10px; }
                .text-gray-400 { color: #9ca3af; }
                .italic { font-style: italic; }
                .-mt-16 { margin-top: -64px; }
                .z-0 { z-index: 0; }
                .z-10 { z-index: 10; }
                /* Floating elements polyfill for dompdf */
                .right-wrapper { float: right; width: 250px; text-align: center; margin-top: 20px; }
                .signature-wrapper { position: relative; height: 100px; margin-top: 10px; margin-bottom: 10px; }
                .kertas { width: 100%; box-sizing: border-box; }
            </style>
        </head>
        <body>
            <div class="kertas">
                ' . str_replace('flex justify-end pr-8', 'right-wrapper', str_replace('flex items-center justify-center -mt-16 mb-4', 'signature-wrapper', $html)) . '
            </div>
        </body>
        </html>';

        // 3. Render PDF using dompdf
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadHTML($fullDocument);
        // Set paper to F4 size (215.9mm x 330.2mm)
        $pdf->setPaper([0, 0, 609.4488, 935.433], 'portrait');
        
        // Enable remote blocks (just in case)
        $pdf->setOptions(['isRemoteEnabled' => true, 'isHtml5ParserEnabled' => true]);
        
        $fileName = 'Surat_' . str_replace('/', '_', $autoNomor) . '_' . time() . '.pdf';
        $suratPath = "surat/{$pengajuan->id_warga}/{$fileName}";
        
        Storage::disk('private')->put($suratPath, $pdf->output());

        Surat::create([
            'id_pengajuan' => $pengajuan->id_pengajuan,
            'nomor_surat'  => $autoNomor,
            'tanggal_terbit' => now()->toDateString(),
            'file_surat'   => $suratPath,
        ]);

        // Kirim notifikasi email ke warga
        $this->kirimNotifikasiApprove($pengajuan);

        return redirect()->route('verifikasi.index')
            ->with('success', 'Pengajuan disetujui. Dokumen resmi beserta stempel otomatis telah berhasil diterbitkan.');
    }

    public function reject(Request $request, Pengajuan $pengajuan)
    {
        $validated = $request->validate([
            'alasan_penolakan' => 'required|string|max:500',
        ]);

        $pengajuan->update([
            'status'  => 'ditolak',
            'catatan' => $validated['alasan_penolakan'],
        ]);

        // Kirim notifikasi penolakan ke warga
        $this->kirimNotifikasiTolak($pengajuan, $validated['alasan_penolakan']);

        return redirect()->route('verifikasi.index')
            ->with('success', 'Pengajuan ditolak. Notifikasi dikirim ke warga.');
    }

    /**
     * Kirim notifikasi email saat pengajuan disetujui.
     */
    private function kirimNotifikasiApprove(Pengajuan $pengajuan): void
    {
        $warga = $pengajuan->warga;
        if (!$warga || !$warga->email) return;

        $html = '
            <div style="font-family:sans-serif;max-width:480px;margin:auto;">
                <div style="background:linear-gradient(135deg,#00685d,#008376);padding:32px;border-radius:16px 16px 0 0;text-align:center;">
                    <h1 style="color:#fff;margin:0;font-size:22px;">✅ Pengajuan Disetujui!</h1>
                </div>
                <div style="background:#fff;padding:32px;border-radius:0 0 16px 16px;border:1px solid #eceef0;">
                    <p style="color:#191c1e;font-size:15px;">Halo, <strong>' . e($warga->nama) . '</strong></p>
                    <p style="color:#3d4947;">Pengajuan surat Anda telah <strong style="color:#00685d;">disetujui</strong> oleh Ketua RT 06.</p>
                    <div style="background:#f2f4f6;border-radius:12px;padding:16px;margin:16px 0;">
                        <p style="margin:0 0 4px 0;font-size:13px;color:#6d7a77;">Jenis Surat</p>
                        <p style="margin:0;font-weight:600;color:#191c1e;">' . e($pengajuan->jenis_surat) . '</p>
                    </div>
                    <p style="color:#3d4947;font-size:14px;">📍 <strong>Silakan ambil surat Anda secara langsung ke kantor RT 06.</strong></p>
                    <p style="color:#6d7a77;font-size:12px;margin-top:24px;">SIMART-06 • Sistem Manajemen RT</p>
                </div>
            </div>';

        $this->sendEmail($warga->email, '✅ Surat Anda Disetujui - SIMART-06', $html);
    }

    /**
     * Kirim notifikasi email saat pengajuan ditolak.
     */
    private function kirimNotifikasiTolak(Pengajuan $pengajuan, string $alasan): void
    {
        $warga = $pengajuan->warga;
        if (!$warga || !$warga->email) return;

        $html = '
            <div style="font-family:sans-serif;max-width:480px;margin:auto;">
                <div style="background:linear-gradient(135deg,#ba1a1a,#d32f2f);padding:32px;border-radius:16px 16px 0 0;text-align:center;">
                    <h1 style="color:#fff;margin:0;font-size:22px;">❌ Pengajuan Ditolak</h1>
                </div>
                <div style="background:#fff;padding:32px;border-radius:0 0 16px 16px;border:1px solid #eceef0;">
                    <p style="color:#191c1e;font-size:15px;">Halo, <strong>' . e($warga->nama) . '</strong></p>
                    <p style="color:#3d4947;">Mohon maaf, pengajuan surat Anda <strong style="color:#ba1a1a;">ditolak</strong> oleh Ketua RT 06.</p>
                    <div style="background:#f2f4f6;border-radius:12px;padding:16px;margin:16px 0;">
                        <p style="margin:0 0 4px 0;font-size:13px;color:#6d7a77;">Jenis Surat</p>
                        <p style="margin:0;font-weight:600;color:#191c1e;">' . e($pengajuan->jenis_surat) . '</p>
                        <p style="margin:12px 0 4px 0;font-size:13px;color:#6d7a77;">Alasan Penolakan</p>
                        <p style="margin:0;color:#ba1a1a;font-weight:500;">' . e($alasan) . '</p>
                    </div>
                    <p style="color:#3d4947;font-size:14px;">Silakan ajukan kembali setelah memperbaiki kekurangan di atas.</p>
                    <p style="color:#6d7a77;font-size:12px;margin-top:24px;">SIMART-06 • Sistem Manajemen RT</p>
                </div>
            </div>';

        $this->sendEmail($warga->email, '❌ Pengajuan Ditolak - SIMART-06', $html);
    }

    /**
     * Helper: kirim email via NodeMailer, fallback ke Laravel Mail.
     */
    private function sendEmail(string $to, string $subject, string $html): void
    {
        try {
            $mailer = app(NodeMailerService::class);
            $sent   = $mailer->send($to, $subject, $html);
            if (!$sent) {
                \Mail::html($html, fn ($m) => $m->to($to)->subject($subject));
            }
        } catch (\Throwable $e) {
            Log::warning('Notifikasi email gagal: ' . $e->getMessage());
        }
    }

    public function suratIndex()
    {
        $surat = Surat::with(['pengajuan.warga'])
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('rt.surat.index', compact('surat'));
    }

    public function wargaIndex()
    {
        $warga = \App\Models\Warga::withCount('pengajuan')
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('rt.warga.index', compact('warga'));
    }

    public function laporanIndex()
    {
        $data = [
            'totalPengajuan' => Pengajuan::count(),
            'pending' => Pengajuan::where('status', 'pending')->count(),
            'diproses' => Pengajuan::where('status', 'diproses')->count(),
            'selesai' => Pengajuan::where('status', 'selesai')->count(),
            'ditolak' => Pengajuan::where('status', 'ditolak')->count(),
        ];

        return view('rt.laporan.index', compact('data'));
    }

    public function downloadSurat(Surat $surat)
    {
        if (! $surat->file_surat || ! Storage::disk('private')->exists($surat->file_surat)) {
            return back()->withErrors('File surat tidak ditemukan');
        }

        $extension = pathinfo($surat->file_surat, PATHINFO_EXTENSION);
        $contentType = $extension === 'html' ? 'text/html' : 'application/pdf';

        if (request()->boolean('inline') || $extension === 'html') {
            return Storage::disk('private')->response($surat->file_surat, "Surat_{$surat->nomor_surat}.{$extension}", [
                'Content-Type' => $contentType,
                'Content-Disposition' => 'inline',
            ]);
        }

        return Storage::disk('private')->download($surat->file_surat, "Surat_{$surat->nomor_surat}.{$extension}");
    }

    /**
     * Update profil RT
     */
    public function updateProfilRT(Request $request)
    {
        $validated = $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'no_hp'   => 'nullable|string|max:20',
            'alamat'  => 'nullable|string|max:500',
        ]);

        // Update User model
        auth()->user()->update([
            'name'  => $validated['name'],
            'email' => $validated['email'],
        ]);

        // Update Warga model if exists
        $rt = auth()->user()->warga;
        if ($rt) {
            $rt->update([
                'nama'   => $validated['name'],
                'email'  => $validated['email'],
                'no_hp'  => $validated['no_hp'] ?? $rt->no_hp,
                'alamat' => $validated['alamat'] ?? $rt->alamat,
            ]);
        }

        return back()->with('success', 'Profil RT berhasil diperbarui!');
    }

    /**
     * Update password RT
     */
    public function updatePasswordRT(Request $request)
    {
        $validated = $request->validate([
            'password' => 'required|string|min:8',
        ]);

        auth()->user()->update(['password' => bcrypt($validated['password'])]);
        auth()->user()->warga?->update(['password' => bcrypt($validated['password'])]);

        return back()->with('success', 'Password RT berhasil diubah!');
    }

    /**
     * Update foto profil RT
     */
    public function updateFotoRT(Request $request)
    {
        $validated = $request->validate([
            'foto_profil' => 'required|file|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $rt = auth()->user()->warga;
        if (!$rt) {
            return back()->withErrors('Data RT tidak ditemukan');
        }

        if ($rt->foto_profil && Storage::disk('public')->exists($rt->foto_profil)) {
            Storage::disk('public')->delete($rt->foto_profil);
        }

        $path = $request->file('foto_profil')->store("profil/{$rt->id_warga}", 'public');
        $rt->update(['foto_profil' => $path]);

        return back()->with('success', 'Foto profil berhasil diperbarui!');
    }
    /**
     * Upload tanda tangan RT
     */
    public function updateTandaTanganRT(Request $request)
    {
        $validated = $request->validate([
            'tanda_tangan' => 'required|file|image|mimes:png,jpeg,jpg|max:2048',
        ]);

        $rt = auth()->user()->warga;
        if (!$rt) {
            return back()->withErrors('Data RT tidak ditemukan');
        }

        // Hapus file lama jika ada
        if ($rt->tanda_tangan && Storage::disk('public')->exists($rt->tanda_tangan)) {
            Storage::disk('public')->delete($rt->tanda_tangan);
        }

        $path = $request->file('tanda_tangan')->store('tanda_tangan', 'public');
        $rt->update(['tanda_tangan' => $path]);

        return back()->with('success', 'Tanda tangan berhasil diperbarui! Akan otomatis tercetak di surat yang disetujui.');
    }

    public function storePengumuman(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'kategori' => 'required|string|max:100',
            'sasaran' => 'required|string|max:100',
            'isi' => 'required|string',
            'waktu_mulai' => 'nullable|date',
            'waktu_selesai' => 'nullable|date|after_or_equal:waktu_mulai',
        ]);

        if (empty($validated['waktu_mulai'])) {
            $validated['waktu_mulai'] = now();
        }

        \App\Models\Pengumuman::create($validated);

        return redirect()->back()->with('success', 'Pengumuman berhasil dibuat dan dikirim ke warga!');
    }
}
