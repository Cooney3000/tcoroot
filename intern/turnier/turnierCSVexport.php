<?php 
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/csv;charset=UTF-8');
header('Content-Disposition: attachment; filename=anmeldungen2019.csv');

session_start();
require_once("../inc/config.inc.php");
require_once("../inc/functions.inc.php");
require_once("../inc/permissioncheck.inc.php");

//Überprüfe, dass der User eingeloggt und berechtigt ist
//Der Aufruf von check_user() muss in alle internen Seiten eingebaut sein
if ( ! is_checked_in()) {
  header('Location: /intern/login.php');
  exit; // WICHTIG falls der Browser nicht redirected
}else {
  $user = check_user();
}

$order = ["created_at DESC", "category, created_at DESC", "category, LK, created_at DESC", "category, spielername ASC", "zusage DESC"];

if (isset($_GET["order"])) {
  $o = $_GET["order"];
} else {
  $o = 0;
}
$orderSQL = $order[$o];

$sql = "SELECT * FROM tournament_players ORDER BY ".$orderSQL;
$statement = $pdo->prepare($sql);
$result = $statement->execute();
if($result) {


  $file = 'Spielername;Timestamp;Zusage;LK;Kategorie;Verfuegbar am 16.6.2019;Freitags verfuegbar ab;Verfuegbar am Finaltag 21.9.2019;Telefon/WhatsApp;Kommentar'."\r\n";
  while($row = $statement->fetch()) {
    $file .=       $row['spielername']
              .';'.$row['created_at']
              .';'.$row['zusage']
              .';'.$row['LK']
              .';'.$row['category']
              .';'.$row['comment1']
              .';'.$row['comment2']
              .';'.$row['comment3']
              .';'.$row['comment4']
              .';'.$row['comment5']
              ;
    $file .= "\r\n"; 
  }
  echo chr(255) . chr(254) . mb_convert_encoding($file, 'UTF-16LE', 'UTF-8');
} 

?>