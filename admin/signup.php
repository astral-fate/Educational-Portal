<?php
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        include_once('includes/conn.php');
        $name = $_POST['name'];
        $Email = $_POST['Email'];
        $Password = password_hash($_POST['Password'], PASSWORD_DEFAULT); 
        $username = $_POST['username'];

        try {
            $sql = "INSERT INTO `users`(`name`, `Email`, `Password`, `username`) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$name, $Email, $Password, $username]);
            $msg = "Inserted Successfully";
            $alertType = "alert-success";
        } catch (PDOException $e) {
            $msg = $e->getMessage();
            $alertType = "alert-danger";
        }
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Sign up</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
    <style>
        html, body {
            display: flex;
            justify-content: center;
            height: 100%;
        }
        body, div, h1, form, input, p { 
            padding: 0;
            margin: 0;
            outline: none;
            font-family: Roboto, Arial, sans-serif;
            font-size: 16px;
            color: #666;
        }
        h1 {
            padding: 10px 0;
            font-size: 32px;
            font-weight: 300;
            text-align: center;
        }
        p {
            font-size: 12px;
        }
        hr {
            color: #a9a9a9;
            opacity: 0.3;
        }
        .main-block {
            max-width: 340px; 
            min-height: 460px; 
            padding: 10px 0;
            margin: auto;
            border-radius: 5px; 
            border: solid 1px #ccc;
            box-shadow: 1px 2px 5px rgba(0,0,0,.31); 
            background: #ebebeb; 
        }
        form {
            margin: 0 30px;
        }
        .account-type, .gender {
            margin: 15px 0;
        }
        input[type=radio] {
            display: none;
        }
        label#icon {
            margin: 0;
            border-radius: 5px 0 0 5px;
        }
        label.radio {
            position: relative;
            display: inline-block;
            padding-top: 4px;
            margin-right: 20px;
            text-indent: 30px;
            overflow: visible;
            cursor: pointer;
        }
        label.radio:before {
            content: "";
            position: absolute;
            top: 2px;
            left: 0;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background: #1c87c9;
        }
        label.radio:after {
            content: "";
            position: absolute;
            width: 9px;
            height: 4px;
            top: 8px;
            left: 4px;
            border: 3px solid #fff;
            border-top: none;
            border-right: none;
            transform: rotate(-45deg);
            opacity: 0;
        }
        input[type=radio]:checked + label:after {
            opacity: 1;
        }
        input[type=text], input[type=password] {
            width: calc(100% - 57px);
            height: 36px;
            margin: 13px 0 0 -5px;
            padding-left: 10px; 
            border-radius: 0 5px 5px 0;
            border: solid 1px #cbc9c9; 
            box-shadow: 1px 2px 5px rgba(0,0,0,.09); 
            background: #fff; 
        }
        input[type=password] {
            margin-bottom: 15px;
        }
        #icon {
            display: inline-block;
            padding: 9.3px 15px;
            box-shadow: 1px 2px 5px rgba(0,0,0,.09); 
            background: #1c87c9;
            color: #fff;
            text-align: center;
        }
        .btn-block {
            margin-top: 10px;
            text-align: center;
        }
        button {
            width: 100%;
            padding: 10px 0;
            margin: 10px auto;
            border-radius: 5px; 
            border: none;
            background: #1c87c9; 
            font-size: 14px;
            font-weight: 600;
            color: #fff;
        }
        button:hover {
            background: #26a9e0;
        }
    </style>
    
</head>
<body>
    <div class="main-block">
        <div>
            <?php
                if (isset($msg)) {
                    echo "<div class='alert $alertType' role='alert'>$msg</div>";
                }
            ?>
        </div>
        <div id="register" class="animate form registration_form">
            <section class="login_content">
                <form action="" method="POST">
                    <h1>Create Account</h1>
                    <div>
                        <input type="text" class="form-control" name="name" id="name" placeholder="name" required="" />
                    </div>
                    <div>
                        <input type="text" class="form-control" name="username" id="username" placeholder="username" required="" />
                    </div>
                    <div>
                        <input type="email" class="form-control" name="Email" id="Email" placeholder="Email" required="" />
                    </div>
                    <div>
                        <input type="password" class="form-control"  name="Password" id="Password" placeholder="Password" required="" />
                    </div>
                    <div>
                        <button type="submit" class="btn btn-default submit">Submit</button>
                    </div>
                </form> 

                <div class="clearfix"></div>

                <div class="separator">
                    <p class="change_link">Already a member ?
                        <a href="login.php" class="to_register"> Log in </a>
                    </p>

                    <div class="clearfix"></div>
                    <br/>

                    <div>
                        <h1><i class="fa fa-graduation-cap"></i></i> Education Admin</h1>
                        <p>©2016 All Rights Reserved. Education Admin is a Bootstrap 4 template. Privacy and Terms</p>
                    </div>
                </div>
        
            </section>
        </div>
    </div>
</body>
</html>
