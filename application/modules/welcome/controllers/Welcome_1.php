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
        $this->load->js(base_url('js/wow.min.js'));
        $this->load->js(base_url('js/owl.carousel.min.js'));
        $this->load->js(base_url('js/jquery.stickit.js'));
    }

    public function index() {
        // echo $_POST['city'];
        // exit();
        $val = "is_active=1 AND activated_at != 'NULL' AND valitity != 'NULL' ";
        $this->db->select('*')->where($val);
        $this->db->from('school_details');
        $school = $this->db->get();

        foreach ($school->result() as $schools) {

            $test = $schools->valitity * 60 * 60 * 24;


            $activate = new DateTime($schools->activated_at);

            $date = new DateTime();
            if ($date->getTimestamp() > $activate->getTimestamp() + $test) {
                $this->db->set('is_active', 0);
                $this->db->set('activated_at', NULL);
                $this->db->set('valitity', NULL);
                $this->db->where('id', $schools->id);
                $this->db->update('school_details');
            }
        }

        $ins = "is_active=1 AND activated_at != 'NULL' AND valitity != 'NULL' ";
        $this->db->select('*')->where($ins);
        $this->db->from('institute_details');
        $institute = $this->db->get();

        foreach ($institute->result() as $institutes) {

            $valitity = $institutes->valitity * 60 * 60 * 24;


            $activate = new DateTime($institutes->activated_at);

            $date = new DateTime();
            if ($date->getTimestamp() > $activate->getTimestamp() + $valitity) {
                $this->db->set('is_active', 0);
                $this->db->set('activated_at', NULL);
                $this->db->set('valitity', NULL);
                $this->db->where('id', $institutes->id);
                $this->db->update('institute_details');
            }
        }
        $data["random"] = rand();
//        Welcome_message page top Start
        $date = date("Y/m/d");

        $this->db->select('*')->where('date =', $date);
        $this->db->from('homepage_counts');
        $homepage = $this->db->get();
        if ($homepage->num_rows() > 0) {
            foreach ($homepage->result() as $homepages) {
                $view_count = $homepages->view_count;
            }

            $this->db->set('view_count', $view_count + 1)->where('date', $date)->update('homepage_counts');
        } else {
            $homepage_count = array(
                'date' => $date,
                'view_count' => 1,
            );

            $this->db->insert('homepage_counts', $homepage_count);
        }

        $ipaddress = '';
        if (isset($_SERVER['HTTP_CLIENT_IP']))
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        else if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if (isset($_SERVER['HTTP_X_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        else if (isset($_SERVER['HTTP_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        else if (isset($_SERVER['HTTP_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        else if (isset($_SERVER['REMOTE_ADDR']))
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        else
            $ipaddress = 'UNKNOWN';


        $json = file_get_contents("http://api.ipstack.com/$ipaddress?access_key=568cb70a320a074c060506651b81a793");
        $json = json_decode($json, true);

        $uccity = $json['city'];

        $city = strtolower($uccity);
// echo $uccity;
// exit();
        $city_check = 0;
        $yourcity = array();
        $data["aff_url"] = $aff_url = end($this->uri->segments);

// echo $aff_url;
// exit();
        if ($aff_url != "") {
            $yourcity = explode("-", $aff_url);
            $city = end($yourcity);
            $ucity = ucfirst($city);
            $data['searchcity'] = ucfirst($city);

            $this->db->select('*')->where('is_active =', 1);
            $this->db->from('cities');
            $allcity = $this->db->get();

            foreach ($allcity->result() as $allcitys) {

                if ($allcitys->city_name == $ucity) {
                    $uccity = ucfirst($city);
                }
            }



// echo $city;
// exit();
        } else {
            $this->db->select('*')->where('is_active =', 1);
            $this->db->from('cities');
            $allcity = $this->db->get();

            foreach ($allcity->result() as $allcitys) {

                if ($allcitys->city_name == $uccity) {
                    $city_check++;
                }
            }
// echo $city;
// exit();
            if ($city_check == 0) {
                $uccity = "Coimbatore";
                $city = "coimbatore";
            }
        }
        $data["city"] = $city;
// echo $uccity;
// exit();

        $this->db->select('*')->where('date =', $date);
        $this->db->where('ip =', $ipaddress);
        $this->db->from('user_analys');
        $ip = $this->db->get();

        if ($ip->num_rows() > 0) {
            foreach ($ip->result() as $ips) {
                $old_ip = $ips->ip;
                $page_view = $ips->page_view;
            }

            $this->db->set('page_view', $page_view + 1);
            $this->db->where('date', $date);
            $this->db->where('ip', $ipaddress);

            $update = $this->db->update('user_analys');

            // $this->db->set('page_view',$page_view+1)->where('date',$date)->update('user_analys');
        } else {
            $user_count = array(
                'ip' => $ipaddress,
                'date' => $date,
                'page_view' => 1,
            );

            $this->db->insert('user_analys', $user_count);
        }
//        Welcome_message page top End

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
        ?>

        <?php
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

}
