<?php 
header ('Strict-Transport-Security: max-age=31536000');
header("Access-Control-Allow-Origin: *");
header('Content-Type: text/html; charset=utf-8');

//Bereitstellen aller Daten für die Magnettafel

session_start();
require_once("../inc/config.inc.php");
require_once("../inc/functions.inc.php");
require_once("../inc/permissioncheck.inc.php");

//Überprüfe, dass der User eingeloggt und berechtigt ist
//Der Aufruf von check_user() muss in alle internen Seiten eingebaut sein

// $user = check_user();
// $userId = $user['id'];

// Create connection
$conn = new mysqli($db_host, $db_user, $db_password, $db_name);
$conn->set_charset("utf8");

if ($conn->connect_error) {
  die($fehlerMsg['dbconnect'] ."\r\n$db_host, $db_user, $db_password, $db_name\r\n". ' ' . $fehlerAction . "\r\n<br>" . $conn->connect_error);
}

$id = $_GET['i'];
$col = $_GET['col'];
$value = $_GET['v'];

$sql='';
$sql = "UPDATE bookings SET $col = '$value' WHERE id=$id"; 

if ($conn->query($sql) === false) {
  LOG(DBG, "SQL-Operation gescheitert:\r\n$sql");
}
$conn->close();

?>

