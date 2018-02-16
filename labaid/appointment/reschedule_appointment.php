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
    $appointment_date   = date("d-m-Y", strtotime($_POST['appointment_date']));

    if($_POST['chamber_location']!=NULL){$chamber_location = $_POST['chamber_location'];}
    if($_POST['chamber_location_preview_1']!=NULL){$chamber_location = $_POST['chamber_location_preview_1'];}

    if($_POST['speciality']!=NULL){$speciality = $_POST['speciality'];}
    if($_POST['speciality_preview_1']!=NULL){$speciality = $_POST['speciality_preview_1'];}


    $doctor_id          = $_POST['doctor_id'];
    $doctor_id_1        = $_POST['doctor_id_1'];

    $appointment_time_explode   = explode('_',$_POST['appointment_time']);
    $appointment_time = $appointment_time_explode[0];
    $session          = $appointment_time_explode[1];


    //  echo " UPDATE appointment SET alt_number='$alt_number', chamber_location='$chamber_location',speciality='$speciality' WHERE id='$id'";

    $create_appointment = $conn->prepare("
        UPDATE appointment SET
          alt_number        = :alt_number,
          chamber_location  = :chamber_location,
          speciality        = :speciality,
          appointment_date  = :appointment_date,
          status=:status
        WHERE
          id                = :id
    ");
    //BINDING VALUES
    $create_appointment->bindValue(':alt_number',$alt_number);
    $create_appointment->bindValue(':chamber_location',$chamber_location);
    $create_appointment->bindValue(':speciality',$speciality);
    $create_appointment->bindValue(':appointment_date',$appointment_date);
    $create_appointment->bindValue(':status',2);
    $create_appointment->bindValue(':id',$id);

    if ($create_appointment->execute() == TRUE ){       
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
  <link rel="stylesheet" href="/labaid/appointment/radio.css">


</head>

<body class="hold-transition skin-blue sidebar-mini sidebar-collapse">
<div class="wrapper">

<!--INCLUDING NAVIGATION-->
  <?php include('../nav.php');?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1 class="text-center">New Appointment</h1>
    </section>

  <!-- Main content -->
    <section class="content">

        <div class="row-fluid">

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
                              <tr>
                                <td><strong>Doctor </strong></td><td><?php echo $search_customer_info['doctor_id'] ?></td>
                                <td><strong>Date</strong></td><td><?php echo $search_customer_info['appointment_date'] ?></td>
                                <td><strong>Slot/Serial</strong></td><td><?php echo $search_customer_info['appointment_time'];echo $search_customer_info['serial']; ?></td>
                                <td><strong>Location</strong></td><td><?php echo $search_customer_info['chamber_location'] ?></td>
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
                              <div class="col-sm-3">
                                <div class="box">
                                  <div clas="box-body">
                                    <table class="table table-condensed table-bordered text-center">
                                      <tr>
                                        <th>Search Option</th>
                                      </tr>
                                      <tr>
                                        <td>
                                          <select class="form-control" name="" id="search_category">
                                            <option value="">Choose Your option</option>
                                            <option value="location">Search By Location</option>
                                            <option value="name_of_doctor">Search By Doctor Name</option>
                                          </select>
                                        </td>
                                      </tr>
                                    </table>
                                  </div>
                                </div>
                                <!--DOCTOR LIST HERE => SEARCH USING LOCATION AND SPECIALITY------------------------------------------------------------->
                                <div class="box location search_option" style="display:none">
                                  <div clas="box-body">
                                    <table id="" class=" table table-condensed table-bordered text-center" >
                                      <tr>
                                        <th>Select Doctor From Below</th>
                                      </tr>
                                      <tr>
                                        <td>
                                          <select id="doctor_id" name="doctor_id" class="form-control" size="15">
                                              <option value="">Choose Your Option</option>
                                          </select>
                                        </td>
                                      </tr>
                                    </table>
                                  </div>
                                </div>
                                <!------------------------------------------------------------------------------------------------------------------------->
                                <!--DOCTOR LIST HERE => SEARCH USING DOCTOR NAME------------------------------------------------------------->
                                <div class="box name_of_doctor search_option" style="display:none">
                                  <div clas="box-body">
                                    <table id="" class=" table table-condensed table-bordered text-center" >
                                      <tr>
                                        <th>Select Doctor From Below</th>
                                      </tr>
                                      <tr>
                                        <td>
                                          <select id="doctor_id_1" name="doctor_id_1" class="form-control" size="15">
                                              <option value="">Choose Your Option</option>
                                          </select>
                                        </td>
                                      </tr>
                                    </table>
                                  </div>
                                </div>
                                <!------------------------------------------------------------------------------------------------------------------------->
                              </div>

                              <!---MIDDLE COLUMN------------------------------------------------------------------------------------------------------------------------->
                              <div class="col-sm-4">
                                <div class="box location search_option" style="display:none;">
                                  <div clas="box-body">
                                    <table id=""  class="table table-condensed table-bordered text-center">
                                      <tr>
                                        <th>Chamber</th>
                                        <th>Speciality</th>
                                      </tr>
                                      <tr>
                                        <td>
                                          <!--CHAMBER LOCATION-->
                                        <!--  <input type="text" class="form-control" list="doctor_chamber_location" id="chamber_location" name="chamber_location" required/> -->
                                          <select class="form-control" id="chamber_location" name="chamber_location">
                                            <option value="">Choose Your Option</option>
                                            <?php
                                              $chamber_locations = $conn->query("SELECT chamber_location from doctor_profile GROUP BY chamber_location");
                                              $chamber_locations = $chamber_locations->fetchAll(PDO::FETCH_ASSOC);
                                              foreach($chamber_locations as $chamber_location):
                                            ?>
                                              <option value="<?php echo $chamber_location['chamber_location'] ?> "><?php echo $chamber_location['chamber_location'] ?></option>

                                            <?php endforeach;?>
                                          </select>
                                        </td>
                                        <td>
                                          <!--DOCTOR SPECIALITY-->

                                          <select id="speciality" class="form-control" name="speciality">
                                            <option value="">Choose Your Option</option>
                                            <?php
                                              $doctor_specialities = $conn->query("SELECT speciality from speciality GROUP BY speciality");
                                              $doctor_specialities = $doctor_specialities->fetchAll(PDO::FETCH_ASSOC);
                                              foreach($doctor_specialities as $doctor_speciality):
                                            ?>
                                              <option value="<?php echo $doctor_speciality['speciality'] ?>"><?php echo $doctor_speciality['speciality'] ?></option>

                                            <?php endforeach;?>
                                          </select>
                                        </td>
                                      </tr>
                                    </table>
                                  </div>
                                </div>
                                <!--SEARCH DOCTOR BY NAME------------------------------------------------------------------------------------------------>
                                <div class="box name_of_doctor search_option" style="display:none;">
                                  <div clas="box-body">
                                    <table id=""  class="table table-condensed table-bordered text-center">
                                      <tr>
                                        <th>Doctor Name</th>
                                      </tr>
                                      <tr>
                                        <td>
                                          <input type="text" class="form-control" name="doctor_name" id="doctor_name" value="">
                                        </td>
                                      </tr>
                                    </table>
                                  </div>
                                </div>
                                <!------------------------------------------------------------------------------------------------------------------------>
                                <!--DOCTOR PROFILE-------------------------------------------------------------------------------------------------------->
                                <div class="" id="doctor_profile"></div>
                                <!------------------------------------------------------------------------------------------------------------------------>
                              </div>
                              <!--MIDDLE COLUMN ENDS HERE------------------------------------------------------------------------------------------------------------------>

                              <div class="col-sm-5">
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
                                              <input type="date" value="<?php echo date('Y-m-d'); ?>" class="form-control pull-right" name="appointment_date" id="appointment_date">
                                               <p class="help-block" id="appointment_validation"></p>
                                            </div>
                                        </td>
                                      </tr>
                                    </table>
                                  </div>
                                </div>
                                <!--APPOINTMENT TIME-->
                                <div id="serial_slot"></div>


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
                                          <td><p id="chamber_location_preview"></p><p id="chamber_location_preview_text"></p></td>
                                          <td>Doctor Speciality:</td>
                                          <td><p id="speciality_preview"></p><p id="speciality_preview_text"></p></td>
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
                            <center>
                              <button type="button" class="btn btn-primary" id="preview" name="" data-toggle="modal" data-target=".bs-example-modal-lg">PREVIEW</button>
                            </center>
                    </form>
                <?php

                    }
                  }
                ?>

      </div>
    </section>
  </div>

  <!-- /.content-wrapper -->




  <script type="text/javascript">
    $(function() {
          $('#search_category').change(function(){
            $('.search_option').hide();
            $('.' + $(this).val()).show();
          });
    });
  </script>


