<?php
	session_start();
?><html>
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
		require_once('../config.php');
		require_once(ADMIN.'\admin-navbar.php');
	?>	
	<div class="container">
		<a class="btn btn-lg btn-primary btn-block mod-form-submit-button" style="margin-top:20px;" href="addProduct.php">Add Product</a>
		<a class="btn btn-lg btn-primary btn-block mod-form-submit-button" style="margin-top:20px;" href="addCategory.php">Add Category</a>
		<a class="btn btn-lg btn-primary btn-block mod-form-submit-button" style="margin-top:20px;" href="addBrand.php">Add Brand</a>
	</div>	<!-- End of container -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>

</html>