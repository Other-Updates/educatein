<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Add_trial extends CI_Controller {

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
        $this->load->view('add_trial', $data);
    }

    public function insert() {
        // $userid = base64_encode($_GET['id']);
        // print_r($user_id)
// echo $_POST['schoolname'];
// echo "<br>";
// // echo $_POST['address'];
// // echo "<br>";
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
            'school_category_id' => 4,
            'about' => $_POST['description'],
            'website_url' => $_POST['website'],
            'year_of_establish' => $_POST['founded'],
            // 'ad'=>$_POST['ad'],
            'type' => $_POST['schooltype'],
            'activated_at' => date('Y-m-d H:i:s'),
            'hostel' => $customRadio1,
            'rte' => $customRadio,
            // 'students'=>$_POST['students'],
            // 'teachers'=>$_POST['teachers'],
            // 'facebook'=>$_POST['facebook'],
            // 'twitter'=>$_POST['twitter'],
            // 'instagram'=>$_POST['instagram'],
            // 'linkedin'=>$_POST['linkedin'],
            // 'pinterest'=>$_POST['pinterest'], 
            'logo' => $banner1_name,
            'is_active' => 1,
            'valitity' => 30
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


        // gallery image save
        $gallaryimage = $_FILES['mytext']['name'];
        $gallarytype = $_FILES['mytext']['type'];
        $gallarysize = $_FILES['mytext']['size'];
        $gallarytmp_name = $_FILES['mytext']['tmp_name'];

        if (is_array($gallaryimage)) {
            for ($i = 0; $i < count($gallaryimage); $i++) {
                $gallaryimage = $gallaryimage[$i];
                $gallary1_ext = pathinfo($gallaryimage, PATHINFO_EXTENSION);

                $gallary1_name = $_POST['schoolname'] . "-" . rand(10000, 10000000) . "." . $gallary1_ext;
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
            The trial package school " . $_POST['schoolname'] . " has been submitted by the user " . $user_name . ".Please check the details. Email : " . $user_email . "Mobile : " . $user_phone;
        $headers = "From: support@edugatein.com" . "\r\n" .
                "CC: manikandan@haunuzinfosystems.com";

        mail($to, $subject, $txt, $headers);
         $this->load->view('add_trial');
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

    public function razorPaySuccess() {
        $data = [
            'user_id' => '1',
            'payment_id' => $this->input->post('razorpay_payment_id'),
            'amount' => $this->input->post('totalAmount'),
            'product_id' => $this->input->post('product_id'),
        ];
        $insert = $this->db->insert('payments', $data);
        $arr = array('msg' => 'Payment successfully credited', 'status' => true);
    }

    public function RazorThankYou() {
        $this->load->view('welcome_message');
    }

    public function update_trial($school_id){
        $this->db->select('*');
        $this->db->where('id',base64_decode($school_id));
        $this->db->from('school_details');
        $userid = $this->db->get()->result_array();
        $data = array();
        $data[] = array(
            'school_category_id' => 4,
            'valitity' => 30,
            'id' => base64_decode($school_id)
        );
        $this->db->update_batch('school_details',$data,'id');
        redirect('plandetail?id='.base64_encode($userid[0]['user_id']));
    }
}
?>