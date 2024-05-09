<?php

    if($_SERVER["REQUEST_METHOD"] === "POST") {
		// dump($_SESSION);
	

			

	
    }
	else {

		$client = query("select * from client where clientId = ?", $_SESSION["dnsc_geoanalytics"]["userid"]);
		$client = $client[0];
				render("public/profile_system/profileUpdateForm.php",[
					"client" => $client
				]);
	}
?>
