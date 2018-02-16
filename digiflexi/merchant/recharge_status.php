<?php
//SESSION,DB CONNECTION,OTHER QUERIES
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
                                    <th>ID</th>
                                    <th>DIGIFLEXI ID</th>
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
                                    foreach ($rows as $row){
                                ?>
                                            <tr>
                                                <td>
                                                  <?php echo $row['id'];?>
                                                </td>
                                                <td>
                                                  <?php echo $row['digiflexi_id'];?>
                                                </td>
                                                <td>
                                                    <?php echo $row['msisdn'];?>
                                                </td>
                                                <td>
                                                    <?php echo $row['amount'];?>
                                                </td>
                                                <td><?php echo $row['msisdn_type'];?></td>
                                                <td>
                                                    <label for="" class="label label-success" id="status<?php echo $row['id']?>">In Queue</label>
                                                  </div>
                                                </td>
                                            </tr>
                                <?php
                                  $ids[] = $row['id'];
                                        }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
  </div>
  <!-- /.content-wrapper -->

<script type="text/javascript">

var obj = <?php echo json_encode($ids); ?>;
//console.log(obj);


$(function(){
  AjaxRequest();
});

function AjaxRequest(){
  if(obj){
    for(var i = 0; i < obj.length; i++) {
        var id = obj[i];
        $.ajax({
          method:'post',
          url:"ajax_recharge_status.php",
          data:'id='+id,
          success:function(result){
            var result = result;
            var string = result.split('_');
            var recharge_status =string[0] ;
            var id = string[1];

            if(recharge_status == 1){
              var status='Done';
              $('#status'+id).html(status);
            }
            if(recharge_status == 3){
              var status='In Queue';
              $('#status'+id).html(status);
            }

          }
        });
    }
  }
 setTimeout(AjaxRequest,5000); //call the same function every 1s.
}

</script>

<!--INCLUDING FOOTER-->
  <?php include('../footer.php');?>
