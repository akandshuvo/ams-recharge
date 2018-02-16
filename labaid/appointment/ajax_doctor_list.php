<?php

    session_start(); //starting the login session
    date_default_timezone_set('Asia/Dhaka');
    if($_SESSION['is_login'] != 1){
        header("location:/labaid/index.php"); // if user is not logged in,this will redirect user to the login page
    }
    include ('../dbconfig.php');
    include ('../function/function.php');

    //pulling doctor list from db
    $id= $_POST['id'];
    $chamber_location = $_POST['chamber_location'];
    $speciality = $_POST['speciality'];
    $appointment_date =date("d-m-Y", strtotime($_POST['appointment_date']));
    $doctor_id = $_POST['doctor_id'];

 echo $chamber_location;




  // FETCHING DOCTOR LIST FROM DB

      if(isset($_POST['chamber_location']) && !empty($_POST['chamber_location']) && isset($_POST['speciality']) && !empty($_POST['speciality'])){
        $doctor_lists = $conn->query("SELECT * from doctor_profile WHERE chamber_location = '$chamber_location' AND speciality = '$speciality'")->fetchAll(PDO::FETCH_ASSOC);
        $rowcount = $conn->query("SELECT * from doctor_profile  WHERE chamber_location = '$chamber_location' AND speciality = '$speciality'")->rowCount();
        if($rowcount>0){
          foreach($doctor_lists as $doctor_list){
            echo '<option value="'.$doctor_list['doctor_id'].'">'.$doctor_list['full_name'].'</option>';
          }
        }else{
          echo '<option value="">Doctor List Not Available</option>';
        }
      }



