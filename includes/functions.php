<?php
    require_once("constants.php");
     function to_peso($number){
        if($number != ""){
            return("₱ " .number_format($number, 2, '.', ','));
        }
        else
        return($number);
    }
    function getRandomColor() {
        return sprintf('#%06X', mt_rand(0, 0xFFFFFF));
    }
    
    function getBarangay(){
$barangays = [
    ["id" => 1, "name" => "A. O. Floirendo"],
    ["id" => 2, "name" => "Datu Abdul Dadia"],
    ["id" => 3, "name" => "Buenavista"],
    ["id" => 4, "name" => "Cacao"],
    ["id" => 5, "name" => "Cagangohan"],
    ["id" => 6, "name" => "Consolacion"],
    ["id" => 7, "name" => "Dapco"],
    ["id" => 8, "name" => "Gredu (Poblacion)"],
    ["id" => 9, "name" => "J.P. Laurel"],
    ["id" => 10, "name" => "Kasilak"],
    ["id" => 11, "name" => "Katipunan"],
    ["id" => 12, "name" => "Katualan"],
    ["id" => 13, "name" => "Kauswagan"],
    ["id" => 14, "name" => "Kiotoy"],
    ["id" => 15, "name" => "Little Panay"],
    ["id" => 16, "name" => "Lower Panaga (Roxas)"],
    ["id" => 17, "name" => "Mabunao"],
    ["id" => 18, "name" => "Maduao"],
    ["id" => 19, "name" => "Malativas"],
    ["id" => 20, "name" => "Manay"],
    ["id" => 21, "name" => "Nanyo"],
    ["id" => 22, "name" => "New Malaga (Dalisay)"],
    ["id" => 23, "name" => "New Malitbog"],
    ["id" => 24, "name" => "New Pandan (Poblacion)"],
    ["id" => 25, "name" => "New Visayas"],
    ["id" => 26, "name" => "Quezon"],
    ["id" => 27, "name" => "Salvacion"],
    ["id" => 28, "name" => "San Francisco (Poblacion)"],
    ["id" => 29, "name" => "San Nicolas"],
    ["id" => 30, "name" => "San Pedro"],
    ["id" => 31, "name" => "San Roque"],
    ["id" => 32, "name" => "San Vicente"],
    ["id" => 33, "name" => "Santa Cruz"],
    ["id" => 34, "name" => "Santo Niño (Poblacion)"],
    ["id" => 35, "name" => "Sindaton"],
    ["id" => 36, "name" => "Southern Davao"],
    ["id" => 37, "name" => "Tagpore"],
    ["id" => 38, "name" => "Tibungol"],
    ["id" => 39, "name" => "Upper Licanan"],
    ["id" => 40, "name" => "Waterfall"]
];

return $barangays;

    }

    function adjustBrightness($hex, $steps) {
        // Ensure hex code is 6 characters
        $hex = str_replace('#', '', $hex);
        if (strlen($hex) == 3) {
            $hex = str_repeat(substr($hex, 0, 1), 2) . 
                   str_repeat(substr($hex, 1, 1), 2) . 
                   str_repeat(substr($hex, 2, 1), 2);
        }
        
        // Convert to RGB
        $r = hexdec(substr($hex, 0, 2));
        $g = hexdec(substr($hex, 2, 2));
        $b = hexdec(substr($hex, 4, 2));
        
        // Adjust brightness
        $r = max(0, min(255, $r + $steps));
        $g = max(0, min(255, $g + $steps));
        $b = max(0, min(255, $b + $steps));
        
        // Convert back to hex
        return sprintf("#%02x%02x%02x", $r, $g, $b);
    }
    

    function getMonths(){
        $months = [
            ["id" => 1, "name" => "Jan"],
            ["id" => 2, "name" => "Feb"],
            ["id" => 3, "name" => "Mar"],
            ["id" => 4, "name" => "Apr"],
            ["id" => 5, "name" => "May"],
            ["id" => 6, "name" => "Jun"],
            ["id" => 7, "name" => "Jul"],
            ["id" => 8, "name" => "Aug"],
            ["id" => 9, "name" => "Sep"],
            ["id" => 10, "name" => "Oct"],
            ["id" => 11, "name" => "Nov"],
            ["id" => 12, "name" => "Dec"],
        ];
        return $months;
            }

    function generateMonthArray($from, $to) {
        $from = max(1, min(12, (int)$from)); // Ensure $from is between 1 and 12.
        $to = max(1, min(12, (int)$to));     // Ensure $to is between 1 and 12.
        $months = [
            'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
            'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'
        ];
    
        $result = [];
        for ($i = $from - 1; $i < $to; $i++) {
            $result[] = $months[$i];
        }
    
        return $result;
    }

    function convertBrgytoNumber($barangay){
        // Define an associative array mapping barangay names to numbers
        $barangayMap = array(
            "A. O. Floirendo" => 1,
            "Datu Abdul Dadia" => 2,
            "Buenavista" => 3,
            "Cacao" => 4,
            "Cagangohan" => 5,
            "Consolacion" => 6,
            "Dapco" => 7,
            "Gredu (Poblacion)" => 8,
            "J.P. Laurel" => 9,
            "Kasilak" => 10,
            "Katipunan" => 11,
            "Katualan" => 12,
            "Kauswagan" => 13,
            "Kiotoy" => 14,
            "Little Panay" => 15,
            "Lower Panaga (Roxas)" => 16,
            "Mabunao" => 17,
            "Maduao" => 18,
            "Malativas" => 19,
            "Manay" => 20,
            "Nanyo" => 21,
            "New Malaga (Dalisay)" => 22,
            "New Malitbog" => 23,
            "New Pandan (Pob.)" => 24,
            "New Visayas" => 25,
            "Quezon" => 26,
            "Salvacion" => 27,
            "San Francisco (Poblacion)" => 28,
            "San Nicolas" => 29,
            "San Pedro" => 30,
            "San Roque" => 31,
            "San Vicente" => 32,
            "Santa Cruz" => 33,
            "Santo Niño (Poblacion)" => 34,
            "Sindaton" => 35,
            "Southern Davao" => 36,
            "Tagpore" => 37,
            "Tibungol" => 38,
            "Upper Licanan" => 39,
            "Waterfall" => 40
        );
    
        // Convert barangay name to lowercase for case-insensitive comparison
        // $barangayLower = strtolower($barangay);
    
        // Check if the barangay exists in the mapping
        if (isset($barangayMap[$barangay])) {
            return $barangayMap[$barangay];
        } else {
            return null; // Or handle if barangay is not found (optional)
        }
    }


    function to_peso_with_no_prefix($number){
        if($number != ""){
            return(number_format($number, 2, '.', ','));
        }
        else
        return($number);
    }

    function add_log($activity, $user){

        $log_id = create_uuid("LOG");
        $ip = getIPAddress(); 
        $date = date("Y-m-d G:i:s a");

        if (query("insert INTO tbl_logs (logs_id, action, logs_date, user_id, ip_address, timestamp) 
                    VALUES(?,?,?,?,?,?)", 
                $log_id, $activity, $date, $user, $ip, time()) === false)
				{
					dump("Sorry, that username has already been taken!");
                }
        ;

      
    }

    function getIPAddress() {  
        if(!empty($_SERVER['HTTP_CLIENT_IP'])) {  
                   $ip = $_SERVER['HTTP_CLIENT_IP'];  
           }  
       elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {  
                   $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];  
        }  
       else{  
                $ip = $_SERVER['REMOTE_ADDR'];  
        }  
        return $ip;  
   } 

    function dump($variable)
    {
        require("dump.php");
        exit;
    }
	
	function dumper($variable)
    {
        require("../../templates/dump.php");
        exit;
    }
	
