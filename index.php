<?php 
	if(filter_has_var(INPUT_POST, "submit")){
		$title = htmlspecialchars($_POST["title"]);
		$short = htmlspecialchars($_POST["short"]);
		$long = htmlspecialchars($_POST['long']);
		$icon = $_FILES['icon']['name'];
		$tempIcon = $_FILES['icon']['tmp_name'];
		$graphic = $_FILES['graphic']['name'];
		$tempGraphic = $_FILES['graphic']['tmp_name'];
		$video = htmlspecialchars($_POST['promo']);
		$policy = htmlspecialchars($_POST['policy']);
		$apk = $_FILES['apk']['name'];
		$tempApk = $_FILES['apk']['tmp_name'];
		$name = htmlspecialchars($_POST['user']);
		$email = htmlspecialchars($_POST['email']);
		$phone = htmlspecialchars($_POST['phone']);


		$conn = mysqli_connect("localhost","root", '123456', 'freeapp');


		$uppr_case = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
		$lower_case = "abcdefghijklmnopqrstuvwxyz";
		$number = "1234567890";
		$generate_uppr_case = substr(str_shuffle($uppr_case), 0, 2);
		$generate_lower_case = substr(str_shuffle($lower_case), 0, 2);
		$generate_number = substr(str_shuffle($number), 0, 2);
		$mixed = "$generate_uppr_case$generate_lower_case$generate_number";
		$generte_mixed = substr(str_shuffle($mixed), 0, 6);


		//echo md5($generte_mixed);
		$user_id = substr($title, 0, 3) . '@' . date("m.y") . '_' . substr(str_shuffle($number), 0, 3);
		//echo $user_id;



		if(mysqli_connect_errno()){
			echo "failed to connect MySQL: " .mysqli_connect_errno();
		}
		$i = 0;
		$screenshotsName = '';
		while ($i < count($_FILES['screenshots']['name'])) {
			$tempScreenshots = $_FILES['screenshots']['tmp_name'][$i];
			$screenshots = $_FILES['screenshots']['name'][$i];
			$screenshots_name = $user_id . '_' . $screenshots;
			move_uploaded_file($tempScreenshots, "screenshots/$screenshots_name");
			$screenshotsName = $screenshotsName . $screenshots_name . ', ';
			$i++;
		}
		$apk_name = $user_id . '_' . $apk;
		$icon_name = $user_id . '_'. $icon;
		$graphic_name = $user_id.'_'. $graphic;
		move_uploaded_file($tempApk, "apk/$apk_name");
		move_uploaded_file($tempIcon, "icon/$icon_name");
		move_uploaded_file($tempGraphic, "graphic/$graphic_name");
		$sql = "INSERT INTO `upload-form`(`title`, `short`, `longDis`, `screenshots`, `icon`, `graphic`, `video`, `policy`, `apk`, `name`, `email`, `phone`) VALUES ('$title','$short','$long','$screenshotsName','$icon','$graphic','$video','$policy','$apk','$name','$email','$phone')";

		$sqlLogin = "INSERT INTO `login`(`name`, `email`, `userId`, `password`, `phone`) VALUES ('$name', '$email', '$user_id', '$generte_mixed', '$phone')" ;
		$run = mysqli_query($conn, $sql);
		$run_login = mysqli_query($conn, $sqlLogin);

		$subject  = 'Username And Password';
		$body = '<h4>User ID: </h4><p>' . $user_id .'</p>
			<h4> Password: </h4><p>' . $generte_mixed. '</p>';
		$mail = "";

		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-Type:text/html;charset-UTF-8" . "\r\n";
		$headers  .= "From: ". "Freeapp" .'<'.$mail.'>'."\r\n";

		mail($email, $subject, $body, $headers);

		echo "<script>alert('Upload Successfully')</script>";
	}
 ?>

