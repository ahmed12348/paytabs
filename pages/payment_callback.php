<?php
include_once('../db/db.php');

$payload = file_get_contents('php://input');
$data = json_decode($payload, true);

if (isset($data['cart_id']) && isset($data['payment_result']['response_status'])) {
    $cart_id = $data['cart_id'];
    $order_id = str_replace("ORDER_", "", $cart_id);

    $payment_status = $data['payment_result']['response_status'];

    $status = ($payment_status == "A") ? 'paid' : 'failed';
    
    $update_sql = "UPDATE payments SET status = ? WHERE order_id = ?";
    $stmt = $conn->prepare($update_sql);
    $stmt->bind_param("si", $status, $order_id);
    $stmt->execute();
    $stmt->close();
}

http_response_code(200);
?>
