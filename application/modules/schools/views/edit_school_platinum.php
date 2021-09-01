<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// $url = end($this->uri->segments);
// 	$this->db->select('*');
// 	$this->db->from('register');
// 	$this->db->where("id", $url);
// 	$check = $this->db->get();

$school_id = base64_decode($_GET['id']);
$this->db->select('*');
$this->db->from('school_details');
$this->db->where("id", $school_id);
$school = $this->db->get()->result_array();
$this->db->select('*');
$this->db->from('user_register');
$this->db->where("id", $school[0]['user_id']);
$user = $this->db->get()->result_array();
$userid = $user[0]['id'];

//getting selected affiliation
$this->db->select('*')->where('id',$school[0]['affiliation_id']);
$this->db->from('affiliations');
$affiliation = $this->db->get()->result_array();

//getting selected city
$this->db->select('*')->where('id',$school[0]['city_id']);
$this->db->from('cities');
$city1 = $this->db->get()->result_array();

//getting selected area
$this->db->select('*')->where('id', $school[0]['area_id']);
$this->db->from('areas');
$area = $this->db->get()->result_array();

//getting school activities
$this->db->select('*')->where('school_id', $school[0]['id']);
$this->db->from('school_images');
$school_img = $this->db->get()->result_array();
$this->db->select('si.id as image_id,si.school_id,si.images,sa.id as school_act_id,sa.activity_name');
$this->db->where('si.school_id', $school[0]['id']);
$this->db->join('school_activities as sa','si.school_activity_id = sa.id','left');
$this->db->from('school_images as si');
$school_activities=$this->db->get()->result_array();
$this->db->select('*')->where('school_id',$school[0]['id']);
$this->db->from('school_images as si');
$facility = $this->db->get()->result_array();

$this->db->select('*')->where('school_id',$school[0]['id']);
$this->db->from('platinum_datas');
$this->db->where('heading','Founded');
$founded = $this->db->get()->result_array();

$this->db->select('*')->where('school_id',$school[0]['id']);
$this->db->from('platinum_datas');
$this->db->where('heading','Special');
$special = $this->db->get()->result_array();

$this->db->select('*')->where('school_id',$school[0]['id']);
$this->db->from('platinum_datas');
$this->db->where('heading','Events');
$events = $this->db->get()->result_array();

$this->db->select('*')->where('school_id',$school[0]['id']);
$this->db->from('platinum_datas');
$this->db->where('heading','Achievements');
$achievements = $this->db->get()->result_array();

$this->db->select('*')->where('school_id',$school[0]['id']);
$this->db->from('platinum_datas');
$this->db->where('heading','Teachers');
$teachers = $this->db->get()->result_array();

$this->db->select('*')->where('school_id',$school[0]['id']);
$this->db->from('platinum_datas');
$this->db->where('heading','Branches');
$branches = $this->db->get()->result_array();

$this->db->select('*')->where('school_id',$school[0]['id']);
$this->db->from('platinum_datas');
$this->db->where('heading','Academic');
$academic = $this->db->get()->result_array();

$this->db->select('*')->where('school_id',$school[0]['id']);
$this->db->from('platinum_datas');
$this->db->where('heading','Language');
$language = $this->db->get()->result_array();

$this->db->select('*')->where('school_id',$school[0]['id']);
$this->db->from('platinum_datas');
$this->db->where('heading','activity');
$activity = $this->db->get()->result_array();

$this->db->select('*')->where('school_id',$school[0]['id']);
$this->db->from('platinum_datas');
$this->db->where('heading','Students');
$students = $this->db->get()->result_array();

$this->db->select('*')->where('schooldetails_id',$school[0]['id']);
$this->db->from('schoolmanagement_activities');
$management = $this->db->get()->result_array();
// echo "<pre>";print_r($management);exit;

$this->db->select('*');
// $this->db->where('school_id',$school[0]['id']);
$this->db->where('school_id',$school[0]['id']);
$this->db->from('school_facilities');
$school_facilities_datas = $this->db->get()->result_array();

$this->db->select('*');
$this->db->where('id',$school[0]['schooltype_id']);
$this->db->from('school_types');
$schooltype = $this->db->get()->result_array();

?>

<style>
    .noclick  {
        pointer-events: none;
    }
</style>

