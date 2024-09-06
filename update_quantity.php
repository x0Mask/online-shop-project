<?php
session_start();
include('admin/config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    $csrf_token = $data['csrf_token'];
    if (!isset($_SESSION['csrf_token']) || $csrf_token !== $_SESSION['csrf_token']) {
        echo json_encode(['success' => false, 'message' => 'CSRF token validation failed.']);
        exit();
    }

    if (!isset($_SESSION['user_id'])) {
        echo json_encode(['success' => false, 'message' => 'User not logged in.']);
        exit();
    }

    $user_id = $_SESSION['user_id'];
    $product_id = $data['product_id'];
    $quantity = $data['quantity'];

    // Update quantity in cart
    $update_query = "UPDATE cart SET quantity = '$quantity' WHERE user_id = '$user_id' AND product_id = '$product_id'";
    mysqli_query($conn, $update_query);

    // Calculate new total price
    $result = mysqli_query($conn, "SELECT price FROM cart WHERE user_id = '$user_id' AND product_id = '$product_id'");
    $item = mysqli_fetch_assoc($result);
    $new_total = $item['price'] * $quantity;

    // Calculate cart total
    $cart_result = mysqli_query($conn, "SELECT SUM(price * quantity) AS cart_total FROM cart WHERE user_id = '$user_id'");
    $cart_total = mysqli_fetch_assoc($cart_result)['cart_total'];

    echo json_encode(['success' => true, 'new_total' => $new_total, 'cart_total' => $cart_total]);
}
?>
