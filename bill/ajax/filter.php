<style>
	tr th{
		text-align: center;
	}
</style>


<?php session_start(); include('../../dbconnect.php');




	$sear = $_POST['sear'];
$rr = "SELECT * FROM `master_add_product` WHERE `company_name` LIKE '%$sear%' OR `product_name` LIKE '%$sear%'";
$tt = mysqli_query($conn,$rr);
$pp = mysqli_num_rows($tt);
if($pp != ''){
	?>
	<table class="table table-bordered">
	<thead>
	  <tr>
		<th>Image</th>
		<th>Company Name</th>
		<th>Product Name</th>
		<th>Size</th>
		<th>Price</th>
		<th>Add To Cart</th>
	  </tr>
	</thead>
	<?php
while($jj = mysqli_fetch_array($tt)){
	$n1 = "SELECT * FROM `master_size` WHERE `id` = '$jj[size]'";
	$n = mysqli_query($conn,$n1);
	$dd8 = mysqli_fetch_array($n);
?>
	<tbody>
	  <tr>
		<td><img src="https://cdn.dribbble.com/assets/dribbble-ball-icon-e94956d5f010d19607348176b0ae90def55d61871a43cb4bcb6d771d8d235471.svg"></td>
		<td> <?php echo $jj['company_name'];?></td>
		<td> <?php echo $jj['product_name'];?></td>
		<td> <?php echo $dd8['size'];?></td>
		<td> <?php echo $jj['price'];?></td>
		<td> <button type="submit" class="aadtocart" value="<?php echo $jj['id'];?>"><i class="fa fa-shopping-cart fa-2x" aria-hidden="true"></i></button></td>
	  </tr>
	</tbody>
<?php
}
}else{?>
	<p style="padding: 10px;font-size: 22px;font-weight: bold;">Sorry, no result found!</p>
<?php
}?>
</table>