<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns:fb="http://www.facebook.com/2008/fbml" xmlns:og="http://opengraphprotocol.org/schema/">
    <head>
       <title>Facebook Graph API Extended Permissions PHP class</title>
       <meta name="description" content="PHP Example of creting Facebook Extended Permissions using the Graph API." />
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
                                    <h1>Facebook Extended Permissions</h1>
                        
                                    <p style="text-align: justify">
                                    Permission control is used to allow the user to add extended permissions, like sending upload images and status updates, to Facebook application. It is possible
                                    to define JavaScript code which will be executed and form id which will be submitted after permissions are confirmed by user. This example shows PHP code used
                                    for adding 2 permissions (sending an email and getting user activities).

                                    <br /><br />
                                    For all details about the control, with descriptions of all optional properties, please visit
                                    <b><a href="http://faceconn.com/facebook-extended-permissions-php">Facebook Extended Permissions Tutorial</a></b>.
                                    <br /><br />
                                    </p>
                                    
                                    <?php
                                        // check facebook session
                                        include 'SessionCheck.php';
                                        
                                        // create new instance of Permssions control
                                        $perms = new Permissions();

                                        // set permissions on email and SMS
                                        $perms->SetPermissions("email, user_activities");

                                        // Optional: set CSS class for add permissions button
                                        $perms->SetCssClass("facebookbutton");

                                        // Optional: set JavaScript code for confirmation
                                        $perms->SetOnConfirmJavaScript("alert('permissions added')");

                                        // Optional: set submit form id for confirmation
                                        $perms->SetOnConfirmSubmitForm("form1");

                                        // render the control on the page
                                        $perms->Render();

                                        // render the control on the page
                                        echo "<br /><br />";
                                        include 'CodeExamples/PermissionsExample.php';
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

