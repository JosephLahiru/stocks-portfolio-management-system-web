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
			
			//echo $_SESSION['animal'];
			if(!empty($_SESSION['logged_user'])){
				$current_user = $_SESSION['logged_user'];
				//echo "<h2>Hello " . $current_user . "</h2>";
			}

			mysqli_select_db($conn, $dbname);
			echo "<div class='topnav'>";

			if(empty($_SESSION['logged_user'])){	
				echo "<a href='signin.php'>Sign in</a>";
				echo "<a href='login.php'>Login</a>";
				echo "<a href='art_gallery.php'>Gallery</a>";
				echo "<a class='active' href='home.php'>Home</a>";
				echo "<a href='home.php' class='none'><img src='../images/logo.png' class='logo'></a>";

			}else{
				echo "<a href='logout.php'>Logout</a>";
				echo "<a href='user_account.php'>Hello " . $current_user . "!</a>";
				echo "<a href='user_account.php'>Account</a>";
				echo "<a href='art_gallery.php'>Gallery</a>";
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

			<div class="mySlides fade">
			  <!-- <div class="numbertext">1 / 4</div> -->
			  <img src="../db_images/art_1.jpg" style="width:100%">
			  <div class="text">Crash Lands</div>
			</div>

			<div class="mySlides fade">
			  <!-- <div class="numbertext">2 / 4</div> -->
			  <img src="../db_images/art_2.jpg" style="width:100%">
			  <div class="text">Desert Valley</div>
			</div>

			<div class="mySlides fade">
			  <!-- <div class="numbertext">3 / 4</div> -->
			  <img src="../db_images/art_7.jpg" style="width:100%">
			  <div class="text">Mountains</div>
			</div>

			<div class="mySlides fade">
			  <!-- <div class="numbertext">4 / 4</div> -->
			  <img src="../db_images/art_8.jpg" style="width:100%">
			  <div class="text">Retro Planet</div>
			</div>

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
								Millanium art gallery connects audiences and art, providing an extraordinary space where contemporary life and contemporary art connect, challenge, and inspire one another. We share, develop and conserve the  National Collection of Modern and Contemporary Art for now and for the future.
							</p>
						</td>
						<td style="vertical-align: text-top;">
							<ul>
								<li>We acknowledge and respect the legacy of the artist members who built this organization.</li>
								<li>We believe the arts are essential to human existence.</li>
								<li>We believe in the power of artists working cooperatively as a community for economic viability, support, feedback, and the nurturing of new ideas.</li>
								<li>We believe in artistic excellence, innovation, and all forms of creative engagement.</li>
								<li>We strive to support artists at all stages of their careers from diverse communities, artistic genres, and traditions.</li>
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