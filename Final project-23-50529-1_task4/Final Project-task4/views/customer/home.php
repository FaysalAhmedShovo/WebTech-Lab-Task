<?php
session_start();
require_once "../../config/database.php";

$db = new Database();
$conn = $db->connect();

$products = $conn->query("SELECT * FROM products");
?>

<h2>🛍️ Products</h2>

<div class="search-box">
<input id="search" onkeyup="searchProducts()" placeholder="Search">
<input id="min" type="number" placeholder="Min">
<input id="max" type="number" placeholder="Max">
</div>

<div id="product-list">

<?php foreach($products as $p){ ?>
<div class="card">
<h4><?= $p['name'] ?></h4>
<p>💰 <?= $p['price'] ?> ৳</p>

<img src="../../public/uploads/products/<?= $p['image_path'] ?>">

<br>
<a href="product_details.php?id=<?= $p['id'] ?>">View</a><br>
<button onclick="addToCart(<?= $p['id'] ?>)">Add to Cart</button>
</div>
<?php } ?>

</div>

<script src="../../public/assets/js/app.js"></script>