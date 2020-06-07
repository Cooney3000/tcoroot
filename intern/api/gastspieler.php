<?php 
header ('Strict-Transport-Security: max-age=31536000');
header("Access-Control-Allow-Origin: *");
header('Content-Type: text/html; charset=utf-8');

//Bereitstellen aller Daten für die Magnettafel

session_start();
require_once("../inc/config.inc.php");
require_once("../inc/functions.inc.php");
require_once("../inc/permissioncheck.inc.php");

//Der Aufruf von check_user_silent() muss in alle API-Skripten eingebaut sein
$user = check_user_silent();
if ( ! $user ) {
  echo ('{"records": [{"returncode":"user not logged in"}] }');
  exit;
}

$id = $_GET['i'];
$col = $_GET['col'];
$value = $_GET['v'];

$sql='';
$sql = "UPDATE bookings SET $col = '$value' WHERE id=$id"; 

if ($pdo->query($sql) === false) 
{
  TLOG(ERROR, "SQL-Operation gescheitert:\r\n$sql", __LINE__);
  echo ('{"records": [{"returncode":"nok"}] }');
  exit;
} 
else 
{
  echo ('{"records": [{"returncode":"ok"}] }');
}

?>

