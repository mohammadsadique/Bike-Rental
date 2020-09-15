<?php session_start(); include('../dbconnect.php');
$kk = "SELECT * FROM `bill_gen` ORDER BY id DESC LIMIT 1";
$jj = mysqli_query($conn,$kk);
$num = mysqli_num_rows($jj);
$nn = mysqli_fetch_array($jj);
if($num > 0){
	$bill_no = $nn['bill_no']+1;
}else{
	$bill_no = '1';
}
if(isset($_POST['gen_bill'])){
	
	$id = $_POST['id'];
	$quantity = $_POST['quantity'];
	$price = $_POST['price'];
	$single_price = $_POST['single_price'];
	$count = count($_POST['id']);
	$i = 0;
		$timezone = new DateTimeZone("Asia/Kolkata" );
		$date = new DateTime();
		$date->setTimezone($timezone);
		$date_time = $date->format("M d, Y H:i:s"); 
		$date = date('Y-m-d');
	while($count > $i){
		$id[$i];
		$quantity[$i];
		$price[$i];
		$single_price[$i];
		$cust_name = $_POST['cust_name']; 
		$kk2 = "SELECT * FROM `master_add_product` WHERE id = '$id[$i]'";
		$jj2 = mysqli_query($conn,$kk2);
		$nn2 = mysqli_fetch_array($jj2);
			$nic = "INSERT INTO `bill_gen`( bill_no , cust_name ,`company_name`, `product_name`, `size`, single_quantity_price , `quantity`, `price`, `image`, `date`, `date_time`) VALUES ('$bill_no', '$cust_name', '$nn2[company_name]' , '$nn2[product_name]' , '$nn2[size]' ,'$single_price[$i]', '$quantity[$i]' , '$price[$i]' , '$nn2[image]' , '$date' , '$date_time')";
		
			mysqli_query($conn,$nic);
		
		$i++;
	}
	$upd = "UPDATE `master_add_product` SET `status`= '0' WHERE `status` = '1'";
	mysqli_query($conn,$upd);
	echo "<script>window.open('bill_gen.php')</script>";
	echo "<script>window.open('pdf.php?bill_no=$bill_no', '_blank')</script>";
}
			$vv1 = "SELECT * FROM `master_add_product` WHERE status = '1'";
			$tt1 = mysqli_query($conn,$vv1);
			$gg = mysqli_num_rows($tt1);
			if($gg > 0){
			?>
			<div class="col-md-12"></div>
			<div class="col-md-1"></div>
			<div class="col-md-10">
				<div class="box">
					<div class="box-header">
						<h3 class="box-title"><b>Your Cart [<?php echo $gg?>]</b></h3>
					</div>
					<div class="box-body box box-info">
						<form method="post" action="your_cart.php">
						<div class="col-md-3">
							<div class="form-group">
								<label for="pwd">Bill Number:</label>
								<input type="text" value="<?php echo $bill_no?>" class="form-control" placeholder="Bill Number" style="text-align:center;font-weight:bold;" readonly>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="pwd">Customer Name:</label>
								<input type="text" class="form-control" name="cust_name" placeholder="Customer Name" required>
							</div>
						</div>
						<table class="table table-bordered">
							<thead>
							  <tr>
								<th>S.No.</th>
								<th>Image</th>
								<th>Company Name</th>
								<th>Product Name</th>
								<th>Size</th>
								<th>Single Item Price</th>
								<th>Quantity</th>
								<th>Price</th>
								<th>Remove</th>
							  </tr>
							</thead>
							<tbody>
								<?php
								$i = 1;
								while($nn1 = mysqli_fetch_array($tt1)){
									$n1 = "SELECT * FROM `master_size` WHERE `id` = '$nn1[size]'";
									$n = mysqli_query($conn,$n1);
									$dd8 = mysqli_fetch_array($n);
								?>								
								<tr>
									<td><?php echo $i; ?></td>
									<td><img src="https://cdn.dribbble.com/assets/dribbble-ball-icon-e94956d5f010d19607348176b0ae90def55d61871a43cb4bcb6d771d8d235471.svg"></td>
									<td> <?php echo $nn1['company_name'];?></td>
									<td> <?php echo $nn1['product_name'];?></td>
									<td> <?php echo $dd8['size'];?><input type="hidden" name="single_price[]" value="<?php echo $nn1['price'];?>"></td>
									<td> <?php echo $nn1['price'];?></td>
									<td> <input type="number" class="form-control quan" name="quantity[]" value="1"><input type="hidden" value="<?php echo $nn1['price'];?>" ></td>
									<td class="pri"> <p class="par"><?php echo $nn1['price'];?></p><input type="hidden" name="price[]" value="<?php echo $nn1['price'];?>"></td>
									<td> <img src="../img/img_not_delete/delete.png" class="del" style="width: 27px;cursor: pointer;"><input type="hidden" name="id[]" value="<?php echo $nn1['id'];?>" ></td>
								</tr>
								<?php
								$i++;
								}?>
							</tbody>
						</table>
						<hr><button type="submit" target="_blank" name="gen_bill" class="btn btn-success btn-lg" style="float: right;"> <i class="fa fa-money" aria-hidden="true"></i> Generate Bill</button>
					</form>
					</div>
				</div>
			</div>
			<div class="col-md-1"></div>
			<?php
			}?>