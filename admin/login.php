<?php
require "tools/db.php";

session_start();

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $query = "SELECT * FROM admins WHERE username='$username' AND password='$password'";
    $result = mysqli_query($db, $query);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION["user_id"] = $row["admin_id"];
        $_SESSION["username"] = $row["username"];
        header("Location: account.php");
        exit();
    } else {
        $error = "Invalid username or password.";
    }

    mysqli_close($db);
}
?>

<!DOCTYPE html>
<html lang="en"><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="../css/login.css">
    <title>FitFuel - Admin Panel</title>
</head>
<body>
    <header>
        <img src="../img/logo.png" alt="FitFuel logo" id="logo">
    </header>
    <main id="login-block">
        <form method="post" action="login.php" id="login-form">
            <fieldset>
                <legend><h1>Login</h1></legend>

                <?php if ($error) echo "<div class='error'>$error</div>";?>

                <label for="username">Username</label>
                <input id="username" name="username" type="text">

                <label for="password">Password</label>
                <input id="password" name="password" type="password">


                <input type="submit" id="login-button" value="Login">
            </fieldset>
            <i class="comment">To create an account, please visit management.</i>
        </form>
    </main>
    <footer>
        &copy; FitFuel<sup>fictional</sup> - Web-based Systems Project
    </footer>

</body></html>