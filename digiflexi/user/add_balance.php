<?php
//SESSION,DB CONNECTION,OTHER QUERIES
    session_start();    
    include ('../dbconfig.php'); // database connection
    
    $id                                   =   $_GET['id'];
    $user_info                            =   $conn->query("SELECT * from user WHERE id='$id'")->fetch();
    
    if(isset($_POST['balance_update'])){
            $balance_update_username      =   $_POST['username'];
            $balance_update_amount        =   $_POST['balance_amount'];
            $userlevel                    =   $_POST['userlevel'];
        
  # => IF THE USER IS ADMIN
  
         if($userlevel==1){
           
            # => UPDATING ADMIN BALANCE
            
            $admin                        =   $_SESSION['username'];
            $admin_balance                =   $conn->query("SELECT balance from user WHERE username='$admin' ")->fetchColumn(); 
            $balance_deduct               =   intval($admin_balance)+intval($balance_update_amount);
            $admin_balance_update         =   $conn->query("UPDATE user SET balance=$balance_deduct WHERE username='$admin'");
            
            # => BALANCE UPDATE REPORT
            
            $new_balance                  =   $balance_deduct;
            $previous_balance             =   intval($admin_balance);
            $added_amount                 =   $balance_update_amount;
            $account_name                 =   $_SESSION['username'];
            $added_by                     =   $_SESSION['username'];
            
            $balance_report               =   "INSERT INTO balance_report(new_balance,previous_balance,added_amount,account_name,added_by)
                                              VALUES(:new_balance,:previous_balance,:added_amount,:account_name,:added_by)  
                                              ";
                                              
            $balance_report_query         =   $conn->prepare($balance_report);
            $balance_report_query         ->  bindValue(':new_balance',$new_balance);
            $balance_report_query         ->  bindValue(':previous_balance',$previous_balance);
            $balance_report_query         ->  bindValue(':added_amount',$added_amount);
            $balance_report_query         ->  bindValue(':account_name',$account_name);
            $balance_report_query         ->  bindValue(':added_by',$added_by);
            $balance_report_query         ->  execute();
            
            
            header("location:index.php");
         }
        
  # => IF THE USER IS USER
  
        if($userlevel==2){
          
            # => ADD BALANCE TO MERCHANT ACCOUNT
            
            $merchant_balance             =   $conn->query("SELECT balance from user WHERE username='$balance_update_username' ")->fetchColumn(); 
            $balance_add                  =   intval($merchant_balance)+intval($balance_update_amount);
            $merchant_balance_update      =   $conn->query("UPDATE user SET balance=$balance_add WHERE username='$balance_update_username'");
            
            
            # => UPDATING ADMIN BALANCE
            
            $admin                        =   $_SESSION['username'];
            $admin_balance                =   $conn->query("SELECT balance from user WHERE username='$admin' ")->fetchColumn(); 
            $balance_deduct               =   intval($admin_balance)-intval($balance_update_amount);
            $admin_balance_update         =   $conn->query("UPDATE user SET balance=$balance_deduct WHERE username='$admin'");
            
            
            # => BALANCE UPDATE REPORT => TABLE = 'balance_report'
            
            $new_balance                  =   $balance_add;
            $previous_balance             =   intval($merchant_balance);
            $added_amount                 =   $balance_update_amount;
            $account_name                 =   $balance_update_username;
            $added_by                     =   $_SESSION['username'];
            
            $balance_report               =   "INSERT INTO balance_report(new_balance,previous_balance,added_amount,account_name,added_by)
                                              VALUES(:new_balance,:previous_balance,:added_amount,:account_name,:added_by)  
                              ";
            $balance_report_query         =   $conn->prepare($balance_report);
            $balance_report_query         ->  bindValue(':new_balance',$new_balance);
            $balance_report_query         ->  bindValue(':previous_balance',$previous_balance);
            $balance_report_query         ->  bindValue(':added_amount',$added_amount);
            $balance_report_query         ->  bindValue(':account_name',$account_name);
            $balance_report_query         ->  bindValue(':added_by',$added_by);
            $balance_report_query         ->  execute();
            
            header("location:index.php");
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
        Add Balance
      </h1>
    </section>

  <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-sm-6 col-sm-offset-3">
              <div class="box">
            <!-- /.box-header -->
            <div class="box-body">
              <form class="form-horizontal" action="" method="post">
                  
                <div class="form-group">
                  <label for="full_name" class="col-sm-4 col-form-label">Full Name</label></label>
                  <div class="col-sm-8">
                    <input  type="text" class="form-control" id="full_name" name="full_name" value="<?php echo $user_info['full_name']?>" readonly>
                    <input type="hidden" name="userlevel" value="<?php echo $user_info['user_level']?>"/>
                  </div>
                </div>
                
                <div class="form-group">
                    <label for="username" class="col-sm-4 col-form-label">username</label></label>
                    <div class="col-sm-8">
                        <input  type="text" class="form-control" id="username" name="username" value="<?php echo $user_info['username']?>" readonly>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="balance" class="col-sm-4 col-form-label">Balance</label></label>
                    <div class="col-sm-8">
                        <?php 
                            if($user_info['user_level']==1){
                                echo '<input  type="number" class="form-control" id="balance" name="balance_amount"   required >';
                            }else{
                                echo '<input  type="number" class="form-control" id="balance" name="balance_amount"  min=10 max="'.$balance.'" required >';
                            }
                        ?>
                        <p class="text-danger"><?php echo "Your Balance is"." ".$balance." TK "?></p>
                    </div>
                </div>
                
                <center><button class="btn btn-info" type="submit" name="balance_update">Add Balance</button></center>
              </form>
            </div>
            <!-- /.box-body -->
          </div>
            </div>
        </div>
    </section>
  </div>
  <!-- /.content-wrapper -->
  
  
  
<!--INCLUDING FOOTER-->
  <?php include('../footer.php');?>
  
  
