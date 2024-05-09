<?php

    if($_SERVER["REQUEST_METHOD"] === "POST") {
		// dump($_SESSION);
	
		if($_POST["action"] == "profileUpdate"):
			

			query("update client set 
					firstname = '".$_POST["firstname"]."',
					middlename = '".$_POST["middlename"]."',
					lastname = '".$_POST["lastname"]."',
					nameExtension = '".$_POST["nameExtension"]."',
					region = '".$_POST["region"]."',
					province = '".$_POST["province"]."',
					cityMun = '".$_POST["cityMun"]."',
					barangay = '".$_POST["barangay"]."',
					address = '".$_POST["address"]."',
					contactNumber = '".$_POST["contactNumber"]."',
					birthDate = '".$_POST["birthDate"]."',
					gender = '".$_POST["gender"]."',
					clientStatus = 'DONE UPDATE'
					where clientId = ?
					", $_POST["userid"]);

					$_SESSION["dnsc_geoanalytics"]["fillprofile"] = "DONE";
					
				

					$res_arr = [
						"result" => "success",
						"title" => "Success",
						"message" => "Success on updating data",
						"link" => "index",
						// "html" => '<a href="#">View or Print '.$transaction_id.'</a>'
						];
						echo json_encode($res_arr); exit();

		endif;
	
    }
	else {

		$client = query("select * from client where clientId = ?", $_SESSION["dnsc_geoanalytics"]["userid"]);
		$client = $client[0];
				render("public/profile_system/profileUpdateForm.php",[
					"client" => $client
				]);
	}
?>
