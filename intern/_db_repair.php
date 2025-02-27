<?php
session_start();
require_once("inc/config.inc.php");
require_once("inc/functions.inc.php");
require_once("inc/permissioncheck.inc.php");

// Überprüfen, ob der aktuelle Benutzer angemeldet ist, ohne eine Umleitung oder Fehler auszulösen
$current_user = check_user_silent();

if (!$current_user) {
    TECHO(DEBUG, "Du bist nicht angemeldet.");
    exit;
}

// Funktion zur Bereinigung von Zeichenketten
function clean_string($input) {
    // Entfernt unsichtbare oder ungültige Zeichen
    $cleaned = preg_replace('/[^\P{C}\n]+/u', '', $input); // Entfernt Steuerzeichen
    return trim($cleaned); // Entfernt überflüssige Leerzeichen
}

// Hole alle Benutzerdaten aus der Tabelle
$sql = "SELECT id, email, vorname, nachname, festnetz, mobil, ueber_mich FROM users";
$result = $pdo->query($sql);

if ($result->rowCount() > 0) {
    foreach ($result as $row) {
        // Bereinige jede Zeichenkette
        $email = clean_string($row['email']);
        $vorname = clean_string($row['vorname']);
        $nachname = clean_string($row['nachname']);
        $festnetz = clean_string($row['festnetz']);
        $mobil = clean_string($row['mobil']);
        $ueber_mich = clean_string($row['ueber_mich']);

        // Nur aktualisieren, wenn Änderungen vorgenommen wurden
        if ($email !== $row['email'] || $vorname !== $row['vorname'] || $nachname !== $row['nachname'] || 
            $festnetz !== $row['festnetz'] || $mobil !== $row['mobil'] || $ueber_mich !== $row['ueber_mich']) {
            
            // Update-Abfrage für den aktuellen Benutzer
            $update_sql = "UPDATE users SET 
                email = :email, 
                vorname = :vorname, 
                nachname = :nachname, 
                festnetz = :festnetz, 
                mobil = :mobil, 
                ueber_mich = :ueber_mich 
                WHERE id = :id";
            
            $stmt = $pdo->prepare($update_sql);
            $stmt->execute([
                ':email' => $email,
                ':vorname' => $vorname,
                ':nachname' => $nachname,
                ':festnetz' => $festnetz,
                ':mobil' => $mobil,
                ':ueber_mich' => $ueber_mich,
                ':id' => $row['id']
            ]);
            
            TECHO(INFO, "Benutzer mit ID " . $row['id'] . " wurde aktualisiert.");
        }
    }
} else {
    TECHO(INFO, "Keine Benutzer gefunden.");
}

TECHO(INFO, "Bereinigung abgeschlossen.");
