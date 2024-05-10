<?php
    if($_SERVER["REQUEST_METHOD"] === "POST") {
		if($_POST["action"] == "patientRecords"):
			// dump($_POST);

			$draw = isset($_POST["draw"]) ? $_POST["draw"] : 1;
            $offset = $_POST["start"];
            $limit = $_POST["length"];
            $search = $_POST["search"]["value"];


			$limitString = " limit " . $limit;
			$offsetString = " offset " . $offset;
			$petCount = query("select count(*) as count, clientId from pet group by clientId");
			$PetCount = [];

			foreach($petCount as $row):
				$PetCount[$row["clientId"]] = $row;
			endforeach;

			$where = " where clientStatus = 'DONE UPDATE'";


			$baseQuery = "select * from client " . $where;


			if($search == ""):
                $data = query($baseQuery . " " . $limitString . " " . $offsetString);
                $all_data = query($baseQuery);
            else:
                                // dump($query_string);
                $data = query($baseQuery . " and CONCAT(firstname, ' ', lastname) LIKE '%".$search."%'" . " " . $limitString . " " . $offsetString);
                $all_data = query($baseQuery . " and CONCAT(firstname, ' ', lastname) LIKE '%".$search."%'");
                // $all_data = $data;
            endif;


			$i = 0;
			foreach($data as $row):
				// dump($row);
				$data[$i]["action"] = '<a href="patient?action=specific&id='.$row["clientId"].'" class="btn btn-block btn-sm btn-success">View</a>
										
				';
				$data[$i]["name"] = $row["lastname"] . ", " . $row["firstname"];
				$data[$i]["address"] = $row["province"] . ", " . $row["cityMun"] . ", " . strtoupper($row["barangay"]) . ", " . $row["address"];
				$data[$i]["pets"] = 0;
				if(isset($PetCount[$row["clientId"]])):
					$data[$i]["pets"] = $PetCount[$row["clientId"]]["count"];
				endif;

				
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
				render("public/patient_system/patientList.php",[]);
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
				
				
			endif;
		endif;


			
	}
?>