<!--PREVIEW WINDOW-->
  <script type="text/javascript">
    $(document).ready(function(){
        var Customer_Name       = document.getElementById("customer_name").value;
        $("#customer_name_preview").text(Customer_Name);

        var Customer_Reg_Number       = document.getElementById("reg_number").value;
        $("#customer_reg_number_preview").text(Customer_Reg_Number);

        var Mobile_Number       = document.getElementById("mobile_number").value;
        $("#mobile_number_preview").text(Mobile_Number);

        var Alt_Number       = document.getElementById("alt_number").value;
        $("#alt_number_preview").text(Alt_Number);

        $('#chamber_location').on('change',function(){
          var Chamber_Location       = document.getElementById("chamber_location").value;
           $("#chamber_location_preview_text").empty();
          $("#chamber_location_preview").text(Chamber_Location);
        });

        $('#speciality').on('change',function(){
          var Doctor_Speciality       = document.getElementById("speciality").value;
          $("#speciality_preview_text").empty();
          $("#speciality_preview").text(Doctor_Speciality);
        });

      //  $('#doctor_id').on('change',function(){
      //    var Doctor_ID       = document.getElementById("doctor_id").value;
      //    $("#doctor_id_preview").text(Doctor_ID);
      //  });

      //  $('#doctor_id_1').on('change',function(){
      //    var Doctor_ID         = document.getElementById("doctor_id_1").value;
      //    $("#doctor_id_preview").empty();
      //    $("#doctor_id_preview").text(Doctor_ID);
      //  });

        var Appointment_date       = document.getElementById("appointment_date").value;
        $("#appointment_date_preview").text(Appointment_date);

        $('#appointment_date').on('change',function(){
          var Appointment_date       = document.getElementById("appointment_date").value;
          $("#appointment_date_preview").empty();
          $("#appointment_date_preview").text(Appointment_date);
        });

   });

   // APPOINTMENT SLOT IN PREVIEW WINDOW
   $("#preview").click(function() {
     var Chamber_Location_1  = $("input[name=chamber_location_preview_1]").val();
     var Doctor_Speciality_1 = $("input[name=speciality_preview_1]").val();
     var Doctor_Name = $("input[name=doctor_name_preview]").val();

     var val = $('input[name=appointment_time]:checked').val();
     var mystr = val;
     //Splitting it with : as the separator
     var myarr = mystr.split("_");
     //PRINTING DATA IN PREVIEW WINDOWS
     $("#appointment_serial_preview").text(myarr[0]);

     if(Chamber_Location_1 ){
       $("#chamber_location_preview_text").empty();
       $("#chamber_location_preview").empty();
       $("#chamber_location_preview_text").text(Chamber_Location_1);
     }

     if(Doctor_Speciality_1){
       $("#speciality_preview_text").empty();
       $("#speciality_preview").empty();
       $("#speciality_preview_text").text(Doctor_Speciality_1);
     }



     $("#doctor_id_preview").empty();
     $("#doctor_id_preview").text(Doctor_Name);

   });
  </script>

