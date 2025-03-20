<?php
session_start();
include "connection.php";

$response = array();

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

                // Calculate total price
                $totalPrice += $price * $quantity;
                $totalItems += $quantity;
                $cartItems[] = array(
                    'id' => $row['id'],
                    'name' => $row['name'],
                    'price' => $price,
                    'image' => $row['image'],
                    'quantity' => $quantity
                );
            }   

            $response['status'] = 'success';
            $response['data'] = $cartItems;
            $response['totalPrice'] = $totalPrice;
            $response['totalItems'] = $totalItems;
        } else {
            $response['status'] = 'error';
            $response['message'] = 'Your cart is empty';
        }

        $stmt->close();
    } else {
        $response['status'] = 'error';
        $response['message'] = 'Database query failed';
    }
} else {
    $response['status'] = 'error';
    $response['message'] = 'Please log in to view the cart';
}

header('Content-Type: application/json');
echo json_encode($response);
?>
