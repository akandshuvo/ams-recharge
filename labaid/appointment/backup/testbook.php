<?php
//SESSION,DB CONNECTION,OTHER QUERIES
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
    <script src="/labaid/appointment/scripts.js"></script>
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
        Customer Information
      </h1>
    </section>

  <!-- Main content -->
    <section class="content">
        <div class="row">
          <div class="box">
            <!-- /.box-header -->
            <div class="box-body">

                <?php

                    $search_query = "SELECT * from customer WHERE reg_number ='$reg_number' OR mobile_number = '01534653592'";
                    //echo $search_query;
                    $rowcount = $conn->query($search_query)->rowCount();
                    
                    if($rowcount != NULL){
                    $search_customer_infos = $conn->query($search_query)->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($search_customer_infos as $search_customer_info):
                  
                ?>
                
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
                
                <!--APPOINTMEN TAKING FORM-->
                <form action="" method="post"> 
                                 
                  <!--CUSTOMER NAME AND REGISTRATION NUMBER--> 
                    <input type="hidden" class="form-control"   name="customer_name" id="customer_name"  value="<?php echo $search_customer_info['customer_name'] ?>"  readonly/>  
                    <input type="hidden" class="form-control"   name="reg_number"    id="reg_number"     value="<?php echo $search_customer_info['reg_number'] ?>"     readonly/>
                  <!--MOBILE NUMBER AND ALT MOBILE NUMBER-->  
                    <input type="hidden" class="form-control"   name="mobile_number"  id="mobile_number"  value="<?php echo $search_customer_info['mobile_number'] ?>" readonly/>  
                    <input type="hidden" class="form-control"   name="alt_number"     id="alt_number"     value="<?php echo $search_customer_info['alt_number'] ?>" readonly/>


                    <div class="row">
                      <div class="col-sm-6">
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
                        <!--Doctor Profile-->

                        <div class="" id="doctor_profile">
                          
                        </div>
                      </div>
                    
                      <div class="col-sm-6">
                        
                        <div class="box">
                          <div class="box-body">
                            <!--------------------------------------------------------------------------------------------------------->
                            <table class="table table-bordered table-condensed text-center">
                              <tr>
                                <td>Appointment Date</td>
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
                            <!--------------------------------------------------------------------------------------------------------->
                          </div>
                        </div>

                        <!--APPOINTMENT TIME--> 
                        <div class="box">
                          <div class="box-body">
                            <div id="serial_slot">
                              
                            </div>  
                          </div>
                        </div>
                        <!--END OF APPOINTMENT TIME-->
                      </div>
                  </div>
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
                                  <td>
                                    Mobile Number:
                                  </td>
                                  <td>
                                    <p id="mobile_number_preview"></p>
                                  </td>
                                  <td>
                                    Alt Number:
                                  </td>
                                  <td>
                                    <p id="alt_number_preview"></p>
                                  </td>
                                </tr>
                                <tr>
                                  <td>
                                    Chamber Location:
                                  </td>
                                  <td>
                                    <p id="chamber_location_preview"></p>
                                  </td>
                                  <td>
                                    Doctor Speciality:
                                  </td>
                                  <td>
                                    <p id="speciality_preview"></p>
                                  </td>
                                </tr>
                                <tr>
                                  <td>
                                    Doctor Name:
                                  </td>
                                  <td>
                                    <p id="doctor_id_preview"></p>
                                  </td>
                                  <td>
                                    Appointment Date
                                  </td>
                                  <td>
                                    <p id="appointment_date_preview"></p>
                                  </td>
                                </tr>
                                <tr>
                                  <td>
                                    
                                  </td>
                                  <td>
                                    
                                  </td>
                                  <td>
                                    Appointment Slot/Serial
                                  </td>
                                  <td>
                                    <p id="appointment_serial_preview"></p>
                                    <p id="appointment_time_preview"></p>
                                  </td>
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
                      <center>
                        <button type="button" class="btn btn-primary" id="preview" data-toggle="modal" data-target=".bs-example-modal-lg">PREVIEW</button>
                      </center>  
                  </form>
                <?php
                  endforeach;
                    }
                ?>  
                  
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
  
  
