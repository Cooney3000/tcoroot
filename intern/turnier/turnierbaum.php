<?php
session_start();
require_once("../inc/config.inc.php");
require_once("../inc/functions.inc.php");
require_once("../inc/permissioncheck.inc.php");

// Einstieg in den internen Bereich

//Überprüfe, dass der User eingeloggt und berechtigt ist
//Der Aufruf von check_user() muss in alle internen Seiten eingebaut sein
$user = check_user();

$title = "Turnierbaum";
include("../inc/header.inc.php");
?>
<script>
document.addEventListener('DOMContentLoaded', () => {
    document.getElementById("nav-intern").classList.add("active");
    document.getElementById("nav-einstellungen").classList.remove("active");
    document.getElementById("nav-turnier").classList.remove("active");
    document.getElementById("nav-tafel").classList.remove("active");
    if (document.getElementById("nav-login") !== null) document.getElementById("nav-login").classList.remove("active");
    if (document.getElementById("nav-logout") !== null) document.getElementById("nav-logout").classList.remove("active");
});
</script>

<div class="container main-container">
  <?php require_once("turnierheader.inc.php"); ?>

  <h3>Die aktuellen Turnierbäume</h3>
  <?php if ($user['id'] == 211 || $user['id'] == 212): ?>
    <div class="editor">
      <p>Lieber Norbert,</p>
      <p>so geht's:</p>
      <ol>
        <li>Im Excel alles markieren und kopieren (Strg-A, Strg-C)</li>
        <li>IrfanView aufrufen: Windows-Taste, irf eingeben <br>
          (evtl. einmal vorher downloaden und installieren: <a href="https://www.irfanview.de/download-irfanview-64-bit-deutsche-version/">Download</a>)</li>
        <li>Das kopierte Bild reinkopieren: Strg-V</li>
        <li>Datei - Speichern unter - PNG-Dateityp auswählen<br>
          Dateinamen müssen korrekt sein: <strong>herren.png, damen.png, herrenb.png, damenb.png</strong><br>
          Beim Speichern in dem kleinen Dialog oben rechts darf "Transparente Farbe speichern NICHT ausgewählt sein!
        </li>
      </ol>
      <p>Jetzt kannst du die Dateien hier im Formular hochladen.</p>
      <form enctype="multipart/form-data" action="turnierbaum.php" method="POST">
        <div class="form-group">
          <input type="hidden" name="MAX_FILE_SIZE" value="2000000" />
          <input type="hidden" name="op" value="upload" />
          <label class="mt-1" for="h">Upload Herren</label>
          <input class="form-control" name="spieler[]" id="h" type="file" />
          <label for="d">Upload Damen</label>
          <input class="form-control" name="spieler[]" id="d" type="file" />
          <label for="hb">Upload Herren B</label>
          <input class="form-control" name="spieler[]" id="hb" type="file" />
          <label for="db">Upload Damen B</label>
          <input class="form-control" name="spieler[]" id="db" type="file" />
          <br>
          <input class="btn btn-secondary" type="submit" value="Datei(en) senden" />
        </div>
      </form>
    </div>
  <?php endif; ?>

  <?php
  if (isset($_POST['op']) && $_POST['op'] == 'upload') {
    foreach ($_FILES["spieler"]["error"] as $key => $error) {
      if ($error == UPLOAD_ERR_OK) {
        $tmp_name = $_FILES["spieler"]["tmp_name"][$key];
        $name = basename($_FILES["spieler"]["name"][$key]);
        error_log("tmp_name: $tmp_name, name: $name");
        move_uploaded_file($tmp_name, "turnierbaum/$name");
      }
    }
  }
  ?>

  <div>
    <h2>Herren</h2>
    <a href="turnierbaum/herren.png"><img id="herren" src="turnierbaum/herren.png?rnd=<?= time(); ?>" class="w-100" alt="Herren Turnierbaum"></a>
  </div>

  <div>
    <h2>Damen</h2>
    <a href="turnierbaum/damen.png"><img id="damen" src="turnierbaum/damen.png?rnd=<?= time(); ?>" class="w-100" alt="Damen Turnierbaum"></a>
  </div>

  <?php if (file_exists('turnierbaum/herrenb.png')): ?>
    <div>
        <h2>Herren B</h2>
        <a href="turnierbaum/herrenb.png"><img id="herren" src="turnierbaum/herrenb.png?rnd=<?= time(); ?>" class="w-75" alt="Herren B Turnierbaum"></a>
    </div>
  <?php endif; ?>

  <?php if (file_exists('turnierbaum/damenb.png')): ?>
    <div>
        <h2>Damen B</div>
        <a href="turnierbaum/damenb.png"><img id="damen" src="turnierbaum/damenb.png?rnd=<?= time(); ?>" class="w-75" alt="Damen B Turnierbaum"></a>
    </div>
  <?php endif; ?>
</div>

<?php include("../inc/footer.inc.php"); ?>
