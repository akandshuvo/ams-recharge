
<?php
  session_start();
  include ('dbconfig.php');
?>


  <!-- Main Header -->
  <header class="main-header" style="background-color:#fff !important;">

    <!-- Logo -->
    <a style="background-color:#4A148C !important;" class="logo">
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top skin-purple" style="background-color:#4A148C !important;" role="navigation">

      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <center>
      <div class="navbar-header">
        <a class="navbar-brand" style="position: absolute;left: 50%;margin-left: -50px !important;display: block;" href="#">digiflexi</a>
      </div>
      </center>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">

        <ul class="nav navbar-nav">
          <!-- User Account Menu -->
          <li class="dropdown user user-menu">
            <!-- Menu Toggle Button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <!-- The user image in the navbar-->
              <img src="/digiflexi/dist/img/avatar.png" class="user-image" alt="User Image">
              <!-- hidden-xs hides the username on small devices so only the image appears. -->
              <span class="hidden-xs">
                <?php
                  echo $_SESSION['full_name'];
                ?>
              </span>
            </a>
            <ul class="dropdown-menu">
              <!-- The user image in the menu -->
              <li class="user-header">
                <img src="/digiflexi/dist/img/avatar.png" class="img-circle" alt="User Image">
                <p>
                  <?php echo $_SESSION['full_name'];?>
                </p>
                <p>
                  <?php
                    $username =$_SESSION['username'];
                    $balance = $conn->query("SELECT balance from user WHERE username='$username' ")->fetchColumn();
                    echo "Your Balanace is TK $balance";
                  ?>
                </p>
              </li>
              <!-- Menu Body -->
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                <a href="/digiflexi/user/change_password.php" class="btn btn-default btn-flat">Change Password</a>
                </div>
                <div class="pull-right">
                  <a href="/digiflexi/scripts/log_out.php" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="/digiflexi/dist/img/avatar.png" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $_SESSION['full_name']?></p>
        </div>
      </div>


      <!-- Sidebar Menu -->
      <ul class="sidebar-menu">
        <li class="header">Navigation</li>
        <!-- Optionally, you can add icons to the links -->
        <li class=""><a href="/digiflexi/dashboard.php"><i class="fa fa-map"></i><span>Dashboard</span></a></li>

        <?php //if($_SESSION['user_level']==1):?>
          <li class="treeview">
            <a href="#"><i class="fa fa-money"></i> <span>Recharge</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="/digiflexi/merchant/single_recharge.php">Single Recharge</a></li>
              <li><a href="/digiflexi/merchant/bulk_recharge.php">Bulk Recharge</a></li>
              <li><a href="/digiflexi/merchant/recharge_status.php">Recharge Status</a></li>
            </ul>
          </li>
        <?php //endif ?>


        <?php //if($_SESSION['user_level']==1):?>
          <li class="treeview">
            <a href="#"><i class="fa fa-bar-chart"></i> <span>Reports</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="/digiflexi/reports/view.php">View Report</a></li>
              <li><a href="/digiflexi/reports/index.php">Download Report</a></li>
              <?php if($_SESSION['user_level']==1):?>
                <li><a href="/digiflexi/reports/balance_allocation.php">Balance Report</a></li>
              <?php endif ?>
              <?php if($_SESSION['user_level']==2):?>
                <li><a href="/digiflexi/reports/balance_allocation.php">Balance Report</a></li>
              <?php endif ?>
            </ul>
          </li>
        <?php //endif ?>

        <?php if($_SESSION['user_level']==1):?>
          <li class="treeview">
            <a href="#"><i class="fa fa-cogs"></i> <span>Setup</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="/digiflexi/user/index.php">User Management</a></li>
            </ul>
          </li>
        <?php endif; ?>





      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>
