<?php 
session_start();

if (isset($_COOKIE['identifier'])) {
    require_once("inc/config.inc.php");
    require_once("inc/functions.inc.php");
    require_once("inc/permissioncheck.inc.php");

    // Alle Session-Daten löschen
    $_SESSION = array();
    $paths = [
        "/intern/",
        "/intern/turnier",
        "/intern/history/turnier2019",
        "/intern/history/turnier2018"
    ];

    foreach ($paths as $path) {
        setcookie("identifier", "", 1, $path);
        setcookie("securitytoken", "", 1, $path);
    }

    // Jetzt noch in der DB löschen
    $statement = $pdo->prepare("DELETE FROM securitytokens WHERE identifier = :identifier");
    $statement->execute(['identifier' => $_COOKIE['identifier']]);

    session_destroy();
}

$title = "Logout";
include("inc/header.inc.php");
?>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const navItems = ['intern', 'einstellungen', 'login', 'logout'];
    navItems.forEach(item => {
        const element = document.getElementById(`nav-${item}`);
        if (element) {
            element.classList.remove('active');
        }
    });
    document.getElementById("nav-logout").classList.add("active");
});
</script>

<div class="container main-container">
Der Logout war erfolgreich. <a href="login.php">Zurück zum Login</a>.
</div>

<?php 
include("inc/footer.inc.php");
?>
