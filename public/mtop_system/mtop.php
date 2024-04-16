<?php
use mikehaertl\pdftk\Pdf;
use PHPJasper\PHPJasper;

    if($_SERVER["REQUEST_METHOD"] === "POST") {
		if($_POST["action"] == "mtop_datatable"){
			
            // print_r($_REQUEST);
            $draw = isset($_POST["draw"]) ? $_POST["draw"] : 1;
            $offset = $_POST["start"];
            $limit = 10;
            $search = $_POST["search"]["value"];
            $sql = query("select * from operator");
            $vehicle = query("select * from vehicle");
            $Vehicle = [];
            foreach($vehicle as $row):
                $Vehicle[$row["MTOP_NO"]] = $row;
            endforeach;
            $all_data = $sql;
            if($search == ""){
                $query_string = "select * from operator
                                order by MTOP_NO ASC
                                    limit ".$limit." offset ".$offset." ";
                $data = query($query_string);
            }
            else{
                $query_string = "
                    select * from operator
                    where 
                    concat(lastname, ', ', firstname) like '%".$search."%' or
                    concat(firstname, ' ', lastname) like '%".$search."%' or
                    MTOP_NO like '%".$search."%'
                    order by MTOP_NO ASC
                    limit ".$limit." offset ".$offset."
                ";
                $data = query($query_string);
                $query_string = "
                        select * from operator
                        where 
                        concat(lastname, ', ', firstname) like '%".$search."%' or
						concat(firstname, ' ', lastname) like '%".$search."%' or
						MTOP_NO like '%".$search."%'
						order by MTOP_NO ASC
                ";
                $all_data = query($query_string);
            }
            $i=0;
            foreach($data as $row):
				$data[$i]["fullname"] = $row["lastname"] . ", " . $row["firstname"];
				$data[$i]["gender"] = $row["Gender"];
				$data[$i]["mtop"] = "<a href='mtop_profile?action=profile&mtop=".$row["MTOP_NO"]."'>".$row["MTOP_NO"] ."</a>";
				$data[$i]["mp_expiration_date"] = $Vehicle[$row["MTOP_NO"]]["mp_expiration_date"];
				$data[$i]["expiration_date"] = $Vehicle[$row["MTOP_NO"]]["expiration_date"];
                $i++;
            endforeach;
   
            $json_data = array(
                "draw" => $draw + 1,
                "iTotalRecords" => count($all_data),
                "iTotalDisplayRecords" => count($all_data),
                "aaData" => $data
            );
            echo json_encode($json_data);
        }

		if($_POST["action"] == "update_mtop"){
			// dump($_POST);
			query("update operator set lastname = ?, firstname = ?, address = ?, Gender = ?
					where MTOP_NO = ?", $_POST["lastname"], $_POST["firstname"], $_POST["address"], $_POST["Gender"], $_POST["mtop"]);

			query("update vehicle set plate_no = ?, make = ?, motor_no = ?, chassis_no = ?, reg_no = ?, route = ?,
					expiration_date = ?, mp_expiration_date = ?, care_of = ?
					where MTOP_NO = ?", 
					$_POST["plate_no"], $_POST["make"], $_POST["motor_no"], $_POST["chassis_no"], $_POST["reg_no"], $_POST["route"],
					$_POST["expiration_date"], $_POST["mp_expiration_date"], $_POST["care_of"], $_POST["mtop"]
				);

			$res_arr = [
				"result" => "success",
				"title" => "Success",
				"message" => "Done Updating Data",
				"link" => "mtop_profile?action=profile&mtop=".$_POST["mtop"],
				];
				echo json_encode($res_arr); exit();



		}

        if($_POST["action"] == "print_renew"):

            // $transaction = query("select * from transaction_logs ");

            $mtop = query("SELECT vehicle.MTOP_NO, CONCAT(firstname,' ',lastname) as  fullname , 
            address, plate_no, make, chassis_no, motor_no, reg_no, route, status, released_date, 
            expiration_date FROM vehicle JOIN operator ON vehicle.MTOP_NO = operator.MTOP_NO AND vehicle.MTOP_NO = ?", $_POST["mtop_no"]);
            //  $P{mtop_no}
            // dump($mtop);
            $mtop = $mtop[0];
            $pdf = new Pdf('mtop_reports/RENEW_BACK_NOTFINAL.pdf');
            $result = $pdf->fillForm([
				"mtop_no"    => $mtop["MTOP_NO"],
				"date_now"    => date("F d, Y"),
				"fullname"    => $mtop["fullname"],
				"address"    => $mtop["address"],
				"route"    => $mtop["route"],
				"make"    => $mtop["make"],
				"motor_no"    => $mtop["motor_no"],
				"chassis_no"    => $mtop["chassis_no"],
				"plate_no"    => $mtop["plate_no"],
				"reg_no"    => $mtop["reg_no"],
			
				])
                ->flatten()
				->saveAs("output_forms/".$_POST["mtop_no"]."_remew.pdf");
                $path = "output_forms/".$_POST["mtop_no"]."_remew.pdf";
                $filename=$_POST["mtop_no"]."_renew_1.pdf";
                $load[] = array('path'=>$path, 'filename' => $filename, 'result' => 'success');
                        $json = array('info' => $load);
                        echo json_encode($json);
                        exit();
        endif;


        if($_POST["action"] == "print_renew_back"):

            $permit = query("SELECT * FROM transaction_logs WHERE MTOP_NO = ? AND or_items LIKE CONCAT('%', ?, '%') ORDER BY ddate DESC LIMIT 1", $_POST["mtop_no"], "FRANCHISING FEE");
            $etracs_amount = query_etracs("SELECT amount, objid, receiptdate FROM cashreceipt WHERE receiptno = ? and collectiontype_objid = 'GENERAL_COLLECTION'", $permit[0]["or_no"]);
            // dump($etracs_amount);
            // SELECT vehicle.MTOP_NO, (SELECT city_admin from settings LIMIT 1 ) as city_ad,(SELECT city_admin_pos from settings LIMIT 1 ) as city_ad_pos, (SELECT mayor from settings LIMIT 1 ) as city_mayor, CONCAT(firstname,' ',lastname) as  fullname , address, plate_no, make, chassis_no, motor_no, reg_no, status, released_date, IFNULL(DATE_FORMAT(expiration_date,'%b %d %Y'),'') as exp, or_no, DATE_FORMAT(date_paid,'%b %d %Y') as paid, (filling_fee + franchise_fee) as total, (SELECT head from settings LIMIT 1 ) as head1, (SELECT head_pos from settings LIMIT 1 ) as head_pos, (SELECT head_office from settings LIMIT 1 ) as head_office FROM vehicle, operator, fees WHERE vehicle.MTOP_NO = operator.MTOP_NO AND vehicle.MTOP_NO = fees.MTOP_NO AND vehicle.MTOP_NO = $P{mtop_no} ORDER BY fees.ID DESC LIMIT 1
            $mtop = query("SELECT vehicle.MTOP_NO, (SELECT city_admin from settings LIMIT 1 ) as city_ad,
            (SELECT city_admin_pos from settings LIMIT 1 ) as city_ad_pos, (SELECT mayor from settings LIMIT 1 ) as city_mayor, 
            CONCAT(firstname,' ',lastname) as  fullname , address, plate_no, make, chassis_no, motor_no, reg_no, status, released_date, 
            IFNULL(DATE_FORMAT(expiration_date,'%b %d %Y'),'') as exp, or_no, DATE_FORMAT(date_paid,'%b %d %Y') as paid, (filling_fee + franchise_fee) as total, 
            (SELECT head from settings LIMIT 1 ) as head1, (SELECT head_pos from settings LIMIT 1 ) as head_pos, (SELECT head_office from settings LIMIT 1 ) as head_office 
            FROM vehicle, operator, fees WHERE vehicle.MTOP_NO = operator.MTOP_NO AND vehicle.MTOP_NO = fees.MTOP_NO AND vehicle.MTOP_NO = ? ORDER BY fees.ID DESC LIMIT 1", $_POST["mtop_no"]);
            // dump($mtop);
            $settings = query("select * from settings");
            $settings = $settings[0];
            $mtop = $mtop[0];

            $cashreceipt = query_etracs("SELECT * FROM cashreceipt WHERE receiptno = ?", $mtop["or_no"]);
            $total = to_peso($cashreceipt[0]["amount"]);
            // $or_no = $mtop["or_no"];

            // $dateString = $cashreceipt[0]["receiptdate"];
            // // dump($dateString); // Your date in Y-m-d format
            // $date = DateTime::createFromFormat('Y-m-d 00:00:00', $dateString);
            // $paid_date = $date->format('F d Y');


            // $or_no = $cashreceipt[0]["receiptdate"];


            
            // dump($cashreceipt);
            // if(empty($cashreceipt)):
            //     $total = $mtop[""]
            // else:
            //   $cashitems =  query_etracs("SELECT * FROM cashreceiptitem WHERE receiptid = ?", $cashreceipt[0]["objid"]);



            //  $P{mtop_no}
            // dump($mtop);
            
            $pdf = new Pdf('mtop_reports/printbacknotfinal.pdf');

            // $dateString = $mtop["expiration_date"]; // Your date in Y-m-d format
            // $date = DateTime::createFromFormat('Y-m-d', $dateString);
            // $expiration_date = $date->format('F d Y');

            // $total = to_peso(1000);
            
            // $paid_date = date("F d, Y");


            $result = $pdf->fillForm([
				"mtop_no"    => $mtop["MTOP_NO"],
				"date_day"    => date("d"),
				"date_month"    => date("F"),
				"date_year"    => date("Y"),
				"expiration_date"    => $mtop["exp"],
				"city_mayor"    => $settings["mayor"],
				"head1"    => $settings["head"],
				"head_pos"    => $settings["head_pos"],
				"head_office"    => $settings["head_office"],
				"city_ad"    => $settings["city_admin"],
				"city_ad_pos"    => $settings["city_admin_pos"],
				"total"    => to_peso_with_no_prefix($etracs_amount[0]["amount"]),
				"or_no"    => $permit[0]["or_no"],
				"paid_date"    => date('M d Y', strtotime($etracs_amount[0]["receiptdate"])),
				// "date_entry"    => date("F d, Y"),
				// "operator_full"    => $mtop["fullname"],
				// "address_home"    => $mtop["address"],
				// "route"    => $mtop["route"],
				// "make"    => $mtop["make"],
				// "motor_no"    => $mtop["motor_no"],
				// "chassis_no"    => $mtop["chassis_no"],
				// "plate_no"    => $mtop["plate_no"],
				// "reg_no"    => $mtop["reg_no"],
			
				])
                ->flatten()
				->saveAs("output_forms/".$_POST["mtop_no"]."_renew_back_1.pdf");
                $path = "output_forms/".$_POST["mtop_no"]."_renew_back_1.pdf";
                $filename=$_POST["mtop_no"]."_renew_back_1.pdf";
                $load[] = array('path'=>$path, 'filename' => $filename, 'result' => 'success');
                        $json = array('info' => $load);
                        echo json_encode($json);
                        exit();
        endif;
        if($_POST["action"] == "print_dropping"):
            // dump($_POST);
            $dropping = query("SELECT * FROM transaction_logs WHERE MTOP_NO = ? AND or_items LIKE CONCAT('%', ?, '%') ORDER BY ddate DESC LIMIT 1", $_POST["mtop_no"], "DROPPING");
            if(empty($dropping)):
                $load[] = array('message'=>"No Dropping Transaction detected in the system!", 'result' => 'failed');
                        $json = array('info' => $load);
                        echo json_encode($json);
                        exit();
            endif;
            $mtop = query("select *, CONCAT(firstname,' ',lastname) as fullname from operator o
                            left join vehicle v
                            on v.MTOP_NO = o.MTOP_NO
                            where o.MTOP_NO = ?", $_POST["mtop_no"]);
            $mtop=$mtop[0];
            $settings = query("select * from settings");
            $settings = $settings[0];
            $etracs_amount = query_etracs("SELECT amount, objid, receiptdate FROM cashreceipt WHERE receiptno = ? and collectiontype_objid = 'GENERAL_COLLECTION'", $dropping[0]["or_no"]);
            $pdf = new Pdf('mtop_reports/dropping_notfinal.pdf');
            $result = $pdf->fillForm([
				"fullname"    => strtoupper($mtop["fullname"]),
				"address"    => $mtop["address"],
				"mtop_no"    => $_POST["mtop_no"],
				"mtop_bold"    => $_POST["mtop_no"],
				"plate_no"    => $mtop["plate_no"],
				"make"    => $mtop["make"],
				"motor_no"    => $mtop["motor_no"],
				"chassis_no"    => $mtop["chassis_no"],
				"released_date"    => date('M d Y', strtotime($mtop["released_date"])),
				"exp_date"    => date('M d Y', strtotime($mtop["expiration_date"])),
                "day_now"    => date("d"),
                "month_year"    => date("F Y"),
                "transferee"    => ucwords($_POST["operator"]),
                "transferee_address"    => ucwords($_POST["address"]),
                "mayor"    => strtoupper($settings["mayor"]),
                "head"    => strtoupper($settings["head"]),
                "head_pos"    => $settings["head_pos"],
                "head_office"    => $settings["head_office"],
                "city_ad"    => strtoupper($settings["city_admin"]),
                "city_ad_pos"    => $settings["city_admin_pos"],
                "total_fee"    => to_peso_with_no_prefix($etracs_amount[0]["amount"]),
                "or_no"    => $dropping[0]["or_no"],
                "date_paid"    => date('M d Y', strtotime($etracs_amount[0]["receiptdate"])),
				])
                ->flatten()
				->saveAs("output_forms/".$_POST["mtop_no"]."_dropping.pdf");
                $path = "output_forms/".$_POST["mtop_no"]."_dropping.pdf";
                $filename=$_POST["mtop_no"]."_dropping.pdf";
                $load[] = array('path'=>$path, 'filename' => $filename, 'result' => 'success');
                $json = array('info' => $load);
                echo json_encode($json);
                exit();
        endif;

        if($_POST["action"] == "print_substitution"):

            // dump($_POST);
            // dump($_POST);
            $substitution = query("SELECT * FROM transaction_logs WHERE MTOP_NO = ? AND or_items LIKE CONCAT('%', ?, '%') ORDER BY ddate DESC LIMIT 1", $_POST["mtop_no"], "SUBSTITUTION");
            if(empty($substitution)):
                $load[] = array('message'=>"No Substitution of Unit Transaction detected in the system!", 'result' => 'failed');
                        $json = array('info' => $load);
                        echo json_encode($json);
                        exit();
            endif;
            $mtop = query("select *, CONCAT(firstname,' ',lastname) as fullname from operator o
                            left join vehicle v
                            on v.MTOP_NO = o.MTOP_NO
                            where o.MTOP_NO = ?", $_POST["mtop_no"]);
            // dump($substitution);
            $mtop=$mtop[0];
            // dump($mtop);
            $settings = query("select * from settings");
            $settings = $settings[0];
            $etracs_amount = query_etracs("SELECT amount, objid, receiptdate FROM cashreceipt WHERE receiptno = ? and collectiontype_objid = 'GENERAL_COLLECTION'", $substitution[0]["or_no"]);
            $pdf = new Pdf('mtop_reports/substitution_notfinal.pdf');
            $result = $pdf->fillForm([
				"fullname"    => strtoupper($mtop["fullname"]),
				"address"    => $mtop["address"],
				"mtop_year"    => $_POST["mtop_no"] . "-" . date("Y"),
				"exp_date"    => date('M d Y', strtotime($mtop["expiration_date"])),
				// "plate_no"    => $mtop["plate_no"],
				"make1"    => $mtop["make1"],
				"motor_no1"    => $mtop["motor_no1"],
				"year1"    => $mtop["YearModel1"],
				"chassis_no1"    => $mtop["chassis_no1"],

                "make"    => $mtop["make"],
				"motor_no"    => $mtop["motor_no"],
				"year"    => $mtop["YearModel"],
				"chassis_no"    => $mtop["chassis_no"],

                "fullname1"    => strtoupper($mtop["fullname"]),

                "mayor"    => strtoupper($settings["mayor"]),
                "head"    => strtoupper($settings["head"]),
                "head_pos"    => $settings["head_pos"],
                "head_office"    => $settings["head_office"],
                "city_ad"    => strtoupper($settings["city_admin"]),
                "city_ad_pos"    => $settings["city_admin_pos"],
                "total_fee"    => to_peso_with_no_prefix($etracs_amount[0]["amount"]),
                "or_no"    => $substitution[0]["or_no"],
                "date_paid"    => date('M d Y', strtotime($etracs_amount[0]["receiptdate"])),
				])
                ->flatten()
				->saveAs("output_forms/".$_POST["mtop_no"]."_sub.pdf");
                $path = "output_forms/".$_POST["mtop_no"]."_sub.pdf";
                $filename=$_POST["mtop_no"]."_sub.pdf";
                $load[] = array('path'=>$path, 'filename' => $filename, 'result' => 'success');
                $json = array('info' => $load);
                echo json_encode($json);
                exit();

            
        endif;


        if($_POST["action"] == "print_mayors_permit"):
            $mp = query("SELECT * FROM transaction_logs WHERE MTOP_NO = ? AND or_items LIKE CONCAT('%', ?, '%') ORDER BY ddate DESC LIMIT 1", $_POST["mtop_no"], "Mayor's Permit");
            if(empty($mp)):
                $load[] = array('message'=>"No Mayors Permit Transaction found on this MTOP", 'result' => 'failed');
                        $json = array('info' => $load);
                        echo json_encode($json);
                        exit();
            endif;
            // dump($mp);

            $mtop = query("select *, CONCAT(firstname,' ',lastname) as fullname from operator o
                            left join vehicle v
                            on v.MTOP_NO = o.MTOP_NO
                            where o.MTOP_NO = ?", $_POST["mtop_no"]);
            // dump($mtop);
            $mtop = $mtop[0];

            $settings = query("select * from settings");
            $settings = $settings[0];


            $mtop_year = $mtop["MTOP_NO"] . "-" . date('Y', strtotime($mtop["mp_expiration_date"]));
            $exp_date = date('M d Y', strtotime($mtop["expiration_date"]));


            $etracs_amount = query_etracs("SELECT amount, objid, receiptdate FROM cashreceipt WHERE receiptno = ? and collectiontype_objid = 'GENERAL_COLLECTION'", $mp[0]["or_no"]);
            

            


            $pdf = new Pdf('mtop_reports/mayors_permit_notfinal.pdf');
            $result = $pdf->fillForm([
				"fullname"    => strtoupper($mtop["fullname"]),
				"address"    => $mtop["address"],
				"date_now"    => date("F d, Y"),
				"mtop_year"    => $mtop_year,
				"make"    => $mtop["make"],
				"plate_no"    => $mtop["plate_no"],
				"chassis_no"    => $mtop["chassis_no"],
				"exp_date"    => $exp_date,
				"mp_exp_year"    => date('Y', strtotime($mtop["mp_expiration_date"])),
				"city_mayor"    => $settings["mayor"],
				"bpls_head"    => $settings["head"],
				"bpls_head_position"    => $settings["head_pos"],
				"bpls_head_office"    => $settings["head_office"],
				"city_ad"    => $settings["city_admin"],
				"city_ad_pos"    => $settings["city_admin_pos"],
				"or_no"    => $mp[0]["or_no"],
				"date_paid"    => date('M d Y', strtotime($etracs_amount[0]["receiptdate"])),
				"total_fee"    => to_peso_with_no_prefix($etracs_amount[0]["amount"]),
				])
                ->flatten()
				->saveAs("output_forms/".$_POST["mtop_no"]."_mp.pdf");
                $path = "output_forms/".$_POST["mtop_no"]."_mp.pdf";
                $filename=$_POST["mtop_no"]."_renew_1.pdf";
                $load[] = array('path'=>$path, 'filename' => $filename, 'result' => 'success');
                        $json = array('info' => $load);
                        echo json_encode($json);
                        exit();

            // $load[] = array('message'=>"No Mayors Permit Transaction found on this MTOP", 'result' => 'failed');
            //             $json = array('info' => $load);
            //             echo json_encode($json);
            //             exit();


        endif;


        if($_POST["action"] == "or_details"){
            // dump($_POST);
           $html = "";
            if($_POST["options"] == "etracs"):
                $cashreceipt = query_etracs("SELECT * FROM cashreceipt WHERE objid = ?", $_POST["id"]);
                $cashitems =  query_etracs("SELECT * FROM cashreceiptitem WHERE receiptid = ?", $_POST["id"]);
                // dump($cashitems);

                $html = $html . '
                <dl>
                <div class="row">
                    <div class="col-md-3">
                        <dt>OR Number</dt>
                        <dd>'.$cashreceipt[0]["receiptno"].'</dd>
                    </div>
                    <div class="col-md-3">
                    <dt>Total Amount</dt>
                    <dd>'.to_peso($cashreceipt[0]["amount"]).'</dd>
                    </div>
                    <div class="col-md-6">
                    <dt>Paid By</dt>
                    <dd>'.$cashreceipt[0]["paidby"].' on '.$cashreceipt[0]["receiptdate"].'</dd>
                    </div>
                </div>
                </dl>
                ';

                $html = $html . '<table class="table table-bordered">';
                    $html = $html . '<thead>';
                        $html = $html . '<th>Item Title</th>';
                        $html = $html . '<th>Item Amount</th>';
                    $html = $html . '</thead>';
                    $html = $html . '<tbody>';
                        foreach($cashitems as $item):
                            $html = $html . '<tr>';
                                $html = $html . '<td>'.$item["item_title"].'</td>';
                                $html = $html . '<td class="text-right">'.to_peso($item["amount"]).'</td>';
                            $html = $html . '</tr>';
                        endforeach;
                    $html = $html . '</tbody>';
                $html = $html . '</table>';
            endif;

            echo($html);

        }



    }
	else {








        // $or_number = query("select * from fees");
        // $OR = [];
        // foreach ($or_number as $row) :
        //     // $OR[$row["or_no"]] = $row;
        //     // $row["or_no"] = "0086538";
    
        //     $or_with_g = $row["or_no"] . "G";
        //     $or_with_dot = $row["or_no"] . ".";
        //     // dump($or_with_dot);
    
    
    
    
        //     $query_string = "SELECT cr.item_title,c.receiptno FROM cashreceipt c
        // left join cashreceiptitem cr
        // on c.objid = cr.receiptid WHERE receiptno = '" . $row["or_no"] . "'";
        //     $etracs_amount = query_etracs($query_string);
        //     // dump($etracs_amount);
        //     // if (!empty($etracs_amount)) :
        //     if (strpos(serialize($etracs_amount), "MTOP") !== false) :
        //         $update_string = "update fees set or_no = '" . $etracs_amount[0]["receiptno"] . "' where ID = '" . $row["ID"] . "'";
        //         // dump($update_string);
        //         query($update_string);
        //     // dump();
        //     else:
        //         $query_string = "SELECT cr.item_title,c.receiptno FROM cashreceipt c
        //         left join cashreceiptitem cr
        //         on c.objid = cr.receiptid WHERE receiptno = '" . $or_with_g . "'";
        //             $etracs_amount = query_etracs($query_string);
        //             if (strpos(serialize($etracs_amount), "MTOP") !== false):
        //                 $update_string = "update fees set or_no = '" . $etracs_amount[0]["receiptno"] . "' where ID = '" . $row["ID"] . "'";
        //                 // dump($update_string);
        //                 query($update_string);
        //             else:
        //                 $query_string = "SELECT cr.item_title,c.receiptno FROM cashreceipt c
        //                 left join cashreceiptitem cr
        //                 on c.objid = cr.receiptid WHERE receiptno = '" . $or_with_dot . "'";
        //                     $etracs_amount = query_etracs($query_string);
        //                     if (!empty($etracs_amount)):
        //                         if (strpos(serialize($etracs_amount), "MTOP") !== false):
        //                             $update_string = "update fees set or_no = '" . $etracs_amount[0]["receiptno"] . "' where ID = '" . $row["ID"] . "'";
        //                             // dump($update_string);
        //                             query($update_string);
        //                         endif;
        //                     endif;
        //             endif;
        //     endif;
        // endforeach;



        // $logs = query("select * from transaction_logs where or_no != ''");
        // foreach ($logs as $row) {
        //     $data_array[] = $row['or_no'];
        // }

        // $in_values = implode("','", $data_array);
        // $in_values = "'" . $in_values . "'";

     

        // $sql = "SELECT cr.item_title, c.receiptno 
        // FROM cashreceipt c 
        // LEFT JOIN cashreceiptitem cr ON c.objid = cr.receiptid 
        // WHERE receiptno IN ($in_values) and c.collectiontype_name = 'GENERAL_COLLECTION'";
        // // dump($sql);


        // $Etracs = [];
        // $etracs = query_etracs($sql);
        // foreach($etracs as $row):
        //     $Etracs[$row["receiptno"]][] = $row;
        // endforeach;
        // // dump($Etracs);

        // foreach($logs as $row):
        //     if(isset($Etracs[$row["or_no"]])):
        //         $details = serialize($Etracs[$row["or_no"]]);
        //         query("update transaction_logs set or_items = ? where ID = ?", $details, $row["ID"]);
        //         // dump($details);
        //     endif;
        // endforeach;
        // dump("done");

  





		if(isset($_GET["action"])){
			if($_GET["action"] == "list"){
				render("public/mtop_system/mtop_form.php",[
				]);
			}


			if($_GET["action"] == "profile"){

				$mtop = query("select * from operator o
								left join vehicle v
								on v.MTOP_NO = o.MTOP_NO
								where o.MTOP_NO = ?", $_GET["mtop"]);
				// dump($mtop);

				render("public/mtop_system/mtop_profile.php",[
					"mtop" => $mtop[0],
				]);
			}
		}
		

		
	}
?>
