// open and close the cart //
var cart = document.querySelector('.cart');

function open_cart(){
    if(cart){
        cart.classList.add("active");
    }
}

function close_cart(){
    if(cart){
        cart.classList.remove("active");
    }
}


// cart system //
const cartButtons = document.querySelectorAll(".add_cart");
const cartContainer = document.querySelector(".items_in_cart");
const totalPrice = document.querySelector(".price_cart_total");
const cartCount = document.querySelector(".top_cart h3 span");
const cartIconCount = document.querySelector(".count_item");


// get cart from local storage //
let cartItems = JSON.parse(localStorage.getItem("cart")) || [];


// display cart items //
function displayCart(){

    if(!cartContainer) return;

    cartContainer.innerHTML = "";

    cartItems.forEach(item => {

        cartContainer.innerHTML += `
        
        <div class="cart_item">

            <img src="img/${item.image}" alt="">

            <div class="content">
                <h4>${item.name}</h4>
                <p class="cart_price">
                    SAR ${item.price * item.quantity}
                </p>
            </div>

            <button class="delet_item" data-name="${item.name}">
                <i class="fa-solid fa-trash-can"></i>
            </button>

        </div>

        `;

    });

    updateTotalPrice();
    updateCartCount();
    updateDeleteButtons();

}


// add products //
cartButtons.forEach(button => {

    button.addEventListener("click", () => {
        const id = button.dataset.id;
        const name = button.dataset.name;
        const price = parseFloat(button.dataset.price);
        const image = button.dataset.image;
        const stock = parseInt(button.dataset.stock);


        // check if exists //
        const exists =
        cartItems.find(item => item.name === name);

        if(exists){
            exists.stock = stock;

            if(exists.quantity < stock){
                exists.quantity += 1;

            }else{
                alert("Not enough stock");
                return;

            }

        }else{
            cartItems.push({

                id,
                name,
                price,
                image,
                stock,
                quantity: 1

            });
        }


        // save //
        localStorage.setItem(
            "cart",
            JSON.stringify(cartItems)
        );

        displayCart();

        open_cart();

    });

});


// delete item //
function updateDeleteButtons(){

    const deleteButtons = document.querySelectorAll(".delet_item");

    deleteButtons.forEach(button => {

        button.onclick = () => {

            const name = button.dataset.name;

            cartItems = cartItems.filter(item => item.name !== name);

            localStorage.setItem("cart", JSON.stringify(cartItems));

            displayCart();

        };

    });

}


// total price //
function updateTotalPrice(){

    if(!totalPrice) return;

    let total = 0;

    cartItems.forEach(item => {

        total += item.price * item.quantity;

    });

    totalPrice.innerText = "SAR " + total;

}


// cart count //
function updateCartCount(){

    let count = 0;

    cartItems.forEach(item => {

        count += item.quantity;

    });

    if(cartCount){
        cartCount.innerText = `(${count} Item in Cart)`;
    }

    if(cartIconCount){
        cartIconCount.innerText = count;
    }

}


// first load //
displayCart();




// CHECKOUT PAGE //

const checkoutContainer = document.getElementById("checkout_items");

if(checkoutContainer){

    const subtotalPrice = document.getElementById("subtotal_price");

    const checkoutTotalPrice = document.getElementById("total_price");

    const deleteAllBtn = document.getElementById("delete_all");

    cartItems = JSON.parse(localStorage.getItem("cart")) || [];


    function displayCheckoutItems(){

        checkoutContainer.innerHTML = "";

        let subtotal = 0;

        cartItems.forEach(item => {

            subtotal += item.price * item.quantity;

            checkoutContainer.innerHTML += `

            <div class="cart-item">

                <img src="img/${item.image}" alt="">

                <div class="cart-item-info">

                    <h4>${item.name}</h4>

                    <p class="cart-price">
                        SAR ${item.price}
                    </p>

                    <div class="quantity-controls">

                        <button class="qty-btn minus">
                            -
                        </button>

                        <input
                        type="number"
                        class="quantity-input"
                        value="${item.quantity}"
                        min="1">

                        <button class="qty-btn plus">
                            +
                        </button>

                    </div>

                    <p class="total-price">
                        Total: SAR
                        <span class="item-total">
                            ${item.price * item.quantity}
                        </span>
                    </p>

                    <button class="delete-btn"
                    data-name="${item.name}">
                        Delete
                    </button>

                </div>

            </div>

            `;

        });

        subtotalPrice.innerText = "SAR " + subtotal;

        checkoutTotalPrice.innerText =
        "SAR " + (subtotal + 20);

        document.getElementById("checkout_total_hidden").value =
        subtotal + 20;

        document.getElementById("cart_data_input").value =
        JSON.stringify(cartItems);

        updateCheckoutDeleteButtons();

    }


    function updateCheckoutDeleteButtons(){

        const deleteButtons = document.querySelectorAll(".delete-btn");

        deleteButtons.forEach(button => {

            button.onclick = () => {

                const name = button.dataset.name;

                cartItems =
                cartItems.filter(item => item.name !== name);

                localStorage.setItem(
                    "cart",
                    JSON.stringify(cartItems)
                );

                displayCheckoutItems();

                displayCart();

            };

        });

    }


    deleteAllBtn.onclick = () => {

        cartItems = [];

        localStorage.removeItem("cart");

        displayCheckoutItems();

        displayCart();

    };

    displayCheckoutItems();

}


