<?php
require "admin/tools/db.php";

$id = $_GET['id'];
$query = mysqli_query($db, "SELECT * FROM products WHERE product_id = $id");
$product = mysqli_fetch_assoc($query);

?>

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
<body>

<?php include "includes/header.html"?>


<!-- cart -->
<?php require "includes/cart.php"?>


<main>

    <div class="product-detail-container container">

        <div class="product-detail">

            <div class="product-image">

                <img src="img/<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>">

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
<?php include "includes/footer.html" ?>

<script src="js/main.js"></script>

</body>
</html>