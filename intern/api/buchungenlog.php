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

$user = check_user();
$userId = $user['id'];

// $line = strftime("%Y-%m-%d %H-%M-%S") . " $_SERVER[REQUEST_URI]";;
// file_put_contents('../logs/buchungen.log', $line.PHP_EOL , FILE_APPEND | LOCK_EX);

$sql = <<<EOT
INSERT INTO log_tafel 
  (user_id, bookings_id, operation, comment) 
  VALUES
  (?,?,?,?)
EOT;
// error_log ($sql . " ### " . $_GET['uid'].", ".$_GET['rid'].", ". $_GET['op'].", ". $_SERVER['REQUEST_URI']);
$stmt= $pdo->prepare($sql);
$stmt->execute([$_GET['uid'], $_GET['rid'], $_GET['op'], $_SERVER['REQUEST_URI']]);

?>

