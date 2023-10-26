<?php
session_start();
require_once("../inc/config.inc.php");
require_once("../inc/functions.inc.php");
require_once("../inc/permissioncheck.inc.php");

$user = check_user();

$title = "Platzbuchung - Anleitung";
include("../inc/header.inc.php");
$kw = "champ2019";
?>
<script>
  // var element = document.getElementById("nav-intern");
  // element.classList.add("active");
  document.getElementById("nav-intern").classList.remove("active");
  document.getElementById("nav-einstellungen").classList.remove("active");
  document.getElementById("nav-turnier").classList.add("active");
  document.getElementById("nav-tafel").classList.remove("active");
  document.getElementById("nav-login").classList.remove("active");
  document.getElementById("nav-logout").classList.remove("active");
</script>

<div class="container main-container">
  <?php
  require_once("turnierheader.inc.php");
  ?>
  <h1>Turnierablauf</h1>
  </p>
  <h2>Auslosung</h2>
  <p>Die Auslosung ist im Turnierbaum zu finden, sobald verfügbar, siehe ggf. oben in der Navigation</p>
    
  <h2>Spieltermine selbst vereinbaren!</h2>
  <p>
Das Turnier findet während der Saison statt. Halbfinale und Finale werden an einem Septemberwoche gespielt. Alle Spiele bis dahin 
werden eigenverantwortlich mit den Gegnern vereinbart und in der Platzbuchung eingetragen. </p>
<p><strong>Bitte beachten:</strong></p>
<ul>
  <li>In der Platzbuchung als "Turnier" eintragen. Das geht auch, wenn es weiter in der Zukunft liegt.</li>
  <li>Bitte möglichst Platz 1 buchen. Wenn es nicht anders geht: Platz 2. Ein Turnierspiel ist immer attraktiv für Zuschauer, 
      auch wenn Ihr das anders seht.</li>
  <li>Bälle: Bitte einigt euch auf Bälle. Idealerweise sind sie neu.</li>
</ul>


  </p>
  <h2>Kategorien / Modus</h2>
  <p>
    Es gibt eine Herren- und eine Damen-Kategorie. Gespielt wird im einfachen k.o.-System. Wer sein erstes Spiel verliert, 
    kann in der B-Runde weiterspielen.
  </p>
  <h2>Auslosung nach DTB-Turnierregeln</h2>
  <p>Es wurde streng nach den DTB-Turnierregeln vorgegangen: Qualifikanten wurden nach Erfahrung der Turnierleitung bestimmt. Gesetzt wurden 
    die nach aktueller LK acht stärksten Spieler. Alle anderen Positionen wurden nach Zufall ausgelost.</p>
</div>

<?php
include("../inc/footer.inc.php")
?>