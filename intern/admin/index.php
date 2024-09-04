<?php 
session_start();
require_once("../inc/config.inc.php");
require_once("../inc/functions.inc.php");
require_once("../inc/permissioncheck.inc.php");

//Überprüfe, dass der User eingeloggt und berechtigt ist
$user = check_user();

$title = "TCO Admin";
include("header.inc.php");
$menuid = "nav-" . getFilename(__FILE__);
?>

<script>
  document.getElementById("<?= $menuid ?>").classList.add("active");
</script>

<?php
// Function to generate event cards
function generate_event_cards($events)
{
  $cards = '';
  foreach ($events as $event) {
    $cards .= '
          <div class="col-6 col-sm-4 col-md-3 col-lg-2 mb-2"> <!-- Adjusted column classes -->
            <div class="bg-light p-2 h-100 kachel">
              <a href="' . $event[1] . '"' . $event[3] . '>
                <span class="titel mb-2">' . $event[0] . '</span>
                <div class="icon-container">
                 <!-- <img src="' . $event[2] . '" alt="' . $event[0] . '"> -->
                </div>
              </a>
            </div>
          </div>';
  }
  return $cards;
}

$events = [
  ["Benutzer", "/intern/admin/benutzer.php", "", ""],
  ["Aufnahmeanträge", "/intern/admin/verein-aufnahmeantraege.php", "", ""],
  ["Gastbuchungen", "/intern/admin/gastedit.php", "", ""],
  ["Serienbuchungen", "/intern/admin/serieedit.php", "", ""],
  ["Berechtigungen", "/intern/admin/permissionsedit.php", "", ""],
  ["Funktionen", "/intern/admin/funktionen.php", "", 'target="_blank"'],
  ["Shop Management", "/intern/admin/shop/", "", ''],
];
?>

<script>
  document.addEventListener('DOMContentLoaded', () => {
    const navItems = ['index', 'turnier', 'halloffame', 'tafel', 'login', 'logout'];
    navItems.forEach(item => {
      const element = document.getElementById(`nav-${item}`);
      if (element) {
        element.classList.remove('active');
      }
    });
    document.getElementById('nav-index').classList.add('active');
  });
</script>

<div class="container main-container">

  <div class="container mt-4">
  <div class="row gx-3 gy-2">
    <?= generate_event_cards($events); ?>
  </div>
</div>

<?php
include("footer.inc.php")
?>