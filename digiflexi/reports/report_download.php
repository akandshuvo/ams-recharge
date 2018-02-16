<?php
session_start();
include '../dbconfig.php';
$output = '';
if(isset($_GET["from"]))
{
	$from           = $_GET['from'];
	$to             = $_GET['to'];
    if($_SESSION['user_level'] ==1){
        $query = "SELECT * FROM recharge WHERE datetime >= '$from' AND datetime <= '$to 23:59:59' ORDER BY id DESC ";
    }else{
        $merchant_username = $_SESSION['username'];
        $query = "SELECT * FROM recharge WHERE datetime >= '$from' AND datetime <= '$to 23:59:59' AND merchant_username='$merchant_username' ORDER BY id DESC ";
    }
    
    
    $rowCount       = $conn->query($query)->rowCount();
    $rows           = $conn->query($query)->fetchAll(PDO::FETCH_ASSOC);
    if($rowCount > 0)
    {
        $output .= '
                <table class="table" border="1">
                     <tr>
                      <th>MSISDN</th>
                      <th>DigiFlexi ID</th>
                      <th>Digipay ID</th>
                      <th>Reponse Code</th>
                      <th>Message</th>
                      <th>Operator ID</th>
                      <th>Amount</th>
                      <th>Date Time</th>
                     </tr>
           ';
        foreach($rows as $row){
        

            
           
           
            $output .= '
                     <tr>
                        <td>'.$row['msisdn'].'</td>
                        <td>'.$row['digiflexi_id'].'</td>
                        <td>'.$row['digi_id'].'</td>
                        <td>'.$row['response_code'].'</td>
                        <td>'.$row['message'].'</td>
                        <td>'.$row['operator_id'].'</td>
                        <td>'.$row['amount'].'</td>
                        <td>'.$row['datetime'].'</td>
                     </tr>
                ';
        
        }
       
        $output .= '</table>';
        $filename = $from."to".$to.time();
        header("Content-Type: application/xls");
        header("Content-Disposition: attachment; filename=$filename.xls");
        echo $output;

    }
	else {
		$output = '<table><tr><td colspan=6><h1 style="color:red">No Result</h1></td></tr></table>';
        $filename = $from. " to ".$to.time();
        header("Content-Type: application/xls");
        header("Content-Disposition: attachment; filename=$filename.xls");
        echo $output;
	}
	
}
?>

Passport Holder: ABU BAKKAR SIDDIK
Verified By: Mohammad Iar Ali - Bogra
Phone Number: 01716245941

Passport Holder: SHANARA BEGUM
Verified By:Mohammad Iar Ali - Bogra
Phone Number:01716245941

