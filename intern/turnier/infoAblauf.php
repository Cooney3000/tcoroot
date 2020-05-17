<?php 
session_start();
require_once("../inc/config.inc.php");
require_once("../inc/functions.inc.php");
require_once("../inc/permissioncheck.inc.php");

if(isset($_SESSION['userid'])) {
  $user = check_user();
}
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

<h1>Turnierablauf</h1>

<h2>Kommunikation</h2>

<p>Die Kommunikation läuft über eine separate WhatsApp-Gruppe je Kategorie, um die Flut der
 Nachrichten etwas einzudämmen. Wer sich auch für die anderen Kategorien interessiert und immer
  auf dem Laufenden bleiben möchte, kann auch gerne zusätzlich in andere Gruppen aufgenommen werden. </p>

<h2>Terminvereinbarung</h2>

<p>Sobald eine neue Paarung feststeht, sollte möglichst schnell ein Spieltermin vereinbart werden. Bitte
 nehmt schnell Kontakt mit Eurem Partner auf, Ihr erleichtert damit die Turnierplanung enorm. 
 Bitte wendet Euch bei der Terminvereinbarung direkt an den Spielpartner und nutzt dafür nicht 
 die WhatsApp-Gruppe. Die <strong>Telefonnummer des Partners findet Ihr <a href="bereitsAngemeldet.php">hier</a></strong>. Der Spieltermin muss im 
 <strong><a href="../tafel/" target="_blank">Platzbuchungssystem</a></strong> als Spielartmit einer Spieldauer von 2 Stunden eingetragen werden.</p>

<p>Im Platzbuchungssystem ist erkennbar, wann Plätze für das Turnier frei sind. 
Montags ab 18 Uhr sind alle Plätze durch das DropIn belegt. Von Dienstag bis Donnerstag 
steht wegen den diversen Trainingszeiten abends nur ein Platz zur Verfügung. Deshalb sollten 
die Spiele nach Möglichkeit schwerpunktmäßig an Freitagen, Feiertagen und Wochenenden stattfinden. 
Trotz der Punktspielsaison sind auch an den Wochenenden fast immer Plätze verfügbar.  
Soweit möglich, sollten die Spiele auf Platz 1 stattfinden.</p>

<h2>Der Spieltag</h2>

<p>Bitte seid pünktlich zur vereinbarten Zeit spielbereit. Die Erfahrung aus dem letzten Jahr zeigt, dass 
immer wieder Interessierte zum Zuschauen vorbeikommen, bitte nutzt auch deshalb die grünen Ergebnistafeln. 
Ihr findet sie in den Umkleidekabinen.</p>

<p>Bälle bringt jeder selbst mit. Grundsätzlich ist als Turnierball der neue für Punktspiele und 
Turniere vorgesehene Dunlop-Ball btv 1.0 zu verwenden. Ihr könnt Euch aber auch auf jeden anderen 
Ball einigen. Die Bälle sollten neu oder neuwertig sein, aber auch hierbei könnt Ihr Euch einfach 
absprechen.</p>

<p>Gespielt wird nach den üblichen Regeln: 2 Gewinnsätze, die beiden ersten Sätze normal (bei 6:6 Tiebreak), 
der 3. Satz als Matchtiebreak bis 10. </p>

<h2>Spielergebnis eintragen</h2>

<p>Das Spielergebnis tragt Ihr bitte im Kommentar in euren Spieltermin im Platzbuchungssystem ein. Dazu einfach auf dein 
Spiel klicken/tippen und das Ergebnis in das Kommentarfeld eintragen.</p>

<p>Die Spielergebnisse werden durch die Turnierleitung regelmäßig in den Online-Spielplan übertragen. 
Die im Clubheim aushängenden Spielpläne werden wöchentlich neu ausgedruckt.</p>

<h2>Nach dem Spiel ist vor dem Spiel</h2>

<p>Bitte schaut nach jedem Spiel im Spielplan nach, wie es für Euch weiter geht und nehmt wiederum 
zeitnah Kontakt mit dem nächsten Spielpartner auf. </p>

<h2>Finaltag – Siegerehrung</h2>

<p>Die Halbfinal- und Finalspiele finden am (wird noch festgelegt)) statt.
<p>Die Sieger werden im Rahmen der Players & Friends – Night geehrt. Diesen Termin sollten sich bitte alle Teilnehmer 
  und auch Nicht-Teilnehmer freihalten. Wie das genau abläuft, geben wir noch bekannt. UNsere urprüngliche vor-Corona-Planung müssen wir noch anpassen.


LG Norbert


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