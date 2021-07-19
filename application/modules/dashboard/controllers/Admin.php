<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    function __construct() {
        parent::__construct();
        if (!$this->ion_auth->logged_in()) {
            redirect('admin');
        }
        $this->_init();
    }

    private function _init() {
        $this->output->set_template('default');
    }

    public function index() {
        $data = array();
//         $data['schools'] = $this->Base_Model->get_records('grades g ', array("short_name, (SELECT count(*) FROM students s  WHERE s.grade_id = g.id AND s.gender_id=1) AS male, (SELECT count(*) FROM students s  WHERE s.grade_id = g.id AND s.gender_id=0) AS female, (SELECT count(*) FROM students s  WHERE s.grade_id = g.id) AS total  "), '','','g.ord','ASC');
         $data['schools'] = $this->Base_Model->getCount('school_details',array());
         $data['institutes'] = $this->Base_Model->getCount('institute_details',array());
         $data['high_school'] = $this->Base_Model->getCount('school_details',array("schooltype_id" => 2));
         $data['higher_secondary_school'] = $this->Base_Model->getCount('school_details',array("schooltype_id" => 3)); 
         $data['elementary_school'] = $this->Base_Model->getCount('school_details',array("schooltype_id" => 4)); 
         $data['preschool'] = $this->Base_Model->getCount('school_details',array("schooltype_id" => 5)); 
         $data['special_school'] = $this->Base_Model->getCount('school_details',array("schooltype_id" => 6)); 
        $this->load->view('dashboard', $data);
    }

}
