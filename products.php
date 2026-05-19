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
require "admin/tools/db.php";

$query = mysqli_query($db, "SELECT * FROM products");
?>

<body>

    <?php include "includes/header.php" ?>

    <h1 style="text-align: center; margin-top: 1em;">Check out what we have!</h1>
    <main id="product-list">

        <?php while($row = mysqli_fetch_assoc($query)) { ?>

            <?php include "includes/item.php" ?>

        <?php } ?>

    </main>
    <?php include "includes/footer.html" ?>
</body>
</html>