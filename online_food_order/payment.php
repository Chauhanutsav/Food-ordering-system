<?php 
include 'header.php';

if(!isset($_SESSION['user'])){
    header("Location: login.php");
    exit();
}

if(!isset($_SESSION['cart']) || empty($_SESSION['cart'])){
    echo "<div class='alert alert-warning'>Cart is empty</div>";
    include 'footer.php';
    exit();
}

if(isset($_POST['pay'])){

    $user_id = (int)$_SESSION['user'];
    $method = mysqli_real_escape_string($conn, $_POST['method']);
    $total = 0;

    // Insert order first
    $insert_order = mysqli_query($conn,
        "INSERT INTO orders (user_id,total,payment_method,payment_status)
         VALUES ($user_id,0,'$method','Paid')"
    );

    if(!$insert_order){
        die("Order Insert Failed");
    }

    $order_id = mysqli_insert_id($conn);

    foreach($_SESSION['cart'] as $id => $qty){

        $id = (int)$id;
        $qty = (int)$qty;

        if($id <= 0 || $qty <= 0){
            continue;
        }

        $res = mysqli_query($conn,
            "SELECT price FROM menu WHERE id=$id"
        );

        if($res && mysqli_num_rows($res) > 0){

            $row = mysqli_fetch_assoc($res);

            $price = (float)$row['price'];
            $sub = $price * $qty;

            $total += $sub;

            mysqli_query($conn,
                "INSERT INTO order_items (order_id,menu_id,quantity)
                 VALUES ($order_id,$id,$qty)"
            );
        }
    }

    mysqli_query($conn,
        "UPDATE orders SET total=$total WHERE id=$order_id"
    );

    unset($_SESSION['cart']);

    header("Location: order_history.php");
    exit();
}
?>

<h3>Payment</h3>

<form method="POST">
    <select name="method" class="form-select mb-3" required>
        <option value="">Select Payment Method</option>
        <option>Cash on Delivery</option>
        <option>UPI</option>
        <option>Credit Card</option>
    </select>

    <button name="pay" class="btn btn-success">Confirm Payment</button>
</form>

<?php include 'footer.php'; ?>