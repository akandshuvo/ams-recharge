<?php
# => ERROR REPORTING 0
error_reporting(0);

# => STARTING THE SESSION
ob_start();
session_start();

# => DATABASE CONNECTION FILE

include('../dbconfig.php');

# => CHECK IF THE USER IS LOGGED IN

if($_SESSION['is_login']!=1){
  header("location:../index.php");
}


# =>GETTING MSISDN AND AMOUNT USING POST METHOD
$msisdn             = $_POST['msisdn'];
$amount             = $_POST['amount'];
$msisdn_type        = $_POST['msisdn_type'];
$merchant_username  = $_SESSION['username'];
$operator_prefix    = substr($msisdn,0,3);

# => Operator prefix    
if($operator_prefix == '015'){$operator_name="Teletalk";}               // Teletalk
elseif($operator_prefix == '016'){$operator_name="Airtel";}             // Airtel
elseif($operator_prefix == '017'){$operator_name="Grameenphone";}       // GRAMEENPHONE
elseif($operator_prefix=='018'){$operator_name="Robi";}                 // Robi
elseif($operator_prefix=='019'){$operator_name="Banglalink";}           // Banglalink
else{$operator_name="";}

# => MSISDN VALIDATION

$msisdn_length                      = strlen($msisdn);
$msisdn_operator_code               = substr($msisdn);
$msisdn_operator_code_suffix        = substr($msisdn);

if(preg_match('/[a-zA-Z]/i', $msisdn)){
  header("location:single_recharge.php?wrongmsisdn");die;
}

if($msisdn_length==11 && !preg_match('/[a-zA-Z]/i', $msisdn)   && $msisdn_operator_code ="015" || $msisdn_operator_code ="017" || $msisdn_operator_code ="018" || $msisdn_operator_code ="016"){
  //$status =0; // 0 = number is pending for recharge
}else{
  //$status =2; // 2 = there is something wrong with the number.
  header("location:single_recharge.php?wrongmsisdn");die;
}

# => DIGIFLEXILOAD ID GENERATION

$digiflexi_id = "DGF".date('Ymd').time().rand(1000,9999);


# => INSERT RECHARGE INFORMATION IN DATABASE

$query = "INSERT INTO recharge(
                                digiflexi_id,
                                  digi_id,
                                    response_code,
                                      message,
                                        response_time,
                                          operator_id,
                                            operator_name,
                                              msisdn,
                                                msisdn_type,
                                                  amount,
                                                    merchant_username,
                                                      recharge_status 
                              )
                        VALUES(
                                :digiflexi_id,
                                  :digi_id,
                                    :response_code,
                                      :message,
                                        :response_time,
                                          :operator_id,
                                            :operator_name,
                                              :msisdn,
                                                :msisdn_type,
                                                  :amount,
                                                    :merchant_username,
                                                      :recharge_status
                              )
        ";

$insert=$conn->prepare($query);
$insert->bindValue(':digiflexi_id',$digiflexi_id);
$insert->bindValue(':digi_id',$digi_id);
$insert->bindValue(':response_code',$response_code);
$insert->bindValue(':message',$message);
$insert->bindValue(':response_time',$response_time);
$insert->bindValue(':operator_id',$operator_id);
$insert->bindValue(':operator_name',$operator_name);
$insert->bindValue(':msisdn',$msisdn);
$insert->bindValue(':msisdn_type',$msisdn_type);
$insert->bindValue(':amount',$amount);
$insert->bindValue(':merchant_username',$merchant_username);
$insert->bindValue(':recharge_status',3);
$insert->execute();


# => UPDATING MERCHANT/ADMIN BALANCE

$merchant = preg_replace("/[^a-zA-Z]/", "", $_SESSION['username']);
$merchant_balance  = $conn->query("SELECT balance from user WHERE username='$merchant' ")->fetchColumn();
$balance_deduct = intval($merchant_balance)-intval($amount);
$admin_balance_update = $conn->query("UPDATE user SET balance=$balance_deduct WHERE username='$merchant'");



# => HEADING BACK TO DASHBOARD

header("location:../merchant/recharge_status.php");


?>
