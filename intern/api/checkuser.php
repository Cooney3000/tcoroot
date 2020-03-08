<?php
// header ('Strict-Transport-Security: max-age=31536000');
header("Access-Control-Allow-Origin: *");
// header("Access-Control-Allow-Origin: *");
header('Content-Type: multipart/form-data; charset=utf-8');

session_start();

require_once("../inc/functions.inc.php");
require_once("../inc/config.inc.php");

// API - User Check In

//Überprüfe, dass der User eingeloggt und berechtigt ist
$result = array();

if (is_checked_in()) 
{
  $result = check_user();
  $result['retcode'] = 'OK';
}
else 
{
  $result['retcode'] = 'NOK';
}
echo json_encode($result, JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
// echo('{"records":[{' . $rc . '}]}');

?>