<!-- <div class="dashboard-menu">
    <div class="container">
        <ul class="list-inline">
            <li class="list-inline-item noclick"><a href="<?php echo base_url() ?>my-account"><i class="lnr lnr-user"></i> My Account</a></li>
            <li class="list-inline-item"><a href="<?php echo base_url() ?>package?id=<?php echo base64_encode($userid); ?>"><i class="lnr lnr-gift"></i> Package Details</a></li>
            <li class="list-inline-item"><a href="<?php echo base_url("logout") ?>"><i class="lnr lnr-exit"></i> Logout</a></li>
        </ul>
    </div> -->
    <!-- /container -->
<!-- </div> -->
<!-- /dashboard-menu -->

<div class="dashboard-content">
    <div class="container-fluid1">
        <div class="section-title mb-2">
            <h1><?php echo $school[0]["school_name"]; ?>
            <!-- <span>(Platinum Package)</span></h1> -->
            <div class="status-btn">
                <?php if(empty($school[0]['status'])){ ?>
                <button class="btn btn-warning" title="Holded" disabled ><i class="bi bi-hourglass-bottom"></i> Holded</button>
                <a href="<?php echo base_url() ?>schools/admin/approve_school/<?php echo base64_encode($school_id); ?>"><button class="btn btn-success" title="Approve"> Approve</button></a>
                <a href="<?php echo base_url() ?>schools/admin/reject_school/<?php echo base64_encode($school_id); ?>"><button class="btn btn-danger" title="Reject">Reject</button></a>
                <?php } ?>
                <?php if($school[0]['status'] == 2 && $school[0]['status'] != NULL){ ?>
                <a href="<?php echo base_url() ?>schools/admin/hold_school/<?php echo base64_encode($school_id); ?>"><button class="btn btn-warning" title="Hold">Hold</button></a>
                <a href="<?php echo base_url() ?>schools/admin/approve_school/<?php echo base64_encode($school_id); ?>"><button class="btn btn-success" title="Approve">Approve</button></a>
                <button class="btn btn-danger" title="Rejected" disabled ><i class="bi bi-x-circle"></i> Rejected</button>
                <?php } ?>
                <?php if($school[0]['status']== 1){ ?>
                <a href="<?php echo base_url() ?>schools/admin/hold_school/<?php echo base64_encode($school_id); ?>"><button class="btn btn-warning" title="Hold">Hold</button></a>
                <button class="btn btn-success" title="Approved" disabled ><i class="bi bi-check2-square"></i> Approved </button>
                <a href="<?php echo base_url() ?>schools/admin/reject_school/<?php echo base64_encode($school_id); ?>"><button class="btn btn-danger" title="Reject">Reject</button></a>
                <?php } ?>
            </div>
        </div><!-- /section-title -->
        <div class="listing-section mat-30">
            <form action="<?php echo base_url() ?>schools/admin/update_school" method="post" enctype="multipart/form-data">
            <div class="edit-school-inner">
                <div class="form-row">
                    <div class="col-lg-3 col-sm-6" style="display:none">
                        <div class="form-group">
                        <input type="hidden" value=<?php echo $school_id; ?> class="form-control" id="school_id" name="school_id">
                            <label for="user_id">user id</label>
                            <input type="text" class="form-control" id="user_id" name="user_id" value="<?php echo $userid; ?>" placeholder="e.g. Haunuz Matriculation" required>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="form-group">
                            <label for="schoolname">School Name</label>
                            <input type="text" class="form-control" name="schoolname" id="schoolname" value="<?php echo $school[0]["school_name"];?>" placeholder="e.g. Haunuz Matric School" required>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="form-group">
                            <label for="schoolboard">School Board</label>
                            <select class="form-control" name="schoolboard" id="exampleFormControlSelect1" required>
                                <option value="" >e.g. Matriculation School</option>
                                <option value="cbse"<?php if('cbse' == $affiliation[0]['affiliation_name']){echo "selected";} ?>>CBSE School</option>
                                <option value="international"<?php if('international' == $affiliation[0]['affiliation_name']){echo "selected";} ?>>International School</option>
                                <option value="matriculation"<?php if('matriculation' == $affiliation[0]['affiliation_name']){echo "selected";} ?>>Matriculation School</option>
                                <option value="special"<?php if('special' == $affiliation[0]['affiliation_name']){echo "selected";} ?>>Special School</option>
                                <option value="kindergarten"<?php if('kindergarten' == $affiliation[0]['affiliation_name']){echo "selected";} ?>>Kindergarten</option>
                                <!-- <option>Other</option> -->
                            </select>
                        </div>
                    </div>


                    <div class="col-lg-3 col-sm-6">
                        <div class="form-group">
                            <label for="city">City</label>
                            <select class="form-control" name="city" id="exampleFormControlSelect1" required>
                                <option value="">--Select City--</option>
                                <?php
                                $this->db->select('*');
                                $this->db->from('cities');
                                $city = $this->db->get();
                                foreach ($city->result() as $citys) {
                                    ?>
                                        <option value="<?php echo $citys->city_name; ?>" <?php if($citys->city_name == $city1[0]['city_name']){echo "selected";} ?>><?php echo $citys->city_name; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="form-group">
                            <label for="area">Area</label>
                            <input type="text" name="area" class="form-control" id="area" value="<?php echo $area[0]['area_name'];?>" placeholder="e.g.Nallampalayam" required>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="form-group">
                            <label for="level">Grade Level</label>
                            <select class="form-control" name="level" id="exampleFormControlSelect1" required>
                                <option value="" >e.g. Elementary School</option>
                                <option value="Elementary School"<?php if($schooltype[0]['school_type']=="Elementary School"){echo "selected";}?>>Elementary School</option>
                                <option value="Preschools"<?php if($schooltype[0]['school_type']=="Preschools"){echo "selected";}?>>Preschools</option>
                                <option value="High School"<?php if($schooltype[0]['school_type']=="High School"){echo "selected";}?>>High School</option>
                                <option value="Higher Secondary School"<?php if($schooltype[0]['school_type']=="Higher Secondary School"){echo "selected";}?>>Higher Secondary School</option>
                                <option value="Special school"<?php if($schooltype[0]['school_type']=="Special school"){echo "selected";}?>>Special school</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-5 col-sm-6">
                        <div class="form-group">
                            <label for="ad">Admission Info</label>
                            <input type="text" name="ad" class="form-control" id="ad" value="<?php echo $school[0]['ad'];?>" placeholder="e.g.Admissions open now, please be hurry!..." >
                        </div>
                    </div>
                </div><!-- /form-row -->

                <ul class="list-inline">
                    <li class="list-inline-item mr-5">
                        <div class="yesorno">
                            <label for="customRadio1">Eligibility to Avail Admission Under the RTE Act</label>
                            <div class="form-row ml-0">
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="customRadio1" name="customRadio2" value="1" <?php if($school[0]['rte']=='1'){echo "checked";} ?> class="custom-control-input" >
                                    <label class="custom-control-label" style="margin-top: 0px!important;" for="customRadio1">Yes</label>&nbsp; &nbsp; &nbsp; 
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="customRadio2" name="customRadio2" value="0" <?php if($school[0]['rte']=='0'){echo "checked";} ?>  class="custom-control-input">
                                    <label class="custom-control-label" style="margin-top: 0px!important;" for="customRadio2">No</label>
                                </div>
                            </div><!-- /form-row -->
                        </div><!-- /yesorno -->
                    </li>

                    <li class="list-inline-item">
                        <div class="yesorno">
                            <label for="customRadio2">Hostel Facility</label>
                            <div class="form-row ml-0">
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="customRadio3" name="customRadio1"  value="1" <?php if($school[0]['hostel']=='1'){echo "checked";}?> class="custom-control-input" >
                                    <label class="custom-control-label" style="margin-top: 0px!important;" for="customRadio3">Yes</label>&nbsp; &nbsp; &nbsp; 
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="customRadio4" name="customRadio1"  value="0" <?php if($school[0]['hostel']=='0'){echo "checked";}?>  class="custom-control-input">
                                    <label class="custom-control-label" style="margin-top: 0px!important;" for="customRadio4">No</label>
                                </div>
                            </div><!-- /form-row -->
                        </div><!-- /yesorno -->
                    </li>
                </ul>
            </div>
            <div class="edit-school-inner">
            <h4 class="mb-3">Banner Image</h4>
                    <hr class="mb-4">
                <div class="form-row mat-30">
                    <div class="col-lg-6 col-sm-6 file-img-upload">
                        <label for="banner" style="margin-bottom: 0px;">Add Banner Images</label>
                        <small style="display: block;font-weight: 300;" class="mb-3">You can add 3 banner images in Platinum package.</small>
                        <div class="input-group mb-3">
                            <div class="custom-file">
                                <input type="file" name="banner1" accept="image/x-png,image/gif,image/jpeg" class="custom-file-input" id="inputGroupFile02">
                                <label class="custom-file-label" for="inputGroupFile02" aria-describedby="inputGroupFileAddon02">Choose file</label>
                            </div>
                        </div><!-- /input-group -->
                        <div class="input-group mb-3">
                            <div class="custom-file">
                                <input type="file" name="banner2" accept="image/x-png,image/gif,image/jpeg" class="custom-file-input" id="inputGroupFile03" >
                                <label class="custom-file-label" for="inputGroupFile03" aria-describedby="inputGroupFileAddon02">Choose file</label>
                            </div>
                        </div><!-- /input-group -->
                        <div class="input-group mb-3">
                            <div class="custom-file">
                                <input type="file" name="banner3" accept="image/x-png,image/gif,image/jpeg" class="custom-file-input" id="inputGroupFile04">
                                <label class="custom-file-label" for="inputGroupFile04" aria-describedby="inputGroupFileAddon02">Choose file</label>
                            </div>
                        </div><!-- /input-group -->

                        <div class="form-row">
                            <div class="col-lg-12">
                                <div class="alert alert-success mab-30" role="alert">
                                    <p class="image-note">Banner images are highly visible for Platinum package. So choose your images in high quality to attract peoples.</p>
                                </div>
                            </div>
                        </div>
                    </div><!-- /file-img-upload -->
                    <div class="col-lg-6">
                        <label for="bannerimagesample" class="mab-30"> Images</label>
                        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                                <ol class="carousel-indicators">
                                    <?php for($i=0;$i<(count($school_img) + count($school_facilities_datas ));$i++){ ?>
                                        <li data-target="#carouselExampleIndicators" data-slide-to="<?php echo $i ?>" class="<?php if($i==0){echo 'active';} ?>"></li>
                                    <?php } ?>
                                </ol>
                            <div class="carousel-inner">
                                <?php $activeslide = true; ?>
                                <?php foreach($school_img as $key=>$image){ ?>
                                    <div class="carousel-item <?php if($activeslide){echo 'active';$activeslide = false;} ?> ">
                                    <img class="d-block w-100" src="<?php echo base_url("/laravel/public/"); ?><?php echo $image['images'] ?> " alt="<?php echo $key ?> slide">
                                    </div>
                                <?php } ?>
                                <?php foreach($school_facilities_datas as $key=>$image){ ?>
                                    <div class="carousel-item <?php if($activeslide){echo 'active';$activeslide = false;} ?> ">
                                    <img class="d-block w-100" src="<?php echo base_url("/laravel/public/"); ?><?php echo $image['image'] ?> " alt="<?php echo $key ?> slide">
                                    </div>
                                <?php } ?>
                                </div>
                                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>
                    </div>
                </div><!-- /form-row -->
            </div>
            <div class="edit-school-inner">

                <h4 class="mb-2">Additional Info</h4>
                <p class="mb-3">Only 6 additional infos are displayed.</p>
                <hr class="mb-4">
                <div class="form-row mt-3">
                    <div class="col-lg-4 col-sm-6">
                        <div class="form-group">
                            <label for="founded">Founded</label>
                            <input type="text" name="founded" class="form-control" id="founded" value="<?php echo $founded[0]['content'];?>" placeholder="e.g.1980">
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <div class="form-group">
                            <label for="special">Special</label>
                            <input type="text" name="special" class="form-control" id="special" value="<?php echo $special[0]['content'];?>" placeholder="e.g.French class">
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <div class="form-group">
                            <label for="students">No.of Students</label>
                            <input type="text" name="students" class="form-control" id="students" value="<?php echo $students[0]['content'];?>" placeholder="e.g.2005">
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <div class="form-group">
                            <label for="events">Events</label>
                            <input type="text"  name="events" class="form-control" id="events" value="<?php echo $events[0]['content'];?>" placeholder="e.g.Annual Day celebration">
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <div class="form-group">
                            <label for="achievements">Achievements</label>
                            <input type="text" name="achievements" class="form-control" id="achievements" value="<?php echo $achievements[0]['content'];?>" placeholder="e.g.First in Sports">
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <div class="form-group">
                            <label for="teachers">No.of Teachers</label>
                            <input type="text" name="teachers" class="form-control" id="teachers" value="<?php echo $teachers[0]['content'];?>" placeholder="e.g.55">
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <div class="form-group">
                            <label for="branches">Branches</label>
                            <input type="text" name="branches" class="form-control" id="branches" value="<?php echo $branches[0]['content'];?>" placeholder="e.g. Coimbatore,Thei, Erode">
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <div class="form-group">
                            <label for="academic">Academic History</label>
                            <input type="text" name="academic" class="form-control" id="academic" value="<?php echo $academic[0]['content'];?>" placeholder="e.g.Last year 98% Results">
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <div class="form-group">
                            <label for="language">Languages</label>
                            <input type="text" name="language" class="form-control" id="language" value="<?php echo $language[0]['content'];?>" placeholder="e.g.French">
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <div class="form-group">
                            <label for="activity">Activity</label>
                            <input type="text" name="activity1" class="form-control" id="activity" value="<?php echo $activity[0]['content'];?>" placeholder="e.g.Martial Arts">
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <div class="form-group">
                            <label for="academic">No of Boys</label>
                            <input type="text" name="boys" class="form-control" id="academic" value="<?php echo $school[0]['boys']; ?>"placeholder="No of Boys">
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <div class="form-group">
                            <label for="academic">No of Girls</label>
                            <input type="text" name="girls" class="form-control" id="academic" value="<?php echo $school[0]['girls']; ?>" placeholder="No of Girls">
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <div class="form-group">
                            <label for="academic">Vision</label>
                            <textarea class="form-control" name="our_vision" id="our_vision" rows="1" style="height: 130px;"><?php echo $school[0]['our_vision']; ?></textarea >
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <div class="form-group">
                            <label for="academic">Mission</label>
                            <textarea class="form-control" name="our_mission" id="our_mission" rows="1" style="height: 130px;"><?php echo $school[0]['our_mission']; ?></textarea >
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <div class="form-group">
                            <label for="academic">Motto</label>
                            <textarea class="form-control" name="our_motto" id="our_motto" rows="1" style="height: 130px;"><?php echo $school[0]['our_motto']; ?></textarea >
                        </div>
                    </div>
                </div><!-- /form-row -->
            </div>
            <div class="edit-school-inner">

                <h4 class="mb-3">About Info</h4>
                <hr class="mb-4">
                <div class="form-row mt-3">
                    <div class="col-lg-6 col-sm-6">
                        <div class="form-group">
                            <label for="about">About Description</label>
                            <textarea class="form-control" name="description" id="about" rows="1" style="height: 130px;"><?php echo $school[0]['about']; ?></textarea >
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6">
                        <label for="aboutimg1">About Image 1</label>
                        <div class="input-group mb-3">
                            <div class="custom-file">
                                <input type="file" name="aboutimg1" class="custom-file-input" accept="image/x-png,image/gif,image/jpeg" id="inputGroupFile01" aria-describedby="aboutimg1" >
                                <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                            </div>
                        </div>

                        <label for="aboutimg2">About Image 2</label>
                        <div class="input-group mb-3">
                            <div class="custom-file">
                                <input type="file" name="aboutimg2" class="custom-file-input" accept="image/x-png,image/gif,image/jpeg" id="inputGroupFile01" aria-describedby="aboutimg2" >
                                <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                            </div>
                        </div>
                    </div>
                    <?php $selectedActivity = array();
                     foreach($management as $key=>$management_data){ 
                        $selectedActivity[] = $management_data['activity_name'];
                      } ?>
                    <div class="col-lg-12 col-sm-6">
                        <h5 class="pink mt-2">Special Info</h5>
                        <ul class="list-inline">
                            <li class="list-inline-item">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" name="playground" value="playground" <?php if( in_array('playground',$selectedActivity)){echo "checked";} ?> class="custom-control-input" id="customControlValidation1">
                                    <label class="custom-control-label" for="customControlValidation1">Playground</label>
                                </div><!-- /custom-checkbox -->
                            </li>
                            <li class="list-inline-item">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" name="kidsplay" value="kidsplay" <?php if( in_array('kidsplay',$selectedActivity)){echo "checked";} ?> class="custom-control-input" id="customControlValidation2">
                                    <label class="custom-control-label" for="customControlValidation2">Kids Playcorner</label>
                                </div><!-- /custom-checkbox -->
                            </li>
                            <li class="list-inline-item">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" name="transport"  value="transport" <?php if( in_array('transport',$selectedActivity)){echo "checked";} ?> class="custom-control-input" id="customControlValidation3">
                                    <label class="custom-control-label" for="customControlValidation3">Transportation</label>
                                </div><!-- /custom-checkbox -->
                            </li>
                            <li class="list-inline-item">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" name="curriculam" value="curriculam" <?php if( in_array('curriculam',$selectedActivity)){echo "checked";} ?> class="custom-control-input" id="customControlValidation4">
                                    <label class="custom-control-label" for="customControlValidation4">Curriculam</label>
                                </div><!-- /custom-checkbox -->
                            </li>
                            <li class="list-inline-item">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" name="fieldtrips" value="fieldtrips" <?php if( in_array('fieldtrips',$selectedActivity)){echo "checked";} ?> class="custom-control-input" id="customControlValidation5">
                                    <label class="custom-control-label" for="customControlValidation5">Field Trips</label>
                                </div><!-- /custom-checkbox -->
                            </li>
                            <li class="list-inline-item">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" name="specialactivity" value="special activity" <?php if( in_array('special activity',$selectedActivity)){echo "checked";} ?> class="custom-control-input" id="customControlValidation6">
                                    <label class="custom-control-label" for="customControlValidation6">Activity</label>
                                </div><!-- /custom-checkbox -->
                            </li>
                            <li class="list-inline-item">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" name="progressive" value="progressive" <?php if( in_array('progressive',$selectedActivity)){echo "checked";} ?> class="custom-control-input" id="customControlValidation7">
                                    <label class="custom-control-label" for="customControlValidation7">Progressive Learning</label>
                                </div><!-- /custom-checkbox -->
                            </li>
                            <li class="list-inline-item">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" name="opportunities" value="opportunities" <?php if( in_array('opportunities',$selectedActivity)){echo "checked";} ?> class="custom-control-input" id="customControlValidation8">
                                    <label class="custom-control-label" for="customControlValidation8">Opportunities</label>
                                </div><!-- /custom-checkbox -->
                            </li>
                            <li class="list-inline-item">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" name="clubs" value="clubs" <?php if( in_array('clubs',$selectedActivity)){echo "checked";} ?> class="custom-control-input" id="customControlValidation9">
                                    <label class="custom-control-label" for="customControlValidation9">Clubs</label>
                                </div><!-- /custom-checkbox -->
                            </li>
                            <li class="list-inline-item">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" name="infrastructure" value="infrastructure" <?php if( in_array('infrastructure',$selectedActivity)){echo "checked";} ?> class="custom-control-input" id="customControlValidation10">
                                    <label class="custom-control-label" for="customControlValidation10">Infrastructure</label>
                                </div><!-- /custom-checkbox -->
                            </li>
                        </ul>
                    </div>
                  
                </div><!-- /form-row -->
            </div>
            <?php if(isset($school_activities[0])){ ?>
            <div class="edit-school-inner">
                <h4 class="mb-3">School Activities</h4>
                <hr class="mb-4">
                <?php foreach($school_activities as $key=>$school_activities1){ ?>
                <div class="form-row" id="actmore">
                    <div class="col-lg-3 col-sm-6">
                        <div class="form-group">
                            <?php if($key==0){ ?><label for="activity1">Activity Name</label><?php } ?>
                            <input type="text" name="activity[]" class="form-control" id="activity1" value="<?php echo $school_activities1['activity_name']; ?>"placeholder="e.g.Sports" >
                        </div>
                    </div>
                    <div class="col-lg-7 col-sm-6">
                        <?php if($key==0){ ?><label for="activityimage1">Activity Image</label><?php } ?>
                            <input type="hidden" name="activityid[]" value="<?php echo $school_activities1['school_act_id']; ?>">
                            <input type="hidden" name="activityimage_id[]" value="<?php echo $school_activities1['image_id']; ?>">
                            <input type="hidden" name="activityoldimage[]" value="<?php echo $school_activities1['images']; ?>">
                            <div class="input-group mb-3">
                            <div class="custom-file">
                                <input type="file" name="activityimage[]" class="custom-file-input" accept="image/x-png,image/gif,image/jpeg,image/jpg" id="activityimage1" >
                                <label class="custom-file-label" for="activityimage1">Choose file</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-row" id="actmore">
                        <div class="col-lg-4 col-sm-6 form-group">
                            <label for="addmore" style="visibility: hidden;display: block;">Add More</label>
                            <?php if($key==0){ ?><a class="btn btn-primary add_field_button1" id="addmore">Add More</a><?php } ?>
                        </div>
                    </div>
                </div><!-- /form-row -->
                <?php } ?>
            </div>
            <?php } else {?>
                <div class="edit-school-inner">
                    <h4 class="mb-3">School Activities</h4>
                    <hr class="mb-4">
                    <div class="form-row" id="actmore">
                        <div class="col-lg-4 col-sm-6 form-group">
                            <label for="addmore" style="visibility: hidden;display: block;">Add More</label>
                            <?php if($key==0){ ?><a class="btn btn-primary add_field_button1" id="addmore">Add</a><?php } ?>
                        </div>
                    </div>
                </div>
                <?php } ?>
                    <?php if(isset($school_facilities_datas[0])){ ?>
            <div class="edit-school-inner">
                <h4 class="mb-3">School Facilities</h4>
                <hr class="mb-4">
                <?php foreach($school_facilities_datas as $key=>$school_facilities_data){ ?>
                    <div class="form-row" id="facilitymore">
                        <div class="col-lg-3 col-sm-6">
                            <div class="form-group">
                               <?php if($key==0){ ?> <label for="facility1">Facility Name</label> <?php } ?>
                                <input type="text" name="facility[]" class="form-control" id="facility1" value="<?php echo $school_facilities_data['facility']; ?>" placeholder="e.g.Library" >
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6">
                            <?php if($key==0){ ?><label for="facilityimage1">Facility Images</label><?php } ?>
                            <div class="input-group mb-3">
                                <input type="hidden" name="facilityid[]" value="<?php echo $school_facilities_data['id']; ?>">
                                <input type="hidden" name="facilityoldimage[]" value="<?php echo $school_facilities_data['image']; ?>">
                                <div class="custom-file">
                                    <input type="file" name="facilityimage[]" class="custom-file-input" accept="image/x-png,image/gif,image/jpeg,image/jpg" id="facilityimage1" aria-describedby="facilityimage1" >
                                    <label class="custom-file-label" for="facilityimage1">Choose file</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6">
                            <div class="form-group">
                                <?php if($key==0){ ?><label for="facilitydes1">Facility Description</label><?php } ?>
                                <textarea class="form-control" name="facilitydesc[]" id="facilitydes1" rows="1" ><?php echo $school_facilities_data['content']; ?></textarea>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6">
                            <div class="form-group">
                                <label for="facaddmore" style="visibility: hidden;display: block;">Add More</label>
                                <?php if($key==0){?><a class="btn btn-primary addmore-show1" id="facaddmore">Add More</a><?php }?>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <?php } else { ?>
                <div class="edit-school-inner">
                    <h4 class="mb-3">School Facilities</h4>
                    <hr class="mb-4">
                    <div class="form-row" id="facilitymore">
                        <div class="col-lg-3 col-sm-6">
                            <div class="form-group">
                                <label for="facaddmore" style="visibility: hidden;display: block;">Add More</label>
                                <a class="btn btn-primary addmore-show1" id="facaddmore">Add</a>
                            </div>
                        </div>
                    </div>
                </div>
                        <?php } ?>
            <div class="edit-school-inner">

                <h4 class="mb-3">Location</h4>
                <hr class="mb-4">
                <div class="form-row">
                    <div class="col-lg-4 col-sm-6">
                        <div class="form-group">
                            <label for="phone">Phone Number</label>
                            <input type="text" name="phone" class="form-control" id="phone" value="<?php echo $school[0]['mobile']; ?>" placeholder="e.g.+91 9876543210">
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" class="form-control" id="email" value="<?php echo $school[0]['email']; ?>" placeholder="e.g.admin@gmail.com">
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <div class="form-group">
                            <label for="website">Website</label>
                            <input type="text" name="website" class="form-control" id="website" value="<?php echo $school[0]['website_url']; ?>" placeholder="e.g.www.yourwebsite.com">
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <div class="form-group">
                            <label for="website">Map</label>
                            <input type="text" name="map_url" class="form-control" id="website" value="<?php echo $school[0]['map_url']; ?>" placeholder="https://www.google.com/maps/@11.0231552,76.9523712,15z">
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <div class="form-group">
                            <label for="address">Address</label>
                            <textarea class="form-control" name="address" id="address" rows="1" style="height: 80px;"><?php echo $school[0]['address']; ?></textarea>
                        </div>
                    </div>
                </div><!-- /form-row -->
            </div>
            <div class="edit-school-inner">

                <h4 class="mb-3">Social Links</h4>
                <hr class="mb-4">
                <div class="form-row">
                    <div class="col-lg-4 col-sm-6">
                        <div class="form-group">
                            <label for="facebook">Facebook</label>
                            <input type="text" class="form-control" name="facebook" id="facebook" value="<?php echo $school[0]['facebook']; ?>" placeholder="e.g.+91 9876543210">
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <div class="form-group">
                            <label for="twitter">Twitter</label>
                            <input type="text" class="form-control" name="twitter" id="twitter" value="<?php echo $school[0]['twitter']; ?>" placeholder="e.g.admin@gmail.com">
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <div class="form-group">
                            <label for="instagram">Instagram</label>
                            <input type="text" class="form-control" name="instagram" id="instagram" value="<?php echo $school[0]['instagram']; ?>" placeholder="e.g.www.yourwebsite.com">
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <div class="form-group">
                            <label for="linkedin">Linked in</label>
                            <input type="text" class="form-control" name="linkedin" id="linkedin" value="<?php echo $school[0]['linkedin']; ?>" placeholder="e.g.www.yourwebsite.com">
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <div class="form-group">
                            <label for="pinterest">Pinterest</label>
                            <input type="text" class="form-control" name="pinterest" id="pinterest" value="<?php echo $school[0]['pinterest']; ?>"placeholder="e.g.www.yourwebsite.com">
                        </div>
                    </div>
                </div><!-- /form-row -->
            </div>
            <div class="edit-school-inner">
                <button class="btn btn-primary btn-save" id="formsubmit">SUBMIT</button>
            </div><br>
            </form>
        </div><!-- /listing-section -->
    </div><!-- /container -->
</div><!-- /dashboard-content -->
<script>
    $(document).ready(function () {

        //activity add more
        var max_fields = 50; //maximum input boxes allowed
        var activity = $("#actmore"); //Fields wrapper
        var act_button = $("#addmore"); //Add button ID

        var x = 1; //initlal text box count
        $(act_button).click(function (e) { //on add input button click
            e.preventDefault();
            if (x < max_fields) { //max input box allowed
                x++; //text box increment
                $(activity).append('<div class="form-row w-100 mx-0" id="actmore"><div class="col-lg-4 col-sm-6 form-group"><input type="text" class="form-control" id="activity[]" name="activity[]" placeholder="Sports"></div><input type="hidden" name="activityid[]" value=""><input type="hidden" name="activityimage_id[]" value=""><input type="hidden" name="activityoldimage[]" value=""><div class="col-lg-4 col-sm-6"><div class="input-group mb-3 custom-file"><input type="hidden" name="activityid[]" value="0"><input type="file" class="" id="activityimage[]" name="activityimage[]" accept="image/x-png,image/jpg,image/jpeg,image/x-PNG,image/JPG,image/JPEG" aria-describedby=""></div></div><div class="col-lg-3 col-sm-6 remove_field"><a href="#" class="btn btn-danger ">Remove</a></div></div>'); //add input box
            }
        });

        $(activity).on("click", ".remove_field", function (e) { //user click on remove text
            e.preventDefault();
            $(this).parent('div').remove();
            x--;
        })


            //facility add more

        var max_fields = 50; //maximum input boxes allowed
        var facility = $("#facilitymore"); //Fields wrapper
        var fac_button = $("#facaddmore"); //Add button ID

        var x = 1; //initlal text box count
        $(fac_button).click(function (e) { //on add input button click
            e.preventDefault();
            if (x < max_fields) { //max input box allowed
                x++; //text box increment
                $(facility).append('<div class="form-row w-100 mx-0" id="facilitymore"><input type="hidden" name="facilityid[]" value=""><input type="hidden" name="facilityoldimage[]" value=""><div class="col-lg-3 col-sm-6"><div class="form-group"><input type="text" class="form-control" id="facility[]" name="facility[]" placeholder="Library"></div></div><div class="col-lg-3 col-sm-6"><div class="input-group mb-3"><div class="custom-file"><input type="file" name="facilityimage[]" class="custom-file-input" accept="image/x-png,image/gif,image/jpeg,image/jpg" id="facilityimage1" aria-describedby="facilityimage1" ><label class="custom-file-label" for="facilityimage1">Choose file</label></div></div></div><div class="col-lg-3 col-sm-6"><div class="form-group"><textarea class="form-control" id="facilitydesc[]" name="facilitydesc[]" rows=""></textarea></div></div><div class="col-lg-3 col-sm-6 remove_field1"><a href="#" class="btn btn-danger">Remove</a></div></div>');
            }
        });

        $(facility).on("click", ".remove_field1", function (e) { //user click on remove text
            e.preventDefault();
            $(this).parent('div').remove();
            x--;
        })

    });
</script>