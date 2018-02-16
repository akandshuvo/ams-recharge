<?php
//SESSION,DB CONNECTION,OTHER QUERIES
  session_start(); //starting the login session
  if($_SESSION['is_login'] != 1){
    header("location:/labaid/index.php"); // if user is not logged in,this will redirect user to the login page
  }
  include ('../dbconfig.php'); // database connection
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>::DIGICON::</title>
<!--include header-->
  <?php include('../header.php')?>

</head>

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

<!--INCLUDING NAVIGATION-->
  <?php include('../nav.php');?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

  <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-5">
              <!-- Widget: user widget style 1 -->
              <div class="box box-widget widget-user">
                <!-- Add the bg color to the header using any of the bg-* classes -->
                <div class="widget-user-header bg-aqua-active">
                  <h3 class="widget-user-username">Prof. Dr. Md. Mujibul Hoque</h3>
                    <h5 class="widget-user-desc">
                        
                    </h5>
                </div>
                <div class="widget-user-image">
                  <img class="img-circle" src="../dist/img/user1-128x128.jpg" alt="User Avatar">
                </div>
                <div class="box-footer">
                    <p>
                        Professor & Head (Ex), Dept. of Dermatology, 
                        Dhaka Medical College
                        Dermatology (Skin, Venereology, Sexual, Hair, Allergy)
                    </p>
                </div>
              </div>
              <!-- /.widget-user -->
              
                <div class="box">
                    <div class="box-body">

                    </div>
                </div>
            </div>
            <div class="col-sm-7">
                <div class="box">
                    <div class="box-body">
                        <h3>HELLO FROM THE OTHER SIDE</h3>
                    </div>
                </div>
                <div class="box">
                    <div class="box-body">
                        <h3>HELLO FROM THE OTHER SIDE</h3>
                    </div>
                </div>
                <div class="box">
                    <div class="box-body">
                        <h3>HELLO FROM THE OTHER SIDE</h3>
                    </div>
                </div>
            </div>
        </div>
    </section>
  </div>
  <!-- /.content-wrapper -->
  
  
  
<!--INCLUDING FOOTER-->
  <?php include('../footer.php');?>
  
  
