<?php
//SESSION,DB CONNECTION,OTHER QUERIES
    session_start();
    include ('../dbconfig.php'); // database connection
    if($_SESSION['is_login'] !=1){
        header("location:/labaid/index.php");  
    }
    
    
    $date               = date("Y-m-d");
    $exploded           = explode("-",$date);
    $get_year               = $exploded['0'];
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
                url: "ajax_edit.php",
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
<!--INCLUDING PRELOADER-->
<?php include('../preloader.php');?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  <!-- Main content -->
    <section class="content">
        <div class="row-fluid">
          <div class="box">
            <!-- /.box-header -->
            <div class="box-body">
                <div class="calender">
                    <form action="" method="post">
                        <div class="form-group row">
                            <label for="" class="col-sm-1 col-form-label">Month</label></label>
                            <div class="col-sm-3">
                                <select class="form-control" name="month" id="" required>
                                    <option value="">Choose Your Option</option>
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
                            <label for="" class="col-sm-1 col-form-label">Year</label></label>
                            <div class="col-sm-2">
                                <select class="form-control" name="year" id="">
                                    <?php for($i=$get_year;$i<=$get_year+50;$i++):?>
                                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                    <?php endfor;?>
                                </select>
                            </div>
                            <label for="" class="col-sm-1 col-form-label">DOCTOR</label></label>
                            <div class="col-sm-2">
                                <input type="text" class="form-control" list="doctors" name="doctor_id" required />
                                    <datalist id="doctors">
                                        <?php
                                          $doctor_lists = $conn->query("SELECT doctor_id,full_name from doctor_profile");
                                          $doctor_lists = $doctor_lists->fetchAll(PDO::FETCH_ASSOC);
                                          foreach($doctor_lists as $doctor_list):
                                        ?>
                                          <option value="<?php echo $doctor_list['doctor_id'] ?>"><?php echo $doctor_list['full_name'] ?></option>
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
                    <table class="table table-bordered text-center table-condensed">
                        <tr>
                            <th>DATE</th>
                            <th>1st Session</th>    
                            <th>2nd Session</th>
                            <th>3rd Session</th>
                            <th>Avg Patient</th>
                            <th>Duration</th>
                            <th>Type</th>
                            <th style="width:3%;">Slot(1)/Serial(2)</th>
                            <th>Status</th>
                            <th style="width:3%;">Open(1)/Close(0)</th>
                            <th>#</th>
                        </tr>
                    <?php
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
                            //checking if there is any booking on that day
                                $schedule_date =  $schedule_list['schedule_date'];
                                $check_appointment =$conn->query("SELECT * from appointment WHERE appointment_date='$schedule_date' AND doctor_id='$doctor_id'")->fetchColumn();
                                if($check_appointment >= 1 ){
                    ?>
                        
                            
                        <tr class="danger">
                            <td>
                                <?php 
                                    $appointment_date = $schedule_list['schedule_date'];
                                    echo date("jS F, Y", strtotime($schedule_list['schedule_date']));        
                                ?>
                            </td>
                            <td>
                                <?php echo $schedule_list['session_1'] ?>
                            </td>
                            <td>
                                <?php echo $schedule_list['session_2'] ?>
                            </td>
                            <td>
                                <?php echo $schedule_list['session_3'] ?>
                            </td>
                            
                            <td>
                                <?php echo $schedule_list['avg_load_patient'] ?>
                            </td>
                            
                            <td>
                                <?php echo $schedule_list['avg_duration'] ?>
                            </td>

                            <td>
                                <?php
                                    if($schedule_list['slot_serial'] ==1){
                                        echo '<label for="" class="label label-info">Slot</label>';
                                    }
                                    if($schedule_list['slot_serial'] ==2){
                                        echo '<label for="" class="label label-warning">Serial</label>';
                                    }
                                ?>
                            </td>
                            <td>
                                <?php echo $schedule_list['slot_serial'];?>
                            </td>
                            <td>
                                <?php
                                    if($schedule_list['status'] ==1){
                                        echo '<label for="" class="label label-info">Open</label>';
                                        //echo '1';
                                        
                                    }
                                    if($schedule_list['status'] ==0){
                                        echo '<label for="" class="label label-warning">Close</label>';
                                        //echo '0';
                                    }
                                ?>
                            </td>
                            <td>
                                <?php echo $schedule_list['status'];?>
                            </td>
                            <td><a href="reschedule.php?date=<?php echo $schedule_list['schedule_date'] ?>&doctor_id=<?php echo $schedule_list['doctor_id'];?>"
                                    <label for="" class="label label-primary">Reschedule</label>
                                </a>
                            </td>

                        </tr>

                    <?php   
                                }else{
                                    
                    ?>                        
                        <tr>
                            <td>
                                <?php 
                                    $appointment_date = $schedule_list['schedule_date'];
                                    echo date("jS F, Y", strtotime($schedule_list['schedule_date']));        
                                ?>
                            </td>
                            <td contenteditable="true" onBlur="saveToDatabase(this,'session_1','<?php echo $schedule_list['id']; ?>')" onClick="showEdit(this);">
                                <?php echo $schedule_list['session_1'] ?>
                            </td>
                            <td contenteditable="true" onBlur="saveToDatabase(this,'session_2','<?php echo $schedule_list['id']; ?>')" onClick="showEdit(this);">
                                <?php echo $schedule_list['session_2'] ?>
                            </td>
                            <td contenteditable="true" onBlur="saveToDatabase(this,'session_3','<?php echo $schedule_list['id']; ?>')" onClick="showEdit(this);">
                                <?php echo $schedule_list['session_3'] ?>
                            </td>
                            
                            <td contenteditable="true" onBlur="saveToDatabase(this,'avg_load_patient','<?php echo $schedule_list['id']; ?>')" onClick="showEdit(this);">
                                <?php echo $schedule_list['avg_load_patient'] ?>
                            </td>
                            
                            <td contenteditable="true" onBlur="saveToDatabase(this,'avg_duration','<?php echo $schedule_list['id']; ?>')" onClick="showEdit(this);">
                                <?php echo $schedule_list['avg_duration'] ?>
                            </td>


                            <td>
                                <?php
                                    if($schedule_list['slot_serial'] ==1){
                                        echo '<label for="" class="label label-info">Slot</label>';
                                    }
                                    if($schedule_list['slot_serial'] ==2){
                                        echo '<label for="" class="label label-warning">Serial</label>';
                                    }
                                ?>
                            </td>
                            <td contenteditable="true" onBlur="saveToDatabase(this,'slot_serial','<?php echo $schedule_list['id']; ?>')" onClick="showEdit(this);">
                                <?php echo $schedule_list['slot_serial'];?>
                            </td>
                            <td>
                                <?php
                                    if($schedule_list['status'] ==1){
                                        echo '<label for="" class="label label-info">Open</label>';
                                        //echo '1';
                                        
                                    }
                                    if($schedule_list['status'] ==0){
                                        echo '<label for="" class="label label-warning">Close</label>';
                                        //echo '0';
                                    }
                                ?>
                            </td>
                            <td  contenteditable="true" onBlur="saveToDatabase(this,'status','<?php echo $schedule_list['id']; ?>')" onClick="showEdit(this);">
                                <?php echo $schedule_list['status'];?>
                            </td>
                            <td><a href="reschedule.php?date=<?php echo $schedule_list['schedule_date'] ?>&doctor_id=<?php echo $row['doctor_id']?>"
                                    <label for="" class="label label-primary">Reschedule</label>
                                </a>
                            </td>

                        </tr>
                    
                    
                    
                    <?php
                                }
                    endforeach;
                            }
                        }
                    ?>
                </table>
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


