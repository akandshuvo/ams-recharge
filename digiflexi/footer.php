



<!--NOTIFICATION-->
<div id="notification"></div>



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
  <script>

  $(function(){
    getAjaxRequest();
  });

  function getAjaxRequest(){
    $.ajax({
      method:'post',
      url:"/digiflexi/cron/notification.php",
      data:{data:"data"},
      success:function(result){
        $('#notification').html(result);
      },
      error:function(err){
         //error handler
      }
    });
    setTimeout(getAjaxRequest,5000); //call the same function every 1s.
  }
  </script>
