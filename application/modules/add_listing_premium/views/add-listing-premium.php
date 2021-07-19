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
            <span>(Premium Package)</span>
        </div><!-- /section-title -->
        <hr>
        <div class="listing-section mat-30">
            <form action="<?php echo base_url() ?>add_listing_premium/insert" method="post" enctype="multipart/form-data">
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
                            <input type="text" class="form-control" id="schoolname" name="schoolname" placeholder="e.g. Haunuz Matriculation" required>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="form-group">
                            <label for="schoolboard">School Board</label>
                            <select class="form-control" id="exampleFormControlSelect1" name="schoolboard" required>
                                <option value="" >e.g. CBSE School</option>
                                <option value="cbse">CBSE School</option>
                                <option value="international">International School</option>
                                <option value="matriculation">Matriculation School</option>
                                <option value="special">Special School</option>
                                <option value="kindergarten">Kindergarten</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="form-group">
                            <label for="city">City</label>
                            <select class="form-control" id="exampleFormControlSelect2" name="city" required>
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
                            <input type="text" class="form-control" id="area" name="area" placeholder="e.g.Nallampalayam" required>
                        </div>
                    </div>
                </div><!-- /form-row -->

                <ul class="list-inline">
                    <li class="list-inline-item mr-5">
                        <div class="yesorno">
                            <label for="area">Eligibility to Avail Admission Under the RTE Act</label>
                            <div class="form-row">
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="customRadio1" value="1" name="customRadio" class="custom-control-input">
                                    <label class="custom-control-label" style="margin-top: 0px!important;" for="customRadio1">Yes</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="customRadio2" value="0" name="customRadio" class="custom-control-input">
                                    <label class="custom-control-label" style="margin-top: 0px!important;" for="customRadio2">No</label>
                                </div>
                            </div><!-- /form-row -->
                        </div><!-- /yesorno -->
                    </li>

                    <li class="list-inline-item">
                        <div class="yesorno">
                            <label for="customRadio1">Hostel Facility</label>
                            <div class="form-row">
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="customRadio3" value="1" name="customRadio1" class="custom-control-input">
                                    <label class="custom-control-label" style="margin-top: 0px!important;" for="customRadio3">Yes</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="customRadio4" value="0" name="customRadio1" class="custom-control-input">
                                    <label class="custom-control-label" style="margin-top: 0px!important;" for="customRadio4">No</label>
                                </div>
                            </div><!--/form-row -->
                        </div><!--/yesorno -->
                    </li>
                </ul>
                <hr class="mt-4">
                <div class="form-row mat-30">
                    <div class="col-lg-6 col-sm-6 file-img-upload">
                        <label for="banner">Add Banner Image</label>
                        <input type="file" id="file-upload" name="banner" accept="image/x-png,image/jpg,image/jpeg,image/x-PNG,image/JPG,image/JPEG" />
                        <label for="file-upload" class="file-upload" style="display: block;">
                            <img src="<?php echo base_url("assets/front/images/"); ?>dashboard/add-img.png" width="70px" alt="Images">
                            <p>Upload Images</p>
                            <span>Images with format of jpg & png are acceptable.</span>
                        </label>
                        <div id="file-upload-filename"></div>
                    </div><!-- /file-img-upload -->

                    <div class="col-lg-4 col-sm-6">
                        <label for="bannersample">Banner Image Sample</label>
                        <div class="object-fit" style="width: 100%;height: 180px;">
                            <img src="<?php echo base_url("assets/front/images/"); ?>dashboard/2nd-banner.jpg" class="w-100 rounded" alt="" style="width: 100%;height: 180px;object-fit: cover;">	
                        </div>
                    </div>
                </div><!-- /form-row -->
                <div class="form-row">
                    <div class="col-lg-6">
                        <div class="alert alert-primary mt-3" role="alert">
                            <p class="image-note">Choose your banner images in high quality to attract more peoples.</p>
                        </div>
                    </div>
                    <div class="col-lg-6"></div>
                </div>
                <!-- Alert Content -->

                <div class="form-row mt-3">
                    <div class="col-lg-6 col-sm-6">
                        <div class="form-group">
                            <label for="description">School Description</label>
                            <textarea class="form-control" id="description" name="description" rows="1" style="height: 80px;" ></textarea>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6"></div>
                </div><!-- /form-row -->

                <h4 class="mt-4 mb-2">Additional Info</h4>
                <hr class="mb-4">
                <div class="form-row mab-30">
                    <div class="col-lg-4 col-sm-6">
                        <div class="form-group">
                            <label for="founded">Founded</label>
                            <input type="text" class="form-control" id="founded" name="founded" placeholder="e.g.1980" >
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <div class="form-group">
                            <label for="students">No.of Students</label>
                            <input type="text" class="form-control" id="students" name="students" placeholder="e.g.1980" >
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <div class="form-group">
                            <label for="level">Grade Level</label>
                            <select class="form-control" id="exampleFormControlSelect3" name="level" required>
                                <option value="" >e.g. Elementary School</option>
                                <option value="Elementary School">Elementary School</option>
                                <option value="Preschools">Preschools</option>
                                <option value="High School">High School</option>
                                <option value="Higher Secondary School">Higher Secondary School</option>
                                <option value="Special school">Special school</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <div class="form-group">
                            <label for="schooltype">School Type</label>
                            <select class="form-control" id="exampleFormControlSelect4" name="schooltype" required>
                                <option value=""  >e.g. Co-Ed</option>
                                <option value="Co-Ed">Co-Ed</option>
                                <option value="Girls">Girls</option>
                                <option value="Boys">Boys</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <div class="form-group">
                            <label for="acedemic">Academic Percentage</label>
                            <input type="text" class="form-control" id="acedemic" name="acedemic" placeholder="e.g.78%" >
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <div class="form-group">
                            <label for="teachers">No.of Teachers</label>
                            <input type="text" class="form-control" id="teachers" name="teachers" placeholder="e.g.105" >
                        </div>
                    </div>
                </div><!-- /form-row -->

                <h4 class="mb-2">School Activities</h4>
                <hr class="mb-3">
                <div class="form-row mt-3" id="actmore">
                    <div class="col-lg-4 col-sm-6 form-group">
                        <label for="activity[]">Activity Name</label>
                        <input type="text" class="form-control" id="activity[]" name="activity[]" placeholder="e.g.Sports" >
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <label for="activityimage[]">Activity Image</label>
                        <div class="input-group mb-3 ">
                            <input type="file" class="" id="activityimage[]" name="activityimage[]" accept="image/x-png,image/jpg,image/jpeg,image/x-PNG,image/JPG,image/JPEG"  aria-describedby="activityimage" >
                            <!-- <label class="custom-file-label" for="">Choose file</label> -->
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 form-group">
                        <label for="addmore" style="visibility: hidden;display: block;">Add More</label>
                        <a class="btn btn-primary add_field_button1" id="addmore">Add More</a>
                    </div>
                </div><!-- /form-row -->


                <h4 class="mt-4 mb-3">School Facilities</h4>
                <hr class="mb-4">
                <div class="form-row" id="facilitymore">
                    <div class="col-lg-3 col-sm-6">
                        <div class="form-group">
                            <label for="facility[]">Facility Name</label>
                            <input type="text" class="form-control" id="facility[]" name="facility[]" placeholder="e.g.Library" >
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
                            <label for="facilitydesc[]">Facility Description</label>
                            <textarea class="form-control" id="facilitydesc[]" name="facilitydesc[]" rows="1" ></textarea>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="form-group">
                            <label for="facaddmore" style="visibility: hidden;display: block;">Add More</label>
                            <a class="btn btn-primary addmore-show1" id="facaddmore">Add More</a>
                        </div>
                    </div>
                </div><!-- /form-row -->

                <h4 class="mb-2 mt-4">Location</h4>
                <hr class="mb-3">
                <div class="form-row">
                    <div class="col-lg-4 col-sm-6">
                        <div class="form-group">
                            <label for="phone">Phone Number</label>
                            <input type="text" class="form-control" id="phone" name="phone" placeholder="e.g.+91 9876543210" >
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="e.g.admin@gmail.com" >
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <div class="form-group">
                            <label for="website">Website</label>
                            <input type="text" class="form-control" id="website" name="website" placeholder="e.g.www.yourwebsite.com" >
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <div class="form-group">
                            <label for="address">Address</label>
                            <textarea class="form-control" id="address" name="address" rows="1" style="height: 80px;" ></textarea>
                        </div>
                    </div>
                </div><!-- /form-row -->

                <h4 class="mb-2 mt-4">Social Links</h4>
                <hr class="mb-3">
                <div class="form-row">
                    <div class="col-lg-4 col-sm-6">
                        <div class="form-group">
                            <label for="facebook">Facebook</label>
                            <input type="text" class="form-control" id="facebook" name="facebook" placeholder="e.g.+91 9876543210" >
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <div class="form-group">
                            <label for="twitter">Twitter</label>
                            <input type="text" class="form-control" id="twitter" name="twitter" placeholder="e.g.admin@gmail.com" >
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <div class="form-group">
                            <label for="instagram">Instagram</label>
                            <input type="text" class="form-control" id="instagram" name="instagram" placeholder="www.yourwebsite.com" >
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <div class="form-group">
                            <label for="linkedin">Linked in</label>
                            <input type="text" class="form-control" id="linkedin" name="linkedin" placeholder="e.g.www.yourwebsite.com" >
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <div class="form-group">
                            <label for="pinterest">Pinterest</label>
                            <input type="text" class="form-control" id="pinterest" name="pinterest" placeholder="e.g.www.yourwebsite.com" >
                        </div>
                    </div>
                </div><!-- /form-row -->

                <button class="btn btn-primary btn-save">SUBMIT</button>
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
