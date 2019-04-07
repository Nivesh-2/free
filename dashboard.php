<?php 
	session_start();


	$conn = mysqli_connect("localhost", "root", "123456", "freeapp");

	if(mysqli_connect_errno()){
		echo "failed to connect MySQL: " .mysqli_connect_errno();
	}
	if(filter_has_var(INPUT_POST, "log")){
		//echo 'hello';
		$_SESSION['user_id'] = '';
		$_SESSION['password'] = '';
	}
	$userId = $_SESSION['user_id'];
	$password = $_SESSION['password'];
	$sql = "SELECT * FROM `login` WHERE `userId` = '$userId'";
	$result = mysqli_query($conn, $sql);
	$count = mysqli_num_rows($result);
	$sq = "SELECT * FROM `upload-form` WHERE `userId` = '$userId'";
	$res = mysqli_query($conn, $sq);
	$row = mysqli_fetch_assoc($result);
	$rows = mysqli_fetch_assoc($res);






 ?>
<?php if($count === 1):?>
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
		.bar {
			float: right;
		}
		.container{
			width: 70%;
			margin: auto;
			height: 10000px;
			margin-top: 30px;
			padding: 30px;
			font-size: 20px;
		}
		.cont{
			width: 10%;
		    margin: auto;
		    margin-top: 200px;
		}
		.modal{
			display: none;
			position: fixed;
			z-index: 1;
			left: 0;
			top:0;
			height: 100%;
			width: 100%;
			overflow: auto;
			background-color: rgba(0,0,0,0.2);
		}

		.modal-content{
			background-color: #f4f4f4;
			margin:10% auto;
			width: 40%;
			padding: 50px;
		}

		.modal-content input{
			width: 100%;
			padding: 5px;
			font-size: 18px;
			border-radius: 25px;
			border: none;
			border: solid 1px #000;
			outline: none;
		}

		.closeBtn{
			float: right;
			cursor: pointer;
		}

		.img{
			float: right;
			border-radius: 112px;
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
			<li class="bar"><form method="post" action="#"><button style="margin: 10px; margin-top: 5px; padding: 10px; background-color: #fff; border: none; font-weight: bold; font-family: 'Montserrat', sans-serif; border-radius: 5px; cursor: pointer; outline: none;"  name="log">Logout</button></form></li>
		</ul>
	</nav>
	<div class="container" >
		<img class="img" width="225" height="225" src="icon/<?php echo $rows['icon']; ?>">
		<table style="width: 70%;font-size: 20px;margin: 30px;">
			<tr>
				<td>Name: </td>
				<td><?php echo $row['name']; ?></td>
			</tr>
			<tr>
				<td>Email: </td>
				<td><?php echo $row['email']; ?></td>
			</tr>
			<tr>
				<td>User ID: </td>
				<td><?php echo $row['userId']; ?></td>
			</tr>
		</table>
		<button style="padding: 10px; border-radius: 5px;border: none;background-color: #212121; color: #fff; outline: none;font-family: 'Montserrat', sans-serif;" id="modalBtn"><i class="fas fa-edit"></i> Edit Password</button>
		<div id="simpleModal" class="modal">
			<div class="modal-content">
				<span class="closeBtn">&times;</span><br>
				<form method="post" action="#">
					<div>
						<label>Old User ID</label><br>
						<input type="text" name="oldId" required="">
					</div>
					<div>
						<label>Old Password</label><br>
						<input type="password" name="oldpass" required="">
					</div>
					<div>
						<label>New Password</label><br>
						<input type="password" name="newpass" required="">
					</div>
					<div>
						<label>Confirm Password</label><br>
						<input type="password" name="conpass" required="">
					</div>
					<button style="margin-top: 27px; padding: 10px; border-radius: 10px;border: none;
					background: #000;color: #FFF;font-family: 'Montserrat', sans-serif;" name="change">Submit</button>
				</form>
			</div>
		</div>
	</div>
</body>
<script type="text/javascript">
	
	var modal = document.getElementById('simpleModal');
	var modalBtn = document.getElementById('modalBtn');
	var closeBtn = document.getElementsByClassName('closeBtn')[0];


	modalBtn.addEventListener("click", openModal);
	closeBtn.addEventListener("click", closeModal);
	window.addEventListener("click", clickOutsideModal);

	function openModal(){
		modal.style.display = 'block';
	}

	function closeModal(){
		modal.style.display = 'none';
	}

	function clickOutsideModal(e){
		if(e.target == modal){
			modal.style.display = 'none';
		}
	}
</script>
</html>
<?php endif;
	if($count === 0	){
		header("Location:login.php");
	}
?>


<?php 

	if(filter_has_var(INPUT_POST, 'change')){
		$oldpass = htmlspecialchars($_POST['oldpass']);
		$oldId = htmlspecialchars($_POST['oldId']);
		$newpass = htmlspecialchars($_POST['newpass']);
		$conpass = htmlspecialchars($_POST['conpass']);


		$slip = "SELECT * FROM `login` WHERE `password` = '$oldpass' && `userId` = '$oldId'";
		$res = mysqli_query($conn, $slip);
		$cou = mysqli_num_rows($res);

		if ($cou === 1 && $conpass === $newpass) {
			# code...
			$mysql = "UPDATE `login` SET `password`='$newpass' WHERE `userId`='$oldId'";
			$run = mysqli_query($conn, $mysql);
			echo "<script> alert('Changed Successfully')</script>";
		} else {
			echo "<script> alert('Check the password and userId again')</script>";
		}
		
		
	}

?>