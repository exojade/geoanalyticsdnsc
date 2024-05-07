<?php

    if($_SERVER["REQUEST_METHOD"] === "POST") {
		// dump($_SESSION);
		if($_POST["action"] == "petsList"):
			// dump($_SESSION);

			$draw = isset($_POST["draw"]) ? $_POST["draw"] : 1;
            $offset = $_POST["start"];
            $limit = $_POST["length"];
            $search = $_POST["search"]["value"];

			$limitString = " limit " . $limit;
			$offsetString = " offset " . $offset;
			$baseQuery = "select * from pet where clientId = '".$_SESSION["dnsc_geoanalytics"]["userid"]."'";

			// $query = query("select * from pet where clientId = ?", $_SESSION["dnsc_geoanalytics"]["userid"]);
			if($search == ""):
                $data = query($baseQuery . " " . $limitString . " " . $offsetString);
                $all_data = query($baseQuery);
            else:
                
                                // dump($query_string);
                $data = query($baseQuery . " and petName like '%".$search."%'" . " " . $limitString . " " . $offsetString);
                $all_data = query($baseQuery . " and petName like '%".$search."%'");
                // $all_data = $data;
            endif;
			// dump($query);
			$i = 0;
			foreach($data as $row):
				// dump($row);
				$data[$i]["action"] = '<a href="pets?action=specific&id='.$row["petId"].'"  class="btn btn-primary btn-block">View</a>';
				if($row["image"] == ""):
					if($row["petType"] == "Cat"):
						$data[$i]["image"] = '<img style="border: 2px solid black;" src="uploads/catVector.jpeg" width="50" height="50">';
					else:
						$data[$i]["image"] = '<img style="border: 2px solid black;" src="uploads/dogVector.jpeg" width="50" height="50">';
					endif;

				else:
					$data[$i]["image"] = '<img style="border: 2px solid black;" src="'.$row["image"].'" width="50" height="50">';
				endif;
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

			

		elseif($_POST["action"] == "addNewPet"):
			// dump($_POST);
			$clientId = $_SESSION["dnsc_geoanalytics"]["userid"];
			$petId = create_trackid("PET");
			if (query("insert INTO pet (petId, petName, petType, petBreed, petDescription, clientId) 
				VALUES(?,?,?,?,?,?)", 
				$petId, $_POST["petName"] ,$_POST["typePet"], $_POST["petBreed"], $_POST["petDescription"], $clientId) === false)
				{
					echo("not_success");
				}
          	else;
			  if($_FILES["petImage"]["size"] != 0):
				$target_pdf = "uploads/";
				$path_parts = pathinfo($_FILES["petImage"]["name"]);
				$extension = $path_parts['extension'];
				$target = $target_pdf . $petId. "." . $extension;
				if(!move_uploaded_file($_FILES['petImage']['tmp_name'], $target)){
					echo("FAMILY Do not have upload files");
					exit();
				}
			query("update pet set image = '".$target."'
					where petId = '".$petId."'");
			endif;

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
			render("public/pets_system/petsList.php",[]);
		else:
			if($_GET["action"] == "specific"):
				render("public/pets_system/petSpecific.php",[]);
			endif;
		endif;
	}
?>
