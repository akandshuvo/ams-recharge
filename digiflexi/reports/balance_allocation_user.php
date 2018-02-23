<?php
//SESSION,DB CONNECTION,OTHER QUERIES
ob_start();
session_start();
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

<body class="hold-transition skin-blue sidebar-mini sidebar-collapse">
<div class="wrapper">

<!--INCLUDING NAVIGATION-->
  <?php include('../nav.php');?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1 class="text-center">
        Recharge Report
      </h1>
    </section>

  <!-- Main content -->
    <section class="content">
        <div class="row">
          <div class="col-sm-12">
            <div class="box">
            <!-- /.box-header -->
            <div class="box-body">
            <?php  		
                $user = $_SESSION['username'];
    			$query = "SELECT * FROM balance_report WHERE account_name='$user'";
    			$rows = $conn->query($query)->fetchAll(PDO::FETCH_ASSOC);
			    ?>    
                
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th>NEW BALANCE</th>
                      <th>PREVIOUS BALANCE</th>
                      <th>ADDED AMOUNT</th>
                      <th>ACCOUNT NAME</th>
                      <th>ADDED BY</th>
                      <th>DATE TIME</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                        foreach($rows as $row){
                    ?>
                      <tr>
                        <td><?php echo $row['new_balance']?></td>
                        <td><?php echo $row['previous_balance']?></td>
                        <td><?php echo $row['added_amount']?></td>
                        <td><?php echo $row['account_name']?></td>
                        <td><?php echo $row['added_by']?></td>
                        <td><?php echo $row['datetime']?></td>
                      </tr>
                      <?php } ?>
                    </tbody>
                    <tfoot>
                    <tr>
                      <th>NEW BALANCE</th>
                      <th>PREVIOUS BALANCE</th>
                      <th>ADDED AMOUNT</th>
                      <th>ACCOUNT NAME</th>
                      <th>ADDED BY</th>
                      <th>DATE TIME</th>
                    </tr>
                    </tfoot>
                </table>
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
  
  
