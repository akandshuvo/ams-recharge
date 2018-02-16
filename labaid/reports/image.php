<?php
//SESSION,DB CONNECTION,OTHER QUERIES
 session_start();  
 include ('../dbconfig.php'); // database connection
 $employee_id= $_SESSION['employee_id'];
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
        Customer Information
      </h1>
    </section>

  <!-- Main content -->
    <section class="content">
        <div class="row">
          <div class="box">
            <!-- /.box-header -->
            <div class="box-body">
              

                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th>MSISDN</th>
                      <th>FULL NAME</th>
                      <th>ZIP CODE</th>
                      <th>Bill Address</th>
                      <th>Agent ID</th>
                      <th>Agent Name</th>
                      <th>Appointment</th>
                      <th>Date</th>
                    </tr>
                    </thead>
                    <tbody>
                      <?php
                        $pending = "SELECT * from customer_profiling WHERE status=4";
                        $pending_execute = $conn->query($pending);
                        while($pending_result=$pending_execute->fetch_assoc()){
                      
                      ?>
                      <tr>
                        <td><?php echo $pending_result['msisdn']?></td>
                        <td><?php echo $pending_result['full_name']?></td>
                        <td><?php echo $pending_result['zip_code']?></td>
                        <td><?php echo $pending_result['current_billing_address']?></td>
                        <td><?php echo $pending_result['profiling_agent_id']?></td>
                        <td><?php echo $pending_result['profiling_agent_name']?></td>
                        <td><?php echo $pending_result['appointment_date']?>&nbsp;&nbsp;<?php echo $pending_result['appointment_time']?></td>
                        <td><?php echo $pending_result['profiling_task_completion_date']?></td>
                      </tr>
                      <?php } ?>
                    </tbody>
                    <tfoot>
                    <tr>
                      <th>MSISDN</th>
                      <th>FULL NAME</th>
                      <th>ZIP CODE</th>
                      <th>Bill Address</th>
                      <th>Agent ID</th>
                      <th>Agent Name</th>
                      <th>Appointment</th>
                      <th>Date</th>
                    </tr>
                    </tfoot>
                  </table>
              </form>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
      </div>
    </section>
  </div>
  <!-- /.content-wrapper -->
  
  
  
<!--INCLUDING FOOTER-->
  <?php include('../footer.php');?>
  
  
