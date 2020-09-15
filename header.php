<?php session_start(); include('../dbconnect.php');
if(!empty($_SESSION['user_id'])){}
else
{
	header('location:../login.php');
}
?>
<?php
	$tt = "SELECT * FROM `login` WHERE `user_id` = '$_SESSION[user_id]'";
	$ee = mysqli_query($conn,$tt);
	$qq = mysqli_fetch_array($ee);
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<link rel="shortcut icon" href="../img/favicon1.ico" type="image/x-icon">
		<link rel="icon" href="../img/favicon1.ico" type="image/x-icon">
		<title>GO BIKES</title>
		<link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
		<link rel="stylesheet" href="../plugins/datatables/dataTables.bootstrap.css">
		<link rel="stylesheet" href="../plugins/datepicker/datepicker3.css">
		<link rel="stylesheet" href="../plugins/timepicker/bootstrap-timepicker.min.css">
		<link rel="stylesheet" href="../plugins/iCheck/all.css">
		<link rel="stylesheet" href="../plugins/select2/select2.min.css">
		<link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
		<link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">
		<link rel="stylesheet" href="../multiselect/dist/css/bootstrap-multiselect.css" type="text/css"/>
		<link href="../sweetalert2/sweetalert.css" rel="stylesheet" />
		<link rel="icon" type="image/png" href="img/durga logo.png">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<style>
			li_bgclr {
				background-color:rgba(243, 174, 18, 0.56);
			}
		</style>
	</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
	<header class="main-header">
		<a href="" class="logo">
			<span class="logo-mini"><b>CP</b></span>
			<span class="logo-lg" style="font-size: 90%;"><b>GO BIKES</b></span>
		</a>
		<nav class="navbar navbar-static-top">
			<a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</a>
			<ul class="nav navbar-nav" style="margin-top: 3px;font-size: 26px;color: white;">
				<li class="user-header">
					<div class="pull-left">
						<a href="#" style="color: white;font-weight: bold;"> <?php if($_SESSION['id'] == '1'){echo 'Admin Panel :- ';}else{ echo 'Advisor Panel :- '; } ?></a>
					</div>
					<div class="pull-right">
						<a href="#" style="color: #f4f4f4;margin-left: 9px;font-style: oblique;"><?php echo $qq['name'];?></a>
					</div>
				</li>
			</ul>
			<div class="navbar-custom-menu">
				<ul class="nav navbar-nav">
					<li class="dropdown user user-menu">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<img src="../img/<?php if($qq['img'] !=''){ echo $qq['img']; }else{ echo 'img_not_delete/dummy.png';}?>" class="user-image" >
							<span class="hidden-xs"><?php echo $_SESSION['user_id']; ?></span>
						</a>
						<ul class="dropdown-menu">
							<li class="user-header">
								<img src="../img/<?php if($qq['img'] !='') { echo $qq['img']; }else{ echo 'img_not_delete/dummy.png';}?>" class="img-circle">
								<p>
									Name : <?php echo $qq['name'];?>
									<small>User Id : <?php echo $qq['user_id']; ?></small>
								</p>
							</li>
							<li class="user-footer">
								<div class="pull-left">
									<a href="../home/profile.php" class="btn btn-default btn-flat bg-green">Profile</a>
								</div>
								<div class="pull-right">
									<a href="../logout.php" class="btn btn-default btn-flat bg-blue" style="">Sign out</a>
								</div>
							</li>
						</ul>
					</li>
				</ul>
			</div> 
		</nav>
	</header>
	<aside class="main-sidebar">
		<section class="sidebar">
			<div class="user-panel">
				<div class="pull-left image">
					<img src="../img/<?php if($qq['img'] !='') { echo $qq['img']; }else{ echo 'img_not_delete/dummy.png';}?>" class="img-circle" alt="User Image" style="max-width: ;height:;">
				</div>
				<div class="pull-left info">
					<p><?php echo $qq['name'];?></p>
					<a href="#"><i class="fa fa-circle text-success"></i> Online</a>
				</div>
			  </div>
			<ul class="sidebar-menu">
				<li class="header">MAIN NAVIGATION</li>
				<?php
				$a = $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']; 
				$b = $_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']);
				$c = $_SERVER['SERVER_NAME'];
				 ?>
					<li <?php if( $a == $b.'/dashboard.php' ){ echo "class='active'"; }?>>
						<a href="../home/dashboard.php">
							<i class="fa fa-tachometer" aria-hidden="true"></i> <span>Dashboard</span>
							<span class="pull-right-container">
								<small class="label pull-right bg-green"></small>
							</span>
						</a>
					</li>
					<li <?php if( $a == $b.'/profile.php' ){ echo "class='active'"; }?>>
						<a href="../home/profile.php">
							<i class="fa fa-user" aria-hidden="true"></i> <span>Profile</span>
							<span class="pull-right-container">
								<small class="label pull-right bg-green"></small>
							</span>
						</a>
					</li>
					<li class="<?php if( $b == $c.'/GOBIKES/master' ){ echo "active"; }?> treeview">
						<a href="#">	
							<i class="fa fa-folder"></i> <span>Master</span>
							<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							<li <?php if( $a == $b.'/addvehicle.php' ){ echo "class='active'"; }?>><a href="../master/addvehicle.php"><i class="fa fa-circle-o"></i>Add vehicle</a></li>
							<li <?php if( $a == $b.'/setpayment.php' ){ echo "class='active'"; }?>><a href="../master/setpayment.php"><i class="fa fa-circle-o"></i>Set Payment</a></li>
						</ul>
					</li>
					<li class="<?php if( $b == $c.'/GOBIKES/customer' ){ echo "active"; }?> treeview">
						<a href="#">	
							<i class="fa fa-users"></i> <span>Customer</span>
							<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							<li <?php if( $a == $b.'/addcustomer.php' ){ echo "class='active'"; }?>><a href="../customer/addcustomer.php"><i class="fa fa-circle-o"></i>Add Customer</a></li>
							<li <?php if( $a == $b.'/managecustomer.php' ){ echo "class='active'"; }?>><a href="../customer/managecustomer.php"><i class="fa fa-circle-o"></i>Manage Customer</a></li>
						</ul>
					</li>
					<!--
					<li class="<?php if( $b == $c.'/chand/master' ){ echo "active"; }?> treeview">
						<a href="#">	
							<i class="fa fa-folder"></i> <span>Master</span>
							<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							<li <?php if( $a == $b.'/size.php' ){ echo "class='active'"; }?>><a href="../master/size.php"><i class="fa fa-circle-o"></i>Size</a></li>
							<li <?php if( $a == $b.'/add_product.php' ){ echo "class='active'"; }?>><a href="../master/add_product.php"><i class="fa fa-circle-o"></i>Add Product</a></li>
						</ul>
					</li>
					<li <?php if( $a == $b.'/bill_gen.php' ){ echo "class='active'"; }?>>
						<a href="../bill/bill_gen.php">
							<i class="fa fa-file" aria-hidden="true"></i> <span>Bill Generator</span>
							<span class="pull-right-container">
								<small class="label pull-right bg-green"></small>
							</span>
						</a>
					</li>
					<li class="<?php if( $b == $c.'/chand/reporting' ){ echo "active"; }?> treeview">
						<a href="#">	
							<i class="fa fa-folder"></i> <span>Reporting</span>
							<span class="pull-right-container">
								<i class="fa fa-angle-left pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu">
							<li <?php if( $a == $b.'/bill_report.php' ){ echo "class='active'"; }?>><a href="../reporting/bill_report.php"><i class="fa fa-circle-o"></i>Bill Reporting</a></li>
						</ul>
					</li>

					-->
					<li>
						<a href="../logout.php">	
							<i class="fa fa-sign-out" aria-hidden="true"></i> <span>Logout</span>
							<span class="pull-right-container">
								<small class="label pull-right bg-green"></small>
							</span>
						</a>
					</li>
				<?php
				//}?>
			</ul>
		</section>
	</aside>
 