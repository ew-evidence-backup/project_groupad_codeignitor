<?
     /*
     * CAMPAIGNS
     * Author Evin Weissenberg
      * Notes: A campaign in GroupAd System is an offer in hasoffers.com
      * A Advertiser is an affiliate in hasoffers.com
     */
     include('GSR.php');
     include('Hasoffers.php');
     class Campaigns extends GSR {
          //Campaign Properties
          private $campaign_name;
          private $campaign_driver;
          private $campaign_advertiser_id;
          private $campaign_type;
          private $campaign_expiration_date;
          private $campaign_pixel_link;
          //Facebook Properties
          private $facebook_ad_type;
          private $facebook_account;
          private $facebook_secret;
          private $facebook_key;
          //Twitter Properties
          private $twitter_ad_type;
          //Banner Properties
          private $banner_ad_type;
          //Link Properties
          private $link_ad_type;
          //LinkedIn Properties
          private $linkedIn_ad_type;

          function __construct() { }

          function campaignCreate($params) {
               //Create Offer in hasoffers.com & Return Data Object to create GroupAd campaign
               $ho = new HasOffers();
               $returned_object = $ho->offersCreate($params['offer_name'], $params['exp_date'], $params['preview_url'],
                    $params['offer_url'], $params['description'], $params['protocol'], $params['status'], $params['advertiser_id']);
               $this->debug($returned_object);
               //Get impression link
               //Get conversion pixel link from hasoffers

               if ($campaign_type = "FB") {
                    //$this->campaignInitFacebook($returned_object['']);
               }
               if ($campaign_type = "TT") {
                    $this->campaignInitTwitter("");
               }
               if ($campaign_type = "BN") {
                    $this->campaignInitBannerAd("");
               }
               if ($campaign_type = "LK") {
                    $this->campaignInitLinkAd("");
               }
               if ($campaign_type = "LI") {
                    $this->campaignInitLinkedInAd("");
               }
               if ($campaign_type = "combo") {
                    $this->campaignInitCombo("");
               }
          }

          function campaignInitFacebook($ho_campaign_id) {
               //Create Campaign in GroupAd System
          }

          function campaignInitTwitter() { }

          function campaignInitBannerAd() { }

          function campaignInitLinkAd() { }

          function campaignInitLinkedInAd() { }

          function campaignInitCombo() { }

          function charities() { }

          function couponPromoCodes() { }

          function couponStandard() { }

          function unLockOffer() { }

          function contestWatchAd() { }

          function contestUserInviteIncreaseChancesToWin() { }

     }

?>