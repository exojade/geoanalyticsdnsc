<?php

    if($_SERVER["REQUEST_METHOD"] === "POST") {
		// dump($_SESSION);

		if($_POST["action"] == "addMedicalRecord"):

			// dump($_POST);
			$medId = create_trackid("MED");
			if (query("insert INTO checkup (checkupId, petId, dateCheckup, type, service, symptoms, prescription, doctorsNote, diagnosis, treatment, doctorId) 
				VALUES(?,?,?,?,?,?,?,?,?,?,?)", 
				$medId, $_POST["petId"] ,date("Y-m-d H:i:s"), $_POST["recordType"], $_POST["service"], $_POST["symptoms"],
					$_POST["prescriptions"], $_POST["doctorNote"], $_POST["diagnosis"], $_POST["treatment"],$_SESSION["dnsc_geoanalytics"]["userid"]) === false)
				{
					echo("not_success");
				}
          	else;


			  if(isset($_POST["disease"])):
				$client = query("select c.* from pet p
								left join client c
								on c.clientId = p.clientId
								where p.petId = ?
								", $_POST["petId"]);

				$barangayId = $client[0]["barangayId"];
				// dump($client);
				foreach($_POST["disease"] as $row):
					if (query("insert INTO checkup_disease (checkupId, diseaseId, petId, barangay, dateCheckUp) 
					VALUES(?,?,?,?,?)", 
					$medId, $row, $_POST["petId"],$barangayId,date("Y-m-d H:i:s")) === false)
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

			if(isset($_REQUEST["diseases"]) && !empty($_REQUEST["diseases"])) {
				$diseaseList = $_REQUEST["diseases"];
				$where .= " and cd.diseaseId IN (".$diseaseList.")";
				$joinDiseaseTable = " left join checkup_disease cd on c.checkupId = cd.checkupId
										left join disease d on d.diseaseId = cd.diseaseId ";
				$parameterDisease = ",GROUP_CONCAT(d.diseaseName SEPARATOR ', ') as disease_names ";
			} else {
				$joinDiseaseTable = "";
				$parameterDisease = "";
			}

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


			if($_SESSION["dnsc_geoanalytics"]["role"] == "DOCTOR"):
				$where = " and doctorId = '".$_SESSION["dnsc_geoanalytics"]["userid"]."'";
			endif;


			

			// $baseQuery = "select c.*, p.clientId from checkup c 
			// left join pet p
			// on p.petId = c.petId" . $where;

			$baseQuery = "select c.*, p.clientId

                  $parameterDisease
                  from checkup c 
                  left join pet p on p.petId = c.petId 
                  $joinDiseaseTable 
                  $where 
                  group by c.checkupId ";
			// dump($baseQuery);

			$data = query($baseQuery . " order by dateCheckup desc " . $limitString . " " . $offsetString);
			$all_data = query($baseQuery . " order by dateCheckup desc ");


			$Clients = [];
			$clients = query("select * from client");
			foreach($clients as $row):
				$Clients[$row["clientId"]] = $row;
			endforeach;


			$Disease = [];
			$disease = query("select cd.*, d.diseaseName from checkup_disease cd
								left join disease d
								on d.diseaseId = cd.diseaseId");
			foreach($disease as $row):
				$Disease[$row["checkupId"]][$row["diseaseName"]] = $row;
			endforeach;

			// dump($Disease);




			$Pets = [];
			$pets = query("select * from pet");
			foreach($pets as $row):
				$Pets[$row["petId"]] = $row;
			endforeach;
			



			$i = 0;
			foreach($data as $row):
				// dump($row);

				// dump($Clients[$Pets[$row["petId"]]["clientId"]]);


				$data[$i]["action"] = '<a href="#" data-toggle="modal" data-target="#medicalRecordModal" data-id="'.$row["checkupId"].'" class="btn btn-block btn-sm btn-success">Open Record</a>';
				$data[$i]["owner"] = $Clients[$Pets[$row["petId"]]["clientId"]]["lastname"] . ", " . $Clients[$Pets[$row["petId"]]["clientId"]]["firstname"];
				$data[$i]["pet"] = $Pets[$row["petId"]]["petName"];
				$data[$i]["disease"] = "";
				if($parameterDisease != ""):
					$data[$i]["disease"] = $row["disease_names"];
				endif;
				



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

		elseif($_POST["action"] == "medicalRecordModal"):

			
			$medRecord = query("select c.*, concat(cl.lastname, ', ' , cl.firstname) as owner,
								p.petName, p.petType,
								concat(d.doctorsLastname, ', ' , d.doctorsFirstname) as doctor
								from checkup c
								left join pet p
								on p.petId = c.petId
								left join client cl
								on cl.clientId = p.clientId
								left join doctors d
								on d.doctorsId = c.doctorId
								where checkupId = ?", $_POST["checkupId"]);
			// dump($medRecord);
			$medRecord = $medRecord[0];

			$hint = '
<input type="hidden" name="checkupId" value="'.$medRecord["checkupId"].'">

			<div class="card">
				<div class="card-body">
				<table class="table" id="sectionTable">
				<tr>
                      <th>Owner Name:</th>
                      <td>'.$medRecord["owner"].'</td>
					    <th>Doctor Attended:</th>
                      <td>'.$medRecord["doctor"].'</td>
                    </tr>
                    <tr>
                      <th>Pet Name:</th>
                      <td>'.$medRecord["petName"].'</td>
                      <th>Specie Type:</th>
                      <td>'.$medRecord["petType"].'</td>
                    </tr>
                    <tr>
                      <th>Type of Consultation:</th>
                      <td>'.$medRecord["type"].'</td>
                      <th>Date of Consultation:</th>
                      <td>'.$medRecord["dateCheckup"].'</td>
                    </tr>
                 
                  </table>

					</div>
				</div>';



				if($medRecord["diagnosis"] != ""):
					$hint .='<div class="card">
					<div class="card-body">
					<table class="table" id="sectionTable">
					<tr>
						  <th>Diagnosis:</th>
						</tr>
						<tr>
						   <td>'.$medRecord["diagnosis"].'</td>
						</tr>
					  </table>
	
						</div>
					</div>';
				endif;

				if($medRecord["symptoms"] != ""):
					$hint .= '
					<div class="card">
					<div class="card-body">
					<table class="table" id="sectionTable">
					<tr>
						  <th>Symptoms:</th>
						</tr>
						<tr>
						   <td>'.$medRecord["symptoms"].'</td>
						</tr>
					  </table>
	
						</div>
					</div>
					';
				endif;

				if($medRecord["treatment"]!=""):
					$hint.='
					<div class="card">
					<div class="card-body">
					<table class="table" id="sectionTable">
					<tr>
						  <th>Treatment:</th>
						</tr>
						<tr>
						   <td>'.$medRecord["treatment"].'</td>
						</tr>
					  </table>
	
						</div>
					</div>
					';
	
				endif;

				if($medRecord["prescription"] !=""):
					$hint.='
					<div class="card">
				<div class="card-body">
				<table class="table" id="sectionTable">
				<tr>
                      <th>Prescription:</th>
                    </tr>
                    <tr>
                       <td>'.$medRecord["prescription"].'</td>
                    </tr>
                  </table>

					</div>
				</div>
				';
				endif;



				

				

		
				

				// $hint .='
				// 	<div class="card">
				// <div class="card-body">
				// <table class="table" id="sectionTable">
				// <tr>
                //       <th>Disease:</th>
                //     </tr>
                //     <tr>
                //        <td>'.$medRecord["prescription"].'</td>
                //     </tr>
                //   </table>

				// 	</div>
				// </div>
				// ';

			// $hint.='
			// <hr>
            //       <h5><b>Symptoms</b></h5>
            //       '.$medRecord["symptoms"].'

            //       <hr>
            //       <h3>Rx [Prescription]</h3>
            //       '.$medRecord["prescription"].'
            //       <br>
            //       <form class="generic_form_trigger_no_prompt" data-url="pets">
            //           <input type="hidden" name="action" value="printPrescription">
            //           <input type="hidden" name="checkupId" value="'.$medRecord["checkupId"].'">
            //         <button type="submit" class="btn btn-primary btn-sm"> Print Prescription</button>
            //       </form>

            //       <hr>
            //       <h5><b>Doctors Notes</b></h5>
            //       '.$medRecord["doctorsNote"].'
			
			
			// ';

			echo($hint);
								
			// dump($medRecord);

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
