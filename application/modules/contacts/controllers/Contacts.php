<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contacts extends CI_Controller {

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
        $this->load->js('assets/front/js/wow.min.js');
        $this->load->js('assets/front/js/owl.carousel.min.js');
        $this->load->js('assets/front/js/jquery.easeScroll.js');
//        $this->load->js(base_url('css/lightbox.css'));
//        $this->load->js(base_url('js/lightbox.js'));
    }

    public function index() {
        $this->load->view('contact');
    }

    public function insert() {
        $data = array(
            'name' => $this->input->post('name'),
            'email' => $this->input->post('email'),
            'subject' => $this->input->post('subject'),
            'phone' => $this->input->post('phone'),
            'message' => $this->input->post('message'),
        );

        $name = $data['name'];
        $email = $data['email'];
        $subject = $data['subject'];
        $phone = $data['phone'];
        $message = $data['message'];



        if ($name != " " && $email != " " && $subject != " " && $phone != " ") {


            $where = " name = '$name' AND email = '$email' AND subject = '$subject' AND phone = '$phone' AND message = '$message'";

            $this->db->select('*')->where($where);
            $this->db->from('contact_form');
            $contact = $this->db->get()->result();


            if (count($contact) == 0) {

                $this->db->insert('contact_form', $data);

                $to = "support@edugatein.com";
                $subject = "Enquiry From Edugatein.com";
                $message = "Hi Edugatein,
                The new enquiry from " . $name . ".
                Subject : " . $subject . "
                Message : " . $message . "
                Mobile : " . $phone . " 
                Email : " . $email . " ";
                // Always set content-type when sending HTML email
                $headers = "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

                // More headers
                $headers .= 'From: <support@edugatein.com>' . "\r\n";
                $headers .= 'Cc: manikandan@haunuzinfosystems.com' . "\r\n";

                mail($to, $subject, $message, $headers);
// if(mail($to,$subject,$message,$headers))
// {
// echo "success";
// }else
// {
//     echo "failed";
// }
// exit();
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

                                                                                                        <!-- echo '<script>alert("You Have Successfully updated this Record!");</script>'; -->

                <?php
                $this->load->view('contact'); //insert
            } else {


                $this->load->view('contact'); //already inserted data
            }
        } else {
            $this->load->view('contact'); //check the data  
        }
    }

    public function newsletter() {
        $data = array(
            'email' => $this->input->post('email')
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
                $this->load->view('contact');
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
                $this->load->view('contact');
            }
        } else {
            $this->load->view('contact');
        }
    }

}
?>
