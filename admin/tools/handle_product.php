<?php
require "db.php";
session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: ../login.php");
    exit();
}

$action = $_POST['action'] ?? '';

switch ($action) {

    // add action
    case 'add':
        $name        = $_POST['name'] ?? '';
        $category_id = $_POST['category_id'] ?? 0;
        $description = $_POST['description'] ?? '';
        $price       = $_POST['price'] ?? 0;
        $stock       = $_POST['stock'] ?? 0;

        // emptiness check
        if ($name === '' || $category_id == 0 || !isset($_FILES['image']) || $_FILES['image']['error'] !== 0) {
            header("Location: ../account.php?show=items&error=Please fill in all required fields and upload an image.");
            exit();
        }

        // move image to our directory "/img" (relative so things don't break)
        $image = basename($_FILES['image']['name']);
        $target = "../../img/" . $image;
        move_uploaded_file($_FILES['image']['tmp_name'], $target);

        $query = "INSERT INTO products (name, description, price, stock, image, category_id)
                  VALUES ('$name', '$description', $price, $stock, '$image', $category_id)";

        if (mysqli_query($db, $query)) {
            header("Location: ../account.php?show=items&success=Product added successfully.");
        } else {
            header("Location: ../account.php?show=items&error=Failed to add product.");
        }
        break;

    // edit action
    case 'edit':
        $product_id  = $_POST['product_id'] ?? 0;
        $name        = $_POST['name'] ?? '';
        $category_id = $_POST['category_id'] ?? 0;
        $description = $_POST['description'] ?? '';
        $price       = $_POST['price'] ?? 0;
        $stock       = $_POST['stock'] ?? 0;

        // use new image if uploaded, otherwise keep the old one
        if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
            $image = basename($_FILES['image']['name']);
            $target = "../../img/" . $image;
            move_uploaded_file($_FILES['image']['tmp_name'], $target);
        } else {
            $image = $_POST['old_image'] ?? '';
        }

        if ($product_id == 0 || $name === '' || $category_id == 0 || $image === '') {
            header("Location: ../account.php?show=items&error=Please fill in all required fields.");
            exit();
        }

        $query = "UPDATE products 
                  SET name = '$name', description = '$description', price = $price, 
                      stock = $stock, image = '$image', category_id = $category_id
                  WHERE product_id = $product_id";

        if (mysqli_query($db, $query)) {
            header("Location: ../account.php?show=items&success=Product updated successfully.");
        } else {
            header("Location: ../account.php?show=items&error=Failed to update product.");
        }
        break;

    // delete action=
    case 'delete':
        $product_id = $_POST['product_id'] ?? 0;

        if ($product_id == 0) {
            header("Location: ../account.php?show=items&error=Invalid product.");
            exit();
        }

        // check if product is in any order before deleting
        $check = mysqli_query($db, "SELECT COUNT(*) as cnt FROM order_items WHERE product_id = $product_id");
        $row = mysqli_fetch_assoc($check);

        if ($row['cnt'] > 0) {
            header("Location: ../account.php?show=items&error=Cannot delete product — it is referenced in existing orders.");
            exit();
        }

        if (mysqli_query($db, "DELETE FROM products WHERE product_id = $product_id")) {
            header("Location: ../account.php?show=items&success=Product deleted successfully.");
        } else {
            header("Location: ../account.php?show=items&error=Failed to delete product.");
        }
        break;

    default:
        header("Location: ../account.php?show=items");
        break;
}
exit();
