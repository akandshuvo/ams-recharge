<?php



//phpinfo();die;
date_default_timezone_set('Asia/Dhaka');
//SESSION,DB CONNECTION,OTHER QUERIES
  session_start(); //starting the login session
  if($_SESSION['is_login'] != 1){
    header("location:/labaid/index.php"); // if user is not logged in,this will redirect user to the login page
  }

  include ('../dbconfig.php');
  include ('../function/function.php');// database connection

  if(isset($_POST['make_appointment'])){

    $id                 = $_GET['lastId'];
    $customer_name      = $_POST['customer_name']     ;
    $reg_number         = $_POST['reg_number']        ;
    $mobile_number      = $_POST['mobile_number']     ;
    $alt_number         = $_POST['alt_number']        ;
    $chamber_location   = $_POST['chamber_location']  ;
    $speciality         = $_POST['speciality']        ;
    $doctor_id          = $_POST['doctor_id']         ;
    $appointment_date   = date("d-m-Y", strtotime($_POST['appointment_date']));



    $appointment_time_explode   = explode('_',$_POST['appointment_time']);
    $appointment_time = $appointment_time_explode[0];
    $session          = $appointment_time_explode[1];
    $serial   = $_POST['serial']  ;

  //INSERTION QUERY

    //$query = "INSERT INTO appointment(customer_name,reg_number,mobile_number,alt_number,chamber_location,speciality,doctor_id,appointment_date,appointment_time)
    //                VALUES('$customer_name','$reg_number','$mobile_number','$alt_number','$chamber_location','$speciality','$doctor_id','$appointment_date','$appointment_time')";

    $create_appointment = $conn->prepare("

        UPDATE appointment SET

          customer_name=:customer_name,
          reg_number=:reg_number,
          mobile_number=:mobile_number,
          alt_number=:alt_number,
          chamber_location=:chamber_location,
          speciality=:speciality,
          doctor_id=:doctor_id,
          appointment_date=:appointment_date,
          appointment_time=:appointment_time,
          serial=:serial,
          session=:session

        WHERE
          id=:id
    ");


    //BINDING VALUES
    $create_appointment->bindValue(':customer_name',$customer_name);
    $create_appointment->bindValue(':reg_number',$reg_number);
    $create_appointment->bindValue(':mobile_number',$mobile_number);
    $create_appointment->bindValue(':alt_number',$alt_number);
    $create_appointment->bindValue(':chamber_location',$chamber_location);
    $create_appointment->bindValue(':speciality',$speciality);
    $create_appointment->bindValue(':doctor_id',$doctor_id);
    $create_appointment->bindValue(':appointment_date',$appointment_date);
    $create_appointment->bindValue(':appointment_time',$appointment_time);
    $create_appointment->bindValue(':serial',$serial);
    $create_appointment->bindValue(':session',$session);
    $create_appointment->bindValue(':id',$id);



    if ($create_appointment->execute() == TRUE ) {
      header("location:index.php?success");
    }else{
      header("location:index.php?failed");
    }


  }


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
        New Appointment
      </h1>
    </section>

  <!-- Main content -->
    <section class="content">
      <div class="col-sm-12">
        <div class="row">

                <?php
                //direct from patient creation
                if(isset($_GET['lastId'])){
                    $id= $_GET['lastId'];
                    $search_query = "SELECT * FROM appointment WHERE id=$id";
                    $rowcount = $conn->query($search_query)->rowCount();

                    if($rowcount != NULL){
                      $search_customer_infos  = $conn->query($search_query)->fetchAll(PDO::FETCH_ASSOC);
                      $search_customer_info   = call_user_func_array('array_merge', $search_customer_infos);




                ?>
                <!--APPOINTMEN TAKING FORM-->
                    <form action="" method="post" id="appointment_form">
                      <!--PATIENT BASIC INFORMATION-->
                        <div class="box">
                          <div class="box-body">
                            <table class="table table-bordered table-condensed">
                              <tr>
                                <td><strong>Name:</strong></td><td><?php echo $search_customer_info['customer_name'] ?></td>
                                <td><strong>Reg No:</strong></td><td><?php echo $search_customer_info['reg_number'] ?></td>
                                <td><strong>Phone</strong></td><td><?php echo $search_customer_info['mobile_number'] ?></td>
                                <td><strong>Alt Phone</strong></td><td><?php echo $search_customer_info['alt_number'] ?></td>
                              </tr>
                            </table>
                          </div>
                        </div>


                        <!--CUSTOMER NAME AND REGISTRATION NUMBER-->
                          <input type="hidden" class="form-control"   name="customer_name" id="customer_name"  value="<?php echo $search_customer_info['customer_name'] ?>"  readonly/>
                          <input type="hidden" class="form-control"   name="reg_number"    id="reg_number"     value="<?php echo $search_customer_info['reg_number'] ?>"     readonly/>
                        <!--MOBILE NUMBER AND ALT MOBILE NUMBER-->
                          <input type="hidden" class="form-control"   name="mobile_number"  id="mobile_number"  value="<?php echo $search_customer_info['mobile_number'] ?>" readonly/>
                          <input type="hidden" class="form-control"   name="alt_number"     id="alt_number"     value="<?php echo $search_customer_info['alt_number'] ?>" readonly/>


                            <div class="row">
                              <div class="col-sm-4">
                                <div class="box">
                                  <div clas="box-body">
                                    <table class="table table-condensed table-bordered text-center">
                                      <tr>
                                        <th>Chamber</th>
                                        <th>Speciality</th>
                                        <th>Name</th>
                                      </tr>
                                      <tr>
                                        <td>
                                          <!--CHAMBER LOCATION-->
                                          <input type="text" class="form-control" list="doctor_chamber_location" id="chamber_location" name="chamber_location" required/>
                                          <datalist id="doctor_chamber_location">
                                            <?php
                                              $chamber_locations = $conn->query("SELECT chamber_location from doctor_profile GROUP BY chamber_location");
                                              $chamber_locations = $chamber_locations->fetchAll(PDO::FETCH_ASSOC);
                                              foreach($chamber_locations as $chamber_location):
                                            ?>
                                              <option value="<?php echo $chamber_location['chamber_location'] ?> "><?php echo $chamber_location['chamber_location'] ?></option>

                                            <?php endforeach;?>
                                          </datalist>
                                        </td>
                                        <td>
                                          <!--DOCTOR SPECIALITY-->
                                          <input type="text" class="form-control" list="doctor_speciality" id="speciality" name="speciality" required/>
                                          <datalist id="doctor_speciality">
                                            <?php
                                              $doctor_specialities = $conn->query("SELECT speciality from speciality GROUP BY speciality");
                                              $doctor_specialities = $doctor_specialities->fetchAll(PDO::FETCH_ASSOC);
                                              foreach($doctor_specialities as $doctor_speciality):
                                            ?>
                                              <option value="<?php echo $doctor_speciality['speciality'] ?>"><?php echo $doctor_speciality['speciality'] ?></option>

                                            <?php endforeach;?>
                                          </datalist>
                                        </td>
                                        <td>
                                          <input type="text" class="form-control" list="doctor_list" id="doctor_id" name="doctor_id" required/>
                                          <datalist id="doctor_list">

                                          </datalist>
                                        </td>
                                      </tr>
                                    </table>
                                  </div>
                                </div>


                                <div class="" id="doctor_profile">

                                </div>
                              </div>

                              <div class="col-sm-4">
                                <div class="box">
                                  <div clas="box-body">
                                    <table class="table table-condensed table-bordered text-center">
                                      <tr>
                                        <th>Appointment Date</th>
                                      </tr>
                                      <tr>
                                        <td>
                                            <div class="input-group date">
                                              <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                              </div>
                                              <input type="text" class="datepicker form-control pull-right" name="appointment_date" id="appointment_date">
                                               <p class="help-block" id="appointment_validation"></p>
                                            </div>
                                        </td>
                                      </tr>
                                    </table>
                                  </div>
                                </div>
                                <div id="appointment_slot_booked" class="info-text">

                                </div>
                                <!--APPOINTMENT TIME-->
                                    <div id="serial_slot">

                                    </div>
                              </div>
                                <!--END OF APPOINTMENT TIME-->
                            </div>

                          <!--PREVIEW WINDOW-->
                            <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
                                <div class="modal-dialog modal-lg" role="document">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                      <center>
                                        <h4 class="modal-title" id="myModalLabel">APPOINTMENT PREVIEW</h4>
                                      </center>
                                    </div>
                                    <div class="modal-body">
                                      <table class="table">
                                        <tr>
                                          <td>Customer Name:</td>
                                          <td><p id="customer_name_preview"></p></td>
                                          <td>Customer Registration Number:</td>
                                          <td><p id="customer_reg_number_preview"></p></td>
                                        </tr>
                                        <tr>
                                          <td>Mobile Number:</td>
                                          <td><p id="mobile_number_preview"></p></td>
                                          <td>Alt Number:</td>
                                          <td><p id="alt_number_preview"></p></td>
                                        </tr>
                                        <tr>
                                          <td>Chamber Location:</td>
                                          <td><p id="chamber_location_preview"></p></td>
                                          <td>Doctor Speciality:</td>
                                          <td><p id="speciality_preview"></p></td>
                                        </tr>
                                        <tr>
                                          <td>Doctor Name:</td>
                                          <td><p id="doctor_id_preview"></p></td>
                                          <td>Appointment Date</td>
                                          <td><p id="appointment_date_preview"></p></td>
                                        </tr>
                                        <tr>
                                          <td></td>
                                          <td></td>
                                          <td>Appointment Slot/Serial</td>
                                          <td><p id="appointment_serial_preview"></p><p id="appointment_time_preview"></p></td>
                                        </tr>
                                      </table>
                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                      <button class="btn btn-info" name="make_appointment">Make Appointment</button>
                                    </div>
                                  </div>
                                </div>
                              </div>

                            <br><br><br><br><br><br><br><br>
                            <center>
                              <button type="button" class="btn btn-primary" id="preview" name="" data-toggle="modal" data-target=".bs-example-modal-lg">PREVIEW</button>
                            </center>
                    </form>
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
