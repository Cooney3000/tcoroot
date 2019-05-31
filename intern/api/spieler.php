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

$sql = <<<EOT
SELECT id, CONCAT(vorname, ' ', nachname) as spieler FROM users WHERE status = "T" OR status = "A" ORDER BY status, vorname, nachname
EOT;

// error_log($sql);

$result = $conn->query($sql);
if ($result->num_rows > 0) {
  $json='';
  $komma = ' ';
  while($row = $result->fetch_assoc()) {
    $tem = $row;
    $json .= $komma . json_encode($tem);
    
    $komma = ',';
  }
  $json = '{"records":['.$json.']}';
} else {
  $json = '{"records":[]}';
}
echo $json;

$conn->close();

?>

