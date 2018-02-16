<?php
session_start();
include('dbconfig.php');

$user = $_SESSION['username'];

$check_license ="SELECT * from user WHERE username = '$user'" ;
$check_license = $conn->query($check_license)->fetch();

$license_expire_date = $check_license['license'];
$license_expire_date = md5($license_expire_date);
echo $license_expire_date;
$license = explode("_",$license_expire_date);
$today = date("Y-m-d");

if(strtotime($today) > strtotime($license[0])){
  //  header("location:/digiflexi/index.php?expired");
}




?>