<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Institute_trial extends CI_Controller {

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
        $this->load->view('institute_trial',$data);
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

        $banner1 = $_FILES['banner']['name'];
        $banner1_ext = pathinfo($banner1, PATHINFO_EXTENSION);
        // echo $banner1_ext;
        // exit();
        $banner1_name = $_POST['institutename'] . "-" . rand(10000, 10000000) . "." . $banner1_ext;
        $banner1_type = $_FILES['banner']['type'];
        $banner1_size = $_FILES['banner']['size'];
        $banner1_tem_loc = $_FILES['banner']['tmp_name'];
        $banner1_store = FCPATH . "/laravel/public/" . $banner1_name;

        $allowed = array('gif', 'png', 'jpg', 'jpeg', 'GIF', 'PNG', 'JPG', 'JPEG');


        if (in_array($banner1_ext, $allowed)) {

            if (move_uploaded_file($banner1_tem_loc, $banner1_store)) {
                
            }
        }
        $schoolinsert = array(
            'category_id' => $category_id,
            'position_id' => 4,
            'institute_name' => $_POST['institutename'],
            'slug' => $_POST['institutename'],
            'mobile' => $_POST['phone'],
            'email' => $_POST['email'],
            'address' => $_POST['address'],
            'user_id' => $_POST['user_id'],
            'proprietor_name' => $_POST['propname'],
            'city_id' => $yourcity_id,
            'area_id' => $area_id,
            'about' => $_POST['description'],
            'valitity' => 30,
            'year_of_establish' => $_POST['founded'],
            'branches' => $_POST['branches'],
            // 'ad'=>$_POST['ad'],
            'specials' => $_POST['special'],
            'website_url' => $_POST['website'],
            // 'timings'=>$_POST['timing'],
            'logo' => $banner1_name,
            'activated_at' => date('Y-m-d H:i:s'),
            'is_active' => 1,
                // 'news_image'=>$newsbanner1_name,
                // 'valitity'=>100
        );


        $this->db->insert('institute_details', $schoolinsert);

        $this->db->select('*')->where('slug =', $_POST['institutename']);
        $this->db->from('institute_details');
        $schooldetail = $this->db->get();
        foreach ($schooldetail->result() as $schooldetails) {
            $school_id = $schooldetails->id;
        }

        $banner1insert = array(
            'institute_id' => $school_id,
            'category_id' => 3,
            'image' => $banner1_name,
            'is_active' => 1
        );

        $this->db->insert('institute_images', $banner1insert);

            // gallery image save
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

        // activitys save
        $categoryheading = $_POST['categoryheading'];
        $categorydesc = $_POST['categorydesc'];
        $categoryicon = array(
            '0' => 'Cat_icon_1.png',
            '1' => 'Cat_icon_2.png',
            '2' => 'Cat_icon_3.png',
            '3' => 'Cat_icon_4.png',
            '4' => 'Cat_icon_5.png',
            '5' => 'Cat_icon_6.png',
            '6' => 'Cat_icon_7.png',
            '7' => 'Cat_icon_8.png',
            '8' => 'Cat_icon_9.png',
            '9' => 'Cat_icon_10.png',
            '10' => 'Cat_icon_11.png',
            '11' => 'Cat_icon_12.png',
            '12' => 'Cat_icon_13.png',
            '13' => 'Cat_icon_14.png',
            '14' => 'Cat_icon_15.png'
        );


        if (is_array($categoryheading)) {
            for ($i = 0; $i < count($categoryheading); $i++) {

                $this->db->select('*')->where('program_name =', $categoryheading[$i]);
                $this->db->from('institute_programs');
                $schoolactivity1 = $this->db->get();

                if ($schoolactivity1->num_rows() > 0) {
                    foreach ($schoolactivity1->result() as $schoolactivitys1) {
                        $schoolactivity_id1 = $schoolactivitys1->id;
                    }
                } else {
                    $schoolactivityinsert1 = array(
                        'program_name' => $categoryheading[$i]
                    );

                    $this->db->insert('institute_programs', $schoolactivityinsert1);

                    $this->db->select('*')->where('program_name =', $categoryheading[$i]);
                    $this->db->from('institute_programs');
                    $schoolactivity1 = $this->db->get();

                    foreach ($schoolactivity1->result() as $schoolactivitys1) {
                        $schoolactivity_id1 = $schoolactivitys1->id;
                    }
                }

                $schoolactivityinsert1 = array(
                    'institute_id' => $school_id,
                    'program_id' => $schoolactivity_id1,
                    'image' => $categoryicon[$i],
                    'about' => $categorydesc[$i],
                    'is_active' => 1
                );

                $this->db->insert('program_details', $schoolactivityinsert1);
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
        The Trial package institute " . $_POST['institutename'] . " has been submitted by the user " . $user_name . ".Please check the details. Email : " . $user_email . "Mobile : " . $user_phone;
        $headers = "From: support@edugatein.com" . "\r\n" .
                "CC: manikandan@haunuzinfosystems.com";

        mail($to, $subject, $txt, $headers);



        // $this->load->view('institute-listing-three');
        ?>
        <?php $userid =  $this->session->userdata('user_id'); ?>
        <script src="<?php echo base_url() ?>assets/front/js/jquery.min.js"></script>
        <script>
               $(document).ready(function () {
                swal({
                    title: "Trial package added successfully",
                    text: "It will be validated and approved soon",
                    icon: "success",
                }).then(function() {
                    window.location = "<?php echo base_url() ?>plan-details?id=<?php echo base64_encode($userid); ?>";
                });
            }); 
        </script>

        <?php

    }

    public function update_trial($school_id){
        $data = array();
        $data[] = array(
            'position_id' => 4,
            'valitity' => 30,
            'paid' => 0,
            // 'id' => base64_decode($school_id)
        );
        $this->db->update('institute_details',$data,array('id'=>base64_decode($school_id)));
        $this->db->select('*');
        $this->db->where('id',base64_decode($school_id));
        $this->db->from('institute_details');
        $userid = $this->db->get()->result_array();     
        ?>
        <script src="<?php echo base_url() ?>assets/front/js/jquery.min.js"></script>
        <script>
               $(document).ready(function () {
                swal({
                    title: "Trial package added successfully",
                    text: "It will be validated within two working days",
                    icon: "success",
                }).then(function() {
                    window.location = "<?php echo base_url() ?>plan-details?id=<?php echo base64_encode($userid[0]['user_id']); ?>";
                });
            }); 
        </script>
        <?php
        // <!-- redirect('plandetail?id='.base64_encode($userid[0]['user_id'])); -->
    }

}
?>