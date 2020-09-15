<?php include '../header.php'; ?>
<?php
if(isset($_POST['sub']))
{
	$vehicle_id = mysqli_real_escape_string($conn,$_POST['vehicle_id']);
	$days = mysqli_real_escape_string($conn,$_POST['days']);
	$howmanyhours = mysqli_real_escape_string($conn,$_POST['howmanyhours']);
	$price = mysqli_real_escape_string($conn,$_POST['price']);
		$timezone = new DateTimeZone("Asia/Kolkata" );
		$date = new DateTime();
		$date->setTimezone($timezone);
		$date_time = $date->format("M d, Y H:i:s"); 
		$date = date('Y-m-d');
	$bb = "INSERT INTO `g_setpayment`( `vehicle_id`, `days`, `howmanyhours`, `price`, `date_time`, `date`) VALUES ('$vehicle_id','$days','$howmanyhours','$price','$date_time','$date')";
	mysqli_query($conn,$bb);
	
	echo "<script>alert('Payment set successfully!');</script>";
	echo "<script>window.location.href='setpayment.php';</script>";
}
if(isset($_POST['del'])){
	$id = $_POST['del'];
	$tt = "DELETE FROM `g_setpayment` WHERE `id` = '$id'";
	mysqli_query($conn,$tt);

	echo "<script>alert('Deleted successfully!');</script>";
	echo "<script>window.location.href='setpayment.php';</script>";
}
if(isset($_POST['upd'])){
	$id = $_POST['upd'];
	$tt = "SELECT * FROM `g_setpayment` WHERE `id` = '$id'";
	$ee = mysqli_query($conn,$tt);
	$qq = mysqli_fetch_array($ee);

	$tt3 = "SELECT * FROM `g_addvehicle` WHERE `id` = '$qq[vehicle_id]'";
	$ee3 = mysqli_query($conn,$tt3);
	$qq3 = mysqli_fetch_array($ee3);

}else{
	$id = '';
}
if(isset($_POST['update']))
{
	$id = $_POST['update'];
	$vehicle_id = mysqli_real_escape_string($conn,$_POST['vehicle_id']);
	$days = mysqli_real_escape_string($conn,$_POST['days']);
	$howmanyhours = mysqli_real_escape_string($conn,$_POST['howmanyhours']);
	$price = mysqli_real_escape_string($conn,$_POST['price']);
		$timezone = new DateTimeZone("Asia/Kolkata" );
		$date = new DateTime();
		$date->setTimezone($timezone);
		$date_time = $date->format("M d, Y H:i:s"); 
		$date = date('Y-m-d');
		
	$bb = "UPDATE `g_setpayment` SET `vehicle_id`='$vehicle_id',`days`='$days',`howmanyhours`='$howmanyhours',`price`='$price',`date_time`='$date_time',`date`='$date' WHERE `id` = '$id'";
	mysqli_query($conn,$bb);
	
	echo "<script>alert('Update successfully!');</script>";
	echo "<script>window.location.href='setpayment.php';</script>";
}
?>
<div class="content-wrapper">
	<section class="content">
		<div class="row">
			<div class="col-md-1"></div>
			<div class="col-md-10">
				<div class="box">
					<div class="box-header">
						<h3 class="box-title"><b>Set Payments</b></h3>
					</div>
					<div class="box-body box box-info">
						<form class="" method="post" enctype="multipart/form-data">
							<div class="col-md-3">
								<div class="form-group">
									<label for="exampleInputEmail1">Select Vehicle</label>
									<select class="form-control" name="vehicle_id">
										<?php 
										if($id != ''){
											?>
											<option value="<?php echo $qq3['id'] ?>"><?php echo $qq3['vehiclename']." - ".$qq3['model'];?></option>
											<?php
										} ?>
										<option>Select list</option>
										<?php	
										$vv1 = "SELECT * FROM `g_addvehicle` ORDER BY id DESC";
										$tt1 = mysqli_query($conn,$vv1);
										while($nn1 = mysqli_fetch_array($tt1)){
											?>
											<option value="<?php echo $nn1['id'] ?>"><?php echo $nn1['vehiclename']." - ".$nn1['model'];?></option>
											<?php
										}?>
									</select>
								</div>  
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label for="exampleInputEmail1">Select Month/Week/Hour</label>
									<select class="form-control" name="days">
										<?php 
										if($id != ''){
											$days = $qq['days'];
											if($days == 'H'){
												$d = 'Hourly';
											}
											else if($days == 'W'){
												$d = 'Weekly';
											}
											else if($days == 'M'){
												$d = 'Monthly';
											}else{ $d = 'NULL'; }
											?>
											<option value="<?php echo $qq['days']; ?>"><?php echo $d;?></option>
											<?php
										} ?>
										<option>Select list</option>
										<option value="H">Hourly</option>
										<option value="W">Weekly</option>
										<option value="M">Monthly</option>
									</select>
								</div>  
							</div>
							<div class="col-md-3">
								<div class="form-group">
								<label for="exampleInputEmail1">How Many Hours</label>
									<input type="text" class="form-control" name="howmanyhours" placeholder="How Many Hours" value="<?php if($id != ''){ echo $qq['howmanyhours']; } ?>">
								</div>
							</div>		
							<div class="col-md-3">
								<div class="form-group">
								<label for="exampleInputEmail1">Price ( Per Hour )</label>
									<input type="text" class="form-control" name="price" placeholder="Price ( Per Hour )" value="<?php if($id != ''){ echo $qq['price']; } ?>">
								</div>  
							</div>					
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
			<div class="col-md-1"></div>
			<div class="col-md-12"></div>
			<div class="col-md-1"></div>
			<div class="col-md-10">	
				<div class="box">
					<div class="box-header">
						<h3 class="box-title"><b>Manage Set Payments</b></h3>
					</div>
					<div class="box-body box box-info">
						<table class="table table-bordered">
							<thead>
							  <tr>
								<th>S.No.</th>
								<th>Vehicle</th>
								<th>Month/Week/Hour</th>
								<th>How Many Hours</th>
								<th>Price ( Per Hour )</th>
								<th>Date-Time</th>
								<th>Update</th>
								<th>Delete</th>
							  </tr>
							</thead>
							<tbody>
								<?php
									$vv1 = "SELECT * FROM `g_setpayment` ORDER BY id DESC";
									$tt1 = mysqli_query($conn,$vv1);
									$i = 1;
									while($nn1 = mysqli_fetch_array($tt1)){
										$tt2 = "SELECT * FROM `g_addvehicle` WHERE `id` = '$nn1[vehicle_id]'";
										$ee2 = mysqli_query($conn,$tt2);
										$qq2 = mysqli_fetch_array($ee2);
								?>								
								<tr>
									<td><?php echo $i; ?></td>
									<td><?php echo $qq2['vehiclename']." - ".$qq2['model'];?></td>
									<td><?php 
										$days = $nn1['days'];
										if($days == 'H'){
											echo 'Hourly';
										}
										else if($days == 'W'){
											echo 'Weekly';
										}
										else if($days == 'M'){
											echo 'Monthly';
										}else{ echo 'NULL'; }
									
									?></td>
									<td><?php echo $nn1['howmanyhours'];?></td>
									<td><?php echo $nn1['price'];?></td>
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
	