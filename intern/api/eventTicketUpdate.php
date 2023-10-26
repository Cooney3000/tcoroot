<?php 
header ('Strict-Transport-Security: max-age=31536000');
header("Access-Control-Allow-Origin: *");
header('Content-Type: text/html; charset=utf-8');

//Updaten Userdaten, generisch

session_start();
require_once("../inc/config.inc.php");
require_once("../inc/functions.inc.php");
require_once("../inc/permissioncheck.inc.php");

//Überprüfe, dass der User eingeloggt und berechtigt ist
//Der Aufruf von check_user_silent() muss in alle APIs eingebaut sein
$user = check_user_silent();
if ( ! $user ) {
  echo ('{"records": [{"returncode":"user not logged in"}] }');
  exit;
}

// Create connection
$conn = new mysqli($db_host, $db_user, $db_password, $db_name);
$conn->set_charset("utf8");

if ($conn->connect_error) {
  die($fehlerMsg['dbconnect'] ."\r\n$db_host, $db_user, $db_password, $db_name\r\n". ' ' . $fehlerAction . "\r\n<br>" . $conn->connect_error);
}

$col = $_GET['col'];
$value = $_GET['v'];
$id = $_GET['i'];

$sql = <<<EOT
UPDATE event_tickets SET $col = '$value' WHERE id=$id
EOT;

error_log($sql);

if ($conn->query($sql) === FALSE) {
  error_log("userUpdate.php: Kann nicht speichern:" . $sql);
}
$conn->close();

?>

