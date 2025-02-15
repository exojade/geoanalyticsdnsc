<?php
require("includes/google_class.php");  
    if($_SERVER["REQUEST_METHOD"] === "POST") {

		if($_POST["action"] == "calendarApi"):
			// dump($_POST);

			$events = query("SELECT appointmentId, t.slotId, t.timeslot,
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
		left join timeslot t on t.slotId = a.timeSet
		LEFT JOIN
			users u ON a.clientId = u.userid;");

		$doctorSchedule = query("select ds.*, t.timeslot from doctor_schedule ds left join timeslot t on ds.slotId = t.slotId");

		// dump($doctorSchedule);


		$mergedSchedule = [];
$allDates = [];
$allTimeSlots = [];

// Collect all unique dates and timeslots
foreach ($events as $event) {
    $allDates[$event['start']] = $event['start'];
    $allTimeSlots[$event['slotId']] = $event['timeslot'];
}
// dump($allDates);
foreach ($doctorSchedule as $schedule) {
    $allDates[$schedule['schedule_date']] = $schedule['schedule_date'];
    $allTimeSlots[$schedule['slotId']] = $schedule['timeslot'];
}

// Sort the dates
sort($allDates);
// dump($allDates);
// Build the merged schedule

// dump($allTimeSlots);
foreach ($allDates as $date) {
    foreach ($allTimeSlots as $slotId => $timeslot) {
        $status = 'AVAILABLE';
        $title = '';
        $backgroundColor = '#FFFFFF';

        // Check if there's an event on this date and timeslot
        foreach ($events as $event) {
            if ($event['start'] == $date && $event['slotId'] == $slotId) {
                $status = 'BOOKED';
                $title = $event['title'];
                $backgroundColor = $event['backgroundColor'];

				$mergedSchedule[] = [
					'date' => $date,
					'slotId' => $slotId,
					'timeslot' => $timeslot,
					'status' => $status,
					'title' => $timeslot,
					'backgroundColor' => $backgroundColor,
				];
                break;
            }
        }

        // If no event, check if the doctor is unavailable
        if ($status === 'AVAILABLE') {
            foreach ($doctorSchedule as $schedule) {
                if ($schedule['schedule_date'] == $date && $schedule['slotId'] == $slotId) {
                    $status = 'UNAVAILABLE';
                    $title = 'Doctor Unavailable';
                    $backgroundColor = '#FF0000';


					$mergedSchedule[] = [
						'date' => $date,
						'slotId' => $slotId,
						'timeslot' => $timeslot,
						'status' => $status,
						'title' => $timeslot,
						'backgroundColor' => $backgroundColor,
					];
                    break;
                }
            }
        }

        // Add to the merged schedule
   
		// dump($mergedSchedule);
    }
}

// dump($mergedSchedule);


// dump($events);


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
			$jsonEvents = json_encode($mergedSchedule);
			
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

		elseif($_POST["action"] == "getDoctorSchedule"):
			// dump($_POST);
			$html = "";
			
			$DoctorSchedule = [];
			$doctorSchedule = query("select * from doctor_schedule where schedule_date = ?", $_POST["schedule_date"]);
			foreach($doctorSchedule as $row):
				$DoctorSchedule[$row["slotId"]] = $row;
			endforeach;

			$html.='<input type="hidden" name="schedule_date" value="'.$_POST["schedule_date"].'">';
			$html.='<table class="table table-bordered">';
			$timeslot = query("select * from timeslot where remarks = 'active'");
			foreach($timeslot as $row):
				$html .='<tr>';
				$html .='<td>'.$row["timeSlot"].'</td>';
				$html .= '<td><input type="checkbox" name="'.$row["slotId"].'" '.(isset($DoctorSchedule[$row["slotId"]]) ? "" : "checked") .' data-bootstrap-switch data-off-color="danger" data-on-color="success"></td>';
				$html .='</tr>';
			endforeach;
			$html.='</table>';



			echo($html);

		elseif($_POST["action"] == "updateDoctorSchedule"):


			$timeslot = query("select * from timeslot where remarks = 'active'");

			query("delete from doctor_schedule where schedule_date = ?", $_POST["schedule_date"]);
			foreach($timeslot as $row):
				if(!isset($_POST[$row["slotId"]])):
					if (query("insert INTO doctor_schedule (schedule_date, slotId) 
					VALUES(?,?)", 
					$_POST["schedule_date"], $row["slotId"]) === false)
					{
						echo("not_success");
					}
				endif;
			endforeach;
			
			$res_arr = [
				"result" => "success",
				"title" => "Success",
				"message" => "Success on Schedule",
				"link" => "refresh",
				// "html" => '<a href="#">View or Print '.$transaction_id.'</a>'
				];
				echo json_encode($res_arr); exit();


			// dump($_POST);



		endif;
		
    }
		else {
			if(!isset($_GET["action"])):
				render("public/doctorSchedule_system/doctorSchedulePage.php",[]);
			else:
				if($_GET["action"] == "specific"):
					render("public/pets_system/petSpecific.php",[]);
				endif;
			endif;
		}

		// if()
		// 

		
?>
