<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns:fb="http://www.facebook.com/2008/fbml" xmlns:og="http://opengraphprotocol.org/schema/">
    <head>
       <title>Facebook Graph API Invite Friends PHP class</title>
       <meta name="description" content="PHP Example of creting Facebook Invite Friends using the Graph API." />
       <link rel="stylesheet" type="text/css" href="styles.css" />
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
                                    <h1>Facebook Invite Friends</h1>
                       
                                    <p style="text-align: justify">
                                    Facebook Invite control is used to invite friends to use Facebook application or Facebook Connect website by sending an invite requests. There are 2 types of invite control: 
                                    classic and condensed. Following examples demonstrate each of these 2 types and PHP code for configuring them. If there are no friends on displayed controls,
                                    please login on Facebook with login button located on top right corner.
                                    <br /><br />
                                    For all details about the controls, with descriptions of all optional properties, please visit
                                    <b><a href="http://faceconn.com/facebook-invite-friends-php">Facebook Invite Friends Tutorial</a></b>.
                                    <br />
                                    </p>
                                    <?php include 'SessionCheck.php'; ?>
                                    <br />

                                    <b>Invite Friends Classic</b><br /><br />
                                    <?php
                                        // create instance of login control
                                        $invite1 = new InviteFriends();

                                        // set main title of the control
                                        $invite1->SetMainTitle("Main title");

                                        // set content inside invite request
                                        $invite1->SetContent("This is content of invite request.");

                                        // render the command
                                        $invite1->Render();

                                        // show the code example
                                        echo "<br /><br />";
                                        include 'CodeExamples/InviteFriendsClassicExample.php';
                                    ?>
                                    <br /><br /><br />


                                     <b>Invite Friends Condensed</b><br /><br />
                                    <?php
                                        // create instance of login control
                                        $invite2 = new InviteFriendsCondensed();

                                        // set content inside invite request
                                        $invite2->SetContent("This is content of invite request.");

                                        // render the command
                                        $invite2->Render();

                                        // show the code example
                                        echo "<br /><br />";
                                        include 'CodeExamples/InviteFriendsCondensedExample.php';
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