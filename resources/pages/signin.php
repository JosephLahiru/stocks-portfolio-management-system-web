<!DOCTYPE html>
<html>
	<head>
		<title>Sign In</title>
		<link href="https://fonts.googleapis.com/css2?family=Muli:wght@400;700&display=swap" rel="stylesheet">
	    <link rel="stylesheet" href="../css/signin.css">
	    <link rel="stylesheet" type="text/css" href="../css/nav.css">
		<?php
			require_once '../php_scripts/connect.php';

			mysqli_select_db($conn, $dbname);

			echo "<div class='topnav'>";

			echo "<a href='art_gallery.php'>Gallery</a>";
			echo "<a href='home.php'>Home</a>";
			echo "<a href='home.php' class='none'><img src='../images/logo.png' class='logo'></a>";

			echo "</div>";
		?>
	</head>
	<body>
		<div class="main">
		    <div class="main-container">
		        <div class="form-container">
		            <div class="form-body">
		                <h1 class="title">Sign  In</h1><br>

		                <form action="" class="the-form" method="POST">
						
							<label for="fname">First Name:</label>
		                    <input type="text" name="fname" id="fname" placeholder="Enter Your First name">
							
							<label for="lname">Last Name:</label>
		                    <input type="text" name="lname" id="lname" placeholder="Enter Your Last name">

		                    <label for="email">Email:</label>
		                    <input type="email" name="email" id="email" placeholder="Enter your email">
							
							<label for="address">Address:</label>
		                    <input type="textarea" name="address" id="address" placeholder="Enter your address">
							
							<label for="usertype">User Type:</label>
							<select name="type"class="text" id="usertype">
		                        <option>user</option>
		                        <option>artist</option>
							</select>

		                    <label for="password">Password:</label>
		                    <input type="password" name="pwd" id="pwd" placeholder="Enter your password">

		                    <input type="submit" value="Sign In" name="submit">

		                </form>

		            </div>
		        </div>
		    </div>
		</div>

		<?php
			if(isset($_POST['submit'])){

				if(empty($_POST['fname']) && empty($_POST['lname']) && empty($_POST['email']) && empty($_POST['pwd']) && empty($_POST['address'])){
					echo "<br><div class='other' align='center'>Please fill all the fields !!</div>";
				}
				else if(empty($_POST['fname'])){
					echo "<br><div class='other' align='center'>Please enter your first name !!</div>";
				}
				else if(empty($_POST['lname'])){
					echo "<br><div class='other' align='center'>Please enter your last name !!</div>";
				}

				else if(empty($_POST['email'])){
					echo "<br><div class='other' align='center'>Please enter your email !!</div>";
				}

				else if(empty($_POST['pwd'])){
					echo "<br><div class='other' align='center'>Please enter your password !!</div>";
				}

				else if(empty($_POST['address'])){
					echo "<br><div class='other' align='center'>Please enter your address !!</div>";
				}
				else{

					$sql = "INSERT INTO user (firstname, lastname, gmail, password, address, type) VALUES ('" . $_POST['fname'] . "', '" . $_POST['lname'] . "', '" . $_POST['email'] . "', '" . $_POST['pwd'] . "', '" . $_POST['address'] . "', '" . $_POST['type'] . "');";

					if ($conn->query($sql) === TRUE) {
					  echo "New record created successfully";
					  sleep(2);
					  header( 'Location: login.php' );
					} else {
					  echo "Error: " . $sql . "<br>" . $conn->error;
					}
				}
			}

			echo "<div class='form-footer'>";
			echo "<div><span>Already Have an account?</span> <a href='login.php'>Log In Here</a></div>";
			echo "</div>";

			require_once '../php_scripts/footer.php';
		?>
	</body>
</html>