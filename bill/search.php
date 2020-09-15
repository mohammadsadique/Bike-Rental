<?php include '../header.php'; ?>
<?php  include('../dbconnect.php');
	$tt = "SELECT * FROM `login` WHERE `user_id` = '$_SESSION[user_id]'";
	$ee = mysqli_query($conn,$tt);
	$qq = mysqli_fetch_array($ee);

if(isset($_POST['profile'])){
	$your_img = time().'_'.$_FILES['your_img']['name'];
		$pass = htmlspecialchars(trim(stripslashes($_POST['pass'])));
		$name = htmlspecialchars(trim(stripslashes($_POST['name'])));
	if($your_img != ''){
		move_uploaded_file($_FILES['your_img']['tmp_name'],'../img/'.$your_img);
		$basic_detail = "UPDATE `login` SET `pass`= '$pass' ,`name` = '$name' ,`img`= '$your_img' WHERE `user_id` = '$_SESSION[user_id]'";
		mysqli_query($conn,$basic_detail);
	}else{
		$basic_detail = "UPDATE `login` SET `pass`= '$pass' ,`name` = '$name'  WHERE `user_id` = '$_SESSION[user_id]'";
		mysqli_query($conn,$basic_detail);
	}

	echo "<script>alert('Your Profile Updated Successfully!');</script>";
	echo "<script>window.location.href='profile.php';</script>";
}
?>
<script src="link/js/googleapis.js" type="text/javascript"></script>
<link rel="stylesheet" href="link/css/reset.min.css">
<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Roboto:400,500,700'>
<link rel="stylesheet" href="link/css/style.css">
<style>
.show{
    background: floralwhite;
}
.table{
	margin-bottom:0px;
}
</style>

				
  
<div class="content-wrapper"> 
	<section class="content">
		<div class="row">
			<div class="col-md-1"></div>
			<div class="col-md-10">
				<div class="box">
					<div class="box-header">
						<h3 class="box-title"><b>Bill Generator</b></h3>
					</div>
					<div class="box-body box box-info">
						<div class="col-md-12" style="text-align: center;">	
							<label style="padding: 8px;font-size: 22px;color: red;">Search Product [Hit Enter For Search]</label><br>
							<input type="text" id="" class="form-control sea" placeholder="Search Product...." autofocus>
							<div class="search2" style="width: 0px;height:0px;">
								<div class="bar2">
									<div class="icon">
										<i></i>
									</div>
								</div>
								<form>
									<input type="text"  autofocus>
								</form>
								<div class="close2"></div>
							</div>	
							<ul class="show"></ul>
						</div>
					</div>	
				</div>
			</div>
			<div class="col-md-1"></div>
		</div>
	</section>
</div>
<script src='link/js/jquery.min.js'></script>
<script  src="link/js/index.js"></script>
<?php include '../footer.php'; ?>
<script>
	$(document).ready(function(){
		$('.sea').keyup(function(e){
			var sear = $(this).val();
			//////
				$.ajax({
					url:'ajax/filter.php',
					type:'post',
					data:{sear:sear},
					success:function(res){
						//alert(res);
						//list.addClass('show').html(res);
						$('.show').html(res);
					}
				});
			//////
		});
	});
</script>