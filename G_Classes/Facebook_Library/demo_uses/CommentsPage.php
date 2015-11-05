<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns:fb="http://www.facebook.com/2008/fbml" xmlns:og="http://opengraphprotocol.org/schema/">
    <head>
       <title>Facebook Graph API Comments PHP class</title>
       <meta name="description" content="PHP Example of creting Facebook Comments using the Graph API." />
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
                                     <h1>Facebook Comments</h1>
                        
                                    <p style="text-align: justify">
                                    This control allows users of your web site to write comments and share them with their friends by posting them on their profiles.
                                    Posting a comment on user's wall will result in more visitors from the Facebook to your site. The example shows PHP code for creating default
                                    Comments control which has 10 displayed comments and width of 550 pixels.
                                    <br /><br />
                                    For all details about the control, with descriptions of all optional properties, please visit
                                    <b><a href="http://faceconn.com/facebook-comments-php">Facebook Comments Tutorial</a></b>.
                                    <br />
                                    </p>
                                    <?php
                                        // check facebook session
                                        include 'SessionCheck.php';
                                        
                                        // create new instance of the control and render
                                        $comments = new Comments();
                                        $comments->Render();

                                        // show the code example
                                        echo "<br /><br />";
                                        include 'CodeExamples/CommentsExample.php';
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
