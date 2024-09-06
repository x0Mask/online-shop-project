<?php

$servername = "mysql";
$user = "sql_user";
$password = "sql_password";
$db = "shopdb";

$conn = new mysqli($servername, $user, $password, $db);

if ($conn->connect_error) {
    die("Connection Failed: " . $conn->connect_error);
}
