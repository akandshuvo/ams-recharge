<?php
# => ERROR REPORTING 0

error_reporting(0);

# => STARTING THE SESSION

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

# => MSISDN VALIDATION

if(preg_match('/[a-zA-Z]/i', $msisdn)){
  header("location:single_recharge.php?wrongmsisdn");die;
}

# => DIGIFLEXILOAD ID GENERATION

$digiflexi_id = "DGF".date('md').time().rand(100,999);


# => INSERT RECHARGE INFORMATION IN DATABASE

$query = "INSERT INTO recharge(digiflexi_id,digi_id,response_code,message,response_time,operator_id,msisdn,amount,merchant_username)
                                VALUES(:digiflexi_id,:digi_id,:response_code,:message,:response_time,:operator_id,:msisdn,:amount,:merchant_username)
        ";

$insert=$conn->prepare($query);
$insert->bindValue(':digiflexi_id',$digiflexi_id);
$insert->bindValue(':digi_id',$digi_id);
$insert->bindValue(':response_code',$response_code);
$insert->bindValue(':message',$message);
$insert->bindValue(':response_time',$response_time);
$insert->bindValue(':operator_id',$operator_id);
$insert->bindValue(':msisdn',$msisdn);
$insert->bindValue(':amount',$amount);
$insert->bindValue(':merchant_username',$merchant_username);
$insert->execute();


# => UPDATING MERCHANT/ADMIN BALANCE

$merchant = preg_replace("/[^a-zA-Z]/", "", $_SESSION['username']);
$merchant_balance  = $conn->query("SELECT balance from user WHERE username='$merchant' ")->fetchColumn();
$balance_deduct = intval($merchant_balance)-intval($amount);
$admin_balance_update = $conn->query("UPDATE user SET balance=$balance_deduct WHERE username='$merchant'");


# => RESOURCES FOR SOAP API REQUEST

require('nusoap.php');
$c = new soapclient('http://116.193.217.182/api/api.php?wsdl');
$digipay_merchant_username = 'digiflexi';
$digipay_merchant_password = 'dg344i';







# =>CREATING TOP UP REQUEST

$recharge_createTopup = $c->createTopup("$digipay_merchant_username","$digipay_merchant_password","$digiflexi_id","$msisdn",$amount,"$msisdn_type","http://116.193.217.182", "DIGICON FlexiLoad");
$digi_id = $recharge_createTopup->digi_id;


# => MAKE TOPUP

$recharge_sendTopupRequest = $c->sendTopupRequest($digi_id,"$digipay_merchant_username","$digipay_merchant_password");

# => RESPONSES GETTING FROM API REQUEST

$digi_id = $recharge_sendTopupRequest->digi_id;
$response_code = $recharge_sendTopupRequest->response;
$message = $recharge_sendTopupRequest->message;
$response_time = $recharge_sendTopupRequest->res_time;
$operator_id = $recharge_sendTopupRequest->operator_res_id;


# => UPDATE RECHARGE INFORMATION

$update_query = "UPDATE recharge SET
                                      digi_id       = '$digi_id',
                                      response_code = '$response_code',
                                      message       = '$message',
                                      response_time = '$response_time',
                                      operator_id   = '$operator_id'

                  WHERE digiflexi_id ='$digiflexi_id' ";

$update_query_execute = $conn->query($update_query);

# => HEADING BACK TO DASHBOARD

header("location:../dashboard.php");

//01704697287
//ini_set("soap.wsdl_cache_enabled", 0);
//$res = $c->cancelRecharge('123456', 'test001', 'silvercloud');
//SEND REQUEST FOR TOP
//$digi_id = "DG07151500081953994";
//echo $digi_id;
//FIND TOP UP INFORMATION
//$recharge_findTopup = $c->findTopup($digi_id,'testmerchant','dg344i');
//print_r($recharge_createTopup);
//echo "<pre>";print_r($recharge_sendTopupRequest);echo "</pre>";

//print_r($recharge_findTopup);

?>
