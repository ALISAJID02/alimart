<?php
session_start();
include "connection.php";

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $product_id = $_POST['product_id'];

    $query = "DELETE FROM cart WHERE user_id = ? AND product_id = ?";
    if ($stmt = $connection->prepare($query)) {
        $stmt->bind_param("ii", $user_id, $product_id);
        $stmt->execute();
        $stmt->close();
    }
}

// Optionally send an empty response
header('Content-Type: application/json');
echo json_encode([]);
?>
