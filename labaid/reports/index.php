<?php
//SESSION,DB CONNECTION,OTHER QUERIES
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
        Customer Information
      </h1>
    </section>

  <!-- Main content -->
    <section class="content">
        <div class="row">
          <div class="box">
            <!-- /.box-header -->
            <div class="box-body">
                
                <form action="index.php" method="post">
                    <div class="form-group row">
                        <label for="from" class="col-sm-1 col-sm-offset-2 col-form-label">From</label></label>
                        <div class="col-sm-2">
                            <input  type="date" class="form-control" id="from" name="from" value="" >
                        </div>
                        <label for="to" class="col-sm-1 col-form-label">To</label></label>
                        <div class="col-sm-2">
                            <input  type="date" class="form-control" id="to" name="to">
                        </div>
                        <div class="col-sm-2">
                            <button class="btn btn-success" type="submit">Search</button>
                        </div>
                    </div>
                </form>
                
            <?php  		
                if (isset($_POST['from'])){
    			$from = $_POST['from'];
    			$to = $_POST['to'];
    			$query = "SELECT * FROM customer_profiling WHERE profiling_task_completion_date >= '$from' AND profiling_task_completion_date <= '$to 23:59:59' AND status='4' ORDER BY id DESC ";
    			$query_execute = $conn->query($query);
			?>    
                
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th>MSISDN</th>
                      <th>FULL NAME</th>
                      <th>BiLL Address</th>
                      <th>Activation Date</th>
                      <th>Job Assign Date</th>
                      <th>Zip Code</th>
                      <th>Thana</th>
                      <th>District</th>
                      <th>Division</th>
                      <th>Status</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                        while($row=$query_execute->fetch_assoc()){
                    ?>
                      <tr>
                        <td><?php echo $row['msisdn']?></td>
                        <td><?php echo $row['full_name']?></td>
                        <td><?php echo $row['current_billing_address']?></td>
                        <td><?php echo $row['activation_date']?></td>
                        <td><?php echo $row['job_assign_date']?></td>
                        <td><?php echo $row['zip_code']?></td>
                        <td><?php echo $row['thana']?></td>
                        <td><?php echo $row['district']?></td>
                        <td><?php echo $row['division']?></td>
                        <td>
                            <?php 
                                if ($row['status']==1) {
                                    // code...
                                    echo '<span class="label label-danger">Not Done</span>';
                                }
                                if ($row['status']==2) {
                                    // code...
                                    echo '<span class="label label-info">Made Appointment</span>';
                                }
                                if ($row['status']==3) {
                                    // code...
                                    echo '<span class="label label-info">Assigned To '.$row['profiling_agent_id'].'</span>';
                                }
                                if ($row['status']==4) {
                                    // code...
                                    echo '<span class="label label-success">Done</span>';
                                }
                            ?>
                        </td>
                      </tr>
                      <?php } ?>
                    </tbody>
                    <tfoot>
                    <tr>
                      <th>MSISDN</th>
                      <th>FULL NAME</th>
                      <th>BiLL Address</th>
                      <th>Activation Date</th>
                      <th>Job Assign Date</th>
                      <th>Zip Code</th>
                      <th>Thana</th>
                      <th>District</th>
                      <th>Division</th>
                      <th>Status</th>
                    </tr>
                    </tfoot>
                </table>
            <center><a class="btn btn-info" target="_blank" href="basic.php?from=<?php echo $from ?>&to=<?php echo $to ?>">Download</a></center>
            <?php }?>
            
            

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
  
  
