<?php 
session_start();
require_once("inc/config.inc.php");
require_once("inc/functions.inc.php");

$title = "Passwort neu vergeben";
include("templates/header.inc.php")
?>
<script>
    document.getElementById("nav-intern").classList.remove("active");
    document.getElementById("nav-einstellungen").classList.remove("active");
    document.getElementById("nav-turnier").classList.remove("active");
    document.getElementById("nav-halloffame").classList.remove("active");
    document.getElementById("nav-tafel").classList.remove("active");
    document.getElementById("nav-login").classList.remove("active");
    document.getElementById("nav-logout").classList.remove("active");
</script>

<div class="container main-container">
<h1>Passwort neu vergeben</h1>
<?php

$showFormular = TRUE;
$fehlermsg = '';

if (isset($_GET['t'])) 
{
  $token = $_GET['t'];

  // Überprüfe das Token
  $statement = $pdo->prepare("SELECT * FROM optintokens WHERE token = :token");
  $statement->execute(array('token' => $token));
  $optintoken = $statement->fetch();
  $email = $optintoken['email'];
  
  if ($optintoken) 
  {
    if (isset($_GET['pwreset'])) 
    {
      // überprüfe, ob Passwort 1 und Passwort 2 übereinstimmen
      $passwort   = $_POST['passwort'];
      $passwort2  = $_POST['passwort2'];

      if ($passwort == $passwort2)
      {
        // Token und Passwort ok
        // Das Token wird gelöscht, das Passwort in die DB geschrieben

        // Token löschen
        $sql = "DELETE FROM optintokens WHERE token = '$token'";
        $pdo->exec($sql);
        $passwort_hash = password_hash($passwort, PASSWORD_DEFAULT);
        
        // Passwortupdate
        $sql = "UPDATE users SET passwort = '$passwort_hash' WHERE email = '$email'";
        $pdo->exec($sql);

        $showFormular = FALSE;
        echo ('<p class = "h3 text-success">Dein Passwort wurde zurückgesetzt. Melde dich jetzt an: <a href="login.php">Login</a></p>');
      }
      else
      {
        $fehlermsg = 'Die Passwörter müssen übereinstimmen. Bitte versuche es erneut.';
      }
    }
  }
  else // optintoken nicht vorhanden
  {
    $fehlermsg = 'Dein Link ist bereits abgelaufen. Bitte starte den Passwort-Reset erneut';
    $error = TRUE;
  }
  if ($showFormular) {	

?>

  <p class = "h4">Bitte gib dein Passwort zweimal ein</p>
  <form action="?pwreset=1&t=<?= $token ?>" method="post" accept-charset="utf-8">

    <div class="form-group">
    <label for="inputPasswort">Passwort:</label>
    <input type="password" id="inputPasswort" name="passwort" class="form-control" x-autocompletetype="new-password" required>
    </div> 

    <div class="form-group">
    <label for="inputPasswort2">Passwort wiederholen:</label>
    <input type="password" id="inputPasswort2" name="passwort2" class="form-control" x-autocompletetype="new-password" required>
    </div> 

    <button type="submit" class="btn btn-lg btn-primary btn-block">Jetzt zurücksetzen</button>
  </form>
  <p class="h3 text-danger"><?= $fehlermsg ?></p>


  <?php
  }
  else // Fehler
  {
?>
    <p class="h2 text-danger"><?= $fehlermsg ?></p>
<?php
  }
}
else
{
?>
  <p class="h2 text-danger">Ungültiger Link. Bitte starten Sie den Passwort-Reset erneut</p>
<?php
}
?>

</div>
<?php 
include("templates/footer.inc.php");
?>
