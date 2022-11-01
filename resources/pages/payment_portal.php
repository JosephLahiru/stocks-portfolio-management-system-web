<!DOCTYPE html>
<html>
	<head>
		<title>Payment Portal</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
		<link rel="stylesheet" type="text/css" href="../css/payport.css">
		<link rel="stylesheet" type="text/css" href="../css/nav.css">
		<link rel="stylesheet" type="text/css" href="../css/listb.css">
		<?php
			require_once '../php_scripts/connect.php';
			session_start();

			if(!empty($_SESSION['logged_user'])){
				$current_user = $_SESSION['logged_user'];
			}
			mysqli_select_db($conn, $dbname);

			echo "<div class='topnav'>";

			echo "<a href='user_account.php'>Hello " . $current_user . "!</a>";
			echo "<a href='user_account.php'>Account</a>";
			//echo "<a href='logout.php'>Logout</a>";
			echo "<a href='art_gallery.php'>Gallery</a>";
			echo "<a href='home.php'>Home</a> </div>";

			echo "</div>";
		?>
		<script type="text/javascript">
			$(document).ready(function(){
				$("#add_a_card").click(function(){
					$("#new_card").show();
					$('#continue_to_check').hide();
				});
			});
		</script>
	</head>
	<body>
		<div align="center" class="main">
			<h1>Payment Portal</h1>

			<?php
				$logged_user_id = $_SESSION['user_id'];
				$sql_cards = "SELECT * FROM credit_card WHERE user_id = $logged_user_id";

				$result_cards = mysqli_query($conn, $sql_cards);

				if(!empty($result_cards)){
					echo "<form action='' method='POST'>";

					$card_count = mysqli_num_rows($result_cards);

					echo "<h2 class='topic'>Choose your Card to pay with</h2>";
					echo "<table id='user' style='width:70%'>";
					echo "<tr><th>Card ID</th><th>Added Date/Time</th><th>Card Name</th><th>Card Number</th><th>Choose</th></tr>";

					for($i=0; $i<$card_count; $i++){
						$card_data = mysqli_fetch_assoc($result_cards);

						$card_id = $card_data['card_id'];
						$added_on = $card_data['added_time'];
						$card_name = $card_data['card_name'];
						$card_num = $card_data['card_number'];

						echo "<tr>";
						echo "<td>$card_id</td>";
						echo "<td>$added_on</td>";
						echo "<td>$card_name</td>";
						echo "<td>$card_num</td>";
						echo "<td><input type='radio' name='choose_card' value='$card_id'></td>";
						echo "</tr>";
					}
					echo "</table><br>";

					echo "<input type='submit' name='direct_submit' value='Continue to checkout' id='continue_to_check' class='btn' style='width:250px'><br><br>";
					echo "</form>";

				}
			?>
			<button id="add_a_card" class="btn" style="width:200px">Add a new card</button><br><br>

			<div id="new_card" style="display: none;">
				<div class="row" style="width:50%">
				  <div class="col-75">
				    <div class="container">
				      <form action="" method="POST">
				        <div class="row">
				          <div class="col-50" align="left">
				            <br>
				            <label for="fname">Accepted Cards</label>
				            <div class="icon-container">
				              <i class="fa fa-cc-visa" style="color:navy;"></i>
				              <i class="fa fa-cc-amex" style="color:blue;"></i>
				              <i class="fa fa-cc-mastercard" style="color:red;"></i>
				              <i class="fa fa-cc-discover" style="color:orange;"></i>
				            </div>
				            <label for="cname">Name on Card</label>
				            <input type="text" id="cname" name="cardname" placeholder="Elon Musk">
				            <label for="ccnum">Credit card number</label>
				            <input type="text" id="ccnum" name="cardnumber" placeholder="6969-6969-6969-6969">
				            <label for="expmonth">Exp Month</label>
				            <input type="text" id="expmonth" name="expmonth" placeholder="January">
				            <div class="row">
				              <div class="col-50">
				                <label for="expyear">Exp Year</label>
				                <input type="text" id="expyear" name="expyear" placeholder="2028">
				              </div>
				              <div class="col-50">
				                <label for="cvv">CVV</label>
				                <input type="text" id="cvv" name="cvv" placeholder="669">
				              </div>
				            </div>
				          </div>
				        </div>
				        <input type="submit" value="Continue to checkout" class="btn" name="submit">
				      </form>
				    </div>
				  </div>
				</div>
			</div>
		</div>

		<?php
			if(isset($_POST['submit'])){
				if(empty($_POST['cardname']) || empty($_POST['cardnumber']) || empty($_POST['expmonth']) || empty($_POST['expyear']) || empty($_POST['cvv'])){
					echo "<script>alert('Please fill all the fields !!!'); </script>";
				}
				else{

					$card_name = $_POST['cardname'];
					$card_number = $_POST['cardnumber'];
					$exp_month = $_POST['expmonth'];
					$exp_year = $_POST['expyear'];
					$cvv = $_POST['cvv'];

					$sql_add_card = "INSERT INTO credit_card (card_name, card_number, exp_month, exp_year, cvv, user_id) VALUES('$card_name', '$card_number', '$exp_month', '$exp_year', '$cvv', '$logged_user_id');";

					if ($conn->query($sql_add_card) === TRUE) {
					  echo "<script>window.location.href='checkout.php';</script>";
					} else {
					  echo "Error: " . $sql_add_card . "<br>" . $conn->error;
					}

					$sql_retrieve_card_id = "SELECT card_id FROM credit_card WHERE card_number='$card_number';";

					$result_retrieve_card_id = $conn->query($sql_retrieve_card_id);

					$card_id_data = mysqli_fetch_assoc($result_retrieve_card_id);

					if ($result_retrieve_card_id == TRUE) {
					  $_SESSION['buying_card'] = $card_id_data['card_id'];
					} else {
					  echo "Error: " . $sql_add_card . "<br>" . $conn->error;
					}
				}
			}

			if(isset($_POST['direct_submit'])){

				if(isset($_POST['choose_card'])){
					$_SESSION['buying_card'] = $_POST['choose_card'];
					// ob_start();
					// header( 'Location: checkout.php' );
					// ob_end_flush();
					echo "<script>window.location.href='checkout.php';</script>";
				}
				else{
					echo "Please Select a Card or Add a new Card !!!";
				}
				//echo "The chosen card is " . $_SESSION['buying_card'];
			}

			require_once '../php_scripts/footer.php';
		?>
	</body>
</html>