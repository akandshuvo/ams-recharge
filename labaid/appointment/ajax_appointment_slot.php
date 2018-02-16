<?php
    session_start(); //starting the login session
    date_default_timezone_set('Asia/Dhaka');
    if($_SESSION['is_login'] != 1){
        header("location:/labaid/index.php"); // if user is not logged in,this will redirect user to the login page
    }
    include ('../dbconfig.php');
    include ('../function/function.php');

    /*check if the slot is booked or not*/

    $doctor_id                  = $_POST['doctor_id'] ;
    $doctor_id_1                = $_POST['doctor_id_1'] ;
    $appointment_date           = date("d-m-Y", strtotime($_POST['appointment_date']));
    $appointment_serial         = $_POST['appointment_serial']; // NULL DATA WILL BE UPDATED
    $appointment_slot           = $_POST['appointment_slot'];
    $appointment_slot_explode   = explode('_',$_POST['appointment_slot']);
    $appointment_slot           = $appointment_slot_explode[0];
    $session                    = $appointment_slot_explode[1];
    $id                         = $_POST['id'];

    if($doctor_id != NULL){
      if($session == 4){
        $booked_slot = $conn->query("SELECT id  FROM appointment WHERE doctor_id ='$doctor_id' AND appointment_date ='$appointment_date' AND appointment_time != '$appointment_slot' AND id!=$id ")->rowCount();
      }else{
        $booked_slot = $conn->query("SELECT id  FROM appointment WHERE doctor_id ='$doctor_id' AND appointment_date ='$appointment_date' AND appointment_time='$appointment_slot' AND id!=$id")->rowCount();
      }

      if($booked_slot == 1){
        echo 0;
      }else{
        $prebook =  $conn->prepare("
                    UPDATE appointment SET appointment_time = :appointment_time,serial = :appointment_serial,appointment_date = :appointment_date,session=:session,status=:status WHERE id=:id
        ");
        $prebook->bindValue(':id',$id);
        $prebook->bindValue(':appointment_time',$appointment_slot);
        $prebook->bindValue(':appointment_date',$appointment_date);
        $prebook->bindValue(':appointment_serial',$appointment_serial); // NULL DATA WILL BE UPDATED
        $prebook->bindValue(':session',$session);
        $prebook->bindValue(':status',1);
        $prebook->execute();
        echo 1;
      }
    }

    if($doctor_id_1 != NULL){
      if($session == 4){
        $booked_slot = $conn->query("SELECT id  FROM appointment WHERE doctor_id ='$doctor_id_1' AND appointment_date ='$appointment_date' AND appointment_time != '$appointment_slot' AND id!=$id ")->rowCount();
      }else{
          $booked_slot = $conn->query("SELECT id  FROM appointment WHERE doctor_id ='$doctor_id_1' AND appointment_date ='$appointment_date' AND appointment_time='$appointment_slot' AND id!=$id")->rowCount();
      }
      if($booked_slot == 1){
        echo 0;
      }else{
        $prebook =  $conn->prepare("
                    UPDATE appointment SET appointment_time = :appointment_time,serial = :appointment_serial,appointment_date = :appointment_date,session=:session,status=:status WHERE id=:id
        ");
        $prebook->bindValue(':id',$id);
        $prebook->bindValue(':appointment_time',$appointment_slot);
        $prebook->bindValue(':appointment_date',$appointment_date);
        $prebook->bindValue(':appointment_serial',$appointment_serial); // NULL DATA WILL BE UPDATED
        $prebook->bindValue(':session',$session);
        $prebook->bindValue(':status',1);
        $prebook->execute();
        echo 1;
      }
    }






    /*
    echo '<div class="box"><div class="box-body">';
    echo "You have booked slot => $appointment_slot";
    echo '</div></div>';
    */
?>
