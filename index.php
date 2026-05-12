<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FitFuel</title>

    <!-- css -->
    <link rel="stylesheet" href="css/style.css">

    <!-- font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
</head>

<?php
include "admin/tools/db.php";

$query = mysqli_query($db, "SELECT * FROM products");
?>

<body>

    <?php include "includes/header.html" ?>

    <div class="cart">
        <div class="top_cart">
            <h3>My Cart <span>(0 Item in Cart)</span></h3>
            <span onclick="close_cart()" class="close_cart">
                <i class="fa-solid fa-x"></i>
            </span>
        </div>

        <div class="items_in_cart">

            <div class="cart_item">
                <img src="img/whey.jpg" alt="">

                <div class="content">
                    <h4>Whey Protein Powder</h4>
                    <p class="cart_price">SAR 250</p>
                </div>

                <button class="delet_item">
                    <i class="fa-solid fa-trash-can"></i>
                </button>
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

        <?php while($row = mysqli_fetch_assoc($query)) { ?>

            <div class="product-item">

                <div class="images">
                    <img src="<?php echo $row['image']; ?>" alt="">
                </div>

                <div class="metadata">

                    <span class="name">
                        <?php echo $row['name']; ?>
                    </span>

                    <span class="price">
                        SAR <?php echo $row['price']; ?>
                    </span>

                    <span class="rating">
                        <?php echo $row['rating']; ?>
                    </span>

                </div>

            </div>

        <?php } ?>

    </main>

    <script src="js/main.js"></script>

</body>
</html>