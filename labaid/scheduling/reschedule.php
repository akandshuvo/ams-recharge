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
  <?php include('../nav.php');?>

<!--INCLUDING PRELOADER-->
<?php  
    include('../preloader.php');

?>


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  <!-- Main content -->
    <section class="content">
        <div class="row-fluid">
          <div class="box">
            <!-- /.box-header -->
            <div class="box-body">
                <div class="calender">
                    <?php 
                    if (isset($_GET['date'])) {
                    ?>

                    <?php
                        $post_date = date("d-m-Y", strtotime($_GET['date'])) ;
                        $doctor_id  = $_GET['doctor_id'];
                        $view_schedule = $conn->prepare("SELECT * from appointment WHERE appointment_date='$post_date' AND doctor_id='$doctor_id'");
                        $view_schedule->execute();
                        $schedules = $view_schedule->fetchAll(PDO::FETCH_ASSOC); 
                        if ($schedules == NULL){
                            echo "<center><button class='btn btn-warning'>NO DATA AVAILABLE</button></center>";
                        }else{
                    ?>
                        <!---HTML-->
                        
                            <table class="table table-bordered text-center table-condensed">
                                <tr>
                                    <th>DATE</th>
                                    <th>Customer Name</th>    
                                    <th>Registration Number</th>
                                    <th>Mobile Number</th>
                                    <th>Alt No</th>
                                    <th>Chamber Location</th>
                                    <th>Speciality</th>
                                    <th>Doctor ID</th>
                                    <th>Slot/Serial</th>
                                    <th>Session</th>
                                    <th>#</th>
                                </tr>
                    
                    <?php
                        foreach($schedules as $row){
                            $duplication[] = $row['appointment_time'];      
                        }
                        $unique =array_diff($duplication, array_diff_assoc($duplication, array_unique($duplication)));
                        $duplicate = array_unique(array_diff($duplication,$unique));
                        foreach($schedules as $schedule_list):
                            if(in_array($schedule_list['appointment_time'],$duplicate)){
                    ?>


                            
                                <tr class="warning">
                                    <input type="hidden" name="id[]" value="<?php echo $schedule_list['id']; ?>"/>
                                    <input type="hidden" name="doctor_id" id="doctor_id" value="<?php echo $schedule_list['doctor_id']; ?>"/>
                                    
                                    <td>
                                        <?php echo $schedule_list['appointment_date']; ?>
                                    </td>
                                    <td>
                                        <?php echo $schedule_list['customer_name'] ?>
                                    </td>
                                    <td>
                                        <?php echo $schedule_list['reg_number'] ?>
                                    </td>
                                    <td>
                                        <?php 
                                            echo $schedule_list['mobile_number'];
                                        ?>
                                    </td>
                                    <td>
                                        <?php 
                                            echo $schedule_list['alt_number']; 
                                        ?>
                                    </td>
                                    
                                    <td>
                                        <?php echo $schedule_list['chamber_location'] ?>
                                    </td>
                                    
                                    <td>
                                        <?php echo $schedule_list['speciality'] ?>
                                    </td>
                                    
                                    <td>
                                        <?php echo $schedule_list['doctor_id'] ?>
                                    </td>
                                    <td>
                                        <?php
                                            echo $schedule_list['appointment_time']; 
                                            echo $schedule_list['serial'];  
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                            if($schedule_list['session'] == 1){echo "Session 1";}
                                              if($schedule_list['session'] == 2){echo "Session 2";}
                                                if($schedule_list['session'] == 3){echo "Session 3";}
                                        ?>
                                    </td>
                                    <td>
                                       <a target="_blank" href="/labaid/appointment/reschedule_appointment.php?lastId=<?php echo $schedule_list['id'];?>"><label class="label label-info" for="">Reschedule</label></a> 
                                    </td>
                                </tr>
                    <?php
                            }else{
                    
                    ?>
                                <tr>
                                    <input type="hidden" name="id[]" value="<?php echo $schedule_list['id']; ?>"/>
                                    <input type="hidden" name="doctor_id" id="doctor_id" value="<?php echo $schedule_list['doctor_id']; ?>"/>
                                    
                                    <td>
                                        <?php echo $schedule_list['appointment_date']; ?>
                                    </td>
                                    <td>
                                        <?php echo $schedule_list['customer_name'] ?>
                                    </td>
                                    <td>
                                        <?php echo $schedule_list['reg_number'] ?>
                                    </td>
                                    <td>
                                        <?php 
                                            echo $schedule_list['mobile_number'];
                                        ?>
                                    </td>
                                    <td>
                                        <?php 
                                            echo $schedule_list['alt_number']; 
                                        ?>
                                    </td>
                                    
                                    <td>
                                        <?php echo $schedule_list['chamber_location'] ?>
                                    </td>
                                    
                                    <td>
                                        <?php echo $schedule_list['speciality'] ?>
                                    </td>
                                    
                                    <td>
                                        <?php echo $schedule_list['doctor_id'] ?>
                                    </td>
                                    <td>
                                        <?php
                                            echo $schedule_list['appointment_time']; 
                                            echo $schedule_list['serial'];  
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                            if($schedule_list['session'] == 1){echo "Session 1";}
                                              if($schedule_list['session'] == 2){echo "Session 2";}
                                                if($schedule_list['session'] == 3){echo "Session 3";}
                                        ?>
                                    </td>
                                </tr>
                    <?php            
                            } 
                        endforeach;
                    ?>
                    <!--html-->
                    
                            </table>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group-row">
                                        <label class="col-sm-1 col-sm-offset-4" for="rechedule_date">Date</label>
                                        <div class="col-sm-2">
                                            <input class="form-control" type="date" name="reschedule_date" id="reschedule_date" required/>
                                        </div>
                                        <div class="col-sm-3">
                                            <button   onClick="check_duplicate()" class="btn btn-info">Check Duplicate</button> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                    <?php
                            }
                    ?>

                    <?php
                        }
                    ?>
                </div>
            </div>
            <center>
                <div id="message"></div>
            </center>
            
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
      </div>
    </section>
  </div>
  <!-- /.content-wrapper -->
  
  
  <script type="text/javascript">
  function check_duplicate(){
    var doctor_id           = "<?php echo $_GET['doctor_id']?>";
    var reschedule_date     = "<?php echo $_GET['date']?>";
    var new_date            = document.getElementById("reschedule_date").value;

    //when searched by chamber location and speciality
    if(doctor_id && reschedule_date  && new_date){

      $.ajax({
      type:'POST',
      url:'ajax_duplicate.php',
      data:'doctor_id='+doctor_id+'&reschedule_date='+reschedule_date+'&new_date='+new_date,
        success:function(html){
          $('#message').html(html);
          //alert(html);
        }
      });
    }
  }
  function reschedule(){
    var doctor_id           = "<?php echo $_GET['doctor_id']?>";
    var reschedule_date     = "<?php echo $_GET['date']?>";
    var new_date            = document.getElementById("reschedule_date").value;

    //when searched by chamber location and speciality
    if(doctor_id && reschedule_date  && new_date){

      $.ajax({
      type:'POST',
      url:'ajax_reschedule.php',
      data:'doctor_id='+doctor_id+'&reschedule_date='+reschedule_date+'&new_date='+new_date,
        success:function(html){
            var pathname = window.location.pathname;
            var next_page = pathname+"?date="+new_date+"&doctor_id="+doctor_id;
            window.location = next_page;
            
            //$('#message').html(pathname);
            //alert(html);
        }
      });
    }
  }
</script>
<!--INCLUDING FOOTER-->
  <?php include('../footer.php');?>
  







