<?php
if(isset($_POST['get_option']))
{
 include('../dbconfig.php');

 $state = $_POST['get_option'];
 //$state = 1216;
 $query="select employee_id from user where zip_code='$state'";
 $find=$conn->query($query);
 echo "<option>choose you option</option>";
 while($row=$find->fetch_array())
 {
  echo "<option>".$row['employee_id']."</option>";
 }
 exit;
}
?>