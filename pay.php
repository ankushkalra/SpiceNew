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
		$user_id = $_SESSION['user_id'];
		$address_id = $_SESSION['selected_address'];
		$date = date('Y-m-d', strtotime("now"));
		$query = "INSERT INTO orders(user_id, order_status_code, payment_method_code, address_id) values ('$user_id', 'P' , 'C', '$address_id')";
        if(mysqli_query($conn, $query)) {
        	$query = "INSERT INTO orders(user_id, order_status_code, payment_method_code, address_id, expected_delivery_date) values ('$user_id', 'P' , 'C', '$address_id','$date')";
        ////// I am here.................../////
        	//								  //
        	//								  //
        	//								  //
        	$_SESSION['message'] = "Order placed successfully";
        } else {
        	$_SESSION['message'] = "Query Execution failed";
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
		margin-bottom: 30px;
	}
	</style>
</head>
<body>

	<?php require_once('navbar.php'); ?>

	<div class="container">
		<div class="order">
			<h3>Your Order:</h3><br>
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
						<td></td>
					</tr>
				<?php
				}
				?>
			</table>
		</div>
			<form method="post" action="pay.php">
				<input class="btn" type="submit" name="submit" value="Confirm Order">
			</form>
		</div>	<!-- End of order -->
		<?php
			if(isset($_SESSION['message'])) {
		?>
				<br>
				<h4>Order has been placed. Return to <a href="index.php">Home Page</a></h4>
		<?php
			}
		?>
	</div>
</body>
</html>