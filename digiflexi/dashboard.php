<?php
  date_default_timezone_set('Asia/Dhaka');
  ob_start();
  session_start();
  include('dbconfig.php');
  if($_SESSION['is_login'] !=1){
    header("location:/digiflexi/index.php");
  }
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>::digiflexi::</title>
  <!--include header-->
  <?php include('header.php')?>
</head>
<?php include('preloader.php');?>

<body class="hold-transition skin-blue sidebar-mini sidebar-collapse">
<div class="wrapper">

  <!--INCLUDING NAVIGATION-->
  <?php include('nav.php');?>
  <div class="content-wrapper">
    <section class="content">
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3>
                  <?php
                    $username =$_SESSION['username'];
                    $balance = $conn->query("SELECT balance from user WHERE username='$username' ")->fetchColumn();
                    echo "$balance";
                  ?>
              </h3>
              <p>BALANCE</p>
            </div>
            <div class="icon">
              <i class="fa fa-money"></i>
            </div>
            <a href="#" class="small-box-footer">
              Your balance
            </a>
          </div>
        </div>
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3>
                <!--Total Recharge today-->
                <?php
            			$from = date("Y-m-d");
            			$to   = date("Y-m-d");
            			if($_SESSION['user_level'] ==1){
                    $recharge_amounts_today = $conn->query("SELECT amount from recharge WHERE datetime >= '$from' AND datetime <= '$to 23:59:59' ")->fetchAll(PDO::FETCH_ASSOC);
            			}
            			if($_SESSION['user_level'] ==2){
            			  $merchant_username = $_SESSION['username'];
                    $recharge_amounts_today = $conn->query("SELECT amount from recharge WHERE datetime >= '$from' AND datetime <= '$to 23:59:59' AND merchant_username='$merchant_username' ")->fetchAll(PDO::FETCH_ASSOC);
            			}
                  if($recharge_amounts_today !=NULL){
                    foreach($recharge_amounts_today as $recharge_amount_today){
                      $recharge_amount[] = (int)$recharge_amount_today['amount'];
                    }
                    $recharge_amount_sum_today = array_sum($recharge_amount);
                    echo $recharge_amount_sum_today;
                  }else{
                    echo "0";
                  }
                ?>
              </h3>
              <p>Recharged Today</p>
            </div>
            <div class="icon">
              <i class="fa fa-dollar"></i>
            </div>
            <a href="#" class="small-box-footer">Total Recharge Amount -Today</a>
          </div>
        </div>
        <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>
                <!--Total Recharge All-->
                <?php
            			if($_SESSION['user_level'] ==1){
                    $recharge_amounts_all = $conn->query("SELECT amount from recharge")->fetchAll(PDO::FETCH_ASSOC);
            			}
            			if($_SESSION['user_level'] ==2){
            			  $merchant_username = $_SESSION['username'];
                    $recharge_amounts_all = $conn->query("SELECT amount from recharge WHERE merchant_username='$merchant_username'")->fetchAll(PDO::FETCH_ASSOC);
            			}

                  if($recharge_amounts_all!=NULL){
                    foreach($recharge_amounts_all as $recharge_amount_all){
                        $recharge_all[] = (int)$recharge_amount_all['amount'];
                    }

                    $recharge_amount_sum_all = array_sum($recharge_all);
                    echo $recharge_amount_sum_all;
                  }else{
                    echo "0";
                  }
                ?>
              </h3>

              <p>All Recharge</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer">All Recharge Amount</a>
          </div>
        </div>
        <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>
                <?php
                    $merchant_count = $conn->query("SELECT user_level from user WHERE user_level=2 ")->rowCount();
                    echo $merchant_count;
                ?>
              </h3>
              <p>Merchants</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="#" class="small-box-footer">
              Total Merchants
            </a>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-sm-12">
          <div class="box">
            <div class="box-header">
              <h4>Today's Report</h4>
            </div>
            <div class="box-body">
                <?php
            			$from = date("Y-m-d");
            			$to   = date("Y-m-d");
            			if($_SESSION['user_level'] ==1){
            			  $query = "SELECT * FROM recharge WHERE datetime >= '$from' AND datetime <= '$to 23:59:59' ORDER BY id DESC ";
            			}
            			if($_SESSION['user_level'] ==2){
            			  $merchant_username = $_SESSION['username'];
            			  $query = "SELECT * FROM recharge WHERE datetime >= '$from' AND datetime <= '$to 23:59:59' AND merchant_username='$merchant_username' ORDER BY id DESC ";
            			}
            			$rows = $conn->query($query)->fetchAll(PDO::FETCH_ASSOC);
      			    ?>

                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th>MSISDN</th>
                      <th>DigiFlexi ID</th>
                      <th>Digipay ID</th>
                      <th>Reponse Code</th>
                      <th>Message</th>
                      <th>Operator ID</th>
                      <th>Amount</th>
                      <th>Date Time</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                        foreach($rows as $row){
                    ?>
                      <tr>
                        <td><?php echo $row['msisdn']?></td>
                        <td><?php echo $row['digiflexi_id']?></td>
                        <td><?php echo $row['digi_id']?></td>
                        <td><?php echo $row['response_code']?></td>
                        <td><?php echo $row['message']?></td>
                        <td><?php echo $row['operator_id']?></td>
                        <td><?php echo $row['amount']?></td>
                        <td><?php echo $row['datetime']?></td>
                      </tr>
                      <?php } ?>
                    </tbody>
                    <tfoot>
                    <tr>
                      <th>MSISDN</th>
                      <th>DigiFlexi ID</th>
                      <th>Digipay ID</th>
                      <th>Reponse Code</th>
                      <th>Message</th>
                      <th>Operator ID</th>
                      <th>Amount</th>
                      <th>Date Time</th>
                    </tr>
                    </tfoot>
                </table>
            </div>
          </div>
        </div>
      </div>

    </section>
  </div>

<!--INCLUDING FOOTER-->
  <?php include('footer.php');?>
