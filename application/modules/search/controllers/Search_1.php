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

//Page View Count
        $date = date("Y/m/d");
        $this->db->select('*')->where('date =', $date);
        $this->db->from('homepage_counts');
        $homepage = $this->db->get();
        if ($homepage->num_rows() > 0) {
            foreach ($homepage->result() as $homepages) {
                $view_count = $homepages->view_count;
            }
            $this->db->set('view_count', $view_count + 1)->where('date', $date)->update('homepage_counts');
        } else {
            $homepage_count = array(
                'date' => $date,
                'view_count' => 1,
            );
            $this->db->insert('homepage_counts', $homepage_count);
        }



        $ipaddress = '';
        if (isset($_SERVER['HTTP_CLIENT_IP']))
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        else if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if (isset($_SERVER['HTTP_X_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        else if (isset($_SERVER['HTTP_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        else if (isset($_SERVER['HTTP_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        else if (isset($_SERVER['REMOTE_ADDR']))
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        else
            $ipaddress = 'UNKNOWN';

        $this->db->select('*')->where('date =', $date);
        $this->db->where('ip =', $ipaddress);
        $this->db->from('user_analys');
        $ip = $this->db->get();
        if ($ip->num_rows() > 0) {
            foreach ($ip->result() as $ips) {
                $old_ip = $ips->ip;
                $page_view = $ips->page_view;
            }

            $this->db->set('page_view', $page_view + 1);
            $this->db->where('date', $date);
            $this->db->where('ip', $ipaddress);

            $update = $this->db->update('user_analys');

            // $this->db->set('page_view',$page_view+1)->where('date',$date)->update('user_analys');
        } else {
            $user_count = array(
                'ip' => $ipaddress,
                'date' => $date,
                'page_view' => 1,
            );

            $this->db->insert('user_analys', $user_count);
        }



        $search = (!empty($_POST['search']) ? $_POST['search'] : "");
        $searchcity = (!empty($_POST['searchcity']) ? $_POST['searchcity'] : "");


        $this->db->select('*');
        $this->db->from('cities');
        $test = $this->db->like('city_name', $searchcity);
        $city_search = $this->db->get()->result_array();

        foreach ($city_search as $city_searchs) {
            $city_name = $city_searchs['city_name'];
            $city_id = $city_searchs['id'];
        }

        $search = ltrim($search);
        $search = rtrim($search);
        $this->db->select('*');
        $this->db->from('search_results');
        $test = $this->db->where('keyword', $search);
        $search_result = $this->db->get()->result_array();
        $hostel_count = 0;
        if (count($search_result) > 0) {
            foreach ($search_result as $search_results) {
                $this->db->set('count', $search_results['count'] + 1);
                $this->db->where('keyword', $search_results['keyword']);
                $this->db->update('search_results');
            }
        } else {
            $data = array(
                'keyword' => $search,
                'count' => 1,
            );
            $this->db->insert('search_results', $data);
        }


        $search = str_replace(",", " ", $search);

        $data["search_array"] = $search_array = explode(" ", $search);


        $school_search = array();
        $aff_search = array();
//        $city_search = array();
        $area_search = array();
        $category_search = array();
        $list_search = array();
        $loop = 0;
//School
        $this->db->select('*');
        $this->db->from('school_details');
        $test = $this->db->where('slug', $search);
        $this->db->where('is_active', 1);
//        $this->db->where('activated_at !=', NULL);
//        $this->db->where('valitity !=', NULL);
//        $this->db->where('deleted_at', NULL);
        $school_search1 = $this->db->get()->result_array();
        if (count($school_search1) > 0) {
            $school_search = $school_search1;
        }

        if (count($school_search1) == 0) {
          
            foreach ($search_array as $value) {
                $test_state = ucfirst($value);
                if ($test_state == "Stateboard") {
                    $value = "state";
                }
                if ($test_state == "Hostel" || $test_state == "Hostels") {
                    $Hostel_search = 1;
                }
                if ($value != "in" && $value != "school" && $value != "School" && $value != "SCHOOL" && $value != "schools" && $value != "Schools" && $value != "SCHOOLS") {
                   
                    $this->db->select('*');
                    $this->db->from('cities');
                    $test = $this->db->like('city_name', $value);
                    $city_search1 = $this->db->get()->result_array();
                    
                    if (count($city_search1) > 0) {
                        $city_search = $city_search1;
                    }
                    if (count($school_search) == 0) {
                        $this->db->select('*');
                        $this->db->from('affiliations');
                        $test = $this->db->where('affiliation_name', $value);
                        $aff_search1 = $this->db->get()->result_array();

                        if (count($aff_search1) > 0) {
                            $aff_search = $aff_search1;
                        }
                        if (count($aff_search) == 0) {
                            
                            $this->db->select('*');
                            $this->db->from('affiliations');
                            $test = $this->db->like('affiliation_name', $value);
                            $aff_search1 = $this->db->get()->result_array();

                            if (count($aff_search1) > 0) {
                                $aff_search = $aff_search1;
                            }
                        }
                    }
                    if (count($school_search) == 0 && count($city_search) == 0 && count($area_search) == 0) {
                        $this->db->select('*');
                        $this->db->from('areas');
                        $test = $this->db->like('area_name', $value);
                        $area_search1 = $this->db->get()->result_array();
                        if (count($area_search1) > 0) {
                            $area_search = $area_search1;
                        }
                        if (count($area_search) == 0) {
                            $this->db->select('*');
                            $this->db->from('area_nearbys');
                            $test = $this->db->like('name', $search);
                            $area_search1 = $this->db->get()->result_array();

                            if (count($area_search) == 0) {
                                $this->db->select('*');
                                $this->db->from('area_nearbys');
                                $test = $this->db->like('name', $value);
                                $area_search1 = $this->db->get()->result_array();
                                // echo "<br>";
                                if (count($area_search1) > 0) {
                                    $area_search = $area_search1;
                                }
                            }

                            if (count($area_search) > 0) {
                                foreach ($area_search as $area_searchs) {
                                    $area_id = $area_searchs['nearby_name'];
                                }
                                $this->db->select('*');
                                $this->db->from('areas');
                                $test = $this->db->where('id', $area_id);
                                $area_search1 = $this->db->get()->result_array();
                                // echo "<br>";
                                if (count($area_search1) > 0) {
                                    $area_search = $area_search1;
                                }
                            }
                        }
                    }


                    if (count($school_search) == 0 && count($city_search) == 0 && count($aff_search) == 0) {

                        if ($value != "coimbatore") {

                            $this->db->select('*');
                            $this->db->from('school_details');
                            $test = $this->db->like('school_name', $value);
                            $this->db->where('is_active', 1);
                            $this->db->where('activated_at !=', NULL);
                            $this->db->where('valitity !=', NULL);
                            $this->db->where('deleted_at', NULL);
                            $list_search1 = $this->db->get()->result_array();
                            // echo "<br>";
                            if (count($list_search1) > 0) {
                                $list_search = $list_search1;
                            }

                            if (count($list_search) == 0) {
                                $this->db->select('*');
                                $this->db->from('school_details');
                                $test = $this->db->like('slug', $value);
                                $this->db->where('city_id', $city_id);
                                $this->db->where('is_active', 1);
                                $this->db->where('activated_at !=', NULL);
                                $this->db->where('valitity !=', NULL);
                                $this->db->where('deleted_at', NULL);
                                $list_search1 = $this->db->get()->result_array();

                                if (count($list_search1) > 0) {
                                    $list_search = $list_search1;
                                }
                            }
                        }



                        if (count($area_search) == 0 && count($school_search) == 0) {
                            $this->db->select('*');
                            $this->db->from('affiliations');
                            $test = $this->db->like('affiliation_name', $value);
                            $aff_search1 = $this->db->get()->result_array();

                            if (count($aff_search1) > 0) {
                                $aff_search = $aff_search1;
                            }
                        }


                        $this->db->select('*');
                        $this->db->from('school_types');
                        $test = $this->db->like('school_type', $value);
                        $category_search1 = $this->db->get()->result_array();

                        if (count($category_search1) > 0) {
                            $category_search = $category_search1;
                        }
                    }
                }
                $loop++;
            }
        }

        $data["aff_search"] = $data["area_search"] = $data["city_search"] = $data["list_search"] = array();
        $this->db->select('*')->where('is_active =', 1);
        $this->db->from('affiliations');
        $data['query'] = $this->db->get();
        $data["search"] = $search;
        $data["school_search"] = $school_search;
//        $data["city_search"] = $city_search;
        $data["city_name"] = $city_name;
        $data["city_id"] = $city_id;
        $this->load->view('search-list', $data);
    }

}
