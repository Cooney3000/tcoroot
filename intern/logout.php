<?php 

if (isset($_COOKIE['identifier']))
{
  session_start();
  
  // Alle Session-Daten löschen
  $_SESSION = array();
  setcookie("identifier", "", 1, "/intern/");
  setcookie("securitytoken", "", 1, "/intern/");
  setcookie("identifier", "", 1, "/intern/turnier");
  setcookie("securitytoken", "", 1, "/intern/turnier");
  setcookie("identifier", "", 1, "/intern/history/turnier2019");
  setcookie("securitytoken", "", 1, "/intern/history/turnier2019");
  setcookie("identifier", "", 1, "/intern/history/turnier2018");
  setcookie("securitytoken", "", 1, "/intern/history/turnier2018");

  require_once("inc/config.inc.php");
  require_once("inc/functions.inc.php");
  require_once("inc/permissioncheck.inc.php");
  
  // Jetzt noch in der DB löschen
  $pdo->query("DELETE FROM securitytokens WHERE identifier = '{$_COOKIE['identifier']}'");

  session_destroy();
}


$title = "Logout";
include("inc/header.inc.php");
?>

<script>
    // var element = document.getElementById("nav-intern");
    // element.classList.add("active");
    document.getElementById("nav-intern").classList.remove("active");
    document.getElementById("nav-einstellungen").classList.remove("active");
    document.getElementById("nav-login").classList.remove("active");
    document.getElementById("nav-logout").classList.add("active");
</script>

<div class="container main-container">
Der Logout war erfolgreich. <a href="login.php">Zurück zum Login</a>.
</div>

<?php 
include("inc/footer.inc.php")
?>