/*
// PULLING APPOINTMENT TIME SLOT

    if(isset($_POST['doctor_id']) && !empty($_POST['doctor_id']) && isset($_POST['appointment_date']) && !empty($_POST['appointment_date'])){

    // APPOITNMENT TIME VALIDATION
      $today = date("d-m-Y");
      if($appointment_date < $today){
        echo '<center style="color:#F44336">PLEASE CHOOSE A VALID DATE</center>';
      }else{


        $serial_slot = $conn->query("SELECT slot_serial FROM schedule WHERE doctor_id='$doctor_id' AND schedule_date='$appointment_date'")->fetchColumn();

        //TIME SLOT
          if ( $serial_slot == 1) {
            $slots = $conn->query("SELECT session_1,session_2,session_3,avg_load_patient,avg_duration FROM schedule WHERE doctor_id ='$doctor_id' AND schedule_date ='$appointment_date'")->fetchAll(PDO::FETCH_ASSOC);

            $booked_slot = $conn->query("SELECT appointment_time from appointment WHERE id=$id")->fetchAll(PDO::FETCH_ASSOC);
            $booked_slot = array_column($booked_slot, 'appointment_time');


            echo '<div class="box">';
            echo '<div class="box-body">';
            echo '<div id="serial_preview">';
            echo '<center><h4>APPOINTMENT SLOT</h4><hr></center>';

              foreach($slots as $slot){

                // FIRST SESSION
                    echo  '<div class="form-group row">';
                    echo  '<label for="" class="col-sm-3 col-form-label">1st Session:&nbsp;</label></label>' ;
                    echo  '<div class="col-sm-9">';
                          $session_1           = explode("-",$slot['session_1']);

                          $session_1_start      =   $session_1['0'];
                          $session_1_end        =   $session_1['1'];

                          $session_1_start_sec  =   strtotime("1970-01-01 $session_1_start UTC");
                          $session_1_end_sec    =   strtotime("1970-01-01 $session_1_end  UTC");

                          $session_1_ranges = hoursRange( $session_1_start_sec, $session_1_end_sec, 60 * 10, 'h:i a' );
                          $session_1_ranges = array_slice($session_1_ranges,0,-1);

                          $session_1_ranges = array_diff($session_1_ranges,$booked_slot); // removing booked appointment time

                          foreach ($session_1_ranges as $session_1_range){
                            echo  '<label class="">';
                            echo  '<input type="radio" onclick="hello()" id="" name="appointment_time" value="'.$session_1_range.''._1.'" required>';
                            echo  '&nbsp;'; echo   $session_1_range; echo '&nbsp;';
                            echo  '</label>';

                        }

                    echo  '</div>';
                    echo  '</div><hr>';


                // SECOND SESSION

                  if($slot['session_2'] != "-"){
                    echo  '<div class="form-group row">';
                    echo  '<label for="" class="col-sm-3 col-form-label">2nd Session:&nbsp;</label></label>' ;
                    echo  '<div class="col-sm-9">';
                          $session_2            = explode("-",$slot['session_2']);

                          $session_2_start      =   $session_2['0'];
                          $session_2_end        =   $session_2['1'];

                          $session_2_start_sec  =   strtotime("1970-01-01 $session_2_start UTC");
                          $session_2_end_sec    =   strtotime("1970-01-01 $session_2_end  UTC");

                          $session_2_ranges = hoursRange( $session_2_start_sec, $session_2_end_sec, 60 * 10, 'h:i a' );
                          $session_2_ranges = array_slice($session_2_ranges,0,-1);

                          $session_2_ranges = array_diff($session_2_ranges,$booked_slot);

                          foreach ($session_2_ranges as $session_2_range){
                            echo  '<label class="">';
                            echo  '<input type="radio" id="" onclick="hello()" name="appointment_time" value="'.$session_2_range.''._2.'" required>';
                            echo '&nbsp;'; echo   $session_2_range; echo '&nbsp;';
                            echo  '</label>';

                        }

                    echo  '</div>';
                    echo  '</div><hr>';
                 }


                // THIRD SESSION
                  if($slot['session_3'] != "-"){
                    echo  '<div class="form-group row">';
                    echo  '<label for="" class="col-sm-3 col-form-label">3rd Session:&nbsp;</label></label>' ;
                    echo  '<div class="col-sm-9">';
                          $session_3            = explode("-",$slot['session_3']);

                          $session_3_start      =   $session_3['0'];
                          $session_3_end        =   $session_3['1'];

                          $session_3_start_sec  =   strtotime("1970-01-01 $session_3_start UTC");
                          $session_3_end_sec    =   strtotime("1970-01-01 $session_3_end  UTC");

                          $session_3_ranges = hoursRange( $session_3_start_sec, $session_3_end_sec, 60 * 10, 'h:i a' );
                          $session_3_ranges = array_slice($session_3_ranges,0,-1);

                          $session_3_ranges_compared = array_diff($session_3_ranges,$booked_slot);

                          foreach ($session_3_ranges_compared as $session_3_range){
                            echo  '<label class="">';
                            echo  '<input type="radio" onclick="hello()" id="" name="appointment_time" value="'.$session_3_range.''._3.'" required>';
                            echo '&nbsp;'; echo   $session_3_range; echo '&nbsp;';
                            echo  '</label>';

                        }

                    echo  '</div>';
                    echo  '</div><hr>';

                 }
              // EMERGENCY SESSION
                  if ($slot['session_1'] != "-" && $slot['session_2'] != "-" && $slot['session_3'] != "-") {
                    echo        '<div class="form-group row">';
                    echo          '<label for="" class="col-sm-3 col-form-label">EMERGENCY</label></label>';
                    echo          '<div class="col-sm-4">';
                                      echo  '<input type="radio" onclick="hello()" id="" name="appointment_time" value="'.end($session_3_ranges).'" required>';
                                      echo '&nbsp;'; echo   end($session_3_ranges); echo '&nbsp;';
                    echo          '</div>';
                    echo        '</div>';
                  }

                  if ($slot['session_1'] != "-" && $slot['session_2'] != "-" && $slot['session_3'] == "-") {
                    echo        '<div class="form-group row">';
                    echo          '<label for="" class="col-sm-3 col-form-label">EMERGENCY</label></label>';
                    echo          '<div class="col-sm-4">';
                                      echo  '<input type="radio" onclick="hello()" id="" name="appointment_time" value="'.end($session_2_ranges).'" required>';
                                      echo '&nbsp;'; echo   end($session_2_ranges); echo '&nbsp;';
                    echo          '</div>';
                    echo        '</div>';
                  }

                  if ($slot['session_1'] != "-" && $slot['session_2'] == "-" && $slot['session_3'] == "-") {
                    echo        '<div class="form-group row">';
                    echo          '<label for="" class="col-sm-3 col-form-label">EMERGENCY</label></label>';
                    echo          '<div class="col-sm-4">';
                                      echo  '<input type="radio" onclick="hello()"  id="" name="appointment_time" value="'.end($session_1_ranges).'" required>';
                                      echo '&nbsp;'; echo   end($session_1_ranges); echo '&nbsp;';
                    echo          '</div>';
                    echo        '</div>';
                  }
              }
          }
      echo '</div>';
      echo '</div>';
      echo '</div>';


  // SERIAL
        if ($serial_slot == 2) {
          $serial = $conn->query("SELECT avg_load_patient FROM schedule  WHERE doctor_id='$doctor_id' AND schedule_date='$appointment_date' ")->fetchColumn();
          $booked_serial = $conn->query("SELECT serial FROM appointment WHERE doctor_id='$doctor_id' AND appointment_date='$appointment_date' ORDER BY id DESC LIMIT 0,1 ")->fetchColumn();
          if($booked_serial == NULL){
            $booked_serial = 1;
          }
          else{
            $booked_serial = $booked_serial+1;
          }


          if($booked_serial > $serial){
            echo '<center><h3>ALL SEAT HAS BEEN FILLED UP</h3></center>';
          } else{
              echo    '<div class="form-group row">';
              echo        '<label for="" class="col-sm-3 col-form-label">First Session:&nbsp;</label></label>';
              echo        '<div class="col-sm-9">';
              echo            '<input type="text" class="form-control"   value="'.$booked_serial.'" max="'.$serial.'"  id="serial" name="serial" readonly/>';
              echo        '</div>';
              echo    '</div><hr>';
          }
        }
      }
    }
*/

