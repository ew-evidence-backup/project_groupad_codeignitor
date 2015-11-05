<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns:fb="http://www.facebook.com/2008/fbml" xmlns:og="http://opengraphprotocol.org/schema/">
    <head>
       <title>Facebook Graph API Like Box PHP class</title>
       <meta name="description" content="PHP Example of creting Facebook Like Box using the Graph API." />
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
                                    <h1>Facebook Like Box</h1>
                        
                                    <p style="text-align: justify">
                                    This control is used to allow users of the web site to become fan of the Facebook page, see messages from the page wall and people who are fans of the page.
                                    The example shows how to create 3 like boxes. The fist one is default with 10 fans, show stream and show header. The second one is without fan list and the third
                                    one is without fans and stream.
                                    <br /><br />
                                    For all details about the control, with descriptions of all optional properties, please visit
                                    <b><a href="http://faceconn.com/facebook-like-box-php">Facebook Like Box Tutorial</a></b>.
                                    <br />
                                    </p>

                                    <?php
                                        // check facebook session
                                        include 'SessionCheck.php';
                                    
                                        // create instance of the control
                                        $likeBox = new LikeBox();

                                        // setting of page Id
                                        $likeBox->SetPageId("167880046558855");

                                        // render the default control on the page
                                        $likeBox->Render();

                                        // render without fan list
                                        $likeBox->SetFansCount(0);
                                        $likeBox->Render();

                                        // render without fan list and stream
                                        $likeBox->SetShowStream(false);
                                        $likeBox->Render();

                                        // show the code example
                                        echo "<br /><br />";
                                        include 'CodeExamples/LikeBoxExample.php';
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
