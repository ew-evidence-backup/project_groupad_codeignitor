<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns:fb="http://www.facebook.com/2008/fbml" xmlns:og="http://opengraphprotocol.org/schema/">
    <head>
       <title>Facebook Graph API Recommendations PHP class</title>
       <meta name="description" content="PHP Example of creting Facebook Recomendations using the Graph API." />
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
                                    <h1>Facebook Recommendations</h1>
                        
                                    <p style="text-align: justify">
                                    Recommendations control is used to show a list of interesting content for particular domain. The list is created depending on user personal preferences and
                                    shared content by other people. The example shows PHP code for creating the control with default setting: width 300 pixels, height 300 pixels, show header and
                                    light color scheme. Recommendations are set for faceconn.com domain.

                                    <br /><br />
                                    For all details about the control, with descriptions of all optional properties, please visit
                                    <b><a href="http://faceconn.com/facebook-recommendations-php">Facebook Recommendations Tutorial</a></b>.
                                    <br />
                                    </p>
                                    
                                    <?php
                                        // check facebook session
                                        include 'SessionCheck.php';
                                    
                                        // create new instance of the control
                                        $recomendations = new Recommendations();

                                        // set external domain
                                        $recomendations->SetDomain("faceconn.com");

                                        // render the control on the page
                                        $recomendations->Render();

                                        // render the control on the page
                                        echo "<br /><br />";
                                        include 'CodeExamples/RecommendationsExample.php';
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
