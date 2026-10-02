<?php

include 'header.php';

if(isset($_POST['register'])){

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Check if email already exists
    $check = mysqli_query($conn, 
        "SELECT * FROM users WHERE email='$email'"
    );

    if(mysqli_num_rows($check) > 0){

        echo "<div class='alert alert-danger text-center'>
                Email already exists! Please login.
              </div>";

    } else {

        mysqli_query($conn,
            "INSERT INTO users (name,email,password,role)
             VALUES('$name','$email','$password','user')"
        );

        header("Location: login.php");
        exit();
    }
}
?>

<div class="container mt-5">
<div class="col-md-4 mx-auto">
<h3 class="text-center mb-3">Register</h3>

<form method="POST">

<input type="text" name="name" 
       class="form-control mb-3" 
       placeholder="Name" required>

<input type="email" name="email" 
       class="form-control mb-3" 
       placeholder="Email" required>

<input type="password" name="password" 
       class="form-control mb-3" 
       placeholder="Password" required>

<button type="submit" 
        name="register" 
        class="btn btn-primary w-100">
Register
</button>

</form>
</div>
</div>

<?php include 'footer.php'; ?>