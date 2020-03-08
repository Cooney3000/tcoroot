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

$title = "Intern - Aktionen";
include("templates/header.inc.php");
?>
<script>
  // var element = document.getElementById("nav-intern");
  // element.classList.add("active");
  document.getElementById("nav-intern").classList.remove("active");
  document.getElementById("nav-einstellungen").classList.remove("active");
  document.getElementById("nav-turnier").classList.remove("active");
  document.getElementById("nav-halloffame").classList.remove("active");
  document.getElementById("nav-tafel").classList.remove("active");
  document.getElementById("nav-login").classList.remove("active");
  document.getElementById("nav-logout").classList.remove("active");
</script>
<div class="container main-container">

  <h1>Saisonvorbereitung: Tennis am Meer!</h1>

  <article class="m-3">
      
      <p class="h3">Liebe TCO‘ler</p>
      <br>
      <img src="/images/trainer/michael_goerzen_2.png" class="rounded float-right w-25" alt="Michael Görzen">
      <p>ich freue mich, als neuer Trainer mit euch in die Saison 2020 starten zu dürfen!</p>
      <br>
      Ich möchte euch als Saisonvorbereitung <strong>eine Woche Tennis am Meer</strong> anbieten:</p>
      <br>
      <ul class="aufzaehlung">
        <li>1 Woche Tennis am Meer</li>
        <li>Zeitraum: 11.4. - 18.4.2020</li>
        <li>Vorbereitungstraining auf die Saison 2020, auch Mannschaftstraining</li>
        <li>mit Flug, Transfer zum Hotel, Hotel und all incl. Verpflegung </li>
        <li>Abflughäfen: München, Nürnberg, Memmingen; eigene Anreise zum Flughafen</li>
        <li>5 Tage Tennis</li>
        <li>Tennistraining an 4 Tagen, 2 Mal täglich</li>
        <li>1 Tag organisiertes Turnier</li>
        <li>reservierte Tennis-Plätze für unsere Gruppe</li>
        <li>Bälle und Material werden vom Trainer zur Verfügung gestellt</li>
        <li>zusätzlich können weitere Sportangebote (wie z.B. Fitness) der Hotelanlage genutzt werden</li>
      </ul>
      <br>
      <p>Preis pro Person Doppelzimmer 850,-€</p>
      <p>Preis pro Person Einzelzimmer   980,-€</p>
      <br>
      <p>Es fallen keine weiteren Kosten an.</p>
      <br>
      <p>Mindestteilnehmerzahl: 8</p>
      <br>
      <p>Bitte meldet euch an per Email bis spätestens 22.3.2020 bei mir: <a href="mailto:michael070985@icloud.com">michael070985@icloud.com</a> oder hier mit diesem Formular:</p>
      <p>Unten seht Ihr, wer sich schon über das Formular angemeldet hat.</p>
      
  </article>

  <div class="registration-form">

    <?php

    $showFormular = 1;
    $cid = 1; // campaign-Id

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
          cmt
        FROM users as u 
        LEFT JOIN (
          SELECT 
            campaign_id AS ctid, 
            user_id AS cuid, 
            willing_to_attend AS wta, 
            comment AS cmt 
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

      error_log("0003 (record): " . http_build_query($result));
    }

    if ($registrieren) {

      $sql = "UPDATE users SET festnetz = '$festnetz', mobil = '$mobil' WHERE id = {$user['id']}";
      // error_log("0004: " . $sql);
      $pdo->query($sql);
      $sql = <<<EOT
    INSERT INTO campaign_users (campaign_id, user_id, willing_to_attend, comment) VALUES ($ctid, $cuid, $willTeilnehmen, "$kommentar") 
      ON DUPLICATE KEY 
    UPDATE willing_to_attend = $willTeilnehmen, comment = "$kommentar"
EOT;
      // error_log("0005: " . $sql);
      $statement = $pdo->query($sql);
      echo ('<br><strong class="text-success">Deine Anmeldung/Absage wurde gespeichert!</strong><br>');
    }


    if ($showFormular) {
    ?>
      <p class="h3 mt-4">Deine Turnier-Anmeldung:</p>
      <p>Name: <?= $vorname ?> <?= $nachname ?></p>

      <form id="registerTurnierForm" class="myform" action="?register=1" method="post">
        <input type="hidden" name="vorname" value="<?= $vorname ?>">
        <input type="hidden" name="nachname" value="<?= $nachname ?>">
        <input type="hidden" name="festnetz" value="<?= $festnetz ?>">
        <div class="form-group">
          <label for="mobil">Mobilnummer (WhatsApp): </label>
          <input class="form-control" type="text" id="mobil" name="mobil" value="<?= $mobil ?>">
          <label for="mobil">Festnetznummer: </label>
          <input class="form-control" type="text" id="festnetz" name="festnetz" value="<?= $festnetz ?>">
        </div>


        <div class="form-group alert-danger px-3">
          <span class="pr-3" for="inputZusage">Ich fahre mit ans Meer von 11.4. - 18.4.2020:&nbsp;</span>
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
          <label for="kommentar">Bemerkungen (z. B. "Ich habe kein WhatsApp"):</label>
          <textarea class="form-control" name="kommentar" rows="3"><?= $kommentar ?></textarea>
        </div>

        <button type="submit" class="btn btn-lg btn-success btn-block">Absenden</button>
      </form>

      <p class="h4">Bereits angemeldet:</p>
<?php
$sql = "SELECT * FROM users u, campaign_users c where u.id = user_id AND c.willing_to_attend = 1 ORDER BY u.nachname, u.vorname";
$statement = $pdo->prepare($sql);
$result = $statement->execute();
if($result) {
?>
    <br>
    <div class="mx-3">
    <table class="table table-bordered table-light tbl-small">
      <thead>
        <tr>
          <th>#</th>
          <th>Teilnehmer/in</th>
          <th>Tel</th>
          <th>Ist dabei</th>
          <th>Komm.</th>
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
          <td class="text-center"><?=$row['willing_to_attend']===NULL?'---':$row['willing_to_attend']==='1'?'J':'N'?></td>
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
include("templates/footer.inc.php")
?>