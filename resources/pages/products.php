<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Products</title>

    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/shop-homepage.css" rel="stylesheet">
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
			echo "<a class='active' href='products.php'>Products</a>";
			echo "<a href='home.php'>Home</a>";
			echo "<a href='home.php' class='none'><img src='../images/logo.png' class='logo'></a>";

		}else{
			echo "<a href='logout.php'>Logout</a>";
			echo "<a href='user_account.php'>Hello " . $current_user . "!</a>";
			echo "<a href='user_account.php'>Account</a>";
			echo "<a class='active' href='products.php'>Products</a>";
			echo "<a href='home.php'>Home</a>";
			echo "<a href='home.php' class='none'><img src='../images/logo.png' class='logo'></a>";
		}

		echo "</div>";
	?>

</head>
<body>
	<br>
	<h1 align="center" style="font-family: 'Cinzel', serif; font-size: 60px;">Products</h1>
	<br>

	<div class="container">

	  <div class="row">

		<?php

		$sql = "SELECT * FROM `product`";

		$res = mysqli_query($conn, $sql);

		while($data = mysqli_fetch_assoc($res)){

		    echo "<div class=\"col-lg-4 col-md-6 mb-4\">";
		    echo "<div class=\"card h-100\" style=\"background-color:#696969\">";
		    echo "<a href=\"#\"><img class=\"card-img-top\" src=\"../images/slide" . $data['product_id'] . ".png\" alt=\"\"></a>";
		    echo "<div class=\"card-body\">";
		    echo "<h4 class=\"card-title\">";
		    echo "<a href=\"view_product.php?id=" . $data['product_id'] . "\">" . $data['product_name'] . "</a>";
		    echo "</h4>";
		    echo "<h5>Rs. " . $data['product_price'] . "</h5>";
		    echo "<p class=\"card-text\">" . $data['product_description'] . "</p>";
		    echo "</div>";
		    // echo "<div class=\"card-footer\">";
		    // echo "<small class=\"text-muted\">&#9733; &#9733; &#9733; &#9733; &#9734;</small>";
		    // echo "</div>";
		    echo "</div>";
		    echo "</div>";
		}

	    ?>
	  </div>

	</div>

	<?php require_once '../php_scripts/footer.php'; ?>
</body>
</html>