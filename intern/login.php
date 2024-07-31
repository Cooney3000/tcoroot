<?php
session_start();
require_once("inc/config.inc.php");
require_once("inc/functions.inc.php");

//
// Login-Formular
//

$error_msg = "";
if (isset($_POST['email']) && isset($_POST['passwort'])) 
{
  $email      = $_POST['email'];
  $passwort   = $_POST['passwort'];

  $statement = $pdo->prepare("SELECT * FROM users WHERE email = :email AND NOT (status = 'D')");
  $statement->execute(array('email' => $email));
  $user = $statement->fetch();
  
  //Überprüfung des Passworts
  if ($user && password_verify($passwort, $user['passwort'])) 
  {
    $_SESSION['userid'] = $user['id'];
    
    //
    //Berechtigung dazuholen
    //
    $statement = $pdo->prepare("SELECT * FROM permissions WHERE user_id = :user_id");
    $result = $statement->execute(array('user_id' => $user['id']));
    $permissions = $statement->fetch();
    $_SESSION['permissions'] = $permissions['permissions'];
    
    //
    // Möchte der Nutzer angemeldet bleiben? Dann Cookie setzen
    //
    if (isset($_POST['angemeldet_bleiben'])) 
    {
      $identifier = random_string();
      $securitytoken = random_string();
      $insert = $pdo->prepare("INSERT INTO securitytokens (user_id, identifier, securitytoken) VALUES (:user_id, :identifier, :securitytoken)");
      $insert->execute(array('user_id' => $user['id'], 'identifier' => $identifier, 'securitytoken' => sha1($securitytoken)));
      setcookie("identifier", $identifier, time() + (3600 * 24 * 365), "/intern/"); //Valid for 1 year
      setcookie("securitytoken", $securitytoken, time() + (3600 * 24 * 365), "/intern/"); //Valid for 1 year
    }
    
    //
    // Befindet sich der Benutzer noch im Wartebereich?
    //
    if ($user['status'] == 'W') 
    {
      $error_msg = "Dein Account ist noch nicht aktiviert. Schreibe bitte eine Mail an webmaster@tcolching.de, falls das schon länger so ist.";
    }
    else 
    {
      //
      // Alles gut, weiter zum Internen Bereich als eingeloggter User
      //
      $redirect_to = isset($_SESSION['redirect_to']) ? $_SESSION['redirect_to'] : 'internal.php';
      unset($_SESSION['redirect_to']); // Ziel-URL aus der Session entfernen
      header("Location: $redirect_to");
      exit;
    }
  }
  else 
  {
    $error_msg = "E-Mail oder Passwort war ungültig";
  }
}

$email_value = "";

if (isset($_POST['email']))
{
  $email_value = htmlentities($_POST['email']);
}
$title = "Login";
include("inc/loginheader.inc.php");
?>
<div class="container small-container-330 form-signin">
  <form action="login.php" method="post">
    <h2 class="form-signin-heading">Login mit E-Mail-Adresse und Passwort</h2>

    <?php
    if (isset($error_msg) && !empty($error_msg)) {
    ?>
      <div class="h5 mb-4 text-danger"><?= $error_msg ?></div>
    <?php
    }
    ?>
    <label for="inputEmail" class="sr-only">E-Mail</label>
    <input type="email" name="email" id="inputEmail" class="form-control" placeholder="E-Mail" value="<?= $email_value ?>" required autofocus>
    <label for="inputPassword" class="sr-only">Passwort</label>
    <input type="password" name="passwort" id="inputPassword" class="form-control" placeholder="Passwort" required>
    <div class="checkbox">
      <label>
        <input type="checkbox" value="remember-me" name="angemeldet_bleiben" value="1" checked> Angemeldet bleiben (außer, du machst einen Logout)
      </label>
    </div>
    <button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>
    <br>
    <p class="h5 my-2">Passwort vergessen? Setze dein Passwort selbst zurück: <a href="pwvergessen.php">Passwort zurücksetzen</a></p>
  </form>
  <p class="h5 my-2">Noch nicht registriert? <a href="register.php">Zur Registrierung</a></p>

</div> <!-- /container -->

<?php
include("inc/footer.inc.php")
?>
