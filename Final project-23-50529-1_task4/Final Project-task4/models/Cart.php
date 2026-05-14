<?php
class Cart {

    // 🛒 ADD
    public function add($id){
        if(!isset($_SESSION['cart'])){
            $_SESSION['cart'] = [];
        }

        $_SESSION['cart'][$id] = ($_SESSION['cart'][$id] ?? 0) + 1;
    }

    // 🔄 UPDATE
    public function update($id, $qty){
        if($qty <= 0){
            unset($_SESSION['cart'][$id]);
        }else{
            $_SESSION['cart'][$id] = $qty;
        }
    }

    // ❌ REMOVE
    public function remove($id){
        unset($_SESSION['cart'][$id]);
    }

    // 📦 GET CART
    public function get(){
        return $_SESSION['cart'] ?? [];
    }

    // 🧹 CLEAR
    public function clear(){
        unset($_SESSION['cart']);
    }
}
?>