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
				$data[$i]["action"] = '<a href="#" class="btn btn-block btn-sm btn-warning">Update</a>';
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
