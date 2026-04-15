<?php
require "tools/db.php";

session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/account.css">
    <title>FitFuel - Admin Panel</title>
</head>
<body>
    <header>
        <img src="../img/logo.png" alt="fitfuel logo" height="60">
        <span id="corner-details">
            <span id="logged-name">Welcome, <?php echo $_SESSION["fullname"]?></span>
            <form method="post" action="logout.php" id="logout-form">
                <button type="submit" id="logout">Logout</button>
            </form>
        </span>
    </header>
    <main>
        <nav id="sidebar">
            <ul>
                <li><a href="account.php?show=items">Items</a></li>
                <li><a href="account.php?show=orders">Orders</a></li>
                <li><a href="account.php?show=account">Account Details</a></li>

            </ul>
        </nav>
        <section id="content">
            <?php
                if(isset($_GET['show'])) {
                    switch ($_GET['show']) {
                        case 'items':
                            include "tools/items_list.php";
                            break;
                        case 'orders':
                            include "tools/orders_list.php";
                            break;
                        case 'account':
                            include "tools/account_details.php";
                            break;
                        default:
                            break;
                    }
                }
            ?>
        </section>
    </main>
</body>
</html>