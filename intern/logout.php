<?php
session_start();
require_once("inc/config.inc.php");
require_once("inc/functions.inc.php");
require_once("inc/permissioncheck.inc.php");

if (isset($_COOKIE['identifier'])) {

    // Alle Session-Daten löschen
    $_SESSION = [];
    session_destroy();  // Session should be destroyed after unsetting the session variables

    // Clear cookies for specified paths
    $paths = [
        "/intern/",
        "/intern/turnier",
        "/intern/history/turnier2019",
        "/intern/history/turnier2018"
    ];

    foreach ($paths as $path) {
        setcookie("identifier", "", time() - 3600, $path);
        setcookie("securitytoken", "", time() - 3600, $path);
    }

    // Jetzt noch in der DB löschen
    $statement = $pdo->prepare("DELETE FROM securitytokens WHERE identifier = :identifier");
    $statement->execute(['identifier' => $_COOKIE['identifier']]);
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
    Du bist ausgeloggt.
    <div>
        <a class="btn btn-lg btn-success btn-block" href="login.php">Zum Login</a>
    </div>
</div>

<?php
include("inc/footer.inc.php");
?>