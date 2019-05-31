<?php 
session_start();
require_once("inc/config.inc.php");
require_once("inc/functions.inc.php");

$title = "Registrierung";
include("templates/header.inc.php")
?>
<script>
    // var element = document.getElementById("nav-intern");
    // element.classList.add("active");
    document.getElementById("nav-intern").classList.remove("active");
    document.getElementById("nav-einstellungen").classList.remove("active");
    document.getElementById("nav-turnier").classList.remove("active");
    document.getElementById("nav-tafel").classList.remove("active");
    document.getElementById("nav-login").classList.remove("active");
    document.getElementById("nav-logout").classList.remove("active");
</script>

<div class="container main-container registration-form">
<h1>Registrierung</h1>
<?php
$showFormular = true; //Variable ob das Registrierungsformular angezeigt werden soll
 
if(isset($_GET['register'])) {
	$error = false;
	$vorname = trim($_POST['vorname']);
	$nachname = trim($_POST['nachname']);
	$geschlecht = trim($_POST['geschlecht']);
	$email = trim($_POST['email']);
  $mobilnummer = trim($_POST['mobilnummer']);
  $festnetznummer = trim($_POST['festnetznummer']);
  $geburtsdatum = trim($_POST['geburtsdatum']);
  $passwort = $_POST['passwort'];
	$passwort2 = $_POST['passwort2'];
	
	if(empty($vorname) || empty($nachname) || empty($email)) {
		echo 'Bitte alle Felder ausfüllen<br>';
		$error = true;
	}
  
	if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		echo 'Bitte eine gültige E-Mail-Adresse eingeben<br>';
		$error = true;
	} 	
	if(strlen($passwort) == 0) {
		echo 'Bitte ein Passwort angeben<br>';
		$error = true;
	}
	if(strlen($geburtsdatum) == 0) {
		echo 'Bitte ein Geburtsdatum angeben<br>';
		$error = true;
	}
	if(strlen($geschlecht) > 1 || strlen($geschlecht) == 0) {
		echo 'Bitte ein Geschlecht auswählen<br>';
		$error = true;
	}
  if(strlen($festnetznummer) == 0 && strlen($mobilnummer) == 0) {
		echo 'Bitte mindestens eine Mobilnummer oder eine Festnetznummer angeben<br>';
		$error = true;
	}
  if($passwort != $passwort2) {
		echo 'Die Passwörter müssen übereinstimmen<br>';
		$error = true;
	}
	
	//Überprüfe, dass die E-Mail-Adresse noch nicht registriert wurde
	if(!$error) { 
		$statement = $pdo->prepare("SELECT * FROM users WHERE email = :email");
		$result = $statement->execute(array('email' => $email));
		$user = $statement->fetch();
		
		if($user !== false) {
			echo 'Diese E-Mail-Adresse ist bereits vergeben<br>';
			$error = true;
		}	
	}
	
	//Keine Fehler, wir können den Nutzer registrieren
	if(!$error) {	
		$passwort_hash = password_hash($passwort, PASSWORD_DEFAULT);
    // Benutzerdaten einfügen mit 'W' in warteposition. Wird durch den Link in der E-Mail aktiviert.
    $sql = <<<EOT
INSERT INTO users (email,passwort,geburtsdatum,festnetz,mobil,vorname,nachname,geschlecht, status)
           VALUES (:email,:passwort,:geburtsdatum,:festnetz,:mobil,:vorname,:nachname,:geschlecht, :status)
EOT;
		$statement = $pdo->prepare($sql);
    $statement->execute(array(
                  'email' => $email, 
                  'passwort' => $passwort_hash, 
                  'geburtsdatum' => $geburtsdatum,  
                  'festnetz' => $festnetznummer,
                  'mobil' => $mobilnummer,
                  'vorname' => $vorname, 
                  'nachname' => $nachname,
                  'geschlecht' => $geschlecht,  
                  'status' => 'W'
                ));
    
    if($result) {	
      // Das Token für den E-Mail-Link erzeugen
      $token = md5(random_bytes(20));

      // Opt-In-Token anlegen
      $sql = 'INSERT INTO optintokens (email,token) VALUES (:email,:token)';
      $statement = $pdo->prepare($sql);
      $statement->execute(array('email' => $email, 'token' => $token));

      // Mail versenden
      $empfaenger = "$email";
      $betreff = "Deine Registrierung beim TCO abschließen";
      $from = "From: " . $CONFIG['webmasterMailAddress'] . "\r\n";
      $from .= "Reply-To: " . $CONFIG['webmasterMailAddress'] . "\r\n";
      $from .= "Content-Type: text/html; charset=utf-8\r\n";
      $text = <<<EOT
<p>Hallo $vorname $nachname,</p>

<p>
vielen Dank für deine Registrierung beim TCO. 
<a href="https://www.tcolching.de/intern/registerAbschluss.php?t=$token">Für deine Registrierung klicke bitte auf diesen Link</a><br>
Danach kannst du dich mit deiner E-Mail-Adresse und deinem Passwort einloggen.
</p>

<p>Viele Grüße</p>
<p>Der TC Olching e.V.</p>
EOT;
      if (mail($empfaenger, $betreff, $text, $from)) {
        echo '<div class="h5 my-2">Vielen Dank! Du wurdest erfolgreich registriert und erhältst in Kürze eine Mail. Dein Account wird aktiviert, sobald du auf den Link in der Mail klickst.</div>';
        $showFormular = false;
      } else {
        echo '<div class="h5 text-danger my-2">Beim Versenden der Bestätigungsmail ist leider ein Fehler aufgetreten. Bitte benachrichtige ' . $CONFIG['webmasterMailAddress'] . '<br></div>';
      }
		} else {
			echo '<div class="h5 text-danger my-2">Beim Abspeichern ist leider ein Fehler aufgetreten. Bitte benachrichtige ' . $CONFIG['webmasterMailAddress'] . '<br></div>';
		}
	} 
}
 
