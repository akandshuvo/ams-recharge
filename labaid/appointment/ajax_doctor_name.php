<?php
    session_start(); //starting the login session
    date_default_timezone_set('Asia/Dhaka');
  //  if($_SESSION['is_login'] != 1){
  //      header("location:/labaid/index.php"); // if user is not logged in,this will redirect user to the login page
  //  }
    include ('../dbconfig.php');
    include ('../function/function.php');

    //pulling doctor list from db

    $doctor_name =$_POST['doctor_name'];
    $rows = $conn->query("SELECT * from doctor_profile WHERE `full_name` LIKE '%$doctor_name%' ")->fetchAll(PDO::FETCH_ASSOC);

    foreach ($rows as $key => $row) {
      # code...
      echo '<option value="'.$row['doctor_id'].'">'.$row['full_name'].'</option>';
    }



?>
