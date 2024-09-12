<?php
session_start();
include 'lib/functions.php';

// Funktionen für rechteabhängige Funktionen START
require_once("intern/inc/config.inc.php");
require_once("intern/inc/functions.inc.php");
require_once("intern/inc/permissioncheck.inc.php");
// Funktionen für rechteabhängige Funktionen ENDE

$navigation = setNavigation('aktuell');
$_header = "Presse";
include 'header.php';
?>


<div id="blatt4" class="blatt">
  <?php if (isset($_SESSION['permissions']) && checkPermissions(VORSTAND)) : ?>
    <!-- Button to toggle the form visibility -->
    <button id="toggleFormBtn" class="btn btn-info btn-sm"><strong>Neuen Presseartikel hochladen</strong></button>

    <!-- Form initially hidden -->
    <div id="uploadForm" class="card mt-3" style="display: none;">
      <div class="card-body">
        <h2 class="card-title"><strong>Neuen Presseartikel hochladen</strong></h2>
        <form id="uploadFormElement" action="lib/upload.php" method="post" enctype="multipart/form-data">
          <div class="mb-3">
            <label for="file" class="form-label">Wähle eine Datei aus. Der Dateiname
              muss folgendes Format haben <strong class="font-monospace">JJJJMMTT_zeitung_thema.jpg</strong>,
              also z. B. <strong class="font-monospace">20230905_Tagblatt_Olching Open Ankündigung.jpg</strong>
            </label>
            <input type="file" name="file" class="form-control" id="file" required>
          </div>
          <button type="submit" class="btn btn-success">Hochladen</button>
        </form>
      </div>
    </div>
  <?php endif; ?>

  <!-- Anzeige der Presseartikel -->
  <section id="presse" class="seite">
    <?php displayPressArticles('images/presse', 0); ?>
  </section>
</div>

<script src="js/public.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> <!-- Laden von SweetAlert -->

<script>
  document.addEventListener('DOMContentLoaded', function() {
    <?php if ($swalMessage): ?>
      Swal.fire({
        icon: '<?= $swalMessageType ?>',
        title: 'Hinweis',
        text: '<?= $swalMessage ?>'
      });
    <?php endif; ?>
  });
</script>

<?php
include 'footer.php';
?>