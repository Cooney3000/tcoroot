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
  <li><a href="bereitsAngemeldet.php?order=0">Nach Anmeldezeitpunkt (älteste zuerst)</a>          <a href="turnierCSVexport.php?order=0">Excel Export</a></li>
  <li><a href="bereitsAngemeldet.php?order=1">Nach LK, Anmeldezeitpunkt (älteste zuerst)</a>      <a href="turnierCSVexport.php?order=1">Excel Export</a></li>
  <li><a href="bereitsAngemeldet.php?order=3">Nach Zusage</a>                                     <a href="turnierCSVexport.php?order=3">Excel Export</a></li>
</ul> -->
<?php

$order = ["t.created_at ASC", 
          "LK ASC, t.created_at ASC", 
          "willing_to_play DESC, nachname ASC, vorname ASC"];

// if (isset($_GET["order"])) {
//   $orderIndex = $_GET["order"];
// } else {
//   $orderIndex = 0;
// }
$orderIndex = 2;

$orderSQL = $order[$orderIndex];

$sql = "SELECT * FROM users u, tournament_players t where u.id = user_id ORDER BY ".$orderSQL;
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
          <th>Tel</th>
          <th>Spielt</th>
          <th>Komm.</th>
        </tr>
      </thead>
<?php
  $gw = "###first###";
  $order = ['created_at', 'lk', 'lk', 'lk', 'willing_to_play'];
  $lfd = 1;
  while($row = $statement->fetch()) {
    // Gruppenwechsel - Trennlinie
    // if ( ($orderIndex != 0) && ($gw != $row[$order[$orderIndex]]) ) {
    //   if ($gw != "###first###") {
    //     echo '<tr style="background-color: black"><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><//tr>';
    //   }
    //   $gw = $row[$order[$orderIndex]];
    //   $lfd = 1;
    // }
?>
        <tr>
          <td><?=$lfd++?></td>
          <td><?= $row['nachname'] . ' ' . $row['vorname'] ?></td>
          <!-- <td><?=substr($row['created_at'],8,2).'.'.substr($row['created_at'],5,2).'.'?></td> -->
          <td><?=$row['lk']?></td>
          <td><?=$row['mobil']?></td>
          <td class="text-center"><?=$row['willing_to_play']===NULL?'---':$row['willing_to_play']==='1'?'J':'N'?></td>
          <td><?=$row['comment']?></td>
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