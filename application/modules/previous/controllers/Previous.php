<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Previous extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->output->set_template('simple');
        $this->_init();
    }

    private function _init() {
        $this->load->css('assets/front/fancybox/css/jquery.fancybox.min.css');
        $this->load->js('assets/front/js/wow.min.js');
        $this->load->js('assets/front/fancybox/js/jquery.fancybox.min.js');
    }

    public function index() {
        $data = "";
         if (isset($_GET['id'])) {
            $userid = base64_decode($_GET['id']);
            $this->db->select('*');
            $this->db->from('student_register');
            $this->db->where("id", $userid);
            $user = $this->db->get()->row();
           
            $data["username"] = $user->firstname;          
        }
        $this->load->view('previous',$data);
    }

}

?>