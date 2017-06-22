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

		if(isset($_POST['p_name']) && $_POST['category'] && isset($_POST['brand']) && isset($_POST['price']) && isset($_FILES['fileToUpload'])) {

			$p_name = $_POST['p_name'];
			$category = $_POST['category'];
			$brand = $_POST['brand'];
			$price = $_POST['price'];
			$quantity = $_POST['quantity'];
			$unit = $_POST['unit'];

			$uploadOk = 1;

			// first move the image in a direcotory
			$target_dir = "uploads/";
			$oldFileName = basename($_FILES["fileToUpload"]["name"]);
			$fileExtension = pathinfo($oldFileName, PATHINFO_EXTENSION);

			function uniqueNameForImage($target_dir, $fileExtension) {
				$name = base_convert(microtime(), 10, 36);
				if (file_exists($target_dir.$name.".".$fileExtension)) {
					uniqueNameForImage();
				} else return $name ;
			}

			$newFileName = uniqueNameForImage($target_dir, $fileExtension).".".$fileExtension;

			$target_file = $target_dir.$newFileName;
			
			// Allow certain file formats
			if($fileExtension != "jpg" && $fileExtension != "png" && $fileExtension != "jpeg" && $fileExtension != "gif" ) {
				echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
				$uploadOk = 0;
			}

			// Check if $uploadOk is set to 0 by an error
			if ($uploadOk == 0) {
				echo "Sorry, your file was not uploaded.";
				// if everything is ok, try to upload file
			} else {
				if(move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
					$query = "INSERT INTO products(p_name, image, price, category, brand, quantity, unit) values ('$p_name', '$target_file', '$price', 1, '$brand', '$quantity', '$unit')";
					if(mysqli_query($conn, $query)) {
						$_SESSION['message'] = "Product successfully added.";
					} else {
						echo "Query execution failed.";
						trigger_error(mysqli_error($conn)." in ".$query);
					}
				} else {
					echo "File moving failed.";
				}
			}
		} else {
			echo "Something is not set.";
		}
	}
?>
<html>
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

			<form method="post" action="addProduct.php" enctype="multipart/form-data">

				<div class="input-group input-group-lg">
					<span class="input-group-addon">Product Name</span>
					<input type="text" name="p_name" class="form-control" placeholder="Product Name"  required>
				</div><br> <!-- end of input-group -->

				<div class="input-group input-group-lg">
					<span class="input-group-addon">Category</span>
					<select class="form-control" name="category">
					<?php
						$query = "select id, c_name from categories";
						$result = mysqli_query($conn, $query);
						if($result) {
							while($row = mysqli_fetch_array($result)) {
					?>
						<option value="<?php echo $row['id']; ?>"><?php echo $row['c_name']; ?></option>

					<?php
							}
						}
					?>
					</select>
				</div><br>	<!-- end of input-group -->

				<div class="input-group input-group-lg">
					<span class="input-group-addon">Brand Name</span>
					<select class="form-control" name="brand">
					<?php
						$query = "select id, b_name from brands";
						$result = mysqli_query($conn, $query);
						if($result) {
							while($row = mysqli_fetch_array($result)) {
					?>
						<option value="<?php echo $row['id']; ?>"><?php echo $row['b_name']; ?></option>

					<?php
							}
						}
					?>
					</select>
				</div><br>	<!-- end of input-group -->

				<div class="input-group input-group-lg">
					<span class="input-group-addon">Price</span>
					<input type="number" step="0.01" min="0" class="form-control" placeholder="" name="price" required>
				</div><br>	<!-- end of input-group -->

				<div class="input-group input-group-lg">
					<span class="input-group-addon">Quantity</span>
					<input type="number" step="1" min="0" class="form-control" placeholder="" name="quantity" required>
				</div><br>	<!-- end of input-group -->

				<div class="input-group input-group-lg">
					<span class="input-group-addon">Unit</span>
					<select class="form-control" name="unit">
						<option value="Kg">Kg</option>
					</select>
				</div><br>	<!-- end of input-group -->

				<div class="input-group input-group-lg">
					<span class="input-group-addon">Image</span>
					<input type="file" name="fileToUpload" id="fileToUpload" class="form-control"  required>
				</div>	<!-- end of input-group -->

				<button name="submit" class="btn btn-lg btn-primary btn-block mod-form-submit-button" style="margin-top:20px;" type="submit">Add Product</button>	<!-- Submit Button -->

			</form>
		</div>	
	</div>	<!-- End of container -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>

</html>