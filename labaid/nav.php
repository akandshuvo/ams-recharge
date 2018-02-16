
<?php
  session_start();
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
        <a class="navbar-brand" style="position: absolute;left: 50%;margin-left: -50px !important;display: block;" href="#">LABAID</a>
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
              <img src="/labaid/dist/img/avatar.png" class="user-image" alt="User Image">
              <!-- hidden-xs hides the username on small devices so only the image appears. -->
              <span class="hidden-xs"><?php echo $_SESSION['full_name']?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- The user image in the menu -->
              <li class="user-header">
                <img src="/labaid/dist/img/avatar.png" class="img-circle" alt="User Image">

                <p>
                  <?php echo $_SESSION['full_name']?>
                </p>
              </li>
              <!-- Menu Body -->
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                <a href="/labaid/user/change_password.php" class="btn btn-default btn-flat">Change Password</a>
                </div>
                <div class="pull-right">
                  <a href="/labaid/scripts/log_out.php" class="btn btn-default btn-flat">Sign out</a>
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
          <img src="/labaid/dist/img/avatar.png" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $_SESSION['full_name']?></p>
        </div>
      </div>


      <!-- Sidebar Menu -->
      <ul class="sidebar-menu">
        <li class="header">Navigation</li>
        <!-- Optionally, you can add icons to the links -->
        <li class=""><a href="/labaid/dashboard.php"><i class="fa fa-map"></i><span>Dashboard</span></a></li>
        
        <?php if($_SESSION['user_level']==1):?>    
          <li class="treeview">
            <a href="#"><i class="fa fa-user"></i> <span>Patient</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="/labaid/customer/index.php">New Patient</a></li>
              <li><a href="/labaid/customer/old_patient.php">Existing Patient</a></li>
            </ul>
          </li>
        <?php endif ?> 
        
        <?php if($_SESSION['user_level']==1 || $_SESSION['user_level']==4):?>    
          <li class="treeview">
            <a href="#"><i class="fa fa-pencil"></i> <span>Appointment</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="/labaid/appointment/index.php">New Appointment</a></li>
              <li><a href="/labaid/appointment/pending.php">Pending Appointment</a></li>
            </ul>
          </li>
        <?php endif ?> 
        
        <?php if($_SESSION['user_level']==1):?>    
          <li class="treeview">
            <a href="#"><i class="fa fa-clock-o"></i> <span>Scheduling</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="/labaid/scheduling/index.php">New Schedule</a></li>
              <li><a href="/labaid/scheduling/calender.php">View Schedule</a></li>
              <li><a href="/labaid/scheduling/reschedule.php">Reschedule</a></li>
            </ul>
          </li>
        <?php endif ?> 
        

        
        <?php if($_SESSION['user_level']==1):?>    
          <li class="treeview">
            <a href="#"><i class="fa fa-eye"></i> <span>View</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="/labaid/user/doctor_profile.php">Doctor</a></li>
              <li><a href="/labaid/user/new_doctor.php">Agent</a></li>
            </ul>
          </li>
        <?php endif ?> 
        
        
        <?php if($_SESSION['user_level']==1):?>    
          <li class="treeview">
            <a href="#"><i class="fa fa-users"></i> <span>Users</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="/labaid/user/index.php">Create User</a></li>
              <li><a href="/labaid/user/new_doctor.php">Create Doctor Profile</a></li>
            </ul>
          </li>
        <?php endif ?> 
        
        <?php if($_SESSION['user_level']==1):?>    
          <li class="treeview">
            <a href="#"><i class="fa fa-cogs"></i> <span>Setup</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="/labaid/setup/index.php#branch">Create New Branch</a></li>
              <li><a href="/labaid/setup/index.php#department">Create New Department</a></li>
            </ul>
          </li>
        <?php endif ?> 

        <?php if($_SESSION['user_level']==1):?>    
          <li class="treeview">
            <a href="#"><i class="fa fa-bar-chart"></i> <span>Reports</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="/labaid/reports/index.php">Basic Report</a></li>
            </ul>
          </li>
        <?php endif ?> 

      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>
