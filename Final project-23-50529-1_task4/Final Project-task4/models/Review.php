<?php
class Review {

    private $conn;

    public function __construct($db){
        $this->conn = $db;
    }

    // ✍️ ADD REVIEW
    public function add($product_id, $user_id, $name, $comment){

        $stmt = $this->conn->prepare("
            INSERT INTO reviews 
            (product_id, user_id, reviewer_name, comment, created_at)
            VALUES (?, ?, ?, ?, NOW())
        ");

        return $stmt->execute([
            $product_id,
            $user_id,
            $name,
            $comment
        ]);
    }

    // ❌ DELETE (OWN)
    public function deleteOwn($id, $user_id){

        $stmt = $this->conn->prepare("
            DELETE FROM reviews WHERE id=? AND user_id=?
        ");

        return $stmt->execute([$id, $user_id]);
    }

    // ❌ ADMIN DELETE
    public function deleteAny($id){

        $stmt = $this->conn->prepare("DELETE FROM reviews WHERE id=?");
        return $stmt->execute([$id]);
    }

    // 🔍 GET BY PRODUCT
    public function getByProduct($product_id){

        $stmt = $this->conn->prepare("
            SELECT * FROM reviews WHERE product_id=? ORDER BY id DESC
        ");

        $stmt->execute([$product_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}
?>