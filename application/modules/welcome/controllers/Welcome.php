<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     * 	- or -
     * 		http://example.com/index.php/welcome/index
     * 	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */
    function __construct() {
        parent::__construct();
        $this->output->set_template('simple');
        $this->_init();
    }

    private function _init() {

        $this->load->js(base_url('assets/front/js/wow.min.js'));
        $this->load->js(base_url('assets/front/js/owl.carousel.min.js'));
        $this->load->js(base_url('assets/front/js/jquery.stickit.js'));
    }

    public function index() {

//        $this->check_validity();
//        $this->home_page_count();
        $data["random"] = rand();
        $selected = $this->selected_city();
        $data["city"] = $selected["city"];
        $data["uccity"] = $selected["uccity"];
        $data["aff_url"] = $selected["aff_url"];
        $data["searchcity"] = $selected["searchcity"];
        $data["allcity"] = $this->get_cities();
        $data["city_id"] = $city_id = $selected["city_id"];
        $data["schools"] = array();
        if (!empty($city_id)) {
            $data["schools"] = $this->get_schools($city_id);
        }
        $this->session->set_userdata('city_id',$data["city_id"]);
        //platinum plan schools
        // $this->db->select('sd.school_name as schoolname,sd.affiliation_id,si.images as banner,af.affiliation_name');
        // $this->db->from('school_details as sd');
        // $this->db->join('school_images as si', 'sd.id = si.school_id and school_activity_id = 2', 'left');
        // $this->db->join('affiliations as af','sd.affiliation_id = af.id');
        // if(!empty($this->session->userdata('city_id')))
        //     $this->db->where('sd.city_id',$this->session->userdata('city_id'));
        // $this->db->where('sd.deleted_at',NULL);
        // $this->db->where('sd.status',1);
        // $this->db->where('sd.is_active',1);
        // $this->db->where('sd.school_category_id',1);
        // // $this->db->where('si.school_activity_id',2);
        // $this->db->order_by('RAND()');
        // $data['platinum_data'] = $this->db->get()->result_array();

        // //premium plan schools
        // $this->db->select('sd.school_name as schoolname,si.images as banner,af.affiliation_name');
        // $this->db->from('school_details as sd');
        // $this->db->join('school_images as si', 'sd.id = si.school_id and school_activity_id = 2', 'left');
        // $this->db->join('affiliations as af','sd.affiliation_id = af.id');
        // if(!empty($this->session->userdata('city_id')))
        // $this->db->where('sd.city_id',$this->session->userdata('city_id'));
        // $this->db->where('sd.deleted_at',NULL);
        // $this->db->where('sd.status',1);
        // $this->db->where('sd.is_active',1);
        // $this->db->order_by('RAND()');
        // $this->db->where('sd.school_category_id',2);
        // $data['premium_data'] = $this->db->get()->result_array();

        //spectrum plan schools
        // $this->db->select('sd.school_name as schoolname,si.images as banner,af.affiliation_name');
        // $this->db->join('school_images as si', 'sd.id = si.school_id and school_activity_id = 2', 'left');
        // $this->db->join('affiliations as af','sd.affiliation_id = af.id');
        // if(!empty($this->session->userdata('city_id')))
        // $this->db->where('sd.city_id',$this->session->userdata('city_id'));
        // $this->db->where('sd.deleted_at',NULL);
        // $this->db->where('sd.status',1);
        // $this->db->where('sd.is_active',1);
        // $this->db->where('sd.school_category_id',3);
        // $this->db->order_by('RAND()');
        // $this->db->from('school_details as sd');
        // $query = $this->db->get();
        // $data['spectrum_data'] = Array();
        // foreach ($query->result_array() as $row) {
        //     $data['spectrum_data'][] = $row;
        // }
        // // print_r($data['spectrum_data']);exit;
        // // = $this->db->get()->result_array();

        // //platinum activity classes
        // $where = "ind.is_active=1 AND ind.position_id=1 AND ind.status=1 AND ind.valitity IS NOT NULL AND ind.deleted_at is NULL ";
        // $this->db->select('ind.*,ic.category_name as type');
        // $this->db->where($where);
        // if(!empty($this->session->userdata('city_id')))
        //     $this->db->where('ind.city_id',$this->session->userdata('city_id'));
        // $this->db->join('institute_categories as ic','ind.category_id = ic.id','left');
        // $this->db->from('institute_details as ind');
        // // = $this->db->get()->result_array();
        // $query = $this->db->get();
        // $data['activity_platinum'] = Array();
        // if($query !== FALSE && $query->num_rows() > 0){
        //     foreach ($query->result_array() as $row) {
        //         $data['activity_platinum'][] = $row;
        //     }
        // }

        // //premium activity classes 
        // $where = "ind.is_active=1 AND ind.position_id=2 AND ind.status=1 AND ind.valitity IS NOT NULL AND ind.deleted_at is NULL ";
        // $this->db->select('ind.*,ic.category_name as type');
        // $this->db->where($where);
        // if(!empty($this->session->userdata('city_id')))
        //     $this->db->where('ind.city_id',$this->session->userdata('city_id'));
        // $this->db->join('institute_categories as ic','ind.category_id = ic.id','left');
        // $this->db->from('institute_details as ind');
        // // = $this->db->get()->result_array();
        // $query = $this->db->get();
        // $data['activity_premium'] = Array();
        // if($query !== FALSE && $query->num_rows() > 0){
        //     foreach ($query->result_array() as $row) {
        //         $data['activity_premium'][] = $row;
        //     }
        // }

        // //spectrum activity classes 
        // $where = "in.is_active=1 AND in.position_id=3 AND in.status=1 AND in.valitity IS NOT NULL AND in.deleted_at is NULL ";
        // $this->db->select('in.*,ic.category_name as type');
        // $this->db->where($where);
        // if(!empty($this->session->userdata('city_id')))
        //     $this->db->where('in.city_id',$this->session->userdata('city_id'));
        // $this->db->from('institute_details as in');
        // $this->db->join('institute_categories as ic','in.category_id = ic.id','left');
        // // = $this->db->get()->result_array();
        // $query = $this->db->get();
        // $data['activity_spectrum'] = Array();
        // if($query !== FALSE && $query->num_rows() > 0){
        //     foreach ($query->result_array() as $row) {
        //         $data['activity_spectrum'][] = $row;
        //     }
        // }

        $this->load->view('welcome_message', $data);
    }

    public function career() {
        $data['firstname'] = $_POST['firstname'];
        if (isset($_POST['lastname'])) {
            $data['lastname'] = $_POST['lastname'];
        }
        $data['email'] = $_POST['email'];
        $data['mobile'] = $_POST['mobile'];
        $data['designation'] = $_POST['designation'];
        if (isset($_POST['portfolio'])) {
            $data['portfolio'] = $_POST['portfolio'];
        }
        $data['file'] = $_FILES['file']['name'];
        $date = date_default_timezone_set('Asia/Kolkata');
        $data['created_at'] = date('Y-m-d h-i-s');
        $file = $_FILES['file']['name'];
        $ext = pathinfo($file, PATHINFO_EXTENSION);
        $file_name = $_POST['firstname'] . "-" . $_POST['mobile'] . "." . $ext;
        $file_type = $_FILES['file']['type'];
        $file_size = $_FILES['file']['size'];
        $file_tem_loc = $_FILES['file']['tmp_name'];
        $file_store = $_SERVER['DOCUMENT_ROOT'] . "/uploads/" . $file_name;
        $allowed = array('gif', 'png', 'jpg', 'jpeg');
// echo $file_type;
// exit();
        if (!in_array($ext, $allowed)) {
            if (move_uploaded_file($file_tem_loc, $file_store)) {
                
            }
        }
        $this->db->insert('careers', $data);
        $this->load->view('welcome_message');
    }

    public function enquiry() {
        $data['name'] = $_POST['name'];
        $data['email'] = $_POST['email'];
        $data['mobile'] = $_POST['mobile'];
        $data['ip'] = $_POST['ip'];
        $data['city'] = $_POST['city'];
        $data['comment'] = $_POST['comment'];
// if( $data['name'] != " "){
// echo $data['name'];
// exit();
// } 
        $username = "manikandan@haunuzinfosystems.com";
        $hash = "23ac5a688f4e027886766d2f5e799c8ae74dc96976b879299ba0df1d9f3eafb9";
        // Config variables. Consult http://api.textlocal.in/docs for more info.
        $test = "0";
        // Data for text message. This is the text message data.
        $sender = "EDUGAT"; // This is who the message appears to be from.
        $numbers = $data['mobile']; // A single number or a comma-seperated list of numbers
        $data['random'] = rand(1000, 9999);
        $rndno = $data['random'];
        $random['random'] = $rndno;
        $message = "This is a otp message from the edugatein.the otp is " . $rndno;
        // 612 chars or less
        // A single number or a comma-seperated list of numbers
        $message = rawurlencode($message);
        $data1 = "username=" . $username . "&hash=" . $hash . "&message=" . $message . "&sender=" . $sender . "&numbers=" . $numbers . "&test=" . $test;
        $ch = curl_init('http://api.textlocal.in/send/?');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch); // This is the result from the API
        curl_close($ch);
        $this->db->insert('otp_tracker', $data);
        $this->load->view('welcome_message', $random);
    }

    public function otp() {
        $new_otp = $_POST['otp'];
        $ip = $_POST['ip'];
        $this->db->select('*')->where('ip', $ip);
        $this->db->from('otp_tracker');
        $otp = $this->db->get();
        $count = 0;
        foreach ($otp->result() as $otps) {
            $old_otp = $otps->random;
            if ($new_otp == $old_otp) {
                $random['random'] = $old_otp;
                $count++;
                ?>
                <!-- Success-Alert -->
                <script type="text/javascript">
                    $(document).ready(function () {
                        swal({
                            title: "Good job!",
                            text: "Thanks for contacting us.",
                            icon: "success",
                            buttons: true,
                        });
                    });
                </script>
                <?php
                $this->db->insert('enquiry_form', $otps);
            } else if ($old_otp == "") {
                echo '<script>alert("session time out!..please try again!!!!!");</script>';
                $count++;
            }
        }


        if ($count == 0 && isset($old_otp)) {
            ?>

            <!-- Danger-Alert -->
            <script type="text/javascript">
                $(document).ready(function () {
                    swal({
                        title: "You Entered Wrong OTP!",
                        text: "Please try again.",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    });
                });
            </script>


            <?php
        }

        if ($count > 0) {
            $this->load->view('welcome_message', $random);
        } else {
            $this->load->view('welcome_message');
        }
    }

