<?php
$search = $_GET['search'] ?? '';

$query = "SELECT products.*, categories.category_name 
          FROM products 
          JOIN categories ON products.category_id = categories.category_id";

if (!empty($search)) {
    $query .= " WHERE products.name LIKE '%$search%' OR products.description LIKE '%$search%'";
}

$query .= " ORDER BY products.product_id ASC";

$result = mysqli_query($db, $query);
?>

<div id="items-header">
    <div id="contents-text">
        <h1>Products</h1>
        <?php

        if (!empty($search)) {
            echo "<i>".mysqli_num_rows($result)." result";
            if(mysqli_num_rows($result) > 1) {echo "s";}
            echo " found.</i>";
        }

        ?>
    </div>
    <div id="items-actions">
        <div id="items-search">
            <form method="get" action="account.php">
                <input type="hidden" name="show" value="items">
                <input type="search" name="search" placeholder="Search..." value="<?= htmlspecialchars(isset($_GET['search']) ? $_GET['search'] : '') ?>">
            </form>
        </div>
        <div id="items-management">
            <button id="add">Add</button>
            <button id="modify">Modify</button>
            <button id="remove">Remove</button>
        </div>
    </div>
</div>
<div>
    <table id="products-table">
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
        <?php if (mysqli_num_rows($result) == 0): ?>
            <tr><td colspan="9">No products found.</td></tr>
        <?php else: ?>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td><?= $row["product_id"] ?></td>
                    <td><img src="../../img/<?= htmlspecialchars($row["image"]) ?>" width="60"></td>
                    <td><?= htmlspecialchars($row["name"]) ?></td>
                    <td><?= htmlspecialchars($row["category_name"]) ?></td>
                        <td><?= htmlspecialchars($row["description"]) ?></td>
                    <td><?= number_format($row["price"], 2) ?> SAR</td>
                    <td><?= $row["stock"] ?></td>
                    <td><?= $row["rating"] ?> / 5.0</td>
                </tr>
            <?php endwhile; ?>
        <?php endif; ?>
        </tbody>
    </table>
</div>

