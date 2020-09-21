<?php include('../dbconnect.php');
    require('../customfunction/function.php');

    // Working Page Is : customer/addcustomer.php
    if(isset($_POST['vehicleId'])){
        $vehicleId =  $_POST['vehicleId'];
        $a = "SELECT * FROM `g_setpayment` WHERE `vehicle_id` = '$vehicleId'";
        $b = mysqli_query($conn,$a);
        $val = '<option>Select list</option>';
        while($c = mysqli_fetch_array($b)){
            $days = changeDays($c['days']);
            $val .= "<option value='$c[days]'>$days</option>";
        }
        echo  $val;
    }
?>