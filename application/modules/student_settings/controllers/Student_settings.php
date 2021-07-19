<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Student_settings extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->output->set_template('simple');
        $this->_init();
    }

    private function _init() {
        $this->load->css('assets/front/css/owl.carousel.min.css');
        $this->load->css('assets/front/fancybox/css/jquery.fancybox.min.css');
        $this->load->js('assets/front/js/owl.carousel.min.js');
        $this->load->js('assets/front/js/wow.min.js');
        $this->load->js('assets/front/js/jquery.stickit.js');
    }

    public function index() {
        
         $data="";
        if (isset($_GET['id'])) {
            $userid = base64_decode($_GET['id']);
            $this->db->select('*');
            $this->db->from('student_register');
            $this->db->where("id", $userid);
            $user = $this->db->get()->row();
           
            $data["username"] = $user->firstname;          
        }
        $this->load->view('student-settings',$data);
    }
    
    
    
    public function update()
	{ 

        // echo "test";
        // exit();
        $data = array(
			'lastname' => $this->input->post('lastname'),
            'city' => $this->input->post('city'),
            'area' => $this->input->post('area'),
            'schoolname' => $this->input->post('schoolname'),
            'grade' => $this->input->post('grade'),
            'pincode' => $this->input->post('pincode'),
            );

            $profile = $_FILES['image']['name'];
            $profile_ext = pathinfo($profile, PATHINFO_EXTENSION);
            // echo $banner1_ext;
            // exit();
            $profile_name = rand(10000,10000000).".".$profile_ext;
            $profile_type = $_FILES['image']['type'];
            $profile_size = $_FILES['image']['size'];
            $profile_tem_loc = $_FILES['image']['tmp_name'];
            $profile_store = $_SERVER['DOCUMENT_ROOT']."/images/students/".$profile_name;
           
            $allowed = array('gif','png','jpg','jpeg','GIF','PNG','JPG','JPEG');
           
           
           if(in_array($profile_ext,$allowed))
           {
           
            if(move_uploaded_file($profile_tem_loc,$profile_store))
            {
               $data['image'] = $profile_name;    
           
            }
           }


            $data['email'] = $this->input->post('useremail');
// echo  $data['email'];
// exit();

            $this->db->where('email =', $data['email']);
            $this->db->update('student_register', $data);

            $this->db->select('*');
            $this->db->from('student_register');
            $this->db->where('email =', $data['email']);
            $check = $this->db->get()->result();

            foreach($check as $checks){

                $data['id'] = $checks->id;
                $data['firstname'] = $checks->firstname;
                $data['lastname'] = $checks->lastname;
                $data['email'] = $checks->email;
                $data['phone'] = $checks->phone;
                $data['grade'] = $checks->grade;
                $data['board'] = $checks->board;
                $data['schoolname'] = $checks->schoolname;
                $data['area'] = $checks->area;
                $data['city'] = $checks->city;
                $data['pincode'] = $checks->pincode;
                $data['image'] = $checks->image;
            }
            $data['category'] = "student"; 
		$this->load->view('student-settings',$data);
		
    }
	

}
