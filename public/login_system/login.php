<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
		// dump($_POST);
        $rows = query("SELECT * FROM mtop_users WHERE userName = ?", $_POST["username"]);
        if (count($rows) == 1)
        {
            $row = $rows[0];
			if (crypt($_POST["password"], $row["userPassword"]) == $row["userPassword"]){
				// dump($row);
				$_SESSION["dnsc_geoanalytics"] = [
					"userid" => $row["userId"],
					"uname" => $row["fullName"],
					"role" => $row["userLevel"],
					"fullname" => $row["fullName"],
					"profile_image" => "",
					"application" => "mtop"
				];

				// $activity = $row["fullname"] . " successfully logged in into the system";
				echo("proceed");
            }
			else {
				// $activity = $row["fullname"] . " entered " . $_POST["password"];
				echo("wrong_password");
			}
		}
		else {
			echo("wrong_password");
		}  
    }
    else
    {
        renderview("public/login_system/loginform.php", ["title" => "Log In"]);
    }
?>