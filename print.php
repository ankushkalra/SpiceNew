<?php
	session_start();
?>
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
	</style>
</head>
<body>
		<?php require_once('navbar.php'); ?>
		<div class="container">
		<table class="table table-bordered">
		<?php
		if(!empty($_SESSION["cart"])) {
					$total = 0;
					foreach ($_SESSION["cart"] as $key => $value) {
						echo("Cart is set.")
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
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
</body>
</html>