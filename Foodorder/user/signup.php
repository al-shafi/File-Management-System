<!DOCTYPE html>
<html class="signupbody">
<head>
	<meta charset="utf-8">
	<title>FOODIE</title>
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<link href="https://fonts.googleapis.com/css?family=Lato:100,300,300i,400,700" rel="stylesheet">
</head>
<body>
	<header>
		<div class="wrapper">
			<nav>
				<a href="../"><img src="../css/images/logo3.png"></a>
				<ul>
					<li><a href="../index.html">Home</a></li>	
					<?php
						session_start();
						
					 	if (isset($_SESSION['restaurantid']) || isset($_COOKIE['restaurantcookie'])) {
					 		
							echo "<li><a href='../restaurant'>My Restaurant</a></li>";
							echo "<li><a href='../restaurant/addfood.php'>Add Item</a></li>";
							echo "<li><a href='../include/logout.php'>Logout</a></li>";
						}elseif (isset($_SESSION['userid']) || isset($_COOKIE['usercookie'])) {
							echo "<li><a href='#'>My Info</a></li>";
							echo "<li><a href='../include/logout.php'>Logout</a></li>";
						}elseif (!isset($_SESSION['userid']) && !isset($_COOKIE['usercookie'])){
							echo "<li><a href='../include/login_rc.php'>Login</a></li>";
							echo "<li><a href='../include/signup_rc.php'>Sign up</a></li>";
						}
					?>
				</ul>
			</nav>
		</div>
	</header>
	<div class="signup">
		<div class="userSignup"><h1>Sign up as Customer</h1></div>
		<form action="" method="POST" onsubmit="return Validate()" name="vform">
			<input type="text" name="username" placeholder="Customer Name" id="vname">
			<div id="name_error" class="val_error"></div><br>
			<input type="email" name="email" placeholder="Email" id="vemail">
			<div id="email_error" class="val_error"></div><br>
			<input type="password" name="pass" placeholder="New password" id="vpassword">
			<div id="password_error" class="val_error"></div><br>
			<input type="password" name="cpass" placeholder="Confirm password" id="vcpassword">
			<div id="cpassword_error" class="val_error"></div><br>
			<input type="text" name="phone" placeholder="Phone number" id="vphone">
			<div id="phone_error" class="val_error"></div><br>
			<input type="text" name="address" placeholder="Address" id="vaddress">
			<div id="address_error" class="val_error"></div><br>
			<button type="submit" name="signup" id="vbtn">Sign up</button>
		</form>
		<span id="succmsg"></span>
	</div>
	<script type="text/javascript" src="../css/jquery.js"></script>
	<script type="text/javascript" src="../css/script.js"></script>

	
</body>
</html>

<?php
	
	include "../include/connection.php";

	
	if (isset($_SESSION['restaurantid']) || isset($_COOKIE['restaurantcookie']) || isset($_SESSION['userid']) || isset($_COOKIE['usercookie'])) {
		header("location: ../");
	}

	if (isset($_POST['signup'])) {
		$name=mysqli_real_escape_string($conn,$_POST['username']);
		$email=mysqli_real_escape_string($conn,$_POST['email']);
		$pass=mysqli_real_escape_string($conn,$_POST['pass']);
		$phone=mysqli_real_escape_string($conn,$_POST['phone']);
		$address=mysqli_real_escape_string($conn,$_POST['address']);
		$hpass=password_hash("$pass",PASSWORD_DEFAULT);
		
		if (!empty($name) || !empty($email) || !empty($pass) || !empty($phone) || !empty($address)) {
			
			$query="INSERT into customers (name,email,phone,pass,address) values ('$name','$email',$phone,'$hpass','$address');";

			if ($conn->query($query)) {
				// header("location: ../");
				echo "<p class='succmsgs'>Registration Successful</p>";
			}
		}
	}

?>

