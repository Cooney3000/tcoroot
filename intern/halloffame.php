<?php
session_start();
require_once("inc/config.inc.php");
require_once("inc/functions.inc.php");
require_once("inc/permissioncheck.inc.php");

// Einstieg in den internen Bereich

//Überprüfe, dass der User eingeloggt und berechtigt ist
//Der Aufruf von check_user() muss in alle internen Seiten eingebaut sein
$user = check_user();

$title = "Intern Hall Of Fame";
include("templates/header.inc.php");
?>
<script>
    document.getElementById("nav-intern").classList.remove("active");
    document.getElementById("nav-einstellungen").classList.remove("active");
    document.getElementById("nav-turnier").classList.remove("active");
    document.getElementById("nav-halloffame").classList.add("active");
    document.getElementById("nav-tafel").classList.remove("active");
    if (typeof(document.getElementById("nav-login").classList.remove("active"))) { document.getElementById("nav-login").classList.remove("active") }
    if (typeof(document.getElementById("nav-logout").classList.remove("active"))) {document.getElementById("nav-logout").classList.remove("active")}
</script>

<div class="container main-container">
  <h1 class="h1">Hall of Fame</h1>

  <div class="container mt-4">
    <div class="row">
      <div class="h2 px-3 py-1 bg-success h-100 w-100 text-white">Die Clubmeister 2019&nbsp;&nbsp;&nbsp;<img class="img-fluid" src="/intern/images/siegplakette.png" alt="Siegplakette" /></div>
      <div class="col-sm">
        <div class="klein my-2">Mannschaftsspielerinnen:</div>
        <img src="/intern/history/turnier2019/images/petra_streif.png" alt="Petra Streif" />
        <div class="h5 mb-2">Petra Streif</div>
      </div>
      <div class="col-sm">
        <div class="klein my-2">Mannschaftsspieler:</div>
        <img src="/intern/history/turnier2019/images/thomas_schek.png" alt="Thomas Schek" />
        <div class="h5 mb-2">Thomas Schek</div>
      </div>
      <div class="col-sm">
        <div class="klein my-2">Freizeitspieler:</div>
        <img src="/intern/history/turnier2019/images/hacky_leihenseder.png" alt="Hartmut Hacky Leihenseder" />
        <div class="h5 mb-2">Hartmut "Hacky" Leihenseder</div>
      </div>
    </div> <!-- row -->
    <p>Das erste Jahr der neuen Clubmeisterschaften, die von Norbert frühzeitig geplant waren und verschiedene Spielklassen einführten. </p>
  <p>Conny Roloff programmierte eine elektronische Platztafel, auf der sich jede Paarung eintragen konnte. Jeder konnte sehen, wer wann spielt. 
  Dadurch fanden sich an sonst leeren Wochenenden plötzlich Zuschauer ein und es ergaben sich gesellige Nachmittage.</p>
      <a href="/intern/history/turnier2019/">Zu weiteren Turnierdetails</a>
  </div> <!-- container -->


  <div class="container mt-4">
    <div class="row">
      <div class="h2 px-3 py-1 bg-success h-100 w-100 text-white">Die Clubmeister 2018&nbsp;&nbsp;&nbsp;<img class="img-fluid" src="/intern/images/siegplakette.png" alt="Siegplakette" /></div>
      <div class="col-sm">
        <div class="klein my-2">Mannschaftsspieler:</div>
        <img src="/intern/history/turnier2018/images/niko_rieber.png" alt="Niko Rieber" />
        <div class="h5 mb-2">Niko Rieber</div>
      </div>
    </div> <!-- row -->
        <p>Das war der erste Versuchsballon für ein Clubturnier. Unheimlich kurfristig auf die Beine gestellt, allerdings nur mit den Spielern der Herrenmannschaften. 
            Deswegen gab es auch noch kein Plakat oder sonstige Zusatzorganisation.</p>
        <p>Die Online-Unterstützung für die Spielerpaarungen lief noch über ein geteiltes Excel und war etwas hakelig.</p>
        <a href="/intern/history/turnier2018/">Zu weiteren Turnierdetails</a>
  </div> <!-- container -->


</div>
<?php 
include("templates/footer.inc.php")
?>

