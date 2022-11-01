<!DOCTYPE html>
<html>
	<head>
		<title>Manage Users</title>
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
		<div class="main" align="center">
			<h1>Manage Users</h1><hr>
			<form method="POST" action="">
			<?php
				$sql_user = "SELECT * FROM user;";

				$result_user = mysqli_query($conn, $sql_user);

				if(!empty($result_user)){
					$user_count = mysqli_num_rows($result_user);

					echo "<h2 class='topic'>Delete User</h2>";
					echo "<table id='user' style='width:70%' align='center'>";
					echo "<tr><th>User ID</th><th>First Name</th><th>Last Name</th><th>Email</th><th>Password</th><th>Address</th><th>User Type</th><th>Choose</th></tr>";

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
						echo "<td><input type='radio' name='del_usr' value='" . $user_data['id'] . "'></td>";
						echo "</tr>";
					}
					echo "</table><br>";
					echo "<br><br><input type='submit' name='submit_del' value='Delete User' class='delete_button' style='width:160px;'><input type='reset' name='reset' value='Clear Selection' class='upload_button' style='width:160px; margin-left:10px;'>";
				}
			?>
			</form>

			<?php 
			if(isset($_POST['submit_del'])){
				if(isset($_POST['del_usr'])){
					$sql_del_user = "DELETE FROM user WHERE id=" . $_POST['del_usr'] . ";";

					if(mysqli_query($conn, $sql_del_user) == TRUE){
						echo "User Deleted Successfully";
					}else{
						echo "User deletion error : " . mysqli_error($conn);
					}
				}
				else{
					echo "<br>Please choose a user to delete.";
				}
			}
			?>
			<br><hr>
			<form action="" method="POST">
				<h2 class='topic'>Update User Data</h2>

				Enter User ID : <input type="text" name="u_id"><br><br>
				<table border="1" align="center" id="user" style="width:70%;">
					<tr><th>Field</th><th>Choose</th><th>New Data</th></tr>
					<tr><td>First Name</td><td><input type='radio' name='update_usr' value='first_name'></td><td><input type="text" name="first_name_new"></td></tr>
					<tr><td>Last Name</td><td><input type='radio' name='update_usr' value='last_name'></td><td><input type="text" name="last_name_new"></td></tr>
					<tr><td>Email</td><td><input type='radio' name='update_usr' value='email'></td><td><input type="text" name="email_new"></td></tr>
					<tr><td>Password</td><td><input type='radio' name='update_usr' value='password'></td><td><input type="text" name="password_new"></td></tr>
					<tr><td>Address</td><td><input type='radio' name='update_usr' value='address'></td><td><input type="text" name="address_new"></td></tr>
					<tr><td>User Type</td><td><input type='radio' name='update_usr' value='user_type'></td><td><!-- <input type="text" name="user_type_new"> -->
						<select name="user_type_new">
							<option value="user">user</option>
							<option value="artist">artist</option>
						</select>
					</td></tr>
				</table>
				<br>
				<input type='submit' name='submit_update' value='Update User Data' class='delete_button' style='width:180px;'><input type='reset' name='reset' value='Clear Selection' class='upload_button' style='width:160px; margin-left:10px;'>
			</form>

			<?php
				if(isset($_POST['submit_update'])){
					if(!empty($_POST['u_id'])){
						if(!empty($_POST['update_usr'])){
							if($_POST['update_usr']=="first_name"){
								$sql_update_user = "UPDATE user SET firstname='" . $_POST['first_name_new'] . "' WHERE id='" . $_POST['u_id'] . "';";
							}else if($_POST['update_usr']=="last_name"){
								$sql_update_user = "UPDATE user SET lastname='" . $_POST['last_name_new'] . "' WHERE id='" . $_POST['u_id'] . "';";
							}else if($_POST['update_usr']=="email"){
								$sql_update_user = "UPDATE user SET gmail='" . $_POST['email_new'] . "' WHERE id='" . $_POST['u_id'] . "';";
							}else if($_POST['update_usr']=="password"){
								$sql_update_user = "UPDATE user SET password='" . $_POST['password_new'] . "' WHERE id='" . $_POST['u_id'] . "';";
							}else if($_POST['update_usr']=="address"){
								$sql_update_user = "UPDATE user SET address='" . $_POST['address_new'] . "' WHERE id='" . $_POST['u_id'] . "';";
							}else if($_POST['update_usr']=="user_type"){
								$sql_update_user = "UPDATE user SET type='" . $_POST['user_type_new'] . "' WHERE id='" . $_POST['u_id'] . "';";
							}
						}
						else{
							echo "<br>Please choose a field to update.";
						}
						if(!empty($sql_update_user)){
							//echo "$sql_update_user";
							if(mysqli_query($conn, $sql_update_user)==TRUE){
								echo "<br>User data Updated Successfully";
							}else{
								echo "<br>User data update failure : " . mysqli_error($conn);
							}
						}

					}else{
						echo "<br>Please enter user id to update.";
					}
				}
			?>
			<?php require_once "admin_footer.php"; ?>
		</div>
	</body>
</html>