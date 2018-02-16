<?php
//SESSION,DB CONNECTION,OTHER QUERIES
  date_default_timezone_set('Asia/Dhaka');
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


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1 class="text-center">
        
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
                    <th>Reg Number</th>
                    <th>Patient Name</th>
                    <th>Mobile</th>
                    <th>Alt No</th>
                    <th>Doctor ID</th>
                    <th>Chamber Location</th>
                    <th>Speciality</th>
                    <th>Appointment Date</th>
                    <th>Appointment Time/Slot</th>
                  </tr>
                  </thead>
                  <tbody>  
                    <?php
                    //"SELECT * from appointment WHERE appointment_date='$toda"
                      $today = date("d-m-Y");
                      $patients = $conn->query("SELECT * from appointment")->fetchAll(PDO::FETCH_ASSOC);
                      foreach($patients as $patient):
                    ?>
                    <tr>
                      <td><?php echo $patient['reg_number']?></td>
                      <td><?php echo $patient['customer_name']?></td>
                      <td><?php echo $patient['mobile_number'];?></td>
                      <td><?php echo $patient['alt_number'] ?></td>
                      <td><?php echo $patient['doctor_id']?></td>
                      <td><?php echo $patient['chamber_location']?></td>
                      <td><?php echo $patient['speciality']?></td>
                      <td><?php echo $patient['appointment_date']?></td>
                      <td><?php echo $patient['appointment_time'];echo $patient['serial']?></td>
                    </tr>
                    <?php endforeach;  ?>
                  </tbody>
                </table>
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
  
  
