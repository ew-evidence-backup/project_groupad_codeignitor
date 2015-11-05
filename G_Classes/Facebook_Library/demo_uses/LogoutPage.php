<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns:fb="http://www.facebook.com/2008/fbml" xmlns:og="http://opengraphprotocol.org/schema/">
    <head>
       <title>Facebook Logout PHP Demo web site</title>
       <meta name="description" content="Facebook Connet Logout." />
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
                                    <script>
                                       function DoLogout() {
                                         
                                         if (graphApiInitialized == false)
                                         {
                                             setTimeout('DoLogout()', 100);
                                             return;
                                         }
                                         setTimeout(function() {
                                           FB.logout(function(response) {
                                             alert("You are loged out from Facebook !!");
                                           });
                                         }, 500);
                                       };
                                       DoLogout();
                                    </script>
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