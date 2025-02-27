<?php
// Datei: get_images.php
$directory = dirname(__FILE__) . '/../images/impressionen/';
$images = glob($directory . '*.{jpg,jpeg,png,gif}', GLOB_BRACE);

// Debugging-Ausgabe: Zeige das Verzeichnis und die gefundenen Dateien
header('Content-Type: application/json');
if (empty($images)) {
    echo json_encode(["error" => "Keine Bilder gefunden im Verzeichnis: " . realpath($directory)]);
} else {
    natsort($images);
    $images = array_values($images);
    echo json_encode(array_map('basename', $images));
}