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

$showFormular = 1;

$serieedit = isset($_POST["serieedit"]) ? 1 : 0;
$userid = $user['id'];


if ($serieedit) {
  // if (true) {
  // Die Formularwerte übernehmen
  $wtag = [];
  $platz = [];
  $seriesid        = isset($_POST["seriesid"]) ?        $_POST["seriesid"] : '';
  $comment         = isset($_POST["comment"]) ?         $_POST["comment"] : '';
  $spieler1        = isset($_POST["spieler1"]) ?        $_POST["spieler1"] : 0;
  $spieler2        = isset($_POST["spieler2"]) ?        $_POST["spieler2"] : 0;
  $spieler3        = isset($_POST["spieler3"]) ?        $_POST["spieler3"] : 0;
  $spieler4        = isset($_POST["spieler4"]) ?        $_POST["spieler4"] : 0;
  $zeitvon         = isset($_POST["zeitvon"]) ?         $_POST["zeitvon"] : '';
  $zeitbis         = isset($_POST["zeitbis"]) ?         $_POST["zeitbis"] : '';
  $einzelstunden   = isset($_POST["einzelstunden"]) ?   $_POST["einzelstunden"] : 0;
  $platz[0]        = isset($_POST["platz1"]) ?          $_POST["platz1"] : 0;
  $platz[1]        = isset($_POST["platz2"]) ?          $_POST["platz2"] : 0;
  $platz[2]        = isset($_POST["platz3"]) ?          $_POST["platz3"] : 0;
  $platz[3]        = isset($_POST["platz4"]) ?          $_POST["platz4"] : 0;
  $platz[4]        = isset($_POST["platz5"]) ?          $_POST["platz5"] : 0;
  $platz[5]        = isset($_POST["platz6"]) ?          $_POST["platz6"] : 0;
  $bookingType     = isset($_POST["bookingType"]) ?     $_POST["bookingType"] : '';
  $kommentar       = isset($_POST["kommentar"]) ?       $_POST["kommentar"] : '';
  $zeitraum        = isset($_POST["zeitraum"]) ?        $_POST["zeitraum"] : '';
  $datumVon        = isset($_POST["datumvon"]) ?        $_POST["datumvon"] : '';
  $datumBis        = isset($_POST["datumbis"]) ?        $_POST["datumbis"] : '';
  $wtag[0]         = isset($_POST["montag"]) ?          '0' : '';
  $wtag[1]         = isset($_POST["dienstag"]) ?        '1' : '';
  $wtag[2]         = isset($_POST["mittwoch"]) ?        '2' : '';
  $wtag[3]         = isset($_POST["donnerstag"]) ?      '3' : '';
  $wtag[4]         = isset($_POST["freitag"]) ?         '4' : '';
  $wtag[5]         = isset($_POST["samstag"]) ?         '5' : '';
  $wtag[6]         = isset($_POST["sonntag"]) ?         '6' : '';
  $einzelDatum    = isset($_POST["einzeldatum"]) ?    $_POST["einzeldatum"] : '';


  // TECHO(DEBUG, http_build_query($_POST), __LINE__);


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

if ($showFormular) {
  ?>


  <div class="container main-container">
    <h1>Serienbuchungen</h1>
    <h2>Bestehende Serie auswählen</h2>
    <p>
    <form id="allseries" class="formwidth" action="seriedetails.php" method="POST">
      <select id="sid" name="sid" class="form-select text-white border-white bg-secondary"  onchange="this.form.submit()">
      <option value="-">-</option>
      <?php

      $yyyy = date("Y");
      $sql = "SELECT DISTINCT series_id, '', '' FROM  bookings where  NOT series_id IS NULL AND starts_at LIKE '{$yyyy}%'";
      $sql = "SELECT series_id, created_at, comment FROM  seriesnames ORDER BY series_id";
        foreach ($pdo->query($sql) as $row) {
        if ($row['series_id'] > '') {
      ?>
        <option value="<?= $row['series_id'] ?>"><?= $row['series_id'] ?> - <?= $row['comment'] ?></option>
<!-- <span><a class="btn btn-secondary py-0 my-1" href="seriedetails.php?sid=<?= $row['series_id'] ?>"><?= $row['series_id'] ?></a> </span> -->
      <?php
        }
      }
      ?>
      </select>
    </form>
    </p>
    <h2>Neue Serienbuchung eingeben</h2>

    <form id="editSerieForm" class="formwidth" action="?serieedit=1" method="POST">
      <input type="hidden" id="serieedit" name="serieedit" value="1">
      <div class="form-group">
        <label for="seriesid">Serien-ID (bitte eine sprechende, neue, eindeutige ID wählen, z.B. "DropIn-2020"): </label>
        <input class="form-control" type="text" id="seriesid" name="seriesid" value="" required>
      </div>

      <div class="form-group">
        <label for="comment">Kommentar (Erläuterung, was das für eine Serie ist): </label>
        <input class="form-control" type="text" id="comment" name="comment" value="">
      </div>

      <div class="form-group">
        <label for="zeitvon">Zeit von: </label>
        <select id="zeitvon" name="zeitvon" class="form-select">
          <option value="08:00">08:00h</option>
          <option value="08:30">08:30h</option>
          <option value="09:00">09:00h</option>
          <option value="09:30">09:30h</option>
          <option value="10:00">10:00h</option>
          <option value="10:30">10:30h</option>
          <option value="11:00">11:00h</option>
          <option value="11:30">11:30h</option>
          <option value="12:00">12:00h</option>
          <option value="12:30">12:30h</option>
          <option value="13:00">13:00h</option>
          <option value="13:30">13:30h</option>
          <option value="14:00">14:00h</option>
          <option value="14:30">14:30h</option>
          <option value="15:00">15:00h</option>
          <option value="15:30">15:30h</option>
          <option value="16:00">16:00h</option>
          <option value="16:30">16:30h</option>
          <option value="17:00">17:00h</option>
          <option value="17:30">17:30h</option>
          <option value="18:00">18:00h</option>
          <option value="18:30">18:30h</option>
          <option value="19:00">19:00h</option>
          <option value="19:30">19:30h</option>
          <option value="20:00">20:00h</option>
          <option value="20:30">20:30h</option>
          <option value="21:00">21:00h</option>
        </select>


        <label for="zeitbis">bis: </label>
        <select id="zeitbis" name="zeitbis" class="form-select">
          <option value="08:00">08:00h</option>
          <option value="08:30">08:30h</option>
          <option value="09:00">09:00h</option>
          <option value="09:30">09:30h</option>
          <option value="10:00">10:00h</option>
          <option value="10:30">10:30h</option>
          <option value="11:00">11:00h</option>
          <option value="11:30">11:30h</option>
          <option value="12:00">12:00h</option>
          <option value="12:30">12:30h</option>
          <option value="13:00">13:00h</option>
          <option value="13:30">13:30h</option>
          <option value="14:00">14:00h</option>
          <option value="14:30">14:30h</option>
          <option value="15:00">15:00h</option>
          <option value="15:30">15:30h</option>
          <option value="16:00">16:00h</option>
          <option value="16:30">16:30h</option>
          <option value="17:00">17:00h</option>
          <option value="17:30">17:30h</option>
          <option value="18:00">18:00h</option>
          <option value="18:30">18:30h</option>
          <option value="19:00">19:00h</option>
          <option value="19:30">19:30h</option>
          <option value="20:00">20:00h</option>
          <option value="20:30">20:30h</option>
          <option value="21:00">21:00h</option>
        </select>
      </div>

      <p class="my-3">
        <!-- <button class="btn btn-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseZeitraum" aria-expanded="true" aria-controls="collapseZeitraum"> -->
        Zeitraum:
        <!-- </button> -->
      </p>
      <!-- <div class="collapse" id="collapseZeitraum"> -->
      <div class="form-group my-3">
        <div class="card card-body">
          <div class="form-group">
            <label for="datumvon">Datum von: </label>
            <input class="form-control" type="date" id="datumvon" name="datumvon" placeholder="TT.MM.JJJJ" value="">
            <label for="datumbis">bis: </label>
            <input class="form-control" type="date" id="datumbis" name="datumbis" placeholder="TT.MM.JJJJ" value="">
          </div>
          <p>jeweils am:</p>
          <div class="form-group">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="1" name="montag" id="montag">
              <label class="form-check-label" for="flexCheckChecked">
                Montag
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="2" name="dienstag" id="dienstag">
              <label class="form-check-label" for="flexCheckChecked">
                Dienstag
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="3" name="mittwoch" id="mittwoch">
              <label class="form-check-label" for="flexCheckChecked">
                Mittwoch
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="4" name="donnerstag" id="donnerstag">
              <label class="form-check-label" for="flexCheckChecked">
                Donnerstag
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="5" name="freitag" id="freitag">
              <label class="form-check-label" for="flexCheckChecked">
                Freitag
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="6" name="samstag" id="samstag">
              <label class="form-check-label" for="flexCheckChecked">
                Samstag
              </label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" value="7" name="sonntag" id="sonntag">
              <label class="form-check-label" for="flexCheckDefault">
                Sonntag
              </label>
            </div>
          </div>
        </div>
        <!-- </div> -->


        <div class="form-group">
          <label for="spieler1">Spieler 1: </label>
          <select id="spieler1" name="spieler1" class="form-select" value="0" required>
            <?php
            $optionsSpieler = "";
            $sqlselect = "
SELECT id, vorname, nachname FROM users
  ORDER BY nachname, vorname";
            $statement = $pdo->prepare($sqlselect);
            $result = $statement->execute();
            if ($result) {

              while ($row = $statement->fetch()) {
                $rid = $row['id'] == '24' ? '0' : $row['id'];
                $optionsSpieler .= ('<option value="' . $rid . '">' . $row['nachname'] . " " . $row['vorname'] . '</option>');
              }
            }
            echo ($optionsSpieler);
            ?>
          </select>
          <select id="spieler2" name="spieler2" class="form-select" value="0">
            <?= $optionsSpieler ?>
          </select>
          <select id="spieler3" name="spieler3" class="form-select" value="0">
            <?= $optionsSpieler ?>
          </select>
          <select id="spieler4" name="spieler4" class="form-select" value="0">
            <?= $optionsSpieler ?>
          </select>
        </div>



        <div class="form-group">
          <label for="typ">Typ:</label>
          <select id="bookingType" name="bookingType" class="form-select custom-select custom-select" required>
            <option value="">- bitte auswählen -</option>
            <option value="ts-einzel">Einzel</option>
            <option value="ts-doppel">Doppel</option>
            <option value="ts-turnier">Turnier</option>
            <option value="ts-veranstaltung">Veranstaltung</option>
            <option value="ts-training">Training</option>
            <option value="ts-punktspiele">Punktspiele</option>
            <option value="ts-trbuchung">Trainer-Buchung</option>
          </select>
        </div>

        <div class="form-group mt-3">
          <div class="form-check">
            <input class="form-check-input" type="checkbox" name="einzelstunden" id="einzelstunden">
            <label class="form-check-label" for="flexCheckDefault">
              Zeitraum als Einzelstunden buchen (z. B. Zeit 08:00 - 12:00 erzeugt nicht eine, sondern vier Buchungen)
            </label>
          </div>
        </div>

        <div class="form-group mt-3">
          <div class="form-check">
            <input class="form-check-input" type="checkbox" name="platz1" id="platz1">
            <label class="form-check-label" for="flexCheckDefault">
              Platz 1
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="checkbox" name="platz2" id="platz2">
            <label class="form-check-label" for="flexCheckChecked">
              Platz 2
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="checkbox" name="platz3" id="platz3">
            <label class="form-check-label" for="flexCheckChecked">
              Platz 3
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="checkbox" name="platz4" id="platz4">
            <label class="form-check-label" for="flexCheckChecked">
              Platz 4
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="checkbox" name="platz5" id="platz5">
            <label class="form-check-label" for="flexCheckChecked">
              Platz 5
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="checkbox" name="platz6" id="platz6">
            <label class="form-check-label" for="flexCheckChecked">
              Platz 6
            </label>
          </div>
        </div>
        <div class="form-group">
          <label for="kommentar">Kommentarfeld-Text:</label>
          <textarea class="form-control" name="kommentar" rows="3"></textarea>
        </div>

        <!-- Einzeltage buchen -->

        <p class="my-3">
          <button class="btn btn-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseEinzeltermine" aria-expanded="false" aria-controls="collapseEinzeltermine">
            Einzeltermine hinzufügen
          </button>
        </p>

        <div class="collapse" id="collapseEinzeltermine">
          <div class="card card-body">
            <div class="form-group">
              <input class="form-control" type="date" name="einzeldatum[]" placeholder="TT.MM.JJJJ" value="">
              <input class="form-control" type="date" name="einzeldatum[]" placeholder="TT.MM.JJJJ" value="">
              <input class="form-control" type="date" name="einzeldatum[]" placeholder="TT.MM.JJJJ" value="">
              <input class="form-control" type="date" name="einzeldatum[]" placeholder="TT.MM.JJJJ" value="">
              <input class="form-control" type="date" name="einzeldatum[]" placeholder="TT.MM.JJJJ" value="">
              <input class="form-control" type="date" name="einzeldatum[]" placeholder="TT.MM.JJJJ" value="">
              <input class="form-control" type="date" name="einzeldatum[]" placeholder="TT.MM.JJJJ" value="">
              <input class="form-control" type="date" name="einzeldatum[]" placeholder="TT.MM.JJJJ" value="">
              <input class="form-control" type="date" name="einzeldatum[]" placeholder="TT.MM.JJJJ" value="">
              <input class="form-control" type="date" name="einzeldatum[]" placeholder="TT.MM.JJJJ" value="">
              <input class="form-control" type="date" name="einzeldatum[]" placeholder="TT.MM.JJJJ" value="">
              <input class="form-control" type="date" name="einzeldatum[]" placeholder="TT.MM.JJJJ" value="">
              <input class="form-control" type="date" name="einzeldatum[]" placeholder="TT.MM.JJJJ" value="">
              <input class="form-control" type="date" name="einzeldatum[]" placeholder="TT.MM.JJJJ" value="">
              <input class="form-control" type="date" name="einzeldatum[]" placeholder="TT.MM.JJJJ" value="">
            </div>
          </div>
        </div>

        <button type="submit" class="btn btn-lg btn-success btn-block">Absenden</button>
    </form>
  </div>

<?php

} //Ende von if($showFormular)
?>


<?php
include("footer.inc.php");
?>