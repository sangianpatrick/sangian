<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="NursingRP">
  <meta name="keywords" content="Research Project, Computer Science, Unklab, Nurse">
  <meta name="author" content="Patrick Maurits Sangian">
  <title><?php echo $title;?></title>
  <link rel="shortcut icon" href="<?php echo base_url();?>assets/logo.ico" />
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?php echo base_url('assets/');?>bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url('assets/font-awesome/');?>css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url('assets/ionicons/');?>css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url('assets/');?>dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo base_url('assets/');?>dist/css/skins/_all-skins.min.css">
  <link rel="stylesheet" href="<?php echo base_url('assets/');?>plugins/datatables/dataTables.bootstrap.css">
  <link rel="stylesheet" href="<?php echo base_url('assets/');?>plugins/iCheck/all.css">
  <!-- Bootstrap time Picker -->
  <link rel="stylesheet" href="<?php echo base_url('assets/');?>plugins/timepicker/bootstrap-timepicker.min.css">
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="<?php echo base_url('assets/');?>plugins/datepicker/datepicker3.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition skin-blue sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="<?php echo site_url('dashboard');?>" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>N</b>RP</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Nursing</b>RP</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <?php if($_SESSION['sess_gender'] == "M"):?>
                  <img src="<?php echo base_url('assets/');?>dist/img/avatar5.png" class="user-image" alt="User Image">
                <?php elseif($_SESSION['sess_gender'] == "F"):?>
                  <img src="<?php echo base_url('assets/');?>dist/img/avatar2.png" class="user-image" alt="User Image">
                <?php endif;?>
                <span class="hidden-xs"><?php echo $this->session->userdata('sess_fullname');?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <?php if($_SESSION['sess_gender'] == "M"):?>
                  <img src="<?php echo base_url('assets/');?>dist/img/avatar5.png" class="img-circle" alt="User Image">
                <?php elseif($_SESSION['sess_gender'] == "F"):?>
                  <img src="<?php echo base_url('assets/');?>dist/img/avatar2.png" class="img-circle" alt="User Image">
                <?php endif;?>

                <p>
                  <?php echo $this->session->userdata('sess_fullname');?> -
                  <?php
                      switch ($_SESSION['sess_userlevel']) {
                        case '1':
                          echo "Administrator";
                          break;
                        case '2':
                          echo "Lecturer/";
                          if($_SESSION['sess_role']==1){
                            echo "Dean";
                          }elseif($_SESSION['sess_role']==2){
                            echo "HoP";
                          }elseif($_SESSION['sess_role']==3){
                            echo "Lecturer";
                          }elseif($_SESSION['sess_role']==4){
                            echo "Secretary";
                          }
                          break;
                        case '3':
                          echo "Student";
                          break;
                      }
                  ?>
                </p>
              </li>
              <li class="user-footer">
                <div >
                  <a href="<?php echo site_url('signout');?>" class="btn btn-default  btn-flat btn-block">Signout</a>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>

  <!-- =============================================== -->

  <!-- Left side column. contains the sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
                <?php if($_SESSION['sess_gender'] == "M"):?>
                  <img src="<?php echo base_url('assets/');?>dist/img/avatar5.png" class="img-circle" alt="User Image">
                <?php elseif($_SESSION['sess_gender'] == "F"):?>
                  <img src="<?php echo base_url('assets/');?>dist/img/avatar2.png" class="img-circle" alt="User Image">
                <?php endif;?>
        </div>
        <div class="pull-left info">
          <p><?php echo $this->session->userdata('sess_fullname');?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
          <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>
        <?php if($_SESSION['sess_userlevel'] == 1):?>
        <li><a href="<?php echo site_url('admin/dashboard');?>"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
        <li><a href="<?php echo site_url('admin/manage_lecturer_staff');?>"><i class="fa fa-user"></i> <span>Manage Lecturer/Staff</span></a></li>
        <li><a href="<?php echo site_url('admin/manage_student');?>"><i class="fa fa-user"></i> <span>Manage Student</span></a></li>
        <li><a href="<?php echo site_url('admin/post_defense');?>"><i class="fa fa-book"></i> <span>Post Defense</span></a></li>
        <?php endif;?>

        <?php if($_SESSION['sess_userlevel'] == 2):?>
        <li><a href="<?php echo site_url('lecturer/dashboard');?>"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
        <li><a href="<?php echo site_url('lecturer/research_project/apprentices');?>"><i class="fa fa-user"></i> <span>My Apprentices</span></a></li>
        <li><a href="<?php echo site_url('lecturer/research_project/panelist');?>"><i class="fa fa-user"></i> <span>Panelist</span></a></li>

        <?php endif;?>
        <?php if($_SESSION['sess_userlevel'] == 2 && $_SESSION['sess_role'] == 1):?>
          <li><a href="<?php echo site_url('lecturer/view_students');?>"><i class="fa fa-user"></i> <span>View Students</span></a></li>
          <li class="treeview active">
            <a href="#">
              <i class="fa fa-folder"></i> <span>Research Project</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="<?php echo site_url('lecturer/research_project/defense_schedule');?>"><i class="fa fa-circle-o"></i> Defense Schedule</a></li>
            </ul>
          </li>
        <?php endif;?>
        <?php if($_SESSION['sess_userlevel'] == 2 && $_SESSION['sess_role'] == 2):?>
        <li><a href="<?php echo site_url('lecturer/view_students');?>"><i class="fa fa-user"></i> <span>View Students</span></a></li>
        <li class="treeview active">
          <a href="#">
            <i class="fa fa-folder"></i> <span>Research Project</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo site_url('lecturer/research_project/submission');?>"><i class="fa fa-circle-o"></i> Submission</a></li>
            <li><a href="<?php echo site_url('lecturer/research_project/defense_schedule');?>"><i class="fa fa-circle-o"></i> Defense Schedule</a></li>
          </ul>
        </li>

        <?php endif;?>

        <?php if($_SESSION['sess_userlevel'] == 3):?>
        <li><a href="<?php echo site_url('student/dashboard');?>"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
        <li><a href="<?php echo site_url('student/rp_submission');?>"><i class="fa fa-send"></i> <span>Topic's Submission</span></a></li>
        <li><a href="<?php echo site_url('student/defense_schedule');?>"><i class="fa fa-calendar"></i> <span>Defense Schedule</span></a></li>
        <?php endif;?>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
