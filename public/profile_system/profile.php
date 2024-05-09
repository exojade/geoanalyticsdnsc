<?php

    if($_SERVER["REQUEST_METHOD"] === "POST") {
		// dump($_SESSION);
	

			

	
    }
	else {
		if(!isset($_GET["action"])):
			render("public/pets_system/petsList.php",[]);
		else:
			if($_GET["action"] == "profileUpdate"):
				render("public/profile_system/petSpecific.php",[]);
			endif;
		endif;
	}
?>
