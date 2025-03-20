<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>electronics</title>
</head>

<body>
<?php
    include "header.php";
    include "connection.php";
    ?>
<div class="cart-box" id="cartBox">
        <button id="closeCartButton"><i class='fa-solid fa-xmark close-cart'></i></button>
        <h2>Your Cart<div id="totalItems"></div></h2>
    <div class="cart-items">
    <div id="cartItems"></div>
    </div>
    <div class='cart-cash'>
                 <h4>Total</h4><span>RS:<div id="totalPrice"></div></span>
                 <p>Taxes and shipping calculated at checkout</p>
                 <button class='checkout-btn'><a href=''>procced to checkout</a></button>
                 <button class='viewcart-btn'><a href=''>view cart</a></button>
    </div>
</div>
<div id="overlay"></div>
<div class="alert"></div>
    <div class="electronic-wrapper">
        <div class="electronic-poster">
            <img src="./pictures/electronic.jpg" alt="">
            <h1>featured electronics</h1>
        </div>
        <div class="electronic-main">
        <div class="wishlist-nav">
            <a href="index.php">home</a>
            > featured electronics
        </div>
            <div class="electronice-colorbox"></div>
            <div class="electronic-itemsbox">
                <div class="electronic-items-text">
                    <h1>Featured Electronics</h1>
                    <p>The Vogal Shopify theme's collection page is best suited for large catalogues.</p><br>
                    <p>The collection page is designed to organize, present, and filter thousands of product catalogues.
                    </p><br><br>
                    <p>Furthermore, Vogal is built with powerful, cutting-edge, carefully written, high-quality code
                        that is ready to use right away.</p>
                    <span>22 item</span>
                    <select name="" id="">
                        <option value="">featured</option>
                        <option value="">best selling</option>
                        <option value="">alhabeticlly A-Z</option>
                        <option value="">alhabeticlly Z-A</option>
                        <option value="">pice , high to low</option>
                        <option value="">pice , low to high</option>
                    </select>
                </div>
                <div id="quickview-wrapper"></div>
                <div class="electronic-item">
                    <?php
                       $select="select *from product";
                       $selected=$connection->query($select);
                       while($pro_image=$selected->fetch_assoc()){
                        $id=$pro_image['id'];   
                        $imagepath1=$pro_image['image'];   
                        $imagepath2=$pro_image['image2']; 
                        $fullname=$pro_image['name'];
                        $price=$pro_image['price'];
                            echo "<div class='product' >";
                           echo" <div class='productimage'>";
                                echo"<img src='$imagepath1'  class='frontface'>";
                               echo"<img src='$imagepath2' class='backface'>";
                           echo " </div>";
                            echo"<div class='producticon'>";
                                echo"<span>";
                                // $user_id = $_SESSION['user_id'];
                                        echo"<button type='submit' class='addwish' id='$id' title='add to wishlist'><i class='fa-regular fa-heart heart'></i></button>";
                                        echo"<button type='submit' class='addcart ' data-product-id='$id'><i class='fa-solid fa-cart-shopping cartbtn' title='Add to cart'></i></a></button>";
                                        echo"<button type='submit' class='quicksearch' id='$id'> <i class='fa-solid fa-magnifying-glass' title='quick view'></i></button>";
                                echo"</span>";
                            echo"</div>";
                            echo"<div class='producttext'>";
                                    echo" <p>$fullname</p>";
                                    echo"<h6>Rs: $price</h6>";
                                    echo"<span>";
                                        echo"<i class='fa-regular fa-star'></i>";
                                        echo"<i class='fa-regular fa-star'></i>";
                                        echo"<i class='fa-regular fa-star'></i>";
                                        echo"<i class='fa-regular fa-star'></i>";
                                        echo"<i class='fa-regular fa-star'></i>";
                                    echo"</span>";
                            echo" </div>";
                        echo" </div>";    
                     
                        }
                    ?>        
                 </div>
            </div>
        </div>
    </div>
    <?php include "footer.html";
    ?>
 <script src="script.js"></script>
 <script src="cart.js"></script>
</body>

</html>