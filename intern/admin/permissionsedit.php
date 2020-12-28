<?php
session_start();
require_once("../inc/config.inc.php");
require_once("../inc/functions.inc.php");
require_once("../inc/permissioncheck.inc.php");

$user = check_user();

if (!checkPermissions(VORSTAND)) {
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

<?php
$delimiter = "$$$";
// Ein Array füllen für die möglichen Berechtigungsstufen

$sqlperm = "SELECT * FROM permissionnames ORDER BY pattern DESC";
$perm_pattern = Array();

foreach ($pdo->query($sqlperm) as $row) {
  $perm_pattern [$row['pattern']] = $row['value'];
}
$perm_value = array_flip($perm_pattern);
?>

<div class="container main-container">
  <h2 class="h1">Berechtigungsvergabe</h2>

  <div class="container mt-4">
 <?php
 /*
  <div class="row">
      <!-- Berechtigungsgruppen -->
      <table class="table table-bordered table-light tbl-small">
        <thead>
          <th>Berechtigungsgruppe</th>
          <?php for($i=1; $i<17; $i++) {
            echo "<th>p$i</th>\r\n";
          }?>
        </thead>
        <tbody>
        <?php
          foreach(array_keys($perm_pattern) as $pa_key) {
            echo "<tr>";
            echo "<td>". $perm_pattern[$pa_key] ."</td>";
            $p_bits = str_split(sprintf("%016b",$pa_key));
            foreach($p_bits as $bit) {
              echo '<td class="text-center">'. $bit ."</td>";
            }
            echo "</tr>";
            // for ($i=1; $i<16; $i++) {
            //   echo "<td>p$i</td>\r\n";
            // }
          }
        ?>
        </tbody>
      </table>

    </div>
*/
?>
    
    <div class="row">

<!- Benutzerliste -->
  
  <table class="table table-bordered table-light tbl-small">
    <thead>
      <th>ID<br>
        <a class="fas fa-angle-up fa-1x" href="permissionsedit.php?o=uid&dir=asc"></a>&nbsp;&nbsp;
        <a class="fas fa-angle-down fa-1x" href="permissionsedit.php?o=uid&dir=desc"></a>
      </th>
      <th>
        Benutzername<br>
        <a class="fas fa-angle-up fa-1x" href="permissionsedit.php?o=spielername&dir=asc"></a>&nbsp;&nbsp;
        <a class="fas fa-angle-down fa-1x" href="permissionsedit.php?o=spielername&dir=desc"></a>
      </th>
      <?php
          foreach(array_values($perm_pattern) as $pa_value) {
            if ($perm_value[$pa_value] != 0) {
              echo "<th>$pa_value</th>\r\n";
            }
          }
      ?>
    </thead> 
    <tbody>

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

foreach ($pdo->query($sql) as $row) {
?>
    <tr>
      <td><?= $row['uid'] ?></td> 
      <td style="width: auto"><?= $row['spielername'] ?></td>
      <?php
          // Des Users derzeitige Rechte
          $u_perm = $row['perm'] ? $row['perm'] : 0;

          // Erzeugen der Tabellenzeile mit allen Rechten. Die Admin-Spalte ist nicht änderbr, ebenso Zeilen von Admins
          $userIsAdmin = false;
          foreach(array_values($perm_pattern) as $pa_value) {
            // Rechte sind ungleich 0
            if ($perm_value[$pa_value] != 0) {
              // Hat der User dieses Recht?
              $YN = ($perm_value[$pa_value] == ($perm_value[$pa_value] & $u_perm)) ? true : false;
              echo '<td>';
              if ($pa_value == 'Administrator' || $userIsAdmin) {
                echo $YN ? 'Y' : 'N';
                $userIsAdmin = $YN == 'Y' ? true : false;
              } else {
                $check = $YN;
                $checked = $YN ? 'checked' : '';
                echo '<input type="checkbox" onclick="hasChanged(this)" id="'. $row['uid'] . $delimiter . $pa_value .'"  value="'. $check .'"'. $checked .'/>';
              }
              echo '</td>';
            }
          }


      ?>
</tr>
<?php
}

?>
    </tbody>
  </table>
</div> <!-- container -->
<?php
  include("footer.inc.php");
?>

<script>
function hasChanged(e) {
  let permission = []
  <?php
    foreach(array_keys($perm_value) as $p) {
      echo "permission ['$p'] = '". $perm_value[$p] ."'\r\n";
    }
  ?>
  
  const delimiter = '<?= $delimiter ?>'
  let [uid, col] = e.id.split(delimiter)
  
  newpattern = 0;
  for(pn in permission) {
    if (!(pn === 'Administrator' || pn === '---')) {  
      elem = document.getElementById(uid + delimiter + pn)
      if (elem.checked) {
        newpattern = newpattern | permission[pn]
      }
    }
  }
  // alert (newpattern)
      
  uid = "uid=" + uid;
  col = "&col=" + 'permissions';
  const v = "&v=" + newpattern;
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
