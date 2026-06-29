<?php

namespace Database\Seeders;

use App\Models\SuratTemplate;
use Illuminate\Database\Seeder;

class SuratTemplateSeeder extends Seeder
{
    public function run(): void
    {
        $templates = [
            [
                'jenis_surat' => 'jenis_1',
                'nama_surat'  => 'Surat Pernyataan Belum Pernah Menikah',
                'content'     => '<div style=\"font-family:\'Times New Roman\',Times,serif;font-size:12pt;line-height:1.5;color:#000;width:210mm;min-height:297mm;padding:2cm 2.5cm;margin:0 auto;background:#fff;box-sizing:border-box;\">

  <div style=\"text-align:center;margin:18px 0 30px;\">
    <p style=\"margin:0;font-size:14pt;font-weight:bold;text-decoration:underline;text-transform:uppercase;\">SURAT PERNYATAAN BELUM PERNAH MENIKAH</p>
  </div>

  <p style=\"margin:0 0 16px;\">Saya yang bertanda tangan di bawah ini:</p>
  
  <table style=\"width:100%;border-collapse:collapse;margin:0 0 20px 20px;\">
    <tr>
      <td style=\"width:30%;padding:4px 0;vertical-align:top;\">Nama</td>
      <td style=\"width:3%;padding:4px 0;vertical-align:top;\">:</td>
      <td style=\"padding:4px 0;vertical-align:top;\"><span id=\"field_nama\">[NAMA_LENGKAP]</span></td>
    </tr>
    <tr>
      <td style=\"padding:4px 0;vertical-align:top;\">NIK</td>
      <td style=\"padding:4px 0;vertical-align:top;\">:</td>
      <td style=\"padding:4px 0;vertical-align:top;\"><span id=\"field_nik\">[NIK]</span></td>
    </tr>
    <tr>
      <td style=\"padding:4px 0;vertical-align:top;\">Tempat, tanggal lahir</td>
      <td style=\"padding:4px 0;vertical-align:top;\">:</td>
      <td style=\"padding:4px 0;vertical-align:top;\"><span id=\"field_ttl\">[TEMPAT_TANGGAL_LAHIR]</span></td>
    </tr>
    <tr>
      <td style=\"padding:4px 0;vertical-align:top;\">Jenis Kelamin</td>
      <td style=\"padding:4px 0;vertical-align:top;\">:</td>
      <td style=\"padding:4px 0;vertical-align:top;\"><span id=\"field_jk\">[JENIS_KELAMIN]</span></td>
    </tr>
    <tr>
      <td style=\"padding:4px 0;vertical-align:top;\">Agama</td>
      <td style=\"padding:4px 0;vertical-align:top;\">:</td>
      <td style=\"padding:4px 0;vertical-align:top;\"><span id=\"field_agama\">[AGAMA]</span></td>
    </tr>
    <tr>
      <td style=\"padding:4px 0;vertical-align:top;\">Pekerjaan</td>
      <td style=\"padding:4px 0;vertical-align:top;\">:</td>
      <td style=\"padding:4px 0;vertical-align:top;\"><span id=\"field_pekerjaan\">[PEKERJAAN]</span></td>
    </tr>
    <tr>
      <td style=\"padding:4px 0;vertical-align:top;\">Alamat</td>
      <td style=\"padding:4px 0;vertical-align:top;\">:</td>
      <td style=\"padding:4px 0;vertical-align:top;\"><span id=\"field_alamat\">[ALAMAT_LENGKAP]</span></td>
    </tr>
  </table>

  <p style=\"text-align:justify;margin-bottom:12px;text-indent:30px;\">
    Menyatakan dengan sesungguhnya bahwa sampai saat ini saya belum pernah menikah dengan siapapun baik secara adat, hukum agama, atau hukum negara.
  </p>
  <p style=\"text-align:justify;margin-bottom:12px;text-indent:30px;\">
    Surat pernyataan ini saya buat sebagai persyaratan permohonan penerbitan Surat Keterangan Belum Menikah oleh Kelurahan Damai Bahagia yang selanjutnya akan kami gunakan untuk <span id=\"field_tujuan_penggunaan\">[TUJUAN_PENGGUNAAN]</span>.
  </p>
  <p style=\"text-align:justify;margin-bottom:30px;text-indent:30px;\">
    Demikian Surat Pernyataan ini saya buat dengan sebenar-benarnya. Apabila di kemudian hari terdapat hal-hal yang tidak sesuai dengan data yang saya cantumkan di Surat Pernyataan ini saya bersedia bertanggung jawab sesuai dengan ketentuan dan perundang-undangan yang berlaku tanpa melibatkan aparat Kelurahan.
  </p>

  <div style=\"display:flex;justify-content:flex-end;margin-bottom:20px;\">
    <div style=\"width:40%;text-align:center;\">
      <p style=\"margin:0 0 4px;\">Balikpapan, <span id=\"field_tgl_buat\">........................</span></p>
      <p style=\"margin:0 0 60px;\">Yang Membuat Pernyataan</p>
      <div style=\"position:relative;margin-bottom:5px;\">
        <span style=\"position:absolute;left:-20px;bottom:10px;font-size:10px;border:1px solid #000;padding:2px;\">Materai 10000</span>
      </div>
      <p style=\"margin:0;\">(<span id=\"field_ttd_nama\">..................................</span>) *</p>
    </div>
  </div>

  <p style=\"font-weight:bold;margin:0 0 8px;\">Saksi - Saksi :</p>
  <table style=\"width:100%;border-collapse:collapse;margin-bottom:20px;\">
    <tr>
      <th style=\"border:1px solid #000;padding:5px;width:5%;\">No</th>
      <th style=\"border:1px solid #000;padding:5px;width:35%;\">Nama</th>
      <th style=\"border:1px solid #000;padding:5px;width:30%;\">NIK</th>
      <th style=\"border:1px solid #000;padding:5px;width:30%;\">Tanda tangan</th>
    </tr>
    <tr>
      <td style=\"border:1px solid #000;padding:5px;text-align:center;\">1.</td>
      <td style=\"border:1px solid #000;padding:5px;\"><span id=\"field_saksi1_nama\">[NAMA_SAKSI_1]</span></td>
      <td style=\"border:1px solid #000;padding:5px;\"><span id=\"field_saksi1_nik\">[NIK_SAKSI_1]</span></td>
      <td style=\"border:1px solid #000;padding:5px;height:40px;\">1. </td>
    </tr>
    <tr>
      <td style=\"border:1px solid #000;padding:5px;text-align:center;\">2.</td>
      <td style=\"border:1px solid #000;padding:5px;\"><span id=\"field_saksi2_nama\">[NAMA_SAKSI_2]</span></td>
      <td style=\"border:1px solid #000;padding:5px;\"><span id=\"field_saksi2_nik\">[NIK_SAKSI_2]</span></td>
      <td style=\"border:1px solid #000;padding:5px;height:40px;\">2. </td>
    </tr>
  </table>

  <p style=\"font-size:10pt;\">*) Isi dengan lengkap</p>
</div>',
            ],
            [
                'jenis_surat' => 'jenis_2',
                'nama_surat'  => 'Surat Pernyataan Untuk Menikah',
                'content'     => '<div style=\"font-family:\'Times New Roman\',Times,serif;font-size:12pt;line-height:1.8;color:#000;width:210mm;min-height:297mm;padding:2cm 2.5cm;margin:0 auto;background:#fff;box-sizing:border-box;\">

  <div style=\"text-align:center;border-bottom:3px double #000;padding-bottom:10px;margin-bottom:6px;\">
    <p style=\"margin:0;font-size:14pt;font-weight:bold;letter-spacing:1px;\">RUKUN TETANGGA 06 / RUKUN WARGA 11</p>
    <p style=\"margin:2px 0;font-size:11pt;\">Kelurahan Sepinggan Raya, Kecamatan Balikpapan Selatan</p>
    <p style=\"margin:2px 0;font-size:10pt;\">Kota Balikpapan, Kalimantan Timur</p>
  </div>

  <div style=\"text-align:center;margin:18px 0 20px;\">
    <p style=\"margin:0;font-size:14pt;font-weight:bold;text-decoration:underline;text-transform:uppercase;letter-spacing:0.5px;\">Surat Pernyataan Untuk Menikah</p>
    <p style=\"margin:4px 0 0;font-size:10pt;\">Nomor: <span id=\"field_nomor_surat\">..........</span> /RT.06/RW.11/<span id=\"field_bulan\">.........</span>/<span id=\"field_tahun\">2026</span></p>
  </div><p style=\"margin:0 0 8px;\">Yang bertanda tangan di bawah ini:</p><table style=\"width:100%;border-collapse:collapse;margin:10px 0 20px 10px;\">    <tr>
      <td style=\"width:42%;padding:3px 6px;vertical-align:top;\">Nama Lengkap</td>
      <td style=\"width:3%;padding:3px 0;vertical-align:top;\">:</td>
      <td style=\"padding:3px 6px;vertical-align:top;\"><span id=\"field_nama_lengkap\">[NAMA_LENGKAP]</span></td>
    </tr>    <tr>
      <td style=\"width:42%;padding:3px 6px;vertical-align:top;\">Tempat, Tanggal Lahir</td>
      <td style=\"width:3%;padding:3px 0;vertical-align:top;\">:</td>
      <td style=\"padding:3px 6px;vertical-align:top;\"><span id=\"field_ttl\">[TEMPAT_LAHIR], [TANGGAL_LAHIR]</span></td>
    </tr>    <tr>
      <td style=\"width:42%;padding:3px 6px;vertical-align:top;\">Jenis Kelamin</td>
      <td style=\"width:3%;padding:3px 0;vertical-align:top;\">:</td>
      <td style=\"padding:3px 6px;vertical-align:top;\"><span id=\"field_jenis_kelamin\">[JENIS_KELAMIN]</span></td>
    </tr>    <tr>
      <td style=\"width:42%;padding:3px 6px;vertical-align:top;\">Agama</td>
      <td style=\"width:3%;padding:3px 0;vertical-align:top;\">:</td>
      <td style=\"padding:3px 6px;vertical-align:top;\"><span id=\"field_agama\">[AGAMA]</span></td>
    </tr>    <tr>
      <td style=\"width:42%;padding:3px 6px;vertical-align:top;\">Pekerjaan</td>
      <td style=\"width:3%;padding:3px 0;vertical-align:top;\">:</td>
      <td style=\"padding:3px 6px;vertical-align:top;\"><span id=\"field_pekerjaan\">[PEKERJAAN]</span></td>
    </tr>    <tr>
      <td style=\"width:42%;padding:3px 6px;vertical-align:top;\">Alamat</td>
      <td style=\"width:3%;padding:3px 0;vertical-align:top;\">:</td>
      <td style=\"padding:3px 6px;vertical-align:top;\"><span id=\"field_alamat\">[ALAMAT_LENGKAP]</span></td>
    </tr></table><p style=\"text-align:justify;\">Dengan ini menyatakan dengan sesungguhnya bahwa saya bermaksud untuk melangsungkan pernikahan dengan:</p><table style=\"width:100%;border-collapse:collapse;margin:10px 0 20px 10px;\">    <tr>
      <td style=\"width:42%;padding:3px 6px;vertical-align:top;\">Nama Calon Pasangan</td>
      <td style=\"width:3%;padding:3px 0;vertical-align:top;\">:</td>
      <td style=\"padding:3px 6px;vertical-align:top;\"><span id=\"field_nama_calon\">[NAMA_CALON_PASANGAN]</span></td>
    </tr>    <tr>
      <td style=\"width:42%;padding:3px 6px;vertical-align:top;\">Tempat, Tanggal Lahir</td>
      <td style=\"width:3%;padding:3px 0;vertical-align:top;\">:</td>
      <td style=\"padding:3px 6px;vertical-align:top;\"><span id=\"field_ttl_calon\">[TEMPAT_LAHIR_CALON], [TGL_LAHIR_CALON]</span></td>
    </tr>    <tr>
      <td style=\"width:42%;padding:3px 6px;vertical-align:top;\">Agama</td>
      <td style=\"width:3%;padding:3px 0;vertical-align:top;\">:</td>
      <td style=\"padding:3px 6px;vertical-align:top;\"><span id=\"field_agama_calon\">[AGAMA_CALON]</span></td>
    </tr>    <tr>
      <td style=\"width:42%;padding:3px 6px;vertical-align:top;\">Pekerjaan</td>
      <td style=\"width:3%;padding:3px 0;vertical-align:top;\">:</td>
      <td style=\"padding:3px 6px;vertical-align:top;\"><span id=\"field_pekerjaan_calon\">[PEKERJAAN_CALON]</span></td>
    </tr>    <tr>
      <td style=\"width:42%;padding:3px 6px;vertical-align:top;\">Alamat</td>
      <td style=\"width:3%;padding:3px 0;vertical-align:top;\">:</td>
      <td style=\"padding:3px 6px;vertical-align:top;\"><span id=\"field_alamat_calon\">[ALAMAT_CALON]</span></td>
    </tr></table><p style=\"text-align:justify;\">Dan saya menyatakan bahwa pernikahan yang akan dilangsungkan sesuai dengan hukum agama dan negara yang berlaku.</p>
  <p style=\"margin:24px 0 4px;\">Demikian surat pernyataan ini saya buat dengan sesungguhnya dan dalam keadaan sadar tanpa ada paksaan dari siapapun, untuk dapat digunakan sebagaimana mestinya.</p>

  <div style=\"margin-top:32px;display:flex;justify-content:space-between;\">
    <div style=\"width:45%;text-align:center;\">
      <p style=\"margin:0 0 60px;\">Mengetahui,<br><strong>Ketua RT 06 / RW 11</strong></p>
      <div id=\"signature_area\" style=\"border-top:1px solid #000;padding-top:4px;\">
        <p style=\"margin:0;font-size:11pt;\">(..................................)</p>
      </div>
    </div>
    <div style=\"width:45%;text-align:center;\">
      <p style=\"margin:0;\">Balikpapan, <span id=\"field_tanggal_ttd\">................</span></p>
      <p style=\"margin:0 0 60px;\">Yang Membuat Pernyataan,</p>
      <div style=\"border-top:1px solid #000;padding-top:4px;\">
        <p style=\"margin:0;font-size:11pt;\">(<span id=\"field_nama_ttd\">..................................</span>)</p>
      </div>
    </div>
  </div>

</div>',
            ],
            [
                'jenis_surat' => 'jenis_3',
                'nama_surat'  => 'Surat Pernyataan Janda/Duda',
                'content'     => '<div style=\"font-family:\'Times New Roman\',Times,serif;font-size:12pt;line-height:1.8;color:#000;width:210mm;min-height:297mm;padding:2cm 2.5cm;margin:0 auto;background:#fff;box-sizing:border-box;\">

  <div style=\"text-align:center;border-bottom:3px double #000;padding-bottom:10px;margin-bottom:6px;\">
    <p style=\"margin:0;font-size:14pt;font-weight:bold;letter-spacing:1px;\">RUKUN TETANGGA 06 / RUKUN WARGA 11</p>
    <p style=\"margin:2px 0;font-size:11pt;\">Kelurahan Sepinggan Raya, Kecamatan Balikpapan Selatan</p>
    <p style=\"margin:2px 0;font-size:10pt;\">Kota Balikpapan, Kalimantan Timur</p>
  </div>

  <div style=\"text-align:center;margin:18px 0 20px;\">
    <p style=\"margin:0;font-size:14pt;font-weight:bold;text-decoration:underline;text-transform:uppercase;letter-spacing:0.5px;\">Surat Pernyataan Janda / Duda</p>
    <p style=\"margin:4px 0 0;font-size:10pt;\">Nomor: <span id=\"field_nomor_surat\">..........</span> /RT.06/RW.11/<span id=\"field_bulan\">.........</span>/<span id=\"field_tahun\">2026</span></p>
  </div><p style=\"margin:0 0 8px;\">Yang bertanda tangan di bawah ini:</p><table style=\"width:100%;border-collapse:collapse;margin:10px 0 20px 10px;\">    <tr>
      <td style=\"width:42%;padding:3px 6px;vertical-align:top;\">Nama Lengkap</td>
      <td style=\"width:3%;padding:3px 0;vertical-align:top;\">:</td>
      <td style=\"padding:3px 6px;vertical-align:top;\"><span id=\"field_nama_lengkap\">[NAMA_LENGKAP]</span></td>
    </tr>    <tr>
      <td style=\"width:42%;padding:3px 6px;vertical-align:top;\">Tempat, Tanggal Lahir</td>
      <td style=\"width:3%;padding:3px 0;vertical-align:top;\">:</td>
      <td style=\"padding:3px 6px;vertical-align:top;\"><span id=\"field_ttl\">[TEMPAT_LAHIR], [TANGGAL_LAHIR]</span></td>
    </tr>    <tr>
      <td style=\"width:42%;padding:3px 6px;vertical-align:top;\">Jenis Kelamin</td>
      <td style=\"width:3%;padding:3px 0;vertical-align:top;\">:</td>
      <td style=\"padding:3px 6px;vertical-align:top;\"><span id=\"field_jenis_kelamin\">[JENIS_KELAMIN]</span></td>
    </tr>    <tr>
      <td style=\"width:42%;padding:3px 6px;vertical-align:top;\">Agama</td>
      <td style=\"width:3%;padding:3px 0;vertical-align:top;\">:</td>
      <td style=\"padding:3px 6px;vertical-align:top;\"><span id=\"field_agama\">[AGAMA]</span></td>
    </tr>    <tr>
      <td style=\"width:42%;padding:3px 6px;vertical-align:top;\">Pekerjaan</td>
      <td style=\"width:3%;padding:3px 0;vertical-align:top;\">:</td>
      <td style=\"padding:3px 6px;vertical-align:top;\"><span id=\"field_pekerjaan\">[PEKERJAAN]</span></td>
    </tr>    <tr>
      <td style=\"width:42%;padding:3px 6px;vertical-align:top;\">Alamat</td>
      <td style=\"width:3%;padding:3px 0;vertical-align:top;\">:</td>
      <td style=\"padding:3px 6px;vertical-align:top;\"><span id=\"field_alamat\">[ALAMAT_LENGKAP]</span></td>
    </tr>    <tr>
      <td style=\"width:42%;padding:3px 6px;vertical-align:top;\">Status</td>
      <td style=\"width:3%;padding:3px 0;vertical-align:top;\">:</td>
      <td style=\"padding:3px 6px;vertical-align:top;\"><span id=\"field_status\">[JANDA / DUDA]</span></td>
    </tr></table><p style=\"text-align:justify;\">Dengan ini menyatakan dengan sesungguhnya bahwa saya berstatus <strong><span id=\"field_status_bold\">[JANDA / DUDA]</span></strong> akibat <span id=\"field_alasan\">[CERAI / MENINGGAL DUNIA]</span> dari pasangan saya yang bernama <span id=\"field_nama_mantan\">[NAMA_MANTAN_PASANGAN]</span>.</p>
     <p style=\"text-align:justify;margin-top:8px;\">Surat pernyataan ini dibuat untuk keperluan: <span id=\"field_keperluan\">[KEPERLUAN_SURAT]</span>.</p>
  <p style=\"margin:24px 0 4px;\">Demikian surat pernyataan ini saya buat dengan sesungguhnya dan dalam keadaan sadar tanpa ada paksaan dari siapapun, untuk dapat digunakan sebagaimana mestinya.</p>

  <div style=\"margin-top:32px;display:flex;justify-content:space-between;\">
    <div style=\"width:45%;text-align:center;\">
      <p style=\"margin:0 0 60px;\">Mengetahui,<br><strong>Ketua RT 06 / RW 11</strong></p>
      <div id=\"signature_area\" style=\"border-top:1px solid #000;padding-top:4px;\">
        <p style=\"margin:0;font-size:11pt;\">(..................................)</p>
      </div>
    </div>
    <div style=\"width:45%;text-align:center;\">
      <p style=\"margin:0;\">Balikpapan, <span id=\"field_tanggal_ttd\">................</span></p>
      <p style=\"margin:0 0 60px;\">Yang Membuat Pernyataan,</p>
      <div style=\"border-top:1px solid #000;padding-top:4px;\">
        <p style=\"margin:0;font-size:11pt;\">(<span id=\"field_nama_ttd\">..................................</span>)</p>
      </div>
    </div>
  </div>

</div>',
            ],
            [
                'jenis_surat' => 'jenis_4',
                'nama_surat'  => 'Surat Pernyataan Orang yang Sama',
                'content'     => '<div style=\"font-family:\'Times New Roman\',Times,serif;font-size:12pt;line-height:1.8;color:#000;width:210mm;min-height:297mm;padding:2cm 2.5cm;margin:0 auto;background:#fff;box-sizing:border-box;\">

  <div style=\"text-align:center;border-bottom:3px double #000;padding-bottom:10px;margin-bottom:6px;\">
    <p style=\"margin:0;font-size:14pt;font-weight:bold;letter-spacing:1px;\">RUKUN TETANGGA 06 / RUKUN WARGA 11</p>
    <p style=\"margin:2px 0;font-size:11pt;\">Kelurahan Sepinggan Raya, Kecamatan Balikpapan Selatan</p>
    <p style=\"margin:2px 0;font-size:10pt;\">Kota Balikpapan, Kalimantan Timur</p>
  </div>

  <div style=\"text-align:center;margin:18px 0 20px;\">
    <p style=\"margin:0;font-size:14pt;font-weight:bold;text-decoration:underline;text-transform:uppercase;letter-spacing:0.5px;\">Surat Pernyataan Orang yang Sama</p>
    <p style=\"margin:4px 0 0;font-size:10pt;\">Nomor: <span id=\"field_nomor_surat\">..........</span> /RT.06/RW.11/<span id=\"field_bulan\">.........</span>/<span id=\"field_tahun\">2026</span></p>
  </div><p style=\"margin:0 0 8px;\">Yang bertanda tangan di bawah ini:</p><table style=\"width:100%;border-collapse:collapse;margin:10px 0 20px 10px;\">    <tr>
      <td style=\"width:42%;padding:3px 6px;vertical-align:top;\">Nama Lengkap</td>
      <td style=\"width:3%;padding:3px 0;vertical-align:top;\">:</td>
      <td style=\"padding:3px 6px;vertical-align:top;\"><span id=\"field_nama_lengkap\">[NAMA_LENGKAP]</span></td>
    </tr>    <tr>
      <td style=\"width:42%;padding:3px 6px;vertical-align:top;\">Tempat, Tanggal Lahir</td>
      <td style=\"width:3%;padding:3px 0;vertical-align:top;\">:</td>
      <td style=\"padding:3px 6px;vertical-align:top;\"><span id=\"field_ttl\">[TEMPAT_LAHIR], [TANGGAL_LAHIR]</span></td>
    </tr>    <tr>
      <td style=\"width:42%;padding:3px 6px;vertical-align:top;\">Agama</td>
      <td style=\"width:3%;padding:3px 0;vertical-align:top;\">:</td>
      <td style=\"padding:3px 6px;vertical-align:top;\"><span id=\"field_agama\">[AGAMA]</span></td>
    </tr>    <tr>
      <td style=\"width:42%;padding:3px 6px;vertical-align:top;\">Pekerjaan</td>
      <td style=\"width:3%;padding:3px 0;vertical-align:top;\">:</td>
      <td style=\"padding:3px 6px;vertical-align:top;\"><span id=\"field_pekerjaan\">[PEKERJAAN]</span></td>
    </tr>    <tr>
      <td style=\"width:42%;padding:3px 6px;vertical-align:top;\">Alamat</td>
      <td style=\"width:3%;padding:3px 0;vertical-align:top;\">:</td>
      <td style=\"padding:3px 6px;vertical-align:top;\"><span id=\"field_alamat\">[ALAMAT_LENGKAP]</span></td>
    </tr></table><p style=\"text-align:justify;\">Dengan ini menyatakan dengan sesungguhnya bahwa nama <strong><span id=\"field_nama_di_dokumen\">[NAMA_DI_DOKUMEN_LAIN]</span></strong> yang tercantum dalam <span id=\"field_jenis_dokumen\">[JENIS_DOKUMEN]</span> adalah benar merupakan nama lain dari orang yang sama dengan saya, yaitu <strong><span id=\"field_nama_sekarang\">[NAMA_LENGKAP]</span></strong>.</p>
     <p style=\"text-align:justify;margin-top:8px;\">Keterangan: <span id=\"field_keterangan\">[KETERANGAN_TAMBAHAN]</span>.</p>
  <p style=\"margin:24px 0 4px;\">Demikian surat pernyataan ini saya buat dengan sesungguhnya dan dalam keadaan sadar tanpa ada paksaan dari siapapun, untuk dapat digunakan sebagaimana mestinya.</p>

  <div style=\"margin-top:32px;display:flex;justify-content:space-between;\">
    <div style=\"width:45%;text-align:center;\">
      <p style=\"margin:0 0 60px;\">Mengetahui,<br><strong>Ketua RT 06 / RW 11</strong></p>
      <div id=\"signature_area\" style=\"border-top:1px solid #000;padding-top:4px;\">
        <p style=\"margin:0;font-size:11pt;\">(..................................)</p>
      </div>
    </div>
    <div style=\"width:45%;text-align:center;\">
      <p style=\"margin:0;\">Balikpapan, <span id=\"field_tanggal_ttd\">................</span></p>
      <p style=\"margin:0 0 60px;\">Yang Membuat Pernyataan,</p>
      <div style=\"border-top:1px solid #000;padding-top:4px;\">
        <p style=\"margin:0;font-size:11pt;\">(<span id=\"field_nama_ttd\">..................................</span>)</p>
      </div>
    </div>
  </div>

</div>',
            ],
            [
                'jenis_surat' => 'jenis_5',
                'nama_surat'  => 'Surat Pernyataan Berpenghasilan Tidak Tetap',
                'content'     => '<div style=\"font-family:\'Times New Roman\',Times,serif;font-size:12pt;line-height:1.8;color:#000;width:210mm;min-height:297mm;padding:2cm 2.5cm;margin:0 auto;background:#fff;box-sizing:border-box;\">

  <div style=\"text-align:center;border-bottom:3px double #000;padding-bottom:10px;margin-bottom:6px;\">
    <p style=\"margin:0;font-size:14pt;font-weight:bold;letter-spacing:1px;\">RUKUN TETANGGA 06 / RUKUN WARGA 11</p>
    <p style=\"margin:2px 0;font-size:11pt;\">Kelurahan Sepinggan Raya, Kecamatan Balikpapan Selatan</p>
    <p style=\"margin:2px 0;font-size:10pt;\">Kota Balikpapan, Kalimantan Timur</p>
  </div>

  <div style=\"text-align:center;margin:18px 0 20px;\">
    <p style=\"margin:0;font-size:14pt;font-weight:bold;text-decoration:underline;text-transform:uppercase;letter-spacing:0.5px;\">Surat Pernyataan Berpenghasilan Tidak Tetap</p>
    <p style=\"margin:4px 0 0;font-size:10pt;\">Nomor: <span id=\"field_nomor_surat\">..........</span> /RT.06/RW.11/<span id=\"field_bulan\">.........</span>/<span id=\"field_tahun\">2026</span></p>
  </div><p style=\"margin:0 0 8px;\">Yang bertanda tangan di bawah ini:</p><table style=\"width:100%;border-collapse:collapse;margin:10px 0 20px 10px;\">    <tr>
      <td style=\"width:42%;padding:3px 6px;vertical-align:top;\">Nama Lengkap</td>
      <td style=\"width:3%;padding:3px 0;vertical-align:top;\">:</td>
      <td style=\"padding:3px 6px;vertical-align:top;\"><span id=\"field_nama_lengkap\">[NAMA_LENGKAP]</span></td>
    </tr>    <tr>
      <td style=\"width:42%;padding:3px 6px;vertical-align:top;\">Tempat, Tanggal Lahir</td>
      <td style=\"width:3%;padding:3px 0;vertical-align:top;\">:</td>
      <td style=\"padding:3px 6px;vertical-align:top;\"><span id=\"field_ttl\">[TEMPAT_LAHIR], [TANGGAL_LAHIR]</span></td>
    </tr>    <tr>
      <td style=\"width:42%;padding:3px 6px;vertical-align:top;\">Jenis Kelamin</td>
      <td style=\"width:3%;padding:3px 0;vertical-align:top;\">:</td>
      <td style=\"padding:3px 6px;vertical-align:top;\"><span id=\"field_jenis_kelamin\">[JENIS_KELAMIN]</span></td>
    </tr>    <tr>
      <td style=\"width:42%;padding:3px 6px;vertical-align:top;\">Agama</td>
      <td style=\"width:3%;padding:3px 0;vertical-align:top;\">:</td>
      <td style=\"padding:3px 6px;vertical-align:top;\"><span id=\"field_agama\">[AGAMA]</span></td>
    </tr>    <tr>
      <td style=\"width:42%;padding:3px 6px;vertical-align:top;\">Pekerjaan / Usaha</td>
      <td style=\"width:3%;padding:3px 0;vertical-align:top;\">:</td>
      <td style=\"padding:3px 6px;vertical-align:top;\"><span id=\"field_pekerjaan\">[PEKERJAAN / JENIS_USAHA]</span></td>
    </tr>    <tr>
      <td style=\"width:42%;padding:3px 6px;vertical-align:top;\">Alamat</td>
      <td style=\"width:3%;padding:3px 0;vertical-align:top;\">:</td>
      <td style=\"padding:3px 6px;vertical-align:top;\"><span id=\"field_alamat\">[ALAMAT_LENGKAP]</span></td>
    </tr></table><p style=\"text-align:justify;\">Dengan ini menyatakan dengan sesungguhnya bahwa saya benar merupakan warga yang <strong>berpenghasilan tidak tetap</strong> dengan perkiraan penghasilan rata-rata per bulan sebesar <strong>Rp <span id=\"field_penghasilan\">[PERKIRAAN_PENGHASILAN_PER_BULAN]</span>,-</strong>.</p>
     <p style=\"text-align:justify;margin-top:8px;\">Surat pernyataan ini dibuat untuk keperluan: <span id=\"field_keperluan\">[KEPERLUAN_SURAT]</span>.</p>
  <p style=\"margin:24px 0 4px;\">Demikian surat pernyataan ini saya buat dengan sesungguhnya dan dalam keadaan sadar tanpa ada paksaan dari siapapun, untuk dapat digunakan sebagaimana mestinya.</p>

  <div style=\"margin-top:32px;display:flex;justify-content:space-between;\">
    <div style=\"width:45%;text-align:center;\">
      <p style=\"margin:0 0 60px;\">Mengetahui,<br><strong>Ketua RT 06 / RW 11</strong></p>
      <div id=\"signature_area\" style=\"border-top:1px solid #000;padding-top:4px;\">
        <p style=\"margin:0;font-size:11pt;\">(..................................)</p>
      </div>
    </div>
    <div style=\"width:45%;text-align:center;\">
      <p style=\"margin:0;\">Balikpapan, <span id=\"field_tanggal_ttd\">................</span></p>
      <p style=\"margin:0 0 60px;\">Yang Membuat Pernyataan,</p>
      <div style=\"border-top:1px solid #000;padding-top:4px;\">
        <p style=\"margin:0;font-size:11pt;\">(<span id=\"field_nama_ttd\">..................................</span>)</p>
      </div>
    </div>
  </div>

</div>',
            ],
            [
                'jenis_surat' => 'jenis_6',
                'nama_surat'  => 'Surat Pernyataan Jaminan Bertempat Tinggal',
                'content'     => '<div style=\"font-family:\'Times New Roman\',Times,serif;font-size:12pt;line-height:1.8;color:#000;width:210mm;min-height:297mm;padding:2cm 2.5cm;margin:0 auto;background:#fff;box-sizing:border-box;\">

  <div style=\"text-align:center;border-bottom:3px double #000;padding-bottom:10px;margin-bottom:6px;\">
    <p style=\"margin:0;font-size:14pt;font-weight:bold;letter-spacing:1px;\">RUKUN TETANGGA 06 / RUKUN WARGA 11</p>
    <p style=\"margin:2px 0;font-size:11pt;\">Kelurahan Sepinggan Raya, Kecamatan Balikpapan Selatan</p>
    <p style=\"margin:2px 0;font-size:10pt;\">Kota Balikpapan, Kalimantan Timur</p>
  </div>

  <div style=\"text-align:center;margin:18px 0 20px;\">
    <p style=\"margin:0;font-size:14pt;font-weight:bold;text-decoration:underline;text-transform:uppercase;letter-spacing:0.5px;\">Surat Pernyataan Jaminan Bertempat Tinggal</p>
    <p style=\"margin:4px 0 0;font-size:10pt;\">Nomor: <span id=\"field_nomor_surat\">..........</span> /RT.06/RW.11/<span id=\"field_bulan\">.........</span>/<span id=\"field_tahun\">2026</span></p>
  </div><p style=\"margin:0 0 8px;\">Yang bertanda tangan di bawah ini selaku penjamin:</p><table style=\"width:100%;border-collapse:collapse;margin:10px 0 20px 10px;\">    <tr>
      <td style=\"width:42%;padding:3px 6px;vertical-align:top;\">Nama Penjamin</td>
      <td style=\"width:3%;padding:3px 0;vertical-align:top;\">:</td>
      <td style=\"padding:3px 6px;vertical-align:top;\"><span id=\"field_nama_penjamin\">[NAMA_PENJAMIN]</span></td>
    </tr>    <tr>
      <td style=\"width:42%;padding:3px 6px;vertical-align:top;\">Alamat Penjamin</td>
      <td style=\"width:3%;padding:3px 0;vertical-align:top;\">:</td>
      <td style=\"padding:3px 6px;vertical-align:top;\"><span id=\"field_alamat_penjamin\">[ALAMAT_PENJAMIN]</span></td>
    </tr></table><p style=\"margin:8px 0;\">Dengan ini menyatakan dan menjamin bahwa orang tersebut di bawah ini:</p><table style=\"width:100%;border-collapse:collapse;margin:10px 0 20px 10px;\">    <tr>
      <td style=\"width:42%;padding:3px 6px;vertical-align:top;\">Nama yang Dijamin</td>
      <td style=\"width:3%;padding:3px 0;vertical-align:top;\">:</td>
      <td style=\"padding:3px 6px;vertical-align:top;\"><span id=\"field_nama_dijamin\">[NAMA_YANG_DIJAMIN]</span></td>
    </tr>    <tr>
      <td style=\"width:42%;padding:3px 6px;vertical-align:top;\">Tempat, Tanggal Lahir</td>
      <td style=\"width:3%;padding:3px 0;vertical-align:top;\">:</td>
      <td style=\"padding:3px 6px;vertical-align:top;\"><span id=\"field_ttl_dijamin\">[TEMPAT_LAHIR], [TANGGAL_LAHIR]</span></td>
    </tr>    <tr>
      <td style=\"width:42%;padding:3px 6px;vertical-align:top;\">Jenis Kelamin</td>
      <td style=\"width:3%;padding:3px 0;vertical-align:top;\">:</td>
      <td style=\"padding:3px 6px;vertical-align:top;\"><span id=\"field_jenis_kelamin\">[JENIS_KELAMIN]</span></td>
    </tr>    <tr>
      <td style=\"width:42%;padding:3px 6px;vertical-align:top;\">Pekerjaan</td>
      <td style=\"width:3%;padding:3px 0;vertical-align:top;\">:</td>
      <td style=\"padding:3px 6px;vertical-align:top;\"><span id=\"field_pekerjaan\">[PEKERJAAN]</span></td>
    </tr>    <tr>
      <td style=\"width:42%;padding:3px 6px;vertical-align:top;\">Alamat Tinggal</td>
      <td style=\"width:3%;padding:3px 0;vertical-align:top;\">:</td>
      <td style=\"padding:3px 6px;vertical-align:top;\"><span id=\"field_alamat_tinggal\">[ALAMAT_TEMPAT_TINGGAL]</span></td>
    </tr></table><p style=\"text-align:justify;\">Benar-benar bertempat tinggal di alamat yang tertera di atas dan berada dalam jaminan saya. Apabila di kemudian hari terjadi hal-hal yang tidak diinginkan, saya bersedia bertanggung jawab sepenuhnya.</p>
     <p style=\"text-align:justify;margin-top:8px;\">Surat ini dibuat untuk keperluan: <span id=\"field_keperluan\">[KEPERLUAN_SURAT]</span>.</p>
  <p style=\"margin:24px 0 4px;\">Demikian surat pernyataan ini saya buat dengan sesungguhnya dan dalam keadaan sadar tanpa ada paksaan dari siapapun, untuk dapat digunakan sebagaimana mestinya.</p>

  <div style=\"margin-top:32px;display:flex;justify-content:space-between;\">
    <div style=\"width:45%;text-align:center;\">
      <p style=\"margin:0 0 60px;\">Mengetahui,<br><strong>Ketua RT 06 / RW 11</strong></p>
      <div id=\"signature_area\" style=\"border-top:1px solid #000;padding-top:4px;\">
        <p style=\"margin:0;font-size:11pt;\">(..................................)</p>
      </div>
    </div>
    <div style=\"width:45%;text-align:center;\">
      <p style=\"margin:0;\">Balikpapan, <span id=\"field_tanggal_ttd\">................</span></p>
      <p style=\"margin:0 0 60px;\">Yang Membuat Pernyataan,</p>
      <div style=\"border-top:1px solid #000;padding-top:4px;\">
        <p style=\"margin:0;font-size:11pt;\">(<span id=\"field_nama_ttd\">..................................</span>)</p>
      </div>
    </div>
  </div>

</div>',
            ],
            [
                'jenis_surat' => 'jenis_7',
                'nama_surat'  => 'Surat Pernyataan Jaminan Bertempat Tinggal khusus WNA',
                'content'     => '<div style=\"font-family:\'Times New Roman\',Times,serif;font-size:12pt;line-height:1.8;color:#000;width:210mm;min-height:297mm;padding:2cm 2.5cm;margin:0 auto;background:#fff;box-sizing:border-box;\">

  <div style=\"text-align:center;border-bottom:3px double #000;padding-bottom:10px;margin-bottom:6px;\">
    <p style=\"margin:0;font-size:14pt;font-weight:bold;letter-spacing:1px;\">RUKUN TETANGGA 06 / RUKUN WARGA 11</p>
    <p style=\"margin:2px 0;font-size:11pt;\">Kelurahan Sepinggan Raya, Kecamatan Balikpapan Selatan</p>
    <p style=\"margin:2px 0;font-size:10pt;\">Kota Balikpapan, Kalimantan Timur</p>
  </div>

  <div style=\"text-align:center;margin:18px 0 20px;\">
    <p style=\"margin:0;font-size:14pt;font-weight:bold;text-decoration:underline;text-transform:uppercase;letter-spacing:0.5px;\">Surat Pernyataan Jaminan Bertempat Tinggal Khusus WNA</p>
    <p style=\"margin:4px 0 0;font-size:10pt;\">Nomor: <span id=\"field_nomor_surat\">..........</span> /RT.06/RW.11/<span id=\"field_bulan\">.........</span>/<span id=\"field_tahun\">2026</span></p>
  </div><p style=\"margin:0 0 8px;\">Yang bertanda tangan di bawah ini selaku Penanggung Jawab (Penjamin) Warga Negara Asing:</p><table style=\"width:100%;border-collapse:collapse;margin:10px 0 20px 10px;\">    <tr>
      <td style=\"width:42%;padding:3px 6px;vertical-align:top;\">Nama Penjamin (WNI)</td>
      <td style=\"width:3%;padding:3px 0;vertical-align:top;\">:</td>
      <td style=\"padding:3px 6px;vertical-align:top;\"><span id=\"field_nama_penjamin\">[NAMA_PENJAMIN]</span></td>
    </tr>    <tr>
      <td style=\"width:42%;padding:3px 6px;vertical-align:top;\">NIK Penjamin</td>
      <td style=\"width:3%;padding:3px 0;vertical-align:top;\">:</td>
      <td style=\"padding:3px 6px;vertical-align:top;\"><span id=\"field_nik_penjamin\">[NIK_PENJAMIN]</span></td>
    </tr>    <tr>
      <td style=\"width:42%;padding:3px 6px;vertical-align:top;\">Alamat Penjamin</td>
      <td style=\"width:3%;padding:3px 0;vertical-align:top;\">:</td>
      <td style=\"padding:3px 6px;vertical-align:top;\"><span id=\"field_alamat_penjamin\">[ALAMAT_PENJAMIN]</span></td>
    </tr></table><p style=\"margin:8px 0;\">Dengan ini menyatakan dan menjamin keberadaan Warga Negara Asing berikut:</p><table style=\"width:100%;border-collapse:collapse;margin:10px 0 20px 10px;\">    <tr>
      <td style=\"width:42%;padding:3px 6px;vertical-align:top;\">Nama WNA</td>
      <td style=\"width:3%;padding:3px 0;vertical-align:top;\">:</td>
      <td style=\"padding:3px 6px;vertical-align:top;\"><span id=\"field_nama_wna\">[NAMA_WNA]</span></td>
    </tr>    <tr>
      <td style=\"width:42%;padding:3px 6px;vertical-align:top;\">Kewarganegaraan</td>
      <td style=\"width:3%;padding:3px 0;vertical-align:top;\">:</td>
      <td style=\"padding:3px 6px;vertical-align:top;\"><span id=\"field_kewarganegaraan\">[KEWARGANEGARAAN_WNA]</span></td>
    </tr>    <tr>
      <td style=\"width:42%;padding:3px 6px;vertical-align:top;\">Nomor Paspor</td>
      <td style=\"width:3%;padding:3px 0;vertical-align:top;\">:</td>
      <td style=\"padding:3px 6px;vertical-align:top;\"><span id=\"field_nomor_paspor\">[NOMOR_PASPOR]</span></td>
    </tr>    <tr>
      <td style=\"width:42%;padding:3px 6px;vertical-align:top;\">Alamat Tinggal</td>
      <td style=\"width:3%;padding:3px 0;vertical-align:top;\">:</td>
      <td style=\"padding:3px 6px;vertical-align:top;\"><span id=\"field_alamat_tinggal\">[ALAMAT_TINGGAL_WNA]</span></td>
    </tr></table><p style=\"text-align:justify;\">Bahwa WNA tersebut benar-benar bertempat tinggal di alamat yang tertera dan saya bertanggung jawab penuh atas segala perbuatan WNA dimaksud selama berada di wilayah RT 06/RW 11.</p>
     <p style=\"text-align:justify;margin-top:8px;\">Surat ini dibuat untuk keperluan: <span id=\"field_keperluan\">[KEPERLUAN_SURAT]</span>.</p>
  <p style=\"margin:24px 0 4px;\">Demikian surat pernyataan ini saya buat dengan sesungguhnya dan dalam keadaan sadar tanpa ada paksaan dari siapapun, untuk dapat digunakan sebagaimana mestinya.</p>

  <div style=\"margin-top:32px;display:flex;justify-content:space-between;\">
    <div style=\"width:45%;text-align:center;\">
      <p style=\"margin:0 0 60px;\">Mengetahui,<br><strong>Ketua RT 06 / RW 11</strong></p>
      <div id=\"signature_area\" style=\"border-top:1px solid #000;padding-top:4px;\">
        <p style=\"margin:0;font-size:11pt;\">(..................................)</p>
      </div>
    </div>
    <div style=\"width:45%;text-align:center;\">
      <p style=\"margin:0;\">Balikpapan, <span id=\"field_tanggal_ttd\">................</span></p>
      <p style=\"margin:0 0 60px;\">Yang Membuat Pernyataan,</p>
      <div style=\"border-top:1px solid #000;padding-top:4px;\">
        <p style=\"margin:0;font-size:11pt;\">(<span id=\"field_nama_ttd\">..................................</span>)</p>
      </div>
    </div>
  </div>

</div>',
            ],
            [
                'jenis_surat' => 'jenis_8',
                'nama_surat'  => 'Surat Pernyataan Gaib (Ditinggal pergi oleh suami / istri)',
                'content'     => '<div style=\"font-family:\'Times New Roman\',Times,serif;font-size:12pt;line-height:1.8;color:#000;width:210mm;min-height:297mm;padding:2cm 2.5cm;margin:0 auto;background:#fff;box-sizing:border-box;\">

  <div style=\"text-align:center;border-bottom:3px double #000;padding-bottom:10px;margin-bottom:6px;\">
    <p style=\"margin:0;font-size:14pt;font-weight:bold;letter-spacing:1px;\">RUKUN TETANGGA 06 / RUKUN WARGA 11</p>
    <p style=\"margin:2px 0;font-size:11pt;\">Kelurahan Sepinggan Raya, Kecamatan Balikpapan Selatan</p>
    <p style=\"margin:2px 0;font-size:10pt;\">Kota Balikpapan, Kalimantan Timur</p>
  </div>

  <div style=\"text-align:center;margin:18px 0 20px;\">
    <p style=\"margin:0;font-size:14pt;font-weight:bold;text-decoration:underline;text-transform:uppercase;letter-spacing:0.5px;\">Surat Pernyataan Gaib (Ditinggal Pergi oleh Suami / Istri)</p>
    <p style=\"margin:4px 0 0;font-size:10pt;\">Nomor: <span id=\"field_nomor_surat\">..........</span> /RT.06/RW.11/<span id=\"field_bulan\">.........</span>/<span id=\"field_tahun\">2026</span></p>
  </div><p style=\"margin:0 0 8px;\">Yang bertanda tangan di bawah ini:</p><table style=\"width:100%;border-collapse:collapse;margin:10px 0 20px 10px;\">    <tr>
      <td style=\"width:42%;padding:3px 6px;vertical-align:top;\">Nama Pelapor</td>
      <td style=\"width:3%;padding:3px 0;vertical-align:top;\">:</td>
      <td style=\"padding:3px 6px;vertical-align:top;\"><span id=\"field_nama_pelapor\">[NAMA_PELAPOR]</span></td>
    </tr>    <tr>
      <td style=\"width:42%;padding:3px 6px;vertical-align:top;\">Tempat, Tanggal Lahir</td>
      <td style=\"width:3%;padding:3px 0;vertical-align:top;\">:</td>
      <td style=\"padding:3px 6px;vertical-align:top;\"><span id=\"field_ttl\">[TEMPAT_LAHIR], [TANGGAL_LAHIR]</span></td>
    </tr>    <tr>
      <td style=\"width:42%;padding:3px 6px;vertical-align:top;\">Hubungan</td>
      <td style=\"width:3%;padding:3px 0;vertical-align:top;\">:</td>
      <td style=\"padding:3px 6px;vertical-align:top;\"><span id=\"field_hubungan\">[SUAMI / ISTRI]</span></td>
    </tr>    <tr>
      <td style=\"width:42%;padding:3px 6px;vertical-align:top;\">Alamat</td>
      <td style=\"width:3%;padding:3px 0;vertical-align:top;\">:</td>
      <td style=\"padding:3px 6px;vertical-align:top;\"><span id=\"field_alamat\">[ALAMAT_PELAPOR]</span></td>
    </tr></table><p style=\"text-align:justify;\">Dengan ini menyatakan dengan sesungguhnya bahwa <span id=\"field_hubungan_gaib\">[SUAMI / ISTRI]</span> saya yang bernama <strong><span id=\"field_nama_gaib\">[NAMA_YANG_GAIB]</span></strong> telah pergi meninggalkan saya sejak tanggal <span id=\"field_tgl_terakhir\">[TANGGAL_TERAKHIR_DIKETAHUI]</span> dan hingga saat ini tidak diketahui keberadaannya.</p>
     <p style=\"text-align:justify;margin-top:8px;\">Keterangan tambahan: <span id=\"field_keterangan\">[KETERANGAN_TAMBAHAN]</span>.</p>
     <p style=\"text-align:justify;margin-top:8px;\">Surat pernyataan ini dibuat untuk keperluan administrasi yang diperlukan.</p>
  <p style=\"margin:24px 0 4px;\">Demikian surat pernyataan ini saya buat dengan sesungguhnya dan dalam keadaan sadar tanpa ada paksaan dari siapapun, untuk dapat digunakan sebagaimana mestinya.</p>

  <div style=\"margin-top:32px;display:flex;justify-content:space-between;\">
    <div style=\"width:45%;text-align:center;\">
      <p style=\"margin:0 0 60px;\">Mengetahui,<br><strong>Ketua RT 06 / RW 11</strong></p>
      <div id=\"signature_area\" style=\"border-top:1px solid #000;padding-top:4px;\">
        <p style=\"margin:0;font-size:11pt;\">(..................................)</p>
      </div>
    </div>
    <div style=\"width:45%;text-align:center;\">
      <p style=\"margin:0;\">Balikpapan, <span id=\"field_tanggal_ttd\">................</span></p>
      <p style=\"margin:0 0 60px;\">Yang Membuat Pernyataan,</p>
      <div style=\"border-top:1px solid #000;padding-top:4px;\">
        <p style=\"margin:0;font-size:11pt;\">(<span id=\"field_nama_ttd\">..................................</span>)</p>
      </div>
    </div>
  </div>

</div>',
            ],
            [
                'jenis_surat' => 'jenis_9',
                'nama_surat'  => 'Surat Pernyataan Tanggung Jawab Mutlak (SPTJM) Kebenaran Data Kematian',
                'content'     => '<div style=\"font-family:\'Times New Roman\',Times,serif;font-size:12pt;line-height:1.8;color:#000;width:210mm;min-height:297mm;padding:2cm 2.5cm;margin:0 auto;background:#fff;box-sizing:border-box;\">

  <div style=\"text-align:center;border-bottom:3px double #000;padding-bottom:10px;margin-bottom:6px;\">
    <p style=\"margin:0;font-size:14pt;font-weight:bold;letter-spacing:1px;\">RUKUN TETANGGA 06 / RUKUN WARGA 11</p>
    <p style=\"margin:2px 0;font-size:11pt;\">Kelurahan Sepinggan Raya, Kecamatan Balikpapan Selatan</p>
    <p style=\"margin:2px 0;font-size:10pt;\">Kota Balikpapan, Kalimantan Timur</p>
  </div>

  <div style=\"text-align:center;margin:18px 0 20px;\">
    <p style=\"margin:0;font-size:14pt;font-weight:bold;text-decoration:underline;text-transform:uppercase;letter-spacing:0.5px;\">Surat Pernyataan Tanggung Jawab Mutlak (SPTJM) Kebenaran Data Kematian</p>
    <p style=\"margin:4px 0 0;font-size:10pt;\">Nomor: <span id=\"field_nomor_surat\">..........</span> /RT.06/RW.11/<span id=\"field_bulan\">.........</span>/<span id=\"field_tahun\">2026</span></p>
  </div><p style=\"margin:0 0 8px;\">Yang bertanda tangan di bawah ini:</p><table style=\"width:100%;border-collapse:collapse;margin:10px 0 20px 10px;\">    <tr>
      <td style=\"width:42%;padding:3px 6px;vertical-align:top;\">Nama Pelapor</td>
      <td style=\"width:3%;padding:3px 0;vertical-align:top;\">:</td>
      <td style=\"padding:3px 6px;vertical-align:top;\"><span id=\"field_nama_pelapor\">[NAMA_PELAPOR]</span></td>
    </tr>    <tr>
      <td style=\"width:42%;padding:3px 6px;vertical-align:top;\">Hubungan</td>
      <td style=\"width:3%;padding:3px 0;vertical-align:top;\">:</td>
      <td style=\"padding:3px 6px;vertical-align:top;\"><span id=\"field_hubungan\">[HUBUNGAN_DENGAN_ALMARHUM]</span></td>
    </tr>    <tr>
      <td style=\"width:42%;padding:3px 6px;vertical-align:top;\">Alamat</td>
      <td style=\"width:3%;padding:3px 0;vertical-align:top;\">:</td>
      <td style=\"padding:3px 6px;vertical-align:top;\"><span id=\"field_alamat_pelapor\">[ALAMAT_PELAPOR]</span></td>
    </tr></table><p style=\"margin:8px 0;\">Menyatakan bahwa data kematian di bawah ini adalah benar:</p><table style=\"width:100%;border-collapse:collapse;margin:10px 0 20px 10px;\">    <tr>
      <td style=\"width:42%;padding:3px 6px;vertical-align:top;\">Nama Almarhum/ah</td>
      <td style=\"width:3%;padding:3px 0;vertical-align:top;\">:</td>
      <td style=\"padding:3px 6px;vertical-align:top;\"><span id=\"field_nama_almarhum\">[NAMA_ALMARHUM]</span></td>
    </tr>    <tr>
      <td style=\"width:42%;padding:3px 6px;vertical-align:top;\">Tempat, Tanggal Lahir</td>
      <td style=\"width:3%;padding:3px 0;vertical-align:top;\">:</td>
      <td style=\"padding:3px 6px;vertical-align:top;\"><span id=\"field_ttl_alm\">[TEMPAT_LAHIR_ALM], [TGL_LAHIR_ALM]</span></td>
    </tr>    <tr>
      <td style=\"width:42%;padding:3px 6px;vertical-align:top;\">Tanggal Meninggal</td>
      <td style=\"width:3%;padding:3px 0;vertical-align:top;\">:</td>
      <td style=\"padding:3px 6px;vertical-align:top;\"><span id=\"field_tgl_meninggal\">[TANGGAL_MENINGGAL]</span></td>
    </tr>    <tr>
      <td style=\"width:42%;padding:3px 6px;vertical-align:top;\">Tempat Meninggal</td>
      <td style=\"width:3%;padding:3px 0;vertical-align:top;\">:</td>
      <td style=\"padding:3px 6px;vertical-align:top;\"><span id=\"field_tempat_meninggal\">[TEMPAT_MENINGGAL]</span></td>
    </tr>    <tr>
      <td style=\"width:42%;padding:3px 6px;vertical-align:top;\">Penyebab Kematian</td>
      <td style=\"width:3%;padding:3px 0;vertical-align:top;\">:</td>
      <td style=\"padding:3px 6px;vertical-align:top;\"><span id=\"field_penyebab\">[PENYEBAB_KEMATIAN]</span></td>
    </tr>    <tr>
      <td style=\"width:42%;padding:3px 6px;vertical-align:top;\">Alamat Terakhir</td>
      <td style=\"width:3%;padding:3px 0;vertical-align:top;\">:</td>
      <td style=\"padding:3px 6px;vertical-align:top;\"><span id=\"field_alamat_alm\">[ALAMAT_TERAKHIR_ALMARHUM]</span></td>
    </tr></table><p style=\"text-align:justify;\">Demikian surat pernyataan tanggung jawab mutlak ini saya buat dengan sebenarnya. Apabila di kemudian hari pernyataan ini tidak benar, saya bersedia mempertanggungjawabkan secara hukum.</p>
  <p style=\"margin:24px 0 4px;\">Demikian surat pernyataan ini saya buat dengan sesungguhnya dan dalam keadaan sadar tanpa ada paksaan dari siapapun, untuk dapat digunakan sebagaimana mestinya.</p>

  <div style=\"margin-top:32px;display:flex;justify-content:space-between;\">
    <div style=\"width:45%;text-align:center;\">
      <p style=\"margin:0 0 60px;\">Mengetahui,<br><strong>Ketua RT 06 / RW 11</strong></p>
      <div id=\"signature_area\" style=\"border-top:1px solid #000;padding-top:4px;\">
        <p style=\"margin:0;font-size:11pt;\">(..................................)</p>
      </div>
    </div>
    <div style=\"width:45%;text-align:center;\">
      <p style=\"margin:0;\">Balikpapan, <span id=\"field_tanggal_ttd\">................</span></p>
      <p style=\"margin:0 0 60px;\">Yang Membuat Pernyataan,</p>
      <div style=\"border-top:1px solid #000;padding-top:4px;\">
        <p style=\"margin:0;font-size:11pt;\">(<span id=\"field_nama_ttd\">..................................</span>)</p>
      </div>
    </div>
  </div>

</div>',
            ],
            [
                'jenis_surat' => 'jenis_11',
                'nama_surat'  => 'Surat Pernyataan Penjaga Gerbang Makam',
                'content'     => '<div style=\"font-family:\'Times New Roman\',Times,serif;font-size:12pt;line-height:1.8;color:#000;width:210mm;min-height:297mm;padding:2cm 2.5cm;margin:0 auto;background:#fff;box-sizing:border-box;\">

  <div style=\"text-align:center;border-bottom:3px double #000;padding-bottom:10px;margin-bottom:6px;\">
    <p style=\"margin:0;font-size:14pt;font-weight:bold;letter-spacing:1px;\">RUKUN TETANGGA 06 / RUKUN WARGA 11</p>
    <p style=\"margin:2px 0;font-size:11pt;\">Kelurahan Sepinggan Raya, Kecamatan Balikpapan Selatan</p>
    <p style=\"margin:2px 0;font-size:10pt;\">Kota Balikpapan, Kalimantan Timur</p>
  </div>

  <div style=\"text-align:center;margin:18px 0 20px;\">
    <p style=\"margin:0;font-size:14pt;font-weight:bold;text-decoration:underline;text-transform:uppercase;letter-spacing:0.5px;\">Surat Pernyataan Penjaga Gerbang Makam</p>
    <p style=\"margin:4px 0 0;font-size:10pt;\">Nomor: <span id=\"field_nomor_surat\">..........</span> /RT.06/RW.11/<span id=\"field_bulan\">.........</span>/<span id=\"field_tahun\">2026</span></p>
  </div><p style=\"margin:0 0 8px;\">Yang bertanda tangan di bawah ini:</p><table style=\"width:100%;border-collapse:collapse;margin:10px 0 20px 10px;\">    <tr>
      <td style=\"width:42%;padding:3px 6px;vertical-align:top;\">Nama Lengkap</td>
      <td style=\"width:3%;padding:3px 0;vertical-align:top;\">:</td>
      <td style=\"padding:3px 6px;vertical-align:top;\"><span id=\"field_nama_lengkap\">[NAMA_LENGKAP]</span></td>
    </tr>    <tr>
      <td style=\"width:42%;padding:3px 6px;vertical-align:top;\">Tempat, Tanggal Lahir</td>
      <td style=\"width:3%;padding:3px 0;vertical-align:top;\">:</td>
      <td style=\"padding:3px 6px;vertical-align:top;\"><span id=\"field_ttl\">[TEMPAT_LAHIR], [TANGGAL_LAHIR]</span></td>
    </tr>    <tr>
      <td style=\"width:42%;padding:3px 6px;vertical-align:top;\">Jenis Kelamin</td>
      <td style=\"width:3%;padding:3px 0;vertical-align:top;\">:</td>
      <td style=\"padding:3px 6px;vertical-align:top;\"><span id=\"field_jenis_kelamin\">[JENIS_KELAMIN]</span></td>
    </tr>    <tr>
      <td style=\"width:42%;padding:3px 6px;vertical-align:top;\">Agama</td>
      <td style=\"width:3%;padding:3px 0;vertical-align:top;\">:</td>
      <td style=\"padding:3px 6px;vertical-align:top;\"><span id=\"field_agama\">[AGAMA]</span></td>
    </tr>    <tr>
      <td style=\"width:42%;padding:3px 6px;vertical-align:top;\">Pekerjaan</td>
      <td style=\"width:3%;padding:3px 0;vertical-align:top;\">:</td>
      <td style=\"padding:3px 6px;vertical-align:top;\"><span id=\"field_pekerjaan\">[PEKERJAAN]</span></td>
    </tr>    <tr>
      <td style=\"width:42%;padding:3px 6px;vertical-align:top;\">Alamat</td>
      <td style=\"width:3%;padding:3px 0;vertical-align:top;\">:</td>
      <td style=\"padding:3px 6px;vertical-align:top;\"><span id=\"field_alamat\">[ALAMAT_LENGKAP]</span></td>
    </tr></table><p style=\"text-align:justify;\">Dengan ini menyatakan bahwa saya bersedia dan bertanggung jawab sebagai <strong>Penjaga Gerbang Makam</strong> di <span id=\"field_nama_makam\">[NAMA_LOKASI_MAKAM]</span>, yang bertugas menjaga, merawat, dan memastikan ketertiban lingkungan makam tersebut.</p>
     <p style=\"text-align:justify;margin-top:8px;\">Surat pernyataan ini dibuat untuk keperluan: <span id=\"field_keperluan\">[KEPERLUAN_SURAT]</span>.</p>
  <p style=\"margin:24px 0 4px;\">Demikian surat pernyataan ini saya buat dengan sesungguhnya dan dalam keadaan sadar tanpa ada paksaan dari siapapun, untuk dapat digunakan sebagaimana mestinya.</p>

  <div style=\"margin-top:32px;display:flex;justify-content:space-between;\">
    <div style=\"width:45%;text-align:center;\">
      <p style=\"margin:0 0 60px;\">Mengetahui,<br><strong>Ketua RT 06 / RW 11</strong></p>
      <div id=\"signature_area\" style=\"border-top:1px solid #000;padding-top:4px;\">
        <p style=\"margin:0;font-size:11pt;\">(..................................)</p>
      </div>
    </div>
    <div style=\"width:45%;text-align:center;\">
      <p style=\"margin:0;\">Balikpapan, <span id=\"field_tanggal_ttd\">................</span></p>
      <p style=\"margin:0 0 60px;\">Yang Membuat Pernyataan,</p>
      <div style=\"border-top:1px solid #000;padding-top:4px;\">
        <p style=\"margin:0;font-size:11pt;\">(<span id=\"field_nama_ttd\">..................................</span>)</p>
      </div>
    </div>
  </div>

</div>',
            ],
            [
                'jenis_surat' => 'jenis_12',
                'nama_surat'  => 'Surat Pernyataan Umum (untuk perihal keterangan lain yang belum tersebut di atas)',
                'content'     => '<div style=\"font-family:\'Times New Roman\',Times,serif;font-size:12pt;line-height:1.8;color:#000;width:210mm;min-height:297mm;padding:2cm 2.5cm;margin:0 auto;background:#fff;box-sizing:border-box;\">

  <div style=\"text-align:center;border-bottom:3px double #000;padding-bottom:10px;margin-bottom:6px;\">
    <p style=\"margin:0;font-size:14pt;font-weight:bold;letter-spacing:1px;\">RUKUN TETANGGA 06 / RUKUN WARGA 11</p>
    <p style=\"margin:2px 0;font-size:11pt;\">Kelurahan Sepinggan Raya, Kecamatan Balikpapan Selatan</p>
    <p style=\"margin:2px 0;font-size:10pt;\">Kota Balikpapan, Kalimantan Timur</p>
  </div>

  <div style=\"text-align:center;margin:18px 0 20px;\">
    <p style=\"margin:0;font-size:14pt;font-weight:bold;text-decoration:underline;text-transform:uppercase;letter-spacing:0.5px;\">Surat Pernyataan</p>
    <p style=\"margin:4px 0 0;font-size:10pt;\">Nomor: <span id=\"field_nomor_surat\">..........</span> /RT.06/RW.11/<span id=\"field_bulan\">.........</span>/<span id=\"field_tahun\">2026</span></p>
  </div><p style=\"margin:0 0 8px;\">Yang bertanda tangan di bawah ini:</p><table style=\"width:100%;border-collapse:collapse;margin:10px 0 20px 10px;\">    <tr>
      <td style=\"width:42%;padding:3px 6px;vertical-align:top;\">Nama Lengkap</td>
      <td style=\"width:3%;padding:3px 0;vertical-align:top;\">:</td>
      <td style=\"padding:3px 6px;vertical-align:top;\"><span id=\"field_nama_lengkap\">[NAMA_LENGKAP]</span></td>
    </tr>    <tr>
      <td style=\"width:42%;padding:3px 6px;vertical-align:top;\">Tempat, Tanggal Lahir</td>
      <td style=\"width:3%;padding:3px 0;vertical-align:top;\">:</td>
      <td style=\"padding:3px 6px;vertical-align:top;\"><span id=\"field_ttl\">[TEMPAT_LAHIR], [TANGGAL_LAHIR]</span></td>
    </tr>    <tr>
      <td style=\"width:42%;padding:3px 6px;vertical-align:top;\">Jenis Kelamin</td>
      <td style=\"width:3%;padding:3px 0;vertical-align:top;\">:</td>
      <td style=\"padding:3px 6px;vertical-align:top;\"><span id=\"field_jenis_kelamin\">[JENIS_KELAMIN]</span></td>
    </tr>    <tr>
      <td style=\"width:42%;padding:3px 6px;vertical-align:top;\">Agama</td>
      <td style=\"width:3%;padding:3px 0;vertical-align:top;\">:</td>
      <td style=\"padding:3px 6px;vertical-align:top;\"><span id=\"field_agama\">[AGAMA]</span></td>
    </tr>    <tr>
      <td style=\"width:42%;padding:3px 6px;vertical-align:top;\">Pekerjaan</td>
      <td style=\"width:3%;padding:3px 0;vertical-align:top;\">:</td>
      <td style=\"padding:3px 6px;vertical-align:top;\"><span id=\"field_pekerjaan\">[PEKERJAAN]</span></td>
    </tr>    <tr>
      <td style=\"width:42%;padding:3px 6px;vertical-align:top;\">Alamat</td>
      <td style=\"width:3%;padding:3px 0;vertical-align:top;\">:</td>
      <td style=\"padding:3px 6px;vertical-align:top;\"><span id=\"field_alamat\">[ALAMAT_LENGKAP]</span></td>
    </tr></table><p style=\"text-align:justify;\">Dengan ini menyatakan dengan sesungguhnya bahwa:</p>
     <p style=\"margin:10px 0 10px 20px;text-align:justify;font-style:italic;border-left:3px solid #ccc;padding-left:12px;\"><span id=\"field_perihal\">[PERIHAL_ISI_PERNYATAAN]</span></p>
     <p style=\"text-align:justify;\">Surat pernyataan ini dibuat untuk keperluan: <span id=\"field_keperluan\">[KEPERLUAN_SURAT]</span>.</p>
  <p style=\"margin:24px 0 4px;\">Demikian surat pernyataan ini saya buat dengan sesungguhnya dan dalam keadaan sadar tanpa ada paksaan dari siapapun, untuk dapat digunakan sebagaimana mestinya.</p>

  <div style=\"margin-top:32px;display:flex;justify-content:space-between;\">
    <div style=\"width:45%;text-align:center;\">
      <p style=\"margin:0 0 60px;\">Mengetahui,<br><strong>Ketua RT 06 / RW 11</strong></p>
      <div id=\"signature_area\" style=\"border-top:1px solid #000;padding-top:4px;\">
        <p style=\"margin:0;font-size:11pt;\">(..................................)</p>
      </div>
    </div>
    <div style=\"width:45%;text-align:center;\">
      <p style=\"margin:0;\">Balikpapan, <span id=\"field_tanggal_ttd\">................</span></p>
      <p style=\"margin:0 0 60px;\">Yang Membuat Pernyataan,</p>
      <div style=\"border-top:1px solid #000;padding-top:4px;\">
        <p style=\"margin:0;font-size:11pt;\">(<span id=\"field_nama_ttd\">..................................</span>)</p>
      </div>
    </div>
  </div>

</div>',
            ],
            [
                'jenis_surat' => 'surat',
                'nama_surat'  => 'Surat Pernyataan Belum Pernah Dibuatkan Akta Kematian',
                'content'     => '<div style=\"font-family:\'Times New Roman\',Times,serif;font-size:12pt;line-height:1.5;color:#000;width:100%;padding:1cm 2cm;box-sizing:border-box;\">

  <div style=\"text-align:center;margin-bottom:30px;\">
    <p style=\"margin:0;font-size:14pt;font-weight:bold;text-decoration:underline;\">SURAT PERNYATAAN</p>
  </div>

  <p style=\"margin:0 0 10px;\">Yang bertanda tangan di bawah ini:</p>

  <table style=\"width:100%;border-collapse:collapse;margin:0 0 20px 20px;\">
    <tr>
      <td style=\"width:35%;padding:4px 0;vertical-align:top;\">Nama</td>
      <td style=\"width:3%;padding:4px 0;vertical-align:top;\">:</td>
      <td style=\"padding:4px 0;vertical-align:top;\">[NAMA_LENGKAP]</td>
    </tr>
    <tr>
      <td style=\"padding:4px 0;vertical-align:top;\">NIK</td>
      <td style=\"padding:4px 0;vertical-align:top;\">:</td>
      <td style=\"padding:4px 0;vertical-align:top;\">[NIK_PELAPOR]</td>
    </tr>
    <tr>
      <td style=\"padding:4px 0;vertical-align:top;\">Tempat & tanggal lahir</td>
      <td style=\"padding:4px 0;vertical-align:top;\">:</td>
      <td style=\"padding:4px 0;vertical-align:top;\">[TEMPAT_TANGGAL_LAHIR_PELAPOR]</td>
    </tr>
    <tr>
      <td style=\"padding:4px 0;vertical-align:top;\">Alamat</td>
      <td style=\"padding:4px 0;vertical-align:top;\">:</td>
      <td style=\"padding:4px 0;vertical-align:top;\">[ALAMAT_LENGKAP]</td>
    </tr>
  </table>

  <p style=\"margin:0 0 10px;\">Dengan ini menyatakan bahwa sebenar-benarnya, bahwa :</p>

  <table style=\"width:100%;border-collapse:collapse;margin:0 0 20px 20px;\">
    <tr>
      <td style=\"width:35%;padding:4px 0;vertical-align:top;\">Nama</td>
      <td style=\"width:3%;padding:4px 0;vertical-align:top;\">:</td>
      <td style=\"padding:4px 0;vertical-align:top;\">[NAMA_ALMARHUM]</td>
    </tr>
    <tr>
      <td style=\"padding:4px 0;vertical-align:top;\">Tempat/tanggal lahir</td>
      <td style=\"padding:4px 0;vertical-align:top;\">:</td>
      <td style=\"padding:4px 0;vertical-align:top;\">[TEMPAT_TANGGAL_LAHIR_ALMARHUM]</td>
    </tr>
    <tr>
      <td style=\"padding:4px 0;vertical-align:top;\">Tempat/tanggal meninggal</td>
      <td style=\"padding:4px 0;vertical-align:top;\">:</td>
      <td style=\"padding:4px 0;vertical-align:top;\">[TEMPAT_TANGGAL_MENINGGAL]</td>
    </tr>
    <tr>
      <td style=\"padding:4px 0;vertical-align:top;\">Jam Meninggal</td>
      <td style=\"padding:4px 0;vertical-align:top;\">:</td>
      <td style=\"padding:4px 0;vertical-align:top;\">[JAM_MENINGGAL]</td>
    </tr>
  </table>

  <p style=\"text-align:justify;margin-bottom:12px;\">
    Adalah benar hingga saat ini belum pernah dibuatkan Akte Kematian baik di Catatan Sipil kota Balikpapan ataupun di Catatan Sipil di kota manapun.
  </p>

  <p style=\"text-align:justify;margin-bottom:12px;\">
    Demikian surat pernyataan ini saya buat dengan sebenar-benarnya tanpa ada paksaan dari pihak manapun. Bila dikemudian hari pernyataan saya ini tidak benar maka saya siap dituntut sesuai dengan peraturan hukum yang berlaku dan tidak melibatkan pegawai pemerintah Kota Balikpapan.
  </p>

  <div style=\"display:flex;justify-content:flex-end;margin-top:40px;\">
    <div style=\"width:45%;text-align:center;\">
      <p style=\"margin:0 0 4px;\">Balikpapan, <span id=\"field_tanggal_ttd\">........................</span></p>
      <p style=\"margin:0 0 60px;\">Yang Membuat Pernyataan,</p>
      <div style=\"position:relative;margin-bottom:5px;\">
        <span style=\"position:absolute;left:20px;bottom:10px;font-size:10px;border:1px solid #000;padding:4px;\">Materai 10000</span>
      </div>
      <p style=\"margin:0;\">( [NAMA_LENGKAP] )</p>
    </div>
  </div>

</div>',
            ],
        ];

        foreach ($templates as $tmpl) {
            SuratTemplate::updateOrCreate(
                ['jenis_surat' => $tmpl['jenis_surat']],
                $tmpl
            );
        }
    }
}
