<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$templates = App\Models\SuratTemplate::whereIn('nama_surat', [
    'Surat Pernyataan Janda/Duda', 
    'Surat Pernyataan Orang yang Sama', 
    'Surat Pernyataan Tanggung Jawab Mutlak (SPTJM) Kebenaran Data Kematian', 
    'Surat Pernyataan Umum'
])->get();

foreach($templates as $t) {
    echo "--- " . $t->nama_surat . " ---\n";
    echo substr($t->content, -500) . "\n\n";
}
