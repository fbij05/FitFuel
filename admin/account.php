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
    <header></header>
    <main>

    </main>
</body>
</html>