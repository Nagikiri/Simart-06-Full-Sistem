<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$templates = App\Models\SuratTemplate::all();
$output = "";
foreach ($templates as $t) {
    $output .= "=== TEMPLATE ID: {$t->id} ===\n";
    $output .= "NAME: {$t->nama_surat}\n";
    $output .= "CONTENT:\n{$t->content}\n\n";
}
file_put_contents('all_templates_dump.txt', $output);
echo "Dumped to all_templates_dump.txt\n";
