<?php
require_once "../../../config/database.php";

$db = new Database();
$conn = $db->connect();

$id = $_POST['id'];

$conn->prepare("DELETE FROM reviews WHERE user_id=?")->execute([$id]);
$conn->prepare("DELETE FROM orders WHERE user_id=?")->execute([$id]);
$conn->prepare("DELETE FROM users WHERE id=?")->execute([$id]);

echo "done";