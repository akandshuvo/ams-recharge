<?php
include '../dbconfig.php';
$output = '';
if(isset($_GET["from"]))
{
	$from = $_GET['from'];
	$to = $_GET['to'];
    $sql = "SELECT * FROM customer_profiling WHERE profiling_task_completion_date >= '$from' AND profiling_task_completion_date <= '$to 23:59:59' AND status='4' ORDER BY id DESC";
    //echo $sql;
    
    $result = $conn->query($sql);
    if($result->num_rows > 0)
    {
        $output .= '
                <table class="table" border="1">
                     <tr>
                        <th style="background:#000;">MSISDN</th>
                        <th>FULL NAME</th>
                        <th>UPDATED FULL NAME</th>
                        <th>CURRENT BILLING ADDRESS</th>
                        <th>UPDATED BILLING ADDRESS</th>
                        <th>DIVISION</th>
                        <th>ACTIVATION DATE</th>
                        <th>SALES POINT</th>
                        <th>PROFILING PARTNER NAME</th>
                        <th>JOB ASSIGN DATE</th>
                        <th>JOB ASSIGN TIME</th>
                        <th>PROFILING AGENT ID</th>
                        <th>PROFILING TASK COMPLETION DATE</th>
                        <th>PROFILING TASK COMPLETION TIME</th>
                        <th>REMARKS</th>
                        <th>LOCATION OF HOUSE</th>
                        <th>ACCOMMODATION TYPE</th>
                        <th>PAYMENT RESPONSIBILITY</th>
                        <th>HOUSE OWNERSHIP</th>
                        <th>SIZE OF ACCOMMODATION(SQF)</th>
                        <th>PROFESSION/SERVICE</th>
                        <th>PROFESSIONAL EXPERIENCE</th>
                        <th>INCOME LEVEL(MONTHLY-GOVT)</th>
                        <th>INCOME LEVEL(MONTHLY-OTHERS)</th>
                        <th>NATURE OF BUSINESS</th>
                        <th>NUMBER OF EMPLOYEE</th>
                        <th>YEAR OF BUSINESS</th>
                        <th>EMAIL</th>
                        <th>CREDIT CATEGORY</th>
                     </tr>
           ';
        while($row = $result->fetch_assoc())
        {
            if ($row['job_category']=="Government") {
                $income_level_govt=$row['income_level'];
            }
            if ($row['job_category']!="Government") {
                $income_level_govt="Not Applicable";
            }
            
            if($row['job_category']=="Private"){
                $income_level_private=$row['income_level'];
            }elseif($row['nature_of_business']=="Retail Business"){
                $income_level_private=$row['income_level'];
            }elseif($row['nature_of_business']=="Sole Proprietorship"){
                $income_level_private=$row['income_level'];
            }elseif($row['nature_of_business']=="Small and Medium Enterprise"){
                $income_level_private=$row['income_level'];
            }elseif($row['nature_of_business']=="Public/Private organization"){
                $income_level_private=$row['income_level'];
            }elseif($row['nature_of_business']=="Listed Public/Private Organizatio"){
                $income_level_private=$row['income_level'];
            }else{
                $income_level_private="Not Applicable";
            }
            
           
           
            $output .= '
                     <tr>
                          <td>'.$row['msisdn'].'</td>
                          <td>'.$row['full_name'].'</td>
                          <td>'.$row['updated_full_name'].'</td>
                          <td>'.$row['current_billing_address'].'</td>
                          <td>'.$row['updated_billing_address'].'</td>
                          <td>'.$row['division'].'</td>
                          <td>'.$row['activation_date'].'</td>
                          <td>'.$row['sales_point'].'</td>
                          <td>DIGICON</td>
                          <td>'.$row['job_assigned_date'].'</td>
                          <td>'.$row['job_assigned_time'].'</td>
                          <td>'.$row['profiling_agent_id'].'</td>
                          <td>'.$row['profiling_task_completion_date'].'</td>
                          <td>'.$row['profiling_task_completion_time'].'</td>
                          <td>'.$row['remarks'].'</td>
                          <td>'.$row['location_of_house'].'</td>
                          <td>'.$row['accommodation_type'].'</td>
                          <td>'.$row['payment_responsibility'].'</td>
                          <td>'.$row['house_ownership'].'</td>
                          <td>'.$row['size_of_accommodation'].'</td>
                          <td>'.$row['designation'].'</td>
                          <td>'.$row['professional_experience'].'</td>
                          
                          <td>'.$income_level_govt.'</td>
                          <td>'.$income_level_private.'</td>
                          
                          <td>'.$row['nature_of_business'].'</td>
                          <td>'.$row['number_of_employee'].'</td>
                          <td>'.$row['year_of_business'].'</td>
                          <td>'.$row['email'].'</td>
                          <td>'.$row['credit_category'].'</td>
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