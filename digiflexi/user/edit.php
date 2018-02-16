<?php
//SESSION,DB CONNECTION,OTHER QUERIES
  session_start(); // login session starts here
  if($_SESSION['is_login'] != 1){
    header("location:/labaid/index.php"); // if user is not logged in,this will redirect user to the login page
  }
  
 include ('../dbconfig.php'); // database connection

// 
 if (isset($_POST['update'])) {
   // code...
   $id = $_POST['id'];
   $zip_code = $_POST['zip_code'];
   $user_level = $_POST['user_level'];
   
   $query="UPDATE user SET zip_code='$zip_code',user_level='$user_level' WHERE id=$id";
   $query_execute=$conn->query($query);
   if ($query_execute==TRUE) {
     header("location:edit.php?success&id=".$id);
   }else{
     header("location:edit.php?failed&id=".$id);
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
        UPDATE USER
      </h1>
    </section>

  <!-- Main content -->
    <section class="content">
        <div class="row">
          <div class="col-sm-6 col-sm-offset-3">
            <div class="box">
            <!-- /.box-header -->
            <div class="box-body">
            <?php
                if (isset($_GET['success'])) {
            ?>
            <div class="alert alert-success" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
             <center><strong>User Created Successfully</strong></center>
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
                if (isset($_GET['id'])) {
                    $id=$_GET['id'];
                    $query="SELECT * from user WHERE id=$id";
                    $row=$conn->query($query)->fetch();
            ?>
                <form action="edit.php" method="post">
                    <input type="hidden" name="id" value="<?php echo $row['id']?>"/>
                    <div class="form-group row">
                      <label for="full_name" class="col-sm-2 col-form-label">Full Name</label></label>
                      <div class="col-sm-10">
                        <input  type="text" class="form-control" id="full_name" name="full_name" value="<?php echo $row['full_name']?>" readonly>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="employee_id" class="col-sm-2 col-form-label">Employee ID</label></label>
                      <div class="col-sm-4">
                        <input  type="text" class="form-control" id="username" name="username" value="<?php echo $row['username']?>" readonly>
                      </div>
                    </div>
                    <center><button class="btn btn-info" type="submit" name="update">UPDATE</button></center>
            </form> 
            <?php
                }
             ?>
             
            
                          
            </div>
            <!-- /.box-body -->
          </div>
          </div>
      </div>
    </section>
  </div>
  
  
  
<!--INCLUDING FOOTER-->
  <?php include('../footer.php');?>
  
  
