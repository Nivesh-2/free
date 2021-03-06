<!DOCTYPE>
<html>
<head>
	<title>Freeapp</title>
	<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
	<style type="text/css">
		*{
			padding: 0;
			margin: 0;
		}
		body{
			font-family: 'Montserrat', sans-serif;
			line-height: 2.9em;
			color: #000;
			overflow: hidden;
			background-image: url(wall.jpg);
			background-size: cover;
			background-attachment: fixed;
		}
		#nav{
			background-color: #fff;
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
			color: #212121;
			font-weight: bold;
			padding-left: 20px;
			font-size: 15px;
		}
		#nav a:hover{
			color: #757575;
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
			<li><a href="login.php">LOGIN</a></li>
			<li><a href="about.php">ABOUT US</a></li>
			<li><a href="contact.php" style="color: #757575;">CONTACT US</a></li>
		</ul>
	</nav>
	<div style="width: 80%; margin: auto; padding-top: 30px; line-height: 30px; text-align: center;">
		<h1 style="font-size: 50px;">Contact Us</h1><br>
		<p style="font-size: 16px;">
		Phone Number: 1234567890<br>
		Email: afhklasdf<br>
		</p><br>
		<p style="font-size: 16px;">
		Phone Number: 1234567890<br>
		Email: afhklasdf<br>
		</p>
	</div>
</body>
</html>
