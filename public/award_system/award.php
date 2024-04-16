<?php
// dump($_REQUEST);

use mikehaertl\pdftk\Pdf;

    if($_SERVER["REQUEST_METHOD"] === "POST") {
		

        if($_POST["action"] == "awardMTOP"):

            $cashreceipt = query_etracs("SELECT * FROM cashreceipt WHERE receiptno = ?", $_POST["or_number"]);
            if(empty($cashreceipt)):

                $res_arr = [
                    "message" => "OR Number not found in the system. Cannot proceed!",
                    "status" => "failed",
                    "link" => "Failed",
                    ];
                    echo json_encode($res_arr); exit();

            endif;



            // dump($_POST);
            $mp_date = date("Y") . "-12-31";

            query("update operator set 
                        lastname = ?,
                        firstname = ?,
                        middlename = ?,
                        suffix = ?,
                        address = ?,
                        Gender = ?
                        where MTOP_NO = ?
                        ",
                    strtoupper($_POST["lastname"]),
                    strtoupper($_POST["firstname"]),
                    strtoupper($_POST["middlename"]),
                    strtoupper($_POST["suffix"]),
                    strtoupper($_POST["address"]),
                    strtoupper($_POST["gender"]),
                    $_POST["mtop_no"]
                    );


            query("update vehicle set 
                    plate_no = ?,
                    make = ?,
                    chassis_no = ?,
                    motor_no = ?,
                    reg_no = ?,
                    route = ?,
                    status = ?,
                    care_of = ?,
                    mp_expiration_date = ?,
                    released_date = ?,
                    expiration_date = ?
                    where MTOP_NO = ?
                    ",
                $_POST["plate_no"],
                $_POST["make"],
                $_POST["chassis"],
                $_POST["motor_no"],
                $_POST["certification"],
                $_POST["route"],
                "For Release",
                $_POST["note"],
                $mp_date,
                date("Y-m-d"),
                $_POST["expiration_date"],
                $_POST["mtop_no"]
                );


                $ddate = $cashreceipt[0]["receiptdate"];
                $receiptdate = date("Y-m-d", strtotime($ddate));


                if (query("insert INTO fees (or_no,date_paid,MTOP_NO) 
				VALUES(?,?,?)", 
				$_POST["or_number"],$receiptdate,$_POST["mtop_no"]) === false)
				{
					apologize("Sorry, that username has already been taken!");
				}
                

                if (query("insert INTO transaction_logs (MTOP_NO,firstname,lastname,make,plate_num,chassis_no,motor_no,ddate,type,action) 
				VALUES(?,?,?,?,?,?,?,?,?,?)", 
				$_POST["mtop_no"],strtoupper($_POST["firstname"]),strtoupper($_POST["lastname"]),$_POST["make"],$_POST["plate_no"],
                $_POST["chassis"],$_POST["motor_no"],$receiptdate,"Awarding","Award of MTOP"
                ) === false)
				{
					apologize("Sorry, that username has already been taken!");
				}

                $res_arr = [
                    "message" => "Successfully awarded",
                    "result" => "success",
                    "link" => "refresh",
                    ];
                    echo json_encode($res_arr); exit();


            


        endif;



    }
	else {
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

        else{

            $mtop = query("SELECT *
            FROM vehicle
            WHERE expiration_date <= CURDATE()");
            // dump($mtop);


            $bill = query("select * from billing_type_fee tf
                           left join billing_fees f
                           on f.fee_id = tf.fee_id
                           where tf.type_id = ?
                           order by f.amount desc
            ", "NEW");
            // dump($bill);
            

            render("public/award_system/award_form.php",[
                "mtop" => $mtop,
                "bill" => $bill,
            ]);
        }
		

		
	}
?>
