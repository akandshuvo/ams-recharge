<?php
//SESSION,DB CONNECTION,OTHER QUERIES
  session_start(); //starting the login session
  if($_SESSION['is_login'] != 1){
    header("location:/labaid/index.php"); // if user is not logged in,this will redirect user to the login page
  }
  include ('../dbconfig.php'); // database connection
 
 
 if (isset($_POST['create'])) {
   // code...
   $full_name=$_POST['full_name'];
   $employee_id=$_POST['employee_id'];
   $password=$_POST['password'];
   $user_level=$_POST['user_level'];
   
   $count=$conn->query("SELECT count(employee_id) from user WHERE employee_id='$employee_id'")->fetchColumn() ;


   if ($count>0) {
     // code...
     header("location:index.php?idexist");
   }else{
      $query=$conn->prepare("INSERT INTO user(full_name,employee_id,password,user_level) 
                            VALUES(:full_name,:employee_id,:password,:user_level)");
      
      $query->bindValue(':full_name',$full_name);
      $query->bindValue(':employee_id',$employee_id);
      $query->bindValue(':password',$password);
      $query->bindValue(':user_level',$user_level);
                      
      if ($query->execute()==TRUE) {
        header("location:index.php?success");
      }else{
         header("location:index.php?failed");
      } 
   }
 }
 
  if (isset($_GET['id'])) {
   // code...
  $id=$_GET['id'];
   
  $delete ="DELETE from user WHERE id='$id'";
  $delete_exec = $conn->query($delete);
  if ($delete_exec==TRUE) {
    header("location:index.php?deleted");
  }else{
    header("location:index.php?failed");
  }

 }
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>::LABAID::</title>
<!--include header-->
  <?php include('../header.php')?>

</head>

<body class="hold-transition skin-blue sidebar-mini sidebar-collapse">
<div class="wrapper">

<!--INCLUDING NAVIGATION-->
  <?php include('../nav.php');?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  
  <!--:::::::::::::::::::::::::::::::RESPONSE MESSAGE:::::::::::::::::::::::::::::::::::::::::::::::::::-->              
              <?php
                  if (isset($_GET['success'])) {
              ?>
                <script type="text/javascript">
                  swal("Good Job","User Created Successfully", "success")
                </script>
              <?php
                  }
               ?>
              <?php
                  if (isset($_GET['failed'])) {
              ?>
                <script type="text/javascript">
                  swal("Oops...", "Something went wrong!", "error");
                </script>
              <?php
                  }
              ?>
  <!--:::::::::::::::::::::::::::::::::::END OF RESPONSE MESSAGE:::::::::::::::::::::::::::::::::::::::::-->  


  <!-- Main content -->
  <!--branches-->
    <section class="content" id="branch">
        <div class="row">
            <div class="col-sm-6">
               <div class="box">
                    <!-- /.box-header -->
                    <div class="box-body">
                      <form action="index.php" method="post">
                        <div class="form-group row">
                          <label for="full_name" class="col-sm-2 col-form-label">Full Name</label></label>
                          <div class="col-sm-4">
                            <input  type="text" class="form-control" id="full_name" name="full_name">
                          </div>
                          <label for="employee_id" class="col-sm-2 col-form-label">Employee ID</label></label>
                          <div class="col-sm-4">
                            <input  type="text" class="form-control" id="employee_id" name="employee_id">
                          </div>
                        </div>
                        <center><button class="btn btn-info" type="submit" name="create">CREATE</button></center>
                      </form>             
                    </div>
                  </div> 
            </div>
            <div class="col-sm-6">
                <div class="box">
                    <!-- /.box-header -->
                    <div class="box-body">
                      <center><h3>USER LIST</h3></center> 
                      <hr>
                      <table id="" class="table table-bordered">
                        
                        <thead>
                          <tr>
                            <td>Name</td>
                            <td>Employee ID</td>
                            <td>User Type</td>
                            <td>Action</td>
                          </tr>
                        </thead>
                        
                        <tbody>
                          <?php 
                            $user_lists = $conn->query("SELECT * from user")->fetchAll(PDO::FETCH_ASSOC);
                            foreach($user_lists as $user_list):
                          ?>
                          <tr>
                            <td><?php echo $user_list['full_name']?></td>
                            <td><?php echo $user_list['employee_id']?></td>
                            <td>
                              
                                <?php
                                    if($user_list['user_level']=="1"){echo "Super Admin";}
                                    if($user_list['user_level']=="2"){echo "Admin";}
                                    if($user_list['user_level']=="3"){echo "Doctor";}
                                    if($user_list['user_level']=="4"){echo "Agent";}
                                    if($user_list['user_level']=="5"){echo "Receptionist";}
                                ?>
                            </td>
                            <td><label class="label label-warning">EDIT</label></td>
                          </tr>
                          <?php
                            endforeach;
                          ?>
                          
                        </tbody>
                        
                        <tfoot>
                          <tr>
                            <td>Name</td>
                            <td>Employee ID</td>
                            <td>USER TYPE</td>
                            <td>Action</td>
                          </tr>
                        </tfoot>
                        
                      </table>
                    </div>
                  </div>
            </div>
        </div>
    </section>
  
  <!--departments-->  
    <section class="content" id="department">
        <div class="row">
            <div class="col-sm-6">
               <div class="box">
                    <!-- /.box-header -->
                    <div class="box-body">
                      <form action="index.php" method="post">
                        <div class="form-group row">
                          <label for="full_name" class="col-sm-2 col-form-label">Full Name</label></label>
                          <div class="col-sm-4">
                            <input  type="text" class="form-control" id="full_name" name="full_name">
                          </div>
                          <label for="employee_id" class="col-sm-2 col-form-label">Employee ID</label></label>
                          <div class="col-sm-4">
                            <input  type="text" class="form-control" id="employee_id" name="employee_id">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="password" class="col-sm-2 col-form-label">Password</label></label>
                          <div class="col-sm-4">
                            <input  type="password" class="form-control" id="password" name="password"  minlength="6" maxlength="10" size="10">
                          </div>
                          <label for="user_level" class="col-sm-2 col-form-label">User Level</label></label>
                          <div class="col-sm-4">
                            <select class="form-control" name="user_level" id="user_level" required>
                              <option value="">Choose Your Option</option>
                              <option value="1">Super Admin</option>
                              <option value="2">Admin</option>
                              <option value="3">Doctor</option>
                              <option value="4">Agent</option>
                              <option value="5">Receptionist</option>
                            </select>
                          </div>
                        </div>
                        <center><button class="btn btn-info" type="submit" name="create">CREATE</button></center>
                      </form>             
                    </div>
                  </div> 
            </div>
            <div class="col-sm-6">
                <div class="box">
                    <!-- /.box-header -->
                    <div class="box-body">
                      <center><h3>DEPARTMENT LIST</h3></center> 
                      <hr>
                      <table id="" class="table table-bordered">
                        
                        <thead>
                          <tr>
                            <td>Name</td>
                            <td>Employee ID</td>
                            <td>User Type</td>
                            <td>Action</td>
                          </tr>
                        </thead>
                        
                        <tbody>
                          <?php 
                            $user_lists = $conn->query("SELECT * from user")->fetchAll(PDO::FETCH_ASSOC);
                            foreach($user_lists as $user_list):
                          ?>
                          <tr>
                            <td><?php echo $user_list['full_name']?></td>
                            <td><?php echo $user_list['employee_id']?></td>
                            <td>
                              
                                <?php
                                    if($user_list['user_level']=="1"){echo "Super Admin";}
                                    if($user_list['user_level']=="2"){echo "Admin";}
                                    if($user_list['user_level']=="3"){echo "Doctor";}
                                    if($user_list['user_level']=="4"){echo "Agent";}
                                    if($user_list['user_level']=="5"){echo "Receptionist";}
                                ?>
                            </td>
                            <td><label class="label label-warning">EDIT</label></td>
                          </tr>
                          <?php
                            endforeach;
                          ?>
                          
                        </tbody>
                        
                        <tfoot>
                          <tr>
                            <td>Name</td>
                            <td>Employee ID</td>
                            <td>USER TYPE</td>
                            <td>Action</td>
                          </tr>
                        </tfoot>
                        
                      </table>
                    </div>
                  </div>
            </div>
        </div>
    </section>
  </div>
  
  
  
  
<!--INCLUDING FOOTER-->
  <?php include('../footer.php');?>
  
  
