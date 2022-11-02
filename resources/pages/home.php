<!DOCTYPE html>
<html>
	<head>
		<title>Home</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="../css/main.css">
		<link rel="stylesheet" type="text/css" href="../css/nav.css">
		<link rel="stylesheet" type="text/css" href="../css/slideshow.css">
		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Cinzel&family=Ubuntu:wght@300&display=swap" rel="stylesheet">
		
		<?php
			require_once '../php_scripts/connect.php';
			session_start();
			
			if(!empty($_SESSION['logged_user'])){
				$current_user = $_SESSION['logged_user'];
			}

			mysqli_select_db($conn, $dbname);
			echo "<div class='topnav'>";

			if(empty($_SESSION['logged_user'])){	
				echo "<a href='signin.php'>Sign in</a>";
				echo "<a href='login.php'>Login</a>";
				echo "<a href='products.php'>Products</a>";
				echo "<a class='active' href='home.php'>Home</a>";
				echo "<a href='home.php' class='none'><img src='../images/logo.png' class='logo'></a>";

			}else{
				echo "<a href='logout.php'>Logout</a>";
				echo "<a href='user_account.php'>Hello " . $current_user . "!</a>";
				echo "<a href='user_account.php'>Account</a>";
				echo "<a href='products.php'>Products</a>";
				echo "<a class='active' href='home.php'>Home</a>";
				echo "<a href='home.php' class='none'><img src='../images/logo.png' class='logo'></a>";
			}

			echo "</div>";
		?>
	</head>
	<body>
		<div class="main">
			<h1 align="center" style="font-family: 'Cinzel', serif; font-size: 50px;">Welcome To Stocks Portfolio<br>Management System</h1>

			<div class="slideshow-container">

			<?php

			$sql = "SELECT * FROM `product`";

			$res = mysqli_query($conn, $sql);

			while($data = mysqli_fetch_assoc($res)){
				echo "<div class=\"mySlides fade\">";
				echo "<img src=\"../images/slide" . $data['product_id'] . ".png\" style=\"width:100%\">";
				echo "<div class=\"text\">" . $data['product_name'] . "</div>";
				echo "</div>";
			}

			?>
			</div>
			<br>

			<div style="text-align:center">
			  <span class="dot"></span> 
			  <span class="dot"></span> 
			  <span class="dot"></span>
			  <span class="dot"></span>
			</div>

		</div>
		<br>
		<div align="center">
			<div style="background-color: rgba(105, 105, 105, 0.75); width: 90%; border-radius: 10px;">
				<table style="width:95%;">
					<col style="width:50%">
					<col style="width:50%">
					<tr>
						<td>
							<h2>About us</h2>
						</td>
						<td>
							<h2>Our targets</h2>
						</td>
					</tr>
					<tr>
						<td style="vertical-align: text-top;">
							<p style="text-align: justify; padding: 5px;">
								Stocks Portfolio Management system is an online platform that is designed to increase the throughput and efficiency of shop inventories.
							</p>
						</td>
						<td style="vertical-align: text-top;">
							<ul>
								<li>Increase Material Availability.</li>
								<li>Better Level of Customer Service.</li>
								<li>Optimizing Product Sales.</li>
								<li>Cost-Effective Storage.</li>
								<li>Reducing Cost Value of Inventories.</li>
								<li>Maintaining Sufficient Stock.</li>
								<li>Keeping Wastage and Losses to a Minimum.</li>
							</ul>
						</td>
					</tr>
				</table>
			</div>	
		</div>

		<script>
			let slideIndex = 0;
			showSlides();

			function showSlides() {
			  let i;
			  let slides = document.getElementsByClassName("mySlides");
			  let dots = document.getElementsByClassName("dot");
			  for (i = 0; i < slides.length; i++) {
			    slides[i].style.display = "none";  
			  }
			  slideIndex++;
			  if (slideIndex > slides.length) {slideIndex = 1}    
			  for (i = 0; i < dots.length; i++) {
			    dots[i].className = dots[i].className.replace(" active", "");
			  }
			  slides[slideIndex-1].style.display = "block";  
			  dots[slideIndex-1].className += " active";
			  setTimeout(showSlides, 4000);
			}
		</script>

		<?php require_once '../php_scripts/footer.php'; ?>
	</body>
</html>