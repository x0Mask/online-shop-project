<?php
include('config.php');

if (isset($_POST['upload'])) {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $image = $_FILES['image'];
    $image_location = $_FILES['image']['tmp_name'];
    $image_name = $_FILES['image']['name'];
    $image_up = "../images/" . $image_name;
    $insert_query = "INSERT INTO `products`(`name`, `price`, `image`) VALUES ('$name','$price','$image_up')";

    if (mysqli_query($conn, $insert_query)) {
        if (move_uploaded_file($image_location, $image_up)) {
            // Display success alert using JavaScript
            echo "<script>alert('تم رفع المنتج بنجاح');</script>";

            // Redirect to index.php after showing the alert
            echo "<script>window.location.href = 'index.php';</script>";
            exit();
        } else {
            echo "<script>alert('حدث مشكلة, لم يتم رفع المنتج');</script>";
        }
    } else {
        echo "<script>alert('Error: Could not execute $insert_query. " . mysqli_error($conn) . "');</script>";
    }
}
