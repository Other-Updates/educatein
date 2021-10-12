<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Cron_model extends CI_Model {

    function __construct() {

        parent::__construct();
    }

    function expire_plan(){
        $data = array(
            'expiry_status' => 1,
            'status' =>  NULL,
        );
        $this->db->select('*');
        $this->db->from('school_details');
        $school = $this->db->get()->result_array();
        foreach($school as $schools){
            $date = date('Y-m-d');
            $this->db->where('expiry_date<',$date);
            $this->db->update('school_details',$data,array('id'=>$schools['id']));
        }
        $this->db->select('*');
        $this->db->from('institute_details');
        $class = $this->db->get()->result_array();
        foreach($class as $classes){
            $date = date('Y-m-d');
            $this->db->where('expiry_date<',$date);
            $this->db->update('institute_details',$data,array('id'=>$classes['id']));
        }
    }
}