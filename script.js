$(document).ready(function () {
    $(document).on("click", ".quicksearch", function () {
        var searchData = $(this).attr("id");
        // alert(searchData);
        $('#quickview-wrapper').show();
        $('body').addClass('no-scroll');
        $.ajax({
            url: "quicksearch.php",
            type: "post",
            data: { term: searchData },
            success: function (data) {
                $("#quickview-wrapper").html(data);
            }
        });
    });
});

$(document).ready(function () {
    $(document).on("click", ".close-quick", function () {
        var getId = $(this).attr("id");
        $('#quickview-wrapper').hide();
        $('body').removeClass('no-scroll');
    });
});


// $(document).on('click', '#quickview-wrapper', function () {
//     $('#quickview-wrapper').hide();
//     $('body').removeClass('no-scroll'); // Enable scrolling
// });

$(document).ready(function () {
    $(document).off('click', '.addcart').on('click', '.addcart', function (e) {
        e.preventDefault();
        var productId = $(this).data('product-id');
        // alert(productId);
        $.ajax({
            type: 'POST',
            url: 'add_to_cart.php',
            data: { product_id: productId },
            dataType: 'json',
            success: function (response) {
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
                    $('#overlay').fadeIn(); // Show the overlay
                    $('body').addClass('no-scroll'); // Disable scrolling
                }
            },
            error: function (xhr, status, error) {
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
   // Increase quantity
   $(document).off('click', '.plusbtn').on('click', '.plusbtn', function () {
    // Find the sibling input and increment its value
    var quantityInput = $(this).siblings('.quantity-input');
    var currentQuantity = parseInt(quantityInput.val()) || 1;
    quantityInput.val(currentQuantity + 1);
});

// Decrease quantity
$(document).off('click', '.minusbtn').on('click', '.minusbtn', function () {
    // Find the sibling input and decrement its value, ensuring it doesn't go below 1
    var quantityInput = $(this).siblings('.quantity-input');
    var currentQuantity = parseInt(quantityInput.val()) || 1;

    if (currentQuantity > 1) {
        quantityInput.val(currentQuantity - 1);
    }
});
});

// Add to cart with quantity
$(document).off('click', '.addcart-with-quantity').on('click', '.addcart-with-quantity', function (e) {
    e.preventDefault();
    var productId = $(this).data('product-id');
    var quantityInput = $(this).siblings('.quick-view-quantity-box').find('.quantity-input');
    var quantity = parseInt(quantityInput.val()) || 1;
    $.ajax({
        type: 'POST',
        url: 'add_to_cart_with_quantity.php',
        data: { product_id: productId, quantity: quantity },
        dataType: 'json',
        success: function (response) {
            var alertClass = response.status === 'success' ? 'alert-success' : 'alert-error';
            $('.alert')
                .removeClass('alert-success alert-error')
                .addClass(alertClass)
                .text(response.message)
                .fadeIn()
                .delay(2000)
                .fadeOut();

            if (response.status === 'success') {
                loadCartItems(); // Refresh cart items
            }
        },
        error: function (xhr, status, error) {
            console.error('An error occurred: ' + error);
        }
    });
});


    $('#showCartButton').click(function () {
        loadCartItems();
        $('#cartBox').fadeIn(); // Show the cart box
        $('#overlay').fadeIn(); // Show the overlay
        $('body').addClass('no-scroll'); // Disable scrolling
    });

    $(document).on('click', '#overlay', function () {
        $('#cartBox').fadeOut();
        $('#overlay').fadeOut(); // Hide the overlay
        $('body').removeClass('no-scroll'); // Enable scrolling
    });

    $('#closeCartButton').click(function () {
        $('#cartBox').fadeOut(); // Hide the cart box
        $('#overlay').fadeOut(); // Hide the overlay
        $('body').removeClass('no-scroll'); // Enable scrolling
    });

    function loadCartItems() {
        $.ajax({
            type: 'GET',
            url: 'fetch_cart.php',
            dataType: 'json',
            success: function (response) {
                if (response.status === 'success') {
                    console.log(response); // Log the response to check if it's valid JSON
                    var cartItems = response.data;
                    var cartHtml = '';
                    cartItems.forEach(function (item) {
                        cartHtml += "<div id='cart'>";
                        cartHtml += "<div class='cart-product'>";
                        cartHtml += "<div class='cart-image'><img src='" + item.image + "' alt='" + item.name + "'></div>";
                        cartHtml += "<div class='cart-text'>";
                        cartHtml += "<p>" + item.name + "<br><span>" + item.price + "</span></p>";
                        cartHtml += "<div class='quick-view-quantity-box'>";
                        cartHtml += "<button class='decrease-quantity' data-product-id='" + item.id + "'>-</button>";
                        cartHtml += "<input type='text' value='" + item.quantity + "' readonly>";
                        cartHtml += "<button class='increase-quantity' data-product-id='" + item.id + "'>+</button>";
                        cartHtml += "</div>";
                        cartHtml += "<i class='fa-solid fa-trash delete-product' data-product-id='" + item.id + "'></i>";
                        cartHtml += "</div>";
                        cartHtml += "</div>";
                        cartHtml += "</div>";
                        cartHtml += "</div>";
                    });
                    $('#cartItems').html(cartHtml);
                    $('#totalPrice').text(response.totalPrice);
                    $('#totalItems').text(response.totalItems);
                    $('.cart-cash').fadeIn();

                } else {
                    var emptycart = response.data;
                    var emptycart = '';
                    emptycart += "<div class='emptycart-wrapper'>";
                    emptycart += "<div class='empty-cart'>";
                    emptycart += "<i class='fa-solid fa-cart-shopping'></i>";
                    emptycart += "<p>No products in the cart</p>";
                    emptycart += "<button><a href='electronics.php'>CONTINUE SHOPPING</a></button>";
                    emptycart += "<span>Have an account? <br>";
                    emptycart += "<a href='login.php'>log in</a>to check out faster.</span>";
                    emptycart += "</div>";
                    emptycart += "</div>";
                    $('#cartItems').html(emptycart);
                    $('#totalPrice').text('');
                    $('#totalItems').text('');
                    $('.cart-cash').fadeOut();
                }
            },
            error: function (xhr, status, error) {
                $('#cartItems').html('<p>An error occurred: ' + error + '</p>');
            }
        });
    }
    $(document).off('click', '.increase-quantity').on('click', '.increase-quantity', function () {
        var productId = $(this).data('product-id');

        $.ajax({
            type: 'POST',
            url: 'increase_quantity.php',
            data: { product_id: productId },
            dataType: 'json',
            success: function () {
                loadCartItems();  // Update the cart view
            },
            error: function (xhr, status, error) {
                console.error('An error occurred: ' + error);
            }
        });
    });

    $(document).off('click', '.decrease-quantity').on('click', '.decrease-quantity', function () {
        var productId = $(this).data('product-id');

        $.ajax({
            type: 'POST',
            url: 'decrease_quantity.php',
            data: { product_id: productId },
            dataType: 'json',
            success: function () {
                loadCartItems();  // Update the cart view
            },
            error: function (xhr, status, error) {
                console.error('An error occurred: ' + error);
            }
        });
    });

    // Function to delete a product from the cart
    $(document).on('click', '.delete-product', function () {
        var productId = $(this).data('product-id');
        $.ajax({
            type: 'POST',
            url: 'delete_from_cart.php',
            data: { product_id: productId },
            dataType: 'json',
            success: function () {
                loadCartItems();  // Update the cart view
            },
            error: function (xhr, status, error) {
                console.error('An error occurred: ' + error);
            }
        });
    });
    // Initially hide the cart box
    $('#cartBox').hide();
    $('#overlay').hide();


document.querySelector('.hamburger-menu').addEventListener('click', function () {
    document.querySelector('.mainnav').classList.toggle('active');
});
var swiper = new Swiper(".mySwiper", {
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
});