function utf8ize($mixed) {
    if (is_array($mixed)) {
        foreach ($mixed as $key => $value) {
            $mixed[$key] = utf8ize($value);
        }
    } elseif (is_string($mixed)) {
        // Convert only if not valid UTF-8 already
        if (!mb_check_encoding($mixed, 'UTF-8')) {
            return mb_convert_encoding($mixed, 'UTF-8', 'ISO-8859-1'); // or other encoding if needed
        }
    }
    return $mixed;
}

    /**
     * Executes SQL statement, possibly with parameters, returning
     * an array of all rows in result set or false on (non-fatal) error.
     */
    function query(/* $sql [, ... ] */)
    {
        // SQL statement
        $sql = func_get_arg(0);

        // parameters, if any
        $parameters = array_slice(func_get_args(), 1);

        // try to connect to database
        static $handle;
        if (!isset($handle))
        {
            try
            {
                // connect to database
                $handle = new PDO("mysql:dbname=" . DATABASE . ";host=" . SERVER, USERNAME, PASSWORD);
				// $handle->exec("set names utf8");
				// $handle->exec("set character_set_results='utf8'");
				// $handle->exec("set collation_connection='utf8'");
				// $handle->exec("set character_set_client='utf8'");
                // ensure that PDO::prepare returns false when passed invalid SQL
                $handle->setAttribute(PDO::ATTR_EMULATE_PREPARES, false); 
            }
            catch (Exception $e)
            {
                // trigger (big, orange) error
                trigger_error($e->getMessage(), E_USER_ERROR);
                exit;
            }
        }

        // prepare SQL statement
        $statement = $handle->prepare($sql);
        if ($statement === false)
        {
            // trigger (big, orange) error
            trigger_error($handle->errorInfo()[2], E_USER_ERROR);
            exit;
        }

        // execute SQL statement
        $results = $statement->execute($parameters);

        // return result set's rows, if any
        if ($results !== false)
        {
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }
        else
        {
            return false;
        }
    }

    function query_etracs(/* $sql [, ... ] */)
        {
            // SQL statement
            $sql = func_get_arg(0);
    
            // parameters, if any
            $parameters = array_slice(func_get_args(), 1);
    
            // try to connect to database
            static $handle;
            if (!isset($handle))
            {
                try
                {
                    // connect to database
                    $handle = new PDO("mysql:dbname=" . DATABASE_ETRACS . ";host=" . SERVER_ETRACS, USERNAME_ETRACS, PASSWORD_ETRACS);
                    $handle->exec("set names utf8");
                    $handle->exec("set character_set_results='utf8'");
                    $handle->exec("set collation_connection='utf8'");
                    $handle->exec("set character_set_client='utf8'");
                    // ensure that PDO::prepare returns false when passed invalid SQL
                    $handle->setAttribute(PDO::ATTR_EMULATE_PREPARES, false); 
                }
                catch (Exception $e)
                {
                    // trigger (big, orange) error
                    trigger_error($e->getMessage(), E_USER_ERROR);
                    exit;
                }
            }
    
            // prepare SQL statement
            $statement = $handle->prepare($sql);
            if ($statement === false)
            {
                // trigger (big, orange) error
                trigger_error($handle->errorInfo()[2], E_USER_ERROR);
                exit;
            }
    
            // execute SQL statement
            $results = $statement->execute($parameters);
    
            // return result set's rows, if any
            if ($results !== false)
            {
                return $statement->fetchAll(PDO::FETCH_ASSOC);
            }
            else
            {
                return false;
            }
        }


    

    function logout()
    {
        // unset any session variables
        $_SESSION["dnsc_geoanalytics"] = [];

        // expire cookie
        if (!empty($_COOKIE[session_name()]))
        {
            setcookie(session_name(), "", time() - 42000);
        }

        // destroy session
        //session_destroy();
		unset($_SESSION["dnsc_geoanalytics"]);
    }

    /**
     * Redirects user to destination, which can be
     * a URL or a relative path on the local host.
     *
     * Because this function outputs an HTTP header, it
     * must be called before caller outputs any HTML.
     * 
     * 
     * 
     */

    function strips($data) {
  	  $data = trim($data);
  	  $data = stripslashes($data);
  	  $data = htmlspecialchars($data);
      if(empty($data)) {
        return null;
      }
      else {
        return $data;
      }
  	}



    function redirect($destination)
    {
		
		
		
        // handle URL
        if (preg_match("/^https?:\/\//", $destination))
        {
            header("Location: " . $destination);
			
			
        }

        // handle absolute path
        else if (preg_match("/^\//", $destination))
        {
            $protocol = (isset($_SERVER["HTTPS"])) ? "https" : "http";
            $host = $_SERVER["HTTP_HOST"];
            header("Location: $protocol://$host$destination");
			
        }

        // handle relative path
        else
        {
            // adapted from http://www.php.net/header
            $protocol = (isset($_SERVER["HTTPS"])) ? "https" : "http";
            $host = $_SERVER["HTTP_HOST"];
            $path = rtrim(dirname($_SERVER["PHP_SELF"]), "/\\");
            header("Location: $protocol://$host$path/$destination");
			
			
        }
		
        // exit immediately since we're redirecting anyway
        exit;
    }

    /**
     * Renders template, passing in values.
     */
    function render($template, $values = [])
    {
		
        // if template exists, render it
        // if (file_exists("$template"))
        // {   // {   // {
            // extract variables into local scope
            extract($values);
            // render header
            require("layouts/header.php");
			
			// render sidebar
            require("layouts/sidebar.php");

            // render template
            require("$template");
        // }

        // else err
        // else
        // {
            // trigger_error("Invalid template: $template", E_USER_ERROR);
        // }
    }


    function renderFrontPage($template, $values = [])
    {
            extract($values);
            require("layouts/headerFrontPage.php");
            require("$template");
    }


    function renderview($template, $values = []) {
        extract($values);
        require("$template");
        
    }
	
	function check_input($data) {
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
	}
	
	
	function super_unique($array,$key)
	{
		$temp_array = array();
		foreach ($array as &$v) {
		if (!isset($temp_array[$v[$key]]))
		$temp_array[$v[$key]] =& $v;
			}
		$array = array_values($temp_array);
		return $array;
	}
	
	header('content-type:text/html;charset=utf-8');
	
	


?>
