<?php 
session_start();
require_once("inc/config.inc.php");
require_once("inc/functions.inc.php");

$title = "Bestätigung der Registrierung";
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
<h1>Bestätigung der Registrierung</h1>
<?php

if (isset($_GET['t'])) {
    $error = false;
    $token = trim($_GET['t']);
    
    // Überprüfe das Token
    if (!$error) { 
        $statement = $pdo->prepare("SELECT * FROM optintokens WHERE token = :token");
        $statement->execute(['token' => $token]);
        $optintoken = $statement->fetch();

        if ($optintoken !== false) {
            try {
                $pdo->beginTransaction();
                
                // Setze den Status auf 'A'
                $sql = "UPDATE users SET status = 'A' WHERE email = :email";
                $statement = $pdo->prepare($sql);
                $statement->execute(['email' => $optintoken['email']]);

                // Das Token wird gelöscht
                $sql = "DELETE FROM optintokens WHERE token = :token";
                $statement = $pdo->prepare($sql);
                $statement->execute(['token' => $token]);

                $pdo->commit();

                echo '<h2>Gratuliere! Dein Account wurde aktiviert! <a href="login.php">Zum LOGIN</a></h2>';
            } catch (Exception $e) {
                $pdo->rollBack();
                echo '<h2 class="text-danger">Ein Fehler ist aufgetreten. Bitte versuche es später erneut.</h2>';
            }
        } else {
            echo '<h2 class="text-danger">Ungültiger oder abgelaufener Token.</h2>';
        }
    }
} else {
    echo '<h2 class="text-danger">Kein Token angegeben.</h2>';
}

?>
</div>
<?php 
include("inc/footer.inc.php");
?>
