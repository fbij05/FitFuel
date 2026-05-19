<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>

    <link rel="stylesheet" href="css/style.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
    <style>
        .cart_header {display: none !important;}
    </style>

</head>

<body>

<?php include "includes/header.html" ?>

<main>

    <div class="container checkout-container">

        <h2>Checkout</h2>

        <!-- cart items -->
        <div class="cart-items" id="checkout_items">

        </div>


        <!-- summary -->
        <div class="checkout-summary">

            <div class="subtotal">
                <p>Subtotal:</p>
                <p id="subtotal_price">SAR 0</p>
            </div>

            <div class="shipping">
                <p>Shipping:</p>
                <p>SAR 20</p>
            </div>

            <div class="total">
                <p>Total:</p>
                <p id="total_price">SAR 20</p>
            </div>

        </div>


        <!-- shipping form -->
        <div class="shipping-address">

            <h3>Shipping Address</h3>

            <form>

                <input type="text" placeholder="Full Name" required>

                <input type="text" placeholder="Street Address" required>

                <input type="text" placeholder="City" required>

                <input type="text" placeholder="State/Province" required>

                <input type="text" placeholder="Postal Code" required>

                <input type="text" placeholder="Country" required>

            </form>

        </div>


        <!-- buttons -->
        <div class="actions">

            <button class="delete-all-btn" id="delete_all">
                Delete All
            </button>

            <a href="payment.html" class="buy-btn">
                Buy Now
            </a>

        </div>

    </div>

</main>
<?php include "includes/footer.html" ?>


<script>

const checkoutContainer = document.getElementById("checkout_items");

const subtotalPrice = document.getElementById("subtotal_price");

const totalPrice = document.getElementById("total_price");

const deleteAllBtn = document.getElementById("delete_all");


// get cart items //
let cartItems = JSON.parse(localStorage.getItem("cart")) || [];


// display checkout items //
function displayCheckoutItems(){

    checkoutContainer.innerHTML = "";

    let subtotal = 0;

    cartItems.forEach(item => {

        subtotal += item.price;

        checkoutContainer.innerHTML += `

        <div class="cart-item">

            <img src="img/${item.image}" alt="">

            <div class="cart-item-info">

                <h4>${item.name}</h4>

                <p class="cart-price">
                    SAR ${item.price}
                </p>

                <p class="total-price">
                    Total: SAR ${item.price}
                </p>

                <button class="delete-btn" data-name="${item.name}">
                    Delete
                </button>

            </div>

        </div>

        `;

    });

    subtotalPrice.innerText = "SAR " + subtotal;

    totalPrice.innerText = "SAR " + (subtotal + 20);

    updateDeleteButtons();

}


// delete item //
function updateDeleteButtons(){

    const deleteButtons = document.querySelectorAll(".delete-btn");

    deleteButtons.forEach(button => {

        button.onclick = () => {

            const name = button.dataset.name;

            cartItems = cartItems.filter(item => item.name !== name);

            localStorage.setItem("cart", JSON.stringify(cartItems));

            displayCheckoutItems();

        };

    });

}


// delete all //
deleteAllBtn.onclick = () => {

    cartItems = [];

    localStorage.removeItem("cart");

    displayCheckoutItems();

};


// first load //
displayCheckoutItems();

</script>

</body>
</html>