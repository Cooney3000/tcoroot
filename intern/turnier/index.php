<?php 
session_start();
require_once("../inc/config.inc.php");
require_once("../inc/functions.inc.php");
require_once("../inc/permissioncheck.inc.php");

if(isset($_SESSION['userid'])) {
  $user = check_user();
}
$title = "Turnierregistrierung";
include("../templates/header.inc.php");
$kw = "champ2019";
?>
<script>
  // var element = document.getElementById("nav-intern");
    // element.classList.add("active");
    document.getElementById("nav-intern").classList.remove("active");
    document.getElementById("nav-einstellungen").classList.remove("active");
    document.getElementById("nav-turnier").classList.add("active");
    document.getElementById("nav-tafel").classList.remove("active");
    document.getElementById("nav-login").classList.remove("active");
    document.getElementById("nav-logout").classList.remove("active");
</script>

<div class="container main-container">
  <h2>CLUBMEISTERSCHAFTEN 2019 (22.5. - 21.9.2019)</h2>
  
  <div class="container mt-4">
    <div class="row">
 
<?php
if (isset($_SESSION['userid']) && checkPermissions(PERMISSIONS::NONE)) {
?>
      <div class="col-sm">
        <div class="h-100 bg-light p-2">
          <a class="btn btn-success w-100" href="bereitsAngemeldet.php">Liste der Spieler</a>
          <h5 class="h-25 m-2">Anmeldeliste</h5>
          <p class="h-25 pl-2">Wer eigentlich mitspielt</p>
        </div>
      </div>
<?php
} 
?>

      <div class="col-sm">
        <div class="h-100 bg-light p-2">
          <a class="btn btn-success w-100" href="infoPlatzbuchung.php">Registrierung</a>
          <h5 class="h-25 m-2">Registrieren</h5>
          <p class="h-25 pl-2">Für den internen Bereich registrieren</p>
        </div>
      </div>
      <div class="col-sm">
        <div class="h-100 bg-light p-2">
            <a class="btn btn-success w-100" href="infoAblauf.php">Ablauf</a>
            <h5 class="h-25 m-2">Ablauf</h5>
            <p class="h-25 pl-2">Bälle, Terminvereinbarung, Regeln, ...</p>
        </div>
      </div>
      <div class="col-sm">
        <div class="h-100 bg-light p-2">
          <a class="btn btn-success w-100" href="infoPlatzbuchung2.php">Platzbuchung</a>
          <h5 class="h-25 m-2">Begegnungen</h5>
          <p class="h-25 pl-2">Wie du dich verabredest und wo du das einträgst</p>
        </div>
      </div>
    </div>
    <div class="row">
    </div>
    <div class="row">
      <div class="col-sm">
        <div class="h-100 bg-light p-2">
            <a class="btn btn-success w-100" href="turnierbaum.php">Turnierbaum</a>
            <h5 class="h-25 m-2">Turnierbäume</h5>
            <p class="h-25 pl-2">Der aktuelle Turnierstatus</p>
        </div>
      </div>
      <div class="col-sm">
        <div class="h-100 bg-light p-2">
            <a class="btn btn-success w-100" href="begegnungen.php">Begegnungen</a>
            <h5 class="h-25 m-2">Begegnungen</h5>
            <p class="h-25 pl-2">Wer wann gegen wen spielt</p>
        </div>
      </div>
