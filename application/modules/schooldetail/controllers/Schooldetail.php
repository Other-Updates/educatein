<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Schooldetail extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->output->set_template('simple');
        $this->_init();
    }

    private function _init() {
        $this->load->css(base_url('assets/front/css/owl.carousel.min.css'));
        $this->load->css(base_url('assets/front/css/styles1.css'));
        $this->load->css(base_url('assets/front/css/jquery.fancybox.min.css'));
        $this->load->css(base_url('assets/front/css/swiper.min.css'));
        $this->load->js(base_url('assets/front/js/wow.min.js'));
        $this->load->js(base_url('assets/front/js/owl.carousel.min.js'));
        $this->load->js(base_url('assets/front/js/jquery.stickit.js'));
        $this->load->js(base_url('assets/front/js/jquery.easeScroll.js'));
        $this->load->js(base_url('assets/front/js/parallax.min.js'));
        $this->load->js(base_url('assets/front/js/jquery.fancybox.min.js'));
        $this->load->js(base_url('assets/front/js/Chart.js'));
        $this->load->js(base_url('assets/front/js/dot-circle.js'));
        $this->load->js(base_url('assets/front/js/swiper.min.js'));
    }

    public function index() {
        $this->db->select('*')->where('is_active =', 1);
        $this->db->from('affiliations');
        $query['query'] = $this->db->get();

        $this->load->view('schooldetails', $query);
    }

    public function admission() {
        $data = array(
            'firstname' => $this->input->post('firstname'),
            'lastname' => $this->input->post('lastname'),
            'email' => $this->input->post('email'),
            'mobile' => $this->input->post('mobile'),
            'school_id' => $this->input->post('schoolid'),
            'enquiry' => $this->input->post('enquiry'),
        );
        $this->db->insert('admission_enquiries', $data);
        $this->db->select('*');
        $this->db->where('id',$this->input->post('schoolid'));
        $this->db->from('school_details');
        $school = $this->db->get()->result_array();
        $message = "Name : ".ucfirst($_POST['firstname'])." ".$_POST['lastname']."<br>"."Mobile : ".$_POST['mobile']."<br>"."Email : ".$_POST['email']."<br>"."Enquiry : ".$_POST['enquiry'];

        $this->load->library('email');

        $config['protocol']    = 'smtp';
        $config['smtp_host']    = 'ssl://smtp.gmail.com';
        $config['smtp_port']    = '465';
        $config['smtp_timeout'] = '7';
        $config['smtp_user']    = 'ftwoftesting@gmail.com';
        $config['smtp_pass']    = 'MotivationS@1';
        $config['charset']    = 'utf-8';
        $config['newline']    = "\r\n";
        $config['mailtype'] = 'html'; 
        $config['validation'] = TRUE; // bool whether to validate email or not      
        
        $this->email->initialize($config);
        
        $this->email->from('ftwoftesting@gmail.com');
        $this->email->to('sundarabui2k21@gmail.com'); 
        $this->email->subject('Admission Enquiry');
        $this->email->message($message);  
            if($this->email->send())
            {
                $this->session->set_flashdata("email_sent","Congragulation Email Send Successfully.");
            }
            else
            {
            show_error($this->email->print_debugger());
            }




        // $this->load->library('email');
        // $config['protocol']    = 'smtp';
        // $config['smtp_host']    = 'ssl://smtp.gmail.com';
        // $config['smtp_port']    = '465';
        // $config['smtp_timeout'] = '7';
        // $config['smtp_user']    = 'ftwoftesting@gmail.com';
        // $config['smtp_pass']    = 'MotivationS@1';
        // $config['charset']    = 'utf-8';
        // $config['newline']    = "\r\n";
        // $config['mailtype'] = 'html';
        // $config['validation'] = TRUE; // bool whether to validate email or not      
        
        // $this->email->initialize($config);
        // $message = "Name : ".ucfirst($_POST['firstname'])." ".$_POST['lastname']."<br>"."Mobile : ".$_POST['mobile']."<br>"."Email : ".$_POST['email']."<br>"."Enquiry : ".$_POST['enquiry'];
        // $this->email->from('ftwoftesting@gmail.com');
        // $this->email->to('sundarabui2k21@gmail.com'); 
        // $this->email->subject('Admission Enquiry');
        // $this->email->message($this->input->post('enquiry'));  
        //     if($this->email->send())
        //     {
        //         $this->session->set_flashdata("email_sent","Congragulation Email Send Successfully.");
        //     }
        //     else
        //     {
        //     show_error($this->email->print_debugger());
        //     }
        redirect(base_url());
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
                $this->load->view('welcome_message');
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
                $this->load->view('welcome_message');
            }
        } else {
            $this->load->view('welcome_message');
        }
    }

    public function enquiry() {

        $data['name'] = $_POST['name'];
        $data['email'] = $_POST['email'];
        $data['mobile'] = $_POST['mobile'];
        $data['ip'] = $_POST['ip'];
        $data['school'] = $_POST['school'];
        $data['city'] = $_POST['city'];
        $data['comment'] = $_POST['comment'];
        $school['school'] = $data['school'];

        $username = "manikandan@haunuzinfosystems.com";
        $hash = "23ac5a688f4e027886766d2f5e799c8ae74dc96976b879299ba0df1d9f3eafb9";

        // Config variables. Consult http://api.textlocal.in/docs for more info.
        $test = "0";

        // Data for text message. This is the text message data.
        $sender = "EDUGAT"; // This is who the message appears to be from.
        $numbers = $data['mobile']; // A single number or a comma-seperated list of numbers
        $data['random'] = rand(1000, 9999);
        $rndno = $data['random'];
        $school['random'] = $rndno;
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




        $this->load->view('schooldetails', $school);
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
            $school['school'] = $otps->school;
            $school['random'] = $rndno;

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
//         echo '<div class="alert alert-danger">
//   <strong>you entered wrong otp..!please try again</strong>
// </div>';
        }
        $this->db->select('*')->where('is_active =', 1);
        $this->db->from('affiliations');
        $query['query'] = $this->db->get();

        $this->load->view('schooldetails', $school);
    }

    public function phoneotp() {

        $data['name'] = $_POST['otpname'];
        $data['email'] = $_POST['countrycode'];
        $data['mobile'] = $_POST['otpmobile'];
        $data['ip'] = $_POST['mobileip'];
        $data['school'] = $_POST['mobileid'];
        $data['city'] = $_POST['mobilecity'];
        $data['comment'] = "test";
        $school['school'] = $data['school'];



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
        $school['random'] = $rndno;
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
        echo $message;
        echo $result;
        curl_close($ch);

// exit();
        //	echo '<script>alert("You Have Successfully updated this Record!");</script>';




        $this->db->insert('otp_tracker', $data);
        $this->load->view('schooldetails', $school);
    }

}
