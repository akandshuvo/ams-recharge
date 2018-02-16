<?php
    //error_reporting(0);
    $post = $_POST;
    $user =  "root";
    $pass =  "dg344i";
    $conn = new PDO('mysql:host=localhost;dbname=labaid', $user, $pass);

    if ($conn!=TRUE) {
        echo "NO";
    }

?>
