<?php
require("includes/google_class.php");  
    if($_SERVER["REQUEST_METHOD"] === "POST") {

		if($_POST["action"] == "availSchedules"):
			// dump($_POST);

			
			
			
			$the_date = $_POST["the_date"];

			
			// dump($type);
			$sql = query("select timeSet, count(*) as count from appointment where appointmentStatus in ('PENDING', 'ACCEPTED') and dateSet = ? group by timeSet",
							$the_date);
							// dump($sql);
			$schedules = query("select * from timeslot where remarks = 'active'");
			
			$scheduletime = [];
			foreach($schedules as $s):
				$scheduletime[$s["slotId"]] = $s;
			endforeach;
			// dump($scheduletime);
			$schedules_taken = [];
			foreach($sql as $row):
				$schedules_taken[$row["timeSet"]] = $row;
			endforeach;
			// dump($schedules_taken);
			// dump("awit");
			foreach($scheduletime as $scheds):
				$sched = $scheds;
				// dump($scheds);

				if(isset($schedules_taken[$scheds["slotId"]])):
					$scheduletime[$scheds["slotId"]]["slotsAvailable"] = $scheduletime[$scheds["slotId"]]["slotsAvailable"] - $schedules_taken[$scheds["slotId"]]["count"];
				endif;


				
				// if(array_key_exists($scheds["slotId"], $schedules_taken)){
				// }
			endforeach;
			
			// dump($scheduletime);
			echo("<div class='row'>");
			echo("<div class='col-md-6'>");
			$count = 0;
			foreach($scheduletime as $s):
				// dump($s);
				if($count == 5){
					echo("</div>");
					echo("<div class='col-md-6'>");
				}
				$slots_available = $s["slotsAvailable"];
				$time = $s["slotId"];
				$timeSlot = $s["timeSlot"];
				
			
				$the_time=strtotime($the_date);
				$month=date("F",$the_time);
				$year=date("Y",$the_time);
				$day=date("d",$the_time);
				$day = strval($day);
			
			
			
				$return_cue = true;
				
			
				if($the_date == date("Y-m-d")){
			
					$start_time = str_replace(":","",$s["startTime"]);
					$my_time = date("Gi");
					// $my_time = "1500";
					$difference = $start_time - $my_time;
					// echo($difference);
					if($difference < 100){
						$return_cue = false;
					}
				}

				if($s["slotsAvailable"] == 0){
			
					$return_cue = false;
				}

			
			
				$to_date = strtotime($the_date);
				$week = date("l", $to_date);
				// dump($week);
				if($week == "Saturday" || $week == "Sunday"):
					$return_cue = false;
				endif;

				if($the_date < date("Y-m-d")){
					$return_cue = false;
				}
				
			
			
			
				// if(($month == 'January' || $month == 'February') && $year == '2024'){
			
				// 	if($month == 'January'){
				// 		if($day == '02')
				// 		$return_cue = false;
				// 		else if($day >= 21){
				// 			$return_cue = false;
				// 		}
				// 	}
			
				// 	if($month == 'February'){
				// 		$return_cue = false;
				// 	}
				 
				// if($slots_available <= 0){
				// 	$return_cue = false;
				// }
				
				// else{
					
				// if($week == 'Saturday'){
					
					
				// 	if($month == 'February' || $month == 'January'){
			
						
				// 		// $return_cue = false;
				// 	}
				// 	else{
				// 			$return_cue = true;
						
					
						
						
				// 	}
			
				// 	if($time == 'PM 04:00 - 05:00' ){
				// 		$return_cue = false;
				// 		}
			
				// 		if($time == 'PM 05:00 - 06:00' ){
				// 		$return_cue = false;
				// 		}
					
					
				// }
				
				// // if($time == 'PM 05:00 - 06:00' ){
				// // 	    $return_cue = false;
				// // 	    }
					
					
					
				// }
					
				// if($day == "25" || $day == '1'){
				// 	$return_cue = false;
				// }  
				
				
				
			
			
				// }
				// else
				// 	$return_cue = false;
			
				if($return_cue == true){
					echo('
					<div class="form-group">
								<div class="radio">
									<label class="text-success">
									<input required type="radio" name="time_taken" value="'.$time.'">
									'.$timeSlot.' - Available
									</label></strong>
								</div>
						</div>
					');
				}
			
				else{
					echo('
					<div class="form-group">
								  <div class="radio">
									<strong><label class="text-danger">
									  <input required type="radio" name="time_taken" value="'.$time.'" disabled="">
									  '.$timeSlot.' - Not Available
									</label></strong>
								  </div>
								</div>
					');
			
			
				}
			
				
				$count++;
			endforeach;
			
			echo("</div>");
			echo("</div>");
			
			echo("
			<script>
			$('input:radio[name=\"time_taken\"]').change(function(){
				if($(this).val() != ''){
					this_checked = 1;
					$('#submiter').prop('disabled', false);
				}
			});
			</script>
			");

		elseif($_POST["action"] == "appointmentList"):

			$draw = isset($_POST["draw"]) ? $_POST["draw"] : 1;
            $offset = $_POST["start"];
            $limit = $_POST["length"];
            $search = $_POST["search"]["value"];

			$limitString = " limit " . $limit;
			$offsetString = " offset " . $offset;
			$baseQuery = "select * from appointment order by timestampSet desc";

			$TimeSlot = [];
			$timeslot = query("select * from timeslot");
			foreach($timeslot as $row):
				$TimeSlot[$row["slotId"]] = $row;
			endforeach;

			$Client = [];
			$client = query("select * from users");
			foreach($client as $row):
				$Client[$row["userid"]] = $row;
			endforeach;


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
				$data[$i]["action"] = '
				<form class="generic_form_trigger" style="display:inline;" data-url="appointment">
				<input type="hidden" name="action" value="cancelAppointment">
				<div class="btn-group" width="100%">
                        <a href="#" data-toggle="modal" data-id="'.$row["appointmentId"].'" data-target="#modalAppointment" class="btn btn-sm btn-success">Accept</a>
                      
											
											<button class="btn btn-sm btn-danger">Cancel</button>
									
                      </div>
					  </form>
	
				';

				$data[$i]["client"] = $Client[$row["clientId"]]["fullname"];
				$data[$i]["email"] = $Client[$row["clientId"]]["username"];

				
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

		elseif($_POST["action"] == "modalAppointment"):
			// dump($_POST);
			$appointment = query("select a.*, u.*, t.timeSlot from appointment a
								left join users u
								on a.clientId = u.userid
								left join timeslot t
								on t.slotId = a.timeSet
								where a.appointmentId = ?
								",$_POST["appointmentId"]);

			$timeslot = query("select * from timeslot where remarks = 'active'");
			

			$appointment = $appointment[0];


			$hint = '
			<div class="row">
              <div class="col-md-12">
			  <input type="hidden" name="action" value="acceptAppointment">
			  <input type="hidden" name="appointmentId" value="'.$appointment["appointmentId"].'">

			  <div class="form-group">
                    <label for="exampleInputEmail1">Client</label>
                    <input disabled type="text" value="'.$appointment["fullname"].' - '.$appointment["username"].'" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                  </div>



              <label for="exampleInputEmail1">Date of Appointment <span class="color-red">*</span></label><br>
              <div class="input-group">
              
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                  </div>
                  <input value="'.$appointment["dateSet"].'" placeholder="Select Date of Appointment here" required type="date" name="appointment_date" class="form-control" >
              
                </div>

				<br>

				<div class="form-group">
                        <label>Time Slot</label>
                        <select name="timeSlot" class="form-control">';
						foreach($timeslot as $row):
							if($row["slotId"] == $appointment["timeSet"]):
								$hint.='<option selected value="'.$row["slotId"].'">'.$row["timeSlot"].'</option>';
							else:
								$hint.='<option value="'.$row["slotId"].'">'.$row["timeSlot"].'</option>';
							endif;
						endforeach;
                        $hint.='</select>
                      </div>
             
              
          
			 
			  </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label>Summary Note of Appointment</label>
                  <textarea disabled required name="noteAppointment" class="form-control" rows="3" placeholder="Reason of Appointment">'.$appointment["notes"].'</textarea>
                </div>
              </div>
            </div>
			<button type="submit" class="btn btn-primary">Submit</button>
			';
			echo($hint);
		elseif($_POST["action"] == "acceptAppointment"):
			// dump($_SESSION);

			query("update appointment set dateSet = ?, timeSet = ?, appointmentStatus = 'ONGOING' where appointmentId = ?", $_POST["appointment_date"], $_POST["timeSlot"], $_POST["appointmentId"]);
			$appointment = query("select a.*, u.*, t.timeSlot, t.startTime, t.endTime from appointment a
								left join users u
								on a.clientId = u.userid
								left join timeslot t
								on t.slotId = a.timeSet
								where a.appointmentId = ?
								",$_POST["appointmentId"]);
			// dump($appointment);
			$appointment = $appointment[0];

			$google->setAccessToken($_SESSION["dnsc_geoanalytics"]['accessToken']);
			$service = new Google_Service_Calendar($google);
			$calendarId= "15df82f54cf28baa57c00d9fc76503ed9d5b0fcaef7ec5595fc7e04a87fb72f2@group.calendar.google.com";
			// $optParams = array(
			// 	'maxResults' => 10,
			// 	'orderBy' => 'startTime',
			// 	'singleEvents' => true,
			// 	// 'timeMin' => date(format: 'c'),
			// );

			// $results = $service->events->listEvents($calendarId, $optParams);
			// $events = $results->getItems();
			// dump($events);


			$event = new Google_Service_Calendar_Event(array(
				'summary' => 'CHECKUP for CITY VET - ' . $appointment["fullname"],
				'location' => 'City Veterinary Office',
				'description' => 'Book an appointment for checkup',
				'start' => array(
				  'dateTime' => ''.$appointment["dateSet"].'T'.$appointment["startTime"].':00+08:00',
				  'timeZone' => 'Asia/Manila',
				),
				'end' => array(
				  'dateTime' => ''.$appointment["dateSet"].'T'.$appointment["endTime"].':00+08:00',
				  'timeZone' => 'Asia/Manila',
				),
				'attendees' => array(
				  array('email' => $_SESSION["dnsc_geoanalytics"]["uname"]),
				  array('email' => ''.$appointment["username"].''),
				//   array('email' => 'sbrin@example.com'),
				),
				'reminders' => array(
				  'useDefault' => FALSE,
				  'overrides' => array(
					array('method' => 'email', 'minutes' => 24 * 60),
					array('method' => 'popup', 'minutes' => 10),
				  ),
				 

				),

				'conferenceData' => array(
					'createRequest' => array(
						'requestId' => time(),
					),
				),
			  ));
			
			//   $calendarId = 'primary';
			  $event = $service->events->insert($calendarId, $event, ['conferenceDataVersion' => 1]);
			//   dump($event->hangoutLink);

			  query("update appointment set meetId = ? where appointmentId = ?", $event->hangoutLink, $_POST["appointmentId"]);

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
				render("public/appointment_system/appointmentList.php",[]);
			else:
				if($_GET["action"] == "specific"):
					render("public/pets_system/petSpecific.php",[]);
				endif;
			endif;
		}

		// if()
		// 

		
?>
