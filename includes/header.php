    <?php

    if(session_status() === PHP_SESSION_NONE){

        session_start();

    }

    ?>
<header>
    <div class="container top-nav">
        <a href="index.php" class="logo"><img src="img/logo.png" alt=""></a>

        <form action="products.php" method="GET" class="search" >

            <input type="search"
             name="search"
             placeholder="Search for a products...">
            <button type="submit">Search</button>

        </form>

        <div class="cart_header">
            <div onclick="open_cart()" class="icon_cart">
                <i class="fa-solid fa-cart-shopping"></i>
                <span class="count_item">0</span>
            </div>
            <div class="tottal_price">
                <p>My cart</p>
                <p class="price_cart_head">SAR 0</p>
            </div>
        </div>
    </div>

    <nav>
        <div class="links container">
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="products.php">All products</a></li>
                <li><a href="about.php">About us</a></li>
                <li><a href="contact.php">Contact</a></li>
            </ul>

            <!-- login / guest -->
            <div class="login_signup">

            <?php if(isset($_SESSION["fullname"])){ ?>

                <span class="user-status">

                    Welcome,
                    <?php echo $_SESSION["fullname"]; ?>

                </span>

                <a href="logout.php">

                    <i class="fa-solid fa-right-from-bracket"></i>

                    Logout

                </a>

            <?php }else{ ?>

                <span class="user-status">

                    Guest

                </span>

                <a href="user_login.php">

                    <i class="fa-solid fa-arrow-right-to-bracket"></i>

                    Login

                </a>

                <a href="register.php">

                    Register

                </a>

            <?php } ?>

            </div>
        </div>
    </nav>
</header>
