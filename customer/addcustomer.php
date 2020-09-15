<?php include '../header.php'; ?>
<?php
if(isset($_POST['sub']))
{
	$company_name = $_POST['company_name'];
	$product_name = $_POST['product_name'];
	$size = $_POST['size'];
	$quantity = $_POST['quantity'];
	$price = $_POST['price'];
		$timezone = new DateTimeZone("Asia/Kolkata" );
		$date = new DateTime();
		$date->setTimezone($timezone);
		$date_time = $date->format("M d, Y H:i:s"); 
		$date = date('Y-m-d');
	$bb = "INSERT INTO `master_add_product`( `company_name`, `product_name`, `size`, `quantity`, `price` , `date`, `date_time`) VALUES ('$company_name','$product_name','$size','$quantity','$price','$date','$date_time')";
	mysqli_query($conn,$bb);
	
	echo "<script>alert('Add Product  successfully!');</script>";
	echo "<script>window.location.href='add_product.php';</script>";
}
if(isset($_POST['del'])){
	$id = $_POST['del'];
	$tt = "DELETE FROM `master_add_product` WHERE `id` = '$id'";
	mysqli_query($conn,$tt);

	echo "<script>alert('Deleted product successfully!');</script>";
	echo "<script>window.location.href='add_product.php';</script>";
}
if(isset($_POST['upd'])){
	$id = $_POST['upd'];
	$tt = "SELECT * FROM `master_add_product` WHERE `id` = '$id'";
	$ee = mysqli_query($conn,$tt);
	$qq = mysqli_fetch_array($ee);
}else{
	$id = '';
}
if(isset($_POST['update']))
{
	$id = $_POST['update'];
	$company_name = $_POST['company_name'];
	$product_name = $_POST['product_name'];
	$size = $_POST['size'];
	$quantity = $_POST['quantity'];
	$price = $_POST['price'];
		$timezone = new DateTimeZone("Asia/Kolkata" );
		$date = new DateTime();
		$date->setTimezone($timezone);
		$date_time = $date->format("M d, Y H:i:s"); 
		$date = date('Y-m-d');
	$bb = "UPDATE `master_add_product` SET `company_name`= '$company_name' ,`product_name`= '$product_name' ,`size`= '$size' ,`quantity`= '$quantity' ,`price`= '$price' WHERE `id` = '$id'";
	mysqli_query($conn,$bb);
	
	echo "<script>alert('Update Product  successfully!');</script>";
	echo "<script>window.location.href='add_product.php';</script>";
}
?>
<div class="content-wrapper">
	<section class="content">
		<div class="row">
			<div class="col-md-1"></div>
			<div class="col-md-10">
			<div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Add Customer</h3>
            </div>
            <form role="form">
            <div class="box-body">
			 	<div class="col-md-3">
					<div class="form-group">
						<label for="exampleInputEmail1">Name</label>
						<input type="text" class="form-control" name="name" placeholder="Name" value="<?php if($id != ''){ echo $qq['name']; } ?>">
					</div>  
            	</div>
				<div class="col-md-3">
					<div class="form-group">
					<label for="exampleInputEmail1">Father Name</label>
						<input type="text" class="form-control" name="name" placeholder="Father Name" value="<?php if($id != ''){ echo $qq['name']; } ?>">
					</div>  
            	</div>
				<div class="col-md-3">
					<div class="form-group">
						<label for="exampleInputEmail1">Mobile</label>
						<input type="text" class="form-control" name="mobile" placeholder="Mobile" value="<?php if($id != ''){ echo $qq['mobile']; } ?>">
					</div>  
            	</div>
				<div class="col-md-3">
					<div class="form-group">
					<label for="exampleInputEmail1">Aadhar Number</label>
						<input type="text" class="form-control" name="aadhar" placeholder="Aadhar Number" value="<?php if($id != ''){ echo $qq['aadhar']; } ?>">
					</div>  
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label for="exampleInputEmail1">Select Vehicle</label>
						<select class="form-control" name="vehicle_id">
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

				<div class="col-md-6">
					<div class="form-group">
						<label>Date Time To Take Vehicle</label>
						<div class="input-group date">
							<div class="input-group-addon">
								<i class="fa fa-calendar"></i>
							</div>
							<input type="text" class="form-control pull-right datepicker">
						</div>
						<div class="input-group">
							<input type="text" class="form-control timepicker">
							<div class="input-group-addon">
								<i class="fa fa-clock-o"></i>
							</div>
						</div>
					</div>
             	</div>
				 <div class="col-md-6">
					<div class="form-group">
						<label>Date Time To Return Vehicle</label>
						<div class="input-group date">
							<div class="input-group-addon">
								<i class="fa fa-calendar"></i>
							</div>
							<input type="text" class="form-control pull-right datepicker">
						</div>
						<div class="input-group">
							<input type="text" class="form-control timepicker">
							<div class="input-group-addon">
								<i class="fa fa-clock-o"></i>
							</div>
						</div>
					</div>
             	</div>
				<div class="col-md-6">
					<div class="form-group">
						<label>Address</label>
						<textarea class="form-control" rows="3" placeholder="Enter Address..."></textarea>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label>Work / Reason</label>
						<textarea class="form-control" rows="3" placeholder="Enter Work..."></textarea>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
					<label for="exampleInputEmail1">Advance</label>
						<input type="text" class="form-control" name="price" placeholder="Advance" value="<?php if($id != ''){ echo $qq['price']; } ?>">
					</div>  
				</div>	
				<div class="col-md-3">
					<div class="form-group">
					<label for="exampleInputEmail1">Due</label>
						<input type="text" class="form-control" name="price" placeholder="Due" value="<?php if($id != ''){ echo $qq['price']; } ?>">
					</div>  
				</div>					

			</div>
              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
          	</div>




			</div>
			<div class="col-md-1"></div>
		


		</div>
	</section>
</div>
<?php include '../footer.php'; ?>
	