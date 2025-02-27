<?php
session_start();
require_once("inc/config.inc.php");
require_once("inc/functions.inc.php");
require_once("inc/permissioncheck.inc.php");

$user = check_user();

$title = "Intern Profil";
include(dirname(__FILE__) . "/inc/header.inc.php");

?>
<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suche Tennis-Partner</title>
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
<div class="container main-container">

  <div class="container mt-4">
    <h1>Suche Tennis-Partner</h1>
    <p>Diese Spieler haben in ihrem <a href="settings.php">Profil</a> angegeben, dass sie einen Partner zum Spielen suchen:</p>
    <div class="userprofile-card-container">
        <?php
        // Alle Benutzer abrufen, die einen Tennis-Partner suchen
        $statement = $pdo->query("SELECT id, vorname, nachname, profile_pic, spiel_level, ueber_mich FROM users WHERE suche_tennis_partner = 1");
        $rowCount = $statement->rowCount();
        if ($rowCount == 0) {
            echo '<p><strong>- Derzeit sucht niemand einen Spielpartner -</strong></p>';
        }

        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) : ?>
            <div class="userprofile-card">
                <a href="/intern/userprofile.php?id=<?= htmlspecialchars($row['id']) ?>">
                    <img src="<?= htmlspecialchars(getProfilePicPath($row['id'], $pdo)) ?>" alt="Profilbild">
                    <h3><?= htmlspecialchars($row['vorname']) . ' ' . htmlspecialchars($row['nachname']) ?></h3>
                </a>
                <p><strong>Spiellevel:</strong> <?= htmlspecialchars($row['spiel_level']) ?></p>
                <p><?= nl2br(htmlspecialchars(mb_strimwidth($row['ueber_mich'], 0, 50, "..."))) ?></p> <!-- Zeigt nur die ersten 50 Zeichen von "Über mich" -->
            </div>
        <?php endwhile; ?>
    </div>
    <h3>Du suchst einen Partner? Dann lade dein Bild hoch und ergänze dein <a href="settings.php">Profil</a>. Dort kannst du auch angeben, dass du hier angezeigt werden willst. </h3>
    </div>
</div>
<?php
  include(dirname(__FILE__) . "/inc/footer.inc.php");
?>