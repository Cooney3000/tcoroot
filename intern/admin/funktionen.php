<?php
session_start();
require_once("../inc/config.inc.php");
require_once("../inc/functions.inc.php");
require_once("../inc/permissioncheck.inc.php");

//Überprüfe, dass der User eingeloggt und berechtigt ist
$user = check_user();

$title = "TCO Admin-Funktionen";
include("header.inc.php");
$menuid = "nav-" . getFilename(__FILE__);
?>

<script>
  document.getElementById("<?= $menuid ?>").classList.add("active");
</script>

<?php
if (checkPermissions(KASSIER)) {
?>

  <div class="container main-container registration-form">
    <h1>Funktionen</h1>

    <!-- <form action="index.php" method="post"> -->
    <h3> Registrierungscode</h3>
    <p>
      Einen Registrierungscode erzeugen, der nach 30 Tagen oder nach gültiger Registrierung erlischt.
      Mit diesem Code darf man sich registrieren. Zu vergeben z. B. an neue Mitglieder.
    </p>


    <form action="javascript:generateRegcode()" class="row g-3">
      <div class="col-auto">
        <!-- <button name="generateRegCode" onclick="showRegcode()" class="btn btn-success" type="submit">Registrierungscode erzeugen</button> -->
        <button name="generateRegCode" class="btn btn-success" type="submit">Registrierungscode erzeugen</button>
      </div>
      <div class="col-auto">
        für (bitte Namen eingeben)
      </div>
      <div class="col-auto">
        <input class="form-control " id="regcodeperson" required />
      </div>
    </form>
    <div class="my-3">
      <span id="regcodeLabel" class="h3 my-3"></span> <span id="regcode" class="h3 bg-light rounded-3 my-3"></span>
    </div>

    <!-- </form> -->




  </div>

  <script>
    // function generateRegcode() {
    //   if (document.getElementById("regcodeperson").value !== "") {
    //     document.getElementById("regcode").innerHTML = "Neuer Code für " + document.getElementById("regcodeperson").value + ": WALLA";
    //   }
    //   else {
    //     document.getElementById("regcode").innerHTML = "";
    //   }
    // }

    function generateRegcode() {
      if (document.getElementById("regcodeperson").value !== "") {
        const url = "/intern/api/regcodenew.php?p=" + encodeURIComponent(document.getElementById("regcodeperson").value);
        // console.log(url);
        fetch(url, {
            credentials: 'same-origin'
          })
          .then(result => {
            if (result.ok) {
              // console.log(result);
              return result.json();
            } else {
              throw new Error('Fehler beim Generieren eines Registrierungscodes');
            }
          })
          .then(result => {
            if (result.retcode == "OK") {
              // console.log(result);
              document.getElementById("regcodeLabel").innerHTML = "Neuer Code für " + document.getElementById("regcodeperson").value + ": ";
              document.getElementById("regcode").innerHTML = result.regcode;
            } else {
              throw new Error('Fehler beim Generieren eines Registercodes' + this.state.r.id);
            }
          });
      } else {
        document.getElementById("regcode").innerHTML = "";
      }
    }
  </script>

<?php
}
include("footer.inc.php");
?>