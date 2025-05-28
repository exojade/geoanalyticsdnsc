<?php

    if($_SERVER["REQUEST_METHOD"] === "POST") {
		// dump($_SESSION);
		if($_POST["action"] == "pet_breeds_list"):
			// dump($_SESSION);

			$draw = isset($_POST["draw"]) ? $_POST["draw"] : 1;
            $offset = $_POST["start"];
            $limit = $_POST["length"];
            $search = $_POST["search"]["value"];


			$where = " where 1=1";


			$limitString = " limit " . $limit;
			$offsetString = " offset " . $offset;
			$baseQuery = "select * from pet_breeds";


			// $query = query("select * from pet where clientId = ?", $_SESSION["dnsc_geoanalytics"]["userid"]);
			if($search == ""):
              
            else:
               $where .= " and breed like '%".$search."%'";
                // $all_data = $data;
            endif;
			// dump($query);
			$data = query($baseQuery . $where . $limitString . $offsetString);
			$all_data = query($baseQuery . $where);

			$i = 0;
			foreach($data as $row):
				// dump($row);
				$data[$i]["action"] = '
					<form class="generic_form_trigger" data-url="pet_breeds">
					<input type="hidden" name="action" value="delete_breed">
					<input type="hidden" name="breed_id" value="'.$row["breed_id"].'">
						<button class="btn btn-danger btn-sm btn-block">Delete</button>
					</form>
				';
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

		elseif($_POST["action"] == "delete_breed"):
				// dump($_FILES);


				query("delete from pet_breeds where breed_id = ?", $_POST["breed_id"]);
				$res_arr = [
				"result" => "success",
				"title" => "Success",
				"message" => "Success on deleting breed!",
				"link" => "refresh",
				// "html" => '<a href="#">View or Print '.$transaction_id.'</a>'
				];
				echo json_encode($res_arr); exit();

			

		elseif($_POST["action"] == "add_pet_breed"):
			// dump($_POST);
		
			if (query("insert INTO pet_breeds (species, breed) 
				VALUES(?,?)", 
				$_POST["species"], $_POST["breed"]) === false)
				{
					echo("not_success");
				}
          	else;
			$res_arr = [
				"result" => "success",
				"title" => "Success",
				"message" => "Success on adding breed!",
				"link" => "refresh",
				// "html" => '<a href="#">View or Print '.$transaction_id.'</a>'
				];
				echo json_encode($res_arr); exit();
			

		endif;
    }
	else {
		if(!isset($_GET["action"])):
			render("public/pet_breeds_system/pet_breeds_list.php",[]);
		else:
			if($_GET["action"] == "specific"):
				render("public/pets_system/petSpecific.php",[]);
			endif;
		endif;
	}
?>
