<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns:fb="http://www.facebook.com/2008/fbml" xmlns:og="http://opengraphprotocol.org/schema/">
    <head>
       <title>Facebook Graph API Like Button PHP class</title>
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
                                    <h1>Facebook Like Button</h1>
                        
                                    <p style="text-align: justify">
                                    Like Button is used to enable users of website to share interesting content with their friends. When user clicks on like button inside you page, 
                                                            a story will appear in the user's friends' News Feed, with link back to your site. This increases number of visitors to your site. 
                                                            Following example shows 3 types of layout of like button: 'standard', 'button_count' and 'box_count'. Last button is standard 
                                                            type with 'send' option enabled. 
                                    <br /><br />
                                    For all details about the control, with descriptions of all optional properties, please visit
                                    <b><a href="http://faceconn.com/facebook-like-button-php">Facebook Like Button Tutorial</a></b>.
                                    <br />
                                    </p>
                                    
                                    <?php
                                        // check facebook session
                                        include 'SessionCheck.php';
                                        
                                        // create new instance of the control
                                        $like = new LikeButton();

                                        // Optional: set external URL
                                        $like->SetUrl("http://faceconn.com");

                                        // render the control on the page
                                        $like->Render();
                                        echo "<br /><br />";
                                        
                                        // set layout to button_count
                                        $like->SetLayout("button_count");
                                        $like->Render();
                                        echo "<br /><br />";
                                        
                                        // set layout to box_count
                                        $like->SetLayout("box_count");
                                        $like->Render();
                                        echo "<br /><br />";
                                        
                                        // set layout to standard and show send button
                                        $like->SetLayout("standard");
                                        $like->SetSend(true);
                                        $like->Render();
                                        echo "<br /><br />";

                                        // show the code example
                                        echo "<br /><br />";
                                        include 'CodeExamples/LikeButtonExample.php';
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