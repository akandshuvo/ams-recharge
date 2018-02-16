<?php
    //SESSION,DB CONNECTION,OTHER QUERIES
    session_start();
    include ('../dbconfig.php'); // database connection
    if($_SESSION['is_login'] !=1){
      header("location:/labaid/index.php");
    }
    
    
    
    
    $date               = date("Y-m-d");
    $exploded           = explode("-",$date);
    $get_year           = $exploded['0'];
    $count_month_number = $exploded['1'];
    $today              = $exploded['2'];
     



 
    if(isset($_POST['new_schedule'])){ 
        $month_number       = $post_month = $_POST['month'];
        $year               = $post_year  = $_POST['year'];
        $doctor_id = $_POST['doctor_id'];
        
        
        //PULLING DOCTOR INFORMATION FROM DB
        $doctor_infos = $conn->query("SELECT * from doctor_profile WHERE doctor_id = '$doctor_id' ")->fetchAll(PDO::FETCH_ASSOC);
        if($doctor_infos == NULL){header("location:index.php?noprofile");die;}
        else{
          foreach($doctor_infos as $doctor_info){
            $employee_id          = $doctor_info['employee_id']; 
            $session_1            = $doctor_info['session_1'];
            $session_2            = $doctor_info['session_2'] ;
            $session_3            = $doctor_info['session_3'] ;
            $avg_load_patient     = $doctor_info['avg_load_patient'] ;
            $avg_duration         = $doctor_info['avg_duration'] ;
            $slot_serial          = $doctor_info['slot_serial'] ;
          }

        } 
    
    
        include 'month.php';
        
        $checkMonth = $conn->query("select count(*) from schedule WHERE month='$post_month' AND year='$post_year' AND doctor_id='$doctor_id'")->fetchColumn();
        $checkMonth = (int)$checkMonth;
        
        if ($checkMonth > 0) {
          header('location:index.php?alreadyinitiated');die;
        }
        if((int)$post_month<(int)$count_month_number AND $post_year == $get_year){
          header('location:index.php?timetravel');die;
        }
        
        if((int)$post_year >= (int)$year){
          
          for($i=1;$i<=$month_day_count;$i++){
            
             //$schedule_date = $i."-".$month_number."-".$year;
            
            if($i <= 9){
              $schedule_date = '0'.$i."-".$month_number."-".$year;
            }else{
              $schedule_date = $i."-".$month_number."-".$year;
            }
            
            $initiate = $conn->prepare("
                                        INSERT INTO 
                                                    schedule(
                                                              doctor_id,
                                                                employee_id,
                                                                  schedule_date,
                                                                    session_1,
                                                                      session_2,
                                                                        session_3,
                                                                          avg_load_patient,
                                                                            avg_duration,
                                                                              slot_serial,
                                                                                month,
                                                                                  year,
                                                                                    status
                                                            ) 
                                                       
                                                    VALUE(
                                                            :doctor_id,
                                                              :employee_id,
                                                                :schedule_date,
                                                                  :session_1,
                                                                    :session_2,
                                                                      :session_3,
                                                                        :avg_load_patient,
                                                                          :avg_duration,
                                                                            :slot_serial,
                                                                              :month,
                                                                                :year,
                                                                                  :status
                                                          )
                                      ");
                                      
                                      
            $initiate->bindValue(':doctor_id',$doctor_id);
            $initiate->bindValue(':employee_id',$employee_id);
            $initiate->bindValue(':schedule_date',$schedule_date);
            $initiate->bindValue(':session_1',$session_1);
            $initiate->bindValue(':session_2',$session_2);
            $initiate->bindValue(':session_3',$session_3);
            $initiate->bindValue(':avg_load_patient',$avg_load_patient);
            $initiate->bindValue(':avg_duration',$avg_duration);
            $initiate->bindValue(':slot_serial',$slot_serial);
            $initiate->bindValue(':month',$month_number);
            $initiate->bindValue(':year',$year);
            $initiate->bindValue(':status',1);
            $initiate->execute();
          }
          

          
          header('location:index.php?initiated');
        }
        
        
    }                
              
     
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>::LABAID::</title>
<!--include header-->
  <?php include('../header.php')?>

</head>

<body class="hold-transition skin-blue sidebar-mini sidebar-collapse">
<div class="wrapper">

<!--INCLUDING NAVIGATION-->
  <?php include('../nav.php');?>

      <!--:::::::::::::::::::::::::::::::RESPONSE MESSAGE:::::::::::::::::::::::::::::::::::::::::::::::::::-->              
      <?php
              if (isset($_GET['success'])) {
          ?>
            <script type="text/javascript">
              swal("Good Job","User Created Successfully", "success")
            </script>
          <?php
              }
          ?>
          
          <?php
              if (isset($_GET['initiated'])) {
          ?>
            <script type="text/javascript">
              swal("Good Job","Schedule Initiated", "success")
            </script>
          <?php
              }
          ?>
          <?php
              if (isset($_GET['alreadyinitiated'])) {
          ?>
            <script type="text/javascript">
              swal("Oops...", "Schedule already initiated,Please check from view schedule", "error");
            </script>
          <?php
              }
          ?>
          <?php
              if (isset($_GET['timetravel'])) {
          ?>
            <script type="text/javascript">
              swal("Oops...", "You can not make a time travel request", "error");
            </script>
          <?php
              }
          ?>
          
          <?php
              if (isset($_GET['noprofile'])) {
          ?>
            <script type="text/javascript">
              swal("Oops...", "Doctor Profile Not avaialble.", "error");
            </script>
          <?php
              }
          ?>

    <!--:::::::::::::::::::::::::::::::::::END OF RESPONSE MESSAGE:::::::::::::::::::::::::::::::::::::::::-->  

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1 class="text-center">
        NEW SCHEDULE
      </h1>
    </section>

  <!-- Main content -->
    <section class="content">
        <div class="row">
          <div class="col-sm-6 col-sm-offset-3">
            <div class="box">
              <div class="box-body">   
                      <form action="" method="post" class="form-horizontal">
                          <div class="form-group">
                            <label for="" class=" text-center col-sm-4 col-form-label">Month</label></label>
                              <div class="col-sm-6">
                                  <select class="form-control" name="month" id="" required>
                                      <option value="">Chose Your Option</option>
                                      <option value="01">JANUARY</option>
                                      <option value="02">FEBRUARY</option>
                                      <option value="03">MARCH</option>
                                      <option value="04">APRIL</option>
                                      <option value="05">MAY</option>
                                      <option value="06">JUNE</option>
                                      <option value="07">JULY</option>
                                      <option value="08">AUGUST</option>
                                      <option value="09">SEPTEMBER</option>
                                      <option value="10">OCTOBER</option>
                                      <option value="11">NOVEMBER</option>
                                      <option value="12">DECEMBER</option>
                                  </select>
                              </div>
                          </div>
                          <div class="form-group">
                              <label for="" class="col-sm-4 text-center col-form-label">Year</label></label>
                              <div class="col-sm-6">
                                  <select class="form-control" name="year" id="" required>
                                      <?php for($i=$get_year;$i<=$get_year+50;$i++):?>
                                          <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                      <?php endfor;?>
                                  </select>
                              </div>
                          </div>
                          <div class="form-group">
                              <label for="" class="col-sm-4 text-center col-form-label">DOCTOR</label></label>
                              <div class="col-sm-6">
                                  <input type="text" class="form-control" list="doctors" name="doctor_id" required />
                                  <datalist id="doctors">
                                    <?php 
                                      $doctor_lists = $conn->query("SELECT doctor_id,full_name FROM doctor_profile")->fetchAll(PDO::FETCH_ASSOC);
                                      foreach($doctor_lists as $doctor_list):
                                    ?>
                                      <option value="<?php echo $doctor_list['doctor_id']?>"><?php echo $doctor_list['full_name']?></option>
                                    <?php endforeach;?>
                                  </datalist>
                              </div>
                          </div>
                          <div class="form-group row">
                              <center>
                                  <button class="btn btn-info" name="new_schedule">INITIATE</button>
                              </center>
                          </div>
                      </form>
              </div>
            </div>
          </div>
      </div>
    </section>
  </div>
  <!-- /.content-wrapper -->
  
  
  
<!--INCLUDING FOOTER-->
  <?php include('../footer.php');?>
  
  
