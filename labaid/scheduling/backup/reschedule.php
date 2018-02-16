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
  
    <script>
		function showEdit(editableObj) {
			$(editableObj).css("background","#FFF");
		} 
        function saveToDatabase(editableObj,column,id) {
            $(editableObj).css("background","#FFF url(loaderIcon.gif) no-repeat right");
            $.ajax({
                url: "ajax_reschedule.php",
                type: "POST",
                data:'column='+column+'&editval='+editableObj.innerHTML+'&id='+id,
                success: function(data){
                    $(editableObj).css("background","#FDFDFD");
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
  <!-- Main content -->
    <section class="content">
        <div class="row-fluid">
          <div class="box">
            <!-- /.box-header -->
            <div class="box-body">
                <div class="calender">
                    <form action="" method="post" >
                        <div class="form-group row">
                            <label for="" class="col-sm-1 col-form-label">Date</label></label>
                            <div class="col-sm-3">
                                <input class="form-control datepicker" name="date"/>
                            </div>
                            <label for="" class="col-sm-1 col-form-label">DOCTOR</label></label>
                            <div class="col-sm-2">
                                <input type="text" class="form-control" list="doctors" name="doctor_id" required />
                                    <datalist id="doctors">
                                        <?php
                                          $doctor_lists = $conn->query("SELECT * from doctor_profile");
                                          $doctor_lists = $doctor_lists->fetchAll(PDO::FETCH_ASSOC);
                                          foreach($doctor_lists as $doctor_list):
                                        ?>
                                          <option value="<?php echo $doctor_list['doctor_id'] ?>"><?php echo $doctor_list['doctor_id'] ?></option>
                                          
                                        <?php endforeach;?>
                                    </datalist>
                            </div>
                            
                            <div class="col-sm-2">
                                <center>
                                    <button class="btn btn-info" name="view_schedule">SEARCH</button>
                                </center>
                            </div>
                            
                        </div>
                    </form>
                    <hr>




                    <?php 
                    if (isset($_POST['view_schedule'])) {
                    ?>

                    <?php
                        $post_date = date("d-m-Y", strtotime($_POST['date'])) ;
                        $doctor_id  = $_POST['doctor_id'];
                        
                        
                        
                        
                        
                        
                        
                        $view_schedule = $conn->prepare("SELECT * from appointment WHERE appointment_date='$post_date' AND doctor_id='$doctor_id'");
                        $view_schedule->execute();
                        $schedules = $view_schedule->fetchAll(PDO::FETCH_ASSOC); 
                        if ($schedules == NULL){
                            echo "<center><button class='btn btn-warning'>NO DATA AVAILABLE</button></center>";
                        }else{
                    ?>
                        <!---HTML-->
                        <form action="ajax_reschedule.php" method="post">
                            <table class="table table-bordered text-center table-condensed">
                                <tr>
                                    <th>DATE</th>
                                    <th>Customer Name</th>    
                                    <th>Registration Number</th>
                                    <th>Mobile Number/Alt No</th>
                                    <th>Chamber Location</th>
                                    <th>Speciality</th>
                                    <th>Doctor ID</th>
                                    <th>Slot/Serial</th>
                                    <th>Session</th>
                                </tr>
                    
                    <?php
                            
                        foreach($schedules as $schedule_list):
                    ?>
                        
                            
                                <tr>
                                    <input type="hidden" name="id[]" value="<?php echo $schedule_list['id']; ?>"/>
                                    <input type="hidden" name="doctor_id" value="<?php echo $schedule_list['doctor_id']; ?>"/>
                                    
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
                                            echo ";";
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
                                        <?php echo $schedule_list['appointment_time']; echo $schedule_list['serial'];  ?>
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
                                
                    endforeach;
                    ?>
                    <!--html-->
                    
                            </table>
                            <div class="row">
                                <div class="col-sm-12">
                                    <table>
                                        <tr class="text-center">
                                            <td width="10%">Date</td>
                                            <td width="15%">
                                                <input class="form-control datepicker"type="" name="reschedule_date"/>  
                                            </td>
                                            <td width="10%">From</td>
                                            <td width="10%">
                                                <input class="form-control" type="time" name="reschedule_time_from"/>
                                            </td>
                                            <td width="10%">TO</td>
                                            <td width="10%">
                                                <input class="form-control" type="time" name="reschedule_time_to"/>
                                            </td>
                                            <td width="10%">Session</td>
                                            <td width="10%">
                                                <select name="session" id="" class="form-control">
                                                    <option value="">Choose Your Option</option>
                                                    <option value="1">Session 1</option>
                                                    <option value="2">Session 2</option>
                                                    <option value="3">Session 3</option>
                                                </select>  
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                               <center><button type="submit" name="reschedule" class="btn btn-success">Reschedule</button></center> 
                            </div>
                        </form>    
                    <?php
                            }
                    ?>

                    <?php
                        }
                    ?>
                </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
      </div>
    </section>
  </div>
  <!-- /.content-wrapper -->
  
  
  
<!--INCLUDING FOOTER-->
  <?php include('../footer.php');?>
  
  





<?php 
/*
// calendar design
if (isset($_POST['view_schedule'])) {
$post_month = $_POST['month'];
$post_year  = $_POST['year'];
$doctor_id  = $_POST['doctor_id'];

$view_schedule = $conn->prepare("SELECT * from schedule WHERE month='$post_month' AND year='$post_year' AND doctor_id='$doctor_id'");
$view_schedule->execute();
$schedules = $view_schedule->fetchAll(PDO::FETCH_ASSOC); 
if ($schedules == NULL) {
echo "<center><button class='btn btn-warning'>NO DATA AVAILABLE</button></center>";
}else{
foreach($schedules as $schedule_list):
?>

<div class="col-sm-3 ">
<div class="calender_box">
<div class="calender_box_header">
<p class="pull-right"><a href="mailto:" style="color:white;"><span class="fa fa-pencil"></span></a> </p>
<p class="pull-left">
<?php 
$appointment_date = $schedule_list['schedule_date'];
echo date("jS F, Y", strtotime($schedule_list['schedule_date']));        

?>
</p>
</div>
<div class="calender_box_body">
<p>1st Session:&nbsp;<?php echo $schedule_list['session_1'] ?></p>
<p>2nd Session:&nbsp;<?php echo $schedule_list['session_2'] ?></p>
<p>3rd Session:&nbsp;<?php echo $schedule_list['session_3'] ?></p>
<p>Total Patient:
<?php 
$count_patient  = $conn->query("SELECT * from appointment WHERE appointment_date = '$appointment_date' AND doctor_id='$doctor_id'")->rowCount();
if ($count_patient != NULL) {
echo $count_patient;
}else{
echo "0";
}
?>
</p>
<center>
<label  class="label label-info"><a href="" style="color:white;">View More</a></label>
</center>
</div>
</div>
</div>
<?php endforeach;}}else{ ?>   
<center><h4>NO DATA</h4></center>
<?php } 

*/

?>


