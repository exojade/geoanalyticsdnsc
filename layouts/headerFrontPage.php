<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<?php
$siteOptions = query("select * from siteoptions");
$siteOptions = $siteOptions[0];
?>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>HDMS</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="AdminLTE_new/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="AdminLTE_new/dist/css/adminlte.min.css">
  <link rel="icon" href="<?php echo($siteOptions["mainLogo"]); ?>">
</head>
<?php
$currentUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$path = parse_url($currentUrl, PHP_URL_PATH);
$lastWord = basename($path);
?>
<body class="hold-transition layout-top-nav">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
    <div class="container">
      <a href="index" class="navbar-brand">
        <img src="<?php echo($siteOptions["mainLogo"]); ?>" style="width: 80px; height: 80px;" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      </a>

      <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse order-3" id="navbarCollapse">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
        <li class="nav-item">
                        <a class="nav-link <?php echo ($lastWord == 'home') ? 'active' : ''; ?>" aria-current="page" href="home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo ($lastWord == 'newAppointment') ? 'active' : ''; ?>" href="newAppointment">Appointment</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo ($lastWord == 'ourServices') ? 'active' : ''; ?>" aria-current="page" href="ourServices">Our Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo ($lastWord == 'aboutUs') ? 'active' : ''; ?>" aria-current="page" href="aboutUs">About Us</a>
                    </li>
                    <li class="nav-item">
                        <!-- <a class="nav-link <?php echo ($lastWord == 'contactUs') ? 'active' : ''; ?>" aria-current="page" href="contactUs">Contact Us</a> -->
                    </li>

                    <a class="nav-link mr-30" href="login" id="navbarDarkDropdownMenuLink" >
                        Personnel Login
                    </a>
        </ul>

        <!-- SEARCH FORM -->

      </div>

      <!-- Right navbar links -->
    </div>
  </nav>