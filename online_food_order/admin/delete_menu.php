<?php
include '../config.php';

if($_SESSION['role'] != "admin"){
    header("Location: ../index.php");
    exit();
}

$id = $_GET['id'];

mysqli_query($conn,"DELETE FROM menu WHERE id=$id");

header("Location: dashboard.php");
exit();
?>