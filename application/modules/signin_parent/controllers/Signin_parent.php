<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Signin_parent extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('url');
        // $this->load->model('users_model');
        $this->output->set_template('simple');
        $this->_init();
    }

    private function _init() {
        
    }

    public function index() {
        $this->load->view('signin-parent');
    }

    public function check() {
        //load session library
        $this->load->library('session');
        $data = array(
            'email' => $this->input->post('signemail'),
            'password' => base64_encode($this->input->post('signpassword')),
        );
        $mail = $data['email'];
        $password = $data['password'];

        $this->db->select('*');
        $this->db->from('student_register');
        $this->db->where('email =', $mail);
        $this->db->where('password =', $password);
        $this->db->where('category =', 'parent');
        $check = $this->db->get()->result();

        if (count($check) == 0) {
            $this->load->view('signin-parent');
            ?>
            <script type="text/javascript">
                alert("Your Username or Password Is Incorrect...!");
            </script>

            <?php

        } else {
            foreach ($check as $checks) {
                $data['id'] = $checks->id;
                $data['firstname'] = $checks->firstname;
                $data['username'] = $checks->firstname;
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
                $data['category'] = $checks->category;
            }

            $this->session->set_userdata('user', $data);

            $this->load->view('student-settings', $data);
        }
    }

    public function syllabus() {
        //load session library
        $this->load->library('session');

        //restrict users to go to home if not logged in
        if ($this->session->userdata('user')) {
            $this->load->view('syllabus');
        } else {
            redirect('/');
        }
    }

}
?>
