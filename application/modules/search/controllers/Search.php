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
    public $page_count;
    function __construct() {
        parent::__construct();
        $this->output->set_template('simple');
        $this->load->library("pagination");
        $this->_init();
        $this->page_count = 12;
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


    public function search_school($search,$limit=null, $start=null){
        $session = $this->session->userdata();
        $where = "sd.is_active=1 AND sd.status=1 AND sd.valitity IS NOT NULL AND sd.deleted_at is NULL ";
        $this->db->select('sd.*,af.affiliation_name,ar.area_name');
        if(!empty($session['city_id']))
        $this->db->where('sd.city_id',$session['city_id']);
        $this->db->where($where);
        $this->db->like('sd.school_name',$search);
        $this->db->order_by('school_category_id');
        $this->db->from('school_details as sd');
        $this->db->join('affiliations as af','sd.affiliation_id=af.id','left');
        $this->db->join('areas as ar','sd.area_id=ar.id','left');
        $data["search"] = "Schools in " . ucfirst($session["search_city"]);
        if(!empty($limit)){
            $this->db->limit($limit, $start);
            $data['schools'] = $this->db->get()->result_array();
            return $data;
        }else{
            return $this->db->get()->num_rows();
        }
    }

    public function search_class($search,$limit=null, $start=null){
        $session = $this->session->userdata();
        $where = "ind.is_active=1 AND ind.status=1 AND ind.valitity IS NOT NULL AND ind.deleted_at is NULL ";
        $this->db->select('ind.*,ic.category_name,ar.area_name');
        if(!empty($session['city_id']))
        $this->db->where('ind.city_id',$session['city_id']);
        $this->db->where($where);
        $this->db->like('ind.institute_name',$_GET['search_class']);
        $this->db->order_by('position_id');
        $this->db->from('institute_details as ind');
        $this->db->join('institute_categories as ic','ind.category_id=ic.id','left');
        $this->db->join('areas as ar','ind.area_id=ar.id','left');
        // $data['activityclass'] = $this->db->get()->result_array();
        $data["search"] = "Activity Classes in " . ucfirst($session["search_city"]);
        if(!empty($limit)){
            $this->db->limit($limit, $start);
            $data['activityclass'] = $this->db->get()->result_array();
            return $data;
        }else{
            return $this->db->get()->num_rows();
        }
    }

    public function createPageinatation($count,$link){
        $config = array();
        if ($this->input->get('search')) $config['suffix'] = '?' . http_build_query($_GET, '', "&");
        $config["base_url"] = base_url() . $link;
        $config["total_rows"] = $count;
        $config["per_page"] = $this->page_count;
        $config["uri_segment"] = 2;
        $config['first_url'] = $config["base_url"].'?'.http_build_query($_GET);
        // $config['use_page_numbers'] = TRUE;
        $this->pagination->initialize($config);
        return $this->pagination->create_links();
    }


    public function index() {
        if(!empty($_GET['searchcity'])){
            $this->db->select('*');
            $this->db->where('city_name',ucfirst($_GET['searchcity']));
            $this->db->from('cities');
            $cityid = $this->db->get()->result_array();
            $this->session->set_userdata('search_city',$_GET['searchcity']);
            $this->session->set_userdata('city_id',$cityid[0]['id']);
        }
        $school = $_GET['search']; // school search 
        $activityclass = $_GET['search_class']; // activity class search 
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
        // if (!empty($session["city_id"])) {
        //     $sub_where[] = array('direct' => 0, 'rule' => 'where', 'field' => 'sd.city_id', 'value' => $session["city_id"]);
        // }
        // $data['schools'] = $this->Base_Model->getAdvanceList('school_details sd ', $join_tables, $fields, $sub_where, array('return' => 'result_array'), 'sd.id', '', '', 6);
        if(isset($_GET['search'])){
            $data["links"] = $this->createPageinatation($this->search_school($_GET['search']),'schools-list');
            $page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
            $data1 = $this->search_school($_GET['search'],$this->page_count, $page);
            $data['schools'] =  $data1['schools'];
            $data['search'] =  $data1['search'];
        }
        if(isset($_GET['search_class'])){
            $data["links"] = $this->createPageinatation($this->search_class($_GET['search_class']),'schools-list');
            $page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
            $data1 = $this->search_class($_GET['search_class'],$this->page_count, $page);

            $data['activityclass'] =  $data1['activityclass'];
            $data['search'] =  $data1['search'];
        }
        $data['searchcity'] = $session['search_city'];
        $data["affiliations"] = $this->Base_Model->get_records("affiliations", "*", array(array(true, "is_active", 1)), "result");
        $data["institute_categories"] = $this->Base_Model->get_records("institute_categories", "*", array(), "result");


        $this->db->select('*')->where('is_active =', 1);
        $this->db->order_by("city_name", "asc");
        $this->db->from('cities');
        $data['allcity'] = $this->db->get()->result();

        $this->load->view('search-list', $data);
    }

}
