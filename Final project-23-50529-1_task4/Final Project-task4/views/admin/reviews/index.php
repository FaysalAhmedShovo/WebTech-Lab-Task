<?php
session_start();
if($_SESSION['role']!=='admin'){ exit; }

require_once "../../../config/database.php";

$db = new Database();
$conn = $db->connect();

$reviews = $conn->query("
SELECT reviews.*, products.name as pname 
FROM reviews 
JOIN products ON products.id=reviews.product_id
");
?>

<h2>All Reviews</h2>

<?php foreach($reviews as $r){ ?>
<div>
<?= $r['pname'] ?> | <?= $r['reviewer_name'] ?>:
<?= $r['comment'] ?>
<button onclick="delReview(<?= $r['id'] ?>)">Delete</button>
</div>
<?php } ?>

<script>
function delReview(id){
fetch("delete.php",{
method:"POST",
headers:{'Content-Type':'application/x-www-form-urlencoded'},
body:`id=${id}`
})
.then(()=>location.reload());
}
</script>