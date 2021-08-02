<?php 
session_start();
require_once("../inc/config.inc.php");
require_once("../inc/functions.inc.php");
require_once("../inc/permissioncheck.inc.php");

//Überprüfe, dass der User eingeloggt und berechtigt ist
$user = check_user();

$title = "Turnierspieler bearbeiten";
include("../templates/header.inc.php");
if (checkPermissions(T_ALL_PERMISSIONS | T_ALL_PERMISSIONS) ) 
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
$delimiter = '#';
  // Spielerliste erzeugen
  ?>
  <table class="table table-light tbl-small">
    <tr>
      <th>#</th>
      <th>
        Spielername<br>
        <a class="fas fa-angle-up fa-1x" href="bereitsAngemeldetEdit.php?o=spielername&dir=asc"></a>&nbsp;&nbsp;
        <a class="fas fa-angle-down fa-1x" href="bereitsAngemeldetEdit.php?o=spielername&dir=desc"></a>
      </th>
      <th>Kat<br>
        <a class="fas fa-angle-up fa-1x" href="bereitsAngemeldetEdit.php?o=category&dir=asc"></a>&nbsp;&nbsp;
        <a class="fas fa-angle-down fa-1x" href="bereitsAngemeldetEdit.php?o=category&dir=desc"></a>
      </th>
      <th>Mobil</th>
      <th>Spielt</th>
      <th>Kommentar</th>
      <th>Anm-Dat<br>
        <a class="fas fa-angle-up fa-1x" href="bereitsAngemeldetEdit.php?o=created_at&dir=asc"></a>&nbsp;&nbsp;
        <a class="fas fa-angle-down fa-1x" href="bereitsAngemeldetEdit.php?o=created_at&dir=desc"></a>
      </th>
      <th>Aktionen</th>
    </tr> 
  <?php
  $tournament_id = $CONFIG['activeTournament'];

  $order = (isset($_GET['o'])) ? $_GET['o'] : 'u.id';
  $direction = (isset($_GET['dir'])) ? $_GET['dir'] : 'asc';

  $sql = <<<EOT
  SELECT
  t.*,
  CONCAT(u.nachname, ' ', u.vorname) AS spielername,
  u.mobil AS mobil,
  u.id as uid,
  t.id AS tid,
  t.created_at AS created_at
FROM users AS u
  LEFT JOIN tournament_players AS t 
ON u.id = t.user_id
WHERE u.id>=200 AND (t.tournament_id=$tournament_id) AND (u.status='A')
  ORDER BY t.willing_to_play DESC, $order $direction
EOT;

if (DEBUG) error_log('['. basename($_SERVER['PHP_SELF']) . "\r\n$sql");
date_default_timezone_set('UTC');

  foreach ($pdo->query($sql) as $row) {
    $strDate = date('d.m. h:i', strtotime ($row['created_at']));
    
    ?>
      <tr>
        <td class="align-middle form-control-sm" ><?= $row['uid'] ?></td> 
        <td class="align-middle form-control-sm" style="width: auto"><?= $row['spielername'] ?></td>
        <td class="align-middle"><input class="form-control form-control-sm" style="width: 3rem" onchange="hasChanged(this)"     id="<?= $row['tid'] . $delimiter . 'category'          . $delimiter . $row['uid']   ?>"  type="text" value="<?= $row['category'] ?>"/></td>
        <td class="align-middle"><input class="form-control form-control-sm" style="width: 7rem" onchange="hasChangedUser(this)" id="<?= $row['uid'] . $delimiter . 'mobil'             . $delimiter . $row['mobil'] ?>"  type="text" value="<?= $row['mobil'] ?>"/></td>
        <td class="align-middle"><input class="form-control form-control-sm" style="width: 3rem" onchange="hasChanged(this)"     id="<?= $row['tid'] . $delimiter . 'willing_to_play'   . $delimiter . $row['uid']   ?>"  type="text" value="<?= $row['willing_to_play'] ?>"/></td>
        <td class="align-middle"><input class="form-control form-control-sm" style="width: 7rem" onchange="hasChanged(this)"     id="<?= $row['tid'] . $delimiter . 'comment'           . $delimiter . $row['uid']   ?>"  type="text" value="<?= $row['comment'] ?>"/></td>
        <td class="align-middle form-control-sm" style="width: auto"><?= $strDate ?></td>
        <td class="align-middle">
<?php
    if ( ! is_null($row['willing_to_play'])) {
?>
        <button type="submit" class="btn btn-warning btn-sm" style="width: 5rem" onclick="hasChanged(this)"     id="<?= $row['tid'] . $delimiter . 'rs'             . $delimiter . $row['uid']   ?>"  type="text">Reset</button></td>
<?php 
    }
?>
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
  const uid = "&uid=" + p[2];
  const v = "&v=" + e.value;
  const url = "/intern/api/turnierspieler.php?" + id + col + v + uid;
  // console.log(url);
  fetch(url, {credentials: 'same-origin'})
    .then(result => {
      if (result.ok) {
        // console.log(result);
        location.reload(false);
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
