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
include("../templates/header.inc.php");

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
  // if (checkPermissions(PERMISSIONS::T_ALL_PERMISSIONS) ) {
  if ($user['id'] == 211 || $user['id'] == 212 ) {
?>
    <div class="editor">
      <p>Lieber Norbert,</p>
      <p>so geht's:</p>
      <ol>
        <li>1. Im Excel alles markieren und kopieren (Strg-A, Strg-C)</li>
        <li>2. IrfanView aufrufen: Windows-Taste, irf eingeben <br>
            (evtl. einmal vorher downloaden und installieren: <a href="https://www.irfanview.de/download-irfanview-64-bit-deutsche-version/)">Download</a>)</li>
        <li>3. Das kopierte Bild reinkopieren: Strg-V</li>
        <li>4. Datei - Speichern unter - PNG-Dateityp auswählen<br>
            Dateinamen müssen korrekt sein: <strong>mannschaftsspieler.png, mannschaftsspielerinnen.png, freizeitspieler.png</strong><br>
            Beim Speichern in dem kleinen Dialog oben rechts darf "Transparente Farbe speichern NICHT ausgewählt sein!
        </li>
      </ol>
      <p>Jetzt kannst du die Dateien hier im Formular hochladen.</p>
  </pre>
      <form enctype="multipart/form-data" action="turnierbaum.php" method="POST">
        <div class="form-group">
          <input type="hidden" name="MAX_FILE_SIZE" value="2000000" />
          <input type="hidden" name="op" value="upload" />
          <label class="mt-1 " for="m">Upload Mannschaftsspieler</label>
          <input class="form-control" name="spieler[]" id="m" type="file" />
          <label for="d">Upload Mannschaftsspielerinnen</label>
          <input class="form-control" name="spieler[]" id="d" type="file" />
          <label for="f">Upload Freizeitspieler/innen</label>
          <input class="form-control" name="spieler[]" id="f" type="file" />
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


<p class="h3">Turnierbäume werden nach der Auslosung veröffentlicht</p>

<!--
<div>
  <h2>Mannschaftsspieler Herren</h2>
  <a href="turnierbaum/mannschaftsspieler.png"><img id="mannschaftsspieler" src="turnierbaum/mannschaftsspieler.png" class="w-100" alt="Mannschaftsspieler"></a>
</div>

<div>
  <h2>Mannschaftsspielerinnen Damen</h2>
  <a href="turnierbaum/mannschaftsspielerinnen.png"><img id="mannschaftsspieler" src="turnierbaum/mannschaftsspielerinnen.png" class="w-100" alt="Mannschaftsspielerinnen"></a>
</div>

<div>
  <h2>Freizeitspieler</h2>
  <a href="turnierbaum/freizeitspieler.png"><img id="mannschaftsspieler" src="turnierbaum/freizeitspieler.png" class="w-100" alt="Freizeitspieler"></a>
</div>
-->

</div>

<?php 
include("../templates/footer.inc.php")
?>
