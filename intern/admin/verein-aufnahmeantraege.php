<?php
session_start();
require_once("../inc/config.inc.php");
require_once("../inc/functions.inc.php");
require_once("../inc/permissioncheck.inc.php");

$user = check_user();

if (!(checkPermissions(TRAINER) || checkPermissions(KASSIER))) {
  echo ("<html><body>");
  TECHO(DBG, "Für diese Seite besitzt du leider nicht die nötige Berechtigung", __LINE__);
  echo ("</body></html>");
  die("Keine Berechtigung");
}

$title = "TCO Aufnahmeanträge";
include("header.inc.php");
$menuid = "nav-serieedit";
?>
<script>
  document.getElementById("<?= $menuid ?>").classList.add("active");
</script>


<?php
$userid = $user['id'];
//
// Wurde der Löschen-Button geklickt?
//
$button = '';
if (isset($_POST['deleteRow'])) {
  $row_id = $_POST['deleteRow'];

  echo "<!-- BUTTON-DEBUG $row_id -->\r\n";

  $statement = $pdo->prepare("DELETE FROM reg_applicants WHERE id = ?");
  $statement->execute([$row_id]);
}


// TECHO (DEBUG, http_build_query($_POST)."\r\n");
?>

<div class="container main-container">
  <form action="verein-aufnahmeantraege.php" method="post">
    <h1>Gestellte Aufnahmeanträge</h1>


    <table class="table table-bordered table-light tbl-small">
      <thead>
        <tr>
          <th>id</th>
          <th>Vorname</th>
          <th>Nachname<br>
            <a class="fas fa-angle-up fa-1x" href="verein-aufnahmeantraege.php?o=nachname&dir=asc"></a>&nbsp;&nbsp;
            <a class="fas fa-angle-down fa-1x" href="verein-aufnahmeantraege.php?o=nachname&dir=desc"></a>
          </th>
          <th>Mitgliedschaft<br>
            <a class="fas fa-angle-up fa-1x" href="verein-aufnahmeantraege.php?o=mitgliedschaft&dir=asc"></a>&nbsp;&nbsp;
            <a class="fas fa-angle-down fa-1x" href="verein-aufnahmeantraege.php?o=mitgliedschaft&dir=desc"></a>
          </th>
          <th>Erziehungsberechtigter</th>
          <th>Strasse</th>
          <th>Plz</th>
          <th>Ort</th>
          <th>Geburtsdatum</th>
          <th>Tel</th>
          <th>E-Mail</th>
          <th>Geschlecht</th>
          <th>Nationalitaet</th>
          <th>Kontoinhaber</th>
          <th>IBAN</th>
          <th>Bemerkungen</th>
          <th>Erstellt am<br>
            <a class="fas fa-angle-up fa-1x" href="verein-aufnahmeantraege.php?o=created_at&dir=asc"></a>&nbsp;&nbsp;
            <a class="fas fa-angle-down fa-1x" href="verein-aufnahmeantraege.php?o=created_at&dir=desc"></a>
          </th>
          <?php
          if (checkPermissions(KASSIER)) {
          ?>
            <th>Aktion</th>
          <?php
          }
          ?>
        </tr>
      </thead>
      <tbody>
        <?php

        $order = (isset($_GET['o'])) ? $_GET['o'] : 'created_at';
        $direction = (isset($_GET['dir'])) ? $_GET['dir'] : 'asc';


        $sql = <<<EOT
      SELECT * FROM reg_applicants WHERE verified = 1
      ORDER BY $order $direction
EOT;
        // TLOG (DEBUG, "$sql\r\n", __LINE__);

        foreach ($pdo->query($sql) as $row) {




          $strDatum = date('d.m.Y', strtotime($row['created_at']));
          $strZeit = date('H:i', strtotime($row['created_at']));



        ?>
          <tr>
            <td class="align-middle form-control-sm" style="width: auto"><?= $row['id'] ?></td>
            <td class="align-middle form-control-sm" style="width: auto"><?= $row['vorname'] ?></td>
            <td class="align-middle form-control-sm" style="width: auto"><?= $row['nachname'] ?></td>
            <td class="align-middle form-control-sm" style="width: auto"><?= $row['mitgliedschaft'] ?></td>
            <td class="align-middle form-control-sm" style="width: auto"><?= $row['erziehungsberechtigter'] ?></td>
            <td class="align-middle form-control-sm" style="width: auto"><?= $row['strasse'] ?></td>
            <td class="align-middle form-control-sm" style="width: auto"><?= $row['plz'] ?></td>
            <td class="align-middle form-control-sm" style="width: auto"><?= $row['ort'] ?></td>
            <td class="align-middle form-control-sm" style="width: auto"><?= $row['geburtsdatum'] ?></td>
            <td class="align-middle form-control-sm" style="width: auto"><?= $row['tel'] ?></td>
            <td class="align-middle form-control-sm" style="width: auto"><?= $row['email'] ?></td>
            <td class="align-middle form-control-sm" style="width: auto"><?= $row['geschlecht'] ?></td>
            <td class="align-middle form-control-sm" style="width: auto"><?= $row['nationalitaet'] ?></td>
            <td class="align-middle form-control-sm" style="width: auto"><?= $row['kontoinhaber'] ?></td>
            <td class="align-middle form-control-sm" style="width: auto"><?= $row['konto_iban'] ?></td>
            <td class="align-middle form-control-sm" style="width: auto"><?= $row['bemerkungen'] ?></td>
            <td class="align-middle form-control-sm" style="width: auto"><?= $row['created_at'] ?></td>
            <?php
            if (checkPermissions(KASSIER)) {
            ?>
              <td class="align-middle form-control-sm" style="width: auto"><button type="submit" name="deleteRow" value="<?= $row['id'] ?>" class="btn btn-danger btn-sm btn-block py-0">Löschen</button></td>
            <?php
            }
            ?>
          </tr>
        <?php
        }
        ?>
      </tbody>
    </table>
  </form>
</div>
<?php
include("footer.inc.php");
?>