<?php
    ob_start();
    session_start();
    include ('../dbconfig.php');
    # => RESOURCES FOR SOAP API REQUEST
    //require('nusoap.php');
    $c = new soapclient('http://116.193.217.182/api/api.php?wsdl');
    $digipay_merchant_username = 'digiflexi';
    $digipay_merchant_password = 'dg344i';


    $data= $conn->query("SELECT * FROM recharge WHERE recharge_status=3  ORDER BY id ASC LIMIT 1")->fetch();
    var_dump($datas);
    if($data != NULL){
      //foreach ($datas as $data) {
        $msisdn         = $data['msisdn'];
        $amount         = $data['amount'];
        $msisdn_type    = $data['msisdn_type'];

        # => DIGIFLEXILOAD ID GENERATION
        $digiflexi_id = $data['digiflexi_id'];
        # =>CREATING TOP UP REQUEST

        $recharge_createTopup = $c->createTopup("$digipay_merchant_username","$digipay_merchant_password","$digiflexi_id","$msisdn",$amount,"$msisdn_type","http://116.193.217.182", "DIGICON FlexiLoad");

        if($recharge_createTopup != NULL){
          $digi_id = $recharge_createTopup->digi_id;
          # => MAKE TOPUP
          $recharge_sendTopupRequest = $c->sendTopupRequest($digi_id,"$digipay_merchant_username","$digipay_merchant_password");
          if($recharge_sendTopupRequest != NULL){
            # => RESPONSES GETTING FROM API REQUEST
            $digi_id = $recharge_sendTopupRequest->digi_id;
            $response_code = $recharge_sendTopupRequest->response;
            $message = $recharge_sendTopupRequest->message;
            $response_time = $recharge_sendTopupRequest->res_time;
            $operator_id = $recharge_sendTopupRequest->operator_res_id;

            # => UPDATE RECHARGE INFORMATION

            $update_query = "UPDATE recharge SET
                                                    digi_id='$digi_id',
                                                    response_code='$response_code',
                                                    message='$message',
                                                    response_time='$response_time',
                                                    operator_id='$operator_id',
                                                    recharge_status=1

                              WHERE digiflexi_id ='$digiflexi_id' ";

            $update_query_execute = $conn->query($update_query);
            if($update_query_execute ==TRUE){
              # => NOTIFICATION AREA INSERION
              $merchant_username = $data['merchant_username'];
              if($response_code ==200){
                $notification_message  = $msisdn." "."has been recharged with an amount of "." ".$amount;
              }
              if($response_code !=200){

                $notification_message = "Recharge was not successful to this ".$msisdn." and amount of ".$amount.".Response message is ".$message;
              }
              $insert   = $conn->query("INSERT INTO notification(message,merchant_username,response_code,status) VALUE('$notification_message','$merchant_username','$response_code',0) ");
            }
          }
        }
      //}
    }
?>
