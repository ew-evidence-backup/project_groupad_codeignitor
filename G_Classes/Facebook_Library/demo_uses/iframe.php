<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns:fb="http://www.facebook.com/2008/fbml" xmlns:og="http://opengraphprotocol.org/schema/">
    <head>
       <title>Facebook iFrame example</title>
       <meta name="description" content="Facebook iFrame demo page for PHP development." />
       <link rel="stylesheet" type="text/css" href="styles.css" />
    </head>
    <body>
       <div style="width:760px">
          <?php
              require_once 'facebook.php';
              require_once 'faceconn/faceconn.php';
              UseGraphAPI();
          ?>
       
          <form id="form1">
             <?php
                  // create facebook object.
                  $facebook = new Facebook(AppConfig::GetKeyArray());

                  // create facebook session
                  $session = $facebook->getSession();


                  if (!$session) // is session not exist redirect application in Facebook iFrame URL that user have log in
                  {
                      $loginUrl = $facebook->getLoginUrl(
                              array(
                              'canvas'    => 1,
                              'fbconnect' => 0,
                              'req_perms' => 'email'    // example of adding email permission
                              )
                      );

                      $redirectScript = "<script type=\"text/javascript\">\n";
                      $redirectScript .= "if (parent != self) \n";
                      $redirectScript .= "top.location.href = \"" . $loginUrl . "\";\n";
                      $redirectScript .= "else self.location.href = \"" . $loginUrl . "\";\n";
                      $redirectScript .= "</script>";

                      echo $redirectScript;
                  } // user is already logged, get user data using graph api
                  else {
                      // get user data
                      $loggedUser = $facebook->api('/me');
                      echo "<b>User data:</b><br />";
                      echo "<br /><b>User ID:</b> " . $loggedUser['id'];
                      echo "<br /><b>First name:</b> " . $loggedUser['first_name'];
                      echo "<br /><b>Last name:</b> " . $loggedUser['last_name'];
                      echo "<br /><b>Email:</b> " . $loggedUser['email'];
                  }
              ?>
           </form>
        </div>
    </body>
</html>