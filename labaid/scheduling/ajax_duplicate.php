<?php
    include('../dbconfig.php');
    include ('../function/function.php');    


    $doctor_id = $_POST['doctor_id'];
    $reschedule_date = $_POST['reschedule_date']; // booked date
    $reschedule_date = date("d-m-Y",strtotime($_POST['reschedule_date'])); // booked date
    $new_date =$_POST['new_date']; // new booking date
    $new_date = date("d-m-Y",strtotime($new_date));

    $booked_date = $conn->query("SELECT appointment_time FROM appointment WHERE appointment_date='$reschedule_date' and doctor_id='$doctor_id' ")->fetchAll(PDO::FETCH_ASSOC);
    $booked_date = array_map('current', $booked_date);

    $booking_date = $conn->query("SELECT appointment_time FROM appointment WHERE appointment_date='$new_date' and doctor_id='$doctor_id' ")->fetchAll(PDO::FETCH_ASSOC);
    $booking_date = array_map('current', $booking_date);

    $duplicate_slot=array_intersect($booking_date,$booked_date);
    $length=  count($duplicate_slot);
    echo "<h3>These time slots are duplicate</h3>";
    for($i=0;$i<=$length;$i++){
        print '<label class="label label-info">'.$duplicate_slot[$i].'</label>';
        echo "&nbsp;&nbsp;";
    }
    echo "<br>";
    echo '<hr>';
    echo '<button type="" name="reschedule" onclick="reschedule()" class="btn btn-success">Continue Reschedule</button> ';
    echo "<br><br>";
?>