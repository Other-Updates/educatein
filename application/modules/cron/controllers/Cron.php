<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Cron extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('cron/cron_model');
    }
    
    function expire_plan(){
       $this->cron_model->expire_plan();
       echo 'success!';
    }
}
