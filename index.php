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


		//echo $generte_mixed;
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
			move_uploaded_file($tempScreenshots, "screenshots/$screenshots");
			$screenshotsName = $screenshotsName . $screenshots . ', ';
			$i++;
		}
		move_uploaded_file($tempApk, "apk/$apk");
		move_uploaded_file($tempIcon, "icon/$icon");
		move_uploaded_file($tempGraphic, "graphic/$graphic");
		$sql = "INSERT INTO `upload-form`(`title`, `short`, `longDis`, `screenshots`, `icon`, `graphic`, `video`, `policy`, `apk`, `name`, `email`, `phone`) VALUES ('$title','$short','$long','$screenshotsName','$icon','$graphic','$video','$policy','$apk','$name','$email','$phone')";

		$sqlLogin = "INSERT INTO `login`(`name`, `email`, `userId`, `password`, `phone`) VALUES ('$name', '$email', '$user_id', '$generte_mixed', '$phone')" ;
		$run = mysqli_query($conn, $sql);

		$subject  = 'Username And Password';
		$body = '<h4>User ID: </h4><p>' . $user_id .'</p>
			<h4> Password: </h4><p>' . $generte_mixed. '</p>';

		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-Type:text/html;charset-UTF-8" . "\r\n";

		mail($email, $subject, $body, $headers);

		echo "<script>alert('Upload Successfully')</script>";
	}
 ?>

<!DOCTYPE>
<html>
<head>
	<title>Freeapp</title>
	<link rel="stylesheet" type="text/css" href="page.css">
	<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
</head>
<body>
	<nav id="nav" style="padding-top: 30px; padding-left: 50px; margin: 0px;">
		<h1>LOGO</h1>
		<ul>
			<li><a href="index.php" id="active" style="color: #F5F5F5;">HOME</a></li>
			<li><a href="login.php">LOGIN</a></li>
			<li><a href="about.php">ABOUT US</a></li>
			<li><a href="contact.php">CONTACT US</a></li>
		</ul>
	</nav>
	<div class="cont">
		<button class="form" style="height: 9%">Upload Here!</button>
	</div>
	<div class="upload-box">
		<div class="hide-upload-btn"><i class="fas fa-times"></i></div>
		<h1 class="upload-form" style="padding: 30px; padding-bottom: 0px; ">Upload Here!</h1>
		<div>
			<form method="post" action="#" enctype="multipart/form-data">
				<div class="upload-form" style="overflow: auto; height: 70%; box-sizing: border-box; padding-right: 50px;">
					<div>
						<label>Title*</label><br>
						<input style="padding: 10px; width: 100%; font-size: 14px; border-radius: 6px; border: none;" type="text" name="title" placeholder="Enter Title of Your App" required="" autocomplete="off">
					</div>
					<div>
						<label>Short Description*</label>
						<textarea style="padding: 10px; width: 100%; font-size: 14px; border-radius: 6px; border: none;" rows="2" placeholder="Write a short description about the app" name="short" required="" autocomplete="off"></textarea>
					</div>
					<div>
						<label>Long Description*</label>
						<textarea style="padding: 10px; width: 100%; font-size: 14px; border-radius: 6px; border: none;" rows="5" placeholder="Write some description about the app" name="long" required="" autocomplete="off"></textarea>
					</div>
					<div>
	      				<label>Screenshots*</label><br>
	      				<input style="outline: none;" type="file" name="screenshots[]" required="" multiple=""><br>
	      				<small style="line-height: 17px;">Select screenshots folder</small>
	    			</div>
	    			<div>
	      				<label>Icon*</label><br>
	      				<input style="outline: none;" type="file" name="icon" required=""><br>
	      				<small style="line-height: 17px;" >Select icon</small>
	    			</div>
					<div>
	      				<label>Featured Graphic*</label><br>
	      				<input style="outline: none;" type="file" name="graphic" required=""><br>
	      				<small style="line-height: 17px;" >Select featured graphic</small>
	    			</div> 
	    			<div>
						<label>Promo Video</label><br>
						<input style="padding: 10px; width: 100%; font-size: 14px; border-radius: 6px; border: none;" type="text" name="promo" placeholder="https://">
						<small style="line-height: 17px;">Enter the promo video link</small>
					</div>   			
					<div>
						<label>Private Policy</label><br>
						<input style="padding: 10px; width: 100%; font-size: 14px; border-radius: 6px; border: none;" type="text" name="policy" placeholder="https://">
						<small style="line-height: 17px;">Enter the private policy link</small>
					</div>
					<div>
						<label>APK File*</label><br>
	      				<input style="outline: none;" type="file" name="apk" required=""><br>
	      				<small style="line-height: 17px;" >Select APK file</small>
					</div>
					<div>
						<label>Developer Details*</label>
						<div style="width: 80%; margin: auto;">
							<div>
								<label>Name</label><br>
								<input type="text" style="padding: 10px; width: 100%; font-size: 14px; border-radius: 6px; border: none;" name="user" placeholder="Enter Developer's Name" required="" autocomplete="on">
							</div>
							<div>
								<label>Email</label><br>
								<input type="email" style="padding: 10px; width: 100%; font-size: 14px; border-radius: 6px; border: none;" name="email" placeholder="Enter Developer's Email" required="" autocomplete="on">
							</div>
							<div>
								<label>Phone Number</label><br>
								<input type="text" style="padding: 10px; width: 100%; font-size: 14px; border-radius: 6px; border: none;" name="phone" placeholder="Enter Developer's Phone Number" required="" autocomplete="on">
							</div>
						</div>
					</div>
				</div>
				<div style="width: 40%; margin: auto;">
					<button style="padding: 10px; font-weight: bold; margin-top: 14px; border: none; border-radius: 6px; outline: none; background: #303F9F; color: #C5CAE9;" name="submit">Submit</button>
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