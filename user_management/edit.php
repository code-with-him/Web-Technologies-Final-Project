<?php
include 'db.php';

$id = $_GET['id'];
$data = mysqli_query($conn, "SELECT * FROM users WHERE id='$id'");
$row = mysqli_fetch_assoc($data);


if(isset($_POST['update'])){

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $phone = $_POST['phone'];

    $sql = "UPDATE users
            SET
            name='$name',
            email='$email',
            password='$password',
            phone='$phone'
            WHERE id='$id'";

    mysqli_query($conn, $sql);

    header("Location:dashboard.php");
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Edit User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
<div class="container mt-5">

    <div class="row justify-content-center">

        <div class="col-md-6">

            <div class="card">

                <div class="card-header text-center">
                    <h3>Edit User</h3>
                </div>

                <div class="card-body">

                    <form method="POST">

                        <div class="mb-3">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control"
                            value="<?php echo $row['name']; ?>">
                        </div>

                        <div class="mb-3">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control"
                            value="<?php echo $row['email']; ?>">
                        </div>

                        <div class="mb-3">
                            <label>Password</label>
                            <input type="text" name="password" class="form-control"
                            value="<?php echo $row['password']; ?>">
                        </div>

                        <div class="mb-3">
                            <label>Phone</label>
                            <input type="text" name="phone" class="form-control"
                            value="<?php echo $row['phone']; ?>">
                        </div>

                        <button type="submit" name="update" class="btn btn-success">
                            Update
                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>
</body>
</html>