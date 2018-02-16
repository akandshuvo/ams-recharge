<?php
//SESSION,DB CONNECTION,OTHER QUERIES
 session_start();
 include ('../dbconfig.php'); // database connection
 
 if (isset($_POST['submit'])){
	if ($_FILES[csv][size] > 0) {
        //get the csv file
        $file = $_FILES[csv][tmp_name];
        $handle = fopen($file,"r");
        //loop through the csv file and insert into database
        do {
            if ($data[0]) {
                
                $query="INSERT INTO 
                                    zip_code(zip_code) 
                                        VALUES('".addslashes($data[0])."')";
        $conn->query($query);
            }
        } while ($data = fgetcsv($handle,5000,",","'"));
        //
        //redirect
        header('Location: zip_code.php?success=1'); die;
    }
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
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

<!--INCLUDING NAVIGATION-->
  <?php include('../nav.php');?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">


  <!-- Main content -->
    <section class="content">
        <div class="row">
          <div class="box">
            <!-- /.box-header -->
            <div class="box-body">
             <?php
                if (isset($_GET['success'])) {
            ?>
            <div class="alert alert-success" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
             <center><strong>Success!</strong>  File Uploaded Successfully</center>
            </div>
            <?php
                }
             ?> 
        		<h1 style="text-align:center;color:#F54545">PLEASE READ THE BELOW INSTRUCTIONS</h1><hr>
                <ol style="font-size:16px;">
                	<li style="color:orange">ONLY ONE COLUMN WITH ZIP CODE</li>
                </ol><hr>

                <div class="col-sm-12 center">
                	<form class="form-horizontal" action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
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
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
      </div>
    </section>
  </div>
  <!-- /.content-wrapper -->
  
  
  
<!--INCLUDING FOOTER-->
  <?php include('../footer.php');?>
  
  
