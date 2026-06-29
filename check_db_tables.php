<?php
try {
    $db = new PDO('mysql:host=127.0.0.1;dbname=simart', 'root', '');
    $stmt = $db->query('SELECT content FROM surat_templates LIMIT 1');
    echo $stmt->fetchColumn();
} catch (Exception $e) {}
