<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Privacy extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->output->set_template('simple');
    }

    function index(){
        $this->load->view('privacy');
    }
}