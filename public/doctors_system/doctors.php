<?php
    if($_SERVER["REQUEST_METHOD"] === "POST") {


		if($_POST["action"] == "getData"):
			// dump($_POST);
			$pds = query("select d.*, u.username from doctors d 
							left join users u on u.userid = d.doctorsId
							where d.doctorsId = ?", $_REQUEST["doctorsId"]);
			$data = $pds[0];
			echo json_encode($pds);
		endif;

		if($_POST["action"] == "updatedoctorInfo"):
			// dump($_POST);

			$doctor = $_POST["doctor"];

			query("update doctors set
					doctorsFirstname = ?,
					doctorsMiddlename = ?,
					doctorsLastname = ?,
					doctorsExtension = ?,
					doctorsRegion = ?,
					doctorsProvince = ?,
					doctorsCitymun = ?,
					doctorsBarangay = ?,
					doctorsAddress = ?,
					doctorsContactNumber = ?,
					doctorsSex = ?,
					doctorsBirthday = ?,
					doctorsLicenseNumber = ?
					where doctorsId = ?",
					$doctor["doctorsFirstname"],
					$doctor["doctorsMiddlename"],
					$doctor["doctorsLastname"],
					$doctor["doctorsExtension"],
					$doctor["doctorsRegion"],
					$doctor["doctorsProvince"],
					$doctor["doctorsCitymun"],
					$doctor["doctorsBarangay"],
					$doctor["doctorsAddress"],
					$doctor["doctorsContactNumber"],
					$doctor["doctorsSex"],
					$doctor["doctorsBirthday"],
					$doctor["doctorsLicenseNumber"],
					$doctor["doctorsId"]
				);


				query("update users set
					username = ?
					where userid = ?",
					$doctor["username"],
					$doctor["doctorsId"]
				);

				echo(1);
		endif;

		if($_POST["action"] == "doctorsList"):
			// dump($_POST);

			$draw = isset($_POST["draw"]) ? $_POST["draw"] : 1;
            $offset = $_POST["start"];
            $limit = $_POST["length"];
            $search = $_POST["search"]["value"];


			$limitString = " limit " . $limit;
			$offsetString = " offset " . $offset;
		



			$where = " where 1=1";


			$baseQuery = "select * from doctors " . $where;


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
				$data[$i]["action"] = '<a href="doctors?action=update&id='.$row["doctorsId"].'" class="btn btn-block btn-sm btn-warning">Update</a>
				';
				$data[$i]["name"] = $row["doctorsLastname"] . ", " . $row["doctorsFirstname"];
				$data[$i]["address"] = $row["doctorsProvince"] . ", " . $row["doctorsCitymun"] . ", " . strtoupper($row["doctorsBarangay"]) . ", " . $row["doctorsAddress"];
				$data[$i]["gender"] = $row["doctorsSex"];
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
												doctorsAddress, doctorsContactNumber, doctorsSex, doctorsBirthday, doctorsLicenseNumber) 
				VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?)", 
				$doctorId, $_POST["firstname"], $_POST["middlename"], $_POST["lastname"], $_POST["nameExtension"],
				$_POST["region"], $_POST["province"], $_POST["cityMun"], $_POST["barangay"], $_POST["address"],
				$_POST["contactNumber"], $_POST["gender"], $_POST["birthDate"],$_POST["licenseNumber"]);

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
	
	
	
	
	
			endif;

			


    }
	else {
		if(!isset($_GET["action"])):
				render("public/doctors_system/doctorsList.php",[]);
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
			elseif($_GET["action"] == "update"):
		
				render("public/doctors_system/updateDoctorForm.php",[]);
			endif;
		endif;


			
	}
?>
