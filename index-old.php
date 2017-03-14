<?php

$current_page = basename($_SERVER['PHP_SELF']);

require_once("library.php");

processRequests();

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title>Stuff Dogs Like</title>
	<!-- FONT AWESOME & GOOGLE FONTS -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href="https://fonts.googleapis.com/css?family=Comfortaa|Dosis|Indie+Flower|Yellowtail|Caveat" rel="stylesheet">
	<!-- BOOTSTRAP -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  	<!-- PERSONAL STYLE -->
  	<link rel="stylesheet" type="text/css" href="dogcommerce-new.css">
</head>
<body>

<!-- HEADER -->

<?php require_once("header-carousel.html"); ?>

<!-- CONTENT PAGE -->
	<div class="container" id="shop" name="shop">
		<div class="row">
			<div class="welcome-text text-center">
				<?php welcomeText(); ?>		
			</div>
			<div class="well col-xs-12 col-sm-9 col-md-9 col-lg-8 left">
				<?php 	
					if ($current_page == 'about.php') {
					echo "<h3>About</h3>
						<div class='about text-center'>
						<img src='photos/babydog.jpg'>
						<p><strong>Stuff Dogs Like</strong> is inspired by Winter, a 3-year-old Japanese Spitz currently residing in Manila.</p>
						</div>";
				} 
				else if ($current_page == 'contact.php') {
					echo "<h3>Contact Us</h3>
						<div class='contact text-center'>
						<img src='photos/babydog2.jpg'>
						<p><span>Digits:</span> 09xx-xxx-xxxx</p>
						<p><span>Email:</span> stuffdogslike@winter.com</p>
						<p><span>Address:</span> Tuitt Coding Bootcamp<br>
						Centro Plaza Building <br> Sct. Madriñan cor. Sct. Torillo<br>
						Brgy. South Triangle, Quezon City</p>
						</div>";
				}
				else if ($current_page == 'doggiecart.php') {
					echo "<h3>Doggie Cart</h3>";
					dogCart();
				}
				else {
					require_once("left.html");
				}
				?>
			</div>

			<div class="col-xs-12 col-sm-3 col-md-3 col-lg-4 right">
				<?php require_once("right.html"); ?>
			</div> <!-- end all right -->
		</div> <!-- end row middle post -->
	</div> <!-- end container class -->
  

<!-- FOOTER -->
<footer class="container-fluid text-center">
	<?php require_once("footer.html"); ?>
</footer>

<script>

	function signUp() {
		$('#login-form').hide();
		$('#signup-form').show();
	}

	function cancelSignUp() {
		$('#login-form').show();
		$('#signup-form').hide();
	}

	function cancelEdit() {
		$('#add-item').hide();
	}

</script>

</body>
</html>

