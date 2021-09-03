
<?php
  $this->session->userdata('school');
//Get User id from url
$userid = base64_decode($_GET['id']);

$this->db->select('*');
$this->db->from('user_register');
$this->db->where("id", $userid);
$user = $this->db->get();

foreach ($user->result() as $users) {
    $username = $users->name;
    $userimage = $users->image;
    $userid = $users->id;
    $address = $users->address;
    $phone = $users->phone;
    $state = $users->state;
    $country = $users->country;
    $pincode = $users->pincode;
    $image = $users->image;
    $cityid = $users->city_id;
}
?>

<div class="student-dashboard-body">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 mab-30">
                <div class="student-dashboard-sidebar sticky-sidebar shadow-lg">
                    <div class="text-center">
                        <div class="student-profile-img">

                            <?php
                            if ($image != NULL) {
                                ?>
                                <img src="<?php echo base_url("images/"); ?>myaccount/<?php echo $image ?>" class="mb-3 rounded-circle" alt="">
                                <?php
                            } else {
                                ?>
                                <img src="<?php echo base_url("assets/front/images/"); ?>dashboard/profile-img.png" class="mb-3 rounded-circle" alt="">
                                <?php
                            }
                            ?>

                        </div><!-- /student-profile-img -->
                        <h5 class="mt-2"><?php echo $username; ?></h5>
                    </div>
                    <hr class="my-3">

                    <ul class="list-group">
                        <li class="list-group-item"><a href="<?php echo base_url() ?>my-account?id=<?php echo base64_encode($userid); ?>"><i class="lnr lnr-user"></i> &nbsp;My Account</a></li>
                        <li class="list-group-item"><a href="<?php echo base_url() ?>package?id=<?php echo base64_encode($userid); ?>"><i class="lnr lnr-gift"></i> &nbsp;Package Details</a></li>
                        <li class="list-group-item active noclick"><a href=""><i class="lnr lnr-license"></i> &nbsp;Plan Details</a></li>
                        <li class="list-group-item"><a href="<?php echo base_url("logout") ?>" class="logout"><i class="lnr lnr-exit"></i> &nbsp;Logout</a></li>
                    </ul>
                </div><!-- /student-dashboard-sidebar -->
            </div>

            <div class="col-lg-9">
                <div class="section-title mab-30">
                    <h2 class="mb-2">Plan Details</h2>
                    <div class="modal-body text-center col-lg-12 pl-8" style="margin-left:300px">
                        <a href="<?php echo base_url(); ?>schoolfirst?id=<?php echo base64_encode($userid); ?>"><button class="btn btn-pink">ADD SCHOOL</button></a>
                        <a href="<?php echo base_url(); ?>institutefirst?id=<?php echo base64_encode($userid); ?>"><button class="btn btn-primary">ACTIVITY CLASS</button></a>
                    </div>
                    <hr>
                </div><!-- /section-title -->
                <?php
// echo $userid;
// exit();
                $this->db->select('*')->where('user_id =', $userid);
// $this->db->where('is_active =','1');
                $this->db->where('deleted_at =', NULL);
                // $this->db->where('status != 2');
                $this->db->order_by("activated_at", "desc");
                $this->db->from('school_details');
                $school = $this->db->get();
                            // print_r($this->db->last_query());exit;
                $this->db->select('*')->where('user_id =', $userid);
