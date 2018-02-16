<?php
  //SESSION,DB CONNECTION,OTHER QUERIES
  ob_start();
  session_start();
  include ('../dbconfig.php'); // database connection

  # => CHECK IF THE USER IS LOGGED IN
  if($_SESSION['is_login']!=1){
    header("location:../index.php");
  }

  # => GENERATING TABLE NAME

  $merchant_username  =   preg_replace("/[^a-zA-Z]/", "", $_SESSION['username']);
  $today              =   date("d_m_Y");
//$tablename          =   $merchant_username."_".$today;

# =>DELETING TABLE IF EXIST BEFORE UPLOADING DARA

//$delete_table       =   $conn->prepare("DROP TABLE IF EXISTS $tablename");
//$delete_table->execute();


# =>CREATING TABLE BEFORE UPLOADING DATA
//$table_create_query = "
//                           CREATE TABLE IF NOT EXISTS $tablename (
//                              `id`              int(11)         NOT NULL    AUTO_INCREMENT,
//                              `msisdn`          varchar(128)    NOT NULL,
//                              `amount`          int(32)         NOT NULL,
//                              `msisdn_type`     varchar(128)    NOT NULL,
//                              `status`          int(1)          NOT NULL,
//
//                              PRIMARY KEY (`id`)
//                            )
//
//                    ";
//$create_table       = $conn->prepare($table_create_query);
//$create_table->execute();






# => UPLOADING DATA IN DB FROM CSV
 if (isset($_POST['submit'])){
	if ($_FILES[csv][size] > 0) {
        //get the csv file
        $file = $_FILES[csv][tmp_name];
        $handle = fopen($file,"r");
        $handle2 = fopen($file,"r");
        while ($data = fgetcsv($handle,50000,",")){

            $msisdn                             = addslashes($data[0]);
            $amount                             = addslashes($data[1]);
            $msisdn_length                      = strlen(addslashes($data[0]));
            $msisdn_operator_code               = substr(addslashes($data[0]),0,3);
            $msisdn_operator_code_suffix        = substr(addslashes($data[0]),3,8);


        //    if(preg_match('/[a-zA-Z]/i', $msisdn)){
        //        echo " alphabet found";echo "<br>";echo $msisdn;echo "<br>";
        //    }else{
        //        echo " no alphabet found";echo "<br>";
        //    }


            if($msisdn_length==11 && !preg_match('/[a-zA-Z]/i', $msisdn)   && $msisdn_operator_code ="015" || $msisdn_operator_code ="017" || $msisdn_operator_code ="018" || $msisdn_operator_code ="016"){
                    $status =0; // 0 = number is pending for recharge
            }else{
                    $status =2; // 2 = there is something wrong with the number.
            }

            if ($data[0]) {
                $query="INSERT INTO recharge(msisdn,amount,msisdn_type,recharge_status,merchant_username)
                        VALUES('".addslashes($data[0])."','".addslashes($data[1])."','".addslashes($data[2])."',$status,'$merchant_username')";
                $query=$conn->prepare($query);
                $query->execute();
            }
        }
        header('Location:bulk_recharge_view.php'); die;
    }
}
?>
