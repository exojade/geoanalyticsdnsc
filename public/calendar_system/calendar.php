<?php
require("includes/google_class.php");  
    if($_SERVER["REQUEST_METHOD"] === "POST") {

		if($_POST["action"] == "calendarApi"):
			// dump($_POST);

			$events = query("SELECT appointmentId,
			CONCAT(u.fullname , ' - ' , u.username) AS title,



			dateSet as start,


			CASE
				WHEN a.appointmentStatus = 'ONGOING' THEN '#43AA8B' -- Green
				WHEN a.appointmentStatus = 'CANCELLED' THEN '#F02D3A' -- Red
				WHEN a.appointmentStatus = 'PENDING' THEN '#F7F052' -- Yellow
				ELSE '#FFFFFF' -- Default color
			END AS backgroundColor
		FROM
			appointment a
		LEFT JOIN
			users u ON a.clientId = u.userid;");


			// $events = array(
			// 	array(
			// 		'title' => 'Event 1',
			// 		// 'start' => '2024-05-10T10:00:00',
			// 		// 'end'   => '2024-05-10T12:00:00',
			// 		'backgroundColor'   => '#f56954',
			// 		'allDay'   => true,
			// 		// 'borderColor'   => '#f56954',allDay         : true
			// 	),
			// 	// Add more events as needed
			// );
			// dump($events);
			
			// Convert the events array to JSON format
			$jsonEvents = json_encode($events);
			
			// Set the appropriate content type header
			header('Content-Type: application/json');
			
			// Output the JSON data
			echo $jsonEvents;
		
		elseif($_POST["action"] == "modalCalendar"):
			$appointment = query("select a.*, t.timeslot, u.fullname from appointment a
									left join timeslot t
									on t.slotId = a.timeSet
									left join users u
									on u.userid = a.clientId
									where a.appointmentId = ?", $_POST["appointmentId"]);
			$appointment = $appointment[0];
			$date = date("l, F d, Y", strtotime($appointment["dateSet"]));

			$hint = '
				<h5>Schedule for Online Checkup : '.$appointment["fullname"].'</h5>
				<h6>'.$date.' | '.$appointment["timeslot"].'</h6>
			<br>
			<h6>Note:</h6>
                  <p>'.$appointment["notes"].'</p>
			';

			if($appointment["meetId"] != ""):
				$hint.='
				
				<a class="btn btn-primary" target="_blank" href="'.$appointment["meetId"].'"> Open Google Meet &nbsp; <i class="fas fa-video"></i></a>
				<br><i><small>'.$appointment["meetId"].'</small></i>

				';
			endif;

			echo($hint);

			// dump($_POST);


		endif;
		
    }
		else {
			if(!isset($_GET["action"])):
				render("public/calendar_system/calendarForm.php",[]);
			else:
				if($_GET["action"] == "specific"):
					render("public/pets_system/petSpecific.php",[]);
				endif;
			endif;
		}

		// if()
		// 

		
?>
