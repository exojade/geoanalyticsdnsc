<?php
// dump($_SESSION);
    if($_SERVER["REQUEST_METHOD"] === "POST") {
		
		if($_POST["action"] == "profileAdd"):
			// dump($_POST);

			$clientId = create_trackid("CL-");
			query("insert INTO client (clientId, firstname, lastname, middlename, nameExtension, region,
											province, cityMun, barangay, address, contactNumber, clientType,
											birthDate, gender, clientStatus) 
            VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)", 
            $clientId, $_POST["firstname"], $_POST["lastname"], $_POST["middlename"], $_POST["nameExtension"],
			$_POST["region"], $_POST["province"], $_POST["cityMun"], $_POST["barangay"], $_POST["address"],
			$_POST["contactNumber"], "WALK IN", $_POST["birthDate"], $_POST["gender"], "DONE UPDATE");
			
			$res_arr = [
				"result" => "success",
				"title" => "Success",
				"message" => "Success on updating data",
				"link" => "patient?action=specific&id=".$clientId,
				// "html" => '<a href="#">View or Print '.$transaction_id.'</a>'
				];
				echo json_encode($res_arr); exit();





		endif;
    }
	else {
		if(!isset($_GET["action"])):
			render("public/pets_system/petsList.php",[]);
		else:
			if($_GET["action"] == "profileUpdate"):
				render("public/profile_system/petSpecific.php",[]);
			elseif($_GET["action"] == "profileAdd"):
				render("public/profile_system/profileAddForm.php",[]);
			endif;
		endif;
	}
?>
