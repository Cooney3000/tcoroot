<?php
session_start();
require_once("../inc/config.inc.php");
require_once("../inc/functions.inc.php");
require_once("../inc/permissioncheck.inc.php");

// Einstieg in den internen Bereich

//Überprüfe, dass der User eingeloggt und berechtigt ist
//Der Aufruf von check_user() muss in alle internen Seiten eingebaut sein
$user = check_user();
// error_log (join(" # ", $user));

$title = "Intern - Kreismeisterschaft";
include("../inc/header.inc.php");
?>
<script>
  // var element = document.getElementById("nav-intern");
  // element.classList.add("active");
  document.getElementById("nav-intern").classList.remove("active");
  document.getElementById("nav-turnier").classList.remove("active");
  document.getElementById("nav-halloffame").classList.remove("active");
  document.getElementById("nav-tafel").classList.remove("active");
  document.getElementById("nav-login").classList.remove("active");
  document.getElementById("nav-logout").classList.remove("active");
</script>
<div class="container main-container">

  <div class="container">
    <div class="row">
      <div class="col-lg-8">
        <h1 class="h3 persoenlich text-gross my-3">Kreismeisterschaft 2024</h1>
        <h2>Donnerstag, 14.09. bis Sonntag, 17.09.2019</h2>
        <p>
          <a class="btn btn-lg btn-success btn-block" href="mytennis-Turnieranmeldung_Anleitung.pdf"><img src="/images/intern/mybigpoint_logo.png"> mybigpoint Anmeldeanleitung</a>
        </p>
        <p>
          <a class="btn btn-lg btn-success btn-block" href="Kreismeisterschaft-FFB-2024-Ausschreibung.pdf">Download Ausschreibungsdokument</a>
        </p>
        <p>
          <a class="btn btn-lg btn-success btn-block" href="https://spieler.tennis.de">Zu MyBigpoint</a>
        </p>

        <div class="col-lg-4 d-flex align-items-start">
          <img src="/images/intern/KM2024-Plakat.png" alt="Kreismeisterschaften Plakat">
        </div>
      </div>
    </div>
  </div>
</div>

<?php
include("../inc/footer.inc.php")
?>