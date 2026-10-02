<?php include 'header.php';

if(isset($_POST['login'])){
$email=$_POST['email'];
$password=$_POST['password'];

$res=mysqli_query($conn,"SELECT * FROM users WHERE email='$email'");
$user=mysqli_fetch_assoc($res);

if($user && password_verify($password,$user['password'])){
$_SESSION['user']=$user['id'];
$_SESSION['role']=$user['role'];
header("Location: index.php");
}else{
echo "<div class='alert alert-danger'>Invalid Login</div>";
}
}
?>

<div class="col-md-4 mx-auto">
<h3>Login</h3>
<form method="POST">
<input type="email" name="email" class="form-control mb-2" required>
<input type="password" name="password" class="form-control mb-2" required>
<button name="login" class="btn btn-success w-100">Login</button>
</form>
</div>

<?php include 'footer.php'; ?>