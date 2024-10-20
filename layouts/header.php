<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>PET SYSTEM</title>

  <?php
  $siteOptions = query("select * from siteoptions");
  $siteOptions = $siteOptions[0];
  ?>

  <!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback"> -->
  <link rel="stylesheet" href="AdminLTE_new/plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="AdminLTE_new/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <link rel="stylesheet" href="AdminLTE_new/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="AdminLTE_new/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <link rel="stylesheet" href="resources/animate.css" />
  <link rel="icon" href="<?php echo($siteOptions["mainLogo"]); ?>">
</head>

<style>
@keyframes inside-out {
    0% {
        transform: scale(0); /* Start from scale 0 */
        opacity: 0; /* Fully transparent */
    }
    100% {
        transform: scale(1); /* End at original size */
        opacity: 1; /* Fully opaque */
    }
}

.modal.fade .modal-dialog {
    transition: transform 0.2s ease-out, opacity 0.2s ease-out; /* Smooth transition for scale */
}

.modal.show .modal-dialog {
    animation: inside-out 0.2s forwards; /* Apply the animation on show */
}

.modal.hide .modal-dialog {
    animation: inside-out 0.2s reverse forwards; /* Reverse animation for hide */
}
    </style>
<style>
  .content-wrapper{
    background-color: #fff !important;
  } 
  .navbar-light{
    border-bottom: none !important;
    background-color: #fff !important;
  }
  .color-red{
    color:red;
  }
</style>
<body class="hold-transition sidebar-mini layout-fixed">
<!-- Site wrapper -->
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-light navbar-light" >
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <h5 style="
    padding: .5rem 1rem !important; margin: 0 !important;">Welcome <?php echo($_SESSION["dnsc_geoanalytics"]["fullname"]); ?></h5>
    <!-- <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
   
    </ul> -->


    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      

      <!-- Messages Dropdown Menu -->
     
      <!-- Notifications Dropdown Menu -->

      <?php if($_SESSION["dnsc_geoanalytics"]["role"] == "admin"): ?>
      <li class="nav-item">
        <a class="nav-link"  href="settings">
          <i class="text-primary fas fa-cog" title="Settings"></i>
        </a>
      </li>
      <?php endif; ?>



      <li class="nav-item">
        <a class="nav-link"  href="logout">
          <i class="text-danger fas fa-sign-out-alt" title="Logout System"></i>
        </a>
        <!-- <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">15 Notifications</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> 4 new messages
            <span class="float-right text-muted text-sm">3 mins</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-users mr-2"></i> 8 friend requests
            <span class="float-right text-muted text-sm">12 hours</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-file mr-2"></i> 3 new reports
            <span class="float-right text-muted text-sm">2 days</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div> -->
      </li>
      <!-- <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li> -->
      <!-- <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-controlsidebar-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li> -->
    </ul>
  </nav>

  
<script src="AdminLTE_new/plugins/jquery/jquery.min.js"></script>
<script src="AdminLTE_new/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Bootstrap 4 -->
<script src="AdminLTE_new/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="AdminLTE_new/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="AdminLTE_new/dist/js/adminlte.min.js"></script>
<!-- <script src="AdminLTE/bower_components/jquery-ui/jquery-ui.min.js"></script> -->
<!-- AdminLTE for demo purposes -->


