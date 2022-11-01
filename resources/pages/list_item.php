<!DOCTYPE html>
<html>
	<head>
		<title>List Item</title>
		<link rel="stylesheet" href="../css/style1.css">
		<link rel="stylesheet" type="text/css" href="../css/nav.css">
		<!-- 	<link rel="stylesheet" type="text/css" href="../css/listb.css"> -->
		<link href="https://fonts.googleapis.com/css2?family=Muli:wght@400;700&display=swap" rel="stylesheet">

		<?php
			require_once '../php_scripts/connect.php';
			session_start();

			if (!$conn) {
				die("Connection failed: " . mysqli_connect_error());
			}

			mysqli_select_db($conn, $dbname);

			if(!empty($_SESSION['logged_user'])){
				$current_user = $_SESSION['logged_user'];
				$user_id = $_SESSION['user_id'];
				//echo "<h2>Hello " . $current_user . "</h2>";
			}
		?>
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
				echo "<a href='home.php'>Home</a> </div>";
			?>

			<div class="main-container">
			    <div class="form-container">

			        <div class="form-body">

			            <h2 class="title">List Item</h2><br>

						<form action="" method="post" enctype="multipart/form-data" class="the-form">

							<label for="topic">Enter the image topic</label>
							<input type="text1" name="topic" id="topic" placeholder="Sea of Monsters">

							<label for="file">Select Image File:</label>
							<input type="file" name="image" id="file"><br>

							<label for="amount">Enter image price</label>
							<input type="text1" name="amount" id="amount" placeholder="31.41">

							<input type="submit" name="submit" value="Upload" class="upload_button">
						</form>

					</div>
				</div>
			</div>

			<?php 
				$status = $statusMsg = '';
				if(isset($_POST["submit"])){
					if(!empty($_POST['topic']) && !empty($_POST['amount'])){
						$status = 'error';
						if(!empty($_FILES["image"]["name"])) {
							$fileName = basename($_FILES["image"]["name"]);
							$fileType = pathinfo($fileName, PATHINFO_EXTENSION);

							$allowTypes = array('jpg','png','jpeg','gif');
							if(in_array($fileType, $allowTypes)){
								$image = $_FILES['image']['tmp_name'];
								$imgContent = addslashes(file_get_contents($image));
								$topic = $_POST['topic'];
								$amount = $_POST['amount'];

								$sql = "INSERT INTO images (image, created, rank, topic, user_id) VALUES ('$imgContent', NOW(), 0, '$topic', '$user_id')";
								$sql_price = "INSERT INTO image_price (amount) VALUES ('$amount');";
								//$sql = "SELECT * FROM user;";
								$insert = $conn->query($sql); 
								$insert_price = $conn->query($sql_price);

								if($insert){ 
									$status = 'success';
									//$statusMsg = "File uploaded successfully." . "<br>SQL : " . $sql;
									$statusMsg = "File uploaded successfully.";
								}else{
									$statusMsg = "File upload failed, please try again. <br> Error : " . $conn->error . "<br>SQL : " . $sql;
								}
							}
							else{
								$statusMsg = 'Sorry, only JPG, JPEG, PNG, & GIF files are allowed to upload.';
							}
						}else{
							$statusMsg = 'Please select an image file to upload.';
						}
					}
					else{
						$statusMsg = 'Please fill in all the fields.';
					}
				}
				echo "<br><div class='other' align='center'>$statusMsg</div>";

				require_once '../php_scripts/footer.php';
			?>
		</div>
	</body>
</html>