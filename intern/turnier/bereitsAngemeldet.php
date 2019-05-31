<?php 
session_start();
require_once("../inc/config.inc.php");
require_once("../inc/functions.inc.php");
require_once("../inc/permissioncheck.inc.php");

//Überprüfe, dass der User eingeloggt und berechtigt ist
$user = check_user();

$title = "Angemeldete Spieler";
include("../templates/header.inc.php")
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

<h1>Turnierteilnehmer</h1>
<!-- <ul>
  <li><a href="bereitsAngemeldet.php?order=0">Nach Anmeldezeitpunkt (älteste zuerst)</a>                 <a href="turnierCSVexport.php?order=0">Excel Export</a></li>
  <li><a href="bereitsAngemeldet.php?order=1">Nach Kategorie, Anmeldezeitpunkt (älteste zuerst)</a>      <a href="turnierCSVexport.php?order=1">Excel Export</a></li>
  <li><a href="bereitsAngemeldet.php?order=2">Nach Kategorie, LK, Anmeldezeitpunkt (älteste zuerst)</a>  <a href="turnierCSVexport.php?order=2">Excel Export</a></li>
  <li><a href="bereitsAngemeldet.php?order=3">Nach Kategorie, Nachname, Vorname</a>                      <a href="turnierCSVexport.php?order=3">Excel Export</a></li>
</ul> -->
<?php

$order = ["created_at ASC", 
          "category, created_at ASC", 
          "category, LK ASC, created_at ASC", 
          "category, spielername ASC", 
          "zusage DESC"];

// if (isset($_GET["order"])) {
//   $orderIndex = $_GET["order"];
// } else {
//   $orderIndex = 0;
// }
$orderIndex = 3;

$orderSQL = $order[$orderIndex];

$sql = "SELECT * FROM tournament_players ORDER BY ".$orderSQL;
// error_log("Angemeldete Spieler: ".$sql);
$statement = $pdo->prepare($sql);
$result = $statement->execute();
if($result) {
?>
    <br>
    <div class="mx-3">
    <table class="table table-bordered table-light tbl-small">
      <thead>
        <tr>
          <th>#</th>
          <th>Spieler/in</th>
          <!-- <th>Anm.</th> -->
          <!-- <th>Zusage</th> -->
          <th>LK</th>
          <th>Kat</th>
          <th>15.6.?</th>
          <th>Fr</th>
          <th>21.9.</th>
          <th>Tel</th>
          <th>Sonst</th>
        </tr>
      </thead>
<?php
  $gw = "###first###";
  $order = ['created_at', 'category', 'category', 'category', 'zusage'];
  $lfd = 1;
  while($row = $statement->fetch()) {
    if ( ($orderIndex != 0) && ($gw != $row[$order[$orderIndex]]) ) {
      if ($gw != "###first###") {
        echo '<tr style="background-color: black"><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><//tr>';
      }
      $gw = $row[$order[$orderIndex]];
      $lfd = 1;
    }
?>
        <tr>
          <td><?=$lfd++?></td>
          <td><?=$row['spielername']?></td>
          <!-- <td><?=substr($row['created_at'],8,2).'.'.substr($row['created_at'],5,2).'.'?></td> -->
          <!-- <td><?=$row['zusage']?></td> -->
          <td><?=$row['LK']?></td>
          <td><?=$row['category']?></td>
          <td><?=$row['comment1']?></td>
          <td><?=$row['comment2']?></td>
          <td><?=$row['comment3']?></td>
          <td><?=$row['comment4']?></td>
          <td><?=$row['comment5']?></td>
        </tr>
<?php
  }
  echo '</table>';
} else {
  echo 'Beim Lesen der Daten ist leider ein Fehler aufgetreten. Bitte benachrichtige conny.roloff@tcolching.de<br>';
}

?>
</div>
<?php 
include("../templates/footer.inc.php")
?>