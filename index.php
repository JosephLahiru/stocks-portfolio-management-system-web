<!DOCTYPE html>
<html>
	<head>
		<title>SPMS</title>

		<style type="text/css">
			body{
				background-image: url("resources/images/cover2.png");
				background-repeat: no-repeat;
				background-size: cover;
			}

			.loader {
			  border: 16px solid #f3f3f3;
			  border-radius: 50%;
			  border-top: 16px solid #3498db;
			  width: 80px;
			  height: 80px;
			  -webkit-animation: spin 2s linear infinite; /* Safari */
			  animation: spin 2s linear infinite;
			}

			@keyframes spin {
			  0% { transform: rotate(0deg); }
			  100% { transform: rotate(360deg); }
			}

			.spacing{
				height: 560px;
			}

			.error{
				color: white;
				text-align: center;
				font-size: 30px;
			}

			.setup_button {
			  background-color: white; 
			  color: black; 
			  border: 2px solid #4CAF50;
			  transition-duration: 0.2s;
			  height: 30px;
			  width: 80px;
			  font-size: 20px;
			  border-radius: 5px;
			}

			.setup_button:hover {
			  background-color: #4CAF50;
			  color: white;
			}

			.continue_button {
			  background-color: white; 
			  color: black; 
			  border: 2px solid red;
			  transition-duration: 0.2s;
			  height: 30px;
			  width: 80px;
			  font-size: 20px;
			  border-radius: 5px;
			}

			.continue_button:hover {
			  background-color: red;
			  color: white;
			}

			.warning{
				width: 12%;
				height: auto;
			}

		</style>

		<?php require_once 'resources/php_scripts/connect.php';

		$db_check_sql = "SHOW DATABASES LIKE 'spms';";

		$db_check_result = mysqli_query($conn, $db_check_sql);

		if($db_check_result != NULL){
			$db_check_data_rows = mysqli_num_rows($db_check_result);

			if($db_check_data_rows>0){
				echo "<style>.warning{display:none;}</style>";
				echo "<meta http-equiv='refresh' content='3; URL=resources/pages/home.php'>";
			}else{
				echo "<div class='error'>SPMS DATABASE NOT FOUND<br>PLEASE USE THE create_db.php FILE TO SETUP THE DATABASE.</div>";
				echo "<br><div align='center'><button class='setup_button' onclick=\"window.location.href='resources/pages/create_db.php';\" style='width:160px; margin-right:5px'>Setup Database</button>";
				echo "<button class='continue_button' onclick=\"window.location.href='resources/pages/home.php';\" style='width:190px'>Continue Anyway</button></div>";
				echo "<style>.loader{display:none;} .spacing{height: 430px;}</style>";
				
			}

		}else{
			echo "Mysql server connection error : " . mysqli_error($conn);
		}

		?>
	</head>
	<body>
		<br><br><br>
		<div class="spacing"></div>
		<div align="center">
			<div class="loader"></div>
			<div id="warning"><img src="resources/images/warning.png" class="warning"></div>
		</div>
	</body>
</html>