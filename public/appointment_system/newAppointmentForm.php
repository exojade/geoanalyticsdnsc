
<?php require("layouts/headerFrontPage.php"); ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"> <!-- Font Awesome CSS -->
    <style>
        .google-btn {
            background-color: #DB4437;
            color: #FFFFFF;
            border: none;
            border-radius: 4px;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
        }

        .google-icon {
            margin-right: 10px;
        }
    </style>
<!-- Calendar appointment start -->
<div class="container mt-5">
  <center><h2 class="mb-4">Calendar Appointment for Pet Owners</h2></center>
  <div class="calendar mb-4">
    <h4 id="currentMonthYear"></h4>
  </div>

  <h4>Welcome to the City Veterinary Office Online Appointment System</h4>
  <br>
  <h5 style="text-align: justify">
  Before proceeding, please ensure you have registered using your Google email address as telemedicine appointments will be conducted via Google Meet. Review all fields in the online form carefully and provide complete and accurate information.
<br>
<br>
TERMS and CONDITIONS:
<br>
<br>
This appointment and scheduling system allocates slots based on the availability of the veterinarian.
Users accept the responsibility of providing accurate information. If the desired appointment date is unavailable, the office reserves the right to reschedule and will notify you via email.
By proceeding with this application, you acknowledge and agree that the information provided may be used and disclosed by the City Veterinary Office in accordance with legal and regulatory standards and in compliance with the “Data Privacy Act of 2012”.
</h5>
<br>
<br>
<a class="google-btn" href="<?php echo($google->createAuthUrl()); ?>">
        <i class="fab fa-google google-icon"></i>
        Sign in with Google
      </a>


  
</div>

<br>
<br>
<br>
<br>
<!-- Calendar appointment end -->

<!-- Footer start -->
<footer class="bg-dark text-white py-2">
    <div class="container">
        <div class="row">
            <div class="col-md-5">
                <p>&copy; 2024 Animal Health Disease Monitoring Online Checkup Services</p>
            </div>
        </div>
    </div>
</footer>
<!-- Footer end -->

<!-- JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="js/bootstrap.bundle.min.js"></script>
<script>
  // Get current month and year
  var currentDate = new Date();
  var currentMonth = currentDate.toLocaleString('default', { month: 'long' });
  var currentDay = currentDate.getDate();
  var currentYear = currentDate.getFullYear();
  document.getElementById("currentMonthYear").innerText = currentMonth + " " + currentDay + ", " + currentYear;

  // Display appointment form automatically
  // document.getElementById("appointmentForm").style.display = "block";

  // // Form submission event
  // document.getElementById("appointmentForm").addEventListener("submit", function(event) {
  //   event.preventDefault();
  //   // Get form values
  //   var ownerName = document.getElementById("ownerName").value;
  //   var ownerContact = document.getElementById("ownerContact").value;
  //   var ownerEmail = document.getElementById("ownerEmail").value;
  //   var ownerAddress = document.getElementById("ownerAddress").value;
  //   var petType = document.getElementById("petType").value;
  //   var petBreed = document.getElementById("petBreed").value;
  //   var petAge = document.getElementById("petAge").value;
  //   var petServices = document.getElementById("petServices").value;

  //   // handle the appointment creation, validation, and storage

  //   // demonstration purposes, we'll just display the collected data
  //   var appointmentDetails = {
  //     "Owner Information": {
  //       "Name": ownerName,
  //       "Contact": ownerContact,
  //       "Email": ownerEmail,
  //       "Address": ownerAddress
  //     },
  //     "Pet Information": {
  //       "Type": petType,
  //       "Breed": petBreed,
  //       "Age": petAge,
  //       "Services": petServices
  //     }
  //   };
  //   console.log(appointmentDetails);

  //   // Optionally, you can display a success message or redirect the user
  //   alert("Appointment set successfully!");
  //   // Clear form
  //   document.getElementById("appointmentForm").reset();
  // });
</script>

</body>
</html>
