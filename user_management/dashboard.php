<?php
session_start();

include 'db.php';

if(!isset($_SESSION['user_email'])){
    header("Location:login.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <div class="d-flex justify-content-between mb-3">

        <h2>User Dashboard</h2>

        <button onclick="toggleMode()" class="btn btn-dark mb-3">
        Dark/Light Mode
        </button>

        <a href="logout.php" class="btn btn-danger mb-3">
            Logout
        </a>
    </div>
    <table class="table table-bordered table-striped">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Password</th>
            <th>Phone</th>
            <th>Action</th>
        </tr>
<?php
$data = mysqli_query($conn, "SELECT * FROM users");
while($row = mysqli_fetch_assoc($data)){
?>

<tr>
    <td><?php echo $row['id']; ?></td>
    <td><?php echo $row['name']; ?></td>
    <td><?php echo $row['email']; ?></td>
    <td><?php echo $row['password']; ?></td>
    <td><?php echo $row['phone']; ?></td>
    <td>
        <a href="edit.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">
            Edit
        </a>

        <a href="delete.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm">
            Delete
        </a>
    </td>
</tr>
<?php
}
?>
    </table>


<hr>
<h3>Login History</h3>
<table class="table table-bordered">
<tr>
    <th>ID</th>
    <th>Email</th>
    <th>Login Time</th>
    <th>Action</th>
</tr>

<?php
$history = mysqli_query($conn,
"SELECT * FROM login_history ORDER BY id DESC");
while($log = mysqli_fetch_assoc($history)){
?>

<tr>
    <td><?php echo $log['id']; ?></td>
    <td><?php echo $log['email']; ?></td>
    <td><?php echo $log['login_time']; ?></td>
    <td>
        <a href="delete_history.php?id=<?php echo $log['id']; ?>"
           class="btn btn-danger btn-sm">
           Delete
        </a>
    </td>
</tr>
<?php
}
?>
</table>



</div>


<script>
function toggleMode(){
    document.body.classList.toggle("bg-dark");
    document.body.classList.toggle("text-white");
    let tables = document.querySelectorAll("table");
    tables.forEach(function(table){
        table.classList.toggle("table-dark");
    });
}
</script>


</body>
</html>