<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns:fb="http://www.facebook.com/2008/fbml" xmlns:og="http://opengraphprotocol.org/schema/">
    <head>
       <title>Facebook Graph API Login Button PHP class</title>
       <meta name="description" content="PHP Example of creting Facebook Login Button using the Graph API." />
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
                    <form id="form1" action="UserDataPage.php">
                        <table >
                            <tr>
                                <td valign="top" style="width:155px">
                                    <?php include "LinkList.php"; ?>
                                </td>
                                <td valign="top" style="width:770px; padding-top: 5px">
                                    <h1>Facebook Login Button</h1>
                    
                                    <p style="text-align: justify">
                                    Login Button control is used to connect a web site to the Facebook and allow it to use the Facebook API. It also enables the user that once he is logged, all controls from this list will 
                                    work without additional logging. It is also possible to define JavaScript code which will be executed after user is successfully logged, or form id which will be submitted which allows
                                    redirection to another page, or resubmitting the current page.

                                    <br /><br />
                                    For all details about the control, with descriptions of all optional properties, please visit
                                    <b><a href="http://faceconn.com/facebook-login-button-php">Facebook Login Button Tutorial</a></b>.</p>
                                    <br />

                                    <b>Example:</b><br />
                                    <p style="text-align: justify">
                                    The example demonstrates login button configured with all optional parameters. Below the login button is code used for configuration. Press the login button to see how it works. 
                                    When you press it, popup window will show up, and you have to enter Facebook credentials. After your successful login, you will be asked to allow the usage of extended permissions for the 
                                    website (this example shows setting of email permission). After confirmation you will be redirected to another page where your basic profile data will be shown. There is
                                    also an option to set JavaScript code which will be executed after successful login.
                                    </p>
                                    <br />
                                    <?php
                                        // creating new instande of Login Button
                                        $login = new LoginButton();

                                        // Optional: setting text and size
                                        $login->SetText("Sign up with Facebook");
                                        $login->SetSize("small");

                                        // Optional: setting list of extended permissions
                                        $login->SetPermissions("email");

                                        // Optional: setting the form id which will be submitted
                                        // on successfull login (redirect on User Data page)
                                        $login->SetOnLoginSubmitForm("form1");

                                        // Render commmand on the page
                                        $login->Render();

                                        // show the code example
                                        echo "<br /><br />";
                                        include 'CodeExamples/LoginButtonExample.php';
                                        
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