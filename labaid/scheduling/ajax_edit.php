
<?php
    include("../dbconfig.php");
    $value =$_POST["editval"];
    if($value != NULL){
        $result = $conn->prepare("UPDATE schedule set " . $_POST["column"] . " = '".$value."' WHERE  id=".$_POST["id"])->execute();
    }
    
?>

