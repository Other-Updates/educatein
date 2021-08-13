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
$this->db->select('*')->where('id=',$school[0]['affiliation_id']);
$this->db->from('affiliations');
$affiliation = $this->db->get()->result_array();

//getting selected city
$this->db->select('*')->where('id=',$school[0]['city_id']);
$this->db->from('cities');
$city1 = $this->db->get()->result_array();

//getting selected area
$this->db->select('*')->where('id =', $school[0]['area_id']);
$this->db->from('areas');
$area = $this->db->get()->result_array();

$this->db->select('*')->where('school_id =', $school[0]['id']);
$this->db->from('school_images');
$school_img = $this->db->get()->result_array();
$this->db->select('*')->where('id =', $school_img[0]['school_activity_id']);
$this->db->from('school_activities');
$school_activities=$this->db->get()->result_array();

$this->db->select('*');
$this->db->where('id',$school[0]['schooltype_id']);
$this->db->from('school_types');
$schooltype = $this->db->get()->result_array();

$this->db->select('*')->where('school_id=',$school[0]['id']);
$this->db->from('platinum_datas');
$this->db->where('heading=','Academic');
$academic = $this->db->get()->result_array();

//getting school activities
$this->db->select('*')->where('school_id =', $school[0]['id']);
$this->db->from('school_images');
$school_img = $this->db->get()->result_array();
$this->db->select('*')->where('id =', $school_img[0]['school_activity_id']);
$this->db->from('school_activities');
$school_activities=$this->db->get()->result_array();

$this->db->select('*');
// $this->db->where('school_id',$school[0]['id']);
$this->db->where('school_id',$school[0]['id']);
$this->db->from('school_facilities');
$school_facilities_datas = $this->db->get()->result_array();
?> 

<style>
    .addmore {
        height: 45px;
        border-radius: 3px;
        background-color: #85b5f3;
        border-color: #85b5f3;
    }

    .noclick  {
        pointer-events: none;
    }
