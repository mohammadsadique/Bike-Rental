<?php
session_start();
?>


<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
	
  <title>Brilliant public school </title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/iCheck/square/blue.css">
  <link href="sweetalert2/sweetalert2.min.css" rel="stylesheet" />
	<link rel="icon" type="image/gif" href="logo.gif" />
	
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  <style>
  .logo-name{
	  font-family:"Old English Text MT";
  }
  </style>
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <!--<a href="../../index2.html"><b>SIGN </b>IN</a>-->
	<a class="logo-name" href="#"><span style="font-family: Old English Text MT; color:#000;">Brilliant Public School</span></a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Sign in to start your session</p>

    <form action="" method="post">
      <div class="form-group has-feedback">
	    <input type="text" class="form-control" placeholder="User Id" value="<?php if(isset($_GET['user_id']) && isset($_GET['pass']) ){ echo $_GET['user_id'];} ?>" name="user_id" " />
        <!--<input type="text" class="form-control" name="email" placeholder="User Name" required>-->
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" name="pwd" placeholder="Password" value="<?php if(isset($_GET['email']) && isset($_GET['pass']) ){ echo $_GET['pass'];} ?>" required>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <!--<div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox"> Remember Me
            </label>
          </div>
        </div>-->
        
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat" name="signin">Sign In</button>
		  
        </div>
        <div class="col-xs-2">
          
		  
        </div>
		<div class="col-xs-6">
          <a href="#">I forgot my password</a>
		  
        </div>
      </div>
    </form>

    <div class="social-auth-links text-center">
      <!--<p>- OR -</p>
      <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using
        Facebook</a>
      <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign in using
        Google+</a>
    </div>-->
    <!-- /.social-auth-links -->
    
    <!--<a href="#">I forgot my password</a><br>-->
    <!--<a href="register.html" class="text-center">Register a new membership</a>-->
    
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 2.2.3 -->
<script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="bootstrap/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="plugins/iCheck/icheck.min.js"></script>
<script src="sweetalert2/sweetalert2.min.js" ></script>
<?php
include 'dbconnect.php';


	if(isset($_GET['email']) && isset($_GET['pass']) )
	{
		$_SESSION['us'] = $_GET['us'];
		$query_ad_txt = "SELECT * FROM tbl_logreg WHERE user_id='$_GET[email]' AND pass='$_GET[pass]' AND Status = '1' "; 
		$run_ad_txt = mysqli_query($conn,$query_ad_txt);
		$get_txt = mysqli_fetch_assoc($run_ad_txt);
		
		$class_section = "SELECT * FROM assign_teacher_class_assign WHERE user_id='$_GET[email]' ";
		$class_section_taken = mysqli_query($conn,$class_section);
		$class_section_fetch = mysqli_fetch_assoc($class_section_taken);
		
		$num_ad_txt = mysqli_num_rows($run_ad_txt);
		if($num_ad_txt > 0)
		{
			if($get_txt['role']=='admin')
			{
				$_SESSION['role']= $get_txt['role'];
				$_SESSION['user']= $get_txt['name'];
				$_SESSION['user_id']= $get_txt['user_id'];
				$_SESSION['class']= $class_section_fetch['class'];         ///for teacher
				$_SESSION['section']= $class_section_fetch['section'];     ///for teacher
				$_SESSION['id']= $get_txt['id'];
				 //header('location:dashbord_admin.php.php');
				 
				///log///
				$insert_log = "INSERT INTO tbl_bps_log (user,task,my_pannel,remote_pannel,date)
							   VALUES('$_SESSION[us]','Loggin Successfully','$_SESSION[us]','$_SESSION[user]','".date("Y-m-d h:i:s")."')";
				$r_log = mysqli_query($conn,$insert_log); 
				///log///
				 
				echo "<script>window.location.href='home/dashboard_admin.php'</script>";
				//header('location:data.php');
			}
			 if($get_txt['role']=='poweruser')
			  {
				$_SESSION['role']= $get_txt['role'];
				$_SESSION['user']= $get_txt['name'];
				$_SESSION['user_id']= $get_txt['user_id'];
				$_SESSION['class']= $class_section_fetch['class'];           ///for teacher
				$_SESSION['section']= $class_section_fetch['section'];       ///for teacher
				$_SESSION['id']= $get_txt['id'];
				
				$insert_log = "INSERT INTO tbl_bps_log (user,task,my_pannel,remote_pannel,date)
							   VALUES('$_SESSION[us]','Loggin Successfully','$_SESSION[us]','$_SESSION[user]','".date("Y-m-d h:i:s")."')";
				$r_log = mysqli_query($conn,$insert_log); 
				
				echo "<script>window.location.href='home/dashboard_poweruser.php'</script>";
				//header('location:dashbord_poweruser.php');
			  }
			  if($get_txt['role']=='user')
			  {
				$_SESSION['role']= $get_txt['role'];
				$_SESSION['user']= $get_txt['name'];
				$_SESSION['user_id']= $get_txt['user_id'];
				$_SESSION['class']= $class_section_fetch['class'];           ///for teacher
				$_SESSION['section']= $class_section_fetch['section'];         ///for teacher
				$_SESSION['id']= $get_txt['id'];
				
				$insert_log = "INSERT INTO tbl_bps_log (user,task,my_pannel,remote_pannel,date)
							   VALUES('$_SESSION[us]','Loggin Successfully','$_SESSION[us]','$_SESSION[user]','".date("Y-m-d h:i:s")."')";
				$r_log = mysqli_query($conn,$insert_log); 
				
				echo "<script>window.location.href='home/dashboard_user.php'</script>";
				//header('location:dashbord_user.php');
			  }
		}
		else
		{
	         //$x = "Wrong username or password !";
			echo "<script>swal('Oops','Wrong username or password! Retry','error');</script>";
		}
	}
	



