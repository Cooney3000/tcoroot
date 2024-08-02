<?php
session_start();
require_once("inc/config.inc.php");
require_once("inc/functions.inc.php");
require_once("inc/permissioncheck.inc.php");

$title = "Registrierung";
include("inc/header.inc.php");
?>
<script>
  document.addEventListener('DOMContentLoaded', () => {
    const navItems = ['intern', 'einstellungen', 'turnier', 'halloffame', 'tafel', 'login', 'logout'];
    navItems.forEach(item => {
      const element = document.getElementById(`nav-${item}`);
      if (element) {
        element.classList.remove('active');
      }
    });
  });
</script>

<div class="container main-container registration-form">
  <h1>Registrierung</h1>
  <?php
  $showFormular = true;

  if (isset($_GET['register'])) {
    $error = false;
    $regcode = filter_input(INPUT_POST, 'regcode', FILTER_SANITIZE_STRING);
    $vorname = filter_input(INPUT_POST, 'vorname', FILTER_SANITIZE_STRING);
    $nachname = filter_input(INPUT_POST, 'nachname', FILTER_SANITIZE_STRING);
    $geschlecht = filter_input(INPUT_POST, 'geschlecht', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $mobilnummer = filter_input(INPUT_POST, 'mobilnummer', FILTER_SANITIZE_STRING);
    $festnetznummer = filter_input(INPUT_POST, 'festnetznummer', FILTER_SANITIZE_STRING);
    $geburtsdatum = filter_input(INPUT_POST, 'geburtsdatum', FILTER_SANITIZE_STRING);
    $passwort = $_POST['passwort'];
    $passwort2 = $_POST['passwort2'];

    if (empty($regcode) || empty($vorname) || empty($nachname) || empty($email)) {
      echo '<span class="text-danger">Bitte alle Felder ausfüllen</span><br>';
      $error = true;
    }

    $statement = $pdo->prepare("SELECT COUNT(*) FROM reg_codes WHERE regcode = :regcode");
    $statement->execute(['regcode' => $regcode]);
    $count = $statement->fetchColumn();

    if ($count > 0) {
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo '<span class="text-danger">Bitte eine gültige E-Mail-Adresse eingeben</span><br>';
        $error = true;
      }
      if (strlen($passwort) == 0) {
        echo '<span class="text-danger">Bitte ein Passwort angeben</span><br>';
        $error = true;
      }
      if (strlen($geburtsdatum) == 0) {
        echo '<span class="text-danger">Bitte ein Geburtsdatum angeben</span><br>';
        $error = true;
      }
      if (strlen($geschlecht) > 1 || strlen($geschlecht) == 0) {
        echo '<span class="text-danger">Bitte ein Geschlecht auswählen</span><br>';
        $error = true;
      }
      if (strlen($festnetznummer) == 0 && strlen($mobilnummer) == 0) {
        echo '<span class="text-danger">Bitte mindestens eine Mobilnummer oder eine Festnetznummer angeben</span><br>';
        $error = true;
      }
      if ($passwort != $passwort2) {
        echo '<span class="text-danger">Die Passwörter müssen übereinstimmen</span><br>';
        $error = true;
      }

      if (!$error) {
        $statement = $pdo->prepare("SELECT * FROM users WHERE email = :email");
        $statement->execute(['email' => $email]);
        $user = $statement->fetch();

        if ($user !== false) {
          echo '<mark><span class="text-danger">Diese E-Mail-Adresse ist bereits vergeben</span><mark><br>';
          $error = true;
        }
      }

      if (!$error) {
        $passwort_hash = password_hash($passwort, PASSWORD_DEFAULT);

        $sql = <<<EOT
INSERT INTO users (email, passwort, geburtsdatum, festnetz, mobil, vorname, nachname, geschlecht, status)
           VALUES (:email, :passwort, :geburtsdatum, :festnetz, :mobil, :vorname, :nachname, :geschlecht, :status)
EOT;
        $statement = $pdo->prepare($sql);
        $result = $statement->execute([
          'email' => $email,
          'passwort' => $passwort_hash,
          'geburtsdatum' => $geburtsdatum,
          'festnetz' => $festnetznummer,
          'mobil' => $mobilnummer,
          'vorname' => $vorname,
          'nachname' => $nachname,
          'geschlecht' => $geschlecht,
          'status' => 'W'
        ]);

        if ($result) {
          $token = md5(random_bytes(20));

          $sql = 'INSERT INTO optintokens (email, token) VALUES (:email, :token)';
          $statement = $pdo->prepare($sql);
          $statement->execute(['email' => $email, 'token' => $token]);

          $empfaenger = $email;
          $betreff = "Deine Registrierung beim TCO abschließen";
          $from = "From: " . $CONFIG['webmasterMailAddress'] . "\r\n";
          $from .= "Bcc: " . $CONFIG['webmasterMailAddress'] . "\r\n";
          $from .= "Reply-To: " . $CONFIG['webmasterMailAddress'] . "\r\n";
          $from .= "Content-Type: text/html; charset=utf-8\r\n";

          $text = <<<EOT
<p>Hallo $vorname $nachname,</p>

<p>Vielen Dank für deine Registrierung beim TCO. 
<a href="https://www.tcolching.de/intern/registerAbschluss.php?t=$token">Für deine Registrierung klicke bitte auf diesen Link</a><br>
Danach kannst du dich mit deiner E-Mail-Adresse und deinem Passwort einloggen.</p>

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

      if (!$error) {
        $statement = $pdo->prepare("DELETE FROM reg_codes WHERE regcode = ?");
        $statement->execute([$regcode]);
      }
    } else {
      echo ('<h2 class="text-danger">Registrierungscode nicht vorhanden oder abgelaufen. Bitte versuch es noch einmal oder wende dich an webmaster@tcolching.de</h2>');
    }
  }

  if ($showFormular) {
  ?>
    <form action="?register=1" method="post" accept-charset="utf-8">
      <input type="hidden" name="token" value="<?= generate_csrf_token() ?>">

      <div class="form-group">
        <label for="inputRegCode">Registrierungscode:</label>
        <input type="text" id="inputRegCode" name="regcode" class="form-control" required>
      </div>

      <div class="form-group">
        <label for="inputVorname">Vorname:</label>
        <input type="text" id="inputVorname" name="vorname" class="form-control" required>
      </div>

      <div class="form-group">
        <label for="inputNachname">Nachname:</label>
        <input type="text" id="inputNachname" name="nachname" class="form-control" required>
      </div>

      <div class="form-group">
        <label for="inputGeschlecht">Geschlecht:</label>
        <select id="inputGeschlecht" name="geschlecht" class="form-control" required>
          <option value="">- Bitte auswählen -</option>
          <option value="w">weiblich</option>
          <option value="m">männlich</option>
          <option value="d">divers</option>
        </select>
      </div>

      <div class="form-group">
        <label for="inputEmail">E-Mail:</label>
        <input type="email" id="inputEmail" name="email" class="form-control" required>
      </div>

      <div class="form-group">
        <label for="inputFestnetznummer">Festnetznummer (optional):</label>
        <input type="text" id="inputFestnetznummer" name="festnetznummer" class="form-control">
      </div>

      <div class="form-group">
        <label for="inputMobilnummer">Mobilnummer (auch für WhatsApp):</label>
        <input type="text" id="inputMobilnummer" name="mobilnummer" class="form-control" required>
      </div>

      <div class="form-group">
        <label for="inputGeburtsdatum">Geburtsdatum:</label>
        <input type="date" id="inputGeburtsdatum" name="geburtsdatum" class="form-control" required />
      </div>
      <br>
      <p class="h4">Gute Passwörter</p>
      <p> sind wichtig, auch wenn Du vielleicht denkst, dass die TCO-Website keine große Relevanz hat. </p>
      <p>Allerdings: Wenn dein Account gehackt wird, hat der Hacker immerhin
        schon Zugriff auf alle Mitgliedernamen und viele Email-Adressen sowie Telefonnummern und er weiß, wer wann mit wem Tennis spielt.
        Alle anderen Mitglieder werden es Dir danken, wenn du sie durch Anwendung eines guten Passworts davor bewahrst.</p>

      <p>Bitte gib dein Passwort zweimal ein. Das Passwort muss mindestens 10 und maximal 14 Zeichen lang sein.
        Es muss aus den Zeichen <mark> a-z A-Z 0-9 ! @ # $ % ^ & * _ = + - </mark> bestehen. Ein Großbuchstabe,
        ein Sonderzeichen und eine Ziffer müssen jeweils mindestens vorkommen</p>

      <div class="form-group">
        <label for="inputPasswort">Passwort:</label>
        <input type="password" id="inputPasswort" name="passwort" minlength="10" maxlength="14" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*_=+-.,]).{10,14}$" class="form-control" required>
      </div>

      <div class="form-group">
        <label for="inputPasswort2">Passwort wiederholen:</label>
        <input type="password" id="inputPasswort2" name="passwort2" minlength="10" maxlength="14" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*_=+-.,]).{10,14}$" class="form-control" required>
      </div>

      <button type="submit" class="btn btn-lg btn-primary btn-block">Registrieren</button>
    </form>

  <?php
  } //Ende von if($showFormular)
  ?>
</div>
<?php
include("inc/footer.inc.php")
?>