<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>::LABAID::</title>
  <?php include('header.php')?>


</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="#"><b>::LABAID::</b></a>
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
    <p class="login-box-msg">Sign in to start your session</p>

    <form action="/labaid/scripts/checklogin.php" method="post">
      <div class="form-group has-feedback">
        <input type="text" class="form-control" name="user_id" placeholder="Your User ID">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" name="password" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div>
        <!-- /.col -->
      </div>
    </form>
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<div class="row text-center">
  copyright <?php echo date("Y") ?> &copy; Digicon Technologies Ltd.
</div>

<!--INCLUDING FOOTER-->
<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 2.2.3 -->
<script src="/labaid/plugins/jQuery/jquery-2.2.3.min.js"></script>

<!-- Bootstrap 3.3.6 -->
<script src="/labaid/bootstrap/js/bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="/labaid/dist/js/app.min.js"></script>
<!-- DataTables -->
<script src="/labaid/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="/labaid/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script src="/labaid/plugins/datepicker/bootstrap-datepicker.js"></script>
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