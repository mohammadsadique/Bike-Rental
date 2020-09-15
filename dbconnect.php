<?php
$host = "localhost";
$user = "root";
$pass = "mysql";
$db = "gobikes";
$conn = mysqli_connect($host,$user,$pass) or die ("db error new");
mysqli_select_db($conn,$db);
?>