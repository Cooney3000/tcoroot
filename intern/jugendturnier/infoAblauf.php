<?php 
session_start();
require_once("../inc/config.inc.php");
require_once("../inc/functions.inc.php");
require_once("../inc/permissioncheck.inc.php");

$user = check_user();

$title = "Platzbuchung Clubturnier - Anleitung";
include("../templates/header.inc.php");
$kw = "champ2020";
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
 Nachrichten etwas einzudämmen. </p>

<h2>Terminvereinbarung</h2>

<p>Wenn eine Partie feststeht, dann vereinbart bitte schnell mit 
  eurem Partner den Spieltermin und tragt ihn sofort ein, auch wenn das Spiel erst später stattfinden kann. <strong>Damit 
    erleichtert Ihr uns die Turnierplanung enorm, weil 
  wir dann sehen können, dass Ihr euch abgesprochen habt.</strong> 
 Bitte wendet euch bei der Terminvereinbarung direkt an den Spielpartner und nutzt dafür nicht 
 die WhatsApp-Gruppe. 
 
 <p>Die <strong>Telefonnummer des Partners findet Ihr <a href="bereitsAngemeldet.php">hier</a></strong>.</p>
 
 <p>Der Spieltermin muss im <strong><a href="../tafel/" target="_blank">Platzbuchungssystem</a></strong> als Spielart 
 "Turnier" mit einer Spieldauer von 2 Stunden eingetragen werden.</p>

 <p>Wenn Ihr das Spiel in der Platzbuchung eingetragen habt, erscheint es automatisch in der Liste der Begegnungen.</p>

<p>Die Spiele sollten nach Möglichkeit an Freitagen, Feiertagen und Wochenenden stattfinden. 
Auch während der Punktspielsaison sind an den Wochenenden fast immer Plätze verfügbar.  
Soweit möglich, sollten die Spiele auf Platz 1 stattfinden.</p>

<h2>Der Spieltag</h2>

<p>Bitte seid pünktlich zur vereinbarten Zeit spielbereit. Die Erfahrung aus dem letzten Jahr zeigt, dass 
immer wieder Interessierte zum Zuschauen vorbeikommen, bitte nutzt auch deshalb die grünen Ergebnistafeln. 
Ihr findet sie im Vereinsheim.</p>

<p><strong>Bälle</strong> bringt jeder selbst mit. Grundsätzlich ist als Turnierball der für Punktspiele und 
Turniere vorgesehene Dunlop-Ball btv 1.0 zu verwenden. Ihr könnt euch aber auch auf jeden anderen 
Ball einigen. Die Bälle sollten neu oder neuwertig sein, aber auch hierbei könnt Ihr euch einfach 
absprechen.</p>

<p>Gespielt wird nach den üblichen Regeln: 2 Gewinnsätze, die beiden ersten Sätze normal (bei 6:6 Tiebreak), 
der 3. Satz als Matchtiebreak bis 10. </p>

<h2>Spielergebnis eintragen</h2>

<p>Das Spielergebnis tragt Ihr bitte im Kommentar in euren Spieltermin im Platzbuchungssystem ein. Dazu einfach auf dein 
Spiel klicken/tippen und das Ergebnis in das Kommentarfeld eintragen.</p>

<p>Die Spielergebnisse werden durch die Turnierleitung regelmäßig in den Online-Spielplan übertragen.</p>

<h2>Nach dem Spiel ist vor dem Spiel</h2>

<p>Bitte schaut nach jedem Spiel im Spielplan nach, wie es für euch weiter geht und nehmt wiederum 
zeitnah Kontakt mit dem nächsten Spielpartner auf. </p>

<h2>Finaltag – Siegerehrung</h2>

<p>Die Finalspiele finden nach Möglichkeit am 25. September 2020 statt.
<p>Die Sieger werden im Rahmen der Players & Friends–Night geehrt (2020, wenn Corona es zulässt, oder 2021). 


LG Norbert

<?php 
include("../templates/footer.inc.php")
?>