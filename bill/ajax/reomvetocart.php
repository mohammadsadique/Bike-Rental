<?php session_start(); include('../../dbconnect.php');

$master_add_product_id = $_POST['master_add_product_id'];
$rr = "UPDATE `master_add_product` SET `status`= '0' WHERE `id` = '$master_add_product_id'";
mysqli_query($conn,$rr);

?>