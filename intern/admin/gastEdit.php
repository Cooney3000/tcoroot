<?php 
session_start();
require_once("../inc/config.inc.php");
require_once("../inc/functions.inc.php");
require_once("../inc/permissioncheck.inc.php");

//Überprüfe, dass der User eingeloggt und berechtigt ist
$user = check_user();

$title = "TCO Gastgebühr";
include("header.inc.php");
$menuid = "nav-" . getFilename(__FILE__);
?>
<script>
  document.getElementById("<?= $menuid ?>").classList.add("active");
</script>

<?php
$delimiter = '#';
if (checkPermissions(PERMISSIONS::VORSTAND | PERMISSIONS::VORSTAND) ) 
{
?>

  <div class="container main-container registration-form">

  <div class="container main-container">
  <h1>Gastspiele und nicht registrierte Mitglieder prüfen</h1>

  
  <?php
  // Spielerliste erzeugen
  ?>
  <table class="table table-light tbl-small">
    <tr>
      <th>Bezahlt<br>
        <a class="fas fa-angle-up fa-1x" href="gastEdit.php?o=paid&dir=asc"></a>&nbsp;&nbsp;
        <a class="fas fa-angle-down fa-1x" href="gastEdit.php?o=paid&dir=desc"></a>
      </th>
      <th>Von<br>
        <a class="fas fa-angle-up fa-1x" href="gastEdit.php?o=starts_at&dir=asc"></a>&nbsp;&nbsp;
        <a class="fas fa-angle-down fa-1x" href="gastEdit.php?o=ends_at&dir=desc"></a>
      </th>
      <th>Bis</th>
      <th>
        Spieler1<br>
        <a class="fas fa-angle-up fa-1x" href="gastEdit.php?o=p1.nachname&dir=asc"></a>&nbsp;&nbsp;
        <a class="fas fa-angle-down fa-1x" href="gastEdit.php?o=p1.nachname&dir=desc"></a>
      </th>
      <th>
        Spieler2<br>
        <a class="fas fa-angle-up fa-1x" href="gastEdit.php?o=p2.nachname&dir=asc"></a>&nbsp;&nbsp;
        <a class="fas fa-angle-down fa-1x" href="gastEdit.php?o=p2.nachname&dir=desc"></a>
      </th>
      <th>
        Spieler3<br>
        <a class="fas fa-angle-up fa-1x" href="gastEdit.php?o=p3.nachname&dir=asc"></a>&nbsp;&nbsp;
        <a class="fas fa-angle-down fa-1x" href="gastEdit.php?o=p3.nachname&dir=desc"></a>
      </th>
      <th>
        Spieler4<br>
        <a class="fas fa-angle-up fa-1x" href="gastEdit.php?o=p4.nachname&dir=asc"></a>&nbsp;&nbsp;
        <a class="fas fa-angle-down fa-1x" href="gastEdit.php?o=p4.nachname&dir=desc"></a>
      </th>
      <th>Kommentar</th>
    </tr> 
  <?php
  $gast = $CONFIG['gastId'];
  $mitglied = $CONFIG['mitgliedId'];


  $order = (isset($_GET['o'])) ? $_GET['o'] : 'Start';
  $direction = (isset($_GET['dir'])) ? $_GET['dir'] : 'asc';



$sql = <<<EOT
  SELECT
    b.id AS id, 
    b.starts_at AS Start,
    b.ends_at AS End,
    paid AS bezahlt,
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
  WHERE b.booking_state='A' AND (b.player1 = $gast OR b.player2 = $gast OR b.player3 = $gast OR b.player4 = $gast 
        OR b.player1 = $mitglied OR b.player2 = $mitglied OR b.player3 = $mitglied OR b.player4 = $mitglied)
    ORDER BY $order $direction
EOT;

  // TLOG(DBG, "\r\n$sql", __LINE__);

  date_default_timezone_set('UTC');

  foreach ($pdo->query($sql) as $row) {
    $strDateVon = date('d.m. H:i', strtotime ($row['Start']));
    $strDateBis = date('d.m. H:i', strtotime ($row['End']));
    $spieler = array();
    $pid = [ $row['sp1'], $row['sp2'], $row['sp3'], $row['sp4'] ];
    for($i = 1; $i<=4; $i++) {
      $spieler[$i-1] = ( ! is_null($pid[$i-1]) ) ? $row["pn$i"] ." ". $row["pv$i"] : '';
    }

    if ($row['bezahlt'] == '1') {
      $check =  true;
      $checked = 'checked';
    } 
    else {
      $check =  false;
      $checked = '';
    }
    
    // TLOG(DBG, "check: $check, paid: ${row['bezahlt']}");

    
    ?>
      <tr>
        <td class="align-middle">
          <input type="checkbox"
            onclick="hasChanged(this)" id="<?= $row['id'] . $delimiter . "paid"   ?>"  value="<?= $check ?>" <?= $checked ?>/>
        </td>
        <td class="align-middle form-control-sm" style="width: auto"><?= $strDateVon ?></td>
        <td class="align-middle form-control-sm" style="width: auto"><?= $strDateBis ?></td>
        <td class="align-middle form-control-sm" style="width: auto"><?= $spieler[0]." (".$row['sp1'].")" ?></td>
        <td class="align-middle form-control-sm" style="width: auto"><?= $spieler[1] ?></td>
        <td class="align-middle form-control-sm" style="width: auto"><?= $spieler[2] ?></td>
        <td class="align-middle form-control-sm" style="width: auto"><?= $spieler[3] ?></td>
        <td class="align-middle"><?=$row['comment']?></td>
      </tr>
<?php
  }
?>
</table>
<?php
} // check_permissions
include("footer.inc.php");
?>

<script>
function hasChanged(e) {
  const p = e.id.split('<?= $delimiter ?>');
  const id = "i=" + p[0];
  const col = "&col=" + p[1];
  // const v = "&v=" + (e.value == 'On' ? 1 : 0);
  const v = "&v=" + (e.checked ? 1 : 0);
  const url = "/intern/api/gastspieler.php?" + id + col + v;
  // console.log(url);
  fetch(url, {credentials: 'same-origin'})
  .then(result => {
    if (result.ok) {
      return result.json()
    } else {
        throw new Error('Fehler beim Erzeugen/Updaten der Belegung ("bezahlt")');
    }
  })
  .then(result => {
    let rc = result.records[0].returncode;
    if (rc === 'ok') {
      return true;
    } else {
      throw new Error('Fehler beim Erzeugen/Updaten der Belegung ("bezahlt")');
    }
  })
  .catch((error) => {
    console.error('Fehler beim Erzeugen/Updaten der Belegung ("bezahlt"):', error);
  });
}

</script>
