<?php

      session_start(); //starting the login session
      date_default_timezone_set('Asia/Dhaka');
      if($_SESSION['is_login'] != 1){
        header("location:/labaid/index.php"); // if user is not logged in,this will redirect user to the login page
      }
      include ('../dbconfig.php');
      include ('../function/function.php');

      $today                      = date("d-m-Y");
      $id                         = $_POST['id'];
      $chamber_location           = $_POST['chamber_location'];
      $speciality                 = $_POST['speciality'];
      $appointment_date           = date("d-m-Y", strtotime($_POST['appointment_date']));
      $doctor_id                  = $_POST['doctor_id'];
      $doctor_id_1                = $_POST['doctor_id_1'];
      $message                    = $_POST['message'];

################################################SEARCHING BY SPECIALITY AND LOCATION###########################################################################
      if(isset($_POST['doctor_id']) && !empty($_POST['doctor_id']) && isset($_POST['appointment_date']) && !empty($_POST['appointment_date'])){
          ###################--APPOITNMENT TIME VALIDATION--################################################################
          if($appointment_date < $today){
            echo '<center style="color:#F44336">PLEASE CHOOSE A VALID DATE</center>';
          }else{
            $serial_slot = $conn->query("SELECT slot_serial FROM schedule WHERE doctor_id='$doctor_id' AND schedule_date='$appointment_date'")->fetchColumn();
            echo '<div class="box">';
            echo '<div class="box-body">';
            echo '<div id="serial_preview">';
            echo '<center><h4>APPOINTMENT SLOT</h4></center>';
            echo '<center><h5 style="color:red">'.$message.'</h5><hr></center>';
            //####################TIME SLOT##########################//
            if ( $serial_slot == 1) {
                $slots = $conn->query("SELECT session_1,session_2,session_3,avg_load_patient,avg_duration FROM schedule WHERE doctor_id ='$doctor_id' AND schedule_date ='$appointment_date'")->fetchAll(PDO::FETCH_ASSOC);
                foreach($slots as $slot){
                  $avg_duration = intval($slot['avg_duration']);
                  #########################--FIRST SESSION DATA--#################################################
                  $session_1            =   explode("-",$slot['session_1']);
                  $session_1_start      =   $session_1['0'];
                  $session_1_end        =   $session_1['1'];
                  $session_1_start_sec  =   strtotime("1970-01-01 $session_1_start UTC");
                  $session_1_end_sec    =   strtotime("1970-01-01 $session_1_end  UTC");
                  $session_1_ranges     =   hoursRange( $session_1_start_sec, $session_1_end_sec, 60 * $avg_duration, 'h:i a' );
                  $session_1_ranges     =   array_slice($session_1_ranges,0,-1);
                  #########################--2nd SESSION DATA--#################################################
                  $session_2            =   explode("-",$slot['session_2']);
                  $session_2_start      =   $session_2['0'];
                  $session_2_end        =   $session_2['1'];
                  $session_2_start_sec  =   strtotime("1970-01-01 $session_2_start UTC");
                  $session_2_end_sec    =   strtotime("1970-01-01 $session_2_end  UTC");
                  $session_2_ranges     =   hoursRange( $session_2_start_sec, $session_2_end_sec, 60 * $avg_duration, 'h:i a' );
                  $session_2_ranges     =   array_slice($session_2_ranges,0,-1);
                  #########################--3rd SESSION DATA--#################################################
                  $session_3            =   explode("-",$slot['session_3']);
                  $session_3_start      =   $session_3['0'];
                  $session_3_end        =   $session_3['1'];
                  $session_3_start_sec  =   strtotime("1970-01-01 $session_3_start UTC");
                  $session_3_end_sec    =   strtotime("1970-01-01 $session_3_end  UTC");
                  $session_3_ranges     =   hoursRange( $session_3_start_sec, $session_3_end_sec, 60 * $avg_duration,'h:i a' );
                  $session_3_ranges     =   array_slice($session_3_ranges,0,-1);
                  ############--TEMPORARY BOOKED SLOT--#######################
                  $temp_booked_slot     =   $conn->query("SELECT appointment_time  FROM appointment WHERE id=$id")->fetchAll(PDO::FETCH_ASSOC);
                  $temp_booked_slot     =   array_map('current', $temp_booked_slot);
                  ############--BOOKED SLOT--##################################
                  $booked_slot          =   $conn->query("SELECT appointment_time  FROM appointment WHERE doctor_id ='$doctor_id' AND appointment_date ='$appointment_date' AND id!=$id AND status=2")->fetchAll(PDO::FETCH_ASSOC);
                  $booked_slot          =   array_map('current', $booked_slot);
                  ############--PENDING SLOT--################################
                  $pending_slot         =   $conn->query("SELECT appointment_time  FROM appointment WHERE doctor_id ='$doctor_id' AND appointment_date ='$appointment_date' AND id!=$id AND status=1")->fetchAll(PDO::FETCH_ASSOC);
                  $pending_slot         =   array_map('current', $pending_slot);
                  ############--FIRST SESSION--###########################
                  echo  '<div class="form-group row">';
                  echo  '<p class="col-sm-3"><strong>1st Session:</strong></p>' ;
                  echo  '<div class="col-sm-9">';
                  ############--PULLING APPOINTMENT SLOTS--################
                  foreach ($session_1_ranges as $session_1_range){
                    echo '<div class="radio_test">';
                    if (in_array($session_1_range, $booked_slot)) {
                      $booked_slot_customer = $conn->query("SELECT customer_name  FROM appointment WHERE  appointment_date ='$appointment_date' AND appointment_time='$session_1_range'  AND id!=$id AND status=2")->fetchColumn();
                      $label_id =  str_replace(" ", "", $session_1_range);
                      echo '<input  type="radio"  name="appointment_time" id="'.$label_id.'" value="'.$session_1_range.''._1.'" class="radio_2" />';
                      echo '<label  onclick="return false;"  for="'.$label_id.'" data-toggle="tooltip" title="'.$booked_slot_customer.'">'.$session_1_range.'</label>';
                    }
                    elseif(in_array($session_1_range, $temp_booked_slot)){
                      $label_id =  str_replace(" ", "", $session_1_range);
                      echo '<input  type="radio"  name="appointment_time" id="'.$label_id.'" value="'.$session_1_range.''._1.'" class="radio_1" checked />';
                      echo '<label  onclick="return false;"  for="'.$label_id.'" data-toggle="tooltip" title="">'.$session_1_range.'</label>';
                    }
                    elseif (in_array($session_1_range, $pending_slot)) {
                      $label_id =  str_replace(" ", "", $session_1_range);
                      echo '<input  type="radio"  name="appointment_time" id="'.$label_id.'" value="'.$session_1_range.''._1.'" class="radio_3" />';
                      echo '<label  onclick="return false;"  for="'.$label_id.'" data-toggle="tooltip" title="">'.$session_1_range.'</label>';
                    }
                    else{
                      $label_id =  str_replace(" ", "", $session_1_range);
                      echo '<input type="radio" onclick="slot_booking()" name="appointment_time" id="'.$label_id.'" value="'.$session_1_range.''._1.'" class="radio_1" />';
                      echo '<label for="'.$label_id.'">'.$session_1_range.'</label>';
                    }
                    echo '</div>';
                  }
                  echo  '</div>';
                  echo  '</div><hr>';
                  ###############--SECOND SESSION--#####################
                  if($slot['session_2'] != "-"){
                    echo  '<div class="form-group row">';
                    echo  '<p class="col-sm-3"><strong>2nd Session:</strong></p>' ;
                    echo  '<div class="col-sm-9">';
                    foreach ($session_2_ranges as $session_2_range){
                      echo '<div class="radio_test">';
                      if (in_array($session_2_range, $booked_slot)) {
                        $booked_slot_customer = $conn->query("SELECT customer_name  FROM appointment WHERE  appointment_date ='$appointment_date' AND appointment_time='$session_2_range'  AND id!=$id AND status=2")->fetchColumn();
                        $label_id =  str_replace(" ", "", $session_2_range);
                        echo '<input  type="radio"  name="appointment_time" id="'.$label_id.'" value="'.$session_2_range.''._2.'" class="radio_2" />';
                        echo '<label  onclick="return false;"  for="'.$label_id.'" data-toggle="tooltip" title="'.$booked_slot_customer.'">'.$session_2_range.'</label>';
                      }
                      elseif(in_array($session_2_range, $temp_booked_slot)){
                        $label_id =  str_replace(" ", "", $session_2_range);
                        echo '<input  type="radio"  name="appointment_time" id="'.$label_id.'" value="'.$session_2_range.''._2.'" class="radio_1" checked />';
                        echo '<label  onclick="return false;"  for="'.$label_id.'" data-toggle="tooltip" title="">'.$session_2_range.'</label>';
                      }
                      elseif (in_array($session_2_range, $pending_slot)) {
                        $label_id =  str_replace(" ", "", $session_2_range);
                        echo '<input  type="radio"  name="appointment_time" id="'.$label_id.'" value="'.$session_2_range.''._2.'" class="radio_3" />';
                        echo '<label  onclick="return false;"  for="'.$label_id.'" data-toggle="tooltip" title="">'.$session_2_range.'</label>';
                      }
                      else{
                        $label_id =  str_replace(" ", "", $session_2_range);
                        echo '<input type="radio" onclick="slot_booking()" name="appointment_time" id="'.$label_id.'" value="'.$session_2_range.''._2.'" class="radio_1" />';
                        echo '<label for="'.$label_id.'">'.$session_2_range.'</label>';

                      }
                      echo '</div>';
                    }
                    echo  '</div>';
                    echo  '</div><hr>';
                  }
                    //################THIRD SESSION##########################################//
                    if($slot['session_3'] != "-"){
                      echo  '<div class="form-group row">';
                      echo  '<p class="col-sm-3"><strong>3rd Session:</strong></p>' ;
                      echo  '<div class="col-sm-9">';

                      foreach ($session_3_ranges as $session_3_range){
                          echo '<div class="radio_test">';
                          if (in_array($session_3_range, $booked_slot)) {
                            $booked_slot_customer = $conn->query("SELECT customer_name  FROM appointment WHERE  appointment_date ='$appointment_date' AND appointment_time='$session_3_range'  AND id!=$id AND status=2")->fetchColumn();
                            $label_id =  str_replace(" ", "", $session_3_range);
                            echo '<input  type="radio"  name="appointment_time" id="'.$label_id.'" value="'.$session_3_range.''._3.'" class="radio_2" />';
                            echo '<label  onclick="return false;"  for="'.$label_id.'" data-toggle="tooltip" title="'.$booked_slot_customer.'">'.$session_3_range.'</label>';
                          }
                          elseif(in_array($session_3_range, $temp_booked_slot)){
                            $label_id =  str_replace(" ", "", $session_3_range);
                            echo '<input  type="radio"  name="appointment_time" id="'.$label_id.'" value="'.$session_3_range.''._3.'" class="radio_1" checked />';
                            echo '<label  onclick="return false;"  for="'.$label_id.'" data-toggle="tooltip" title="">'.$session_3_range.'</label>';
                          }
                          elseif (in_array($session_3_range, $pending_slot)) {
                            $label_id =  str_replace(" ", "", $session_3_range);
                            echo '<input  type="radio"  name="appointment_time" id="'.$label_id.'" value="'.$session_3_range.''._3.'" class="radio_3" />';
                            echo '<label  onclick="return false;"  for="'.$label_id.'" data-toggle="tooltip" title="">'.$session_3_range.'</label>';
                          }
                          else{
                            $label_id =  str_replace(" ", "", $session_3_range);
                            echo '<input type="radio" onclick="slot_booking()" name="appointment_time" id="'.$label_id.'" value="'.$session_3_range.''._3.'" class="radio_1" />';
                            echo '<label for="'.$label_id.'">'.$session_3_range.'</label>';
                          }
                          echo '</div>';
                        }
                        echo  '</div>';
                        echo  '</div><hr>';
                      }

                      //####################EMERGENCY SESSION##############################//
                      if ($slot['session_1'] != "-" && $slot['session_2'] != "-" && $slot['session_3'] != "-"){ //end of session 3
                        $end_session_3_ranges =  date("h:i a", strtotime(end($session_3_ranges)));
                        $end_session_3_ranges = new DateTime($end_session_3_ranges);
                        $end_session_3_ranges->add(new DateInterval('PT1M'));
                        $end_session_3_ranges= $end_session_3_ranges->format('h:i a');
                        echo '<div class="form-group row">';
                        echo '<p for="" class="col-sm-3"><strong>Emergency</strong></label></p>';
                        echo '<div class="col-sm-4">';
                        $label_id =  str_replace(" ", "",$end_session_3_ranges);
                        echo '<div class="radio_test">';
                        echo '<input type="radio" onclick="emergency_slot()" name="appointment_time" id="'.$label_id.''._4.'" value="'.$end_session_3_ranges.''._4.'" class="radio_1 " />';
                        echo '<label for="'.$label_id.''._4.'">'.$end_session_3_ranges.'</label>';
                        echo '</div>';
                        echo  '</div>';
                        echo  '</div>';
                      }
                      if ($slot['session_1'] != "-" && $slot['session_2'] != "-" && $slot['session_3'] == "-"){   //end of session 2
                        $end_session_2_ranges =  date("h:i a", strtotime(end($session_2_ranges)));
                        $end_session_2_ranges = new DateTime($end_session_2_ranges);
                        $end_session_2_ranges->add(new DateInterval('PT1M'));
                        $end_session_2_ranges= $end_session_2_ranges->format('h:i a');
                        echo '<div class="form-group row">';
                        echo '<p for="" class="col-sm-3"><strong>Emergency</strong></label></p>';
                        echo '<div class="col-sm-4">';
                        $label_id =  str_replace(" ", "",$end_session_2_ranges);
                        echo '<div class="radio_test">';
                        echo '<input type="radio" onclick="emergency_slot()" name="appointment_time" id="'.$label_id.''._4.'" value="'.$end_session_2_ranges.''._4.'" class="radio_1 " />';
                        echo '<label for="'.$label_id.''._4.'">'.$end_session_2_ranges.'</label>';
                        echo '</div>';
                        echo  '</div>';
                        echo  '</div>';
                      }
                      if ($slot['session_1'] != "-" && $slot['session_2'] == "-" && $slot['session_3'] == "-"){ //end of session 1
                        $end_session_1_ranges =  date("h:i a", strtotime(end($session_1_ranges)));
                        $end_session_1_ranges = new DateTime($end_session_1_ranges);
                        $end_session_1_ranges->add(new DateInterval('PT1M'));
                        $end_session_1_ranges= $end_session_1_ranges->format('h:i a');
                        echo '<div class="form-group row">';
                        echo '<p class="col-sm-3"><strong>Emergency</strong></p>';
                        echo '<div class="col-sm-4">';
                        $label_id =  str_replace(" ", "",$end_session_1_ranges);
                        echo '<div class="radio_test">';
                        echo '<input type="radio" onclick="emergency_slot()" name="appointment_time" id="'.$label_id.''._4.'" value="'.$end_session_1_ranges.''._4.'" class="radio_1 " />';
                        echo '<label for="'.$label_id.''._4.'">'.$end_session_1_ranges.'</label>';
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                      }
                }
            }
            //####################SERIAL SLOT##########################//
            elseif ( $serial_slot == 2) {
                $slots = $conn->query("SELECT session_1,session_2,session_3,avg_load_patient,avg_duration FROM schedule WHERE doctor_id ='$doctor_id' AND schedule_date ='$appointment_date'")->fetchAll(PDO::FETCH_ASSOC);
                ############TEMPORARY BOOKES SLOT#######################
                $temp_booked_slot = $conn->query("SELECT serial  FROM appointment WHERE id=$id")->fetchAll(PDO::FETCH_ASSOC);
                $temp_booked_slot = array_map('current', $temp_booked_slot);
                ############SLOT BOOKED##################################
                $booked_slot = $conn->query("SELECT serial  FROM appointment WHERE doctor_id ='$doctor_id' AND appointment_date ='$appointment_date' AND id!=$id AND status=2")->fetchAll(PDO::FETCH_ASSOC);
                $booked_slot = array_map('current', $booked_slot);
                ############PENDING SLOT################################
                $pending_slot = $conn->query("SELECT serial  FROM appointment WHERE doctor_id ='$doctor_id' AND appointment_date ='$appointment_date' AND id!=$id AND status=1")->fetchAll(PDO::FETCH_ASSOC);
                $pending_slot = array_map('current', $pending_slot);
                #######################################################
                foreach($slots as $slot){
                $avg_load_patient = intval($slot['avg_load_patient']);
                //############FIRST SESSION###########################//
                echo  '<div class="form-group row">';
                echo  '<p class="col-sm-3"><strong>1st Session('.$slot['session_1'].'):</strong></p>' ;
                echo  '<div class="col-sm-9">';
                $session_1            =   explode("-",$slot['session_1']);
                $session_1_start      =   $session_1['0'];
                $session_1_end        =   $session_1['1'];
                $session_1_start_sec  =   strtotime("1970-01-01 $session_1_start UTC");
                $session_1_end_sec    =   strtotime("1970-01-01 $session_1_end  UTC");
                $session_1_ranges     =   hoursRange( $session_1_start_sec, $session_1_end_sec, 60 * $avg_load_patient, 'h:i a' );
                $session_1_ranges     =   array_slice($session_1_ranges,0,-1);

                for($i=1;$i<=$avg_load_patient;$i++){
                  echo '<div class="radio_test">';
                    if (in_array($i, $booked_slot)) {
                      echo '<input  type="radio"  name="appointment_time" id="'.$i.'" value="'.$i.''._1.'" class="radio_2" />';
                      echo '<label  onclick="return false;"  for="'.$i.'" data-toggle="tooltip" title="">'.$i.'</label>';
                    }
                    elseif(in_array($i, $temp_booked_slot)){
                      echo '<input  type="radio"  name="appointment_time" id="'.$i.'" value="'.$i.''._1.'" class="radio_1" checked />';
                      echo '<label  onclick="return false;"  for="'.$label_id.'" data-toggle="tooltip" title="">'.$i.'</label>';
                    }
                    elseif (in_array($i, $pending_slot)) {
                      echo '<input  type="radio"  name="appointment_time" id="'.$i.'" value="'.$i.''._1.'" class="radio_3" />';
                      echo '<label  onclick="return false;"  for="'.$i.'" data-toggle="tooltip" title="">'.$i.'</label>';
                    }
                    else{
                      echo '<input type="radio" onclick="serial_booking()" name="appointment_time" id="'.$i.'" value="'.$i.''._1.'" class="radio_1" />';
                      echo '<label for="'.$i.'">'.$i.'</label>';
                    }
                  echo  '</div>';
                  $second = $i;
                  $emergency = $i+1;
                }
                echo  '</div>';
                echo  '</div><hr>';
                //###############SECOND SESSION#####################//
                if($slot['session_2'] != "-"){
                  echo  '<div class="form-group row">';
                  echo  '<p class="col-sm-3"><strong>2nd Session('.$slot['session_2'].'):</strong></p>' ;
                  echo  '<div class="col-sm-9">';
                  $session_2           = explode("-",$slot['session_2']);
                  $session_2_start      =   $session_2['0'];
                  $session_2_end        =   $session_2['1'];
                  $session_2_start_sec  =   strtotime("1970-01-01 $session_2_start UTC");
                  $session_2_end_sec    =   strtotime("1970-01-01 $session_2_end  UTC");
                  $session_2_ranges = hoursRange( $session_2_start_sec, $session_2_end_sec, 60*$avg_load_patient, 'h:i a' );
                  $session_2_ranges = array_slice($session_2_ranges,0,-1);

                  for($i=$second+1;$i<=$avg_load_patient+$second;$i++){
                    echo '<div class="radio_test">';
                      if (in_array($i, $booked_slot)) {
                        echo '<input  type="radio"  name="appointment_time" id="'.$i.'" value="'.$i.''._2.'" class="radio_2" />';
                        echo '<label  onclick="return false;"  for="'.$i.'" data-toggle="tooltip" title="">'.$i.'</label>';
                      }
                      elseif(in_array($i, $temp_booked_slot)){
                        echo '<input  type="radio"  name="appointment_time" id="'.$i.'" value="'.$i.''._2.'" class="radio_1" checked />';
                        echo '<label  onclick="return false;"  for="'.$label_id.'" data-toggle="tooltip" title="">'.$i.'</label>';
                      }
                      elseif (in_array($i, $pending_slot)) {
                        echo '<input  type="radio"  name="appointment_time" id="'.$i.'" value="'.$i.''._2.'" class="radio_3" />';
                        echo '<label  onclick="return false;"  for="'.$i.'" data-toggle="tooltip" title="">'.$i.'</label>';
                      }
                      else{
                        echo '<input type="radio" onclick="serial_booking()" name="appointment_time" id="'.$i.'" value="'.$i.''._2.'" class="radio_1" />';
                        echo '<label for="'.$i.'">'.$i.'</label>';
                      }
                    echo  '</div>';
                    $third = $i;
                    $emergency = $i+1;
                  }

                  echo  '</div>';
                  echo  '</div><hr>';
                }
                  //################THIRD SESSION##########################################//
                if($slot['session_3'] != "-"){
                    echo  '<div class="form-group row">';
                    echo  '<p class="col-sm-3"><strong>3rd Session('.$slot['session_3'].'):</strong></p>' ;
                    echo  '<div class="col-sm-9">';
                    $session_3            =   explode("-",$slot['session_3']);
                    $session_3_start      =   $session_3['0'];
                    $session_3_end        =   $session_3['1'];
                    $session_3_start_sec  =   strtotime("1970-01-01 $session_3_start UTC");
                    $session_3_end_sec    =   strtotime("1970-01-01 $session_3_end  UTC");
                    $session_3_ranges     =   hoursRange( $session_3_start_sec, $session_3_end_sec, 60 * $avg_load_patient,'h:i a' );
                    $session_3_ranges     =   array_slice($session_3_ranges,0,-1);

                    for($i=$third+1;$i<=$avg_load_patient+$third;$i++){
                      echo '<div class="radio_test">';
                        if (in_array($i, $booked_slot)) {
                          echo '<input  type="radio"  name="appointment_time" id="'.$i.'" value="'.$i.''._3.'" class="radio_2" />';
                          echo '<label  onclick="return false;"  for="'.$i.'" data-toggle="tooltip" title="">'.$i.'</label>';
                        }
                        elseif(in_array($i, $temp_booked_slot)){
                          echo '<input  type="radio"  name="appointment_time" id="'.$i.'" value="'.$i.''._3.'" class="radio_1" checked />';
                          echo '<label  onclick="return false;"  for="'.$label_id.'" data-toggle="tooltip" title="">'.$i.'</label>';
                        }
                        elseif (in_array($i, $pending_slot)) {
                          echo '<input  type="radio"  name="appointment_time" id="'.$i.'" value="'.$i.''._3.'" class="radio_3" />';
                          echo '<label  onclick="return false;"  for="'.$i.'" data-toggle="tooltip" title="">'.$i.'</label>';
                        }
                        else{
                          echo '<input type="radio" onclick="serial_booking()" name="appointment_time" id="'.$i.'" value="'.$i.''._3.'" class="radio_1" />';
                          echo '<label for="'.$i.'">'.$i.'</label>';
                        }
                      echo  '</div>';
                      $emergency = $i+1;
                    }
                      echo  '</div>';
                      echo  '</div><hr>';
                    }
                    //####################EMERGENCY SESSION##############################//
                    if ($slot['session_1'] != "-" && $slot['session_2'] != "-" && $slot['session_3'] != "-"){ //end of session 3
                      echo '<div class="form-group row">';
                      echo '<p for="" class="col-sm-3"><strong>Emergency</strong></label></p>';
                      echo '<div class="col-sm-4">';
                      echo '<div class="radio_test">';
                      echo '<input type="radio" onclick="emergency_serial()" name="appointment_time" id="'.$emergency.'" value="'.$emergency.''._4.'" class="radio_1" />';
                      echo '<label for="'.$emergency.'">'.$emergency.'</label>';
                      echo '</div>';
                      echo  '</div>';
                      echo  '</div>';
                    }
                    if ($slot['session_1'] != "-" && $slot['session_2'] != "-" && $slot['session_3'] == "-"){ //end of session 2
                      echo '<div class="form-group row">';
                      echo '<p for="" class="col-sm-3"><strong>Emergency</strong></label></p>';
                      echo '<div class="col-sm-4">';
                      $label_id =  str_replace(" ", "", end($session_2_ranges));
                      echo '<div class="radio_test">';
                      echo '<input type="radio" onclick="emergency_serial()" name="appointment_time" id="'.$emergency.'" value="'.$emergency.''._4.'" class="radio_1" />';
                      echo '<label for="'.$emergency.'">'.$emergency.'</label>';
                      echo '</div>';
                      echo  '</div>';
                      echo  '</div>';
                    }
                    if ($slot['session_1'] != "-" && $slot['session_2'] == "-" && $slot['session_3'] == "-"){ //end of session one
                      echo '<div class="form-group row">';
                      echo '<p class="col-sm-3"><strong>Emergency</strong></p>';
                      echo '<div class="col-sm-4">';
                      $label_id =  str_replace(" ", "", end($session_1_ranges));
                      echo '<div class="radio_test">';
                      echo '<input type="radio" onclick="emergency_serial()" name="appointment_time" id="'.$emergency.'" value="'.$emergency.''._4.'" class="radio_1" />';
                      echo '<label for="'.$emergency.'">'.$emergency.'</label>';
                      echo '</div>';
                      echo '</div>';
                      echo '</div>';
                    }

                  }
              }
              else{
                echo '<center style="color:#F44336">No Schedule Found</center>';
              }
            echo '</div>';
            echo '</div>';
            echo '</div>';
          }
        }



