<?php
//SESSION,DB CONNECTION,OTHER QUERIES
 include ('../dbconfig.php'); // database connection
 include('../license.php');
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
    			if($_SESSION['user_level'] ==1){
    			  $query = "SELECT * FROM recharge WHERE datetime >= '$from' AND datetime <= '$to 23:59:59' ORDER BY id DESC ";
    			}
    			if($_SESSION['user_level'] ==2){
    			  $merchant_username = $_SESSION['username'];
    			  $query = "SELECT * FROM recharge WHERE datetime >= '$from' AND datetime <= '$to 23:59:59' AND merchant_username='$merchant_username' ORDER BY id DESC ";
    			}
    			
    		
    			$rows = $conn->query($query)->fetchAll(PDO::FETCH_ASSOC);
			    ?>    
                
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th>MSISDN</th>
                      <th>DigiFlexi ID</th>
                      <th>Digipay ID</th>
                      <th>Reponse Code</th>
                      <th>Message</th>
                      <th>Operator ID</th>
                      <th>Amount</th>
                      <th>Date Time</th>
                      
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                        foreach($rows as $row){
                    ?>
                      <tr>
                        <td><?php echo $row['msisdn']?></td>
                        <td><?php echo $row['digiflexi_id']?></td>
                        <td><?php echo $row['digi_id']?></td>
                        <td><?php echo $row['response_code']?></td>
                        <td><?php echo $row['message']?></td>
                        <td><?php echo $row['operator_id']?></td>
                        <td><?php echo $row['amount']?></td>
                        <td><?php echo $row['datetime']?></td>
                      </tr>
                      <?php } ?>
                    </tbody>
                    <tfoot>
                    <tr>
                      <th>MSISDN</th>
                      <th>DigiFlexi ID</th>
                      <th>Digipay ID</th>
                      <th>Reponse Code</th>
                      <th>Message</th>
                      <th>Operator ID</th>
                      <th>Amount</th>
                      <th>Date Time</th>
                    </tr>
                    </tfoot>
                </table>
                <center><a class="btn btn-info" target="_blank" href="report_download.php?from=<?php echo $from ?>&to=<?php echo $to ?>">Download</a></center>
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
  
  
