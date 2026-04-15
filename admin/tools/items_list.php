<?php
$query = "SELECT products.*, categories.category_name 
          FROM products 
          JOIN categories ON products.category_id = categories.category_id
          ORDER BY categories.category_name, products.name";

$result = mysqli_query($db, $query);
?>

<h1>Products</h1>

<div id="products-table">
    <table>
        <thead>
        <tr>
            <th>#</th>
            <th>Image</th>
            <th>Name</th>
            <th>Category</th>
            <th>Description</th>
            <th>Price</th>
            <th>Stock</th>
            <th>Rating</th>
        </tr>
        </thead>
        <tbody>
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td><?= $row["product_id"] ?></td>
                <td><img src="images/<?= htmlspecialchars($row["image"]) ?>" width="60"></td>
                <td><?= htmlspecialchars($row["name"]) ?></td>
                <td><?= htmlspecialchars($row["category_name"]) ?></td>
                <td><?= htmlspecialchars($row["description"]) ?></td>
                <td><?= number_format($row["price"], 2) ?> SAR</td>
                <td><?= $row["stock"] ?></td>
                <td><?= $row["rating"] ?> / 5.0</td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
</div>