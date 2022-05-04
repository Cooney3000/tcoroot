<?php
session_start();
require_once("../inc/config.inc.php");
require_once("../inc/functions.inc.php");
require_once("../inc/permissioncheck.inc.php");

$user = check_user();

if (!checkPermissions(T_ALL_PERMISSIONS)) {
  echo ("<html><body>");
  TECHO(DBG, "Für diese Seite besitzt du leider nicht die nötige Berechtigung", __LINE__);
  echo ("</body></html>");
  die("Keine Berechtigung");
}

$title = "TCO Serienimport";
include("header.inc.php");
$menuid = "nav-" . getFilename(__FILE__);
?>
<script>
  document.getElementById("<?= $menuid ?>").classList.add("active");
</script>


<?php


  $sql = <<<EOT
INSERT INTO bookings (
  `id`, `ta_id`, `booking_state`, `series_id`, 
  `created_at`, `updated_at`, `user_id`, `updated_by`, 
  `player1`, `player2`, `player3`, `player4`, 
  `court`, `starts_at`, `ends_at`, `booking_type`, 
  `comment`, `price`, `paid`) 
VALUES 
EOT;

$jetzt = date('Y-m-d H:m');
$serieID = "Punktspiele";
$file = "spielplan2022.csv";
$openfile = fopen($file, "r");
$fileArray = explode("\r\n", fread($openfile, filesize($file)));
$firstLine = true;
$data = "";

foreach($fileArray as $line) {
  if ($firstLine) {
    $firstLine = false;
    continue;
  };
  $line = rtrim($line);
  $colArray = explode(";", $line);
  $platzArray = explode(",", $colArray[0]);
  foreach($platzArray as $platz) {
// (0,0,'A','test', '2022-05-03 20:05','2022-05-03 20:05',211,211, 9,0,0,0, 1,'2022-05-02 08:00','2022-05-02 10:30','ts-punktspiele', '','0','0'),
    $data .= "(0,0,'A','$serieID','$jetzt','$jetzt',211,211,'". $colArray[1] ."',0,0,0,$platz,'". $colArray[6] ."','". $colArray[7] ."','ts-punktspiele', '','0','0'),\r\n";
  }
}

$sql .= substr($data,0,strlen($data) - 3);
$statement = $pdo->prepare($sql);
$statement->execute();

// Noch den Eintrag in der seriesnames-Tabelle vornehmen
$sql = "INSERT INTO `seriesnames` (`series_id`, `created_at`, `comment`) VALUES ('$serieID','$jetzt', '$serieID')";
$statement = $pdo->prepare($sql);
$statement->execute();



?>

<?php
include("footer.inc.php");
?>