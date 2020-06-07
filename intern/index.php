<?php
  session_start();
  require_once("inc/config.inc.php");
  require_once("inc/functions.inc.php");
  require_once("inc/permissioncheck.inc.php");


  $user = check_user_silent();

  if ( ! $user ) {
    // neuer, unbekannter Benutzer
    $targetPage = 'Location: ' . HOSTNAME . '/intern/login.php';
  } 
  else 
  {
    $targetPage = 'Location: ' . HOSTNAME . '/intern/internal.php';
  }  
  header($targetPage);
  exit; // WICHTIG falls der Browser nicht redirected
?>