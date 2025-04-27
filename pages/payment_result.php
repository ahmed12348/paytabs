<?php
$status = $_GET['respStatus'] ?? 'failed';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Payment Result</title>
</head>
<body>

<?php if ($status == 'A'): ?>
    <h1> Payment Successful!</h1>
    <p>Thank you for your order. Your payment has been processed successfully.</p>
<?php else: ?>
    <h1> Payment Failed!</h1>
    <p>Sorry, your payment could not be completed.</p>
<?php endif; ?>

</body>
</html>
