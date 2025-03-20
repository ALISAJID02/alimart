<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>

<body class="checkout">
    <div class="checkout_information">
        <span class="checkout_tags">
            <h3>contact</h3><a href="">login</a>
        </span>
        <input type="text" placeholder="Email or mobile phone number">
        <input type="checkbox" id="checkbox">
        <label for="checkbox">Email me with news and offers</label>
        <h3>Delivery</h3>
        <select name="" id="">
            <option value="">india</option>
            <option value="">austrlia</option>
            <option value="">germany</option>
            <option value="">canada</option>
            <option value="">brazil</option>
            <option value="">palestine</option>
            <option value="">pakistan</option>
        </select>
        <input type="text" placeholder="fistname(optional)">
        <input type="text" placeholder="lastname">
        <input type="text" placeholder="company(optional)">
        <input type="text" placeholder="address">
        <input type="text" placeholder="appartment, suite, etc.(optional)">
        <input type="text" placeholder="city">
        <select class="states" name="" id="">
            <option value="">rajasthan</option>
            <option value="">gujrat</option>
            <option value="">madya pradesh</option>
            <option value="">uttar paradesh</option>
            <option value="">bihar</option>
            <option value="">punjab</option>
            <option value="">jammu&kashmir</option>
        </select>
        <input type="text" placeholder="postcode">
        <input type="checkbox" id="saveinfo">
        <label for="saveinfo">Save this information for next time</label>
        <h3>shipping method</h3>
        <div class="shipping">
            <p>Enter your shipping address to view available shipping methods.</p>
        </div>
        <h3>Payment</h3>
        <p>All transactions are secure and encrypted.</p>
        <div class="credit_card">
            <h5>credit card</h5>
            <div class="creditlogo"><img src="./pictures/bogus.CIsYlO1z.svg" alt=""></div>
        </div>
        <div class="checkout_payment">
            <input type="number" placeholder="Card number">
            <input type="text" placeholder="Expiration date (MM / YY)">
            <input type="text" placeholder="security code">
            <input type="text" placeholder="name of card">
            <input type="checkbox" id="add">
            <label for="add">Save this information for next time</label>
        </div>
        <button>Pay now</button>
    </div>
    <div class="checkout_productsdetail">
   <?php 
   include "connection.php"; 
   session_start();
   if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    $query = "SELECT product.id, product.name, product.price, product.image, cart.quantity 
              FROM cart 
              JOIN product ON cart.product_id = product.id 
              WHERE cart.user_id = ?";
    
    if ($stmt = $connection->prepare($query)) {
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $cartItems = array();
            $totalPrice = 0.0;
            $totalItems = 0;

            while ($row = $result->fetch_assoc()) {
                $priceString = str_replace(',', '', $row['price']);
                $price = (float)$priceString;
                $quantity = (int)$row['quantity'];
                $image=$row['image'];
                $name=$row['name'];


                // Calculate total price
                $totalPrice += $price * $quantity;
                $totalItems += $quantity;

        echo"<div class='checkout_product'>
            <div class='checkoutimage'>
                <img src='$image'>
            </div>
            <div class='checkoutname'>
                <span>
                    <h4>$name</h4>
                    <p>White</p>
                </span>
            </div>
            <div class='checkoutproductprice'>₹$price</div>
        </div>";
    }
    }
}
}
$user_id = $_SESSION['user_id'];

    $query = "SELECT product.id, product.name, product.price, product.image, cart.quantity 
              FROM cart 
              JOIN product ON cart.product_id = product.id 
              WHERE cart.user_id = ?";
    
    if ($stmt = $connection->prepare($query)) {
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $cartItems = array();
            $totalPrice = 0.0;
            $totalItems = 0;
            $withtaxes=0;
            $fullprice=0;
            while ($row = $result->fetch_assoc()) {
                $priceString = str_replace(',', '', $row['price']);
                $price = (float)$priceString;
                $quantity = (int)$row['quantity'];
        
                // Calculate total price
                $totalPrice += $price * $quantity;
                $totalItems += $quantity;
            }
                $withtaxes+=($totalPrice*0.18);
                $fullprice+=$totalPrice+$withtaxes;
            
        echo"<input type='text' placeholder='discount code'><button>apply</button>";
        echo"<div class='checkout_totalprice'>
            <div class='checkouttitle'>
                <h6>Subtotal • $totalItems items</h6>
                <h6>Shipping</h6>
                <h6>Estimated taxes</h6>
                <h3>Total</h3>
            </div>
            <div class='checkoutprices'>
                <h6>₹$totalPrice</h6>
                <h6>Free</h6>
                
                <h6>₹$withtaxes</h6>
                <h3>
                    <span>INR</span>
                    ₹$fullprice
                </h3>
            </div>
        </div>";
    }

}

        ?>
    </div>
</body>

</html>