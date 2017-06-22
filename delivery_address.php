<?php
	session_start();
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
	    	    	echo "Query executed successfully.";
	    	    	$_SESSION['message'] = "Address added successfully";
				} else {
					echo "Failed.";
				}
	        } else {
	        	echo "Else inside";
	        	$_SESSION['message'] = "Please login first. Login <a href=\"login.php\">here</a>";
	        }
		} else {
			$_SESSION['message'] = "Please fill out all the fields.";
		}
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width = device-width, initial-scale=1">
	<title>Show Product - Shiva Spices</title>
	<link href="https://fonts.googleapis.com/css?family=Lora" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Merriweather" rel="stylesheet">
	<!-- Bootstrap library -->
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

	<style type="text/css">
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
	<?php
		require_once 'navbar.php';
	?>
	<div class="container">

		<div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">

			<h2 style="font-family: 'Merriweather', serif;">Add a new address</h2>
			<hr/>
			<form method="post" action="delivery_address.php">

				<div class="form-group-sm">
					<label>Full Name:</label>
					<input type="text" name="full_name" class="form-control" >
				</div><br> <!-- end of input-group -->

				<div class="form-group-sm">
					<label>Mobile Number:</label>
					<input type="text" name="mobile_number" class="form-control" >
				</div><br> <!-- end of input-group -->

				<div class="form-group-sm">
					<label>Pincode:</label>
					<input type="text" name="pincode" class="form-control" >
				</div><br> <!-- end of input-group -->

				<div class="form-group-sm">
					<label>Flat / House No. / Floor / Building:</label>
					<input type="text" name="house_no" class="form-control" >
				</div><br> <!-- end of input-group -->

				<div class="form-group-sm">
					<label>Colony / Street / Locality:</label>
					<input type="text" name="street" class="form-control">
				</div><br> <!-- end of input-group -->

				<div class="form-group-sm">
					<label>Landmark:</label>
					<input type="text" name="landmark" class="form-control" >
				</div><br> <!-- end of input-group -->

				<div class="form-group-sm">
					<label>Town / City:</label>
					<input type="text" name="town_or_city" class="form-control" >
				</div><br> <!-- end of input-group -->

				<div class="form-group-sm">
					<label>State:</label>
					<input type="text" name="state" class="form-control" >
				</div><br> <!-- end of input-group -->

				<div class="text-center">
					<button class="btn btn-lg btn-primary mod-form-submit-button" name="submit" type="submit">Add New Address</button>	<!-- Submit Button -->
				</div>
			</form>
		</div>	
	</div>	<!-- End of container -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>