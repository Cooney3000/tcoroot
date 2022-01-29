<?php
session_start();
require_once("../inc/config.inc.php");
require_once("../inc/functions.inc.php");
require_once("../inc/permissioncheck.inc.php");

$user = check_user();

if (!checkPermissions(T_ALL_PERMISSIONS)) {
  echo ("<html><body>");
  TECHO(DBG, "Für diese Seite besitzt du leider nicht die nötige Berechtigung", __LINE__);
  echo ("</body></html>");
  die("Keine Berechtigung");
}

$title = "TCO Serie bearbeiten";
include("header.inc.php");
$menuid = "nav-serieedit";
?>
<script>
  document.getElementById("<?= $menuid ?>").classList.add("active");
</script>


<?php
$userid = $user['id'];
$sid = isset($_GET['sid']) ? $_GET['sid'] : $_POST['sid'];

$yyyy = date("Y");
$buttonkey = "";
foreach(['deleteSeries', 'deleteRow'] as $k) {
  if (isset($_POST[$k])) {
    $buttonkey = $k;
  }
}
// TECHO (DEBUG, "$k\r\n");
// TECHO (DEBUG, http_build_query($_POST)."\r\n");
$sql = "";
if ($buttonkey == "deleteSeries") {
  $sql = "DELETE FROM bookings WHERE starts_at LIKE '$yyyy%' AND series_id = '$sid'";
  $sql2 = "DELETE FROM seriesnames WHERE series_id = '$sid'";
  $pdo->query($sql2);
}
else if ($buttonkey == "deleteRow") {
  $deleteId = $_POST[$buttonkey];
  $sql = "DELETE FROM bookings WHERE starts_at LIKE '$yyyy%' AND id = '$deleteId'";
}
if ($sql != "") $pdo->query($sql);
?>

<div class="container main-container">
  <form action="seriedetails.php" method="post">
    <input name="sid" type="hidden" value="<?= $sid ?>">
    <h1>Serienbuchung - Detailansicht</h1>
    <h2><?= $sid ?> <button type="submit" name="deleteSeries" value="<?= $sid ?>" class="btn btn-secondary py-0" >Ganze Serie Löschen</button></h2>
    <table class="table table-light tbl-small">
      <thead>
        <tr>
          <th>Datum</th>
          <th>Zeit&nbsp;von&nbsp;bis</th>
          <th>Typ</th>
          <th>Platz</th>
          <th>Spieler 1</th>
          <th>Kommentar</th>
          <th>Aktion</th>
        </tr>
      </thead>
      <tbody>
        <?php

        $sql = <<<EOT
      SELECT b.id as id,
      b.series_id AS series_id, 
             b.starts_at as Start, 
             b.ends_at AS End,
             b.booking_type AS bt,
             b.court AS court,
             u.vorname AS Vorname,
             u.nachname AS Nachname,
             b.comment AS comment
      FROM  bookings AS b 
      LEFT JOIN users AS u ON b.player1 = u.id
      WHERE  b.series_id = '$sid' AND b.starts_at LIKE '{$yyyy}%'
      ORDER BY b.starts_at
EOT;
// TLOG (DEBUG, "$sql\r\n", __LINE__);

foreach ($pdo->query($sql) as $row) {
          $strDatum = date('d.m.Y', strtotime($row['Start']));
          $strZeit = date('H:i', strtotime($row['Start'])) . '-' . date('H:i', strtotime($row['End']));

        ?>
          <tr>
            <td class="align-middle form-control-sm" style="width: auto"><?= $strDatum ?></td>
            <td class="align-middle form-control-sm" style="width: auto"><?= $strZeit ?></td>
            <td class="align-middle form-control-sm" style="width: auto"><?= ucfirst(substr($row['bt'], 3)) ?></td>
            <td class="align-middle form-control-sm" style="width: auto"><?= $row['court'] ?></td>
            <td class="align-middle form-control-sm" style="width: auto"><?= $row['Vorname'] . ' ' . $row['Nachname'] ?></td>
            <td class="align-middle form-control-sm" style="width: auto"><?= $row['comment'] ?></td>
            <td class="align-middle form-control-sm" style="width: auto"><button type="submit" name="deleteRow" value="<?= $row['id'] ?>" class="btn btn-danger btn-sm btn-block py-0">Löschen</button></td>
          </tr>
        <?php
        }
        ?>
      </tbody>
    </table>
  </form>
  <a href="serieedit.php">Neue Buchung</a>
</div>
<?php
include("footer.inc.php");
?>