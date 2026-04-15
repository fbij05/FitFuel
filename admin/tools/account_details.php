<?php
$query = "SELECT * FROM admin_login_view WHERE admin_id='$_SESSION[user_id]'";
$result = mysqli_query($db, $query);
$row = mysqli_fetch_assoc($result);
?>

<h1>Account Details</h1>
<div id="account-details">
    <table>
        <tr>
            <th>Full Name</th>
            <td><?= htmlspecialchars($row["full_name"]) ?></td>
        </tr>
        <tr>
            <th>Email</th>
            <td><?= htmlspecialchars($row["email"]) ?></td>
        </tr>
        <tr>
            <th>Phone</th>
            <td><?= htmlspecialchars($row["phone"]) ?></td>
        </tr>
        <tr>
            <th>Username</th>
            <td><?= htmlspecialchars($row["username"]) ?></td>
        </tr>
    </table>
</div>