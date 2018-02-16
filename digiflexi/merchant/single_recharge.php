<?php
//SESSION,DB CONNECTION,OTHER QUERIES
session_start();
include ('../dbconfig.php'); // database connection

# => CHECK IF THE USER IS LOGGED IN

if($_SESSION['is_login']!=1){
  header("location:../index.php");
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
  
<!--notification-->
  <?php if (isset($_GET['wrongmsisdn'])) { ?>
    <script type="text/javascript">
      swal("Oops...", "Something wrong with the msisdn", "error");
    </script>
  <?php } ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1 class="text-center">
        SINGLE RECHARGE
      </h1>
    </section>

  <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-sm-6 col-sm-offset-3">
                <div class="box">
                    <div class="box-body">
                        <form class="form-horizontal" action="single_recharge_action.php" method="post">
                          <div class="form-group">
                            <label for="msisdn" class="col-sm-3 control-label">MSISDN</label>
                            <div class="col-sm-9">
                              <input type="text" class="form-control" id="msisdn" name="msisdn" minlength='11' maxlength='11' placeholder="Mobile Number" required>
                            </div>
                          </div>
                          <div class="form-group">
                            <label for="amount" class="col-sm-3 control-label">AMOUNT</label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                  <div class="input-group-addon">$</div>
                                  <input type="number" class="form-control" id="amount" min="10" name="amount" placeholder="Amount" required>
                                  <div class="input-group-addon">.00</div>
                                </div>
                            </div>
                          </div>
                          <div class="form-group">
                            <p class="col-sm-9 col-sm-offset-3 text-danger"><?php echo "You Balance is TK ".$balance;?></p>
                          </div>
                          <div class="form-group">
                            <label for="mobile_number" class="col-sm-3 control-label">MSISDN Type</label>
                            <div class="col-sm-9">
                              <select class="form-control" name="msisdn_type" id="msisdn_type" required>
                                <option value="">Choose Your Option</option>
                                <option value="prepaid">PREPAID</option>
                                <option value="postpaid">POSTPAID</option>
                              </select>
                            </div>
                          </div>

                          <div class="form-group">
                            <center>
                              <button type="submit" name="recharge" class="btn btn-default">Recharge</button>
                            </center>
                          </div>
                        </form>
                    </div>
                </div>
            </div>
      </div>
    </section>
  </div>
  <!-- /.content-wrapper -->
  
  
  
<!--INCLUDING FOOTER-->
  <?php include('../footer.php');?>
  
  
