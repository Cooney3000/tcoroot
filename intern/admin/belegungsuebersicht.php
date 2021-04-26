<?php 
session_start();
require_once("../inc/config.inc.php");
require_once("../inc/functions.inc.php");
require_once("../inc/permissioncheck.inc.php");

//Überprüfe, dass der User eingeloggt und berechtigt ist
$user = check_user();

$title = "TCO Platzbbelegungs-Historie";
include("header.inc.php");
$menuid = "nav-" . getFilename(__FILE__);
?>
<script>
  document.getElementById("<?= $menuid ?>").classList.add("active");
</script>


 
<?php
$delimiter = '#';
if (checkPermissions(VORSTAND) ) 
{
?>

  <div class="container main-container registration-form">

  <div class="container main-container">
  <h1>Übersicht über alle Belegungen</h1>

  
  <?php
  // Spielerliste erzeugen
  $filter = ' AND b.starts_at LIKE "2021%"';
  ?>
  <table class="display" style="font-size: 0.9rem" id="tcolist">
  <!-- <table class="table table-light tbl-small" id="tcolist"> -->
    <thead>
      <tr>
        <th>Datum</th>
        <th>Zeit&nbsp;von&nbsp;bis</th>
        <th>Pl</th>
        <th>Sp 1</th>
        <th>Sp 2</th>
        <th>Sp 3</th>
        <th>Sp 4</th>
        <th>Typ</th>
        <th>Kommentar</th>
      </tr>
    </thead>
    <tbody>
  <?php

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
    p4.nachname AS pn4,
    b.booking_type AS bt,
    b.court AS court
  FROM bookings AS b 
  LEFT JOIN users AS p1 ON b.player1 = p1.id
  LEFT JOIN users AS p2 ON b.player2 = p2.id
  LEFT JOIN users AS p3 ON b.player3 = p3.id
  LEFT JOIN users AS p4 ON b.player4 = p4.id
  WHERE b.booking_state='A' $filter
    ORDER BY $order $direction
EOT;

  // TLOG(DBG, "\r\n$sql", __LINE__);

  date_default_timezone_set('UTC');

  foreach ($pdo->query($sql) as $row) {
    $strDatum = date('y-m-d', strtotime ($row['Start']));
    $strZeit = date('H:i', strtotime ($row['Start'])).'-'.date('H:i', strtotime ($row['End']));
    $spieler = array();
    $pid = [ $row['sp1'], $row['sp2'], $row['sp3'], $row['sp4'] ];
    for($i = 1; $i<=4; $i++) {
      $spielerNn[$i-1] = ( ! is_null($pid[$i-1]) ) ? $row["pn$i"] : '';
      $spielerVn[$i-1] = ( ! is_null($pid[$i-1]) ) ? $row["pv$i"] : '';
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
        <td><?= $strDatum ?></td>
        <td><?= $strZeit ?></td>
        <td><?= $row['court'] ?></td>
        <td><?= $spielerNn[0].' '.$spielerVn[0] ?></td>
        <td><?= $spielerNn[1] ?></td>
        <td><?= $spielerNn[2] ?></td>
        <td><?= $spielerNn[3] ?></td>
        <td><?=ucfirst(substr($row['bt'], 3))?></td>
        <td><?=$row['comment']?></td>
      </tr>
<?php
  }
?>
    </tbody>
</table>

<script>
  $(document).ready( function () {
      $('#tcolist').DataTable();
  } );
  $('#tcolist').DataTable( {
    paging: false,
    autowidth: true
} );
</script>


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
