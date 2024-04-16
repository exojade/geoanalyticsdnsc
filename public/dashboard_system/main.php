<?php
// $sql = query_etracs("SELECT * FROM cashreceipt WHERE receiptno = '0724986G'");
// dump($sql);



// $transaction_logs = query("select * from transaction_logs where ddate between '2023-01-01' and '2023-12-31'");
// $fees = query("select * from fees");
// $Fees = [];
// foreach($fees as $f):
// 	$Fees[$f["MTOP_NO"]][$f["date_paid"]] = $f;
// endforeach;
// // dump($Fees);
// foreach($transaction_logs as $t):

// 	if(isset($Fees[$t["MTOP_NO"]][$t["ddate"]])):
// 	$or_number = $Fees[$t["MTOP_NO"]][$t["ddate"]]["or_no"];
// 	else:
// 	$or_number = "";
	
// 	endif;
// 	query("update transaction_logs set or_number = ? where MTOP_NO = ? and ddate = ?", $or_number, $t["MTOP_NO"], $t["ddate"]);
// endforeach;


// PARA SA NEW,RENEW UG AWARDING
// $fees =  query("select * from fees where filling_fee is not null and filling_fee <> '' and filling_fee <> 0");
// $New = [];
// $Renew = [];
// $Awarding = [];

// $Logs = [];
// $logs = query("select * from transaction_logs where type in ('New', 'Renew', 'Awarding') order by MTOP_NO ASC, ddate desc");

// foreach($logs as $l):
// 	$Logs[$l["MTOP_NO"]][$l["ddate"]][$l["type"]] = $l;
// endforeach;
// // dump($Logs);
// foreach($fees as $f):
// 	// dump($f);
// 	if(isset($Logs[$f["MTOP_NO"]][$f["date_paid"]]["Renew"])):
// 		array_push($Renew,$f["ID"]);
// 	elseif(isset($Logs[$f["MTOP_NO"]][$f["date_paid"]]["Awarding"])):
// 		array_push($Awarding,$f["ID"]);
// 	elseif(isset($Logs[$f["MTOP_NO"]][$f["date_paid"]]["New"])):
// 		array_push($New,$f["ID"]);
// 	endif;
// endforeach;
	
// 	$New = "'".implode("','",$New)."'";
// 	$Renew = "'".implode("','",$Renew)."'";
// 	$Awarding = "'".implode("','",$Awarding)."'";
	// dump($New);

	// query("update fees set type = 'New' where ID in (".$New.")");
	// query("update fees set type = 'Renew' where ID in (".$Renew.")");
	// query("update fees set type = 'Awarding' where ID in (".$Awarding.")");
	// dump("done");
// PARA SA NEW,RENEW UG AWARDING

$dropping = query("select * FROM fees WHERE dropping_fee <> '' AND dropping_fee IS NOT NULL AND dropping_fee <> 0 ORDER BY date_paid DESC");







    if($_SERVER["REQUEST_METHOD"] === "POST") {
	
		
		
    }
	else {
		$role = $_SESSION["dnsc_geoanalytics"]["role"];
		// dump($role);
		if($role == "ADMINISTRATOR"){
			render("public/dashboard_system/dashboard_admin.php",[]);
		}
	}
?>
