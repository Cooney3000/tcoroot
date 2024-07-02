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
include("inc/header.inc.php");
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

  <h2>Mitgliederbereich - du bist angemeldet als <?= htmlentities(trim($user['vorname']) . ' ' . trim($user['nachname'])) ?></h2>
  <!-- Links zu Events wie Anmeldungen etc. -->

  <div class="container mt-4">
    <div class="row">

      <!-- Für den Wirt -->
      <?php

      if (checkPermissions(WIRT) || checkPermissions(ADMINISTRATOR)) {
        $file = "../work/wirt.txt";
        $line = trim(file_get_contents($file));

        $wirtStatus = substr($line, 0, 1);
        $wirtAktivStatus = substr($line, 1, 1);
        $wirtStatusDatum = substr($line, 2, 8);

        // Token generieren und in der Sitzung speichern, wenn es nicht existiert
        if (empty($_SESSION['token'])) {
          $_SESSION['token'] = bin2hex(random_bytes(32));
        }
        $token = $_SESSION['token'];

        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['token']) && $_POST['token'] === $_SESSION['token']) {
          if (isset($_POST['SWT'])) {
            $wirtStatus = abs($wirtStatus - 1); // ON wird OFF, OFF wird ON
            $wirtStatusDatum = date("d.m.y");
          } else if (isset($_POST['SWS'])) {
            $wirtAktivStatus = abs($wirtAktivStatus - 1); // ON wird OFF, OFF wird ON
            $wirtStatusDatum = date("d.m.y");
          }

          file_put_contents($file, $wirtStatus . $wirtAktivStatus . $wirtStatusDatum);

          // Token nach Verwendung ungültig machen und neu generieren
          unset($_SESSION['token']);
          $_SESSION['token'] = bin2hex(random_bytes(32));
        }

        $wirtStatusClass = ($wirtStatus && $wirtStatusDatum == date("d.m.y")) ? "btn btn-danger btn-sm" : "btn btn-success btn-sm";
        $wirtStatusText1 = ($wirtStatus && $wirtStatusDatum == date("d.m.y")) ? "geöffnet" : "geschlossen";
        $wirtStatusText2 = ($wirtStatus && $wirtStatusDatum == date("d.m.y")) ? "Schließen" : "Öffnen";
        $wirtAktivClass = ($wirtAktivStatus) ? "btn btn-secondary btn-sm" : "btn btn-dark btn-sm";
        $wirtAktivText1 = ($wirtAktivStatus) ? " aktiviert" : " deaktiviert";
        $wirtAktivText2 = ($wirtAktivStatus) ? "Deaktivieren" : "Aktivieren";
      ?>
        <div class="col-sm mb-2">
          <div class="bg-light p-2 h-100">
            <span class="btn btn-danger w-100 mb-2">Vereinsgaststätte</span>
            <p>
              Anzeige auf der Startseite ist <strong><?= $wirtAktivText1 ?></strong>.<br>
            <form method="post" action="internal.php">
              <input type="hidden" name="token" value="<?= $_SESSION['token'] ?>">
              <button type="submit" name="SWS" class="<?= $wirtAktivClass ?> px-1"><?= $wirtAktivText2 ?></button>
            </form>
            </p>
            <p>
              Die Vereinsgaststätte ist <strong><?= $wirtStatusText1 ?></strong>.<br>
            <form method="post" action="internal.php">
              <input type="hidden" name="token" value="<?= $_SESSION['token'] ?>">
              <button type="submit" name="SWT" class="<?= $wirtStatusClass ?> px-1"><?= $wirtStatusText2 ?></button>
            </form>
            </p>
          </div>
        </div>
      <?php
      }
      ?>



      <div class="col-sm mb-2">
        <div class="bg-light p-2 h-100">
          <a href="/intern/tafel/">
            <span class="btn btn-success w-100 mb-2">Platzbuchungssystem</span>
            <img class="mw-100" src="/images/platzbuchung_thmb.png" alt="Platzbuchung">
            <p class="align-text-bottom">Platzbuchung bis zu 24h vorher möglich</p>
          </a>
        </div>
      </div>
      <div class="col-sm mb-2">
        <div class="bg-light p-2 h-100">
          <a href="/intern/turnier/turnierbaum.php">
            <span class="btn btn-success w-100 mb-2">Clubturnier '24</span>
            <img class="mw-100" src="/images/intern/turnier.png" alt="Clubturnier">
            <p class="align-text-bottom">Die Spiele haben begonnen!</p>
          </a>
        </div>
      </div>
      <div class="col-sm mb-2">
        <div class="bg-light p-2 h-100">
          <a href="sommercamp.php">
            <span class="btn btn-success w-100 mb-2">Sommercamp 2024</span>
            <img class="mw-100" src="/images/intern/sommercamp.png" alt="Sommercamp">
            <p class="align-text-bottom"><br>Melde dich an!</p>
          </a>
        </div>
      </div>
      <!--
      <div class="col-sm mb-2">
        <div class="bg-light p-2 h-100">
          <a class="btn btn-success w-100 mb-2" href="a_matchtraining.php">Matchtraining</a>
          <img class="mw-100" src="/images/intern/matchtraining.png" alt="TCO Tippspiel">
          <p class="align-text-bottom">zur Anmeldung für jugendliche Mitglieder</p>
        </div>
      </div>
