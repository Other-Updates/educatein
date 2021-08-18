<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Add_listing_premium extends CI_Controller {

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
        $this->load->view('add-listing-premium',$data);
    }

    public function insert() {
// echo $_POST['activity'];
// echo "<br>";
// exit();

        $this->db->select('*')->where('affiliation_name =', $_POST['schoolboard']);
        $this->db->from('affiliations');
        $schoolboardarray = $this->db->get();

        foreach ($schoolboardarray->result() as $schoolboards) {
            $schoolboard_id = $schoolboards->id;
        }

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

        $this->db->select('*')->where('school_type =', $_POST['level']);
        $this->db->from('school_types');
        $level = $this->db->get();
        foreach ($level->result() as $levels) {
            $level_id = $levels->id;
        }

        $banner1 = $_FILES['banner']['name'];
        $banner1_ext = pathinfo($banner1, PATHINFO_EXTENSION);
        // echo $banner1_ext;
        // exit();
        $banner1_name = $_POST['schoolname'] . "-" . rand(10000, 10000000) . "." . $banner1_ext;
        $banner1_type = $_FILES['banner']['type'];
        $banner1_size = $_FILES['banner']['size'];
        $banner1_tem_loc = $_FILES['banner']['tmp_name'];
        $banner1_store = FCPATH . "/laravel/public/" . $banner1_name;

        $allowed = array('gif', 'png', 'jpg', 'jpeg', 'GIF', 'PNG', 'JPG', 'JPEG');


        if (in_array($banner1_ext, $allowed)) {

            if (move_uploaded_file($banner1_tem_loc, $banner1_store)) {
                
            }
        }

        if (isset($_POST['customRadio1'])) {
            $customRadio1 = $_POST['customRadio1'];
        } else {
            $customRadio1 = NULL;
        }

        if (isset($_POST['customRadio'])) {
            $customRadio = $_POST['customRadio'];
        } else {
            $customRadio = NULL;
        }

        $schoolinsert = array(
            'school_name' => $_POST['schoolname'],
            'slug' => $_POST['schoolname'],
            'mobile' => $_POST['phone'],
            'email' => $_POST['email'],
            'address' => $_POST['address'],
            'user_id' => $_POST['user_id'],
            'city_id' => $yourcity_id,
            'area_id' => $area_id,
            'affiliation_id' => $schoolboard_id,
            'schooltype_id' => $level_id,
            'school_category_id' => 2,
            'about' => $_POST['description'],
            'website_url' => $_POST['website'],
            'year_of_establish' => $_POST['founded'],
            // 'ad'=>$_POST['ad'],
            'acadamic' => $_POST['acedemic'],
            'type' => $_POST['schooltype'],
            'hostel' => $customRadio1,
            'rte' => $customRadio,
            'students' => $_POST['students'],
            'teachers' => $_POST['teachers'],
            'facebook' => $_POST['facebook'],
            'twitter' => $_POST['twitter'],
            'instagram' => $_POST['instagram'],
            'linkedin' => $_POST['linkedin'],
            'pinterest' => $_POST['pinterest'],
            'logo' => $banner1_name,
            'activated_at' => date('Y-m-d H:i:s'),
            'is_active' => 1,
            'valitity' => 100
        );
        $this->db->insert('school_details', $schoolinsert);
        $this->db->select('*')->where('slug =', $_POST['schoolname']);
        $this->db->from('school_details');
        $schooldetail = $this->db->get();
        foreach ($schooldetail->result() as $schooldetails) {
            $school_id = $schooldetails->id;
        }
// banner1 image save
        $banner1insert = array(
            'school_id' => $school_id,
            'school_activity_id' => 2,
            'images' => $banner1_name,
            'is_active' => 1
        );

        $this->db->insert('school_images', $banner1insert);



// if(isset($_FILES['banner']['name']))
// {
//         $banner1 = $_FILES['banner']['name'];
//         $banner1_ext = pathinfo($banner1, PATHINFO_EXTENSION);
// // echo $banner1_ext;
// // exit();
//         $banner1_name = $_POST['schoolname']."-".rand(10000,10000000).".".$banner1_ext;
//         $banner1_type = $_FILES['banner']['type'];
//         $banner1_size = $_FILES['banner']['size'];
//         $banner1_tem_loc = $_FILES['banner']['tmp_name'];
//         $banner1_store = $_SERVER['DOCUMENT_ROOT']."/laravel/public/".$banner1_name;
//         $allowed = array('gif','png','jpg','jpeg','GIF','PNG','JPG','JPEG');
//     if(in_array($banner1_ext,$allowed))
//     {
//         if(move_uploaded_file($banner1_tem_loc,$banner1_store))
//         {
//             $banner1insert = array(
//                 'school_id'=>$school_id,
//                 'school_activity_id'=>2,
//                 'images'=>$banner1_name,
//                 'is_active'=>1
//         );
//         $this->db->insert('school_images',$banner1insert);
//         }
//     }
// }
//platinum data save
        if (!empty($_POST['founded'])) {
            $foundedinsert = array(
                'school_id' => $school_id,
                'icon_class' => 'fa fa-calendar-check-o',
                'heading' => 'Founded',
                'content' => $_POST['founded'],
                'brief_content' => $_POST['founded'],
                'is_active' => 1
            );
            $this->db->insert('platinum_datas', $foundedinsert);
        }

        if (!empty($_POST['students'])) {
            $studentsinsert = array(
                'school_id' => $school_id,
                'icon_class' => 'fa fa-group',
                'heading' => 'Students',
                'content' => $_POST['students'],
                'brief_content' => $_POST['students'],
                'is_active' => 1
            );
            $this->db->insert('platinum_datas', $studentsinsert);
        }

        if (!empty($_POST['level'])) {
            $levelinsert = array(
                'school_id' => $school_id,
                'icon_class' => 'fa fa-graduation-cap',
                'heading' => 'Level',
                'content' => $_POST['level'],
                'brief_content' => $_POST['level'],
                'is_active' => 1
            );
            $this->db->insert('platinum_datas', $levelinsert);
        }

        if (!empty($_POST['schooltype'])) {
            $schooltypeinsert = array(
                'school_id' => $school_id,
                'icon_class' => 'fa fa-bank',
                'heading' => 'Schooltype',
                'content' => $_POST['schooltype'],
                'brief_content' => $_POST['schooltype'],
                'is_active' => 1
            );
            $this->db->insert('platinum_datas', $schooltypeinsert);
        }

        if (!empty($_POST['acedemic'])) {
            $acedemicinsert = array(
                'school_id' => $school_id,
                'icon_class' => 'fa fa-percent',
                'heading' => 'Acedemic',
                'content' => $_POST['acedemic'],
                'brief_content' => $_POST['acedemic'],
                'is_active' => 1
            );
            $this->db->insert('platinum_datas', $acedemicinsert);
        }

        if (!empty($_POST['teachers'])) {
            $teachersinsert = array(
                'school_id' => $school_id,
                'icon_class' => 'fa fa-user',
                'heading' => 'Teachers',
                'content' => $_POST['teachers'],
                'brief_content' => $_POST['teachers'],
                'is_active' => 1
            );
            $this->db->insert('platinum_datas', $teachersinsert);
        }


// activity image save
        $activity = $_POST['activity'];
        $activityimage = $_FILES['activityimage']['name'];
        $activitytype = $_FILES['activityimage']['type'];
        $activitysize = $_FILES['activityimage']['size'];
        $activitytmp_name = $_FILES['activityimage']['tmp_name'];

        if (is_array($activity)) {
            for ($i = 0; $i < count($activity); $i++) {
                // print ($activity[$i]);
                // if(isset($_FILES['activityimage1']['name']))
                // {
                $activity1 = $activityimage[$i];
                $activity1_ext = pathinfo($activity1, PATHINFO_EXTENSION);

                $activity1_name = $_POST['schoolname'] . "-" . rand(10000, 10000000) . "." . $activity1_ext;
                $activity1_type = $activitytype[$i];
                $activity1_size = $activitysize[$i];
                $activity1_tem_loc = $activitytmp_name[$i];
                $activity1_store = FCPATH . "/laravel/public/" . $activity1_name;

                $allowed = array('gif', 'png', 'jpg', 'jpeg', 'GIF', 'PNG', 'JPG', 'JPEG');


                if (in_array($activity1_ext, $allowed)) {
                    if (move_uploaded_file($activity1_tem_loc, $activity1_store)) {

                        $this->db->select('*')->where('activity_name =', $activity[$i]);
                        $this->db->from('school_activities');
                        $schoolactivity1 = $this->db->get();

                        if ($schoolactivity1->num_rows() > 0) {
                            foreach ($schoolactivity1->result() as $schoolactivitys1) {
                                $schoolactivity_id1 = $schoolactivitys1->id;
                            }
                        } else {
                            $schoolactivityinsert1 = array(
                                'activity_name' => $activity[$i]
                            );

                            $this->db->insert('school_activities', $schoolactivityinsert1);

                            $this->db->select('*')->where('activity_name =', $activity[$i]);
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
                // }
            }
        }


        // facility image save
        $facility = $_POST['facility'];
        $facilitydesc = $_POST['facilitydesc'];
        $facilityimage = $_FILES['facilityimage']['name'];
        $facilitytype = $_FILES['facilityimage']['type'];
        $facilitysize = $_FILES['facilityimage']['size'];
        $facilitytmp_name = $_FILES['facilityimage']['tmp_name'];

        if (is_array($facility)) {
            for ($i = 0; $i < count($facility); $i++) {
                $facility1 = $facilityimage[$i];
                $facility1_ext = pathinfo($facility1, PATHINFO_EXTENSION);

                $facility1_name = $_POST['schoolname'] . "-" . rand(10000, 10000000) . "." . $facility1_ext;
                $facility1_type = $facilitytype[$i];
                $facility1_size = $facilitysize[$i];
                $facility1_tem_loc = $facilitytmp_name[$i];
                $facility1_store = FCPATH . "/laravel/public/" . $facility1_name;

                $allowed = array('gif', 'png', 'jpg', 'jpeg', 'GIF', 'PNG', 'JPG', 'JPEG');
                // echo $file_type;
                // exit();
                if (in_array($facility1_ext, $allowed)) {
                    if (move_uploaded_file($facility1_tem_loc, $facility1_store)) {
                        $schoolfaciltyinsert1 = array(
                            'school_id' => $school_id,
                            'facility' => $facility[$i],
                            'content' => $facilitydesc[$i],
                            'image' => $facility1_name,
                            'is_active' => 1
                        );

                        $this->db->insert('school_facilities', $schoolfaciltyinsert1);
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

        //send email to sales
        $to = "sales@edugatein.com,mani969806506@gmail.co";
        $subject = "New institute submitted";
        $txt = "Hi Edugatein,
        The premium package school " . $_POST['schoolname'] . " has been submitted by the user " . $user_name . ".Please check the details. Email : " . $user_email . "Mobile : " . $user_phone;
        $headers = "From: support@edugatein.com" . "\r\n" .
                "CC: manikandan@haunuzinfosystems.com";

        mail($to, $subject, $txt, $headers);


        // $this->load->view('add-listing-premium');
        ?>
        <script>
            window.location.href = "https://rzp.io/l/schoolpremiumpackage";
        </script>

        <?php

    }

    public function update_premium($school_id){
        $data = array();
        $data[] = array(
            'school_category_id' => 2,
            'valitity' => 100,
            'id' => base64_decode($school_id)
        );
        $this->db->update_batch('school_details',$data,'id');
        ?>
            <script>
            window.location.href = "https://rzp.io/l/schoolpremiumpackage";
            </script>
        <?php
    }

}
?>