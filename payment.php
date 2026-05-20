<?php

require "admin/tools/db.php";

session_start();


// save checkout data from checkout page //
if(
    isset($_POST["full_name"]) &&
    !isset($_POST["confirm_payment"])
){

    $_SESSION["checkout_data"] = $_POST;

}


// prevent direct access //
if(
    !isset($_SESSION["checkout_data"])
    &&
    !isset($_POST["confirm_payment"])
){

    header("Location: checkout.php");

    exit();

}


// confirm payment //
if(isset($_POST["confirm_payment"])){

    // get checkout data //
    $checkout = $_POST;

    $total_amount = $_POST["total_amount"];

    $status = "Pending";


    // always use checkout customer data //

    $full_name = $checkout["full_name"];

    $email = $checkout["email"];

    $phone = $checkout["phone"];

    $address = $checkout["address"];

    $city = $checkout["city"];

    $state = $checkout["state"];

    $postal_code = $checkout["postal_code"];

    $country = $checkout["country"];


    // full address //
    $full_address = $address . ", " .
                    $city . ", " .
                    $state . ", " .
                    $postal_code . ", " .
                    $country;


    // check if email exists //
    $check_user = mysqli_query(
        $db,
        "SELECT * FROM users WHERE email='$email'"
    );


    if(mysqli_num_rows($check_user) > 0){

        // existing user //
        $user = mysqli_fetch_assoc($check_user);

        $user_id = $user["user_id"];

    }else{

        // create new user //
        $user_query = "INSERT INTO users
        (full_name, email, phone, address)
        VALUES
        ('$full_name', '$email', '$phone', '$full_address')";


        $user_result = mysqli_query($db, $user_query);

        if(!$user_result){

            die(mysqli_error($db));

        }

        $user_id = mysqli_insert_id($db);

    }


    // create order //
    $query = "INSERT INTO orders
    (user_id, total_amount, status)
    VALUES
    ('$user_id', '$total_amount', '$status')";


    $result = mysqli_query($db, $query);

    if(!$result){

        die(mysqli_error($db));

    }


    // save order id //
    $order_id = mysqli_insert_id($db);


    // update stock //
    if(isset($_POST["cart_data"])){

        $cart = json_decode($_POST["cart_data"], true);

        foreach($cart as $item){

            $product_id = $item["id"];

            $quantity = $item["quantity"];

            mysqli_query(
                $db,
                "UPDATE products
                SET stock = stock - $quantity
                WHERE product_id = $product_id"
            );

        }

    }


    // save invoice session //
    $_SESSION["invoice_order_id"] = $order_id;

    // save past purchase cookie //

    $product_names = [];

    $cart = json_decode($_POST["cart_data"], true);

    foreach($cart as $item){

        $product_names[] =
        $item["name"] . " x" . $item["quantity"];

    }


    $purchase_data =
    implode(", ", $product_names);

        setcookie(
        "past_purchase",
        $purchase_data,
        time() + (86400 * 30),
        "/"
        );

        // redirect //
        header("Location: invoice.php");

        exit();

    }

?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">

    <meta name="viewport"
    content="width=device-width, initial-scale=1.0">

    <title>Payment</title>

    <link rel="stylesheet" href="css/style.css">

    <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">

</head>

<body>

<?php include "includes/header.html" ?>

<div class="container payment-page">

    <h1>Payment</h1>


    <!-- order summary -->
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


    <!-- payment methods -->
    <div class="payment-methods">

        <i class="fa-brands fa-cc-visa"></i>

        <i class="fa-brands fa-cc-mastercard"></i>

        <i class="fa-brands fa-apple-pay"></i>

    </div>


    <!-- payment form -->
    <form
    id="payment_form"
    method="POST"
    action="payment.php">


        <!-- card holder -->
        <input 
        type="text"
        placeholder="Card Holder Name"
        pattern="[A-Za-z\s]{3,}"
        required>


        <!-- card number -->
        <input 
        type="text"
        placeholder="1234 5678 9012 3456"
        maxlength="19"
        pattern="[0-9]{4}\s[0-9]{4}\s[0-9]{4}\s[0-9]{4}"
        required>


        <!-- expiry date -->
        <input 
        type="text"
        placeholder="MM/YY"
        maxlength="5"
        pattern="(0[1-9]|1[0-2])\/[0-9]{2}"
        required>


        <!-- cvv -->
        <input 
        type="text"
        placeholder="CVV"
        maxlength="3"
        pattern="[0-9]{3}"
        required>


        <!-- hidden checkout data -->
        <?php

        if(isset($_SESSION["checkout_data"])){

            foreach($_SESSION["checkout_data"] as $key => $value){

                echo '
                <input
                type="hidden"
                name="'.$key.'"
                value="'.$value.'">
                ';

            }

        }

        ?>


        <p class="secure-payment">

            <i class="fa-solid fa-lock"></i>

            Your payment information is secure and encrypted.

        </p>


        <input
        type="hidden"
        name="total_amount"
        id="hidden_total">


        <input
        type="hidden"
        name="confirm_payment"
        value="1">


        <input
        type="hidden"
        name="cart_data"
        id="cart_data_payment">


        <button type="submit" class="buy-btn">
            Confirm Payment
        </button>

    </form>

</div>

<script src="js/main.js"></script>

</body>
</html>