<?php
try {
    $db = new PDO('mysql:host=127.0.0.1;dbname=simart', 'root', '');
    $stmt = $db->query('SELECT id, nama_surat, content FROM surat_templates');
    $templates = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($templates as $t) {
        echo "ID: {$t['id']} | NAMA: {$t['nama_surat']}\n";
        preg_match_all('/\[([A-Z0-9_]+)\]/', $t['content'], $matches);
        echo "Placeholders: " . implode(', ', array_unique($matches[1])) . "\n\n";
    }
} catch (Exception $e) { echo $e->getMessage(); }
