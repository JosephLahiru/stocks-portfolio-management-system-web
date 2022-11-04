<!DOCTYPE html>
<html>
	<head>
		<title>Payment Portal</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
		<link rel="stylesheet" type="text/css" href="../css/payport.css">
		<link rel="stylesheet" type="text/css" href="../css/nav.css">
		<link rel="stylesheet" type="text/css" href="../css/listb.css">
		<?php
			require_once '../php_scripts/connect.php';
			session_start();

			if(!empty($_SESSION['logged_user'])){
				$current_user = $_SESSION['logged_user'];
			}
			mysqli_select_db($conn, $dbname);

			echo "<div class='topnav'>";

			if(!empty($current_user)){
				echo "<a href='user_account.php'>Hello " . $current_user . "!</a>";
			}
			echo "<a href='user_account.php'>Account</a>";
			echo "<a href='products.php'>Products</a>";
			echo "<a href='home.php'>Home</a>";
			echo "<a href='home.php' class='none'><product src='../images/logo.png' class='logo'></a>";
			echo "</div>";

			echo "</div>";
		?>
	</head>
	<body>
		<div align="center" class="main">
			<h1>Comfirm Payment</h1>
			<form action="" method="POST">
			<?php
				$user_id = $_SESSION['user_id'];
				$quantity = $_SESSION['buying_qty'];
				$amount = $_SESSION['buying_price'];
				$card = $_SESSION['buying_card'];
				$total = $quantity * $amount;

				echo "<table id='user'>";
				echo "<tr>";
				echo "<td>Buyer ID</td><td>$user_id ($current_user)</td>";
				echo "</tr><tr>";
				echo "<td>Amount</td><td>\$ $total</td>";
				echo "</tr><tr>";
				echo "<td>Card ID</td><td>$card</td>";
				echo "</tr>";
				echo "</table><br>";

				echo "<input type='submit' name='submit' value='Comfirm Order' id='continue_to_check' class='btn' style='width:250px'><br><br>";
			?>
			</form>
		</div>

		<?php
			if(isset($_POST['submit'])){

				$sql_transaction = "INSERT INTO transaction(img_id, artist_id, user_id, amount) VALUES ($img_id, $artist_id, $user_id, $amount);";
				$sql_update_owner = "UPDATE images SET owned = $user_id WHERE img_id=$img_id;";

				$result_sql_transaction = $conn->query($sql_transaction);
				$result_sql_update_owner = $conn->query($sql_update_owner);

				if($result_sql_transaction){ 
					$status = 'success';

					echo "<script> alert('Payment Sucessfull. Redirecting to user account.'); </script>";
					header( 'Location: user_account.php' );
				}else{
					echo "<script>alert('Payment Unsucessfull. Please try again !!!.'); </script>";
				}
			}

			require_once '../php_scripts/footer.php';
		?>
	</body>
</html>