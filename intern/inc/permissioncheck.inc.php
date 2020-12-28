<?php

  // Es gibt 16 Rechte. Übereinandergelegt

  // Recht:        1 2 3 4  5  6  7   8   9  10   11   12   13   14    15    16
  // Dezimalwert:  1 2 4 8 16 32 64 128 256 512 1024 2048 4096 8192 16384 32768 
  //
  // Summen daraus sind kombinierte Rechte, z.B. 
  //                3 ist Recht 1 und Recht 2
  //               15 ist Recht 1, 2, 3, 4 (1+2+4+8)
  //              128 ist Recht 8
  //              143 ist Recht 1,2,3,4,8    
    foreach ($pdo->query("SELECT * FROM permissionnames")as $line) {
      define($line['technical_name'],$line['pattern']);
    }

  function checkPermissions($required) {
      $userPermissions = intval($_SESSION['permissions']);
      return $required == ($userPermissions & intval($required));
  }
?>
