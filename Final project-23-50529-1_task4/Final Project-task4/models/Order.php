<?php
class Order {

    private $conn;

    public function __construct($db){
        $this->conn = $db;
    }

    // 🧾 CREATE ORDER
    public function create($user_id, $total, $method){

        $stmt = $this->conn->prepare("
            INSERT INTO orders 
            (user_id, total_amount, payment_method, status, order_date)
            VALUES (?, ?, ?, 'pending', NOW())
        ");

        $stmt->execute([$user_id, $total, $method]);

        return $this->conn->lastInsertId();
    }

    // 📦 GET USER ORDERS
    public function getByUser($user_id){
        $stmt = $this->conn->prepare("SELECT * FROM orders WHERE user_id=? ORDER BY id DESC");
        $stmt->execute([$user_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}
?>