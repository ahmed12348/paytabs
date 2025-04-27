<?php
// Include the database connection file
include_once('../db/db.php');

// Check if form is submitted and required POST data is available
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['products']) && isset($_POST['total_amount'])) {
    $selected_products = $_POST['products']; // Selected product IDs (should be an array)
    $total_amount = $_POST['total_amount']; // Total amount passed from checkout

    // Ensure $selected_products is an array, and if not, convert it
    if (is_string($selected_products)) {
        $selected_products = explode(',', $selected_products); // Convert string to array
    }

    // Optionally, you can validate the products by querying the database to ensure they exist
    $product_ids = implode(",", $selected_products); // Convert array to comma-separated string
    $query = "SELECT * FROM products WHERE id IN ($product_ids)";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        // Fetch product details (for reference or logging)
        while ($row = $result->fetch_assoc()) {
            // Process each product (this could be used to display order details or calculate total)
            echo "Product: " . $row['name'] . " - $" . $row['price'] . "<br>";
        }
    }

    // Example of PayTabs data for payment
    $paytabs_profile_id = "132344";
    $paytabs_integration_key = "SWJ992BZTN-JHGTJBWDLM-BZJKMR2ZHT";
    $paytabs_instance = "Egypt";

    $data = array(
        "profile_id" => $paytabs_profile_id,
        "integration_key" => $paytabs_integration_key,
        "amount" => $total_amount, // Total price of selected products
        "currency" => "USD",
        "email" => "customer@example.com", // User's email (replace with dynamic data)
        "callback" => "http://localhost/paytabst/pages/payment_callback.php", // Callback URL
        "return" => "http://localhost/paytabs/pages/payment_result.php" // Return URL
    );

    // Make the request to PayTabs (you can do this using cURL)
    $url = "https://secure.paytabs.com/payment/request";
    $ch = curl_init($url);
    
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

    $response = curl_exec($ch);
    curl_close($ch);

    // Parse the response (you can customize this as needed)
    $response_data = json_decode($response, true);
    
    if (isset($response_data['payment_url'])) {
        $payment_url = $response_data['payment_url'];
        
        // Dynamically load the PayTabs iframe
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
