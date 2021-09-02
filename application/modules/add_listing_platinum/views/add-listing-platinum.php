<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// $url = end($this->uri->segments);
// 	$this->db->select('*');
// 	$this->db->from('register');
// 	$this->db->where("id", $url);
// 	$check = $this->db->get();

$userid = base64_decode($_GET['id']);

$this->db->select('*');
$this->db->from('user_register');
$this->db->where("id", $userid);
$user = $this->db->get();

foreach ($user->result() as $users) {
    $username = $users->name;
    $userid = $users->id;
}
?>

<style>
    .noclick  {
        pointer-events: none;
    }
</style>

<div class="dashboard-menu">
    <div class="container">
        <ul class="list-inline">
            <li class="list-inline-item noclick"><a href="<?php echo base_url() ?>my-account"><i class="lnr lnr-user"></i> My Account</a></li>
            <li class="list-inline-item"><a href="<?php echo base_url() ?>package?id=<?php echo base64_encode($userid); ?>"><i class="lnr lnr-gift"></i> Package Details</a></li>
            <li class="list-inline-item"><a href="<?php echo base_url("logout") ?>"><i class="lnr lnr-exit"></i> Logout</a></li>
        </ul>
    </div><!-- /container -->
</div><!-- /dashboard-menu -->

<div class="dashboard-content">
    <div class="container">
        <div class="section-title mb-3">
            <h1>Enter your details</h1>
            <span>(Platinum Package)</span>
        </div><!-- /section-title -->
        <hr>
        <div class="listing-section mat-30">
            <form action="<?php echo base_url() ?>add_listing_platinum/insert" id="platinum" method="post" enctype="multipart/form-data">
                <div class="form-row">
                    <div class="col-lg-3 col-sm-6" style="display:none">
                        <div class="form-group">
                            <label for="user_id">user id</label>
                            <input type="text" class="form-control" id="user_id" name="user_id" value="<?php echo $userid; ?>" placeholder="e.g. Haunuz Matriculation" required>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="form-group">
                            <label for="schoolname">School Name</label>
                            <input type="text" class="form-control" name="schoolname" id="schoolname" placeholder="e.g. Haunuz Matric School" >
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="form-group">
                            <label for="schoolboard">School Board</label>
                            <select class="form-control" name="schoolboard" id="exampleFormControlSelect1" required>
                                <option value="" >e.g. Matriculation School</option>
                                <option value="cbse">CBSE School</option>
                                <option value="international">International School</option>
                                <option value="matriculation">Matriculation School</option>
                                <option value="special">Special School</option>
                                <option value="kindergarten">Kindergarten</option>
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
                                    <option value="<?php echo $citys->city_name; ?>"><?php echo $citys->city_name; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="form-group">
                            <label for="area">Area</label>
                            <input type="text" name="area" class="form-control" id="area" placeholder="e.g.Nallampalayam" required>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="form-group">
                            <label for="area">Pincode</label>
                            <input type="text" name="pincode" class="form-control" id="area" placeholder="654001" required>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="form-group">
                            <label for="level">Grade Level</label>
                            <select class="form-control" name="level" id="exampleFormControlSelect1" required>
                                <option value="" >e.g. Elementary School</option>
                                <option value="Elementary School">Elementary School</option>
                                <option value="Preschools">Preschools</option>
                                <option value="High School">High School</option>
                                <option value="Higher Secondary School">Higher Secondary School</option>
                                <option value="Special school">Special school</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-5 col-sm-6">
                        <div class="form-group">
                            <label for="ad">Admission Info</label>
                            <input type="text" name="ad" class="form-control" id="ad" placeholder="e.g.Admissions open now, please be hurry!..." >
                        </div>
                    </div>
                </div><!-- /form-row -->

                <ul class="list-inline">
                    <li class="list-inline-item mr-5">
                        <div class="yesorno">
                            <label for="customRadio1">Eligibility to Avail Admission Under the RTE Act</label>
                            <div class="form-row">
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="customRadio1" name="customRadio1" value="1" class="custom-control-input" >
                                    <label class="custom-control-label" style="margin-top: 0px!important;" for="customRadio1">Yes</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="customRadio2" name="customRadio1" value="0"  class="custom-control-input">
                                    <label class="custom-control-label" style="margin-top: 0px!important;" for="customRadio2">No</label>
                                </div>
                            </div><!-- /form-row -->
                        </div><!-- /yesorno -->
                    </li>

                    <li class="list-inline-item">
                        <div class="yesorno">
                            <label for="customRadio2">Hostel Facility</label>
                            <div class="form-row">
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="customRadio3" name="customRadio2"  value="1"  class="custom-control-input" >
                                    <label class="custom-control-label" style="margin-top: 0px!important;" for="customRadio3">Yes</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="customRadio4" name="customRadio2"  value="0"  class="custom-control-input">
                                    <label class="custom-control-label" style="margin-top: 0px!important;" for="customRadio4">No</label>
                                </div>
                            </div><!-- /form-row -->
                        </div><!-- /yesorno -->
                    </li>
                </ul>
                <hr class="mt-4">

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
                                <div class="alert alert-primary mab-30" role="alert">
                                    <p class="image-note">Banner images are highly visible for Platinum package. So choose your images in high quality to attract peoples.</p>
                                </div>
                            </div>
                        </div>
                    </div><!-- /file-img-upload -->

                    <div class="col-lg-6">
                        <label for="bannerimagesample" class="mab-30">Banner Image Sample</label>
                        <div class="object-fit" style="width: 100%;height: 230px;">
                            <img src="<?php echo base_url("assets/front/images/"); ?>dashboard/1st-banner.jpg" class="w-100 rounded" alt="" style="width: 100%;height: 230px;object-fit: cover;">	
                        </div>
                    </div>
                </div><!-- /form-row -->

                <h4 class="mt-4 mb-2">Additional Info</h4>
                <p class="mb-3">Only 6 additional infos are displayed.</p>
                <hr class="mb-4">
                <div class="form-row mt-3">
                    <div class="col-lg-4 col-sm-6">
                        <div class="form-group">
                            <label for="founded">Founded</label>
                            <input type="text" name="founded" class="form-control" id="founded" placeholder="e.g.1980">
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <div class="form-group">
                            <label for="special">Special</label>
                            <input type="text" name="special" class="form-control" id="special" placeholder="e.g.French class">
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <div class="form-group">
                            <label for="students">No.of Students</label>
                            <input type="text" name="students" class="form-control" id="students" placeholder="e.g.2005">
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <div class="form-group">
                            <label for="events">Events</label>
                            <input type="text"  name="events" class="form-control" id="events" placeholder="e.g.Annual Day celebration">
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <div class="form-group">
                            <label for="achievements">Achievements</label>
                            <input type="text" name="achievements" class="form-control" id="achievements" placeholder="e.g.First in Sports">
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <div class="form-group">
                            <label for="teachers">No.of Teachers</label>
                            <input type="text" name="teachers" class="form-control" id="teachers" placeholder="e.g.55">
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <div class="form-group">
                            <label for="branches">Branches</label>
                            <input type="text" name="branches" class="form-control" id="branches" placeholder="e.g. Coimbatore,Thei, Erode">
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <div class="form-group">
                            <label for="academic">Academic History</label>
                            <input type="text" name="academic" class="form-control" id="academic" placeholder="e.g.Last year 98% Results">
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <div class="form-group">
                            <label for="language">Languages</label>
                            <input type="text" name="language" class="form-control" id="language" placeholder="e.g.French">
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <div class="form-group">
                            <label for="activity">Activity</label>
                            <input type="text" name="activity" class="form-control" id="activity" placeholder="e.g.Martial Arts">
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <div class="form-group">
                            <label for="academic">No of Boys</label>
                            <input type="text" name="boys" class="form-control" id="academic" placeholder="No of Boys">
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <div class="form-group">
                            <label for="academic">No of Girls</label>
                            <input type="text" name="girls" class="form-control" id="academic" placeholder="No of Girls">
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <div class="form-group">
                            <label for="academic">Vision</label>
                            <textarea class="form-control" name="our_vision" id="our_vision" rows="1" style="height: 80px;"></textarea>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <div class="form-group">
                            <label for="academic">Mission</label>
                            <textarea class="form-control" name="our_mission" id="our_mission" rows="1" style="height: 80px;"></textarea>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <div class="form-group">
                            <label for="academic">Motto</label>
                            <textarea class="form-control" name="our_motto" id="our_motto" rows="1" style="height: 80px;"></textarea>
                        </div>
                    </div>
                </div><!-- /form-row -->

                <h4 class="mt-4 mb-3">About Info</h4>
                <hr class="mb-4">
                <div class="form-row mt-3">
                    <div class="col-lg-6 col-sm-6">
                        <div class="form-group">
                            <label for="about">About Description</label>
                            <textarea class="form-control" name="about" id="about" rows="1" style="height: 130px;"></textarea >
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
                    <div class="col-lg-12 col-sm-6">
                        <h5 class="pink mt-2">Special Info</h5>
                        <ul class="list-inline">
                            <li class="list-inline-item">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" name="playground" value="playground" class="custom-control-input" id="customControlValidation1">
                                    <label class="custom-control-label" for="customControlValidation1">Playgorund</label>
                                </div><!-- /custom-checkbox -->
                            </li>
                            <li class="list-inline-item">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" name="kidsplay" class="custom-control-input" id="customControlValidation2">
                                    <label class="custom-control-label" for="customControlValidation2">Kids Playcorner</label>
                                </div><!-- /custom-checkbox -->
                            </li>
                            <li class="list-inline-item">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" name="transport"  value="transport" class="custom-control-input" id="customControlValidation3">
                                    <label class="custom-control-label" for="customControlValidation3">Transportation</label>
                                </div><!-- /custom-checkbox -->
                            </li>
                            <li class="list-inline-item">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" name="curriculam" value="curriculam" class="custom-control-input" id="customControlValidation4">
                                    <label class="custom-control-label" for="customControlValidation4">Curriculam</label>
                                </div><!-- /custom-checkbox -->
                            </li>
                            <li class="list-inline-item">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" name="fieldtrips" value="fieldtrips" class="custom-control-input" id="customControlValidation5">
                                    <label class="custom-control-label" for="customControlValidation5">Field Trips</label>
                                </div><!-- /custom-checkbox -->
                            </li>
                            <li class="list-inline-item">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" name="specialactivity" value="specialactivity" class="custom-control-input" id="customControlValidation6">
                                    <label class="custom-control-label" for="customControlValidation6">Activity</label>
                                </div><!-- /custom-checkbox -->
                            </li>
                            <li class="list-inline-item">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" name="progressive" value="progressive" class="custom-control-input" id="customControlValidation7">
                                    <label class="custom-control-label" for="customControlValidation7">Progressive Learning</label>
                                </div><!-- /custom-checkbox -->
                            </li>
                            <li class="list-inline-item">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" name="opportunities" value="opportunities" class="custom-control-input" id="customControlValidation8">
                                    <label class="custom-control-label" for="customControlValidation8">Opportunities</label>
                                </div><!-- /custom-checkbox -->
                            </li>
                            <li class="list-inline-item">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" name="clubs" value="clubs" class="custom-control-input" id="customControlValidation9">
                                    <label class="custom-control-label" for="customControlValidation9">Clubs</label>
                                </div><!-- /custom-checkbox -->
                            </li>
                            <li class="list-inline-item">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" name="infrastructure" value="infrastructure" class="custom-control-input" id="customControlValidation10">
                                    <label class="custom-control-label" for="customControlValidation10">Infrastructure</label>
                                </div><!-- /custom-checkbox -->
                            </li>
                        </ul>
                    </div>
                </div><!-- /form-row -->

                <h4 class="mt-5 mb-3">School Activities</h4>
                <hr class="mb-4">
                <div class="form-row">
                    <div class="col-lg-3 col-sm-6">
                        <div class="form-group">
                            <label for="activity1">Activity Name</label>
                            <input type="text" name="activity1" class="form-control" id="activity1" placeholder="e.g.Sports" >
                        </div>
                    </div>
                    <div class="col-lg-7 col-sm-6">
                        <label for="activityimage1">Activity Image</label>
                        <div class="input-group mb-3">
                            <div class="custom-file">
                                <input type="file" name="activityimage1" class="custom-file-input" accept="image/x-png,image/gif,image/jpeg,image/jpg" id="activityimage1" >
                                <label class="custom-file-label" for="activityimage1">Choose file</label>
                            </div>
                        </div>
                    </div>
                </div><!-- /form-row -->

                <div class="form-row">
                    <div class="col-lg-3 col-sm-6">
                        <div class="form-group">
                            <input type="text" name="activity2" class="form-control" id="activity2" placeholder="e.g.Sports">
                        </div>
                    </div>
                    <div class="col-lg-7 col-sm-6">
                        <div class="input-group mb-3">
                            <div class="custom-file">
                                <input type="file" name="activityimage2" class="custom-file-input" accept="image/x-png,image/gif,image/jpeg,image/jpg" id="activityimage2" aria-describedby="activityimage2">
                                <label class="custom-file-label" for="activityimage2">Choose file</label>
                            </div>
                        </div>
                    </div>
                </div><!-- /form-row -->

                <div class="form-row">
                    <div class="col-lg-3 col-sm-6">
                        <div class="form-group">
                            <input type="text" name="activity3" class="form-control" id="activity3" placeholder="e.g.Sports">
                        </div>
                    </div>
                    <div class="col-lg-7 col-sm-6">
                        <div class="input-group mb-3">
                            <div class="custom-file">
                                <input type="file" name="activityimage3" class="custom-file-input" accept="image/x-png,image/gif,image/jpeg,image/jpg" id="activityimage3" aria-describedby="activityimage3">
                                <label class="custom-file-label" for="activityimage3">Choose file</label>
                            </div>
                        </div>
                    </div>
                </div><!-- /form-row -->

                <div class="form-row">
                    <div class="col-lg-3 col-sm-6">
                        <div class="form-group">
                            <input type="text" name="activity4" class="form-control" id="activity4" placeholder="e.g.Sports">
                        </div>
                    </div>
                    <div class="col-lg-7 col-sm-6">
                        <div class="input-group mb-3">
                            <div class="custom-file">
                                <input type="file" name="activityimage4" class="custom-file-input" accept="image/x-png,image/gif,image/jpeg,image/jpg" id="activityimage4" aria-describedby="activityimage4">
                                <label class="custom-file-label" for="activityimage4">Choose file</label>
                            </div>
                        </div>
                    </div>
                </div><!-- /form-row -->



                <h4 class="mt-4 mb-3">School Facilities</h4>
                <hr class="mb-4">
                <div class="form-row">
                    <div class="col-lg-3 col-sm-6">
                        <div class="form-group">
                            <label for="facility1">Facility Name</label>
                            <input type="text" name="facility1" class="form-control" id="facility1" placeholder="e.g.Library" >
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <label for="facilityimage1">Facility Images</label>
                        <div class="input-group mb-3">
                            <div class="custom-file">
                                <input type="file" name="facilityimage1" class="custom-file-input" accept="image/x-png,image/gif,image/jpeg,image/jpg" id="facilityimage1" aria-describedby="facilityimage1" >
                                <label class="custom-file-label" for="facilityimage1">Choose file</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <div class="form-group">
                            <label for="facilitydes1">Facility Description</label>
                            <textarea class="form-control" name="facilitydes1" id="facilitydes1" rows="1" ></textarea>
                        </div>
                    </div>
                </div><!-- /form-row -->

                <div class="form-row">
                    <div class="col-lg-3 col-sm-6">
                        <div class="form-group">
                            <input type="text" name="facility2" class="form-control" id="facility2" placeholder="e.g.Library">
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="input-group mb-3">
                            <div class="custom-file">
                                <input type="file" name="facilityimage2" class="custom-file-input" accept="image/x-png,image/gif,image/jpeg,image/jpg" id="facilityimage2" aria-describedby="facilityimage2">
                                <label class="custom-file-label" for="facilityimage2">Choose file</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <div class="form-group">
                            <textarea class="form-control" name="facilitydes2"   rows="1"></textarea>
                        </div>
                    </div>
                </div><!-- /form-row -->

                <div class="form-row">
                    <div class="col-lg-3 col-sm-6">
                        <div class="form-group">
                            <input type="text" name="facility3" class="form-control" id="facility3" placeholder="e.g.Library">
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="input-group mb-3">
                            <div class="custom-file">
                                <input type="file" name="facilityimage3" class="custom-file-input" accept="image/x-png,image/gif,image/jpeg,image/jpg" id="facilityimage3" aria-describedby="facilityimage3">
                                <label class="custom-file-label"  for="facilityimage3">Choose file</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <div class="form-group">
                            <textarea class="form-control" name="facilitydes3" id="facilitydes3" rows="1"></textarea>
                        </div>
                    </div>

                </div><!-- /form-row -->

                <div class="form-row">
                    <div class="col-lg-3 col-sm-6">
                        <div class="form-group">
                            <input type="text" name="facility4" class="form-control" id="facility4" placeholder="e.g.Library">
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="input-group mb-3">
                            <div class="custom-file">
                                <input type="file" name="facilityimage4" class="custom-file-input" accept="image/x-png,image/gif,image/jpeg,image/jpg" id="facilityimage4" aria-describedby="facilityimage4">
                                <label class="custom-file-label" for="facilityimage4">Choose file</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <div class="form-group">
                            <textarea class="form-control" name="facilitydes4" id="facilitydes4" rows="1"></textarea>
                        </div>
                    </div>
                </div><!-- /form-row -->

                <h4 class="mt-5 mb-3">Location</h4>
                <hr class="mb-4">
                <div class="form-row">
                    <div class="col-lg-4 col-sm-6">
                        <div class="form-group">
                            <label for="phone">Phone Number</label>
                            <input type="text" name="phone" class="form-control" id="phone" placeholder="e.g.+91 9876543210">
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" class="form-control" id="email" placeholder="e.g.admin@gmail.com">
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <div class="form-group">
                            <label for="website">Website</label>
                            <input type="text" name="website" class="form-control" id="website" placeholder="e.g.www.yourwebsite.com">
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <div class="form-group">
                            <label for="website">Map</label>
                            <input type="text" name="map_url" class="form-control" id="website" placeholder="https://www.google.com/maps/@11.0231552,76.9523712,15z">
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <div class="form-group">
                            <label for="address">Address</label>
                            <textarea class="form-control" name="address" id="address" rows="1" style="height: 80px;"></textarea>
                        </div>
                    </div>
                </div><!-- /form-row -->

                <h4 class="mt-3 mb-3">Social Links</h4>
                <hr class="mb-4">
                <div class="form-row">
                    <div class="col-lg-4 col-sm-6">
                        <div class="form-group">
                            <label for="facebook">Facebook</label>
                            <input type="text" class="form-control" name="facebook" id="facebook" placeholder="e.g.+91 9876543210">
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <div class="form-group">
                            <label for="twitter">Twitter</label>
                            <input type="text" class="form-control" name="twitter" id="twitter" placeholder="e.g.admin@gmail.com">
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <div class="form-group">
                            <label for="instagram">Instagram</label>
                            <input type="text" class="form-control" name="instagram" id="instagram" placeholder="e.g.www.yourwebsite.com">
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <div class="form-group">
                            <label for="linkedin">Linked in</label>
                            <input type="text" class="form-control" name="linkedin" id="linkedin" placeholder="e.g.www.yourwebsite.com">
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <div class="form-group">
                            <label for="pinterest">Pinterest</label>
                            <input type="text" class="form-control" name="pinterest" id="pinterest" placeholder="e.g.www.yourwebsite.com">
                        </div>
                    </div>
                </div><!-- /form-row -->

                <button class="btn btn-primary btn-save buy_now" id="formsubmit">SUBMIT</button>
            </form>
        </div><!-- /listing-section -->
    </div><!-- /container -->
