<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns:fb="http://www.facebook.com/2008/fbml" xmlns:og="http://opengraphprotocol.org/schema/">
    <head>
       <title>Facebook Connect Demo web site</title>
       <meta name="description" content="Facebook Connet Graph API classes for PHP development." />
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
                                    <h1>Facebook Connect PHP Toolkit Demo pages</h1>

                                    <p style="text-align: justify">
                                    This website is used as an example on how to use Facebook Connect PHP Toolkit classes. The classes will make Facebook applications development much faster and easier to maintain.
                                    The toolkit contains 10 of the most used UI components for Facebook Connect web sites which are also applicable for Facebook iFrame applications. Each class is supplemented
                                    with a demo page.
                                    <br />
                                    </p>

                                    <?php include 'SessionCheck.php'; ?>
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