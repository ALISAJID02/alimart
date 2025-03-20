<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
<div class="cart-box" id="cartBox">
        <button id="closeCartButton"><i class='fa-solid fa-xmark close-cart'></i></button>
        <h2>Your Cart<div id="totalItems"></div></h2>
    <div class="cart-items">
    <div id="cartItems"></div>
    </div>
    <div class='cart-cash'>
                 <h4>Total</h4><span>RS:<div id="totalPrice"></div></span>
                 <p>Taxes and shipping calculated at checkout</p>
                 <button class='checkout-btn'><a href='checkout.php'>procced to checkout</a></button>
                 <button class='viewcart-btn'><a href=''>view cart</a></button>
    </div>
</div>
<div id="overlay"></div>

<div class='wishlist-nav' style="margin-top:185px;">
            <a href='index.php'>home</a>
            > wishlist
        </div>
        
<?php
session_start();
include "connection.php";
include "header.php";
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    $query = "SELECT product.id, product.name, product.price, product.image 
              FROM wishlist 
              JOIN product ON wishlist.product_id = product.id 
              WHERE wishlist.user_id = ?";
    if ($stmt = $connection->prepare($query)) {
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            echo "<div class='whislist-wrapper'>";
         
            echo "<h1>wishlist</h1>";
            echo "<div class='wishlist-product'>";
                        while ($row = $result->fetch_assoc()) {
                            $id=$row['id'];
                            echo "<div class='product'>";
                            echo "<div class='productimage'>";
                            echo "<img src='" . $row['image'] . "' alt='" . $row['name'] . "' class='frontface'>";
                            echo "<img src='" . $row['image'] . "' alt='" . $row['name'] . "' class='backface'>";
                            echo "</div>";
                            echo "<div class='producticon'>";
                            echo "<span>";
                            echo "<button class='addcart' data-product-id='" . $id . "'>
                                <i class='fa-solid fa-cart-shopping cartbtn' title='Add to cart'></i>
                            </button>";
                            echo "<button type='submit' class='quicksearch' id='$id'>
                                <i class='fa-solid fa-magnifying-glass' title='Quick view'></i>
                            </button>";
                            echo "<sajid class='delete-btn' data-product-id='" . $id . "'>
                            <a href=''><i class='fa-solid fa-xmark' title='Remove from wishlist'></i></a>
                                </sajid>";
                            echo "</span>";
                            echo "</div>";
                            echo "<div class='producttext'>";
                            echo "<p>" . $row['name'] . "</p>";
                            echo "<h6>" . $row['price'] . "</h6>";
                            echo "<span>";
                            echo "<i class='fa-regular fa-star'></i>";
                            echo "<i class='fa-regular fa-star'></i>";
                            echo "<i class='fa-regular fa-star'></i>";
                            echo "<i class='fa-regular fa-star'></i>";
                            echo "<i class='fa-regular fa-star'></i>";
                            echo "</span>";
                            echo "</div>";
                            echo "</div>";
            }
            echo" </div>";
             echo" </div>";
        } else {
            echo "<p style='color:black;text-align:center;'>Your wishlist is empty</p>";
        }
        $stmt->close();
    } else {
        echo "Database query failed";
    }
} else {
    echo "<p style='color:black;text-align:center;margin:80px 0 0 0 ;'>please login in to view your wishlist</p>";
    echo"<button style='color:black;padding:10px 15px;border-radius:5px;margin:10px 730px;background-color:#1772af;text-decoration: none;'><a href='login.php'>LOGIN</a></button>";
}
?>
<div id="quickview-wrapper">
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

 <script src="script.js"></script>
 <script src="add_wishlist.js"></script>

</body>
</html>