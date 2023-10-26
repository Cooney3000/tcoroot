<?php 
session_start();
require_once("../inc/config.inc.php");
require_once("../inc/functions.inc.php");
require_once("../inc/permissioncheck.inc.php");

//Überprüfe, dass der User eingeloggt und berechtigt ist
$user = check_user();

$title = "Norberts Seite";
include("../inc/header.inc.php");
if (checkPermissions(T_ALL_PERMISSIONS) ) 
{
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

  <h1>Wer noch nicht registriert ist</h1>

<?php
  $sql = <<<EOT
    SELECT u.id as id, t1.spielername as p, t1.comment4 as c, u.vorname as vn, u.nachname as nn
      FROM users AS u 
      RIGHT JOIN tournament_players AS t1 ON CONCAT(UPPER(u.nachname), " ", UPPER(u.vorname)) = t1.spielername
      ORDER BY u.nachname,t1.spielername
EOT;
  $statement = $pdo->prepare($sql);
  $result = $statement->execute();
  if($result) {
?>
    <br>
    <div class="mx-3">
    <table class="table table-bordered table-light tbl-small">
<?php
    $lfd = 1;
    while($row = $statement->fetch()) {
      if (is_null($row['vn'])) {
?>
        <tr style="height:1.3rem">
          <td><?=$lfd++?></td>
          <td><?=$row['p']?></td>
          <td><?=$row['c']?></td>
        </tr>
<?php
      }
    }
    echo '</table>';
  } else {
    echo 'Beim Lesen der Daten ist leider ein Fehler aufgetreten. Bitte benachrichtige conny.roloff@tcolching.de<br>';
  }

?>
  </div>
<?php 
  include("../inc/footer.inc.php");
}
?>