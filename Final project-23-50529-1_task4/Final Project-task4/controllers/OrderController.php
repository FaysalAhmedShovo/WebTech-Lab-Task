<?php
require_once __DIR__ . "/../models/Order.php";
require_once __DIR__ . "/../models/OrderItem.php";

class OrderController {

    private $conn;
    private $orderModel;
    private $itemModel;

    public function __construct($db){
        $this->conn = $db;
        $this->orderModel = new Order($db);
        $this->itemModel = new OrderItem($db);
    }

    // 🧾 PLACE ORDER
    public function placeOrder($user_id, $cart, $method){

        if(empty($cart)){
            return ["error"=>"Cart empty"];
        }

        if(!in_array($method, ['cash_on_delivery','online_wallet'])){
            return ["error"=>"Invalid payment"];
        }

        $total = 0;

        // 🔍 CALC TOTAL + CHECK STOCK
        foreach($cart as $id => $qty){

            if($qty <= 0){
                return ["error"=>"Invalid quantity"];
            }

            $stmt = $this->conn->prepare("SELECT price, stock FROM products WHERE id=?");
            $stmt->execute([$id]);
            $p = $stmt->fetch(PDO::FETCH_ASSOC);

            if(!$p){
                return ["error"=>"Product not found"];
            }

            if($p['stock'] < $qty){
                return ["error"=>"Stock not enough"];
            }

            $total += $p['price'] * $qty;
        }

        // 🔥 CREATE ORDER
        $order_id = $this->orderModel->create($user_id, $total, $method);

        // 🔥 INSERT ITEMS + UPDATE STOCK
        foreach($cart as $id => $qty){

            $stmt = $this->conn->prepare("SELECT price FROM products WHERE id=?");
            $stmt->execute([$id]);
            $p = $stmt->fetch(PDO::FETCH_ASSOC);

            $this->itemModel->create($order_id, $id, $qty, $p['price']);

            // stock update
            $this->conn->prepare("UPDATE products SET stock = stock - ? WHERE id=?")
                       ->execute([$qty, $id]);
        }

        return [
            "status" => "success",
            "order_id" => $order_id,
            "total" => $total
        ];
    }

}
?>