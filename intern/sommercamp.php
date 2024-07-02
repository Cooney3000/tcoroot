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

$title = "Sommercamp";
include("inc/header.inc.php");
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

<div class="container">
  <div class="row">
    <div class="col-lg-8">
      <h1 class="h3 persoenlich text-gross">Sommercamp 2024!</h1>
      <p class="persoenlich">An alle Jugendlichen des TCO!</p>
      <p>Auch in diesem Jahr führen wir wieder ein Tenniscamp für alle Jugendlichen, die Mitglied im TCO sind, in den Sommerferien durch.</p>
      <table class="table table-borderless">
        <tbody>
          <tr>
            <th scope="row"><strong>Datum:</strong></th>
            <td>29.07.2024 - 01.08.2024</td>
          </tr>
          <tr>
            <th scope="row"><strong>Zeit:</strong></th>
            <td>täglich von 10:00h - 15:00h</td>
          </tr>
          <tr>
            <th scope="row"><strong>Ablauf:</strong></th>
            <td>2 Stunden Training, 1 Stunde Mittagspause (Essen incl.), 2 Stunden Training</td>
          </tr>
          <tr>
            <th scope="row"><strong>Mindestteilnehmerzahl:</strong></th>
            <td>8</td>
          </tr>
          <tr>
            <th scope="row"><strong>Kosten:</strong></th>
            <td>150 EUR</td>
          </tr>
          <tr>
            <th scope="row"><strong>Anmeldeschluss:</strong></th>
            <td>21.07.2024</td>
          </tr>
        </tbody>
      </table>
      <p class="mb-4 persoenlich">Euer Michael</p>
      <p>P.S.: * falls ihr in der ersten Sommerferien-Woche nicht vor Ort seid aber dennoch Interesse an einem 
        Tenniscamp habt; in der zweiten Sommerferien-Woche wird über die Stadt Olching ebenso wieder ein Tenniscamp 
        bei uns durchgeführt. Hierfür muss man sich direkt über das „Ferienprogramm“ der Stadt Olching anmelden.</p>
    </div>
    <div class="col-lg-4 d-flex align-items-start">
      <img src="/images/trainer/michael_goerzen_portrait.png" class="rounded float-lg-right w-75" alt="Michael Görzen">
    </div>
  </div>
</div>



  <div class="registration-form">

    <?php

    $showFormular = 1;
    $cid = 12; // campaign-Id

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

      $nachname        = $_POST["nachname"];
      $vorname         = $_POST["vorname"];
      $festnetz        = $_POST["festnetz"];
      $mobil           = $_POST["mobil"];
      $ctid            = $cid;
      $cuid            = $user['id'];
      $willTeilnehmen  = $_POST["willTeilnehmen"] === "1" ? 1 : 0;
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

      // Mail an den Trainer versenden
      $JN = $willTeilnehmen?"Ja":"Nein";
      $empfaenger = $CONFIG['trainerMailAddress'];
      $betreff = "Eine Anmeldung für das Sommercamp";
      $from  = "From: " . $CONFIG['webmasterMailAddress'] . "\r\n";
      $from .= "Bcc: " . $CONFIG['webmasterMailAddress'] . "\r\n";
      $from .= "Reply-To: " . $CONFIG['webmasterMailAddress'] . "\r\n";
      $from .= "Content-Type: text/html; charset=utf-8\r\n";
      $text = <<<EOT
<p>Hallo {$CONFIG['trainerVorname']} {$CONFIG['trainerNachname']},</p>

<p>
Ein Teilnehmer hat sich für das Jugend-Sommercamp 2024 angemeldet:
</p>
<p>Nachname: $nachname      </p>
<p>Vorname: $vorname       </p>
<p>Festnetz: $festnetz      </p>
<p>Mobil: $mobil         </p>
<p>Will teilnehmen: $JN</p>
<p>Kommentar: $kommentar     </p>

<p>Viele Grüße</p>
<p>Der TC Olching e.V.</p>
EOT;
      $mailGesendet = mail($empfaenger, $betreff, $text, $from);
      TECHO(DBG, "Mail gesendet = $mailGesendet");

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
          <span class="pr-3" for="inputZusage">Ich nehme / Mein Kind nimmt am Sommercamp teil:&nbsp;</span>
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
          <label for="kommentar">Bemerkungen:</label>
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
          <th>Bin dabei</th>
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
          <td class="text-center">
            <?php 
              echo ($row['willing_to_attend']===NULL)?'---':(($row['willing_to_attend']==='1')?'J':'N'); 
            ?>
          </td>
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
include("inc/footer.inc.php")
?>