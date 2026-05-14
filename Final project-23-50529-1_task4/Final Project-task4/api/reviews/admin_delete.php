<?php
session_start();
header("Content-Type: application/json");

if(!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin'){
    echo json_encode(["error"=>"Unauthorized"]);
    exit;
}

require_once "../../config/database.php";
require_once "../../models/Review.php";

$db = new Database();
$conn = $db->connect();

$reviewModel = new Review($conn);

$id = $_POST['id'] ?? 0;

$reviewModel->deleteAny($id);

echo json_encode(["status"=>"deleted"]);
?>