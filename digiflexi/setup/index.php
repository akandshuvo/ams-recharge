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

<body class="hold-transition skin-blue sidebar-mini">
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
            <div id="zip_code">
                <div class="row">
                    <div class="box">
                        <div class="box-body">
                            <form method="POST" action="index.php">
                               <input type="hidden" name="id" value="<?php echo $result['id']?>"/>
                              <!--MSISDN and ALT MSISDN-->  
                                <div class="form-group row">
                                    <label for="msisdn" class="col-sm-2 col-form-label">MSISDN</label></label>
                                    <div class="col-sm-4">
                                        <input  type="text" class="form-control" id="msisdn" name="msisdn" value="<?php echo $result['msisdn']?>" readonly>
                                    </div>
                                    <label for="num_of_attempts" class="col-sm-2 col-form-label">Number Of Attempts</label></label>
                                    <div class="col-sm-4">
                                        <input readonly type="number" class="form-control" id="num_of_attempts"  name="num_of_attempts" value="<?php echo $result['num_of_attempts']+1?>">
                                    </div>
                                </div>
                              
                                <div class="form-group row">
                                    <div class="col-sm-12 text-center">
                                        <button type="submit" class="btn btn-primary" name="attempt">Save</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <section class="content">
            <div id="location">
                <div class="row">
                    <div class="box">
                        <div class="box-body">
                
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
  <!-- /.content-wrapper -->
  
  
  
<!--INCLUDING FOOTER-->
  <?php include('../footer.php');?>
  
  
