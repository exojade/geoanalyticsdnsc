<?php
    if($_SERVER["REQUEST_METHOD"] === "POST") {
		if($_POST["action"] == "announcementList"):
			// dump($_POST);

			$draw = isset($_POST["draw"]) ? $_POST["draw"] : 1;
            $offset = $_POST["start"];
            $limit = $_POST["length"];
            $search = $_POST["search"]["value"];


			$limitString = " limit " . $limit;
			$offsetString = " offset " . $offset;
			$baseQuery = "select * from announcements where 1=1";
			if($search == ""):
                $data = query($baseQuery . " " . $limitString . " " . $offsetString);
                $all_data = query($baseQuery);
            else:
                                // dump($query_string);
                $data = query($baseQuery . " and title LIKE '%".$search."%'" . " or description like '%".$search."%' " . $limitString . " " . $offsetString);
                $all_data = query($baseQuery . " and title LIKE '%".$search."%'" . " or description like '%".$search."%'");
                // $all_data = $data;
            endif;


			$i = 0;
			foreach($data as $row):
				// dump($row);
				$data[$i]["action"] = '<a href="#" class="btn btn-block btn-sm btn-warning">Update</a>';
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

      


        if($_POST["action"] == "addAnnouncement"):
            // dump($_FILES);


			$target_pdf = "resources/announcements/";
			if($_FILES["banner_image"]["size"] != 0){
				$target = $target_pdf . basename($_FILES['banner_image']['name']);
                    if(!move_uploaded_file($_FILES['banner_image']['tmp_name'], $target)){
                        echo("FAMILY Do not have upload files");
                        exit();
                    }
			}


            if (query("insert INTO announcements (title, description, status, banner_image) 
				VALUES(?,?,?,?)", 
				$_POST["title"], $_POST["description"] ,"ACTIVE", $target) === false)
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
				render("public/announcement_system/announcementList.php",[]);
		else:
		
		endif;


			
	}
?>
