<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Results extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->output->set_template('simple');
        $this->_init();
    }

    private function _init() {
        $this->load->js('assets/front/js/wow.min.js');
        $this->load->js('assets/front/js/owl.carousel.min.js');
        $this->load->js('assets/front/js/jquery.easeScroll.js');
        $this->load->js('assets/front/js/parallax.min.js');
        $this->load->js('assets/front/js/jquery.fancybox.min.js');
    }

    public function index() {
        $this->load->view('results');
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
                $this->load->view('results');
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
                $this->load->view('results');
            }
        } else {
            $this->load->view('results');
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




        $this->load->view('results', $data);
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


        $this->load->view('results');
    }

}
?>