if($showFormular) {
?>
<form action="?register=1" method="post" accept-charset="utf-8">

<div class="form-group">
<label for="inputVorname">Vorname:</label>
<input type="text" id="inputVorname" name="vorname" class="form-control" x-autocompletetype="given-name" required>
</div>

<div class="form-group">
<label for="inputNachname">Nachname:</label>
<input type="text" id="inputNachname" name="nachname" class="form-control" x-autocompletetype="family-name" required>
</div>

<div class="form-group">
<label for="inputGeschlecht">Geschlecht:</label>
<select id="inputGeschlecht" name="geschlecht"  class="form-control" x-autocompletetype="sex" required>
  <option value="">- Bitte auswählen -</option>
  <option value="w">weiblich</option>
  <option value="m">männlich</option>
  <option value="d">divers</option>
</select>
</div>

<div class="form-group">
<label for="inputEmail">E-Mail:</label>
<input type="email" id="inputEmail" name="email" class="form-control" x-autocompletetype="email" required>
</div>

<div class="form-group">
<label for="inputFestnetznummer">Festnetznummer (optional):</label>
<input type="text" id="inputFestnetznummer" name="festnetznummer" class="form-control" x-autocompletetype="tel">
</div>

<div class="form-group">
<label for="inputMobilnummer">Mobilnummer (auch für WhatsApp):</label>
<input type="text" id="inputMobilnummer" name="mobilnummer" class="form-control" x-autocompletetype="tel" required>
</div>

<div class="form-group">
<label for="inputGeburtsdatum">Geburtsdatum (Jahresauswahl geht auch am Handy: Tippe das Jahr an, ist anscheinend etwas diffizil)</label>
<input type="date" id="inputGeburtsdatum" name="geburtsdatum" class="form-control date" x-autocompletetype="bday" required/>
</div>

<div class="form-group">
<label for="inputPasswort">Passwort:</label>
<input type="password" id="inputPasswort" name="passwort" class="form-control" x-autocompletetype="new-password" required>
</div> 

<div class="form-group">
<label for="inputPasswort2">Passwort wiederholen:</label>
<input type="password" id="inputPasswort2" name="passwort2" class="form-control" x-autocompletetype="new-password" required>
</div> 

<button type="submit" class="btn btn-lg btn-primary btn-block">Registrieren</button>
</form>
 
<?php
} //Ende von if($showFormular)
	

?>
</div>
<?php 
include("templates/footer.inc.php")
?>

