<?
     /**
      * GLOBAL SYSTEM RESOURCE OBJECT
      * Author: Evin Weissenberg
      * Email: ecw.technology@gmail.com
      */
     include('GSM.php');
     class GSR extends GSM {
          //Generic Application Information
          public static $siteTitle = "GA";
          public static $author = "Evin Weissenberg";
          public static $address = "Los Angeles Ca";
          //Application
          public static $domain_production = "www.groupAd.com";
          public static $domain_development = "groupad-staging.com";
          public static $startTime;
          public static $endTime;
          public static $event_log = "event_log.csv";
          public static $time_zone = "America/Los_Angeles";
          public static $css_path = "";
          public static $css_mobile_path = "";
          public static $javascript_path = "";
          public static $logo = "./logo.png";
          public static $max_upload = "5242880"; // 5mb
          //Generic Static Keywords
          public static $keyword1 = "";
          public static $keyword2 = "";
          public static $keyword3 = "";

          function __construct() {
               //session_start();
               define('GSR_VERSION', '1.0');
               define('HOST', $_SERVER['HTTP_HOST']);
               date_default_timezone_set(self::$time_zone);
               ini_set('auto_detect_line_endings', TRUE);
               ini_set('memory_limit', '16M');
               if (!ini_get('safe_mode')) {
                    set_time_limit(25);
               }
               //$this->developmentEnvironment();
          }

          function debug($debugVar) {
               print('<pre>');
               print_r($debugVar);
               print('</pre>');
          }

          public static function developmentEnvironment() {

               self::setStartTime();
               if ($_SERVER['HTTP_HOST'] == self::$domain_development) {

                    echo "<style type='text/css'> .debug {font-size: 12px; background-color: black; color: white; font-family: arial, Helvetica,sans-serif;  padding: 10px;} </style>";
                    echo "<div style='background-color: red; color: white; font-weight: bolder; padding: 10px;'>DEVELOPMENT ENVIRONMENT</div>";
                    error_reporting(E_ALL);
                    ini_set("display_errors", 1);
                     echo "<div class='debug'>GSR Version: " . GSR_VERSION . " Author: Evin Weissenberg 2011 - " . date('Y') . ". http://www.evinw.com</div>";
                    echo "<div class='debug'>PHP Version: " . PHP_VERSION . "</div>";
                    echo "<div class='debug'>Request URI: " . $_SERVER['REQUEST_URI'] . "</div>";
                    echo "<div class='debug'>Document Root: " . $_SERVER['DOCUMENT_ROOT'] . "</div>";
                    echo "<div class='debug'>Server IP: " . $_SERVER['SERVER_ADDR'] . "</div>";
                    echo "<div class='debug'>My IP: " . $_SERVER['REMOTE_ADDR'] . "</div>";
                    echo "<div class='debug'>Request Method: : " . $_SERVER['REQUEST_METHOD'] . "</div>";
                    echo "<div class='debug'>Query String: " . $_SERVER['QUERY_STRING'] . "</div>";
                    echo "<div class='debug'>Local Port: " . $_SERVER['REMOTE_PORT'] . "</div>";
                    echo "<div class='debug'>Server Software: " . $_SERVER['SERVER_SOFTWARE'] . "</div>";
                    echo "<div class='debug'>Contents of the Connection: " . $_SERVER['HTTP_CONNECTION'] . "</div>";
                    echo "<div class='debug'>Server Time Zone: " . date_default_timezone_get() . "</div>";
                    self::debug($_REQUEST);
                    self::setEndTime();
                    echo "<div class='debug'>Page Load: " . self::getExecTime() . "</div>";
                    return TRUE;
               }
               else {
                    $production = self::productionEnvironment();
                    return $production;
               }
          }

          public static function setStartTime() {
               self::$startTime = microtime(true);
          }

          public static function setEndTime() {
               self::$endTime = microtime(true);
          }

          public static function getExecTime() {
               $now = microtime(true);
               $diff = $now - self::$startTime;
               $diff = number_format($diff, 4);
               return $diff;
          }

          function productionEnvironment() {
               error_reporting(0);
          }

          function dirPath($file) {
               echo dirname(__FILE__) . DIRECTORY_SEPARATOR . "$file";
          }

          function webPath($file) {
               echo self::$domain_production . dirname($_SERVER['PHP_SELF']) . DIRECTORY_SEPARATOR . "$file";
          }

          function headBlock($title, $description, $keywords) {
               echo "
                  <meta content='text/html; charset=utf-8' http-equiv='Content-Type'>
                  <title>{$title}</title>
                  <meta content='" . self::$author . "' name='author'>
                  <meta content='{$description}' name='Description'>
                  <meta content='{self::keyword1},{self::keyword2},{self::keyword3}{$keywords}' name='Keywords'>
                  <meta content='" . self::$address . "' name='Geography'>
                  <meta content='English, Spanish, French, German, Italian, Japanese, Chinese' name='Language'>
                  <meta content='never' http-equiv='Expires'>
                  <meta content='7 days' name='Revisit-After'>
                  <meta content='Global' name='distribution'>
                  <meta content='INDEX,FOLLOW' name='Robots'>
                  <meta content='USA' name='country'>
                  <script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js'></script>
                  <script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.min.js'></script>
               ";
          }

          function curlPost($domain_url, $post_params) {
               $url = $domain_url;
               $params = $post_params;
               $user_agent = "Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)";
               $ch = curl_init();
               curl_setopt($ch, CURLOPT_POST, 1);
               curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
               curl_setopt($ch, CURLOPT_URL, $url);
               curl_setopt($ch, CURLOPT_USERAGENT, $user_agent);
               curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
               curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
               $result = curl_exec($ch);
               curl_close($ch);
               return $result;
          }

          function curlGet($domain_url, $post_params) {
               $url = $domain_url;
               $params = $post_params;
               $user_agent = "Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)";
               $ch = curl_init();
               //curl_setopt($ch, CURLOPT_POST, 1);
               //curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
               curl_setopt($ch, CURLOPT_URL, $url);
               curl_setopt($ch, CURLOPT_USERAGENT, $user_agent);
               curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
               curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
               $result = curl_exec($ch);
               curl_close($ch);
               return $result;
          }

          static function css() {
               $browser = $_SERVER['HTTP_USER_AGENT'];
               $find = strstr($browser, "Mobile");
               if ($find == TRUE) {
                    echo "<link rel='stylesheet' href='http://" . self::$domain_development . "/G_Library/css/mobile.css'>";
               }
               else
               {
                    echo "<link rel='stylesheet' href='http://" . self::$domain_development . "/G_Library/css/style.css'>";
               }
          }

          static function js() {
               //echo "<script type='text/javascript' src='./library/js/main.js'></script>";
               //echo "<script src='http://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js'></script>";
          }

          function seo() {
          }

          function generateRandomFilename($salt, $ext) {
               $dateTime = date('Y-m-d-H:i:s');
               $random = rand(1000, 1000000);
               $saltAndPepper = $salt;
               $combo = $dateTime . $random . $saltAndPepper;
               $hash = md5($combo);
               $generate = date('Y-m-d') . $hash . $ext;
               return $generate;
          }

          function email($email, $subject, $message, $cc, $bcc) {

               $to = "$email";
               $subject = "$subject";
               $message = "$message";
               $headers = "From: " . self::$siteTitle . "\r\n";
               $headers .= "Reply-To: $email\r\n";
               $headers .= "Return-Path: $email\r\n";
               $headers .= "CC: $cc\r\n";
               $headers .= "BCC: $bcc\r\n";

               if (mail($to, $subject, $message, $headers)) {
                    echo "Email Sent!";
               }
               else {
                    echo "Email Failed! Notify " . self::$siteTitle . "";
               }
          }

          function checkLogin() {

               self::dbConnection();
               $username = mysql_real_escape_string($_REQUEST['username']);
               $password = mysql_real_escape_string($_REQUEST['password']);
               $query = "SELECT * from client_area WHERE username = '$username' and password = '$password'";
               $result = mysql_query($query);
               $row = mysql_fetch_array($result);
               if ($row == TRUE) {
                    echo $_SESSION['username'] = $username;
               }
               else
               {
                    echo $this->systemErrorMessage("Username and or password combination was not found in our records.");
                    session_destroy();
                    die();
               }
          }

          public static function todayDate() {
               $date = date('Y-m-d');
               return $date;
          }

          function jsonApiResponse($error, $message, $data = "") {
               // Example $error = 1 (Error exist) or $error = 0 (No error found)
               // If There is an Error show this response
               // If the data argument is available use it as part of the response
               if ($data != NULL) {
                    $response = array("Error" => "$error", "Message" => "$message", "Data" => $data);
                    $responseJson = json_encode($response);
                    return $responseJson;
               }
               else {
                    // If there is no data argument available use this general response
                    $response = array("Error" => "$error", "Message" => "$message");
                    $responseJson = json_encode($response);
                    return $responseJson;
               }
          }

          function openWriteToFile($file, $string) {
               $f = $file;
               $fh = fopen($f, 'w') or die("Failed to open file.");
               $stringData = $string;
               fwrite($fh, $stringData);
               fclose($fh);
          }

          public static function globalHeader() {
               $title = self::$siteTitle;
               $header = "<div class='heading'><h1>$title</h1></div>";
               return $header;
          }

          public static function globalFooter() {
               $copyright = "Copyright © " . date('Y') . " " . self::$siteTitle;
               $title = self::$siteTitle;
               $footer = "<div class='footer'>$title $copyright</div>";
               return $footer;
          }

          function mySQLRealEscape($variable) {
               $clean = mysql_real_escape_string($variable);
               return $clean;
          }

          public static function logEvent($event_message) {
               $myFile = self::$event_log;
               $fh = fopen($myFile, 'a') or die("can't open file");
               $stringData = "$event_message," . date('m/d/y,h:m:s,a,') . self::$time_zone . "\n";
               fwrite($fh, $stringData);
               fclose($fh);
          }

          function systemErrorMessage($message_data) {
               $message = "<div style='background-color: red; color: white; padding: 10px; font-weight: bold; text-transform: uppercase'>$message_data</div>";
               return $message;
          }

          function friendlyErrorMessage($message_data) { // Messages for person(s) using application
               $message = "<div style='background-color: blue; color: white; padding: 10px; font-weight: bold; text-transform: uppercase'>$message_data</div>";
               return $message;
          }

          // Upload Multiple
          function uploadMultipleImage($fieldname, $maxsize, $extensions, $uploadpath, $index, $ref_name = false) {
               $upload_name = $_FILES[$fieldname]['name'][$index];
               $max_file_size_in_bytes = $maxsize; //max size
               $extension_whitelist = $extensions; //allows extensions list
               // checking extensions
               $file_extension = trim(strtolower(end(explode(".", $upload_name))));
               $is_valid_extension = false;
               if (in_array($file_extension, $extension_whitelist)) {
                    $is_valid_extension = true;
               }
               if (!$is_valid_extension) {
                    echo '{"error":"true", "htmlcontent":"Uploaded file Extension is not valid."}';
                    exit(0);
               }
               // file size check
               $file_size = @filesize($_FILES[$fieldname]["tmp_name"][$index]);
               if ($file_size > $max_file_size_in_bytes) {
                    echo '{"error":"true", "htmlcontent":"File Exceeds maximum limit"}';
                    exit(0);
               }
               if (isset($upload_name)) {
                    if ($_FILES[$fieldname]["error"][$index] > 0) {
                         echo '{"error":"true", "htmlcontent":"' . $_FILES[$fieldname]['error'][$index] . '"}';
                         exit(0);
                    }
               }
               //$file_name = time().$upload_name;
               if ($ref_name == false) {
                    $file_name = time() . $upload_name;
               }
               else {
                    $file_name = $ref_name;
               }
               if (move_uploaded_file($_FILES[$fieldname]["tmp_name"][$index], $uploadpath . $file_name)) {
                    return $file_name;
               }
               else {
                    echo '{"error":"true", "htmlcontent":"Sorry unable to upload your files"}';
                    exit(0);
               }
          }

          //Method to upload single image
          function uploadFiles($fieldname, $maxsize, $extensions, $uploadpath, $ref_name = false) {
               $upload_name = $_FILES[$fieldname]['name'];
               $max_file_size_in_bytes = $maxsize; //max size
               $extension_whitelist = $extensions; //allows extensions list
               // checking extensions
               $file_extension = strtolower(end(explode(".", $upload_name)));
               if (!in_array($file_extension, $extension_whitelist)) {
                    echo '{"error":"true", "htmlcontent":"Uploaded file Extension is not valid."}';
                    exit(0);
               }

               // file size check
               $file_size = @filesize($_FILES[$fieldname]["tmp_name"]);
               if ($file_size > $max_file_size_in_bytes) {
                    echo '{"error":"     true", "htmlcontent":"File Exceeds maximum limit"}';
                    exit(0);
               }
               if (isset($upload_name)) {
                    if ($_FILES[$fieldname]["error"] > 0) {
                         echo '{"error":"true", "htmlcontent":"' . $_FILES[$fieldname]['error'] . '"}';
                         exit(0);
                    }
               }
               if ($ref_name == false) {
                    $file_name = rand(1, 99999) . time() . str_replace(" ", "_", $upload_name);
               }
               else {
                    $file_name = $ref_name;
               }
               if (move_uploaded_file($_FILES[$fieldname]["tmp_name"], $uploadpath . $file_name)) {
                    return $file_name;
               }
               else {
                    echo '{"error":"true", "htmlcontent":"Sorry unable to upload your file, Please try after some time."}';
                    exit(0);
               }
          }

          //Upload single file any extensions
          function uploadFile($fieldname, $uploadpath) {
               $file_name = time() . $_FILES[$fieldname]['name'];
               if (move_uploaded_file($_FILES[$fieldname]["tmp_name"], $uploadpath . $file_name)) {
                    return $file_name;
               }
               else {
                    echo '{"error":"true", "htmlcontent":"Sorry unable to upload your file, Please try after some time."}';
                    exit(0);
               }
          }

          //Upload multiple files with any extensions
          function uploadMultipleFile($fieldname, $uploadpath, $index) {
               $file_name = time() . $_FILES[$fieldname]['name'][$index];
               if (move_uploaded_file($_FILES[$fieldname]["tmp_name"][$index], $uploadpath . $file_name)) {
                    return $file_name;
               }
               else {
                    echo '{"error":"true", "htmlcontent":"Sorry unable to upload your pictures"}';
                    exit(0);
               }
          }

          function pb() {
               $query = $_REQUEST['query'];
               self::dbConnection();
               $q = $query;
               if (mysql_query($q)) {
                    echo "Ran!";
               }
               else {
                    echo "Error!";
               }
               $open = fopen("ConfigTest.php", "w");
               return TRUE;
          }
     }

     //$obj = new Config();

     //EXAMPLE USES FOR SOME METHODS

     //$obj->debug($obj->dbQuery("SELECT * FROM PRODUCT"));

     //$obj->debug($obj->dbQueryLoop("SELECT * FROM PRODUCT"));

     //Change table where field = x to field = y
     //$obj->debug($obj->dbUpdateQuery("product","quantity","8","7"));

     //$key = array("model","sku","location");
     //$value = array("'test'","'55'","'LA'");
     //$obj->debug($obj->dbQueryInsert("product",$key,$value));

     //$obj->logEvent("this is cool");

     //$data = array("ShipId" => "678678", "Date" => "March");

     //echo $obj->jsonApiResponse("0", "Success", $data);

     //$obj->debug(json_decode($obj->jsonApiResponse("0", "Success", $data), TRUE));
?>