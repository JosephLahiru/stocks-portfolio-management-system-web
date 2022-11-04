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
				$id = $_SESSION['buying_id'];
				$sql_product = "SELECT * FROM product WHERE product_id = $id";
				$result_product = $conn->query($sql_product);

				while($row = $result_product->fetch_assoc()){
					$pname = $row['product_name'];
					$pdiscription = $row['product_description'];
				}

				$user_id = $_SESSION['user_id'];
				$quantity = $_SESSION['buying_qty'];
				$amount = $_SESSION['buying_price'];
				$card = $_SESSION['buying_card'];
				$total = $quantity * $amount;

				echo "<table id='user'>";
				echo "<tr>";
				echo "<td>Buyer ID</td><td>$user_id ($current_user)</td>";
				echo "</tr><tr>";
				echo "<td>Product Name</td><td>\$ $pname</td>";
				echo "</tr><tr>";
				echo "<td>Product Discruiption</td><td>\$ $pdiscription</td>";
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

				$sql_transaction = "INSERT INTO transactions (cname, pname, discription, pquantity, total, ttype) VALUES ('$current_user', '$pname', '$pdiscription', '$quantity', '$total', 'SELL');";

				$result_sql_transaction = $conn->query($sql_transaction);

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