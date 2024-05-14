<?php

    if($_SERVER["REQUEST_METHOD"] === "POST") {
		// dump($_SESSION);

		if($_POST["action"] == "addMedicalRecord"):

			// dump($_POST);
			$medId = create_trackid("MED");
			if (query("insert INTO checkup (checkupId, petId, dateCheckup, type, service, symptoms, prescription, doctorsNote, diagnosis, treatment) 
				VALUES(?,?,?,?,?,?,?,?,?,?)", 
				$medId, $_POST["petId"] ,date("Y-m-d H:i:s"), $_POST["recordType"], $_POST["service"], $_POST["symptoms"],
					$_POST["prescriptions"], $_POST["doctorNote"], $_POST["diagnosis"], $_POST["treatment"]) === false)
				{
					echo("not_success");
				}
          	else;


			  if(isset($_POST["disease"])):
				foreach($_POST["disease"] as $row):
					if (query("insert INTO checkup_disease (checkupId, diseaseId, petId) 
					VALUES(?,?,?)", 
					$medId, $row, $_POST["petId"]) === false)
					{
						echo("not_success");
					}
				  else;
				endforeach;
			endif;
				
				

			$res_arr = [
				"result" => "success",
				"title" => "Success",
				"message" => "Success on updating data",
				"link" => "refresh",
				// "html" => '<a href="#">View or Print '.$transaction_id.'</a>'
				];
				echo json_encode($res_arr); exit();



			dump($_POST);


		endif;

    }
	else {
		if(!isset($_GET["action"])):
			render("public/pets_system/petsList.php",[]);
		else:
			if($_GET["action"] == "specific"):
				render("public/pets_system/petSpecific.php",[]);
			endif;
		endif;
	}
?>
