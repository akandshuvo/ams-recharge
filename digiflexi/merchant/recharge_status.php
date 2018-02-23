<?php
//SESSION,DB CONNECTION,OTHER QUERIES
     session_start();
     include ('../dbconfig.php'); // database connection

    # => CHECK IF THE USER IS LOGGED IN
    if($_SESSION['is_login']!=1){
      header("location:../index.php");
    }
    if($_GET['page']){
      $page = $_GET['page'];
     }else{
       $page = 1;
     }
    
     if($_GET['perpage']){
      $perpage = $_GET['perpage'];
     }else{
       $perpage = 10;
     }
    
       //positioning
      $start = ($page > 1) ? ($page*$perpage)-$perpage: 0;
    
      # => PAGE COUNT
      $merchant_username = $_SESSION['username'];
      $total 	= $conn->query("SELECT id FROM recharge  WHERE merchant_username='$merchant_username' AND recharge_status=1")->rowCount(); //status = 1  => recharge request has been done. 
      $pages = ceil($total/$perpage);
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
<?php include('../preloader.php');?>
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
                        <table id="" class="text-center table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>DIGIFLEXI ID</th>
                                    <th>MSISDN</th>
                                    <th>OPERATOR</th>
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

                                    $rows = $conn->query("SELECT * from recharge WHERE merchant_username='$merchant_username' ORDER BY id DESC LIMIT {$start},{$perpage}")->fetchAll(PDO::FETCH_ASSOC);
                                    foreach ($rows as $row){
                                ?>
                                            <tr>
                                                <td>
                                                  <?php echo $row['digiflexi_id'];?>
                                                </td>
                                                <td>
                                                    <?php echo $row['msisdn'];?>
                                                </td>
                                                <td>
                                                    <?php echo $row['operator_name'];?>
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
                    <div class="box-footer">
                      <div class="col-sm-6">
                        <div class="text-left">
                          <?php 
                              $to =$start+$perpage;
                              echo "Showing ". $start ." to ".$to." of ".$total." entries " ;
                          ?>
                        </div>
                      </div>
                      <div class="col-sm-6">
                        <div class="text-right">
                          <nav aria-label="..." class="" style="margin-top:-25px;"> 
                              <ul class="pagination">
                                <?php
                                if($page == 1){
                                ?>
                                  <li class="disabled"><a><span aria-hidden="true" class="fa fa-angle-double-left"></span></a>     </li>
                                <?php
                                }
                                else{
                                ?>  
                                  <li class=""><a href="recharge_status.php?page=<?php echo $page-1;?>&perpage=<?php echo $perpage ?>" aria-label="Previous"><span aria-hidden="true" class="fa fa-angle-double-left"></span></a></li>
                                <?php  
                                }
                                ?>    

                                <?php
                                if($page == 1){;
                                ?>
                                <?php
                                }
                                else{
                                ?>  
                                  <li class=""><a href="recharge_status.php?page=<?php echo $page-1;?>&perpage=<?php echo $perpage ?>" aria-label="Previous"><?php echo $page-1;?></a></li>
                                <?php  
                                }
                                ?> 
                                <?php 
                                  for($x=$page;$x<=$pages;$x++){
                                    if($x <= $pages){
                                ?>
                                    <li <?php if($page === $x){echo 'class="active"';}?>>
                                      <a href="recharge_status.php?page=<?php echo $x?>&perpage=<?php echo $perpage ?>">
                                        <?php echo $x; ?>
                                      </a>
                                    </li>
                                <?php
                                    } 
                                  }
                                ?>


                                <?php
                                if($page == $pages){
                                ?>
                                  <li class="disabled"><a><span aria-hidden="true" class="fa fa-angle-double-right"></span></a>     </li>
                                <?php
                                }
                                else{
                                ?>  
                                  <li class=""><a href="recharge_status.php?page=<?php echo $page+1;?>&perpage=<?php echo $perpage ?>" aria-label="Previous"><span aria-hidden="true" class="fa fa-angle-double-right"></span></a></li>
                            
                                <?php  
                                }
                                ?> 
                              </ul>
                          </nav>
                        </div>
                      </div>                          
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
