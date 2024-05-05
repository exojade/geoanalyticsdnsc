<?php
require("includes/google_class.php"); 
    if($_SERVER["REQUEST_METHOD"] === "POST") {

		
    }
	else {

        renderview("public/appointment_system/newAppointmentForm.php",
        [
            "google" => $google


        ]);

		

		
	}
?>