<?php
if (checkPermissions(PERMISSIONS::T_ALL_PERMISSIONS) ) 
{
?>
      <div class="col-sm">
        <div class="h-100 bg-light p-2">
            <a class="btn btn-danger w-100" href="ticketverkauf.php">Ticketverkauf</a>
            <p class="h-25 pl-2">(Nur für Admins sichtbar)</p>
        </div>
      </div>
      <div class="col-sm">
        <div class="h-100 bg-light p-2">
            <a class="btn btn-danger w-100" href="nichtregistriert.php">Nicht registriert</a>
            <p class="h-25 pl-2">(Nur für Admins sichtbar)</p>
        </div>
      </div>
<?php
}
?>
    </div> <!-- row -->
  </div> <!-- container -->

  <h2>Disclaimer</h2>

  <p><strong>Das System ist selbst programmiert</strong> und daher möglicherweise nicht perfekt. Wenn du Fehler findest, bitte ich um Nachsicht und eine Email an 
  <a href="mailto:webmaster@tcolching.de">webmaster@tcolching.de</a>.</p>
  <p>Auch wenn es Probleme irgendwelcher Art gibt, bitte ich um Benachrichtigung. Bitte nicht einfach wegducken, 
  wenn du versehentlich Änderungen gemacht hast. Keiner ist böse :-)</p>
  <p>Viel Spaß mit dem System!</p>
  <p>Euer Conny Roloff</p>


  
  <!-- <h2>Turnieranmeldung (Registrierung geschlossen)</h2> -->
  <div class="registration-form">
    <?php
  $showFormular = false; //Variable ob das Registrierungsformular angezeigt werden soll
  
  if(isset($_GET['register'])) {
    $error = false;
    $turnierKennwort = trim($_POST['turnierkennwort']);
    $spielername = trim($_POST['spielernname'])." ".trim($_POST['spielervname']);
    $zusage = trim($_POST['zusage']);
    //$turnierId = trim($_POST['turnier_id']);
    $turnierId = 1;
    
    $kategorie = isset($_POST['kategorie']) ? trim($_POST['kategorie']) : "-";
    $lk = isset($_POST['lk']) ? trim($_POST['lk']) : "0";
    $kommentar1 = isset($_POST['kommentar1']) ? trim($_POST['kommentar1']) : "-";
    $kommentar2 = isset($_POST['kommentar2']) ? trim($_POST['kommentar2']) : "-";
    $kommentar3 = isset($_POST['kommentar3']) ? trim($_POST['kommentar3']) : "-";
    $kommentar4 = isset($_POST['kommentar4']) ? trim($_POST['kommentar4']) : "-";
    $kommentar5 = isset($_POST['kommentar5']) ? trim($_POST['kommentar5']) : "-";
    
    if($turnierKennwort == $kw) {

  $sql = <<<EOT
INSERT INTO tournament_players (spielername,zusage,tournament_id,category,LK,comment1,comment2,comment3,comment4,comment5)
          VALUES (:spielername,:zusage,:turnierid,:category,:lk,:comment1,:comment2,:comment3,:comment4,:comment5)
EOT;
      $statement = $pdo->prepare($sql);
      $statement->execute(array(
                    'spielername' => $spielername,
                    'zusage' => $zusage,
                    'turnierid' => $turnierId, 
                    'category' => $kategorie,  
                    'lk' => $lk,
                    'comment1' => $kommentar1,
                    'comment2' => $kommentar2, 
                    'comment3' => $kommentar3,
                    'comment4' => $kommentar4,
                    'comment5' => $kommentar5
                  ));
      echo '<strong class="text-success">Deine Anmeldung/Absage wurde gespeichert!</strong><br>';
    } else {
      echo '<strong class="text-danger">Falsches Kennwort</strong><br>';
    } 
  }

  if($showFormular) {
?>
  <form id="registerTurnierForm" class="myform" action="?register=1" method="post">
  <div class="form-group">
    <label for="inputTurnierKennwort">Turnierkennwort <?= checkPermissions(PERMISSIONS::T_ALL_PERMISSIONS) ? '(Kennwort: '.$kw.')' : '' ?></label>
    <input type="text" id="inputTurnierKennwort" name="turnierkennwort" class="form-control" required>
  </div>
  <div class="form-group">
    <div class="form-row">
      <div class="col">
        <label for="inputSpielervname">* Vorname</label>
        <input type="text" id="inputSpielervname" name="spielervname" class="form-control" required> 
      </div>
      <div class="col">
        <label for="inputSpielernname">* Nachname</label>
        <input type="text" id="inputSpielernname" name="spielernname" class="form-control" required>
      </div>
    </div>
  </div>

  <div class="form-group">
    <div class="form-check form-check-inline">
        <span for="inputZusage">Weiter ausfüllen ODER hier klicken:&nbsp;</span>
      <button type="button" class="btn btn-danger" onclick="document.getElementById('inputZusage').value='Nein';document.getElementById('registerTurnierForm').submit();">Ich spiele nicht mit!</button>
      <input type="hidden" id="inputZusage" name="zusage" value="Ja" />
    </div>
  </div>

  <div class="form-group">
  <label for="inputKategorie">* Turnierkategorie:</label>
  <select id="inputKategorie" name="kategorie"  class="form-control" required>
    <option value="">- bitte auswählen -</option>
    <option value="D">Damen Mannschaftsspielerinnen</option>
    <option value="H">Herren Mannschaftsspieler</option>
    <option value="F">Freizeitspieler/innen</option>
  </select>
</div> 

<div class="form-group">
  <label for="inputLk">* LK:</label>
  <select id="inputLk" name="lk"  class="form-control" required>
    <option value="">- bitte auswählen -</option>
    <option value="0">Freizeitspieler</option>
    <?php
      for ($i=23; $i>0; $i--) {
        echo ("  <option value=\"LK{$i}\">LK{$i}</option>");
      } 
    ?>
  </select>
  </div>
  
  <label for="inputKommentar1">* Verfügbar am 15.6.2019?</label>
  <div class="form-group btn-light px-1 rounded">
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="kommentar1" id="inputKommentar1JA" value="Ja" required>
      <label class="form-check-label" for="inputKommentar1JA">Ja</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="kommentar1" id="inputKommentar1NEIN" value="Nein">
      <label class="form-check-label" for="inputKommentar1NEIN">Nein</label>
    </div>
  </div>
  
  <div class="form-group">
    <label for="inputKommentar2">* Freitags verfügbar ab:</label><br>
  <input type="text" id="inputKommentar2" name="kommentar2" class="form-control" required>
  </div>

  <label for="inputKommentar3">* Verfügbar am Finaltag 21.9.2019?</label>
  <div class="form-group btn-light px-1 rounded">
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="kommentar3" id="inputKommentar3JA" value="Ja" required>
      <label class="form-check-label" for="inputKommentar3JA">Ja</label>
    </div>
    <div class="form-check form-check-inline">
      <input class="form-check-input" type="radio" name="kommentar3" id="inputKommentar3NEIN" value="Nein">
      <label class="form-check-label" for="inputKommentar3NEIN">Nein</label>
    </div>
  </div>

  <div class="form-group">
    <label for="inputKommentar4">* Telefon/WhatsApp:</label>
  <input type="text" id="inputKommentar4" name="kommentar4" class="form-control" required>
</div>

<div class="form-group">
  <label for="inputKommentar5">Kommentar Sonstiges</label>
  <input type="text" id="inputKommentar5" name="kommentar5" class="form-control">
  </div>
  
  <button type="submit" class="btn btn-lg btn-success btn-block">Absenden</button>
</form>
  </div>
</div>
</div>

<?php 
} //Ende von if($showFormular)


include("../templates/footer.inc.php")
?>