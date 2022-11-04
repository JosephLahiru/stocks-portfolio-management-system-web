<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
	    <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Change Password</title>
		<link href="https://fonts.googleapis.com/css2?family=Muli:wght@400;700&display=swap" rel="stylesheet">
	    <link rel="stylesheet" href="../css/style1.css">
	    <link rel="stylesheet" type="text/css" href="../css/payport.css">
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
			echo "<a href='produts.php'>Products</a>";
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
			            <h2 class="title">Change Password</h2><br>

			            <form action="" class="the-form" method="post">

			                <label for="old_pwd">Old Password</label>
			                <input type="password" name="old_pwd" id="old_pwd" placeholder="Enter your old password">

			                <label for="new_pwd">New Password</label>
			                <input type="password" name="new_pwd" id="new_pwd" placeholder="Enter your new password">

			                <label for="password">Comfirm Password</label>
			                <input type="password" name="com_pwd" id="com_pwd" placeholder="Comfirm password">

			                <input type="submit" value="Change Password" name="submit">

			            </form>

			        </div>
			    </div>
			</div>

			<?php
				if(isset($_POST['submit'])){
					if(!empty($_POST['old_pwd']) && !empty($_POST['new_pwd']) && !empty($_POST['com_pwd'])){
						$error = 0;

						$user_id = $_SESSION['user_id'];
						$sql_user = "SELECT * FROM customer WHERE custID=$user_id";

						$result_user = mysqli_query($conn, $sql_user);
						$data_user = mysqli_fetch_assoc($result_user);

						if(!empty($_POST['old_pwd']) && !empty($_POST['new_pwd']) && !empty($_POST['com_pwd'])){

							if($_POST['old_pwd'] == $data_user['password']){

								$new_pwd = $_POST['new_pwd'];

								if($new_pwd == $_POST['com_pwd']){
									$sql = "UPDATE customer SET password=$new_pwd WHERE custID=$user_id";
									$result = mysqli_query($conn, $sql);
								}
								else{
									echo "<br><div class='other' align='center'>New password and comfirm password does not match.</div>";
									$error = 1;
								}
							}

							else{
								echo "<br><div class='other' align='center'>Old password miss match.</div>";
								$error = 1;
							}		
						}

						else{
							echo "<br><div class='other' align='center'>Plese fill all the parameters.</div>";
							$error = 1;
						}
						if($error==0){
							echo "<script> alert('Password changed sucessfully.'); window.location.href='user_account.php';</script>";
							//header( 'Location: user_account.php' );
						}
					}
					else{
						echo "<br><div class='other' align='center'>Please fill in all the fields.</div>";
					}
				}
				
				require_once '../php_scripts/footer.php';
			?>
		</div>
	</body>
</html>