</div><!-- /dashboard-content -->
<!-- <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
  var SITEURL = "<?php echo base_url()  ?>";

  $('body').on('click', '.buy_now', function(e){
    var totalAmount = $(this).attr("data-amount");
    var product_id =  $(this).attr("data-id");
    var options = {
    "key": "rzp_live_x0G1AirIMohXPV",
    "amount": (1*100), // 2000 paise = INR 20
    "name": "Edugatein",
    "description": "Payment",
    "image": "https://www.tutsmake.com/wp-content/uploads/2018/12/cropped-favicon-1024-1-180x180.png",
    "handler": function (response){
          $.ajax({
            url: SITEURL + 'add_listing_platinum/razorPaySuccess',
            type: 'post',
            dataType: 'json',
            data: {
                razorpay_payment_id: response.razorpay_payment_id , totalAmount : totalAmount ,product_id : product_id,
            }, 
            success: function (msg) {
 
               window.location.href = SITEURL;
            }
        });
      
    },
 
    "theme": {
        "color": "#528FF0"
    }
  };
  var rzp1 = new Razorpay(options);
  rzp1.open();
  e.preventDefault();
  });
 
</script> -->
<script>
    $(document).ready(function(){
        $("#formsubmit").on('click',function (event) {
            event.preventDefault();
            $("#platinum").validate({
                rules: {
                    schoolname: "required",
                    // schoolboard: "required",
                    // city:"required",
                    // area:"required",
                    // pincode:"required",
                    // level:"required",
                    // area:"required"
                    // password: {
                    //     minlength: 5
                    // },
                //     confirm_password: {
                //         minlength: 5,
                //         equalTo: "#password"
                //     },
                //     terms: "required"
                },
                // messages: {
                //     confirm_password: "Password not matching"
                // },
                errorElement: 'div',
                errorLabelContainer: '.errorTxt',
                errorPlacement: function (error, element) {
                    if (element.attr("name") == "terms")
                        element.parents('.custom-checkbox').append(error);
                    else
                        element.parents('.form-group').append(error);
                }
            });
        });
    });
</script>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
<script src="<?php echo base_url('assets/admin/js/jquery.validate.min.js'); ?>" ></script>     



