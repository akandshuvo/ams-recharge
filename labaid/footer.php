
  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <!-- Default to the left -->
    <strong>Copyright &copy; <?php echo date("Y")?> <a href="#">Digicon Technologies Ltd</a>.</strong> All rights reserved.
  </footer>

  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>

<div id="notification">


</div>
<!-- ./wrapper -->

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
<!--<script src="/labaid/appointment/scripts.js"></script>-->
<script>
  $(function () {
    $("#example1").DataTable({
    });

    $("#dashboard_agent").DataTable({
      "order": [[ 3, 'desc' ]]
    });
    $("#dashboard_branch").DataTable({
      "order": [[ 2, 'desc' ]]
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
<script>

$(function(){
  getAjaxRequest();
});

function getAjaxRequest(){
  $.ajax({
    method:'post',  
    url:"/labaid/cron/notification.php",
    data:{data:"data"},
    success:function(result){
      $('#notification').html(result);
    },
    error:function(err){
       //error handler
    } 
  });
  setTimeout(getAjaxRequest,3000); //call the same function every 1s.
}

</script>

