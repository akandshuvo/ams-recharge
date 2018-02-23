
<?php
    session_start();
    include("../dbconfig.php");

    # => CHECK IF THE USER IS LOGGED IN

    if($_SESSION['is_login']!=1){
    header("location:../index.php");
    }

    # => GENERATING TABLE NAME

    $merchant_username  =   preg_replace("/[^a-zA-Z]/", "", $_SESSION['username']);
    $today              =   date("d_m_Y");
    $tablename          =   $merchant_username."_".$today;


    $value =trim($_POST["editval"]);

    $msisdn                             = $value;
    $msisdn_length                      = strlen($value);
    $msisdn_operator_code               = substr($value,0,3);
    $msisdn_operator_code_suffix        = substr(addslashes($data[0]),3,8);

    if($msisdn_length==11 && !preg_match('/[a-zA-Z]/i', $msisdn) && $msisdn_operator_code ="015" || $msisdn_operator_code ="017" || $msisdn_operator_code ="018" || $msisdn_operator_code ="016"){
            $status =0;
    }else{
            $status =2;
    }



    if($value != NULL){
        $result = $conn->prepare("UPDATE recharge set " . $_POST["column"] . " = '".$value."' WHERE  id=".$_POST["id"])->execute();
        $update_temp_recharge = $conn->prepare("UPDATE recharge set recharge_status=$status WHERE  id=".$_POST["id"])->execute();
    }

?>
