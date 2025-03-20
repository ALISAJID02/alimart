<?php
session_start();

if (isset($_SESSION['user_id']) && isset($_POST['product_id']) && isset($_POST['quantity'])) {
    $user_id = $_SESSION['user_id'];
    $product_id = $_POST['product_id'];
    $quantity = max(1, intval($_POST['quantity'])); // Ensure quantity is at least 1

    // Include or require database connection
    require_once 'connection.php'; // Critical, prefer require_once

    // Check if the product is already in the cart
    $query = "SELECT quantity FROM cart WHERE user_id = ? AND product_id = ?";
    if ($stmt = $connection->prepare($query)) {
        $stmt->bind_param("ii", $user_id, $product_id);
        $stmt->execute();
        $stmt->bind_result($existing_quantity);
        $stmt->fetch();
        $stmt->close();

        if ($existing_quantity) {
            // Overwrite the quantity instead of incrementing
            $new_quantity = $existing_quantity + $quantity;
            $update_query = "UPDATE cart SET quantity = ? WHERE user_id = ? AND product_id = ?";
            if ($update_stmt = $connection->prepare($update_query)) {
                $update_stmt->bind_param("iii", $new_quantity, $user_id, $product_id);
                $update_stmt->execute();
                $update_stmt->close();
            }
        } else {
            // Insert new product into the cart
            $insert_query = "INSERT INTO cart (user_id, product_id, quantity) VALUES (?, ?, ?)";
            if ($insert_stmt = $connection->prepare($insert_query)) {
                $insert_stmt->bind_param("iii", $user_id, $product_id, $quantity);
                $insert_stmt->execute();
                $insert_stmt->close();
            }
        }        
        echo json_encode(["status" => "success", "message" => "Product added to cart successfully."]);
    } else {
        echo json_encode(["status" => "error", "message" => "Failed to prepare query."]);
    }
    $connection->close();
} else {
    echo json_encode(["status" => "error", "message" => "Invalid input."]);
}
?>