// quantity controls //
document.addEventListener("click", (e) => {

    // plus
    if(e.target.classList.contains("plus")){

        let input =
        e.target.parentElement.querySelector(".quantity-input");

        let currentValue = parseInt(input.value);

        const cartItem =
        e.target.closest(".cart-item-info");

        const productName =
        cartItem.querySelector("h4").innerText;


        const product =
        cartItems.find(item => item.name == productName);


        if(currentValue < parseInt(product.stock)){

            input.value = currentValue + 1;

            updateCartQuantity(e.target);

            updateItemTotal();

        }else{

            alert("Not enough stock");

        }

    }


    // minus
    if(e.target.classList.contains("minus")){

        let input =
        e.target.parentElement.querySelector(".quantity-input");

        if(parseInt(input.value) > 1){

            input.value = parseInt(input.value) - 1;

            updateCartQuantity(e.target);

            updateItemTotal();

        }

    }

});



function updateItemTotal(){

    let subtotal = 0;

    document.querySelectorAll(".cart-item-info").forEach(item => {

        subtotal += parseFloat(
            item.querySelector(".item-total").innerText
        );

    });

    document.getElementById("subtotal_price").innerText =
    "SAR " + subtotal;

    document.getElementById("total_price").innerText =
    "SAR " + (subtotal + 20);

    document.getElementById("checkout_total_hidden").value =
    subtotal + 20;

}




// PAYMENT PAGE // 

const paymentForm = document.getElementById("payment_form");

if(paymentForm){

    cartItems = JSON.parse(localStorage.getItem("cart")) || [];

    const subtotalPrice = document.getElementById("subtotal_price");

    const paymentTotalPrice = document.getElementById("total_price");

    let subtotal = 0;

    cartItems.forEach(item => {

        subtotal += item.price * item.quantity;

    });

    subtotalPrice.innerText = "SAR " + subtotal;

    paymentTotalPrice.innerText =
    "SAR " + (subtotal + 20);

        const paymentSummary =
    document.querySelector(".checkout-summary");

    cartItems.forEach(item => {

        paymentSummary.innerHTML += `

        <div class="payment-product">

            <p>
                ${item.name} x${item.quantity}
            </p>

            <p>
                SAR ${item.price * item.quantity}
            </p>

        </div>

        `;

    });

    document.getElementById("hidden_total").value =
    subtotal + 20;

    document.getElementById("cart_data_payment").value =
    localStorage.getItem("cart");


    paymentForm.addEventListener("submit", function(){

        localStorage.removeItem("cart");

    });

}



function updateCartQuantity(button){

    const cartItem =
    button.closest(".cart-item-info");

    const productName =
    cartItem.querySelector("h4").innerText;

    const quantity =
    parseInt(
        cartItem.querySelector(".quantity-input").value
    );


    cartItems.forEach(item => {

        if(item.name == productName){

            if(quantity <= item.stock){

                item.quantity = quantity;

            }else{

                alert("Not enough stock");

                quantity =
                item.stock;

                cartItem.querySelector(".quantity-input").value =
                item.stock;

                item.quantity = item.stock;

            }

            cartItem.querySelector(".item-total").innerText =
            item.price * quantity;

        }

    });


    localStorage.setItem(
        "cart",
        JSON.stringify(cartItems)
    );

}