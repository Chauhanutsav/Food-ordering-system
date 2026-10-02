<?php 
include '../config.php';

if($_SESSION['role'] != "admin"){
    header("Location: ../index.php");
    exit();
}

include '../header.php';
?>

<h2 class="mt-4">⚙ Admin - Manage Menu</h2>

<a href="add_menu.php" class="btn btn-success mb-3">
➕ Add New Item
</a>

<table class="table table-bordered text-center">
<tr>
<th>ID</th>
<th>Image</th>
<th>Name</th>
<th>Price</th>
<th>Action</th>
</tr>

<?php
$result = mysqli_query($conn,"SELECT * FROM menu");

while($row = mysqli_fetch_assoc($result)){
?>

<tr>
<td><?php echo $row['id']; ?></td>

<td>
<img src="../images/<?php echo $row['image']; ?>" 
     width="80" height="60" 
     style="object-fit:cover;border-radius:10px;">
</td>

<td><?php echo $row['name']; ?></td>
<td>₹<?php echo $row['price']; ?></td>

<td>
<a href="edit_menu.php?id=<?php echo $row['id']; ?>" 
   class="btn btn-warning btn-sm">Edit</a>

<a href="delete_menu.php?id=<?php echo $row['id']; ?>" 
   class="btn btn-danger btn-sm"
   onclick="return confirm('Delete this item?');">
Delete
</a>
</td>

</tr>

<?php } ?>

</table>

<?php include '../footer.php'; ?>