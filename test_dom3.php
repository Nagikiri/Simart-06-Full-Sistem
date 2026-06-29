<?php
require __DIR__.'/vendor/autoload.php';
use Dompdf\Dompdf;
use Dompdf\Options;

$html = '<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: Arial, Helvetica, sans-serif; font-size: 12pt; }
        .page { border: 1px solid black; padding: 20px; height: 900px; }
    </style>
</head>
<body>
<div class="page">
    <p>This is some content before the table.</p>
    <p>We are simulating the page height to see if it pushes to page 2.</p>
    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
    
    <table style="width: 100%; border-collapse: collapse; margin-top: 24px; text-align: center;">
        <tr>
            <td style="width: 50%; vertical-align: top;">
                <p style="margin: 0;">Mengetahui,</p>
                <p style="margin: 0;">Ketua RT … Kelurahan Damai Bahagia</p>
            </td>
            <td style="width: 50%; vertical-align: top;">
                <p style="margin: 0;">Balikpapan,</p>
                <p style="margin: 0; font-weight: bold;">Yang Membuat Pernyataan</p>
                <p style="margin: 22px 0 0; font-size: 10pt; font-style: italic;">Materai 10000</p>
            </td>
        </tr>
        <tr>
            <td style="padding-top: 55px;">
                <div style="margin-top: -30px; margin-bottom: -50px;">
                    <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAADUlEQVR42mP8z8BQDwAEhQGAhKmMIQAAAABJRU5ErkJggg==" height="140" style="background: red;" />
                </div>
                (&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;)
            </td>
            <td style="padding-top: 55px;">(&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;)</td>
        </tr>
    </table>
    
    <p>This is Saksi-Saksi. It should NOT be pushed down too much!</p>
</div>
</body>
</html>';

$options = new Options();
$options->set('isHtml5ParserEnabled', true);
$options->set('isRemoteEnabled', true);
$dompdf = new Dompdf($options);
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();

file_put_contents('test_output.pdf', $dompdf->output());
echo "PDF generated.\n";
