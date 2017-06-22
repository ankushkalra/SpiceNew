<?php

    session_start();
    unset($_SESSION['message']);

    require_once 'config.php';
    require_once APP_ROOT.'\db\db_config.php';
    $conn = mysqli_connect($db_host, $db_user, $db_userPassword, $db_name);
    if($conn->connect_error) {
        echo "<br/>";
        echo($conn->connect_errno);
        echo "<br/>";
        echo($conn->connect_error);
       
        die("Failed to connect to MySql.");
    }

    
    if(isset($_POST['submit'])) {

        if(isset($_POST['email']) && $_POST['password'] && isset($_POST['cpassword']) && isset($_POST['fname']) && isset($_POST['lname'])) {
            
            $email = $_POST['email'];
            $password = $_POST['password'];
            $cpassword = $_POST['cpassword'];
            $fname = $_POST['fname'];
            $lname = $_POST['lname'];

            if($password != $cpassword) {
                $_SESSION['message'] = "Password and Confirm Password do not match.";
            } else {
                $query = "SELECT * from users where email_id='$email'";
                $result = mysqli_query($conn, $query);
                if (mysqli_num_rows($result) > 0) {
                    $_SESSION['message'] = "Email id already exists. Login <a href=\"login.php\">here</a>";
                } else {
                    $query = "INSERT INTO users(fname, lname, email_id, password, role) values ('$fname', '$lname', '$email', '$password', 'customer')";
                    if(mysqli_query($conn, $query)) {
                        header("Location: login.php");
                        exit();
                    } else {
                        $_SESSION['message'] = "Query Execution failed.";
                        trigger_error(mysqli_error($conn)." in ".$query);
                    }
                }
            }
        }
    }
?>

<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width = device-width, initial-scale=1">

        <title>Login System - Shiva Spices</title>

        <link rel="stylesheet" type="text/css" href="css/bootstrap.css">

        <link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet" type="text/css">

        <link rel="stylesheet" type="text/css" href="bootstrap-mod.css">

        <link rel="stylesheet" type="text/css" href="index.css">

    </head>
    <body>

        <?php require_once('navbar.php'); ?>

        <div class="container">

            <div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 col-sm-12 col-xs-12">

                <form method="post" action="register.php">

                    <?php
                    if(isset($_SESSION['message'])) {
                    ?>
                        <p><?php echo $_SESSION['message']; ?></p>
                    <?php
                    }
                    ?>

                    <div class="input-group input-group-lg">
                        <span class="input-group-addon">First Name</span>
                        <input type="text" name="fname" class="form-control" required>
                    </div><br> <!-- end of First-Name input-group -->

                    <div class="input-group input-group-lg">
                        <span class="input-group-addon">Last Name</span>
                        <input type="text" name="lname" class="form-control" required>
                    </div><br> <!-- end of Last-Name input-group -->

                    <div class="input-group input-group-lg">
                        <span class="input-group-addon">Email</span>
                        <input type="text" name="email" class="form-control" required>
                    </div><br> <!-- end of Email input-group -->

                    <div class="input-group input-group-lg">
                        <span class="input-group-addon">Password</span>
                        <input type="password" name="password" class="form-control" required>
                    </div><br> <!-- end of Password input-group -->

                    <div class="input-group input-group-lg">
                        <span class="input-group-addon">Confirm Password</span>
                        <input type="password" name="cpassword" class="form-control" required>
                    </div><br> <!-- end of Confirm-Password input-group -->

                    <button class="btn btn-lg btn-primary btn-block mod-form-submit-button" name="submit" type="submit">Register</button>  <!-- Submit Button -->

                </form>
            </div>  
        </div>  <!-- End of container -->

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>