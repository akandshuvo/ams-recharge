<?php
//SESSION,DB CONNECTION,OTHER QUERIES
  session_start(); //starting the login session
  if($_SESSION['is_login'] != 1){
    header("location:/digiflexi/index.php"); // if user is not logged in,this will redirect user to the login page
  }
  include ('../dbconfig.php'); // database connection
 
 
 if (isset($_POST['create'])) {
   // code...
   $full_name   = $_POST['full_name'];
   $username    = $_POST['username'];
   $password    = md5($_POST['password']);
   $merchant_balance     = $_POST['balance'];
   
   $user_level  = 2;// user level 2 = merchant,1=admin
   $status      = 1;  
   
   $count=$conn->query("SELECT count(username) from user WHERE username='$username'")->fetchColumn() ;


   if ($count>0) {
     // code...
     header("location:index.php?usernameexist");
   }else{
      $query=$conn->prepare("INSERT INTO user(full_name,username,password,balance,user_level,status) 
                            VALUES(:full_name,:username,:password,:balance,:user_level,:status)");
      
      $query->bindValue(':full_name',$full_name);
      $query->bindValue(':username',$username);
      $query->bindValue(':password',$password);
      $query->bindValue(':balance',$merchant_balance);
      $query->bindValue(':user_level',$user_level);
      $query->bindValue(':status',$status);
                      
      if ($query->execute()==TRUE){
        //BALANCE DEDUCTION
        $username       =$_SESSION['username'];
        $admin_balance  = $conn->query("SELECT balance from user WHERE username='$username' ")->fetchColumn(); 
        $balance_deduct = intval($admin_balance)-intval($merchant_balance);
        
        $admin_balance_update = $conn->query("UPDATE user SET balance=$balance_deduct WHERE username='$username'");
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
  <title>::digiflexi::</title>
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
        CREATE NEW USER
      </h1>
    </section>

  <!-- Main content -->
    <section class="content">
      
      <!--MERCHANT ACCOUNT CREATION FORM-->
        <div class="row">
          <div class="col-sm-6 col-sm-offset-3">
            <div class="box">
            <!-- /.box-header -->
            <div class="box-body">
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
              <?php
                  if (isset($_GET['usernameexist'])) {
              ?>
                <script type="text/javascript">
                  swal("Oops...", "Username Exist!", "error");
                </script>
              <?php
                  }
              ?>
<!--:::::::::::::::::::::::::::::::::::END OF RESPONSE MESSAGE:::::::::::::::::::::::::::::::::::::::::-->     
              <form class="form-horizontal" action="index.php" method="post">
                <div class="form-group">
                  <label for="full_name" class="col-sm-4 col-form-label">Full Name</label></label>
                  <div class="col-sm-8">
                    <input  type="text" class="form-control" id="full_name" name="full_name" required>
                  </div>
                </div>
                <div class="form-group">
                  <label for="username" class="col-sm-4 col-form-label">username</label></label>
                  <div class="col-sm-8">
                    <input  type="text" class="form-control" id="username" name="username" required>
                  </div>
                </div>
                <div class="form-group">
                  <label for="password" class="col-sm-4 col-form-label">Password</label></label>
                  <div class="col-sm-8">
                    <input  type="password" class="form-control" id="password" name="password"  minlength="6" maxlength="10" size="10" required>
                  </div>
                </div>
                <div class="form-group">
                  <label for="balance" class="col-sm-4 col-form-label">Balance</label></label>
                  <div class="col-sm-8">
                    <input  type="number" class="form-control" id="balance" name="balance"  min=10 max=<?php echo $balance ?> required >
                    <p class="text-danger">
                      <?php
                        if($balance == 0 || $balance == NULL){
                          echo "You do not have sufficiant balance. Add More";
                        }else{
                          echo "Your Balance is"." ".$balance." TK ";
                        }
                      ?>
                    </p>
                  </div>
                </div>
                
                <center><button class="btn btn-info" type="submit" name="create">CREATE</button></center>
              </form>             
            </div>
          </div>
          </div>
        </div>
      
      <!--USER LIST-->
        <div class="row">
          <div class="col-sm-10 col-sm-offset-1">
            <div class="box">
            <!-- /.box-header -->
            <div class="box-body">
              <center><h3>USER LIST</h3></center> 
              <hr>
              <table id="" class="table table-bordered text-center">
                
                <thead>
                  <tr>
                    <th>Name</th>
                    <th>User Type</th>
                    <th>Balance</th>
                    <th>Action</th>
                  </tr>
                </thead>
                
                <tbody>
                  <?php 
                    $user_lists = $conn->query("SELECT * from user")->fetchAll(PDO::FETCH_ASSOC);
                    foreach($user_lists as $user_list):
                  ?>
                  <tr>
                    <td><?php echo $user_list['full_name']?></td>
                    <td>
                      
                        <?php
                            if($user_list['user_level']=="1"){echo "Admin";}
                            if($user_list['user_level']=="2"){echo "User";}
                        ?>
                    </td>
                    <td><?php echo $user_list['balance']?> TK</td>
                    <td>
                    <!--  <a href="edit.php?id=<?php echo $user_list['id'];?>"><label class="label label-success"><span class="fa fa-pencil"></span></label></a>  -->
                      <a href="add_balance.php?id=<?php echo $user_list['id'];?>"><label class="label label-info"><span class="fa fa-money"></span></label></a>  
                    </td>
                  </tr>
                  <?php
                    endforeach;
                  ?>
                  
                </tbody>
              </table>
            </div>
          </div>
          </div>
      </div>
    </section>
  </div>
  
  
  
  
<!--INCLUDING FOOTER-->
  <?php include('../footer.php');?>
  
  
