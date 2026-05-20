<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>FitFuel - About Us</title>


    <!-- css f -->
    <link rel="stylesheet" href="css/style.css">

    <!-- font aws -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">


</head>
<body>

<?php include "includes/header.html" ?>

<div class="cart">
    <div class="top_cart">
        <h3>My Cart <span>(oItem in Cart)</span></h3>
        <span onclick="close_cart()" class="close_cart"><i class="fa-solid fa-x"></i></span>
    </div>

    <div class="items_in_cart">
        <div class="cart_item">
            <img src="img/whey protein powder.jpg" alt="">
            <div class="content">
                <h4>Whey Protein Powder</h4>
                <p class="cart_price">SAR 250</p>
            </div>
            <BUtton class="delet_item"><i class="fa-solid fa-trash-can"></i></BUtton>
        </div>

        <div class="cart_item">
            <img src="img/Proteína.jpg" alt="">
            <div class="content">
                <h4>ISO100 Hydrolyzed</h4>
                <p class="cart_price">SAR 260</p>
            </div>
            <BUtton class="delet_item"><i class="fa-solid fa-trash-can"></i></BUtton>
        </div>
    </div>

    <div class="bottom_cart">
        <div class="total">
            <p>Cart subtotal</p>
            <p class="price_cart_total">$0</p>
        </div>

        <div class="cart_button">
            <a href="#" class="btn_cart">Proceed to checkout</a>
            <button class="btn_cart tranc_bg">Shop more</button>
        </div>
    </div>
</div>

<main id="product-list">
    <section class="about">
        <h2>About Us</h2>
        <span style="font-size: 1.4em;">
        <p>At <strong>FitFuel</strong>, we're dedicated to helping you reach your fitness goals with quality supplements and equipment. Whether you're just starting out or a seasoned athlete, we've got what you need to perform at your best.</p>
            <br>
        <p>Founded by fitness enthusiasts, we know what it takes to stay consistent, and we know how hard it is to find products you can actually trust. That's why everything we carry is carefully selected for quality, value, and results.</p>
            <br>
        <p>We're not just a store. We're your training partner.</p>
        </span>
    </section>
</main>

</body>
</html>