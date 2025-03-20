<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="style1.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500&display=swap" rel="stylesheet">
    <title>ali mart</title>
   <style>
    
</style>
 
</head>
<body>
<?php    
session_start();
include "header.php";

?>
<div id="message-alert" style="display: none; position: fixed; top: 10px; right: 655px; z-index: 10000; padding: 10px; border-radius: 5px; background-color: #333; color: #fff;"></div>

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
<div class="alert"></div>
    <div class="slider">
        <div class="slides"><img src="./pictures/pic2.jpg" alt=""></div>
        <div class="slides"><img src="./pictures/pic.jpg" alt=""></div>
        <div class="slidebtn">
            <span class="sliderbtn first" onclick="goPre()">&#10094;</span>
            <span class="sliderbtn second" onclick="goNext()">&#10095;</span>
        </div>
    </div>
    <div class="topproducts">
        <div class="bigproduct">
            <img src="./pictures/mobile-bnr.jpg" alt="" title="Galaxy S22 Ultra">
            <div class="topproducttext">
                <h1>galaxy s22 ultra</h1>
                <p>makes night epic with nighography</p>
                <button>get 10% off</button>
            </div>
        </div>
        <div class="smallproducts">
            <div class="smallproduct">
                <img src="./pictures/projectore.jpg" alt="" title="Porjectors">
                <div class="smallproducttext">
                    <h3>porjectors</h3>
                    <p>4k ultra hd with 8 million pixels</p>
                </div>
            </div>
            <div class="smallproduct">
                <img src="./pictures/soundbars.jpg" alt="" title="Soundbars">
                <div class="smallproducttext">
                    <h3>soundbars</h3>
                    <p>with wireless subwoofer for extra deep bass</p>
                </div>
            </div>
            <div class="smallproduct">
                <img src="./pictures/speecker.jpg" alt="" title="Bluetooth Speaker">
                <div class="smallproducttext">
                    <h3>bluetooth speaker</h3>
                    <p>feather light, ultra-poratable grab-and-go design</p>
                </div>
            </div>
            <div class="smallproduct">
                <img src="./pictures/game.jpg" alt="" title="Video Game">
                <div class="smallproducttext">
                    <h3>video game</h3>
                    <p>flat 25% off on childern's day</p>
                </div>
            </div>
        </div>
    </div>
    <div class="section-topproducts">
        <h2>new product</h2>
        <div id="quickview-wrapper">
        </div>
        <?php
        include "connection.php";
$select = "SELECT * FROM product LIMIT 10";
$selected = $connection->query($select);

