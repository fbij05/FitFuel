<?php
session_start();
if(isset($_SESSION["user_id"])){

    $cookie_name =
    "past_purchase_" . $_SESSION["user_id"];


    setcookie(

        $cookie_name,

        "",

        time() - 3600,

        "/"

    );

}
session_destroy();
header("Location: index.php");
exit()
?>