<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
	    <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Login</title>
		<link href="https://fonts.googleapis.com/css2?family=Muli:wght@400;700&display=swap" rel="stylesheet">
	    <link rel="stylesheet" href="../css/style1.css">
		<link rel="stylesheet" type="text/css" href="../css/nav.css">
		<?php
			require_once '../php_scripts/connect.php';

			mysqli_select_db($conn, $dbname);

			session_start();

			if(!empty($_SESSION['logged_user'])){
				$current_user = $_SESSION['logged_user'];
			}
			mysqli_select_db($conn, $dbname);

			echo "<div class='topnav'>";

			// echo "<a href='user_account.php'>Hello " . $current_user . "!</a>";
			// echo "<a href='user_account.php'>Account</a>";
			//echo "<a href='logout.php'>Logout</a>";
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

			            <h2 class="title">Log in with</h2>

			            <div class="social-login">
			                <ul>
			                    <li class="google"><a href="#">Google</a></li>
			                    <li class="fb"><a href="#">Facebook</a></li>
			                </ul>
			            </div>

			            <div class="_or">or</div>

			            <form action="" class="the-form" method="post">

			                <label for="email">Email</label>
			                <input type="email" name="email" id="email" placeholder="Enter your email">

			                <label for="password">Password</label>
			                <input type="password" name="pwd" id="password" placeholder="Enter your password"> 

			                <input type="submit" value="Log In" name="submit">

			            </form>

			        </div>

			    </div>
			</div>

			<?php

			$found = 0;

				if(isset($_POST['submit'])){

					if(empty($_POST['email']) || empty($_POST['pwd'])){
						echo "<br><div class='other' align='center'>Please Fill All The fields !!!</div>";
					}
					else{
						$sql = "SELECT * FROM customer";
						$result = mysqli_query($conn, $sql);
						$check = mysqli_num_rows($result);
						if($check > 0){
							while($data= mysqli_fetch_assoc($result)){
								if($data["email"] == $_POST['email'] && $data["password"] == $_POST['pwd']){
									$logged_user = $data['firstName'];
									$logged_user_id = $data['custID'];
									//$_SESSION['varname'] = $var_value;

									$_SESSION['logged_user'] = $logged_user;
									$_SESSION['user_id'] = $logged_user_id;
									echo "<br>The logged in user is " . $data['firstname'];
									sleep(1);
									header( 'Location: home.php' );
									$found = 1;
									break;
								}
							}
						}

						if($found == 0){
							echo "<br><div class='other' align='center'>Login Failed Please Check Your Credentials !!!</div>";
						}
					}
				}

				echo "<div class='form-footer'>";
				echo "<div><span>Don't have an account?</span> <a href='signin.php'>Sign Up</a></div>";
			?>
		</div>
		<?php require_once '../php_scripts/footer.php';?>
	</body>
</html>