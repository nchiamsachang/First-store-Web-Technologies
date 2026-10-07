
var PRODUCTS = [
    { id: 0, name: "Wheat Belly", price: 0.99, img: "../images/e-books/health/WheatBelly.jpg" },
    { id: 1, name: "Exercise Cure", price: 2.99, img: "../images/e-books/health/NoExercise.jpg" },
    { id: 2, name: "Daniel Plan", price: 2.99, img: "../images/e-books/health/healthPlan.jpg" },
    { id: 3, name: "Soul Healing", price: 1.99, img: "../images/e-books/health/Soul.jpg" },
    { id: 4, name: "What To Expect", price: 3.99, img: "../images/e-books/parenting/expect.jpg" },
    { id: 5, name: "The First Year", price: 1.99, img: "../images/e-books/parenting/expect1.jpg" },
    { id: 6, name: "Hands Free Mama", price: 0.99, img: "../images/e-books/parenting/Mama.jpg" },
    { id: 7, name: "Talk To Kids", price: 2.99, img: "../images/e-books/parenting/talk.jpg" }
];

function setCookie(name, value, days) {
    var expires = "";
    if (days) {
        var d = new Date();
        d.setTime(d.getTime() + days * 24 * 60 * 60 * 1000);
        expires = "; expires=" + d.toUTCString();
    }
    document.cookie = name + "=" + encodeURIComponent(value) + expires + "; path=/";
}

function getCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i].trim();
        if (c.indexOf(nameEQ) === 0)
            return decodeURIComponent(c.substring(nameEQ.length));
    }
    return null;
}

function deleteCookie(name) {
    setCookie(name, "", -1);
}

function getCartItems() {
    var items = [];
    for (var i = 0; i < PRODUCTS.length; i++) {
        var qty = getCookie("cart_" + i);
        if (qty !== null && parseInt(qty) > 0) {
            items.push({ product: PRODUCTS[i], qty: parseInt(qty) });
        }
    }
    return items;
}

function addToCart(catalogId, qty) {
    var existing = getCookie("cart_" + catalogId);
    var newQty = (existing ? parseInt(existing) : 0) + qty;
    setCookie("cart_" + catalogId, newQty, 7);
}

function removeFromCart(catalogId) {
    deleteCookie("cart_" + catalogId);
}

function cartIsEmpty() {
    return getCartItems().length === 0;
}

function handleAddToCart(catalogId, qtyFieldId) {
    var qtyField = document.getElementById(qtyFieldId);
    var qty = parseInt(qtyField.value);

    if (isNaN(qty) || qty <= 0) {
        alert("Please enter a valid quantity.");
        return;
    }

    var product = PRODUCTS[catalogId];
    var result = confirm("Added " + qty + " x " + product.name + " to cart.\n\nPress OK to continue shopping, or Cancel to stay on this page.");
    if (result) {
        addToCart(catalogId, qty);
        window.location.href = "store_index.html";
    }
}

function reviewCart() {
    if (cartIsEmpty()) {
        alert("Your shopping cart is empty!");
        window.location.href = "store_index.html";
    } else {
        window.location.href = "Cart.html";
    }
}