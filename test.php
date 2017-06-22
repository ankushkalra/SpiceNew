<?php
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

	echo date('Y-m-d', strtotime("+14 days"));
	date_default_timezone_set('Asia/Kolkata');
	$timezone = date_default_timezone_get();
	echo "The current server timezone is: " . $timezone;
	mysqli_close($conn);
?>