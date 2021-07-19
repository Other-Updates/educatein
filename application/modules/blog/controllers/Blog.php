<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Blog extends CI_Controller {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
      // * 		http://example.com/index.php/welcome
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
    }

    public function index() {
        
        $this->load->view('blog');

        // $this->load->library('pagination');	
        //       $this->db->select('*');
        //       $this->db->from('blogs');
        //       $blog = $this->db->get();
        //       $total_rows = $blog_comment->num_rows();
        // $config['total_rows'] = $total_rows;
        // $config['per_page'] = 5;
        // $config['base_url'] = base_url('blog/index');
    }

    public function insert() {
        $ip = $_SERVER['REMOTE_ADDR'];
        $blog_id = $this->input->post('blog_id');
        $ratings = $this->input->post('rating');
        //echo $blog_id;
        $this->db->select('*');
        $this->db->from('blog_like');
        $blog_like = $this->db->get();
        // foreach($blog_like->result() as $likes){
        //  $db_ip = $likes->user_id;
        //  $db_blog_id = $likes->blog_id;
        //  $db_id = $likes->id;
        //                       	if($db_ip==$ip && $db_blog_id == $blog_id){
        //                       		$ratings_dislike = 'Dislike';
        //                       		$data = array( 
        //    	'ratings'      => $ratings_dislike , 
        // );
        // $this->db->where('id', $db_id);
        // $this->db->update('blog_like', $data);
        //                       	}else{
        //                       		$data = array(
        // 	'blog_id' => $blog_id,
        // 	'user_id' => $ip,
        // 	'ratings' => $ratings,
        // );
        // $this->db->insert('blog_like',$data);
        //                      		}
        //                       }



        $like_test = 0;
        foreach ($blog_like->result() as $likes) {

            $db_ip = $likes->user_id;
            $db_blog_id = $likes->blog_id;

            if ($db_ip == $ip && $db_blog_id == $blog_id) {

                $like_test = 1;
            }
        }

        if ($like_test == 0) {

            $data = array(
                'blog_id' => $blog_id,
                'user_id' => $ip,
                'ratings' => $ratings,
            );
            $this->db->insert('blog_like', $data);

            echo $like_test;
        } else {

            echo $like_test;
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

// echo count($contact);
// exit();
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