</style>
<div class="dashboard-content">
    <div class="container-fluid1">
        <div class="section-title mb-2">
            <h1><?php echo $school[0]["school_name"]; ?>
            <span>(Premium Package)</span></h1>
        </div><!-- /section-title -->
        <div class="listing-section mat-30">
            <form action="<?php echo base_url() ?>schools/admin/update_school" method="post" enctype="multipart/form-data">
            <div class="edit-school-inner">
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
                            <input type="text" class="form-control" id="schoolname" name="schoolname" value="<?php echo $school[0]["school_name"]; ?>" readonly placeholder="e.g. Haunuz Matriculation" required>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="form-group">
                            <label for="schoolboard">School Board</label>
                            <select class="form-control" id="exampleFormControlSelect1" name="schoolboard" readonly required>
                                <option value="" >e.g. Matriculation School</option>
                                <option value="cbse"<?php if('cbse' == $affiliation[0]['affiliation_name']){echo "selected";} ?>>CBSE School</option>
                                <option value="international"<?php if('international' == $affiliation[0]['affiliation_name']){echo "selected";} ?>>International School</option>
                                <option value="matriculation"<?php if('matriculation' == $affiliation[0]['affiliation_name']){echo "selected";} ?>>Matriculation School</option>
                                <option value="special"<?php if('special' == $affiliation[0]['affiliation_name']){echo "selected";} ?>>Special School</option>
                                <option value="kindergarten"<?php if('kindergarten' == $affiliation[0]['affiliation_name']){echo "selected";} ?>>Kindergarten</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="form-group">
                            <label for="city">City</label>
                            <select class="form-control" id="exampleFormControlSelect2" name="city" readonly required>
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
                            <input type="text" class="form-control" id="area" name="area" value="<?php echo $area[0]['area_name'];?>" readonly placeholder="e.g.Nallampalayam" required>
                        </div>
                    </div>
                </div><!-- /form-row -->

                <ul class="list-inline">
                    <li class="list-inline-item mr-5">
                        <div class="yesorno">
                            <label for="area">Eligibility to Avail Admission Under the RTE Act</label>
                            <div class="form-row ml-0">
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="customRadio1" value="1" name="customRadio" <?php if($school[0]['rte']=='1'){echo "checked";} ?> class="custom-control-input">
                                    <label class="custom-control-label" style="margin-top: 0px!important;" for="customRadio1">Yes</label>&nbsp; &nbsp; &nbsp; 
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="customRadio2" value="0" name="customRadio" <?php if($school[0]['rte']=='0'){echo "checked";} ?> class="custom-control-input">
                                    <label class="custom-control-label" style="margin-top: 0px!important;" for="customRadio2">No</label>
                                </div>
                            </div><!-- /form-row -->
                        </div><!-- /yesorno -->
                    </li>

                    <li class="list-inline-item">
                        <div class="yesorno">
                            <label for="customRadio1">Hostel Facility</label>
                            <div class="form-row ml-0">
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="customRadio3" value="1" name="customRadio1" <?php if($school[0]['hostel']=='1'){echo "checked";}?> class="custom-control-input">
                                    <label class="custom-control-label" style="margin-top: 0px!important;" for="customRadio3">Yes</label>&nbsp; &nbsp; &nbsp; 
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="customRadio4" value="0" name="customRadio1" <?php if($school[0]['hostel']=='0'){echo "checked";}?> class="custom-control-input">
                                    <label class="custom-control-label" style="margin-top: 0px!important;" for="customRadio4">No</label>
                                </div>
                            </div><!--/form-row -->
                        </div><!--/yesorno -->
                    </li>
                </ul>
            </div>
            <div class="edit-school-inner">
            <h4 class="mb-3">Banner Image</h4>
                    <hr class="mb-4">
                <div class="form-row mat-30">
                                        <div class="col-lg-6 col-sm-6">
                        <label for="bannersample"> Image </label>
                        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                                    <?php foreach($school_img as $key=>$image){ ?>
                                        <li data-target="#carouselExampleIndicators" data-slide-to="<?php echo $key ?>" class="<?php if($key==0){echo 'active';} ?>"></li>
                                    <?php } ?>
                                </ol>
                                <div class="carousel-inner">
                                <?php foreach($school_img as $key=>$image){ ?>
                                    <div class="carousel-item <?php if($key==0){echo 'active';} ?> ">
                                    <img class="d-block w-100" src="<?php echo base_url("/laravel/public/"); ?><?php echo $image['images'] ?> " alt="<?php echo $key ?> slide">
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
                <!-- Alert Content -->
            </div>
            <div class="edit-school-inner">
            <h4 class="mb-3">School Description</h4>
                    <hr class="mb-4">

                <div class="form-row mt-3">
                    <div class="col-lg-6 col-sm-6">
                        <div class="form-group">
                            <label for="description">School Description</label>
                            <textarea class="form-control" id="description" name="description" rows="1" readonly style="height: 80px;" ><?php echo $school[0]["about"]; ?></textarea>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6"></div>
                </div><!-- /form-row -->
            </div>
            <div class="edit-school-inner">

                <h4 class="mt-4 mb-2">Additional Info</h4>
                <hr class="mb-4">
                <div class="form-row mab-30">
                    <div class="col-lg-4 col-sm-6">
                        <div class="form-group">
                            <label for="founded">Founded</label>
                            <input type="text" class="form-control" id="founded" name="founded" value="<?php echo $school[0]['year_of_establish'];?>" readonly placeholder="e.g.1980" >
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <div class="form-group">
                            <label for="students">No.of Students</label>
                            <input type="text" class="form-control" id="students" name="students" value="<?php echo $school[0]['students'];?>" readonly placeholder="e.g.1980" >
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <div class="form-group">
                            <label for="level">Grade Level</label>
                            <select class="form-control" id="exampleFormControlSelect3" name="level" readonly required>
                                <option value="" >e.g. Elementary School</option>
                                <option value="Elementary School"<?php if($schooltype[0]['school_type']=="Elementary School"){echo "selected";}?>>Elementary School</option>
                                <option value="Preschools"<?php if($schooltype[0]['school_type']=="Preschools"){echo "selected";}?>>Preschools</option>
                                <option value="High School"<?php if($schooltype[0]['school_type']=="High School"){echo "selected";}?>>High School</option>
                                <option value="Higher Secondary School"<?php if($schooltype[0]['school_type']=="Higher Secondary School"){echo "selected";}?>>Higher Secondary School</option>
                                <option value="Special school"<?php if($schooltype[0]['school_type']=="Special school"){echo "selected";}?>>Special school</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <div class="form-group">
                            <label for="schooltype">School Type</label>
                            <select class="form-control" id="exampleFormControlSelect4" name="schooltype" readonly required>
                                <option value=""  >e.g. Co-Ed</option>
                                <option value="Co-Ed"<?php if($school[0]['type']=="Co-Ed"){echo "selected";}?>>Co-Ed</option>
                                <option value="Girls"<?php if($school[0]['type']=="Girls"){echo "selected";}?>>Girls</option>
                                <option value="Boys"<?php if($school[0]['type']=="Boys"){echo "selected";}?>>Boys</option>
                                <option value="Other"<?php if($school[0]['type']=="Other"){echo "selected";}?>>Other</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <div class="form-group">
                            <label for="acedemic">Academic Percentage</label>
                            <input type="text" class="form-control" id="acedemic" name="acedemic" readonly value="<?php echo $school[0]['acadamic'];?>" placeholder="e.g.78%" >
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <div class="form-group">
                            <label for="teachers">No.of Teachers</label>
                            <input type="text" class="form-control" id="teachers" name="teachers" readonly value="<?php echo $school[0]['teachers'];?>"placeholder="e.g.105" >
                        </div>
                    </div>
                </div><!-- /form-row -->
            </div>
            <div class="edit-school-inner">

                <h4 class="mb-2">School Activities</h4>
                <hr class="mb-3">
                <div class="form-row mt-3" id="actmore">
                    <div class="col-lg-4 col-sm-6 form-group">
                        <label for="activity[]">Activity Name</label>
                        <input type="text" class="form-control" id="activity[]" name="activity[]" readonly value="<?php echo $school_activities[0]['activity_name']; ?>" placeholder="e.g.Sports" >
                    </div>
                </div><!-- /form-row -->
            </div>
            <div class="edit-school-inner">


                <h4 class="mt-4 mb-3">School Facilities</h4>
                <hr class="mb-4">
                <?php foreach($school_facilities_datas as $key=>$school_facilities_data){ ?>
                <div class="form-row" id="facilitymore">
                    <div class="col-lg-3 col-sm-6">
                        <div class="form-group">
                            <?php if($key==0){ ?> <label for="facility1">Facility Name</label> <?php } ?>
                            <input type="text" class="form-control" id="facility[]" name="facility[]" readonly value="<?php echo $school_facilities_data['facility'] ?>" placeholder="e.g.Library" >
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="form-group">
                            <?php if($key==0){ ?><label for="facilitydesc[]">Facility Description</label> <?php } ?>
                            <textarea class="form-control" id="facilitydesc[]" readonly name="facilitydesc[]" rows="1" ><?php echo $school_facilities_data['content'] ?></textarea>
                        </div>
                    </div>
                </div><!-- /form-row -->
            <?php } ?>
            </div>
            
            <div class="edit-school-inner">

                <h4 class="mb-2 mt-4">Location</h4>
                <hr class="mb-3">
                <div class="form-row">
                    <div class="col-lg-4 col-sm-6">
                        <div class="form-group">
                            <label for="phone">Phone Number</label>
                            <input type="text" class="form-control" id="phone" name="phone" readonly value="<?php echo $school[0]['mobile']; ?>" placeholder="e.g.+91 9876543210" >
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" readonly value="<?php echo $school[0]['email']; ?>" placeholder="e.g.admin@gmail.com" >
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <div class="form-group">
                            <label for="website">Website</label>
                            <input type="text" class="form-control" id="website" name="website" readonly value="<?php echo $school[0]['website_url']?>" placeholder="e.g.www.yourwebsite.com" >
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <div class="form-group">
                            <label for="address">Address</label>
                            <textarea class="form-control" id="address" name="address" rows="1" readonly style="height: 80px;" ><?php echo $school[0]['address']?></textarea>
                        </div>
                    </div>
                </div><!-- /form-row -->
            </div>
            <div class="edit-school-inner">

                <h4 class="mb-2 mt-4">Social Links</h4>
                <hr class="mb-3">
                <div class="form-row">
                    <div class="col-lg-4 col-sm-6">
                        <div class="form-group">
                            <label for="facebook">Facebook</label>
                            <input type="text" class="form-control" id="facebook" name="facebook" readonly value="<?php echo $school[0]['facebook']?>" placeholder="e.g.www.yourwebsite.com" >
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <div class="form-group">
                            <label for="twitter">Twitter</label>
                            <input type="text" class="form-control" id="twitter" name="twitter" readonly value="<?php echo $school[0]['twitter']?>" placeholder="e.g.admin@gmail.com" >
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <div class="form-group">
                            <label for="instagram">Instagram</label>
                            <input type="text" class="form-control" id="instagram" name="instagram" readonly value="<?php echo $school[0]['instagram']?>" placeholder="www.yourwebsite.com" >
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <div class="form-group">
                            <label for="linkedin">Linked in</label>
                            <input type="text" class="form-control" id="linkedin" name="linkedin" readonly value="<?php echo $school[0]['linkedin']?>" placeholder="e.g.www.yourwebsite.com" >
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <div class="form-group">
                            <label for="pinterest">Pinterest</label>
                            <input type="text" class="form-control" id="pinterest" name="pinterest" readonly value="<?php echo $school[0]['pinterest']?>" placeholder="e.g.www.yourwebsite.com" >
                        </div>
                    </div>
                </div><!-- /form-row -->
            </div>
            <!-- <div class="edit-school-inner">
                <button class="btn btn-primary btn-save">SUBMIT</button>
            </div><br> -->
            </form>
        </div><!-- /listing-section -->
    </div><!-- /container -->
</div><!-- /dashboard-content -->

<script>
    // $("#addmore").click(function () {
    //   $("#actmore").append('<div class="form-row mt-3" id="actmore"><div class="col-lg-3 col-sm-6 form-group"><input type="text" class="form-control" id="activity" name="activity" placeholder="Sports"></div><div class="col-lg-7 col-sm-6"><div class="input-group mb-3 custom-file"><input type="file" class="" id="activityimage" name="activityimage" accept="image/x-png,image/gif,image/jpeg" id="" aria-describedby=""></div></div><div class="col-lg-2 col-sm-6 form-group"><a class="btn btn-primary addmore-show btn-block add_field_button1" id="addmore">Add More</a><a href="#" class="btn btn-danger">Remove</a></div></div>');
    // });


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
                $(activity).append('<div class="form-row w-100 mx-0" id="actmore"><div class="col-lg-4 col-sm-6 form-group"><input type="text" class="form-control" id="activity[]" name="activity[]" placeholder="Sports"></div><div class="col-lg-4 col-sm-6"><div class="input-group mb-3 custom-file"><input type="file" class="" id="activityimage[]" name="activityimage[]" accept="image/x-png,image/jpg,image/jpeg,image/x-PNG,image/JPG,image/JPEG" aria-describedby=""></div></div><div class="col-lg-3 col-sm-6 remove_field"><a href="#" class="btn btn-danger ">Remove</a></div></div>'); //add input box
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
                $(facility).append('<div class="form-row w-100 mx-0" id="facilitymore"><div class="col-lg-3 col-sm-6"><div class="form-group"><input type="text" class="form-control" id="facility[]" name="facility[]" placeholder="Library"></div></div><div class="col-lg-3 col-sm-6"><div class="input-group mb-3"><div class="custom-file"><input type="file" class="" id="facilityimage[]" name="facilityimage[]"  accept="image/x-png,image/jpg,image/jpeg,image/x-PNG,image/JPG,image/JPEG" id="" aria-describedby=""></div></div></div><div class="col-lg-3 col-sm-6"><div class="form-group"><textarea class="form-control" id="facilitydesc[]" name="facilitydesc[]" rows=""></textarea></div></div><div class="col-lg-3 col-sm-6 remove_field1"><a href="#" class="btn btn-danger">Remove</a></div></div>');
            }
        });

        $(facility).on("click", ".remove_field1", function (e) { //user click on remove text
            e.preventDefault();
            $(this).parent('div').remove();
            x--;
        })

    });
</script>
