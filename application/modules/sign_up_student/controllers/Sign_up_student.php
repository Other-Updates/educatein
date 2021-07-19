<?php

class Sign_up_student extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->output->set_template('simple');
        $this->_init();
    }

    private function _init() {
        $this->load->css('assets/front/css/owl.carousel.min.css');
        $this->load->js('assets/front/js/owl.carousel.min.js');
          $this->load->js('assets/front/js/jquery.stickit.js');
    }

    public function index() {
        $this->load->view('sign-up-student');
    }

    public function insert() {
        if (strlen($_POST['lastname']) == 0) {
            $lastname = NULL;
        } else {
            $lastname = $_POST['lastname'];
        }
// exit();
        $data = array(
            'firstname' => $this->input->post('firstname'),
            'lastname' => $lastname,
            'email' => $this->input->post('useremail'),
            'phone' => $this->input->post('mobile'),
            'password' => base64_encode($this->input->post('password')),
            'grade' => $this->input->post('grade'),
            'board' => $this->input->post('board'),
            'terms' => $this->input->post('terms'),
            'ip' => $this->input->post('ip'),
        );

        $this->db->select('*')->where('email =', $data['email']);
        $this->db->from('student_register');
        $email = $this->db->get()->result();

        if (count($email) == 0) {

//            $username = "manikandan@haunuzinfosystems.com";
//            $hash = "23ac5a688f4e027886766d2f5e799c8ae74dc96976b879299ba0df1d9f3eafb9";
//
//// Config variables. Consult http://api.textlocal.in/docs for more info.
//            $test = "0";
//
//// Data for text message. This is the text message data.
//            $sender = "EDUGAT"; // This is who the message appears to be from.
//            $numbers = $data['phone']; // A single number or a comma-seperated list of numbers
            $data['random'] = rand(1000, 9999);
            $rndno = $data['random'];
            $school['random'] = $rndno;
            $message = "This is a otp message from the edugatein.the otp is " . $rndno;
// 612 chars or less
// A single number or a comma-seperated list of numbers
//            $message = rawurlencode($message);
//            $data1 = "username=" . $username . "&hash=" . $hash . "&message=" . $message . "&sender=" . $sender . "&numbers=" . $numbers . "&test=" . $test;
//            $ch = curl_init('http://api.textlocal.in/send/?');
//            curl_setopt($ch, CURLOPT_POST, true);
//            curl_setopt($ch, CURLOPT_POSTFIELDS, $data1);
//            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//            $result = curl_exec($ch); // This is the result from the API
//            curl_close($ch);


            $this->db->insert('student_tracker', $data);

// $this->db->insert('user_register',$data);
            ?>

            <!-- Success-Alert -->
            <script type="text/javascript">
                //         $(document).ready(function(){
                //             swal({
                //                 title: "Good job!",
                //                   text: "You Are Registered successfully",
                //                   icon: "success",
                //                   buttons: true,
                //             });
                //         });
            </script>


            <?php
            $this->load->view('sign-up-student', $data);
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
            $this->load->view('sign-up-student', $data);
        }
    }

    public function otp() {

        $new_otp = $_POST['otp'];
        $ip = $_POST['ip'];


        $this->db->select('*')->where('ip', $ip);
        $this->db->from('student_tracker');
        $otp = $this->db->get();


        $count = 0;
        foreach ($otp->result() as $otps) {
            $old_otp = $otps->random;
            $data['random'] = $old_otp;

            if ($new_otp == $old_otp) {
                $count++;
                $otps->category = "student";
                $this->db->insert('student_register', $otps);
       
        
//send email
//                $to = "sales@edugatein.com";
//                $subject = "New Student User Registered";
//                $txt = "Hi Edugatein,
//The new student user " . $otps->firstname . " has been registered.Please check the details. Email : " . $otps->email . " Mobile : " . $otps->phone;
//                $headers = "From: support@edugatein.com" . "\r\n" .
//                        "CC: manikandan@haunuzinfosystems.com";
//
//                mail($to, $subject, $txt, $headers);
                ?>
<script src="<?php echo base_url() ?>assets/front/js/jquery.min.js"></script>
<script src="<?php echo base_url() ?>assets/front/js/sweetalert.min.js"></script> 
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
//  $this->session->set_userdata('school',$otps->email);
                $otps->username = $otps->firstname;
                $this->load->view('student-settings', $otps);
            } else if ($old_otp == "") {
                echo '<script>alert("session time out!..please try again!!!!!");</script>';
                $count++;
                $this->load->view('sign-up-student');
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

            $this->load->view('sign-up-student');
        }
    }

}
