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

$title = "Intern - Matchtraining";
include("inc/header.inc.php");
?>
<script>
  // var element = document.getElementById("nav-intern");
  // element.classList.add("active");
  document.getElementById("nav-intern").classList.remove("active");
  document.getElementById("nav-turnier").classList.remove("active");
  document.getElementById("nav-halloffame").classList.remove("active");
  document.getElementById("nav-tafel").classList.remove("active");
  document.getElementById("nav-login").classList.remove("active");
  document.getElementById("nav-logout").classList.remove("active");
</script>
<div class="container main-container">

  <article class="m-3 clear-fix">

    <p class="h3 persoenlich text-gross">MATCHTRAINING</p>
    <h3>für jugendliche Mitglieder des TC Olching</h3>
    <p>Für das Matchtraining im Sommer '24 könnt Ihr die Kinder jetzt hier anmelden!</p>
    <p> Matchtraining bildet den Übergang vom Training mit überwiegend technisch orientiertem Anteil, zum spielsituativen und taktischen Training im Einzel als auch beim Doppel.</p>
    <p class="my-4"><strong>Bezahlung direkt beim Trainer selbst, das wird nicht über den Verein verwaltet!</strong></p>
    <table class="table table-sm table-success table-striped">
      <tr>
        <td>Start:</td>
        <td>06.05.2024</td>
      </tr>
      <tr>
        <td>Ende:</td>
        <td> 15.07.2024</td>
      </tr>
      <tr>
        <td>Trainingstag:</td>
        <td> Montag</td>
      </tr>
      <tr>
        <td>Uhrzeit:</td>
        <td> 17:00 - 18:00 Uhr</td>
      </tr>
      <tr>
        <td>Kein Training:</td>
        <td> 20.05.24 und 27.05.24 (Pfingstferien)</td>
      </tr>
      <tr>
        <td>Anzahl der Einheiten:</td>
        <td> 9</td>
      </tr>
      <tr>
        <td>Preis:</td>
        <td> 100 €</td>
      </tr>
    </table>

  </article>

  <div class="registration-form">

    <?php

    $showFormular = 1;
    $cid = 11; // campaign-Id

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
    $kommentar    = "";
    $info1    = "";

    if ($registrieren) {
      // Die Formularwerte übernehmen

      $nachname     = $_POST["nachname"];
      $vorname      = $_POST["vorname"];
      $festnetz     = $_POST["festnetz"];
      $mobil        = $_POST["mobil"];
      $ctid         = $cid;
      $cuid         = $user['id'];
      $willTeilnehmen  = $_POST["willTeilnehmen"] === "1" ? 1 : 0;
      $kommentar    = $_POST["kommentar"];
      $info1    = $_POST["info1"];
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
          info1
        FROM users as u 
        LEFT JOIN (
          SELECT 
            campaign_id AS ctid, 
            user_id AS cuid, 
            willing_to_attend AS wta, 
            comment AS cmt,
            info1 AS info1
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
      $info1  = isset($result["info1"]) ? $result["info1"] : $info1;

      error_log("0003 (record): " . http_build_query($result));
    }
    if ($registrieren) {

      $sql = "UPDATE users SET festnetz = '$festnetz', mobil = '$mobil' WHERE id = {$user['id']}";
      // error_log("0004: " . $sql);
      $pdo->query($sql);
      $sql = <<<EOT
    INSERT INTO campaign_users (campaign_id, user_id, willing_to_attend, comment, info1) VALUES ($ctid, $cuid, $willTeilnehmen, "$kommentar", "$info1") 
      ON DUPLICATE KEY 
    UPDATE willing_to_attend = $willTeilnehmen, comment = "$kommentar", info1 = "$info1"
EOT;
      // error_log("0005: " . $sql);
      $statement = $pdo->query($sql);
      echo ('<br><strong class="text-success">Deine Anmeldung/Absage wurde gespeichert!</strong><br>');
    }
    if ($showFormular) {
    ?>
      <p class="h3 mt-4">Deine Matchtraining-Anmeldung:</p>
      <p>Name: <?= $vorname ?> <?= $nachname ?></p>

      <form id="registerTurnierForm" class="myform" action="?register=1" method="post">
        <input type="hidden" name="vorname" value="<?= $vorname ?>">
        <input type="hidden" name="nachname" value="<?= $nachname ?>">
        <input type="hidden" name="festnetz" value="<?= $festnetz ?>">
        <input type="hidden" name="kommentar" value="<?= $comment ?>">
        <div class="form-group">
          <label for="mobil">Mobilnummer (WhatsApp): </label>
          <input class="form-control" type="text" id="mobil" name="mobil" value="<?= $mobil ?>">
        </div>


        <div class="form-group alert-danger px-3">
          <span class="pr-3" for="inputZusage">Ich möchte im Matchtraining dabei sein:&nbsp;</span>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="willTeilnehmen" id="willTeilnehmenJA" value="1" <?= ($willTeilnehmen ? 'checked' : '') ?> required>
            <label class="form-check-label" for="willTeilnehmenJA">Ja</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="willTeilnehmen" id="willTeilnehmenNEIN" value="0" <?= (!$willTeilnehmen ? 'checked' : '') ?>>
            <label class="form-check-label" for="willTeilnehmenNEIN">Nein</label>
          </div>
        </div>

        <div class="form-group">
          <label for="info1">Bemerkungen</label>
          <textarea class="form-control" name="info1" rows="2"><?= $info1 ?></textarea>
        </div>

        <button type="submit" class="btn btn-lg btn-success btn-block">Absenden</button>
      </form>

      <?php

      if (checkPermissions(TRAINER)) {


        $sql = "SELECT * FROM users u, campaign_users c where u.id = user_id AND c.willing_to_attend = 1 AND campaign_id = $cid ORDER BY u.nachname, u.vorname";
        $statement = $pdo->prepare($sql);
        $result = $statement->execute();

        //echo "<p><strong>TESTAUSGABEN<br>SQL: $sql<br>result: $result</strong></p>)";

        if ($result) {
      ?>
          <p class="h4">Bereits angemeldet:</p>
          <br>
          <div class="mx-3">
            <table class="table table-bordered table-light tbl-small">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Teilnehmer/in</th>
                  <th>Tel</th>
                  <th>Ist dabei</th>
                  <th>Trainingstyp</th>
                  <th>Info</th>
                </tr>
              </thead>
              <?php

              $lfd = 1;
              while ($row = $statement->fetch()) {
              ?>
                <tr>
                  <td><?= $lfd++ ?></td>
                  <td><?= $row['nachname'] . ' ' . $row['vorname'] ?></td>
                  <td><?= $row['mobil'] ?></td>
                  <td class="text-center"><?= ($row['willing_to_attend'] === NULL ? '---' : ($row['willing_to_attend'] === '1' ? 'J' : 'N')) ?></td>
                  <td><?= $row['comment'] ?></td>
                  <td><?= $row['info1'] ?></td>
                </tr>
        <?php
              }
              /*  ############## TESTEN ###############
############## TESTEN ############### */
              echo '</table>';
            } else {
              echo 'Beim Lesen der Daten ist leider ein Fehler aufgetreten. Bitte benachrichtige conny.roloff@tcolching.de<br>';
            }
          } //Ende von if($showFormular)
        } //Ende von if (checkPermissions(TRAINER))
        ?>


          </div>

  </div>

  <?php
  include("inc/footer.inc.php")
  ?>