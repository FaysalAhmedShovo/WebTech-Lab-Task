<?php
header("Content-Type: application/json");

$data = [
    "name" => "Faysal",
    "age" => 23,
    "city" => "Tangail"
];

echo json_encode($data);
?>