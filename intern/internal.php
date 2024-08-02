<?php
session_start();
require_once("inc/config.inc.php");
require_once("inc/functions.inc.php");
require_once("inc/permissioncheck.inc.php");

// Einstieg in den internen Bereich

// Überprüfe, dass der User eingeloggt und berechtigt ist
// Der Aufruf von check_user() muss in alle internen Seiten eingebaut sein
$user = check_user();

$title = "Intern Startseite";
include("inc/header.inc.php");
?>
<script>
  document.addEventListener('DOMContentLoaded', () => {
    const navItems = ['intern', 'turnier', 'halloffame', 'tafel', 'login', 'logout'];
    navItems.forEach(item => {
      const element = document.getElementById(`nav-${item}`);
      if (element) {
        element.classList.remove('active');
      }
    });
    document.getElementById('nav-intern').classList.add('active');
  });
</script>

<div class="container main-container">
  <h2>Mitgliederbereich - du bist angemeldet als <?= htmlentities(trim($user['vorname']) . ' ' . trim($user['nachname'])) ?></h2>

  <!-- Links zu Events wie Anmeldungen etc. -->
  <div class="container mt-4">
    <div class="row">
      <!-- Für den Wirt -->
      <?php
      if (checkPermissions(WIRT) || checkPermissions(ADMINISTRATOR)) {
        list($wirtStatusText1, $wirtStatusClass, $wirtStatusText2, $wirtAktivClass, $wirtAktivText1, $wirtAktivText2) = handleWirtStatus("../work/wirt.txt");
        echo '
          <div class="mb-4 bg-success p-1 text-white bg-opacity-7 border">
          <div class="h4">Gaststätte: </div>
            <p class="d-inline-block mr-3">' . $wirtStatusText1 . '</p>
            <form method="post" action="internal.php" class="d-inline-block">
                <input type="hidden" name="token" value="' . generate_csrf_token() . '">
                <button type="submit" name="SWT" class="' . $wirtStatusClass . '">' . $wirtStatusText2 . '</button>
            </form>
            <p class="d-inline-block mr-3 ml-4">' . $wirtAktivText1 . '</p>
            <form method="post" action="internal.php" class="d-inline-block">
                <input type="hidden" name="token" value="' . generate_csrf_token() . '">
                <button type="submit" name="SWS" class="' . $wirtAktivClass . '">' . $wirtAktivText2 . '</button>
            </form>
          </div>';
      }
      ?>

      <!-- Event Cards -->
      <?php
      $events = [
        ["Platzbuchung", "/intern/tafel/", "/images/intern/platztafel.png", "Platzbuchung bis zu 24h vorher möglich"],
        ["Clubturnier '24", "/intern/turnier/turnierbaum.php", "/images/intern/turnier.png", "Die Spiele haben begonnen!"],
        ["Players & Friends '24", "/intern/playersfriends.php", "/images/intern/PF_2024_logo.png", "Jetzt Karte kaufen!"],
        ["Wintertraining", "wintertraining.php", "/images/intern/wintertraining.png", "Melde dich an!"],
        ["Sommercamp 2024", "sommercamp.php", "/images/intern/sommercamp.png", "Melde dich an!"],
        ["TCO Quickstart", "downloads/TCO Newbie-Guide 2024-05-08.pdf", "/images/intern/quickstart.png", "Du bist neu?"]
      ];

      foreach ($events as $event) {
        echo '
        <div class="col-sm-6 col-md-4 col-lg-3 mb-2">
          <div class="bg-light p-2 h-100 kachel">
            <a href="' . $event[1] . '">
              <span class="btn btn-success w-100 mb-2">' . $event[0] . '</span>
              <img class="w-100" src="' . $event[2] . '" alt="' . $event[0] . '">
              <p class="align-text-bottom">' . $event[3] . '</p>
            </a>
          </div>
        </div>';
      }
      ?>
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
        echo '<p class="d-inline-flex gap-1">
        <a class="btn btn-success btn-sm" data-bs-toggle="collapse" href="#collapseRundschreiben" id="toggleButton">...mehr Rundschreiben</a>
      </p>
      <div class="collapse" id="collapseRundschreiben">';
      }

      echo "<div><a href=\"rundschreiben/$file\">{$datum[0][2]}.{$datum[0][1]}.{$datum[0][0]} - $beschreibung</a></div>\n";
    }
  }
  if ($thereAreHiddenArticles) {
    echo "</div>\n";
  }
  ?>

  <?php
  if (checkPermissions(MANNSCHAFTSFUEHRER)) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && validate_csrf_token($_POST['token'])) {
      $buttonkey = '';
      foreach (['activate', 'deactivate', 'delete'] as $k) {
        if (isset($_POST[$k])) {
          $buttonkey = $k;
        }
      }
      if ($buttonkey != '') {
        $button = $_POST[$buttonkey];
        $pa = preg_split('/-/', $button);
        $statement = $pdo->prepare("UPDATE users SET status = ? WHERE id = ?");
        $statement->execute([$pa[1], $pa[0]]);
      }
      $statement = $pdo->prepare("DELETE FROM users WHERE status = 'X'");
      $statement->execute();
    }
    $statement = $pdo->prepare('SELECT * FROM users WHERE status <> "T" AND status <> "X" ORDER BY status DESC, nachname, vorname');
    $statement->execute();
  ?>
    <h2>Aktuell registrierte Benutzer (nur für Mannschaftsführer sichtbar)</h2>
    <h3>(A = Aktiv, P = Passiv, D = Deaktiviert, W = Wartet auf Aktivierung)</h3>
    <div class="mx-3">
      <form action="internal.php" method="post">
        <input type="hidden" name="token" value="<?= generate_csrf_token() ?>">
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
            <?php if (checkPermissions(VORSTAND)) { ?>
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
              <?php if (checkPermissions(VORSTAND)) { ?>
                <td>
                  <?php if ($danger) { ?>
                    <button type="submit" name="activate" value="<?= $row['id'] ?>-A" class="btn btn-success btn-sm btn-block py-0">Aktivieren</button>
                  <?php }
                  if ($row['status'] == 'A') { ?>
                    <button type="submit" name="deactivate" value="<?= $row['id'] ?>-D" class="btn btn-danger btn-sm btn-block py-0">Deaktivieren</button>
                  <?php } ?>
                </td>
                <td>
                  <?php if ($danger) { ?>
                    <button type="submit" name="delete" value="<?= $row['id'] ?>-X" class="btn btn-danger btn-sm btn-block py-0">Löschen</button>
                  <?php } ?>
                </td>
              <?php } ?>
            </tr>
          <?php } ?>
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