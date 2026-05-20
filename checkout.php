<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>

    <link rel="stylesheet" href="css/style.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
</head>

<body>

<?php include "includes/header.html" ?>

<main>

    <div class="container checkout-container">

        <h2>Checkout</h2>

        <!-- cart items -->
        <div class="cart-items" id="checkout_items">

        </div>


        <!-- summary -->
        <div class="checkout-summary">

            <div class="subtotal">
                <p>Subtotal:</p>
                <p id="subtotal_price">SAR 0</p>
            </div>

            <div class="shipping">
                <p>Shipping:</p>
                <p>SAR 20</p>
            </div>

            <div class="total">
                <p>Total:</p>
                <p id="total_price">SAR 20</p>
            </div>

        </div>


        <!-- shipping form -->
        <div class="shipping-address">

            <h3>Shipping Address</h3>

            <form action="payment.php" method="POST">

                <input type="text" name="full_name" placeholder="Full Name" required>

                <input type="email" name="email" placeholder="Email" required>

                <input type="text" name="phone" placeholder="Phone Number" required>

                <input type="text" name="address" placeholder="Street Address" required>

                <input type="text" name="city" placeholder="City" required>

                <input type="text" name="state" placeholder="State/Province" required>

                <input type="text" name="postal_code" placeholder="Postal Code" required>

                <input type="text" name="country" placeholder="Country" required>

                <!-- buttons -->
                <div class="actions">

                    <button type="button"  class="delete-all-btn" id="delete_all">
                       Delete All
                    </button>

                    <input type="hidden" name="total_amount" id="checkout_total_hidden">

                    <input type="hidden"
                        name="cart_data"
                        id="cart_data_input">

                    <button type="submit" class="buy-btn">
                        Buy Now
                    </button>

                </div>

            </form>

        </div>


        

    </div>

</main>


<script src="js/main.js"></script>

</body>
</html>