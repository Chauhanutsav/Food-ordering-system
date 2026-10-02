<?php include 'header.php'; ?>


<div class="text-center mb-5">
    <h2 class="fw-bold">🍴 Explore Delicious Food</h2>
    <p class="text-muted">Fresh • Fast • Affordable</p>
</div>


<div class="row">

<?php


if(isset($_GET['search']) && $_GET['search'] != ""){
    $search = mysqli_real_escape_string($conn, $_GET['search']);
    $result = mysqli_query($conn,
        "SELECT * FROM menu WHERE name LIKE '%$search%'");
} else {
    $result = mysqli_query($conn,"SELECT * FROM menu");
}


if(mysqli_num_rows($result) > 0){

    while($row = mysqli_fetch_assoc($result)){
?>

        <div class="col-md-3 mb-4">
            <div class="card h-100 shadow-lg">

                
               <img src="images/<?php echo $row['image']; ?>" 
     class="card-img-top"
     height="220"
     style="object-fit:cover;"
     alt="<?php echo $row['name']; ?>">
                
                <div class="card-body text-center p-4">

                    <h5 class="mb-2 fw-semibold">
                        <?php echo $row['name']; ?>
                    </h5>

                    <p class="text-muted small">
                        <?php echo $row['description']; ?>
                    </p>

                    <h5 class="text-success mb-3 fw-bold">
                        ₹<?php echo $row['price']; ?>
                    </h5>

                    <?php if(isset($_SESSION['user'])) { ?>

                        <form method="POST" action="cart.php">

                            <input type="hidden" 
                                   name="id" 
                                   value="<?php echo $row['id']; ?>">

                            <input type="number" 
                                   name="quantity" 
                                   value="1" 
                                   min="1" 
                                   class="form-control mb-3">

                            <button name="add" 
                                    class="btn btn-success w-100">
                                Add to Cart
                            </button>

                        </form>

                    <?php } else { ?>

                        <a href="login.php" 
                           class="btn btn-primary w-100">
                            Login to Order
                        </a>

                    <?php } ?>

                </div>

            </div>
        </div>

<?php
    }
} else {
    echo "
    <div class='col-12'>
        <div class='alert alert-warning text-center'>
            No food items found.
        </div>
    </div>";
}
?>

</div>

<?php include 'footer.php'; ?>