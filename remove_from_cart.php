<?php
session_start();
include('admin/config.php');

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id'])) {
    if (!isset($_SESSION['user_id'])) {
        die('User not logged in.');
    }

    $user_id = $_SESSION['user_id'];
    $product_id = $_GET['id'];

    $delete_query = "DELETE FROM cart WHERE user_id = '$user_id' AND product_id = '$product_id'";
    mysqli_query($conn, $delete_query);

    header('Location: index.php'); // Redirect back to the index page
}
?>
