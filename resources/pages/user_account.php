<!DOCTYPE html>
<html>
<head>
	<title>Account</title>
	<link rel="stylesheet" type="text/css" href="../css/nav.css">
	<link rel="stylesheet" type="text/css" href="../css/listb_admin.css">
	<link rel="stylesheet" type="text/css" href="../css/main.css">
	<?php
		require_once '../php_scripts/connect.php';

		mysqli_select_db($conn, $dbname);

		session_start();

		if(!empty($_SESSION['logged_user'])){
			$current_user = $_SESSION['logged_user'];
			//echo "<h1 align='center'>Hello " . $current_user . "</h1>";
		}
	?>
	<style type="text/css">
		body {font-family: Verdana, sans-serif;
	}
	</style>
</head>
<body>
<div class="main">
	<div class="topnav">
	<?php
		echo "<a href='user_account.php'>Hello " . $current_user . "!</a>";
		echo "<a class='active' href='user_account.php'>Account</a>";
		//echo "<a href='logout.php'>Logout</a>";
		echo "<a href='products.php'>Products</a>";
		echo "<a href='home.php'>Home</a>";
		echo "<a href='home.php' class='none'><img src='../images/logo.png' class='logo'></a>";
		echo "</div>";

		$sql = "SELECT * FROM `customer`";
		$result = mysqli_query($conn, $sql);
		$check = mysqli_num_rows($result);
		$logged_user_id = $_SESSION['user_id'];
		if($check > 0){
			while($data= mysqli_fetch_assoc($result)){
				if($data["custID"] == $logged_user_id){
					$logged_user = $data['firstName'];			

					break;
				}
			}
		}

		//user details area
		$sql = "SELECT * FROM customer WHERE custID=$logged_user_id";
		$result = mysqli_query($conn, $sql);
		$data = mysqli_fetch_assoc($result);

		$firstname = $data['firstName'];
		$lastname = $data['lastName'];
		$gmail = $data['email'];
		$address = $data['address'];

		echo "<div align='center'>";
		echo "<div style=\"background-color: rgba(105, 105, 105, 0.75); width: 90%; border-radius: 10px; padding:20px;\">";

		echo "<h2 class='topic'>User Data</h2>";
		echo "<table border='1' id='user'>";
		echo "<tr><td>First Name</td><td>$firstname</td></tr>";
		echo "<tr><td>Last Name</td><td>$lastname</td></tr>";
		echo "<tr><td>Gmail</td><td>$gmail</td></tr>";
		echo "<tr><td>Address</td><td>$address</td></tr>";
		echo "</table>";

		//add user functions
		//change password, logout
		echo "<br><div align='center'><a href='logout.php'><button class='list_button'>Logout</button></a>";
		echo "<a href='change_pwd.php'><button class='list_button' style='width:190px;'>Change Password</button></a>";

		echo "</div>";
		echo "</div>";

		require_once '../php_scripts/footer.php';
	?>
	</div>
</body>
</html>