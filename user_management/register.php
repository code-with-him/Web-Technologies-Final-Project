<?php
include 'db.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if(isset($_POST['save'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $phone = $_POST['phone'];
    $check = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");

    if(mysqli_num_rows($check) > 0){
        echo "<script>alert('Email Already Exists')</script>";
    }else{
        $sql = "INSERT INTO users(name,email,password,phone)
                VALUES('$name','$email','$password','$phone')";
        mysqli_query($conn, $sql);

        // PHPMailer Start
        $mail = new PHPMailer(true);
        try{
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'mdfhmmym@gmail.com';
            $mail->Password = 'tzkw jfjs ahhz nnvn';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;
            $mail->setFrom('mdfhmmym@gmail.com', 'User Management System');
            $mail->addAddress($email);
            $mail->isHTML(true);
            $mail->Subject = 'Registration Successful';
            $mail->Body = "
                <h3>Welcome $name</h3>
                <p>Your registration has been completed successfully.</p>
            ";
            $mail->send();

            echo "<script>
            alert('Registration Successful & Confirmation Email Sent');
            window.location.href='login.php';
            </script>";

        }catch(Exception $e){

            echo "<script>
            alert('Email Failed');
            </script>";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">

    <div class="row justify-content-center">

        <div class="col-md-6">

            <div class="card">

                <div class="card-header text-center">

                    <h3>User Registration</h3>

                </div>

                <div class="card-body">

                    <form method="POST">

                        <div class="mb-3">

                            <label>Name</label>

                            <input type="text"
                                   name="name"
                                   class="form-control"
                                   required>

                        </div>

                        <div class="mb-3">

                            <label>Email</label>

                            <input type="email"
                                   name="email"
                                   class="form-control"
                                   required>

                        </div>

                        <div class="mb-3">

                            <label>Password</label>

                            <input type="password"
                                   name="password"
                                   class="form-control"
                                   required>

                        </div>

                        <div class="mb-3">

                            <label>Phone</label>

                            <input type="text"
                                   name="phone"
                                   class="form-control"
                                   required>

                        </div>

                        <button type="submit"
                                name="save"
                                class="btn btn-primary">

                            Register

                        </button>

                        <a href="login.php"
                           class="btn btn-success">

                           Login

                        </a>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>
</body>
</html>