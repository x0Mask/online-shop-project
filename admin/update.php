<?php
include('config.php');

if (isset($_POST['edit'])) {
    $id = intval($_POST['id']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);
    $image = $_FILES['image'];

    $image_location = $image['tmp_name'];
    $image_name = $image['name'];
    $image_up = "../images/" . basename($image_name);

    // Check if a new image was uploaded
    if (!empty($image_name)) {
        $edit_query = "UPDATE products SET name='$name', price='$price', image='$image_up' WHERE id='$id'";
    } else {
        $edit_query = "UPDATE products SET name='$name', price='$price' WHERE id='$id'";
    }

    if (mysqli_query($conn, $edit_query)) {
        if (!empty($image_name)) {
            if (move_uploaded_file($image_location, $image_up)) {
                echo "<script>alert('تم تحديث المنتج بنجاح');</script>";
            } else {
                echo "<script>alert('حدث مشكلة في رفع الصورة');</script>";
            }
        } else {
            echo "<script>alert('تم تحديث المنتج بنجاح');</script>";
        }
        echo "<script>window.location.href = 'products.php';</script>";
        exit();
    } else {
        echo "<script>alert('Error: Could not execute $edit_query. " . mysqli_error($conn) . "');</script>";
    }
}
