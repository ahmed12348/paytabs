<?php
// Include the database connection file
include_once('../db/db.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Page</title>
</head>
<body>
    <h1>Choose Products</h1>

    <form action="checkout.php" method="post">
        <?php
        // Fetch products from the database
        $query = "SELECT * FROM products";
        $result = $conn->query($query);

        // Check if there are products in the database
        if ($result->num_rows > 0) {
            // Loop through each product and display them
            while ($row = $result->fetch_assoc()) {
                echo '<input type="checkbox" name="products[]" value="' . $row['id'] . '"> ' . $row['name'] . ' - $' . $row['price'] . '<br>';
            }
        } else {
            echo "No products available.";
        }
        ?>

        <br>
        <input type="submit" value="Proceed to Checkout">
    </form>
</body>
</html>
