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
				<div class="box">
					<div class="box-header">
						<h3 class="box-title"><b>Manage Product</b></h3>
					</div>
					<div class="box-body box box-info">
						<table class="table table-bordered">
							<thead>
							  <tr>
								<th>S.No.</th>
								<th>Company Name</th>
								<th>Product Name</th>
								<th>Size</th>
								<th>Quantity</th>
								<th>Price</th>
								<th>Date-Time</th>
								<th>Update</th>
								<th>Delete</th>
							  </tr>
							</thead>
							<tbody>
								<?php
									$vv1 = "SELECT * FROM `master_add_product` ORDER BY id DESC";
									$tt1 = mysqli_query($conn,$vv1);
									$i = 1;
									while($nn1 = mysqli_fetch_array($tt1)){
										$n1 = "SELECT * FROM `master_size` WHERE `id` = '$nn1[size]'";
										$n = mysqli_query($conn,$n1);
										$dd8 = mysqli_fetch_array($n);
								?>								
								<tr>
									<td><?php echo $i; ?></td>
									<td><?php echo $nn1['company_name'];?></td>
									<td><?php echo $nn1['product_name'];?></td>
									<td><?php echo $dd8['size'];?></td>
									<td><?php echo $nn1['quantity'];?></td>
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
	