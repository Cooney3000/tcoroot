<?php
session_start();
require_once("../inc/config.inc.php");
require_once("../inc/functions.inc.php");
require_once("../inc/permissioncheck.inc.php");

//Überprüfe, dass der User eingeloggt und berechtigt ist
$user = check_user();

$title = "TCO-Shop: Export";
include("header.inc.php");
$menuid = "nav-" . getFilename(__FILE__);



// Excel Export HIER




?>







<?php
include("footer.inc.php");
?>