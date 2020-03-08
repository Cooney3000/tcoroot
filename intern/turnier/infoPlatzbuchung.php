<?php 
session_start();
require_once("../inc/config.inc.php");
require_once("../inc/functions.inc.php");
require_once("../inc/permissioncheck.inc.php");

$user = check_user();

$title = "Turnierplaner - Anleitung";
include("../templates/header.inc.php");
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
  <h1>Anleitung: DIE REGISTRIERUNG</h1>
  <h2>Wie du deine Platzbuchung mit der elektronischen Platztafel organisierst:</h2>
  <p>
Damit sich die Spieler einfacher verabreden können und sehen, wann Plätze frei sind, 
habe ich ein Platzbuchungssystem programmiert, das ähnlich aussieht wie unsere alte Magnettafel am Platz. Somit ist auch immer für alle gut sichtbar, 
wann interessante Begegnungen stattfinden.
  </p>
  <p>
  <strong class="text-danger">Die Benutzung des Platzbuchungssystems ist Pflicht ab 2020 für alle Platzbuchungen!</strong>
  </p>
  <h2>Registrierung</h2>
  <p>
  <strong>Alle Spieler</strong> müssen sich zunächst als Benutzer registrieren: <strong><a href="../register.php">Zur Registrierung</a></strong>
  <br><strong class="text-danger">Bitte merke dir dein Passwort! Wenn du es vergisst, habe ich Zusatzaufwand, da ich noch keine "Passwort vergessen"-Funktionalität eingebaut habe!</strong>
  </p>
  <h2>Warteraum</h2>
  <p>
  Wenn du registriert bist, befindest du dich in Warteposition. 
  <strong>Du erhältst eine E-Mail mit einem Link. Wenn du ihn anklickst, wird dein Account aktiviert.</strong>
  </p>
  <h2>Login und zur Platzbelegung</h2>
  <p>
  Vor der Benutzung des Systems musst du dich einloggen: <strong><a href="../login.php">Zum Login</a></strong>
  </p>
  <p>
  Jetzt kannst du in der Navigation <strong><a href="../tafel/">PLATZTAFEL</a></strong> auswählen! 
  </p>
  <h2>Turnierplaner / Platztafel</h2>
  <p>
  <strong>Browser: </strong>Es werden folgende Browser in der jeweils aktuellsten Version unterstützt: Safari, Chrome, Edge, Internet Explorer 11
  </p>
  <p>
  Am PC, am Tablet oder mit quergestelltem Smartphone siehst du jetzt 6 Spalten: für jeden Platz eine. 
  Mit hochgestelltem Handy siehst du nur einen Platz und kannst zu den anderen Plätzen "rüberwischen".
  </p>
  <p>
  Über den Plätzen gibt es eine Leiste mit Kalendertagen. Sie beginnt mit dem jeweils heutigen Tag. Du kannst jeden Tag auswählen. 
  </p>
  <p>
  Mit dem "+" in der Titelleiste eines Platzes kannst du eine Platzreservierung vornehmen. Es erscheint ein Formular. 
  </p>
  <p>
  Wenn du einen bestehenden Termin anklickst, kannst du diesen ändern.
  </p>
  <h3>ACHTUNG: Du kannst Buchungen von anderen ändern oder löschen! Sei daher bitte vorsichtig!</h3>

  <h2>Disclaimer</h2>

  <p><strong>Das System ist selbst programmiert</strong> und daher möglicherweise nicht perfekt. Wenn du Fehler findest, bitte ich um Nachsicht und eine Email an 
  <a href="mailto:webmaster@tcolching.de">webmaster@tcolching.de</a>.</p>
  <p>Auch wenn es Probleme irgendwelcher Art gibt, bitte ich um Benachrichtigung. Bitte nicht einfach wegducken, 
  wenn du versehentlich Änderungen gemacht hast. Keiner ist böse :-)</p>
  <p>Viel Spaß mit dem System!</p>
  <p>Euer Conny Roloff</p>

<?php 
include("../templates/footer.inc.php")
?>