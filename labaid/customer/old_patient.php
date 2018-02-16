<?php
//SESSION,DB CONNECTION,OTHER QUERIES
 include ('../dbconfig.php'); // database connection
 ini_set('memory_limit', '-1');
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

    <!--:::::::::::::::::::::::::::::::RESPONSE MESSAGE:::::::::::::::::::::::::::::::::::::::::::::::::::-->
    <?php
                  if (isset($_GET['cancelled'])) {
              ?>
                <script type="text/javascript">
                  swal("Good Job","Appointment has been canceled", "success")
                </script>
              <?php
                  //header("location:index.php");
                  }
               ?>
              <?php
                  if (isset($_GET['failed'])) {
              ?>
                <script type="text/javascript">
                  swal("Oops...", "Something went wrong!", "error");
                </script>
              <?php
                  }
              ?>
<!--:::::::::::::::::::::::::::::::::::END OF RESPONSE MESSAGE:::::::::::::::::::::::::::::::::::::::::-->


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1 class="text-center">
        Patient Information
      </h1>
    </section>

  <!-- Main content -->
    <section class="content">
        <!--CUSTOMER INFORMATION SEARCHING FORM-->                
        <div class="row">
            <div class="col-sm-6">
                <div class="box">
                    <div class="box-header">
                        <center><h4><strong>Search by Reg No/Phone</strong></h4></center><hr>
                    </div>
                    <div class="box-body">
                        <form action="" method="post" class="form-horizontal">
                            <div class="form-group">
                                <label for="" class="col-sm-4 col-form-label">Registration Number</label></label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control"  name="reg_number"/>  
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="col-sm-4 col-form-label">Mobile Number</label></label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" list="" name="mobile_number"/>
                                </div>
                            </div>
                            <center><button class="btn btn-info" name="search_customer_1">Search</button></center>    
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="box">
                    <div class="box-header">
                        <center><h4><strong>Search by Patient Name</strong></h4></center><hr>
                    </div>
                    <div class="box-body">
                        <form action="" method="post" class="form-horizontal">
                            <div class="form-group">
                                <label for="" class="col-sm-4 col-form-label">Patient Name</label></label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control"  id="patient_name" name="patient_name" required/>
                                </div>
                            </div>
                            <center><button class="btn btn-info" name="search_customer_2">Search</button></center>    
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">


    <?php

        //SEARCHING USING REGISTRATION NUMBER AND PHONE NUMBER
        if(isset($_POST['search_customer_1'])){
            $reg_number     = $_POST['reg_number'];
            $mobile_number  = $_POST['mobile_number'];
            $search_query = "SELECT * from customer WHERE reg_number ='$reg_number' OR mobile_number = '$mobile_number'";
            $rows = $conn->query($search_query)->fetchAll(PDO::FETCH_ASSOC);
            if($rows != NULL){            
            foreach ($rows as $row){
    ?>
                    <div class="box">
                        <div class="box-body">
                            <table class="table text-center table-bordered">
                                <tr>
                                    <th>Customer Name</th>
                                    <th>Reg Number</th>
                                    <th>Mobile</th>
                                    <th>Alt Mobile</th>
                                    <th>Action</th>
                                </tr>
                                <tr>
                                    <td><?php echo $row['patient_designation']; echo "&nbsp;"; echo $row['customer_name']; ?></td>
                                    <td><?php echo $row['reg_number']; ?></td>
                                    <td><?php echo $row['mobile_number']; ?></td>
                                    <td><?php echo $row['alt_number']; ?></td>
                                    <td>
                                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo<?php echo $row['id']; ?>" aria-expanded="false" aria-controls="collapseTwo<?php echo $row['id']; ?>">VIEW</a>
                                    </td>
                                </tr>
                            </table>
                            <!--appointment history-->
                            <div id="collapseTwo<?php echo $row['id']; ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
    <?php
                            $reg_number = $row['reg_number'];
                            $query ="SELECT * from appointment WHERE reg_number=$reg_number";
                            $appointment_infos = $conn->query("SELECT * from appointment WHERE reg_number='$reg_number' ")->fetchAll(PDO::FETCH_ASSOC);
                            if($appointment_infos!=NULL){
    ?>
                                <hr>
                                <table class="table text-center table-bordered" >
                                    <tr>
                                        <th>Chamber Location</th>
                                        <th>Doctor Speciality</th>    
                                        <th>Doctor Name</th>
                                        <th>Appointment Date</th>
                                        <th>Appointment Time/Serial</th>
                                        <th>Action</th>
                                    </tr>    
    <?php        
                                foreach($appointment_infos as $appointment_info){
    ?>
                                    <tr>
                                        <td><?php echo $appointment_info['chamber_location']; ?></td>
                                        <td><?php echo $appointment_info['speciality']; ?></td>
                                        <td>
                                            <?php 
                                                $doctor_id      =   $appointment_info['doctor_id'];                                                
                                                $doctor_name   = $conn->query("SELECT full_name from doctor_profile WHERE doctor_id='$doctor_id' ")->fetchColumn();
                                                if ($doctor_name !=NULL) {
                                                    echo $doctor_name;         
                                                }
                                            ?>
                                        </td>
                                        <td><?php echo $appointment_info['appointment_date']; ?></td>
                                        <td><?php echo $appointment_info['appointment_time']; ?><?php echo $appointment_info['serial']; ?></td>
                                        <td>

                                            <!-- Modal -->
                                            <form class="form-horizontal" action="/labaid/appointment/cancel_appointment.php" method="post">
                                                <div class="modal fade" id="<?php echo $appointment_info['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label for="reason" class="col-sm-2 control-label">Reason</label>
                                                                <div class="col-sm-10">
                                                                    <input type="text" class="form-control" id="reason" name="reason" placeholder="" required>
                                                                    <input type="hidden" name="id" value="<?php echo $appointment_info['id']; ?>">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <hr>
                                                        <center>
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-info" name="reason_submit">Confirm</button>
                                                        </center>
                                                        <br>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                            <!-- Button trigger modal -->
                                            <label for="" class="label label-warning" data-toggle="modal" data-target="#<?php echo $appointment_info['id']; ?>">Cancel</label>
                                            &nbsp;&nbsp;
                                            <a href="/labaid/appointment/reschedule_appointment.php?lastId=<?php echo $appointment_info['id']; ?>">
                                                <label for="" class="label label-info">Reschedule</label>
                                            </a>
                                        </td>
                                    </tr>
    <?php 
                                }
    ?>
                                </table>
    <?php        
                                }else{ 
                                    echo "<center>No appointment was taken </center>";
                                } 
    ?>
                            </div>
                        </div>
                    </div>
    <?php 
                }
            }else{
    ?>
                <center><h3>NO CUSTOMER FOUND <a href="/labaid/customer/index.php" class="btn btn-info">CREATE NEW CUSTOMER</a></h3></center> 
    <?php
            }
        }
    ?>
                

