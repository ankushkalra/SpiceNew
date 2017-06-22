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
?>
<!doctype html>
<html>
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width = device-width, initial-scale=1">

		<title>Show Product - Shiva Spices</title>

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

	/* css for left sidebar */
	/*						*/
	.navbar-fixed-left {
	  /*width: 140px;
	  */border-radius: 0;
	  height: 1585px;
	}

	.navbar-fixed-left .navbar-nav > li {
	  float: none;  /* Cancel default li float: left */
	  width: 139px;
	}

	.navbar-fixed-left + .container {
	  padding-left: 160px;
	}

	/* On using dropdown menu (To right shift popuped) */
	.navbar-fixed-left .navbar-nav > li > .dropdown-menu {
	  margin-top: -50px;
	  margin-left: 140px;
	}
	/* End of css for left sidebar */
	/*							   */
	</style>
</head>
<body>
	<?php require_once('navbar.php'); ?>

	<div class="container">
	<div class="col-md-3 col-sm-6">
	<div class="navbar navbar-inverse navbar-fixed-left">
		<a class="navbar-brand" href="#">SS</a>
		<ul class="nav navbar-nav">
	    	<!-- <li class="dropdown">
	    		<a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown<span class="caret"></span></a>
	     		<ul class="dropdown-menu" role="menu">
				    <li><a href="#">Sub Menu1</a></li>
		    		<li><a href="#">Sub Menu2</a></li>
		    		<li><a href="#">Sub Menu3</a></li>
		    		<li class="divider"></li>
		    		<li><a href="#">Sub Menu4</a></li>
		    		<li><a href="#">Sub Menu5</a></li>
	    		</ul>
			</li> -->
			<li><a href="category.php?cat=6">Whole Spices</a></li>
			<li><a href="category.php?cat=10">Ground Spices</a></li>
			<li><a href="about.php">About</a></li>
		</ul>	
	</div>
</div>
		
		<?php
			$cat = $_GET['cat'];
			$query = "SELECT * FROM products where category = '$cat' LIMIT 12";
			$result = mysqli_query($conn, $query);
			if (mysqli_num_rows($result) > 0) {
				while($row = mysqli_fetch_array($result)) {
		?>
		
		<div class="col-md-3 col-sm-6">
			<form method="post" action="shop.php?action=add&id=<?php echo $row['id']; ?>">
				<div class="product-container">
					<img src="<?php echo HTML_ADMIN; ?><?php echo $row['image']; ?>" class="img-responsive" style="margin-left:auto; margin-right: auto;">
					<h5 class="text-info"><?php echo $row['p_name']; ?></h5>
					<h5 class="text-danger"><?php echo $row['price']; ?></h5>
					<h5 class="text-danger"><?php echo $row['id']; ?></h5>
					<input type="text" name="quantity" class="form-control" value="1">
					<input type="hidden" name="hidden_name" value="<?php echo $row['p_name']; ?>">
					<input type="hidden" name="hidden_price" value="<?php echo $row['price']; ?>">
					<input type="submit" name="add" style="margin-top:5px;" class="btn btn-default" value="Add to Bag">
				</div>	<!-- End of product-container -->
			</form>
		</div>
		<?php
				}
			} else
				echo "Query failed.";
		?>
		<div style="clear:both"></div>
		<h2 class="second-heading">My Shopping Bag</h2>
		<div class="table-responsive">
			<table class="table table-bordered">
				<tr>
					<th width="40%">Product Name</th>
					<th width="10%">Quantity</th>
					<th width="20%">Price Details</th>
					<th width="15%">Order Total</th>
					<th width="5%">Action</th>
				</tr>
				<?php
				if(!empty($_SESSION["cart"])) {
					$total = 0;
					foreach ($_SESSION["cart"] as $key => $value) {
				?>
					<tr>
					<td><?php echo $value['item_name']; ?></td>
					<td><?php echo $value['item_quantity']; ?></td>
					<td>$ <?php echo $value['product_price']; ?></td>
					<td>$ <?php echo number_format($value['item_quantity'] * $value['product_price'], 2); ?></td>
					<td><a href="shop.php?action=delete&id=<?php echo $value["product_id"];?>"><span class="text-danger">X</span></a>
					</tr>
					<?php
					$total = $total + ($value["item_quantity"] * $value["product_price"]);
					}
					?>
					<tr>
						<td colspan="3" align="right">Total</td>
						<td align="right">$ <?php echo number_format($total,2); ?></td>
						<td><a class="btn btn-primary btn-small navbar-btn" href="checkout.php">Checkout</a></td>
					</tr>
				<?php
				}
				?>
			</table>
		</div>
	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
</body>	
</html>