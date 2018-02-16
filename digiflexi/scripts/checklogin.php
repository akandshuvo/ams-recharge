<?php
    session_start();
    include ('../dbconfig.php');
    
    $user_id  = $_POST['user_id'];
    $password = md5($_POST['password']);

    
    $count = $conn->query("SELECT * FROM user WHERE username='$user_id' AND password = '$password'")->rowCount();
    //var_dump($count);die;
    
    if ($count == 1) {
            $user_results = $conn->query("SELECT * from user where username='$user_id' AND password = '$password'")->fetchAll(PDO::FETCH_ASSOC);
            
            foreach($user_results as $user_result){
                $_SESSION['full_name']=$user_result['full_name'];
                $_SESSION['username']=$user_result['username'];
                $_SESSION['user_level']=$user_result['user_level'];
                $_SESSION['is_login'] = 1;
                header("location:../dashboard.php");
            }

    }else{
        header("location:../index.php?error");
    }
    

?>