<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns:fb="http://www.facebook.com/2008/fbml" xmlns:og="http://opengraphprotocol.org/schema/">
    <head>
       <title>Facebook Graph API Send Button PHP class</title>
       <meta name="description" content="PHP Example of creting Facebook Like Button using the Graph API." />
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
                                    <h1>Facebook Send Button</h1>
                        
                                    <p style="text-align: justify">
                                    Facebook Send Button is used by users of website to share interesting content with their friends 
                                    by selecting them from friends list. This will result in sending the message to friends' inbox. 
                                    There is also an option to send it to the wall of group that user is fan of, or any email address.
                                    The example shows PHP code needed to insert default Send button, with defined external URL.
                                    <br /><br />
                                    For all details about the control, with descriptions of all optional properties, please visit
                                    <b><a href="http://faceconn.com/facebook-send-button-php">Facebook Send Button Tutorial</a></b>.
                                    <br />
                                    </p>
                                    
                                    <?php
                                        // check facebook session
                                        include 'SessionCheck.php';
                                        
                                        // create new instance of the control
                                        $send = new SendButton();

                                        // Optional: set external URL
                                        $send->SetUrl("http://faceconn.com");

                                        // render the control on the page
                                        $send->Render();

                                        // show the code example
                                        echo "<br /><br />";
                                        include 'CodeExamples/SendButtonExample.php';
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