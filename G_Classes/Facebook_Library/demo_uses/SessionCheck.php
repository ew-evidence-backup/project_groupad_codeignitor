<?php
    // create facebook object.
    $facebook = new Facebook(AppConfig::GetKeyArray());
    

    // create facebook session
    $facebookUser = $facebook->getUser();
    
    // check if user if connected
    if (! $facebookUser) {
        echo"<br><b>Facebook session is not established. Please login by pressing login button:</b>";
         $login = new LoginButton();
         $login->SetSize("small");
         $login->SetOnLoginSubmitForm("form1");
         $login->Render();
         echo "<br /><br />";
    }
?>