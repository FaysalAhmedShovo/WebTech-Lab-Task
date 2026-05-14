<?php
session_start();
if($_SESSION['role']!=='admin'){ exit; }

require_once "../../../config/database.php";

$db = new Database();
$conn = $db->connect();

$users = $conn->query("SELECT * FROM users WHERE role='customer'");
?>

<h2>Customers</h2>

<?php foreach($users as $u){ ?>
<div>
<?= $u['name'] ?> (<?= $u['email'] ?>)
<button onclick="delUser(<?= $u['id'] ?>)">Delete</button>
</div>
<?php } ?>

<script>
function delUser(id){
if(confirm("Delete user?")){
fetch("delete.php",{
method:"POST",
headers:{'Content-Type':'application/x-www-form-urlencoded'},
body:`id=${id}`
})
.then(()=>location.reload());
}
}
</script>