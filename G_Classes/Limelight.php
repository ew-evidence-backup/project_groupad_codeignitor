<?php

     /**
      *    LimeLight API Class
      *
      *
      */
     class LimeLight {

          public $result; // this stores the curl->result for use by the caller (if needed).
          public $rcode; // The API response code. Typically 100 on API success.
          // If rcode is positive > 100 then some kind of API error occured.
          // If rcode < 0 then an unknown failure occured (probably not the API)
          public $rdesc; // The API response code description.

          private $member_url = 'https://www.hbshoppingcart.com/admin/membership.php';
          private $trans_url = 'https://www.hbshoppingcart.com/admin/transact.php';
          private $logObj; // The LogMsg object attached (or null).

          public $cacheTimeout = 600;

          function __construct() {
          }

          function __destruct() {
          }

          /**
           *    Do LimeLight API call
           *
           *    Sets object's $this->result with api call results
           *
           * @param string $method LimeLight API method name
           * @param array $params Parameters to pass to LimeLight API call
           *
           * @return array returns api call results or bool(false) on error
           */
          public function api($method, $params = array(), $useCache = true) {

               Debug::add("LimeLight API Call: <b style=\"color: #fff\">$method</b>");
               $post = $this->init_post($method);
               $post += $params;

               $memcache = Registry::get('memcache');

               $paramHash = md5(serialize($params));
               $cacheKey = "LimeLight:$method:$paramHash";

               Debug::add("API Call cache key = <b>$cacheKey</b>");
               if ($useCache) {
                    $cachedResult = $memcache->get($cacheKey);
                    if (!empty($cachedResult) && $cachedResult['response_code'] == 100) {
                         Debug::add("<b>*Cache Hit*</b> - LimeLight API Call  - returning cached data");
                         //				pre($cachedResult);
                         $this->rcode = $arr['response_code'];
                         $this->rdesc = 'Success';
                         return $cachedResult;
                    }
               }
               unset($this->result);
               $curl = new MHCurl($this->member_url);
               Debug::add("Completed CURL call: {$this->member_url}");
               if ($curl->post($post)) {
                    $this->result = $curl->result;
                    $arr = array();
                    //			Debug::add("LimeLight Response");
                    //			Debug::add($curl->result);
                    parse_str($curl->result, $arr);
                    $responseCodes = explode(",", $arr['response_code']);
                    if (is_array($responseCodes) && $responseCodes[0] == '100') {
                         $this->rcode = $responseCodes[0];
                         $this->rdesc = 'Success';

                         // save results in cache
                         if ($useCache) {
                              //					echo "setting cache $cacheKey<br>";
                              Debug::add("Setting cache $cacheKey");
                              $memcache->set($cacheKey, $arr, $this->cacheTimeout);
                         }
                         Debug::add("SUCCESS - LimeLight API Call");

                         return $arr;
                    }
                    else {
                         $this->rcode = $arr['response_code'];
                         $this->rdesc = 'Failed';
                    }
               }

               Debug::add("Completed LimeLight API Call: $method - FAILED");
               Debug::add($arr);
               return false;
          }

          /* -----------------------------------------------------------------------------------------------------
      Utility function: init_post

      This functions is called at the start of each API method to perform initialzation prior to each call.


      Request Parameters:
          $method_name              Required. The name of the API method being called.

      Return Value: array
          This returns the $post array to be used in all API calls.
      ------------------------------------------------------------------------------------------------------*/
          private function init_post($method_name) {

               $this->result = null;
               $this->rcode = -1;
               $this->rdesc = 'Unexpected, unknown failure in ' . $method_name;
               $post = array();
               $post['username'] = 'www.hbshoppingcart.com';
               $post['password'] = '4Zu6hD9brze44D';
               $post['method'] = $method_name;
               if ($this->logObj != null && $this->logObj->level > 1) {
                    $this->logObj->writeln("LimeLight::init_post($method_name)");
               }
               return $post;
          }


          /* -----------------------------------------------------------------------------------------------------
      API Method: validate_credentials

      The validate_credentials method is used to check our account credentials to ensure they are active.
      ------------------------------------------------------------------------------------------------------*/
          public function validate_credentials() {
               return $this->api('validate_credentials', array(), false);
          }

          /* -----------------------------------------------------------------------------------------------------
      API Method: campaign_find_active

      The campaign_find_active method is used to retrieve an array of all campaign Ids currently active.
      ------------------------------------------------------------------------------------------------------*/
          public function campaign_find_active() {
               return $this->api('campaign_find_active');
          }

          /* -----------------------------------------------------------------------------------------------------
      API Method: campaign_view

      The campaign_view method is designed to return critical data about a campaign, based on the campaign_id
      submitted.
      ------------------------------------------------------------------------------------------------------*/
          public function campaign_view($campaignId) {
               return $this->api('campaign_view', array('campaign_id' => $campaignId));

          }

          /* -----------------------------------------------------------------------------------------------------
      API Method: customer_find_active_product

      The customer_find_active_product method returns the list of active products for a customer as an array.

      If the optional parameter $p_campaign_id is used the list will be narrowed to the valid products for
      that campaign only.  If this is not specified, all valid products are returned for that customer Id,
      regardless of the campaign.

      Request Parameters:
          $p_customer_id          Required.
          $p_campaign_id          Optional.

      Return Value: array
          This returns the list of active products (as an array) for a customer,
          or an empty array if the method fails.
          The array element keys are:
              ['product_ids']
      ------------------------------------------------------------------------------------------------------*/
          public function customer_find_active_product($p_customer_id, $p_campaign_id = null) {

               $post = $this->init_post('customer_find_active_product');
               $post['customer_id'] = $p_customer_id;

               if ($p_campaign_id !== null) {
                    $post['campaign_id'] = $p_campaign_id;
               }

               $curl = new MHCurl($this->member_url, $this->logObj);
               if ($curl->post($post)) {
                    $this->result = $curl->result;
                    parse_str($curl->result, $arr);
                    if (isset($arr['response_code']) && $arr['response_code'] == '100') {
                         $this->rcode = '100';
                         $this->rdesc = 'Success';
                         unset($arr['response_code']);
                         /* Expecting 1 element in the array
                      $arr['product_ids']
                      */
                         return $arr;
                    }
               }
               return array();
          }

          // This returns the recurring pro-rate amount to be refunded.
          //
          /* -----------------------------------------------------------------------------------------------------
      API Method: order_calculate_refund

      The order_calculate_refund method is used to help figure out the pro-rate amount for recurring orders
      to be refunded. The recurring date is based on the main product recurring date.
      The amount is calculated as follows:

          Description                                                       Example
          -------------------------------------------------------------     -----------------------
          time_used     = Number of days used (purchase_date - today)       15 days
          total_time    = Number of total days                              30 days
          total_amount  = Total amount of order (Minus Refunds Already)     $10.00 - $2.00
          refund_amount = (time_used / total_time) * total_amount           (15/30) * $8.00 = $4.00

      Request Parameters:
          $p_order_id             Required.

      Return Value: float
          This returns the recurring pro-rate amount to be refunded
          or false if the method fails.
      ------------------------------------------------------------------------------------------------------*/
          public function order_calculate_refund($p_order_id) {

               $post = $this->init_post('order_calculate_refund');
               $post['order_id'] = $p_order_id;

               $curl = new MHCurl($this->member_url, $this->logObj);
               if ($curl->post($post)) {
                    $this->result = $curl->result;
                    parse_str($curl->result, $arr);
                    if (isset($arr['response_code']) && $arr['response_code'] == '100') {
                         $this->rcode = '100';
                         $this->rdesc = 'Success';
                         unset($arr['response_code']);
                         $this->result = $arr['amount'];
                    }
               }
               return false;
          }

          /* -----------------------------------------------------------------------------------------------------
      API Method: order_find_overdue

      The order_find_overdue method is used to retrieve orders that have been declined.
      The $p_days parameter is the number of days in the history of orders to search within.

      Request Parameters:
          $p_days					Required.

      Return Value: array
          This returns an array of order ids that have been declined.
          If none are found, or the method fails, the array will be empty.
      ------------------------------------------------------------------------------------------------------*/
          public function order_find_overdue($p_days) {

               $post = $this->init_post('order_find_overdue');
               $post['days'] = $p_days;

               $curl = new MHCurl($this->member_url, $this->logObj);
               if ($curl->post($post)) {
                    $this->result = $curl->result;
                    parse_str($curl->result, $arr);
                    if (isset($arr['response_code']) && $arr['response_code'] == '100') {
                         $this->rcode = '100';
                         $this->rdesc = 'Success';
                         unset($arr['response_code']);
                         // Expecting 1 element, ancestor_id
                         if (isset($arr['ancestor_id'])) {
                              return explode(",", $arr['ancestor_id']);
                         }
                    }
               }
               return array();
          }

          /* -----------------------------------------------------------------------------------------------------
      API Method: order_refund

      The order_refund method is used to perform a refund on the given order.

      Request Parameters:
          $p_order_id             Required. The order number.
          $p_amount               Required. The amount to refund.
          $p_keep_recurring       Required. 0 or 1 (Keep recurring active, 0=no, 1=yes).

      Return Value: boolean
          This returns true if the refund succeeded,
          or false if the method fails.
      ------------------------------------------------------------------------------------------------------*/
          public function order_refund($p_order_id, $p_amount, $p_keep_recurring) {

               $post = $this->init_post('order_refund');
               $post['order_id'] = $p_order_id;
               $post['amount'] = $p_amount;
               $post['keep_recurring'] = $p_keep_recurring;

               $curl = new MHCurl($this->member_url, $this->logObj);
               if ($curl->post($post)) {
                    $this->result = $curl->result;
                    $arr = array();
                    parse_str($curl->result, $arr);
                    if (isset($arr['response_code']) && $arr['response_code'] == '100') {
                         $this->rcode = '100';
                         $this->rdesc = 'Success';
                         $this->result = true;
                    }
               }
               return false;
          }

          /* -----------------------------------------------------------------------------------------------------
      API Method: order_void

      The order_void method is used to perform a void on the given order.
      Typically a void must be placed against an order within 24 hours of a transaction.
      Subscriptions will be canceled when a successful void is put in place.

      Request Parameters:
          $p_order_id             Required.

      Return Value: boolean
          This returns true if void succeeded,
          or false if the method fails.
      ------------------------------------------------------------------------------------------------------*/
          public function order_void($p_order_id) {

               $post = $this->init_post('order_void');
               $post['order_id'] = $p_order_id;

               $curl = new MHCurl($this->member_url, $this->logObj);
               $this->result = false;
               if ($curl->post($post)) {
                    $this->result = $curl->result;
                    parse_str($curl->result, $arr);
                    if (isset($arr['response_code']) && $arr['response_code'] == '100') {
                         $this->rcode = '100';
                         $this->rdesc = 'Success';
                         $this->result = true;
                    }
               }
               return false;
          }

          /* -----------------------------------------------------------------------------------------------------
      API Method: order_update_recurring

      The order_update_recurring method is used to update the recurring status of one or more orders.

      $p_order_id & $p_status can be CSV fields, but if used this way, there must be a pairing
      between the order_id and the status code for each order_id.
          Example:  $p_order_id = '500,678,123'
                    $p_status = 'start,start,stop'

      $p_order_id can also be an associative array, where each key is the order_id and it's value is
      the status code to set it to.  In this case, the $p_status can be passed in as a single status
      value to set the status for any order_id with an empty value in the array.
          Example:	$p_order_id = array('500'=>'start','678'=>'start','123'=>'')
                      $p_status = 'stop'

      The status value can be 'start' to process next recurring order and charge the customer;
      'stop' to cancel subscription and prevent future billings; 'reset' to re-activate the original next
      recurring date that was on the order before it got placed on hold.

      Request Parameters:
          $p_order_id             Required. The order number(s) to affect.
          $p_status               Required. The new status code (start | stop | reset).

      Return Value: boolean
          This returns true if succeeded,
          or false if the method fails.
      ------------------------------------------------------------------------------------------------------*/
          public function order_update_recurring($p_order_id, $p_status) {

               $post = $this->init_post('order_update_recurring');

               if (is_array($p_order_id)) {
                    // Turn the array into a CSV field since that's what the API expects.
                    $delim = '';
                    foreach ($p_order_id as $key => $val) {
                         if (strlen($val) > 0) {
                              $post['order_id'] .= $delim . $key;
                              $post['status'] .= $delim . $val;
                         }
                         else {
                              $post['order_id'] .= $delim . $key;
                              $post['status'] .= $delim . $p_status;
                         }
                         $delim = ',';
                    }
               }
               else {
                    $post['order_id'] = $p_order_id;
                    $post['status'] = $p_status;
               }
               $curl = new MHCurl($this->member_url, $this->logObj);
               if ($curl->post($post)) {
                    $this->result = $curl->result;
                    parse_str($curl->result, $arr);
                    if (isset($arr['response_code']) && $arr['response_code'] == '100') {
                         $this->rcode = '100';
                         $this->rdesc = 'Success';
                         return true;
                    }
               }
               return false;
          }

          /* -----------------------------------------------------------------------------------------------------
      API Method: order_find

      The order_find method is an extremely powerful reporting engine to find orders and get a result of
      order Ids that meet your criteria. HTTPS is required for this call.

      Request Parameters:
          $p_campaign_id          Required.
          $p_start_date           Required.
          $p_end_date             Required
          $p_search_type          Requried. Must be 'all' or 'any' to define whether to OR or AND the criteria.
          $op_crit_vals           Required. An array of optional key with values that are use for comparison.
          $op_crit_bools          Required. An array of optional keys whose value must be true or false.

          $op_crit_vals[] -- Criteria Keys that require values
          ---------------------   ---------------------------------------------------------------------------------------------
          start_time              A valid time in the format HH:MM:SS.  From 00:00:00 to 23:59:59
          end_time                A valid time in the format HH:MM:SS.  From 00:00:00 to 23:59:59
          customer_id             Any customer id in limelight
          first_4_cc              Numeric string (Must be exactly 4 characters from beginning of credit card).
          last_4_cc               Numeric string (Must be exactly 4  characters from end of credit card)
          order_total             A non-negative dollar amount (without the dollar sign)
          first_name              Alphanumeric string (Allows wildcard *) (will search both billing and shipping columns)
          last_name               Alphanumeric string (Allows wildcard *) *mi* will find Smith and Bomita
          address                 Alphanumeric string (Allows wildcard *) (will search both billing and shipping columns)
          city                    Alphanumeric string (Allows wildcard *) (will search both billing and shipping columns)
          state                   Alphanumeric string (Allows wildcard *) (will search both billing and shipping columns)
          zip                     Alphanumeric string (Allows wildcard *) (will search both billing and shipping columns)
          country                 ISO 2 digit value*
          phone                   Alphanumeric string (Allows wildcard *)
          email                   Alphanumeric string (Allows wildcard *)
          ip_address              Alphanumeric string (Allows wildcard *)
          transaction_id          Must be an exact transaction_id on order.  No wildcards.
          affiliate_id            Alphanumeric string (Allows wildcard *)
          sub_affiliate_id        Alphanumeric string (Allows wildcard *)
          billing_cycle           0-Infinity. Zero being initial cycle ONLY orders.  1 being first recurring orders etc etc
          tracking_number         Alphanumeric string (Allows wildcard *)

          $op_crit_bools[] -- Criteria Keys whose values are true or false.
          ---------------------   ---------------------------------------------------------------------------------------------
          all                     Will return orders in any state/status.
          declines                Will return orders that have declined.
          success                 Will return orders that have been approved from the payment gateway.
          new                     Will return orders that have been approved from the payment gateway and
                                    have not been shipped or refunded in any way.
          hold                    Will return orders that have been put on hold.
          recurring               Will return orders that have an active subscription tied to it.
          fraud                   Will return orders that have been marked as fraud.
          rma                     Will return orders that have been marked as RMA.
          archived                Will return orders that have been processed successfully on the rebill cycle that
                                    at one point had a subscription that passed through the rebill process.
          chargeback              Will return orders that have been marked as chargeback.
          void                    Will return orders that have been voided.
          shipped                 Will return orders that have been shipped.
          confirmed               Will return orders that have been confirmed.
          not_confirmed           Will return orders that have been marked as non-confirmed.
          no_confirmation_status  Will return orders that have not been marked as confirmed or not. (new)
          no_upsells              Will return orders that do not have upsells.
          has_upsells             Will return orders that have upsells.
          full_refunds            Will return orders that were refunded in FULL.
          partial_refunds         Will return orders that were refunded PARTIALLY
          all_refunds             Will return orders that were refunded both PARTIALLY and in FULL.
          ---------------------   ---------------------------------------------------------------------------------------------

      Return Value: array
          This returns an array of order ids that meet the search criteria.
          If none found, or the method fails, the array will be empty.
      ------------------------------------------------------------------------------------------------------*/
          public function order_find($p_campaign_id, $p_start_date, $p_end_date, $p_search_type, $op_crit_vals, $op_crit_bools) {

               $post = $this->init_post('order_find');
               $post['campaign_id'] = $p_campaign_id; // Can also be 'all'
               $post['start_date'] = $p_start_date;
               $post['end_date'] = $p_end_date;
               $post['search_type'] = $p_search_type; // Must be 'any' or 'all'

               foreach ($op_crit_vals as $k => $v) {
                    $post[$k] = $v;
               }
               $cri = '';
               $delim = '';
               foreach ($op_crit_bools as $k => $v) {
                    if ($v !== 0) {
                         $cri .= $delim . $k;
                    }
                    $delim = ',';
               }
               $post['criteria'] = $cri;

               $curl = new MHCurl($this->member_url, $this->logObj);
               if ($curl->post($post)) {
                    $this->result = $curl->result;
                    echo "cr=" . $curl->result . "\n";
                    parse_str($curl->result, $arr);
                    if (isset($arr['response_code']) && $arr['response_code'] == '100') {
                         $this->rcode = '100';
                         $this->rdesc = 'Success';
                         unset($arr['response_code']);
                         // Expecting 2 elemenst, total_orders & order_ids
                         if (isset($arr['order_ids'])) {
                              return explode(",", $arr['order_ids']);
                         }
                    }
                    if (isset($arr['response_code']) && $arr['response_code'] == '333') {
                         $this->rcode = $arr['response_code'];
                         $this->rdesc = 'No orders found!';
                    }
               }
               return array();
          }

          /* -----------------------------------------------------------------------------------------------------
      API Method: order_update

      The order_update method is currently used to update the confirmation status of an order, but will be
      used to update more values on an order in the future.

      actions must be one of the following text strings:
          cc_number, cc_expiration_date, cc_payment_type, rebill_discount, next_rebill_product,
          confirmation_status, blacklist, fraud, notes, chargeback, first_name, last_name, email,
          phone, shipping_address1, shipping_city, shipping_zip, shipping_state, shipping_country,
          billing_address1, billing_city, billing_zip, billing_state, billing_country.

      Request Parameters:
          $p_order_ids            Required. CSV list of order IDs to update.
          $p_actions              Required. Related CSV list of an action to do for each order.
          $p_values               Required. Related CSV of values to provide for each action.

      Return Value: boolean
          This returns true if the order(s) were updated,
          or false if the method fails.
      ------------------------------------------------------------------------------------------------------*/
          public function order_update($p_order_ids, $p_actions, $p_values) {

               $post = $this->init_post('order_update');
               $post['order_ids'] = $p_order_ids;
               $post['actions'] = $p_actions;
               $post['values'] = $p_values;

               $curl = new MHCurl($this->member_url, $this->logObj);
               if ($curl->post($post)) {
                    $this->result = $curl->result;
                    if ($curl->result == '100') {
                         $this->rcode = '100';
                         $this->rdesc = 'Success';
                         return true;
                    }
               }
               return false;
          }

          /* -----------------------------------------------------------------------------------------------------
      API Method: order_view

      The order_view method is used to retrieve critical information of an order and its associated data.
      The call assembles the parent_order_id and children_ids of any orders that have been created from the order.
      The call also retrieves certain fields depending on whether or not the product is shippable.

      Request Parameters:
          $p_order_id             Required.

      Return Value: array
          This returns the details of an order as an array, or an empty array if the method fails.
          Each key of the array is the order record's fieldname and value.
          The array element keys are (not all will exist):
              ancestor_id , customer_id , parent_id , child_id (CSV) , order_status , is_recurring , first_name
              last_name , shipping_street_address , shipping_city , shipping_state , shipping_postcode , shipping_country
              billing_street_address , billing_city , billing_state , billing_postcode , billing_country
              customers_telephone , time_stamp , recurring_date , cc_type , cc_number , cc_expires
              main_product_id , upsell_product_id (CSV) , shipping_method_name , shipping_id , transaction_id , auth_id
              tracking_number , on_hold , on_hold_by , hold_date , email_address , gateway_id , amount_refunded_to_date
              order_confirmed , order_confirmed_date , is_chargeback , is_fraud , is_rma , rma_number
              rma_reason , ip_address , affiliate , sub_affiliate
              products[0][product_id] , products[1][product_id] , products[2][product_id] , products[...][product_id]
              products[0][sku] , products[1][sku] , products[2][sku] , products[...][sku]
              products[0][price] , products[1][price] , products[2][price] , products[...][price]
              products[0][name] , products[1][name] , products[2][name] , products[...][name]
              products[0][on_hold] , products[1][on_hold] , products[2][on_hold] , products[...][on_hold]
              products[0][is_recurring] , products[1][is_recurring] , products[2][is_recurring] , products[...][is_recurring]
              products[0][recurring_date] , products[1][recurring_date] , products[2][recurring_date] , products[...][recurring_date]
              decline_reason , campaign_id , order_total
      ------------------------------------------------------------------------------------------------------*/
          public function order_view($p_order_id) {

               $post = $this->init_post('order_view');
               $post['order_id'] = $p_order_id;

               $curl = new MHCurl($this->member_url, $this->logObj);
               if ($curl->post($post)) {
                    $this->result = $curl->result;
                    parse_str($curl->result, $arr);
                    if (isset($arr['response_code']) && $arr['response_code'] == '100') {
                         $this->rcode = '100';
                         $this->rdesc = 'Success';
                         unset($arr['response_code']);
                         return $arr;
                    }
               }
               return array();
          }

          /* -----------------------------------------------------------------------------------------------------
      API Method: product_index

      The product_index method is used to retrieve information related to several products.

      Request Parameters:
          $p_product_id           Required. Array of product_id's to retrieve.

      Return Value: array
          This returns an array with an element for each product listed in the $p_product_id array passed in.
          The key to each element is each product_id.

          Each element for a single product itself contains an associative array of each fieldname and
          value.  All will contain the [response_code] element.  If it equals '100' then the other product
          fields will also exist.  If it does not = '100' then only the response_code and product_id fields exist.

          ALWAYS CHECK THE [response_code] FIELD TO MAKE SURE IT IS '100' BEFORE USING THE PRODUCT INFORMATION!!!

          Example: A valid product whose product_id == 320
              [320] => Array (
                  [response_code] => 100
                  [product_id] => 320
                  [product_name] => 2 bottles of Skin Brightener Cream
                  [product_description] => 2 bottles of Skin Brightener Cream by Revitol Skin Care
                  [product_sku] => 516
                  [product_price] => 54.9500
                  [product_category_name] => $29.95 and Odd Staging
                  [product_is_trial] => 0
                  [product_is_shippable] => 1
                  [product_rebill_product] => 0
                  [product_rebill_days] => 0
              )
          Example: An invalid product whose product_id == 127999
              [127999] => Array (
                  [response_code] => 600
                  [product_id] => 127999
              )

          Example use of return value:
              echo $result[$product_id_1]['product_name'];
              echo $result[$product_id_2]['product_price'];
      ------------------------------------------------------------------------------------------------------*/
          public function product_index($p_product_id) {

               Debug::add("LimeLight->product_index()");

               if (is_array($p_product_id)) {
                    $productCsv = implode(",", $p_product_id);
               }
               else {
                    $productCsv = $p_product_id;
               }
               $qty_prods = count($p_product_id);

               Debug::add(array("product_id" => $productCsv));
               $result = $this->api('product_index', array("product_id" => $productCsv));

               if (!empty($result)) {
                    foreach ($result as $field_name => $field_val) {
                         $field_name = urldecode($field_name);
                         $field_val = explode(',', $field_val);
                         if (count($field_val) >= $qty_prods) {
                              for ($j = 0; $j < $qty_prods; $j++) {
                                   if ($field_name == 'response_code') {
                                        $res_arr[$p_product_id[$j]][$field_name] = urldecode($field_val[$j]);
                                        $res_arr[$p_product_id[$j]]['product_id'] = $p_product_id[$j];
                                   }
                                   else {
                                        // The response_code is always first in the result from LimeLight so it should
                                        // exist.  If they change the order of their first field then this will break!
                                        if ($res_arr[$p_product_id[$j]]['response_code'] == '100') {
                                             // Only record product information on valid product results.
                                             $res_arr[$p_product_id[$j]][$field_name] = urldecode($field_val[$j]);
                                        }
                                   }
                              }
                         }
                    }
               }

               // temp hack
               Debug::add("Overriding product data with our product data - start");
               // we need to override/add product data from our own data to fill in missing fields such as quantity
               if (is_array($res_arr)) {
                    foreach ($res_arr as $productId => $product) {
                         $data = ProductLL::getProduct($productId);
                         if (is_array($data)) {
                              $res_arr[$productId] += $data;
                         }
                    }
               }
               Debug::add("Overriding product data with our product data - end");
               Debug::add($res_arr);

               return $res_arr;
          }

          /* -----------------------------------------------------------------------------------------------------
      API Method: product_copy

      The product_copy method is the easiest way to get started taking template products that are existing in
      your offers and slightly tweaking them through the API.  It could be used for such things as creating
      products on the fly for membership upgrades.

      The newly created copied product will reside in the same product category as the copied template.

      You can specify and optional new_name field to use a name of your choice for the newly created product
      based off an existing template.  If not passed, the product name will be "EXISTING_PRODUCT_NAME" (COPY)

      Request Parameters:
          $p_product_id           Required. Must be valid.
          $p_new_name             Optional.

      Return Value: numeric
          This returns the new product_id of the new record created,
          or false if the method fails.
      ------------------------------------------------------------------------------------------------------*/
          public function product_copy($p_product_id, $p_new_name = '') {

               $post = $this->init_post('product_copy');
               $post['product_id'] = $p_product_id;
               $post['new_name'] = $new_name;

               $curl = new MHCurl($this->member_url, $this->logObj);
               if ($curl->post($post)) {
                    $this->result = $curl->result;
                    $arr = array();
                    parse_str($curl->result, $arr);
                    if (isset($arr['response_code']) && $arr['response_code'] == '100') {
                         $this->rcode = '100';
                         $this->rdesc = 'Success';
                         unset($arr['response_code']);
                         // Expecting 1 element, new_product_id
                         return $arr['new_product_id'];
                    }
               }
               return false;
          }

          /* -----------------------------------------------------------------------------------------------------
      API Method: product_update

      The product_update method is currently used to update the information on a product through the API.

      actions must be one of the following text strings:
          product_name, product_price, product_description, product_sku, product_weight ,is_shippable,
          rebill_days, rebill_product, is_free_trial, signature_confirmation, delivery_confirmation,
          digital_delivery_url, digital_delivery, declared_value

      Request Parameters:
          $p_product_ids          Required. CSV list of product IDs to update.
          $p_actions              Required. Related CSV list of an action to do for each product.
          $p_values               Required. Related CSV of values to provide for each product.

      Return Value: boolean
          This returns true if the product(s) were updated,
          or false if the method fails.
      ------------------------------------------------------------------------------------------------------*/
          public function product_update($p_product_ids, $p_actions, $p_values) {

               $post = $this->init_post('product_update');
               $post['product_ids'] = $p_product_ids;
               $post['actions'] = $p_actions;
               $post['values'] = $p_values;

               $curl = new MHCurl($this->member_url, $this->logObj);
               if ($curl->post($post)) {
                    $this->result = $curl->result;
                    if ($curl->result == '100') {
                         $this->rcode = '100';
                         $this->rdesc = 'Success';
                         return true;
                    }
               }
               return false;
          }

          /* -----------------------------------------------------------------------------------------------------
      API Method: upsell_stop_recurring

      The upsell_stop_recurring method is used to stop upsells from recurring.

      Request Parameters:
          $p_order_id             Required. The order number.
          $p_product_id           Required. The product id.

      Return Value: boolean
          This returns true if the method succeeded,
          or false if the method fails.
      ------------------------------------------------------------------------------------------------------*/
          public function upsell_stop_recurring($p_order_id, $p_product_id) {

               $post = $this->init_post('upsell_stop_recurring');
               $post['order_id'] = $p_order_id;
               $post['product_id'] = $p_product_id;

               $curl = new MHCurl($this->member_url, $this->logObj);
               if ($curl->post($post)) {
                    $this->result = $curl->result;
                    $arr = array();
                    parse_str($curl->result, $arr);
                    if (isset($arr['response_code']) && $arr['response_code'] == '100') {
                         $this->rcode = '100';
                         $this->rdesc = 'Success';
                         return true;
                    }
               }
               return false;
          }

          /* -----------------------------------------------------------------------------------------------------
      API Method: NewProspect

      The NewProspect method will submit a new prospect record to Lime Light and return a result array.

      The $p_fields array should have the following elements:
          campaignId, firstName, lastName, address1, city, state, zip, country, phone, email,
          AFID, SID, AFFID, C1, C2, C3, AID, OPT, notes, ipAddress

      Request Parameters:
          $p_fields               Required. The array of field names and their values.

      Return Value: boolean
          This returns true if the method succeeded, or false it it failed.

          On return, the caller must use this object->result property to extract other
          meaningful information about the result. Result is an array.
          Possible elements in the result array are:
              errorFound     1 digit 0 or 1.  If 1, then errorMessage will be posted.
              errorMessage   255 Characters Max Optional, only posted if errorFound is 1
              responseCode   5 Digits Max Tells response of transaction. See appendix A for complete list
              prospectId     100 Characters Max Optional, only posted if responseCode is 100
              declineReason  255 Characters Max Optional, only posted if responseCode is 500.
                                Text string stating decline reason, comes from the gateway.

            Example usage of return value:
            if( isset($xx->result['prospectId']) && $xx->result['prospectId'] != '')
                    $prospect_id = $xx->result['prospectId'];

      ------------------------------------------------------------------------------------------------------*/
          public function NewProspect($p_fields) {

               $post = $this->init_post('NewProspect');
               $post = array_merge($post, $p_fields);

               setlocale(LC_CTYPE, 'en_US.utf8');
               $post['firstName'] = self::convertText($post['firstName']);
               $post['lastName'] = self::convertText($post['lastName']);
               $post['email'] = self::convertText($post['email']);
               $post['address1'] = self::convertText($post['address1']);
               $post['city'] = self::convertText($post['city']);
               $post['state'] = self::convertText($post['state']);
               $post['country'] = self::convertText($post['country']);

               $curl = new MHCurl($this->trans_url, $this->logObj);
               if ($curl->post($post)) {
                    parse_str($curl->result, $arr);
                    $this->result = $arr;
                    if (isset($arr['errorFound']) && $arr['errorFound'] != '0') {
                         if (isset($arr['errorMessage']) && $arr['errorMessage'] != '') {
                              $this->rdesc = $arr['errorMessage'];
                         }
                         else {
                              if (isset($arr['declineReason']) && $arr['declineReason'] != '') {
                                   $this->rdesc = $arr['declineReason'];
                              }
                         }
                         if (isset($arr['responseCode'])) {
                              $this->rcode = $arr['responseCode'];
                         }
                         return false;
                    }
                    if (isset($arr['responseCode']) && $arr['responseCode'] == '100') {
                         $this->rcode = '100';
                         $this->rdesc = 'Success';
                         return true;
                    }
                    if (isset($arr['responseCode']) && $arr['responseCode'] != '') {
                         $this->rcode = $arr['responseCode'];
                         return true;
                    }
               }
               return false;
          }

          /* -----------------------------------------------------------------------------------------------------
      API Method: NewOrderWithProspect

      The NewOrderWithProspect must be used in conjunction with the NewProspect call.  NewProspect will return
      a prospectId of which you must pass as "prospectId" on this call as well.  The logic flow is similar to
      that of a two-step campaign.

      Please note that it is recommended to send a complete record with all available fields to pass upon
      initially sending the prospect through the NewProspect call to reduce confusion of what fields are
      required during the sale.  An example would be if you don't pass IPAddress through the prospect record
      and don't prompt or require IPAddress during the NewOrderWithProspect.  Lime Light systems will reject
      that because there is a blank value on the IPAddress.

      The $p_fields array should have the following elements:
          prospectId, upsellCount, upsellProductIds, productId, campaignId, shippingId, creditCardType,
          creditCardNumber, expirationDate, CW, tranType, billingSameAsShipping

      Request Parameters:
          $p_fields               Required. The array of field names and their values.

      Return Value: boolean
          This returns true if the method succeeded, or false it it failed.

          On return, the caller must use this object->result property to extract other
          meaningful information about the result. Result is an array.
          Possible elements in the result array are:
              errorFound     1 digit 0 or 1.  If 1, then errorMessage will be posted.
              errorMessage   255 Characters Max Optional, only posted if errorFound is 1
              responseCode   5 Digits Max Tells response of transaction. See appendix A for complete list
              transactionId  100 Characters Max Optional, only posted if responseCode is 100
              authId         100 Characters Max Optional, only posted if responseCode is 100
              orderId        Integer Lime Light order Id for the order that was just created.
              orderTotal     25 Characters Max Optional, only posted if responseCode is 100
              customerId     Integer Optional, only posted if responseCode is 100
              declineReason  255 Characters Max Optional, only posted if responseCode is 500.
                                Text string stating decline reason, comes from the gateway.

              A good response (with test credit card) looks like this:
                  [errorFound] = 0
                  [responseCode] = 100
                  [transactionID] = UsaEpayTransNumber
                  [customerId] = 7
                  [authId] = UsaEpayAuth
                  [orderId] = 10000068
                  [orderTotal] = 5.97


      ------------------------------------------------------------------------------------------------------*/
          public function NewOrderWithProspect($p_fields) {

               $post = $this->init_post('NewOrderWithProspect');
               $post = array_merge($post, $p_fields);

               setlocale(LC_CTYPE, 'en_US.utf8');
               $post['firstName'] = self::convertText($post['firstName']);
               $post['lastName'] = self::convertText($post['lastName']);
               $post['email'] = self::convertText($post['email']);
               $post['shippingAddress1'] = self::convertText($post['shippingAddress1']);
               $post['shippingCity'] = self::convertText($post['shippingCity']);
               $post['shippingState'] = self::convertText($post['shippingState']);
               $post['shippingCountry'] = self::convertText($post['shippingCountry']);
               $post['billingAddress1'] = self::convertText($post['billingAddress1']);
               $post['billingCity'] = self::convertText($post['billingCity']);
               $post['billingState'] = self::convertText($post['billingState']);
               $post['billingZip'] = self::convertText($post['billingZip']);
               $post['billingCountry'] = self::convertText($post['billingCountry']);

               $curl = new MHCurl($this->trans_url, $this->logObj);
               if ($curl->post($post)) {
                    parse_str($curl->result, $arr);
                    $this->result = $arr;
                    if (isset($arr['errorFound']) && $arr['errorFound'] != '0') {
                         if (isset($arr['errorMessage']) && $arr['errorMessage'] != '') {
                              $this->rdesc = $arr['errorMessage'];
                         }
                         else {
                              if (isset($arr['declineReason']) && $arr['declineReason'] != '') {
                                   $this->rdesc = $arr['declineReason'];
                              }
                         }
                         if (isset($arr['responseCode'])) {
                              $this->rcode = $arr['responseCode'];
                         }
                         return false;
                    }
                    if (isset($arr['responseCode']) && $arr['responseCode'] == '100') {
                         $this->rcode = '100';
                         $this->rdesc = 'Success';
                         return true;
                    }
                    if (isset($arr['responseCode']) && $arr['responseCode'] != '') {
                         $this->rcode = $arr['responseCode'];
                         return true;
                    }
               }
               return false;
          }

          /* -----------------------------------------------------------------------------------------------------
      API Method: NewOrderCardOnFile

      The NewOrderCardOnFile method supports all the existing parameters of the NewOrder method, but simplifies
      the process so you can pass an existing order_id under the previousOrderId parameter, so you don't have
      to pass existing information under the customer associated with that order.

      The $p_fields array should have the following elements:
          previousOrderId, productId, campaignId, shippingId

      Request Parameters:
          $p_fields               Required. The array of field names and their values.

      Return Value: boolean
          This returns true if the method succeeded, or false it it failed.

          On return, the caller must use this object->result property to extract other
          meaningful information about the result. Result is an array.
          Possible elements in the result array are:
              errorFound     1 digit 0 or 1.  If 1, then errorMessage will be posted.
              errorMessage   255 Characters Max Optional, only posted if errorFound is 1
              responseCode   5 Digits Max Tells response of transaction. See appendix A for complete list
              transactionId  100 Characters Max Optional, only posted if responseCode is 100
              authId         100 Characters Max Optional, only posted if responseCode is 100
              orderId        Integer Lime Light order Id for the order that was just created.
              orderTotal     25 Characters Max Optional, only posted if responseCode is 100
              customerId     Integer Optional, only posted if responseCode is 100
              declineReason  255 Characters Max Optional, only posted if responseCode is 500.
                                Text string stating decline reason, comes from the gateway.

              A good response (with test credit card) looks like this:
                  [errorFound] = 0
                  [responseCode] = 100
                  [transactionID] = UsaEpayTransNumber
                  [customerId] = 7
                  [authId] = UsaEpayAuth
                  [orderId] = 10000068
                  [orderTotal] = 5.97

      ------------------------------------------------------------------------------------------------------*/
          public function NewOrderCardOnFile($p_fields) {

               $post = $this->init_post('NewOrderCardOnFile');
               $post = array_merge($post, $p_fields);

               $curl = new MHCurl($this->trans_url, $this->logObj);
               if ($curl->post($post)) {
                    parse_str($curl->result, $arr);
                    $this->result = $arr;
                    if (isset($arr['errorFound']) && $arr['errorFound'] != '0') {
                         if (isset($arr['errorMessage']) && $arr['errorMessage'] != '') {
                              $this->rdesc = $arr['errorMessage'];
                         }
                         else {
                              if (isset($arr['declineReason']) && $arr['declineReason'] != '') {
                                   $this->rdesc = $arr['declineReason'];
                              }
                         }
                         if (isset($arr['responseCode'])) {
                              $this->rcode = $arr['responseCode'];
                         }
                         return false;
                    }
                    if (isset($arr['responseCode']) && $arr['responseCode'] == '100') {
                         $this->rcode = '100';
                         $this->rdesc = 'Success';
                         return true;
                    }
                    if (isset($arr['responseCode']) && $arr['responseCode'] != '') {
                         $this->rcode = $arr['responseCode'];
                         return true;
                    }
               }
               return false;
          }

          /* -----------------------------------------------------------------------------------------------------
      API Method: NewOrder

      The NewOrder method adds a new order.

      The $p_fields array should have the following elements:
          firstName, lastName, shippingAddress1, shippingCity, shippingState, shippingZip, shippingCountry,
          billingAddress1, billingCity, billingState, billingZip, billingCountry,
          phone, email, creditCardType, creditCardNumber, expirationDate, CW,
          checkAccount, checkRouting, tranType, ipAddress, AFID, SID, AFFID, C1, C2, C3, AID, OPT,
          productId, campaignId, shippingId, upsellCount, upsellProductIds,
          prospectId, billingSameAsShipping, initializeNewSubscription, previousOrderId, notes,
          dynamic_product_price_XX (where XX = he product id)

          The dynamic_product_price_XX can be duplicated for multiple products.

      Request Parameters:
          $p_fields               Required. The array of field names and their values.

      Return Value: boolean
          This returns true if the method succeeded, or false it it failed.

          On return, the caller must use this object->result property to extract other
          meaningful information about the result. Result is an array.
          Possible elements in the result array are:
              errorFound     1 digit 0 or 1.  If 1, then errorMessage will be posted.
              errorMessage   255 Characters Max Optional, only posted if errorFound is 1
              responseCode   5 Digits Max Tells response of transaction. See appendix A for complete list
              transactionId  100 Characters Max Optional, only posted if responseCode is 100
              authId         100 Characters Max Optional, only posted if responseCode is 100
              orderId        Integer Lime Light order Id for the order that was just created.
              orderTotal     25 Characters Max Optional, only posted if responseCode is 100
              customerId     Integer Optional, only posted if responseCode is 100
              declineReason  255 Characters Max Optional, only posted if responseCode is 500.
                                Text string stating decline reason, comes from the gateway.

              A good response (with test credit card) looks like this:
                  [errorFound] = 0
                  [responseCode] = 100
                  [transactionID] = UsaEpayTransNumber
                  [customerId] = 7
                  [authId] = UsaEpayAuth
                  [orderId] = 10000068
                  [orderTotal] = 5.97


      ------------------------------------------------------------------------------------------------------*/
          public function NewOrder($p_fields) {

               $post = $this->init_post('NewOrder');
               $post = array_merge($post, $p_fields);
               $curl = new MHCurl($this->trans_url, $this->logObj);
               if ($curl->post($post)) {
                    parse_str($curl->result, $arr);
                    $this->result = $arr;
                    if (isset($arr['errorFound']) && $arr['errorFound'] != '0') {
                         if (isset($arr['errorMessage']) && $arr['errorMessage'] != '') {
                              $this->rdesc = $arr['errorMessage'];
                         }
                         else {
                              if (isset($arr['declineReason']) && $arr['declineReason'] != '') {
                                   $this->rdesc = $arr['declineReason'];
                              }
                         }
                         if (isset($arr['responseCode'])) {
                              $this->rcode = $arr['responseCode'];
                         }
                         return false;
                    }
                    if (isset($arr['responseCode']) && $arr['responseCode'] == '100') {
                         $this->rcode = '100';
                         $this->rdesc = 'Success';
                         return true;
                    }
                    if (isset($arr['responseCode']) && $arr['responseCode'] != '') {
                         $this->rcode = $arr['responseCode'];
                         return true;
                    }
               }
               return false;
          }

          public static function getCreditCardType($cardName) {
               if ($cardName == 'MasterCard') {
                    return 'master';
               }
               else {
                    if ($cardName == 'Visa') {
                         return 'visa';
                    }
                    else {
                         if ($cardName == 'Discover') {
                              return 'discover';
                         }
                         else {
                              if ($cardName == 'American Express') {
                                   return 'amex';
                              }
                              else {
                                   if ($cardName == 'Maestro') {
                                        return 'master';
                                   }
                                   else {
                                        if ($cardName == 'Visa Electron') {
                                             return 'visa';
                                        }
                                        else {
                                             if ($cardName == 'JCB') {
                                                  return 'discover';
                                             }
                                             else {
                                                  if ($cardName == 'Solo') {
                                                       return 'master';
                                                  }
                                                  else {
                                                       if ($cardName == 'Diners Club') {
                                                            return 'discover';
                                                       }
                                                       else {
                                                            if ($cardName == 'Switch') {
                                                                 return 'master';
                                                            }
                                                            else {
                                                                 return 'master';
                                                            }
                                                       }
                                                  }
                                             }
                                        }
                                   }
                              }
                         }
                    }
               }

               return false;

          }

          public static function convertText($str) {
               $unwanted_array = array('°' => 'o', 'º' => 'o', 'Š' => 'S', 'š' => 's', 'Ž' => 'Z', 'ž' => 'z', 'À' => 'A', 'Á' => 'A', 'Â' => 'A', 'Ã' => 'A', 'Ä' => 'A', 'Å' => 'A', 'Æ' => 'A', 'Ç' => 'C', 'È' => 'E', 'É' => 'E',
                    'Ê' => 'E', 'Ë' => 'E', 'Ì' => 'I', 'Í' => 'I', 'Î' => 'I', 'Ï' => 'I', 'Ñ' => 'N', 'Ò' => 'O', 'Ó' => 'O', 'Ô' => 'O', 'Õ' => 'O', 'Ö' => 'O', 'Ø' => 'O', 'Ù' => 'U',
                    'Ú' => 'U', 'Û' => 'U', 'Ü' => 'U', 'Ý' => 'Y', 'Þ' => 'B', 'ß' => 'Ss', 'à' => 'a', 'á' => 'a', 'â' => 'a', 'ã' => 'a', 'ä' => 'a', 'å' => 'a', 'æ' => 'a', 'ç' => 'c',
                    'è' => 'e', 'é' => 'e', 'ê' => 'e', 'ë' => 'e', 'ì' => 'i', 'í' => 'i', 'î' => 'i', 'ï' => 'i', 'ð' => 'o', 'ñ' => 'n', 'ò' => 'o', 'ó' => 'o', 'ô' => 'o', 'õ' => 'o',
                    'ö' => 'o', 'ø' => 'o', 'ù' => 'u', 'ú' => 'u', 'û' => 'u', 'ý' => 'y', 'ý' => 'y', 'þ' => 'b', 'ÿ' => 'y');
               $str = strtr($str, $unwanted_array);

               # Quotes cleanup
               $str = str_replace(chr(ord("`")), "'", $str); # `
               $str = str_replace(chr(ord("´")), "'", $str); # ´
               $str = str_replace(chr(ord("„")), ",", $str); # „
               $str = str_replace(chr(ord("`")), "'", $str); # `
               $str = str_replace(chr(ord("´")), "'", $str); # ´
               $str = str_replace(chr(ord("“")), '"', $str); # “
               $str = str_replace(chr(ord("”")), '"', $str); # ”
               $str = str_replace(chr(ord("´")), "'", $str); # ´

               # Bullets, dashes, and trademarks
               $str = str_replace(chr(149), " ", $str); # bullet •
               $str = str_replace(chr(150), " ", $str); # en dash
               $str = str_replace(chr(151), " ", $str); # em dash
               $str = str_replace(chr(153), " ", $str); # trademark
               $str = str_replace(chr(169), " ", $str); # copyright mark
               $str = str_replace(chr(174), " ", $str); # registration mark

               return $str;
          }
     }
