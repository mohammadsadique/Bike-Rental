<?php include '../header.php'; ?>
<?php
if(isset($_POST['sub']))
{
	$vehiclename = mysqli_real_escape_string($conn,$_POST['vehiclename']);
	$model = mysqli_real_escape_string($conn,$_POST['model']);
	$price = mysqli_real_escape_string($conn,$_POST['price']);
		$timezone = new DateTimeZone("Asia/Kolkata" );
		$date = new DateTime();
		$date->setTimezone($timezone);
		$date_time = $date->format("M d, Y H:i:s"); 
		$date = date('Y-m-d');
	
	$bb = "INSERT INTO `g_addvehicle`( `vehiclename`, `model`, `date_time`, `date`) VALUES ('$vehiclename','$model','$date_time','$date')";
	mysqli_query($conn,$bb);
	
	echo "<script>alert('Vehicle added successfully!');</script>";
	echo "<script>window.location.href='addvehicle.php';</script>";
}
if(isset($_POST['del'])){
	$id = $_POST['del'];
	$tt = "DELETE FROM `g_addvehicle` WHERE `id` = '$id'";
	mysqli_query($conn,$tt);

	echo "<script>alert('Deleted successfully!');</script>";
	echo "<script>window.location.href='addvehicle.php';</script>";
}
if(isset($_POST['upd'])){
	$id = $_POST['upd'];
	$tt = "SELECT * FROM `g_addvehicle` WHERE `id` = '$id'";
	$ee = mysqli_query($conn,$tt);
	$qq = mysqli_fetch_array($ee);
}else{
	$id = '';
}
if(isset($_POST['update']))
{
	$id = $_POST['update'];
	$vehiclename = mysqli_real_escape_string($conn,$_POST['vehiclename']);
	$model = mysqli_real_escape_string($conn,$_POST['model']);
	$price = mysqli_real_escape_string($conn,$_POST['price']);
		$timezone = new DateTimeZone("Asia/Kolkata" );
		$date = new DateTime();
		$date->setTimezone($timezone);
		$date_time = $date->format("M d, Y H:i:s"); 
		$date = date('Y-m-d');
		
	$bb = "UPDATE `g_addvehicle` SET `vehiclename`='$vehiclename',`model`='$model',`date_time`='$date_time',`date`='$date' WHERE `id` = '$id'";
	mysqli_query($conn,$bb);
	
	echo "<script>alert('Update successfully!');</script>";
	echo "<script>window.location.href='addvehicle.php';</script>";
}
?>
<div class="content-wrapper">
	<section class="content">
		<div class="row">
			<div class="col-md-5">
				<div class="box">
					<div class="box-header">
						<h3 class="box-title"><b>Add Vehicle</b></h3>
					</div>
					<div class="box-body box box-info">
						<form method="post" enctype="multipart/form-data">
							<div class="col-md-6">
								<div class="form-group">
									<label for="exampleInputEmail1">Vehicle Name</label>
									<input type="text" class="form-control" name="vehiclename" placeholder="Vehicle Name" value="<?php if($id != ''){ echo $qq['vehiclename']; } ?>">
								</div>  
							</div>
							<div class="col-md-6">
								<div class="form-group">
								<label for="exampleInputEmail1">Model</label>
									<input type="text" class="form-control" name="model" placeholder="Model" value="<?php if($id != ''){ echo $qq['model']; } ?>">
								</div>  
							</div>
							<div class="col-md-12"></div>
							<div class="col-md-2 pull-left" style="">
								<?php if($id != ''){?>
								<button type="submit" value="<?php if($id != ''){ echo $qq['id']; } ?>" name="update" class="btn btn-info" >Update</button>
								<?php
								}else{?>
								<button type="submit" name="sub" class="btn btn-primary" >Submit</button>
								<?php
								}?> 
							</div>
						</form>
					</div>	
				</div>
			</div>
			<div class="col-md-7">	
				<div class="box">
					<div class="box-header">
						<h3 class="box-title"><b>Manage Vehicle</b></h3>
					</div>
					<div class="box-body box box-info">
						<table class="table table-bordered">
							<thead>
							  <tr>
								<th>S.No.</th>
								<th>Vehicle Name</th>
								<th>Model</th>
								<th>Date-Time</th>
								<th>Update</th>
								<th>Delete</th>
							  </tr>
							</thead>
							<tbody>
								<?php
									$vv1 = "SELECT * FROM `g_addvehicle` ORDER BY id DESC";
									$tt1 = mysqli_query($conn,$vv1);
									$i = 1;
									while($nn1 = mysqli_fetch_array($tt1)){
								?>								
								<tr>
									<td><?php echo $i; ?></td>
									<td><?php echo $nn1['vehiclename'];?></td>
									<td><?php echo $nn1['model'];?></td>
									<td><?php echo $nn1['date_time'];?></td>
									<td><form method="post" action=""><button type="submit" name="upd" class="btn btn-success" value="<?php echo $nn1['id'];?>">Update</button></form></td>
									<td><form method="post" action=""><button type="submit" name="del" class="btn btn-danger" value="<?php echo $nn1['id'];?>" onClick="return confirm('Are you sure, you want to delete?')">Delete</button></form></td>
								</tr>
								<?php
								$i++;
								}?>
							</tbody>
						</table>
					</div>	
				</div>
			</div>
		</div>
	</section>
</div>
<?php include '../footer.php'; ?>
	