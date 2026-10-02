<?php


if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


$conn = mysqli_connect("localhost","root","","food_order_db");

if (!$conn) {
    die("Database Connection Failed: " . mysqli_connect_error());
}

?>