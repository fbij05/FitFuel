<?php

require "admin/tools/db.php";

session_start();


// check invoice session //
if(!isset($_SESSION["invoice_order_id"])){

    header("Location: index.php");

    exit();

}


$order_id = $_SESSION["invoice_order_id"];


// get order data //
$query = mysqli_query($db,
"SELECT orders.*, users.full_name, users.email, users.phone, users.address
FROM orders
JOIN users ON orders.user_id = users.user_id
WHERE orders.order_id = '$order_id'"
);

$order = mysqli_fetch_assoc($query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Invoice</title>

    <link rel="stylesheet" href="css/style.css">

    <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">

</head>

<body>

<?php include "includes/header.html" ?>



<div class="container invoice-page">

    <div class="invoice-box">

        <h1>
            <i class="fa-solid fa-circle-check"></i>
            Order Confirmed
        </h1>

        <p class="invoice-message">
            Thank you for your purchase!
        </p>


        <!-- order details -->
        <div class="invoice-details">

            <div class="invoice-row">
                <span>Order ID:</span>
                <span>#<?php echo $order["order_id"]; ?></span>
            </div>

            <div class="invoice-row">
                <span>Customer Name:</span>
                <span><?php echo $order["full_name"]; ?></span>
            </div>

            <div class="invoice-row">
                <span>Email:</span>
                <span><?php echo $order["email"]; ?></span>
            </div>

            <div class="invoice-row">
                <span>Phone:</span>
                <span><?php echo $order["phone"]; ?></span>
            </div>

            <div class="invoice-row">
                <span>Address:</span>
                <span><?php echo $order["address"]; ?></span>
            </div>

            <div class="invoice-row total-price">
                <span>Total Amount:</span>
                <span>SAR <?php echo $order["total_amount"]; ?></span>
            </div>

            <div class="invoice-row">
                <span>Status:</span>
                <span><?php echo $order["status"]; ?></span>
            </div>

            <div class="invoice-row">
                <span>Order Date:</span>
                <span><?php echo $order["order_date"]; ?></span>
            </div>

        </div>


        <!-- back button -->
        <div class="invoice-actions">

            <a href="index.php" class="btn_cart">
                Back To Home
            </a>

        </div>

    </div>

</div>

</body>
</html>