// serial slot

//    if (isset($_POST['serial_slot'])) {
//      echo $_POST['serial_slot'];
//    }

// Time slot

//    if (isset($_POST['appointment_time'])) {
//      echo $_POST['appointment_time'];
//    }




                  //SELECT OPTIONS
                  /*
                    echo    '<div class="form-group row">';
                    echo        '<label for="" class="col-sm-2 col-form-label">First Session:&nbsp;</label></label>';
                    echo        '<div class="col-sm-10">';

                                    $session_1            = explode("-",$slot['session_1']);

                                    $session_1_start      =   $session_1['0'];
                                    $session_1_end        =   $session_1['1'];

                                    $session_1_start_sec  =   strtotime("1970-01-01 $session_1_start UTC");
                                    $session_1_end_sec    =   strtotime("1970-01-01 $session_1_end  UTC");

                                    $session_1_ranges = hoursRange( $session_1_start_sec, $session_1_end_sec, 60 * (int)$slot['avg_duration'], 'h:i a' );
                                    $session_1_ranges = array_slice($session_1_ranges,0,-1);

                                    $session_1_ranges = array_diff($session_1_ranges,$booked_slot);


                                  //var_dump($session_1_ranges);die;
                                  //  foreach ($session_1_ranges as $session_1_range){
                                  //      echo    '<label class="">';
                                  //      echo        '<input type="radio" id="" name="appointment_time" value="'.$session_1_range.'" required>';
                                  //                    echo '&nbsp;';  echo $session_1_range; echo '&nbsp;';
                                  //      echo   '</label>';
                                  //
                                  //  }

                                  //

                                  echo  '<select class="form-control" required>';
                                  echo  '<option value="">Choose Your Time</option>';
                                    foreach ($session_1_ranges as $session_1_range){
                                      echo    '<option value="'.$session_1_range.'" >'.$session_1_range.'</option>';
                                    }
                                  echo '</select>';

                    echo        '</div>';
                    echo    '</div><hr>';
                  */

?>
