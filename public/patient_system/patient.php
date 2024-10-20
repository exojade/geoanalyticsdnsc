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
				$data[$i]["action"] = '
				<div class="btn-group btn-block">
					<a href="patient?action=specific&id='.$row["clientId"].'" class="btn btn-sm btn-info">View</a>
					<a href="#" data-id="'.$row["clientId"].'" data-target="#updatePatientModal" data-toggle="modal" class="btn btn-sm btn-warning">Update</a>
				</div>
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

		elseif($_POST["action"] == "updatePatientModal"):

			// dump($_POST);

			$client = query("select c.*, u.username from client c
								left join users u 
								on u.userid = c.clientId
								where c.clientId = ?", $_POST["clientId"]);

			$client = $client[0];


			$hint = '
			<input type="hidden" name="client_id" value="'.$client["clientId"].'">
			<div class="row">
                    <div class="col-md-3">
                      <div class="form-group">
                        <label for="exampleInputEmail1">First Name <span class="text-red">*</span></label>
                        <input required value="'.$client["firstname"].'" type="text" name="firstname" class="form-control" id="exampleInputEmail1" placeholder="First Name">
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Middle Name </label>
                        <input  type="text" value="'.$client["middlename"].'" name="middlename" class="form-control" id="exampleInputEmail1" placeholder="Middle Name">
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Last Name <span class="text-red">*</span></label>
                        <input required type="text" value="'.$client["lastname"].'" name="lastname" class="form-control" id="exampleInputEmail1" placeholder="Last Name">
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Name Extension</label>
                        <input  type="text" value="'.$client["nameExtension"].'" name="nameExtension" class="form-control" id="exampleInputEmail1" placeholder="Ex. Sr. Jr. II III">
                      </div>
                    </div>
                  </div>

                  <div class="row">
                          <div class="col-md-3">
                            <div class="form-group">
                              <label for="exampleInputEmail1">Region <span class="text-red">*</span></label>
                              <select style="width:100%;" required class="form-control select2" id="region_select" disabled>
                            		<option selected value="'.$client["region"].'">'.$client["region"].'</option>
                              </select>
                            </div>
                          </div>
                          <div class="col-md-3">
                            <div class="form-group">
                              <label for="exampleInputEmail1">Province <span class="text-red">*</span></label>
                              <select style="width:100%;" width="100%" required class="form-control select2" id="province_select" disabled>
                                  <option selected value="'.$client["region"].'">'.$client["region"].'</option>
                              </select>
                            </div>
                          </div>
                          <div class="col-md-3">
                            <div class="form-group">
                              <label for="exampleInputEmail1">City | Municipality <span class="text-red">*</span></label>
                              <select style="width:100%;" width="100%" required class="form-control select2" id="city_mun_select" disabled>
                                  <option selected value="'.$client["cityMun"].'">'.$client["cityMun"].'</option>
                              </select>
                            </div>
                          </div>
                          <div class="col-md-3">
                            <div class="form-group">
                              <label for="exampleInputEmail1">Barangay <span class="text-red">*</span></label>
                              <select style="width:100%;" name="barangay" width="100%" required class="form-control select2" id="barangay_select">';

								  $barangayNames = array(
									"A. O. Floirendo",
									"Datu Abdul Dadia",
									"Buenavista",
									"Cacao",
									"Cagangohan",
									"Consolacion",
									"Dapco",
									"Gredu (Poblacion)",
									"J.P. Laurel",
									"Kasilak",
									"Katipunan",
									"Katualan",
									"Kauswagan",
									"Kiotoy",
									"Little Panay",
									"Lower Panaga (Roxas)",
									"Mabunao",
									"Maduao",
									"Malativas",
									"Manay",
									"Nanyo",
									"New Malaga (Dalisay)",
									"New Malitbog",
									"New Pandan (Pob.)",
									"New Visayas",
									"Quezon",
									"Salvacion",
									"San Francisco (Poblacion)",
									"San Nicolas",
									"San Pedro",
									"San Roque",
									"San Vicente",
									"Santa Cruz",
									"Santo Niño (Poblacion)",
									"Sindaton",
									"Southern Davao",
									"Tagpore",
									"Tibungol",
									"Upper Licanan",
									"Waterfall"
								);

								foreach($barangayNames as $row):
									if($row == $client["barangay"]):
										$hint .=' <option selected value="'.$row.'">'.$row.'</option>';
									else:
										$hint .=' <option value="'.$row.'">'.$row.'</option>';
									endif;
								endforeach;
								


								$hint .='
                              </select>
                            </div>
                          </div>
                      </div>
                  
                      <div class="row">
                          <div class="col-md-12">
                            <div class="form-group">
                              <label>Street / House Number / Purok <span class="text-red">*</span></label>
                              <input value="'.$client["address"].'" name="address" required type="text" class="form-control"  placeholder="Street / House Number / Purok">
                            </div>
                          </div>
                      </div>

                      <div class="row">
                          <div class="col-md-4">
                            <div class="form-group">
                              <label>Birthdate <span class="text-red">*</span></label>
                              <input  max="'.date('Y-m-d').'" value="'.$client["birthDate"].'" name="birthDate" required type="date" class="form-control"  placeholder="Birthdate">
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-group">
                              <label>Sex <span class="text-red">*</span></label>
                              <select required name="gender" class="form-control select2" >
                               <option selected value="'.$client["gender"].'">'.$client["gender"].'</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                              </select>
                            </div>
                          </div>

                          <div class="col-md-4">
                          <div class="form-group">
                              <label>Contact Number:</label>
                              <div class="input-group">
                                <div class="input-group-prepend">
                                  <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                </div>
                                <input name="contactNumber" value="'.$client["contactNumber"].'" required type="text" class="form-control" data-inputmask=\'"mask": "(+63) 9999999999"\' data-mask>
                              </div>
                              <!-- /.input group -->
                            </div>
                          </div>
                      </div>
			
			
			';


			echo($hint);


			elseif($_POST["action"] == "modalUpdatePet"):

				// dump($_POST);
	
				$pet = query("select * from pet where petId = ?", $_POST["petId"]);
	
				$pet = $pet[0];
	
	
				$hint = '
				<input type="hidden" name="petId" value="'.$_POST["petId"].'">
				<div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="exampleInputEmail1">Pet Name <span class="color-red">*</span></label>
                  <input required type="text" name="petName" value="'.$pet["petName"].'" class="form-control" id="exampleInputEmail1" placeholder="---">
                </div>
              </div>
              <div class="col-md-4">
              <div class="form-group">
                  <label for="exampleInputEmail1">Type of Pet <span class="color-red">*</span></label>
                  <select required class="form-control" name="typePet">
                  	<option value="'.$pet["petType"].'" selected >'.$pet["petType"].'</option>
                    <option value="Cat">Cat</option>
                    <option value="Dog">Dog</option>
                  </select>
                </div>
              </div>
              <div class="col-md-8">
                <div class="form-group">
                  <label for="exampleInputEmail1">Breed <span class="color-red">*</span></label>
                  <input value="'.$pet["petBreed"].'" required type="text" name="petBreed" class="form-control" id="exampleInputEmail1" placeholder="---">
                </div>
              </div>


              <div class="col-md-4">
              <div class="form-group">
                  <label for="exampleInputEmail1">Date of Birth <span class="color-red">*</span></label>
                  <input value="'.$pet["petDob"].'" required type="date" name="petDob" class="form-control" id="exampleInputEmail1" placeholder="---">
                </div>
              </div>
              <div class="col-md-8">
                <div class="form-group">
                  <label for="exampleInputEmail1">Gender <span class="color-red">*</span></label>
                  <select required class="form-control" name="petGender">
                  <option value="'.$pet["petGender"].'" selected>'.$pet["petGender"].'</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                  </select>
                </div>
              </div>

           
              <div class="col-md-4">

			  <div class="card" >';


			  if($pet["image"] != ""):
				$hint .='<img class="bd-placeholder-img img-responsive card-img-top p-3" width="100%" height="auto" src="'.$pet["image"].'" role="img" aria-label="Placeholder: Image cap" preserveAspectRatio="xMidYMid slice" focusable="false">';
			  else:
				$hint .='<img class="bd-placeholder-img img-responsive card-img-top p-3" width="100%" height="auto" src="resources/default.jpg" role="img" aria-label="Placeholder: Image cap" preserveAspectRatio="xMidYMid slice" focusable="false">';
			  endif;


			  $hint.='
				</div>
              
                </div>

				   <div class="col-md-8">
                <div class="form-group">
                  <label>Pet Description</label>
                  <textarea name="petDescription" class="form-control" rows="3" placeholder="Enter ...">'.$pet["petDescription"].'</textarea>
                </div>

				    <div class="form-group">
                      <label for="exampleInputFile">Image of Pet</label>
                      <br>
                      <input name="petImage"  type="file" accept=".pdf, image/*" id="exampleInputFile">
                      <p class="help-block">Upload Image of Pet Here!</p>
                  </div>
              </div>
            </div>
				
				';
	
	
				echo($hint);


		elseif($_POST["action"] == "updatePatient"):
			// dump($_POST);

			$barangayId = convertBrgytoNumber($_POST["barangay"]);
			query("update client set 
					firstname = '".$_POST["firstname"]."',
					middlename = '".$_POST["middlename"]."',
					lastname = '".$_POST["lastname"]."',
					nameExtension = '".$_POST["nameExtension"]."',
					barangay = '".$_POST["barangay"]."',
					address = '".$_POST["address"]."',
					contactNumber = '".$_POST["contactNumber"]."',
					birthDate = '".$_POST["birthDate"]."',
					gender = '".$_POST["gender"]."',
					clientStatus = 'DONE UPDATE',
					barangayId = '".$barangayId."'
					where clientId = ?
					", $_POST["client_id"]);

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
				render("public/patient_system/patientList.php",[]);
		else:
			if($_GET["action"] == "specific"):
				if($_SESSION["dnsc_geoanalytics"]["role"] == "admin" || $_SESSION["dnsc_geoanalytics"]["role"] == "DOCTOR"):
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
