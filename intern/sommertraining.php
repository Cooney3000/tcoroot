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

$title = "Intern - Sommer- und Herbsttraining";
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
  if (typeof(document.getElementById("nav-login").classList.remove("active"))) { document.getElementById("nav-login").classList.remove("active") }
  if (typeof(document.getElementById("nav-logout").classList.remove("active"))) {document.getElementById("nav-logout").classList.remove("active")}
</script>
<div class="container main-container">



  <h1>Anmeldung zum Sommertraining 2020!</h1>
  <h2>Anmeldung abgeschlossen. Bitte an <a href="training.php">Michael Görzen</a> wenden.</h2>
  <img src="/images/trainer/michael_goerzen_2.png" class="rounded float-right w-25" alt="Michael Görzen">

<?php
/*

<p><strong>Ort:</strong></p><p class="mb-4">TC Olching e.V.</p> 
  <p><strong>Zeitraum:</strong></p><p class="mb-4"> vom 04.05. – 2.10.2020 / Nicht in den Pfingst- und Sommerferien!</p> 
  <p><strong>Leistung:</strong></p><p class="mb-4">14 Stunden</p>
  <p><strong>Uhrzeit:</strong></p><p class="mb-4">Mo. - Fr. ab 14.00 bis 19.00 Uhr</p>                                                                                          
  <p class="mb-4">Bei schlechtem Wetter wird das Sommertraining in die Tennishalle nach Gernlinden verlegt. Dabei fallen keine weiteren Kosten an!</p>
  <p class="mb-4">Bei schlechtem Wetter wird das Herbsttraining um eine Woche nach hinten verschoben</p>
  <p><strong>Gebühren pro Teilnehmer:</strong></p>
  <p>4er Gruppe: 168,00 €</p>
  <p>3er Gruppe: 215,00 €</p>
  <p class="mb-4">2er Gruppe: 315,00 €</p> 
  <p class="mb-4"><strong>Anmeldung bitte hier im Formular</strong></p>

  <div class="registration-form">

    <?php

    $showFormular = 1;
    $cid = 3; // campaign-Id

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
    $nameKind     = "";
    $ausschluesse = "";
    $anzahlTage   = "1";

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
      $nameKind     = $_POST["nameKind"];
      $ausschluesse = $_POST["ausschluesse"];
      $anzahlTage   = $_POST["anzahlTage"];
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
          nameKind,
          ausschluesse,
          anzahlTage
        FROM users as u 
        LEFT JOIN (
          SELECT 
            campaign_id AS ctid, 
            user_id AS cuid, 
            willing_to_attend AS wta, 
            comment AS cmt,
            info1 AS nameKind,
            info2 AS ausschluesse,
            info3 AS anzahlTage 
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
      $nameKind      = isset($result["nameKind"]) ?     $result["nameKind"] : $kommentar;
      $ausschluesse  = isset($result["ausschluesse"]) ? $result["ausschluesse"] : $kommentar;
      $anzahlTage    = isset($result["anzahlTage"]) ?   $result["anzahlTage"] : $kommentar;

      error_log("0003 (record): " . http_build_query($result));
    }

    if ($registrieren) {

      $sql = "UPDATE users SET festnetz = '$festnetz', mobil = '$mobil' WHERE id = {$user['id']}";
      // error_log("0004: " . $sql);
      $pdo->query($sql);
      $sql = <<<EOT
    INSERT INTO campaign_users (campaign_id, user_id, willing_to_attend, comment, info1, info2, info3) 
      VALUES ($ctid, $cuid, $willTeilnehmen, "$kommentar", "$nameKind", "$ausschluesse", "$anzahlTage") 
      ON DUPLICATE KEY 
    UPDATE willing_to_attend = $willTeilnehmen, comment = "$kommentar", info1 = "$nameKind", info2 = "$ausschluesse", info3 = "$anzahlTage"
EOT;
      // error_log("0005: " . $sql);
      $statement = $pdo->query($sql);
      echo ('<br><strong class="text-success">Deine Anmeldung/Absage wurde gespeichert!</strong><br>');
    }


    if ($showFormular) {
    ?>
      <p class="h3 mt-4">Deine Anmeldung für das Sommertraining:</p>
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
          <span class="pr-3" for="inputZusage">Mein Kind nimmt am Sommertraining teil:&nbsp;</span>
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
          <label for="nameKind">Name des Kindes:</label>
          <input class="form-control" type="text" id="nameKind" name="nameKind" value="<?= $nameKind ?>">
        </div>

        <div class="form-group">
          <label for="ausschluesse">Zeiten, an denen es nicht geht (z. B. "Mittwochnachmittag bis 16h"):</label>
          <textarea class="form-control" name="ausschluesse" rows="4"><?= $ausschluesse ?></textarea>
        </div>

        <div class="form-group">
          <label for="anzahlTage">An wie vielen Tagen ist Training gewünscht:</label>
          <input class="form-control" type="text" id="anzahlTage" name="anzahlTage" value="<?= $anzahlTage ?>">
        </div>

        <div class="form-group">
          <label for="kommentar">Sonstige Bemerkungen:</label>
          <textarea class="form-control" name="kommentar" rows="3"><?= $kommentar ?></textarea>
        </div>

        <button type="submit" class="btn btn-lg btn-success btn-block">Absenden</button>
      </form>

      <p class="h4">Bereits angemeldet:</p>
<?php
$sql = "
  SELECT *, info1 AS nameKind, info2 AS ausschluesse, info3 AS anzahlTage 
    FROM users u, campaign_users c 
    WHERE u.id = user_id AND c.willing_to_attend = 1 AND campaign_id = $cid
    ORDER BY u.nachname, u.vorname";
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
          <th>Kind</th>
          <th>Ausschlüsse</th>
          <th>Anzahl Tage</th>
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
          <td class="text-center"><?=$row['willing_to_attend']===NULL?'---':$row['willing_to_attend']==='1'?'J':'N'?></td>
          <td><?=$row['nameKind']?></td>
          <td><?=str_replace("\r\n","<br>",$row['ausschluesse'])?></td>
          <td><?=$row['anzahlTage']?></td>
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


*/
?>
  </div>

</div>


<?php
include("templates/footer.inc.php")
?>