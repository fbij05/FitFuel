// open and close the cart //
var cart = document.querySelector('.cart');

function open_cart(){
    cart.classList.add("active");
}

function close_cart(){
    cart.classList.remove("active");
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

    cartContainer.innerHTML = "";

    cartItems.forEach(item => {

        cartContainer.innerHTML += `
        
        <div class="cart_item">

            <img src="${item.image}" alt="">

            <div class="content">
                <h4>${item.name}</h4>
                <p class="cart_price">${item.price}</p>
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

        const name = button.dataset.name;
        const price = parseFloat(button.dataset.price);
        const image = button.dataset.image;

        // prevent duplicates //
        const exists = cartItems.find(item => item.name === name);

        if(exists){
            alert("Product already in cart");
            return;
        }

        // add item //
        cartItems.push({
            name,
            price,
            image
        });

        // save to local storage //
        localStorage.setItem("cart", JSON.stringify(cartItems));

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

    let total = 0;

    cartItems.forEach(item => {
        total += item.price;
    });

    totalPrice.innerText = "SAR " + total;

}


// cart count //
function updateCartCount(){

    cartCount.innerText = `(${cartItems.length} Item in Cart)`;

    cartIconCount.innerText = cartItems.length;

}


// first load //
displayCart();
