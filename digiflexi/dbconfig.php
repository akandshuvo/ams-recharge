<?php
    //error_reporting(0);
    $user =  "root";
    $pass =  "dg344i";
    $conn = new PDO('mysql:host=localhost;dbname=digiflexi', $user, $pass);

    if ($conn!=TRUE) {
        echo "NO";
    }

?>
