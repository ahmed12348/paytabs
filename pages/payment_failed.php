<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Failed</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background-color: #fff;
            padding: 40px;
            text-align: center;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 600px;
        }
        h1 {
            font-size: 2.5rem;
            color: #dc3545;
        }
        p {
            font-size: 1.1rem;
            color: #555;
            margin: 20px 0;
        }
        .btn {
            padding: 10px 20px;
            background-color: #dc3545;
            color: #fff;
            font-size: 1.2rem;
            text-decoration: none;
            border-radius: 4px;
            display: inline-block;
            margin-top: 20px;
        }
        .btn:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>

<div class="container">
    <h1> Payment Failed!</h1>
    <p>Sorry, your payment could not be completed. Please try again later.</p>
    <p>If the issue persists, please contact our support team.</p>
    <a href="/" class="btn">Go to Homepage</a>
</div>

</body>
</html>
