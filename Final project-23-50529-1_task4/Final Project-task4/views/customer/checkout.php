<?php
session_start();

if(!isset($_SESSION['user_id'])){
    header("Location: ../../index.php");
    exit;
}
?>

<h2>Checkout</h2>

<select id="method">
    <option value="cash_on_delivery">Cash on Delivery</option>
    <option value="online_wallet">Online Wallet</option>
</select>

<button onclick="placeOrder()">Place Order</button>

<script>
function placeOrder(){
    let method = document.getElementById("method").value;

    fetch("../../api/order/place.php",{
        method:"POST",
        headers:{'Content-Type':'application/x-www-form-urlencoded'},
        body:`method=${method}`
    })
    .then(r=>r.json())
    .then(d=>{
        if(d.error){
            alert(d.error);
        }else{
            window.location = "order_success.php";
        }
    });
}
</script>