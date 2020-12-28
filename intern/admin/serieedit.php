<?php
session_start();
require_once("../inc/config.inc.php");
require_once("../inc/functions.inc.php");
require_once("../inc/permissioncheck.inc.php");

$user = check_user();

if (!checkPermissions(MANNSCHAFTSFUEHRER)) {
  echo ("<html><body>");
  TECHO(DBG, "Für diese Seite besitzt du leider nicht die nötige Berechtigung", __LINE__);
  echo ("</body></html>");
  die("Keine Berechtigung");
}

$title = "TCO Serie erfassen ";
include("header.inc.php");
$menuid = "nav-" . getFilename(__FILE__);
?>
<script>
  document.getElementById("<?= $menuid ?>").classList.add("active");
</script>



<div class="container main-container">
  <h2 class="h1">Serienbuchung eingeben</h2>

  <div class="container mt-4">
    <div class="row">

      <!-- <div class="col-sm">
        <div class="h-100 bg-light p-2">
          <a class="btn btn-success w-100" href="woandershin.php">Woanders</a>
          <h5 class="h-25 m-2">Woandershin...</h5>
          <p class="h-25 pl-2">Wer eigentlich ....</p>
        </div>
      </div> -->
    </div>
  </div> <!-- container -->

  <br>

  <div class="container mt-4">
    <div class="row">

<!- Buchungsliste -->

  <table class="table table-bordered table-light tbl-small">
    <tr>
      <th>ID<br>
        <a class="fas fa-angle-up fa-1x" href="permissionsedit2.php?o=uid&dir=asc"></a>&nbsp;&nbsp;
        <a class="fas fa-angle-down fa-1x" href="permissionsedit2.php?o=uid&dir=desc"></a>
      </th>
      <th>
        Spielername<br>
        <a class="fas fa-angle-up fa-1x" href="permissionsedit2.php?o=spielername&dir=asc"></a>&nbsp;&nbsp;
        <a class="fas fa-angle-down fa-1x" href="permissionsedit2.php?o=spielername&dir=desc"></a>
      </th>
      <th>Berechtigung<br>
        <a class="fas fa-angle-up fa-1x" href="permissionsedit2.php?o=permname&dir=asc"></a>&nbsp;&nbsp;
        <a class="fas fa-angle-down fa-1x" href="permissionsedit2.php?o=permname&dir=desc"></a>
      </th>
    </tr> 

<?php

  $order = (isset($_GET['o'])) ? $_GET['o'] : 'u.id';
  $direction = (isset($_GET['dir'])) ? $_GET['dir'] : 'asc';

  $sql = <<<EOT
  SELECT
    b.id AS id, 
    b.starts_at AS Start,
    b.ends_at AS End,
    b.booking_type AS btype,
    b.comment AS comment,
    b.player1 AS sp1,
    b.player2 AS sp2,
    b.player1 AS sp3,
    b.player2 AS sp4,
    p1.vorname AS pv1,
    p2.vorname AS pv2,
    p3.vorname AS pv3,
    p4.vorname AS pv4,
    p1.nachname AS pn1,
    p2.nachname AS pn2,
    p3.nachname AS pn3,
    p4.nachname AS pn4
  FROM bookings AS b 
  LEFT JOIN users AS p1 ON b.player1 = p1.id
  LEFT JOIN users AS p2 ON b.player2 = p2.id
  LEFT JOIN users AS p3 ON b.player3 = p3.id
  LEFT JOIN users AS p4 ON b.player4 = p4.id
  WHERE b.booking_state='A' AND (b.starts_at > '$start' AND b.ends_at > '$ende' AND ) <<<<<< ##################################
    ORDER BY $order $direction
EOT;


// Ein Array füllen für die möglichen Berechtigungsstufen

$sqlperm = "SELECT * FROM permissionnames";
$perm_array = Array();

foreach ($pdo->query($sqlperm) as $row) {
  $perm_array [$row['pattern']] = $row['value'];
}


foreach ($pdo->query($sql) as $row) {
?>
    <tr>
      <td><?= $row['uid'] ?></td> 
      <td style="width: auto"><?= $row['spielername'] ?></td>
<?php
/*
      <td><input class="rounded" style="width: 3rem" onchange="hasChanged(this)"     id="<?= $row['tid'] . $delimiter . 'category'          . $delimiter . $row['uid']   ?>"  type="text" value="<?= $row['category'] ?>"/></td>
*/
?>
      <td> 
        <select class="custom-select custom-select-sm" id="<?= $row['uid'] ?>" onchange="hasChanged(this)">
          <option value="0">---</option>
<?php
    foreach(array_keys($perm_array) as $pattern) {
        $selected = ($pattern == $row['perm']) ? ' selected' : '';
        echo ("<option". $selected .' value="'. $pattern .'">'. $perm_array[$pattern] . "</option>\r\n");
    }
?>
        </select>    
      </td>
</tr>
<?php
}

?>
  </table>
</div> <!-- container -->
<?php
  include("footer.inc.php");
?>

<!-- <script>
function hasChanged(e) {
  const uid = "uid=" + e.id;
  const col = "&col=" + 'permissions';
  const v = "&v=" + e.value;
  const url = "/intern/api/permissionUpdate.php?" + uid + col + v;
  fetch(url, {credentials: 'same-origin'})
    .then(result => {
      if (result.ok) {
        location.reload(false);
        return true;
      } else {
        throw new Error('Fehler beim Erzeugen/Updaten der Daten' + this.state.r.id);
      }
    });
}

</script> -->
