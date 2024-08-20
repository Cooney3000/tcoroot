<?php

$savedOrderDetails = [];
$orderStatus = 'pending';

$stmt = $pdo->prepare("SELECT orders.status, order_details.* FROM orders 
                       LEFT JOIN order_details ON orders.id = order_details.order_id 
                       WHERE orders.user_id = ?");
$stmt->execute([$user['id']]);
$savedOrderRows = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($savedOrderRows as $row) {
    if ($row) {
        $orderStatus = $row['status'];

        $articleName = $row['article_name'];
        $variantName = $row['variant_name'];
        $size = $row['size'];
        $quantity = $row['quantity'];
        $color = $row['color'];
        $comment = $row['comment'];
        $canBeLabeled = $row['can_be_labeled'];

        $savedOrderDetails[$color][$articleName][$variantName][$size] = [
            'quantity' => $quantity,
            'comment' => $comment,
            'can_be_labeled' => $canBeLabeled,
        ];
    }
}

TLOG(DEBUG, "Loaded saved order details: " . json_encode($savedOrderDetails), __LINE__);
