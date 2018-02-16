<?php
//SESSION,DB CONNECTION,OTHER QUERIES
 include ('../dbconfig.php'); // database connection
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


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1 class="text-center">
        Customer Information
      </h1>
    </section>

  <!-- Main content -->
    <section class="content">
        <div class="row">
          <div class="box">
            <div class="box-body">
                <label class="r" for="states">This label is stacked above the select</label>
                <div class="button dropdown"> 
                  <select id="colorselector">
                     <option value="red">Red</option>
                     <option value="yellow">Yellow</option>
                     <option value="blue">Blue</option>
                  </select>
                </div>
                
                <div class="output">
                  <div id="red" class="colors red" style="display:none">  “Good artists copy, great artists steal” Pablo Picasso</div>
                  <div id="yellow" class="colors yellow" style="display:none"> “Art is the lie that enables us to realize the truth” Pablo Picasso</div>
                  <div id="blue" class="colors blue" style="display:none"> “If I don't have red, I use blue” Pablo Picasso</div>
                </div>
            </div>
          </div>
      </div>
    </section>
  </div>
  <!-- /.content-wrapper -->
  
  <script type="text/javascript">
    $(function() {
          $('#colorselector').change(function(){
            $('.colors').hide();
            $('#' + $(this).val()).show();
          });
    });
  </script>
      
  
<!--INCLUDING FOOTER-->
  <?php include('../footer.php');?>
  
  
