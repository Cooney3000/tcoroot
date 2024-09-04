<?php 
session_start();
require_once("../inc/config.inc.php");
require_once("../inc/functions.inc.php");
require_once("../inc/permissioncheck.inc.php");

//Überprüfe, dass der User eingeloggt und berechtigt ist
$user = check_user();

$title = "TCO Benutzer";
include("header.inc.php");
$menuid = "nav-" . getFilename(__FILE__);
?>

<script>
  document.getElementById("<?= $menuid ?>").classList.add("active");
</script>

<?php
$delimiter = '§§§';
if (checkPermissions(VORSTAND) ) 
{
  //
  // Wurde einer der Buttons geklickt?
  //
  $buttonkey = '';
  
  
  foreach(['activate', 'deactivate', 'delete', 'schnupper'] as $k) {
    // error_log( "[internal.php] $k=". $_POST[$k] . ' ### ' . isset($_POST[$k]) );
    if (isset($_POST[$k])) {
      $buttonkey = $k;
    }
  }
  if ($buttonkey != '') {
    $button = $_POST[$buttonkey];
    //
    // '-A' : Benutzer aktivieren (ist im Wartezustand 'W'), '-D' : Benutzer deaktivieren, '-X' : Löschen (wird tatsächlich aber nur gekennzeichnet mit X und nicht mehr angezeigt)
    //
    $pa = preg_split('/-/', $button);

    // error_log("[internal.php] buttonkey: $buttonkey, button: $button, pa[0]: $pa[0], pa[1]: $pa[1]");

    if ($buttonkey == 'schnupper') {
      $statement = $pdo->prepare("UPDATE users SET schnupper = ? WHERE id = ?");
    } 
    else {
      $statement = $pdo->prepare("UPDATE users SET status = ? WHERE id = ?");
    }
    $statement->execute([$pa[1], $pa[0]]);
  }


  $order = (isset($_GET['o'])) ? $_GET['o'] : 'nachname, vorname';
  $direction = (isset($_GET['dir'])) ? $_GET['dir'] : 'asc';

  $sql = 'SELECT * FROM users WHERE status <> "T" AND status <> "X" ORDER BY '."$order $direction";
  // TECHO(DBG, $sql);
  $statement = $pdo->prepare($sql);
  $result = $statement->execute();
  ?>
  <h1>Benutzer</h1>
  <h3>Aktuell registrierte Benutzer (A = Aktiv, P = Passiv, D = Deaktiviert, W = Wartet auf Aktivierung)</h3>
  <div class="mx-3">
    <form action="index.php" method="post">
      <table class="table table-bordered table-light tbl-small">
        <tr>
          <th>S<br>
            <a class="fas fa-angle-up fa-1x" href="index.php?o=status&dir=asc"></a> 
            <a class="fas fa-angle-down fa-1x" href="index.php?o=status&dir=desc"></a></th>
          <th>#</th>
          <th>Vorname</th>
          <th>Nachname<br>
            <a class="fas fa-angle-up fa-1x" href="index.php?o=nachname&dir=asc"></a>&nbsp;&nbsp;
            <a class="fas fa-angle-down fa-1x" href="index.php?o=nachname&dir=desc"></a></th>
          <th>E-Mail<br>
            <a class="fas fa-angle-up fa-1x" href="index.php?o=email&dir=asc"></a>&nbsp;&nbsp;
            <a class="fas fa-angle-down fa-1x" href="index.php?o=email&dir=desc"></a></th>
          <th>Festnetz</th>
          <th>Mobil</th>
          <th>Geburtsdatum</th>
          <th>Registriert am<br>
            <a class="fas fa-angle-up fa-1x" href="index.php?o=created_at&dir=asc"></a>&nbsp;&nbsp;
            <a class="fas fa-angle-down fa-1x" href="index.php?o=created_at&dir=desc"></a></th>
          <th>SchnM<br>
            <a class="fas fa-angle-up fa-1x" href="index.php?o=schnupper&dir=asc"></a>&nbsp;&nbsp;
            <a class="fas fa-angle-down fa-1x" href="index.php?o=schnupper&dir=desc"></a></th>
          <th>Aktionen</th><th></th>
        </tr>
        <?php
        $userCount = 0;
        while ($row = $statement->fetch()) {
          $userCount++;
          $danger = ($row['status'] == 'W' || $row['status'] == 'D') ? true : false;
          $classname = $danger ? 'text-gefahr' : '';
          if ($row['schnupper'] == '1') {
            $check =  true;
            $checked = 'checked';
          } 
          else {
            $check =  false;
            $checked = '';
          }
      
        ?>
          <tr>
            <td class="<?= $classname ?>"><?= $row['status'] ?></td>
            <td class="<?= $classname ?>"><?= $row['id'] ?></td>
            <td class="align-middle"><input class="form-control form-control-sm" onchange="hasChanged(this)" id="<?= $row['id'].$delimiter ?>vorname"  type="text" value="<?= $row['vorname'] ?>"/></td>
            <td class="align-middle"><input class="form-control form-control-sm" onchange="hasChanged(this)" id="<?= $row['id'].$delimiter ?>nachname"  type="text" value="<?= $row['nachname'] ?>"/></td>
            <td class="align-middle"><input class="form-control form-control-sm" onchange="hasChanged(this)" id="<?= $row['id'].$delimiter ?>email"  type="text" value="<?= $row['email'] ?>"/></td>
            <td class="align-middle"><input class="form-control form-control-sm" onchange="hasChanged(this)" id="<?= $row['id'].$delimiter ?>festnetz"  type="text" value="<?= $row['festnetz'] ?>"/></td>
            <td class="align-middle"><input class="form-control form-control-sm" onchange="hasChanged(this)" id="<?= $row['id'].$delimiter ?>mobil"  type="text" value="<?= $row['mobil'] ?>"/></td>
            <td class="align-middle"><input class="form-control form-control-sm" onchange="hasChanged(this)" id="<?= $row['id'].$delimiter ?>geburtsdatum"  type="text" value="<?= $row['geburtsdatum'] ?>"/></td>
            <td class="<?= $classname ?>"><?= substr($row['created_at'], 0, 10) ?></td>
            <td class="align-middle">
              <input type="checkbox"  onclick="hasChanged(this)" id="<?= $row['id'] . $delimiter . "schnupper"   ?>"  value="<?= $check ?>" <?= $checked ?>/>
            </td>
            <td>
              <?php
              if ($danger) { ?>
                <button type="submit" name="activate" value="<?= $row['id'] ?>-A" class="btn btn-success btn-sm btn-block py-0">Aktivieren</button>
              <?php
              }
              if ($row['status'] == 'A') { ?>
                <button type="submit" name="deactivate" value="<?= $row['id'] ?>-D" class="btn btn-danger btn-sm btn-block py-0">Deaktivieren</button>
              <?php } ?>
            </td>
            <td>
              <?php
              if ($danger) { ?>
                <button type="submit" name="delete" value="<?= $row['id'] ?>-X" class="btn btn-danger btn-sm btn-block py-0">Löschen</button>
              <?php } ?>
            </td>
          </tr>
        <?php
        }
        ?>
      </table>
    </form>
    <div><?= $userCount ?> Benutzer</div>
  </div>
<?php
}
?>


</div>
<?php
include("footer.inc.php")
?>

<script>
function hasChanged(e) {
  const p = e.id.split('<?= $delimiter ?>');
  const id = "i=" + p[0];
  const col = "&col=" + p[1];
  let v;
  if (p[1]=='schnupper') {
    v = "&v=" + (e.checked ? 1 : 0);
  }
  else {
    v = "&v=" + e.value;
  }
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