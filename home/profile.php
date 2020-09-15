<?php include '../header.php'; ?>
<?php
	$tt = "SELECT * FROM `login` WHERE `user_id` = '$_SESSION[user_id]'";
	$ee = mysqli_query($conn,$tt);
	$qq = mysqli_fetch_array($ee);

if(isset($_POST['profile'])){
	$your_img = $_FILES['your_img']['name'];
		$your_imgtt = time().'_'.$_FILES['your_img']['name'];
		$pass = htmlspecialchars(trim(stripslashes($_POST['pass'])));
		$name = htmlspecialchars(trim(stripslashes($_POST['name'])));
	if($your_img != ''){
		move_uploaded_file($_FILES['your_img']['tmp_name'],'../img/'.$your_imgtt);
		$basic_detail = "UPDATE `login` SET `pass`= '$pass' ,`name` = '$name' ,`img`= '$your_imgtt' WHERE `user_id` = '$_SESSION[user_id]'";
		mysqli_query($conn,$basic_detail);
	}else{
		$basic_detail = "UPDATE `login` SET `pass`= '$pass' ,`name` = '$name'  WHERE `user_id` = '$_SESSION[user_id]'";
		mysqli_query($conn,$basic_detail);
	}

	echo "<script>alert('Your Profile Updated Successfully!');</script>";
	echo "<script>window.location.href='profile.php';</script>";
}
?>
<div class="content-wrapper">
	<section class="content">
		<div class="row">
			<div class="col-md-1"></div>
			<div class="col-md-10">
				<div class="box">
					<div class="box-header">
						<h3 class="box-title"><b>Profile</b></h3>
					</div>
					<div class="box-body box box-info">
						<form class="" method="post" enctype="multipart/form-data">
							<div class="col-md-3" style="">	
								<input type="text" class="form-control" name="user_id" placeholder="User Id" value="<?php  echo $qq['user_id']; ?>" readonly>
							</div>
							<div class="col-md-3" style="">	
								<input type="password" class="form-control" name="pass" placeholder="Password" value="<?php echo $qq['pass']; ?>">
							</div>
							<div class="col-md-3" style="">	
								<input type="text" class="form-control" name="name" placeholder="Name" value="<?php echo $qq['name']; ?>">
							</div>
							<div class="col-md-3" style="">	
								<input type="file" class="form-control" name="your_img"><br>
								<img src="../img/<?php if($qq['img'] !='') { echo $qq['img']; }else{ echo 'img_not_delete/dummy.png';}?>" style="width:150px">
							</div>
							<div class="col-md-12" style=""><hr></div>
							<div class="col-md-2 pull-left" style="">
								<button type="submit" value="<?php if($id != ''){ echo $qq['id']; } ?>" name="profile" class="btn btn-info" >Update Profile</button>
							</div>
						</form>
					</div>	
				</div>
			</div>
			<div class="col-md-1"></div>
		</div>
	</section>
</div>
<?php include '../footer.php'; ?>
	