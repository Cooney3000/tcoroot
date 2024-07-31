<?php
session_start();
require_once("inc/config.inc.php");
require_once("inc/functions.inc.php");
require_once("inc/permissioncheck.inc.php");

// Einstieg in den internen Bereich

//Überprüfe, dass der User eingeloggt und berechtigt ist
//Der Aufruf von check_user() muss in alle internen Seiten eingebaut sein
$user = check_user();
// error_log (join(" # ", $user));

$title = "Intern - Players & Friends Kartenverkauf";
include("inc/header.inc.php");
?>
<script>
  // var element = document.getElementById("nav-intern");
  // element.classList.add("active");
  document.getElementById("nav-intern").classList.remove("active");
  document.getElementById("nav-turnier").classList.remove("active");
  document.getElementById("nav-halloffame").classList.remove("active");
  document.getElementById("nav-tafel").classList.remove("active");
  document.getElementById("nav-login").classList.remove("active");
  document.getElementById("nav-logout").classList.remove("active");
</script>
<div class="container main-container">

  <div class="container">
    <div class="row">
      <div class="col-lg-8">
        <h1 class="h3 persoenlich text-gross my-3">Players & Friends Night 2024!</h1>
        <p class="h4 my-4">An alle Mitglieder <strong>und Freunde</strong> des TCO!</p>
        <div class="h5 lh-lg">
          <p>Die erfolgreichste und fantastischste Tennis-Saisonabschlussparty der westlichen Hemisphäre, die Players & Friends
            Night des TCO, findet auch in 2024 wieder statt - wenn Ihr Eure Karten früh kauft!</p>
            <p><strong>Wir brauchen als Untergrenze 70 verkaufte Karten! Erreichen wir das nicht bis zum 15.&nbsp;September, können wir die Party nicht starten!</strong></p>
            <p>Also: Schreibt Euch den Termin in den Kalender, bucht die Oma für die Kinder und kauft Euch Karten: <strong>15 Euro</strong>
             für ein Armband, das Euch Eintritt und
            kulinarische Genüsse sichert. </p>
            <p>Bringt Eure Freunde und Freundinnen mit und stellt Euch auf eine lange Nacht ein!</p>
          <ol>
            <li><strong>Anmeldung</strong>
              <p>Wenn du bis jetzt noch keine Karte hast: Bitte auf dieser Seite unten anmelden. 
                Das erleichtert uns die Führung einer Liste. Die Karte/das Armband erhältst du 
                dann am Einlass.</p>
            </li>
            <li>
              <p><strong>Überweisung</strong></p>
              <p>Überweist dann <stron>pro Karte 15 Euro</strong> wahlweise per PayPal oder Überweisung auf</p>
                  <p><strong>PayPal: </strong></p>
                  <p><a href="https://www.paypal.com/paypalme/connyroloff">@connyroloff</a></p>
                  <p><strong class="w-75">Bank: </strong></p>
                  <p>Conny Roloff<br>
                  IBAN DE70120300000015437296</p>
                </tr>
                <tr>
                  <p><strong>Verwendungszweck:</strong></p>
                  <p>PF2024</p>
                </tr>
              </table>
            </li>
          </ol>
          <p class="my-4 persoenlich">Euer Party-Kommitee: Norbert und Conny</p>
        </div>
      </div>
      <div class="col-lg-4 d-flex align-items-start">
        <img src="/images/intern/playersfriends_plakat_2024.png" class="mt-3 rounded float-lg-right w-100" alt="Plakat">
      </div>
    </div>
  </div>

  <div class="registration-form">

    <?php

    $showFormular = 1;
    $cid = 14; // campaign-Id

    $registrieren = isset($_GET["register"]) ? 1 : 0;
    // error_log("0001: " . $registrieren);

    // REGISTRIERUNGSFORMULAR:
    // -----------------------
    // 1. Benutzerdaten einlesen oder aus dem Formular übernehmen: 
    //      users: Nachname, Vorname, Geschlecht, Mobilnummer, ...
    //      tournament_players: willing_to_attend, comment, ...
    // 2. Im Formular zur Verfügung stellen
    // 3. Speichern oder abbrechen

    $nachname     = "";
    $vorname      = "";
    $festnetz     = "";
    $mobil        = "";
    $ctid         = "";
    $cuid         = "";
    $willTeilnehmen  = 0;
    $kommentar    = "";
    $info1        = "";
    $info2        = "";
    $info3        = "";
    $info4        = "";
    $info5        = "";
    $info6        = "";
    $info7        = "";

    if ($registrieren) {
      // Die Formularwerte übernehmen
      error_log("0000-08: " . http_build_query($_POST));
      $nachname     = $_POST["nachname"];
      $vorname      = $_POST["vorname"];
      $festnetz     = $_POST["festnetz"];
      $mobil        = $_POST["mobil"];
      $ctid         = $cid;
      $cuid         = $user['id'];
      $willTeilnehmen  = $_POST["willTeilnehmen"] === "1" ? 1 : 0;
      $kommentar    = $_POST["kommentar"];
      $info1    = isset($_POST["info1"]) ? $_POST["info1"] : $info1;
      $info2    = isset($_POST["info2"]) ? $_POST["info2"] : $info2;
      $info3    = isset($_POST["info3"]) ? $_POST["info3"] : $info3;
      $info4    = isset($_POST["info4"]) ? $_POST["info4"] : $info4;
      $info5    = isset($_POST["info5"]) ? $_POST["info5"] : $info5;
      $info6    = isset($_POST["info6"]) ? $_POST["info6"] : $info6;
      $info7    = isset($_POST["info7"]) ? $_POST["info7"] : $info7;
      //error_log("0000-10: $info1");
    } else {
      // Die Werte initial aus der DB lesen
      $sql = <<<EOT
      SELECT 
          u.vorname AS vn, 
          u.nachname AS nn, 
          u.festnetz AS fn, 
          u.mobil as mn, 
          ctid, 
          cuid, 
          wta, 
          cmt,
          info1,
          info2,
          info3,
          info4,
          info5,
          info6,
          info7
        FROM users as u 
        LEFT JOIN (
          SELECT 
            campaign_id AS ctid, 
            user_id AS cuid, 
            willing_to_attend AS wta, 
            comment AS cmt,
            info1,
            info2,
            info3,
            info4,
            info5,
            info6,
            info7
           FROM campaign_users 
          WHERE campaign_id = $cid
          ) AS p
        ON u.id = p.cuid
        WHERE u.id = {$user['id']}
EOT;
      // $u=http_build_query($user);
      // echo("<pre>$user</pre>");
      // error_log("0002: " . $sql);
      $statement  = $pdo->query($sql);
      // Das sollte genau eine Ergebniszeile liefern
      $result     = $statement->fetch(PDO::FETCH_ASSOC);
      $nachname   = $result["nn"];
      $vorname    = $result["vn"];
      $festnetz   = $result["fn"];
      $mobil      = $result["mn"];
      $ctid       = isset($result["ctid"]) ? $result["ctid"] : "";
      $cuid       = isset($result["cuid"]) ? $result["cuid"] : "";
      $willTeilnehmen = isset($result["wta"]) ? $result["wta"] : $willTeilnehmen;
      $kommentar   = isset($result["cmt"]) ? $result["cmt"] : $kommentar;
      $info1       = isset($result["info1"]) ? $result["info1"] : $info1;
      /*
      $info2       = isset($result["info2"]) ? $result["info2"] : $info2;
      $info3       = isset($result["info3"]) ? $result["info3"] : $info3;
      $info4       = isset($result["info4"]) ? $result["info4"] : $info4;
      $info5       = isset($result["info5"]) ? $result["info5"] : $info5;
      $info6       = isset($result["info6"]) ? $result["info6"] : $info6;
      $info7       = isset($result["info7"]) ? $result["info7"] : $info7;
*/
      error_log("0003 (record): " . http_build_query($result));
    }
    if ($registrieren) {

      $sql = "UPDATE users SET festnetz = '$festnetz', mobil = '$mobil' WHERE id = {$user['id']}";
      // error_log("0004: " . $sql);
      $pdo->query($sql);
      $sql = <<<EOT
    INSERT INTO campaign_users (campaign_id, user_id, willing_to_attend, comment, info1, info2, info3, info4, info5, info6, info7) 
    VALUES ($ctid, $cuid, $willTeilnehmen, "$kommentar", "$info1", "$info2", "$info3", "$info4", "$info5", "$info6", "$info7") 
      ON DUPLICATE KEY 
    UPDATE 
      willing_to_attend = $willTeilnehmen, 
      comment = "$kommentar", 
      info1 = "$info1", 
      info2 = "$info2", 
      info3 = "$info3", 
      info4 = "$info4", 
      info5 = "$info5", 
      info6 = "$info6", 
      info7 = "$info7"
EOT;
      error_log("0005: " . $sql);
      $statement = $pdo->query($sql);
      echo ('<br><strong class="text-success">Deine Anmeldung/Absage wurde gespeichert!</strong><br>');
    }
    if ($showFormular) {
    ?>
      <p class="h3 mt-4">Deine Players & Friends-Anmeldung:</p>
      <p>Name: <?= $vorname ?> <?= $nachname ?></p>

      <form id="registerTurnierForm" class="myform" action="?register=1" method="post">
        <input type="hidden" name="vorname" value="<?= $vorname ?>">
        <input type="hidden" name="nachname" value="<?= $nachname ?>">
        <input type="hidden" name="festnetz" value="<?= $festnetz ?>">
        <div class="form-group">
          <label for="mobil">Mobilnummer (WhatsApp): </label>
          <input class="form-control" type="text" id="mobil" name="mobil" value="<?= $mobil ?>">
          <label for="mobil">Festnetznummer: </label>
          <input class="form-control" type="text" id="festnetz" name="festnetz" value="<?= $festnetz ?>">
        </div>


        <div class="form-group alert-danger px-3">
          <span class="pr-3" for="inputZusage">Ich möchte bei der Players & Friends Night kommen!&nbsp;</span>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="willTeilnehmen" id="willTeilnehmenJA" value="1" <?= ($willTeilnehmen ? 'checked' : '') ?> required>
            <label class="form-check-label" for="willTeilnehmenJA">Ja</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="willTeilnehmen" id="willTeilnehmenNEIN" value="0" <?= (!$willTeilnehmen ? 'checked' : '') ?>>
            <label class="form-check-label" for="willTeilnehmenNEIN">Nein</label>
          </div>
        </div>

        <div class="form-group">
          <label for="kommentar">Anzahl, ggf. für wen ich mitkaufe</label>
          <textarea class="form-control" name="kommentar" rows="3"><?= $kommentar ?></textarea>
        </div>

        <?php /*
        <div class="form-group">
          <label for="info1"> ############# </label>
          <textarea class="form-control" name="info1" rows="3"><?= $info1 ?></textarea>
        </div>

        <div class="form-group">
          <label for="info2"> ############# </label>
          <textarea class="form-control" name="info2" rows="3"><?= $info2 ?></textarea>
        </div>

        <div class="form-group">
          <label for="info3"> ############# </label>
          <textarea class="form-control" name="info3" rows="3"><?= $info3 ?></textarea>
        </div>

        <div class="form-group">
          <label for="info4"> ############# </label>
          <textarea class="form-control" name="info4" rows="3"><?= $info4 ?></textarea>
        </div>

        <div class="form-group">
          <label for="info5"> ############# </label>
          <textarea class="form-control" name="info5" rows="3"><?= $info5 ?></textarea>
        </div>

        <div class="form-group">
          <label for="info6"> ############# </label>
          <textarea class="form-control" name="info6" rows="3"><?= $info6 ?></textarea>
        </div>

        <div class="form-group">
          <label for="info7"> ############# </label>
          <textarea class="form-control" name="info7" rows="3"><?= $info7 ?></textarea>
        </div>
*/ ?>
        <button type="submit" class="btn btn-lg btn-success btn-block">Absenden</button>
      </form>

      <p class="h4">Bereits angemeldet:</p>
      <?php
      $sql = "SELECT * FROM users u, campaign_users c where u.id = user_id AND c.willing_to_attend = 1 AND campaign_id = $cid ORDER BY u.nachname, u.vorname";
      error_log("0012: $sql");
      $statement = $pdo->prepare($sql);
      $result = $statement->execute();

      //echo "<p><strong>TESTAUSGABEN<br>SQL: $sql<br>result: $result</strong></p>)";

      if ($result) {
      ?>
        <br>
        <div class="mx-3">
          <table class="table table-bordered table-light tbl-small">
            <thead>
              <tr>
                <th>#</th>
                <th>Teilnehmer/in</th>
                <th>Tel</th>
                <th>Ist dabei</th>
                <th>Anzahl, für wen?</th>
              </tr>
            </thead>
            <?php
            /*
  try {
    $row = $statement->fetch();
  } catch (PDOException $Exception) {
    echo "<p>". $Exception->getMessage() . "</p>";
  }
*/



            $lfd = 1;
            while ($row = $statement->fetch()) {
            ?>
              <tr>
                <td><?= $lfd++ ?></td>
                <td><?= $row['nachname'] . ' ' . $row['vorname'] ?></td>
                <td><?= $row['mobil'] ?></td>
                <td class="text-center"><?= ($row['willing_to_attend'] === NULL ? '---' : ($row['willing_to_attend'] === '1' ? 'J' : 'N')) ?></td>
                <td><?= $row['comment'] ?></td>
                <?php /*
          <td><?=$row['info2']?></td>
          <td><?=$row['info3']?></td>
          <td><?=$row['info4']?></td>
          <td><?=$row['info5']?></td>
          <td><?=$row['info6']?></td>
          <td><?=$row['info7']?></td>
*/ ?>
              </tr>
        <?php
            }
            echo '</table>';
          } else {
            echo 'Beim Lesen der Daten ist leider ein Fehler aufgetreten. Bitte benachrichtige conny.roloff@tcolching.de<br>';
          }
        } //Ende von if($showFormular)
        ?>


        </div>

  </div>

  <?php
  include("inc/footer.inc.php")
  ?>