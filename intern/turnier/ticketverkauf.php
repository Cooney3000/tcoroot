<?php 
session_start();
require_once("../inc/config.inc.php");
require_once("../inc/functions.inc.php");
require_once("../inc/permissioncheck.inc.php");

//Überprüfe, dass der User eingeloggt und berechtigt ist
$user = check_user();

$title = "Ticketverkauf";
include("../templates/header.inc.php");
if (checkPermissions(PERMISSIONS::T_ALL_PERMISSIONS) ) 
{
?>

  <script>
      document.getElementById("nav-intern").classList.remove("active");
      document.getElementById("nav-einstellungen").classList.remove("active");
      document.getElementById("nav-turnier").classList.add("active");
      document.getElementById("nav-login").classList.remove("active");
      document.getElementById("nav-logout").classList.remove("active");
  </script>

  <div class="container main-container registration-form">

<?php 
    require_once("turnierheader.inc.php");
?> 

<div class="container main-container">
  <h1>Ticketverkauf</h1>

  
  <?php
$delimiter = '---';
// SELECT OPTIONs-Array laden
$eventVorschlaege = array();
$sql = 'SELECT * FROM event_vorschlaege WHERE event="Players & Friends 2019" ORDER BY prio';
foreach ($pdo->query($sql) as $row) {
  array_push($eventVorschlaege, ['user_id'=>$row['user_id'], 'teilnehmername'=>$row['teilnehmername'], 'prio'=>$row['prio']] );
}
// foreach ($eventVorschlaege as $e) {
  //   print $e['user_id'];
  //   print " - ";
  //   print $e['teilnehmername'];
  //   print " - ";
  //   print $e['prio'];
  //   print "<br>\r\n";
  // }
  
  
  // Ticketliste erzeugen
  ?>
  <table class="tbl-auto">
    <tr>
      <th>#</th>
      <th>Käufer</th>
      <th>Verkäufer</th>
      <th>Betrag</th>
      <th>Kommentar</th>
    </tr> 
  <?php
  $sql = 'SELECT * FROM event_tickets ORDER BY kaeufer, ticketnummer';
  foreach ($pdo->query($sql) as $row) {
    
    ?>
      <tr>
        <td><?= $row['ticketnummer'] ?></td> 
        <td><input class="rounded border-success" onchange="hasChanged(this)" id="<?= $row['id'] . $delimiter . 'kaeufer' . $delimiter . $row['kaeufer_id'] ?>" type="text" value="<?= $row['kaeufer'] ?>"/></td>
        <td><input class="rounded border-success" onchange="hasChanged(this)" id="<?= $row['id'] . $delimiter . 'verkaeufer' ?>" type="text" value="<?= $row['verkaeufer'] ?>"/></td>
        <td><input class="rounded border-success" onchange="hasChanged(this)" id="<?= $row['id'] . $delimiter . 'betrag' ?>" type="text" value="<?= $row['betrag'] ?>"/></td>
        <td><input class="rounded border-success" onchange="hasChanged(this)" id="<?= $row['id'] . $delimiter . 'kommentar' ?>" type="text" value="<?= $row['kommentar'] ?>"/></td>
      </tr>
<?php
  }
?>
    </table>
<?php
} // check_permissions
include("../templates/footer.inc.php");
?>

<script>
function hasChanged(e) {
  const p = e.id.split('<?= $delimiter ?>');
  const id = "i=" + p[0];
  const col = "&col=" + p[1];
  const v = "&v=" + e.value;
  const kaeuferId = col === "&col=kaeufer" ? "&ki=" + p[2] : "";
  const url = "/intern/api/ticket.php?" + id + col + v + kaeuferId;
  console.log(url);
  fetch(url, {credentials: 'same-origin'})
    .then(result => {
      if (result.ok) {
        // console.log(result);
        return true;
      } else {
        throw new Error('Fehler beim Erzeugen/Updaten der Tickets' + this.state.r.id);
      }
    });
}
</script>
