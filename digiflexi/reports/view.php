<?php
//SESSION,DB CONNECTION,OTHER QUERIES
 ob_start();
 session_start();
 include ('../dbconfig.php'); // database connection

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
  $total 	= $conn->query("SELECT id FROM recharge  WHERE merchant_username='$merchant_username'")->rowCount();
  $pages = ceil($total/$perpage);

   

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>::DIGICON::</title>
<!--include header-->
  <?php include('../header.php')?>

</head>

<body class="hold-transition skin-blue sidebar-mini sidebar-collapse">
<div class="wrapper">

<!--INCLUDING NAVIGATION-->
  <?php include('../nav.php');include('../preloader.php');?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1 class="text-center">
        Recharge Report
      </h1>
    </section>

  <!-- Main content -->
    <section class="content">
        <div class="row">
          <div class="col-sm-12">
            <div class="box">
            <!-- /.box-header -->
            <div class="box-body">
            <?php  		

    			if($_SESSION['user_level'] ==1){
    			  $query = "SELECT * FROM recharge  ORDER BY id DESC LIMIT {$start},{$perpage} ";
    			}
    			if($_SESSION['user_level'] ==2){
    			  $merchant_username = $_SESSION['username'];
    			  $query = "SELECT * FROM recharge  WHERE merchant_username='$merchant_username' ORDER BY id DESC LIMIT {$start},{$perpage} ";
    			}
    			
    		
    			$rows = $conn->query($query)->fetchAll(PDO::FETCH_ASSOC);
			    ?>    
                
                <table id="" class="table table-bordered table-striped">
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
            <!-- /.box-body -->
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
                          <li class=""><a href="view.php?page=<?php echo $page-1;?>&perpage=<?php echo $perpage ?>" aria-label="Previous"><span aria-hidden="true" class="fa fa-angle-double-left"></span></a></li>
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
                          <li class=""><a href="view.php?page=<?php echo $page-1;?>&perpage=<?php echo $perpage ?>" aria-label="Previous"><?php echo $page-1;?></a></li>
                        <?php  
                        }
                        ?> 
                        <?php 
                          for($x=$page;$x<=$page;$x++){
                            if($x <= $pages){
                        ?>
                            <li <?php if($page === $x){echo 'class="active"';}?>>
                              <a href="view.php?page=<?php echo $x?>&perpage=<?php echo $perpage ?>">
                                <?php echo $x; ?>
                              </a>
                            </li>
                        <?php
                            } 
                          }
                        ?>


                        <?php
                        if($page == $pages){;
                        ?>
                          <li class="disabled"><a><span aria-hidden="true" class="fa fa-angle-double-right"></span></a>     </li>
                        <?php
                        }
                        else{
                        ?>  
                          <li class=""><a href="view.php?page=<?php echo $page+1;?>&perpage=<?php echo $perpage ?>" aria-label="Previous"><span aria-hidden="true" class="fa fa-angle-double-right"></span></a></li>
                     
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

    <footer class="main-footer">
      <strong>Copyright &copy; <?php echo date("Y")?> <a href="#">Digicon Technologies Ltd</a>.</strong> All rights reserved.
    </footer>
    <div class="control-sidebar-bg"></div>
  <!-- /.content-wrapper -->
  
  
  
<!--INCLUDING FOOTER-->
  <?php include('../footer.php');?>
  
  </body>
</html>