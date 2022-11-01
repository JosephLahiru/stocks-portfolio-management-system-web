<?php

		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "ICT2153";

		$conn = mysqli_connect($servername, $username, $password);

		if (!$conn) {
			die("Connection failed: " . mysqli_connect_error());
		}
?>