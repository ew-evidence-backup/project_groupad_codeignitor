<?php if (!defined('BASEPATH')) {
     exit('No direct script access allowed');
}

     class main extends CI_Controller {

          /**
           * Index Page for this controller.
           *
           * Maps to the following URL
           *         http://example.com/index.php/welcome
           *    - or -
           *         http://example.com/index.php/welcome/index
           *    - or -
           * Since this controller is set as the default controller in
           * config/routes.php, it's displayed at http://example.com/
           *
           * So any other public methods not prefixed with an underscore will
           * map to /index.php/welcome/<method_name>
           * @see http://codeigniter.com/user_guide/general/urls.html
           */
          public function index() {
               //Caching
               //$this->output->cache(1);
               $this->load->helper('url');
               //echo site_url("test");
               $this->load->view('main_view');
          }

          public function aboutUs() {
               $this->load->view('about_us_view');
          }
     }

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */