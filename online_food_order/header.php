<?php include 'config.php'; ?>
<!DOCTYPE html>
<html>
<head>
<title>FoodApp - Order Delicious Food</title>

<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="assets/style.css">

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
<div class="container">

<a class="navbar-brand" href="index.php">
🍽️ FoodApp
</a>

<!-- Show Search Only on index.php -->
<?php if(basename($_SERVER['PHP_SELF']) == "index.php") { ?>

<form method="GET" action="index.php" class="d-flex mx-auto" style="width:40%;">
    <input type="text" 
           name="search" 
           class="form-control form-control-sm me-2" 
           placeholder="Search food..."
           value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
    <button class="btn btn-warning btn-sm">Search</button>
</form>

<?php } ?>

<div>

<?php if(isset($_SESSION['user'])) { ?>

<a href="/online_food_order/cart.php" class="btn btn-warning btn-sm me-2">
🛒 Cart
</a>

<a href="/online_food_order/order_history.php" class="btn btn-info btn-sm me-2">
📦 Orders
</a>

<?php if($_SESSION['role']=="admin"){ ?>
<a href="/online_food_order/admin/dashboard.php" class="btn btn-danger btn-sm me-2">
⚙ Admin
</a>
<?php } ?>

<a href="/online_food_order/logout.php" class="btn btn-light btn-sm">
Logout
</a>

<?php } else { ?>

<a href="/online_food_order/login.php" class="btn btn-success btn-sm me-2">
Login
</a>

<a href="/online_food_order/register.php" class="btn btn-primary btn-sm">
Register
</a>

<?php } ?>

</div>

</div>
</nav>

<div class="container mt-4">