<?php
//
// Belegung CRUD
// -----------------
//   Parameter:
//      op - Operation: 
//            r: Lesen einer Belegung (Parameter i)
//            ra: Lesen aller Belegungen eines oder mehrerer Tage (Parameter ds bis de, Parameter i wird ggf. ignoriert)
//            d: Löschen einer Belegung (Parameter i)
//            cu: create/update einer Belegung
//      i - Einschränkung auf eine bestimmte Belegung
//      ds - Startdatum
//      de - Enddatum
//      uid - user_id des Buchenden
//      p1 - p4 - user_id des 1. - 4. Spielers (2 Spieler sind mandatory)
//      c - court
//      t - booking_type
//      pr - price (für Gaststunden)
//

header ('Strict-Transport-Security: max-age=31536000');
header("Access-Control-Allow-Origin: *");
header('Content-Type: multipart/form-data; charset=utf-8');
session_start();
require_once("../inc/config.inc.php");
require_once("../inc/functions.inc.php");
require_once("../inc/permissioncheck.inc.php");

if(strcasecmp($_SERVER['REQUEST_METHOD'], 'POST') != 0){
  //throw new Exception('Request method must be POST!');
} else {
  error_log("POST DATA: ".$_POST);
  die("BYE!");
}

//Überprüfe, dass der User eingeloggt und berechtigt ist
//Der Aufruf von check_user() muss in alle internen Seiten eingebaut sein

$user = check_user();
$userId = $user['id'];

// Create connection
global $conn;
$conn = new mysqli($db_host, $db_user, $db_password, $db_name);
$conn->set_charset("utf8");
if ($conn->connect_error) {
  die($fehlerMsg['dbconnect'] ."\r\n$db_host, $db_user, $db_password, $db_name\r\n". ' ' . $fehlerAction . "\r\n<br>" . $conn->connect_error);
}

$op = $_GET['op'];
$json = '{"records":[]}';
$sql = '';

// error_log(join(' # ',$_GET)."\r\n");

switch ($op) {
  case 'r':
    $sql = readB();
    $json = execRsql($sql);
    break;
  case 'ra':
    $sql = readaB();
    $json = execRsql($sql);
    break;
  case 'd':
    deleteB();
    break;
  case 'cu':
    $json = createUpdateB();
    break;
  default:
    error_log("platz.php: Unbekannter OP-Code=".$op);
    break;
}

// error_log($json);
echo $json;
$conn->close();
return;
//END


// -------------------------------------------------------
function execRsql ($sql) {
  global $conn;
  $json = '';
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
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
  return $json;
}


function readB() {
  if (! $_GET['i']) {
    die("platz.php: Keine id angegeben!");
  }

  $i = $_GET['i'];
  $p1 = "CONCAT(U1.vorname,' ',";
  $p2 = "CONCAT(U2.vorname,' ',";
  $p3 = "CONCAT(U3.vorname,' ',";
  $p4 = "CONCAT(U4.vorname,' ',";
  $where = 'B.ta_id = 0 AND B.booking_state="A" AND B.id='.$i;

  $sql = <<<EOT
SELECT B.*, 
  {$p1}U1.nachname) as p1, 
  {$p2}U2.nachname) AS p2, 
  {$p3}U3.nachname) AS p3, 
  {$p4}U4.nachname) AS p4,
  B.player1 AS p1id,
  B.player2 AS p2id,
  B.player3 AS p3id,
  B.player4 AS p4id
FROM bookings as B 
  LEFT JOIN users as U1 ON B.player1=U1.id
  LEFT JOIN users as U2 ON B.player2=U2.id
  LEFT JOIN users as U3 ON B.player3=U3.id
  LEFT JOIN users as U4 ON B.player4=U4.id
WHERE {$where}
EOT;

  error_log("platz.php: ".$sql);
  return $sql;
}

