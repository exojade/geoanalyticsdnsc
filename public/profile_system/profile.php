<?php

    if($_SERVER["REQUEST_METHOD"] === "POST") {
		
		if($_POST["action"] == "profileUpdate"):
			dump($_POST);
		endif;
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
