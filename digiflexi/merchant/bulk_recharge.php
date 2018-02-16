<?php
//SESSION,DATABASE,LOGIN STATUS
session_start();
include ('../dbconfig.php');

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
  <title>::DIGICON::</title>
  <!--include header-->
  <?php include('../header.php')?>

</head>
<body class="hold-transition skin-blue sidebar-mini sidebar-collapse">
  <div class="wrapper">
    <!--INCLUDING NAVIGATION-->
    <?php include('../nav.php');?>
    <div class="content-wrapper">
      <section class="content">
          <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
              <div class="box">
                <div class="box-body">
            		<h1 style="text-align:center;color:#F54545">PLEASE READ THE BELOW INSTRUCTIONS</h1><hr>
                    <ol style="font-size:16px;">
                    	<li>Download the demo file from <a href="demo.csv">here</a></li>
                    	<li>Do Not Use any Comma in the CSV file.</li>
                    	<li>FIELDS: MSISDN,AMOUNT,MSISDN TYPE</li>
                    </ol><hr>

                    <div class="col-sm-12 center">
                    	<form class="form-horizontal" action="bulk_recharge_action.php" method="post" enctype="multipart/form-data" name="form1" id="form1">
                    	  <div class="row">
                            <div class="form-group row">
                                <label for="" class="col-sm-2 col-form-label"><h4>SELECT A CSV FILE</h4></label>
                                <div class="col-sm-3">
                                  <input type="file" class="form-control" id="usr" name="csv" class="btn btn-default" required>
                                </div>
                                <div class="col-sm-2">
                                  <button class="btn btn-success" name="submit" type="type">UPLOAD</button>
                                </div>
                            </div>
                    	  </div>
                      </form>
                    </div>
                </div>
              </div>
            </div>
        </div>
      </section>
    </div>
    <footer class="main-footer">
      <strong>Copyright &copy; <?php echo date("Y")?> <a href="#">Digicon Technologies Ltd</a>.</strong> All rights reserved.
    </footer>
    <div class="control-sidebar-bg"></div>
  </div>
  <!--INCLUDING FOOTER-->
  <?php include('../footer.php');?>
</body>
</html>
