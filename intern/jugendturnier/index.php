<?php
session_start();
require_once("../inc/config.inc.php");
require_once("../inc/functions.inc.php");
require_once("../inc/permissioncheck.inc.php");

$user = check_user();

$title = "Jugendturnierregistrierung";
include("../inc/header.inc.php");
?>
<script>
  // var element = document.getElementById("nav-intern");
  // element.classList.add("active");
  document.getElementById("nav-intern").classList.remove("active");
  document.getElementById("nav-turnier").classList.add("active");
  document.getElementById("nav-tafel").classList.remove("active");
  document.getElementById("nav-login").classList.remove("active");
  document.getElementById("nav-logout").classList.remove("active");
</script>

<div class="container main-container">
  <h1 class="mb-0">JUGENDCLUBMEISTERSCHAFTEN 2020</h1>
  <h2 class="mt-0">(Juli - September 2020)</h2>

  <div class="container mt-4">
    <div class="row">

      <div class="col-sm m-1">
        <div class="h-100 bg-light p-2">
          <a class="btn btn-success w-100" href="bereitsAngemeldet.php">Liste der Spieler</a>
          <h5 class="h-25 m-2">Anmeldeliste</h5>
          <p class="h-25 pl-2">Wer eigentlich mitspielt</p>
        </div>
      </div>
      <div class="col-sm m-1">
        <div class="h-100 bg-light p-2">
          <a class="btn btn-success w-100" href="infoAblauf.php">Ablauf</a>
          <h5 class="h-25 m-2">Ablauf</h5>
          <p class="h-25 pl-2">Bälle, Terminvereinbarung, Regeln, ...</p>
        </div>
      </div>
    </div>
    <div class="row">
    </div>
    <div class="row">
      <div class="col-sm m-1">
        <div class="h-100 bg-light p-2">
          <a class="btn btn-success w-100" href="turnierbaum.php">Turnierbaum</a>
          <h5 class="h-25 m-2">Turnierbäume</h5>
          <p class="h-25 pl-2">Der aktuelle Turnierstatus</p>
        </div>
      </div>
      <div class="col-sm m-1">
        <div class="h-100 bg-light p-2">
          <a class="btn btn-success w-100" href="begegnungen.php">Begegnungen</a>
          <h5 class="h-25 m-2">Begegnungen</h5>
          <p class="h-25 pl-2">Wer wann gegen wen spielt</p>
        </div>
      </div>
      <?php
      // Turnierverantwortliche erhalten mehr Buttons
      if (isset($_SESSION['userid']) && checkPermissions(T_ALL_PERMISSIONS)) {
      ?>
        <div class="col-sm m-1">
          <div class="h-100 bg-light p-2">
            <a class="btn btn-danger w-100" href="bereitsAngemeldetEdit.php">Spieler bearbeiten</a>
            <p class="h-25 pl-2">(Nur für Admins sichtbar)</p>
          </div>
        </div>
        <div class="col-sm m-1">
          <div class="h-100 bg-light p-2">
            <a class="btn btn-danger w-100" href="bereitsAngemeldetBEdit.php">Spieler bearbeiten (B-Runde)</a>
            <p class="h-25 pl-2">(Nur für Admins sichtbar)</p>
          </div>
        </div>
      <?php
      }
      ?>
    </div> <!-- row -->
  </div> <!-- container -->


  <!-- <h2>Turnieranmeldung (Registrierung geschlossen)</h2> -->
  <div class="registration-form">

    <?php

    $showFormular = 1;
    $tid = $CONFIG['activeTournamentJ'];
    $registrieren = isset($_GET["register"]) ? 1 : 0;
    // error_log("0001: " . $registrieren);

    // REGISTRIERUNGSFORMULAR:
    // -----------------------
    // 1. Benutzerdaten einlesen oder aus dem Formular übernehmen: 
    //      users: Nachname, Vorname, Geschlecht, Mobilnummer, ...
    //      tournament_players: willing_to_play, comment, ...
    // 2. Im Formular zur Verfügung stellen
    // 3. Speichern oder abbrechen

    $nachname     = "";
    $vorname      = "";
    $festnetz     = "";
    $mobil        = "";
    $ttid         = "";
    $tuid         = "";
    $willSpielen  = 0;
    $lk           = "";
    $kommentar    = "";

    if ($registrieren) {
      // Die Formularwerte übernehmen

      $nachname     = $_POST["nachname"];
      $vorname      = $_POST["vorname"];
      $festnetz     = $_POST["festnetz"];
      $mobil        = $_POST["mobil"];
      $ttid         = $tid;
      $tuid         = $user;
      $willSpielen  = $_POST["willSpielen"] === "1" ? 1 : 0;
      $lk           = $_POST["lk"];
      $kommentar    = $_POST["kommentar"];
    } else {
      // Die Werte initial aus der DB lesen
      $sql = <<<EOT
      SELECT 
          u.vorname AS vn, 
          u.nachname AS nn, 
          u.festnetz AS fn, 
          u.mobil as mn, 
          ttid, 
          tuid, 
          lk, 
          wtp, 
          cmt
        FROM users as u 
        LEFT JOIN (
          SELECT 
            tournament_id AS ttid, 
            user_id AS tuid, 
            willing_to_play AS wtp, 
            lk, 
            comment AS cmt 
          FROM tournament_players 
          WHERE tournament_id = $tid
          ) AS p
        ON u.id = p.tuid
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
      $ttid       = isset($result["ttid"]) ? $result["ttid"] : "";
      $tuid       = isset($result["tuid"]) ? $result["tuid"] : "";
      $willSpielen = isset($result["wtp"]) ? $result["wtp"] : $willSpielen;
      $lk         = isset($result["lk"]) ? $result["lk"] : $lk;
      $kommentar  = isset($result["cmt"]) ? $result["cmt"] : $kommentar;

      // error_log("0003 (record): " . http_build_query($result));
    }

    if ($registrieren) {
      $statement = $pdo->prepare("UPDATE users SET festnetz = :festnetz, mobil = :mobil WHERE id = :user");
      $statement->execute(array('festnetz' => $festnetz, 'user' => $user['id'], 'mobil' => $mobil));
      $statement = $pdo->prepare("INSERT INTO tournament_players (tournament_id, user_id, willing_to_play, lk, comment) VALUES (:ttid, :tuid, :willSpielen, :lk, :kommentar) 
        ON DUPLICATE KEY 
        UPDATE willing_to_play = :willSpielen, lk = :lk, comment = :kommentar");
      $statement->execute(array('ttid' => $ttid, 'tuid' => $tuid['id'], 'willSpielen' => $willSpielen, 'lk' => $lk, 'kommentar' => $kommentar));
      echo ('<br><strong class="text-success">Deine Anmeldung/Absage wurde gespeichert!</strong><br>');
    }


    if ($showFormular) {
    ?>
      <p class="h3 mt-4">Deine Turnier-Anmeldung für das Jugendclubturnier:</p>
      <br>
      <p class="h4">Bitte gib unten unbedingt an, wann du nicht da bist, z. B. im Urlaub!<p>
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


        <div class="form-group alert-danger  border border-danger px-3">
          <span class="pr-3" for="inputZusage"><strong>Ich spiele beim Jugendclubturnier 2020 mit:&nbsp;</strong></span>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="willSpielen" id="willSpielenJA" value="1" <?= ($willSpielen ? 'checked' : '') ?> required>
            <label class="form-check-label" for="willSpielenJA">Ja</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="willSpielen" id="willSpielenNEIN" value="0" <?= (!$willSpielen ? 'checked' : '') ?>>
            <label class="form-check-label" for="willSpielenNEIN">Nein</label>
          </div>
        </div>

        <div class="form-group">
          <label for="inputLk">So alt werde ich dieses Jahr:</label>
          <select id="inputLk" name="lk" class="form-controlcustom-select custom-select-sm" required>
            <option value="">- bitte auswählen -</option>
            <?php
            for ($i = 7; $i <= 18; $i++) {
              $sel = ("$i" === $lk) ? " selected" : "";
              echo ("  <option$sel value=\"$i\">$i</option>");
            }
            ?>
          </select>
        </div>

        <div class="form-group">
          <label for="kommentar">Meine Abwesenheiten (z. B. Urlaub) und weitere Kommentare:</label>
          <textarea class="form-control" name="kommentar" rows="3"><?= $kommentar ?></textarea>
        </div>

        <button type="submit" class="btn btn-lg btn-success btn-block">Absenden</button>
      </form>
  </div>

  <h2>Disclaimer</h2>

  <p>Die TCO-Website, der interne Bereich und die Platzbuchung werden ständig aktualisiert und verbessert. 
    Wenn du Fehler findest oder Verbesserungsvorschläge hast, bitte ich um eine Email an
    <a href="mailto:webmaster@tcolching.de">webmaster@tcolching.de</a>.</p>
  <p>Auch wenn es Probleme irgendwelcher Art gibt, bitte ich um Benachrichtigung. Bitte nicht einfach wegducken,
    wenn du versehentlich Änderungen gemacht hast. Keiner ist böse :-)</p>
  <p>Viel Spaß mit dem System!</p>
  <p>Euer Conny Roloff</p>


<?php
    } //Ende von if($showFormular)
?>
</div>
</div>


<?php
include("../inc/footer.inc.php")
?>