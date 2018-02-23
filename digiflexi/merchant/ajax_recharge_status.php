<?php
  include('../dbconfig.php');
  $id = $_POST['id'];
  $check_status = $conn->query("SELECT recharge_status FROM recharge WHERE id='$id'")->fetch(); // 1 = recharge done
  echo $check_status['recharge_status']._.$id;
?>
