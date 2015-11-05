<?php
     /**
      *    Has Offers API Object
      *    Author: Evin Weissenberg
      *    http://www.hasoffers.com/wiki/API:Authentication_(Api)
      **/
     //include('GSR.php');
     class HasOffers {

          public static $apiBaseUrl = "https://api.hasoffers.com/Api?";

          public static function api($target, $method, $params = array()) {
               $params['Format'] = 'json';
               $params['Target'] = $target;
               $params['Method'] = $method;
               $params['Service'] = 'HasOffers';
               $params['Version'] = 2;
               $params['NetworkId'] = 'socialreality';
               $params['NetworkToken'] = 'NETcmGvNImPj0QgrR42dpc3x7JeUgJ';
               $url = self::$apiBaseUrl . http_build_query($params);
               $resultJson = file_get_contents($url);
               $result = json_decode($resultJson, TRUE);
               return $result;
          }

          function offersFindAll() {
               $request = self::api("Offer", "findAll");
               return $request;
          }

          function offersCreate($name,$expiration_date,$preview_url,$offer_url,$description,$protocol,$status,$advertiser_id) {
               $p['name'] = "$name";
               $p['preview_url'] = $preview_url;
               $p['offer_url'] = $offer_url;
               $p['expiration_date'] = $expiration_date;
               $p['description'] = $description;
               $p['protocol'] = $protocol;
               $p['status'] = $status;
               $p['advertiser_id'] = $advertiser_id;
               $request = self::api("Offer", "create", $p);
               return $request;
          }

          function offersFindById($id) {
               $p['id'] = $id;
               $request = self::api("Offer", "findById", $p);
               return $request;
          }

          function offerFindAffiliateSettings() {

          }

          function offerGetPixelLink($offer_id) {
               $p['id'] = $offer_id;
               $request = self::api("Offer", "getPixels", $p);
               return $request;
          }

          function affiliateStatus($id, $affiliate_id, $status, $notes) {
               $p['id'] = $id;
               $p['affiliate_id'] = $affiliate_id;
               $p['status'] = $status; // approved, pending, rejected
               $p['notes'] = $notes;
               $request = self::api("Offer", "setAffiliateApproval ", $p);
               return $request;
          }

          function affiliateBlock() {

          }

     }




?>