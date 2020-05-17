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

$title = "Intern - Jugendclubmeisterschaften 2020";
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

  <h1 class="mb-5">Anmeldung zu den Jugend&shy;clubmeister&shy;schaften 2020!</h1>
  <img src="/images/jugendmeister2019.jpg" class="rounded float-right w-25" alt="Jugendclubmeister 2019">
  
  <p class="h4 mb-2"><u>Termin:</u> Samstag, 25.04.2020 bis Sonntag, 26.04.2020</p> 
  <p>(Ersatztermin: Samstag, 02.05. bis Sonntag, 03.05.2020)</p> 

  <p class="mt-5"><u>In folgenden Altersklassen wollen wir den/die Clubmeister/-in ermitteln:</u></p>
  <ul>
    <li>Knaben (13 – 14 Jahre)</li>
    <li>Knaben (15 – 18 Jahre)</li>
    <li>Mädchen (13 – 14 Jahre</li>
    <li>Mädchen (15 – 18 Jahre</li>
    <li>Bambini (11 – 12 Jahre</li>
    <li>Midcourt (7 – 10 Jahre</li>
  </ul>

  <p>Wir freuen uns über sehr viele Anmeldungen! Bitte gebt unbedingt an, in welcher 
    Altersklasse Ihr spielen wollt.</p>
  <p>Sollte aufgrund von zu wenigen Meldungen eine Konkurrenz nicht zustande kommen, 
    werden wir Altersklassen zusammenlegen!</p>

  <p class="h4 my-4"><u>Anmeldeschluss:</u> Montag, 20.04.2020</p>
  <p class="mb-4"><strong>Anmeldung bitte hier im Formular weiter unten!</strong></p>

  <p class="mb-2">Den Spielplan und die Spielansetzungen bekommt Ihr bis spätestens 
    <strong>Mittwoch, 22.04.2020</strong> per Mail.</p>
  <p class="mb-2">Die Startgebühr beträgt für jeden <strong>&euro; 5,00</strong></p>

  <p>Für die Erstplatzierten wird es Medaillen geben und jeder Teilnehmer erhält einen 
    kleinen Sachpreis.</p>

  <p class="h4 my-3"><u>Turnierbeginn:</u></p>
  <p class="mb-3">Samstag, 25.04.2020 ab 10.00 Uhr<br>
    Sonntag, 26.04.2020 nach Turnierverlauf und in Absprache</p>

  <p>Der Vorstand und die Jugendleitung freuen sich über eine rege Teilnahme, faire 
    Spiele und viel Spaß auf unserer Tennisanlage.</p>

  <p class="my-4">Liebe Grüße</p>
  <p class="lead"><em>Petra Streif</em></p>
  <p>(Jugendsportwart)</p>
  
  <div class="registration-form">

    <?php

    $showFormular = 1;
    $cid = 4; // campaign-Id

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
    $altersklasse = "";
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
      $altersklasse = $_POST["altersklasse"];
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
          altersklasse
        FROM users as u 
        LEFT JOIN (
          SELECT 
            campaign_id AS ctid, 
            user_id AS cuid, 
            willing_to_attend AS wta, 
            comment AS cmt,
            info1 AS nameKind,
            info2 AS altersklasse
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
      $altersklasse    = isset($result["altersklasse"]) ?   $result["altersklasse"] : $kommentar;

      error_log("0003 (record): " . http_build_query($result));
    }

    if ($registrieren) {

      $sql = "UPDATE users SET festnetz = '$festnetz', mobil = '$mobil' WHERE id = {$user['id']}";
      // error_log("0004: " . $sql);
      $pdo->query($sql);
      $sql = <<<EOT
    INSERT INTO campaign_users (campaign_id, user_id, willing_to_attend, comment, info1, info2) 
      VALUES ($ctid, $cuid, $willTeilnehmen, "$kommentar", "$nameKind", "$altersklasse") 
      ON DUPLICATE KEY 
    UPDATE willing_to_attend = $willTeilnehmen, comment = "$kommentar", info1 = "$nameKind", info2 = "$altersklasse"
EOT;
      // error_log("0005: " . $sql);
      $statement = $pdo->query($sql);
      echo ('<br><strong class="text-success">Deine Anmeldung/Absage wurde gespeichert!</strong><br>');
    }


    if ($showFormular) {
    ?>
      <p class="h3 mt-4">Deine Anmeldung für die Jugendclubmeisterschaften:</p>
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
          <span class="pr-3" for="inputZusage">Mein Kind nimmt an den Jugendclubmeisterschaften teil:&nbsp;</span>
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
          <label for="altersklasse">Altersklasse:</label>
          <select id="altersklasse" name="altersklasse" class="form-controlcustom-select custom-select" required>
            <option value="">- bitte auswählen -</option>
<?php
              $altersklassen = array(
                "Knaben (13 – 14 Jahre) ",
                "Knaben (15 – 18 Jahre) ",
                "Mädchen (13 – 14 Jahre)",
                "Mädchen (15 – 18 Jahre)",
                "Bambini (11 – 12 Jahre)",
                "Midcourt (7 – 10 Jahre)"
              );
              foreach ($altersklassen as $ak) {
                $sel = ($ak === $altersklasse) ? " selected" : "";
                echo ("  <option$sel value=\"$ak\">$ak</option>");
              }
  
?>

            <option value="Knaben (13 – 14 Jahre)"> Knaben (13 – 14 Jahre) </option>
            <option value="Knaben (15 – 18 Jahre)"> Knaben (15 – 18 Jahre) </option>
            <option value="Mädchen (13 – 14 Jahre)">Mädchen (13 – 14 Jahre)</option>
            <option value="Mädchen (15 – 18 Jahre)">Mädchen (15 – 18 Jahre)</option>
            <option value="Bambini (11 – 12 Jahre)">Bambini (11 – 12 Jahre)</option>
            <option value="Midcourt (7 – 10 Jahre)">Midcourt (7 – 10 Jahre)</option>
          </select>
        </div>
        <div class="form-group">
          <label for="kommentar">Sonstige Bemerkungen:</label>
          <textarea class="form-control" name="kommentar" rows="3"><?= $kommentar ?></textarea>
        </div>

        <button type="submit" class="btn btn-lg btn-success btn-block">Absenden</button>
      </form>

      <p class="h4">Bereits angemeldet:</p>
<?php
$sql = "SELECT *, info1 AS nameKind, info2 AS altersklasse 
          FROM users u, campaign_users c 
          WHERE u.id = user_id AND campaign_id = $cid
          AND c.willing_to_attend = 1 
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
          <th>Altersklasse</th>
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
          <td><?=str_replace("\r\n","<br>",$row['altersklasse'])?></td>
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