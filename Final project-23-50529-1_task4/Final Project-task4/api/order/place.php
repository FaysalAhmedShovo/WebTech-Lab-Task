<?php
session_start();
header("Content-Type: application/json");

if(!isset($_SESSION['user_id'])){
    echo json_encode(["error"=>"Login required"]);
    exit;
}

require_once "../../config/database.php";
require_once "../../controllers/OrderController.php";

$db = new Database();
$conn = $db->connect();

$controller = new OrderController($conn);

$cart = $_SESSION['cart'] ?? [];
$method = $_POST['method'] ?? '';

$result = $controller->placeOrder(
    $_SESSION['user_id'],
    $cart,
    $method
);

if(isset($result['status']) && $result['status'] == 'success'){
    unset($_SESSION['cart']); // cart clear
}

echo json_encode($result);
?>