<?php


	if(!isset($_SESSION["dnsc_geoanalytics"])) {
		redirect("role");
	}
	
	// log out current user, if any
	logout();
	
	// redirect user
	redirect("role");

?>
