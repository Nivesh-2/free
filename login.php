<?php 
	if(filter_has_var(INPUT_POST, "login")){
		$password = htmlspecialchars($_POST['pass']);
		$userId = htmlspecialchars($_POST['user']);

		$conn = mysqli_connect("localhost","root", '123456', 'freeapp');

		if(mysqli_connect_errno()){
			echo "failed to connect MySQL: " .mysqli_connect_errno();
		}

		$sql = "SELECT * FROM `login` WHERE `password` = '$password' && `userId` = '$userId'";
		$result = mysqli_query($conn, $sql);
		$count = mysqli_num_rows($result);
		if ($count === 1) {
			header('location:dashbord.php');
		}
		else {
			echo "<script> alert('cant able to login')</script>";
		}
	}
 ?>
<!DOCTYPE>
<html>
<head>
	<title>Freeapp</title>
	<link rel="stylesheet" type="text/css" href="index.css">
	<link rel="stylesheet" type="text/css" href="login.css">
	<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
</head>
<body>
	<nav id="nav" style="padding-top: 30px; padding-left: 50px;">
		<h1>LOGO</h1>
		<ul>
			<li><a href="index.php">HOME</a></li>
			<li><a href="login.php" style="color: #F5F5F5;">LOGIN</a></li>
			<li><a href="about.php">ABOUT US</a></li>
			<li><a href="contact.php">CONTACT US</a></li>
		</ul>
	</nav>
	<div class="container">
		<div class="box">
			<h1>Login</h1>
			<form method="post" action="#">
				<div class="inputBox">
					<input type="text" name="user" required="">
					<label>User ID</label>
				</div>
				<div class="inputBox">
					<input type="password" name="pass" required="">
					<label>Password</label>
				</div>
				<button style="padding: 10px; font-weight: bold; margin: 10px; margin-top: 14px; border: none; border-radius: 6px; outline: none; border: 2px solid #3F51B5; background: #303F9F; color: #C5CAE9;" name="login">Login</button>
			</form>
		</div>
	</div>
</body>