<?php
session_start();
require_once(dirname(__FILE__) . "/inc/config.inc.php");
require_once(dirname(__FILE__) . "/inc/functions.inc.php");
require_once(dirname(__FILE__) . "/inc/permissioncheck.inc.php");

$user = check_user();

$title = "Intern Spielerprofil";
include(dirname(__FILE__) . "/inc/header.inc.php");


$user_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($user_id <= 0) {
    echo "Ungültige Benutzer-ID.";
    exit;
}

// Benutzerinformationen abrufen
$statement = $pdo->prepare("SELECT id, vorname, nachname, mobil, email, spiel_level, ueber_mich, suche_tennis_partner, profile_pic FROM users WHERE id = :userid");
$statement->bindValue(':userid', $user_id, PDO::PARAM_INT);
$statement->execute();
$userProfile = $statement->fetch(PDO::FETCH_ASSOC);

$userPic = (!empty($userProfile['profile_pic'])) ? './uploads/profile_pics/' . $userProfile['profile_pic'] : '/intern/images/user.png';

if (!$userProfile || $userProfile['suche_tennis_partner'] == 0) {
    echo "Profildaten nicht für die Anzeige freigegeben.";
    exit;
}

// Profildaten anzeigen
?>
<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil von <?php echo htmlspecialchars($userProfile['vorname'] . ' ' . $userProfile['nachname']); ?></title>
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
    <div class="container main-container">

        <div class="container mt-4">
            <h1>Profil von <?php echo htmlspecialchars($userProfile['vorname'] . ' ' . $userProfile['nachname']); ?></h1>
            <div class="profil-details">
                <img src="<?= htmlspecialchars($userPic) ?>" alt="Profilbild" style="width:150px; height:150px;">
                <p><strong>Spiellevel:</strong> <?php echo htmlspecialchars($userProfile['spiel_level']); ?></p>
                <p><strong>Über mich:</strong> <?php echo nl2br(htmlspecialchars($userProfile['ueber_mich'])); ?></p>
                <p><strong>Mobil:</strong> <?php echo nl2br(htmlspecialchars($userProfile['mobil'])); ?></p>
                <p><strong>E-Mail:</strong> <?php echo nl2br(htmlspecialchars($userProfile['email'])); ?></p>
            </div>
        </div>
    </div>
</body>

</html>