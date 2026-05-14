<?php
require_once "config/database.php";

$db = new Database();
$conn = $db->connect();

if($_SERVER['REQUEST_METHOD']=="POST"){

$name = $_POST['name'];
$email = $_POST['email'];
$pass = password_hash($_POST['password'], PASSWORD_DEFAULT);

$stmt = $conn->prepare("INSERT INTO users(name,email,password) VALUES(?,?,?)");
$stmt->execute([$name,$email,$pass]);

header("Location: login.php");
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Register</title>
<link rel="stylesheet" href="public/assets/css/style.css">
</head>

<body>

<h2>📝 Register</h2>

<div class="form-box">

<form method="POST">

<input name="name" placeholder="Full Name" required><br>

<input name="email" type="email" placeholder="Email" required><br>

<input name="password" type="password" placeholder="Password" required><br>

<button type="submit">Register</button>

</form>

<br>
<a href="login.php">Already have account?</a>

</div>

</body>
</html>