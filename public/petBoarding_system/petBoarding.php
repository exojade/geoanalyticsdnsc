<?php

    if($_SERVER["REQUEST_METHOD"] === "POST") {
	

		if($_POST["action"] == "newPetBoarding"):
			
			if($_POST["role"] == "user"):
				// dump($_SESSION["dnsc_geoanalytics"]["userid"]);
				$checkIn = DateTime::createFromFormat('Y-m-d h:i A', ($_POST["dateCheckIn"] . " " . $_POST["checkin"]))->format("Y-m-d H:i:00");
				$checkOut = DateTime::createFromFormat('Y-m-d h:i A', ($_POST["dateCheckOut"] . " " . $_POST["checkout"]))->format("Y-m-d H:i:00");
				// dump($checkIn);
				if ($checkOut <= $checkIn):
					$res_arr = [
						"result" => "failed",
						"title" => "Failed",
						"message" => "Check-out time must be greater than check-in time.",
						"link" => "refresh",
						// "html" => '<a href="#">View or Print '.$transaction_id.'</a>'
						];
						echo json_encode($res_arr); exit();
				endif;

				
				if (query("insert INTO pet_boarding (clientId, from_date, to_date, numberPets, dateSet, status) 
					VALUES(?,?,?,?,?,?)", 
					$_SESSION["dnsc_geoanalytics"]["userid"],$checkIn, $checkOut, $_POST["numberPets"], date("Y-m-d H:i:00"),"PENDING") === false)
					{
						echo("not_success");
					}
				  else;
	
				$res_arr = [
					"result" => "success",
					"title" => "Success",
					"message" => "Success on updating data",
					"link" => "refresh",
					// "html" => '<a href="#">View or Print '.$transaction_id.'</a>'
					];
					echo json_encode($res_arr); exit();

			



			endif;


			elseif($_POST["action"] == "newPetBoardingAdmin"):

				// dump($_POST);



				$checkIn = DateTime::createFromFormat('Y-m-d h:i A', ($_POST["dateCheckIn"] . " " . $_POST["checkin"]))->format("Y-m-d H:i:00");
				$checkOut = DateTime::createFromFormat('Y-m-d h:i A', ($_POST["dateCheckOut"] . " " . $_POST["checkout"]))->format("Y-m-d H:i:00");
				// dump($checkIn);
				if ($checkOut <= $checkIn):
					$res_arr = [
						"result" => "failed",
						"title" => "Failed",
						"message" => "Check-out time must be greater than check-in time.",
						"link" => "refresh",
						// "html" => '<a href="#">View or Print '.$transaction_id.'</a>'
						];
						echo json_encode($res_arr); exit();
				endif;

				
				if (query("insert INTO pet_boarding (clientId, from_date, to_date, numberPets, dateSet, status) 
					VALUES(?,?,?,?,?,?)", 
					$_POST["clientId"],$checkIn, $checkOut, $_POST["numberPets"], date("Y-m-d H:i:00"),"ONGOING") === false)
					{
						echo("not_success");
					}
				  else;
	
				$res_arr = [
					"result" => "success",
					"title" => "Success",
					"message" => "Success on updating data",
					"link" => "refresh",
					// "html" => '<a href="#">View or Print '.$transaction_id.'</a>'
					];
					echo json_encode($res_arr); exit();

		


			// dump($_POST);
			



			


		elseif($_POST["action"] == "petBoardingList"):
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

			// dump($_SESSION);
			if($_SESSION["dnsc_geoanalytics"]["role"] == "CLIENT"):
				$where .=" and clientId = '".$_SESSION["dnsc_geoanalytics"]["userid"]."'";
			endif;

			

			$baseQuery = "SELECT *,
  CASE
    WHEN status = 'ONGOING' AND to_date < NOW() THEN 'OVERDUE'
    ELSE status
  END AS display_status
FROM pet_boarding
$where
ORDER BY 
  CASE
    WHEN status = 'PENDING' THEN 0
    ELSE 1
  END,
  from_date DESC,
  to_date DESC";

			$data = query($baseQuery  . $limitString . " " . $offsetString);
			// dump($data);
			$all_data = query($baseQuery);


			$Clients = [];
			$clients = query("select * from client");
			foreach($clients as $row):
				$Clients[$row["clientId"]] = $row;
			endforeach;


			// dump($_SESSION);

			if($_SESSION["dnsc_geoanalytics"]["role"] == "admin"):
			$i = 0;
			foreach($data as $row):
				// dump($row);

				// dump($Clients[$Pets[$row["petId"]]["clientId"]]);
				// <form class="generic_form_trigger" style="display:inline;" data-url="petBoarding">
				// 		<input type="hidden" name="action" value="cancelPetBoarding">
				// 				<div class="btn-group btn-block" width="100%">
				// 				<a href="#" data-toggle="modal" data-id="'.$row["petBoardingId"].'" data-target="#modalPetBoardingApprove" class="btn btn-sm btn-success"><i class="fa fa-check"></i></a>
				// 				<a href="#" data-toggle="modal" data-id="'.$row["petBoardingId"].'" data-target="#modalPetBoardingApprove" class="btn btn-sm btn-success"><i class="fa fa-check"></i></a>
				// 				<button class="btn btn-sm btn-danger"><i class="fa fa-times"></i></button>
				// 		</div>
				// 	  </form>

				if($row["display_status"] == "PENDING"):
					$data[$i]["action"] = '
					
				
						<div class="btn-group btn-block" width="100%">
							<a href="#" data-toggle="modal" data-id="'.$row["petBoardingId"].'" data-target="#modalPetBoardingApprove" class="btn btn-sm btn-success"><i class="fa fa-check"></i></a>
							<a href="#" data-toggle="modal" data-id="'.$row["petBoardingId"].'" data-target="#modalPetBoardingCancel" class="btn btn-sm btn-danger"><i class="fa fa-times"></i></a>
						</div>
					';
				elseif($row["display_status"] == "OVERDUE" || $row["display_status"] == "ONGOING"):
					$data[$i]["action"] = '
					
					<form class="generic_form_trigger" style="display:inline;" data-url="petBoarding">
						<input type="hidden" name="action" value="donePetBoarding">
						<input type="hidden" name="petBoardingId" value="'.$row["petBoardingId"].'">
								<div class="btn-group btn-block" width="100%">
								<a href="#" data-toggle="modal" data-id="'.$row["petBoardingId"].'" data-target="#modalPetBoardingDetails" class="btn btn-sm btn-info"><i class="fa fa-eye"></i></a>
								<button class="btn btn-sm btn-success"><i class="fa fa-check"></i></button>
						</div>
					  </form>
					';
				elseif($row["display_status"] == "DONE" || $row["display_status"] == "CANCELLED"):
					$data[$i]["action"] = '
								<a href="#" data-toggle="modal" data-id="'.$row["petBoardingId"].'" data-target="#modalPetBoardingDetails" class="btn btn-sm btn-info btn-block"><i class="fa fa-eye"></i></a>
					';
				endif;
				// $data[$i]["action"] = '<a href="#" data-toggle="modal" data-target="#medicalRecordModal" data-id="'.$row["checkupId"].'" class="btn btn-block btn-sm btn-success">Open Record</a>';
				$data[$i]["client"] = $Clients[$row["clientId"]]["lastname"] . ", " . $Clients[$row["clientId"]]["firstname"];
				$data[$i]["from_date"] = (new DateTime($row["from_date"]))->format('l, F j, Y h:i A');
				$data[$i]["to_date"] = (new DateTime($row["to_date"]))->format('l, F j, Y h:i A');



				switch ($row["display_status"]) {
					case "ONGOING":
						// Code for handling ONGOING status
						$data[$i]["display_status"] = "<span class='text-blue'>".$row["display_status"]."</span>";
						break;
				
					case "DONE":
						$data[$i]["display_status"] = "<span class='text-green'>".$row["display_status"]."</span>";
						break;
				
					case "PENDING":
						$data[$i]["display_status"] = "<span class='text-yellow'>".$row["display_status"]."</span>";
						break;
				
					default:
						// Code for handling unknown status
						$data[$i]["display_status"] = "<span class='text-red'>".$row["display_status"]."</span>";
						// echo "Unknown appointment status.";
						break;
				}
		
                $i++;
            endforeach;
            $json_data = array(
                "draw" => $draw + 1,
                "iTotalRecords" => count($all_data),
                "iTotalDisplayRecords" => count($all_data),
                "aaData" => $data
            );
            echo json_encode($json_data);
		else:


			$i = 0;
			foreach($data as $row):
				// dump($row);

				// dump($Clients[$Pets[$row["petId"]]["clientId"]]);

				if($row["display_status"] == "PENDING"):
					$data[$i]["action"] = '
					<form class="generic_form_trigger" style="display:inline;" data-url="petBoarding">
						<input type="hidden" name="action" value="cancelPetBoarding">
								<div class="btn-group btn-block" width="100%">
								<button class="btn btn-sm btn-danger"><i class="fa fa-times"></i></button>
						</div>
					  </form>
					';
				elseif($row["display_status"] == "OVERDUE" || $row["display_status"] == "ONGOING"):
					$data[$i]["action"] = '
						<div class="btn-group btn-block" width="100%">
								<a href="#" data-toggle="modal" data-id="'.$row["petBoardingId"].'" data-target="#modalPetBoardingDetails" class="btn btn-sm btn-info"><i class="fa fa-eye"></i></a>
						</div>
					
					';
				elseif($row["display_status"] == "DONE"):
					$data[$i]["action"] = '
					
				
								<a href="#" data-toggle="modal" data-id="'.$row["petBoardingId"].'" data-target="#modalPetBoardingDetails" class="btn btn-sm btn-info btn-block"><i class="fa fa-eye"></i></a>
						
					';
				endif;
				// $data[$i]["action"] = '<a href="#" data-toggle="modal" data-target="#medicalRecordModal" data-id="'.$row["checkupId"].'" class="btn btn-block btn-sm btn-success">Open Record</a>';
				$data[$i]["client"] = $Clients[$row["clientId"]]["lastname"] . ", " . $Clients[$row["clientId"]]["firstname"];
				$data[$i]["from_date"] = (new DateTime($row["from_date"]))->format('l, F j, Y h:i A');
				$data[$i]["to_date"] = (new DateTime($row["to_date"]))->format('l, F j, Y h:i A');



				switch ($row["display_status"]) {
					case "ONGOING":
						// Code for handling ONGOING status
						$data[$i]["display_status"] = "<span class='text-blue'>".$row["display_status"]."</span>";
						break;
				
					case "DONE":
						$data[$i]["display_status"] = "<span class='text-green'>".$row["display_status"]."</span>";
						break;
				
					case "PENDING":
						$data[$i]["display_status"] = "<span class='text-yellow'>".$row["display_status"]."</span>";
						break;
				
					default:
						// Code for handling unknown status
						$data[$i]["display_status"] = "<span class='text-red'>".$row["display_status"]."</span>";
						// echo "Unknown appointment status.";
						break;
				}
		
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

		elseif($_POST["action"] == "cancelPetBoard"):

		// dump($_POST);
		
		$petBoarding = query("select * from pet_boarding pb
								left join users u
								on u.userid = pb.clientId
								where petBoardingId = ?", $_POST["petBoardingId"]);
		$petBoarding = $petBoarding[0];
		query("update pet_boarding set status = 'CANCELLED', reasonCancellation = ? where petBoardingId = ?", $_POST["reason"], $_POST["petBoardingId"]);
		$siteOptions = query("select * from siteoptions");
		$siteOptions = $siteOptions[0];

		$theEmail = $petBoarding["username"];
					$message = '
					<html>
						<body>';

					$message.='
					Good Day, '.$petBoarding["fullname"].',
					<br>
					<br>
					We regret to inform you that your pet boarding appointment scheduled for '.date("l, F j, Y h:i A", strtotime($petBoarding["dateSet"])).' has been canceled due to '.$_POST["reason"].'.
					<br>
					<br>
					We understand the inconvenience this may cause and deeply apologize for the disruption. Please feel free to contact us to reschedule or discuss any concerns you may have.
					<br>
					<br>
					Thank you for your understanding, and we appreciate your continued trust in our services.
					<br>
					<br>
					Best regards,<br>
					'.$siteOptions["mainTitle"].'
												
											';

		$mail = new PHPMailer();
						try {
							$mail->isSMTP();
							$mail->SMTPAuth = true;
							$mail->SMTPSecure = "ssl";
							$mail->Host = "smtp.gmail.com";
							$mail->Port = "465";
							$mail->isHTML();
							$mail->Username = "valientedogawa@gmail.com";
							$mail->Password = "fhshyevehmebbfje";
							$mail->SetFrom("no-reply@vetwebapplication");
							$mail->Subject = "Pet Boarding Cancellation";
							$mail->Body = $message;
							$mail->AddAddress($theEmail);
							$mail->Send();
							$res_arr = [
								"result" => "success",
								"title" => "Success",
								"message" => "Success on updating data",
								"link" => "refresh",
								// "html" => '<a href="#">View or Print '.$transaction_id.'</a>'
								];
								echo json_encode($res_arr); exit();
								} catch (phpmailerException $e) {
									$res_arr = [
										"result" => "success",
										"title" => "Success",
										"message" => $e->errorMessage(),
										"link" => "refresh",
										// "html" => '<a href="#">View or Print '.$transaction_id.'</a>'
										];
										echo json_encode($res_arr); exit();
								} catch (Exception $e) {
			
									$res_arr = [
										"result" => "success",
										"title" => "Success",
										"message" => $e->getMessage(),
										"link" => "refresh",
										// "html" => '<a href="#">View or Print '.$transaction_id.'</a>'
										];
										echo json_encode($res_arr); exit();
								}

		elseif($_POST["action"] == "modalPetBoardingCancel"):
			// dump($_POST);

			$hint = '
			<input type="hidden" name="petBoardingId" value="'.$_POST["petBoardingId"].'">
			<div class="form-group">
			<label>Reason for Cancellation</label>
				<textarea class="form-control" name="reason"></textarea>
			</div>
			
			
			';

			echo($hint);

			



		elseif($_POST["action"] == "donePetBoarding"):
			// dump($_POST);


			query("update pet_boarding set status = 'DONE', dateDone = ? where petBoardingId = ?", date("Y-m-d H:i:00"), $_POST["petBoardingId"]);

			$res_arr = [
				"result" => "success",
				"title" => "Success",
				"message" => "Success on updating data",
				"link" => "refresh",
				// "html" => '<a href="#">View or Print '.$transaction_id.'</a>'
				];
				echo json_encode($res_arr); exit();


		elseif($_POST["action"] == "modalPetBoardingApprove" || $_POST["action"] == "modalPetBoardingDetails"):
			// dump($_POST);
			
			$petBoarding = query("SELECT pb.*, 
			concat(lastname, ', ', firstname) as client,
				CASE
					WHEN status = 'ONGOING' AND to_date < NOW() THEN 'OVERDUE'
					ELSE status
				END AS display_status

				FROM pet_boarding pb
				left join client c
				on c.clientId = pb.clientId
				where petBoardingId = ?", $_POST["petBoardingId"]);
			// dump($medRecord);
			$petBoarding = $petBoarding[0];
			$row = $petBoarding;

			switch ($row["display_status"]) {
				case "ONGOING":
					// Code for handling ONGOING status
					$row["display_status"] = "<span class='text-blue'>".$row["display_status"]."</span>";
					break;
			
				case "DONE":
					$row["display_status"] = "<span class='text-green'>".$row["display_status"]."</span>";
					break;
			
				case "PENDING":
					$row["display_status"] = "<span class='text-yellow'>".$row["display_status"]."</span>";
					break;
			
				default:
					// Code for handling unknown status
					$row["display_status"] = "<span class='text-red'>".$row["display_status"]."</span>";
					// echo "Unknown appointment status.";
					break;
			}
	

			$hint = '
<input type="hidden" name="petBoardingId" value="'.$petBoarding["petBoardingId"].'">
<input type="hidden" name="action" value="approvePetBoarding">

			<div class="card">
				<div class="card-body">
				<dl>
                  <dt>Client</dt>
                  <dd>'.$petBoarding["client"].'</dd>
                  <dt>Service Start Schedule</dt>
                  <dd>'.(new DateTime($petBoarding["from_date"]))->format('l, F j, Y h:i A').'</dd>
                  <dt>Service End Schedule</dt>
                  <dd>'.(new DateTime($petBoarding["to_date"]))->format('l, F j, Y h:i A').'</dd>
                  <dt>Status</dt>
                  <dd>'.$row["display_status"].'</dd>
                </dl>

					</div>
				</div>';
			echo($hint);

		elseif($_POST["action"] == "approvePetBoarding"):
			// dump($_POST);
			query("update pet_boarding set status = 'ONGOING' where petBoardingId = ?", $_POST["petBoardingId"]);
			$res_arr = [
				"result" => "success",
				"title" => "Success",
				"message" => "Success on updating data",
				"link" => "refresh",
				// "html" => '<a href="#">View or Print '.$transaction_id.'</a>'
				];
				echo json_encode($res_arr); exit();


		endif;

    }
	else {
		if(!isset($_GET["action"])):

			$client = query("select * from client");
			render("public/petBoarding_system/petBoardingList.php",[
				"client" => $client
			]);
		else:
			if($_GET["action"] == "specific"):
				render("public/pets_system/petSpecific.php",[]);
			endif;
		endif;
	}
?>
