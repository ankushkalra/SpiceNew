<?php
	session_start();
	require_once('../config.php');
	require_once(APP_ROOT.'/db/db_config.php');
	$conn = mysqli_connect($db_host, $db_user, $db_userPassword, $db_name);
	if($conn->connect_errno) {
		echo $conn->connect_error;
		echo $conn->connect_errno;
		die('MySql connection failed');
	}

	if(isset($_POST['submit'])) {

		if(isset($_POST['c_name']) && isset($_POST['description'])) {
			$c_name = $_POST['c_name'];
			$description = $_POST['description'];
		}

		$query = "INSERT INTO categories(c_name, description) values ('$c_name', '$description')";
		if(mysqli_query($conn, $query)) {
			$_SESSION['message'] = "Category successfully added.";
		} else {
			echo "Query execution failed.";
			trigger_error(mysqli_error($conn)." in ".$query);
		}
	}

?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width = device-width, initial-scale=1">

	<title>Add New Product - Shiva Spices<?php echo APP_ROOT; ?>\css\bootstrap.min.css</title>

	<link rel="stylesheet" type="text/css" href="/phpw3/upload_image/css/bootstrap.min.css">

	<link rel="stylesheet" type="text/css" href="bootstrap-mod.css">
</head>

<body>

	<?php
		require_once(ADMIN.'\admin-navbar.php');
	?>
	<div class="container">
		<div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 col-sm-12 col-xs-12">

			<form method="post" action="addCategory.php" enctype="multipart/form-data">

				<?php
                    if(isset($_SESSION['message'])) {
                ?>
                 	   <p><?php echo $_SESSION['message']; ?></p>
                <?php
                    	unset($_SESSION['message']);
                    }
                ?>

				<div class="form-group">
					<label for="comment">Category Name</label>
					<input type="text" name="c_name" class="form-control" placeholder="Category Name"  required>
				</div>

				<div class="form-group">
					<label for="comment">Category Description</label>
					<textarea rows="6" cols="50" name="description" class="form-control" placeholder="Category Description" required></textarea>
				</div>

				<button name="submit" class="btn btn-lg btn-primary btn-block mod-form-submit-button" style="margin-top:20px;" type="submit">Add Category</button>	<!-- Submit Button -->

			</form>

		</div>

	</div>	<!-- End of container -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>

</html>