<!--INSERTING APPOINTMENT SLOT WHILE SELECTING-->
  <script type="text/javascript">
    function slot_booking(){
      var doctorList1            = document.getElementById("doctor_id").value;
      var doctorList2            = document.getElementById("doctor_id_1").value;
      var appointmentDate        = document.getElementById("appointment_date").value;
      var id                     = "<?php echo $_GET['lastId']?>";
      var appointment_slot       = $('input[name=appointment_time]:checked').val();
      var radio_id               = appointment_slot.replace(/\s/g,'');
      //when searched by chamber location and speciality
      if(appointment_slot && doctorList1 && appointmentDate){
        $.ajax({
        type:'POST',
        url:'ajax_appointment_slot.php',
        data:'appointment_slot='+appointment_slot+'&id='+id+'&doctor_id='+doctorList1+'&appointment_date='+appointmentDate,
          success:function(html){
            var result = html;
            if(result == 0){
              var message = "SORRY, THIS SLOT HAS BEEN BOOKED";
              $('input[name=appointment_time]').removeAttr("checked");
              if(appointmentDate && doctorList1 ){
                $.ajax({
                type:'POST',
                url:'ajax_serial_slot.php',
                data:'doctor_id='+doctorList1+'&appointment_date='+appointmentDate+'&id='+id+'&message='+message,
                success:function(html){
                  $('#serial_slot').html(html).fadeIn('3000');
                  //alert(html);
                  }
                });
              }
            }
            if(result == 1){
              var message = "";
              $('input[name=appointment_time]').removeAttr("checked");
              if(appointmentDate && doctorList1 ){
                $.ajax({
                type:'POST',
                url:'ajax_serial_slot.php',
                data:'doctor_id='+doctorList1+'&appointment_date='+appointmentDate+'&id='+id+'&message='+message,
                success:function(html){
                  $('#serial_slot').html(html).fadeIn('3000');
                  //alert(html);
                  }
                });
              }
            }
          }
        });
      }
      //WHEN SEARCHED BY NAME
      if(appointment_slot && doctorList2 && appointmentDate){
        $.ajax({
        type:'POST',
        url:'ajax_appointment_slot.php',
        data:'appointment_slot='+appointment_slot+'&id='+id+'&doctor_id_1='+doctorList2+'&appointment_date='+appointmentDate,
          success:function(html){
            var result = html;
            if(result == 0){
              var message = "SORRY, THIS SLOT HAS BEEN BOOKED";
              $('input[name=appointment_time]').removeAttr("checked");
              if(appointmentDate && doctorList2 ){
                $.ajax({
                type:'POST',
                url:'ajax_serial_slot.php',
                data:'doctor_id_1='+doctorList2+'&appointment_date='+appointmentDate+'&id='+id+'&message='+message,
                success:function(html){
                  $('#serial_slot').html(html).fadeIn('3000');
                  //alert(html);
                  }
                });
              }
            }
            if(result == 1){
              var message = "";
              $('input[name=appointment_time]').removeAttr("checked");
              if(appointmentDate && doctorList2 ){
                $.ajax({
                type:'POST',
                url:'ajax_serial_slot.php',
                data:'doctor_id_1='+doctorList2+'&appointment_date='+appointmentDate+'&id='+id+'&message='+message,
                success:function(html){
                  $('#serial_slot').html(html).fadeIn('3000');
                  //alert(html);
                  }
                });
              }
            }
          }
        });
      }
    }
  </script>
