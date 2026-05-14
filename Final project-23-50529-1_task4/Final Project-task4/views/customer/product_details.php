<?php
session_start();
require_once "../../config/database.php";
require_once "../../models/Review.php";

$db = new Database();
$conn = $db->connect();

$id = $_GET['id'];

$stmt = $conn->prepare("SELECT * FROM products WHERE id=?");
$stmt->execute([$id]);
$p = $stmt->fetch();

$reviewModel = new Review($conn);
$reviews = $reviewModel->getByProduct($id);
?>

<h2><?= $p['name'] ?></h2>
<p><?= $p['description'] ?></p>
<p>Price: <?= $p['price'] ?></p>

<button onclick="addToCart(<?= $p['id'] ?>)">Add to Cart</button>

<hr>

<h3>Reviews</h3>

<?php foreach($reviews as $r){ ?>
<div>
<b><?= $r['reviewer_name'] ?></b>:
<?= $r['comment'] ?>

<?php if(isset($_SESSION['user_id']) && $_SESSION['user_id']==$r['user_id']){ ?>
<button onclick="deleteReview(<?= $r['id'] ?>)">Delete</button>
<?php } ?>
</div>
<?php } ?>

<?php if(isset($_SESSION['user_id'])){ ?>
<textarea id="comment"></textarea>
<button onclick="addReview(<?= $p['id'] ?>)">Submit</button>
<?php } ?>

<script>
function addReview(id){
let c = document.getElementById("comment").value;

if(c.trim()==""){
alert("Empty comment");
return;
}

fetch("../../api/reviews/add.php",{
method:"POST",
headers:{'Content-Type':'application/x-www-form-urlencoded'},
body:`product_id=${id}&comment=${c}`
})
.then(()=>location.reload());
}

function deleteReview(id){
fetch("../../api/reviews/delete.php",{
method:"POST",
headers:{'Content-Type':'application/x-www-form-urlencoded'},
body:`id=${id}`
})
.then(()=>location.reload());
}
</script>