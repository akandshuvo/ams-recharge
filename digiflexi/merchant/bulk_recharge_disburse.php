<?php
//error_reporting(0);
ob_start();
session_start();
include ('../dbconfig.php');

# => CHECK IF THE USER IS LOGGED IN

if($_SESSION['is_login']!=1){
  header("location:../index.php");
}







# => GENERATING TABLE NAME

$merchant_username  =   preg_replace("/[^a-zA-Z]/", "", $_SESSION['username']);
$today              =   date("d_m_Y");
$tablename          =   $merchant_username."_".$today;



if (isset($_POST['disburse'])) {

    $ids = $_POST['id'];

    foreach($ids as $id){

        # =>GETTING MSISDN AND AMOUNT USING POST METHOD
        $data = $conn->query("SELECT msisdn,amount,msisdn FROM recharge WHERE id=$id")->fetch();
        $msisdn         = $data['msisdn'];
        $amount         = $data['amount'];
        $msisdn_type    = $data['msisdn_type'];

        # => DIGIFLEXILOAD ID GENERATION
        $digiflexi_id = "DGF".date('Ymd').time().rand(1000,9999);

        # => INSERT RECHARGE INFORMATION IN DATABASE

        $query = "UPDATE recharge SET
                                      digiflexi_id=:digiflexi_id,
                                      digi_id=:digi_id,
                                      response_code=:response_code,
                                      message=:message,
                                      response_time=:response_time,
                                      operator_id=:operator_id,
                                      merchant_username=:merchant_username,
                                      recharge_status = :recharge_status
                  WHERE
                                      id=:id

                ";

        $insert=$conn->prepare($query);
        $insert->bindValue(':digiflexi_id',$digiflexi_id);
        $insert->bindValue(':digi_id',$digi_id);
        $insert->bindValue(':response_code',$response_code);
        $insert->bindValue(':message',$message);
        $insert->bindValue(':response_time',$response_time);
        $insert->bindValue(':operator_id',$operator_id);
        $insert->bindValue(':merchant_username',$merchant_username);
        $insert->bindValue(':recharge_status',3);
        $insert->bindValue(':id',$id);
        $insert->execute();


        # => UPDATING ADMIN BALANCE
        $merchant = preg_replace("/[^a-zA-Z]/", "", $_SESSION['username']);
        $merchant_balance  = $conn->query("SELECT balance from user WHERE username='$merchant' ")->fetchColumn();
        $balance_deduct = intval($merchant_balance)-intval($amount);
        $admin_balance_update = $conn->query("UPDATE user SET balance=$balance_deduct WHERE username='$merchant'");

    }


    # =>DROPPING TABLE IF EXIST BEFORE UPLOADING DARA

    //$delete_table       =   $conn->prepare("DROP TABLE IF EXISTS $tablename");
    //$delete_table->execute();

    header("location:recharge_status.php");
}






    //ini_set("soap.wsdl_cache_enabled", 0);
    //$res = $c->cancelRecharge('123456', 'test001', 'silvercloud');
    //$digi_id = "DG07151500081953994";
    //echo $digi_id;
    //FIND TOP UP INFORMATION
    //$recharge_findTopup = $c->findTopup($digi_id,'testmerchant','dg344i');
    //print_r($recharge_createTopup);
    //print_r($recharge_sendTopupRequest);
    //print_r($recharge_findTopup);
?>
