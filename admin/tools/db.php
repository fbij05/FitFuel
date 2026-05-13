<?php

define("DATABASE_LOCAL", "127.0.0.1");
define("DATABASE_USER", "fitfuel");
define("DATABASE_PASSWD", "password");
define("DATABASE_NAME", "fitfuel_db");

$db = mysqli_connect(DATABASE_LOCAL, DATABASE_USER, DATABASE_PASSWD, DATABASE_NAME);

?>