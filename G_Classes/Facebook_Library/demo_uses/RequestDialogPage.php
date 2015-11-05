<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns:fb="http://www.facebook.com/2008/fbml" xmlns:og="http://opengraphprotocol.org/schema/">
    <head>
       <title>Facebook Graph API Request Dialog PHP class</title>
       <meta name="description" content="PHP Example of creting Facebook Stream Publish using the Graph API." />
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
                                    <h1>Facebook Request Dialog</h1>
                        
                                    <p style="text-align: justify">
                                    Facebook Request Dialog is used to invite friends to start using an application, or to send request 
                                    for some specific action to application users. It is implemented as button and link on which user has
                                    to click to open the request dialog. There is also an option to open it automatically on page load. 
                                    For this example shown PHP code is used for making a default request dialog with defined message and
                                    CSS class.
                                    <br /><br />
                                    For all details about the control, with descriptions of all optional properties, please visit 
                                    <b><a href="http://faceconn.com/facebook-request-dialog-php">Facebook Request Dialog Tutorial</a></b>.
                                    <br /><br />
                                    </p>
                                    
                                    <?php
                                        // check facebook session
                                        include 'SessionCheck.php';
                                    
                                        // create instance of request dialog cotrols
                                        $request = new RequestDialog();

                                        // set message
                                        $request->SetMessage("Try Facebook Connect PHP Toolkit");
                                        
                                        // Optional: set css class of publish button
                                        $request->SetCssClass("facebookbutton");
                                        
                                        // render the control on the page
                                        $request->Render();

                                        // render the control on the page
                                        echo "<br /><br />";
                                        include 'CodeExamples/RequestDialogExample.php';
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