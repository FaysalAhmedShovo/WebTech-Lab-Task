<?php
class Product {

    private $conn;

    public function __construct($db){
        $this->conn = $db;
    }

    // 🔥 CREATE PRODUCT
    public function create($data){

        $stmt = $this->conn->prepare("
            INSERT INTO products 
            (name, description, manufacturer_review, price, category_id, brand_id, image_path, stock, created_at)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW())
        ");

        return $stmt->execute([
            $data['name'],
            $data['description'],
            $data['manufacturer_review'],
            $data['price'],
            $data['category_id'],
            $data['brand_id'],
            $data['image_path'],
            $data['stock']
        ]);
    }

    // 🔍 GET ALL
    public function getAll(){
        return $this->conn->query("SELECT * FROM products ORDER BY id DESC");
    }

    // 🔍 GET BY ID
    public function getById($id){
        $stmt = $this->conn->prepare("SELECT * FROM products WHERE id=?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

}
?>