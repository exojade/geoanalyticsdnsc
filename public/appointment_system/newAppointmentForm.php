<?php require("layouts/headerFrontPage.php"); ?>
<link href="public/static_system/assets/css/template/style.css" rel="stylesheet" />
  <!-- responsive style -->
<link href="public/static_system/assets/css/template/responsive.css" rel="stylesheet" />
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

   
</style>
<section class=" slider_section position-relative" style="padding:20px 45px 40px 45px !important;">
      <div class="slider_bg_box">
        <img src="public/static_system/assets/images/dogBackground.jpg" alt="">
      </div>
      <div class="container">
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
       
          <div class="carousel-inner">
            <div class="carousel-item active">
              <div class="row">
                <div class="col-md-6 col-lg-6">
                  <div class="detail-box">
                    <p style="font-size: 16px;">
                     <b><?php echo(date("F d, Y")); ?></b>
                     <br>
                     <br>
                     <b>Welcome to the City Veterinary Office Online Appointment System</b>
                     <br>
                     <br>
                     Before proceeding, please ensure you have registered using your Google email address as telemedicine appointments will be conducted via Google Meet. Review all fields in the online form carefully and provide complete and accurate information.
                     <br>
                     <br>
                     <b>TERMS and CONDITIONS:</b>
                     <br>
                     <br>
                     This system allocates slots based on veterinarian availability. Users must provide accurate information. If the desired date is unavailable, the office may reschedule it and notify you via email. By proceeding, you agree that your information may be used and disclosed by the City Veterinary Office per the “Data Privacy Act of 2012.”
                     <br>
                     <br>
                    </p>
                    <a class="google-btn btn-block" href="<?php echo($google->createAuthUrl()); ?>">
                <span class="text-center"><i class="fab fa-google google-icon"></i>
                Sign in with Google</span>
            </a>
            <br>
            <br>
                  </div>
                </div>
              </div>
            </div>
            
           
            
          </div>
        </div>

      </div>
    </section>

    <div class="gallery_section " style="background-color:#FF811B; padding :90px 45px !important;">
    
  </div>

    <style>
.wedo_section>*{
    color :#fff;
}
    </style>

  




<?php require("layouts/footerFrontPage.php"); ?>