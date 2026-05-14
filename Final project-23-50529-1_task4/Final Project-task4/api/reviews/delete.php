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

$id = $_POST['id'] ?? 0;

// 🔐 delete only own review
$reviewModel->deleteOwn($id, $_SESSION['user_id']);

echo json_encode(["status"=>"deleted"]);
?>