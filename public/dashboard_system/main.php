<?php
    if($_SERVER["REQUEST_METHOD"] === "POST") {
	
    }
	else {
		$role = $_SESSION["dnsc_geoanalytics"]["role"];
		// dump($role);
		if($role == "ADMINISTRATOR"){
			render("public/dashboard_system/dashboard_admin.php",[]);
		}
	}
?>
