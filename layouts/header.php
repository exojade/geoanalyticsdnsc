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
  <link rel="stylesheet" href="AdminLTE_new/plugins/bs-stepper/css/bs-stepper.min.css">
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


  <div class="modal fade" id="modalNewUserGuide">
          <div class="modal-dialog modal-xl">
            <div class="modal-content ">
              <div class="modal-header bg-primary">
					    <h3 class="modal-title text-center">User's Guide</h3>
              </div>
              <div class="modal-body" style="-webkit-user-select: none;  /* Chrome all / Safari all */
              -moz-user-select: none;     /* Firefox all */
              -ms-user-select: none;  ">
                  <div class="bs-stepper" id="stepperExample">
                          <div class="bs-stepper-header" role="tablist">
                            <!-- Step 1 -->
                            <div class="step" data-target="#step-1">
                              <button type="button" class="step-trigger" role="tab" id="step-1-trigger" aria-controls="step-1">
                                <span class="bs-stepper-circle">1</span>
                              </button>
                            </div>
                            <div class="line"></div>
                            <div class="step" data-target="#step-2">
                              <button type="button" class="step-trigger" role="tab" id="step-2-trigger" aria-controls="step-2">
                                <span class="bs-stepper-circle">2</span>
                              </button>
                            </div>
                            <div class="line"></div>
                            <div class="step" data-target="#step-3">
                              <button type="button" class="step-trigger" role="tab" id="step-3-trigger" aria-controls="step-3">
                                <span class="bs-stepper-circle">3</span>
                              </button>
                            </div>
                          </div>
                          <div class="bs-stepper-content">
                            <!-- Step 1 Content -->
                            <div id="step-1" class="content" role="tabpanel" aria-labelledby="step-1-trigger">
                            <b>Hello, Good Day!</b>
                            <br>
                            <br>
                            In accordance to Data Privacy act of 2012, it is a crucial law in the Philippines that regulates the processing of personal information to protect privacy rights. This article delves into the Act’s requirements, the responsibilities it imposes on businesses and individuals, and its impact on data protection.
                            <br>
                            <br>
                            <b>WORKFLOW OF THE SYSTEM:</b>
                            <br>
                            <br>
                            It is essential to complete the form provided. So, before you can proceed to the system, please ensure all the required fields are filled out accurately.
                            <br>
                            <br>
                            <b>Step 1. Making Profile for the Pet Owners</b>
                            Fill out all the necessary fields in the forms and after filling out, you will be redirected to adding of pets or simply by                                      choosing/clicking "My Pets" in the left sidebar part of the system.
                            <br>
                            <br>
                            <b>Step2: Adding of Pets</b>
                            Fill out all the needed information for the pets and by filling out the important demographic information of your pet and upload a profile picture of it, you must submit the form or just by clicking the "Save Changes" button it will automatically be added on the list of "My Pets".
                            <br>
                            <br>
                            You can also "Update" the existing records of your pet and "Visit" the corresponding medical records.
                            <br>
                            <br>
                            <b>Step 3: Booking an Appointments</b>
                            In adapting Telemedicine capabilities, the Panabo City Vet offers Online Check-up Services. 
                            <br>
                            <br>
                            By clicking the <b>"Book an Appointment"</b> it will prompt you a form for telemedicine services, make sure to make an appointment in order to give the doctor a heads up on the transaction you are availing. 
                            <br>
                            <br>  
                            <button class="btn btn-primary" onclick="stepper.next()">Next</button>
                            </div>

                            <!-- Step 2 Content -->
                            <div id="step-2" class="content" role="tabpanel" aria-labelledby="step-2-trigger">

                            <b>Hello, Good Day!</b>
                            <br>
                            <br>
                            In accordance to Data Privacy act of 2012, it is a crucial law in the Philippines that regulates the processing of personal information to protect privacy rights. This article delves into the Act’s requirements, the responsibilities it imposes on businesses and individuals, and its impact on data protection.
                            <br>
                            <br>
                            <b>WORKFLOW OF THE SYSTEM:</b>
                            <br>
                            <br>
                            <b>Step 4: Appointment Date</b>
                            Choose your desired appointment date, book an available time slot, and make a note to give the doctor a heads-up beforehand. Click the <b>"Save Changes"</b> button to save the appointment you made.
                            <br>
                            <br>
                            After you click <b>"Save Changes"</b> and successfully submit the appointment, it will be sent directly to the Admin interface, where they will review and approve it. Please check your account regularly for updates.
                            <br>
                            <br>
                            Once your appointment is approved, its status will change to <b>"ONGOING."</b> After the appointment is completed, the status will update to <b>"DONE."</b> You will also receive a notification with your appointment schedule 1 hour before your allotted time and the <b>“Google Meet Link”</b> will be available.
                            <br>
                            <br>
                            Hence, if your appointment is rescheduled it will show on the status <b>"ONGOING"</b> but there will be changes on your appointment date. 
                            <br>
                            <br>
                            Once your appointment is not approved, it will show on your status <b>"DONE"</b> and has a note form the Doctor assigned.
                            <br>
                            <br>
                              
                            <button class="btn btn-primary" onclick="stepper.next()">Next</button>
                            </div>


                            <div id="step-3" class="content" role="tabpanel" aria-labelledby="step-3-trigger">
                            <b>Hello, Good Day!</b>

                            <br>
                            <br>

                            In accordance to Data Privacy act of 2012, it is a crucial law in the Philippines that regulates the processing of personal information to protect privacy rights. This article delves into the Act’s requirements, the responsibilities it imposes on businesses and individuals, and its impact on data protection.
                            <br>
                            <br>
                            <b>WORKFLOW OF THE SYSTEM:</b>
                            <br>
                            <br>
                            <b>Step 5: Pet Boarding (Walk in Reservation)</b>
                            Once done on your appointment, you can also book a reservation slot for Walk-in services. This will ensure that you will be catered anytime of the day in the City Vet Facility. 
                            <br>
                            <br>
                            By clicking the <b>"ADD NEW"</b> button it will prompt you a form to input all the important dates of your Walk-in schedule and submit it, and wait for the approval of the admin. You can also delete just by clicking the "X" button on the action row. 
                            <br>
                            <br>
                            Once approved, the status of your walk-in schedule will change into <b>"ONGOING"</b>. Hence, declined the status of your scheduled walk-in will be "DECLINED". 
                            <br>
                            <br>
                            If the scheduled walk-in is completed, the status will change to "DONE".
                            <br>
                            <br>


                                                        
                              
                              <button class="btn btn-primary" onclick="stepper.previous()">Previous</button>
                              <button class="btn btn-danger" data-dismiss="modal" aria-label="Close">Close</button>
                            </div>
                          </div>
                        </div>
              </div>
            </div>
          </div>
        </div>



        <div class="modal fade" id="modalUserGuideAdmin">
          <div class="modal-dialog modal-xl">
            <div class="modal-content ">
              <div class="modal-header bg-primary">
					    <h3 class="modal-title text-center">User's Guide (ADMIN)</h3>
              </div>
              <div class="modal-body" style="-webkit-user-select: none;  /* Chrome all / Safari all */
              -moz-user-select: none;     /* Firefox all */
              -ms-user-select: none;  ">
                  <div class="bs-stepper admin-stepper" id="stepperExample">
                          <div class="bs-stepper-header" role="tablist">
                            <!-- Step 1 -->
                            <div class="step" data-target="#step-1">
                              <button type="button" class="step-trigger" role="tab" id="step-1-trigger" aria-controls="step-1">
                                <span class="bs-stepper-circle">1</span>
                              </button>
                            </div>
                            <div class="line"></div>
                            <div class="step" data-target="#step-2">
                              <button type="button" class="step-trigger" role="tab" id="step-2-trigger" aria-controls="step-2">
                                <span class="bs-stepper-circle">2</span>
                              </button>
                            </div>
                            <div class="line"></div>
                            <div class="step" data-target="#step-3">
                              <button type="button" class="step-trigger" role="tab" id="step-3-trigger" aria-controls="step-3">
                                <span class="bs-stepper-circle">3</span>
                              </button>
                            </div>
                            <div class="line"></div>
                            <div class="step" data-target="#step-4">
                              <button type="button" class="step-trigger" role="tab" id="step-4-trigger" aria-controls="step-4">
                                <span class="bs-stepper-circle">4</span>
                              </button>
                            </div>
                          </div>
                          <div class="bs-stepper-content">
                            <!-- Step 1 Content -->
                            <div id="step-1" class="content" role="tabpanel" aria-labelledby="step-1-trigger">
                            <b>WORKFLOW OF THE SYSTEM:</b>
                            <br>
                            <br>
                            <b>Step 1: Landing Page</b><br>
                            Once the admin enters the system, they will land on the Dashboard page, where assigned admins can monitor the diseases present in Panabo City.
                            <br>
                            <br>
                            <b>Step 2: By selecting one or more diseases, the corresponding areas will be displayed on the map, showing the cases with their respective color coding.</b>
                            <br>
                            For data visualization, the admin can filter the data by month, year, and the types of cases present in Panabo City.
                            <br>
                            <br>
                            <b>*PET PATIENTS*</b>
                            <br>
                            If a pet owner does not have any existing records, the assigned admin can create a profile for them. 
                            <br>
                            <br>
                            <b>Step 3: Click the "ADD NEW CLIENT" and fill out all the required fields, and once submitted, the system will redirect to the pet addition page.</b>
                            <br>
                            When adding pets, it is important to collect all necessary demographic information.
                            <br>
                            <br>
                            <b>Step 4: Input all the information needed and after entering the details, click the "Save Changes" button to successfully submit the information.</b>
                            <br>
                            The admin can also update existing records and view medical records by selecting the "Update" or "Visit" options, respectively.
                            <br>
                            The admin can also export the data to EXCEL, PDF, or PRINT.
                            <br>
                            <br>
                            <b>*APPOINTMENT*</b>
                            <br>
                            When a user books an appointment, it will be sent directly to the Admin Interface. 
                            <br>
                            <br>
                            <button class="btn btn-primary" onclick="stepper.next()">Next</button>
                            </div>

                            <!-- Step 2 Content -->
                            <div id="step-2" class="content" role="tabpanel" aria-labelledby="step-2-trigger">

                            <b>WORKFLOW OF THE SYSTEM:</b>
                            <br>
                            <br>
                            <b>Step 5: The admin will then decide whether to approve, decline, or reschedule the appointment.</b>
                            <br>
                            The admin can also schedule a same-day walk-in appointment for a pet owner visiting the vet by clicking the "ADD WALK-IN" button. 
                            <br>
                            <br>
                            <b>Step 6: After clicking, the admin can select a registered client, assign a doctor, and choose a time slot.</b>
                            <br>
                            Once submitted, the Doctor will approve the same-day walk-in appointment. 
                            <br>
                            <br>
                            <b>*PET BOARDING*</b><br>
                            Step 7: The admin can add a walk-in pet boarding request by clicking the "ADD WALK-IN" button, which will set the status to "PENDING." Enter all the required information and submit it. Once the pet boarding time is completed, the admin can update the status to "DONE."
                            <br>
                            <br>
                            <b>*CALENDAR*</b>
                            <br>
                            The calendar of the admin can preview all the appointments the doctor has, especially the Online check-up services.
                            <br><br>
                            <b>Step 8:</b> By clicking an appointment in the calendar it will prompt a modal in where the admin can see the appointment and google meet link.
                            <br><br>
                            <b>Step 9:</b> The admin can also click the "Open Google Meet" and it will be redirected to the actual google meet meeting.  
                            <br><br>

                            <b>*MEDICAL HISTORY*</b><br>
                            In the medical history master list, the admin can access the records of the corresponding registered clients or pet owners, including their pets.
                            <br><br>
                            <b>Step 10:</b> Click the "Open Record" button, once the "Open record" button is is clicked, a prompt will appear, allowing the admin to print a prescription from the assigned doctor. 
                            <br><br>
                            <b>Step 11:</b> If the "Print Prescription" button is clicked, it will redirect to the PDF file of the prescription, which can then be printed. 
                            <br><br>
                            The admin can search by pet owners, the date they visited the vet, the type of service (walk-in or online), and the type of present diseases. 
                            Also, the admin can export the existing masterlist of the medical records. 
                            <br><br>
                              
                            <button class="btn btn-primary" onclick="stepper.next()">Next</button>
                            </div>


                            <div id="step-3" class="content" role="tabpanel" aria-labelledby="step-3-trigger">
                            <b>WORKFLOW OF THE SYSTEM:</b>
                            <br><br>
                            <b>*DISEASE*</b><br>
                            The admin can view and update the diseases in Panabo City.
                            <br><br>
                            <b>Step 12:</b> Click the button "Update" and by clicking the "Update" button, a form will appear containing important information about the corresponding disease. 
                            <br><br>
                            <b>Step 13:</b> After filling out the form and clicking "Save Changes," the information will be updated and displayed on the disease list.
                            <br>
                            If there is a need to add a new disease, the admin can do so as well. Similar to the update form, the add disease form will include all the necessary information for the specific disease.
                            <br>
                            <br>
                            <b>Step 14:</b> After entering the required details and clicking the "Save Changes" button, the new disease will be added to the disease list.
                            <br><br>
                            The admin can also export the disease list to PDF or Excel.
                            <br><br>
                            <b>*DOCTORS*</b>
                            <br>
                            The admin can add a doctor and update the existing doctor data.
                            <br><br>
                            <b>Step 15:</b> To add a doctor, the admin can click the "Add New Doctor" button, which will redirect to the doctor's profile creation page.
                            <br><br>
                            <b>Step 16:</b> After filling out all the necessary fields, clicking the submit button will add the doctor to the doctor list. Each doctor's entry will have an "Update" button, allowing the admin to modify their information. Once satisfied with the changes, the admin can save the modifications or discard (delete) them.  
                            <br><br>
                            The admin can also search the doctor's by the doctor's name. 
                            <br><br>
                            <b>*ANNOUNCEMENTS*</b>
                            <br>
                            In the announcements page, the admin can add, delete, and export announcements and the list of announcements.
                            <br><br>

                                                        
                              
                            <button class="btn btn-primary" onclick="stepper.next()">Next</button>
                            </div>



                            <div id="step-4" class="content" role="tabpanel" aria-labelledby="step-4-trigger">
                            
                            <b>WORKFLOW OF THE SYSTEM:</b>
                            <br>
                            <br>

                            <b>Step 17:</b> To add an announcement, the admin will click the "ADD ANNOUNCEMENT" button, which will redirect to a page where they 
                            can enter the title, description, and images for the announcement.
                            <br><br>
                            <b>Step 18:</b> After filling in the required details, the admin will click the "Save Changes" button, and the new announcement will be displayed 
                            in the list and visible at the end of the USERS INTERFACE.
                            <br><br>
                            The deletion of an announcement can only be done by the admin. 
                            <br><br>
                            <b>Step 19:</b> By clicking the "Delete" button the chosen existing announcement will then be deleted.
                            <br>
                            <br>

                                                        
                              
                              <button class="btn btn-primary" onclick="stepper.previous()">Previous</button>
                              <button class="btn btn-danger" data-dismiss="modal" aria-label="Close">Close</button>
                            </div>
                          </div>
                        </div>
              </div>
            </div>
          </div>
        </div>




        </div>





  
