<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="style1.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>header</title>
</head>
<body>
    <?php
    include "connection.php";
?>

    <nav>
    <div class="hamburger-menu">
        <i class="fa-solid fa-bars"></i>
    </div>
        <div class="firstnav">
            <div class="textinfo">
                free shipping on order over rs.500 |<span><i class="fa-solid fa-phone"></i> :
                    +91/9694945359</span>
            </div>
            <div class="btns">
                <span><i class="fa-brands fa-facebook"></i></span>
                <span><i class="fa-brands fa-instagram"></i></span>
                <span><i class="fa-brands fa-youtube"></i></span>
                <span><i class="fa-brands fa-whatsapp"></i></span>
            </div>
        </div>
        <div id="navbars">
            <div class="uppernav">
                <div class="logo">
                    <h1>Ali mart</h1>
                    <div class="support-box">
                        <i class="fa-regular fa-message msg"> </i>
                        <h6>EXPERT SUPPORT
                            <p>available 24/7 via chat</p>
                        </h6>
                    </div>
                </div>
                <div class="searchbar">
                    <form action="">
                        <div class="search"><input type="text" placeholder="search product"></input>
                            <button><i class="fa-solid fa-magnifying-glass search"></i></button>
                    </form>
                </div>
            </div>
            <div class="cart-act-section">
                <div class="cartbox"><a href="./login.php" title="account"><i class="fa-regular fa-user"></i>account</a>
                </div>
                <div class="cartbox"><a href="./show_wishlist.php" title="wishlist"><i
                            class="fa-regular fa-heart"></i>wishlist</a></div>
                <div class="cartbox showCartButton" id="showCartButton"><a class=""><i class="fa-solid fa-cart-shopping"></i>cart</a>
                </div>
            </div>
        </div>
            <div class="mainnav">
            <ul>
                <li>
                    <a href=""><span><i class="fa-solid fa-bars bars"></i></span><span> browsecategories</span>
                        <span><i class="fa-solid fa-chevron-down"></i></span>
                    </a>
                    <div class="dropdown">
                        <ul>
                            <li><a href="">smart watches</a></li>
                            <li><a href="">smart TVs</a></li>
                            <li><a href="">laptop & computers</a></li>
                            <li><a href="">Audio & video</a></li>
                            <li><a href="">molile & tablets</a></li>
                            <li><a href="">camreas</a></li>
                            <li><a href="">video games</a></li>
                            <li><a href="">headphones</a></li>
                        </ul>
                    </div>
                </li>
                <li> <a href=""><span> home</span></a></li>
                <li> <a href=""><span> features</span>
                        <span><i class="fa-solid fa-chevron-down"></i></span>
                    </a>
                    <div class="dropdown">
                        <ul>
                            <li>smart watches</li>
                            <li><a href="">smart TVs</a></li>
                            <li><a href="">laptop & computers</a></li>
                            <li><a href="">Audio & video</a></li>
                            <li><a href="">molile & tablets</a></li>
                            <li><a href="">camreas</a></li>
                            <li><a href="">video games</a></li>
                            <li><a href="">headphones</a></li>
                        </ul>
                    </div>
                </li>
                <li> <a href=""><span> product</span>
                        <span><i class="fa-solid fa-chevron-down"></i></span>
                    </a>
                    <div class="dropdown">
                        <ul>
                            <li>smart watches</li>
                            <li><a href="">smart TVs</a></li>
                            <li><a href="">laptop & computers</a></li>
                            <li><a href="">Audio & video</a></li>
                            <li><a href="">molile & tablets</a></li>
                            <li><a href="">camreas</a></li>
                            <li><a href="">video games</a></li>
                            <li><a href="">headphones</a></li>

                        </ul>
                        <ul>
                            <li>smart watches</li>
                            <li><a href="">smart TVs</a></li>
                            <li><a href="">laptop & computers</a></li>
                            <li><a href="">Audio & video</a></li>
                            <li><a href="">molile & tablets</a></li>
                            <li><a href="">camreas</a></li>
                            <li><a href="">video games</a></li>
                            <li><a href="">headphones</a></li>
                        </ul>
                        <ul>
                            <li>smart watches</li>
                            <li><a href="">smart TVs</a></li>
                            <li><a href="">laptop & computers</a></li>
                            <li><a href="">Audio & video</a></li>
                            <li><a href="">molile & tablets</a></li>
                            <li><a href="">camreas</a></li>
                            <li><a href="">video games</a></li>
                            <li><a href="">headphones</a></li>
                        </ul>
                        <ul>
                            <li>smart watches</li>
                            <li><a href="">smart TVs</a></li>
                            <li><a href="">laptop & computers</a></li>
                            <li><a href="">Audio & video</a></li>
                            <li><a href="">molile & tablets</a></li>
                            <li><a href="">camreas</a></li>
                            <li><a href="">video games</a></li>
                            <li><a href="">headphones</a></li>
                        </ul>
                        <img src="./pictures/sale.jpg" alt="">
                    </div>

                </li>
                <li> <a href=""><span> contact</span>
                        <span><i class="fa-solid fa-chevron-down"></i></span>
                    </a>
                    <div class="dropdown">
                        <ul>
                            <li>contact us</li>
                            <li><a href="">+91/9694945359</a></li>
                            <li><a href="">+91/7340520205</a></li>
                            <li><a href="">alisajid30836@gmail.com</a></li>
                            <li><a href="">ssajid0004@gmail.com</a></li>
                        </ul>
                    </div>
                </li>
                <li><a href=""><span> blog</span></a></li>
                <li><a href=""><span> boy now</span></a></li>

            </ul>
        </div>
        </div>
    </nav>
</body>

</html>