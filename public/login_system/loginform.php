<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Panabo City Vet</title>
  <link rel="icon" href="public/static_system/uploads\logocityvet.png">

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="AdminLTE_new/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="AdminLTE_new/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="AdminLTE_new/dist/css/adminlte.min.css">
</head>

<style>
  .google-btn {
            background-color: #3A81D3;
            color: #FFFFFF;
            border: none;
            border-radius: 25px;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            align-items: center;
            text-decoration: none;
        }

        .rounded-btn{
            background-color: #84BA26;
            color: #FFFFFF;
            border: none;
            border-radius: 25px;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            align-items: center;
            text-decoration: none;
            text-align: center;
        }

        .google-icon {
            margin-right: 10px;
        }
</style>
<body class="hold-transition login-page" style='

background-image: url("public/static_system/assets/images/background_latest.jpg") !important;
background-size: 100% auto;
      background-position: center !important;
      background-repeat: no-repeat;
'>
<div class="login-box" style="width:40%;">
  <!-- /.login-logo -->
  <div class="card card-outline" style="border-radius:50px; box-shadow: 0 0 0 10px rgba(0, 0, 0, 0.1);">
    <div class="card-header text-center" style="border-bottom: 0px;">
    <center>
                <!-- <img src="public/static_system/uploads/LGUlogo.png" height="100" style="margin: 5px;"> -->
                <img src="public/static_system/uploads/logocityvet.png" height="100" style="margin: 5px;">
            </center>

        
    </div>
    
    <div class="card-body text-center" >
    <h1><b>LOGIN</b></h1>
        <div class="row">
            <div class="col-md-3">

            </div>
            <div class="col-md-6 text-center">

            <form action="AdminLTE_new/index3.html" method="post">
            <br>
            <a class="google-btn btn-block" href="<?php echo($google->createAuthUrl()); ?>">
                <span class="text-center"><i class="fab fa-google google-icon"></i>
                Sign in with Google</span>
            </a>
                <a class="rounded-btn btn-block" href="home"><span class="text-center">Go back to website</span></a>
     <br>
     <br>
            </form>

   

            </div>
            <div class="col-md-3">

            </div>
        </div>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="AdminLTE_new/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="AdminLTE_new/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="AdminLTE_new/dist/js/adminlte.min.js"></script>
</body>
</html>
