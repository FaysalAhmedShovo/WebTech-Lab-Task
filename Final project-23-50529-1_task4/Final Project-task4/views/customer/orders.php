<?php
session_start();

require_once "../../config/database.php";
require_once "../../models/Order.php";

$db = new Database();
$conn = $db->connect();

$orderModel = new Order($conn);
$orders = $orderModel->getByUser($_SESSION['user_id']);
?>

<h2>Your Orders</h2>

<?php foreach($orders as $o){ ?>
<div>
Order #<?= $o['id'] ?> |
Total: <?= $o['total_amount'] ?> |
Method: <?= $o['payment_method'] ?>
</div>
<?php } ?>