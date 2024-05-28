<?php require("layouts/headerFrontPage.php"); ?>
<link rel="stylesheet" href="AdminLTE_new/plugins/fontawesome-free/css/all.min.css">
<style>
      .google-btn {
            background-color: #FF811B;
            color: #FFFFFF;
            border: none;
            border-radius: 25px;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            align-items: center;
            text-decoration: none;
        }
        .background {
            position: relative;
            height: 80vh;
        }
        .top-half {
            background-color: white;
            height: 75%;
            width: 100%;
        }
        .bottom-half {
            background-color: #3A81D3;
            height: 40%;
            width: 100%;
        }
        .dogs {
            position: absolute;
            bottom: 55%;
            left: 70%;
            transform: translate(-50%, 50%);
        }

        .liner {
            position: absolute;
            bottom: 60%;
            left: 5%;
            transform: translate(-50%, 50%);
        }

        .paws {
            position: absolute;
            bottom: 60%;
            left: 65%;
            transform: translate(-50%, 50%);
        }
        .content {
            position: absolute;
            top: 40%;
            right: 10%;
            transform: translateY(-50%);
        }
        h5{
            font-size:18px !important;
        }
    </style>

<div class="background">
        <div class="top-half">
        <div class="container content">
            <div class="row">
            <div class="col-md-6">
                    <!-- Content on the right -->
                    <!-- <h1><b>Welcome to Pet Care!</b></h1> -->
                    <h5><b><?php echo(date("F d, Y")); ?></b></h5>
                    <br>
                    <h5><b>Welcome to the City Veterinary Office Online Appointment System<b></h5>
                    <br>
                    <h5><b>Before proceeding, please ensure you have registered using your Google email address as telemedicine appointments will be conducted via Google Meet. Review all fields in the online form carefully and provide complete and accurate information.<b></h5>
                    <h5><b>TERMS and CONDITIONS:<b></h5>
                    <br>
                    <h5><b>This system allocates slots based on veterinarian availability. Users must provide accurate information. If the desired date is unavailable, the office may reschedule it and notify you via email. By proceeding, you agree that your information may be used and disclosed by the City Veterinary Office per the “Data Privacy Act of 2012.”<b></h5>
                <br>
                <a class="google-btn btn-block" href="<?php echo($google->createAuthUrl()); ?>">
                <span class="text-center"><i class="fab fa-google google-icon"></i>
                Sign in with Google</span>
            </a>
                
                </div>
                <div class="col-md-4">
                    <!-- This column is intentionally left blank or can contain some other content -->
                </div>
               
            </div>
        </div>
        </div>
        <div class="bottom-half"></div>
        <img style="width: 750px;" src="public/static_system/assets/images/dogs.png" class="dogs" alt="Cat Image">
        
    </div>




<?php require("layouts/footerFrontPage.php"); ?>