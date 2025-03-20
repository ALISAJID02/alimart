<?php
session_start();
include "connection.php";

if (isset($_SESSION['user_id']) && isset($_POST['product_id'])) {
    $user_id = $_SESSION['user_id'];
    $product_id = $_POST['product_id'];

    $query = "UPDATE cart SET quantity = quantity + 1 WHERE user_id = ? AND product_id = ?";
    if ($stmt = $connection->prepare($query)) {
        $stmt->bind_param("ii", $user_id, $product_id);
        $stmt->execute();
        $stmt->close();
    }
}

header('Content-Type: application/json');
echo json_encode(['status' => 'success']);
?>
