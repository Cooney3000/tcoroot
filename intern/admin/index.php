<?php
session_start();
require_once("../inc/config.inc.php");
require_once("../inc/functions.inc.php");
require_once("../inc/permissioncheck.inc.php");

$user = check_user();

if (!checkPermissions(PERMISSIONS::VORSTAND)) {
  echo ("<html><body>");
  console_log("Für diese Seite besitzt du leider nicht die nötige Berechtigung");
  echo ("</body></html>");
  die("Keine Berechtigung");
}

$title = "TCO Home ";
include("header.inc.php");
?>
<script>
  // var element = document.getElementById("nav-intern");
  // element.classList.add("active");
  // document.getElementById("nav-intern").classList.remove("active");
  // document.getElementById("nav-einstellungen").classList.remove("active");
  // document.getElementById("nav-turnier").classList.add("active");
  // document.getElementById("nav-tafel").classList.remove("active");
  // document.getElementById("nav-login").classList.remove("active");
  // document.getElementById("nav-logout").classList.remove("active");
</script>

<div class="container main-container">
  <h2 class="text-white bg-dark">Berechtigungen vergeben</h2>

  <div class="container mt-4">
    <div class="row">

      <div class="col-sm">
        <div class="h-100 bg-light p-2">
          <a class="btn btn-success w-100" href="woandershin.php">Woanders</a>
          <h5 class="h-25 m-2">Woandershin...</h5>
          <p class="h-25 pl-2">Wer eigentlich ....</p>
        </div>
      </div>
    </div>
  </div> <!-- row -->

</div> <!-- container -->
<br>

<?php
  $delimiter = '#';
  // Spielerliste erzeugen
?>
  <table class="table table-bordered table-light tbl-small">
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
      <th>LK<br>
        <a class="fas fa-angle-up fa-1x" href="bereitsAngemeldetEdit.php?o=LK&dir=asc"></a>&nbsp;&nbsp;
        <a class="fas fa-angle-down fa-1x" href="bereitsAngemeldetEdit.php?o=LK&dir=desc"></a>
      </th>
      <th>Spielt<br>
        <a class="fas fa-angle-up fa-1x" href="bereitsAngemeldetEdit.php?o=willing_to_play&dir=asc"></a>&nbsp;&nbsp;
        <a class="fas fa-angle-down fa-1x" href="bereitsAngemeldetEdit.php?o=willing_to_play&dir=desc"></a>
      </th>
      <th>Kommentar</th>
      <th>Anm-Dat<br>
        <a class="fas fa-angle-up fa-1x" href="bereitsAngemeldetEdit.php?o=created_at&dir=asc"></a>&nbsp;&nbsp;
        <a class="fas fa-angle-down fa-1x" href="bereitsAngemeldetEdit.php?o=created_at&dir=desc"></a>
      </th>
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
WHERE u.id>=200 AND (t.tournament_id=$tournament_id OR t.tournament_id IS NULL) AND (u.status='W' OR u.status='A')
  ORDER BY $order $direction
EOT;

if (DEBUG) error_log('['. basename($_SERVER['PHP_SELF']) . "\r\n$sql");

foreach ($pdo->query($sql) as $row) {
?>
    <tr>
      <td><?= $row['uid'] ?></td> 
      <td style="width: auto"><?= $row['spielername'] ?></td>
      <td><input class="rounded" style="width: 3rem" onchange="hasChanged(this)"     id="<?= $row['tid'] . $delimiter . 'category'          . $delimiter . $row['uid']   ?>"  type="text" value="<?= $row['category'] ?>"/></td>
      <td><input class="rounded border-success" style="width: 7rem" onchange="hasChangedUser(this)" id="<?= $row['uid'] . $delimiter . 'mobil'             . $delimiter . $row['mobil'] ?>"  type="text" value="<?= $row['mobil'] ?>"/></td>
      <td><input class="rounded border-success" style="width: 3rem" onchange="hasChanged(this)"     id="<?= $row['tid'] . $delimiter . 'LK'                . $delimiter . $row['uid']   ?>"  type="text" value="<?= $row['lk'] ?>"/></td>
      <td><input class="rounded border-success" style="width: 3rem" onchange="hasChanged(this)"     id="<?= $row['tid'] . $delimiter . 'willing_to_play'   . $delimiter . $row['uid']   ?>"  type="text" value="<?= $row['willing_to_play'] ?>"/></td>
      <td><input class="rounded border-success" style="width: 5rem" onchange="hasChanged(this)"     id="<?= $row['tid'] . $delimiter . 'comment'           . $delimiter . $row['uid']   ?>"  type="text" value="<?= $row['comment'] ?>"/></td>
      <td><?= $row['created_at'] ?></td>
    </tr>
<?php
}
?>
</table>

<?php
  include("footer.inc.php");
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
