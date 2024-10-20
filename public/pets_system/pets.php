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

		elseif($_POST["action"] == "updatePet"):
				// dump($_FILES);


				query("update pet set 
						petName = '".$_POST["petName"]."',
						petType = '".$_POST["typePet"]."',
						petBreed = '".$_POST["petBreed"]."',
						petDescription = '".$_POST["petDescription"]."',
						petGender = '".$_POST["petGender"]."',
						petDob = '".$_POST["petDob"]."'
						where petId = ?
						", $_POST["petId"]);


				if($_FILES["petImage"]["size"] != 0):
					$target_pdf = "uploads/";
					$path_parts = pathinfo($_FILES["petImage"]["name"]);
					$extension = $path_parts['extension'];
					$target = $target_pdf . $_POST["petId"]. "." . $extension;
					if(!move_uploaded_file($_FILES['petImage']['tmp_name'], $target)){
						echo("FAMILY Do not have upload files");
						exit();
					}
					query("update pet set image = '".$target."'
					where petId = '".$_POST["petId"]."'");
				endif;
	

					$res_arr = [
						"result" => "success",
						"title" => "Success",
						"message" => "Success on updating data",
						"link" => "refresh",
						// "html" => '<a href="#">View or Print '.$transaction_id.'</a>'
						];
						echo json_encode($res_arr); exit();
	


				

			

		elseif($_POST["action"] == "addNewPet"):
			// dump($_POST);
			$clientId = $_POST["clientId"];
			$petId = create_trackid("PET");
			if (query("insert INTO pet (petId, petName, petType, petBreed, petDescription, clientId, petGender, petDob) 
				VALUES(?,?,?,?,?,?,?,?)", 
				$petId, $_POST["petName"] ,$_POST["typePet"], $_POST["petBreed"], $_POST["petDescription"], $clientId, $_POST["petGender"], $_POST["petDob"]) === false)
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
			
			

				elseif($_POST["action"] == "printPrescription"):

					// dump($_POST);
					

					$medRecord = query("select *  from checkup c
										 left join pet p
										 on p.petId = c.petId
										 left join client cl
										 on p.clientId = cl.clientId
										 left join doctors d
										 on d.doctorsId = c.doctorId
										 where checkupId = ?", $_POST["checkupId"]);

					$medRecord = $medRecord[0];

					$mpdf = new \Mpdf\Mpdf([
						'mode' => 'utf-8', 'format' => 'A4',
						'debug' => true,
						'margin_top' => 15,
						'margin_left' => 5,
						'margin_right' => 5,
						'margin_bottom' => 5,
						'margin_footer' => 1,
						'default_font' => 'helvetica'
					]);

					$html = "";

					$html .='
					<link rel="stylesheet" href="AdminLTE/dist/css/AdminLTE.min.css">
					<link rel="stylesheet" href="AdminLTE/bower_components/bootstrap/dist/css/bootstrap.min.css">
					<link rel="stylesheet" href="AdminLTE/dist/css/skins/_all-skins.min.css">
					<style>
					.table, th, td, thead, tbody{
						border: 2px solid black !important;
						padding: 8px !important;
					}
					h5{
						margin:0px !important;
						padding:0px !important;
						margin-bottom: 4px !important
						font-size: 15px !important;
						font-weight: 800;
					}

					h4{
						margin:0px !important;
						padding:0px !important;
						margin-bottom: 4px !important
						font-size: 100px !important;
						font-weight: 800;
					}



					b{
						font-weight: bold;
					}

					</style>

					<div class="row">
						<div class="col-xs-3">
							<div class="text-center"><img src="resources/panabologo.png" width="85" height="85" class="img-responsive"></div>
						</div>
						<div class="col-xs-4">
							<h4 class="text-center"><b>City of Panabo</b></h4>
							<h4 class="text-center"><b>City Mayors Office</b></h4>
							<h4 class="text-center"><b>City Veterinary Setion</b></h4>
						</div>
						<div class="col-xs-3">
							<div class="text-center"><img width="80" height="80" src="resources/logocityvet.png" class="img-responsive"></div>
						</div>
					</div>

					
					<hr>
					<div class="row">
						<div class="col-xs-8 co-sm-4">
							<h5><b>Name of Pet Owner:</b> '.$medRecord["lastname"] . ', ' . $medRecord["firstname"] .'</h5>
							<h5><b>Address:</b> ' . $medRecord["cityMun"] . ','. $medRecord["barangay"] .',' . $medRecord["address"] .'</h5>
						</div>
						<div class="col-xs-3 co-sm-4">
							<h5><b>Date:</b> '.$medRecord["dateCheckup"].' </h5>
							
						</div>

					</div>

				<br>

					<div class="row">
						<div class="col-xs-12 co-sm-4">
							<h5><b>Name of Pet:</b> '.$medRecord["petName"].'</h5>
						</div>
						<div class="col-xs-12 co-sm-4">
							<h5><b>Species:</b> '.$medRecord["petType"].'</h5>
						</div>
						<div class="col-xs-12 co-sm-4">
							<h5><b>Breed:</b> '.$medRecord["petBreed"].'</h5>
						</div>
					</div>

					<h1><b>Rx</b></h1>

					'.$medRecord["prescription"].'


					<div style="position: absolute; bottom: 0; left: 0; right: 0; text-align: center; border-top:2px solid black;padding-top:20px; padding-bottom: 10px;">
						<div class="row">
							<div class="col-xs-5" style="padding-left: 30px;">
								<p style="text-align: left;">DO NOT SELF MEDICATE!</p>
								<p style="text-align: left;">Disregard this prescription after completing</p>
								<p style="text-align: left;">the treatment period as indicated. See a vet</p>
								<p style="text-align: left;">for follow-up checkup.</p>
							</div>
							<div class="col-xs-5" style="text-align: left !important;">
								<span style="display: block; text-align: left;" style="font-size: 15px; border-bottom: 1px solid black;"><b>'.$medRecord["doctorsFirstname"] . ' ' . $medRecord["doctorsMiddlename"] . ' ' . $medRecord["doctorsLastname"] . ', ' . $medRecord["doctorsExtension"] .'</b></span>
								<br><span style="display: block;text-align: left;" style="font-size: 15px; ">Lic. No. <b style="border-bottom: 1px solid black;">'.$medRecord["doctorsLicenseNumber"].'</b></span>
								<br><span style="display: block; text-align: left;" style="font-size: 15px;">PTR.: ______________</span>
							</div>
						</div>
					</div>
					';

					$filename = "prescription";
					$path = "reports/".$filename.".pdf";
					$mpdf->WriteHTML($html);
					$mpdf->Output($path, \Mpdf\Output\Destination::FILE);

					$res_arr = [
						"result" => "success",
						"title" => "Success",
						"newlink" => "newlink",
						"message" => "PDF success",
						"link" => $path,
						// "html" => '<a href="#">View or Print '.$transaction_id.'</a>'
						];
						echo json_encode($res_arr); exit();

					// dump($mpdf);








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