// $this->db->where('is_active =','1');
                $this->db->where('deleted_at =', NULL);
                // $this->db->where('status !=',2);
                $this->db->order_by("activated_at", "desc");
                $this->db->from('institute_details');
                $institute = $this->db->get();
                ?>
                <div class="accordion" id="accordionExample">

                    <?php
                    //school plan listing
                    if ($school->num_rows() > 0) {
                        $school_count = 1;

                        foreach ($school->result() as $schools) {
                            if ($schools->school_category_id == 1) {
                                $category = "PLATINUM";
                            } elseif ($schools->school_category_id == 2) {
                                $category = "PREMIUM";
                            } elseif ($schools->school_category_id == 3) {
                                $category = "SPECTRUM";
                            } elseif ($schools->school_category_id == 4) {
                                $category = "TRIAL";
                            }

                            $this->db->select('*')->where('id =', $schools->school_category_id);
                            $this->db->where('is_active =', '1');
                            $this->db->from('affiliations');
                            $affliation = $this->db->get();

                            foreach ($affliation->result() as $affliations) {
                                $affiliation_name = $affliations->slug;
                            }

                            $this->db->select('*')->where('id =', $schools->schooltype_id);
                            $this->db->where('is_active =', '1');
                            $this->db->from('school_types');
                            $type = $this->db->get();

                            foreach ($type->result() as $types) {
                                $school_type = $types->school_type;
                            }

                            if (isset($schools->website_url)) {
                                $website = $schools->website_url;
                            } else {
                                $website = "-";
                            }

                            $school_activity = "is_active=1 AND school_id=" . $schools->id . " AND deleted_at is NULL";
                            $this->db->select('school_activity_id')->where($school_activity);
                            $this->db->from('school_images');
                            $this->db->distinct();
                            $school_activity = $this->db->get();

                            $act_name = array();
                            foreach ($school_activity->result() as $school_activitys) {
                                $actname = "id = " . $school_activitys->school_activity_id . " ";
                                $this->db->select('*')->where($actname);
                                $this->db->from('school_activities');
                                $activityname = $this->db->get();
                                foreach ($activityname->result() as $activitynames) {

                                    if ($activitynames->id != 71) {
                                        $act_name[] = $activitynames->activity_name;
                                    }
                                }
                            }

                            $facility = "is_active=1 AND school_id=" . $schools->id . " AND deleted_at IS NULL";

                            $this->db->select('*')->where($facility);
                            $this->db->from('school_facilities');
                            $facility = $this->db->get();
                            $facility_name = array();
                            $school_image = array();
                            foreach ($facility->result() as $facilities) {
                                $facility_name[] = $facilities->facility;
                                $school_image[] = $facilities->image;
                            }

                            $act_names = implode(",", $act_name);
                            $facility_names = implode(",", $facility_name);
                            
                            if ($school->num_rows() > 0) {
                                    $valitity = $schools->valitity;
        
                                    $activate = new DateTime($schools->activated_at);
                                    $act_date = $activate->getTimestamp();
                                    $date = new DateTime();
                                    $cur_date = $date->getTimestamp();
        
                                    $spend = round($cur_date / (60 * 60 * 24) - $act_date / (60 * 60 * 24));
                                    $remain = $valitity - $spend;
                                    $exp_date = strtotime(+$valitity." days", $act_date);
                                    $expiry_date = date('Y-m-d',$exp_date);
                            }
                            ?>

                            <div class="card shadow mb-2">
                                <div class="card-header" id="heading<?php echo $school_count; ?>">
                                    <h5 class="mb-0 p-2">
                                        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse<?php echo $school_count; ?>" aria-expanded="true" aria-controls="collapse<?php echo $school_count; ?>">
                                            <?php echo $schools->slug; ?> <span class="badge badge-warning"><?php echo $category; ?></span>
                                            <?php if($schools->status == NULL){?><span style="color:green;font-size:15px" >&nbsp;&nbsp;School is under validation</span>
                                                <?php } else if($schools->status == 2){?><span style="color:#F32013;font-size:15px" >&nbsp;&nbsp;School is rejected</span> 
                                                    <?php }else if($schools->status == 1){ 
                                                        if($remain > 0){ ?><span style="color:blue;font-size:15px" >&nbsp;&nbsp;Expiry date- <?php echo $expiry_date ?>( <?php echo $remain ?>days to go)</span>
                                                        <?php }else if($remain <= 0){ ?><span style="color:red;font-size:15px">&nbsp;&nbsp;Your school plan is expired</span><?php } ?>
                                                        <?php } ?>
                                        </button>
                                        <?php
                                        $test = $schools->valitity * 60 * 60 * 24;

                                        $activate = new DateTime($schools->activated_at);

                                        $date = new DateTime();
                                        // echo $test;
                                        // echo "<br>";
                                        // echo $activate->getTimestamp()+$test;
                                        // echo "<br>";
                                        // echo $date->getTimestamp(); 
                                        // exit();
                                        // if ($date->getTimestamp() > $activate->getTimestamp() + $test) {
                                            ?>
                                            <!-- <a href="<?php echo base_url() ?>upgrade-package?id=<?php echo base64_encode($userid); ?>&sid=<?php echo base64_encode($schools->id); ?>" class="upgrade" target="_blank">UPGRADE PLAN</a> -->

                                            <?php
                                        // } else {
                                            ?>
                                            <a href="" class="upgrade" data-toggle="modal" data-target="#exampleModalCenter2">UPGRADE PLAN</a>

                                            <?php
                                        // }
                                        ?>
                                    </h5>

                                </div>

                                <!-- Modal -->
                                <div class="modal upgrade-modal fade" id="exampleModalCenter2" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalCenterTitle">Upgrade To Premium</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true"><i class="lnr lnr-cross"></i></span>
                                                </button>
                                            </div>
                                            <div class="modal-body p-4">
                                                <h5 class="mb-2">To upgrade premium membership please send the following details by mail.</h5>
                                                <ul class="mb-2">
                                                    <li>Current Plan</li>
                                                    <li>School Details</li>
                                                    <li>Upgrade Plan</li>
                                                </ul>
                                                <p class="lead mb-2">Send email to <a href="mailto:support@edugatein.com">support@edugatein.com</a></p>
                                                <p class="mb-3"><b>Note:</b> Your information will be added on website within 48 hours and intimated to you via email.</p>
                                                <p>Toll Free Number: <a href="tel:1800120235600"><i class="fa fa-phone"></i> 1800-120-235600</a></p>
                                            </div>
                                        </div><!-- /modal-content -->
                                    </div>
                                </div><!-- /modal -->


                                <?php if ($school_count == 1) { ?>
                                    <div id="collapse<?php echo $school_count; ?>" class="collapse show" aria-labelledby="heading<?php echo $school_count; ?>" data-parent="#accordionExample">

                                    <?php } else { ?>
                                        <div id="collapse<?php echo $school_count; ?>" class="collapse" aria-labelledby="heading<?php echo $school_count; ?>" data-parent="#accordionExample">

                                        <?php } ?>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="row mb-3">
                                                        <div class="col-lg-4 text-b"><p><b>School Name</b></p></div>
                                                        <div class="col-lg-8"><p><?php echo $schools->slug; ?></p></div>
                                                    </div><!-- row -->
                                                    <div class="row mb-3">
                                                        <div class="col-lg-4 text-b"><p><b>School Type</b></p></div>
                                                        <div class="col-lg-8"><p><?php echo $affiliation_name; ?> School</p></div>
                                                    </div><!-- row -->
                                                    <div class="row mb-3">
                                                        <div class="col-lg-4 text-b"><p><b>Grade Level</b></p></div>
                                                        <div class="col-lg-8"><p><?php echo $school_type; ?></p></div>
                                                    </div><!-- row -->
                                                    <div class="row mb-3">
                                                        <div class="col-lg-4 text-b"><p><b>Founded</b></p></div>
                                                        <div class="col-lg-8"><p><?php echo $schools->year_of_establish; ?></p></div>
                                                    </div><!-- row -->
                                                    <div class="row mb-3">
                                                        <div class="col-lg-4 text-b"><p><b>Activities</b></p></div>
                                                        <div class="col-lg-8"><p><?php  print_r($act_names); ?></p></div>
                                                    </div><!-- row -->
                                                    <div class="row mb-3">
                                                        <div class="col-lg-4 text-b"><p><b>Facilities</b></p></div>
                                                        <div class="col-lg-8"><p><?php echo $facility_names; ?></p></div>
                                                    </div><!-- row -->
                                                    <div class="row mb-3">
                                                        <div class="col-lg-4 text-b"><p><b>Address</b></p></div>
                                                        <div class="col-lg-8"><p><?php echo $schools->address; ?></p></div>
                                                    </div><!-- row -->
                                                    <div class="row mb-3">
                                                        <div class="col-lg-4 text-b"><p><b>Email</b></p></div>
                                                        <div class="col-lg-8"><p><?php echo $schools->email; ?></p></div>
                                                    </div><!-- row -->
                                                    <div class="row mb-3">
                                                        <div class="col-lg-4 text-b"><p><b>Phone Number</b></p></div>
                                                        <div class="col-lg-8"><p><?php echo $schools->mobile; ?></p></div>
                                                    </div><!-- row -->
                                                    <div class="row mb-3">
                                                        <div class="col-lg-4 text-b"><p><b>Website</b></p></div>
                                                        <div class="col-lg-8"><p><a href="<?php echo $website; ?>" target="_blank"><?php echo $website; ?> </a></p></div>
                                                    </div><!-- row -->
                                                </div><!-- /col-lg-6 -->

                                                <div class="col-lg-6">
                                                    <h2>Gallery Images</h2>
                                                    <p>(JPEG and PNG images are only acceptable!).</p>
                                                    <form action="<?php echo base_url() ?>plan-details/gallery?id=<?php echo base64_encode($userid); ?>" method="post" enctype="multipart/form-data">
                                                        <div class="input_fields_wrap mt-3">

                                                            <div class="input-group mb-2">
                                                                <div class="custom-file">
                                                                    <input type="file" class="custom-file-input" id="" aria-describedby="" accept="image/x-png,image/gif,image/jpeg" name="mytext[]">
                                                                    <label class="custom-file-label" for="">Choose file</label>
                                                                </div>
                                                                <div class="input-group-append">
                                                                    <button class="btn btn-secondary add_field_button" type="button" id="">Add More</button>
                                                                </div>
                                                            </div>

                                                            <div class="custom-file" style="display: none;">
                                                                <input type="hidden" class="custom-file-input" value="<?php echo $schools->slug; ?>" name="schoolname">
                                                            </div>
                                                            <div class="custom-file" style="display: none;">
                                                                <input type="hidden" class="custom-file-input" value="<?php echo $schools->id; ?>" name="schoolid">
                                                            </div>
                                                            <button class="btn btn-primary" >SUBMIT</button> 
                                                        </div><!-- /input_fields_wrap -->
                                                    </form>

                                                    <style>
                                                        .input-group-append .btn {
                                                            line-height: 1.65;
                                                            border-top-right-radius: 4px!important;
                                                            border-bottom-right-radius: 4px!important;
                                                        }
                                                    </style>

                                                </div><!-- /col-lg-6 -->
                                            </div><!-- /row -->

                                            <div class="accordion-buttons mt-3 text-right">
                                                <a class="btn btn-blue" href="<?php echo base_url() ?>package?id=<?php echo base64_encode($userid); ?>" target="_blank" role="button">Add More</a>
                                            </div>
                                        </div><!-- /card-body -->
                                    </div><!-- /collapse -->
                                </div><!-- /card -->

                                <style>
                                    body {
                                        font-family: 'Noto sans',sans-serif;
                                    }
                                </style>

                                <?php
                                $school_count++;
                        }
                    }
                        ?>

                        <?php
