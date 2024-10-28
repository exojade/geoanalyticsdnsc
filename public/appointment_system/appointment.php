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
			foreach($scheduletime as $scheds):
				$sched = $scheds;
				if(isset($schedules_taken[$scheds["slotId"]])):
					$scheduletime[$scheds["slotId"]]["slotsAvailable"] = $scheduletime[$scheds["slotId"]]["slotsAvailable"] - $schedules_taken[$scheds["slotId"]]["count"];
				endif;
			endforeach;
			
			echo("<div class='row'>");
			echo("<div class='col-md-6'>");
			$count = 0;
			foreach($scheduletime as $s):
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
				if( $week == "Sunday"):
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

		elseif($_POST["action"] == "appointmentList" && $_SESSION["dnsc_geoanalytics"]["role"] == "admin"):

			$draw = isset($_POST["draw"]) ? $_POST["draw"] : 1;
            $offset = $_POST["start"];
            $limit = $_POST["length"];
            $search = $_POST["search"]["value"];

			$limitString = " limit " . $limit;
			$offsetString = " offset " . $offset;
			$baseQuery = "SELECT * FROM appointment
              ORDER BY 
              CASE 
                WHEN appointmentStatus = 'PENDING' THEN 0 
                ELSE 1 
              END, 
              dateSet DESC, 
              timeSet DESC";

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

			$Doctors = [];
			$doctors = query("select * from doctors");
			foreach($doctors as $row):
				$Doctors[$row["doctorsId"]] = $row;
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
				

				$data[$i]["client"] = $Client[$row["clientId"]]["fullname"];
				$data[$i]["email"] = $Client[$row["clientId"]]["username"];
				if($row["appointmentStatus"] == "PENDING"):
					$data[$i]["action"] = '
				<form class="generic_form_trigger" style="display:inline;" data-url="appointment">
				<input type="hidden" name="action" value="cancelAppointment">
				<div class="btn-group btn-block" width="100%">
                        <a href="#" data-toggle="modal" data-id="'.$row["appointmentId"].'" data-target="#modalAppointmentDetails" class="btn btn-sm btn-info"><i class="fa fa-eye"></i></a>

                        <a href="#" data-toggle="modal" data-id="'.$row["appointmentId"].'" data-target="#modalAppointment" class="btn btn-sm btn-success"><i class="fa fa-check"></i></a>
                      
											
											<button class="btn btn-sm btn-danger"><i class="fa fa-times"></i></button>
									
                      </div>
					  </form>
				';

				
					$data[$i]["doctor"] = "";
				elseif($row["appointmentStatus"] == "CANCELLED"):

					$data[$i]["action"] = '
					<form class="generic_form_trigger" style="display:inline;" data-url="appointment">
					<input type="hidden" name="action" value="cancelAppointment">
					<div class="btn-group" width="100%">
							<a href="#" data-toggle="modal" data-id="'.$row["appointmentId"].'" data-target="#modalAppointment" class="btn btn-sm btn-success">Accept</a>
												<button disabled class="btn btn-sm btn-danger">NO ACTION</button>
						  </div>
						  </form>
					';
					
					$data[$i]["doctor"] = "";
				else:

					$data[$i]["action"] = '
					<a href="#" data-toggle="modal" data-id="'.$row["appointmentId"].'" data-target="#modalAppointmentDetails" class="btn btn-block btn-sm btn-info"><i class="fa fa-eye"></i> Details</a>
					';
					$data[$i]["doctor"] = $Doctors[$row["doctorId"]]["doctorsLastname"] . ", " . $Doctors[$row["doctorId"]]["doctorsFirstname"];
				endif;
				$data[$i]["timeSet"] = $TimeSlot[$row["timeSet"]]["timeSlot"];


				switch ($row["appointmentStatus"]) {
					case "ONGOING":
						// Code for handling ONGOING status
						$data[$i]["appointmentStatus"] = "<span class='text-blue'>".$row["appointmentStatus"]."</span>";
						break;
				
					case "DONE":
						$data[$i]["appointmentStatus"] = "<span class='text-green'>".$row["appointmentStatus"]."</span>";
						break;
				
					case "PENDING":
						$data[$i]["appointmentStatus"] = "<span class='text-yellow'>".$row["appointmentStatus"]."</span>";
						break;
				
					default:
						// Code for handling unknown status
						$data[$i]["appointmentStatus"] = "<span class='text-red'>".$row["appointmentStatus"]."</span>";
						// echo "Unknown appointment status.";
						break;
				}

				
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


		elseif($_POST["action"] == "appointmentList" && $_SESSION["dnsc_geoanalytics"]["role"] == "DOCTOR"):

				$draw = isset($_POST["draw"]) ? $_POST["draw"] : 1;
				$offset = $_POST["start"];
				$limit = $_POST["length"];
				$search = $_POST["search"]["value"];
	
				$limitString = " limit " . $limit;
				$offsetString = " offset " . $offset;
				$baseQuery = "select a.*, t.timeSlot from appointment a left join timeslot t on t.slotId = a.timeSet where doctorId = '".$_SESSION["dnsc_geoanalytics"]["userid"]."' and appointmentStatus = 'ONGOING' order by timestampSet desc";
	
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
	
				$Doctors = [];
				$doctors = query("select * from doctors");
				foreach($doctors as $row):
					$Doctors[$row["doctorsId"]] = $row;
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


				$TimeSlot = [];
				$timeslot = query("select * from timeslot");
				foreach($timeslot as $row):
					$TimeSlot[$row["slotId"]] = $row;
				endforeach;


				foreach($data as $row):
					// dump($row);
					$data[$i]["action"] = '


				<div class="btn-group btn-block" width="100%">
				<a href="#" data-id="'.$row["appointmentId"].'" data-target="#modalAppointmentDetails" data-toggle="modal" class="btn btn-flat btn-sm btn-info" ><i class="fa fa-eye mb-0"></i></a>

				<form class="generic_form_trigger mb-0" data-url="appointment" >
					<input type="hidden" name="action" value="markDoneAppointment">
					<input type="hidden" name="appointmentId" value="'.$row["appointmentId"].'">		
						<button class="btn btn-sm btn-success btn-flat"><i class="fa fa-check"></i></button>
					</form>
				<a href="#" data-id="'.$row["appointmentId"].'" data-target="#rescheduleModal" data-toggle="modal" class="btn btn-flat btn-sm btn-warning" ><i class="fa fa-edit mb-0"></i></a>

                     <form class="generic_form_trigger" data-url="appointment">
					<input type="hidden" name="action" value="markDoneAppointment">
					<input type="hidden" name="appointmentId" value="'.$row["appointmentId"].'">		
						<button class="btn btn-sm btn-danger btn-flat"><i class="fa fa-times"></i></button>
					</form> 
											

									
                      </div>
			
					';
	
					$data[$i]["client"] = $Client[$row["clientId"]]["fullname"];
					$data[$i]["email"] = $Client[$row["clientId"]]["username"];
					$data[$i]["doctor"] = "<a href='".$row["meetId"]."' target='_blank' class='btn btn-sm btn-block btn-info'>Proceed to Google Meet</a>
					";

					$data[$i]["timeSet"] = $TimeSlot[$row["timeSet"]]["timeSlot"];
	
					
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

		elseif($_POST["action"] == "modalAppointmentDetails"):
			

			$appointment = query("
				select a.*, t.timeSlot, c.barangay, c.address, c.contactNumber,
				u.username, u.fullname
				from appointment a
				left join timeslot t
				on t.slotId = a.timeSet
				left join client c
				on c.clientId = a.clientId
				left join users u
				on u.userid = c.clientId
				where a.appointmentId = ?
			", $_POST["appointmentId"]);

			$appointment = $appointment[0];
			// dump($appointment);


			$hint = "";

			$hint .= '
			<div class="card">
				<div class="card-body">
				<table class="table" id="sectionTable">
				<tr>
                      <th>Client Name:</th>
                      <td>'.$appointment["fullname"].'</td>
					    <th>Email Address:</th>
                      <td>'.$appointment["username"].'</td>
                    </tr>
					<tr>
                      <th>Barangay:</th>
                      <td>'.$appointment["barangay"].'</td>
					  <th>Home Address:</th>
                      <td>'.$appointment["address"].'</td>
                    </tr>
                  </table>

					</div>
				</div>';


				$date = $appointment["dateSet"];
				$dateTime = new DateTime($date);
				$formattedDate = $dateTime->format('l M d, Y') .  " , " . $appointment["timeSlot"];


				$date = $appointment["timestampSet"];
				$dateTime = (new DateTime())->setTimestamp($date);
				$formattedDateSet = $dateTime->format('l M d, Y');
				// echo $formattedDate;


			// $scheduleDate = DateTime('2024-01-01')->format('l M d, Y');


			switch ($appointment["appointmentStatus"]) {
				case "ONGOING":
					// Code for handling ONGOING status
					$appointment["appointmentStatus"] = "<span class='text-blue'>".$appointment["appointmentStatus"]."</span>";
					break;
			
				case "DONE":
					$appointment["appointmentStatus"] = "<span class='text-green'>".$appointment["appointmentStatus"]."</span>";
					break;
			
				case "PENDING":
					$appointment["appointmentStatus"] = "<span class='text-yellow'>".$appointment["appointmentStatus"]."</span>";
					break;
			
				default:
					// Code for handling unknown status
					$appointment["appointmentStatus"] = "<span class='text-red'>".$appointment["appointmentStatus"]."</span>";
					// echo "Unknown appointment status.";
					break;
			}


				$hint .= '
			<div class="card">
				<div class="card-body">
				<dl>
                  <dt>Schedule of Appointment:</dt>
                  <dd>'.$formattedDate.'</dd>
                </dl>
				<table class="table" id="sectionTable">
				<tr>
                      <th>Status:</th>
                      <td>'.$appointment["appointmentStatus"].'</td>
					    <th>Date Created:</th>
                      <td>'.$formattedDateSet.'</td>
                    </tr>
                  </table>

				<dl>
                  <dt>Notes for the Appointment:</dt>
                  <dd>'.nl2br($appointment["notes"]).'</dd>
                </dl>

					</div>
				</div>';

			if($appointment["meetId"] != ""):
				$hint .= '
			<div class="card">
				<div class="card-body">
				<dl>
                  <dt>Google Meet Link:</dt>
                  <dd><a style="margin-top:10px;" href="'.$appointment["meetId"].'" target="_blank" class="btn btn-sm btn-info btn-flat">'.$appointment["meetId"].'</a></dd>
                </dl>
					</div>
				</div>';
			endif;

				echo($hint);

		


		elseif($_POST["action"] == "rescheduleModal"):
			

			$appointment = query("select * from appointment where appointmentId = ?", $_POST["appointmentId"]);
			$appointment = $appointment[0];










			// dump($_POST);
			$appointment = query("select a.*, u.*, t.timeSlot from appointment a
								left join users u
								on a.clientId = u.userid
								left join timeslot t
								on t.slotId = a.timeSet
								where a.appointmentId = ?
								",$_POST["appointmentId"]);

			$timeslot = query("select * from timeslot where remarks = 'active'");
			// $doctors = query("select * from doctors");
			

			$appointment = $appointment[0];


			$hint = '
			<div class="row">
              <div class="col-md-12">
			  <input type="hidden" name="action" value="rescheduleAppointment">
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
                  <label>Reason to move appointment</label>
                  <textarea required name="reasonformove" class="form-control" rows="3" placeholder="Reason to move"></textarea>
                </div>
              </div>
            </div>
			<button type="submit" class="btn btn-primary">Submit</button>
			';
			echo($hint);






			// $google->setAccessToken($_SESSION["dnsc_geoanalytics"]['accessToken']);
			// $service = new Google_Service_Calendar($google);
			// $calendarId= $appointment["calendarId"];


			// $event = $service->events->get($calendarId, $appointment["eventId"]);
			// // dump($event);

			// $event->setSummary('New Summary'); // change the event title
			// $event->setLocation('New Location'); // change the event location

			// $start = new Google_Service_Calendar_EventDateTime();
			// $start->setDateTime('2024-07-31T10:00:00+08:00'); // new start time
			// $event->setStart($start);

			// $end = new Google_Service_Calendar_EventDateTime();
			// $end->setDateTime('2024-07-31T11:00:00+08:00'); // new end time
			// $event->setEnd($end);


			// $updatedEvent = $service->events->update($calendarId, $appointment["eventId"], $event, array('sendUpdates' => 'all'));
			// dump("okay");
			// $optParams = array(
			// 	'maxResults' => 10,
			// 	'orderBy' => 'startTime',
			// 	'singleEvents' => true,
			// 	// 'timeMin' => date(format: 'c'),
			// );

			// $results = $service->events->listEvents($calendarId, $optParams);
			// $events = $results->getItems();
			// dump($events);


	
			//   dump($event);

			//   query("update appointment set meetId = ?, calendarId = ?, eventId = ? where appointmentId = ?",
			//   			 $event->hangoutLink, $calendarId, $event->id, $_POST["appointmentId"]);

		elseif($_POST["action"] == "rescheduleAppointment"):
			// dump($_POST);	
			// dump($_SESSION["dnsc_geoanalytics"]["userid"]);

			$appointment = query("select * from appointment where doctorId = ? and timeSet = ? and dateSet = ?", $_SESSION["dnsc_geoanalytics"]["userid"],
							$_POST["timeSlot"], $_POST["appointment_date"]
					);

			// dump($appointment);

			if(!empty($appointment)):
				$res_arr = [
					"result" => "failed",
					"title" => "Failed",
					"message" => "Schedule and time is already taken. Cannot also pick same time and date from the original.",
					// "link" => "appointment",
					// "html" => '<a href="#">View or Print '.$transaction_id.'</a>'
					];
					echo json_encode($res_arr); exit();
			endif;

			$appointment = query("select * from appointment where appointmentId = ?", $_POST["appointmentId"]);
			$appointment = $appointment[0];

			$timeslot = query("select * from timeslot where slotId = ?" , $_POST["timeSlot"]);
			$timeslot = $timeslot[0];
			// dump($timeslot);

			$google->setAccessToken($_SESSION["dnsc_geoanalytics"]['accessToken']);
			$service = new Google_Service_Calendar($google);
			$calendarId= $appointment["calendarId"];


			$event = $service->events->get($calendarId, $appointment["eventId"]);
			// dump($event);

			$event->setSummary('CHECKUP for CITY VET'); // change the event title
			$event->setLocation('Panabo City Veterinary Office'); // change the event location

			$newNotes = $appointment["notes"] . " \n\nReschedule Notes: " . $_POST["reasonformove"];

			$event->setDescription($newNotes);


			$start = new Google_Service_Calendar_EventDateTime();
			// dump($timeslot["startTime"]);
			$start->setDateTime($_POST["appointment_date"] . 'T'.$timeslot["startTime"].':00+08:00'); // new start time
			// dump($start);
			$start->setTimeZone('Asia/Manila');
			$event->setStart($start);

			$end = new Google_Service_Calendar_EventDateTime();
			$end->setDateTime($_POST["appointment_date"] . 'T'.$timeslot["endTime"].':00+08:00'); // new end time
			$end->setTimeZone('Asia/Manila');
			$event->setEnd($end);

			// dump($event);

			// $conferenceData = new Google_Service_Calendar_ConferenceData();
			// $conferenceRequest = new Google_Service_Calendar_CreateConferenceRequest();
			// $conferenceRequest->setRequestId(time());
			// $conferenceData->setCreateRequest($conferenceRequest);
			// $event->setConferenceData($conferenceData);


			$updatedEvent = $service->events->update($calendarId, $appointment["eventId"], $event, array('sendUpdates' => 'all'));
			// dump("okay");

			query("update appointment set dateSet = ?, timeSet =?, notes=? where appointmentId = ? ",
					$_POST["appointment_date"], $_POST["timeSlot"], $newNotes, $_POST["appointmentId"]);

					$res_arr = [
						"result" => "success",
						"title" => "Success",
						"message" => "Success in updating Schedule",
						"link" => "appointment",
						// "html" => '<a href="#">View or Print '.$transaction_id.'</a>'
						];
						echo json_encode($res_arr); exit();



			// query();




		elseif($_POST["action"] == "markDoneAppointment"):
			// dump($_POST);
			query("update appointment set appointmentStatus = 'DONE' where appointmentId = ?", $_POST["appointmentId"]);

			$res_arr = [
				"result" => "success",
				"title" => "Success",
				"message" => "Success on updating data",
				"link" => "appointment",
				// "html" => '<a href="#">View or Print '.$transaction_id.'</a>'
				];
				echo json_encode($res_arr); exit();


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

			$doctors = query("select * from doctors");
			

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

				  <div class="form-group">
					<label>Doctor</label>
					<select name="doctorId" required class="form-control">
					<option value="" selected disabled>Please select doctor</option>
					';
					
					foreach($doctors as $row):
							$hint.='<option value="'.$row["doctorsId"].'">'.$row["doctorsLastname"] . ', ' . $row["doctorsFirstname"].'</option>';
					endforeach;
					$hint.='</select>
				</div>



              <label for="exampleInputEmail1">Date of Appointment <span class="color-red">*</span></label><br>
              <div class="input-group">
              
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                  </div>
                  <input value="'.$appointment["dateSet"].'" placeholder="Select Date of Appointment here" required type="date" name="appointment_date" class="form-control" >
              
                </div>

				<br>
				
				<div id="timeSlotDiv">
				<div class="form-group">
                        <label>Time Slot</label>
                        <select required name="timeSlot" class="form-control">';
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

		elseif($_POST["action"] == "checkDoctorSchedule"):

			$appointment = query("select * from appointment where appointmentId = ?", $_POST["appointmentId"]);
			$appointment = $appointment[0];
			// dump($_POST);

			
			$schedulesDoctors = query("SELECT 
					t.slotId, 
					t.timeSlot, 
					t.startTime, 
					t.endTime,
					IF(a.appointmentId IS NOT NULL, 'Not Available', 'Available') AS availability
				FROM timeslot t
				LEFT JOIN appointment a ON t.slotId = a.timeSet 
					AND a.dateSet = ?  -- Replace with the selected date
					AND a.doctorId = ?        -- Replace with the selected doctor ID
				WHERE t.remarks = 'active'
				ORDER BY t.startTime", $_POST["dateSet"], $_POST["doctorId"]);
			// dump($schedulesDoctors);

			$currentDateTime = new DateTime(); // Get the current date and time
			$currentDateTime->modify('+1 hour'); // Add one hour


			// $specificTime = "09:12 AM";
			// $currentDateTime = DateTime::createFromFormat('h:i A', $specificTime);
			// $currentDateTime->modify('+1 hour');

			// Format for comparison
			$currentFormattedTime = $currentDateTime->format('H:i');
			

			if(date("Y-m-d") > $_POST["dateSet"]):
				$hint = '
			<div class="form-group">
				<label>Time Slot</label>
				<select required name="timeSlot" class="form-control">';
				foreach($schedulesDoctors as $row):
					$hint .= '<option  value="" disabled class="text-danger">'.$row["timeSlot"].' - Not Available</option>';
				endforeach;
			$hint .= '</select>
			</div>';
			echo($hint);
			
			elseif(date("Y-m-d") == $_POST["dateSet"]):
				$hint = '
				<div class="form-group">
					<label>Time Slot</label>
					<select required name="timeSlot" class="form-control">';
					foreach($schedulesDoctors as $row):
						$startTime = $row['startTime'];
						$selected = ($appointment["timeSet"] == $row["slotId"]) ? 'selected' : '';
						if ($row["availability"] == "Available" && $startTime >= $currentFormattedTime) {
							// If available and meets the time condition
							$hint .= '<option '.$selected.' value="' . $row["slotId"] . '" class="text-success">' . $row["timeSlot"] . ' - Available</option>';
						} else {
							// If not available or does not meet the time condition
							$hint .= '<option '.$selected.' value="" disabled class="text-danger">' . $row["timeSlot"] . ' - Not Available</option>';
						}
					endforeach;
				$hint .= '</select>
				</div>';
				echo($hint);

			else:
				$hint = '
				<div class="form-group">
					<label>Time Slot</label>
					<select required name="timeSlot" class="form-control">';
					foreach($schedulesDoctors as $row):
						$startTime = $row['startTime'];
						$selected = ($appointment["timeSet"] == $row["slotId"]) ? 'selected' : '';
						if ($row["availability"] == "Available") {
							// If available and meets the time condition
							$hint .= '<option '.$selected.' value="' . $row["slotId"] . '" class="text-success">' . $row["timeSlot"] . ' - Available</option>';
						} else {
							// If not available or does not meet the time condition
							$hint .= '<option '.$selected.' value="" disabled class="text-danger">' . $row["timeSlot"] . ' - Not Available</option>';
						}
					endforeach;
				$hint .= '</select>
				</div>';
				echo($hint);
			endif;


			

		elseif($_POST["action"] == "checkDoctorScheduleWalkin"):
			
			$schedulesDoctors = query("SELECT 
					t.slotId, 
					t.timeSlot, 
					t.startTime, 
					t.endTime,
					IF(a.appointmentId IS NOT NULL, 'Not Available', 'Available') AS availability
				FROM timeslot t
				LEFT JOIN appointment a ON t.slotId = a.timeSet 
					AND a.dateSet = ?  -- Replace with the selected date
					AND a.doctorId = ?        -- Replace with the selected doctor ID
				WHERE t.remarks = 'active'
				ORDER BY t.startTime", date("Y-m-d"), $_POST["doctorId"]);
			// dump($schedulesDoctors);


			$currentDateTime = new DateTime(); // Get the current date and time
			$currentDateTime->modify('+1 hour'); // Add one hour


			// $specificTime = "09:12 AM";
			// $currentDateTime = DateTime::createFromFormat('h:i A', $specificTime);
			// $currentDateTime->modify('+1 hour');

			// Format for comparison
			$currentFormattedTime = $currentDateTime->format('H:i');
			// dump($currentFormattedTime);
			// Build the hint for available time slots
			$hint = '
			<div class="form-group">
				<label>Time Slot</label>
				<select required name="timeSlot" class="form-control">';

			foreach($schedulesDoctors as $row) {
				// Get the start time of the slot for comparison
				$startTime = $row['startTime']; // Assuming 'startTime' is in 'H:i' format

				// Check if the start time is less than the current time plus one hour
				if ($row["availability"] == "Available" && $startTime >= $currentFormattedTime) {
					// If available and meets the time condition
					$hint .= '<option value="' . $row["slotId"] . '" class="text-success">' . $row["timeSlot"] . ' - Available</option>';
				} else {
					// If not available or does not meet the time condition
					$hint .= '<option value="" disabled class="text-danger">' . $row["timeSlot"] . ' - Not Available</option>';
				}
			}

			$hint .= '</select>
			</div>';
			echo($hint);
			// echo($hint);



		// dump($_POST);

			
		elseif($_POST["action"] == "walkinAppointment"):
			// dump($_POST);


			$appointmentId = create_trackid("APP");
			// dump($appointmentId);

			if (query("insert INTO appointment (appointmentId, dateSet, timeSet, timestampSet, dateScheduled, appointmentStatus, clientId, notes, type,doctorId) 
				VALUES(?,?,?,?,?,?,?,?,'WALK IN',?)", 
				$appointmentId, date("Y-m-d"),$_POST["timeSlot"], time(), date("Y-m-d"), "ONGOING" ,$_POST["clientId"], "", $_POST["doctorId"]) === false)
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



		elseif($_POST["action"] == "acceptAppointment"):
			// dump($_SESSION);

			$doctor = query("select concat(doctorsFirstname, ' ', doctorsLastname, ' ', doctorsExtension) as doctorName from doctors where doctorsId = ?", $_POST["doctorId"]);
			$doctorName = $doctor[0]["doctorName"];

			query("update appointment set dateSet = ?, timeSet = ?, doctorId = ?, appointmentStatus = 'ONGOING' where appointmentId = ?", $_POST["appointment_date"], $_POST["timeSlot"], $_POST["doctorId"], $_POST["appointmentId"]);
			$appointment = query("select doctorUser.username as doctorEmail, a.*, u.*, t.timeSlot, t.startTime, t.endTime from appointment a
								left join users u
								on a.clientId = u.userid
								left join timeslot t
								on t.slotId = a.timeSet
								left join users doctorUser
								on doctorUser.userid = a.doctorId
								where a.appointmentId = ?
								",$_POST["appointmentId"]);
			// dump($appointment);
			$appointment = $appointment[0];

			$google->setAccessToken($_SESSION["dnsc_geoanalytics"]['accessToken']);
			$service = new Google_Service_Calendar($google);
			$siteOptions = query("select * from siteoptions");
			// dump($siteOptions);
			$calendarId= $siteOptions[0]["calendarId"];
			// $optParams = array(
			// 	'maxResults' => 10,
			// 	'orderBy' => 'startTime',
			// 	'singleEvents' => true,
			// 	// 'timeMin' => date(format: 'c'),
			// );

			// $results = $service->events->listEvents($calendarId, $optParams);
			// $events = $results->getItems();
			// dump($events);

			$description = " Booked an appointment for checkup. \n\nPet Owner: ".$appointment["fullname"]." \n\nNotes: " . $appointment["notes"] . "\n\nVet to attend: " . $doctorName;
			query("update appointment set notes = ? where appointmentId = ?", $description, $_POST["appointmentId"]);
			$event = new Google_Service_Calendar_Event(array(
				'summary' => 'CHECKUP for CITY VET - ' . $appointment["fullname"],
				'location' => 'Panabo City Veterinary Office',
				'description' => $description,
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
				  array('email' => ''.$appointment["doctorEmail"].''),
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
			  $event = $service->events->insert($calendarId, $event, array('conferenceDataVersion' => 1, 'sendNotifications' => true));
			//   dump($event);

			  query("update appointment set meetId = ?, calendarId = ?, eventId = ? where appointmentId = ?",
			  			 $event->hangoutLink, $calendarId, $event->id, $_POST["appointmentId"]);

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
