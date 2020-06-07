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
$uid = $_GET['uid'];
$tid = $CONFIG['activeTournament'];
$resetRow = ($col == 'rs');
$fieldlist = "tournament_id, user_id, $col";
$valuelist = "$tid, $uid, '$value'";


if (DEBUG) error_log('[' . basename($_SERVER['PHP_SELF']) . "], \$id: " . ($id == ''));

$sql='';
if ($id == '') {
  $sql = "INSERT INTO tournament_players($fieldlist) VALUES ($valuelist)";
} else {
  if ($resetRow) {
    $sql = "DELETE FROM tournament_players WHERE tournament_id = '$tid' AND user_id = '$uid'";
  } else {
    $sql = "UPDATE tournament_players SET $col = '$value' WHERE id=$id"; 
  }
}

if (DEBUG) error_log('[' . basename($_SERVER['PHP_SELF']) . "] sql:\r\n$sql");

if ($conn->query($sql) === false) {
  error_log('[' . basename($_SERVER['PHP_SELF']) . "]: SQL-Operation gescheitert:\r\n$sql");
}
$conn->close();

?>

