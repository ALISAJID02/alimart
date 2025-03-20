<?php
$response=array();
session_start();
include "connection.php";
if (isset($_POST['product_id']) && isset($_SESSION['user_id'])) {
    $product_id = $_POST['product_id'];
    $user_id = $_SESSION['user_id'];

    // Database connection (replace with your actual connection code)

    // Check if the product is already in the wishlist
    $query = "SELECT COUNT(*) as count FROM wishlist WHERE user_id = ? AND product_id = ?";
    if ($stmt = $connection->prepare($query)) {
        $stmt->bind_param("ii", $user_id, $product_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        if ($row['count'] > 0) {
            // Product is already in the wishlist, remove it
            $query = "DELETE FROM wishlist WHERE user_id = ? AND product_id = ?";
            if ($stmt = $connection->prepare($query)) {
                $stmt->bind_param("ii", $user_id, $product_id);
                $stmt->execute();
                $response['status'] = 'removed';
                $response['message'] = 'Product deleted to wishlist';            }
        } else {
            // Product is not in the wishlist, add it
            $query = "INSERT INTO wishlist (user_id, product_id) VALUES (?, ?)";
            if ($stmt = $connection->prepare($query)) {
                $stmt->bind_param("ii", $user_id, $product_id);
                $stmt->execute();
                $response['status'] = 'added';
                $response['message'] = 'Product added to wishlist';            }
        }
    }
} else {
    $response['status'] = 'error';
    $response['message'] = 'Please log in to add products to the wishlist';
}

header('Content-Type: application/json');
echo json_encode($response);
?>
