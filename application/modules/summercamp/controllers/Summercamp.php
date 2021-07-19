<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Summercamp extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 // * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
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
        $this->load->css('assets/front/css/owl.carousel.min.css');
        $this->load->css('assets/front/css/styles1.css');
        $this->load->css('assets/front/css/jquery.fancybox.min.css');
        $this->load->css('assets/front/css/swiper.min.css');
        $this->load->js('assets/front/js/wow.min.js');
        $this->load->js('assets/front/js/owl.carousel.min.js');
        $this->load->js('assets/front/js/jquery.stickit.js');
        $this->load->js('assets/front/js/jquery.easeScroll.js');
        $this->load->js('assets/front/js/parallax.min.js');
        $this->load->js('assets/front/js/jquery.fancybox.min.js');
        $this->load->js('assets/front/js/Chart.js');
        $this->load->js('assets/front/js/dot-circle.js');
        $this->load->js('assets/front/js/swiper.min.js');
          
	<link rel="stylesheet" href="https://www.edugatein.com/css/styles1.css">
	<link rel="stylesheet" href="https://www.edugatein.com/css/responsive.css">
	<link rel="stylesheet" href="https://www.edugatein.com/css/owl.carousel.min.css">
	<link rel="stylesheet" href="https://www.edugatein.com/css/animate.css">
	<link rel="stylesheet" href="https://cdn.linearicons.com/free/1.0.0/icon-font.min.css">
	<link rel="stylesheet" href="https://www.edugatein.com/css/jquery.fancybox.min.css">
}
	public function index()
	{ 
		$this->load->view('summer-camp');

	}

	public function newsletter()
	{ 
		$data = array(
			'email' => $this->input->post('email'),
			);
			
			

		$email = $data['email'];




		if($email != " "){
		    

		   $where = "email = '$email'";

		   $this->db->select('*')->where($where);
		   $this->db->from('newletters');
		   $contact = $this->db->get()->result();
		   

		          if(count($contact) == 0){	
		              
					$this->db->insert('newletters',$data);
					
								?>

					<!-- Success-Alert -->
					<script type="text/javascript">
						$(document).ready(function(){
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
				  }else{

		?>

			        <!-- Success-Alert -->
			        <script type="text/javascript">
			            $(document).ready(function(){
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

		}else{
    		$this->load->view('welcome_message');  
  		}
  	}

}