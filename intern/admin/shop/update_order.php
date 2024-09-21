<?php
require_once(dirname(__FILE__) . "/../../inc/config.inc.php");

$data = json_decode(file_get_contents('php://input'), true);

$order_id = $data['order_id'];
$status = $data['status'] ?? null;  // Füge den Status hinzu
$delivery = $data['delivery'] ?? null;
$paid = isset($data['paid']) ? (int)$data['paid'] : null;

if ($status !== null) {
    $stmt = $pdo->prepare("UPDATE orders SET status = ? WHERE id = ?");
    $stmt->execute([$status, $order_id]);
}

if ($delivery !== null) {
    $stmt = $pdo->prepare("UPDATE orders SET delivery = ? WHERE id = ?");
    $stmt->execute([$delivery, $order_id]);
}

if ($paid !== null) {
    $stmt = $pdo->prepare("UPDATE orders SET paid = ? WHERE id = ?");
    $stmt->execute([$paid, $order_id]);
}

echo json_encode(['status' => 'success']);