// institute plan listing
                        if ($institute->num_rows() > 0) {
                            // $institute_count = 1;

                            foreach ($institute->result() as $institutes) {
                                if ($institutes->position_id == 1) {
                                    $categoryname = "PLATINUM";
                                } elseif ($institutes->position_id == 2) {
                                    $categoryname = "PREMIUM";
                                } elseif ($institutes->position_id == 3) {
                                    $categoryname = "SPECTRUM";
                                } elseif ($institutes->position_id == 4) {
                                    $categoryname = "TRIAL";
                                }

                                $this->db->select('*')->where('id =', $institutes->category_id);
                                // $this->db->where('is_active =','1');
                                $this->db->from('institute_categories');
                                $category = $this->db->get();

                                foreach ($category->result() as $categories) {
                                    $category_name = $categories->category_name;
                                }

                                $institute_program = "is_active=1 AND institute_id=" . $institutes->id . " AND deleted_at is NULL";
                                $this->db->select('*')->where($institute_program);
                                $this->db->from('program_details');
                                $this->db->distinct();
                                $institute_program = $this->db->get();

                                $pro_name = array();

                                foreach ($institute_program->result() as $institute_programs) {

                                    $program_name = "id=" . $institute_programs->program_id . " AND deleted_at is NULL";
                                    $this->db->select('*')->where($program_name);
                                    $this->db->from('institute_programs');
                                    $program_name = $this->db->get();
                                    foreach ($program_name->result() as $program_names) {
                                        $pro_name[] = $program_names->program_name;
                                    }
                                }
                                if (isset($program_name)) {
                                    $program_name = implode(",", $pro_name);
                                } else {
                                    $program_name = "-";
                                }


                                if (isset($institutes->website_url)) {
                                    $website = $institutes->website_url;
                                } else {
                                    $website = "-";
                                }

                                if ($institute->num_rows() > 0) {
                                    // foreach ($institute->result() as $institutes) {
                                        $valitity = $institutes->valitity;
            
                                        $activate = new DateTime($institutes->activated_at);
                                        $act_date = $activate->getTimestamp();
                                        $date = new DateTime();
                                        $cur_date = $date->getTimestamp();
            
                                        $spend1 = round($cur_date / (60 * 60 * 24) - $act_date / (60 * 60 * 24));
                                        $remain1 = $valitity - $spend1;
                                        $exp_date = strtotime(+$valitity." days", $act_date);
                                        $expiry_date = date('Y-m-d',$exp_date);

                                    // }
                                }
                                ?>

                                <div class="card shadow mb-2">
                                    <div class="card-header" id="heading<?php echo $school_count; ?>">
                                        <h5 class="mb-0 p-2">
                                            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse<?php echo $school_count; ?>" aria-expanded="true" aria-controls="collapse<?php echo $school_count; ?>">
                                                <?php echo $institutes->slug; ?> <span class="badge badge-warning"><?php echo $categoryname; ?></span><?php if($institutes->status == NULL){ ?><span style="color:green;font-size:15px" >&nbsp;&nbsp;Institute is under validation</span><?php } else if($institutes->status == 2){ ?><span style="color:#F32013;font-size:15px" >&nbsp;&nbsp;Institute is rejected</span><?php }else if($institutes->status == 1){ if($remain1 > 0){ ?><span style="color:blue;font-size:15px">&nbsp;&nbsp;Expiry date- <?php echo $expiry_date; ?> ( <?php echo $remain1 ?>days to go )</span><?php } else if($remain1 <= 0){ ?><span style="color:red;font-size:15px">&nbsp;&nbsp;Your institute plan is expired</span><?php } ?><?php } ?>
                                            </button>
                                            <?php
                                            $test = $institutes->valitity * 60 * 60 * 24;

                                            $activate = new DateTime($institutes->activated_at);

                                            $date = new DateTime();

                                            // if ($date->getTimestamp() > $activate->getTimestamp() + $test) {
                                                ?>
                                                <!-- <a href="<?php echo base_url() ?>upgrade-package?id=<?php echo base64_encode($userid); ?>&iid=<?php echo base64_encode($institutes->id); ?>" class="upgrade" target="_blank">UPGRADE PLAN</a> -->

                                                <?php
                                            // } else {
                                                ?>
                                                <a href="" class="upgrade" data-toggle="modal" data-target="#exampleModalCenter2">UPGRADE PLAN</a>

                                                <?php
                                            // }
                                            ?>
                                        </h5>

                                    </div>

                                    <!-- Modal -->
                                    <div class="modal upgrade-modal fade" id="exampleModalCenter2" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalCenterTitle">Upgrade To Premium</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true"><i class="lnr lnr-cross"></i></span>
                                                    </button>
                                                </div>
                                                <div class="modal-body p-4">
                                                    <h5 class="mb-2">To upgrade premium membership please send the following details by mail.</h5>
                                                    <ul class="mb-2">
                                                        <li>Current Plan</li>
                                                        <li>School Details</li>
                                                        <li>Upgrade Plan</li>
                                                    </ul>
                                                    <p class="lead mb-2">Send email to <a href="mailto:support@edugatein.com">support@edugatein.com</a></p>
                                                    <p class="mb-3"><b>Note:</b> Your information will be added on website within 48 hours and intimated to you via email.</p>
                                                    <p>Toll Free Number: <a href="tel:1800120235600"><i class="fa fa-phone"></i> 1800-120-235600</a></p>
                                                </div>
                                            </div><!-- /modal-content -->
                                        </div>
                                    </div><!-- /modal -->


                                    <?php if ($school_count == 1) { ?>
                                        <div id="collapse<?php echo $school_count; ?>" class="collapse show" aria-labelledby="heading<?php echo $school_count; ?>" data-parent="#accordionExample">

                                        <?php } else { ?>
                                            <div id="collapse<?php echo $school_count; ?>" class="collapse" aria-labelledby="heading<?php echo $school_count; ?>" data-parent="#accordionExample">

                                            <?php } ?>
                                            <div class="card-body">
                                                <div class="row mb-3">
                                                    <div class="col-lg-3 text-b"><p>Institute Name</p></div>
                                                    <div class="col-lg-9"><p><?php echo $institutes->slug; ?></p></div>
                                                </div><!-- row -->
                                                <div class="row mb-3">
                                                    <div class="col-lg-3 text-b"><p>Institute Type</p></div>
                                                    <div class="col-lg-9"><p><?php echo $program_name; ?> School</p></div>
                                                </div><!-- row -->
                                                <div class="row mb-3">
                                                    <div class="col-lg-3 text-b"><p>Founded</p></div>
                                                    <div class="col-lg-9"><p><?php echo $institutes->year_of_establish; ?> School</p></div>
                                                </div><!-- row -->
                                                <div class="row mb-3">
                                                    <div class="col-lg-3 text-b"><p>Branches</p></div>
                                                    <div class="col-lg-9"><p><?php echo $institutes->branches; ?> School</p></div>
                                                </div><!-- row -->
                                                <div class="row mb-3">
                                                    <div class="col-lg-3 text-b"><p>proprietor name</p></div>
                                                    <div class="col-lg-9"><p><?php echo $institutes->proprietor_name; ?> School</p></div>
                                                </div><!-- row -->
                                                <div class="row mb-3">
                                                    <div class="col-lg-3 text-b"><p>Specials In</p></div>
                                                    <div class="col-lg-9"><p><?php echo $institutes->specials; ?> School</p></div>
                                                </div><!-- row -->
                                                <div class="row mb-3">
                                                    <div class="col-lg-3 text-b"><p>Address</p></div>
                                                    <div class="col-lg-9"><p><?php echo $institutes->address; ?></p></div>
                                                </div><!-- row -->
                                                <div class="row mb-3">
                                                    <div class="col-lg-3 text-b"><p>Email</p></div>
                                                    <div class="col-lg-9"><p><?php echo $institutes->email; ?></p></div>
                                                </div><!-- row -->
                                                <div class="row mb-3">
                                                    <div class="col-lg-3 text-b"><p>Phone Number</p></div>
                                                    <div class="col-lg-9"><p><?php echo $institutes->mobile; ?></p></div>
                                                </div><!-- row -->
                                                <div class="row mb-3">
                                                    <div class="col-lg-3 text-b"><p>Website</p></div>
                                                    <div class="col-lg-9"><p><a href="<?php echo $website; ?>" target="_blank"><?php echo $website; ?> </a></p></div>
                                                </div><!-- row -->

                                                <div class="accordion-buttons mt-3 text-right">
                                                    <a class="btn btn-blue" href="<?php echo base_url() ?>package?id=<?php echo base64_encode($userid); ?>" target="_blank" role="button">Add More</a>
                                                </div>
                                            </div><!-- /card-body -->
                                        </div><!-- /collapse -->
                                    </div><!-- /card -->
                                    <?php
                                    $school_count++;
                                }
                            }
                            ?>



                        </div><!-- /accordion -->


                    </div>
                </div><!-- /row -->
            </div><!-- /container -->
        </div><!-- /dashboard-content -->

        <!-- ============ Back-to-top ============ -->
        <div class="top-to-bottom">
            <a id="button">
                <i class="fa fa-chevron-up"></i>
            </a>
        </div><!-- /top-to-bottom --> 
        <script>
            $('a.logout').click(function () {
                return confirm('Are you sure want to logout....!!!')
            })

        </script>

        <style>
            .noclick  {
                pointer-events: none;
            }
        </style> 