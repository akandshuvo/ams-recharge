
<?php

include('dbconfig.php');

function generateRandomString($length) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

if(isset($_POST['register'])){
  $fullname   = $_POST['name'];
  $username   = $_POST['user_name'];
  $email      = $_POST['email'];
  $password   = $_POST['password'];
  $activation_string = generateRandomString(128);

  $insert  = $conn->prepare("
  INSERT INTO user (full_name,username,email,password,user_level,balance,activation_string,status)
              VALUES(:full_name,:username,:email,:password,:user_level,:balance,:activation_string,:status)

  ");

  $insert->bindValue(':full_name',$fullname);
  $insert->bindValue(':username',$username);
  $insert->bindValue(':email',$email);
  $insert->bindValue(':user_level',2);
  $insert->bindValue(':password',$password);
  $insert->bindValue(':balance',0);
  $insert->bindValue(':activation_string',$activation_string);
  $insert->bindValue(':status',0);
  $insert->execute();



  /*mail*/

  require 'PHPMailer/PHPMailerAutoload.php';

  $mail = new PHPMailer;

  //$mail->SMTPDebug = 3;                               // Enable verbose debug output

  $mail->isSMTP();                                      // Set mailer to use SMTP
  $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
  $mail->SMTPAuth = true;                               // Enable SMTP authentication
  $mail->Username = 'akandshuvo@gmail.com';                 // SMTP username
  $mail->Password = 'chapuadevil*@25021992';                           // SMTP password
  $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
  $mail->Port = 587;                                    // TCP port to connect to

  $mail->setFrom('noreply@gmail.com','Digiflexi');
  $mail->addAddress('akandshuvo@gmail.com', 'Joe User');     // Add a recipient
  //$mail->addAddress('ellen@example.com');               // Name is optional
  //$mail->addReplyTo('info@example.com', 'Information');
  //$mail->addCC('cc@example.com');
  //$mail->addBCC('bcc@example.com');

  //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
  //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
  //$mail->isHTML(true);                                  // Set email format to HTML

  $mail->Subject = 'Account Activation - Digiflexi';
  $mail->Body    = 'Click the link for account activation. <a href="'.$_SERVER['HTTP_HOST'].'/digiflexi/register.php?activation='.$activation_string.'">Activation Link</a>';
  $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

  if(!$mail->send()) {
      echo 'Message could not be sent.';
      echo 'Mailer Error: ' . $mail->ErrorInfo;
  } else {
      //echo 'Message has been sent';
  }

  /*mail*/
}


if(isset($_GET['activation'])){
  $activation_string = $_GET['activation'];
  $update = $conn->query("UPDATE user SET status=1 WHERE activation_string='$activation_string'");
}

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>::digiflexi::</title>
  <?php include('header.php')?>


</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="#"><b>::digiflexi::</b></a>
  </div>

  <?php
      if (isset($_GET['error'])) {
  ?>
    <script type="text/javascript">
      swal("Oops...", "User ID or Password is Wrong!!!", "error");
    </script>
  <?php
      }
  ?>



  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Register</p>

    <form action="register.php" method="post">
      <div class="form-group has-feedback">
        <input type="text" class="form-control" name="name" placeholder="Your  Name">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>

      <div class="form-group has-feedback">
        <input type="text" class="form-control" name="user_name" placeholder="Your User Name">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>

      <div class="form-group has-feedback">
        <input type="email" class="form-control" name="email" placeholder="Your User Name">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>

      <div class="form-group has-feedback">
        <input type="password" class="form-control" name="password" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>

      <div class="row">
        <div class="col-xs-4 col-xs-offset-4">
          <button type="submit" class="btn btn-info btn-block btn-flat" name="register">Register</button>
        </div>
      </div>
    </form>
  </div>
</div>

<div class="row text-center">
  copyright <?php echo date("Y") ?> &copy; Digicon Technologies Ltd.
</div>

<!--INCLUDING FOOTER-->
<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 2.2.3 -->
<script src="/digiflexi/plugins/jQuery/jquery-2.2.3.min.js"></script>

<!-- Bootstrap 3.3.6 -->
<script src="/digiflexi/bootstrap/js/bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="/digiflexi/dist/js/app.min.js"></script>
<!-- DataTables -->
<script src="/digiflexi/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="/digiflexi/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script src="/digiflexi/plugins/datepicker/bootstrap-datepicker.js"></script>
<script>
  $(function () {
    $("#example1").DataTable({
      "scrollX": true
    });
    $("#subject_table").DataTable({
      "scrollX": true
    });
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });
  });
</script>
<script>
  //Date picker
    $('.datepicker').datepicker({
      autoclose: true,
    });
    $('.datepicker').datepicker('setDate', 'now');
</script>
<!--Form Validaation-->

<script type="text/javascript">

</script>
