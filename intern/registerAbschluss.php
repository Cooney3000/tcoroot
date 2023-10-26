<?php 
session_start();
require_once("inc/config.inc.php");
require_once("inc/functions.inc.php");

$title = "Bestätigung der Registrierung";
include("inc/header.inc.php")
?>
<script>
    document.getElementById("nav-intern").classList.remove("active");
    document.getElementById("nav-einstellungen").classList.remove("active");
    document.getElementById("nav-turnier").classList.remove("active");
    document.getElementById("nav-halloffame").classList.remove("active");
    document.getElementById("nav-tafel").classList.remove("active");
    if (typeof(document.getElementById("nav-login").classList.remove("active"))) { document.getElementById("nav-login").classList.remove("active") }
    if (typeof(document.getElementById("nav-logout").classList.remove("active"))) {document.getElementById("nav-logout").classList.remove("active")}
</script>

<div class="container main-container">
<h1>Bestätigung der Registrierung</h1>
<?php
 
if(isset($_GET['t'])) {
	$error = false;
	$token = trim($_GET['t']);
}
	
//Überprüfe das Token
if(!$error) { 
  $statement = $pdo->prepare("SELECT * FROM optintokens WHERE token = :token");
  $result = $statement->execute(array('token' => $token));
  $optintoken = $statement->fetch();
  
  if ($optintoken != FALSE) {
    // Setze den Status auf 'A'
    $sql = "UPDATE users SET status = 'A' WHERE email = '".$optintoken['email']."'";
    // echo "<p>$sql</p>";
    $count = $pdo->exec($sql);

    // Das Token wird gelöscht
    $sql = "DELETE FROM optintokens WHERE token = '$token'";
    // echo "<p>$sql</p>";
    $count = $pdo->exec($sql);
    echo '<h2>Gratuliere! Dein Account wurde aktiviert! <a href="login.php">Zum LOGIN</a></h2>';
  }
}
?>
</div>
<?php 
include("inc/footer.inc.php");
?>
