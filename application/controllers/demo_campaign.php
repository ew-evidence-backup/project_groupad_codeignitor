<?php if (!defined('BASEPATH')) {
     exit('No direct script access allowed');
}

     class Demo_campaign extends CI_Controller {

          public function index() {
               //Caching
               //$this->output->cache(1);
               $this->load->view('demo_campaign_view.php');
          }

          public function conversion() {
               $this->load->view('demo_campaign_view_convert.php');
          }
     }

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */