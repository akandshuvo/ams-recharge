<?php
  session_start();
  include('dbconfig.php');
  if($_SESSION['is_login'] !=1){
    header("location:/labaid/index.php");
  }
?>



<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>::LABAID::</title>
<!--include header-->
  <?php include('header.php')?>

</head>
<?php include('preloader.php');?>


<body class="hold-transition skin-blue sidebar-mini sidebar-collapse">
<div class="wrapper">
  <!--##################################################-->
  <!--INCLUDING NAVIGATION-->
  <?php include('nav.php');?>
  <div class="content-wrapper">

    <section class="content">
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3><?php echo $uploaded_count ?></h3>
              <p>Uploaded</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="#" class="small-box-footer"></a>
          </div>
        </div>
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?php echo $assigned_count ?></h3>

              <p>Total Assigned</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer"></a>
          </div>
        </div>
        <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?php echo $unassigned_count ?></h3>

              <p>Total Unassigned</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="#" class="small-box-footer"></a>
          </div>
        </div>
        <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?php echo $daily_count ?></h3>
              <p>Daily-Completed</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="#" class="small-box-footer"></a>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-sm-6">
          <div class="panel">
            <div class="panel-heading text-center">
                  
              <h4>Agent Appointment Summary</h4>
            </div>
            <div class="panel-body">
              <table class="table table-bordered table-responsive" id="dashboard_agent">
                <thead>
                  <tr>
                    <th>Agent ID</th>
                    <th>Agent Name</th>
                    <th>Total</th>
                    <th>Percentage</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                    $agent_summary = $conn->query("SELECT agent_id from appointment group by agent_id")->fetchAll(PDO::FETCH_ASSOC);
                    foreach($agent_summary as $row){
                      $agent_id = $row['agent_id'];
                  ?>    
                    
                    <tr>
                      <td><?php echo $row['agent_id']; ?></td>
                      <td><?php echo $agent_name=$conn->query("SELECT full_name FROM user WHERE employee_id='$agent_id'")->fetchColumn();?></td>
                      <td><?php echo $per_agent=$conn->query("SELECT id FROM appointment WHERE agent_id='$agent_id'")->rowCount();?></td>
                      <td>
                        <?php 
                          $total=$conn->query("SELECT id FROM appointment")->rowCount();
                          echo round(($per_agent*100)/$total,3);echo "%";
                        ?>
                          
                      </td>
                    </tr>
                  <?php
                    }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>

        <div class="col-sm-6">
          <div class="panel">
            <div class="panel-heading">
              <h4>Total Appointment Taking(Branch)</h4>
            </div>
            <div class="panel-body">
              <table class="table table-bordered table-responsive" id="dashboard_branch">
                <thead>
                  <tr>
                    <th>Branch Name</th>
                    <th>Total</th>
                    <th>Percentage</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                    $branch_summary = $conn->query("SELECT chamber_location from appointment group by chamber_location")->fetchAll(PDO::FETCH_ASSOC);
                    foreach($branch_summary as $row){
                      $chamber_location = $row['chamber_location'];
                  ?>    
                    
                    <tr>
                      <td><?php echo $row['chamber_location']; ?></td>
                      <td><?php echo $per_branch=$conn->query("SELECT id FROM appointment WHERE chamber_location='$chamber_location'")->rowCount();?></td>
                      <td>
                        <?php 
                          $total=$conn->query("SELECT id FROM appointment")->rowCount();
                          echo round(($per_branch*100)/$total,3);echo "%";
                        ?>
                          
                      </td>
                    </tr>
                  <?php
                    }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!--##################################################-->
  </div>
  
<!--INCLUDING FOOTER-->
  <?php include('footer.php');?>
  
  
