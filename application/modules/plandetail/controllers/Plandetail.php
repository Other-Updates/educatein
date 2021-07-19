<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Plandetail extends CI_Controller {
 
    function __construct() {
        parent::__construct();
        $this->output->set_template('simple');
        $this->_init();
    }

    private function _init() {
        $this->load->css('assets/front/css/owl.carousel.min.css');
        $this->load->js('assets/front/js/wow.min.js');
        $this->load->js('assets/front/js/owl.carousel.min.js');
        $this->load->js('assets/front/js/jquery.stickit.js');
    }

    public function index() {          
        $data["user_id"] = $user_id = $this->session->userdata('user_id');
        $this->db->select('*');
        $this->db->from('user_register');
        $this->db->where("id", $user_id);
        $user = $this->db->get()->row();
       
        $data["username"] = $user->name;
        $this->load->view('plan_details',$data);
    }

    public function gallery() {
        // gallery image save
        $gallaryimage = $_FILES['mytext']['name'];
        $gallarytype = $_FILES['mytext']['type'];
        $gallarysize = $_FILES['mytext']['size'];
        $gallarytmp_name = $_FILES['mytext']['tmp_name'];
        $school_id = $_POST['schoolid'];

        // echo $school_id;
        // echo "<br>";
        // echo $_POST['schoolname'];
        // exit();
        if (is_array($gallaryimage)) {
            for ($i = 0; $i < count($gallaryimage); $i++) {
                $gallaryimage = $gallaryimage[$i];
                $gallary1_ext = pathinfo($gallaryimage, PATHINFO_EXTENSION);

                $gallary1_name = $_POST['schoolname'] . "-" . rand(10000, 10000000) . "." . $gallary1_ext;
                $gallary1_type = $gallarytype[$i];
                $gallary1_size = $gallarysize[$i];
                $gallary1_tem_loc = $gallarytmp_name[$i];
                $gallary1_store = $_SERVER['DOCUMENT_ROOT'] . "/laravel/public/" . $gallary1_name;

                $allowed = array('gif', 'png', 'jpg', 'jpeg', 'GIF', 'PNG', 'JPG', 'JPEG');


                if (in_array($gallary1_ext, $allowed)) {
                    if (move_uploaded_file($gallary1_tem_loc, $gallary1_store)) {

                        $schoolgallaryinsert1 = array(
                            'school_id' => $school_id,
                            'school_activity_id' => 71,
                            'images' => $gallary1_name,
                            'is_active' => 1
                        );

                        $this->db->insert('school_images', $schoolgallaryinsert1);
                    }
                }
            }
        }

        $this->load->view('plan_details');
    }


}

?>