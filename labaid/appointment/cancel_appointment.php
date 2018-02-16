<?php
session_start();
include ('../dbconfig.php');
$agent_id = $_SESSION['employee_id'];

if(isset($_POST['reason_submit'])){
    $id= $_POST['id'];
    $reason = $_POST['reason'];

    
    try {
        // copying data and moving to calcel_appointment from appointment table
        $insert = $conn->prepare("INSERT INTO cancel_appointment select * from appointment where id = '$id'")->execute();
        // updating table cancel_appointment
        $update = $conn->prepare("UPDATE cancel_appointment SET reason='$reason',agent_id= '$agent_id' where id = '$id'")->execute();
        // deleting data from appointment table
        $delete = $conn->prepare("DELETE  FROM appointment WHERE id='$id'")->execute();
        //redirecting to old customer page
        header("location:../customer/old_patient.php?cancelled");
    }
    catch( PDOException $Exception ) {
        $message    = $Exception->getMessage();
        $code       = $Exception->getCode();

        echo $message;
        echo $code;

    }
    
}






//$delete = $conn->prepare("DELETE  FROM appointment WHERE id='$id'")->execute();
//header("location:../customer/old_patient.php");



?>