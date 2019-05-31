<?php
  session_start();
  foreach ($_SESSION as $s) {
    error_log($s);
  }
  foreach ($_COOKIE as $c) {
    error_log($c);
  }
?>