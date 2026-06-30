<?php

$html = '<table style="width: 100%; border-collapse: collapse; margin-top: 24px; text-align: center;">
    <tbody><tr>
        <td style="width: 50%; vertical-align: top;">
            <p style="margin: 0;">Mengetahui</p>
            <p style="margin: 0;">Ketua RT <span class="filled">fsdfsdf</span></p>
        </td>
        <td style="width: 50%; vertical-align: top;">
            <p style="margin: 0;">Balikpapan, <span class="filled">fsdfs</span></p>
            <p style="margin: 0;">Yang membuat pernyataan</p>
            <p style="margin: 0;">(Penjamin)</p>
        </td>
    </tr>
    <tr>
        <td style="padding-top: 70px;">(<span class="filled">fsdfsf</span>)</td>
        <td style="padding-top: 70px;">(<span class="filled">Junnior Pollaris</span>)</td>
    </tr>
</tbody></table>';

$dom = new \DOMDocument();
@$dom->loadHTML(mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8'), LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);

$xpath = new \DOMXPath($dom);
// Cari node teks yang mengandung Ketua RT
$textNodes = $xpath->query("//text()[contains(., 'Ketua RT') or contains(., 'Ketua Rukun Tetangga')]");

$injected = false;
foreach ($textNodes as $textNode) {
    // Kita temukan text node "Ketua RT "
    $parent = $textNode->parentNode;
    
    // Cari TD terdekat yang membungkus ini
    $td = $parent;
    while ($td !== null && $td->nodeName !== 'td' && $td->nodeName !== 'div') {
        $td = $td->parentNode;
    }
    
    if ($td !== null) {
        // Hapus padding/margin kosong besar jika ada di TD ini atau di baris bawahnya
        $htmlStr = $dom->saveHTML($td);
        
        $frag = $dom->createDocumentFragment();
        // Gunakan height besar 120px dan margin-bottom negatif agar numpak di atas nama
        $frag->appendXML('<div style="text-align: center; margin-top: 5px; margin-bottom: -80px; position: relative; z-index: 10;"><img src="IMG" height="120" /></div>');
        
        $parent->appendChild($frag);
        $injected = true;
        break;
    }
}

echo $injected ? "INJECTED:\n" : "FAILED\n";
echo $dom->saveHTML();
