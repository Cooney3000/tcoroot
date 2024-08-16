<?php
session_start();
require_once("../inc/config.inc.php");
require_once("../inc/functions.inc.php");
require_once("../inc/permissioncheck.inc.php");

// Ensure user is authenticated
$user = check_user();

if ( ! checkPermissions(VORSTAND) ) {
    exit;
}
// Set headers to force download of the file as CSV
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=shop_orders.csv');

// Open the output stream
$output = fopen('php://output', 'w');

// Write the header row
fputcsv($output, ['Vorname', 'Nachname', 'Artikel', 'Variante', 'Größe', 'Menge', 'Preis in €', 'Gesamt in €', 'Farbe', 'Kommentar']);

// Fetch all orders and their details
$sql = "
    SELECT users.vorname, users.nachname, order_details.article_name, order_details.variant_name, order_details.size,
           order_details.quantity, order_details.price, order_details.total, order_details.color, order_details.comment
    FROM orders
    INNER JOIN order_details ON orders.id = order_details.order_id
    INNER JOIN users ON orders.user_id = users.id
    WHERE orders.status = 'finished' 
";

TLOG(DEBUG, $sql, __LINE__);

$stmt = $pdo->prepare($sql);
$stmt->execute();
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Write each row to the CSV
foreach ($rows as $row) {
    fputcsv($output, [
        $row['vorname'],
        $row['nachname'],
        $row['article_name'],
        $row['variant_name'],
        $row['size'],
        $row['quantity'],
        number_format($row['price'], 2, ',', '.'),
        number_format($row['total'], 2, ',', '.'),
        $row['color'],
        $row['comment']
    ]);
}

// Close the output stream
fclose($output);
exit;
?>
