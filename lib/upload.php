<?php
session_start();
error_log("Dir: " . __DIR__.", ".__LINE__);
// Funktionen für rechteabhängige Funktionen START
require_once("../intern/inc/config.inc.php");
require_once("../intern/inc/functions.inc.php");
require_once("../intern/inc/permissioncheck.inc.php");
// Funktionen für rechteabhängige Funktionen ENDE

//TLOG(DEBUG, "checkUserSilent(): " . check_user_silent(), __LINE__);
// Stelle sicher, dass nur authentifizierte Vorstandsmitglieder Dateien hochladen können
$response = ['status' => 'error', 'message' => 'Beim Hochladen der Datei ist ein Fehler aufgetreten(3).'];

if (check_user_silent() && isset($_SESSION['permissions']) && checkPermissions(VORSTAND)) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
            // Verwenden Sie __DIR__ um den relativen Pfad vom aktuellen Verzeichnis aus zu setzen
            $uploadDir = __DIR__ . '/../images/presse/';
            TLOG(DEBUG, ";uploadDir: $uploadDir", __LINE__);
            // Überprüfen Sie, ob das Upload-Verzeichnis existiert, und erstellen Sie es, falls nicht
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            // Überprüfen Sie, ob das Verzeichnis beschreibbar ist
            if (is_writable($uploadDir)) {
                $uploadFile = $uploadDir . basename($_FILES['file']['name']);

                // Verschieben Sie die hochgeladene Datei in das Zielverzeichnis
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