<!--EMERGENCY SLOT-->
<script type="text/javascript">
  function emergency_slot(){
    var doctorList1            = document.getElementById("doctor_id").value;
    var doctorList2            = document.getElementById("doctor_id_1").value;
    var appointmentDate        = document.getElementById("appointment_date").value;
    var id                     = "<?php echo $_GET['lastId']?>";
    var appointment_slot       = $('input[name=appointment_time]:checked').val();
    var radio_id               = appointment_slot.replace(/\s/g,'');


    //when searched by chamber location and speciality
    if(appointment_slot && doctorList1 && appointmentDate){
      $.ajax({
      type:'POST',
      url:'ajax_appointment_slot.php',
      data:'appointment_slot='+appointment_slot+'&id='+id+'&doctor_id='+doctorList1+'&appointment_date='+appointmentDate,
        success:function(html){
          var result = html;
        }
      });
    }
    //WHEN SEARCHED BY NAME
    if(appointment_slot && doctorList2 && appointmentDate){
      $.ajax({
      type:'POST',
      url:'ajax_appointment_slot.php',
      data:'appointment_slot='+appointment_slot+'&id='+id+'&doctor_id_1='+doctorList2+'&appointment_date='+appointmentDate,
        success:function(html){
          var result = html;
        }
      });
    }
  }
</script>

