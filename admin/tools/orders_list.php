<?php
$query = "SELECT orders.*, users.full_name
          FROM orders
          JOIN users ON orders.user_id = users.user_id
          ORDER BY orders.order_date DESC";

$result = mysqli_query($db, $query);
?>

<h1>Orders</h1>

<div id="orders-table">
    <table>
        <thead>
        <tr>
            <th>#</th>
            <th>Customer</th>
            <th>Date</th>
            <th>Total</th>
            <th>Status</th>
        </tr>
        </thead>
        <tbody>
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td><?= $row["order_id"] ?></td>
                <td><?= htmlspecialchars($row["full_name"]) ?></td>
                <td><?= $row["order_date"] ?></td>
                <td><?= number_format($row["total_amount"], 2) ?> SAR</td>
                <td><?= htmlspecialchars($row["status"]) ?></td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
</div>