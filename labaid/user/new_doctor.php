<?php
  # => SESSION,DB CONNECTION,OTHER QUERIES
  session_start();
  
  # => CHECKING IF USER IS LOGGED IN OR NOT
  if($_SESSION['is_login'] != 1){
    header("location:/labaid/index.php"); // if user is not logged in,this will redirect user to the login page
  }

  
  include ('../dbconfig.php'); // database connection
 


 
 if (isset($post['create'])) {
   
  $designation                =   $post['designation'];
  $full_name                  =   $designation." ".$post['full_name'];
  $employee_id                =   $post['employee_id'];
  $doctor_id                  =   $post['doctor_id'];
  $chamber_location           =   $post['chamber_location'];
  $chamber_address            =   $post['chamber_address'];
  $speciality                 =   $post['speciality'];
  $department                 =   $post['department'];
  $room_ext                   =   $post['room_ext'];
  $assistant_information      =   $post['assistant_information'];
  $type_of_doctor             =   $post['type_of_doctor'];
  $visit_charge               =   $post['visit_charge'];
  $doctors_degree             =   $post['doctors_degree'];
  $short_description          =   $post['short_description'];
  $avg_load_patient           =   $post['avg_load_patient'];
  $avg_duration               =   $post['avg_duration'];
  $slot_serial                =   $post['slot_serial'];
  $session_1                  =   $post['session_1_start']."-".$post['session_1_end'];
  $session_2                  =   $post['session_2_start']."-".$post['session_2_end'];
  $session_3                  =   $post['session_3_start']."-".$post['session_3_end'];
  
 
  
  $new_doctor = $conn->prepare("
                INSERT INTO doctor_profile(
                                            full_name,
                                              employee_id,
                                                doctor_id,
                                                  chamber_location,
                                                    chamber_address,
                                                      speciality,
                                                        department,
                                                          room_ext,
                                                            assistant_information,
                                                              type_of_doctor,
                                                                visit_charge,
                                                                  doctors_degree,
                                                                    short_description,
                                                                      avg_load_patient,
                                                                        avg_duration,
                                                                          slot_serial,
                                                                            session_1,
                                                                              session_2,
                                                                                session_3
                                          )
                VALUE(
                        :full_name,
                          :employee_id,
                            :doctor_id,
                              :chamber_location,
                                :chamber_address,
                                  :speciality,
                                    :department,
                                      :room_ext,
                                        :assistant_information,
                                          :type_of_doctor,
                                            :visit_charge,
                                              :doctors_degree,
                                                :short_description,
                                                  :avg_load_patient,
                                                    :avg_duration,
                                                      :slot_serial,
                                                        :session_1,
                                                          :session_2,
                                                            :session_3
                )
  ");
  

  
  $new_doctor ->bindValue(':full_name',$full_name);
  $new_doctor ->bindValue(':employee_id',$employee_id);
  $new_doctor ->bindValue(':doctor_id',$doctor_id);
  $new_doctor ->bindValue(':chamber_location',$chamber_location);
  $new_doctor ->bindValue(':chamber_address',$chamber_address);
  $new_doctor ->bindValue(':speciality',$speciality);
  $new_doctor ->bindValue(':department',$department);
  $new_doctor ->bindValue(':room_ext',$room_ext);
  $new_doctor ->bindValue(':assistant_information',$assistant_information);
  $new_doctor ->bindValue(':type_of_doctor',$type_of_doctor);
  $new_doctor ->bindValue(':visit_charge',$visit_charge);
  $new_doctor ->bindValue(':doctors_degree',$doctors_degree);
  $new_doctor ->bindValue(':short_description',$short_description);
  $new_doctor ->bindValue(':avg_load_patient',$avg_load_patient);
  $new_doctor ->bindValue(':avg_duration',$avg_duration);
  $new_doctor ->bindValue(':slot_serial',$slot_serial);
  $new_doctor ->bindValue(':session_1',$session_1);
  $new_doctor ->bindValue(':session_2',$session_2);
  $new_doctor ->bindValue(':session_3',$session_3);
  
  if ($new_doctor ->execute() == TRUE) {
    header('location:new_doctor.php?success');
  }else{
    header('location:new_doctor.php?failed');
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
        Create New Doctor Profile
      </h1>
    </section>

  <!-- Main content -->
    <section class="content">
        <div class="row">
          <div class="box">
            <!-- /.box-header -->
            <div class="box-body">
<!--:::::::::::::::::::::::::::::::RESPONSE MESSAGE:::::::::::::::::::::::::::::::::::::::::::::::::::-->              
              <?php
                  if (isset($_GET['success'])) {
              ?>
                <script type="text/javascript">
                  swal("Good Job","Docotor Profile Created Successfully", "success")
                </script>
              <?php
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
  

              <form action="" method="post">
                <div class="form-group row">
                  <label for="" class="col-sm-2 col-form-label">Designation</label></label>
                  <div class="col-sm-4">
                    <select  class="form-control" id="" name="designation" required>
                      <option value="">Choose Your Option</option>
                      <option value="Professor">Professor</option>
                      <option value="Assistant Professor">Assistant Professor</option>
                      <option value="Associate Professor">Associate Professor</option>
                      <option value="Consultant">Consultant</option>
                    </select>
                  </div>
                  <label for="" class="col-sm-2 col-form-label">Full Name</label></label>
                  <div class="col-sm-4">
                    <input  type="text" class="form-control" id="" name="full_name" required>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="" class="col-sm-2 col-form-label">Employee ID</label></label>
                  <div class="col-sm-4">
                    <input  type="text" class="form-control" id="" list="doctor_list"  name="employee_id" required>
                    <datalist id="doctor_list">
                      <?php 
                         $doctor_lists = $conn->query("SELECT employee_id from user WHERE user_level=3")->fetchAll(PDO::FETCH_ASSOC);
                        foreach($doctor_lists as $doctor_list):
                      ?>
                        <option value="<?php echo $doctor_list['employee_id']?>"><?php echo $doctor_list['employee_id']?></option>
                      <?php endforeach;?>
                    <datalist>
                  </div>
                  <label for="password" class="col-sm-2 col-form-label">Doctors ID</label></label>
                  <div class="col-sm-4">
                    <input  type="" class="form-control" id="" name="doctor_id" required>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="employee_id" class="col-sm-2 col-form-label">Chamber Location</label></label>
                  <div class="col-sm-4">
                    <input  type="text" class="form-control" id="" name="chamber_location" required>
                  </div>
                  <label for="password" class="col-sm-2 col-form-label">Chamber Address</label></label>
                  <div class="col-sm-4">
                    <input  type="" class="form-control" id="" name="chamber_address" required>
                  </div>
                </div>
                
                <div class="form-group row">
                  <label for="" class="col-sm-2 col-form-label">Speciality</label></label>
                  <div class="col-sm-4">
                    <input  type="text" class="form-control" list="speciality" id="" name="speciality" required>
                    <datalist id="speciality">
                      <?php 
                         $specialities = $conn->query("SELECT speciality from speciality")->fetchAll(PDO::FETCH_ASSOC);
                        foreach($specialities as $speciality):
                      ?>
                        <option value="<?php echo $speciality['speciality']?>"><?php echo $speciality['speciality']?></option>
                      <?php endforeach;?>
                    <datalist>
                  </div>
                  <label for="" class="col-sm-2 col-form-label">Department</label></label>
                  <div class="col-sm-4">
                    <input  type="text" class="form-control" list="department" id="" name="department" required>
                    <datalist id="department">
                      <?php 
                         $departments = $conn->query("SELECT department_name from department")->fetchAll(PDO::FETCH_ASSOC);
                        foreach($departments as $department):
                      ?>
                        <option value="<?php echo $department['department_name']?>"><?php echo $department['department_name']?></option>
                      <?php endforeach;?>
                    <datalist>
                  </div>
                </div>
                
                <div class="form-group row">
                  <label for="" class="col-sm-2 col-form-label">Room No & Ext</label></label>
                  <div class="col-sm-4">
                    <input  type="text" class="form-control" id="" name="room_ext" required>
                  </div>
                  <label for="password" class="col-sm-2 col-form-label">Assistant Information</label></label>
                  <div class="col-sm-4">
                    <input  type="" class="form-control" id="" name="assistant_information" required>
                  </div>
                </div>
                
                <div class="form-group row">
                  <label for="" class="col-sm-2 col-form-label">Type of Doctor</label></label>
                  <div class="col-sm-4">
                    <select  class="form-control" id="" name="type_of_doctor" required>
                      <option value="">Choose Your Option</option>
                      <option value="Full Time">Full Time</option>
                      <option value="Part Time">Part Time</option>
                    </select>
                  </div>
                  <label for="password" class="col-sm-2 col-form-label">Visit Charge</label></label>
                  <div class="col-sm-4">
                    <input  type="" class="form-control" id="" name="visit_charge" required>
                  </div>
                </div>
                
                <div class="form-group row">
                  <label for="password" class="col-sm-2 col-form-label">Doctor's Degree</label></label>
                  <div class="col-sm-4">
                    <input  type="" class="form-control" id="" name="doctors_degree" required>
                  </div>
                  <label for="" class="col-sm-2 col-form-label">Short Description</label></label>
                  <div class="col-sm-4">
                    <textarea class="form-control" name="short_description" id="" rows="6" required></textarea>
                  </div>
                </div>
                
                
                <hr>
                <div class="form-group row">
                  <label for="" class="col-sm-2 col-form-label">Average Load Patient</label></label>
                  <div class="col-sm-4">
                    <input  type="text" class="form-control" id="" name="avg_load_patient" required>
                  </div>
                  <label for="" class="col-sm-2 col-form-label">Average Duration</label></label>
                  <div class="col-sm-4">
                    <input  type="" class="form-control" id="" name="avg_duration" required>
                  </div>
                </div>
                
                <div class="form-group row">
                  <label for="" class="col-sm-2 col-form-label">Time Slot/Serial</label></label>
                  <div class="col-sm-2">
                      <input type="radio" id="" name="slot_serial" value="1" required>Time Slot
                  </div>
                  <div class="col-sm-2">
                      <input type="radio" id="" name="slot_serial" value="2" required>Serial
                  </div>
                </div>
                
                <div class="form-group row">
                  <label for="" class="col-sm-2 col-form-label">First Session</label></label>
                  <div class="col-sm-1">
                    <h5>FROM</h5>
                  </div>
                  <div class="col-sm-3">
                    <input  type="time" class="form-control" id="" name="session_1_start" required>
                  </div>
                  <div class="col-sm-2">
                    <p>TO</p>
                  </div>
                  <div class="col-sm-4">
                    <input  type="time" class="form-control" id="" name="session_1_end" required>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="employee_id" class="col-sm-2 col-form-label">Second Session</label></label>
                  <div class="col-sm-1">
                    <h5>FROM</h5>
                  </div>
                  <div class="col-sm-3">
                    <input  type="time" class="form-control" id="" name="session_2_start">
                  </div>
                  <div class="col-sm-2">
                    <p>TO</p>
                  </div>
                  <div class="col-sm-4">
                    <input  type="time" class="form-control" id="" name="session_2_end">
                  </div>
                </div>
                <div class="form-group row">
                  <label for="employee_id" class="col-sm-2 col-form-label">Third Session</label></label>
                  <div class="col-sm-1">
                    <h5>FROM</h5>
                  </div>
                  <div class="col-sm-3">
                    <input  type="time" class="form-control" id="" name="session_3_start">
                  </div>
                  <div class="col-sm-2">
                    <p>TO</p>
                  </div>
                  <div class="col-sm-4">
                    <input  type="time" class="form-control" id="" name="session_3_end">
                  </div>
                </div>
                <hr>
                <center><button class="btn btn-info" type="submit" name="create">CREATE</button></center>
              </form> 
            </div>
          </div>
      </div>
    </section>
  </div>
  <!-- /.content-wrapper -->
  
  
  
<!--INCLUDING FOOTER-->
  <?php include('../footer.php');?>
  
  
