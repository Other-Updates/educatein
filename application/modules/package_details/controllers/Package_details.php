<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Package_details extends CI_Controller {
    
      public function __construct()
    {
        parent::__construct();
//        $this->load->library("session");
//        $this->load->helper('url');
        // if(!$this->session->userdata('school'))
        // redirect(base_url());
        

    }

    public function index() {   
      if (empty($this->session->userdata('user_id'))) {
        $this->session->unset_userdata('school_logged_in');
        redirect(base_url());
    }else{        
      $this->load->view('package-details');
    }
  }

}

?>