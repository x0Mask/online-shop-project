<?php
session_start();
include('admin/config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $csrf_token = $_POST['csrf_token'];
    if (!isset($_SESSION['csrf_token']) || $csrf_token !== $_SESSION['csrf_token']) {
        die('CSRF token validation failed.');
    }

    if (!isset($_SESSION['user_id'])) {
        die('User not logged in.');
    }

    $user_id = $_SESSION['user_id'];
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = isset($_POST['product_image']) ? $_POST['product_image'] : ''; // Ensure image is retrieved correctly

    // Check if the product is already in the cart
    $result = mysqli_query($conn, "SELECT * FROM cart WHERE user_id = '$user_id' AND product_id = '$product_id'");
    if (mysqli_num_rows($result) > 0) {
        // Update quantity if product already exists in the cart
        $row = mysqli_fetch_assoc($result);
        $new_quantity = $row['quantity'] + 1; // Increment quantity
        mysqli_query($conn, "UPDATE cart SET quantity = '$new_quantity' WHERE user_id = '$user_id' AND product_id = '$product_id'");
    } else {
        // Insert new product into cart
        $insert_query = "INSERT INTO cart (user_id, product_id, name, price, image, quantity) VALUES ('$user_id', '$product_id', '$product_name', '$product_price', '$product_image', 1)";
        mysqli_query($conn, $insert_query);
    }

    header('Location: index.php'); // Redirect back to the index page
    exit(); // Ensure script stops execution
}
?>