//    function set_city($city, $user_choice = FALSE) {
//        $this->load->library('session');
//        $search_city = $this->session->userdata('search_city');
//        if (!empty($search_city)) {
//            if ($user_choice) {
//                if ($search_city != $city) {
//                    $data_session_set = array('user_choice' => TRUE, 'search_city' => $city);
//                    $this->session->set_userdata($data_session_set);
//                }
//            } else {
//                $data_session_set = array('user_choice' => FALSE, 'search_city' => $city);
//                $this->session->set_userdata($data_session_set);
//            }
//        } else {
//            $data_session_set = array('user_choice' => FALSE, 'search_city' => $city);
//            $this->session->set_userdata($data_session_set);
//        }
//    }

    function check_validity() {
        //        $val = "is_active=1  AND activated_at != 'NULL' AND valitity != 'NULL' ";
//        $this->db->select('*')->where($val);
//        $this->db->from('school_details');
//        $school = $this->db->get(); 
//         
//        foreach ($school->result() as $schools) {
//            $test = $schools->valitity * 60 * 60 * 48;
//            $activate = new DateTime($schools->activated_at);
//            $date = new DateTime();            
//            if ($date->getTimestamp() > $activate->getTimestamp() + $test) {
//                $this->db->set('is_active', 0);
//                $this->db->set('activated_at', NULL);
//                $this->db->set('valitity', NULL);
//                $this->db->where('id', $schools->id);
//                $this->db->update('school_details');
//            }
//        }
        //        $ins = "is_active=1 AND activated_at != 'NULL' AND valitity != 'NULL' ";
//        $this->db->select('*')->where($ins);
//        $this->db->from('institute_details');
//        $institute = $this->db->get();
//        foreach ($institute->result() as $institutes) {
//            $valitity = $institutes->valitity * 60 * 60 * 24;
//            $activate = new DateTime($institutes->activated_at);
//            $date = new DateTime();
//            if ($date->getTimestamp() > $activate->getTimestamp() + $valitity) {
//                $this->db->set('is_active', 0);
//                $this->db->set('activated_at', NULL);
//                $this->db->set('valitity', NULL);
//                $this->db->where('id', $institutes->id);
//                $this->db->update('institute_details');
//            }
//        }
    }

    function home_page_count() {

//        Welcome_message page top Start
//        $date = date("Y/m/d");
//        $this->db->select('*')->where('date =', $date);
//        $this->db->from('homepage_counts');
//        $homepage = $this->db->get();
//        if ($homepage->num_rows() > 0) {
//            foreach ($homepage->result() as $homepages) {
//                $view_count = $homepages->view_count;
//            }
//            $this->db->set('view_count', $view_count + 1)->where('date', $date)->update('homepage_counts');
//        } else {
//            $homepage_count = array(
//                'date' => $date,
//                'view_count' => 1,
//            );
//            $this->db->insert('homepage_counts', $homepage_count);
//        }
    }

    function user_analysis($ipaddress) {
        //        $date = date("Y/m/d");
        //        $this->db->select('*')->where('date =', $date);
//        $this->db->where('ip =', $ipaddress);
//        $this->db->from('user_analys');
//        $ip = $this->db->get();
//        if ($ip->num_rows() > 0) {
//            foreach ($ip->result() as $ips) {
//                $old_ip = $ips->ip;
//                $page_view = $ips->page_view;
//            }
//            $this->db->set('page_view', $page_view + 1);
//            $this->db->where('date', $date);
//            $this->db->where('ip', $ipaddress);
//            $update = $this->db->update('user_analys');
//            // $this->db->set('page_view',$page_view+1)->where('date',$date)->update('user_analys');
//        } else {
//            $user_count = array(
//                'ip' => $ipaddress,
//                'date' => $date,
//                'page_view' => 1,
//            );
//            $this->db->insert('user_analys', $user_count);
//        }
    }

    function get_cities() {
        $cities = array();
        $this->db->select('*')->where('is_active =', 1);
        $this->db->order_by("city_name", "asc");
        $this->db->from('cities');
        $cities = $this->db->get()->result();
        return $cities;
    }

    function selected_city() {
        $this->load->library('session');
        $search_city = $this->session->userdata('search_city');
        $city_id = $this->session->userdata('city_id');
        $aff_url = $uccity = $city_id = "";
        $aff_url = end($this->uri->segments);
        $yourcity = array();
        $yourcity = explode("-", $aff_url);
        $city = end($yourcity);
        $ucity = $uccity = ucfirst($city);
        if (!empty($search_city)) {
            if ($aff_url != "") {
                $url = $this->find_city_using_url($aff_url, $ucity, $city);
                $uccity = $url["uccity"];
                $city_id = $url["city_id"];
                if ($search_city != $city) {
                    $data_session_set = array("logged_in" => TRUE, 'search_city' => $city, "city_id" => $city_id);
                    $this->session->set_userdata($data_session_set);
                }
            } else {
                $uccity = $search_city;
                $city = $search_city;
                $city_id = $city_id;
            }
        } else {
            if ($aff_url != "") {
                $url = $this->find_city_using_url($aff_url, $ucity, $city);
                $uccity = $url["uccity"];
                $city_id = $url["city_id"];
                $data_session_set = array("logged_in" => TRUE, 'search_city' => $city, "city_id" => $city_id);
                $this->session->set_userdata($data_session_set);
            }
        }

        $city = array("city" => $city, "uccity" => $uccity, "searchcity" => $uccity, "aff_url" => $aff_url, "city_id" => $city_id);
        return $city;
    }

    function find_city_using_url($aff_url, $ucity, $city) {
        $cities = $this->get_cities();
        foreach ($cities as $allcitys) {
            if ($allcitys->city_name == $ucity) {
                $uccity = ucfirst($city);
                $city_id = $allcitys->id;
            }
        }
        $url = array("uccity" => $uccity, "city_id" => $city_id);
        return $url;
    }

    function find_city_using_ip() {

//        $ipaddress = '';
////        Get city using User IP Address
//        if (isset($_SERVER['HTTP_CLIENT_IP']))
//            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
//        else if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
//            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
//        else if (isset($_SERVER['HTTP_X_FORWARDED']))
//            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
//        else if (isset($_SERVER['HTTP_FORWARDED_FOR']))
//            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
//        else if (isset($_SERVER['HTTP_FORWARDED']))
//            $ipaddress = $_SERVER['HTTP_FORWARDED'];
//        else if (isset($_SERVER['REMOTE_ADDR']))
//            $ipaddress = $_SERVER['REMOTE_ADDR'];
//        else
//            $ipaddress = 'UNKNOWN';
//
//        $json = file_get_contents(" ");
//        $json = json_decode($json, true);
//        $uccity = $json['city'];
//        $city = strtolower($uccity);
//        $ip = array("uccity" => $uccity, "city" => $city);
//        return $ip;
    }

    function get_schools($city) {
        $schools = $this->Base_Model->get_records("school_details", "*", array(array(true, "city_id", $city)));
        return $schools;
    }

    function logout() {        
        $this->session->set_userdata('school_logged_in', FALSE);
        $this->session->unset_userdata('user_id');
        session_destroy();        
        redirect(base_url());
    }

    function search_school(){
        $where = "sd.is_active=1 AND sd.status=1 AND sd.valitity IS NOT NULL AND sd.deleted_at is NULL ";
        $this->db->select('sd.school_name');
        $this->db->where($where);
        if(!empty($this->session->userdata('city_id')))
        $this->db->where('sd.city_id',$this->session->userdata('city_id'));
        if(!empty($this->session->userdata('search_city')))
        $this->db->where('ci.city_name',ucfirst($this->session->userdata('search_city')));
        $this->db->like('sd.school_name',$_POST['keyword']);
        $this->db->from('school_details as sd');
        $this->db->join('cities as ci','sd.city_id=ci.id','left');
        $this->db->limit(10);
        $get_school = $this->db->get()->result_array();
        echo json_encode($get_school);
        exit;
    }

}
