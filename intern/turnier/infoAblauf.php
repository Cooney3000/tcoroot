<?php
session_start();
require_once("../inc/config.inc.php");
require_once("../inc/functions.inc.php");
require_once("../inc/permissioncheck.inc.php");

$user = check_user();

$title = "Platzbuchung - Anleitung";
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
  <h1>Turnierablauf</h1>
  </p>
  <h2>Termine</h2>
  <p>Wegen des Corona-bedingten verspäteten Starts der Punktspielsaison kann das Turnier 2021 nicht in der gewohnten Form stattfinden. 
  Wir haben daher beschlossen, das Turnier auf ein Wochenende zu konzentrieren:
    
    <div class="h3">Freitag, 10. September bis Sonntag, 12. September</div>

    Ausnahme: Bei mehr als 16 Teilnehmern in einer Kategorie wird die erste Runde im Zeitraum 01.08.-09.09.21 nach freier Zeiteinteilung gespielt.
  </p>
  <h2>Anmeldung / Auslosung</h2>
  <p>
    Die Anmeldung zum Clubturnier erfolgt über den internen Bereich. Anmeldezeitraum ist ab sofort bis 30. Juli. Sofern in einer 
    Kategorie weniger als 16 Spieler/Spielerinnen gemeldet sind, kann bis 7. September noch nachgemeldet werden.
    Die Auslosung ist abhängig von der Anzahl der bis 30.07.21 gemeldeten Teilnehmer:
    Mehr als 16 Teilnehmer: Auslosung 31. Juli
    Weniger als 16 Teilnehmer: Auslosung 8. September
  </p>
  <h2>Kategorien / Modus</h2>
  <p>
    Es wird eine Herren- und eine Damen-Kategorie geben. Gespielt wird im einfachen k.o.-System. Wer sein erstes Spiel verliert, spielt in der B-Runde weiter.
  </p>
  <h2>Konkrete Zeitplanung</h2>
  <p>
    Eine mögliche erste Runde bei mehr als 16 Teilnehmern findet mit freier Zeiteinteilung statt. Dazu vereinbart ihr bitte bis spätestens 3 Tage nach Auslosung mit eurem Partner einen Spieltermin und tragt ihn im Platzbuchungssystem ein.
    Die Spiele ab dem Achtelfinale (Runde der letzten 16) finden ab Freitag, 10. September nachmittags statt. Bitte plant diesen Tag nach Möglichkeit als Spieltag mit ein. Es werden vermutlich nicht alle Achtelfinals am Freitag stattfinden können, die restlichen werden dann Samstag Vormittag gespielt. Das Viertelfinale ist für Samstag nachmittags vorgesehen, Halbfinale und Finale dann am Sonntag.
    Die B-Runde findet am Samstag und Sonntag statt.
  </p>
  <h2>Sonstiges</h2>
  <p>
    Bälle bringt bitte jeder selbst mit. Grundsätzlich ist als Turnierball der für Punktspiele vorgesehene Dunlop-Ball btv 1.0 zu verwenden. Ihr könnt euch aber auch auf jeden anderen Ball einigen. Die Bälle sollten neu oder neuwertig sein, aber auch hier könnt ihr euch einfach absprechen.
  </p>
  LG Norbert
</div>

<?php
include("../templates/footer.inc.php")
?>