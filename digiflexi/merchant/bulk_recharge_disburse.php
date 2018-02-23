<?php
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
            $data = $conn->query("SELECT msisdn,amount,msisdn_type FROM recharge WHERE id=$id")->fetch();
            $msisdn             = $data['msisdn'];
            $amount             = $data['amount'];
            $msisdn_type        = $data['msisdn_type'];
            $operator_prefix    = substr($msisdn,0,3);

            # => Operator prefix    
            if($operator_prefix == '015'){$operator_name="Teletalk";}               // Teletalk
            elseif($operator_prefix == '016'){$operator_name="Airtel";}             // Airtel
            elseif($operator_prefix == '017'){$operator_name="Grameenphone";}       // GRAMEENPHONE
            elseif($operator_prefix=='018'){$operator_name="Robi";}                 // Robi
            elseif($operator_prefix=='019'){$operator_name="Banglalink";}           // Banglalink
            else{$operator_name="";}


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
                                        operator_name = :operator_name,
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
            $insert->bindValue(':operator_name',$operator_name);
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
        header("location:recharge_status.php");
    }
?>
