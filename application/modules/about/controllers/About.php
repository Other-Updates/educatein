<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class About extends CI_Controller {

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
    }

    public function index() {
        $this->load->view('about');
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
        $sub = 'Enquiry - Edugatein';
        $msg .= "Name : ".$data['name']."<br>";
        $msg .= "Email : ".$data['email']."<br>";
        $msg .= "Mobile : ".$data['mobile']."<br>";
        $msg .= "City : ".$data['city']."<br>";
        $msg .= "Enquiry : ".$data['comment'];
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
        $this->email->subject($sub);
        $this->email->message($msg);  
            if($this->email->send())
            {
                $this->session->set_flashdata("email_sent","Congragulation Email Send Successfully.");
            }
            else
            {
            show_error($this->email->print_debugger());
            }


        $username = "manikandan@haunuzinfosystems.com";
        $hash = "23ac5a688f4e027886766d2f5e799c8ae74dc96976b879299ba0df1d9f3eafb9";

        // Config variables. Consult http://api.textlocal.in/docs for more info.
        $test = "0";

        // Data for text message. This is the text message data.
        $sender = "EDUGAT"; // This is who the message appears to be from.
        $numbers = $data['mobile']; // A single number or a comma-seperated list of numbers
        $data['random'] = rand(1000, 9999);
        $rndno = $data['random'];

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




        $this->load->view('about', $data);
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
            $data['random'] = $old_otp;

            if ($new_otp == $old_otp) {
                $count++;

                $this->db->insert('enquiry_form', $otps);
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


        $this->load->view('about');
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
        // echo $message;
        // echo $result;
        curl_close($ch);

// exit();
        //	echo '<script>alert("You Have Successfully updated this Record!");</script>';




        $this->db->insert('otp_tracker', $data);




        $this->load->view('about', $school);
    }

    public function numbersent() {

        $new_otp = $_POST['otp'];
        $ip = $_POST['ip'];


        $this->db->select('*')->where('ip', $ip);
        $this->db->from('otp_tracker');
        $otp = $this->db->get();


        $count = 0;
        foreach ($otp->result() as $otps) {
            $old_otp = $otps->random;
            $data['random'] = $old_otp;

            if ($new_otp == $old_otp) {
                $count++;

                $this->db->insert('enquiry_form', $otps);
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


        $this->load->view('about');
    }

}
?>
