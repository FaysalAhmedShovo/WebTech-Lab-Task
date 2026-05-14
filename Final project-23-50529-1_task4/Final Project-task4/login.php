<?php
session_start();
require_once "config/database.php";

$db = new Database();
$conn = $db->connect();

if($_SERVER['REQUEST_METHOD']=="POST"){

$email = $_POST['email'];
$pass = $_POST['password'];

$stmt = $conn->prepare("SELECT * FROM users WHERE email=?");
$stmt->execute([$email]);
$user = $stmt->fetch();

if($user && password_verify($pass, $user['password'])){
$_SESSION['user_id'] = $user['id'];
$_SESSION['name'] = $user['name'];
$_SESSION['role'] = $user['role'];

header("Location: index.php");
}else{
$error = "Invalid login!";
}
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Login</title>
<link rel="stylesheet" href="public/assets/css/style.css">
</head>

<body>

<h2>🔐 Login</h2>

<div class="form-box">

<?php if(isset($error)) echo "<p style='color:red'>$error</p>"; ?>

<form method="POST">

<input type="email" name="email" placeholder="Email" required><br>

<input type="password" name="password" placeholder="Password" required><br>

<button type="submit">Login</button>

</form>

<br>
<a href="register.php">Create account</a>

</div>

</body>
</html>