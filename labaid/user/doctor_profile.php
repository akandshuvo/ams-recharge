<?php
//SESSION,DB CONNECTION,OTHER QUERIES
  session_start();
  if($_SESSION['is_login'] != 1){
    header("location:/labaid/index.php"); // if user is not logged in,this will redirect user to the login page
  }
 include ('../dbconfig.php'); // database connection
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>::LABAID::</title>
<!--include header-->
  <?php include('../header.php')?>

</head>

<body class="hold-transition skin-blue sidebar-mini sidebar-collapse">
<div class="wrapper">

<!--INCLUDING NAVIGATION-->
  <?php include('../nav.php');?>

    <?php if(isset($_GET[id])){?> 
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1 class="text-center">
            Doctor List
          </h1>
        </section>
    
      <!-- Main content -->
        <section class="content">
            <div class="row">
              <div class="box">
                <!-- /.box-header -->
                <div class="box-body">
    
                </div>
                <!-- /.box-body -->
              </div>
              <!-- /.box -->
          </div>
        </section>
      </div>
      <!-- /.content-wrapper -->
    <?php }else{ ?>
            
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1 class="text-center">
            Doctor List
          </h1>
        </section>
    
      <!-- Main content -->
        <section class="content">
            <div class="row">
              <div class="box">
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="example1" class="table bordered">
                        <thead>
                            <tr>
                                <th>Full Name</th>
                                <th>Chamber Location</th>
                                <th>Visit Charge</th>
                                <th>Room & Extension</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <?php
                            $doctor_list = $conn->prepare("SELECT * from doctor_profile");
                            $doctor_list ->execute();
                            $doctor_lists = $doctor_list ->fetchAll(PDO::FETCH_ASSOC);
                            //var_dump($doctor_lists);die;
                            foreach ($doctor_lists as $doctor):
                        ?>
                            <tr>
                                <td><?php echo $doctor['full_name']?></td>
                                <td><?php echo $doctor['chamber_location']?></td>
                                <td><?php echo $doctor['visit_charge']?></td>
                                <td><?php echo $doctor['room_ext']?></td>
                                <td>
                                    <a href=""> <label class="label label-success">VIEW</label></a>
                                    <a href=""> <label class="label label-info">EDIT</label></a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        <tfoot>
                            <tr>
                                <th>Full Name</th>
                                <th>Chamber Location</th>
                                <th>Visit Charge</th>
                                <th>Room & Extension</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <!-- /.box-body -->
              </div>
              <!-- /.box -->
          </div>
        </section>
      </div>
      <!-- /.content-wrapper -->
    <?php } ?>

  
  
  
<!--INCLUDING FOOTER-->
  <?php include('../footer.php');?>
  
  
