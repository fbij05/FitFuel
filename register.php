<?php

require "admin/tools/db.php";

session_start();

$error = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $full_name = $_POST["full_name"];

    $username = $_POST["username"];

    $email = $_POST["email"];

    $password = $_POST["password"];


    // check existing email or username //
    $check = mysqli_query(
        $db,
        "SELECT * FROM users
        WHERE email='$email'
        OR username='$username'"
    );


    if(mysqli_num_rows($check) > 0){

        $error = "Email or username already exists.";

    }else{

        mysqli_query(
            $db,
            "INSERT INTO users
            (full_name, username, email, password)

            VALUES

            ('$full_name', '$username', '$email', '$password')"
        );


        header("Location: user_login.php");

        exit();

    }

}

?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <title>Register</title>

    <link rel="stylesheet"
    href="css/login.css">

</head>

<body>

<header>

    <img src="img/logo.png"
    id="logo">

</header>


<main id="login-block">

<form method="POST"
id="login-form">

    <fieldset>

        <legend>

            <h1>Create Account</h1>

        </legend>


        <?php

        if($error){

            echo "<div class='error'>
            $error
            </div>";

        }

        ?>


        <label>

            Full Name

        </label>

        <input
        type="text"
        name="full_name"
        required>


        <label>

            Username

        </label>

        <input
        type="text"
        name="username"
        required>


        <label>

            Email

        </label>

        <input
        type="email"
        name="email"
        required>


        <label>

            Password

        </label>

        <input
        type="password"
        name="password"
        required>


        <input
        type="submit"
        id="login-button"
        value="Register">


        <p style="margin-top: 15px;">

            Already have an account?

            <a href="user_login.php">

                Login

            </a>

        </p>

    </fieldset>

</form>

</main>

</body>
</html>