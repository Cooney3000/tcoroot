<?php
//
// Belegungen ab 17:00 zurückgeben
// -------------------------------
//

require_once("../inc/config.inc.php");
require_once("../inc/functions.inc.php");
require_once("../inc/permissioncheck.inc.php");
session_start();

//Überprüfe, dass der User eingeloggt und berechtigt ist
//Der Aufruf von check_user_silent() muss in alle API-Skripten eingebaut sein
$user = check_user_silent();
if ( ! $user ) {
  echo ('{"records": [{"returncode":"user not logged in"}] }');
  exit;
}

$userId = $user['id'];
TLOG(DBG, "REQUEST-Method: " . $_SERVER['REQUEST_METHOD'], __LINE__);
if(strcasecmp($_SERVER['REQUEST_METHOD'], 'GET') != 0)
{
  echo ('{"records": [{"returncode":"nok"}] }');
  throw new Exception('Request method must be GET!');
  exit;
}

// Create connection
global $conn;
$conn = new mysqli($db_host, $db_user, $db_password, $db_name);
$conn->set_charset("utf8");
if ($conn->connect_error) 
{
  die($fehlerMsg['dbconnect'] ."\r\n$db_host, $db_user, $db_password, $db_name\r\n". ' ' . $fehlerAction . "\r\n<br>" . $conn->connect_error);
}

$json = '{"records":[]}';
$sql = '';

$heuteDatum = date('Y-m-d');
$heuteUhrzeit = date('m:h');
// // TESTDATEN ***************************************************
// $heuteDatum = '2020-05-23';
// $heuteUhrzeit = '08:00';

$sql = <<<EOT
SELECT court, starts_at, ends_at 
  FROM `bookings` 
  WHERE booking_state = 'A' AND `starts_at` >= '$heuteDatum $heuteUhrzeit' AND `starts_at` < '$heuteDatum 23:59' order by starts_at, court
EOT;

TLOG(DBG, $sql, __LINE__);

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

TLOG(DBG, $json, __LINE__);

echo $json;

$conn->close();

?>







