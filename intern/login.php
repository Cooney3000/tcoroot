<?php 
session_start();
require_once("inc/config.inc.php");
require_once("inc/functions.inc.php");

//Referer merken und ins Formular schreiben, damit nach dem Login dahin zurückgekehrt werden kann
if (isset($_SERVER["HTTP_REFERER"])) {
  $_referer = $_SERVER["HTTP_REFERER"];
  if (endsWith($_referer, "login.php")) {
    $_referer = $_POST['ref'];
  }
} else {
  $_referer = "internal.php";
}
error_log("REFERER: ".$_referer);
$error_msg = "";
if(isset($_POST['email']) && isset($_POST['passwort'])) {
	$email = $_POST['email'];
	$passwort = $_POST['passwort'];

	$statement = $pdo->prepare("SELECT * FROM users WHERE email = :email AND NOT (status = 'D')");
	$result = $statement->execute(array('email' => $email));
  $user = $statement->fetch();
	//Überprüfung des Passworts
	if ($user && password_verify($passwort, $user['passwort'])) {
    $_SESSION['userid'] = $user['id'];
    
    //Berechtigung dazuholen
    $statement = $pdo->prepare("SELECT * FROM permissions WHERE user_id = :user_id");
    $result = $statement->execute(array('user_id' => $user['id']));
    $permissions = $statement->fetch();
    $_SESSION['permissions'] = $permissions['permissions'];
  

		//Möchte der Nutzer angemeldet bleiben?
		if(isset($_POST['angemeldet_bleiben'])) {
			$identifier = random_string();
			$securitytoken = random_string();
				
			$insert = $pdo->prepare("INSERT INTO securitytokens (user_id, identifier, securitytoken) VALUES (:user_id, :identifier, :securitytoken)");
			$insert->execute(array('user_id' => $user['id'], 'identifier' => $identifier, 'securitytoken' => sha1($securitytoken)));
			setcookie("identifier",$identifier,time()+(3600*24*365)); //Valid for 1 year
			setcookie("securitytoken",$securitytoken,time()+(3600*24*365)); //Valid for 1 year
    }
    // Befindet sich der Benutzer noch im Wartebereich?
    if ($user['status'] == 'W') {
      $error_msg =  "Dein Account ist noch nicht aktiviert. Schreibe bitte eine Mail an webmaster@tcolching.de, falls das schon länger so ist.";
    } else {
      // Alles gut, weiter zum Internen Bereich als eingeloggter User
      header("location:".$_referer);
      exit;
    }
	} else {
		$error_msg =  "E-Mail oder Passwort war ungültig";
	}

}

$email_value = "";
if(isset($_POST['email']))
	$email_value = htmlentities($_POST['email']); 

  $title = "Login";
include("templates/header.inc.php");
?>
<script>
    // var element = document.getElementById("nav-intern");
    // element.classList.add("active");
    document.getElementById("nav-intern").classList.remove("active");
    document.getElementById("nav-einstellungen").classList.remove("active");
    document.getElementById("nav-turnier").classList.remove("active");
    document.getElementById("nav-tafel").classList.remove("active");
    document.getElementById("nav-login").classList.add("active");
    document.getElementById("nav-logout").classList.remove("active");
</script>

 <div class="container small-container-330 form-signin">
  <form action="login.php" method="post">
    <input type="hidden" name="ref" value="<?= $_referer ?>">
	  <h2 class="form-signin-heading">Login mit E-Mail-Adresse und Passwort</h2>
	
<?php 
if(isset($error_msg) && !empty($error_msg)) {
?>
    <div class="h5 mb-4 text-danger"><?= $error_msg ?></div>
<?php
}
?>
    <label for="inputEmail" class="sr-only">E-Mail</label>
    <input type="email" name="email" id="inputEmail" class="form-control" placeholder="E-Mail" value="<?php echo $email_value; ?>" required autofocus>
    <label for="inputPassword" class="sr-only">Passwort</label>
    <input type="password" name="passwort" id="inputPassword" class="form-control" placeholder="Passwort" required>
    <div class="checkbox">
      <label>
      <input type="checkbox" value="remember-me" name="angemeldet_bleiben" value="1" checked> Angemeldet bleiben (außer, du machst einen Logout)
      </label>
    </div>
    <button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>
    <br>
    Passwort vergessen? Dann bitte <a href="mailto:webmaster@tcolching.de">webmaster@tcolching.de</a> darum bitten, das Passwort zurückzusetzen.
    <!-- <a href="passwortvergessen.php">Passwort vergessen</a> -->
  </form>
  <p class="h5 my-2">Noch nicht registriert? <a href="register.php">Zur Registrierung</a></p>

</div> <!-- /container -->
 

<?php 
include("templates/footer.inc.php")
?>