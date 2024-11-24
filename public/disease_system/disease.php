<?php
    if($_SERVER["REQUEST_METHOD"] === "POST") {
		if($_POST["action"] == "diseaseRecords"):
			// dump($_POST);

			$draw = isset($_POST["draw"]) ? $_POST["draw"] : 1;
            $offset = $_POST["start"];
            $limit = $_POST["length"];
            $search = $_POST["search"]["value"];


			$limitString = " limit " . $limit;
			$offsetString = " offset " . $offset;
		



			$baseQuery = "select * from disease where 1=1";


			if($search == ""):
                $data = query($baseQuery . " " . $limitString . " " . $offsetString);
                $all_data = query($baseQuery);
            else:
                                // dump($query_string);
                $data = query($baseQuery . " and diseaseName LIKE '%".$search."%'" . " " . $limitString . " " . $offsetString);
                $all_data = query($baseQuery . " and diseaseName LIKE '%".$search."%'");
                // $all_data = $data;
            endif;


			$i = 0;
			foreach($data as $row):
				// dump($row);
				$data[$i]["action"] = '<a href="#" data-toggle="modal" data-target="#updateDiseaseModal" data-id="'.$row["diseaseId"].'" class="btn btn-block btn-sm btn-warning">Update</a>';
				$data[$i]["name"] = $row["diseaseName"];
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

        if($_POST["action"] == "updateDisease"):
            // dump($_POST);

            query("update disease set
                    diseaseName = ?,
                    species_affected = ?,
                    transmission_type = ?,
                    description = ?,
                    symptoms = ?,
                    treatment = ?,
                    is_contagious = ?
                    where diseaseId = ?",
                    $_POST["diseaseName"],
                    $_POST["speciesAffected"],
                    $_POST["transmission_type"],
                    $_POST["description"],
                    $_POST["symptoms"],
                    $_POST["treatment"],
                    $_POST["is_contagious"],
                    $_POST["diseaseId"],
                );

                $res_arr = [
                    "result" => "success",
                    "title" => "Success",
                    "message" => "Success on updating data",
                    "link" => "refresh",
                    // "html" => '<a href="#">View or Print '.$transaction_id.'</a>'
                    ];
                    echo json_encode($res_arr); exit();
        endif;

        if($_POST["action"] == "updateDiseaseModal"):
            // dump($_POST);
            $disease = query("select * from disease where diseaseId = ?", $_POST["diseaseId"]);
            $disease = $disease[0];
            // dump($disease);

            $hint = '
            <input type="hidden" name="diseaseId" value="'.$_POST["diseaseId"].'">
            <div class="form-group">
              <label for="exampleInputEmail1">Disease Name <span class="color-red">*</span></label>
              <input placeholder="Enter Disease Name Here" type="text" class="form-control" name="diseaseName" value="'.$disease["diseaseName"].'" required>
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Transmission Type <span class="color-red">*</span></label>
              <input value="'.$disease["transmission_type"].'" placeholder="Enter Transmission Type Here" type="text" class="form-control" name="transmission_type" required>
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Description <span class="color-red">*</span></label>
              <textarea name="description" required class="form-control">'.$disease["description"].'</textarea>
            </div>


            <div class="form-group">
                        <label>Species Affected <span class="color-red">*</span></label>
                        <select name="speciesAffected" required class="form-control">
                        <option selected value="'.$disease["species_affected"].'">'.$disease["species_affected"].'</option>  
                          <option value="cat">Cat</option>
                          <option value="dog">Dog</option>
                          <option value="both">Both</option>
                        </select>
                      </div>


            <div class="form-group">
              <label for="exampleInputEmail1">Symptoms <span class="color-red">*</span></label>
              <textarea name="symptoms" required class="form-control">'.$disease["symptoms"].'</textarea>
            </div>

            <div class="form-group">
              <label>Is it Contagious? <span class="color-red">*</span></label>
              <select name="is_contagious" required class="form-control">
                ';
            if($disease["is_contagious"] == 1):
                $hint.='<option value="1">Yes</option>';
            else:
                $hint.='<option value="0">No</option>';
            endif;
                $hint.='
                <option value="1">Yes</option>
                <option value="0">No</option>
              </select>
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Treatment <span class="color-red">*</span></label>
              <textarea name="treatment" required class="form-control">'.$disease["treatment"].'</textarea>
            </div>
            <hr>
            ';

            echo($hint);

        endif;

        if ($_POST['action'] == 'exportDiseaseRecords'):
            // dump($_POST);
            $search = isset($_POST["search"]) ? $_POST["search"] : '';
            // dump($search);
            header('Content-Type: text/csv');
            header('Content-Disposition: attachment; filename="disease_records.csv"');
        
            $output = fopen('php://output', 'w');
            fputcsv($output, ['Name', 'Transmission Type', 'Description', 'Symptoms', 'Treatment']); // Headers
        
            // Base query
            $query = "SELECT * FROM disease WHERE 1=1";
        
            // Apply search filter if provided
            if (!empty($search)) {
                $query .= " AND diseaseName LIKE '%" . $search . "%'";
            }
        
            $result = query($query);
        
            foreach ($result as $row) {
                fputcsv($output, [ // Action column placeholder
                    $row['diseaseName'],
                    $row['transmission_type'],
                    $row['description'],
                    $row['symptoms'],
                    $row['treatment']
                ]);
            }
        
            fclose($output);
            exit;
        endif;


        if($_POST["action"] == "addDisease"):
            // dump($_POST);
            if (query("insert INTO disease (diseaseName, species_affected, transmission_type, description, symptoms, treatment, is_contagious, created_at) 
				VALUES(?,?,?,?,?,?,?,?)", 
				$_POST["diseaseName"], $_POST["speciesAffected"] ,$_POST["transmissionType"], $_POST["description"], $_POST["symptoms"], $_POST["treatment"], 
                $_POST["is_contagious"], date("Y-m-d H:i:s")) === false)
				{
					echo("not_success");
				}

                $res_arr = [
                    "result" => "success",
                    "title" => "Success",
                    "message" => "Success on updating data",
                    "link" => "refresh",
                    // "html" => '<a href="#">View or Print '.$transaction_id.'</a>'
                    ];
                    echo json_encode($res_arr); exit();
            // dump($_POST);
        endif;

    }
	else {

		if(!isset($_GET["action"])):
				render("public/disease_system/diseaseList.php",[]);
		else:
		
		endif;


			
	}
?>