if(isset($_POST['signin']))
{
	$user_id = $_POST['user_id'];
	$pwd = $_POST['pwd'];
		$query_ad = "SELECT * FROM tbl_logreg WHERE user_id='$user_id' AND pass='$pwd' AND Status = '1' AND Approve = '1' ";
		$run_ad = mysqli_query($conn,$query_ad);
		$get = mysqli_fetch_assoc($run_ad);
		$num_ad = mysqli_num_rows($run_ad);
		//echo $get['role'];
		//echo $num_ad;
		
		
		///for teacher
		$class_section = "SELECT * FROM assign_teacher_class_assign WHERE user_id='$user_id' ";
		$class_section_taken = mysqli_query($conn,$class_section);
		$class_section_fetch = mysqli_fetch_assoc($class_section_taken);
		///for teacher
		
		
		///for user parent
		
			$class_section2 = "SELECT * FROM tbl_bps_admission WHERE admn_no='$user_id' ";
			$class_section_taken2 = mysqli_query($conn,$class_section2);
			$class_section_fetch2 = mysqli_fetch_assoc($class_section_taken2);
		
		///for user parent
		if($num_ad > 0)
		{

		  if($get['role']=='superadmin')
		  {
	        $_SESSION['role']= $get['role'];
	        $_SESSION['user']= $get['name'];
	        $_SESSION['user_id']= $get['user_id'];
			$_SESSION['class']= $class_section_fetch['class'];        ///for teacher
			$_SESSION['class']= $class_section_fetch2['class'];        ///for parent
			$_SESSION['section']= $class_section_fetch['section'];    ///for teacher      
			$_SESSION['section']= $class_section_fetch2['section'];    ///for parent      
			$_SESSION['id']= $get['id'];
			//header('location:dashbord_superadmin.php.php');
			
			$insert_log = "INSERT INTO tbl_bps_log (user,task,my_pannel,remote_pannel,date)
							   VALUES('$_SESSION[user]','Loggin Successfully','$_SESSION[user]','','".date("Y-m-d h:i:s")."')";
		    $r_log = mysqli_query($conn,$insert_log); 
			
			echo "<script>window.location.href='home/dashboard_superadmin.php'</script>";
			//header('location:data.php');
		  }
		  
		  
		  if($get['role']=='admin')
		  {
	        $_SESSION['role']= $get['role'];
	        $_SESSION['user']= $get['name'];
	        $_SESSION['user_id']= $get['user_id'];
			$_SESSION['class']= $class_section_fetch['class'];        ///for teacher   
			$_SESSION['class']= $class_section_fetch2['class'];        ///for parent   
			$_SESSION['section']= $class_section_fetch['section'];    ///for teacher   
			$_SESSION['section']= $class_section_fetch2['section'];    ///for parent   
			$_SESSION['id']= $get['id'];
			//header('location:dashbord_admin.php.php');
			 
			$insert_log = "INSERT INTO tbl_bps_log (user,task,my_pannel,remote_pannel,date)
							   VALUES('$_SESSION[user]','Loggin Successfully','$_SESSION[user]','','".date("Y-m-d h:i:s")."')";
		    $r_log = mysqli_query($conn,$insert_log); 
			 
			echo "<script>window.location.href='home/dashboard_admin.php'</script>";
			//header('location:data.php');
		  }
		  if($get['role']=='poweruser')
		  {
	        $_SESSION['role']= $get['role'];
	        $_SESSION['user']= $get['name'];
	        $_SESSION['user_id']= $get['user_id'];
			$_SESSION['class']= $class_section_fetch['class'];        ///for teacher  
			$_SESSION['class']= $class_section_fetch2['class'];        ///for parent  
			$_SESSION['section']= $class_section_fetch['section'];     ///for teacher   
			$_SESSION['section']= $class_section_fetch2['section'];     ///for parent   
			$_SESSION['id']= $get['id'];
			
			$insert_log = "INSERT INTO tbl_bps_log (user,task,my_pannel,remote_pannel,date)
							   VALUES('$_SESSION[user]','Loggin Successfully','$_SESSION[user]','','".date("Y-m-d h:i:s")."')";
		    $r_log = mysqli_query($conn,$insert_log); 
			
			echo "<script>window.location.href='home/dashboard_poweruser.php'</script>";
			//header('location:dashbord_poweruser.php');
		  }
		  if($get['role']=='user')
		  {
	        $_SESSION['role']= $get['role'];
	        $_SESSION['user']= $get['name'];
	        $_SESSION['user_id']= $get['user_id'];
			$_SESSION['class']= $class_section_fetch['class'];       ///for teacher
			$_SESSION['class']= $class_section_fetch2['class'];       ///for parent
			$_SESSION['section']= $class_section_fetch['section'];      ///for teacher 
			$_SESSION['section']= $class_section_fetch2['section'];      ///for parent 
			$_SESSION['id']= $get['id'];
			
			$insert_log = "INSERT INTO tbl_bps_log (user,task,my_pannel,remote_pannel,date)
							   VALUES('$_SESSION[user]','Loggin Successfully','$_SESSION[user]','','".date("Y-m-d h:i:s")."')";
		    $r_log = mysqli_query($conn,$insert_log); 
			
			echo "<script>window.location.href='home/dashboard_user.php'</script>";
			//header('location:dashbord_user.php');
		  }
		}
		else
		{
	        //$x = "Wrong username or password !";
			echo "<script>swal('Oops','Wrong username or password! Retry','error');</script>";
		}
}	

?>

<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script>
</body>
</html>