while ($pro_image = $selected->fetch_assoc()) {
    $id = $pro_image['id'];   
    $imagepath1 = $pro_image['image'];   
    $imagepath2 = $pro_image['image2']; 
    $fullname = $pro_image['name'];
    $price = $pro_image['price'];

    echo "<div class='product'>";

    // Product Images
    echo "<div class='productimage'>";
    echo "<img src='$imagepath1' class='frontface'>";
    echo "<img src='$imagepath2' class='backface'>";
    echo "</div>";

    // Product Icons (Wishlist, Cart, Quick View)
    echo "<div class='producticon'>";
    echo "<span>";
    if (isset($_SESSION['user_id'])) {
        // User is logged in
        $user_id = $_SESSION['user_id'];
        $query = "SELECT COUNT(*) as count FROM wishlist WHERE user_id = ? AND product_id = ?";
        $stmt = $connection->prepare($query);
        $stmt->bind_param("ii", $user_id, $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
    
        if ($row['count'] > 0) {
            // Product is already in the wishlist
            echo "<button type='button'  class='addwish added' id='$id' title='Added to wishlist' id='wishlist-button'>
                    <i class='fa-solid fa-heart heart'></i>
                  </button>";
        } else {
            // Product is not in the wishlist
            echo "<button type='button'  class='addwish' id='$id' title='Add to wishlist' id='wishlist-button'>
                        <i class='fa-regular fa-heart heart'></i>
                    </button>";
            }
        } else {
            // User is not logged in
            echo "<button type='button'  class='addwish' id='$id' title='Log in to add to wishlist'  id='wishlist-button'>
                    <i class='fa-regular fa-heart heart'></i>
                </button>";
        }
        
        // Add to Cart Button
    echo "<button type='submit' class='addcart' data-product-id='$id'><i class='fa-solid fa-cart-shopping cartbtn' title='Add to cart'></i></button>";

    // Quick View Button
    echo "<button type='submit' class='quicksearch' id='$id'><i class='fa-solid fa-magnifying-glass' title='Quick view'></i></button>";

    echo "</span>";
    echo "</div>";

    // Product Text (Name, Price, Rating)
    echo "<div class='producttext'>";
    echo "<p>$fullname</p>";
    echo "<h6>Rs: $price</h6>";
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
?>
    </div>
    <div class="viewall"><button class="view-all-btn"><a href="electronics.php">view all</a></button></div>
    <div class="category-section">
        <div class="slidebtn">
            <span class="sliderbtn first catbtn" onclick="catpre()">&#10094;</span>
            <span class="sliderbtn second" onclick="catnext()">&#10095;</span>
        </div>
        <h2>Shop by Categories</h2>
        <div class="cat-products">
            <div class="category-product">
                <div class="categoryimage">
                    <img src="./pictures/headphones.jpg" alt="">
                </div>
                <h4>video game</h4>
            </div>
            <div class="category-product">
                <div class="categoryimage">
                    <img src="./pictures/soundbar.jpg" alt="">
                </div>
                <h4>video game</h4>
            </div>
            <div class="category-product">
                <div class="categoryimage">
                    <img src="./pictures/mobile.jpg" alt="">
                </div>
                <h4>video game</h4>
            </div>
            <div class="category-product">
                <div class="categoryimage">
                    <img src="./pictures/tv.jpg" alt="">
                </div>
                <h4>video game</h4>
            </div>
            <div class="category-product">
                <div class="categoryimage">
                    <img src="./pictures/headphone3.jpg" alt="">
                </div>
                <h4>video game</h4>
            </div>
            <div class="category-product">
                <div class="categoryimage">
                    <img src="./pictures/headphone3.jpg" alt="">
                </div>
                <h4>video game</h4>
            </div>
            <div class="category-product">
                <div class="categoryimage">
                    <img src="./pictures/headphone3.jpg" alt="">
                </div>
                <h4>video game</h4>
            </div>
            <div class="category-product">
                <div class="categoryimage">
                    <img src="./pictures/headphone3.jpg" alt="">
                </div>
                <h4>video game</h4>
            </div>
        </div>
    </div>
    <div class="two-offer-poster">
        <div class="bestdeal">
            <img src="./pictures/pic8.jpg" alt="">
            <div class="bestdealtext">
                <h5>up to - 30% off</h5>
                <h1>wireless headphones</h1>
                <span>shop now</span>
            </div>
        </div>
        <div class="bestdeal">
            <img src="./pictures/pic7.jpg" alt="">
            <div class="bestdealtext audiotxt">
                <h1>professional audio</h1>
                <h5>get the best deal</h5>
                <span>shop now</span>
            </div>
        </div>
    </div>
    <div class="brand-section">
        <div class="slidebtn">
            <span class="sliderbtn first" onclick="brandpre()">&#10094;</span>
            <span class="sliderbtn second" onclick="brandnext()">&#10095;</span>
        </div>
        <h2>Brands we distribute</h2>
        <div class="brand-product">
            <div class="brand-product-container">
                <div class="brand-image"><img src="./pictures/logo.jpg" alt=""></div>
            </div>
            <div class="brand-product-container">
                <div class="brand-image"><img src="./pictures/logo1.jpg" alt=""></div>
            </div>
            <div class="brand-product-container">
                <div class="brand-image"><img src="./pictures/logo2.jpg" alt=""></div>
            </div>
            <div class="brand-product-container">
                <div class="brand-image"><img src="./pictures/logo3.jpg" alt=""></div>
            </div>
            <div class="brand-product-container">
                <div class="brand-image"><img src="./pictures/logo4.jpg" alt=""></div>
            </div>
            <div class="brand-product-container">
                <div class="brand-image"><img src="./pictures/logo5.jpg" alt=""></div>
            </div>
            <div class="brand-product-container">
                <div class="brand-image"><img src="./pictures/logo6.jpg" alt=""></div>
            </div>
            <div class="brand-product-container">
                <div class="brand-image"><img src="./pictures/logo6.jpg" alt=""></div>
            </div>
            <div class="brand-product-container">
                <div class="brand-image"><img src="./pictures/logo6.jpg" alt=""></div>
            </div>
            <div class="brand-product-container">
                <div class="brand-image"><img src="./pictures/logo6.jpg" alt=""></div>
            </div>
            <div class="brand-product-container">
                <div class="brand-image"><img src="./pictures/logo6.jpg" alt=""></div>
            </div>
        </div>
    </div>
    <div class="laptop-accessories-section">
        <div class="laptop-poster">
            <div class="laptop-image"><img src="./pictures/laptop-accesories.jpg" alt=""></div>
            <div class="laptop-text">
                <h1>laptop & accessories</h1>
                <p>flash sale.flat 30% off!! this week only</p>
                <button>shop now</button>
            </div>
        </div>
        <div class="laptop-sale-product">
        <?php
       $select="select *from product LIMIT 6";
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
    <div class="watch-poster-section">
        <img src="./pictures/pic6.jpg" alt="">
        <div class="watch-text">
            <h4>time to be smarter</h4>
            <h1>exclusive smart watch</h1>
            <h2>bigger. bolder. better</h2>
            <button>get 20% off now</button>
        </div>
    </div>
    <div class="latest-blog-section">
        <div class="slidebtn">
            <span class="sliderbtn first" onclick=" blogpre()">&#10094;</span>
            <span class="sliderbtn second" onclick=" blognext()">&#10095;</span>
        </div>
        <div class="latest-products-container">
            <h1 class="latest-blog">latest blog</h1>
            <div class="latest cont">
                <div class="latest-blog-product">
                    <div class="latest-blog-image"><img src="./pictures/pic3.jpg" alt=""></div>
                    <h1>undarstanding the lastest TV techonology</h1>
                    <h6>date <span>name</span></h6>
                    <span><button>digital</button><button>tv</button></span>
                </div>
            </div>
            <div class="latest cont">
                <div class="latest-blog-product">
                    <div class="latest-blog-image"><img src="./pictures/pic4.jpg" alt=""></div>
                    <h1>undarstanding the lastest TV techonology</h1>
                    <h6>date <span>name</span></h6>
                    <span><button>digital</button><button>tv</button></span>
                </div>
            </div>
            <div class="latest cont">
                <div class="latest-blog-product">
                    <div class="latest-blog-image"><img src="./pictures/pic5.jpg" alt=""></div>
                    <h1>undarstanding the lastest TV techonology</h1>
                    <h6>date <span>name</span></h6>
                    <span><button>digital</button><button>tv</button></span>
                </div>
            </div>
            <div class="latest cont">
                <div class="latest-blog-product">
                    <div class="latest-blog-image"><img src="./pictures/pic3.jpg" alt=""></div>
                    <h1>undarstanding the lastest TV techonology</h1>
                    <h6>date <span>name</span></h6>
                    <span><button>digital</button><button>tv</button></span>
                </div>
            </div>
            <div class="latest cont">
                <div class="latest-blog-product">
                    <div class="latest-blog-image"><img src="./pictures/pic3.jpg" alt=""></div>
                    <h1>undarstanding the lastest TV techonology</h1>
                    <h6>date <span>name</span></h6>
                    <span><button>digital</button><button>tv</button></span>
                </div>
            </div>
            <div class="latest cont">
                <div class="latest-blog-product">
                    <div class="latest-blog-image"><img src="./pictures/pic3.jpg" alt=""></div>
                    <h1>undarstanding the lastest TV techonology</h1>
                    <h6>date <span>name</span></h6>
                    <span><button>digital</button><button>tv</button></span>
                </div>
            </div>
        </div>
        <div class="about-section">
            <div class="about">
                <i class="fa-solid fa-box-open abt"></i>
                <h6>free delivery</h6>
                <p>for all order over rs.500</p>
            </div>
            <div class="about"> <i class="fa-solid fa-box-open abt"></i>
                <h6>free delivery</h6>
                <p>for all order over rs.500</p>
            </div>
            <div class="about"> <i class="fa-solid fa-box-open abt"></i>
                <h6>free delivery</h6>
                <p>for all order over rs.500</p>
            </div>
            <div class="about"> <i class="fa-solid fa-box-open abt"></i>
                <h6>free delivery</h6>
                <p>for all order over rs.500</p>
            </div>
        </div>
    </div>
   
    <!-- <script src="copy alimart/script.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script> -->
    <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <?php 
    include "footer.html";
    ?>
        <script src="script.js"></script>
        <script src="jscript.js"></script>
        <script src="add_wishlist.js"></script>

</body>

</html>