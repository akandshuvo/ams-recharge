<?php
    # => SESSION,DB CONNECTION,OTHER QUERIES
    ob_start();
    session_start();
    include ('../dbconfig.php'); // database connection

    # => CHECK IF THE USER IS LOGGED IN
    if($_SESSION['is_login']!=1){
      header("location:../index.php");
    }
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>::digiflexi::</title>
<!--include header-->
  <?php include('../header.php')?>
    <script>
		function showEdit(editableObj) {
			$(editableObj).css("background","#FFF");
		}
        function saveToDatabase(editableObj,column,id) {
            $(editableObj).css("background","#FFF url(loaderIcon.gif) no-repeat right");
            $.ajax({
                url: "bulk_recharge_edit.php",
                type: "POST",
                data:'column='+column+'&editval='+editableObj.innerHTML+'&id='+id,
                success: function(data){
                    $(editableObj).css("background","#FDFDFD");
                    window.location.reload(true);
                }
            });
        }
    </script>
</head>

<body class="hold-transition skin-blue sidebar-mini sidebar-collapse">
<div class="wrapper">

<!--INCLUDING NAVIGATION-->
  <?php include('../nav.php');?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1 class="text-center">
        RECHARGE REPORT
      </h1>
    </section>

  <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-sm-12">
                <div class="box">
                    <div class="box-body">
                        <table id="example1" class="text-center table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>MSISDN</th>
                                    <th>AMOUNT</th>
                                    <th>PREPAID/POSTPAID</th>
                                    <th>STATUS</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                    # => GENERATING TABLE NAME
                                    $merchant_username  =   preg_replace("/[^a-zA-Z]/", "", $_SESSION['username']);
                                    $today              =   date("d_m_Y");
                                    $tablename          =   $merchant_username."_".$today;

                                    $rows = $conn->query("SELECT * from recharge WHERE merchant_username='$merchant_username'")->fetchAll(PDO::FETCH_ASSOC);
                                    foreach ($rows as $row):
                                        if($row['recharge_status']==2){
                                ?>
                                            <tr>
                                                <td contenteditable="true" onBlur="saveToDatabase(this,'msisdn','<?php echo $row['id']; ?>')" onClick="showEdit(this);">
                                                    <?php echo $row['msisdn'];?>
                                                </td>
                                                <td contenteditable="true" onBlur="saveToDatabase(this,'amount','<?php echo $row['id']; ?>')" onClick="showEdit(this);">
                                                    <?php echo $row['amount'];?>
                                                </td>
                                                <td><?php echo $row['msisdn_type'];?></td>
                                                <td>
                                                    <?php
                                                        if($row['recharge_status']==0){echo '<label for="" class="label label-info">Pending</label>';}
                                                        if($row['recharge_status']==2){echo '<label for="" class="label label-warning">Error</label>';}
                                                    ?>

                                                </td>
                                            </tr>
                                <?php
                                        }
                                    if($row['recharge_status']==0){
                                ?>
                                            <tr class="success">
                                                <td>
                                                    <?php echo $row['msisdn'];?>
                                                </td>
                                                <td><?php echo $row['amount'];?></td>
                                                <td><?php echo $row['msisdn_type'];?></td>
                                                <td>
                                                    <?php
                                                        if($row['recharge_status']==0){echo '<label for="" class="label label-info">Pending</label>';}
                                                        if($row['recharge_status']==2){echo '<label for="" class="label label-warning">Error</label>';}
                                                    ?>

                                                </td>
                                            </tr>
                                <?php
                                    }
                                    endforeach;
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-sm-offset-3">
                <div class="box">
                    <div class="box-body">
                        <table class="text-center table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Total Recharge Amount is</th>
                                    <th>
                                        <div class="pull-left">
                                            <?php
                                                # => GENERATING TABLE NAME

                                                $merchant_username  =   preg_replace("/[^a-zA-Z]/", "", $_SESSION['username']);
                                                $today              =   date("d_m_Y");
                                                $tablename          =   $merchant_username."_".$today;

                                                $amounts = $conn->query("SELECT amount FROM recharge WHERE merchant_username='$merchant_username'")->fetchAll(PDO::FETCH_ASSOC);

                                                #CONVERTING STRING VALUE TO INTEGER VALUE
                                                foreach($amounts as $amount){
                                                    $recharge_amount[] = (int)$amount['amount'];
                                                }

                                                $recharge_amount_sum = array_sum($recharge_amount);
                                                echo $recharge_amount_sum;
                                            ?>
                                        </div>
                                    </th>
                                    <th>
                                        Taka
                                    </th>
                                </tr>
                                <tr>
                                    <th>You balance  Amount is  </th>
                                    <th>
                                        <div class="pull-left">
                                            <?php
                                                $username =$_SESSION['username'];
                                                $balance = $conn->query("SELECT balance from user WHERE username='$username' ")->fetchColumn();
                                                echo $balance;
                                            ?>
                                        </div>

                                    </th>
                                    <th>
                                        Taka
                                    </th>
                                </tr>
                                <tr>
                                    <th>Amount after deduction </th>
                                    <th>
                                        <div class="pull-left">
                                            <?php
                                                $deduction = (int)$balance-(int)$recharge_amount_sum;
                                                echo $deduction;
                                            ?>
                                        </div>
                                    </th>
                                    <th>
                                        Taka
                                    </th>
                                </tr>

                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>

<!-- # =>DISBURSE BUTTON ACTION -->
        <div class="row">

            <?php
                $not_ok = $conn->query("SELECT * from recharge WHERE recharge_status=2 AND merchant_username='$merchant_username'")->rowCount();
                if( (int)$balance < (int)$recharge_amount_sum){
            ?>

                <center>
                    <h5 class="warning-text">Your recharge amount is exceding the balance amount</h5>
                    <button class="btn btn-disabled">DISBURSE</button>
                </center>
            <?php
                }elseif($not_ok >=1 ){
            ?>
                <center>
                    <h5 class="warning-text">There are some wrong numbers. Correct them first</h5>
                    <button class="btn btn-disabled">DISBURSE</button>
                </center>
            <?php
                }else{
            ?>
                <form action="bulk_recharge_disburse.php" method="post">
                    <?php
                      $rows = $conn->query("SELECT id FROM recharge WHERE merchant_username='$merchant_username' AND recharge_status = 0 ")->fetchAll(PDO::FETCH_ASSOC);
                      foreach ($rows as $row) { echo '<input type="hidden" name="id[]" value="'. $row['id']. '">';;}
                    ?>
                    <center><button class="btn btn-info btn-disabled" type="submit" name="disburse">DISBURSE</button></center>
                </form>

            <?php
                }
            ?>
        </div>
    </section>
  </div>
  <!-- /.content-wrapper -->



<!--INCLUDING FOOTER-->
  <?php include('../footer.php');?>
