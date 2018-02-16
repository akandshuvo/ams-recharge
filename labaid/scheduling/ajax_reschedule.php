
<?php
    include("../dbconfig.php");
    include ('../function/function.php');    




    $doctor_id_1                =   $_POST['doctor_id'];
    $reschedule_date_1          =   $_POST['reschedule_date']; // booked date
    $reschedule_date_1          =   date("d-m-Y",strtotime($_POST['reschedule_date'])); // booked date
    $new_date_1                 =   $_POST['new_date']; // new booking date
    $new_date_1                 =   date("d-m-Y",strtotime($new_date_1));


    $reschedule = $conn->query("UPDATE appointment SET appointment_date ='$new_date_1' WHERE appointment_date='$reschedule_date_1' AND doctor_id='$doctor_id_1'");


?>

