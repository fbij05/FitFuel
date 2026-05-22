
<?php

require "admin/tools/db.php";

session_start();


// prevent guest checkout //
if(!isset($_SESSION["user_id"])){

    header("Location: register.php");

    exit();

}


$user = null;


// get logged in user data //
$user_id = $_SESSION["user_id"];

$query = mysqli_query(
    $db,
    "SELECT * FROM users
    WHERE user_id='$user_id'"
);

$user = mysqli_fetch_assoc($query);

?>

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

<?php include "includes/header.php" ?>

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

                <input type="text" name="full_name" placeholder="Full Name"
                 value="<?php echo $user['full_name'] ?? ''; ?>" required>

                <input type="email" name="email" placeholder="Email"
                 value="<?php echo $user['email'] ?? ''; ?>" required>

                <input type="text" name="phone" placeholder="Phone Number"
                 value="<?php echo $user['phone'] ?? ''; ?>" required>

                <input type="text" name="address" placeholder="Street Address" 
                 value="<?php echo $user['address'] ?? ''; ?>" required>

                <input type="text" name="city" placeholder="City" 
                 value="<?php echo $user['city'] ?? ''; ?>" required>

                <input type="text" name="state" placeholder="State/Province"
                 value="<?php echo $user['state'] ?? ''; ?>" required>

                <input type="text" name="postal_code" placeholder="Postal Code" 
                 value="<?php echo $user['postal_code'] ?? ''; ?>" required>

                <input type="text" name="country" placeholder="Country"
                  value="<?php echo $user['country'] ?? ''; ?>" required>

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