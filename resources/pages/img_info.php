<!DOCTYPE html>
<html>
	<head>
		<title>Image Info</title>
		<link rel="stylesheet" type="text/css" href="../css/listb.css">
		<link rel="stylesheet" type="text/css" href="../css/nav.css">
		<link rel="stylesheet" type="text/css" href="../css/img_info.css">
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
				//echo "<a href='logout.php'>Logout</a>";
				echo "<a href='art_gallery.php'>Gallery</a>";
				echo "<a href='home.php'>Home</a>";
				echo "<a href='home.php' class='none'><img src='../images/logo.png' class='logo'></a>";
				echo "</div>";
				//echo "The image id is " . $_GET['img_id'];

				$sql_img = "SELECT * FROM images ORDER BY img_id DESC;";
				$result_img = $conn->query($sql_img);

				$img_id = $_GET['img_id'];

				$sql_img_price = "SELECT amount FROM image_price WHERE img_id=$img_id;";
				$result_img_price = $conn->query($sql_img_price);

				$img_price = $result_img_price->fetch_row()[0];

				$_SESSION['buying_price'] = $img_price;

				if($result_img->num_rows > 0){
					while($row = $result_img->fetch_assoc()){
						if($row['img_id'] == $_GET['img_id']){
							$user=$row['user_id'];
							$sql_user = "SELECT id, firstname, lastname FROM user WHERE id=$user;";

							$result_usr = $conn->query($sql_user);
							$row_usr = $result_usr->fetch_assoc();

							$first = $row_usr['firstname'];
							$last = $row_usr['lastname'];
							$created = $row['created'];
							$topic = $row['topic'];
							$owned_id = $row['owned'];

							$sql_owned_user = "SELECT firstname, lastname FROM user WHERE id=$owned_id;";
							$result_owned_usr = $conn->query($sql_owned_user);
							if(!empty($result_owned_usr)){
								$row_owned_usr = $result_owned_usr->fetch_assoc();

								$owned = $row_owned_usr['firstname'] . " " . $row_owned_usr['lastname'];
							}

							$_SESSION['buying_artist_id'] = $row_usr['id'];
							$_SESSION['buying_artist_name'] = $row_usr['firstname'];
							$_SESSION['buying_image_topic'] = $topic;

							echo "<h1 align='center'>$topic</h1>";

							?>
								<div align="center">
									<div style="width:1000px; height: auto;">
										<img class="center" src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['image']); ?>"/>
									</div>							
								</div>
							<?php

							echo "<br><div align='center' class='txt'>Artist : $first $last<br>";
							echo "Created on : $created<br>";
							echo "Price : \$ $img_price<br>";
							if(isset($owned)){
								echo "Owned by : $owned<br></div>";
							}else{
								echo "</div>";
							}
							break;
						}
					}
					//$view = $row['views'];
					//echo "<div>Current Views : $view</div>";
					?>
		<!-- 			<form action="" method="post">
						<input type="submit" name="rank_up" value="Vote Up">
					</form> -->
					<?php
						// $new_view = $view+1;
						// $img_id = $_GET['img_id'];

						// $view_update_sql = "UPDATE images SET views=$new_view WHERE img_id=$img_id;";
						// if ($conn->query($view_update_sql) === TRUE) {
						// 	// echo "Record updated successfully";
						// 	// sleep(2);
						// 	// header( 'Location: img_info.php?img_id=$img_id' );

						// } else {
						// 	echo "Error: " . $sql . "<br>" . $conn->error;
						// }
					// if(isset($_POST['rank_up'])){
						// $new_rank = $rank+1;
						// $img_id = $_GET['img_id'];

						// $rank_update_sql = "UPDATE images SET rank=$new_rank WHERE img_id=$img_id;";
						// if ($conn->query($rank_update_sql) === TRUE) {
						// 	echo "Record updated successfully";
						// 	sleep(2);
						// 	header( 'Location: img_info.php?img_id=$img_id' );

						// } else {
						// 	echo "Error: " . $sql . "<br>" . $conn->error;
						// }
					// }

				}else{
					echo "<p class='status error'>Image(s) not found...</p>";
				}

			if(!empty($current_user)){
			?>
			<form action="" method="post">
				<div align="center">
					<?php $_SESSION['buying_img'] = $_GET['img_id'];?>
					<button onclick="window.open('payment_portal.php');" class="buy_button">Buy Now</button>
					<!-- <input class="cart_button" type="submit" name="cart" value="Add To Cart"> -->
				</div>
			</form>

			<?php
			}
				if(isset($_POST['cart'])){
					echo "<script>alert('added to cart successfully');</script>";
				}

				require_once '../php_scripts/footer.php';
			?>
			</div>
		</div>
	</body>
</html>