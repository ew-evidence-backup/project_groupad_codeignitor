<?
     /**
      * GLOBAL SYSTEM MODEL OBJECT
      * Author: Evin Weissenberg
      * Email: ecw.technology@gmail.com
      */
     class GSM {
          //Database Connection Credentials
          public static $host = "localhost";
          public static $username = "groupad_root";
          public static $password = "S~nD?[H6zGUU";
          public static $databaseName = "groupad_system";

          function __construct() {

          }

          public static function dbConnection() {
               mysql_connect(self::$host, self::$username, self::$password) or die(mysql_error());
               mysql_select_db(self::$databaseName) or die(mysql_error());
               return TRUE;
          }

          function dbQuery($query) {
               self::dbConnection();
               $q = "$query";
               $r = mysql_query($q);
               $d = mysql_fetch_assoc($r);
               return $d;
          }

          function dbQueryLoop($query) {
               self::dbConnection();
               $data = array();
               $q = "$query";
               $result = mysql_query($q);
               while ($clientShippingLogData = mysql_fetch_assoc($result)) {
                    array_push($data, $clientShippingLogData);
               }
               return $data;
          }

          function dbUpdateQuery($t, $k, $old_value, $new_value) {
               self::dbConnection();
               $run = mysql_query("UPDATE $t SET $k='$old_value' WHERE $k='$new_value'");
               return $run;
          }

          function dbQueryInsert($t, $k = array(), $v = array()) {
               self::dbConnection();
               $key_explode = implode(",", $k);
               $value_explode = implode(",", $v);
               $run = mysql_query("INSERT INTO $t ($key_explode) VALUES ($value_explode)");
               return $run;
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