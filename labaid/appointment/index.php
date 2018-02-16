<?php
//SESSION,DB CONNECTION,OTHER QUERIES
  session_start();
 include ('../dbconfig.php'); // database connection
 ini_set('memory_limit', '-1');
 ob_start();
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
<?php include('../preloader.php');?>

<body class="hold-transition skin-blue sidebar-mini sidebar-collapse">
<div class="wrapper">

<!--INCLUDING NAVIGATION-->
  <?php include('../nav.php');?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
<!--:::::::::::::::::::::::::::::::RESPONSE MESSAGE:::::::::::::::::::::::::::::::::::::::::::::::::::-->
              <?php
                  if (isset($_GET['success'])) {
              ?>
                <script type="text/javascript">
                  swal("Good Job","New Appoitnement Created", "success")
                </script>
              <?php
                    header( "refresh:2;url=index.php" );
                  }
               ?>
              <?php
                  if (isset($_GET['failed'])) {
              ?>
                <script type="text/javascript">
                  swal("Oops...", "Something went wrong!", "error");
                </script>
              <?php
                header( "refresh:2;url=index.php" );
                  }
              ?>
<!--:::::::::::::::::::::::::::::::::::END OF RESPONSE MESSAGE:::::::::::::::::::::::::::::::::::::::::-->
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1 class="text-center">
        NEW APPOINTMENT
      </h1>
    </section>

  <!-- Main content -->
    <section class="content">


                <!--PATIENT INFORMATION SEARCHING FORM-->

                    <div class="row">
                        <div class="col-sm-6 col-md-offset-3">
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
                                        <center><button class="btn btn-info" name="search_customer">Search</button></center>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>





                <?php
              //SEARCHING USING REGISTRATION NUMBER AND PHONE NUMBER
                if(isset($_POST['search_customer'])){
                    $reg_number     = $_POST['reg_number'];
                    $mobile_number  = $_POST['mobile_number'];

                    //echo $search_query;
                    $search_query = "SELECT * from customer WHERE reg_number ='$reg_number' OR mobile_number = '$mobile_number'";
                    $rows = $conn->query($search_query)->fetchAll(PDO::FETCH_ASSOC);

                    if($rows != NULL){
                ?>
                  <div class="box">
                    <div class="box-body">
                      <table class="table text-center">
                        <thead>
                          <tr>
                            <th>Patient Name</th>
                            <th>Phone Number</th>
                            <th>Alt Number</th>
                            <th>Birthdate</th>
                            <th>Age</th>
                            <th>Reg Number</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                <?php

                    foreach ($rows as $row):
                ?>
                          <tr>
                              <td><?php $name= $row['patient_designation']." ".$row['customer_name'];echo $name; ?></td>
                              <td><?php echo $row['mobile_number']; ?></td>
                              <td><?php echo $row['alt_number']; ?></td>
                              <td><?php echo $row['date_of_birth']; ?></td>
                              <td><?php echo $row['age']; ?></td>
                              <td><?php echo $row['reg_number']; ?></td>
                              <td><a href="index.php?appointment_insert=<?php echo $row['id']?>"><label for="" class="label label-info">MAKE APPOINTMENT</label></a></td>
                          </tr>
                <?php
                  endforeach;
                ?>
                    </table>
                  </div>
                </div>
                <?php
                    }
                    else{
                ?>
                 <center><h3>NO CUSTOMER FOUND <a href="/labaid/customer/index.php" class="btn btn-info">CREATE NEW CUSTOMER</a></h3></center>
                <?php
                    }
                  }
                ?>


              <?php
                // INSERTING DATA IN APPOINTMENT

                if (isset($_GET['appointment_insert'])) {
                  // code...
                    $id = $_GET['appointment_insert'];
                    $search_query = "SELECT * from customer  WHERE id='$id'";
                    $rows = $conn->query($search_query)->fetchAll(PDO::FETCH_ASSOC);
                    $row = call_user_func_array('array_merge', $rows);

                    $customer_name    = $row['patient_designation']." ".$row['customer_name'];
                    $reg_number       = $row['reg_number'];
                    $mobile_number    = $row['mobile_number'];
                    $alt_number       = $row['alt_number'];


                    $query = $conn->prepare('
                                              INSERT INTO appointment (customer_name,reg_number,mobile_number,alt_number) VALUE(:customer_name,:reg_number,:mobile_number,:alt_number)
                                            ');
                    $query->bindValue(':customer_name',$customer_name);
                    $query->bindValue(':reg_number',$reg_number);
                    $query->bindValue(':mobile_number',$mobile_number);
                    $query->bindValue(':alt_number',$alt_number);
                    if($query->execute() == TRUE){
                      $lastId = $conn->lastInsertId();
                      header("location:make_appointment.php?lastId=$lastId");
                    }else{
                      echo "Something went wrong";
                    }
                }





              ?>


    </section>
  </div>
  <!-- /.content-wrapper -->



<!--INCLUDING FOOTER-->
  <?php include('../footer.php');?>
