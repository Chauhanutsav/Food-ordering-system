<?php 
include 'header.php';

// Start cart session if not exists
if(!isset($_SESSION['cart'])){
    $_SESSION['cart'] = [];
}

// ➕ Add to cart
if(isset($_POST['add'])){

    $id  = (int)$_POST['id'];
    $qty = (int)$_POST['quantity'];

    if($id > 0 && $qty > 0){
        if(isset($_SESSION['cart'][$id])){
            $_SESSION['cart'][$id] += $qty;
        } else {
            $_SESSION['cart'][$id] = $qty;
        }
    }
}

// ❌ Remove item
if(isset($_GET['remove'])){
    $remove_id = (int)$_GET['remove'];
    unset($_SESSION['cart'][$remove_id]);
}
?>

<h3 class="mb-4">🛒 Your Cart</h3>

<?php if(empty($_SESSION['cart'])) { ?>

    <div class="alert alert-warning text-center">
        Your cart is empty.
    </div>

<?php } else { ?>

<form method="POST">

<table class="table table-bordered text-center align-middle">
<tr>
<th>Name</th>
<th>Price</th>
<th>Quantity</th>
<th>Total</th>
<th>Action</th>
</tr>

<?php
$total = 0;

$ids = implode(",", array_keys($_SESSION['cart']));
$res = mysqli_query($conn, "SELECT * FROM menu WHERE id IN ($ids)");

while($row = mysqli_fetch_assoc($res)){

    $id  = $row['id'];
    $qty = $_SESSION['cart'][$id];

    $sub = $row['price'] * $qty;
    $total += $sub;
?>

<tr>
<td><?php echo $row['name']; ?></td>
<td>₹<?php echo $row['price']; ?></td>

<td style="width:160px;">
    <div class="input-group justify-content-center">

        <button type="button"
                class="btn btn-outline-secondary btn-minus">
            −
        </button>

        <input type="text"
               value="<?php echo $qty; ?>"
               class="form-control text-center qty-input"
               data-price="<?php echo $row['price']; ?>"
               readonly
               style="max-width:60px;">

        <button type="button"
                class="btn btn-outline-secondary btn-plus">
            +
        </button>

    </div>
</td>

<td class="item-total">₹<?php echo $sub; ?></td>

<td>
<a href="cart.php?remove=<?php echo $id; ?>"
   class="btn btn-danger btn-sm">
   Remove
</a>
</td>
</tr>

<?php } ?>

</table>

<h4 class="text-end">
Grand Total: ₹<span id="grand-total"><?php echo $total; ?></span>
</h4>

<div class="text-end mt-3">
    <a href="payment.php" class="btn btn-success">
        Proceed to Payment 💳
    </a>
</div>

</form>

<?php } ?>

<div class="text-center mt-4">
    <a href="index.php" class="btn btn-primary btn-lg">
        ➕ Add More Items
    </a>
</div>


<!-- ✅ CLEAN SINGLE SCRIPT -->
<script>

document.querySelectorAll('.btn-plus').forEach(function(button){

    button.addEventListener('click', function(){

        let input = this.parentElement.querySelector('.qty-input');
        let qty = parseInt(input.value);
        input.value = qty + 1;

        updateRow(input);
    });

});

document.querySelectorAll('.btn-minus').forEach(function(button){

    button.addEventListener('click', function(){

        let input = this.parentElement.querySelector('.qty-input');
        let qty = parseInt(input.value);

        if(qty > 1){
            input.value = qty - 1;
            updateRow(input);
        }
    });

});

function updateRow(input){

    let price = parseFloat(input.dataset.price);
    let qty   = parseInt(input.value);

    let row = input.closest('tr');
    let subtotal = price * qty;

    row.querySelector('.item-total').innerText = "₹" + subtotal;

    updateGrandTotal();
}

function updateGrandTotal(){

    let total = 0;

    document.querySelectorAll('.item-total').forEach(function(cell){

        let amount = parseFloat(cell.innerText.replace("₹",""));
        total += amount;

    });

    document.getElementById('grand-total').innerText = total;
}

</script>

<?php include 'footer.php'; ?>