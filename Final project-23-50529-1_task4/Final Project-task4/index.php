<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
<title>Computer Shop</title>
<link rel="stylesheet" href="public/assets/css/style.css">
</head>

<body>

<h2>💻 Computer Shop</h2>

<div style="text-align:center; margin-top:20px;">

<?php if(isset($_SESSION['user_id'])){ ?>

    <p>Welcome, <?= $_SESSION['name'] ?></p>

    <a href="views/customer/home.php">Go to Shop</a><br><br>
    <a href="views/customer/cart.php">Cart</a><br><br>
    <a href="views/customer/orders.php">Orders</a><br><br>

    <?php if($_SESSION['role'] == 'admin'){ ?>
        <a href="views/admin/dashboard.php">Admin Panel</a><br><br>
    <?php } ?>

    <a href="logout.php">Logout</a>

<?php } else { ?>

    <a href="login.php">Login</a><br><br>
    <a href="register.php">Register</a>

<?php } ?>

</div>

</body>
</html>