<?php
	session_start();
	$conn = mysqli_connect("localhost", "root", "", "tut");
	if(isset($_POST["add"])) {
		if(isset($_SESSION["cart"])) {
			$item_array_id = array_column($_SESSION["cart"], "product_id");
			if(!in_array($_GET['id'], $item_array_id)) {
				$count = count($_SESSION["cart"]);
				$item_array = array(
					'product_id' => $_GET['id'],
					'item_name' => $_POST['hidden_name'],
					'product_price' => $_POST['hidden_price'],
					'item_quantity' => $_POST['quantity']
				);
				$_SESSION["cart"][$count] = $item_array;
				header("Location: index.php");
    			exit;
			} else {
				foreach ($_SESSION["cart"] as $key => $value) {
					if($value["product_id"] == $_GET["id"]) {
						$_SESSION['cart'][$key]['item_quantity'] = $_SESSION['cart'][$key]['item_quantity'] + 1;
						echo $_SESSION['cart'][$key]['item_quantity'];
						header("Location: index.php");
    					exit;
					}
				}
			}
		} else {
			$item_array = array(
				'product_id' => $_GET['id'],
				'item_name' => $_POST['hidden_name'],
				'product_price' => $_POST['hidden_price'],
				'item_quantity' => $_POST['quantity']
			);
			$_SESSION["cart"][0] = $item_array;
			header("Location: index.php");
    		exit;
		}
	}

	if(isset($_GET["action"])) {
		if($_GET["action"] == "delete") {
			foreach ($_SESSION["cart"] as $key => $value) {
				if($value["product_id"] == $_GET["id"]) {
					unset($_SESSION["cart"][$key]);
					header("Location: index.php");
    				exit;
    			}
			}
		}
	}
?>