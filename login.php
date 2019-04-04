<?php 
	session_start();
	if ($_SESSION['user_id'] != ''and $_SESSION['password'] != '') {
		# code...
		header('location:dashboard.php');

	}
	if(filter_has_var(INPUT_POST, "login")){
		$password = htmlspecialchars($_POST['pass']);
		$userId = htmlspecialchars($_POST['user']);
		$_SESSION['user_id'] = $userId;
		$_SESSION['password'] = $password;

		$conn = mysqli_connect("localhost","root", '123456', 'freeapp');

		if(mysqli_connect_errno()){
			echo "failed to connect MySQL: " .mysqli_connect_errno();
		}

		$sql = "SELECT * FROM `login` WHERE `password` = '$password' && `userId` = '$userId'";
		$result = mysqli_query($conn, $sql);
		$count = mysqli_num_rows($result);
		if ($count === 1) {
			header('location:dashboard.php');
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
	<link rel="stylesheet" type="text/css" href="login.css">
	<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
	<style type="text/css">
		*{
			padding: 0;
			margin: 0;
		}
		body{
			background-color: #E0E0E0;
			font-family: 'Montserrat', sans-serif;
			line-height: 2.9em;
			color: #000;
			overflow: hidden;
		}
		#nav{
			background-color: #212121;
			box-shadow: 0 5px 8px 0 rgba(0, 0,0,0.2),0 7px 20px 0 rgba(0,0,0,0.17);
		}
		#nav ul{
			padding-top: 6px;
			padding-bottom: 6px;
			text-align: left;
			margin-right: 10px;
		}
		#nav li{
			margin: 0px;
			display: inline;
			cursor: pointer;
		}
		#nav a{
			text-decoration: none;
			color: #757575;
			font-weight: bold;
			padding-left: 20px;
			font-size: 15px;
		}
		#nav a:hover{
			color: #F5F5F5;
			font-weight: bold;
		}
		.cont{
			width: 10%;
		    margin: auto;
		    margin-top: 200px;
		}
		.form{
			position: absolute;
			font-size: 16px;
			font-weight: bold;
			font-family: 'Montserrat', sans-serif;
			color: #DCEDC8;
			height: 60px;
			width: 150px;
			border:0;
			background-color: #7CB342;
			border-radius: 10px;
			outline: 0;
			cursor: pointer;
		}
		.form:focus{
			outline: 0;
		}
		.upload-box{
			position: absolute;
			left: 0;
			bottom: -100%;
			width: 100%;
			height: 100vh;
			background-image: linear-gradient(45deg,#9fbaa8,#31354c);
			transition: 0.3s;
		}
		.upload-form{
			width: 40%;
			margin: auto;
		}
		.hide-upload-btn{
			color: #000;
			position: absolute;
			top: 30px;
			right: 30px;
			cursor: pointer;
			font-size: 24px;
			opacity: .7;
		}
		.showed{
			bottom: 0;
		}

		::-webkit-scrollbar{
			width: 8px; 
		}
		::-webkit-scrollbar-thumb{
			border-radius: 10px;
			background-color: #a6a6a6;
		}
		input[type="file"]::-webkit-file-upload-button
		{
			padding: 14px;
			border: none;
			border-radius: 5px;
			background: #212121;
			color: #E0E0E0;
			font-weight: bold;
			font-family: 'Montserrat', sans-serif;
		}
	</style>
</head>
<body>
	<nav id="nav">
		<ul>
			<li><a href="" style="font-size: 24px;">LOGO</a></li>
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
</html>
