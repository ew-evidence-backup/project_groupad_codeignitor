<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns:fb="http://www.facebook.com/2008/fbml" xmlns:og="http://opengraphprotocol.org/schema/">
    <head>
       <title>Facebook Graph API Bookmark Button PHP class</title>
       <meta name="description" content="PHP Example of creting Facebook Bookmark Button using the Graph API." />
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
                                    <h1>Bookmark Button</h1>
                        
                                    <p style="text-align: justify">
                                    With Bookmark button users can easily bookmark your website inside the Facebook environment. If you don't see Bookmark button, you should log in to
                                    Facebook first by using the Login Button. Once an application is bookmarked, the button will not be displayed anymore. The example shows PHP code of
                                    how to add bookmark button on a page.
                                    <br /><br />
                                    For all details about the control, with descriptions of all optional properties, please visit
                                    <b><a href="http://faceconn.com/facebook-bookmark-button-php">Facebook Bookmark Button Tutorial</a></b>.
                                    <br /><br />
                                    </p>
                                    
                                    <?php
                                        // create new instance of the control and render
                                        $bookmark = new Bookmark();
                                        $bookmark->Render();

                                        // show the code example
                                        echo "<br /><br />";
                                        include 'SessionCheck.php';
                                        include 'CodeExamples/BookmarkExample.php';
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
