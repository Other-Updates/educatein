<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Signin extends CI_Controller {

    function __construct() {
        parent::__construct();
        if ($this->session->userdata('school_logged_in'))
            redirect('my-account');
    }

    private function _init() {
        $this->load->css('assets/front/css/bootstrap.min.css');
        $this->load->css('assets/front/css/styles.css');
        $this->load->css('assets/front/css/responsive.css');
        $this->load->css('assets/front/css/font-awesome.css');
        $this->load->css('https://cdn.linearicons.com/free/1.0.0/icon-font.min.css');
        $this->load->css('assets/front/css/animate.css');
        $this->load->css('assets/front/css/dashboard.css');
        $this->load->js('https://code.jquery.com/jquery-3.5.1.min.js');
        $this->load->js('assets/front/js/popper.min.js');
        $this->load->js('assets/front/js/bootstrap.min.js');
        $this->load->js('assets/front/js/dashboard.js');
            $this->load->css(base_url('assets/front/css/owl.carousel.min.css'));
        $this->load->js(base_url('assets/front/js/owl.carousel.min.js')); 
    }

    public function index() {
        $this->output->set_template('blank');
        $this->_init();
        $this->load->view('signin');
    }

    public function myaccount() {
        $data = array(
            'email' => $this->input->post('signemail'),
            'password' => base64_encode($this->input->post('signpassword')),
        );
        $mail = $data['email'];
        $password = $data['password'];
        $this->db->select('*');
        $this->db->from('user_register');
        $this->db->where('email =', $mail);
        $this->db->where('password =', $password);
        $check = $this->db->get()->row();
        if (count($check) == 0) {
            $this->output->unset_template('simple');
            $this->output->set_template('blank');
            $this->_init();
            if ($this->session->userdata('school_logged_in'))
                $this->session->set_userdata('school_logged_in', FALSE);
            $this->load->view('signin');
            ?>
            <script type="text/javascript">
                alert("Your Username or Password Is Incorrect...!");
            </script>

            <?php

        } else {
            $this->output->unset_template('blank');
            $this->output->set_template('simple');
            $this->_init();
            $this->session->set_userdata('school_logged_in', TRUE);
            $this->session->set_userdata('user_id', $check->id);
            $data["user_id"] = $user_id = $this->session->userdata('user_id');
            $this->db->select('*');
            $this->db->from('user_register');
            $this->db->where("id", $user_id);
            $user = $this->db->get()->row();
            $data["username"] = $user->name;
            $data["email"] = $user->email;
            $this->load->view('my-account', $data);
        }
    }

}
?>