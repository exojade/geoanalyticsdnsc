<?php
    require("includes/google_class.php"); 
  //  dump("awit");
    if(!isset($_GET['code'])){
		// dump($_GET);
        header('Location: '.$google->createAuthUrl());
        exit;
    }
    if(isset($_GET['code'])){
    //  dump($google->authenticate($_GET['code']));
		  $accessToken = $google->authenticate($_GET['code']);
      $google->setAccessToken($accessToken);

      // $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
      // $client->setAccessToken($token['access_token']);

      // Get user info
      $service = new Google_Service_Oauth2($google);
      $userInfo = $service->userinfo->get();

      $users = query("select * from users where username = ?",  $userInfo->getEmail());
      // dump($users);
      if(empty($users)):

        $userid = create_trackid("USR-");

        if (query("insert INTO users (userid, username, password, role, fullname) 
          VALUES(?,?,?,?,?)", 
          $userid, $userInfo->getEmail() ,$userInfo->getEmail(), "CLIENT", $userInfo->getName()) === false)
          {
              echo("not_success");
          }
          else;


        // query


        // query();


        // dump("WALA KA NAREHISTRO");
      else:
        $_SESSION["dnsc_geoanalytics"] = [
          "userid" => $users[0]["userid"],
          "uname" => $users[0]["username"],
          "role" => $users[0]["role"],
          "fullname" => $users[0]["fullname"],
          "profile_image" => "",
          "application" => "dnsc_geoanalytics"
        ];
        $_SESSION["dnsc_geoanalytics"]['accessToken'] = $accessToken;
        // $google->setAccessToken($_SESSION["dnsc_geoanalytics"]['accessToken']);
        // $_SESSION["dnsc_geoanalytics"]['accessToken'] = $google->authenticate($_GET['code']);
      endif;


      redirect("index");
 

      // $_SESSION["dnsc_geoanalytics"]["user"] = $userInfo->getEmail();
      // $name = $userInfo->getName();


     
		// redirect($_SESSION["pathers"]);
		// echo("i meant this");
		// redirect("index");
    }



?>