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
$textNodes = $xpath->query("//text()[contains(., 'Ketua RT') or contains(., 'Ketua Rukun Tetangga')]");

$injected = false;
foreach ($textNodes as $textNode) {
    // Cari TD ancestor
    $td = $textNode;
    while ($td !== null && $td->nodeName !== 'td') {
        $td = $td->parentNode;
    }
    
    if ($td !== null) {
        $tr1 = $td->parentNode;
        $tr2 = $tr1->nextSibling;
        while ($tr2 !== null && $tr2->nodeName !== 'tr') {
            $tr2 = $tr2->nextSibling;
        }
        
        if ($tr2 !== null) {
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
                // Modifikasi style padding-top
                $style = $targetTd->getAttribute('style');
                // Hapus padding-top besar
                $style = preg_replace('/padding-top:\s*\d+px;?/', 'padding-top: 5px;', $style);
                $targetTd->setAttribute('style', $style);
                
                $frag = $dom->createDocumentFragment();
                $frag->appendXML('<div><img src="IMG" height="100" style="margin-bottom: 5px;" /></div>');
                
                $targetTd->insertBefore($frag, $targetTd->firstChild);
                $injected = true;
                break;
            }
        }
    }
}

echo $injected ? "INJECTED:\n" : "FAILED\n";
echo $dom->saveHTML();
