<?php
	//session_start();  error_reporting(0); 
	include '../dbconnect.php';
	ini_set('max_execution_time', 600);
	// include autoloader
	require_once '../dompdf/autoload.inc.php';

	// reference the Dompdf namespace
	use Dompdf\Dompdf;

	// instantiate and use the dompdf class
	$dompdf = new Dompdf();
	 
	$bill_no = $_GET['bill_no'];
	
$html =
'
	<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="shortcut icon" href="../img/favicon.ico" type="image/x-icon">
  <link rel="icon" href="../img/favicon.ico" type="image/x-icon">
  <title>Chaand Plastic</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" type="text/css"  href="../bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" type="text/css" href="../dist/css/AdminLTE.min.css">
   <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<!--<style>
		.height {
			min-height: 200px;
		}

		.icon {
			font-size: 47px;
			color: #5CB85C;
		}

		.iconbig {
			font-size: 77px;
			color: #5CB85C;
		}
    
		/* .table > tbody > tr > .emptyrow {
			border-top: none;
		}

		.table > thead > tr > .emptyrow {
			border-bottom: none;
		}

		.table > tbody > tr > .highrow {
			border-top: 3px solid;
		} */
		

		</style>-->
		<style>
		@page{
			margin:0px;
			
		}
			.info{
				width:70%;
				font-size:11px;
				display: inline-block;
				//background-color:red;
			}
			.info_img{
				height:0px;
				display: inline-block;
			//	margin-top:0px;
				//background-color:green;
				
			}
			.info b{
				
				font-weight: bold;
				font-size:12px;
			}
			table, th, td {
			border: 1px solid black;
			border-collapse: collapse;
			text-align:center;
		}
		</style>
		</head>
		<body>';
			$query = "SELECT * FROM `bill_gen` WHERE bill_no = '$bill_no' ";
			$rshr = mysqli_query($conn,$query); 
			$number = mysqli_num_rows($rshr);
			$row = mysqli_fetch_array($rshr);
			
			$vv = "SELECT SUM(`price`) as tot_price FROM `bill_gen` WHERE `bill_no` = '$bill_no'";
			$yy = mysqli_query($conn,$vv);
			$ss = mysqli_fetch_array($yy);
			$html = $html.
				'
				<div class="col-md-12">
				<h2 style="text-align:center">Chaand Plastic</h2>
				<hr>
				<p><h4><b>Bill Number : </b> '.$row['bill_no'].'</h4></p>
				<p><h4><b>Customer Name : </b> '.$row['cust_name'].'</h4></p>
				<p><h4><b>Date-Time : </b> '.$row['date_time'].'</h4></p>
				
					<table width="100%">
						<tr>
							<th style="width:50%;">S.No.</th>
							<th style="width:50%;">Company Name</th>
							<th style="width:50%;">Product Name</th>
							<th style="width:50%;">Size</th>
							<th style="width:50%;">Single Item Price</th>
							<th style="width:50%;">Quantity</th>
							<th style="width:50%;">Price</th>
						</tr>
						';
						$query2 = "SELECT * FROM `bill_gen` WHERE bill_no = '$bill_no' ";
						$rshr2 = mysqli_query($conn,$query2);
						$i = 1;
						while($row2 = mysqli_fetch_array($rshr2)){
							$n1 = "SELECT * FROM `master_size` WHERE `id` = '$row2[size]'";
							$n = mysqli_query($conn,$n1);
							$dd8 = mysqli_fetch_array($n);
							$html = $html.
							'<tr>
								<td style="width:50%;">'.$i.'</td>
								<td style="width:50%;">'.$row2['company_name'].'</td>
								<td style="width:50%;">'.$row2['product_name'].'</td>
								<td style="width:50%;">'.$dd8['size'].'</td>
								<td style="width:50%;">'.$row2['single_quantity_price'].'</td>
								<td style="width:50%;">'.$row2['quantity'].'</td>
								<td style="width:50%;">'.$row2['price'].'</td>
							</tr>';							
							$i++;
						}
					$html = $html.
					'	
					<tr>
						<th colspan="6">Total Price</th>
						<th colspan="1">'.$ss['tot_price'].'</th>
					</tr>
					</table>
				</div>
				';
			$html = $html.
		'</body>
	</html>';

$dompdf->loadHtml($html);
// (Optional) Setup the paper size and orientation
//$dompdf->setPaper('A5', 'landscape');

$dompdf->set_paper(array(0, 0, 595, 841), 'landscape');
//$dompdf->setPaper('A4', 'portland');
// Render the HTML as PDF
$dompdf->render();
// Output the generated PDF (1 = download and 0 = preview)
$dompdf->stream("codexworld",array("Attachment"=>0));
?>