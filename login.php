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

        if(isset($_POST['email']) && $_POST['password']) {
            
            $email = $_POST['email'];
            $password = $_POST['password'];
            
            $query = "SELECT * FROM users WHERE email_id = '$email' && password = '$password'";
            $result = mysqli_query($conn, $query);
            if (mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_array($result)) {
                    $_SESSION['fname'] = $row['fname'];
                    $_SESSION['lname'] = $row['lname'];
                    $_SESSION['user_id'] = $row['user_id'];
                    if($row['role'] == 'admin') {
                        header("Location: admin/admin.php");
                        exit();
                    } else {
                        header("Location: index.php");
                        exit();
                    }   
                }
            } else {
                $_SESSION['message'] = "Login failed. Please check your credentials & Try again.";
                //trigger_error(mysqli_error($conn)." in ".$query);
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

                <form method="post" action="login.php">
                    <?php
                    if(isset($_SESSION['message'])) {
                    ?>
                        <p><?php echo $_SESSION['message']; ?></p>
                    <?php
                    }
                    ?>
                    <div class="input-group input-group-lg">
                        <span class="input-group-addon">Email</span>
                        <input type="text" name="email" class="form-control" placeholder="">
                    </div><br> <!-- end of input-group -->

                    <div class="input-group input-group-lg">
                        <span class="input-group-addon">Password</span>
                        <input type="password" name="password" class="form-control" placeholder="">
                    </div><br> <!-- end of input-group -->


                    <button class="btn btn-lg btn-primary btn-block mod-form-submit-button" name="submit" type="submit">Login</button>  <!-- Submit Button -->

                </form>
            </div>  
        </div>  <!-- End of container -->

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>

    </body>
</html>