<?php
session_start();
if($_SESSION['role']!=='admin'){ exit; }

require_once "../../config/database.php";

$db = new Database();
$conn = $db->connect();
?>

<h2>Admin Dashboard</h2>

<h3>Recent Orders</h3>
<?php
$orders = $conn->query("SELECT * FROM orders ORDER BY id DESC LIMIT 5");
foreach($orders as $o){
echo "Order #".$o['id']." - ".$o['total_amount']."<br>";
}
?>

<h3>Recent Reviews</h3>
<?php
$reviews = $conn->query("SELECT * FROM reviews ORDER BY id DESC LIMIT 5");
foreach($reviews as $r){
echo $r['reviewer_name']." : ".$r['comment']."<br>";
}
?>