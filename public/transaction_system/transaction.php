<?php
// dump($_REQUEST);

use mikehaertl\pdftk\Pdf;

    if($_SERVER["REQUEST_METHOD"] === "POST") {
		

        if($_POST["action"] == "renew_mayors_permit"):

            $etracs_amount = query_etracs("SELECT amount, objid, receiptdate FROM cashreceipt WHERE receiptno = ? and collectiontype_objid = 'GENERAL_COLLECTION'", $substitution[0]["or_no"]);
            $etracs = query_etracs("SELECT amount, objid, receiptdate FROM cashreceipt WHERE receiptno = ? and collectiontype_objid = 'GENERAL_COLLECTION'", $_POST["or_number"]);
            if(empty($etracs)):
                $res_arr = [
                    "message" => "This",
                    "result" => "failed",
                    "link" => "refresh",
                    ];
                    echo json_encode($res_arr); exit();
            endif;


            dump($_POST);


            


        endif;



    }
	else {
		if(isset($_GET["action"])){
			if($_GET["action"] == "mayors_permit"){

                $bill = query("select * from billing_type_fee tf
                                    left join billing_fees f
                                    on f.fee_id = tf.fee_id
                                    where tf.type_id = 'MAYORS PERMIT'");
                $total_standard_fee = 0;
                foreach($bill as $row):
                    if($row["isurcharge"] == 1):
                        $surcharge = $row["amount"];
                    else:
                        $total_standard_fee = $total_standard_fee + $row["amount"];
                    endif;
                endforeach;
                // dump($billing);

                $mtop = query("select * from operator o
                left join vehicle v
                on v.MTOP_NO = o.MTOP_NO
                where o.MTOP_NO = ?", $_GET["mtop"]);

                $settings = query("select * from settings");

                $currentDate = date_create(date("Y-m-d"));
                $expirationDate = date_create($mtop[0]["mp_expiration_date"]);
                $standardFee = $total_standard_fee;
                $surchargePerYear = $surcharge;

                $surchargeLimitDate = date_create($settings[0]["deadline_boss"]); 
                $yearsBehind = date_diff($expirationDate, $currentDate)->y;
                $totalFee = 0;
                if ($currentDate > $surchargeLimitDate) {
                    $totalFee = (($yearsBehind + 1) * ($standardFee + $surchargePerYear));
                } else {
                    $totalFee = $standardFee + (($yearsBehind) * ($standardFee + $surchargePerYear));
                }
// dump($yearsBehind);

$totalFee = $totalFee - $total_standard_fee;
// dump("Total fee: $totalFee");





				render("public/transaction_system/renew_mayors_permit.php",[
                    "mtop" => $mtop,
                    "totalFee" => $totalFee,
                    "bill" => $bill,
				]);
			}
			
		}
	}
?>
