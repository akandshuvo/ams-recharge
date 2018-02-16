<?php
    session_start(); //starting the login session
    date_default_timezone_set('Asia/Dhaka');
    if($_SESSION['is_login'] != 1){
        header("location:/labaid/index.php"); // if user is not logged in,this will redirect user to the login page
    }
    include ('../dbconfig.php');
    include ('../function/function.php');

    //pulling doctor list from db

    $chamber_location = $_POST['chamber_location'];
    $speciality = $_POST['speciality'];

    $id=$_POST['id'];
    $appointment_date = date("d-m-Y", strtotime($_POST['appointment_date']));
    $doctor_id = $_POST['doctor_id'];
    $doctor_id_1 = $_POST['doctor_id_1'];

    // updating appointment with null value
    $appointment_serial         = '';//$_POST['appointment_serial']; // NULL DATA WILL BE UPDATED
    $appointment_slot           = '';//$_POST['appointment_slot'];


    // UPDATING APPOINTMENT INFORMATION

  // FETCHING DOCTOR PROFILE FROM DB => searched using location

    if(isset($_POST['doctor_id']) && !empty($_POST['doctor_id'])){
        $rowcount       = $conn->query("SELECT * from doctor_profile  WHERE doctor_id = '$doctor_id'")->rowCount();
        if($rowcount>0){
            #####################################################################################################################
            // UPDATING APPOINTMENT INFORMATION
            $prebook =  $conn->prepare("
                        UPDATE appointment SET doctor_id = :doctor_id,appointment_date=:appointment_date,appointment_time=:appointment_time,serial=:serial WHERE id=:id
            ");
            $prebook->bindValue(':id',$id);
            $prebook->bindValue(':doctor_id',$doctor_id);
            $prebook->bindValue(':appointment_date',$appointment_date);
            $prebook->bindValue(':appointment_time',$appointment_slot);
            $prebook->bindValue(':serial',$appointment_serial);

            $prebook->execute();
            #####################################################################################################################

            $doctor_profile = $conn->query("SELECT * from doctor_profile WHERE doctor_id = '$doctor_id'")->fetchAll(PDO::FETCH_ASSOC);
            foreach($doctor_profile as $doctor):
?>

                <div class="box">
                  <div class="box-body">
                    <center><h3>DOCTOR PROFILE</h3><button class="btn btn-info btn-sm" type="button" name="">View Schedule Summary</button> </center><hr>
                    <table class="table table-condensed table-bordered">
                        <tr>
                            <td><strong>Full Name</strong></td>
                            <td>
                              <input type="hidden" name="doctor_name_preview" id="doctor_name_preview" value="<?php echo $doctor['full_name'];?>">
                              <?php echo $doctor['full_name'];?>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Employee ID</strong></td>
                            <td><?php echo $doctor['employee_id'];?></td>
                        </tr>
                        <tr>
                            <td><strong>Doctor ID</strong></td>
                            <td><?php echo $doctor['doctor_id'];?></td>
                        </tr>
                        <tr>
                            <td><strong>Chamber Location</strong></td>
                            <td>
                              <?php echo $doctor['chamber_location'];?>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Chamber Address</strong></td>
                            <td><?php echo $doctor['chamber_address'];?></td>
                        </tr>
                        <tr>
                            <td><strong>Speciality</strong></td>
                            <td>
                              <?php echo $doctor['speciality'];?>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Department</strong></td>
                            <td><?php echo $doctor['department'];?></td>
                        </tr>
                        <tr>
                            <td><strong>Room Ext</strong></td>
                            <td><?php echo $doctor['room_ext'];?></td>
                        </tr>
                        <tr>
                            <td><strong>Assistrant Information</strong></td>
                            <td><?php echo $doctor['assistant_information'];?></td>
                        </tr>
                        <tr>
                            <td><strong>Type</strong></td>
                            <td><?php echo $doctor['type_of_doctor'];?></td>
                        </tr>
                        <tr>
                            <td><strong>Visit Charge</strong></td>
                            <td><?php echo $doctor['visit_charge'];?></td>
                        </tr>
                        <tr>
                            <td><strong>1st Session</strong></td>
                            <td><?php echo $doctor['session_1'];?></td>
                        </tr>
                        <tr>
                            <td><strong>2nd Session</strong></td>
                            <td><?php echo $doctor['session_2'];?></td>
                        </tr>
                        <tr>
                            <td><strong>3rd Session</strong></td>
                            <td><?php echo $doctor['session_3'];?></td>
                        </tr>
                        <tr>
                            <td><strong>About</strong></td>
                            <td><?php echo $doctor['short_description'];?></td>
                        </tr>
                    </table>
                  </div>
                </div>
<?php
            endforeach;
        }else{
            echo '<center><label class="label label-info">DOCTOR PROFILE NOT AVAILABLE<label></center>';
        }
    }





// FETCHING DOCTOR PROFILE FROM DB => searched using doctor name

if(isset($_POST['doctor_id_1']) && !empty($_POST['doctor_id_1'])){
    $rowcount       = $conn->query("SELECT * from doctor_profile  WHERE doctor_id = '$doctor_id_1'")->rowCount();


    if($rowcount>0){
      $doctor_profile = $conn->query("SELECT * from doctor_profile WHERE doctor_id = '$doctor_id_1'")->fetchAll(PDO::FETCH_ASSOC);
      #####################################################################################################################
      // UPDATING APPOINTMENT INFORMATION
      $prebook =  $conn->prepare("
                  UPDATE appointment SET doctor_id = :doctor_id,appointment_date=:appointment_date WHERE id=:id
      ");
      $prebook->bindValue(':id',$id);
      $prebook->bindValue(':doctor_id',$doctor_id_1);
      $prebook->bindValue(':appointment_date',$appointment_date);
      $prebook->execute();
      #####################################################################################################################
        foreach($doctor_profile as $doctor){
?>
            <div class="box">
              <div class="box-body">
                <center><h3>DOCTOR PROFILE</h3><button class="btn btn-info btn-sm" type="button" name="">View Schedule Summary</button></center><hr>
                <table class="table table-condensed table-bordered">
                    <tr>
                        <td><strong>Full Name</strong></td>
                        <td>
                          <input type="hidden" name="doctor_name_preview" id="doctor_name_preview" value="<?php echo $doctor['full_name'];?>">
                          <?php echo $doctor['full_name'];?>
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Employee ID</strong></td>
                        <td><?php echo $doctor['employee_id'];?></td>
                    </tr>
                    <tr>
                        <td><strong>Doctor ID</strong></td>
                        <td><?php echo $doctor['doctor_id'];?></td>
                    </tr>
                    <tr>
                        <td><strong>Chamber Location</strong></td>
                        <td>
                          <input type="hidden" name="chamber_location_preview_1" id="chamber_location_preview_1" value="<?php echo $doctor['chamber_location'];?>">
                          <?php echo $doctor['chamber_location'];?>
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Chamber Address</strong></td>
                        <td><?php echo $doctor['chamber_address'];?></td>
                    </tr>
                    <tr>
                        <td><strong>Speciality</strong></td>
                        <td>
                          <input type="hidden" name="speciality_preview_1" id="speciality_preview_1" value="<?php echo $doctor['speciality'];?>">
                          <?php echo $doctor['speciality'];?>
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Department</strong></td>
                        <td><?php echo $doctor['department'];?></td>
                    </tr>
                    <tr>
                        <td><strong>Room Ext</strong></td>
                        <td><?php echo $doctor['room_ext'];?></td>
                    </tr>
                    <tr>
                        <td><strong>Assistrant Information</strong></td>
                        <td><?php echo $doctor['assistant_information'];?></td>
                    </tr>
                    <tr>
                        <td><strong>Type</strong></td>
                        <td><?php echo $doctor['type_of_doctor'];?></td>
                    </tr>
                    <tr>
                        <td><strong>Visit Charge</strong></td>
                        <td><?php echo $doctor['visit_charge'];?></td>
                    </tr>
                    <tr>
                        <td><strong>1st Session</strong></td>
                        <td><?php echo $doctor['session_1'];?></td>
                    </tr>
                    <tr>
                        <td><strong>2nd Session</strong></td>
                        <td><?php echo $doctor['session_2'];?></td>
                    </tr>
                    <tr>
                        <td><strong>3rd Session</strong></td>
                        <td><?php echo $doctor['session_3'];?></td>
                    </tr>
                    <tr>
                        <td><strong>About</strong></td>
                        <td><?php echo $doctor['short_description'];?></td>
                    </tr>
                </table>
              </div>
            </div>
<?php

        }

    }else{
        echo '<center><label class="label label-info">DOCTOR PROFILE NOT AVAILABLE<label></center>';
    }

}

?>