<?php
//SEARCHING USING NAME
if(isset($_POST['search_customer_2'])){
    $patient_name = $_POST['patient_name'];
    $search_query = "SELECT * FROM  customer WHERE  customer_name LIKE  '%$patient_name%'";
    $rows = $conn->query($search_query)->fetchAll(PDO::FETCH_ASSOC);
    if($rows != NULL){            
    foreach ($rows as $row){
?>
            <div class="box">
                <div class="box-body">
                    <table class="table text-center table-bordered">
                        <tr>
                            <th>Customer Name</th>
                            <th>Reg Number</th>
                            <th>Mobile</th>
                            <th>Alt Mobile</th>
                            <th>Action</th>
                        </tr>
                        <tr>
                            <td><?php echo $row['patient_designation']; echo "&nbsp;"; echo $row['customer_name']; ?></td>
                            <td><?php echo $row['reg_number']; ?></td>
                            <td><?php echo $row['mobile_number']; ?></td>
                            <td><?php echo $row['alt_number']; ?></td>
                            <td>
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo<?php echo $row['id']; ?>" aria-expanded="false" aria-controls="collapseTwo<?php echo $row['id']; ?>">VIEW</a>
                            </td>
                        </tr>
                    </table>
                    <!--appointment history-->
                    <div id="accordion" role="tablist" aria-multiselectable="true">
                    <div id="collapseTwo<?php echo $row['id']; ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
<?php
                    $reg_number = $row['reg_number'];
                    $query ="SELECT * from appointment WHERE reg_number=$reg_number";
                    $appointment_infos = $conn->query("SELECT * from appointment WHERE reg_number='$reg_number' ")->fetchAll(PDO::FETCH_ASSOC);
                    if($appointment_infos!=NULL){
?>
                        <hr>
                        <table class="table text-center table-bordered" >
                            <tr>
                                <th>Chamber Location</th>
                                <th>Doctor Speciality</th>    
                                <th>Doctor Name</th>
                                <th>Appointment Date</th>
                                <th>Appointment Time/Serial</th>
                                <th>Action</th>
                            </tr>    
<?php        
                        foreach($appointment_infos as $appointment_info){
?>
                            <tr>
                                <td><?php echo $appointment_info['chamber_location']; ?></td>
                                <td><?php echo $appointment_info['speciality']; ?></td>
                                <td>
                                    <?php 
                                        $doctor_id      =   $appointment_info['doctor_id'];                                                
                                        $doctor_name   = $conn->query("SELECT full_name from doctor_profile WHERE doctor_id='$doctor_id' ")->fetchColumn();
                                        if ($doctor_name !=NULL) {
                                            echo $doctor_name;         
                                        }
                                    ?>
                                </td>
                                <td><?php echo $appointment_info['appointment_date']; ?></td>
                                <td><?php echo $appointment_info['appointment_time']; ?><?php echo $appointment_info['serial']; ?></td>
                                <td>

                                    <!-- Modal -->
                                    <form class="form-horizontal" action="/labaid/appointment/cancel_appointment.php" method="post">
                                        <div class="modal fade" id="<?php echo $appointment_info['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for="reason" class="col-sm-2 control-label">Reason</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" class="form-control" id="reason" name="reason" placeholder="" required>
                                                            <input type="hidden" name="id" value="<?php echo $appointment_info['id']; ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr>
                                                <center>
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-info" name="reason_submit">Confirm</button>
                                                </center>
                                                <br>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <!-- Button trigger modal -->
                                    <label for="" class="label label-warning" data-toggle="modal" data-target="#<?php echo $appointment_info['id']; ?>">Cancel</label>
                                    &nbsp;&nbsp;
                                    <a href="/labaid/appointment/reschedule_appointment.php?lastId=<?php echo $appointment_info['id']; ?>">
                                        <label for="" class="label label-info">Reschedule</label>
                                    </a>
                                </td>
                            </tr>
<?php 
                        }
?>
                        </table>
<?php        
                        }else{ 
                            echo "<center>No appointment was taken </center>";
                        } 
?>
                        </div>
                    </div>
                </div>
            </div>    
<?php 
        }
    }else{
?>
        <center><h3>NO CUSTOMER FOUND <a href="/labaid/customer/index.php" class="btn btn-info">CREATE NEW CUSTOMER</a></h3></center> 
<?php
    }
}
?>

                
 

            </div>
        </div>            
    </section>
  </div>
  <!-- /.content-wrapper -->
  
  
  
<!--INCLUDING FOOTER-->
  <?php include('../footer.php');?>





