<?php
session_start();
require_once(__DIR__ . '/../intern/inc/config.inc.php');
require_once(__DIR__ . '/../intern/inc/functions.inc.php');
require_once(__DIR__ . '/../intern/inc/permissioncheck.inc.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['permissions']) && checkPermissions(VORSTAND)) {
    $imagePath = $_POST['imagePath'];

    TLOG(DEBUG, "imagePath: $imagePath, exists: " . file_exists($imagePath), __LINE__);

    if (file_exists(__DIR__ . "/../$imagePath")) {
        unlink(__DIR__ . "/../$imagePath");
        // Setzen Sie die Erfolgsmeldung in die Session
        $_SESSION['message'] = 'Der Presseartikel wurde erfolgreich gelöscht!';
        $_SESSION['message_type'] = 'success'; // Optional, um verschiedene Meldungstypen zu unterscheiden
    } else {
        // Setzen Sie die Fehlermeldung in die Session
        $_SESSION['message'] = 'Fehler: Der Presseartikel konnte nicht gelöscht werden.';
        $_SESSION['message_type'] = 'error';
    }

    // Leiten Sie zurück zur Startseite
    header('Location: ../index.php');
    exit;
} else {
    // Ungültiger Zugriff
    header('Location: ../index.php');
    exit;
}
