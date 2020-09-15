<?php session_start(); include 'dbconnect.php';
	if(isset($_POST['signin']))
	{
		$user_id = $_POST['user_id'];
		$pwd = $_POST['pwd'];
		
		$query_ad1 = "SELECT * FROM `login` WHERE user_id = '$user_id' AND  pass = '$pwd' ";
		$run_ad1 = mysqli_query($conn,$query_ad1);
		$get1 = mysqli_fetch_assoc($run_ad1);
		$num_ad1 = mysqli_num_rows($run_ad1);
					
		$_SESSION['id']= $get1['id'];
		$_SESSION['user_id']= $get1['user_id'];
		if($num_ad1 > '0')
		{
			echo "<script>window.location.href='home/dashboard.php'</script>";
		}else{
	        echo "<script>alert('Wrong username or password! Retry');</script>";
		}
	}	
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login</title>
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	
	<link rel="shortcut icon" href="img/favicon1.ico" type="image/x-icon">
	<link rel="icon" href="img/favicon1.ico" type="image/x-icon">
	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
	<link rel="stylesheet" href="dist/css/AdminLTE.min.css">
	<link rel="stylesheet" href="plugins/iCheck/square/blue.css">
	<link href="sweetalert2/sweetalert2.min.css" rel="stylesheet" />
</head>
<style>
    
    .login a:hover{
        color:white !important;
		background:green !important;
    }
</style>
<body class="hold-transition login-page">
	<div class="login-box">
		<div class="login-logo" style="margin-bottom: 0px;background: linear-gradient(0.25turn, #3f87a6, #ebf8e1, #f69d3c);border-radius: 22px 22px 0 0px;font-weight: bold;">
			<a class="logo-name" href="index.php"><span style=" color:#000;">GO BIKES</span></a>
		</div>
		<div class="login-box-body">
			<p class="login-box-msg">Sign in to start your session</p>
			<form action="" method="post">
				<div class="form-group has-feedback">
					<input type="text" class="form-control" placeholder="User Id"  name="user_id" required>
					<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
				</div>
				<div class="form-group has-feedback">
					<input type="password" class="form-control" name="pwd" placeholder="Password" required>
					<span class="glyphicon glyphicon-lock form-control-feedback"></span>
				</div>
				
				<div class="row">
					<div class="col-xs-4">
						<button type="submit" class="btn btn-primary btn-block btn-flat" name="signin">Sign In</button>
					</div>
					<div class="col-xs-2"></div>
					<div class="col-xs-6"></div>
				</div>
			</form>
		</div>
	</div>
</body>
<script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<script src="plugins/iCheck/icheck.min.js"></script>
<script src="sweetalert2/sweetalert2.min.js" ></script>
</html>