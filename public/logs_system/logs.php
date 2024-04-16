<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {	
        if($_POST["action"] == "activity_datatable"):
			
            // print_r($_REQUEST);
            $draw = isset($_POST["draw"]) ? $_POST["draw"] : 1;
            $offset = $_POST["start"];
            $limit = $_POST["length"];
            $search = $_POST["search"]["value"];
            $sql = query("select * from transaction_logs order by ddate desc");
            $all_data = $sql;
            if($search == ""){
                $query_string = "select * from transaction_logs
                                order by ddate desc
                                    limit ".$limit." offset ".$offset." ";
                $data = query($query_string);
            }
            else{
                $query_string = "
                    select * from transaction_logs
                    where 
                    concat(lastname, ', ', firstname) like '%".$search."%' or
                    concat(firstname, ' ', lastname) like '%".$search."%' or
                    MTOP_NO like '%".$search."%'
                    order by ddate desc
                    limit ".$limit." offset ".$offset."
                ";
                $data = query($query_string);
                $query_string = "
                        select * from transaction_logs
                        where 
                        concat(lastname, ', ', firstname) like '%".$search."%' or
						concat(firstname, ' ', lastname) like '%".$search."%' or
						MTOP_NO like '%".$search."%'
						order by ddate desc
                ";
                $all_data = query($query_string);
            }
            $i=0;
            foreach($data as $row):
				$data[$i]["fullname"] = $row["lastname"] . ", " . $row["firstname"];
				// $data[$i]["gender"] = $row["Gender"];
				// $data[$i]["mtop"] = "<a href='mtop_profile?action=profile&mtop=".$row["MTOP_NO"]."'>".$row["MTOP_NO"] ."</a>";
				// $data[$i]["mp_expiration_date"] = $Vehicle[$row["MTOP_NO"]]["mp_expiration_date"];
				// $data[$i]["expiration_date"] = $Vehicle[$row["MTOP_NO"]]["expiration_date"];
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
		
    }
    else
    {

        if(isset($_GET["action"])):

            if($_GET["action"] == "activity"):
                render("public/logs_system/activity_list.php");
            elseif($_GET["action"] == "fees"):
                render("public/logs_system/fees_list.php");
            endif;

        endif;

        // dump($user);
        
    }
?>