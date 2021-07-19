<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Search extends CI_Controller {

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
        $data = array("search" => "");
        $session = $this->session->userdata();
        $data["city"] = $session["search_city"];
        $fields = 'sd.*,af.affiliation_name,a.area_name';
        $join_tables[] = array(
            'table_name' => 'affiliations  af ',
            'table_condition' => 'af.id = sd.affiliation_id',
            'table_type' => 'left'
        );
        $join_tables[] = array(
            'table_name' => 'areas  a',
            'table_condition' => 'a.id = sd.area_id',
            'table_type' => 'left'
        );
        if (!empty($session["city_id"])) {
            $sub_where[] = array('direct' => 0, 'rule' => 'where', 'field' => 'sd.city_id', 'value' => $session["city_id"]);
        }
        $data['schools'] = $this->Base_Model->getAdvanceList('school_details sd ', $join_tables, $fields, $sub_where, array('return' => 'result_array'), 'sd.id', '', '', 6);

        $data["affiliations"] = $this->Base_Model->get_records("affiliations", "*", array(array(true, "is_active", 1)), "result");
        $data["institute_categories"] = $this->Base_Model->get_records("institute_categories", "*", array(), "result");

        $data["search"] = "Schools in " . ucfirst($session["search_city"]);


        $this->load->view('search-list', $data);
    }

}
