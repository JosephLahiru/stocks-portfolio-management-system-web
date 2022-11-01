<!DOCTYPE html>
<html>
	<head>
		<title>Gallery</title>
		<link rel="stylesheet" type="text/css" href="../css/gallery.css">
		<link rel="stylesheet" type="text/css" href="../css/nav.css">
		<link rel="stylesheet" type="text/css" href="../css/main.css">
		<?php
			require_once '../php_scripts/connect.php';
			session_start();

			if (!$conn) {
				die("Connection failed: " . mysqli_connect_error());
			}
			//echo $_SESSION['animal'];
			if(!empty($_SESSION['logged_user'])){
				$current_user = $_SESSION['logged_user'];
				//echo "<h2>Hello " . $current_user . "</h2>";
			}
			mysqli_select_db($conn, $dbname);
		?>
	</head>
	<body>
		<div class="main">
			<div class="topnav">
			<?php
				if(empty($current_user)){
					$current_user = "Guest";
				}
				if($current_user != "Guest"){
					echo "<a href='user_account.php'>Hello " . $current_user . "!</a>";
					echo "<a href='user_account.php'>Account</a>";
				}
				//echo "<a href='logout.php'>Logout</a>";
				echo "<a class='active' href='art_gallery.php'>Gallery</a>";
				echo "<a href='home.php'>Home</a>";
				echo "<a href='home.php' class='none'><img src='../images/logo.png' class='logo'></a>";
				echo " </div>";

				$sql = "SELECT image, img_id FROM images ORDER BY img_id DESC;";
				$result = $conn->query($sql);

				if($result->num_rows > 0){
					echo "<div class='gallery'>";
					while($row = $result->fetch_assoc()){
						?>
							<a href="img_info.php?img_id=<?php echo($row['img_id']);?>">
								<img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['image']); ?>"/>
							</a>
						<?php
					}
					echo "</div>";
				}else{
					echo "<p class='status error'>Image(s) not found...</p>";
				}

				require_once '../php_scripts/footer.php';
			?>
			</div>
		</div>
	</body>
</html>