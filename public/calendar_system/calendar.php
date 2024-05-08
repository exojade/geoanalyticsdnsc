<?php
require("includes/google_class.php");  
    if($_SERVER["REQUEST_METHOD"] === "POST") {


		
    }
		else {
			if(!isset($_GET["action"])):
				render("public/calendar_system/calendarForm.php",[]);
			else:
				if($_GET["action"] == "specific"):
					render("public/pets_system/petSpecific.php",[]);
				endif;
			endif;
		}

		// if()
		// 

		
?>
