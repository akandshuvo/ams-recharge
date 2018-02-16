<?php
//SESSION,DB CONNECTION,OTHER QUERIES
 ob_start();
 session_start();
 include ('../dbconfig.php'); // database connection
 if (isset($_POST['submit'])) {
   // code...
   $employee_id     = $_SESSION['employee_id'];
   $password        = $_POST['password'];
   $password_retype = $_POST['password_retype'];
   
   if ($password==$password_retype) {
       $query="UPDATE user SET password='$password' WHERE employee_id='$employee_id'";
       $query_execute=$conn->query($query);
       if ($query_execute==TRUE) {
         header("location:change_password.php?success");
       }else{
         header("location:change_password.php?failed");
       }
   }else{
       header("location:change_password.php?mismatch");
   }
 }
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

<body class="hold-transition skin-blue sidebar-mini sidebar-collapse">
<div class="wrapper">

<!--INCLUDING NAVIGATION-->
  <?php include('../nav.php');?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1 class="text-center">
        Create New User
      </h1>
    </section>

  <!-- Main content -->
    <section class="content">
        <div class="row">
          <div class="box">
            <!-- /.box-header -->
            <div class="box-body">
            <?php
                if (isset($_GET['success'])) {
            ?>
            <div class="alert alert-success" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
             <center><strong>Password Updated Successfully</strong></center>
            </div>
            <?php
                }
             ?>
           <?php
                if (isset($_GET['failed'])) {
            ?>
            <div class="alert alert-success" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
             <center><strong>Something Went Wrong. Try again later.</strong></center>
            </div>
            <?php
                }
             ?>
            <?php
                if (isset($_GET['mismatch'])) {
            ?>
            <div class="alert alert-warning" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
             <center><strong>PASSWORD MISMATCH</strong></center>
            </div>
            <?php
                }
             ?>

                <form action="change_password.php" method="post">
                    <div class="form-group row">
                      <label for="password" class="col-sm-2 col-form-label">New Password</label></label>
                      <div class="col-sm-4">
                        <input  type="password" class="form-control" id="password" name="password" minlength="6" maxlength="10" size="10">
                      </div>
                      <label for="password_retype" class="col-sm-2 col-form-label">Retype Password</label></label>
                      <div class="col-sm-4">
                        <input  type="password" class="form-control" id="password_retype" name="password_retype">
                      </div>
                    </div>
                    <center><button class="btn btn-info" type="submit" name="submit">Change Password</button></center>
                </form> 

             
            
                          
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
      </div>
    </section>
  </div>
  
  
  
<!--INCLUDING FOOTER-->
  <?php include('../footer.php');?>
  
  
