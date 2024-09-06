<?php

include('config.php');

$id = $_GET['id'];

// First, delete related entries in the cart table
mysqli_query($conn, "DELETE FROM cart WHERE product_id=$id");

// Then delete the product
mysqli_query($conn, "DELETE FROM products WHERE id=$id");
header('Location: products.php');
