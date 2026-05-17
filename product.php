<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Detail</title>

    <!-- CSS -->
    <link rel="stylesheet" href="css/style.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
</head>

<?php

include "admin/tools/db.php";

$id = $_GET['id'];

$query = mysqli_query($db, "SELECT * FROM products WHERE product_id = $id");

$product = mysqli_fetch_assoc($query);

?>

<body>

<header>

    <div class="container top-nav">

        <a href="index.php" class="logo">
            <img src="img/logo.png" alt="Logo">
        </a>

        <form action="" class="search">
            <input type="search" placeholder="Search for products...">
            <button type="submit">Search</button>
        </form>

        <div class="cart_header">

            <div onclick="open_cart()" class="icon_cart">
                <i class="fa-solid fa-cart-shopping"></i>

                <span class="count_item">0</span>
            </div>

        </div>

    </div>

</header>


<!-- cart -->
<?php require "includes/cart.php"?>


<main>

    <div class="product-detail-container container">

        <div class="product-detail">

            <div class="product-image">

                <img src="img/<?php echo $product['image']; ?>" alt="">

            </div>

            <div class="product-info">

                <h1 class="product-name">
                    <?php echo $product['name']; ?>
                </h1>

                <p class="product-description">
                    <?php echo $product['description']; ?>
                </p>

                <p class="product-price">
                    SAR <?php echo $product['price']; ?>
                </p>

                <p class="product-rating">
                    Rating: <?php echo $product['rating']; ?>
                </p>

                <!-- add to cart -->
                <button 
                    class="btn-add-to-cart add_cart"
                    data-name="<?php echo $product['name']; ?>"
                    data-price="<?php echo $product['price']; ?>"
                    data-image="<?php echo $product['image']; ?>"
                >
                    Add to Cart
                </button>

                <!-- checkout -->
                <div class="checkout-button-container">

                    <a href="checkout.php" class="btn_cart">
                        Proceed to Checkout
                    </a>

                </div>

            </div>

        </div>

    </div>

</main>

<script src="js/main.js"></script>

</body>
</html>