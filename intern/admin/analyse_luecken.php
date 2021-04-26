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
if (checkPermissions(VORSTAND)) {
?>

  <div class="container main-container registration-form">

    <div class="container main-container">
      <h1>Lückenmacher-Analyse</h1>


      <?php
      // Spielerliste erzeugen
      $filter = ' AND b.starts_at LIKE "2020%"';
      ?>
      <!-- <table class="display" style="font-size: 0.9rem" id="tcolist"> -->
      <table class="table table-light tbl-small" id="tcolist">
        <thead>
          <tr>
            <th>Erstellt</th>
            <th>Buchung</th>
            <th>Buchung&nbsp;von&nbsp;bis</th>
            <th>Platz</th>
            <th>Spieler</th>
            <th>Typ</th>
            <th>Delta</th>
          </tr>
        </thead>
        <tbody>
          <?php

          $order = (isset($_GET['o'])) ? $_GET['o'] : 'Start, court';
          $direction = (isset($_GET['dir'])) ? $_GET['dir'] : 'asc';

          $sql = <<<EOT
  SELECT
    b.id AS id,
    b.created_at AS Created, 
    b.starts_at AS Start,
    b.ends_at AS End,
    b.comment AS comment,
    b.user_id AS uid,
    u.vorname AS vorname,
    u.nachname AS nachname,
    b.booking_type AS bt,
    b.court AS court
  FROM bookings AS b 
  LEFT JOIN users AS u ON b.user_id = u.id
  WHERE b.booking_state='A' $filter
    ORDER BY $order $direction
   
EOT;

          TLOG(DBG, "\r\n$sql", __LINE__);

          date_default_timezone_set('UTC');

          $firstRow = true;
          $prevRow = '';
          $tDeltaMinutes = 0;
          $bgSwitch = "";
          $lm1Color = "";
          $lm2Color = "";
          $lueckenmacher = [];
          foreach ($pdo->query($sql) as $row) {

            if (!$firstRow) {
              // Vorgänger-Zeilenwerte aufbereiten
              $strDatumP = date('d.m.y', strtotime($prevRow['Start']));
              $strZeitP = date('H:i', strtotime($prevRow['Start'])) . '-' . date('H:i', strtotime($prevRow['End']));
              $strCreatedP = date("d.m.y H:i", strtotime($prevRow['Created']));
              // Aktuelle Zeile aufbereiten
              $strDatum = date('d.m.y', strtotime($row['Start']));
              $strZeit = date('H:i', strtotime($row['Start'])) . '-' . date('H:i', strtotime($row['End']));
              $strCreated = date("d.m.y H:i", strtotime($row['Created']));

              if ($strDatumP == $strDatum && $prevRow['court'] == $row['court']) {
                $dtP = new DateTime($prevRow['End']);
                $dt = new DateTime($row['Start']);
                $timeDelta = $dt->diff($dtP);
                $tDeltaMinutes = $timeDelta->h * 60 + $timeDelta->i;

                if ($tDeltaMinutes < 60 && $tDeltaMinutes > 0) {
                  $key = "";
                  if ($prevRow['Created'] > $row['Created']) {
                    // Der Lückenmacher ist in der ersten Zeile
                    $lm1Color = "color:red; font-weight:bold";
                    $lm2Color = "";
                    $key = "{$prevRow['vorname']} {$prevRow['nachname']} ({$prevRow['uid']})";
                    if (array_key_exists($key, $lueckenmacher)) {
                      $lueckenmacher[$key] = $lueckenmacher[$key] + 1;
                    } else {
                      $lueckenmacher[$key] = 1;
                    }
                    // Hintergundfarbe wechselweise
                    $bgSwitch = ($bgSwitch == "background-color:#c1d3fe") ? "background-color:#e2eafc" : "background-color:#c1d3fe"
          ?>
                    <tr style="<?= $bgSwitch ?>;<?= $lm1Color ?>">
                      <td><?= $strCreatedP ?></td>
                      <td><?= $strDatumP ?></td>
                      <td><?= $strZeitP ?></td>
                      <td><?= $prevRow['court'] ?></td>
                      <td><?= $prevRow['vorname'] . ' ' . $prevRow['nachname'] ?></td>
                      <td><?= ucfirst(substr($prevRow['bt'], 3)) ?></td>
                      <td><?= $tDeltaMinutes ?></td>
                    </tr>
                    <tr style="<?= $bgSwitch ?>;<?= $lm2Color ?>">
                      <td><?= $strCreated ?></td>
                      <td><?= $strDatum ?></td>
                      <td><?= $strZeit ?></td>
                      <td><?= $row['court'] ?></td>
                      <td><?= $row['vorname'] . ' ' . $row['nachname'] ?></td>
                      <td><?= ucfirst(substr($row['bt'], 3)) ?></td>
                      <td>&nbsp;</td>
                    </tr>
                    <tr style="height:2rem">
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                    </tr>
          <?php
                  }
                }
              }
            }
            $firstRow = false;
            $cellCssClass = "";
            $prevRow = $row;
          }
          // TECHO(DBG, json_encode($lueckenmacher), __LINE__);
          ?>
        </tbody>
      </table>
      <h2>Rangliste der Lückenmacher:</h2>
      <table class="table table-light tbl-small" id="tcolist">
        <thead>
          <tr>
            <th>Name</th>
            <th>Häufigkeit</th>
          </tr>
        </thead>
        <tbody>
          <?php
          arsort($lueckenmacher);
          foreach ($lueckenmacher as $lm => $lmValue) {
            echo ("<tr><td>$lm</td><td>$lmValue</td></tr>");
          }
          ?>
        </tbody>
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
        fetch(url, {
            credentials: 'same-origin'
          })
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