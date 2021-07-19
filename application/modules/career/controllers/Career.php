<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Career extends CI_Controller { 
    function __construct() {
        parent::__construct();
        $this->output->set_template('simple');
        $this->_init();
    }

    private function _init() {
        $this->load->js('assets/front/js/wow.min.js');
        $this->load->js('assets/front/js/owl.carousel.min.js');
    }

    public function index() {
        
        $this->load->view('careers');

        // $this->load->library('pagination');	
        //       $this->db->select('*');
        //       $this->db->from('blogs');
        //       $blog = $this->db->get();
        //       $total_rows = $blog_comment->num_rows();
        // $config['total_rows'] = $total_rows;
        // $config['per_page'] = 5;
        // $config['base_url'] = base_url('blog/index');
    }
 
}
?>