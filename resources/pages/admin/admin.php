<!DOCTYPE html>
<html>
	<head>
		<title>Admin</title>
		<link rel="stylesheet" type="text/css" href="../../css/main.css">
		<link rel="stylesheet" type="text/css" href="../../css/listb_admin.css">
		<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
		<?php
			require_once '../../php_scripts/connect.php';

			mysqli_select_db($conn, $dbname);
			session_start();
		?>
		<script type="text/javascript">
			$(document).ready(function(){
				$("#show_terminal").click(function(){
					$("#terminal_area").show();
					$('#hide_terminal').show();
					$('#show_terminal').hide();
				});
				$("#hide_terminal").click(function(){
					$("#terminal_area").hide();
					$('#hide_terminal').hide();
					$("#show_terminal").show();
				});
			});
		</script>
	</head>
	<body>
		<div class="main" align="center">
			<hr><h1>Welcome Admin</h1><hr><br>
			<button class="upload_button" onclick="window.location.href='show_tables.php';" style="width:160px">Show Tables</button>
			<button class="upload_button" onclick="window.location.href='manage_users.php';" style="width:160px">Manage Users</button>
			<button id="show_terminal" class="upload_button" style="width:160px">Show Terminal</button>
			<button id="hide_terminal" class="upload_button" style="width:160px; display: none;">Hide Terminal</button>
			<button class="upload_button" onclick="window.location.href='../logout.php';" style="width:160px">Log out</button>
		</div>

		<br>
		<div align="center">
			<div id="terminal_area" style="display: none; border: 4px solid green; padding: 20px; width: 400px;">
				<form action="" method="POST">
					<input type="text" name="command">
					<br><br><input type='submit' name='submit_commnd' value='Run Command' class='delete_button' style='width:180px;'>
				</form>
			</div><br>
		</div>

		<?php
		echo "<div align='center'>";
			if(isset($_POST['submit_commnd'])){
				if(!empty($_POST['command'])){
					$sql_command = $_POST['command'];

					//echo "<br>The command is : $sql_command";

					$result = mysqli_query($conn, $sql_command);

					if($result == NULL){
						echo "Error occured : " . mysqli_error($conn);
					}else{
						while($data = mysqli_fetch_assoc($result)){
							print_r($data);
							echo "<br>";
						}
					}
				}
			}
		echo "<div>";
		?>

		<?php require_once "admin_footer.php"; ?>
	</body>
</html>