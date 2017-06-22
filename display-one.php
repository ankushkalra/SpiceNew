<?php
	$pid = 1;
	require_once 'config.php';
    require_once APP_ROOT.'\db\db_config.php';
	$conn = mysqli_connect($db_host, $db_user, $db_userPassword, $db_name);
	if($conn->connect_errno) {
		echo $conn->connect_error;
		echo $conn->connect_errno;
		die("MySql is not working");
	}
?>
<html>
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width = device-width, initial-scale=1">

	<title>Show Product - Shiva Spices</title>

	<!-- Bootstrap library -->
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<style type="text/css">
	/*.btn-buy {
		background-color: #FA8072;
		color: #FFFFFF;
	}

	.btn-buy:hover {
		color: #fff;
	}*/
	</style>
</head>
<body>
	<div class="container" style="width:90%;">
		<h2 align="center">SoftAOX Tutorial | Creating an Online Store</h2>
		<?php
			$query = "SELECT * FROM products where id = '$pid'";
			$result = mysqli_query($conn, $query);
			if (mysqli_num_rows($result) > 0) {
				if($row = mysqli_fetch_array($result)) {
		?>
		<div class="col-lg-3">
			<?php $bs="/admin/"; ?>
			<img src="<?php echo PROJ_ROOT.$bs.$row['image']; ?>" class="img-responsive">
		</div>
		<div class="col-lg-6" style="float:left;">
			<h3><?php echo $row['p_name']; ?></h3>
			<p><?php //$row['rating']; ?></p>
			<p><?php //$row['description']; ?></p>
			<form method="post" action="shop.php">
				<input type="hidden" name="pid" value="<?php $row['id']; ?>">
				<input type="submit" class="btn btn-buy" value="Add to Cart">
			</form>
		</div>
		<?php
				}
			} else
				echo "Query failed.";
		?>
	</div>
	<!-- ajax library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
</body>
</html>