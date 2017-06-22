<?php
	session_start();
	require_once 'config.php';
    require_once APP_ROOT.'\db\db_config.php';
	$conn = mysqli_connect($db_host, $db_user, $db_userPassword, $db_name);
	if($conn->connect_errno) {
		echo $conn->connect_error;
		echo $conn->connect_errno;
		die("MySql is not working");
	}

	if(isset($_POST['use_address'])) {
		if (isset($_POST['selected_address'])) {
			$_SESSION['selected_address'] = $_POST['selected_address'];
			 header("Location: pay.php");
		}
	}

	if(isset($_POST['submit'])) {
		if(isset($_POST['full_name']) && isset($_POST['mobile_number']) && isset($_POST['pincode']) && isset($_POST['house_no']) && isset($_POST['street']) && isset($_POST['landmark']) && isset($_POST['town_or_city']) && isset($_POST['state'])) {
			$full_name = $_POST['full_name'];
			$mobile_number = $_POST['mobile_number'];
			$pincode = $_POST['pincode'];
			$house_no = $_POST['house_no'];
			$street = $_POST['street'];
			$landmark = $_POST['landmark'];
			$town_or_city = $_POST['town_or_city'];
			$state = $_POST['state'];
			if(isset($_SESSION['user_id'])) {
				$user_id = $_SESSION['user_id'];
				$query = "INSERT INTO address(full_name, mobile_no, pincode, house_no, street, landmark, town_or_city, state, user_id) values ('$full_name', '$mobile_number', '$pincode', '$house_no', '$street', '$landmark', '$town_or_city', '$state', '$user_id')";
	    	    if(mysqli_query($conn, $query)) {
	    	    	$_SESSION['message'] = "Address added successfully";
				} else {
					$_SESSION['message'] = "Sorry, the database is not working.";
				}
	        } else {
	        	$_SESSION['message'] = "Please login first. Login <a href=\"login.php\">here</a>";
	        }
		} else {
			$_SESSION['message'] = "Please fill out all the fields.";
		}
	}
?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width = device-width, initial-scale=1">

	<title>Checkout - Shiva Spices</title>

	<!-- Bootstrap library -->
	<!-- <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> -->
	<!-- jQuery library -->
	<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> -->
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">

	<link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet" type="text/css">

	<link rel="stylesheet" type="text/css" href="bootstrap-mod.css">
	<link rel="stylesheet" type="text/css" href="index.css">
	<style type="text/css">
	body {
		margin: 0px;
	}
	.navbar {
		padding: 0px;
		border-radius: 0px;
	}

	.logo {
	    margin-top: 15px;
	    margin-left: 15px;
	}

	.input-group-addon {
		font-weight: bold;
	}

	hr {
	    display: block;
	    height: 1px;
	    border: 0;
	    border-top: 1px solid #ccc;
	    margin: 1em 0;
	    padding: 0;
	}

	h2 {
		font-weight: bold;
	}

	.form-group-sm {
		margin: 0px;
		padding: 0px;
	}

	body {
		font-family: 'Lora', serif;
		margin-bottom: 30px;
	}
	</style>
</head>
<body>
	<?php require_once('navbar.php'); ?>

	<div class="container">

		<div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">

		<?php
			if(!isset($_SESSION['user_id'])) {
				$_SESSION['message'] = "Please login first. Login <a href=\"login.php\">here</a>";
			}
	    	if(isset($_SESSION['message'])) {
    	?>
    		<h3><?php echo $_SESSION['message']; ?></h3>
	    <?php
	        }
	    ?>

			<h2 style="font-family: 'Merriweather', serif;">Add a new address</h2>
			<hr/>
			<form method="post" action="checkout.php">

				<div class="form-group-sm">
					<label>Full Name:</label>
					<input type="text" name="full_name" class="form-control" required>
				</div><br> <!-- end of input-group -->

				<div class="form-group-sm">
					<label>Mobile Number:</label>
					<input type="number" name="mobile_number" class="form-control" required>
				</div><br> <!-- end of input-group -->

				<div class="form-group-sm">
					<label>Pincode:</label>
					<input type="number" name="pincode" class="form-control" required>
				</div><br> <!-- end of input-group -->

				<div class="form-group-sm">
					<label>Flat / House No. / Floor / Building:</label>
					<input type="text" name="house_no" class="form-control" required>
				</div><br> <!-- end of input-group -->

				<div class="form-group-sm">
					<label>Colony / Street / Locality:</label>
					<input type="text" name="street" class="form-control" required>
				</div><br> <!-- end of input-group -->

				<div class="form-group-sm">
					<label>Landmark:</label>
					<input type="text" name="landmark" class="form-control" required>
				</div><br> <!-- end of input-group -->

				<div class="form-group-sm">
					<label>Town / City:</label>
					<input type="text" name="town_or_city" class="form-control" required>
				</div><br> <!-- end of input-group -->

				<div class="form-group-sm">
					<label>State:</label>
					<input type="text" name="state" class="form-control" required>
				</div><br> <!-- end of input-group -->

				<div class="text-center">
					<button class="btn btn-lg btn-primary mod-form-submit-button" name="submit" type="submit" id="submit_button">Add New Address</button>	<!-- Submit Button -->
				</div>
			</form>
		</div>	
	<?php
		if(isset($_SESSION['user_id'])) {
			$user_id = $_SESSION['user_id'];
			$query = "SELECT * FROM address WHERE user_id = '$user_id'";
            $result = mysqli_query($conn, $query);
            if (mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_array($result)) {
        ?>
                	<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12" style="margin:20px; padding:20px; border: 1px solid orange;">
                	<?php
                		echo $row['full_name'];
                		echo "<br/>";
                		echo $row['mobile_no'];
                		echo "<br/>";
                		echo $row['house_no'];
                		echo ", ";
                		echo $row['street'];
                		echo "<br/>";
                		echo $row['landmark'];
                		echo "<br/>";
                		echo $row['town_or_city']." ".$row['pincode'];
                	?>
                	<br/>
                	<form method="post" action="checkout.php">
                		<input type="hidden" name="selected_address" value="<?php echo $row['address_id'];?>">
                		<input type="submit" name="use_address" class="btn" value="Use this address">
                	</form>
                	</div>
        <?php
                }
            }
        }
        ?>
		
	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script type="text/javascript">

		// var submit_button = document.getElementById("submit_button");
		// submit_button.onclick(function(){
		//    alert("hello"); 
		// });	
	</script>
</body>	
</html>