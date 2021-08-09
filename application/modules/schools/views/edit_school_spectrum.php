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


$this->db->select('*');
$this->db->from('school_details');
$this->db->where("id", $userid);
$school = $this->db->get()->result_array();

foreach ($user->result() as $users) {
    $username = $users->name;
    $userid = $users->id;
}

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

   //getting school activities
   $this->db->select('*')->where('id =', $school[0]['id']);
   $this->db->from('school_images');
   $school_img = $this->db->get()->result_array();
   $this->db->select('*')->where('id =', $school_img[0]['school_activity_id']);
   $this->db->from('school_activities');
   $activity=$this->db->get()->result_array();

   $this->db->select('*')->where('school_id=',$school[0]['id']);
   $this->db->from('school_facilities');
   $facility = $this->db->get()->result_array();
?>
<style>
    .noclick  {
        pointer-events: none;
    }
</style>
<div class="dashboard-content">
    <div class="container-fluid ">
        <div>
            <div class="section-title mb-3">
                <h1><?php echo $school[0]["school_name"]; ?></h1>
                <?php if($school[0]['school_category_id'] == 3){?>
                <span>(Spectrum Package)</span>
                <?php }
                if($school[0]['school_category_id'] == 4){?>
                    <span>(Trial Package)</span>
                <?php } ?>
            </div><!-- /section-title -->   

            <div class="listing-section mat-30">
                <form action="<?php echo base_url("add_listing_spectrum/insert") ?>" method="post" enctype="multipart/form-data">
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
                                <label for="">School Name</label>
                                <input type="text" class="form-control" id="schoolname" name="schoolname" value="<?php echo $school[0]["school_name"];?>" placeholder="Enter your school name" required>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6">
                            <div class="form-group">
                                <label for="">School Board</label>
                                <select class="form-control" id="exampleFormControlSelect1" name="schoolboard" required>
                                    <option value="">School Board</option>
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
                                <label for="">City</label>
                                <select class="form-control" id="exampleFormControlSelect1" name="city" required>
                                    <option  value="">--Select City--</option>
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
                                <label for="">Area</label>
                                <input type="text" class="form-control" id="area" name="area" value="<?php echo $area[0]['area_name'];?>" placeholder="Enter your area" required>
                            </div>
                        </div>
                    </div><!-- /form-row -->

                    <ul class="list-inline">
                        <li class="list-inline-item mr-5">
                            <div class="yesorno">
                                <label for="customRadio">Eligibility to Avail Admission Under the RTE Act</label>
                                <div class="form-row ml-0">
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="customRadio2" value="1" <?php if($school[0]['rte'] == '1'){echo "checked";} ?> name="customRadio" class="custom-control-input" >
                                        <label class="custom-control-label" style="margin-top: 0px!important;" for="customRadio1">Yes</label> &nbsp; &nbsp; &nbsp; 
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="customRadio2" value="0" <?php if($school[0]['rte'] == '0'){echo "checked";} ?> name="customRadio" class="custom-control-input" >
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
                                        <input type="radio" id="customRadio1" value="1"<?php if($school[0]['hostel'] == '1'){echo "checked";} ?> name="customRadio1" class="custom-control-input" >
                                        <label class="custom-control-label" style="margin-top: 0px!important;" for="customRadio3">Yes</label>&nbsp; &nbsp; &nbsp; 
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="customRadio1" value="0" <?php if($school[0]['hostel'] == '0'){echo "checked";} ?> name="customRadio1" class="custom-control-input" >
                                        <label class="custom-control-label" style="margin-top: 0px!important;" for="customRadio4">No</label>
                                    </div>
                                </div><!-- /form-row -->
                            </div><!-- /yesorno -->
                        </li>
                    </ul>

                    <div class="form-row mt-3">
                        <div class="col-lg-6 col-sm-6">
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control" id="description" rows="1" name="description" style="height:80px;" ><?php echo $school[0]['about'];?></textarea>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-6"></div>
                    </div><!-- /form-row -->
                </div>
                <div class="edit-school-inner">
                <h4 class="mb-3">Banner Image</h4>
                    <hr class="mb-4">
                    <!-- ====== Banner Images Upload Section ====== -->
                    <div class="form-row">
                        <div class="col-lg-6 col-sm-6 file-img-upload">
                            <label for="">Add Banner Image</label>
                            <input type="file" id="file-upload" name="banner" accept="image/x-png,image/gif,image/jpeg" multiple  />
                            <label for="file-upload" class="file-upload" style="display: block;">
                                <img src="<?php echo base_url("assets/front/images/"); ?>dashboard/add-img.png" width="70px" alt="">
                                <p>Upload Images</p>
                                <small class="red">Images with format of jpg & png are acceptable.</small>
                            </label>
                            <div id="file-upload-filename"></div>
                        </div><!-- /file-img-upload -->

                        <div class="col-lg-4">
                            <label for="">Banner Image Sample</label>
                            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                                <ol class="carousel-indicators">
                                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                                    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                                </ol>
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                    <img class="d-block w-100" src="<?php echo base_url("assets/front/images/"); ?>dashboard/3rd-banner.jpg" alt="First slide">
                                    </div>
                                    <div class="carousel-item">
                                    <img class="d-block w-100" src="<?php echo base_url("assets/front/images/"); ?>dashboard/3rd-banner.jpg" alt="Second slide">
                                    </div>
                                    <div class="carousel-item">
                                    <img class="d-block w-100" src="<?php echo base_url("assets/front/images/"); ?>dashboard/3rd-banner.jpg" alt="Third slide">
                                    </div>
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
                            <!-- <div class="object-fit" style="width: 100%;height: 180px;">
                                <img src="<?php echo base_url("assets/front/images/"); ?>dashboard/3rd-banner.jpg" class="w-100 rounded" alt="" style="width: 100%;height: 180px;object-fit: cover;">	
                            </div> -->
                        </div>
                    </div><!-- /form-row -->
                </div>
                <div class="edit-school-inner">                    
                <h4 class="mb-3">Additional Info</h4>
                    <hr class="mb-4">
                    <div class="form-row mt-3">
                        <div class="col-lg-4 col-sm-6">
                            <div class="form-group">
                                <label for="">School Type</label>
                                <select class="form-control" id="exampleFormControlSelect1" name="schooltype" required>
                                    <option value="">School Type</option>
                                    <option value="Co-Ed"<?php if($school[0]['type']== "Co-Ed"){echo "selected";}?>>Co-Ed</option>
                                    <option value="Girls"<?php if($school[0]['type']== "Girls"){echo "selected";}?>>Girls</option>
                                    <option value="Boys"<?php if($school[0]['type']== "Boys"){echo "selected";}?>>Boys</option>
                                    <option value="Other"<?php if($school[0]['type']== "Other"){echo "selected";}?>>Other</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6">
                            <div class="form-group">
                                <label for="">Grade Level</label>
                                <select class="form-control" id="exampleFormControlSelect1" name="level" required>
                                    <option value="" >Grade Level</option>
                                    <option value="Elementary School"<?php if($school_type[0]['school_type']=="Elementary School"){echo "selected";}?>>Elementary School</option>
                                    <option value="Preschools"<?php if($school_type[0]['school_type']=="Preschools"){echo "selected";}?>>Preschools</option>
                                    <option value="High School"<?php if($school_type[0]['school_type']=="High School"){echo "selected";}?>>High School</option>
                                    <option value="Higher Secondary School"<?php if($school_type[0]['school_type']=="Higher Secondary School"){echo "selected";}?>>Higher Secondary School</option>
                                    <option value="Special school"<?php if($school_type[0]['school_type']=="Special school"){echo "selected";}?>>Special school</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6">
                            <div class="form-group">
                                <label for="">Founded</label>
                                <input type="text" class="form-control" id="founded" name="founded" value="<?php echo $school[0]['year_of_establish'];?>" placeholder="Founded" >
                            </div>
                        </div>

                        <div class="col-lg-4 col-sm-6">
                            <div class="form-group">
                                <label for="">Address</label>
                                <input type="text" class="form-control" id="address" name="address" value="<?php echo $school[0]['address'];?>" placeholder="Your address">
                            </div>
                        </div>

                        <div class="col-lg-4 col-sm-6">
                            <div class="form-group">
                                <label for="">Email</label> 
                                <input type="email" class="form-control" id="email" name="email" value="<?php echo $school[0]['email'];?>" placeholder="Your email" >
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6">
                            <div class="form-group">
                                <label for="">Phone Number</label>
                                <input type="text" class="form-control" id="phone" name="phone" value="<?php echo $school[0]['mobile'];?>" placeholder="Your Phone Number">
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6">
                            <div class="form-group">
                                <label for="">Website</label>
                                <input type="text" class="form-control" id="website" name="website" value="<?php echo $school[0]['website_url'];?>" placeholder="Your website" >
                            </div>
                        </div>
                    </div><!-- /form-row -->
                </div>
                <div class="edit-school-inner">
                    <h4 class="mb-2">School Activities</h4>
                    <hr class="mb-3">
                    <div class="form-row mt-3" id="actmore">
                        <div class="col-lg-4 col-sm-6">
                            <div class="form-group">
                                <label for="activity[]">Activity Name</label>
                                <input type="text" class="form-control" id="activity[]" name="activity[]" values="<?php echo $activity['activity_name'];?>" placeholder="eg.Sports" >
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6">
                            <div class="form-group">
                                <label for="activityimage[]">Activity Image</label>
                                <div class="input-group">
                                    <input type="file" class="" id="activityimage[]" name="activityimage[]" accept="image/x-png,image/jpg,image/jpeg,image/x-PNG,image/JPG,image/JPEG"  aria-describedby="info" >
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6">
                            <div class="form-group">
                                <label for="addmore" style="visibility: hidden;display: block;">Add More</label>
                                <a class="btn btn-primary add_field_button1" id="addmore">Add More</a>
                            </div>
                        </div>
                    </div><!-- /form-row -->
                </div>
                <div class="edit-school-inner">

                    <h4 class="mb-3">School Facilities</h4>
                    <hr class="mb-4">
                    <div class="form-row" id="facilitymore">
                        <div class="col-lg-3 col-sm-6">
                            <div class="form-group">
                                <label for="facility[]">Facility Name</label>
                                <input type="text" class="form-control" id="facility[]" name="facility[]" value= "<?php echo $facility[0]['facility']; ?>" placeholder="eg.Library" >
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6">
                            <label for="facilityimage[]">Facility Images</label>
                            <div class="input-group mb-3">
                                <div class="">
                                    <input type="file" class="" id="facilityimage[]" name="facilityimage[]"  accept="image/x-png,image/jpg,image/jpeg,image/x-PNG,image/JPG,image/JPEG"  aria-describedby="facilityimage" >
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6">
                            <div class="form-group">
                                <label for="facilitydesc">Facility Description</label>
                                <textarea class="form-control" id="facilitydesc[]" name="facilitydesc[]" rows="1" ><?php echo $facility[0]['content']; ?></textarea>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6">
                            <div class="form-group">
                                <label for="facaddmore" style="visibility: hidden;display: block;">Add More</label>
                                <a class="btn btn-primary addmore-show1" id="facaddmore">Add More</a>
                            </div>
                        </div>
                    </div><!-- /form-row -->  
                </div>
                <div class="edit-school-inner">

                    <h4 class="mb-3">Gallery Images</h4>
                    <hr class="mb-4">
                    <small class="red">(JPEG and PNG images are only acceptable!).</small>
                    <div class="input_fields_wrap mt-3">
                        <div class="form-row">
                            <div class="col-lg-4 col-sm-6">
                                <div class="input-group mb-3">
                                    <input type="file" class="" id="mytext[]"  aria-describedby="mytext" accept="image/x-png,image/gif,image/jpeg" name="mytext[]">
                                </div>
                            </div>
                            <div class="col-lg-2 col-sm-6">
                                <button class="add_field_button btn btn-primary btn-block">Add More</button>
                            </div>
                        </div><!-- /form-row -->
                    </div><!-- /input_fields_wrap -->
                </div>
                <div class="edit-school-inner">
                    <button class="btn btn-primary btn-save buy_now" data-amount="1" data-id="3">SUBMIT</button> 
                </div><br>
                </form>
            </div><!-- /listing-section -->
        </div>
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
                $(activity).append('<div class="form-row w-100 mx-0" id="actmore"><div class="col-lg-4 col-sm-6 form-group"><input type="text" class="form-control" id="activity[]" name="activity[]" placeholder="Sports"></div><div class="col-lg-4 col-sm-6"><div class="input-group mb-3 custom-file"><input type="file" class="" id="activityimage[]" name="activityimage[]" accept="image/x-png,image/jpg,image/jpeg,image/x-PNG,image/JPG,image/JPEG" aria-describedby=""></div></div><div class="col-lg-4 col-sm-6 remove_field"><a href="#" class="btn btn-danger ">Remove</a></div></div>'); //add input box
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