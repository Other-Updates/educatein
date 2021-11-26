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
        $page_count = 12;

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
        $config["per_page"] = $this->page_count;
        $config["uri_segment"] = 2;
        $config['first_url'] = $config["base_url"].'?'.http_build_query($_GET);
        // $config['use_page_numbers'] = TRUE;
        $this->pagination->initialize($config);
        return $this->pagination->create_links();
    }

    public function get_schools(){
        // $limit = 12; 
        // $page = $limit * $_POST['page'];
        $page = $_POST['page'];
        $limit = $_POST['limit'];
        $where2 = "sd.is_active=1 AND sd.status=1 AND sd.activated_at != 'NULL' AND sd.valitity != 'NULL' AND (sd.school_category_id=4 OR sd.school_category_id=3) AND sd.expiry_status !=1 AND sd.affiliation_id=" . $_POST['affiliation'] . " AND sd.city_id =" . $_POST['yourcity_id'] . " AND sd.deleted_at is NULL";
                $this->db->select('sd.*,st.school_type')->where($where2);
                $this->db->order_by('sd.school_category_id');
                $this->db->join('school_types as st','sd.schooltype_id=st.id','left');
                $this->db->from('school_details as sd');
                $this->db->limit($page,$limit);
                $school_spectrum = $this->db->get()->result_array();
                // echo $this->db->last_query();
                echo json_encode($school_spectrum);
                exit;
    }

    public function post_free(){
        $this->load->view('post_free');
    }

    function email_exist(){
        $this->db->select('*')->where('email =', $_POST['usermail']);
        $this->db->from('user_register');
        $email = $this->db->get()->result();
        if (count($email) > 0) {
            echo json_encode(array('status' => 'error', "message" => array("text" => "Try using another contact info !!!", "title" => "User Already Exist")));
            exit;
        }else{
            echo json_encode(array('status' => 'success'));
            exit;
        }
    }

    public function admin_insert() {
        $data = array(
            'name' => $this->input->post('name') . " " . $this->input->post('lastname'),
            'email' => $this->input->post('useremail'),
            'phone' => $this->input->post('adminphone'),
            'password' => base64_encode($this->input->post('password')),
            'category' => $this->input->post('category'),
            'ip' => $this->input->post('ip'),
        );
        // print_r($data);exit;
        $this->db->select('*')->where('email =', $data['email']);
        $this->db->from('user_register');
        $email = $this->db->get()->result();

        if (count($email) == 0) {
            $this->db->insert('account_tracker', $data);
            $this->db->insert('user_register', $data);
            $user_id = $this->db->insert_id();
                $ip = $_SERVER['REMOTE_ADDR'];
                // $mobile = substr($this->input->post('phone'), -4);
                // echo json_encode(array('status' => 'success', 'data' => array("mobile" => $mobile,"contact_email" => $data['email'],"user_id" => $user_id)));
                // die;
            // } else {
            //     echo json_encode(array('status' => 'error', "message" => array("text" => "Try using another contact info !!!", "title" => "User Already Exist")));
            //     die;
            //     $this->load->view('sign-up-school', $data);
            // }
        }
        //insert school
        if($_POST['category'] == 'schoolid'){
            $school['schoolname'] = $_POST['schoolname'];
            $school['schoolboard'] = $_POST['schoolboard'];
            $school['city'] = $_POST['school_city'];

            $this->db->select('*')->where('affiliation_name =', $school['schoolboard']);
            $this->db->from('affiliations');
            $schoolboardarray = $this->db->get();

            foreach ($schoolboardarray->result() as $schoolboards) {
                $schoolboard_id = $schoolboards->id;
            }

            $this->db->select('*')->where('city_name =', $school['city']);
            $this->db->from('cities');
            $yourcityarray = $this->db->get();


            if ($yourcityarray->num_rows() > 0) {
                foreach ($yourcityarray->result() as $yourcitys) {
                    $yourcity_id = $yourcitys->id;
                }
            } else {
                $cityinsert = array(
                    'city_name' => $school['city'],
                    'slug' => $school['city'],
                    'state_id' => 2,
                    'is_active' => 1
                );
                $this->db->insert('cities', $cityinsert);

                $this->db->select('*')->where('city_name =', $school['city']);
                $this->db->from('cities');
                $yourcityarray = $this->db->get();
                foreach ($yourcityarray->result() as $yourcitys) {
                    $yourcity_id = $yourcitys->id;
                }
            }

            $school['area'] = $_POST['school_area'];

            $this->db->select('*')->where('area_name =', $school['area']);
            $this->db->from('areas');
            $area = $this->db->get();


            if ($area->num_rows() > 0) {
                foreach ($area->result() as $areas) {
                    $area_id = $areas->id;
                    //exit();
                }
            } else {
                $areainsert = array(
                    'area_name' => $school['area'],
                    'slug' => $school['area'],
                    'city_id' => $yourcity_id,
                    'is_active' => 1
                );
                $this->db->insert('areas', $areainsert);

                $this->db->select('*')->where('area_name =', $school['area']);
                $this->db->from('areas');
                $area = $this->db->get();
                foreach ($area->result() as $areas) {
                    $area_id = $areas->id;
                    //exit();
                }
            }

            if (isset($_POST['level'])) {
                $school['level'] = $_POST['level'];

                $this->db->select('*')->where('school_type =', $_POST['level']);
                $this->db->from('school_types');
                $level = $this->db->get();
                foreach ($level->result() as $levels) {
                    $level_id = $levels->id;
                }
            } else {
                $level_id = NULL;
            }

            $school['ad'] = $_POST['ad'];
            // $school['customRadio1'] = $_POST['customRadio1'];
            // $school['customRadio2'] = $_POST['customRadio2'];


            $school['founded'] = $_POST['school_founded'];
            $school['students'] = $_POST['school_students'];
            $school['teachers'] = $_POST['school_teachers'];

            $school['about'] = $_POST['about'];
            $school['activity1'] = $_POST['activity1'];
            $school['activity2'] = $_POST['activity2'];
            $school['activity3'] = $_POST['activity3'];
            $school['activity4'] = $_POST['activity4'];
            $school['facility1'] = $_POST['facility1'];
            $school['facility2'] = $_POST['facility2'];
            $school['facility3'] = $_POST['facility3'];
            $school['facility4'] = $_POST['facility4'];
            $school['facilitydes1'] = $_POST['facilitydes1'];
            $school['facilitydes2'] = $_POST['facilitydes2'];
            $school['facilitydes3'] = $_POST['facilitydes3'];
            $school['facilitydes4'] = $_POST['facilitydes4'];
            $school['phone'] = $_POST['school_phone'];
            $school['email'] = $_POST['school_email'];
            $school['website'] = $_POST['school_website'];
            $school['address'] = $_POST['school_address'];
            $school['facebook'] = $_POST['facebook'];
            $school['twitter'] = $_POST['twitter'];
            $school['instagram'] = $_POST['instagram'];
            $school['linkedin'] = $_POST['linkedin'];
            $school['pinterest'] = $_POST['pinterest'];
            // echo $school['students'];
            // echo "<br>";
            // echo $school['teachers'];
            // exit(); 

            // $banner1 = $_FILES['school_banner1']['name'];
            // $banner1_ext = pathinfo($banner1, PATHINFO_EXTENSION);
            // // echo $banner1_ext;
            // // exit();
            // $banner1_name = $_POST['schoolname'] . "-" . rand(10000, 10000000) . "." . $banner1_ext;
            // $banner1_type = $_FILES['school_banner1']['type'];
            // $banner1_size = $_FILES['school_banner1']['size'];
            // $banner1_tem_loc = $_FILES['school_banner1']['tmp_name'];
            // $banner1_store = FCPATH . "/laravel/public/" . $banner1_name;
            // $allowed = array('gif', 'png', 'jpg', 'jpeg');

            // if (in_array($banner1_ext, $allowed)) {

            //     if (move_uploaded_file($banner1_tem_loc, $banner1_store)) {
                    
            //     }
            // }

            if($_POST['school_category'] == 1){
                $paid = 65000;
                $validity = 100;
            }else if($_POST['school_category'] == 2){
                $paid = 30000;
                $validity = 100;
            }else if($_POST['school_category'] == 3){
                $paid = 12000;
                $validity = 100;
            }else if($_POST['school_category'] == 4){
                $paid = 0;
                $validity = 30;
            }


            if (isset($_POST['customRadio2'])) {
                $customRadio1 = $_POST['customRadio2'];
            } else {
                $customRadio1 = NULL;
            }

            if (isset($_POST['customRadio1'])) {
                $customRadio = $_POST['customRadio1'];
            } else {
                $customRadio = NULL;
            }
            if($_POST['school_status'] == 1){
                $status = 1;
                $act_date = date('Y-m-d H:i:s');
            }
            if($_POST['school_status'] == 0){
                $status = null;
                $act_date = null;
            }
            $schoolinsert = array(
                'school_name' => $school['schoolname'],
                'slug' => $school['schoolname'],
                'mobile' => $school['phone'],
                'email' => $school['email'],
                'address' => $school['address'],
                'user_id' => $user_id,
                'city_id' => $yourcity_id,
                'area_id' => $area_id,
                'pincode' => $_POST['pincode'],
                'affiliation_id' => $schoolboard_id,
                'schooltype_id' => $level_id,
                'school_category_id' => 4,
                'status' => $status,
                'about' => $school['about'],
                'website_url' => $_POST['school_website'],
                'our_mission' => $_POST['our_mission'],
                'our_vision' => $_POST['our_vision'],
                'our_motto' => $_POST['our_motto'],
                'boys' => $_POST['boys'],
                'girls' => $_POST['girls'],
                'map_url' => $_POST['school_map_url'],
                'year_of_establish' => $_POST['school_founded'],
                'ad' => $school['ad'],
                // 'type'=>$school['address'],
                'hostel' => $customRadio1,
                'rte' => $customRadio,
                'paid' => 0,
                'students' => $school['school_students'],
                'teachers' => $school['school_teachers'],
                'facebook' => $school['facebook'],
                'twitter' => $school['twitter'],
                'instagram' => $school['instagram'],
                'linkedin' => $school['linkedin'],
                'pinterest' => $school['pinterest'],
                'logo' => $banner1_name,
                'activated_at' => $act_date,
                'is_active' => 1,
                'valitity' => 30,
            );
            $this->db->insert('school_details', $schoolinsert);

            $this->db->select('*')->where('slug =', $school['schoolname']);
            $this->db->from('school_details');
            $schooldetail = $this->db->get();
            foreach ($schooldetail->result() as $schooldetails) {
                $school_id = $schooldetails->id;
            }


            //platinum data save
            if (!empty($_POST['school_founded'])) {
                $foundedinsert = array(
                    'school_id' => $school_id,
                    'icon' => 'founded.png',
                    'heading' => 'Founded',
                    'content' => $_POST['school_founded'],
                    'brief_content' => $_POST['school_founded'],
                    'is_active' => 1
                );
                $this->db->insert('platinum_datas', $foundedinsert);
            }

            if (!empty($_POST['school_special'])) {
                $specialinsert = array(
                    'school_id' => $school_id,
                    'icon' => 'special.png',
                    'heading' => 'Special',
                    'content' => $_POST['school_special'],
                    'brief_content' => $_POST['school_special'],
                    'is_active' => 1
                );
                $this->db->insert('platinum_datas', $specialinsert);
            }

            if (!empty($_POST['school_students'])) {
                $studentsinsert = array(
                    'school_id' => $school_id,
                    'icon' => 'students.png',
                    'heading' => 'Students',
                    'content' => $_POST['school_students'],
                    'brief_content' => $_POST['school_students'],
                    'is_active' => 1
                );
                $this->db->insert('platinum_datas', $studentsinsert);
            }

            if (!empty($_POST['school_events'])) {
                $eventsinsert = array(
                    'school_id' => $school_id,
                    'icon' => 'Events.png',
                    'heading' => 'Events',
                    'content' => $_POST['school_events'],
                    'brief_content' => $_POST['school_events'],
                    'is_active' => 1
                );
                $this->db->insert('platinum_datas', $eventsinsert);
            }

            if (!empty($_POST['school_achievements'])) {
                $achievementsinsert = array(
                    'school_id' => $school_id,
                    'icon' => 'achievements.png',
                    'heading' => 'Achievements',
                    'content' => $_POST['school_achievements'],
                    'brief_content' => $_POST['school_achievements'],
                    'is_active' => 1
                );
                $this->db->insert('platinum_datas', $achievementsinsert);
            }

            if (!empty($_POST['school_teachers'])) {
                $teachersinsert = array(
                    'school_id' => $school_id,
                    'icon' => 'teachers.png',
                    'heading' => 'Teachers',
                    'content' => $_POST['school_teachers'],
                    'brief_content' => $_POST['school_teachers'],
                    'is_active' => 1
                );
                $this->db->insert('platinum_datas', $teachersinsert);
            }

            if (!empty($_POST['school_branches'])) {
                $branchesinsert = array(
                    'school_id' => $school_id,
                    'icon' => 'branch.png',
                    'heading' => 'Branches',
                    'content' => $_POST['school_branches'],
                    'brief_content' => $_POST['school_branches'],
                    'is_active' => 1
                );
                $this->db->insert('platinum_datas', $branchesinsert);
            }

            if (!empty($_POST['school_academic'])) {
                $academicinsert = array(
                    'school_id' => $school_id,
                    'icon' => 'history.png',
                    'heading' => 'Academic',
                    'content' => $_POST['school_academic'],
                    'brief_content' => $_POST['school_academic'],
                    'is_active' => 1
                );
                $this->db->insert('platinum_datas', $academicinsert);
            }

            if (!empty($_POST['school_language'])) {
                $languageinsert = array(
                    'school_id' => $school_id,
                    'icon' => 'language.png',
                    'heading' => 'Language',
                    'content' => $_POST['school_language'],
                    'brief_content' => $_POST['school_language'],
                    'is_active' => 1
                );
                $this->db->insert('platinum_datas', $languageinsert);
            }

            if (!empty($_POST['activity_school'])) {
                $activityinsert = array(
                    'school_id' => $school_id,
                    'icon' => 'activity.png',
                    'heading' => 'activity',
                    'content' => $_POST['activity_school'],
                    'brief_content' => $_POST['activity_school'],
                    'is_active' => 1
                );
                $this->db->insert('platinum_datas', $activityinsert);
            }


            // schoolmanagement activities 

            if (isset($_POST['playground'])) {
                $playgroundinsert = array(
                    'schooldetails_id' => $school_id,
                    'activity_name' => 'playground',
                    'content' => 'The playgrounds must be spacious and outdoors, but they must also be secluded so that the children (and their parents) feel safe and do not have to consider the outside world.',
                    'icon' => 'fa fa-soccer-ball-o',
                    'is_active' => 1
                );
                $this->db->insert('schoolmanagement_activities', $playgroundinsert);
            }

            if (isset($_POST['kidsplay'])) {
                $kidsplayinsert = array(
                    'schooldetails_id' => $school_id,
                    'activity_name' => 'kidsplay',
                    'content' => 'We have provisions for both indoor and outdoor play areas. There are anti-slip flooring, age-appropriate toys, portable naptime cots, and attractive wall graphics.',
                    'icon' => 'fa fa-puzzle-piece',
                    'is_active' => 1
                );
                $this->db->insert('schoolmanagement_activities', $kidsplayinsert);
            }

            if (isset($_POST['transport'])) {
                $transportinsert = array(
                    'schooldetails_id' => $school_id,
                    'activity_name' => 'transport',
                    'content' => 'The school operates buses and vans and pick up children from various points in the city.',
                    'icon' => 'fa fa-bus',
                    'is_active' => 1
                );
                $this->db->insert('schoolmanagement_activities', $transportinsert);
            }

            if (isset($_POST['curriculam'])) {
                $curriculaminsert = array(
                    'schooldetails_id' => $school_id,
                    'activity_name' => 'curriculam',
                    'content' => 'The school strives to equip students to think logically and act sensibly, to develop strong sensibility and responsibility towards Self and to the Society.',
                    'icon' => 'fa fa-bookmark',
                    'is_active' => 1
                );
                $this->db->insert('schoolmanagement_activities', $curriculaminsert);
            }

            if (isset($_POST['fieldtrips'])) {
                $fieldtripsinsert = array(
                    'schooldetails_id' => $school_id,
                    'activity_name' => 'fieldtrips',
                    'content' => 'Experience is the best teacher and learning to take care of oneself , and one’s own belongings independently, without parental supervision , helps the children to become self sufficient.',
                    'icon' => 'fa fa-bicycle',
                    'is_active' => 1
                );
                $this->db->insert('schoolmanagement_activities', $fieldtripsinsert);
            }

            if (isset($_POST['specialactivity'])) {
                $specialinsert = array(
                    'schooldetails_id' => $school_id,
                    'activity_name' => 'special activity',
                    'content' => 'We also conduct several activities wherein the children get to shape their newly developing skills such as cooperating, understanding, compassion and care for them as well as for those that are around them. Join us today!',
                    'icon' => 'fa fa-female',
                    'is_active' => 1
                );
                $this->db->insert('schoolmanagement_activities', $specialinsert);
            }

            if (isset($_POST['progressive'])) {
                $progressiveinsert = array(
                    'schooldetails_id' => $school_id,
                    'activity_name' => 'progressive',
                    'content' => 'Progressive education is a response to traditional methods of teaching. It is defined as an educational movement which gives more value to experience than formal learning.',
                    'icon' => 'fa fa-book',
                    'is_active' => 1
                );
                $this->db->insert('schoolmanagement_activities', $progressiveinsert);
            }

            if (isset($_POST['opportunities'])) {
                $opportunitiesinsert = array(
                    'schooldetails_id' => $school_id,
                    'activity_name' => 'opportunities',
                    'content' => 'Students are encouraged to work in groups. Collaborating allows students to talk to each other and listen to all view points of discussion or assignment.',
                    'icon' => 'fa fa-superpowers',
                    'is_active' => 1
                );
                $this->db->insert('schoolmanagement_activities', $opportunitiesinsert);
            }

            if (isset($_POST['clubs'])) {
                $clubsinsert = array(
                    'schooldetails_id' => $school_id,
                    'activity_name' => 'clubs',
                    'content' => 'The activities of these various clubs will take place on Saturdays (Whenever it is a working day) in the Regular School Time.',
                    'icon' => 'fa fa-child',
                    'is_active' => 1
                );
                $this->db->insert('schoolmanagement_activities', $clubsinsert);
            }

            if (isset($_POST['infrastructure'])) {
                $infrastructureinsert = array(
                    'schooldetails_id' => $school_id,
                    'activity_name' => 'infrastructure',
                    'content' => 'The school lays a strong foundation for the languages and technical subjects through applied linguistic skills, hands on practical and project work throughout the curriculum.',
                    'icon' => 'fa fa-home',
                    'is_active' => 1
                );
                $this->db->insert('schoolmanagement_activities', $infrastructureinsert);
            }






            // banner1 image save
            if (isset($_FILES['school_banner1']['name'])) {
                $banner1 = $_FILES['banner1']['name'];
                $banner1_ext = pathinfo($banner1, PATHINFO_EXTENSION);
                $banner1_name = $school['schoolname'] . "-" . rand(10000, 10000000) . "." . $banner1_ext;
                $banner1_type = $_FILES['school_banner1']['type'];
                $banner1_size = $_FILES['school_banner1']['size'];
                $banner1_tem_loc = $_FILES['school_banner1']['tmp_name'];
                $banner1_store = FCPATH . "/laravel/public/" . $banner1_name;

                $allowed = array('gif', 'png', 'jpg', 'jpeg');

                if (in_array($banner1_ext, $allowed)) {

                    if (move_uploaded_file($banner1_tem_loc, $banner1_store)) {

                        $banner1insert = array(
                            'school_id' => $school_id,
                            'school_activity_id' => 2,
                            'images' => $banner1_name,
                            'is_active' => 1
                        );

                        $this->db->insert('school_images', $banner1insert);
                    }
                }
            }
            $logo = array(
                'logo' => $banner1_name,
            );
            $this->db->update('school_details',$logo,array('id' => $school_id));

            if (isset($_FILES['school_banner2']['name'])) {
                $banner2 = $_FILES['banner2']['name'];
                $banner2_ext = pathinfo($banner2, PATHINFO_EXTENSION);

                $banner2_name = $school['schoolname'] . "-" . rand(10000, 10000000) . "." . $banner2_ext;
                $banner2_type = $_FILES['school_banner2']['type'];
                $banner2_size = $_FILES['school_banner2']['size'];
                $banner2_tem_loc = $_FILES['school_banner2']['tmp_name'];
                $banner2_store = FCPATH . "/laravel/public/" . $banner2_name;

                $allowed = array('gif', 'png', 'jpg', 'jpeg');
                if (in_array($banner2_ext, $allowed)) {
                    if (move_uploaded_file($banner2_tem_loc, $banner2_store)) {
                        $banner2insert = array(
                            'school_id' => $school_id,
                            'school_activity_id' => 169,
                            'images' => $banner2_name,
                            'is_active' => 1
                        );

                        $this->db->insert('school_images', $banner2insert);
                    }
                }
            }

            // banner3 image save
            if (isset($_FILES['school_banner3']['name'])) {
                $banner3 = $_FILES['banner3']['name'];
                $banner3_ext = pathinfo($banner3, PATHINFO_EXTENSION);

                $banner3_name = $school['schoolname'] . "-" . rand(10000, 10000000) . "." . $banner3_ext;
                $banner3_type = $_FILES['school_banner3']['type'];
                $banner3_size = $_FILES['school_banner3']['size'];
                $banner3_tem_loc = $_FILES['school_banner3']['tmp_name'];
                $banner3_store = FCPATH . "/laravel/public/" . $banner3_name;

                $allowed = array('gif', 'png', 'jpg', 'jpeg');
                if (in_array($banner3_ext, $allowed)) {
                    if (move_uploaded_file($banner3_tem_loc, $banner3_store)) {
                        $banner3insert = array(
                            'school_id' => $school_id,
                            'school_activity_id' => 170,
                            'images' => $banner3_name,
                            'is_active' => 1
                        );

                        $this->db->insert('school_images', $banner3insert);
                    }
                }
            }

            // aboutimg1 image save
            if (!empty($_FILES['aboutimg1']['name'])) {
                $aboutimg1 = $_FILES['aboutimg1']['name'];
                $aboutimg1_ext = pathinfo($aboutimg1, PATHINFO_EXTENSION);

                $aboutimg1_name = $school['schoolname'] . "-" . rand(10000, 10000000) . "." . $aboutimg1_ext;
                $aboutimg1_type = $_FILES['aboutimg1']['type'];
                $aboutimg1_size = $_FILES['aboutimg1']['size'];
                $aboutimg1_tem_loc = $_FILES['aboutimg1']['tmp_name'];
                $aboutimg1_store = FCPATH . "/laravel/public/" . $aboutimg1_name;

                $allowed = array('gif', 'png', 'jpg', 'jpeg');
                if (in_array($aboutimg1_ext, $allowed)) {
                    if (move_uploaded_file($aboutimg1_tem_loc, $aboutimg1_store)) {
                        $aboutimg1insert = array(
                            'school_id' => $school_id,
                            'school_activity_id' => 1,
                            'images' => $aboutimg1_name,
                            'is_active' => 1
                        );

                        $this->db->insert('school_images', $aboutimg1insert);
                    }
                }
            }

            // aboutimg2 image save
            if (isset($_FILES['aboutimg2']['name'])) {
                $aboutimg2 = $_FILES['aboutimg2']['name'];
                $aboutimg2_ext = pathinfo($aboutimg2, PATHINFO_EXTENSION);

                $aboutimg2_name = $school['schoolname'] . "-" . rand(10000, 10000000) . "." . $aboutimg2_ext;
                $aboutimg2_type = $_FILES['aboutimg2']['type'];
                $aboutimg2_size = $_FILES['aboutimg2']['size'];
                $aboutimg2_tem_loc = $_FILES['aboutimg2']['tmp_name'];
                $aboutimg2_store = FCPATH . "/laravel/public/" . $aboutimg2_name;

                $allowed = array('gif', 'png', 'jpg', 'jpeg');
                if (in_array($aboutimg2_ext, $allowed)) {
                    if (move_uploaded_file($aboutimg2_tem_loc, $aboutimg2_store)) {
                        $aboutimg2insert = array(
                            'school_id' => $school_id,
                            'school_activity_id' => 1,
                            'images' => $aboutimg2_name,
                            'is_active' => 1
                        );

                        $this->db->insert('school_images', $aboutimg2insert);
                    }
                }
            }

            // activityimage1 image save
            if (isset($_FILES['activityimage1']['name'])) {
                $activity1 = $_FILES['activityimage1']['name'];
                $activity1_ext = pathinfo($activity1, PATHINFO_EXTENSION);

                $activity1_name = $school['schoolname'] . "-" . rand(10000, 10000000) . "." . $activity1_ext;
                $activity1_type = $_FILES['activityimage1']['type'];
                $activity1_size = $_FILES['activityimage1']['size'];
                $activity1_tem_loc = $_FILES['activityimage1']['tmp_name'];
                $activity1_store = FCPATH . "/laravel/public/" . $activity1_name;

                $allowed = array('gif', 'png', 'jpg', 'jpeg');

                if (in_array($activity1_ext, $allowed)) {
                    if (move_uploaded_file($activity1_tem_loc, $activity1_store)) {

                        $this->db->select('*')->where('activity_name =', $_POST['activity1']);
                        $this->db->from('school_activities');
                        $schoolactivity1 = $this->db->get();

                        if ($schoolactivity1->num_rows() > 0) {
                            foreach ($schoolactivity1->result() as $schoolactivitys1) {
                                $schoolactivity_id1 = $schoolactivitys1->id;
                            }
                        } else {
                            $schoolactivityinsert1 = array(
                                'activity_name' => $_POST['activity1']
                            );

                            $this->db->insert('school_activities', $schoolactivityinsert1);

                            $this->db->select('*')->where('activity_name =', $_POST['activity1']);
                            $this->db->from('school_activities');
                            $schoolactivity1 = $this->db->get();

                            foreach ($schoolactivity1->result() as $schoolactivitys1) {
                                $schoolactivity_id1 = $schoolactivitys1->id;
                            }
                        }

                        $schoolactivityinsert1 = array(
                            'school_id' => $school_id,
                            'school_activity_id' => $schoolactivity_id1,
                            'images' => $activity1_name,
                            'is_active' => 1
                        );

                        $this->db->insert('school_images', $schoolactivityinsert1);
                    }
                }
            }

            // activity2 image save
            if (isset($_FILES['activityimage2']['name'])) {
                $activity2 = $_FILES['activityimage2']['name'];
                $activity2_ext = pathinfo($activity2, PATHINFO_EXTENSION);

                $activity2_name = $school['schoolname'] . "-" . rand(10000, 10000000) . "." . $activity2_ext;
                $activity2_type = $_FILES['activityimage2']['type'];
                $activity2_size = $_FILES['activityimage2']['size'];
                $activity2_tem_loc = $_FILES['activityimage2']['tmp_name'];
                $activity2_store = FCPATH . "/laravel/public/" . $activity2_name;

                $allowed = array('gif', 'png', 'jpg', 'jpeg');
                if (in_array($activity2_ext, $allowed)) {
                    if (move_uploaded_file($activity2_tem_loc, $activity2_store)) {
                        $this->db->select('*')->where('activity_name =', $_POST['activity2']);
                        $this->db->from('school_activities');
                        $schoolactivity2 = $this->db->get();

                        if ($schoolactivity2->num_rows() > 0) {
                            foreach ($schoolactivity2->result() as $schoolactivitys2) {
                                $schoolactivity_id2 = $schoolactivitys2->id;
                            }
                        } else {
                            $schoolactivityinsert2 = array(
                                'activity_name' => $_POST['activity2']
                            );

                            $this->db->insert('school_activities', $schoolactivityinsert2);

                            $this->db->select('*')->where('activity_name =', $_POST['activity2']);
                            $this->db->from('school_activities');
                            $schoolactivity2 = $this->db->get();

                            foreach ($schoolactivity2->result() as $schoolactivitys2) {
                                $schoolactivity_id2 = $schoolactivitys2->id;
                            }
                        }

                        $schoolactivityinsert2 = array(
                            'school_id' => $school_id,
                            'school_activity_id' => $schoolactivity_id2,
                            'images' => $activity2_name,
                            'is_active' => 1
                        );

                        $this->db->insert('school_images', $schoolactivityinsert2);
                    }
                }
            }

            // activity3 image save
            if (isset($_FILES['activityimage3']['name'])) {
                $activity3 = $_FILES['activityimage3']['name'];
                $activity3_ext = pathinfo($activity3, PATHINFO_EXTENSION);

                $activity3_name = $school['schoolname'] . "-" . rand(10000, 10000000) . "." . $activity3_ext;
                $activity3_type = $_FILES['activityimage3']['type'];
                $activity3_size = $_FILES['activityimage3']['size'];
                $activity3_tem_loc = $_FILES['activityimage3']['tmp_name'];
                $activity3_store = FCPATH . "/laravel/public/" . $activity3_name;

                $allowed = array('gif', 'png', 'jpg', 'jpeg');
                if (in_array($activity3_ext, $allowed)) {
                    if (move_uploaded_file($activity3_tem_loc, $activity3_store)) {
                        $this->db->select('*')->where('activity_name =', $_POST['activity3']);
                        $this->db->from('school_activities');
                        $schoolactivity3 = $this->db->get();

                        if ($schoolactivity3->num_rows() > 0) {
                            foreach ($schoolactivity3->result() as $schoolactivitys3) {
                                $schoolactivity_id3 = $schoolactivitys3->id;
                            }
                        } else {
                            $schoolactivityinsert3 = array(
                                'activity_name' => $school['activity3']
                            );

                            $this->db->insert('school_activities', $schoolactivityinsert3);

                            $this->db->select('*')->where('activity_name =', $_POST['activity3']);
                            $this->db->from('school_activities');
                            $schoolactivity3 = $this->db->get();

                            foreach ($schoolactivity3->result() as $schoolactivitys3) {
                                $schoolactivity_id3 = $schoolactivitys3->id;
                            }
                        }

                        $schoolactivityinsert3 = array(
                            'school_id' => $school_id,
                            'school_activity_id' => $schoolactivity_id3,
                            'images' => $activity3_name,
                            'is_active' => 1
                        );

                        $this->db->insert('school_images', $schoolactivityinsert3);
                    }
                }
            }

            // activity4 image save
            if (isset($_FILES['activityimage4']['name'])) {
                $activity4 = $_FILES['activityimage4']['name'];
                $activity4_ext = pathinfo($activity4, PATHINFO_EXTENSION);

                $activity4_name = $school['schoolname'] . "-" . rand(10000, 10000000) . "." . $activity4_ext;
                $activity4_type = $_FILES['activityimage4']['type'];
                $activity4_size = $_FILES['activityimage4']['size'];
                $activity4_tem_loc = $_FILES['activityimage4']['tmp_name'];
                $activity4_store = FCPATH . "/laravel/public/" . $activity4_name;

                $allowed = array('gif', 'png', 'jpg', 'jpeg');
                if (in_array($activity4_ext, $allowed)) {
                    if (move_uploaded_file($activity4_tem_loc, $activity4_store)) {
                        $this->db->select('*')->where('activity_name =', $_POST['activity4']);
                        $this->db->from('school_activities');
                        $schoolactivity4 = $this->db->get();

                        if ($schoolactivity4->num_rows() > 0) {
                            foreach ($schoolactivity4->result() as $schoolactivitys4) {
                                $schoolactivity_id4 = $schoolactivitys4->id;
                            }
                        } else {
                            $schoolactivityinsert4 = array(
                                'activity_name' => $school['activity4']
                            );

                            $this->db->insert('school_activities', $schoolactivityinsert4);

                            $this->db->select('*')->where('activity_name =', $_POST['activity4']);
                            $this->db->from('school_activities');
                            $schoolactivity4 = $this->db->get();

                            foreach ($schoolactivity4->result() as $schoolactivitys4) {
                                $schoolactivity_id4 = $schoolactivitys4->id;
                            }
                        }

                        $schoolactivityinsert4 = array(
                            'school_id' => $school_id,
                            'school_activity_id' => $schoolactivity_id4,
                            'images' => $activity4_name,
                            'is_active' => 1
                        );

                        $this->db->insert('school_images', $schoolactivityinsert4);
                    }
                }
            }

            // facility1 image save
            if (isset($_FILES['facilityimage1']['name'])) {
                $facility1 = $_FILES['facilityimage1']['name'];
                $facility1_ext = pathinfo($facility1, PATHINFO_EXTENSION);

                $facility1_name = $school['schoolname'] . "-" . rand(10000, 10000000) . "." . $facility1_ext;
                $facility1_type = $_FILES['facilityimage1']['type'];
                $facility1_size = $_FILES['facilityimage1']['size'];
                $facility1_tem_loc = $_FILES['facilityimage1']['tmp_name'];
                $facility1_store = FCPATH . "/laravel/public/" . $facility1_name;

                $allowed = array('gif', 'png', 'jpg', 'jpeg', 'GIF', 'PNG', 'JPG', 'JPEG');
                if (in_array($facility1_ext, $allowed)) {
                    if (move_uploaded_file($facility1_tem_loc, $facility1_store)) {
                        $schoolfaciltyinsert1 = array(
                            'school_id' => $school_id,
                            'facility' => $school['facility1'],
                            'content' => $school['facilitydes1'],
                            'image' => $facility1_name,
                            'is_active' => 1
                        );
                        $this->db->insert('school_facilities', $schoolfaciltyinsert1);
                    }
                }
            }

            // facility2 image save
            if (isset($_FILES['facilityimage2']['name'])) {
                $facility2 = $_FILES['facilityimage2']['name'];
                $facility2_ext = pathinfo($facility2, PATHINFO_EXTENSION);

                $facility2_name = $school['schoolname'] . "-" . rand(10000, 10000000) . "." . $facility2_ext;
                $facility2_type = $_FILES['facilityimage2']['type'];
                $facility2_size = $_FILES['facilityimage2']['size'];
                $facility2_tem_loc = $_FILES['facilityimage2']['tmp_name'];
                $facility2_store = FCPATH . "/laravel/public/" . $facility2_name;
                $allowed = array('gif', 'png', 'jpg', 'jpeg');
                if (in_array($facility2_ext, $allowed)) {
                    if (move_uploaded_file($facility2_tem_loc, $facility2_store)) {
                        $schoolfaciltyinsert2 = array(
                            'school_id' => $school_id,
                            'facility' => $school['facility2'],
                            'content' => $school['facilitydes2'],
                            'image' => $facility2_name,
                            'is_active' => 1
                        );
                        
                        $this->db->insert('school_facilities', $schoolfaciltyinsert2);
                    }
                }
            }

            // facility3 image save
            if (isset($_FILES['facilityimage3']['name'])) {
                $facility3 = $_FILES['facilityimage3']['name'];
                $facility3_ext = pathinfo($facility3, PATHINFO_EXTENSION);

                $facility3_name = $school['schoolname'] . "-" . rand(10000, 10000000) . "." . $facility3_ext;
                $facility3_type = $_FILES['facilityimage3']['type'];
                $facility3_size = $_FILES['facilityimage3']['size'];
                $facility3_tem_loc = $_FILES['facilityimage3']['tmp_name'];
                $facility3_store = FCPATH . "/laravel/public/" . $facility3_name;

                $allowed = array('gif', 'png', 'jpg', 'jpeg');
                if (in_array($facility3_ext, $allowed)) {
                    if (move_uploaded_file($facility3_tem_loc, $facility3_store)) {
                        $schoolfaciltyinsert3 = array(
                            'school_id' => $school_id,
                            'facility' => $school['facility3'],
                            'content' => $school['facilitydes3'],
                            'image' => $facility3_name,
                            'is_active' => 1
                        );

                        $this->db->insert('school_facilities', $schoolfaciltyinsert3);
                    }
                }
            }

            // facility4 image save
            if (isset($_FILES['facilityimage4']['name'])) {
                $facility4 = $_FILES['facilityimage4']['name'];
                $facility4_ext = pathinfo($facility4, PATHINFO_EXTENSION);

                $facility4_name = $school['schoolname'] . "-" . rand(10000, 10000000) . "." . $facility4_ext;
                $facility4_type = $_FILES['facilityimage4']['type'];
                $facility4_size = $_FILES['facilityimage4']['size'];
                $facility4_tem_loc = $_FILES['facilityimage4']['tmp_name'];
                $facility4_store = FCPATH . "/laravel/public/" . $facility4_name;

                $allowed = array('gif', 'png', 'jpg', 'jpeg');
                if (in_array($facility4_ext, $allowed)) {
                    if (move_uploaded_file($facility4_tem_loc, $facility4_store)) {
                        $schoolfaciltyinsert4 = array(
                            'school_id' => $school_id,
                            'facility' => $school['facility4'],
                            'content' => $school['facilitydes4'],
                            'image' => $facility4_name,
                            'is_active' => 1
                        );
                        $this->db->insert('school_facilities', $schoolfaciltyinsert1);
                    }
                }
            }
            // gallery image save
            if (isset($_FILES['mytext']['name'])) {
                $gallaryimage = $_FILES['mytext']['name'];
                $gallarytype = $_FILES['mytext']['type'];
                $gallarysize = $_FILES['mytext']['size'];
                $gallarytmp_name = $_FILES['mytext']['tmp_name'];



                if (is_array($gallaryimage)) {
                    for ($i = 0; $i < count($gallaryimage); $i++) {
                        $gallary1image = $gallaryimage[$i];
                        $gallary1_ext = pathinfo($gallary1image, PATHINFO_EXTENSION);

                        $gallary1_name = $_POST['institutename'] . "-" . rand(10000, 10000000) . "." . $gallary1_ext;
                        $gallary1_type = $gallarytype[$i];
                        $gallary1_size = $gallarysize[$i];
                        $gallary1_tem_loc = $gallarytmp_name[$i];
                        $gallary1_store = FCPATH . "/laravel/public/" . $gallary1_name;

                        $allowed = array('gif', 'png', 'jpg', 'jpeg', 'GIF', 'PNG', 'JPG', 'JPEG');


                        if (in_array($gallary1_ext, $allowed)) {
                            if (move_uploaded_file($gallary1_tem_loc, $gallary1_store)) {

                                $schoolgallaryinsert1 = array(
                                    'school_id' => $school_id,
                                    'school_activity_id' => 71,
                                    'images' => $gallary1_name,
                                    'is_active' => 1
                                );

                                $this->db->insert('school_images', $schoolgallaryinsert1);
                            }
                        }
                    }
                }
            }

            $user = $this->db->get_where('user_register', array('id' => $_POST['user_id']));
            foreach ($user->result() as $users) {
                $user_name = $users->name;
                $user_email = $users->email;
                $user_phone = $users->phone;
            }
            // redirect('admin/schools');
        }


        // insert activity clasees
        if($_POST['category'] == 'summer_class'){

            $this->db->select('*')->where('city_name =', $_POST['city']);
            $this->db->from('cities');
            $yourcityarray = $this->db->get();


            if ($yourcityarray->num_rows() > 0) {
                foreach ($yourcityarray->result() as $yourcitys) {
                    $yourcity_id = $yourcitys->id;
                }
            } else {
                $cityinsert = array(
                    'city_name' => $_POST['city'],
                    'slug' => $_POST['city'],
                    'state_id' => 2,
                    'is_active' => 1
                );
                $this->db->insert('cities', $cityinsert);

                $this->db->select('*')->where('city_name =', $_POST['city']);
                $this->db->from('cities');
                $yourcityarray = $this->db->get();
                foreach ($yourcityarray->result() as $yourcitys) {
                    $yourcity_id = $yourcitys->id;
                }
            }

            $this->db->select('*')->where('area_name =', $_POST['area']);
            $this->db->from('areas');
            $area = $this->db->get();


            if ($area->num_rows() > 0) {
                foreach ($area->result() as $areas) {
                    $area_id = $areas->id;
                    //exit();
                }
            } else {
                $areainsert = array(
                    'area_name' => $_POST['area'],
                    'slug' => $_POST['area'],
                    'city_id' => $yourcity_id,
                    'is_active' => 1
                );
                $this->db->insert('areas', $areainsert);

                $this->db->select('*')->where('area_name =', $_POST['area']);
                $this->db->from('areas');
                $area = $this->db->get();
                foreach ($area->result() as $areas) {
                    $area_id = $areas->id;
                    //exit();
                }
            }

            $this->db->select('*')->where('category_name =', $_POST['type']);
            $this->db->from('institute_categories');
            $level = $this->db->get();
            foreach ($level->result() as $levels) {
                $category_id = $levels->id;
            }

            $banner1 = $_FILES['banner1']['name'];
            $banner1_ext = pathinfo($banner1, PATHINFO_EXTENSION);
            // echo $banner1_ext;
            // exit();
            $banner1_name = $_POST['institutename'] . "-" . rand(10000, 10000000) . "." . $banner1_ext;
            $banner1_type = $_FILES['banner1']['type'];
            $banner1_size = $_FILES['banner1']['size'];
            $banner1_tem_loc = $_FILES['banner1']['tmp_name'];
            $banner1_store = FCPATH . "/laravel/public/" . $banner1_name;

            $allowed = array('gif', 'png', 'jpg', 'jpeg', 'GIF', 'PNG', 'JPG', 'JPEG');


            if (in_array($banner1_ext, $allowed)) {

                if (move_uploaded_file($banner1_tem_loc, $banner1_store)) {
                    
                }
            }


            $newsbanner1 = $_FILES['newsbanner']['name'];
            $newsbanner1_ext = pathinfo($newsbanner1, PATHINFO_EXTENSION);
            // echo $banner1_ext;
            // exit();
            $newsbanner1_name = $_POST['institutename'] . "-" . rand(10000, 10000000) . "." . $newsbanner1_ext;
            $newsbanner1_type = $_FILES['newsbanner']['type'];
            $newsbanner1_size = $_FILES['newsbanner']['size'];
            $newsbanner1_tem_loc = $_FILES['newsbanner']['tmp_name'];
            $newsbanner1_store = FCPATH . "/laravel/public/" . $newsbanner1_name;

            $allowed = array('gif', 'png', 'jpg', 'jpeg', 'GIF', 'PNG', 'JPG', 'JPEG');


            if (in_array($newsbanner1_ext, $allowed)) {

                if (move_uploaded_file($newsbanner1_tem_loc, $newsbanner1_store)) {
                    $newsbanner1_name = $newsbanner1_name;
                }
            }

            if($_POST['position_id'] == 1){
                $paid = 65000;
                $validity = 100;
            }else if($_POST['position_id'] == 2){
                $paid = 30000;
                $validity = 100;
            }else if($_POST['position_id'] == 1){
                $paid = 12000;
                $validity = 100;
            }else if($_POST['position_id'] == 1){
                $paid = 0;
                $validity = 30;
            }

           
            if($_POST['status'] == 1){
                $status = 1;
                $act_date = date('Y-m-d H:i:s');
            }
            if($_POST['status'] == 0){
                $status = null;
                $act_date = null;
            }

            $classinsert = array(
                'category_id' => $category_id,
                'position_id' => 4,
                'status' => $status,
                'institute_name' => $_POST['institutename'],
                'slug' => $_POST['institutename'],
                'mobile' => $_POST['phone'],
                'email' => $_POST['email'],
                'address' => $_POST['address'],
                'user_id' => $user_id,
                'proprietor_image' => $aboutimage_name,
                'city_id' => $yourcity_id,
                'area_id' => $area_id,
                'about' => $_POST['aboutdesc'],
                'year_of_establish' => $_POST['founded'],
                'branches' => $_POST['branches'],
                // 'ad'=>$_POST['ad'],
                'specials' => $_POST['special'],
                'website_url' => $_POST['website'],
                'timings' => $_POST['timing'],
                'logo' => $banner1_name,
                'paid' => 0,
                'news_image' => $newsbanner1_name,
                'activated_at' => $act_date,
                'is_active' => 1,
                'valitity'=> 30,
            );
            $this->db->insert('institute_details', $classinsert);

            $this->db->select('*')->where('slug =', $_POST['institutename']);
            $this->db->from('institute_details');
            $schooldetail = $this->db->get();
            foreach ($schooldetail->result() as $schooldetails) {
                $school_id = $schooldetails->id;
            }


            //aboutimage
            $aboutimage = $_FILES['aboutimage']['name'];
            $aboutimage_ext = pathinfo($aboutimage, PATHINFO_EXTENSION);
            // echo $banner1_ext;
            // exit();
            $aboutimage_name = $_POST['institutename'] . "-" . rand(10000, 10000000) . "." . $aboutimage_ext;
            $aboutimage_type = $_FILES['aboutimage']['type'];
            $aboutimage_size = $_FILES['aboutimage']['size'];
            $aboutimage_tem_loc = $_FILES['aboutimage']['tmp_name'];
            $aboutimage_store = FCPATH . "/laravel/public/" . $aboutimage_name;

            $allowed = array('gif', 'png', 'jpg', 'jpeg', 'GIF', 'PNG', 'JPG', 'JPEG');


            if (in_array($aboutimage_ext, $allowed)) {

                if (move_uploaded_file($aboutimage_tem_loc, $aboutimage_store)) {
                    $banner2insert = array(
                        'institute_id' => $school_id,
                        'category_id' => 1,
                        'image' => $aboutimage_name,
                        'is_active' => 1
                    );

                    $this->db->insert('institute_images', $banner2insert);
                }
            }
            // banner1 image save
            if (isset($_FILES['banner1']['name'])) {
                $banner1 = $_FILES['banner1']['name'];
                $banner1_ext = pathinfo($banner1, PATHINFO_EXTENSION);
            // echo $banner1_ext;
            // exit();
                $banner1_name = $_POST['institutename'] . "-" . rand(10000, 10000000) . "." . $banner1_ext;
                $banner1_type = $_FILES['banner1']['type'];
                $banner1_size = $_FILES['banner1']['size'];
                $banner1_tem_loc = $_FILES['banner1']['tmp_name'];
                $banner1_store = FCPATH . "/laravel/public/" . $banner1_name;

                $allowed = array('gif', 'png', 'jpg', 'jpeg', 'GIF', 'PNG', 'JPG', 'JPEG');

                if (in_array($banner1_ext, $allowed)) {

                    if (move_uploaded_file($banner1_tem_loc, $banner1_store)) {


                        $banner1insert = array(
                            'institute_id' => $school_id,
                            'category_id' => 3,
                            'image' => $banner1_name,
                            'is_active' => 1
                        );

                        $this->db->insert('institute_images', $banner1insert);

                        $admission = array(
                            'institute_id' => $school_id,
                            'image' => $banner1_name,
                            'content' => 'Admissions for the Academic year 2019-20 commences.',
                            'is_active' => 1
                        );

                        $this->db->insert('institute_admissions', $admission);
                    }
                }
            }


            // exit();
            // banner2 image save
            if (isset($_FILES['banner2']['name'])) {
                $banner2 = $_FILES['banner2']['name'];
                $banner2_ext = pathinfo($banner2, PATHINFO_EXTENSION);

                $banner2_name = $_POST['institutename'] . "-" . rand(10000, 10000000) . "." . $banner2_ext;
                $banner2_type = $_FILES['banner2']['type'];
                $banner2_size = $_FILES['banner2']['size'];
                $banner2_tem_loc = $_FILES['banner2']['tmp_name'];
                $banner2_store = FCPATH . "/laravel/public/" . $banner2_name;

                $allowed = array('gif', 'png', 'jpg', 'jpeg', 'GIF', 'PNG', 'JPG', 'JPEG');
            // echo $file_type;
            // exit();
                if (in_array($banner2_ext, $allowed)) {
                    if (move_uploaded_file($banner2_tem_loc, $banner2_store)) {
                        $banner2insert = array(
                            'institute_id' => $school_id,
                            'category_id' => 3,
                            'image' => $banner2_name,
                            'is_active' => 1
                        );

                        $this->db->insert('institute_images', $banner2insert);
                    }
                }
            }

            // banner3 image save
            if (isset($_FILES['banner3']['name'])) {
                $banner3 = $_FILES['banner3']['name'];
                $banner3_ext = pathinfo($banner3, PATHINFO_EXTENSION);

                $banner3_name = $_POST['institutename'] . "-" . rand(10000, 10000000) . "." . $banner3_ext;
                $banner3_type = $_FILES['banner3']['type'];
                $banner3_size = $_FILES['banner3']['size'];
                $banner3_tem_loc = $_FILES['banner3']['tmp_name'];
                $banner3_store = FCPATH . "/laravel/public/" . $banner3_name;

                $allowed = array('gif', 'png', 'jpg', 'jpeg', 'GIF', 'PNG', 'JPG', 'JPEG');
            // echo $file_type;
            // exit();
                if (in_array($banner3_ext, $allowed)) {
                    if (move_uploaded_file($banner3_tem_loc, $banner3_store)) {
                        $banner3insert = array(
                            'institute_id' => $school_id,
                            'category_id' => 3,
                            'image' => $banner3_name,
                            'is_active' => 1
                        );

                        $this->db->insert('institute_images', $banner3insert);
                    }
                }
            }


            if (!empty($_POST['founded'])) {
                $foundedinsert = array(
                    'institute_id' => $school_id,
                    'icon' => 'founded.png',
                    'heading' => 'Founded',
                    'content' => $_POST['founded'],
                    'brief_content' => $_POST['founded'],
                    'is_active' => 1
                );
                $this->db->insert('institute_platinum_datas', $foundedinsert);
            }



            if (!empty($_POST['special'])) {
                $specialinsert = array(
                    'institute_id' => $school_id,
                    'icon' => 'special.png',
                    'heading' => 'Special',
                    'content' => $_POST['special'],
                    'brief_content' => $_POST['special'],
                    'is_active' => 1
                );
                $this->db->insert('institute_platinum_datas', $specialinsert);
            }

            if (!empty($_POST['students'])) {
                $studentsinsert = array(
                    'institute_id' => $school_id,
                    'icon' => 'students.png',
                    'heading' => 'Students',
                    'content' => $_POST['students'],
                    'brief_content' => $_POST['students'],
                    'is_active' => 1
                );
                $this->db->insert('institute_platinum_datas', $studentsinsert);
            }

            if (!empty($_POST['events'])) {
                $eventsinsert = array(
                    'institute_id' => $school_id,
                    'icon' => 'Events.png',
                    'heading' => 'Events',
                    'content' => $_POST['events'],
                    'brief_content' => $_POST['events'],
                    'is_active' => 1
                );
                $this->db->insert('institute_platinum_datas', $eventsinsert);
            }

            if (!empty($_POST['achievements'])) {
                $achievementsinsert = array(
                    'institute_id' => $school_id,
                    'icon' => 'achievements.png',
                    'heading' => 'Achievements',
                    'content' => $_POST['achievements'],
                    'brief_content' => $_POST['achievements'],
                    'is_active' => 1
                );
                $this->db->insert('institute_platinum_datas', $achievementsinsert);
            }

            if (!empty($_POST['teachers'])) {
                $teachersinsert = array(
                    'institute_id' => $school_id,
                    'icon' => 'teachers.png',
                    'heading' => 'Teachers',
                    'content' => $_POST['teachers'],
                    'brief_content' => $_POST['teachers'],
                    'is_active' => 1
                );
                $this->db->insert('institute_platinum_datas', $teachersinsert);
            }

            if (!empty($_POST['branches'])) {
                $branchesinsert = array(
                    'institute_id' => $school_id,
                    'icon' => 'branch.png',
                    'heading' => 'Branches',
                    'content' => $_POST['branches'],
                    'brief_content' => $_POST['branches'],
                    'is_active' => 1
                );
                $this->db->insert('institute_platinum_datas', $branchesinsert);
            }

            if (!empty($_POST['languages'])) {
                $languageinsert = array(
                    'institute_id' => $school_id,
                    'icon' => 'language.png',
                    'heading' => 'Language',
                    'content' => $_POST['languages'],
                    'brief_content' => $_POST['languages'],
                    'is_active' => 1
                );
                $this->db->insert('institute_platinum_datas', $languageinsert);
            }

            if (!empty($_POST['customRadioInline1'])) {
                
                if ($_POST['customRadioInline1'] == "yes") {
                    $activityinsert = array(
                        'institute_id' => $school_id,
                        'icon' => 'activity.png',
                        'heading' => 'Trainer',
                        'content' => 'Personal Trainer',
                        'brief_content' => 'Personal Trainer',
                        'is_active' => 1
                    );
                    $this->db->insert('institute_platinum_datas', $activityinsert);
                }
            }

            // activity image save
            $activity = $_POST['categoryname'];
            $activitydesc = $_POST['categorydesc'];
            $activityimage = $_FILES['categoryimage']['name'];
            $activitytype = $_FILES['categoryimage']['type'];
            $activitysize = $_FILES['categoryimage']['size'];
            $activitytmp_name = $_FILES['categoryimage']['tmp_name'];

            if (is_array($activity)) {
                for ($i = 0; $i < count($activity); $i++) {
                    // print ($activity[$i]);
                    // if(isset($_FILES['activityimage1']['name']))
                    // {
                    $activity1 = $activityimage[$i];
                    $activity1_ext = pathinfo($activity1, PATHINFO_EXTENSION);

                    $activity1_name = $_POST['institutename'] . "-" . rand(10000, 10000000) . "." . $activity1_ext;
                    $activity1_type = $activitytype[$i];
                    $activity1_size = $activitysize[$i];
                    $activity1_tem_loc = $activitytmp_name[$i];
                    $activity1_store = FCPATH . "/laravel/public/" . $activity1_name;

                    $allowed = array('gif', 'png', 'jpg', 'jpeg', 'GIF', 'PNG', 'JPG', 'JPEG');


                    if (in_array($activity1_ext, $allowed)) {
                        if (move_uploaded_file($activity1_tem_loc, $activity1_store)) {

                            $this->db->select('*')->where('program_name =', $activity[$i]);
                            $this->db->from('institute_programs');
                            $schoolactivity1 = $this->db->get();

                            if ($schoolactivity1->num_rows() > 0) {
                                foreach ($schoolactivity1->result() as $schoolactivitys1) {
                                    $schoolactivity_id1 = $schoolactivitys1->id;
                                }
                            } else {
                                $schoolactivityinsert1 = array(
                                    'program_name' => $activity[$i]
                                );

                                $this->db->insert('institute_programs', $schoolactivityinsert1);

                                $this->db->select('*')->where('program_name =', $activity[$i]);
                                $this->db->from('institute_programs');
                                $schoolactivity1 = $this->db->get();

                                foreach ($schoolactivity1->result() as $schoolactivitys1) {
                                    $schoolactivity_id1 = $schoolactivitys1->id;
                                }
                            }

                            $schoolactivityinsert1 = array(
                                'institute_id' => $school_id,
                                'program_id' => $schoolactivity_id1,
                                'image' => $activity1_name,
                                'about' => $activitydesc[$i],
                                'is_active' => 1
                            );

                            $this->db->insert('program_details', $schoolactivityinsert1);
                        }
                    }
                    // }
                }
            }


            // gallery image save
            if (isset($_FILES['mytext']['name'])) {
                $gallaryimage = $_FILES['mytext']['name'];
                $gallarytype = $_FILES['mytext']['type'];
                $gallarysize = $_FILES['mytext']['size'];
                $gallarytmp_name = $_FILES['mytext']['tmp_name'];



                if (is_array($gallaryimage)) {
                    for ($i = 0; $i < count($gallaryimage); $i++) {
                        $gallary1image = $gallaryimage[$i];
                        $gallary1_ext = pathinfo($gallary1image, PATHINFO_EXTENSION);

                        $gallary1_name = $_POST['institutename'] . "-" . rand(10000, 10000000) . "." . $gallary1_ext;
                        $gallary1_type = $gallarytype[$i];
                        $gallary1_size = $gallarysize[$i];
                        $gallary1_tem_loc = $gallarytmp_name[$i];
                        $gallary1_store = FCPATH . "/laravel/public/" . $gallary1_name;

                        $allowed = array('gif', 'png', 'jpg', 'jpeg', 'GIF', 'PNG', 'JPG', 'JPEG');


                        if (in_array($gallary1_ext, $allowed)) {
                            if (move_uploaded_file($gallary1_tem_loc, $gallary1_store)) {

                                $schoolgallaryinsert1 = array(
                                    'institute_id' => $school_id,
                                    'category_id' => 2,
                                    'image' => $gallary1_name,
                                    'is_active' => 1
                                );

                                $this->db->insert('institute_images', $schoolgallaryinsert1);
                            }
                        }
                    }
                }
            }

            // news & events save
            $news = $_POST['newsheading'];
            $newsdesc = $_POST['newsdesc'];


            if (is_array($news)) {
                for ($i = 0; $i < count($news); $i++) {

                    $newsinsert = array(
                        'institute_id' => $school_id,
                        'news' => $news[$i],
                        'news_brief' => $newsdesc[$i],
                        'is_active' => 1
                    );

                    $this->db->insert('institute_news', $newsinsert);
                }
            }

            // $user = $this->db->get_where('user_register', array('id' => $_POST['user_id']));
            // foreach ($user->result() as $users) {
            //     $user_name = $users->name;
            //     $user_email = $users->email;
            //     $user_phone = $users->phone;
            // }
            // redirect("schools/admin/institute");
        }
        $this->session->set_userdata('user_id',$user_id);
        redirect('my-account?id='.base64_encode($user_id));

    }

}