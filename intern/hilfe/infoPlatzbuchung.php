<?php 
session_start();
require_once("../inc/config.inc.php");
require_once("../inc/functions.inc.php");
require_once("../inc/permissioncheck.inc.php");

$user = check_user();

$title = "Platzbuchung - Anleitung";
include("../inc/header.inc.php");
?>
<script>
    document.getElementById("nav-intern").classList.remove("active");
    document.getElementById("nav-einstellungen").classList.remove("active");
    document.getElementById("nav-turnier").classList.remove("active");
    document.getElementById("nav-halloffame").classList.remove("active");
    document.getElementById("nav-tafel").classList.remove("active");
    document.getElementById("nav-hilfe").classList.add("active");
    document.getElementById("nav-login").classList.remove("active");
    document.getElementById("nav-logout").classList.remove("active");
</script>

<div class="container main-container">
<?php 
  require_once("../inc/header.inc.php");
?>  
 
  <h1>Anleitung: DAS PLATZBUCHUNGSSYSTEM</h1>
  <h2>Wie du einen Platz für deine Spiele buchst:</h2>

  <p>
  <strong class="text-danger">Die Benutzung des Platzbuchungssystems ist Pflicht seit 2020.</strong>
  </p>
  Wähle in der Navigation <strong><a href="../tafel/">Platzbuchung</a></strong> aus! 
  </p>
  <h2>Die Platztafel</h2>
  <p>
  <strong>Browser: </strong>Es werden folgende Browser in der jeweils aktuellsten Version unterstützt: Safari, Chrome, Edge, Internet Explorer 11
  </p>
  <p>
  Am PC, am Tablet oder mit quergestelltem Smartphone siehst du jetzt 6 Spalten: für jeden Platz eine. 
  Mit hochgestelltem Handy siehst du nur einen Platz und kannst zu den anderen Plätzen "rüberwischen".
  </p>
  <img src="\images\intern\platztafel1.png" alt="Screenshot Platztafel"/>
  <p>
  Über den Plätzen gibt es eine Leiste mit Kalendertagen. Sie beginnt mit dem jeweils heutigen Tag. Du kannst jeden Tag auswählen. 
  </p>
  <p>
  Mit dem "+" in der Titelleiste eines Platzes kannst du eine Platzreservierung vornehmen. Es erscheint ein Formular. 
  </p>
  <p>
    Wenn du einen bestehenden Termin anklickst, kannst du diesen ändern.
  </p>
  <h3>ACHTUNG: Du kannst Buchungen von anderen ändern oder löschen! Sei daher bitte vorsichtig! Solche Aktionen werden allerdings aufgezeichnet und können bei Beschwerden ausgewertet werden.</h3>
  <h3>Ein normales Freizeitspiel kannst du nur für den aktuellen Tag buchen. Du kannst keine Buchung löschen oder ändern, wenn ihr Startzeitpunkt bereits verstrichen ist.
  </h3>

  <h2>Disclaimer</h2>

  <p><strong>Das System ist selbst programmiert</strong> und daher möglicherweise nicht perfekt. Wenn du Fehler findest, bitte ich um Nachsicht und eine Email an 
  <a href="mailto:webmaster@tcolching.de">webmaster@tcolching.de</a>.</p>
  <p>Auch wenn es Probleme irgendwelcher Art gibt, bitte ich um Benachrichtigung. Bitte nicht einfach wegducken, 
  wenn du versehentlich Änderungen gemacht hast. Keiner ist böse :-)</p>
  <p>Viel Spaß mit dem System!</p>
  <p>Euer Conny Roloff</p>

<?php 
include("../inc/footer.inc.php")
?>