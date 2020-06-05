<?php
require_once("../inc/functions.inc.php");
require_once("../inc/config.inc.php");

// header ('Strict-Transport-Security: max-age=31536000');
header("Access-Control-Allow-Origin: *");
// header("Access-Control-Allow-Origin: *");
header('Content-Type: multipart/form-data; charset=utf-8');

// API - User Check In

//Überprüfe, dass der User eingeloggt und berechtigt ist
$result = array();

$result = check_user();

if (is_checked_in()) 
{
  $result['retcode'] = ($result) ? 'OK' : 'NOK';
}
else 
{
  $result['retcode'] = 'NOK';
}

if (DEBUG) error_log('[' . basename($_SERVER['PHP_SELF']) . "], result:\r\n" . json_encode($result, JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES) . "\r\n");

echo json_encode($result, JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
// echo('{"records":[{' . $rc . '}]}');

?>
