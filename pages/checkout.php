<?php
// Include the database connection file
include_once('../db/db.php');


if (isset($_POST['products']) && !empty($_POST['products'])) {
    $selected_products = $_POST['products'];
    

    $total_amount = 0;
    $product_ids = implode(",", $selected_products); // Create a comma-separated string of product IDs
    $query = "SELECT * FROM products WHERE id IN ($product_ids)";
    $result = $conn->query($query);
    
    while ($row = $result->fetch_assoc()) {
        // Calculate total amount
        $total_amount += $row['price'];
    }
} else {
  
    echo '{"success": false, "message": "No products selected."}';
    exit;
}
?>

<form action="pay.php" method="post">
    <input type="hidden" name="total_amount" value="<?php echo $total_amount; ?>">
    <input type="hidden" name="products" value="<?php echo implode(',', $selected_products); ?>">

    <label for="address">Shipping Address:</label><br>
    <input type="text" name="address" required><br>
    <input type="submit" value="Proceed to Payment">
</form>