<!DOCTYPE>
<html>
<head>
	<title>Freeapp</title>
	
	<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
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
			<li><a href="index.php" id="active" style="color: #F5F5F5;">HOME</a></li>
			<li><a href="login.php">LOGIN</a></li>
			<li><a href="about.php">ABOUT US</a></li>
			<li><a href="contact.php">CONTACT US</a></li>
		</ul>
	</nav>
	<div class="cont">
		<button class="form" style="height: 60px;">Upload Here!</button>
	</div>
	<div class="upload-box">
		<div class="hide-upload-btn"><i class="fas fa-times"></i></div>
		<h1 class="upload-form" style="padding: 30px; padding-bottom: 0px; ">Upload Here!</h1>
		<div>
			<form method="post" action="#" enctype="multipart/form-data">
				<div class="upload-form" style="overflow: auto; height: 70%; box-sizing: border-box; padding-right: 50px; padding-bottom: 20px;">
					<div>
						<label style="font-weight: bold;">Title*</label><br>
						<input style="padding: 10px; width: 100%; font-size: 14px; border-radius: 6px; border: none;" type="text" name="title" placeholder="Enter Title of Your App" required="" autocomplete="off">
					</div>
					<div>
						<label style="font-weight: bold;">Short Description*</label>
						<textarea style="padding: 10px; width: 100%; font-size: 14px; border-radius: 6px; border: none;" rows="2" placeholder="Write a short description about the app" name="short" required="" autocomplete="off"></textarea>
					</div>
					<div>
						<label style="font-weight: bold;">Long Description*</label>
						<textarea style="padding: 10px; width: 100%; font-size: 14px; border-radius: 6px; border: none;" rows="5" placeholder="Write some description about the app" name="long" required="" autocomplete="off"></textarea>
					</div>
					<div>
	      				<label style="font-weight: bold;">Screenshots*</label><br>
	      				<input style="outline: none;" type="file" name="screenshots[]" required="" multiple=""><br>
	      				<small style="line-height: 17px;">Select all screenshots</small>
	    			</div>
	    			<div>
	      				<label style="font-weight: bold;">Icon*</label><br>
	      				<input style="outline: none;" type="file" name="icon" required=""><br>
	      				<small style="line-height: 17px;" >Select icon</small>
	    			</div>
					<div>
	      				<label style="font-weight: bold;">Featured Graphic*</label><br>
	      				<input style="outline: none;" type="file" name="graphic" required=""><br>
	      				<small style="line-height: 17px;" >Select featured graphic</small>
	    			</div> 
	    			<div>
						<label style="font-weight: bold;">Promo Video</label><br>
						<input style="padding: 10px; width: 100%; font-size: 14px; border-radius: 6px; border: none;" type="text" name="promo" placeholder="https://">
						<small style="line-height: 17px;">Enter the promo video link</small>
					</div>   			
					<div>
						<label style="font-weight: bold;">Private Policy</label><br>
						<input style="padding: 10px; width: 100%; font-size: 14px; border-radius: 6px; border: none;" type="text" name="policy" placeholder="https://">
						<small style="line-height: 17px;">Enter the private policy link</small>
					</div>
					<div>
						<label style="font-weight: bold;">APK File*</label><br>
	      				<input style="outline: none;" type="file" name="apk" required=""><br>
	      				<small style="line-height: 17px;" >Select APK file</small>
					</div>
					<div>
						<label style="font-weight: bold;">Developer Details*</label>
						<div style="width: 80%; margin: auto;">
							<div>
								<label style="font-weight: bold;">Name</label><br>
								<input type="text" style="padding: 10px; width: 100%; font-size: 14px; border-radius: 6px; border: none;" name="user" placeholder="Enter Developer's Name" required="" autocomplete="on">
							</div>
							<div>
								<label style="font-weight: bold;">Email</label><br>
								<input type="email" style="padding: 10px; width: 100%; font-size: 14px; border-radius: 6px; border: none;" name="email" placeholder="Enter Developer's Email" required="" autocomplete="on">
							</div>
							<div>
								<label style="font-weight: bold;">Phone Number</label><br>
								<input type="text" style="padding: 10px; width: 100%; font-size: 14px; border-radius: 6px; border: none;" name="phone" placeholder="Enter Developer's Phone Number" required="" autocomplete="on">
							</div>
						</div>
					</div>
				</div>
				<div style="width: 40%; margin: auto;">
					<small>* Marked things are must.</small><br>
					<button style="padding: 16px; font-weight: bold; margin-top: 2px; border: none; border-radius: 6px; outline: none; background: #212121; color: #E0E0E0; font-family: 'Montserrat', sans-serif;" name="submit">SUBMIT</button>
				</div>
			</form>
		</div>
	</div>

	<script type="text/javascript">
		$(".form").on("click",function(){
			$(".upload-box").toggleClass("showed");
		});
		$(".hide-upload-btn").on("click",function(){
			$(".upload-box").toggleClass("showed");
		});
	</script>


</body>
</html>
