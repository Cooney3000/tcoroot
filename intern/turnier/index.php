<?php
session_start();
require_once("../inc/config.inc.php");
require_once("../inc/functions.inc.php");
require_once("../inc/permissioncheck.inc.php");

$user = check_user();

$title = "Turnierregistrierung";
include("../templates/header.inc.php");
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
  <h1 class="mb-0">CLUBMEISTERSCHAFTEN 2022</h1>
  <!-- <h2 class="mt-0">(10.9. - 12.9.2021)</h2> -->
<?php 
  require_once("turnierheader.inc.php");
?> 

  <!-- <h2>Turnieranmeldung (Registrierung geschlossen)</h2> -->
  <div class="registration-form">

    <?php

    $showFormular = 1;
    $tid = $CONFIG['activeTournament'];
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
    $kategorie    = "";
    $willSpielen  = 0;
    $kommentar    = "";

    if ($registrieren) {
      // Die Formularwerte übernehmen

      $nachname     = $_POST["nachname"];
      $vorname      = $_POST["vorname"];
      $festnetz     = $_POST["festnetz"];
      $mobil        = $_POST["mobil"];
      $ttid         = $tid;
      $tuid         = $user;
      // $kategorie    = $_POST["kategorie"];
      $willSpielen  = $_POST["willSpielen"] === "1" ? 1 : 0;
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
          category,
          wtp, 
          cmt
        FROM users as u 
        LEFT JOIN (
          SELECT 
            tournament_id AS ttid, 
            user_id AS tuid, 
            willing_to_play AS wtp, 
            category AS category,
            comment AS cmt 
          FROM tournament_players 
          WHERE tournament_id = $tid
          ) AS p
        ON u.id = p.tuid
        WHERE u.id = {$user['id']}
EOT;
      // $u=http_build_query($user);
      // echo("<pre>$u</pre>");
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
      // $kategorie  = isset($result["category"]) ? $result["category"] : $kategorie;
      $willSpielen = isset($result["wtp"]) ? $result["wtp"] : $willSpielen;
      $kommentar  = isset($result["cmt"]) ? $result["cmt"] : $kommentar;
    }

    if ($registrieren) {
      $statement = $pdo->prepare("UPDATE users SET festnetz = :festnetz, mobil = :mobil WHERE id = :user");
      $statement->execute(array('festnetz' => $festnetz, 'user' => $user['id'], 'mobil' => $mobil));
      $statement = $pdo->prepare("INSERT INTO tournament_players (tournament_id, user_id, willing_to_play, comment) VALUES (:ttid, :tuid, :willSpielen, :kommentar) 
        ON DUPLICATE KEY 
        UPDATE willing_to_play = :willSpielen, comment = :kommentar");
      $statement->execute(array('ttid' => $ttid, 'tuid' => $tuid['id'], 'willSpielen' => $willSpielen, 'kommentar' => $kommentar));
      echo ('<br><strong class="text-success">Deine Anmeldung/Absage wurde gespeichert!</strong><br>');
    }


    if ($showFormular) {
    ?>
      <br>
      <p class="h3 mt-4">Deine Turnier-Anmeldung:</p>
      <p class="text-groesser">Du glaubst, noch nicht gut genug für eine Turnierteilnahme zu sein? Wenn du ein oder zwei Jahre Spielpraxis
        und schon im Training das eine oder andere Match gespielt hast, dann spiel mit! Ein Turnierspiel
        ist immer eine ganz neue Erfahrung und du lernst neue Leute kennen!</p>
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

        <!-- <div class="form-group">
          <label for="kategorie">Du kannst angeben, ob du auch die Besten herausfordern willst (A-Spieler:innen)
            oder das lieber vermeiden möchtest (B-Spieler:innen). Es ist zurzeit allerdings noch völlig offen, ob wir getrennte Gruppen machen.<?=$kategorie?></label>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="kategorie" id="kategorieA" value="A" <?= ($kategorie ==="A" ? 'checked' : '') ?> >
            <label class="form-check-label" for="kategorieA">
              A
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="kategorie" id="kategorieB" value="B" <?= ($kategorie ==="B" ? 'checked' : '') ?>>
            <label class="form-check-label" for="kategorieB">
              B
            </label>
          </div>
        </div> -->

        <div class="form-control alert-danger border border-danger px-3">
          <span class="pr-3" for="inputZusage"><strong>Ich spiele beim Clubturnier 2022 mit:&nbsp;</strong></span>
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
          <label for="kommentar">Bemerkungen (z. B. "Ich habe kein WhatsApp"):</label>
          <textarea class="form-control" name="kommentar" rows="3"><?= $kommentar ?></textarea>
        </div>

        <button type="submit" class="btn btn-lg btn-success btn-block">Absenden</button>
      </form>
  </div>

  <h2>Disclaimer</h2>

  <p>Die TCO-Website, der interne Bereich und die Platzbuchung werden ständig aktualisiert und verbessert.
    Wenn du Fehler findest oder Verbesserungsvorschläge hast, bitte ich um eine Email an
    <a href="mailto:webmaster@tcolching.de">webmaster@tcolching.de</a>.
  </p>
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
include("../templates/footer.inc.php")
?>