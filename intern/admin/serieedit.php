<?php
session_start();
require_once("../inc/config.inc.php");
require_once("../inc/functions.inc.php");
require_once("../inc/permissioncheck.inc.php");

$user = check_user();

if (!checkPermissions(MANNSCHAFTSFUEHRER)) {
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

$serieedit = isset($_GET["serieedit"]) ? 1 : 0;
$userid = $user['id'];


if ($serieedit) {
  // if (true) {
  // Die Formularwerte übernehmen
  $wtag = [];
  $platz = [];
  $seriesid        = isset($_GET["seriesid"]) ?    $_GET["seriesid"] : '';
  $datumVon        = isset($_GET["datumvon"]) ?    $_GET["datumvon"] : '';
  $datumBis        = isset($_GET["datumbis"]) ?    $_GET["datumbis"] : '';
  $zeitvon         = isset($_GET["zeitvon"]) ?     $_GET["zeitvon"] : '';
  $zeitbis         = isset($_GET["zeitbis"]) ?     $_GET["zeitbis"] : '';
  $spieler1        = isset($_GET["spieler1"]) ?    $_GET["spieler1"] : 0;
  $spieler2        = isset($_GET["spieler2"]) ?    $_GET["spieler2"] : 0;
  $spieler3        = isset($_GET["spieler3"]) ?    $_GET["spieler3"] : 0;
  $spieler4        = isset($_GET["spieler4"]) ?    $_GET["spieler4"] : 0;
  $wtag[0]         = isset($_GET["montag"]) ?      '0' : '';
  $wtag[1]         = isset($_GET["dienstag"]) ?    '1' : '';
  $wtag[2]         = isset($_GET["mittwoch"]) ?    '2' : '';
  $wtag[3]         = isset($_GET["donnerstag"]) ?  '3' : '';
  $wtag[4]         = isset($_GET["freitag"]) ?     '4' : '';
  $wtag[5]         = isset($_GET["samstag"]) ?     '5' : '';
  $wtag[6]         = isset($_GET["sonntag"]) ?     '6' : '';
  $platz[0]        = isset($_GET["platz1"]) ?      $_GET["platz1"] : 0;
  $platz[1]        = isset($_GET["platz2"]) ?      $_GET["platz2"] : 0;
  $platz[2]        = isset($_GET["platz3"]) ?      $_GET["platz3"] : 0;
  $platz[3]        = isset($_GET["platz4"]) ?      $_GET["platz4"] : 0;
  $platz[4]        = isset($_GET["platz5"]) ?      $_GET["platz5"] : 0;
  $platz[5]        = isset($_GET["platz6"]) ?      $_GET["platz6"] : 0;
  $bookingType     = isset($_GET["bookingType"]) ? $_GET["bookingType"] : '';
  $kommentar       = isset($_GET["kommentar"]) ?   $_GET["kommentar"] : '';



  //   $sql = <<<EOT
  // INSERT INTO campaign_users (campaign_id, user_id, willing_to_attend, comment, info1, info2, info3) 
  //   VALUES ($ctid, $cuid, $willTeilnehmen, "$kommentar", "$nameKind", "$ausschluesse", "$anzahlTage") 
  //   ON DUPLICATE KEY 
  // UPDATE willing_to_attend = $willTeilnehmen, comment = "$kommentar", info1 = "$nameKind", info2 = "$ausschluesse", info3 = "$anzahlTage"
  // EOT;
  // error_log("0005: " . $sql);
  // AKTIVIEREN: $statement = $pdo->query($sql);

  $sql = <<<EOT
INSERT INTO bookings (
  `id`, `ta_id`, `booking_state`, `series_id`, 
  `created_at`, `updated_at`, `user_id`, `updated_by`, 
  `player1`, `player2`, `player3`, `player4`, 
  `court`, `starts_at`, `ends_at`, `booking_type`, 
  `comment`, `price`, `paid`) 
VALUES 
EOT;

  // Über den Zeitraum iterieren

  $bookingEnd = new DateTime($datumBis);

  // Die Iteration muss am ersten Tag der Woche des Startdatums beginnen

  // TECHO(DEBUG, $datumVon.": ".date('Y-m-d', strtotime(date('o-\WW', strtotime($datumVon)))));
  $ersterTagDerWoche = new DateTime(date('Y-m-d', strtotime(date('o-\WW', strtotime($datumVon)))));
// TECHO(DEBUG, date_diff($ersterTagDerWoche, $bookingEnd)->format('%R%a').'<br>');

  $jetzt = date('Y-m-d H:m');
  for ($bookingDay = new DateTime(date('Y-m-d', strtotime(date('o-\WW', strtotime($datumVon))))); 
       date_diff($bookingDay, $bookingEnd)->format('%R%a') >= 0; 
       $bookingDay = date_modify($bookingDay, '+1 week')) {
    // TECHO(DEBUG, $datumVon . ", " . date_format($bookingDay, 'Y-m-d') . ", $datumBis, " . date_diff($bookingDay, $bookingEnd)->format('%R%a') . "<br>");

    for ($wDays = 0; $wDays <= 6; $wDays++) {
      
      if ($wtag[$wDays] != '') {
        
        $modifiedDate = new DateTime(date_format($bookingDay, 'Y-m-d'));
        $bDay = date_format(date_modify($modifiedDate, "+$wDays day"), 'Y-m-d');

        for ($pI = 0; $pI < $CONFIG['anzahlPlaetze']; $pI++) {
          if ($platz[$pI] != '') {
            $platzTmp = $pI + 1;
            $sql .= <<<EOT
(0,0,'A','$seriesid',
'$jetzt','$jetzt',$userid,$userid,
$spieler1,$spieler2,$spieler3,$spieler4,
$platzTmp,'$bDay $zeitvon','$bDay $zeitbis','$bookingType',
'$kommentar','0','0'),
EOT;
          }
        }
      }
    }
  }
  // Das letzte Komma entfernen
  $sql = rtrim($sql, ',');
  // TECHO(DEBUG, $sql);
  $statement = $pdo->prepare($sql);
  $result = $statement->execute();
}

if ($showFormular) {
?>



  <div class="container main-container">
    <h2 class="h1">Plätze - Serienbuchung eingeben</h2>

    <form id="editSerieForm" class="formwidth" action="?serieedit=1" method="GET">
      <input type="hidden" id="serieedit" name="serieedit" value="1">
      <div class="form-group">
        <label for="seriesid">Serien-ID: </label>
        <input class="form-control" type="text" id="seriesid" name="seriesid" value="">
      </div>

      <div class="form-group">
        <label for="datumvon">Datum von: </label>
        <input class="form-control" type="date" id="datumvon" name="datumvon" value="TT.MM.JJJJ">
        <label for="datumbis">bis: </label>
        <input class="form-control" type="date" id="datumbis" name="datumbis" value="TT.MM.JJJJ">
      </div>

      <div class="form-group">
        <label for="zeitvon">Zeit von: </label>
        <input class="form-control" type="text" id="zeitvon" name="zeitvon" value="00:00">
        <label for="zeitbis">bis: </label>
        <input class="form-control" type="text" id="zeitbis" name="zeitbis" value="00:00">
      </div>

      <div class="form-group">
        <label for="spieler1">Spieler 1: </label>
        <select id="spieler1" name="spieler1" class="form-control" value="0" required>
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
        <select id="spieler2" name="spieler2" class="form-control" value="0" >
          <?= $optionsSpieler ?>
        </select>
        <select id="spieler3" name="spieler3" class="form-control" value="0" >
          <?= $optionsSpieler ?>
        </select>
        <select id="spieler4" name="spieler4" class="form-control" value="0" >
          <?= $optionsSpieler ?>
        </select>


        <div class="form-group">
          <label for="typ">Typ:</label>
          <select id="bookingType" name="bookingType" class="form-controlcustom-select custom-select" required>
            <option value="">- bitte auswählen -</option>
            <option value="ts-einzel">Einzel</option>
            <option value="ts-doppel">Doppel</option>
            <option value="ts-turnier">Turnier</option>
            <option value="ts-veranstaltung">Veranstaltung</option>
            <option value="ts-training">Training</option>
            <option value="ts-punktspiele">Punktspiele</option>
          </select>
        </div>


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
      <div class="form-group">
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

      <button type="submit" class="btn btn-lg btn-success btn-block">Absenden</button>
    </form>

  <?php

} //Ende von if($showFormular)
  ?>


  <?php
  include("footer.inc.php");
  ?>