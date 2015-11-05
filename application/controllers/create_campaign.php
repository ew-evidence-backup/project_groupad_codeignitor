<?

     /*
      * Create Campaign
      * Author Evin Weissenberg
      */
     include('G_Classes/Campaigns.php');

     class Create_campaign extends CI_Controller {

          public function index() {
               //Caching
               //$this->output->cache(1);
               $camp = new Campaigns();
               $camp->debug($_REQUEST);
               if($_SERVER['REQUEST_METHOD'] == "POST"){
                    $p['offer_name'] = $_REQUEST['offer_name'];
                    $p['exp_date'] = $_REQUEST['exp_date'];
                    $p['preview_url'] = $_REQUEST['preview_url'];
                    $p['offer_url'] = $_REQUEST['offer_url'];
                    $p['description'] = $_REQUEST['description'];
                    $p['protocol'] = $_REQUEST['protocol'];
                    $p['status'] = $_REQUEST['status'];
                    $p['advertiser_id'] = $_REQUEST['advertiser_id'];
                    $camp->campaignCreate($p);
               }
               $this->load->view('create_campaign_view.php');
          }

     }

?>