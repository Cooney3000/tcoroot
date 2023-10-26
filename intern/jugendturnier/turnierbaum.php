<?php
session_start();
require_once("../inc/config.inc.php");
require_once("../inc/functions.inc.php");
require_once("../inc/permissioncheck.inc.php");

// Einstieg in den internen Bereich

//Überprüfe, dass der User eingeloggt und berechtigt ist
//Der Aufruf von check_user() muss in alle internen Seiten eingebaut sein
$user = check_user();

$title = "Upload Turnierbaum";
include("../inc/header.inc.php");

?>
<script src="../js/functions.js" ></script>
<script>
    // var element = document.getElementById("nav-intern");
    // element.classList.add("active");
    document.getElementById("nav-intern").classList.add("active");
    document.getElementById("nav-einstellungen").classList.remove("active");
    document.getElementById("nav-turnier").classList.remove("active");
    document.getElementById("nav-tafel").classList.remove("active");
    document.getElementById("nav-login").classList.remove("active");
    document.getElementById("nav-logout").classList.remove("active");
</script>

<div class="container main-container">
<?php 
  require_once("turnierheader.inc.php");
?>  

<h3>Die aktuellen Turnierbäume</h3>
<?php
  if (checkPermissions(T_ALL_PERMISSIONS) ) {
?>
    <div class="editor">
      <p>Liebe Petra,</p>
      <p>so geht's:</p>
      <ol>
        <li>Im Excel alles markieren und kopieren (Strg-A, Strg-C)</li>
        <li>IrfanView aufrufen: Windows-Taste, irf eingeben <br>
            (evtl. einmal vorher downloaden und installieren: <a href="https://www.irfanview.de/download-irfanview-64-bit-deutsche-version/)">Download</a>)</li>
        <li>Das kopierte Bild reinkopieren: Strg-V</li>
        <li>Datei - Speichern unter - PNG-Dateityp auswählen<br>
            Dateinamen müssen korrekt sein: <strong>plan1.png, plan2.png, plan3.png</strong><br>
            Beim Speichern in dem kleinen Dialog oben rechts darf "Transparente Farbe speichern NICHT ausgewählt sein!
        </li>
      </ol>
      <p>Jetzt kannst du die Dateien hier im Formular hochladen.</p>
  </pre>
      <form enctype="multipart/form-data" action="turnierbaum.php" method="POST">
        <div class="form-group">
          <input type="hidden" name="MAX_FILE_SIZE" value="2000000" />
          <input type="hidden" name="op" value="upload" />
          <label class="mt-1 " for="m">Upload Plan 1</label>
          <input class="form-control" name="spieler[]" id="h" type="file" />
          <label for="d">Upload Plan 2</label>
          <input class="form-control" name="spieler[]" id="d" type="file" />
          <label for="hb">Upload Plan 3</label>
          <input class="form-control" name="spieler[]" id="hb" type="file" />
          <br>
          <input class="btn btn-secondary" type="submit" value="Datei(en) senden" />
        </div>
      </form>
  </div>
  <?php
  }
  if (isset($_POST['op'])) {
    if ($_POST['op'] == 'upload') {
      foreach ($_FILES["spieler"]["error"] as $key => $error) {
        if ($error == UPLOAD_ERR_OK) {
          $tmp_name = $_FILES["spieler"]["tmp_name"][$key];
          // basename() kann Directory Traversal Angriffe verhindern; weitere
          // Gültigkeitsprüfung/Bereinigung des Dateinamens kann angebracht sein
          $name = basename($_FILES["spieler"]["name"][$key]);
          error_log ("tmp_name: $tmp_name, name: $name");
          move_uploaded_file($tmp_name, "turnierbaum/$name");
        }
      }
    }
  }
?>


<p class="h3">Turnierpläne werden nach der Auslosung veröffentlicht</p>

<div>
  <h2>Plan 1</h2>
  <a href="turnierbaum/plan1.png"><img id="herren" src="turnierbaum/plan1.png" class="w-100" alt="Plan 1"></a>
</div>

<div>
  <h2>Plan 2</h2>
  <a href="turnierbaum/plan2.png"><img id="damen" src="turnierbaum/plan1.png" class="w-100" alt="Plan 2"></a>
</div>

<div>
  <h2>Plan 3</h2>
  <a href="turnierbaum/plan3.png"><img id="damen" src="turnierbaum/plan1.png" class="w-100" alt="Plan 3"></a>
</div>

<!--
<div>
  <h2>Freizeitspieler</h2>
  <a href="turnierbaum/freizeitspieler.png"><img id="mannschaftsspieler" src="turnierbaum/freizeitspieler.png" class="w-100" alt="Freizeitspieler"></a>
</div>
-->

</div>

<?php 
include("../inc/footer.inc.php")
?>
