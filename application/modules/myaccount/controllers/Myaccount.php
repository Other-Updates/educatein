<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Myaccount extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->output->set_template('simple');
        $this->_init();
        if (empty($this->session->userdata('school_logged_in'))) {
            redirect("signin");
        }
    }

    function _init() {
        $this->load->css('assets/front/css/owl.carousel.min.css');
        $this->load->js('assets/front/js/owl.carousel.min.js');
        $this->load->js("assets/front/js/jquery.stickit.js");
    }   

    public function index() {
//        echo "<pre>";
//        print_r($this->session->userdata());
//        echo "<pre>";

//        if (empty($this->session->userdata('user_id'))) {
//            $this->session->unset_userdata('school_logged_in');
//            redirect(base_url());
//        } else {
            $data["user_id"] = $user_id = $this->session->userdata('user_id');

            $this->db->select('*');
            $this->db->from('user_register');
            $this->db->where("id", $user_id);
            $user = $this->db->get()->row();
            $data["username"] = $user->name;
//        }
        $this->load->view('my-account', $data);
    }

    public function packageview() {        
        $test = $this->session->flashdata('school');
        echo $test;
        exit();
        $this->session->set_userdata('school', $test);
        $this->load->view('package-details');
    }

    public function update() {
        $data = array(
            'address' => $this->input->post('address'),
            'city_id' => $this->input->post('city'),
            'state' => $this->input->post('state'),
            'country' => $this->input->post('country'),
            'pincode' => $this->input->post('pincode'),
        );
        if(!empty($_FILES['image'])){
            $profile = $_FILES['image']['name'];
            $profile_ext = pathinfo($profile, PATHINFO_EXTENSION);
            $profile_name = rand(10000, 10000000) . "." . $profile_ext;
            $profile_type = $_FILES['image']['type'];
            $profile_size = $_FILES['image']['size'];
            $profile_tem_loc = $_FILES['image']['tmp_name'];
            $profile_store = FCPATH . "/images/myaccount/" . $profile_name;
            
            $allowed = array('gif', 'png', 'jpg', 'jpeg', 'GIF', 'PNG', 'JPG', 'JPEG');
            if (in_array($profile_ext, $allowed)) {
                if (move_uploaded_file($profile_tem_loc, $profile_store)) {
                    $data['image'] = $profile_name;
                }
            }
        }
        $data['email'] = $this->input->post('useremail');
        $this->db->where('id =',$this->session->userdata('user_id'));
        $this->db->update('user_register', $data);
        $data["user_id"] = $user_id = $this->session->userdata('user_id');
        $this->db->select('*');
        $this->db->from('user_register');
        $this->db->where("id", $user_id);
        $user = $this->db->get()->row();

        $data["username"] = $user->name;
        $data["status"] = 'success';
        echo json_encode($data);exit;
        // $this->load->view('my-account', $data);
    }

    public function changepassword() {
        $data = array(
            'email' => $this->input->post('newemail'),
            'password' => base64_encode($this->input->post('newpassword1')),
        );

        $password = base64_encode($this->input->post('currentpassword'));
        $this->db->select('*');
        $this->db->from('user_register');
        $this->db->where('email =', $data['email']);
        $this->db->where('password =', $password);
        $pass = $this->db->get()->result();

        if (count($pass) > 0) {
            $this->db->where('email =', $data['email']);
            $this->db->update('user_register', $data);
            ?>
            <!-- Success-Alert -->
            <script type="text/javascript">
                $(document).ready(function () {
                    swal({
                        title: "Good job!",
                        text: "Your Password Change successfully",
                        icon: "success",
                        buttons: true,
                    });
                });
            </script>


            <?php
        } else {
            ?>
            <!-- Success-Alert -->
            <script type="text/javascript">
                $(document).ready(function () {
                    swal({
                        title: "Your Password Is Incorrect",
                        text: "Please Try Again",
                        icon: "warning",
                        buttons: true
                    });
                });
            </script>


            <?php
        }


$data["user_id"] = $user_id = $this->session->userdata('user_id');
        $this->load->view('my-account', $data);
    }

}
 