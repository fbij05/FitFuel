<?php

require "admin/tools/db.php";

session_start();

$error = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $email = $_POST["email"];

    $password = $_POST["password"];

    $login_type = $_POST["login_type"];


    // admin login //
    if($login_type == "admin"){

        $query = "SELECT * FROM admin_login_view
        WHERE username='$email'
        AND password='$password'";

        $result = mysqli_query($db, $query);


        if(mysqli_num_rows($result) == 1){

            $admin = mysqli_fetch_assoc($result);


            $_SESSION["user_id"] =
            $admin["admin_id"];

            $_SESSION["fullname"] =
            $admin["full_name"];


            header("Location: admin/account.php");

            exit();

        }else{

            $error = "Invalid admin login.";

        }

    }


    // user login //
    else{

        $query = "SELECT * FROM users
        WHERE email='$email'
        OR username='$email'";

        $result = mysqli_query($db, $query);


        if(mysqli_num_rows($result) == 1){

            $user = mysqli_fetch_assoc($result);


            if($password == $user["password"]){

                $_SESSION["user_id"] =
                $user["user_id"];

                $_SESSION["fullname"] =
                $user["full_name"];


                header("Location: index.php");

                exit();

            }else{

                $error = "Invalid password.";

            }

        }else{

            $error = "User not found.";

        }

    }

}

?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
    content="width=device-width, initial-scale=1.0">

    <title>Login</title>

    <link rel="stylesheet"
    href="css/login.css">

</head>

<body>

<header>

    <img src="img/logo.png"
    alt="logo"
    id="logo">

</header>


<main id="login-block">

    <form method="POST"
    id="login-form">

        <fieldset>

            <legend>

                <h1>Login</h1>

            </legend>


            <?php

            if($error){

                echo "<div class='error'>
                $error
                </div>";

            }

            ?>


            <label>

                Login As

            </label>

            <select
            name="login_type"
            required>

                <option value="user">

                    User

                </option>

                <option value="admin">

                    Admin

                </option>

            </select>


            <label>

                Email / Username

            </label>

            <input
            type="text"
            name="email"
            placeholder="Enter email or username"
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
            value="Login">


            <p style="margin-top: 15px;">

                Don't have an account?

                <a href="register.php">

                    Register

                </a>

            </p>

        </fieldset>

    </form>

</main>

</body>
</html>