<?php
require "admin/tools/db.php";

$query = mysqli_query($db, "SELECT * FROM products");
?>

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

<body>

    <?php include "includes/header.html" ?>
    <?php require "includes/cart.php" ?>

    <main id="product-list">

        <?php while($row = mysqli_fetch_assoc($query)) { ?>

            <div class="product-item">

                <a href='product.php?id=<?php echo $row["product_id"]; ?>' class="product_link">

                    <div class="images">
                        <img src="img/<?php echo $row['image']; ?>" alt="<?php echo $row['name']; ?>">
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

                </a>

                <button 
                    class="add_cart"
                    data-name="<?php echo $row['name']; ?>"
                    data-price="<?php echo $row['price']; ?>"
                    data-image="<?php echo $row['image']; ?>"
                >
                    Add to Cart
                </button>

            </div>

        <?php } ?>

    </main>

    <script src="js/main.js"></script>

</body>
</html>