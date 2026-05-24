<?php
session_start();
include 'db.php';
if(isset($_POST['login'])){

    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users
            WHERE email='$email'
            AND password='$password'";

    $data = mysqli_query($conn, $sql);

    if(mysqli_num_rows($data) > 0){
    $_SESSION['user_email'] = $email;
    mysqli_query($conn,
    "INSERT INTO login_history(email)
    VALUES('$email')");
    header("Location:dashboard.php");
    }else{
        echo "<script>alert('Invalid Email or Password')</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">

    <div class="row justify-content-center">

        <div class="col-md-6">

            <div class="card">

                <div class="card-header text-center">
                    <h3>User Login</h3>
                </div>

                <div class="card-body">

                    <form method="POST">

                        <div class="mb-3">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>

                        <button type="submit" name="login" class="btn btn-primary">
                            Login
                        </button>

                        <a href="register.php" class="btn btn-success">
                            Register
                        </a>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>
</body>
</html>