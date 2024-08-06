<?php 
session_start();
require_once("inc/config.inc.php");
require_once("inc/functions.inc.php");
require_once("inc/permissioncheck.inc.php");

$title = "Passwort zurücksetzen";
include("inc/header.inc.php");
?>
<script>
document.addEventListener('DOMContentLoaded', () => {
    const navItems = ['intern', 'einstellungen', 'turnier', 'halloffame', 'tafel', 'login', 'logout'];
    navItems.forEach(item => {
        const element = document.getElementById(`nav-${item}`);
        if (element) {
            element.classList.remove('active');
        }
    });
});
</script>

<div class="container main-container registration-form">
<h1>Passwort zurücksetzen</h1>
<?php
$showFormular = true; // Variable ob das Email-Formular angezeigt werden soll
 
if (isset($_GET['pwreset'])) {
    $error = false;
    $email = trim($_POST['email']);
    
    if (empty($email)) {
        echo '<span class="text-danger">Bitte alle Felder ausfüllen</span><br>';
        $error = true;
    }
  
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo '<span class="text-danger">Bitte eine gültige E-Mail-Adresse eingeben</span><br>';
        $error = true;
    }
    
    // Überprüfe, dass die E-Mail-Adresse vorhanden ist
    if (!$error) {
        $statement = $pdo->prepare("SELECT * FROM users WHERE email = :email");
        $statement->execute(['email' => $email]);
        $user = $statement->fetch();
        
        if (!$user) {
            echo '<span class="text-danger">Diese E-Mail-Adresse ist nicht vorhanden. Bitte erneut versuchen oder ggf. neu registrieren</span><br>';
            $error = true;
        }
    }
    
    // Keine Fehler, wir können den Passwort-Reset einleiten
    if (!$error) {
        $vorname = $user['vorname'];
        $nachname = $user['nachname'];  
        // Das Token für den E-Mail-Link erzeugen
        $token = md5(random_bytes(20));

        // Opt-In-Token anlegen
        $sql = 'INSERT INTO optintokens (email, token) VALUES (:email, :token)';
        $statement = $pdo->prepare($sql);
        $statement->execute(['email' => $email, 'token' => $token]);

        // Mail versenden
        $empfaenger = $email;
        $betreff = "Dein TCO-Passwort zurücksetzen";
        $from = "From: " . $CONFIG['webmasterMailAddress'] . "\r\n";
        $from .= "Bcc: " . $CONFIG['webmasterMailAddress'] . "\r\n";
        $from .= "Reply-To: " . $CONFIG['webmasterMailAddress'] . "\r\n";
        $from .= "Content-Type: text/html; charset=utf-8\r\n";

        $text = <<<EOT
<p>Hallo $vorname $nachname,</p>

<p>
du möchtest dein Passwort beim TCO zurücksetzen? Wenn das richtig ist, dann klicke auf diesen Link:   
<a href="https://www.tcolching.de/intern/pwvergessenAbschluss.php?t=$token">Passwort zurücksetzen</a><br>
Danach kannst du dein neues Passwort eingeben.
</p>
<p>
Wenn du KEIN Zurücksetzen des Passworts veranlasst hast, ignoriere diese Email. Dein altes Passwort ist nach wie vor gültig.
</p>
<p>Viele Grüße</p>
<p>Der TC Olching e.V.</p>
EOT;

        $showFormular = false;

        if (mail($empfaenger, $betreff, $text, $from)) {
            echo '<div class="h5 my-2">Vielen Dank! Du erhältst in Kürze eine Mail. Sobald du auf den Link in der Mail klickst, kannst du dein Passwort neu setzen.</div>';
        } else {
            echo '<div class="h5 text-danger my-2">Beim Versenden der Bestätigungsmail ist leider ein Fehler aufgetreten. Bitte benachrichtige ' . $CONFIG['webmasterMailAddress'] . '<br></div>';
        }
    }
}

if ($showFormular) {
?>
<p class="h4">Du möchtest dein Passwort zurücksetzen?</p>
<p>Gib hier deine Email-Adresse ein, um einen Link zum Zurücksetzen zu erhalten:</p>
<br>

<form action="?pwreset=1" method="post" accept-charset="utf-8">
    <div class="form-group">
        <label for="inputEmail">Deine E-Mail:</label>
        <input type="email" id="inputEmail" name="email" class="form-control" x-autocompletetype="email" required>
    </div>
    <button type="submit" class="btn btn-lg btn-primary btn-block">Absenden</button>
</form>
 
<?php
} // Ende von if($showFormular)
?>
</div>
<?php 
include("inc/footer.inc.php");
?>
