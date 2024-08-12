<?php
session_start();
require_once("../inc/config.inc.php");
require_once("../inc/functions.inc.php");
require_once("../inc/permissioncheck.inc.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    $totalSchwarz = $data['total_schwarz'];
    $totalWeiss = $data['total_weiss'];
    $orderDetails = $data['order_details'];
    $userId = $_SESSION['userid'];

    try {
        // Start transaction
        $pdo->beginTransaction();

        // Check if the user already has an existing order
        $stmt = $pdo->prepare("SELECT id FROM orders WHERE user_id = ?");
        $stmt->execute([$userId]);
        $existingOrder = $stmt->fetch();

        if ($existingOrder) {
            // If an order exists, update it and delete existing order details
            $orderId = $existingOrder['id'];
            $stmt = $pdo->prepare("UPDATE orders SET total_schwarz = ?, total_weiss = ? WHERE id = ?");
            $stmt->execute([$totalSchwarz, $totalWeiss, $orderId]);

            // Delete existing order details
            $stmt = $pdo->prepare("DELETE FROM order_details WHERE order_id = ?");
            $stmt->execute([$orderId]);
        } else {
            // If no order exists, create a new order
            $stmt = $pdo->prepare("INSERT INTO orders (user_id, total_schwarz, total_weiss) VALUES (?, ?, ?)");
            $stmt->execute([$userId, $totalSchwarz, $totalWeiss]);

            // Get the last inserted order ID
            $orderId = $pdo->lastInsertId();
        }

        // Insert each order detail
        $stmt = $pdo->prepare("INSERT INTO order_details (order_id, article_name, variant_name, size, quantity, price, total, color) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

        foreach ($orderDetails as $detail) {
            $stmt->execute([
                $orderId,
                $detail['article_name'],
                $detail['variant_name'],
                $detail['size'],
                $detail['quantity'],
                $detail['price'],
                $detail['total'],
                $detail['color']
            ]);
        }

        // Commit transaction
        $pdo->commit();

        echo json_encode(['status' => 'success']);
    } catch (Exception $e) {
        $pdo->rollBack();
        echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
    }
}
?>
