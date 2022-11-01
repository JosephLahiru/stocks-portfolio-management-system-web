<?php
		// $servername ="gator4256.hostgator.com";
		// $username = "clapde83_joseph";
		// $password = "AoftCt2dOD9P";
		// $dbname = "clapde83_mini_project";

		$servername = "152.70.158.151";
		$username = "root";
		$password = "amres";
		$dbname = "spms";

		// $servername ="remotemysql.com";
		// $username = "FOvR1vFoHu";
		// $password = "WQWuM2aI8L";
		// $dbname = "FOvR1vFoHu";

		$conn = mysqli_connect($servername, $username, $password);

		if (!$conn) {
			die("Connection failed: " . mysqli_connect_error());
		}
?>