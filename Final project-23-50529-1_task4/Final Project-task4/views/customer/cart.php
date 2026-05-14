<?php
session_start();

require_once "../../config/database.php";

$db = new Database();
$conn = $db->connect();

$cart = $_SESSION['cart'] ?? [];
?>

<h2>🛒 Cart</h2>

<?php foreach($cart as $id => $qty):

$stmt = $conn->prepare("SELECT * FROM products WHERE id=?");
$stmt->execute([$id]);
$p = $stmt->fetch();

$sub = $p['price'] * $qty;
?>

<div class="cart-item">
<b><?= $p['name'] ?></b><br>

<span id="price-<?= $id ?>"><?= $p['price'] ?></span> x

<input type="number" value="<?= $qty ?>"
onchange="updateCartLive(<?= $id ?>, this.value)">

= <span id="sub-<?= $id ?>"><?= $sub ?></span>

<button onclick="removeItemLive(<?= $id ?>)">Remove</button>
</div>

<?php endforeach; ?>

<h3>Total: <span id="total"></span></h3>

<a href="checkout.php">Checkout</a>

<script src="../../public/assets/js/app.js"></script>
<script>updateTotal();</script>