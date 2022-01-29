<?php
session_start();
require_once("inc/config.inc.php");
require_once("inc/functions.inc.php");
require_once("inc/permissioncheck.inc.php");

// Einstieg in den internen Bereich

//Überprüfe, dass der User eingeloggt und berechtigt ist
//Der Aufruf von check_user() muss in alle internen Seiten eingebaut sein
$user = check_user();
// error_log (join(" # ", $user));

$title = "Saisonabschluss";
include("templates/header.inc.php");
?>
<script>
  // var element = document.getElementById("nav-intern");
  // element.classList.add("active");
  document.getElementById("nav-intern").classList.remove("active");
  document.getElementById("nav-turnier").classList.remove("active");
  document.getElementById("nav-halloffame").classList.remove("active");
  document.getElementById("nav-tafel").classList.remove("active");
  if (typeof(document.getElementById("nav-login").classList.remove("active"))) { document.getElementById("nav-login").classList.remove("active") }
  if (typeof(document.getElementById("nav-logout").classList.remove("active"))) {document.getElementById("nav-logout").classList.remove("active")}
</script>
<div class="container main-container">

  <h1 class="h3 persoenlich text-gross">Saisonabschluss 2021!</h1>
  <!-- <img src="/images/trainer/michael_goerzen_2.png" class="rounded float-right w-25" alt="Michael Görzen"> -->
  <p class="persoenlich">Liebe TCO'ler!</p>
  <p>Zum Abschluss der Saison spielen am Samstag tagsüber einige Herrenmannschaften gegeneinander. Abends sind alle Mitglieder 
    herzlich aufgefordert, zu einem wie immer lockeren und geselligen Abendessen zusammenzukommen!</p>
  <p><strong>Ort: TC Olching e.V.</strong></p> 
  <p><strong>Zeit: Samstag, 2.10.2021 18:00 Uhr, Essen ab 19:00 Uhr</strong></p> 
  <p>Damit unsere Wirte Birgit und Nenad besser planen können, bitten wir Euch anzugeben, was Ihr essen wollt.</br>
  <strong>Bis Mittwochabend</strong> könnt Ihr Eure Angaben noch ändern. Daher auch die Option "<strong>Nichts</strong>".</p>
  <p><strong>Ab Donnerstag bitte ebenfalls Bescheid geben (Birgit&nbsp;Kruse:&nbsp;0162&nbsp;/&nbsp;817&nbsp;555&nbsp;5).</strong></p>

  <div class="registration-form">

    <?php

    $showFormular = 1;
    $cid = 8; // campaign-Id

    $registrieren = isset($_GET["register"]) ? 1 : 0;
    // error_log("0001: " . $registrieren);

    // REGISTRIERUNGSFORMULAR:
    // -----------------------
    // 1. Benutzerdaten einlesen oder aus dem Formular übernehmen: 
    //      users: Nachname, Vorname, Geschlecht, Mobilnummer, ...
    //      tournament_players: willing_to_attend, comment, ...
    // 2. Im Formular zur Verfügung stellen
    // 3. Speichern oder abbrechen

    $nachname     = "";
    $vorname      = "";
    $festnetz     = "";
    $mobil        = "";
    $ctid         = "";
    $cuid         = "";
    $willTeilnehmen  = 0;
    $essenWahl    = "";
    $kommentar    = "";

    if ($registrieren) {
      // Die Formularwerte übernehmen

      $nachname        = $_POST["nachname"];
      $vorname         = $_POST["vorname"];
      $festnetz        = $_POST["festnetz"];
      $mobil           = $_POST["mobil"];
      $ctid            = $cid;
      $cuid            = $user['id'];
      $willTeilnehmen  = $_POST["willTeilnehmen"] === "1" ? 1 : 0;
      $essenWahl       = $_POST["essenWahl"];
      $kommentar       = $_POST["kommentar"];
      // error_log("0000: $ctid    $cuid");

    } else {
      // Die Werte initial aus der DB lesen
      $sql = <<<EOT
      SELECT 
          u.vorname AS vn, 
          u.nachname AS nn, 
          u.festnetz AS fn, 
          u.mobil as mn, 
          ctid, 
          cuid, 
          wta, 
          cmt,
          essenWahl
        FROM users as u 
        LEFT JOIN (
          SELECT 
            campaign_id AS ctid, 
            user_id AS cuid, 
            willing_to_attend AS wta, 
            comment AS cmt,
            info1 AS essenWahl
          FROM campaign_users 
          WHERE campaign_id = $cid
          ) AS p
        ON u.id = p.cuid
        WHERE u.id = {$user['id']}
EOT;
      // $u=http_build_query($user);
      // echo("<pre>$user</pre>");
      // error_log("0002: " . $sql);
      $statement  = $pdo->query($sql);
      // Das sollte genau eine Ergebniszeile liefern
      $result     = $statement->fetch(PDO::FETCH_ASSOC);
      $nachname   = $result["nn"];
      $vorname    = $result["vn"];
      $festnetz   = $result["fn"];
      $mobil      = $result["mn"];
      $ctid       = isset($result["ctid"]) ? $result["ctid"] : "";
      $cuid       = isset($result["cuid"]) ? $result["cuid"] : "";
      $willTeilnehmen = isset($result["wta"]) ? $result["wta"] : $willTeilnehmen;
      $kommentar  = isset($result["cmt"]) ? $result["cmt"] : $kommentar;
      $essenWahl  = isset($result["essenWahl"]) ?     $result["essenWahl"] : $kommentar;

      error_log("0003 (record): " . http_build_query($result));
    }

    if ($registrieren) {

      $sql = "UPDATE users SET festnetz = '$festnetz', mobil = '$mobil' WHERE id = {$user['id']}";
      // error_log("0004: " . $sql);
      $pdo->query($sql);
      $sql = <<<EOT
    INSERT INTO campaign_users (campaign_id, user_id, willing_to_attend, comment, info1) 
      VALUES ($ctid, $cuid, $willTeilnehmen, "$kommentar", "$essenWahl") 
      ON DUPLICATE KEY 
    UPDATE willing_to_attend = $willTeilnehmen, comment = "$kommentar", info1 = "$essenWahl"
EOT;
      // error_log("0005: " . $sql);
      $statement = $pdo->query($sql);
      echo ('<br><strong class="text-success">Deine Anmeldung/Absage wurde gespeichert!</strong><br>');
    }

    if ($showFormular) {
    ?>
      <p class="h3 mt-4">Deine Anmeldung für das Essen zum Saisonabschluss:</p>
      <p>Name: <?= $vorname ?> <?= $nachname ?></p>

      <form id="registerTurnierForm" class="myform" action="?register=1" method="post">
        <input type="hidden" name="vorname" value="<?= $vorname ?>">
        <input type="hidden" name="nachname" value="<?= $nachname ?>">
        <input type="hidden" name="festnetz" value="<?= $festnetz ?>">
        <input type="hidden" name="willTeilnehmen" value="1">

        <div class="form-group">
          <label for="mobil">Mobilnummer (WhatsApp): </label>
          <input class="form-control" type="text" id="mobil" name="mobil" value="<?= $mobil ?>" disabled >
          <label for="mobil">Festnetznummer: </label>
          <input class="form-control" type="text" id="festnetz" name="festnetz" value="<?= $festnetz ?>" disabled >
        </div>

<!--         
        <div class="form-group alert-danger px-3">
          <span class="pr-3" for="inputZusage">Ich bin abends da:&nbsp;</span>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="willTeilnehmen" id="willTeilnehmenJA" value="1" <?= ($willTeilnehmen ? 'checked' : '') ?> required>
            <label class="form-check-label" for="willTeilnehmenJA">Ja</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="willTeilnehmen" id="willTeilnehmenNEIN" value="0" <?= (!$willTeilnehmen ? 'checked' : '') ?>>
            <label class="form-check-label" for="willTeilnehmenNEIN">Nein</label>
          </div>
        </div>
 -->

       <div class="form-group alert-danger px-3">
          <span class="pr-3" for="inputEssen">Ich möchte zu essen:&nbsp;</span>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="essenWahl" id="essenWahlSpareribs" value="Spareribs" <?= ($essenWahl=="Spareribs" ? 'checked' : '') ?> required disabled >
            <label class="form-check-label" for="essenWahlSpareribs">Spareribs</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="essenWahl" id="essenWahlGemuese" value="Gemüsepfanne" <?= ($essenWahl=="Gemüsepfanne" ? 'checked' : '') ?> disabled >
            <label class="form-check-label" for="essenWahlGemuese">Gemüsepfanne</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="essenWahl" id="essenWahlNichts" value="Nichts" <?= ($essenWahl=="Nichts" ? 'checked' : '') ?> disabled >
            <label class="form-check-label" for="essenWahlNichts">Nichts</label>
          </div>
        </div>

        <div class="form-group">
          <label for="kommentar">Bemerkung</label>
          <textarea class="form-control" name="kommentar" rows="3" disabled ><?= $kommentar ?></textarea>
        </div>

        <button type="submit" class="btn btn-lg btn-success btn-block" disabled>Absenden</button>
      </form>

      <p class="h4">Bereits angemeldet:</p>
<?php
    $sql = "
      SELECT *, info1 AS essenWahl 
        FROM users u, campaign_users c 
        WHERE u.id = user_id AND c.info1 <> 'Nichts' AND campaign_id = $cid
        ORDER BY u.nachname, u.vorname";
    $statement = $pdo->prepare($sql);
    $result = $statement->execute();
    if ($result) {
?>
    <br>
    <div class="mx-3">
    <table class="table table-bordered table-light tbl-small">
      <thead>
        <tr>
          <th>#</th>
          <th>Teilnehmer/in</th>
          <th>Tel</th>
          <th>Essenswahl</th>
          <th>Kommentar</th>
        </tr>
      </thead>
<?php
      $lfd = 1;
      while($row = $statement->fetch()) {
?>
        <tr>
          <td><?=$lfd++?></td>
          <td><?= $row['nachname'] . ' ' . $row['vorname'] ?></td>
          <td><?=$row['mobil']?></td>
          <td><?=$row['essenWahl']?></td>
          <td><?=$row['comment']?></td>
        </tr>
<?php
        }
        echo '</table>';
      } else {
        echo 'Beim Lesen der Daten ist leider ein Fehler aufgetreten. Bitte benachrichtige conny.roloff@tcolching.de<br>';
      }
    } //Ende von if($showFormular)
?>

  </div>

</div>


<?php
include("templates/footer.inc.php");
?>
