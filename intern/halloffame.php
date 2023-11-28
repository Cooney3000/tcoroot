<?php
session_start();
require_once("inc/config.inc.php");
require_once("inc/functions.inc.php");
require_once("inc/permissioncheck.inc.php");

// Einstieg in den internen Bereich

//Überprüfe, dass der User eingeloggt und berechtigt ist
//Der Aufruf von check_user() muss in alle internen Seiten eingebaut sein
$user = check_user();

$title = "Hall Of Fame";
include("inc/header.inc.php");
?>
<script>
  document.getElementById("nav-intern").classList.remove("active");
  document.getElementById("nav-turnier").classList.remove("active");
  document.getElementById("nav-halloffame").classList.add("active");
  document.getElementById("nav-tafel").classList.remove("active");
  if (document.getElementById("nav-login") !== null) document.getElementById("nav-login").classList.remove("active");
  if (document.getElementById("nav-logout") !== null) document.getElementById("nav-logout").classList.remove("active");
</script>

<div class="container main-container">
  <h1 class="h1">Hall of Fame</h1>

  <div class="container mt-4">
    <div class="row">
      <div class="h2 px-3 py-1 bg-success h-100 w-100 text-white">Die Clubmeister 2023&nbsp;&nbsp;&nbsp;<img class="img-fluid" src="/intern/images/siegplakette.png" alt="Siegplakette" /></div>
      <div class="col-sm">
        <div class="klein my-2">Damen:</div>
        <img class="breitebilder" src="/intern/history/turnier2023/images/elena_vogg.jpg" alt="Elena Vogg" />
        <div class="h5 mb-2">Elena Vogg</div>
      </div>
      <div class="col-sm">
        <div class="klein my-2">Herren:</div>
        <img class="breitebilder" src="/intern/history/turnier2023/images/sascha_mischke.jpg" alt="Sascha Mischke" />
        <div class="h5 mb-2">Sascha Mischke</div>
      </div>
    </div> <!-- row -->
    <h2 class="display-5"><a href="/intern/history/turnier2023/">Zu weiteren Turnierdetails</a></h2>
  </div> <!-- container -->

  <div class="container mt-4">
    <div class="row">
      <div class="h2 px-3 py-1 bg-success h-100 w-100 text-white">Die Clubmeister 2022&nbsp;&nbsp;&nbsp;<img class="img-fluid" src="/intern/images/siegplakette.png" alt="Siegplakette" /></div>
      <div class="col-sm">
        <div class="klein my-2">Damen:</div>
        <img class="breitebilder" src="/intern/history/turnier2022/images/moni_traub.png" alt="Moni Traub" />
        <div class="h5 mb-2">Moni Traub</div>
      </div>
      <div class="col-sm">
        <div class="klein my-2">Herren:</div>
        <img class="breitebilder" src="/intern/history/turnier2022/images/kai_kirchhoff.png" alt="Kai Kirchhoff" />
        <div class="h5 mb-2">Kai Kirchhoff</div>
      </div>
    </div> <!-- row -->
    <h2 class="display-5"><a href="/intern/history/turnier2022/">Zu weiteren Turnierdetails</a></h2>
  </div> <!-- container -->

  <div class="container mt-4">
    <div class="row">
      <div class="h2 px-3 py-1 bg-success h-100 w-100 text-white">Die Clubmeister 2021&nbsp;&nbsp;&nbsp;<img class="img-fluid" src="/intern/images/siegplakette.png" alt="Siegplakette" /></div>
      <div class="col-sm">
        <div class="klein my-2">Damen:</div>
        <img class="breitebilder" src="/intern/history/turnier2021/images/luna_streif.png" alt="Luna Streif" />
        <div class="h5 mb-2">Luna Streif</div>
      </div>
      <div class="col-sm">
        <div class="klein my-2">Herren:</div>
        <img class="breitebilder" src="/intern/history/turnier2021/images/ulf_henke.jpeg" alt="Ulf Henke" />
        <div class="h5 mb-2">Ulf Henke</div>
      </div>
    </div> <!-- row -->
    <p>2021 stand immer noch unter dem Einfluss Corona, doch die Erleichterungen durch den Impffortschritt
      waren schon zu spüren. Planungen waren aber nach wie vor ein Glücksspiel, daher entschieden wir uns
      zu einem Wochenende mit k.o.-System und B-Runde.
      Das Wetter spielte mit und so wurde es ein vielfach gelobter Vereins-Event. Besonders interessant: Bei den Damen gab es einen Generationenwechsel!</p>
    <h2 class="display-5"><a href="/intern/history/turnier2021/">Zu weiteren Turnierdetails</a></h2>
  </div> <!-- container -->

  <div class="container mt-4">
    <div class="row">
      <div class="h2 px-3 py-1 bg-success h-100 w-100 text-white">Die Clubmeister 2020&nbsp;&nbsp;&nbsp;<img class="img-fluid" src="/intern/images/siegplakette.png" alt="Siegplakette" /></div>
      <div class="col-sm">
        <div class="klein my-2">Damen:</div>
        <img class="breitebilder" src="/intern/history/turnier2020/images/petra_streif.png" alt="Petra Streif" />
        <div class="h5 mb-2">Petra Streif</div>
      </div>
      <div class="col-sm">
        <div class="klein my-2">Herren:</div>
        <img class="breitebilder" src="/intern/history/turnier2020/images/toni_weber.png" alt="Toni Weber" />
        <div class="h5 mb-2">Toni Weber</div>
      </div>
    </div> <!-- row -->
    <p>2020 war das erste Jahr unter Corona mit vielen Einschränkungen für die Tennissaison. Die Mannschaftsspiele wurden verzögert gestartet,
      das Clubturnier begann erst im Juni wurde als k.o.-System mit B-Runde ausgetragen.
      Corona zum Trotz wurde das Turnier gut angenommen und wurde so ein Erfolg.</p>
    <h2 class="display-5"><a href="/intern/history/turnier2020/">Zu weiteren Turnierdetails</a></h2>
  </div> <!-- container -->


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
    <p>Das erste Jahr der neuen Clubmeisterschaften, die von Norbert Maier frühzeitig geplant waren und verschiedene Spielklassen einführten. </p>
    <p>Conny Roloff programmierte eine elektronische Platztafel, auf der sich jede Paarung eintragen konnte. Jeder konnte sehen, wer wann spielt.
      Dadurch fanden sich an sonst leeren Wochenenden plötzlich Zuschauer ein und es ergaben sich gesellige Nachmittage.</p>
    <h2 class="display-5"><a href="/intern/history/turnier2019/">Zu weiteren Turnierdetails</a></h2>
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
    <h2 class="display-5"><a href="/intern/history/turnier2018/">Zu weiteren Turnierdetails</a></h2>
  </div> <!-- container -->


</div>
<?php
include("inc/footer.inc.php")
?>