<?php

include('config.php');

$id = $_GET['id'];
mysqli_query($conn, "DELETE FROM addcard WHERE id=$id");
header('Location: card.php');