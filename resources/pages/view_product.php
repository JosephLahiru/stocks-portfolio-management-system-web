<!DOCTYPE html>
<html>
	<head>
		<title>Image Info</title>
		<link rel="stylesheet" type="text/css" href="../css/listb.css">
		<link rel="stylesheet" type="text/css" href="../css/nav.css">
		<link rel="stylesheet" type="text/css" href="../css/product_info.css">
		<link rel="stylesheet" type="text/css" href="../css/main.css">
		<?php
			require_once '../php_scripts/connect.php';
			session_start();

			if(!empty($_SESSION['logged_user'])){
				$current_user = $_SESSION['logged_user'];
				//echo "<h2>Hello " . $current_user . "</h2>";
			}
			mysqli_select_db($conn, $dbname);
		?>
		<style type="text/css">
			.center {
					display: block;
					margin-left: auto;
					margin-right: auto;
					width: 50%;
					border-radius: 10px;
				}
		</style>
	</head>
	<body>
		<div class="main">
			<div class="topnav">
				<?php
					if(!empty($current_user)){
						echo "<a href='user_account.php'>Hello " . $current_user . "!</a>";
					}
					echo "<a href='user_account.php'>Account</a>";
					echo "<a href='products.php'>Products</a>";
					echo "<a href='home.php'>Home</a>";
					echo "<a href='home.php' class='none'><product src='../images/logo.png' class='logo'></a>";
					echo "</div>";

					$sql_product = "SELECT * FROM product";
					$result_product = $conn->query($sql_product);

					while($row = $result_product->fetch_assoc()){
						if($row['product_id'] == $_GET['id']){

							$_SESSION['buying_price'] = $row['product_price'];

							echo "<h1 align='center'>" . $row['product_name'] . "</h1>";

							?>
								<div align="center">
									<div style="width:700px; height: auto;">
										<?php echo "<img src=\"../images/slide" . $row['product_id'] . ".png\" style=\"width:100%\">";
										echo "<br><br>Price : Rs. " . $row['product_price'] . "<br>";
										?>
									</div>
								</div>
							<?php

							break;
						}
					}
				?>

				<form action="" method="post">
					<div align="center">
						<br>
						QTY : <input type="text" name="product_qty"><br>
						<?php $_SESSION['buying_product'] = $_GET['id'];?>
						<button onclick="window.open('payment_portal.php');" class="buy_button">Buy Now</button>
					</div>
				</form>
			</div>
		</div>
	</body>
</html>