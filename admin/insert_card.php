<?php
include('config.php');

if (isset($_POST['add'])) {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $insert = "INSERT INTO addcard (name, price) VALUES ('$name', '$price')";
    mysqli_query($conn, $insert);
    header('Location: card.php');
}