<script src="AdminLTE_new/plugins/jquery/jquery.min.js"></script>
<script src="AdminLTE_new/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Bootstrap 4 -->
<script src="AdminLTE_new/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="AdminLTE_new/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="AdminLTE_new/dist/js/adminlte.min.js"></script>
<script src="AdminLTE_new/plugins/bs-stepper/js/bs-stepper.min.js"></script>
<!-- <script src="AdminLTE/bower_components/jquery-ui/jquery-ui.min.js"></script> -->
<!-- AdminLTE for demo purposes -->
<?php if($_SESSION["dnsc_geoanalytics"]["role"] == "CLIENT"): ?>
    <?php if(isset($_GET["isNew"])): ?>
<script>
$(document).ready(function () {
  $('#modalNewUserGuide').modal('show'); // Show the modal on page load
});
$('#modalNewUserGuide').modal({
    backdrop: 'static', // Prevent closing when clicking outside
    keyboard: false     // Optional: Prevent closing with the Esc key
  });


</script>

    <?php endif; ?>
  <?php endif; ?>

  <script>


  document.addEventListener('DOMContentLoaded', function () {
    window.stepper = new Stepper(document.querySelector('.bs-stepper'))
    window.stepper = new Stepper(document.querySelector('.admin-stepper'))
  })
  </script>



