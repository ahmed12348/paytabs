<?php

include_once('../db/db.php');


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['products']) && isset($_POST['total_amount'])) {
    $selected_products = $_POST['products']; 
    $total_amount = $_POST['total_amount']; 


    if (is_string($selected_products)) {
        $selected_products = explode(',', $selected_products); 
    }


    $product_ids = implode(",", $selected_products); 
    $query = "SELECT * FROM products WHERE id IN ($product_ids)";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        // Fetch product details (for reference or logging)
        while ($row = $result->fetch_assoc()) {

            echo "Product: " . $row['name'] . " - $" . $row['price'] . "<br>";
        }
    }

    
    $paytabs_profile_id = "132344";
    $paytabs_integration_key = "SWJ992BZTN-JHGTJBWDLM-BZJKMR2ZHT";
    $paytabs_instance = "Egypt";

    $data = array(
        "profile_id" => $paytabs_profile_id,
        "integration_key" => $paytabs_integration_key,
        "amount" => $total_amount, 
        "currency" => "USD",
        "email" => "customer@example.com", 
        "callback" => "http://localhost/paytabst/pages/payment_callback.php", 
        "return" => "http://localhost/paytabs/pages/payment_result.php" 
    );


    $url = "https://secure.paytabs.com/payment/request";
    $ch = curl_init($url);
    
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

    $response = curl_exec($ch);
    curl_close($ch);

  
    $response_data = json_decode($response, true);
    
    if (isset($response_data['payment_url'])) {
        $payment_url = $response_data['payment_url'];
        

        echo '<h1>Redirecting to Payment...</h1>';
        echo '<iframe src="' . $payment_url . '" width="100%" height="600" frameborder="0"></iframe>';
    } else {
        echo '{"success": false, "message": "Error: Could not generate payment URL."}';
    }

} else {
    echo '{"success": false, "message": "Missing data. Unable to process the payment."}';
    exit;
}
?>
