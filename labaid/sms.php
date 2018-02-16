<?php
try{
 $soapClient = new SoapClient("https://api2.onnorokomSMS.com/sendSMS.asmx?wsdl");
 $paramArray = array(
 'userName' => "01534653592",
 'userPassword' => "dg344i",
 'mobileNumber' => "01534653592",
 'smsText' => "অভিবাদন",
 'type' => "TEXT",
 'maskName' => '',
 'campaignName' => '',
 );
 $value = $soapClient->__call("OneToOne", array($paramArray));
 echo $value->OneToOneResult;
} catch (Exception $e) {
 echo $e->getMessage();
}
