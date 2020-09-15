<?php include '../header.php'; ?>
<div class="content-wrapper">
	<section class="content">
		<div class="row">
			<div class="col-md-1"></div>
			<div class="col-md-10">	
				<div class="box">
					<div class="box-header">
						<h3 class="box-title"><b>Manage Size</b></h3>
					</div>
					<div class="box-body box box-info">
						<table class="table table-bordered">
							<thead>
							  <tr>
								<th>S.No.</th>
								<th>Customer Name</th>
								<th>Company Name</th>
								<th>Product Name</th>
								<th>Size</th>
								<th>Single Item Price</th>
								<th>Quantity</th>
								<th>Price</th>
								<th>Date-Time</th>
								<th>Print</th>
							  </tr>
							</thead>
							<tbody>
								<?php
									$vv1 = "SELECT * FROM `bill_gen` GROUP BY bill_no ORDER BY id DESC";
									$tt1 = mysqli_query($conn,$vv1);
									$i = 1;
									while($nn1 = mysqli_fetch_array($tt1)){
								?>								
								<tr>
									<td><?php echo $i; ?></td>
									<td><?php echo $nn1['cust_name'];?></td>
									<td><?php echo $nn1['company_name'];?></td>
									<td><?php echo $nn1['product_name'];?></td>
									<td><?php echo $nn1['size'];?></td>
									<td><?php echo $nn1['single_quantity_price'];?></td>
									<td><?php echo $nn1['quantity'];?></td>
									<td><?php echo $nn1['price'];?></td>
									<td><?php echo $nn1['date_time'];?></td>
									<td><a href="pdf.php?bill_no=<?php echo $nn1['bill_no'];?>" target="_blank" class="btn btn-success" >Print</a></td>
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
	