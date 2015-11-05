<?php
    if ($_SERVER["SERVER_NAME"] == "localhost")
    {
        Facebook::$CURL_OPTS[CURLOPT_SSL_VERIFYPEER] = false;
        Facebook::$CURL_OPTS[CURLOPT_SSL_VERIFYHOST] = 2;
    }

    require_once 'AppConfig.php';

    if (AppConfig::GetAppId() == null)
    {
        throw new Exception("AppId key is not set. Please edit AppConfig.php file and set value from your application");
    }
    if (AppConfig::GetSecret() == null)
    {
        throw new Exception("App secret key is not set. Please edit AppConfig.php file and set value from your application");
    }
    if (AppConfig::GetAppName() == null)
    {
        throw new Exception("App name is not set. Please edit AppConfig.php file and set value from your application");
    }
    if (AppConfig::GetAppCanvasUrl() == null)
    {
        throw new Exception("App Canvas URL is not set. Please edit AppConfig.php file and set value from your application");
    }
   
    require_once 'GraphApi.php';
    require_once 'LoginButton.php';
    require_once 'RequestDialog.php';
    require_once 'InviteFriends.php';
    require_once 'InviteFriendsCondensed.php';
    require_once 'StreamPublish.php';
    require_once 'Permissions.php';
    require_once 'LikeButton.php';
    require_once 'SendButton.php';
    require_once 'LikeBox.php';
    require_once 'Comments.php';
    require_once 'Bookmark.php';
    require_once 'Recommendations.php';
?>
