<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Signupschool extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->output->set_template('simple');
        $this->_init();
        if ($this->session->userdata('school_logged_in'))
            redirect('my-account');
    }

    private function _init() {
        $this->load->js('assets/front/js/jquery.min.js');
        $this->load->js('assets/front/js/wow.min.js');
        $this->load->js('assets/front/js/owl.carousel.min.js');
        $this->load->js('assets/front/js/sweetalert.min.js');
        $this->load->js('assets/front/js/jquery.validate.min.js');
        $this->load->js('assets/front/js/additional-methods.min.js');
    }

    public function index() {

        $this->load->view('sign-up-school');
    }

    public function insert() {
        $data = array(
            'name' => $this->input->post('name') . " " . $this->input->post('lastname'),
            'email' => $this->input->post('useremail'),
            'phone' => $this->input->post('phone'),
            'password' => base64_encode($this->input->post('password')),
            'category' => $this->input->post('category'),
            'terms' => $this->input->post('terms'),
            'ip' => $this->input->post('ip'),
        );

        $this->db->select('*')->where('email =', $data['email']);
        $this->db->from('user_register');
        $email = $this->db->get()->result();
        if (count($email) == 0) {
            $test = "0";
            $sender = "EDUGAT"; // This is who the message appears to be from.
            $numbers = $data['phone']; // A single number or a comma-seperated list of numbers
            $data['random'] = $random = rand(1000, 9999);
            $this->db->insert('account_tracker', $data);
            $ip = $_SERVER['REMOTE_ADDR'];
            $mobile = substr($this->input->post('phone'), -4);


            // Authorisation details.
            $username = "manikandan@haunuzinfosystems.com";
            $hash = "cbbb512a1a514916c35b040283ac6dc7df975411a4c6669f738aeab42bfeb128";

            // Config variables. Consult http://api.textlocal.in/docs for more info.
            $test = "0";

            // Data for text message. This is the text message data.
            $sender = "EDUGAT"; // This is who the message appears to be from.
            $numbers = $this->input->post('phone'); // A single number or a comma-seperated list of numbers
            $message = 'This is a otp message from the edugatein.the otp is '.$random;
            // 612 chars or less
            // A single number or a comma-seperated list of numbers
            $message = urlencode($message);
            $sms = "username=".$username."&hash=".$hash."&message=".$message."&sender=".$sender."&numbers=".$numbers."&test=".$test;
            $ch = curl_init('http://api.textlocal.in/send/?');
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $sms);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $result = curl_exec($ch); // This is the result from the API
            curl_close($ch);
            // print_r($result);

            echo json_encode(array('status' => 'success', 'data' => array("mobile" => $mobile, "otp" => $random, "contact_email" => $data['email'])));
            die;
        } else {
            echo json_encode(array('status' => 'error', "message" => array("text" => "Try using another contact info !!!", "title" => "User Already Exist")));
            die;
            $this->load->view('sign-up-school', $data);
        }
    }

    public function otp() {
        $new_otp = $_POST['otp'];
        $email = $_POST['contact_email'];
        $ip = $_SERVER['REMOTE_ADDR'];
        $this->db->select('*')->where('email', $email);
        $this->db->order_by("id", "DESC");
        $this->db->from('account_tracker');
        $otp = $this->db->get()->row();
        $count = 0;
        $old_otp = $otp->random;
        $data['random'] = $old_otp;
        if ($new_otp == $old_otp) {
            $this->db->insert('user_register', $otp);
            $this->session->set_userdata('school', $otp->email);
            $this->db->select('*')->where('email =', $otp->email);
            $this->db->from('user_register');
            $user = $this->db->get()->row();
            $this->session->set_userdata('school_logged_in', TRUE);
            $this->session->set_userdata('user_id', $user->id);
            $data["user_id"] = $user_id = $this->session->userdata('user_id');
            echo json_encode(array('status' => 'success',   'redirect_url' => base_url('my-account'),  "message" => array("text" => "OTP Verified Successfully.", "title" => "Verification Completed")));
            die;
        } else {
            $mobile = substr($otp->phone, -4);
            echo json_encode(array('status' => 'error', "mobile" => $mobile, "message" => array("text" => "OTP you have entered is Invalid.", "title" => "Invalid")));
            die;
        }
    }

}
