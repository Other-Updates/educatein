<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Signin_student extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->output->set_template('simple');
        $this->_init();
    }

    private function _init() {
//        $this->load->css('assets/front/css/bootstrap.min.css');
//        $this->load->css('assets/front/css/styles.css');
//        $this->load->css('assets/front/css/responsive.css');
//        $this->load->css('assets/front/css/font-awesome.css');
//        $this->load->css('assets/front/fonts/icon-font/style.css');
//        $this->load->css('assets/front/css/animate.css');
//        $this->load->css('assets/front/css/dashboard.css');
//        $this->load->js('assets/front/js/jquery.min.js');
//        $this->load->js('assets/front/js/popper.min.js');
//        $this->load->js('assets/front/js/bootstrap.min.js');
//        $this->load->js('assets/front/js/dashboard.js');
        $this->load->css('assets/front/css/owl.carousel.min.css');
        $this->load->js('assets/front/js/owl.carousel.min.js');
          $this->load->js('assets/front/js/jquery.stickit.js');
    }

    public function index() {

        $this->load->view('signin-student');
    }

    public function check() {
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
        $this->db->where('category =', 'student');
        $check = $this->db->get()->result();

        if (count($check) == 0) {
            $this->output->set_template('blank');
            $this->_init();
            $this->load->view('signin-student');
            ?>
            <script type="text/javascript">
                alert("Your Username or Password Is Incorrect...!");
            </script>

            <?php

        } else {
            foreach ($check as $checks) {
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
                $data['category'] = $checks->category;
            }


            $this->load->view('student-settings', $data);
        }
    }

}
?>
