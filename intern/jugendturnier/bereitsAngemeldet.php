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

<?php

$order = [
  "nachname ASC, vorname ASC" => "nachname DESC, vorname DESC", 
  "LK ASC, t.created_at ASC" => "t.LK DESC, t.created_at ASC",
  "t.created_at ASC" => "t.created_at DESC"
  ];

$orderSQL = array_keys($order)[0];
if (isset($_GET['o'])) {
  for($i = 0; $i < count($order); $i++) {
    if ($i == $_GET['o']) {
      $orderSQL = ($_GET['dir'] == 'asc') ? array_keys($order)[$i] : array_values($order)[$i];
    }
  }
}

$sql = "SELECT * FROM users u, tournament_players t WHERE u.id = user_id AND willing_to_play = 1 AND t.tournament_id = " .$CONFIG['activeTournamentJ']. " ORDER BY ".$orderSQL;
TLOG(DBG, $sql, __LINE__);

$statement = $pdo->prepare($sql);
$result = $statement->execute();
if($result) {
?>
    <br>
    <div class="mx-3">
    <table class="table table-striped tbl-small">
      <thead>
        <tr>
          <th>#</th>
          <th>Spieler/in<br>
            <a class="fas fa-angle-up fa-1x" href="bereitsAngemeldet.php?o=0&dir=asc"></a>&nbsp;&nbsp;
            <a class="fas fa-angle-down fa-1x" href="bereitsAngemeldet.php?o=0&dir=desc"></a>
          </th>
          <th>Anm.
            <a class="fas fa-angle-up fa-1x" href="bereitsAngemeldet.php?o=2&dir=asc"></a>&nbsp;&nbsp;
            <a class="fas fa-angle-down fa-1x" href="bereitsAngemeldet.php?o=2&dir=desc"></a>
          </th>
          <th>LK<br>
            <a class="fas fa-angle-up fa-1x" href="bereitsAngemeldet.php?o=1&dir=asc"></a>&nbsp;&nbsp;
            <a class="fas fa-angle-down fa-1x" href="bereitsAngemeldet.php?o=1&dir=desc"></a>
          </th>
          <th>Telefon<br>
          </th>
          <th>Komm.</th>
        </tr>
      </thead>
<?php
  $gw = "###first###";
  $order = ['nachname', 'lk', 'created_at'];
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
          <td><?=substr($row['created_at'],8,2).'.'.substr($row['created_at'],5,2).'.'?></td>
          <td><?=$row['lk']?></td>
          <td><?=$row['mobil']?></td>
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