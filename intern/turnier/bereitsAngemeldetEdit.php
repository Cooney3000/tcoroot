<?php 
session_start();
require_once("../inc/config.inc.php");
require_once("../inc/functions.inc.php");
require_once("../inc/permissioncheck.inc.php");

//Überprüfe, dass der User eingeloggt und berechtigt ist
$user = check_user();

$title = "Turnierspieler bearbeiten";
include("../templates/header.inc.php");
if (checkPermissions(PERMISSIONS::T_ALL_PERMISSIONS) ) 
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

<div class="container main-container">
  <h1>Turnierspieler bearbeiten</h1>

  
  <?php
$delimiter = '§$%';
  // Spielerliste erzeugen
  ?>
  <table class="table table-bordered table-light tbl-small">
    <tr>
      <th>#</th>
      <th>Spielername</th>
      <th>Kat</th>
      <th>Mobil</th>
      <th>LK</th>
      <th>Spielt</th>
      <th>Kom</th>
    </tr> 
  <?php
  $sql = <<<EOT
  SELECT 
      t.*,
      CONCAT(u.nachname, ' ', u.vorname) AS spielername,
      u.mobil AS mobil,
      u.id as uid
    FROM tournament_players AS t
    LEFT JOIN users AS u ON u.id = t.user_id
   WHERE t.tournament_id = 3 ORDER BY spielername
EOT;
  // error_log($sql);

  foreach ($pdo->query($sql) as $row) {
    ?>
      <tr>
        <td><?= $row['uid'] ?></td> 
        <td style="width: auto"><?= $row['spielername'] ?></td>
        <td><input class="rounded border-success" style="width: 3rem" onchange="hasChanged(this)" id="<?= $row['id'] . $delimiter . 'category' ?>" type="text" value="<?= $row['category'] ?>"/></td>
        <td><input class="rounded border-success" style="width: 7rem" onchange="hasChangedUser(this)" id="<?= $row['uid'] . $delimiter . 'mobil' ?>" type="text" value="<?= $row['mobil'] ?>"/></td>
        <td><input class="rounded border-success" style="width: 3rem" onchange="hasChanged(this)" id="<?= $row['id'] . $delimiter . 'LK' ?>" type="text" value="<?= $row['lk'] ?>"/></td>
        <td><input class="rounded border-success" style="width: 3rem" onchange="hasChanged(this)" id="<?= $row['id'] . $delimiter . 'willing_to_play' ?>" type="text" value="<?= $row['willing_to_play'] ?>"/></td>
        <td><input class="rounded border-success" style="width: 5rem" onchange="hasChanged(this)" id="<?= $row['id'] . $delimiter . 'comment' ?>" type="text" value="<?= $row['comment'] ?>"/></td>
      </tr>
<?php
  }
?>
</table>
<?php
} // check_permissions
include("../templates/footer.inc.php");
?>

<script>
function hasChanged(e) {
  const p = e.id.split('<?= $delimiter ?>');
  const id = "i=" + p[0];
  const col = "&col=" + p[1];
  const v = "&v=" + e.value;
  const url = "/intern/api/turnierspieler.php?" + id + col + v;
  // console.log(url);
  fetch(url, {credentials: 'same-origin'})
    .then(result => {
      if (result.ok) {
        // console.log(result);
        return true;
      } else {
        throw new Error('Fehler beim Erzeugen/Updaten der Daten' + this.state.r.id);
      }
    });
}

function hasChangedUser(e) {
  const p = e.id.split('<?= $delimiter ?>');
  const id = "i=" + p[0];
  const col = "&col=" + p[1];
  const v = "&v=" + e.value;
  const url = "/intern/api/userUpdate.php?" + id + col + v;
  // console.log(url);
  fetch(url, {credentials: 'same-origin'})
    .then(result => {
      if (result.ok) {
        // console.log(result);
        return true;
      } else {
        throw new Error('Fehler beim Erzeugen/Updaten der Daten' + this.state.r.id);
      }
    });
}
</script>
