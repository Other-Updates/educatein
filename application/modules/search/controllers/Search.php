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
        $school = $_POST['search']; // school search 
        $activityclass = $_POST['activity_class']; // activity class search 
        $data = array("search" => "");
        $session = $this->session->userdata();
        // print_r($session['city_id']);
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
        // $data['schools'] = $this->Base_Model->getAdvanceList('school_details sd ', $join_tables, $fields, $sub_where, array('return' => 'result_array'), 'sd.id', '', '', 6);
        if(isset($_POST['search'])){
            $where = "sd.is_active=1 AND sd.status=1 AND sd.valitity IS NOT NULL AND sd.deleted_at is NULL ";
            $this->db->select('sd.*,af.affiliation_name,ar.area_name');
            if(!empty($session['city_id']))
            $this->db->where('sd.city_id',$session['city_id']);
            $this->db->where($where);
            $this->db->like('sd.school_name',$_POST['search']);
            $this->db->order_by('school_category_id');
            $this->db->from('school_details as sd');
            $this->db->join('affiliations as af','sd.affiliation_id=af.id','left');
            $this->db->join('areas as ar','sd.area_id=ar.id','left');
            $data['schools'] = $this->db->get()->result_array();
            $data["search"] = "Schools in " . ucfirst($session["search_city"]);
        }
        if(isset($_POST['activity_class'])){
            $where = "ind.is_active=1 AND ind.status=1 AND ind.valitity IS NOT NULL AND ind.deleted_at is NULL ";
            $this->db->select('ind.*,ic.category_name,ar.area_name');
            if(!empty($session['city_id']))
            $this->db->where('ind.city_id',$session['city_id']);
            $this->db->where($where);
            $this->db->like('ind.institute_name',$_POST['activity_class']);
            $this->db->order_by('position_id');
            $this->db->from('institute_details as ind');
            $this->db->join('institute_categories as ic','ind.category_id=ic.id','left');
            $this->db->join('areas as ar','ind.area_id=ar.id','left');
            $data['activityclass'] = $this->db->get()->result_array();
            $data["search"] = "Activity Classes in " . ucfirst($session["search_city"]);
        }

        $data["affiliations"] = $this->Base_Model->get_records("affiliations", "*", array(array(true, "is_active", 1)), "result");
        $data["institute_categories"] = $this->Base_Model->get_records("institute_categories", "*", array(), "result");


        $this->db->select('*')->where('is_active =', 1);
        $this->db->order_by("city_name", "asc");
        $this->db->from('cities');
        $data['allcity'] = $this->db->get()->result();

        $this->load->view('search-list', $data);
    }

}
