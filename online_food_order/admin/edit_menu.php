<?php
include '../config.php';

if($_SESSION['role'] != "admin"){
    header("Location: ../index.php");
    exit();
}

$id = $_GET['id'];

$result = mysqli_query($conn,"SELECT * FROM menu WHERE id=$id");
$row = mysqli_fetch_assoc($result);

if(isset($_POST['update'])){

    $name = $_POST['name'];
    $price = $_POST['price'];

    if($_FILES['image']['name']!=""){

        $image = $_FILES['image']['name'];
        $tmp = $_FILES['image']['tmp_name'];

        move_uploaded_file($tmp, "../images/".$image);

        mysqli_query($conn,
        "UPDATE menu SET name='$name',
        price='$price',
        image='$image'
        WHERE id=$id");

    } else {

        mysqli_query($conn,
        "UPDATE menu SET name='$name',
        price='$price'
        WHERE id=$id");
    }

    header("Location: dashboard.php");
    exit();
}

include '../header.php';
?>

<h2>Edit Food Item</h2>

<form method="POST" enctype="multipart/form-data">

<input type="text" name="name"
       value="<?php echo $row['name']; ?>"
       class="form-control mb-3" required>

<input type="number" name="price"
       value="<?php echo $row['price']; ?>"
       class="form-control mb-3" required>

<input type="file" name="image" class="form-control mb-3">

<button type="submit" name="update"
        class="btn btn-primary">
Update Item
</button>

</form>

<?php include '../footer.php'; ?>