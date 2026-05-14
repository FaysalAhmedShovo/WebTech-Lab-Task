<?php
session_start();
header("Content-Type: application/json");

if(!isset($_SESSION['user_id'])){
    echo json_encode(["error"=>"Login required"]);
    exit;
}

require_once "../../config/database.php";
require_once "../../models/Review.php";

$db = new Database();
$conn = $db->connect();

$reviewModel = new Review($conn);

$product_id = $_POST['product_id'] ?? 0;
$comment = trim($_POST['comment'] ?? "");

// 🔐 PHP VALIDATION
if($product_id <= 0 || $comment == "" || strlen($comment) > 200){
    echo json_encode(["error"=>"Invalid input"]);
    exit;
}

$reviewModel->add(
    $product_id,
    $_SESSION['user_id'],
    $_SESSION['name'],
    $comment
);

echo json_encode(["status"=>"added"]);
?>