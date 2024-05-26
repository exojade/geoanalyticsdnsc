<?php
    if($_SERVER["REQUEST_METHOD"] === "POST") {
		if($_POST["action"] == "scheduleList" && $_SESSION["dnsc_geoanalytics"]["role"] == "admin"):
			// dump($_POST);
			$draw = isset($_POST["draw"]) ? $_POST["draw"] : 1;
            $offset = $_POST["start"];
            $limit = $_POST["length"];
            $search = $_POST["search"]["value"];


			$limitString = " limit " . $limit;
			$offsetString = " offset " . $offset;

			$Client = [];
			$client = query("select * from client");
			foreach($client as $row):
				$Client[$row["clientId"]] = $row;
			endforeach;

			$Doctors = [];
			$doctors = query("select * from doctors");
			foreach($doctors as $row):
				$Doctors[$row["doctorsId"]] = $row;
			endforeach;
		



			$where = " where status = 'PENDING'";


			$baseQuery = "select * from checkup_schedule " . $where;


			if($search == ""):
                $data = query($baseQuery . " " . $limitString . " " . $offsetString);
                $all_data = query($baseQuery);
            else:
                                // dump($query_string);
                $data = query($baseQuery . " and CONCAT(doctorsFirstname, ' ', doctorsLastname) LIKE '%".$search."%'" . " " . $limitString . " " . $offsetString);
                $all_data = query($baseQuery . " and CONCAT(doctorsFirstname, ' ', doctorsLastname) LIKE '%".$search."%'");
                // $all_data = $data;
            endif;


			$i = 0;
			foreach($data as $row):
				// dump($row);
				$data[$i]["action"] = '
				<form class="generic_form_trigger" style="display:inline;" data-url="schedule">
				<input type="hidden" name="action" value="cancelSchedule">
				<input type="hidden" name="schedule_id" value="'.$row["schedule_id"].'">
				<div class="btn-group" width="100%">
											<button class="btn btn-sm btn-danger">Cancel</button>
                      </div>
					  </form>
	
				';
				$data[$i]["client"] = $Client[$row["clientId"]]["lastname"] . ", " . $Client[$row["clientId"]]["firstname"];
				$data[$i]["doctor"] = $Doctors[$row["doctorId"]]["doctorsLastname"] . ", " . $Doctors[$row["doctorId"]]["doctorsFirstname"];
                $i++;
            endforeach;
            $json_data = array(
                "draw" => $draw + 1,
                "iTotalRecords" => count($all_data),
                "iTotalDisplayRecords" => count($all_data),
                "aaData" => $data
            );
            echo json_encode($json_data);


			elseif($_POST["action"] == "scheduleList" && $_SESSION["dnsc_geoanalytics"]["role"] == "DOCTOR"):
				// dump($_POST);
				$draw = isset($_POST["draw"]) ? $_POST["draw"] : 1;
				$offset = $_POST["start"];
				$limit = $_POST["length"];
				$search = $_POST["search"]["value"];
	
	
				$limitString = " limit " . $limit;
				$offsetString = " offset " . $offset;
	
				$Client = [];
				$client = query("select * from client");
				foreach($client as $row):
					$Client[$row["clientId"]] = $row;
				endforeach;
	
				$Doctors = [];
				$doctors = query("select * from doctors");
				foreach($doctors as $row):
					$Doctors[$row["doctorsId"]] = $row;
				endforeach;
			
	
	
	
				$where = " where status = 'PENDING' and doctorId = '".$_SESSION["dnsc_geoanalytics"]["userid"]."'";
				$baseQuery = "select * from checkup_schedule " . $where;
	
	
				if($search == ""):
					$data = query($baseQuery . " " . $limitString . " " . $offsetString);
					$all_data = query($baseQuery);
				else:
									// dump($query_string);
					$data = query($baseQuery . " and CONCAT(doctorsFirstname, ' ', doctorsLastname) LIKE '%".$search."%'" . " " . $limitString . " " . $offsetString);
					$all_data = query($baseQuery . " and CONCAT(doctorsFirstname, ' ', doctorsLastname) LIKE '%".$search."%'");
					// $all_data = $data;
				endif;
	
	
				$i = 0;
				foreach($data as $row):
					// dump($row);
					$data[$i]["action"] = '
					<form class="generic_form_trigger" style="display:inline;" data-url="schedule">
					<input type="hidden" name="action" value="markDoneSchedule">
					<input type="hidden" name="schedule_id" value="'.$row["schedule_id"].'">
					<div class="btn-group" width="100%">
					

												<button class="btn btn-sm btn-warning">Mark as Done</button>
												</form>
												<a href="patient?action=specific&id='.$row["clientId"].'"  class="btn btn-sm btn-success">Open</a>
												
												</div>
				
		
					';
					$data[$i]["client"] = $Client[$row["clientId"]]["lastname"] . ", " . $Client[$row["clientId"]]["firstname"];
					$data[$i]["doctor"] = $Doctors[$row["doctorId"]]["doctorsLastname"] . ", " . $Doctors[$row["doctorId"]]["doctorsFirstname"];
					$i++;
				endforeach;
				$json_data = array(
					"draw" => $draw + 1,
					"iTotalRecords" => count($all_data),
					"iTotalDisplayRecords" => count($all_data),
					"aaData" => $data
				);
				echo json_encode($json_data);

			elseif($_POST["action"] == "doctorAdd"):
				// dump($_POST);
	
				$doctorId = create_trackid("DOC-");
				query("insert INTO doctors (doctorsId, doctorsFirstname, doctorsMiddlename, doctorsLastname, doctorsExtension, 
												doctorsRegion,doctorsProvince, doctorsCitymun, doctorsBarangay, 
												doctorsAddress, doctorsContactNumber, doctorsSex, doctorsBirthday) 
				VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?)", 
				$doctorId, $_POST["firstname"], $_POST["middlename"], $_POST["lastname"], $_POST["nameExtension"],
				$_POST["region"], $_POST["province"], $_POST["cityMun"], $_POST["barangay"], $_POST["address"],
				$_POST["contactNumber"], $_POST["gender"], $_POST["birthDate"]);

				query("insert INTO users (userid, username, password, role, fullname) 
				VALUES(?,?,?,?,?)", 
				$doctorId, $_POST["email"], $_POST["email"], "DOCTOR", $_POST["firstname"] . " " . $_POST["lastname"]);


				
				$res_arr = [
					"result" => "success",
					"title" => "Success",
					"message" => "Success on updating data",
					"link" => "doctors",
					// "html" => '<a href="#">View or Print '.$transaction_id.'</a>'
					];
					echo json_encode($res_arr); exit();
	
	
	elseif($_POST["action"] == "bookSchedule"):

		// dump($_POST);
		$schedId = create_trackid("SCHED");

		if (query("insert into checkup_schedule (schedule_id,clientId,doctorId,dateScheduled,timeScheduled, timestamp, status, scheduledBy) 
		VALUES(?,?,?,?,?,?,?,?)", 
		$schedId,$_POST["clientId"],$_POST["doctorId"],date("Y-m-d"),date("H:i:s"),time(),"PENDING",$_SESSION["dnsc_geoanalytics"]["userid"]) === false)
		{
			$res_arr = [
				"result" => "failed",
				"title" => "Failed",
				"message" => "Can't book for the same day!",
				"link" => "schedule",
				// "html" => '<a href="#">View or Print '.$transaction_id.'</a>'
				];
				echo json_encode($res_arr); exit();
		}
		else;

		$res_arr = [
			"result" => "success",
			"title" => "Success",
			"message" => "Success on updating data",
			"link" => "schedule",
			// "html" => '<a href="#">View or Print '.$transaction_id.'</a>'
			];
			echo json_encode($res_arr); exit();

		elseif($_POST["action"] == "markDoneSchedule"):
			// dump($_POST);

			query("update checkup_schedule set status = 'DONE' where schedule_id = ?", $_POST["schedule_id"]);
			$res_arr = [
				"result" => "success",
				"title" => "Success",
				"message" => "Success on updating data",
				"link" => "schedule",
				// "html" => '<a href="#">View or Print '.$transaction_id.'</a>'
				];
				echo json_encode($res_arr); exit();
	
			endif;

			


    }
	else {

		if(!isset($_GET["action"])):
				render("public/schedule_system/scheduleList.php",[]);
		else:
			if($_GET["action"] == "specific"):
				if($_SESSION["dnsc_geoanalytics"]["role"] == "admin"):
					if(!isset($_GET["id"])):
						render("public/404_system/404form.php",[]);
					elseif($_GET["id"] == ""):
						render("public/404_system/404form.php",[]);
					else:
						render("public/patient_system/patientSpecific.php",[]);
					endif;
				else:
					if(!isset($_GET["id"])):
						render("public/404_system/404form.php",[]);
					elseif($_GET["id"] == ""):
						render("public/404_system/404form.php",[]);
					elseif($_SESSION["dnsc_geoanalytics"]["userid"] != $_GET["id"]):
						render("public/404_system/404form.php",[]);
					else:
						render("public/patient_system/patientSpecific.php",[]);
					endif;

				endif;
				
			elseif($_GET["action"] == "doctorAdd"):
				render("public/doctors_system/doctorAddForm.php",[]);
			endif;
		endif;


			
	}
?>
