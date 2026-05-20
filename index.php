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

    <!-- past purchase cookie -->
    <?php

    if(isset($_COOKIE["past_purchase"])){

        echo '
        <div class="past-purchase">
            Last Purchase:
            ' . $_COOKIE["past_purchase"] . '
        </div>
        ';

    }

    ?>
    
    <h1 style="text-align: center; margin-top: 1em;">Try this out!</h1>

    <main id="product-list" style="justify-content: center">
        <?php
        $result = $db->query("
        SELECT * FROM products
        ORDER BY RAND()
        LIMIT 3
    ");
        if ($result && $result->num_rows > 0):
            while ($row = $result->fetch_assoc()):


                include "includes/item.php";


            endwhile;
        else:
            echo '<p>No products found.</p>';
        endif;
        ?>
    </main>

    <script src="js/main.js"></script>

</body>
</html>