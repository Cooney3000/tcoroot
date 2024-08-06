<?php 
session_start();
require_once("inc/config.inc.php");
require_once("inc/functions.inc.php");
require_once("inc/permissioncheck.inc.php");

$title = "Passwort neu vergeben";
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

<div class="container main-container">
<h1>Passwort neu vergeben</h1>
<?php

$showFormular = true;
$fehlermsg = '';

if (isset($_GET['t'])) {
    $token = $_GET['t'];

    // Überprüfe das Token
    $statement = $pdo->prepare("SELECT * FROM optintokens WHERE token = :token");
    $statement->execute(['token' => $token]);
    $optintoken = $statement->fetch();
    
    if ($optintoken) {
        $email = $optintoken['email'];
        
        if (isset($_GET['pwreset'])) {
            // überprüfe, ob Passwort 1 und Passwort 2 übereinstimmen
            $passwort = $_POST['passwort'];
            $passwort2 = $_POST['passwort2'];

            if ($passwort === $passwort2) {
                try {
                    // Token und Passwort ok, begin transaction
                    $pdo->beginTransaction();

                    // Token löschen
                    $sql = "DELETE FROM optintokens WHERE token = :token";
                    $statement = $pdo->prepare($sql);
                    $statement->execute(['token' => $token]);
                    
                    $passwort_hash = password_hash($passwort, PASSWORD_DEFAULT);

                    // Passwortupdate
                    $sql = "UPDATE users SET passwort = :passwort WHERE email = :email";
                    $statement = $pdo->prepare($sql);
                    $statement->execute(['passwort' => $passwort_hash, 'email' => $email]);

                    $pdo->commit();

                    $showFormular = false;
                    echo '<p class="h3 text-success">Dein Passwort wurde zurückgesetzt. Melde dich jetzt an: <a href="login.php">Login</a></p>';
                } catch (Exception $e) {
                    $pdo->rollBack();
                    $fehlermsg = 'Ein Fehler ist aufgetreten. Bitte versuche es erneut.';
                }
            } else {
                $fehlermsg = 'Die Passwörter müssen übereinstimmen. Bitte versuche es erneut.';
            }
        }

        if ($showFormular) {	
?>
            <br>
            <p class="h4">Gute Passwörter</p>
            <p> sind wichtig, auch wenn Du vielleicht denkst, dass die TCO-Website keine große Relevanz hat. </p>
            <p>Allerdings: Wenn dein Account gehackt wird, hat der Hacker immerhin 
            schon Zugriff auf alle Mitgliedernamen und viele Email-Adressen sowie Telefonnummern und er weiß, wer wann mit wem Tennis spielt. 
            Alle anderen Mitglieder werden es Dir danken, wenn du sie durch Anwendung eines guten Passworts davor bewahrst.</p>

            <p>Bitte gib dein Passwort zweimal ein. Das Passwort muss mindestens 10 und maximal 14 Zeichen lang sein. 
            Es muss aus den Zeichen <mark> a-z A-Z 0-9 ! @ # $ % ^ & * _ = + - </mark> bestehen. Ein Großbuchstabe, 
            ein Sonderzeichen und eine Ziffer müssen jeweils mindestens vorkommen</p>

            <form action="?t=<?= htmlentities($token) ?>&pwreset=1" method="post" accept-charset="utf-8">
                <div class="form-group">
                    <label for="inputPasswort">Passwort:</label>
                    <input type="password" id="inputPasswort" name="passwort" minlength="10" maxlength="14" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*_=+-.,]).{10,14}$" class="form-control" x-autocompletetype="new-password" required>
                </div> 

                <div class="form-group">
                    <label for="inputPasswort2">Passwort wiederholen:</label>
                    <input type="password" id="inputPasswort2" name="passwort2" minlength="10" maxlength="14" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*_=+-.,]).{10,14}$" class="form-control" x-autocompletetype="new-password" required>
                </div> 

                <button type="submit" class="btn btn-lg btn-primary btn-block">Jetzt zurücksetzen</button>
            </form>
            <p class="h3 text-danger"><?= $fehlermsg ?></p>

<?php
        }
    } else {
        echo '<p class="h2 text-danger">Dein Link ist bereits abgelaufen. Bitte starte den Passwort-Reset erneut</p>';
    }
} else {
    echo '<p class="h2 text-danger">Ungültiger Link. Bitte starten Sie den Passwort-Reset erneut</p>';
}
?>

</div>
<?php 
include("inc/footer.inc.php");
?>