function readaB() {
  $p = intval($_GET["p"]);                  // Platznummer 1 - 6
  $ds = $_GET["ds"] . " 00:00:00";          // Start-Datum des Belegungstags
  $de = $_GET["de"] . " 23:59:00";          // Ende-Datum des Belegungstags
  // error_log("Platz: $p, Tag: " . $d);
  // $p1 = $p2 = $p3 = $p4 = '(';
  $p1 = "CONCAT(SUBSTRING(U1.vorname, 1, 1), '. ',";
  $p2 = "CONCAT(SUBSTRING(U2.vorname, 1, 1), '. ',";
  $p3 = "CONCAT(SUBSTRING(U3.vorname, 1, 1), '. ',";
  $p4 = "CONCAT(SUBSTRING(U4.vorname, 1, 1), '. ',";

  $where = 'B.ta_id = 0 AND B.booking_state="A" AND B.starts_at > "'.$ds.'" AND B.ends_at < "'.$de.'" AND B.court = '.$p;
  $sql = <<<EOT
  
  SELECT B.*, 
  {$p1}U1.nachname) as p1, 
  {$p2}U2.nachname) AS p2, 
  {$p3}U3.nachname) AS p3, 
  {$p4}U4.nachname) AS p4,
  B.player1 AS p1id,
  B.player2 AS p2id,
  B.player3 AS p3id,
  B.player4 AS p4id
  FROM bookings as B 
  LEFT JOIN users as U1 ON B.player1=U1.id
  LEFT JOIN users as U2 ON B.player2=U2.id
  LEFT JOIN users as U3 ON B.player3=U3.id
  LEFT JOIN users as U4 ON B.player4=U4.id
  WHERE $where
EOT;
  return $sql;
}
  
function deleteB() {
  global $conn;
  $conn->query("DELETE FROM bookings WHERE id = ".$_GET['i']);
}

function createUpdateB() {

  // Eine Belegung erzeugen
  //   Die Änderung des Zeitraums einer existierenden Belegung wird wie folgt durchgeführt:
  //    - Anlegen einer temporären Belegung
  //    - Check, ob der Platz in dem gewünschten Zeitraum frei ist
  //    - Falls ja, wird die alte Belegung gelöscht und die temporäre Belegung wird zur neuen fixiert.
  //    - Falls nein, wird die temporäre Belegung einfach wieder gelöscht 
  global $conn;


  // Eine zufällige Transaktions-Id für die temporäre Belegung erzeugen. Dient als temporäre id.
  mt_srand(time());
  $ta_id = mt_rand();

  $dt = date('Y-m-d H:i:s');

  // Zunächst eine Zeit reservieren mit einer "Transaktions-Id" (ta_id). Wenn eine Row eine ta_id <> 0 hat, dann ist die Belegungszeit auf dem Court geblockt.

  $sql = <<<EOT
INSERT INTO bookings 
  (ta_id, booking_state, created_at, updated_at, user_id, player1, player2, player3, player4, court, starts_at, ends_at, booking_type, comment, price) 
  VALUES
  ({$ta_id}, 'A', '{$dt}', '{$dt}', {$_GET['uid']}, {$_GET['p1']}, {$_GET['p2']}, {$_GET['p3']}, {$_GET['p4']}, {$_GET['c']}, '{$_GET['ds']}', '{$_GET['de']}', '{$_GET['t']}', '{$_GET['cmt']}', {$_GET['pr']})
EOT;

  //error_log($sql);
  if ($conn->query($sql) === TRUE) {
      $current_ta_id = $conn->insert_id;
      // error_log("Transaktions-Zeile ". $ta_id ." geschrieben");
  } else {
      error_log("Error: " . $conn->error);
      die("Error: " . $conn->error);
  }

  // Jetzt prüfen, ob der Zeitraum bereits von jemand anderem belegt wird

  $sql = <<<EOT
SELECT B.*
FROM bookings as B 
WHERE B.id <> {$_GET['i']} AND B.ta_id = 0 AND B.booking_state="A" AND (B.starts_at < "{$_GET['de']}" AND B.ends_at > "{$_GET['ds']}") AND B.court = {$_GET['c']}
EOT;

  // error_log($sql);
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {

    // error_log("platz.php: ZEIT BEREITS BELEGT: \r\n".$sql);
    // In diesem Fall löschen wir die vorhin angelegte Row wieder
    $result = $conn->query("DELETE FROM bookings WHERE id = $current_ta_id");
    
    return '{"records":[ {"returncode":"bereits belegt"}]}';
    
  } else {

    // error_log("ZEIT FREI: \r\n".$sql);
    // Jetzt löschen wir eine ggf. vorhandene ursprüngliche Buchung
    $_GET['i'] ? $conn->query("DELETE FROM bookings WHERE id = {$_GET['i']}") : 0;
    // Updaten der temp. Transaktions-Id auf 0 und machen die neue Belegung dadurch endgültig!
    $result = $conn->query("UPDATE bookings SET ta_id = 0 WHERE id = $current_ta_id");
    
    return '{"records":[ {"returncode":"ok"}]}';

  }
  
}



?>
