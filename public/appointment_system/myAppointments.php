<?php
require("includes/google_class.php");  

// $google->setAccessToken($_SESSION["dnsc_geoanalytics"]['accessToken']);
// $service = new Google_Service_Calendar($google);
// $calendarId= "15df82f54cf28baa57c00d9fc76503ed9d5b0fcaef7ec5595fc7e04a87fb72f2@group.calendar.google.com";
// $optParams = array(
// 	'maxResults' => 10,
// 	'orderBy' => 'startTime',
// 	'singleEvents' => true,
// 	// 'timeMin' => date(format: 'c'),
// );

// $results = $service->events->listEvents($calendarId, $optParams);
// $events = $results->getItems();
// // dump($events);


// $event = new Google_Service_Calendar_Event(array(
// 	'summary' => 'CHECKUP for CITY VET',
// 	'location' => 'City Veterinary Office',
// 	'description' => 'Book an appointment for checkup',
// 	'start' => array(
// 	  'dateTime' => '2024-05-09T09:00:00+08:00',
// 	  'timeZone' => 'Asia/Manila',
// 	),
// 	'end' => array(
// 	  'dateTime' => '2024-05-09T17:00:00+08:00',
// 	  'timeZone' => 'Asia/Manila',
// 	),
// 	'attendees' => array(
// 	  array('email' => 'bosspanabo2020@gmail.com'),
// 	//   array('email' => 'sbrin@example.com'),
// 	),
// 	'reminders' => array(
// 	  'useDefault' => FALSE,
// 	  'overrides' => array(
// 		array('method' => 'email', 'minutes' => 24 * 60),
// 		array('method' => 'popup', 'minutes' => 10),
// 	  ),
// 	),
//   ));
  
// //   $calendarId = 'primary';
//   $event = $service->events->insert($calendarId, $event);
//   dump($event);




    if($_SERVER["REQUEST_METHOD"] === "POST") {
		// dump($_SESSION);
		if($_POST["action"] == "myAppointmentsList"):
			// dump($_SESSION);

			$draw = isset($_POST["draw"]) ? $_POST["draw"] : 1;
            $offset = $_POST["start"];
            $limit = $_POST["length"];
            $search = $_POST["search"]["value"];

			$limitString = " limit " . $limit;
			$offsetString = " offset " . $offset;
			$baseQuery = "select * from appointment where clientId = '".$_SESSION["dnsc_geoanalytics"]["userid"]."'";

			$TimeSlot = [];
			$timeslot = query("select * from timeslot");
			foreach($timeslot as $row):
				$TimeSlot[$row["slotId"]] = $row;
			endforeach;

			// $query = query("select * from pet where clientId = ?", $_SESSION["dnsc_geoanalytics"]["userid"]);
			if($search == ""):
                $data = query($baseQuery . " " . $limitString . " " . $offsetString);
                $all_data = query($baseQuery);
            else:
                
                                // dump($query_string);
                $data = query($baseQuery . " where petName like '%".$search."%'" . " " . $limitString . " " . $offsetString);
                $all_data = query($baseQuery . " where petName like '%".$search."%'");
                // $all_data = $data;
            endif;
			// dump($query);
			$i = 0;
			foreach($data as $row):
				// dump($row);
				$data[$i]["action"] = '<a href="#"  class="btn btn-warning btn-block">Update</a>';
				$data[$i]["appointmentDate"] = $row["dateSet"] . " - " . $TimeSlot[$row["timeSet"]]["timeSlot"];
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

		

			

		elseif($_POST["action"] == "addNewAppointment"):
			// dump($_POST);

			$clientId = $_SESSION["dnsc_geoanalytics"]["userid"];
			$appointmentId = create_trackid("APP");
			// dump($appointmentId);

			if (query("insert INTO appointment (appointmentId, dateSet, timeSet, timestampSet, dateScheduled, appointmentStatus, clientId, notes) 
				VALUES(?,?,?,?,?,?,?,?)", 
				$appointmentId, $_POST["appointment_date"] ,$_POST["time_taken"], time(), date("Y-m-d"), "PENDING" ,$clientId, $_POST["noteAppointment"]) === false)
				{
					echo("not_success");
				}




			

			$res_arr = [
				"result" => "success",
				"title" => "Success",
				"message" => "Success on Booking an appointment!",
				"link" => "refresh",
				// "html" => '<a href="#">View or Print '.$transaction_id.'</a>'
				];
				echo json_encode($res_arr); exit();
			
			









		endif;
    }
	else {
		if(!isset($_GET["action"])):
			render("public/appointment_system/myAppointmentsList.php",[]);
		else:
			if($_GET["action"] == "specific"):
				render("public/pets_system/petSpecific.php",[]);
			endif;
		endif;
	}
?>
