<?php 
session_start();
require_once("../inc/config.inc.php");
require_once("../inc/functions.inc.php");
require_once("../inc/permissioncheck.inc.php");

//Überprüfe, dass der User eingeloggt und berechtigt ist
$user = check_user();

$title = "TCO Eventverkauf";
include("header.inc.php");
$menuid = "nav-" . getFilename(__FILE__);
?>

<script>
  document.getElementById("<?= $menuid ?>").classList.add("active");
</script>

<?php
$delimiter = '§§§';
if (checkPermissions(T_ALL_PERMISSIONS) ) 
{
  
  $order = (isset($_GET['o'])) ? $_GET['o'] : 'kaufer_nn, kaeufer_vn';
  $direction = (isset($_GET['dir'])) ? $_GET['dir'] : 'asc';

  $sql = 'SELECT * FROM event_tickets WHERE event = "Players & Friends 2023"  ORDER BY '."$order $direction";
  // TECHO(DBG, $sql);
  $statement = $pdo->prepare($sql);
  $result = $statement->execute();
  ?>
  <div class="mx-3">
    <form action="index.php" method="post">
      <table class="table table-bordered table-light tbl-small">
        <tr>
          <th>ID<br>
          <th>Name<br>
            <a class="fas fa-angle-up fa-1x" href="index.php?o=kaeufer_nn&dir=asc"></a> 
            <a class="fas fa-angle-down fa-1x" href="index.php?o=kaeufer_nn&dir=desc"></a></th>
          <th>Vorname<br>
            <a class="fas fa-angle-up fa-1x" href="index.php?o=kaeufer_vn&dir=asc"></a>&nbsp;&nbsp;
            <a class="fas fa-angle-down fa-1x" href="index.php?o=kaeufer_vn&dir=desc"></a></th>
          <th>Gruppe<br>
            <a class="fas fa-angle-up fa-1x" href="index.php?o=gruppe&dir=asc"></a>&nbsp;&nbsp;
            <a class="fas fa-angle-down fa-1x" href="index.php?o=gruppe&dir=desc"></a></th>
          <th>Zu-/Absage</th>
            <a class="fas fa-angle-up fa-1x" href="index.php?o=jn&dir=asc"></a>&nbsp;&nbsp;
            <a class="fas fa-angle-down fa-1x" href="index.php?o=jn&dir=desc"></a></th>
          <th>Karte<br>
            <a class="fas fa-angle-up fa-1x" href="index.php?o=ticketnummer&dir=asc"></a>&nbsp;&nbsp;
            <a class="fas fa-angle-down fa-1x" href="index.php?o=ticketnummer&dir=desc"></a></th>
          <th>Verkäufer<br>
            <a class="fas fa-angle-up fa-1x" href="index.php?o=verkaeufer&dir=asc"></a>&nbsp;&nbsp;
            <a class="fas fa-angle-down fa-1x" href="index.php?o=verkaeufer&dir=desc"></a></th>
          <th>Kommentar</th>
        </tr>
        <?php
        while ($row = $statement->fetch()) {
        ?>
          <tr>
            <td class="<?= $classname ?>"><?= $row['id'] ?></td>
            <td class="align-middle"><input class="form-control form-control-sm" onchange="hasChanged(this)" id="<?= $row['id'].$delimiter ?>kaufer_nn"  type="text" value="<?= $row['kaufer_nn'] ?>"/></td>
            <td class="align-middle"><input class="form-control form-control-sm" onchange="hasChanged(this)" id="<?= $row['id'].$delimiter ?>kaufer_vn"  type="text" value="<?= $row['kaufer_vn'] ?>"/></td>
            <td class="align-middle"><input class="form-control form-control-sm" onchange="hasChanged(this)" id="<?= $row['id'].$delimiter ?>gruppe"  type="text" value="<?= $row['gruppe'] ?>"/></td>
            <td class="align-middle"><input class="form-control form-control-sm" onchange="hasChanged(this)" id="<?= $row['id'].$delimiter ?>jn"  type="text" value="<?= $row['jn'] ?>"/></td>
            <td class="align-middle"><input class="form-control form-control-sm" onchange="hasChanged(this)" id="<?= $row['id'].$delimiter ?>ticketnummer"  type="text" value="<?= $row['ticketnummer'] ?>"/></td>
            <td class="align-middle"><input class="form-control form-control-sm" onchange="hasChanged(this)" id="<?= $row['id'].$delimiter ?>verkaeufer"  type="text" value="<?= $row['verkaeufer'] ?>"/></td>
            <td class="align-middle"><input class="form-control form-control-sm" onchange="hasChanged(this)" id="<?= $row['id'].$delimiter ?>kommentar"  type="text" value="<?= $row['kommentar'] ?>"/></td>
          </tr>
        <?php
        }
        ?>
      </table>
    </form>
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
  const url = "/intern/api/eventTicketUpdate.php?" + id + col + v;
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