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



			


		elseif($_POST["action"] == "medicalRecordMasterList"):
			// dump($_REQUEST);
			$draw = isset($_POST["draw"]) ? $_POST["draw"] : 1;
            $offset = $_POST["start"];
            $limit = $_POST["length"];
            $search = $_POST["search"]["value"];

			$limitString = " limit " . $limit;
			$offsetString = " offset " . $offset;

			$where = " where 1=1";

			if(isset($_REQUEST["clientId"])):
				if($_REQUEST["clientId"] != ""):
					$where .=" and clientId = '".$_REQUEST["clientId"]."'";
				endif;
			endif;

			if(isset($_REQUEST["type"])):
				if($_REQUEST["type"] != ""):
					$where .=" and type = '".$_REQUEST["type"]."'";
				endif;
			endif;

			if(isset($_REQUEST["service"])):
				if($_REQUEST["service"] != ""):
					$where .=" and service = '".$_REQUEST["service"]."'";
				endif;
			endif;

			if(isset($_REQUEST["from"])):
				if($_REQUEST["from"] != ""):
					$where .=" and dateCheckup >= '".$_REQUEST["from"]." 00:00:00'";
				endif;
			endif;

			if(isset($_REQUEST["to"])):
				if($_REQUEST["to"] != ""):
					$where .=" and dateCheckup <= '".$_REQUEST["to"]." 23:59:00'";
				endif;
			endif;


			

			$baseQuery = "select c.*, p.clientId from checkup c 
			left join pet p
			on p.petId = c.petId" . $where;

			$data = query($baseQuery . " order by dateCheckup desc " . $limitString . " " . $offsetString);
			$all_data = query($baseQuery . " order by dateCheckup desc ");


			$Clients = [];
			$clients = query("select * from client");
			foreach($clients as $row):
				$Clients[$row["clientId"]] = $row;
			endforeach;


			$Pets = [];
			$pets = query("select * from pet");
			foreach($pets as $row):
				$Pets[$row["petId"]] = $row;
			endforeach;
			



			$i = 0;
			foreach($data as $row):
				// dump($row);

				// dump($Clients[$Pets[$row["petId"]]["clientId"]]);


				$data[$i]["action"] = '<a href="patient?action=specific&id='.$row["checkupId"].'" class="btn btn-block btn-sm btn-success">View</a>';
				$data[$i]["owner"] = $Clients[$Pets[$row["petId"]]["clientId"]]["lastname"] . ", " . $Clients[$Pets[$row["petId"]]["clientId"]]["firstname"];
				$data[$i]["pet"] = $Pets[$row["petId"]]["petName"];




				// $data[$i]["address"] = $row["province"] . ", " . $row["cityMun"] . ", " . strtoupper($row["barangay"]) . ", " . $row["address"];
				// $data[$i]["pets"] = 0;
				// if(isset($PetCount[$row["clientId"]])):
				// 	$data[$i]["pets"] = $PetCount[$row["clientId"]]["count"];
				// endif;

				
				// $data[$i]["appointmentDate"] = $row["dateSet"] . " - " . $TimeSlot[$row["timeSet"]]["timeSlot"];
				// dump();	
                $i++;
            endforeach;
            $json_data = array(
                "draw" => $draw + 1,
                "iTotalRecords" => count($all_data),
                "iTotalDisplayRecords" => count($all_data),
                "aaData" => $data
            );
            echo json_encode($json_data);



		endif;

    }
	else {
		if(!isset($_GET["action"])):

			$client = query("select * from client");
			render("public/medical_system/medicalList.php",[
				"client" => $client
			]);
		else:
			if($_GET["action"] == "specific"):
				render("public/pets_system/petSpecific.php",[]);
			endif;
		endif;
	}
?>
