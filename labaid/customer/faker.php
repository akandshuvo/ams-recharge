<?php

    include('../dbconfig.php');
    

    for($i=1;$i<100000000;$i++){
            $customer_name = $i."_"."Shovon Rahman Shuvo"; 
            $mobile_number = "01534653592";
            $alt_number    = "0747423861";
            $date_of_birth  = "25-02-1992";
            $age            = 10+$i;
            $today = (int)date('Ymdhis')+$i;
            $reg_number     = "LABAID"."-".$today;
            
        $insert = $conn->prepare(
                        "INSERT INTO customer(customer_name,mobile_number,alt_number,date_of_birth,age,reg_number)  
                                    VALUE    (:customer_name,:mobile_number,:alt_number,:date_of_birth,:age,:reg_number)
        ");
        
        $insert->bindValue(':customer_name',$customer_name);
        $insert->bindValue(':mobile_number',$mobile_number);
        $insert->bindValue(':alt_number',$alt_number);
        $insert->bindValue(':date_of_birth',$date_of_birth);
        $insert->bindValue(':age',$age);
        $insert->bindValue(':reg_number',$reg_number);
        $insert->execute();
        
        
    }










?>