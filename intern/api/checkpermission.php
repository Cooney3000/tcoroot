<?php
// header ('Strict-Transport-Security: max-age=31536000');
header("Access-Control-Allow-Origin: *");
header('Content-Type: multipart/form-data; charset=utf-8');

session_start();
require_once("../inc/permissioncheck.inc.php");

// API-Permission-Check

$result = [];

if (isset($_GET['required'])) {
  $result['retcode'] = checkPermissions($required) ? 'OK' : 'NOK';
} else {
  $result['retcode'] = $_SESSION['permissions'];
}

// error_log("[checkpermission.php])" . json_encode($result, JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES) . "\r\n");

echo json_encode($result, JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
// echo('{"records":[{' . $rc . '}]}');

?>
