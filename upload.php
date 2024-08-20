<?php
session_start();

// Funktionen für rechteabhängige Funktionen START
require_once("intern/inc/config.inc.php");
require_once("intern/inc/functions.inc.php");
require_once("intern/inc/permissioncheck.inc.php");
// Funktionen für rechteabhängige Funktionen ENDE

// Stelle sicher, dass nur authentifizierte Vorstandsmitglieder Dateien hochladen können
$user = check_user();

$response = ['status' => 'error', 'message' => 'Beim Hochladen der Datei ist ein Fehler aufgetreten.'];

if (isset($_SESSION['permissions']) && checkPermissions(VORSTAND)) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = 'images/presse/';
            
            // Check if the upload directory exists, if not, create it
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }
            
            // Check if the directory is writable
            if (is_writable($uploadDir)) {
                $uploadFile = $uploadDir . basename($_FILES['file']['name']);

                if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadFile)) {
                    $response['status'] = 'success';
                    $response['message'] = 'Datei erfolgreich hochgeladen!';
                } else {
                    $response['message'] = 'Fehler beim Verschieben der hochgeladenen Datei.';
                }
            } else {
                $response['message'] = 'Upload-Verzeichnis ist nicht beschreibbar.';
            }
        } else {
            $response['message'] = 'Keine Datei hochgeladen oder Fehler beim Hochladen.';
        }
    }
} else {
    $response['message'] = 'Keine Berechtigung zum Hochladen.';
}

header('Content-Type: application/json');
echo json_encode($response);
