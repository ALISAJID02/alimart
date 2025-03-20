<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" /> 
    <style>
/* Style for the cart box */
.cart-box {
    display: none; /* Initially hidden */
    position: fixed;
    top: 0%;
    right: 10px;
    /* transform: translateY(-50%); */
    width: 300px;
    height: 500px;
    background-color: #fff;
    border: 1px solid #ccc;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
    z-index: 1000;
    padding: 20px;
    border-radius: 5px 0 0 5px;
    overflow:scroll;
}

.cart-box h2 {
    margin-top: 0;
    font-size: 1.5em;
}

.cart-item {
    border-bottom: 1px solid #eee;
    padding: 10px 0;
}

.cart-item:last-child {
    border-bottom: none;
    width: 100px;
    height: 100px;
}
.cart-item ul li{
    width: 50px;
    height: 50px;
}


.alert {
    padding: 10px;
    margin: 10px 0;
    border: 1px solid transparent;
    border-radius: 4px;
    display: none; /* Initially hide alerts */
    position: fixed;
    top: 10px;
    left: 50%;
    transform: translateX(-50%);
    z-index: 1000;
    width: 80%;
    max-width: 600px;
}

.alert-success {
    color: #155724;
    background-color: #d4edda;
    border-color: #c3e6cb;
}

.alert-error {
    color: #721c24;
    background-color: #f8d7da;
    border-color: #f5c6cb;
}
.cart-product {
    width: 100%;
    height: 100px;
    border-bottom: 1px rgb(232, 232, 232) solid;
    display: flex;
    line-height: 25px;
    margin-bottom: 10px;
    /* display: none; */
}

.cart-image {
    width: 100px;
    height: 100%;
    background-color: #fff;
}

.cart-image>img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.cart-text {
    padding: 0 10px;
}

.cart-text>p,
span {
    color: gray;
    font-size: 14px;
}


.fa-trash {
    color: #000;
    font-size: 15px;
    padding: 10px;
    cursor: pointer;
}

.quick-view-quantity-box {
    height: 40px;
    overflow: hidden;
    border: 1px rgb(162, 162, 162) solid;
    width: 115px;
    border-radius: 5px;
    float: left;
}

.quick-view-quantity-box>button {
    padding: 5px 10px;
    color: #000;
    font-size: 25px;
    border: none;
    background-color: #fff;
    cursor: pointer;
}

.quick-view-quantity-box>input {
    color: #000;
    width: 50px;
    height: 50px;
    font-size: 15px;
    font-weight: 300;
    outline: none;
    margin-top: -20px;
    padding: 10px;
    border: 1px rgb(162, 162, 162) solid;
    text-align: center;
}


    </style>
</head>
<body>
<button id="showCartButton">Show Cart</button>

<!-- Existing cart box for displaying cart contents -->
<!-- <div class="cart-box" id="cartBox">
    <h2>Your Cart</h2>
    <div id="cartItems"></div>
    <button id="closeCartButton"><i class='fa-solid fa-xmark close-cart'></i></button>
</div> -->

<div class="alert"></div>

<!-- <div id="cart" style="display: none;"> -->
    <!-- Cart items will be populated here -->
<!-- </div> -->

<!-- Example Add to Cart button -->
<button class="addcart" data-product-id="1">Add to Cart</button>
<button class="addcart" data-product-id="2">Add to Cart</button>
<button class="addcart" data-product-id="3">Add to Cart</button>
<div id="cartBox">
    <button id="closeCartButton ">Close Cart</button>
    <div id="cartItems"></div>
    <div id="totalPrice"></div>
    <div id="totalItems"></div>
</div>

</body>
</html>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('.addcart').click(function(e) {
        e.preventDefault();
        var productId = $(this).data('product-id');

        $.ajax({
            type: 'POST',
            url: 'add_to_cart.php',
            data: { product_id: productId },
            dataType: 'json',
            success: function(response) {
                var alertClass = response.status === 'success' ? 'alert-success' : 'alert-error';
                $('.alert')
                    .removeClass('alert-success alert-error')
                    .addClass(alertClass)
                    .text(response.message)
                    .fadeIn()
                    .delay(2000)
                    .fadeOut();

                if (response.status === 'success') {
                    loadCartItems();  // Update the cart view
                    $('#cartBox').fadeIn(); // Show the cart box
                }
            },
            error: function(xhr, status, error) {
                $('.alert')
                    .removeClass('alert-success')
                    .addClass('alert-error')
                    .text('An error occurred: ' + error)
                    .fadeIn()
                    .delay(2000)
                    .fadeOut();
            }
        });
    });
    $(document).on('click', '.increase-quantity', function() {
        var productId = $(this).data('product-id');

        $.ajax({
            type: 'POST',
            url: 'increase_quantity.php',
            data: { product_id: productId },
            dataType: 'json',
            success: function() {
                loadCartItems();  // Update the cart view
            },
            error: function(xhr, status, error) {
                console.error('An error occurred: ' + error);
            }
        });
    });

    $(document).on('click', '.decrease-quantity', function() {
        var productId = $(this).data('product-id');

        $.ajax({
            type: 'POST',
            url: 'decrease_quantity.php',
            data: { product_id: productId },
            dataType: 'json',
            success: function() {
                loadCartItems();  // Update the cart view
            },
            error: function(xhr, status, error) {
                console.error('An error occurred: ' + error);
            }
        });
    });

    $('#showCartButton').click(function() {
        loadCartItems();
        $('#cartBox').fadeIn(); // Show the cart box
    });

    $('#closeCartButton').click(function() {
        $('#cartBox').fadeOut(); // Hide the cart box
    });

    function loadCartItems() {
        $.ajax({
            type: 'GET',
            url: 'fetch_cart.php',
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    var cartItems = response.data;
                    var cartHtml = '';
                    cartItems.forEach(function(item) {
                        cartHtml += "<div class='cart-product'>";
                        cartHtml += "<div class='cart-image'><img src='" + item.image + "' alt='" + item.name + "'></div>";
                        cartHtml += "<div class='cart-text'>";
                        cartHtml += "<p>" + item.name + "<br><span>" + item.price + "</span></p>";
                        cartHtml += "<div class='quick-view-quantity-box'><button>-</button><input type='text' value='" + item.quantity + "'><button>+</button></div>";
                        cartHtml += "<i class='fa-solid fa-trash delete-product' data-product-id='" + item.id + "'></i>";
                        cartHtml += "</div>";
                        cartHtml += "</div>";
                    });
                    $('#cartItems').html(cartHtml);
                    $('#totalPrice').text('Total Price: ' + response.totalPrice);
                    $('#totalItems').text('Total Items: ' + response.totalItems);
                } else {
                    $('#cartItems').html('<p>' + response.message + '</p>');
                    $('#totalPrice').text('');
                    $('#totalItems').text('');
                }
            },
            error: function(xhr, status, error) {
                $('#cartItems').html('<p>An error occurred: ' + error + '</p>');
                $('#totalPrice').text('');
                $('#totalItems').text('');
            }
        });
    }

    // Initially hide the cart box
    $('#cartBox').hide();
    $(document).on('click', '.delete-button', function() {
        var productId = $(this).data('product-id');

        $.ajax({
            type: 'POST',
            url: 'delete_from_cart.php',
            data: { product_id: productId },
            dataType: 'json',
            success: function() {
                loadCartItems();  // Update the cart view
            },
            error: function(xhr, status, error) {
                console.error('An error occurred: ' + error);
            }
        });
    });
    // Initially hide the cart box
    $('#cart').hide();
});
// });

</script>