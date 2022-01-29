<?php
session_start();
require_once("inc/config.inc.php");
require_once("inc/functions.inc.php");
require_once("inc/permissioncheck.inc.php");

// Einstieg in den internen Bereich

//Überprüfe, dass der User eingeloggt und berechtigt ist
//Der Aufruf von check_user() muss in alle internen Seiten eingebaut sein
$user = check_user();

$title = "Intern Startseite";
include("templates/header.inc.php");
?>
<script>
  // var element = document.getElementById("nav-intern");
  // element.classList.add("active");
  document.getElementById("nav-intern").classList.add("active");
  document.getElementById("nav-turnier").classList.remove("active");
  document.getElementById("nav-halloffame").classList.remove("active");
  document.getElementById("nav-tafel").classList.remove("active");
  if (document.getElementById("nav-login") != null) {
    document.getElementById("nav-login").classList.remove("active");
  }
  if (document.getElementById("nav-logout") != null) {
    document.getElementById("nav-logout").classList.remove("active");
  }
</script>
<div class="container main-container">

  <h2>Interner Bereich - du bist angemeldet als <?= htmlentities(trim($user['vorname']) . ' ' . trim($user['nachname'])) ?></h2>
  <!-- Links zu Events wie Anmeldungen etc. -->

  <div class="container mt-4">
    <div class="row">

      <div class="col-sm mb-2">
        <div class="bg-light p-2 h-100">
          <a class="btn btn-success w-100 mb-2" href="/intern/saisonabschluss.php">Saisonabschluss</a>
          <img class="w-100" src="/intern/images/saisonabschluss.jpg" alt="Saisonabschluss">
          <!-- <p class="align-text-bottom">Jetzt anmelden!</p> -->
        </div>
      </div>

      <div class="col-sm mb-2">
        <div class="bg-light p-2 h-100">
          <a class="btn btn-success w-100 mb-2" href="/intern/tafel/">Platzbuchungssystem</a>
          <img class="mw-100" src="/images/platzbuchung_thmb.png" alt="Platzbuchung">
          <!-- <p class="align-text-bottom">Jetzt registrieren!</p> -->
        </div>
      </div>

      <div class="col-sm mb-2">
        <div class="bg-light p-2 h-100">
          <a class="btn btn-success w-100 mb-2" href="halloffame.php">Hall of Fame</a>
          <h5>Ergebnisse, Sieger, Fotogalerien der Clubmeisterschaften</h5>
          <img class="mw-100" src="/intern/images/turniersieger/sieger2021.jpg" alt="Hall of Fame">
          <!-- <p class="align-text-bottom">Bitte anmelden</p> -->
        </div>
      </div>

      <!-- Für den Wirt -->
      <?php

      if ((checkPermissions(WIRT) && (!checkPermissions(VORSTAND))) || checkPermissions(ADMINISTRATOR)) {
        $file = "../work/wirt.txt";
        $line = trim(file_get_contents($file));

        $wirtStatus = substr($line, 0, 1);
        $wirtAktivStatus = substr($line, 1, 1);

        if (isset($_GET['SWT'])) {
          $wirtStatus = abs($wirtStatus - 1);
        } else if (isset($_GET['SWS'])) {
          $wirtAktivStatus = abs($wirtAktivStatus - 1);
        }

        file_put_contents($file, $wirtStatus . $wirtAktivStatus);

        $wirtStatusClass = ($wirtStatus) ? "btn btn-danger btn-sm" : "btn btn-success btn-sm";
        $wirtStatusText1 = ($wirtStatus) ? "geöffnet" : "geschlossen";
        $wirtStatusText2 = ($wirtStatus) ? "Schließen" : "Öffnen";
        $wirtAktivClass = ($wirtAktivStatus) ? "btn btn-secondary btn-sm" : "btn btn-dark btn-sm";
        $wirtAktivText1 = ($wirtAktivStatus) ? " aktiviert" : " deaktiviert";
        $wirtAktivText2 = ($wirtAktivStatus) ? "Dektivieren" : "Aktivieren";
      ?>
        <div class="col-sm mb-2">
          <div class="bg-light p-2 h-100">
            <span class="btn btn-danger w-100 mb-2">Vereinsgaststätte</span>
            <p>
              Anzeige auf der Startseite ist <strong><?= $wirtAktivText1 ?></strong>.<br>
              <a href="internal.php?SWS" style="text-decoration: none"><span class="<?= $wirtAktivClass ?> px-1"><?= $wirtAktivText2 ?></span></a>
            </p>
            <p>
              Die Vereinsgaststätte ist <strong><?= $wirtStatusText1 ?></strong>.<br>
              <a href="internal.php?SWT" style="text-decoration: none"><span class="<?= $wirtStatusClass ?> px-1"><?= $wirtStatusText2 ?></span></a><br>
            </p>
          </div>
        </div>
      <?php
      }
      ?>
    </div>
  </div> <!-- container -->

  <h2>Rundschreiben</h2>
    <span><a class= " btn btn-secondary btn-sm" href ="rundschreiben/rundschreiben-2021-08-06.pdf">Rundschreiben vom 06.08.2021</a></span>
    <span><a class= " btn btn-secondary btn-sm" href ="rundschreiben/rundschreiben-2021-06-12.pdf">Rundschreiben vom 12.06.2021</a></span>
    <span><a class= " btn btn-secondary btn-sm" href ="rundschreiben/rundschreiben-2021-05-22.pdf">Rundschreiben vom 22.05.2021</a></span>
    <span><a class= " btn btn-secondary btn-sm" href ="rundschreiben/rundschreiben-2021-05-19.pdf">Rundschreiben vom 19.05.2021</a></span>

  <?php
  if (checkPermissions(VORSTAND)) {
    //
    // Wurde einer der Buttons geklickt?
    //
    $buttonkey = '';


    foreach (['activate', 'deactivate', 'delete'] as $k) {
      // error_log( "[internal.php] $k=". $_POST[$k] . ' ### ' . isset($_POST[$k]) );
      if (isset($_POST[$k])) {
        $buttonkey = $k;
      }
    }
    if ($buttonkey != '') {
      $button = $_POST[$buttonkey];
      //
      // '-A' : Benutzer aktivieren (ist im Wartezustand 'W'), '-D' : Benutzer deaktivieren, '-X' : Löschen (wird tatsächlich aber nur gekennzeichnet mit X und nicht mehr angezeigt)
      //
      $pa = preg_split('/-/', $button);

      // error_log("[internal.php] buttonkey: $buttonkey, button: $button, pa[0]: $pa[0], pa[1]: $pa[1]");

      $statement = $pdo->prepare("UPDATE users SET status = ? WHERE id = ?");
      $statement->execute([$pa[1], $pa[0]]);
    }
    $statement = $pdo->prepare('(SELECT * FROM users WHERE status <> "T" AND status <> "X" ORDER BY status DESC, nachname, vorname)');
    $result = $statement->execute();
  ?>
    <h2>Aktuell registrierte Benutzer</h2>
    <h3>(A = Aktiv, P = Passiv, D = Deaktiviert, W = Wartet auf Aktivierung)</h3>
    <div class="mx-3">
      <form action="internal.php" method="post">
        <table class="table table-striped tbl-small">
          <tr>
            <th>S</th>
            <th>#</th>
            <th>Vorname</th>
            <th>Nachname</th>
            <th>E-Mail</th>
            <th>Festnetz</th>
            <th>Mobil</th>
            <th>Geburtsdatum</th>
            <th>Registriert am</th>
            <?php
            if (checkPermissions(VORSTAND)) { ?>
              <th>Aktionen</th>
              <th></th>
            <?php } ?>
          </tr>
          <?php
          $userCount = 0;
          while ($row = $statement->fetch()) {
            $userCount++;
            $danger = ($row['status'] == 'W' || $row['status'] == 'D') ? true : false;
            $classname = $danger ? 'text-gefahr' : '';
          ?>
            <tr>
              <td class="<?= $classname ?>"><?= $row['status'] ?></td>
              <td class="<?= $classname ?>"><?= $row['id'] ?></td>
              <td class="<?= $classname ?>"><?= $row['vorname'] ?></td>
              <td class="<?= $classname ?>"><?= $row['nachname'] ?></td>
              <td class="<?= $classname ?>"><a href="mailto:<?= $row['email'] ?>"><?= $row['email'] ?></a></td>
              <td class="<?= $classname ?>"><?= $row['festnetz'] ?></td>
              <td class="<?= $classname ?>"><?= $row['mobil'] ?></td>
              <td class="<?= $classname ?>"><?= substr($row['geburtsdatum'], 0, 10) ?></td>
              <td class="<?= $classname ?>"><?= substr($row['created_at'], 0, 10) ?></td>
              <?php
              if (checkPermissions(VORSTAND)) { ?>
                <td>
                  <?php
                  if ($danger) { ?>
                    <button type="submit" name="activate" value="<?= $row['id'] ?>-A" class="btn btn-success btn-sm btn-block py-0">Aktivieren</button>
                  <?php
                  }
                  if ($row['status'] == 'A') { ?>
                    <button type="submit" name="deactivate" value="<?= $row['id'] ?>-D" class="btn btn-danger btn-sm btn-block py-0">Deaktivieren</button>
                  <?php } ?>
                </td>
                <td>
                  <?php
                  if ($danger) { ?>
                    <button type="submit" name="delete" value="<?= $row['id'] ?>-X" class="btn btn-danger btn-sm btn-block py-0">Löschen</button>
                  <?php } ?>
                </td>
              <?php } ?>
            </tr>
          <?php
          }
          ?>
        </table>
      </form>
      <div><?= $userCount ?> Benutzer</div>
    </div>
  <?php
  }
  ?>


</div>
<?php
include("templates/footer.inc.php")
?>