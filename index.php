<?php
    require("includes/config.php");
    require("includes/uuid.php");
    require("includes/checkhit.php");
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
		$countering = array("login", "register", "print", "otp", "role");
		if (!in_array($request, $countering)){
			if(empty($_SESSION["dnsc_geoanalytics"]["userid"]) && empty($_SESSION["dnsc_geoanalytics"]["application"])){
				require 'public/login_system/login.php';
			}
			else{
				if($request == 'index' || $request == '/' || $request== "")
					require 'public/dashboard_system/main.php';
				else if ($request == 'users')
					require 'public/users_system/users.php';
	

					// ajax_etracsOR
				

				else if ($request == 'logout'){
				require 'logout.php';
			}
				else
					require 'public/404_system/404.php';
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
		}
?>
