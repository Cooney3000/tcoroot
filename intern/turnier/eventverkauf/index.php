<?php 
session_start();
require_once("../inc/config.inc.php");
require_once("../inc/functions.inc.php");
require_once("../inc/permissioncheck.inc.php");

//Überprüfe, dass der User eingeloggt und berechtigt ist
$user = check_user();

$title = "Ticketverkauf";
include("../templates/header.inc.php");
if (checkPermissions(T_ALL_PERMISSIONS) ) 
{
?>

  <script>
      document.getElementById("nav-intern").classList.remove("active");
      document.getElementById("nav-einstellungen").classList.remove("active");
      document.getElementById("nav-turnier").classList.add("active");
      document.getElementById("nav-login").classList.remove("active");
      document.getElementById("nav-logout").classList.remove("active");
  </script>

  <div class="container main-container registration-form">

<?php 
    require_once("turnierheader.inc.php");
?> 
  <div class="container main-container">
    <h1>Ticketverkauf</h1>
    
    <!-- ReactJS Container -->
    <div id="eventverkaufApp"></div>

  </div>
  <script type="text/javascript"
          src="dist/eventverkauf-app.js">
  </script>

  <script>
    function hasChanged(e) {
      const p = e.id.split('<?= $delimiter ?>');
      const id = "i=" + p[0];
      const col = "&col=" + p[1];
      const v = "&v=" + e.value;
      const kaeuferId = col === "&col=kaeufer" ? "&ki=" + p[2] : "";
      const url = "/intern/api/ticket.php?" + id + col + v + kaeuferId;
      console.log(url);
      fetch(url, {credentials: 'same-origin'})
        .then(result => {
          if (result.ok) {
            // console.log(result);
            return true;
          } else {
            throw new Error('Fehler beim Erzeugen/Updaten der Tickets' + this.state.r.id);
          }
        });
    }
  </script>

<?php
} // check_permissions
include("../templates/footer.inc.php");
?>
