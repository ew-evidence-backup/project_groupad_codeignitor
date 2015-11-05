<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns:fb="https://www.facebook.com/2008/fbml" xmlns:og="http://opengraphprotocol.org/schema/">
    <head>
       <title>Facebook Graph API PHP example</title>
       <meta name="description" content="PHP Example of getting Facebook data using the Graph API." />
       <link rel="stylesheet" type="text/css" href="styles.css" />
       <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    </head>
     <body>
         <?php
            require_once 'facebook.php';
            require_once 'faceconn/faceconn.php';
            UseGraphAPI();
        ?>
         <table>
            <tr>
                <td style="width:20%"></td>
                <td>
                    <img src="Images/banner.png" alt="" />
                    <form id="form1">
                        <table >
                            <tr>
                                <td valign="top" style="width:155px">
                                    <?php include "LinkList.php"; ?>
                                </td>
                                <td valign="top" style="width:770px; padding-top: 5px">
                                    <h1>Get Facebook Data</h1>
                        
                                    <p style="text-align: justify">
                                    This page demonstrates how to use Facebook Graph API to get some data from Facebook. First part of PHP code gets basic data
                                    of logged user and write it to page. Second part gets data about user's friends and write their names.
                                    <br />
                                    </p>
                                    
                                    <?php
                                        // create facebook object.
                                        $facebook = new Facebook(AppConfig::GetKeyArray());

                                        // create facebook user
                                        $facebookUser = $facebook->getUser();

                                        // check if user if connected
                                        if ($facebookUser) {
                                            // get user data
                                            $loggedUser = $facebook->api('/me');
                                            echo "<b>User data:</b><br />";
                                            echo "<br /><b>User ID:</b> " . $loggedUser['id'];
                                            echo "<br /><b>First name:</b> " . $loggedUser['first_name'];
                                            echo "<br /><b>Last name:</b> " . $loggedUser['last_name'];

                                            // get first 5 friends
                                            echo "<br /><br /><br /><b>Friends:</b><br /><br />";
                                            $friends = $facebook->api('/me/friends');
                                            $friendsData = $friends['data'];

                                            for ($i = 0; $i < sizeof($friendsData) && $i < 5; $i++)
                                            {
                                                $friend = $friendsData[$i];
                                                echo $friend['name'] . ", ";
                                            }
                                        }
                                        else
                                        {
                                            echo"<br><b>Facebook session is not established. Please login by pressing login button:</b>";
                                            $login = new LoginButton();
                                            $login->SetOnLoginSubmitForm("form1");
                                            $login->Render();
                                        }

                                        // show the code example
                                        echo "<br /><br />";
                                        include 'CodeExamples/UserDataExample.php';
                                    ?>
                                </td>
                            </tr>
                        </table>
                    </form>
                </td>
                <td style="width:20%"></td>
            </tr>
        </table>
    </body>
</html>
