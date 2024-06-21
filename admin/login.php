<?php
session_start();
if (isset($_SESSION['logged']) && $_SESSION['logged'] === true) {
    header('Location: meetings.php');
    die();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    include_once('includes/conn.php');

    try {
        $sql = "SELECT `Email`, `password` FROM `users` WHERE `Email` = ? AND active = ?";
        $email = $_POST['Email'];
        $active = 1;
        $password = $_POST['password'];
        $stmt = $conn->prepare($sql);
        $stmt->execute([$email, $active]);
        if ($stmt->rowCount()) {
            $result = $stmt->fetch();
            $verify = password_verify($password, $result['password']);
            if ($verify) {
                $_SESSION['logged'] = true;
                $_SESSION['Email'] = $result['Email'];
                header('Location: meetings.php');
                die();
            } else {
                $msg = "Incorrect password";
                $alertType = "alert-danger";
            }
        } else {
            $msg = "No data found";
            $alertType = "alert-danger";
        }
    } catch (PDOException $e) {
        $msg = $e->getMessage();
        $alertType = "alert-danger";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Education Admin | Login/Register</title>

    <!-- Bootstrap -->
    <link href="vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="vendors/animate.css/animate.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="build/css/custom.min.css" rel="stylesheet">
</head>

<body class="login">
<div>
    <a class="hiddenanchor" id="signup"></a>
    <a class="hiddenanchor" id="signin"></a>

    <div class="login_wrapper">
        <div class="animate form login_form">
            <section class="login_content">
                <form action="" method="POST">
                    <h1>Login Form</h1>
                    <div>
                        <input type="text" class="form-control" name="Email" placeholder="Email" required="" />
                    </div>
                    <div>
                        <input type="password" class="form-control" name="password" placeholder="Password" required="" />
                    </div>
                    <div>
                        <button type="submit" class="btn btn-default submit">Log in</button>
                        <a class="reset_pass" href="#">Lost your password?</a>
                    </div>

                    <div class="clearfix"></div>

                    <div class="separator">
                        <p class="change_link">New to site?
                            <a href="signup.php" class="to_register"> Create Account </a>
                        </p>

                        <div class="clearfix"></div>
                        <br />

                        <div>
                            <h1><i class="fa fa-graduation-cap"></i></i> Education Admin</h1>
                            <p>©2016 All Rights Reserved. Education Admin is a Bootstrap 4 template. Privacy and Terms</p>
                        </div>
                    </div>
                </form>
            </section>
        </div>

    </div>
</div>
</body>
</html>