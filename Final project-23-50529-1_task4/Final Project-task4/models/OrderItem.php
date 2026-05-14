<?php
class OrderItem {

    private $conn;

    public function __construct($db){
        $this->conn = $db;
    }

    // 📦 CREATE ITEM
    public function create($order_id, $product_id, $qty, $price){

        $stmt = $this->conn->prepare("
            INSERT INTO order_items 
            (order_id, product_id, quantity, unit_price)
            VALUES (?, ?, ?, ?)
        ");

        return $stmt->execute([
            $order_id,
            $product_id,
            $qty,
            $price
        ]);
    }

}
?>