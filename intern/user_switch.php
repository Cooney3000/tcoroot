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

// Definieren der festen Benutzer-ID-Liste
$userlist = [211, 356, 259, 212, 224, 495, 254, 457];
TECHO(DEBUG, "Userlist: " . implode(", ", $userlist));

$placeholders = implode(',', array_fill(0, count($userlist), '?'));
TECHO(DEBUG, "SQL Platzhalter: " . $placeholders);

// Abrufen der Benutzer, die in der Liste enthalten sind
$statement = $pdo->prepare("SELECT id, vorname, nachname FROM users WHERE id IN ($placeholders) ORDER BY nachname");
$execute_result = $statement->execute($userlist);

// Überprüfung, ob die Abfrage erfolgreich war
if (!$execute_result) {
    TECHO(DEBUG, "Fehler beim Abrufen der Benutzer: " . print_r($statement->errorInfo(), true));
    exit;
}

$users = $statement->fetchAll(PDO::FETCH_ASSOC);

if (empty($users)) {
    TECHO(DEBUG, "Keine Benutzer in der Datenbank gefunden.");
} else {
    TECHO(DEBUG, "Gefundene Benutzer: " . print_r($users, true));
}

// Wechseln zu einem anderen Benutzer, wenn der Link geklickt wurde
if (isset($_GET['switch_to_id'])) {
    $new_user_id = (int)$_GET['switch_to_id'];
    TECHO(DEBUG, "Angeforderter Benutzerwechsel zu ID: " . $new_user_id);

    if (!in_array($new_user_id, $userlist)) {
        TECHO(DEBUG, "Benutzer-ID nicht in der zugelassenen Liste.");
        exit;
    }

    // Benutzer prüfen, ob der neue Benutzer existiert
    $statement = $pdo->prepare("SELECT * FROM users WHERE id = :id");
    $statement->bindParam(':id', $new_user_id, PDO::PARAM_INT);
    $statement->execute();
    $new_user = $statement->fetch(PDO::FETCH_ASSOC);

    if ($new_user) {
        TECHO(DEBUG, "Benutzer gefunden: " . print_r($new_user, true));

        // Benutzerdaten in die aktuelle Session setzen
        $_SESSION['userid'] = $new_user['id'];
        $_SESSION['user_data'] = $new_user; // Optional: Wenn mehr Benutzerdaten in der Session benötigt werden

        // Überprüfen, ob die Session korrekt aktualisiert wurde
        TECHO(DEBUG, "Session nach Benutzerwechsel: " . print_r($_SESSION, true));

        // Erneutes Aufrufen der check_user()-Funktion, um Berechtigungen und Session-Status zu aktualisieren
        $user = check_user();

        TECHO(DEBUG, "Benutzer erfolgreich gewechselt. Weiterleitung zu internal.php");

        // Zur internen Startseite weiterleiten
        header("Location: internal.php");
        exit;
    } else {
        TECHO(DEBUG, "Benutzer mit der ID $new_user_id konnte nicht gefunden werden.");
    }
}
?>

<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Benutzerwechsel für Testzwecke</title>
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
    <h1>Benutzerwechsel für Testzwecke</h1>
    <ul>
        <?php foreach ($users as $user): ?>
            <li>
                <a href="?switch_to_id=<?= htmlspecialchars($user['id']) ?>">
                    <?= htmlspecialchars($user['vorname']) . ' ' . htmlspecialchars($user['nachname']) ?> (ID: <?= $user['id'] ?>)
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
</body>

</html>