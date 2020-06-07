<?php
    class PERMISSIONS
    {
      // Es gibt 16 Rechte. Übereinandergelegt
      
      // Recht:        1 2 3 4  5  6  7   8   9  10   11   12   13   14    15    16
      // Dezimalwert:  1 2 4 8 16 32 64 128 256 512 1024 2048 4096 8192 16384 32768 
      //
      // Summen daraus sind kombinierte Rechte, z.B. 
      //                3 ist Recht 1 und Recht 2
      //               15 ist Recht 1, 2, 3, 4 (1+2+4+8)
      //              128 ist Recht 8
      //              143 ist Recht 1,2,3,4,8
        const NONE = 0;
        const MYDATA_READ = 1;
        const MYDATA_WRITE = 2;
        const MYDATA_UPDATE = 3;          // kombiniert
        const ALLDATA_READ = 5;           // kombiniert
        const ALLDATA_WRITE = 8;  
        const ALLDATA_UPDATE = 15;        // kombiniert
          const MANNSCHAFTSFUEHRER = 32;
        const PERMISSION_FREE_3 = 64;
          const T_ALL_PERMISSIONS = 128;    // Turnierverantwortliche
        const PERMISSION_FREE_4 = 256;
          const VORSTAND = 432;             // Mannschaftsführer, Turnierverantwortliche, Vorstand
        const PERMISSION_FREE_5 = 512;
        const PERMISSION_FREE_6 = 1024;
        const PERMISSION_FREE_7 = 2048;
        const PERMISSION_FREE_8 = 4096;
        const PERMISSION_FREE_9 = 8192;
        const PERMISSION_FREE_10 = 16384;
        const PERMISSION_FREE_11 = 32768;
          const ADMINISTRATOR = 65535;

    };
    function checkPermissions($required) {
        $userPermissions = $_SESSION['permissions'];
        return $required == ($userPermissions & $required);
      }
?>
