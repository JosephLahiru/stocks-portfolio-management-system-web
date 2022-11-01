<!DOCTYPE html>
<html>
	<head>
		<title>Show Tables</title>
		<link rel="stylesheet" type="text/css" href="../../css/main.css">
		<link rel="stylesheet" type="text/css" href="../../css/listb_admin.css">
		<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->
		<?php
			require_once '../../php_scripts/connect.php';

			mysqli_select_db($conn, $dbname);

			session_start();

			require_once "admin_nav.php";
		?>
	</head>
	<body>
		<div class="main">
		<?php
			//user table
			$sql_user = "SELECT * FROM user;";

			$result_user = mysqli_query($conn, $sql_user);

			if(!empty($result_user)){
				$user_count = mysqli_num_rows($result_user);

				echo "<h2 class='topic'>User Table</h2>";
				echo "<table id='user' style='width:70%' align='center'>";
				echo "<tr><th>User ID</th><th>First Name</th><th>Last Name</th><th>Email</th><th>Password</th><th>Address</th><th>User Type</th></tr>";

				for($i=0; $i<$user_count; $i++){
					$user_data = mysqli_fetch_assoc($result_user);

					echo "<tr>";
					echo "<td>" . $user_data['id'] . "</td>";
					echo "<td>" . $user_data['firstname'] . "</td>";
					echo "<td>" . $user_data['lastname'] . "</td>";
					echo "<td>" . $user_data['gmail'] . "</td>";
					echo "<td>" . $user_data['password'] . "</td>";
					echo "<td>" . $user_data['address'] . "</td>";
					echo "<td>" . $user_data['type'] . "</td>";
					echo "</tr>";
				}
				echo "</table><br>";
			}

			//credit_card table
			$sql_credit_card = "SELECT * FROM credit_card;";

			$result_credit_card = mysqli_query($conn, $sql_credit_card);

			if(!empty($result_credit_card)){
				$credit_card_count = mysqli_num_rows($result_credit_card);

				echo "<h2 class='topic'>Credit Card Table</h2>";
				echo "<table id='user' style='width:70%' align='center'>";
				echo "<tr><th>Card ID</th><th>Added Time</th><th>Card Name</th><th>Card Number</th><th>Expiry Month</th><th>Expiry Year</th><th>CCV</th><th>Owner ID</th></tr>";

				for($i=0; $i<$credit_card_count; $i++){
					$credit_card_data = mysqli_fetch_assoc($result_credit_card);

					echo "<tr>";
					echo "<td>" . $credit_card_data['card_id'] . "</td>";
					echo "<td>" . $credit_card_data['added_time'] . "</td>";
					echo "<td>" . $credit_card_data['card_name'] . "</td>";
					echo "<td>" . $credit_card_data['card_number'] . "</td>";
					echo "<td>" . $credit_card_data['exp_month'] . "</td>";
					echo "<td>" . $credit_card_data['exp_year'] . "</td>";
					echo "<td>" . $credit_card_data['cvv'] . "</td>";
					echo "<td>" . $credit_card_data['user_id'] . "</td>";
					echo "</tr>";
				}
				echo "</table><br>";
			}

			//images table
			$sql_images = "SELECT * FROM images;";

			$result_images = mysqli_query($conn, $sql_images);

			if(!empty($result_images)){
				$images_count = mysqli_num_rows($result_images);

				echo "<h2 class='topic'>Images Table</h2>";
				echo "<table id='user' style='width:70%' align='center'>";
				echo "<tr><th>Image ID</th><th>Create Date/Time</th><th>Rank</th><th>Views</th><th>Topic</th><th>Created User ID</th><th>Owner ID</th></tr>";

				for($i=0; $i<$images_count; $i++){
					$images_data = mysqli_fetch_assoc($result_images);

					echo "<tr>";
					echo "<td>" . $images_data['img_id'] . "</td>";
					echo "<td>" . $images_data['created'] . "</td>";
					echo "<td>" . $images_data['rank'] . "</td>";
					echo "<td>" . $images_data['views'] . "</td>";
					echo "<td>" . $images_data['topic'] . "</td>";
					echo "<td>" . $images_data['user_id'] . "</td>";
					echo "<td>" . $images_data['owned'] . "</td>";
					echo "</tr>";
				}
				echo "</table><br>";
			}

			//image_price table
			$sql_image_price = "SELECT * FROM image_price;";

			$result_image_price = mysqli_query($conn, $sql_image_price);

			if(!empty($result_image_price)){
				$image_price_count = mysqli_num_rows($result_image_price);

				echo "<h2 class='topic'>Image Amount Table</h2>";
				echo "<table id='user' style='width:70%' align='center'>";
				echo "<tr><th>Image ID</th><th>Amount in USD</th>";

				for($i=0; $i<$image_price_count; $i++){
					$image_price_data = mysqli_fetch_assoc($result_image_price);

					echo "<tr>";
					echo "<td>" . $image_price_data['img_id'] . "</td>";
					echo "<td>" . $image_price_data['amount'] . "</td>";
					echo "</tr>";
				}
				echo "</table><br>";
			}

			//transaction table
			$sql_transaction = "SELECT * FROM transaction;";

			$result_transaction = mysqli_query($conn, $sql_transaction);

			if(!empty($result_transaction)){
				$transaction_count = mysqli_num_rows($result_transaction);

				echo "<h2 class='topic'>Transaction Table</h2>";
				echo "<table id='user' style='width:70%' align='center'>";
				echo "<tr><th>Transaction ID</th><th>Transaction Time</th><th>Image ID</th><th>Seller ID</th><th>Buyer ID</th><th>Amount</th>";

				for($i=0; $i<$transaction_count; $i++){
					$transaction_data = mysqli_fetch_assoc($result_transaction);

					echo "<tr>";
					echo "<td>" . $transaction_data['transaction_id'] . "</td>";
					echo "<td>" . $transaction_data['transaction_time'] . "</td>";
					echo "<td>" . $transaction_data['img_id'] . "</td>";
					echo "<td>" . $transaction_data['artist_id'] . "</td>";
					echo "<td>" . $transaction_data['user_id'] . "</td>";
					echo "<td>" . $transaction_data['amount'] . "</td>";
					echo "</tr>";
				}
				echo "</table><br>";
			}

			require_once "admin_footer.php";
		?>
		</div>
	</body>
</html>