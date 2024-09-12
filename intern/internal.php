<?php
session_start();
require_once(dirname(__FILE__) . "/inc/config.inc.php");
require_once(dirname(__FILE__) . "/inc/functions.inc.php");
require_once(dirname(__FILE__) . "/inc/permissioncheck.inc.php");

// Ensure user is authenticated
$user = check_user();

$title = "Intern Startseite";
include(dirname(__FILE__) . "/inc/header.inc.php");

// Function to generate event cards
function generate_event_cards($events)
{
  $cards = '';
  foreach ($events as $event) {
    $doubleHeightClass = $event[4] ? 'double-height' : ''; // Check if the event should have double height

    // Check if the event has multiple links (array of links)
    if (is_array($event[1])) {
      $links = '';
      foreach ($event[1] as $linkText => $linkURL) {
        $links .= '<div class="kachel-btn"><a href="' . $linkURL . '">' . $linkText . '</a></div>';
      }
      $cards .= '
                <div class="grid-item ' . $doubleHeightClass . '">
                    <div class="kachel">
                        <div class="titel mb-2">' . $event[0] . '</div>
                        <div class="kachel-links">' . $links . '</div>
                    </div>
                </div>';
    } else {
      // Single link event
      $cards .= '
                <div class="grid-item ' . $doubleHeightClass . '">
                    <div class="kachel">
                        <a href="' . $event[1] . '"' . $event[3] . '>
                            <span class="titel mb-2">' . $event[0] . '</span>
                            <img src="' . $event[2] . '" alt="' . $event[0] . '">
                        </a>
                    </div>
                </div>';
    }
  }
  return $cards;
}

// Define events (with single links and multiple links)
$cardEvents = [
  ["Platzbuchung", "/intern/tafel/", "/images/intern/platztafel.png", "", false],
  ["Turniere/Anmeldung:", [
    "Familienturnier" => "/intern/events/Familienturnier 2024.pdf",
    "Jugendturnier" => "/intern/events/jugendturnier.php",
    "Kreismeisterschaft" => "/intern/events/kreismeisterschaft.php",
    "Clubturnier" => "/intern/turnier/",
    "Newbie-DropIn" => "/intern/events/newbieDropIn.php",
  ], "/images/intern/turniere.png", "", true], // Multi-link, double-height event
  ["TCOShop", "/intern/shop/", "/images/intern/shop.png", "", false],
  ["Players & Friends", "/intern/events/playersfriends.php", "/images/intern/PF_2024_logo.png", "", false],
  ["Wintertraining", "/intern/wintertraining.php", "/images/intern/wintertraining.png", "", false],
  ["TCO Quickstart", "downloads/TCO Newbie-Guide 2024-05-08.pdf", "/images/intern/quickstart.png", "", false]
];
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

  <div class="container mt-4">
    <div class="grid-container">
      <?php if (checkPermissions(WIRT) || checkPermissions(ADMINISTRATOR)) : ?>
        <?php list($wirtStatusText1, $wirtStatusClass, $wirtStatusText2, $wirtAktivClass, $wirtAktivText1, $wirtAktivText2) = handleWirtStatus("../work/wirt.txt"); ?>
        <div class="grid-item ">
          <div class="kachel">
            <a href="/intern/tafel/">
              <span class="titel mb-2">Gaststätte</span>
              <div class="text-start">
                <div class="card-body p-2">
                  <p class="d-inline-block mr-3 mb-1"><?= $wirtStatusText1 ?></p>
                  <form method="post" action="internal.php" class="d-inline-block mb-1">
                    <input type="hidden" name="token" value="<?= generate_csrf_token() ?>">
                    <button type="submit" name="SWT" class="<?= $wirtStatusClass ?>"><?= $wirtStatusText2 ?></button>
                  </form>
                  <br>
                  <p class="d-inline-block mr-3 ml-4 mb-1"><?= $wirtAktivText1 ?></p>
                  <form method="post" action="internal.php" class="d-inline-block mb-1">
                    <input type="hidden" name="token" value="<?= generate_csrf_token() ?>">
                    <button type="submit" name="SWS" class="<?= $wirtAktivClass ?>"><?= $wirtAktivText2 ?></button>
                  </form>
                </div>
              </div>
            </a>
          </div>
        </div>
      <?php endif; ?>
      <?= generate_event_cards($cardEvents); ?>
    </div>
  </div>
</div>

<!--
//
// TERMINE
//
-->

<?php
$events = [
  ["13.09.-15.09.2024", "Kreismeisterschaften Jugend/Erwachsene"],
  ["21.09.2024 - 22.09.2024", "Jugendclubmeisterschaft, Comeback-DropIn. <p>Wir wollen unseren Kindern und Jugendlichen sowie unseren Comeback-Trainingsteilnehmern einen Saisonabschluss anbieten.</p>"],
  ["28.09.2024", "Familienturnier"],
  ["12.10.2024", "Players & Friends Night, inkl. Ehrungen"]
];
?>

<div class="container mt-4">
  <h2>Termine</h2>
  <div class="row gx-3 gy-2">
    <div class="p-3">
      <div class="list-group">
        <?php foreach ($events as $event) : ?>
          <div class="list-group-item">
            <span class="fw-bold"><?= $event[0] ?></span> <?= $event[1] ?>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</div>



<div class="container mt-4">
  <h2>Rundschreiben</h2>
  <div class="p-3 bg-light">

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
  </div>
  <?php
  if (checkPermissions(MANNSCHAFTSFUEHRER)) {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $buttonkey = '';
      foreach (['activate', 'deactivate', 'delete'] as $k) {
        if (isset($_POST[$k])) {
          $buttonkey = $k;
        }
      }
      
      TLOG(DBG, "Button geklickt: $buttonkey", __LINE__);
      
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
    <div class="container mt-4">
      <h2>Aktuell registrierte Benutzer (nur für Mannschaftsführer sichtbar)</h2>
      <h3>(A = Aktiv, P = Passiv, D = Deaktiviert, W = Wartet auf Aktivierung)</h3>
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
</div>
<?php
  }
  include(dirname(__FILE__) . "/inc/footer.inc.php");
?>