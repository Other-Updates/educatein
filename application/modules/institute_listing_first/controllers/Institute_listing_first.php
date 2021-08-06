<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Institute_listing_first extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->output->set_template('simple');
        $this->_init();
    }

    private function _init() {
        $this->load->css('assets/front/css/owl.carousel.min.css');
        $this->load->js('assets/front/js/wow.min.js');
        $this->load->js('assets/front/js/owl.carousel.min.js');
    }

    public function index() {
         $data["user_id"] = $user_id = $this->session->userdata('user_id');
        $this->db->select('*');
        $this->db->from('user_register');
        $this->db->where("id", $user_id);
        $user = $this->db->get()->row();
        $data["username"] = $user->name;
        $this->load->view('institute-listing-one',$data);
    }

    public function insert() {

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
                
            }
        }


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
                
            }
        }


        $schoolinsert = array(
            'category_id' => $category_id,
            'position_id' => 1,
            'institute_name' => $_POST['institutename'],
            'slug' => $_POST['institutename'],
            'mobile' => $_POST['phone'],
            'email' => $_POST['email'],
            'address' => $_POST['address'],
            'user_id' => $_POST['user_id'],
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
            'news_image' => $newsbanner1_name,
            'activated_at' => date('Y-m-d H:i:s'),
            'is_active' => 1,
            'valitity'=>100
        );

        $this->db->insert('institute_details', $schoolinsert);

        $this->db->select('*')->where('slug =', $_POST['institutename']);
        $this->db->from('institute_details');
        $schooldetail = $this->db->get();
        foreach ($schooldetail->result() as $schooldetails) {
            $school_id = $schooldetails->id;
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

        if (!empty($_POST['language'])) {
            $languageinsert = array(
                'institute_id' => $school_id,
                'icon' => 'language.png',
                'heading' => 'Language',
                'content' => $_POST['language'],
                'brief_content' => $_POST['language'],
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

        $user = $this->db->get_where('user_register', array('id' => $_POST['user_id']));
        foreach ($user->result() as $users) {
            $user_name = $users->name;
            $user_email = $users->email;
            $user_phone = $users->phone;
        }

        //send email to sales
        $to = "sales@edugatein.com";
        $subject = "New institute submitted";
        $txt = "Hi Edugatein,
            The platinum package institute " . $_POST['institutename'] . " has been submitted by the user " . $user_name . ".Please check the details. Email : " . $user_email . "Mobile : " . $user_phone;
        $headers = "From: support@edugatein.com" . "\r\n" .
                "CC: manikandan@haunuzinfosystems.com";

        mail($to, $subject, $txt, $headers);


        // $this->load->view('institute-listing-one');
        ?>
        <script>
            window.location.href = "https://rzp.io/l/instituteplatinumpackage";
        </script>

        <?php

    }

}
?>