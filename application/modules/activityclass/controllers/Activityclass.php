<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Activityclass extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->output->set_template('simple');
        $this->_init();
    }

    private function _init() {
        $this->load->css(base_url('assets/front/css/styles1.css'));
        $this->load->css(base_url('assets/front/css/owl.carousel.min.css'));
        $this->load->css(base_url('assets/front/css/lightbox.css'));
        $this->load->css('https://fonts.googleapis.com/css?family=Luckiest+Guy&display=swap');
        $this->load->js(base_url('assets/front/js/wow.min.js'));
        $this->load->js(base_url('assets/front/js/owl.carousel.min.js'));
        $this->load->js(base_url('assets/front/js/dot-circle.js'));
        $this->load->js(base_url('assets/front/js/jquery.easeScroll.js'));
    }

    public function index() {

        $yourcity = array();
        $aff_url = $this->uri->segments[1];
        $yourcity = explode("-", $aff_url);
        $yourcity = end($yourcity);
        $uccity = ucfirst($yourcity);
        
        $this->db->select('*');
        $this->db->where('city_name',$uccity);
        $this->db->from('cities');
        $cityid = $this->db->get()->result_array();
        $this->session->set_userdata('search_city',$yourcity);
        $this->session->set_userdata('city_id',$cityid[0]['id']);

        $this->db->select('*')->where('is_active =', 1);
        $this->db->from('affiliations');
        $query['query'] = $this->db->get();
        $this->load->view('activity-classes', $query);
    }

    public function newsletter() {
        $data = array(
            'email' => $this->input->post('email'),
        );
        $email = $data['email'];
        if ($email != " ") {
            $where = "email = '$email'";
            $this->db->select('*')->where($where);
            $this->db->from('newletters');
            $contact = $this->db->get()->result();
            if (count($contact) == 0) {
                $this->db->insert('newletters', $data);
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
                $this->load->view('about');
            } else {
                ?>                
                <!-- Success-Alert -->
                <script type="text/javascript">
                    $(document).ready(function () {
                        swal({
                            title: "Your email already entered!!",
                            text: "Please try someother email..",
                            icon: "success",
                            buttons: true,
                        });
                    });
                </script>
                <?php
                $this->load->view('about');
            }
        } else {
            $this->load->view('about');
        }
    }

    public function enquiry() {

        $data['name'] = $_POST['name'];
        $data['email'] = $_POST['email'];
        $data['mobile'] = $_POST['mobile'];
        $data['ip'] = $_POST['ip'];
        $data['city'] = $_POST['city'];
        $data['comment'] = $_POST['comment'];

//echo $data['mobile'];
//exit();	    

        $username = "manikandan@haunuzinfosystems.com";
        $hash = "23ac5a688f4e027886766d2f5e799c8ae74dc96976b879299ba0df1d9f3eafb9";

        // Config variables. Consult http://api.textlocal.in/docs for more info.
        $test = "0";

        // Data for text message. This is the text message data.
        $sender = "EDUGAT"; // This is who the message appears to be from.
        $numbers = $data['mobile']; // A single number or a comma-seperated list of numbers
        $data['random'] = rand(1000, 9999);
        $rndno = $data['random'];
        $query['random'] = $rndno;
        $message = "This is a otp message from the edugatein.the otp is " . $rndno;
        // 612 chars or less
        // A single number or a comma-seperated list of numbers
        $message = rawurlencode($message);
        $data1 = "username=" . $username . "&hash=" . $hash . "&message=" . $message . "&sender=" . $sender . "&numbers=" . $numbers . "&test=" . $test;
        $ch = curl_init('http://api.textlocal.in/send/?');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//	echo $data['mobile'];
        $result = curl_exec($ch); // This is the result from the API
//	echo $message;
//	echo $result;
        curl_close($ch);
        //	echo '<script>alert("You Have Successfully updated this Record!");</script>';
        $this->db->insert('otp_tracker', $data);
        $this->db->select('*')->where('is_active =', 1);
        $this->db->from('affiliations');
        $query['query'] = $this->db->get();
        $this->load->view('activity-classes', $query);
    }

    public function otp() {

        $new_otp = $_POST['otp'];
        $ip = $_POST['ip'];
        $this->db->select('*')->where('ip', $ip);
        $this->db->from('otp_tracker');
        $otp = $this->db->get();
        $count = 1;
        foreach ($otp->result() as $otps) {
            $old_otp = $otps->random;
            $query['random'] = $old_otp;
            if ($new_otp == $old_otp) {
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
                <!-- echo '<div class="alert alert-success">
                <strong>thank you for enquiry to us...!</strong>
                </div>'; -->
                <?php
                $this->db->insert('enquiry_form', $otps);
            } else if ($old_otp == "") {
                echo '<script>alert("session time out!..please try again!!!!!");</script>';
                $count++;
            }
        }
        if ($count == 0) {
            ?>
            <!-- echo '<div class="alert alert-danger">
            <strong>you entered wrong otp..!please try again</strong>
            </div>'; -->
            <!-- Danger-Alert -->
            <script type="text/javascript">
                $(document).ready(function () {
                    swal({
                        title: "Your Entered Wrong OTP!",
                        text: "Please try again.",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    });
                });
            </script>
            <?php
        }
        $this->db->select('*')->where('is_active =', 1);
        $this->db->from('affiliations');
        $query['query'] = $this->db->get();
        $this->load->view('activity-classes', $query);
    }

    public function get_class(){
        $limit = 12; 
        $affiliation = $_POST['affiliation'];
        $yourcity_id = $_POST['yourcity_id'];
        $page = $_POST['page'];
        $page = $limit * $page;
        $where2 = "ind.is_active=1 AND (ind.position_id=3 OR ind.position_id=4) AND ind.expiry_status !=1 AND ind.status=1 AND ind.category_id=" . $affiliation . " AND ind.city_id =" . $yourcity_id . " AND ind.valitity IS NOT NULL AND ind.deleted_at IS NULL";
        $this->db->select('ind.*')->where($where2);
        if(!empty($this->session->userdata('search_city')))
        $this->db->where('ci.city_name',ucfirst($this->session->userdata('search_city')));
        $this->db->order_by('ind.institute_name');
        $this->db->join('cities as ci','ind.city_id=ci.id','left');
        $this->db->from('institute_details as ind');
        $this->db->limit($page,$limit);
        $school_spectrum = $this->db->get()->result_array();
        echo json_encode($school_spectrum);
        exit;
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

}
