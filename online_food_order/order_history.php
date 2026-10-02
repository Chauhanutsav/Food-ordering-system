<?php include 'header.php';

$user=$_SESSION['user'];
$res=mysqli_query($conn,"SELECT * FROM orders WHERE user_id=$user");
?>

<h3>My Orders</h3>
<table class="table table-bordered">
<tr>
<th>ID</th>
<th>Total</th>
<th>Payment</th>

<th>Date</th>
</tr>

<?php while($row=mysqli_fetch_assoc($res)){ ?>
<tr>
<td><?php echo $row['id']; ?></td>
<td>₹<?php echo $row['total']; ?></td>
<td><?php echo $row['payment_method']; ?></td>

<td><?php echo $row['order_date']; ?></td>
</tr>
<?php } ?>
</table>

<?php include 'footer.php'; ?>