################################################SEARCHING BY DOCTOR NAME###########################################################################
      if(isset($_POST['doctor_id_1']) && !empty($_POST['doctor_id_1']) && isset($_POST['appointment_date']) && !empty($_POST['appointment_date'])){
        // APPOITNMENT TIME VALIDATION
        $today = date("d-m-Y");
        if($appointment_date < $today){
          echo '<center style="color:#F44336">PLEASE CHOOSE A VALID DATE</center>';
        }else{
          $serial_slot = $conn->query("SELECT slot_serial FROM schedule WHERE doctor_id='$doctor_id_1' AND schedule_date='$appointment_date'")->fetchColumn();
          echo '<div class="box">';
          echo '<div class="box-body">';
          echo '<div id="serial_preview">';
          echo '<center><h4>APPOINTMENT SLOT</h4></center>';
          echo '<center><h5 style="color:red">'.$message.'</h5><hr></center>';
          //TIME SLOT
            if ( $serial_slot == 1) {
              $slots = $conn->query("SELECT session_1,session_2,session_3,avg_load_patient,avg_duration FROM schedule WHERE doctor_id ='$doctor_id_1' AND schedule_date ='$appointment_date'")->fetchAll(PDO::FETCH_ASSOC);
              foreach($slots as $slot){
                $avg_duration = intval($slot['avg_duration']);
                #########################FIRST SESSION DATA#################################################
                $session_1            =   explode("-",$slot['session_1']);
                $session_1_start      =   $session_1['0'];
                $session_1_end        =   $session_1['1'];
                $session_1_start_sec  =   strtotime("1970-01-01 $session_1_start UTC");
                $session_1_end_sec    =   strtotime("1970-01-01 $session_1_end  UTC");
                $session_1_ranges     =   hoursRange( $session_1_start_sec, $session_1_end_sec, 60 * $avg_duration, 'h:i a' );
                $session_1_ranges     =   array_slice($session_1_ranges,0,-1);
                #########################2nd SESSION DATA#################################################
                $session_2            =   explode("-",$slot['session_2']);
                $session_2_start      =   $session_2['0'];
                $session_2_end        =   $session_2['1'];
                $session_2_start_sec  =   strtotime("1970-01-01 $session_2_start UTC");
                $session_2_end_sec    =   strtotime("1970-01-01 $session_2_end  UTC");
                $session_2_ranges     =   hoursRange( $session_2_start_sec, $session_2_end_sec, 60 *$avg_duration, 'h:i a' );
                $session_2_ranges     =   array_slice($session_2_ranges,0,-1);
                #########################3rd SESSION DATA#################################################
                $session_3            =   explode("-",$slot['session_3']);
                $session_3_start      =   $session_3['0'];
                $session_3_end        =   $session_3['1'];
                $session_3_start_sec  =   strtotime("1970-01-01 $session_3_start UTC");
                $session_3_end_sec    =   strtotime("1970-01-01 $session_3_end  UTC");
                $session_3_ranges     =   hoursRange( $session_3_start_sec, $session_3_end_sec, 60 * $avg_duration, 'h:i a' );
                $session_3_ranges     =   array_slice($session_3_ranges,0,-1);
                ############TEMPORARY BOOKES SLOT#######################
                $temp_booked_slot     =   $conn->query("SELECT appointment_time  FROM appointment WHERE id=$id")->fetchAll(PDO::FETCH_ASSOC);
                $temp_booked_slot     =   array_map('current', $temp_booked_slot);
                ############SLOT BOOKED##################################
                $booked_slot          =   $conn->query("SELECT appointment_time  FROM appointment WHERE doctor_id ='$doctor_id_1' AND appointment_date ='$appointment_date' AND id!=$id AND status=2")->fetchAll(PDO::FETCH_ASSOC);
                $booked_slot          =   array_map('current', $booked_slot);
                ############PENDING SLOT################################
                $pending_slot         =   $conn->query("SELECT appointment_time  FROM appointment WHERE doctor_id ='$doctor_id_1' AND appointment_date ='$appointment_date' AND id!=$id AND status=1")->fetchAll(PDO::FETCH_ASSOC);
                $pending_slot         =   array_map('current', $pending_slot);
                ########################################################


                //############FIRST SESSION###########################//
                echo  '<div class="form-group row">';
                echo  '<p class="col-sm-3"><strong>1st Session:</strong></p>' ;
                echo  '<div class="col-sm-9">';
                //########PULLING APPOINTMENT SLOTS#################//
                foreach ($session_1_ranges as $session_1_range){
                  echo '<div class="radio_test">';
                    if (in_array($session_1_range, $booked_slot)) {
                      $label_id =  str_replace(" ", "", $session_1_range);
                      echo '<input  type="radio"  name="appointment_time" id="'.$label_id.'" value="'.$session_1_range.''._1.'" class="radio_2" />';
                      echo '<label  onclick="return false;"  for="'.$label_id.'" data-toggle="tooltip" title="">'.$session_1_range.'</label>';
                    }
                    elseif(in_array($session_1_range, $temp_booked_slot)){
                      $label_id =  str_replace(" ", "", $session_1_range);
                      echo '<input  type="radio"  name="appointment_time" id="'.$label_id.'" value="'.$session_1_range.''._1.'" class="radio_1" checked />';
                      echo '<label  onclick="return false;"  for="'.$label_id.'" data-toggle="tooltip" title="">'.$session_1_range.'</label>';
                    }
                    elseif (in_array($session_1_range, $pending_slot)) {
                      $label_id =  str_replace(" ", "", $session_1_range);
                      echo '<input  type="radio"  name="appointment_time" id="'.$label_id.'" value="'.$session_1_range.''._1.'" class="radio_3" />';
                      echo '<label  onclick="return false;"  for="'.$label_id.'" data-toggle="tooltip" title="">'.$session_1_range.'</label>';
                    }
                    else{
                      $label_id =  str_replace(" ", "", $session_1_range);
                      echo '<input type="radio" onclick="slot_booking()" name="appointment_time" id="'.$label_id.'" value="'.$session_1_range.''._1.'" class="radio_1" />';
                      echo '<label for="'.$label_id.'">'.$session_1_range.'</label>';
                    }
                  echo '</div>';
                }
                echo  '</div>';
                echo  '</div><hr>';
                // SECOND SESSION
                if($slot['session_2'] != "-"){
                  echo  '<div class="form-group row">';
                  echo  '<p class="col-sm-3"><strong>2nd Session:</strong></p>' ;
                  echo  '<div class="col-sm-9">';


                  foreach ($session_2_ranges as $session_2_range){
                    echo '<div class="radio_test">';
                      if (in_array($session_2_range, $booked_slot)) {
                        $label_id =  str_replace(" ", "", $session_2_range);
                        echo '<input  type="radio"  name="appointment_time" id="'.$label_id.'" value="'.$session_2_range.''._2.'" class="radio_2" />';
                        echo '<label  onclick="return false;"  for="'.$label_id.'" data-toggle="tooltip" title="">'.$session_2_range.'</label>';
                      }
                      elseif(in_array($session_2_range, $temp_booked_slot)){
                        $label_id =  str_replace(" ", "", $session_2_range);
                        echo '<input  type="radio"  name="appointment_time" id="'.$label_id.'" value="'.$session_2_range.''._2.'" class="radio_1" checked />';
                        echo '<label  onclick="return false;"  for="'.$label_id.'" data-toggle="tooltip" title="">'.$session_2_range.'</label>';
                      }
                      elseif (in_array($session_2_range, $pending_slot)) {
                        $label_id =  str_replace(" ", "", $session_2_range);
                        echo '<input  type="radio"  name="appointment_time" id="'.$label_id.'" value="'.$session_2_range.''._2.'" class="radio_3" />';
                        echo '<label  onclick="return false;"  for="'.$label_id.'" data-toggle="tooltip" title="">'.$session_2_range.'</label>';
                      }
                      else{
                        $label_id =  str_replace(" ", "", $session_2_range);
                        echo '<input type="radio" onclick="slot_booking()" name="appointment_time" id="'.$label_id.'" value="'.$session_2_range.''._2.'" class="radio_1" />';
                        echo '<label for="'.$label_id.'">'.$session_2_range.'</label>';

                      }
                      echo '</div>';
                    }

                  echo  '</div>';
                  echo  '</div><hr>';
                }


               // THIRD SESSION
                if($slot['session_3'] != "-"){
                  echo  '<div class="form-group row">';
                  echo  '<p class="col-sm-3"><strong>3rd Session:</strong></p>' ;
                  echo  '<div class="col-sm-9">';
                  foreach ($session_3_ranges as $session_3_range){
                    echo '<div class="radio_test">';
                       if (in_array($session_3_range, $booked_slot)) {
                         $label_id =  str_replace(" ", "", $session_3_range);
                         echo '<input  type="radio"  name="appointment_time" id="'.$label_id.'" value="'.$session_3_range.''._3.'" class="radio_2" />';
                         echo '<label  onclick="return false;"  for="'.$label_id.'" data-toggle="tooltip" title="">'.$session_3_range.'</label>';
                       }
                       elseif(in_array($session_3_range, $temp_booked_slot)){
                         $label_id =  str_replace(" ", "", $session_3_range);
                         echo '<input  type="radio"  name="appointment_time" id="'.$label_id.'" value="'.$session_3_range.''._3.'" class="radio_1" checked />';
                         echo '<label  onclick="return false;"  for="'.$label_id.'" data-toggle="tooltip" title="">'.$session_3_range.'</label>';
                       }
                       elseif (in_array($session_3_range, $pending_slot)) {
                         $label_id =  str_replace(" ", "", $session_3_range);
                         echo '<input  type="radio"  name="appointment_time" id="'.$label_id.'" value="'.$session_3_range.''._3.'" class="radio_3" />';
                         echo '<label  onclick="return false;"  for="'.$label_id.'" data-toggle="tooltip" title="">'.$session_3_range.'</label>';
                       }
                       else{
                         $label_id =  str_replace(" ", "", $session_3_range);
                         echo '<input type="radio" onclick="slot_booking()" name="appointment_time" id="'.$label_id.'" value="'.$session_3_range.''._3.'" class="radio_1" />';
                         echo '<label for="'.$label_id.'">'.$session_3_range.'</label>';

                       }
                    echo '</div>';
                   }
                   echo  '</div>';
                   echo  '</div><hr>';
                }
                  //####################EMERGENCY SESSION##############################//
                  if ($slot['session_1'] != "-" && $slot['session_2'] != "-" && $slot['session_3'] != "-"){ //end of session 3
                    $end_session_3_ranges =  date("h:i a", strtotime(end($session_3_ranges)));
                    $end_session_3_ranges = new DateTime($end_session_3_ranges);
                    $end_session_3_ranges->add(new DateInterval('PT1M'));
                    $end_session_3_ranges= $end_session_3_ranges->format('h:i a');
                    echo '<div class="form-group row">';
                    echo '<p for="" class="col-sm-3"><strong>Emergency</strong></label></p>';
                    echo '<div class="col-sm-4">';
                    $label_id =  str_replace(" ", "",$end_session_3_ranges);
                    echo '<div class="radio_test">';
                    echo '<input type="radio" onclick="emergency_slot()" name="appointment_time" id="'.$label_id.''._4.'" value="'.$end_session_3_ranges.''._4.'" class="radio_1 " />';
                    echo '<label for="'.$label_id.''._4.'">'.$end_session_3_ranges.'</label>';
                    echo '</div>';
                    echo  '</div>';
                    echo  '</div>';
                  }
                  if ($slot['session_1'] != "-" && $slot['session_2'] != "-" && $slot['session_3'] == "-"){   //end of session 2
                    $end_session_2_ranges =  date("h:i a", strtotime(end($session_2_ranges)));
                    $end_session_2_ranges = new DateTime($end_session_2_ranges);
                    $end_session_2_ranges->add(new DateInterval('PT1M'));
                    $end_session_2_ranges= $end_session_2_ranges->format('h:i a');
                    echo '<div class="form-group row">';
                    echo '<p for="" class="col-sm-3"><strong>Emergency</strong></label></p>';
                    echo '<div class="col-sm-4">';
                    $label_id =  str_replace(" ", "",$end_session_2_ranges);
                    echo '<div class="radio_test">';
                    echo '<input type="radio" onclick="emergency_slot()" name="appointment_time" id="'.$label_id.''._4.'" value="'.$end_session_2_ranges.''._4.'" class="radio_1 " />';
                    echo '<label for="'.$label_id.''._4.'">'.$end_session_2_ranges.'</label>';
                    echo '</div>';
                    echo  '</div>';
                    echo  '</div>';
                  }
                  if ($slot['session_1'] != "-" && $slot['session_2'] == "-" && $slot['session_3'] == "-"){ //end of session 1
                    $end_session_1_ranges =  date("h:i a", strtotime(end($session_1_ranges)));
                    $end_session_1_ranges = new DateTime($end_session_1_ranges);
                    $end_session_1_ranges->add(new DateInterval('PT1M'));
                    $end_session_1_ranges= $end_session_1_ranges->format('h:i a');
                    echo '<div class="form-group row">';
                    echo '<p class="col-sm-3"><strong>Emergency</strong></p>';
                    echo '<div class="col-sm-4">';
                    $label_id =  str_replace(" ", "",$end_session_1_ranges);
                    echo '<div class="radio_test">';
                    echo '<input type="radio" onclick="emergency_slot()" name="appointment_time" id="'.$label_id.''._4.'" value="'.$end_session_1_ranges.''._4.'" class="radio_1 " />';
                    echo '<label for="'.$label_id.''._4.'">'.$end_session_1_ranges.'</label>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                  }
                }
            }
            //SERIAL SLOT
            elseif ( $serial_slot == 2) {
                $slots = $conn->query("SELECT session_1,session_2,session_3,avg_load_patient,avg_duration FROM schedule WHERE doctor_id ='$doctor_id_1' AND schedule_date ='$appointment_date'")->fetchAll(PDO::FETCH_ASSOC);
                ############TEMPORARY BOOKES SLOT#######################
                $temp_booked_slot = $conn->query("SELECT serial  FROM appointment WHERE id=$id")->fetchAll(PDO::FETCH_ASSOC);
                $temp_booked_slot = array_map('current', $temp_booked_slot);

                ############SLOT BOOKED##################################
                $booked_slot = $conn->query("SELECT serial  FROM appointment WHERE doctor_id ='$doctor_id_1' AND appointment_date ='$appointment_date' AND id!=$id AND status=2")->fetchAll(PDO::FETCH_ASSOC);
                $booked_slot = array_map('current', $booked_slot);
                ############PENDING SLOT################################
                $pending_slot = $conn->query("SELECT serial  FROM appointment WHERE doctor_id ='$doctor_id_1' AND appointment_date ='$appointment_date' AND id!=$id AND status=1")->fetchAll(PDO::FETCH_ASSOC);
                $pending_slot = array_map('current', $pending_slot);
                #######################################################
                foreach($slots as $slot){
                $avg_load_patient = intval($slot['avg_load_patient']);
                //############FIRST SESSION###########################//
                echo  '<div class="form-group row">';
                echo  '<p class="col-sm-3"><strong>1st Session:</strong></p>' ;
                echo  '<div class="col-sm-9">';
                $session_1            = explode("-",$slot['session_1']);
                $session_1_start      =   $session_1['0'];
                $session_1_end        =   $session_1['1'];
                $session_1_start_sec  =   strtotime("1970-01-01 $session_1_start UTC");
                $session_1_end_sec    =   strtotime("1970-01-01 $session_1_end  UTC");
                $session_1_ranges     = hoursRange( $session_1_start_sec, $session_1_end_sec, 60 * $avg_load_patient, 'h:i a' );
                $session_1_ranges     = array_slice($session_1_ranges,0,-1);
                for($i=1;$i<=$avg_load_patient;$i++){
                  echo '<div class="radio_test">';
                    if (in_array($i, $booked_slot)) {
                      echo '<input  type="radio"  name="appointment_time" id="'.$i.'" value="'.$i.''._1.'" class="radio_2" />';
                      echo '<label  onclick="return false;"  for="'.$i.'" data-toggle="tooltip" title="">'.$i.'</label>';
                    }
                    elseif(in_array($i, $temp_booked_slot)){
                      echo '<input  type="radio"  name="appointment_time" id="'.$i.'" value="'.$i.''._1.'" class="radio_1" checked />';
                      echo '<label  onclick="return false;"  for="'.$label_id.'" data-toggle="tooltip" title="">'.$i.'</label>';
                    }
                    elseif (in_array($i, $pending_slot)) {
                      echo '<input  type="radio"  name="appointment_time" id="'.$i.'" value="'.$i.''._1.'" class="radio_3" />';
                      echo '<label  onclick="return false;"  for="'.$i.'" data-toggle="tooltip" title="">'.$i.'</label>';
                    }
                    else{
                      echo '<input type="radio" onclick="serial_booking()" name="appointment_time" id="'.$i.'" value="'.$i.''._1.'" class="radio_1" />';
                      echo '<label for="'.$i.'">'.$i.'</label>';
                    }
                  echo  '</div>';
                  $second = $i;
                  $emergency = $i+1;
                }

                echo  '</div>';
                echo  '</div><hr>';
                //###############SECOND SESSION#####################//
                if($slot['session_2'] != "-"){
                  echo  '<div class="form-group row">';
                  echo  '<p class="col-sm-3"><strong>2nd Session:</strong></p>' ;
                  echo  '<div class="col-sm-9">';
                  $session_2           = explode("-",$slot['session_2']);
                  $session_2_start      =   $session_2['0'];
                  $session_2_end        =   $session_2['1'];
                  $session_2_start_sec  =   strtotime("1970-01-01 $session_2_start UTC");
                  $session_2_end_sec    =   strtotime("1970-01-01 $session_2_end  UTC");
                  $session_2_ranges = hoursRange( $session_2_start_sec, $session_2_end_sec, 60*$avg_load_patient, 'h:i a' );
                  $session_2_ranges = array_slice($session_2_ranges,0,-1);

                  for($i=$second+1;$i<=$avg_load_patient+$second;$i++){
                    echo '<div class="radio_test">';
                      if (in_array($i, $booked_slot)) {
                        echo '<input  type="radio"  name="appointment_time" id="'.$i.'" value="'.$i.''._2.'" class="radio_2" />';
                        echo '<label  onclick="return false;"  for="'.$i.'" data-toggle="tooltip" title="">'.$i.'</label>';
                      }
                      elseif(in_array($i, $temp_booked_slot)){
                        echo '<input  type="radio"  name="appointment_time" id="'.$i.'" value="'.$i.''._2.'" class="radio_1" checked />';
                        echo '<label  onclick="return false;"  for="'.$label_id.'" data-toggle="tooltip" title="">'.$i.'</label>';
                      }
                      elseif (in_array($i, $pending_slot)) {
                        echo '<input  type="radio"  name="appointment_time" id="'.$i.'" value="'.$i.''._2.'" class="radio_3" />';
                        echo '<label  onclick="return false;"  for="'.$i.'" data-toggle="tooltip" title="">'.$i.'</label>';
                      }
                      else{
                        echo '<input type="radio" onclick="serial_booking()" name="appointment_time" id="'.$i.'" value="'.$i.''._2.'" class="radio_1" />';
                        echo '<label for="'.$i.'">'.$i.'</label>';
                      }
                    echo  '</div>';
                    $third = $i;
                    $emergency = $i+1;
                  }

                  echo  '</div>';
                  echo  '</div><hr>';
                }
                  //################THIRD SESSION##########################################//
                if($slot['session_3'] != "-"){
                    echo  '<div class="form-group row">';
                    echo  '<p class="col-sm-3"><strong>3rd Session:</strong></p>' ;
                    echo  '<div class="col-sm-9">';
                    $session_3           = explode("-",$slot['session_3']);
                    $session_3_start      =   $session_3['0'];
                    $session_3_end        =   $session_3['1'];
                    $session_3_start_sec  =   strtotime("1970-01-01 $session_3_start UTC");
                    $session_3_end_sec    =   strtotime("1970-01-01 $session_3_end  UTC");
                    $session_3_ranges = hoursRange( $session_3_start_sec, $session_3_end_sec, 60 * $avg_load_patient,'h:i a' );
                    $session_3_ranges = array_slice($session_3_ranges,0,-1);

                    for($i=$third+1;$i<=$avg_load_patient+$third;$i++){
                      echo '<div class="radio_test">';
                        if (in_array($i, $booked_slot)) {
                          echo '<input  type="radio"  name="appointment_time" id="'.$i.'" value="'.$i.''._3.'" class="radio_2" />';
                          echo '<label  onclick="return false;"  for="'.$i.'" data-toggle="tooltip" title="">'.$i.'</label>';
                        }
                        elseif(in_array($i, $temp_booked_slot)){
                          echo '<input  type="radio"  name="appointment_time" id="'.$i.'" value="'.$i.''._3.'" class="radio_1" checked />';
                          echo '<label  onclick="return false;"  for="'.$label_id.'" data-toggle="tooltip" title="">'.$i.'</label>';
                        }
                        elseif (in_array($i, $pending_slot)) {
                          echo '<input  type="radio"  name="appointment_time" id="'.$i.'" value="'.$i.''._3.'" class="radio_3" />';
                          echo '<label  onclick="return false;"  for="'.$i.'" data-toggle="tooltip" title="">'.$i.'</label>';
                        }
                        else{
                          echo '<input type="radio" onclick="serial_booking()" name="appointment_time" id="'.$i.'" value="'.$i.''._3.'" class="radio_1" />';
                          echo '<label for="'.$i.'">'.$i.'</label>';
                        }
                      echo  '</div>';
                      $emergency = $i+1;
                    }
                      echo  '</div>';
                      echo  '</div><hr>';
                    }
                    //####################EMERGENCY SESSION##############################//
                    if ($slot['session_1'] != "-" && $slot['session_2'] != "-" && $slot['session_3'] != "-"){ //end of session 3
                      echo '<div class="form-group row">';
                      echo '<p for="" class="col-sm-3"><strong>Emergency</strong></label></p>';
                      echo '<div class="col-sm-4">';
                        echo '<div class="radio_test">';
                        echo '<input type="radio" onclick="emergency_serial()" name="appointment_time" id="'.$emergency.'" value="'.$emergency.''._4.'" class="radio_1" />';
                        echo '<label for="'.$emergency.'">'.$emergency.'</label>';
                        echo '</div>';
                      echo  '</div>';
                      echo  '</div>';
                    }
                    if ($slot['session_1'] != "-" && $slot['session_2'] != "-" && $slot['session_3'] == "-"){ //end of session 2
                      echo '<div class="form-group row">';
                      echo '<p for="" class="col-sm-3"><strong>Emergency</strong></label></p>';
                      echo '<div class="col-sm-4">';
                      $label_id =  str_replace(" ", "", end($session_2_ranges));
                      echo '<div class="radio_test">';
                      echo '<input type="radio" onclick="emergency_serial()" name="appointment_time" id="'.$emergency.'" value="'.$emergency.''._4.'" class="radio_1" />';
                      echo '<label for="'.$emergency.'">'.$emergency.'</label>';
                      echo '</div>';
                      echo  '</div>';
                      echo  '</div>';
                    }
                    if ($slot['session_1'] != "-" && $slot['session_2'] == "-" && $slot['session_3'] == "-"){ //end of session one
                      echo '<div class="form-group row">';
                      echo '<p class="col-sm-3"><strong>Emergency</strong></p>';
                      echo '<div class="col-sm-4">';
                      $label_id =  str_replace(" ", "", end($session_1_ranges));
                      echo '<div class="radio_test">';
                      echo '<input type="radio" onclick="emergency_serial()" name="appointment_time" id="'.$emergency.'" value="'.$emergency.''._4.'" class="radio_1" />';
                      echo '<label for="'.$emergency.'">'.$emergency.'</label>';
                      echo '</div>';
                      echo '</div>';
                      echo '</div>';
                    }

                  }
              }
            else{
              echo '<center style="color:#F44336">No Schedule Found</center>';
            }
          echo '</div>';
          echo '</div>';
          echo '</div>';
        }
      }
?>
