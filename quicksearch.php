<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <title>Document</title>
</head>
<body>

<?php
include "connection.php";
$searchdata=$_POST['term'];
$insertquick="insert into quick values('$searchdata')";
if($connection->query($insertquick)){

$select="select *from quick";
$quickselect=$connection->query($select);
while($getid=$quickselect->fetch_assoc()){
     $id=$getid['id'];      
// echo $id;
$selectquick="select *from product where id='$id'";
$sqlconnection=$connection->query($selectquick);
// if($selected){
while($pro_image=$sqlconnection->fetch_assoc()){
 $id=$pro_image['id'];   
 $imagepath1=$pro_image['image'];   
 $imagepath2=$pro_image['image2']; 
 $imagepath3=$pro_image['image3']; 
 $imagepath4=$pro_image['image4']; 
 $imagepath5=$pro_image['image5']; 
 $fullname=$pro_image['fullname'];
 $sortname=$pro_image['name'];
 $prodetail=$pro_image['product_details'];
 $price=$pro_image['price'];
//  echo $price;

};
$output="";

 $output= "<div class='quickview-wrapper'>
                <div class='quick-view'>
                <i class='fa-solid fa-xmark close-quick' id='$id'></i>
                 <div class='swiper mySwiper'>
        <div class='swiper-wrapper'>
            <div class='swiper-slide'><img src='$imagepath1'></div>
            <div class='swiper-slide'><img src='$imagepath2'></div>
            <div class='swiper-slide'><img src='$imagepath3'></div>
            <div class='swiper-slide'><img src='$imagepath4'></div>
            <div class='swiper-slide'><img src='$imagepath5'></div>
        </div>
        <div class='swiper-button-next'></div>
        <div class='swiper-button-prev'></div>
    </div>
                    <div class='quick-view-text'>
                    <p>$sortname</p>
                    <h1>$fullname</h1>
                    <h6>Rs.$price</h6>
                    <p> $prodetail</p>
                    <div class='quick-view-quantity-box'><button class='minusbtn'>-</button><input type=''
                            value='1' id='counter' class='quantity-input'><button class='plusbtn'>+</button>
                    </div>
                    <div class='quickview-wishlist addwish 'id='$id'><i class='fa-regular fa-heart' id='wishlist-button'></i>Add to wishlist</div>
                    <button class='addcart addcart-with-quantity' data-product-id='$id'>Add to cart</button>
                    <a href=''>view more details<i class='fa-solid fa-arrow-right'></i></a>
                </div>
            </div>
        </div>";
        echo $output;
        $delete="delete from quick";
        $deleted=$connection->query($delete);
}
}
// }
// }
// }

        ?>  
            <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
        <script src="script.js"></script>
        </body>
</html>