-->
      <div class="col-sm mb-2">
        <div class="bg-light p-2 h-100">
          <a href="downloads/TCO Newbie-Guide 2024-05-08.pdf">
            <div class="btn btn-success w-100 mb-2">Der TCO Newbie-Guide</div>
            <img class="mx-auto" src="/images/intern/neu_beim_tco.png" alt="Newbie Guide">
          </a>

        </div>
      </div>


    </div>
  </div> <!-- container -->

  <h2>Rundschreiben</h2>


  <?php
  $maxSichtbar = 8;
  $anzZeilen = 0;
  $thereAreHiddenArticles = false;
  foreach (scandir("rundschreiben", SCANDIR_SORT_DESCENDING) as $file) {
    $anzZeilen++;
    if ($file === ".." or $file === ".") continue;
    $info = pathinfo($file);
    $filename = $info['filename'];
    preg_match_all('!\d+!', $filename, $datum);
    $chunks = preg_split('! - !', $filename);
    $beschreibung = implode(' - ', array_slice($chunks, 1));
    if (isset($datum[0][0]) && isset($datum[0][2]) && isset($datum[0][2])) {
      if ($anzZeilen == $maxSichtbar) {
        $thereAreHiddenArticles = true;
  ?>
        <p class="d-inline-flex gap-1">
          <a class="btn btn-success btn-sm" data-bs-toggle="collapse" href="#collapseRundschreiben" id="toggleButton">...mehr Rundschreiben</a>
        </p>
        <div class="collapse" id="collapseRundschreiben">
    <?php
      }

      echo "<div><a href =\"rundschreiben/$file\">{$datum[0][2]}.{$datum[0][1]}.{$datum[0][0]} - $beschreibung</a></div>\n";
    }
  }
  if ($thereAreHiddenArticles) {
    echo "</div>\n";
  }
    ?>


    <?php
    if (checkPermissions(MANNSCHAFTSFUEHRER)) {
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
        // '-A' : Benutzer aktivieren (ist im Wartezustand 'W'), '-D' : Benutzer deaktivieren, '-X' : Löschen 
        //
        $pa = preg_split('/-/', $button);

        // error_log("[internal.php] buttonkey: $buttonkey, button: $button, pa[0]: $pa[0], pa[1]: $pa[1]");

        $statement = $pdo->prepare("UPDATE users SET status = ? WHERE id = ?");
        $statement->execute([$pa[1], $pa[0]]);
      }
      $statement = $pdo->prepare("DELETE FROM users WHERE status = 'X'");
      $statement->execute();

      $statement = $pdo->prepare('(SELECT * FROM users WHERE status <> "T" AND status <> "X" ORDER BY status DESC, nachname, vorname)');
      $result = $statement->execute();
    ?>
      <h2>Aktuell registrierte Benutzer (nur für Mannschaftsführer sichtbar)</h2>
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
              <th>Geburtsjahr</th>
              <!-- <th>Registriert am</th> -->
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
                <td class="<?= $classname ?> text-center"><?= substr($row['geburtsdatum'], 0, 4) ?></td>
                <!-- <td class="<?= $classname ?>"><?= substr($row['created_at'], 0, 10) ?></td> -->
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
        include("inc/footer.inc.php")
        ?>