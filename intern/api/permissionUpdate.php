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
if (!checkPermissions(VORSTAND)) {
    TECHO(DBG, "Keine Berechtigung");
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
$uid = $_GET['uid'];
$resetRow = ($col == 'rs');
$fieldlist = "user_id, $col";
$valuelist = "$uid, '$value'";

$sql='';
if ($resetRow) {
  $sql = "DELETE FROM permissions WHERE user_id = '$uid'";
} else {
  $sql = "INSERT INTO permissions($fieldlist) VALUES ($valuelist) ON DUPLICATE KEY UPDATE user_id=$uid, $col=$value"; 
}

TLOG(DBG, "sql:\r\n$sql", __LINE__);

if ($conn->query($sql) === false) {
  TLOG(ERROR, "SQL-Operation gescheitert:\r\n$sql", __LINE__);
}
$conn->close();

?>

