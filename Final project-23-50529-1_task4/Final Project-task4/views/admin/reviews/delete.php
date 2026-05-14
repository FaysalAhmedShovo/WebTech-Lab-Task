<?php
require_once "../../../config/database.php";

$db = new Database();
$conn = $db->connect();

$conn->prepare("DELETE FROM reviews WHERE id=?")->execute([$_POST['id']]);

echo "deleted";