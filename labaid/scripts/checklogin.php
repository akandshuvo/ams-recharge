<?php
    session_start();
    include ('../dbconfig.php');
    
    $user_id  = $_POST['user_id'];
    $password = $_POST['password'];
    

    
    $count = $conn->query("SELECT * from user where employee_id='$user_id' AND password = '$password'")->rowCount();
    //var_dump($count);die;
    
    if ($count == 1) {
            $user_results = $conn->query("SELECT * from user where employee_id='$user_id' AND password = '$password'")->fetchAll(PDO::FETCH_ASSOC);
            
            foreach($user_results as $user_result){
                $_SESSION['full_name']=$user_result['full_name'];
                $_SESSION['employee_id']=$user_result['employee_id'];
                $_SESSION['user_level']=$user_result['user_level'];
                $_SESSION['is_login'] = 1;
                header("location:../dashboard.php");
            }

    }else{
        header("location:../index.php?error");
    }
    

?>