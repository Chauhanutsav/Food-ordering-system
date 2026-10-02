<?php
include '../config.php';

if($_SESSION['role'] != "admin"){
    header("Location: ../index.php");
    exit();
}

if(isset($_POST['submit'])){

    $name = $_POST['name'];
    $price = $_POST['price'];

    $image = $_FILES['image']['name'];
    $tmp = $_FILES['image']['tmp_name'];

    move_uploaded_file($tmp, "../images/".$image);

    mysqli_query($conn,
    "INSERT INTO menu (name,price,image)
     VALUES('$name','$price','$image')");

    header("Location: dashboard.php");
    exit();
}

include '../header.php';
?>

<h2>Add New Food Item</h2>

<form method="POST" enctype="multipart/form-data">

<input type="text" name="name" class="form-control mb-3" placeholder="Food Name" required>

<input type="number" name="price" class="form-control mb-3" placeholder="Price" required>

<input type="file" name="image" class="form-control mb-3" required>

<button type="submit" name="submit" class="btn btn-success">
Add Item
</button>

</form>

<?php include '../footer.php'; ?>