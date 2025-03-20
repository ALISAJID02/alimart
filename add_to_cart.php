<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
include "connection.php";

$response = array();

if (isset($_POST['product_id']) && isset($_SESSION['user_id'])) {
    $product_id = $_POST['product_id'];
    $user_id = $_SESSION['user_id'];
// Subtract 1 if a quantity is being added and already includes an extra
$quantity = isset($_POST['quantity']) ? max(1, (int)$_POST['quantity'] - 1) : 1;

    error_log("Received Product ID: $product_id, Quantity: $quantity"); // Debugging log

    // Check if the product is already in the cart
    $check_cart = $connection->prepare("SELECT quantity FROM cart WHERE user_id = ? AND product_id = ?");
    $check_cart->bind_param("ii", $user_id, $product_id);
    $check_cart->execute();
    $result_cart = $check_cart->get_result();

    if ($result_cart->num_rows > 0) {
        // Product exists in the cart, increment its quantity
        $row = $result_cart->fetch_assoc();
        $new_quantity = $row['quantity']+$quantity-1; // Add the input quantity to the existing one

        $update_cart = $connection->prepare("UPDATE cart SET quantity = ? WHERE user_id = ? AND product_id = ?");
        $update_cart->bind_param("iii", $new_quantity, $user_id, $product_id);
        if ($update_cart->execute()) {
            $response['status'] = 'success';
            $response['message'] = 'Product quantity updated in cart';
        } else {
            $response['status'] = 'error';
            $response['message'] = 'Error updating cart: ' . $connection->error;
        }
        $update_cart->close();
    } else {
        // Product is not in the cart, add it with the specified quantity
        $insert_cart = $connection->prepare("INSERT INTO cart (user_id, product_id, quantity) VALUES (?, ?, ?)");
        $insert_cart->bind_param("iii", $user_id, $product_id, $quantity);
        if ($insert_cart->execute()) {
            $response['status'] = 'success';
            $response['message'] = 'Product added to cart';
        } else {
            $response['status'] = 'error';
            $response['message'] = 'Error adding product to cart: ' . $connection->error;
        }
        $insert_cart->close();
    }

    $check_cart->close();
} else {
    $response['status'] = 'error';
    $response['message'] = 'Please log in to add products to the cart';
}

header('Content-Type: application/json');
echo json_encode($response);
?>
