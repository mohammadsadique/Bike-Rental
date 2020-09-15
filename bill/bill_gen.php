<?php include '../header.php'; ?>
<?php  include('../dbconnect.php');
	$tt = "SELECT * FROM `login` WHERE `user_id` = '$_SESSION[user_id]'";
	$ee = mysqli_query($conn,$tt);
	$qq = mysqli_fetch_array($ee);

if(isset($_POST['aadtocart'])){
	echo $aadtocart = htmlspecialchars(trim(stripslashes($_POST['aadtocart'])));
		
}

?>
<style>
.show{
    background: floralwhite;
}
.table{
	margin-bottom:0px;
}
tr th{
		text-align: center;
	}
	tr td{
		text-align: center;
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
							<input type="text" id="login" onmouseup="document.getElementById('login').select();" class="form-control sea" placeholder="Search Product...." autofocus>
							<div class="show"></div>
						</div>
					</div>	
				</div>
			</div>
			<div class="col-md-1"></div>
			<div class="your_cart"></div>
		</div>
	</section>
</div>
<?php include '../footer.php'; ?>
<script>
	$(document).ready(function(){
		//auto load your cart
		$.ajax({
			url:'your_cart.php',
			success:function(res){
				$('.your_cart').html(res);
			}
		});
		$('.sea').keyup(function(e){
			var sear = $.trim($(this).val());
			if(sear != ''){
			//////
				$.ajax({
					url:'ajax/filter.php',
					type:'post',
					data:{sear:sear},
					success:function(res){
						$('.show').html(res);
					}
				});
			//////
			}else{
				$('.show').html('');
			}
		});
		// add to cart
		$(document).on('click','.aadtocart',function(e){
			e.preventDefault();
			var master_add_product_id = $.trim($(this).val());
			//alert(id);
			$.ajax({
				url:'ajax/addtocart.php',
				type:'post',
				data:{master_add_product_id:master_add_product_id},
				success:function(res2){
					$.ajax({
						url:'your_cart.php',
						success:function(res){
							$('.your_cart').html(res);
						}
					});
				}
			});
		});
		//remove from cart
		$(document).on('click','.del',function(e){
			e.preventDefault();
			var master_add_product_id = $.trim($(this).siblings('input').val());
			$.ajax({
				url:'ajax/reomvetocart.php',
				type:'post',
				data:{master_add_product_id:master_add_product_id},
				success:function(res2){
					$.ajax({
						url:'your_cart.php',
						success:function(res){
							$('.your_cart').html(res);
						}
					});
				}
			});
		});
		// quantity with price
		$(document).on('keyup','.quan',function(e){
			e.preventDefault();
			var quantity = $.trim($(this).val()); 
			var price = $.trim($(this).siblings('input').val());
			if(quantity != ''){
				var new_price = quantity*price;
				$(this).parent('td').siblings('td[class="pri"]').children('.par').html(new_price);
				$(this).parent('td').siblings('td[class="pri"]').children('input').val(new_price);
			}
		});
	});
</script>





















