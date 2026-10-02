<?php include '../config.php';

if($_SESSION['role']!="admin"){
header("Location: ../index.php");
exit();
}

$res=mysqli_query($conn,"SELECT * FROM orders");
?>

<h3>All Orders</h3>
<table class="table table-bordered">
<tr>
<th>ID</th>
<th>User</th>
<th>Total</th>
<th>Status</th>
</tr>

<?php while($row=mysqli_fetch_assoc($res)){ ?>
<tr>
<td><?php echo $row['id']; ?></td>
<td><?php echo $row['user_id']; ?></td>
<td>₹<?php echo $row['total']; ?></td>
<td><?php echo $row['order_status']; ?></td>
</tr>
<?php } ?>
</table>