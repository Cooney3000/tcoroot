<?php
session_start();
require_once("../../inc/config.inc.php");
require_once("../../inc/functions.inc.php");
require_once("../../inc/permissioncheck.inc.php");

//Überprüfe, dass der User eingeloggt und berechtigt ist
//Der Aufruf von check_user_silent() muss in alle API-Skripten eingebaut sein
$user = check_user_silent();
if ( ! $user ) {
  echo ('{"records": [{"returncode":"user not logged in"}] }');
  exit;
}

$order_id = $_GET['order_id'];

$stmt = $pdo->prepare("
    SELECT article_name, variant_name, size, quantity, price, total, color, comment, can_be_labeled
    FROM order_details
    WHERE order_id = ?
");
$stmt->execute([$order_id]);
$orderDetails = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($orderDetails) {
    echo '<table border="1" cellpadding="5" cellspacing="0">';
    echo '<tr><th>Artikelname</th><th>Variante</th><th>Größe</th><th>Menge</th><th>Preis</th><th>Farbe</th><th>Beschriftung</th><th>Gesamt</th></tr>';
    foreach ($orderDetails as $detail) {
        echo '<tr>';
        echo '<td>' . htmlspecialchars($detail['article_name']) . '</td>';
        echo '<td>' . htmlspecialchars($detail['variant_name']) . '</td>';
        echo '<td>' . htmlspecialchars($detail['size']) . '</td>';
        echo '<td>' . $detail['quantity'] . '</td>';
        echo '<td>' . number_format($detail['price'], 2, ',', '.') . ' €</td>';
        echo '<td>' . htmlspecialchars($detail['color']) . '</td>';
        echo '<td>' . ($detail['can_be_labeled'] ? htmlspecialchars($detail['comment']) : 'N/A') . '</td>';
        echo '<td>' . number_format($detail['total'], 2, ',', '.') . ' €</td>';
        echo '</tr>';
    }
    echo '</table>';
} else {
    echo '<p>Keine Bestelldetails gefunden.</p>';
}
?>
