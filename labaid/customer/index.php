<?php
//SESSION,DB CONNECTION,OTHER QUERIES
  ob_start();
  session_start(); //starting the login session
  if($_SESSION['is_login'] != 1){
    header("location:/labaid/index.php"); // if user is not logged in,this will redirect user to the login page
  }
  include ('../dbconfig.php'); // database connection
  
  //getting last registration number
  
  $reg_no     = $conn->query("SELECT reg_number from customer ORDER BY id DESC LIMIT 1")->fetchColumn();
  $labaid     = "LABAID";
  $year       = substr($reg_no,-13,4);
  $month      = substr($reg_no,-9,2);
  $date       = substr($reg_no,-7,2);
  $serial     = substr($reg_no,-5);
  
  

  //todays date spliting
  
  $present_year   = date('Y');
  $present_month  = date('m');
  $present_date   = date('d');
  
  
  //generating registration number//
  
  if($year  == $present_year && $month == $present_month && $date == $present_date){
    
    $serial_legth = (int)$serial;
    
    if(strlen((string)$serial_legth) == 1){
      $serial =$serial+1;
      $serial = (string)$serial;
      $serial = "0000".''.$serial;
    }
    
    if(strlen((string)$serial_legth) == 2){
      $serial =$serial+1;
      $serial = (string)$serial;
      $serial = "000".''.$serial;
    }
    
    if(strlen((string)$serial_legth) == 3){
      $serial =$serial+1;
      $serial = (string)$serial;
      $serial = "00".''.$serial;
    }
    
    if(strlen((string)$serial_legth) == 4){
      $serial =$serial+1;
      $serial = (string)$serial;
      $serial = "0".''.$serial;
    }
    
    if(strlen((string)$serial_legth) == 5){
      $serial =$serial+1;
      $serial = (string)$serial;
      $serial = $serial;
    }
    $registration_number = $labaid.''.$year.''.$month.''.$date.''.$serial;
  }
  else{
    $registration_number = $labaid.$present_year.$present_month.$present_date."00001";
  }


  # => CREATING PATIENT ACCOUNT
  
  if (isset($_POST['create_patient'])) {
      $customer_name        = $_POST['customer_name'];
      $mobile_number        = $_POST['mobile_number'];
      $alt_number           = $_POST['alt_number'];
      $date_of_birth        = $_POST['date_of_birth'];
      $reg_number           = $_POST['reg_number'];
      $patient_designation  = $_POST['patient_designation'];
      $patient_sex          = $_POST['patient_sex'];
      
      # => AGE CALCULATION
      
      $dateOfBirth = date("Y-m-d",strtotime($date_of_birth));
      $today                = date("Y-m-d");
      $age                  = date_diff(date_create($dateOfBirth), date_create($today));
      $age                  = $age->format('%y');
    
      # => GENERATING QUERY
      
      $query = $conn->prepare("
                                INSERT INTO customer(customer_name,mobile_number,alt_number,date_of_birth,age,reg_number,patient_designation,patient_sex)
                                            VALUES  (:customer_name,:mobile_number,:alt_number,:date_of_birth,:age,:reg_number,:patient_designation,:patient_sex)
      ");
      
      $query->bindValue(':customer_name',$customer_name);
      $query->bindValue(':mobile_number',$mobile_number);
      $query->bindValue(':alt_number',$alt_number);
      $query->bindValue(':date_of_birth',$date_of_birth);
      $query->bindValue(':age',$age);
      $query->bindValue(':reg_number',$reg_number);
      $query->bindValue(':patient_designation',$patient_designation);
      $query->bindValue(':patient_sex',$patient_sex);
    
      if($query->execute() == TRUE){
        header("location:../appointment/index.php?reg_number=".$reg_number);
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

<!--:::::::::::::::::::::::::::::::::::RESPONSE MESSAGE::::::::::::::::::::::::::::::::::::::::::::::::-->              
  <?php if (isset($_GET['success'])) { ?>
    <script type="text/javascript">
      swal("Good Job","Patient Registration Successful", "success");
    </script>
    
  <?php header("Refresh:3; url=index.php"); } ?>
<!--:::::::::::::::::::::::::::::::::::END OF RESPONSE MESSAGE:::::::::::::::::::::::::::::::::::::::::--> 


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1 class="text-center">
        Patient Registration
      </h1>
    </section>

  <!-- Main content -->
    <section class="content">
        <div class="row">
          <div class="col-sm-6 col-sm-offset-3">
            <div class="box">
              <div class="box-body">
                
                <form action="" method="post" class="form-horizontal">
                  
                  <!--PATIENT DESIGNATION-->
                    <div class="form-group">
                        <label for="" class="col-sm-4 col-form-label">Patient Designation</label></label>
                        <div class="col-sm-8">
                          <select name="patient_designation" id="" class="form-control" required>
                            <option value="">Choose Your Option</option>
                            <option value="Mr.">Mr.</option>
                            <option value="Miss">Miss.</option>
                            <option value="Mrs">Mrs.</option>
                            <option value="Baby">Baby</option>
                            <option value="Master">Master</option>
                          </select> 
                        </div>
                    </div>
                    
                  <!--PATIENT NAME-->
                    <div class="form-group">
                        <label for="" class="col-sm-4 col-form-label">Patient Name</label></label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control"  name="customer_name" required />  
                        </div>
                    </div>
                    
                  <!--DATE OF BIRTH-->  
                    <div class="form-group">
                        <label for="" class="col-sm-4 col-form-label">Date of Birth</label></label>
                        <div class="col-sm-8">
                            <input type="date" class=" form-control pull-right" name="date_of_birth" id="date_of_birth">
                        </div>
                    </div>
                    
                  <!--SEX-->  
                    <div class="form-group">
                        <label for="" class="col-sm-4 col-form-label">Sex</label></label>
                        <div class="col-sm-8">
                          <select name="patient_sex" id="" class="form-control" required>
                            <option value="">Choose Your Option</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                            <option value="Other">Other</option>
                          </select> 
                        </div>
                    </div>
                    
                  <!--MOBILE NUMBER-->  
                    <div class="form-group">
                        <label for="" class="col-sm-4 col-form-label">Mobile Number</label></label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control"  name="mobile_number" required />
                        </div>
                    </div>
                  
                  <!--ALT MOBILE NUMBER-->  
                    <div class="form-group">
                        <label for="" class="col-sm-4 col-form-label">Alt Mobile Number</label></label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control"  name="alt_number" required />  
                        </div>
                    </div>
                    
                  <!--LOCATION-->  
                    <div class="form-group">
                        <label for="" class="col-sm-4 col-form-label">Location</label></label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control"  name="location" required />  
                        </div>
                    </div>
                    
                  <!--REGISTRATION NUMBER-->  
                    <div class="form-group">
                        <label for="" class="col-sm-4 col-form-label">Registration Number</label></label>
                        <div class="col-sm-8">
                            <input readonly  type="text" class="form-control"  name="reg_number" value="<?php echo $registration_number; ?>"  required />
                        </div>
                    </div>
                    
                    <center>
                        <button class="btn btn-info" type="submit" name="create_patient">SAVE</button>
                    </center>
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
  
  
