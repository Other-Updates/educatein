<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Blogdetails extends CI_Controller {

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
        $this->load->js('assets/front/js/jquery.stickit.js');
    }

    public function index() {
        $this->load->view('blog-details');
    }

    public function insert() {

        $aff_url1 = end($this->uri->segments);
        $aff_url = str_replace("..", "?", $aff_url1);
        $aff_url11 = str_replace("-", " ", $aff_url);
        $aff_url111 = str_replace("_", "'", $aff_url11);



        $this->db->select('id')->where('blog_name =', $aff_url111);
        $this->db->from('blogs');
        $blogdet = $this->db->get();
        foreach ($blogdet->result() as $blogdets) {
            $blog_id = $blogdets->id;
            //print_r($schooldets);
            //echo $blogdets->id;
            //exit();
        }
        $data = array(
            'blog_id' => $blog_id,
            'name' => $this->input->post('name'),
            'email' => $this->input->post('email'),
            'comment' => $this->input->post('message'),
                // 'approval'=> 1
        );


        $name = $data['name'];
        $email = $data['email'];
        $comment = $data['comment'];

        if ($blog_id != " " && $name != " " && $email != " " && $comment != " ") {

            $where = " blog_id = '$blog_id' AND name = '$name' AND email = '$email' AND comment = '$comment'";

            $this->db->select('*')->where($where);
            $this->db->from('blog_comments');
            $blogs_comments = $this->db->get()->result();

            if (count($blogs_comments) == 0) {

                $this->db->insert('blog_comments', $data);

                $to = "edugateinpromotion@gmail.com, pavisaro175596@gmail.com";
                $subject = "Notifications";

                $message = 'You have one comment on ' . $aff_url111 . '<br> Click The Link to approve the comment: <a href="http://edugatein.com/laravel/public/admin"> http://edugatein.com/laravel/public/admin</a>';

                // Always set content-type when sending HTML email
                $headers = "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

                // More headers
                $headers .= 'From: Haunuz Info Systems <pavisribtech55@gmail.com>' . "\r\n";
                //$headers .= 'Cc: myboss@example.com' . "\r\n";

                mail($to, $subject, $message, $headers);
                ?>

                <script type="text/javascript">
                    $(document).ready(function () {
                        swal({
                            title: "Good job!",
                            text: "Thanks for your comment.",
                            icon: "success",
                            buttons: true,
                        });
                    });
                </script>



                                                                                                        <!-- echo '<script>alert("You Have Successfully updated this Record!");</script>'; -->
                <?php
                $this->load->view('blog-details'); //insert
            } else {
                $this->load->view('blog-details'); //already inserted data
            }
        } else {
            $this->load->view('blog-details'); //check the data  
        }
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
                $this->load->view('blog');
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
                $this->load->view('blog');
            }
        } else {
            $this->load->view('blog');
        }
    }

}
?>
