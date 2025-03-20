<?php
session_start();
include "connection.php";

$response = array();

if (isset($_POST['product_id']) && isset($_SESSION['user_id'])) {
    $product_id = $_POST['product_id'];
    $user_id = $_SESSION['user_id'];

    // Delete the product from the wishlist
    $query = "DELETE FROM wishlist WHERE user_id = ? AND product_id = ?";
    if ($stmt = $connection->prepare($query)) {
        $stmt->bind_param("ii", $user_id, $product_id);
        if ($stmt->execute()) {
            $response['status'] = 'success';
            $response['message'] = 'Product removed from wishlist';
        } else {
            $response['status'] = 'error';
            $response['message'] = 'Error removing product from wishlist';
        }
        $stmt->close();
    } else {
        $response['status'] = 'error';
        $response['message'] = 'Failed to prepare database query';
    }
} else {
    $response['status'] = 'error';
    $response['message'] = 'Invalid request';
}

header('Content-Type: application/json');
echo json_encode($response);
?>