<!--INSERTING APPOINTMENT Serial WHILE SELECTING-->
<script type="text/javascript">
  function serial_booking(){
    //var val = $('input[name=appointment_time]:checked').val();
    //var mystr = val;

    //Splitting it with : as the separator
    //var myarr = mystr.split("_");
    var id = "<?php echo $_GET['lastId']?>";
    var doctorList1            = document.getElementById("doctor_id").value;
    var doctorList2            = document.getElementById("doctor_id_1").value;
    var appointmentDate        = document.getElementById("appointment_date").value;
    var appointment_serial = $('input[name=appointment_time]:checked').val();

    //when searched by chamber location and speciality
    if(appointment_serial && doctorList1 && appointmentDate){

      $.ajax({
      type:'POST',
      url:'ajax_appointment_serial.php',
      data:'appointment_serial='+appointment_serial+'&id='+id+'&doctor_id='+doctorList1+'&appointment_date='+appointmentDate,
        success:function(html){
          var result = html;
          if(result == 0){
            var message = "SORRY, THIS SERIAL HAS BEEN BOOKED";
            $('input[name=appointment_time]').removeAttr("checked");
            if(appointmentDate && doctorList1 ){
              $.ajax({
              type:'POST',
              url:'ajax_serial_slot.php',
              data:'doctor_id='+doctorList1+'&appointment_date='+appointmentDate+'&id='+id+'&message='+message,
              success:function(html){
                $('#serial_slot').html(html).fadeIn('3000');
                //alert(html);
                }
              });
            }
          }
          if(result == 1){
            var message = "";
            $('input[name=appointment_time]').removeAttr("checked");
            if(appointmentDate && doctorList1 ){
              $.ajax({
              type:'POST',
              url:'ajax_serial_slot.php',
              data:'doctor_id='+doctorList1+'&appointment_date='+appointmentDate+'&id='+id+'&message='+message,
              success:function(html){
                $('#serial_slot').html(html).fadeIn('3000');
                //alert(html);
                }
              });
            }
          }

        }
      });
    }
    //WHEN SEARCHED BY NAME
    if(appointment_serial && doctorList2 && appointmentDate){
      $.ajax({
      type:'POST',
      url:'ajax_appointment_serial.php',
      data:'appointment_serial='+appointment_serial+'&id='+id+'&doctor_id_1='+doctorList2+'&appointment_date='+appointmentDate,
        success:function(html){
          var result = html;
          if(result == 0){
            var message = "SORRY, THIS SLOT HAS BEEN BOOKED";
            $('input[name=appointment_time]').removeAttr("checked");
            if(appointmentDate && doctorList2 ){
              $.ajax({
              type:'POST',
              url:'ajax_serial_slot.php',
              data:'doctor_id_1='+doctorList2+'&appointment_date='+appointmentDate+'&id='+id+'&message='+message,
              success:function(html){
                $('#serial_slot').html(html).fadeIn('3000');
                //alert(html);
                }
              });
            }
          }
          if(result == 1){
            var message = "";
            $('input[name=appointment_time]').removeAttr("checked");
            if(appointmentDate && doctorList2 ){
              $.ajax({
              type:'POST',
              url:'ajax_serial_slot.php',
              data:'doctor_id_1='+doctorList2+'&appointment_date='+appointmentDate+'&id='+id+'&message='+message,
              success:function(html){
                $('#serial_slot').html(html).fadeIn('3000');
                //alert(html);
                }
              });
            }
          }
        }
      });
    }
  }
</script>
<!--EMERGENCY SLOT-->
<script type="text/javascript">
  function emergency_serial(){
    var id = "<?php echo $_GET['lastId']?>";
    var doctorList1            = document.getElementById("doctor_id").value;
    var doctorList2            = document.getElementById("doctor_id_1").value;
    var appointmentDate        = document.getElementById("appointment_date").value;
    var appointment_serial = $('input[name=appointment_time]:checked').val();

    //when searched by chamber location and speciality
    if(appointment_serial && doctorList1 && appointmentDate){

      $.ajax({
      type:'POST',
      url:'ajax_appointment_serial.php',
      data:'appointment_serial='+appointment_serial+'&id='+id+'&doctor_id='+doctorList1+'&appointment_date='+appointmentDate,
        success:function(html){
          var result = html;
        }
      });
    }
    //WHEN SEARCHED BY NAME
    if(appointment_serial && doctorList2 && appointmentDate){
      $.ajax({
      type:'POST',
      url:'ajax_appointment_serial.php',
      data:'appointment_serial='+appointment_serial+'&id='+id+'&doctor_id_1='+doctorList2+'&appointment_date='+appointmentDate,
        success:function(html){
          var result = html;
        }
      });
    }
  }
</script>

