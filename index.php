<?php
    require("includes/config.php");
    require("includes/uuid.php");
    require("includes/checkhit.php");
	require("PHPMailer/PHPMailerAutoload.php");
	ini_set('max_execution_time', '300');
	
		$request = $_SERVER['REQUEST_URI'];
	
		$constants = get_defined_constants();
		$request = explode('/dnsc_geoanalytics',$request);
		// dump($request);
		$request = $request[1];
		$request = explode('?',$request);
		$request = $request[0];
		$request = explode('/',$request);
		$request = $request[1];
		$countering = array("login", "register", "print", "otp", "role", "static", "newAppointment", 
		"ourServices", "aboutUs", "contactUs", "google_login");
		// dump($_SESSION);
		if (!in_array($request, $countering)){
			if(empty($_SESSION["dnsc_geoanalytics"]["userid"]) && empty($_SESSION["dnsc_geoanalytics"]["application"])){
				require 'public/static_system/index.php';
			}
			else{
				// dump($_SESSION);
				if($_SESSION["dnsc_geoanalytics"]["role"] == "CLIENT" && $_SESSION["dnsc_geoanalytics"]["fillprofile"] == "NOT DONE"):
					if($request != "logout"):
						require 'public/profile_system/profileUpdate.php';
					else:
						require 'logout.php';
					endif;
				else:
					
				if($request == 'index' || $request == '/' || $request== "")
				require 'public/dashboard_system/main.php';
			else if ($request == 'users')
				require 'public/users_system/users.php';
			else if ($request == 'pets')
				require 'public/pets_system/pets.php';
			else if ($request == 'calendar')
				require 'public/calendar_system/calendar.php';

			else if ($request == 'disease')
				require 'public/disease_system/disease.php';

			else if ($request == 'ajaxMapDisease')
				require 'public/ajax_system/ajaxMapDisease.php';
			else if ($request == 'ajaxMap')
				require 'public/ajax_system/ajaxMap.php';
			
			else if ($request == 'profile')
				require 'public/profile_system/profile.php';

			else if ($request == 'schedule')
				require 'public/schedule_system/schedule.php';


			else if ($request == 'data_analysis')
				require 'public/data_analysis_system/data_analysis.php';


			else if ($request == 'static')
				require 'public/static_system/index.php';

			else if ($request == 'profileUpdate')
				require 'public/profile_system/profileUpdate.php';

			else if ($request == 'patient')
				require 'public/patient_system/patient.php';
			else if ($request == 'doctors')
				require 'public/doctors_system/doctors.php';

			else if ($request == 'petBoarding')
				require 'public/petBoarding_system/petBoarding.php';

			else if ($request == 'myAppointments')
				require 'public/appointment_system/myAppointments.php';
			else if ($request == 'appointment')
				require 'public/appointment_system/appointment.php';
			else if ($request == 'medical')
				require 'public/medical_system/medical.php';


			else if ($request == 'settings')
				require 'public/settings_system/settings.php';

			

			else if ($request == 'logout'){
			require 'logout.php';
		}
			else
				require 'public/404_system/404.php';
			
				endif;



			}
		}
		else{
			if ($request == 'login')
				require 'public/login_system/login.php';
			
			else if ($request == 'register')
				require 'public/register_system/register.php';

			else if ($request == 'otp')
				require 'public/otp_system/otp.php';

			else if ($request == 'role')
				require 'public/login_system/role.php';

			else if ($request == 'print')
					require 'public/print_system/print.php';
			else if ($request == 'home')
					require 'public/static_system/index.php';
			else if ($request == 'newAppointment')
					require 'public/appointment_system/newAppointment.php';
			else if ($request == 'ourServices')
					require 'public/static_system/services.php';
			else if ($request == 'aboutUs')
					require 'public/static_system/aboutUs.php';
			else if ($request == 'contactUs')
					require 'public/static_system/contactUs.php';
					else if ($request == 'google_login')
					require 'public/google_login.php';


		}
?>
