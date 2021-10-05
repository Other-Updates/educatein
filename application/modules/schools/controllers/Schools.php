<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Schools extends CI_Controller {

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
        $this->load->library("pagination");

        $this->_init();
    }

    private function _init() {
        $this->load->css(base_url('assets/front/css/owl.carousel.min.css'));
        $this->load->css(base_url('assets/front/css/lightbox.css'));
        $this->load->css('https://fonts.googleapis.com/css?family=Luckiest+Guy&display=swap');     
        $this->load->js(base_url('assets/front/js/wow.min.js'));
        $this->load->js(base_url('assets/front/js/owl.carousel.min.js')); 
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
//        $data["city"] = $session["search_city"];
//        $fields  = 'sd.*,af.affiliation_name,a.area_name';
//        $join_tables[] = array(
//            'table_name' => 'affiliations  af ',
//            'table_condition' => 'af.id = sd.affiliation_id',
//            'table_type' => 'left'
//        );
//        $join_tables[] = array(
//            'table_name' => 'areas  a',
//            'table_condition' => 'a.id = sd.area_id',
//            'table_type' => 'left'
//        );
//        if (!empty($session["city_id"])) {
//            $sub_where[] = array('direct' => 0, 'rule' => 'where', 'field' => 'sd.city_id', 'value' => $session["city_id"]);
//        }
//        $data['schools'] = $this->Base_Model->getAdvanceList('school_details sd ', $join_tables, $fields, $sub_where, array('return' => 'result_array'), 'sd.id', '', '', 6);
//
//        $data["affiliations"] = $this->Base_Model->get_records("affiliations", "*", array(array(true, "is_active", 1)), "result");
//        $data["institute_categories"] = $this->Base_Model->get_records("institute_categories", "*", array(), "result");
//
//        $data["search"] = "Schools in " . ucfirst($session["search_city"]);
        // $where2 = "is_active=1 AND status=1 AND activated_at != 'NULL' AND valitity != 'NULL' AND school_category_id=2 AND city_id =" . $this->session->userdata('city_id') . " AND deleted_at is NULL";
        // $this->db->select('*')->where($where2);
        // // $this->db->order_by('rand()');
        // $this->db->from('school_details');
        // $school_premium = $this->db->get();
        // $config = array();
        // $config["total_rows"] = $this->db->count_all_results();
        // $config["base_url"] = base_url() . "schools";
        // $config["per_page"] = 10;
        // $config["uri_segment"] = 2;

        // $this->pagination->initialize($config);

        // $page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;

        // $data["links"] = $this->pagination->create_links();

        $yourcity = array();
        $aff_url = $this->uri->segments[1];
        // print_r($aff_url);exit;
        $yourcity = explode("-", $aff_url);
        $yourcity = end($yourcity);
        $uccity = ucfirst($yourcity);
        $this->db->select('*');
        $this->db->where('city_name',$uccity);
        $this->db->from('cities');
        $cityid = $this->db->get()->result_array();
        $this->session->set_userdata('search_city',$yourcity);
        $this->session->set_userdata('city_id',$cityid[0]['id']);

        $this->db->select('*')->where('is_active =', 1);
        $this->db->from('affiliations');
        $query['query'] = $this->db->get();


        $this->db->select('sd.*,st.school_type');
        $this->db->order_by('sd.school_category_id');
        $this->db->join('school_types as st','sd.schooltype_id=st.id','left');
        // $this->db->order_by('rand()');
        $this->db->from('school_details as sd');
        $school_spectrum_count = $this->db->get()->num_rows();

        $query["links"] = $this->createPageinatation($school_spectrum_count,'schools-list');

        $this->load->view('schoollist', $query); 
    }

    
    public function createPageinatation($count,$link){
        $config = array();
        if ($this->input->get('search')) $config['suffix'] = '?' . http_build_query($_GET, '', "&");
        $config["base_url"] = base_url() . $link;
        $config["total_rows"] = $count;
        $config["per_page"] = 12;
        $config["uri_segment"] = 2;
        $config['first_url'] = $config["base_url"].'?'.http_build_query($_GET);
        // $config['use_page_numbers'] = TRUE;
        $this->pagination->initialize($config);
        return $this->pagination->create_links();
    }

}