<!--AJAX REQUESTS-->

  <script type="text/javascript">

      $(document).ready(function(){

        // SEARCH USING DOCTOR NAME
            $('#doctor_name').on('keyup',function(){
                var Doctor_Name = $(this).val();
                //console.log(Doctor_Name);
                if(Doctor_Name){
                    $.ajax({
                        type:'POST',
                        url:'ajax_doctor_name.php',
                        data:'doctor_name='+Doctor_Name,
                        success:function(html){
                          $('#doctor_id_1').html(html);
                          //alert(html);
                        }
                    });
                }
            });

        // MAKING AJAX REQUEST WHILE CHANGINg DOCTOR SPECIALITY
            $('#speciality').on('change',function(){
                var Speciality = $(this).val();
                var chamberLocation = document.getElementById("chamber_location").value;

                if(Speciality){
                    $.ajax({
                        type:'POST',
                        url:'ajax_doctor_list.php',
                        data:'chamber_location='+chamberLocation+'&speciality='+Speciality,
                        success:function(html){
                          $('#doctor_id').html(html);
                          //alert(html);
                        }
                    });
                }
            });



        // for doctor profile => SEARCHING USING LOCATION AND SPECIALITY
            $('#doctor_id').on('change',function(){
              var doctorid              = document.getElementById("doctor_id").value;
              var appointmentDate       = document.getElementById("appointment_date").value;
              var id                    = "<?php echo $_GET['lastId']?>";
              if(doctorid && appointmentDate){
                  $.ajax({
                        type:'POST',
                        url:'ajax_doctor_profile_reschedule.php',
                        data:'doctor_id='+doctorid+'&appointment_date='+appointmentDate+'&id='+id,
                        success:function(html){
                          $('#doctor_profile').html(html);
                          //alert(html);
                        }
                    });
                  $.ajax({
                      type:'POST',
                      url:'ajax_serial_slot.php',
                      data:'doctor_id='+doctorid+'&appointment_date='+appointmentDate+'&id='+id,
                      success:function(html){
                          $('#serial_slot').html(html);
                          //alert(html);
                      }
                  });

              }
          });


        // FOR DOCTOR PROFILE => SEARCHING USING NAME
            $('#doctor_id_1').on('change',function(){
            var doctorid              = document.getElementById("doctor_id_1").value;
            var appointmentDate       = document.getElementById("appointment_date").value;
            var id                    = "<?php echo $_GET['lastId']?>";
              if(doctorid && appointmentDate){
                  $.ajax({
                      type:'POST',
                      url:'ajax_doctor_profile_reschedule.php',
                      data:'doctor_id_1='+doctorid+'&appointment_date='+appointmentDate+'&id='+id,
                      success:function(html){
                        $('#doctor_profile').fadeIn('slow').html(html);
                        //alert(html);
                      }
                  });
                  $.ajax({
                      type:'POST',
                      url:'ajax_serial_slot.php',
                      data:'doctor_id_1='+doctorid+'&appointment_date='+appointmentDate+'&id='+id,
                      success:function(html){
                        $('#serial_slot').fadeIn('slow').html(html);
                        //alert(html);
                      }
                  });
              }
        });

        // MAKING AJAX CALL WHILE SELECTING APPOINTMENT DATE
            $('#appointment_date').on('change',function(){
                var doctorList1            = document.getElementById("doctor_id").value;
                var doctorList2            = document.getElementById("doctor_id_1").value;
                var appointmentDate        = document.getElementById("appointment_date").value;
                var id = "<?php echo $_GET['lastId']?>";


                  if(appointmentDate && doctorList1 ){
                      $.ajax({
                          type:'POST',
                          url:'ajax_serial_slot.php',
                          data:'doctor_id='+doctorList1+'&appointment_date='+appointmentDate+'&id='+id,
                          success:function(html){
                            $('#serial_slot').html(html).fadeIn('3000');
                            //alert(html);
                          }
                      });
                  }
                  if(appointmentDate && doctorList2 ){
                      $.ajax({
                          type:'POST',
                          url:'ajax_serial_slot.php',
                          data:'doctor_id_1='+doctorList2+'&appointment_date='+appointmentDate+'&id='+id,
                          success:function(html){
                            $('#serial_slot').html(html).fadeIn('3000');
                            //alert(html);
                          }
                      });
                  }

            });

        //FUNCTION FOR WHEN RADIO BUTTON CLICKED => CHECK IF THE SLOT IS BOOKED OR Not

    });

  </script>


<!--CLEARING AJAX PULLED DATA-->
  <script type="text/javascript">
      $('#search_category').on('change',function(){
        var search_category       = document.getElementById("search_category").value;


        if(search_category == "location"){
          $( "#doctor_id_1" ).empty();
          $( "#doctor_profile" ).empty();
          $( "#serial_slot" ).empty();
        }
        if(search_category == "name_of_doctor"){
          $( "#doctor_id" ).empty();
          $( "#doctor_profile" ).empty();
          $( "#serial_slot" ).empty();
          $( "#chamber_location_preview" ).empty();
          $( "#speciality_preview" ).empty();
        }
      });
  </script>
  <script>
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();
    });
  </script>

<!--INCLUDING FOOTER-->
  <?php include('../footer.php');?>
