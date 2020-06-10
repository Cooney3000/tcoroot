<?php
session_start();
require_once("../inc/config.inc.php");
require_once("../inc/functions.inc.php");
require_once("../inc/permissioncheck.inc.php");

$user = check_user();

if (!checkPermissions(PERMISSIONS::VORSTAND)) {
  echo ("<html><body>");
  TECHO(DBG, "Für diese Seite besitzt du leider nicht die nötige Berechtigung", __LINE__);
  echo ("</body></html>");
  die("Keine Berechtigung");
}

$title = "TCO Berechtigungen ";
include("header.inc.php");
$menuid = "nav-" . getFilename(__FILE__);
?>
<script>
  document.getElementById("<?= $menuid ?>").classList.add("active");
</script>



<div class="container main-container">
  <h2 class="h1">Berechtigungsvergabe</h2>

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

<!- Benutzerliste -->

  <table class="table table-bordered table-light tbl-small">
    <tr>
      <th>ID<br>
        <a class="fas fa-angle-up fa-1x" href="index.php?o=uid&dir=asc"></a>&nbsp;&nbsp;
        <a class="fas fa-angle-down fa-1x" href="index.php?o=uid&dir=desc"></a>
      </th>
      <th>
        Spielername<br>
        <a class="fas fa-angle-up fa-1x" href="index.php?o=spielername&dir=asc"></a>&nbsp;&nbsp;
        <a class="fas fa-angle-down fa-1x" href="index.php?o=spielername&dir=desc"></a>
      </th>
      <th>Berechtigung<br>
        <a class="fas fa-angle-up fa-1x" href="index.php?o=permname&dir=asc"></a>&nbsp;&nbsp;
        <a class="fas fa-angle-down fa-1x" href="index.php?o=permname&dir=desc"></a>
      </th>
    </tr> 

<?php

  $order = (isset($_GET['o'])) ? $_GET['o'] : 'u.id';
  $direction = (isset($_GET['dir'])) ? $_GET['dir'] : 'asc';

  $sql = <<<EOT
  SELECT u.id AS uid, CONCAT(u.nachname, ' ', u.vorname) AS spielername, p.permissions AS perm, pn.value AS permname
  FROM users AS u
  LEFT JOIN `permissions` AS p ON u.id = p.user_id
  LEFT JOIN permissionnames AS pn ON p.permissions = pn.pattern
  WHERE u.status = 'A'
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

<script>
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

</script>
