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

$title = "TCO Serie buchen";
include("header.inc.php");
$menuid = "nav-" . getFilename(__FILE__);
?>
<script>
  document.getElementById("<?= $menuid ?>").classList.add("active");
</script>


<?php

// Import-CSV-Datei einlesen

$file = "spielplan2022.csv";
$openfile = fopen($file, "r");
$cont = fread($openfile, filesize($file));
echo "<pre>\r\n$cont\r\n</pre>";


/*












  $sql = <<<EOT
INSERT INTO bookings (
  `id`, `ta_id`, `booking_state`, `series_id`, 
  `created_at`, `updated_at`, `user_id`, `updated_by`, 
  `player1`, `player2`, `player3`, `player4`, 
  `court`, `starts_at`, `ends_at`, `booking_type`, 
  `comment`, `price`, `paid`) 
VALUES 
EOT;
  $bereitsBelegt = "";
  $jetzt = date('Y-m-d H:m');

  //*****
  // Zeitraum als INSERT-Zeilen erzeugen
  //

  $atLeastOne = false;
  if ($datumVon != "") {
    // Über den Zeitraum iterieren

    $bookingEnd = new DateTime($datumBis);

    // Die Iteration muss am ersten Tag der Woche des Startdatums beginnen

    // TECHO(DEBUG, $datumVon.": ".date('Y-m-d', strtotime(date('o-\WW', strtotime($datumVon)))));
    $ersterTagDerWoche = new DateTime(date('Y-m-d', strtotime(date('o-\WW', strtotime($datumVon)))));
    // TECHO(DEBUG, date_diff($ersterTagDerWoche, $bookingEnd)->format('%R%a').'<br>');

    for (
      $bookingDay = new DateTime(date('Y-m-d', strtotime(date('o-\WW', strtotime($datumVon)))));
      date_diff($bookingDay, $bookingEnd)->format('%R%a') >= 0;
      $bookingDay = date_modify($bookingDay, '+1 week')
    ) {
      // TECHO(DEBUG, $datumVon . ", " . date_format($bookingDay, 'Y-m-d') . ", $datumBis, " . date_diff($bookingDay, $bookingEnd)->format('%R%a') . "<br>");

      for ($wDays = 0; $wDays <= 6; $wDays++) {

        if ($wtag[$wDays] != '') {

          $modifiedDate = new DateTime(date_format($bookingDay, 'Y-m-d'));
          $bDay = date_format(date_modify($modifiedDate, "+$wDays day"), 'Y-m-d');

          for ($pI = 0; $pI < $CONFIG['anzahlPlaetze']; $pI++) {
            if ($platz[$pI] != '') {
              $platzTmp = $pI + 1;


              if ($einzelstunden) {
                $stdVon = substr($zeitvon, 0, 2);
                $minVon = substr($zeitvon, 2, 3); // ':' lassen wir dran
                $stdBis = substr($zeitbis, 0, 2);
                $minBis = substr($zeitbis, 2, 3); // ':' lassen wir dran
                // TLOG(DEBUG, "DIE ZEITEN: $stdVon:$minVon, $stdBis:$minBis\r\n", __LINE__);

                $aktuellerTag = $bookingDay;
                for ($bStdVon = $stdVon; $bStdVon <= $stdBis; $bStdVon++) {
                  $bZeitvon = sprintf("%02d", $bStdVon) . $minVon;
                  $bZeitbis = sprintf("%02d", $bStdVon + 1) . $minBis;
                  $zeile = <<<EOT
(0,0,'A','$seriesid', '$jetzt','$jetzt',$userid,$userid, $spieler1,$spieler2,$spieler3,$spieler4, $platzTmp,'$bDay $bZeitvon','$bDay $bZeitbis','$bookingType', '$kommentar','0','0'),
EOT;
                  // Ist der Platz frei??
                  $sqlCheckPlatz = <<<EOT
            SELECT B.*
            FROM bookings as B 
            WHERE B.booking_state="A" AND (B.starts_at < '$bDay $bZeitbis' AND B.ends_at > '$bDay $bZeitvon') AND B.court = $platzTmp
EOT;
                  $rowCount = $pdo->query($sqlCheckPlatz)->rowCount();
                  // TECHO(DEBUG, "Count: $rowCount\r\n sqlCheckPlatz: $sqlCheckPlatz\r\n"); echo "<br>";
                  if ($rowCount > 0) {
                    $bereitsBelegt .= $zeile . "\r\n";
                  } else {
                    $sql .= $zeile;
                    $atLeastOne = true;
                  }
                }
              } else {
                $zeile = <<<EOT
(0,0,'A','$seriesid', '$jetzt','$jetzt',$userid,$userid, $spieler1,$spieler2,$spieler3,$spieler4, $platzTmp,'$bDay $zeitvon','$bDay $zeitbis','$bookingType', '$kommentar','0','0'),
EOT;
                // Ist der Platz frei??
                $sqlCheckPlatz = <<<EOT
            SELECT B.*
            FROM bookings as B 
            WHERE B.booking_state="A" AND (B.starts_at < '$bDay $zeitbis' AND B.ends_at > '$bDay $zeitvon') AND B.court = $platzTmp
EOT;
                $rowCount = $pdo->query($sqlCheckPlatz)->rowCount();
                // TECHO(DEBUG, "Count: $rowCount\r\n sqlCheckPlatz: $sqlCheckPlatz\r\n"); echo "<br>";
                if ($rowCount > 0) {
                  $bereitsBelegt .= $zeile . "\r\n";
                } else {
                  $sql .= $zeile;
                  $atLeastOne = true;
                }
              }
            }
          }
        }
      }
    }
  }
  //*****
  // Einzelbuchungen als INSERT-Zeilen erzeugen
  //
  foreach ($einzelDatum as $einzelDay) {
    if ($einzelDay != "") {
      $bDay = implode('-', array_reverse(explode('.', $einzelDay)));
      // TECHO(DEBUG, $bDay);
      for ($pI = 0; $pI < $CONFIG['anzahlPlaetze']; $pI++) {
        if ($platz[$pI] != '') {
          $platzTmp = $pI + 1;

          $zeile = <<<EOT
(0,0,'A','$seriesid', '$jetzt','$jetzt',$userid,$userid, $spieler1,$spieler2,$spieler3,$spieler4, $platzTmp,'$bDay $zeitvon','$bDay $zeitbis','$bookingType', '$kommentar','0','0'),
EOT;
          // Ist der Platz frei??
          $sqlCheckPlatz = <<<EOT
        SELECT B.*
        FROM bookings as B 
        WHERE B.booking_state="A" AND (B.starts_at < '$bDay $zeitbis' AND B.ends_at > '$bDay $zeitvon') AND B.court = $platzTmp
EOT;
          $rowCount = $pdo->query($sqlCheckPlatz)->rowCount();
          // TECHO(DEBUG, "Count: $rowCount\r\n sqlCheckPlatz: $sqlCheckPlatz\r\n"); echo "<br>";
          if ($rowCount > 0) {
            $bereitsBelegt .= $zeile . "\r\n";
          } else {
            $sql .= $zeile;
            $atLeastOne = true;
          }
        }
      }
    }
  }
  if ($atLeastOne) {
    $sql = rtrim($sql, ',');
    // TECHO(DEBUG, $sql);
    $statement = $pdo->prepare($sql);
    $statement->execute();

    // Die Serie mit Beschreibung noch in der Serien-Tabelle anlegen
    // Wenn es schiefgeht - egal, dann ist die Serie schon da, auch gut...
    $sql = <<<EOT
    INSERT INTO seriesnames (
      `series_id`, `created_at`, `comment`) 
    VALUES 
      ('$seriesid', '$jetzt','$comment')
    EOT;
    TLOG(DEBUG, $sql, __LINE__);
    $statement = $pdo->prepare($sql);
    $statement->execute();
  }



  if ($bereitsBelegt != "") {
?>
    <h2>Folgende Zeilen wurden nicht übernommen, da bereits überschneidende Belegungen existieren:</h2>
    <pre><?= $bereitsBelegt ?></pre>
  <?php
  }
}

*/

<?php
include("footer.inc.php");
?>