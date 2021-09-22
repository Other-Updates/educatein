<style>
    .form-group .error,  .custom-checkbox .error{
        color: red;
        font-size: 12px;
    }
    .form-group .error{
        border-color: red;
    }

    .form-control:focus {
        color: #495057;
        background-color: #fff;
        border-color: #33317c;
        outline: 0;
        box-shadow:0 0 0 0.2rem rgb(51 49 124 / 25%);
    }
</style>
<form action="<?php echo base_url() ?>schools/admin/admin_insert" method="post"  enctype="multipart/form-data"  id="signupschool" autocomplete="off">
    <div class="new-signin-section">
        <div class="">
            <div class="">
                <div class="">
                    <div class="new-signin-right">
                        <h1 class="section-title mb-2">Enter Registration Details</h1>
                        <div class="">
                            <div class="edit-school-inner">
                            <!-- <form action="<?php echo base_url() ?>schools/admin/admin_insert" method="post"  enctype="multipart/form-data"  id="signupschool" autocomplete="off">-->
                                    <div class="row">
                                        <div class="col-lg-3 col-sm-3">
                                            <div class="form-group">
                                                <label>First Name</label>
                                                <input type="text" class="form-control" id="name" name="name" placeholder=" " required>                                            
                                            </div>	
                                        </div>
                                        <div class="col-lg-3 col-sm-3">
                                            <div class="form-group">
                                                <label>Last Name</label>
                                                <input class="form-control" type="text" placeholder=" " name="lastname" id="lastname">                                            
                                            </div>	
                                        </div>
                                        <div class="col-lg-3 col-sm-3">
                                            <div class="form-group">
                                                <label>E-mail</label>
                                                <input type="email" class="form-control" id="useremail" name="useremail" placeholder=" " required>                                            
                                            </div>	
                                        </div>
                                        <div class="col-lg-3 col-sm-3">
                                            <div class="form-group">
                                                <label>Mobile Number</label>
                                                <input type="number" step="any"  class="form-control" id="phone" name="adminphone" maxlength="10" placeholder=" " required>                                            
                                            </div>	
                                        </div>
                                        <div class="col-lg-3 col-sm-3">
                                            <div class="form-group">
                                                <label>Password</label>    
                                                <input type="password" class="form-control" id="password" name="password" placeholder=" " required>  
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" onclick="myFunctionp(true)" id="showpass" name="showpass" >
                                                    <label class="custom-control-label" for="showpass"> Show Password</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-sm-3">
                                            <div class="form-group">
                                                <label>Confirm Password</label>  
                                                <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder=" " required>   
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" onclick="myFunctionp(false)" id="showpass2" name="showpass2" >
                                                    <label class="custom-control-label" for="showpass2"> Show Confirm Password</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-sm-3">
                                            <div class="form-group">  
                                                <label for="category">Select Category</label>
                                                <select class="floating-select form-control" id="category" name="category" required>
                                                    <option value="">Select Category</option>
                                                    <option value="school">School</option>
                                                    <option value="summer_class">Activity Classes</option>
                                                </select>
                                                
                                            </div>	
                                        </div>
                                    </div><!-- /form-row -->

                                    <!-- <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="terms" name="terms" required>
                                        <label class="custom-control-label mt-2" for="terms">I Agree with <a href="<?php echo base_url() ?>terms-and-conditions" target="_blank">Terms & Conditions</a></label>
                                    </div> -->

                                    <div class="form-group">
                                        <input type="hidden" class="form-control" id="ip" name="ip" aria-describedby="emailHelp" value="<?php echo $_SERVER['REMOTE_ADDR']; ?>">
                                    </div>

                                    <!-- <button type="submit" id="btnsubmit" class="btn btn-primary mb-4">SIGN UP</button> -->
                                <!-- </form> -->

                            </div>
                        </div><!-- /row -->

                        <!-- <p class="new-signin-copyright">&copy; 2019 Edugatein.com All Rights Reserved.</p> -->
                    </div><!-- /new-signin-right -->
                </div>
            </div><!-- /row -->
        </div><!-- /container-fluid -->
    </div><!-- /new-signin-section -->


    <style>
        .noclick  {
            pointer-events: none;
        }
    </style>

    <div id="school" class="hide">
        <div class="">
            <div class="">
                <div class="section-title mb-3">
                    <h3>Enter School Details</h3>
                    <!-- <span>(Platinum Package)</span> -->
                </div><!-- /section-title -->
                <hr>
                <div class="listing-section mat-30">
                    <!-- <form action="<?php echo base_url() ?>schools/admin/insert_school" id="form1" class="form1"method="post" enctype="multipart/form-data"> -->
                        <div class="edit-school-inner">
                            <div class="form-row">
                                <div class="col-lg-3 col-sm-6" style="display:none">
                                    <div class="form-group">
                                        <label for="user_id">user id</label>
                                        <input type="text" class="form-control" id="user_id" name="user_id" value="">
                                    </div>
                                </div>
                                <div class="col-lg-3 col-sm-6">
                                    <div class="form-group">
                                        <label for="schoolname">School Name</label>
                                        <input type="text" class="form-control" name="schoolname" id="schoolname" placeholder="e.g. Haunuz Matric School" required>
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
                                        <select class="form-control" name="school_city" id="exampleFormControlSelect1" required>
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
                                        <input type="text" name="school_area" class="form-control" id="area" placeholder="e.g.Nallampalayam" required>
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
                            </div>
                        <div class="edit-school-inner">
                            <div class="form-row mat-30">
                                <div class="col-lg-6 col-sm-6 file-img-upload">
                                    <h4>Add Banner Images</h4>
                                    <small style="display: block;font-weight: 300;" class="mb-3">You can add 3 banner images in Platinum package.</small>
                                    <div class="input-group mb-3">
                                        <div class="custom-file">
                                            <input type="file" name="school_banner1" accept="image/x-png,image/gif,image/jpeg" class="custom-file-input" id="inputGroupFile02">
                                            <label class="custom-file-label" for="inputGroupFile02" aria-describedby="inputGroupFileAddon02">Choose file</label>
                                        </div>
                                    </div><!-- /input-group -->
                                    <div class="input-group mb-3">
                                        <div class="custom-file">
                                            <input type="file" name="school_banner2" accept="image/x-png,image/gif,image/jpeg" class="custom-file-input" id="inputGroupFile03" >
                                            <label class="custom-file-label" for="inputGroupFile03" aria-describedby="inputGroupFileAddon02">Choose file</label>
                                        </div>
                                    </div><!-- /input-group -->
                                    <div class="input-group mb-3">
                                        <div class="custom-file">
                                            <input type="file" name="school_banner3" accept="image/x-png,image/gif,image/jpeg" class="custom-file-input" id="inputGroupFile04">
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
                        </div>
                        <div class="edit-school-inner">
                            <h4>Additional Info</h4>
                            <p class="mb-3">Only 6 additional infos are displayed.</p>
                            <hr class="mb-4">
                            <div class="form-row mt-3">
                                <div class="col-lg-4 col-sm-6">
                                    <div class="form-group">
                                        <label for="founded">Founded</label>
                                        <input type="text" name="school_founded" class="form-control" id="founded" placeholder="e.g.1980">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-6">
                                    <div class="form-group">
                                        <label for="special">Special</label>
                                        <input type="text" name="school_special" class="form-control" id="special" placeholder="e.g.French class">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-6">
                                    <div class="form-group">
                                        <label for="students">No.of Students</label>
                                        <input type="text" name="school_students" class="form-control" id="students" placeholder="e.g.2005">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-6">
                                    <div class="form-group">
                                        <label for="events">Events</label>
                                        <input type="text"  name="school_events" class="form-control" id="events" placeholder="e.g.Annual Day celebration">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-6">
                                    <div class="form-group">
                                        <label for="achievements">Achievements</label>
                                        <input type="text" name="school_achievements" class="form-control" id="achievements" placeholder="e.g.First in Sports">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-6">
                                    <div class="form-group">
                                        <label for="teachers">No.of Teachers</label>
                                        <input type="text" name="school_teachers" class="form-control" id="teachers" placeholder="e.g.55">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-6">
                                    <div class="form-group">
                                        <label for="branches">Branches</label>
                                        <input type="text" name="school_branches" class="form-control" id="branches" placeholder="e.g. Coimbatore,Thei, Erode">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-6">
                                    <div class="form-group">
                                        <label for="academic">Academic History</label>
                                        <input type="text" name="school_academic" class="form-control" id="academic" placeholder="e.g.Last year 98% Results">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-6">
                                    <div class="form-group">
                                        <label for="language">Languages</label>
                                        <input type="text" name="school_language" class="form-control" id="language" placeholder="e.g.French">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-6">
                                    <div class="form-group">
                                        <label for="activity">Activity</label>
                                        <input type="text" name="activity_school" class="form-control" id="activity" placeholder="e.g.Martial Arts">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-6">
                                    <div class="form-group">
                                        <label for="academic">No of Boys</label>
                                        <input type="text" name="boys" class="form-control" id="boys" placeholder="No of Boys">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-6">
                                    <div class="form-group">
                                        <label for="academic">No of Girls</label>
                                        <input type="text" name="girls" class="form-control" id="girls" placeholder="No of Girls">
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
                        </div>
                        <div class="edit-school-inner">
                            <h4>About Info</h4>
                            <hr class="mb-4">
                            <div class="form-row mt-3">
                                <div class="col-lg-6 col-sm-6">
                                    <div class="form-group">
                                        <label for="about">About Description</label>
                                        <textarea class="form-control" name="about" id="about" rows="1" style="height: 130px;"></textarea >
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-6">
                                    <label for="aboutimg1">About Image</label>
                                    <div class="input-group mb-3">
                                        <div class="custom-file">
                                            <input type="file" name="aboutimg1" class="custom-file-input" accept="image/x-png,image/gif,image/jpeg" id="inputGroupFile01" aria-describedby="aboutimg1" >
                                            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                        </div>
                                    </div>

                                    <!-- <label for="aboutimg2">About Image 2</label>
                                    <div class="input-group mb-3">
                                        <div class="custom-file">
                                            <input type="file" name="aboutimg2" class="custom-file-input" accept="image/x-png,image/gif,image/jpeg" id="inputGroupFile01" aria-describedby="aboutimg2" >
                                            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                        </div>
                                    </div> -->
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
                        </div>
                        <div class="edit-school-inner">
                            <h4>School Activities</h4>
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
                        </div>
                        <div class="edit-school-inner">
                            <h4>School Facilities</h4>
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
                        </div>
                        <div class="edit-school-inner">

                            <h3 class="mt-4 mb-3">Gallery Images</h3>
                            <hr class="mb-4">
                            <p class="mt-2">Add Gallery Images (jpg and png images only acceptable!).</p>
                            <div class="input_fields_wrap mt-3">
                                <div class="form-row">
                                    <div class="col-lg-4 col-sm-6">
                                        <div class="input-group mb-3">
                                            <input type="file" class="mytext1[]" id="mytext1[]" aria-describedby="inputGroupFile01" accept="image/x-png,image/gif,image/jpeg,image/jpg,image/X-PNG,image/GIF,image/JPEG,image/JPG" name="mytext[]" >
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-sm-6">
                                        <button type="button" class="add_field_button btn btn-primary btn-block">Add More</button>
                                    </div>
                                </div><!-- /form-row -->
                            </div><!-- /input_fields_wrap -->
                        </div>
                        <div class="edit-school-inner">
                            <h4>Location</h4>
                            <hr class="mb-4">
                            <div class="form-row">
                                <div class="col-lg-4 col-sm-6">
                                    <div class="form-group">
                                        <label for="phone">Phone Number</label>
                                        <input type="text" name="school_phone" class="form-control" id="phone" placeholder="e.g.+91 9876543210">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-6">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" name="school_email" class="form-control" id="email" placeholder="e.g.admin@gmail.com">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-6">
                                    <div class="form-group">
                                        <label for="website">Website</label>
                                        <input type="text" name="school_website" class="form-control" id="website" placeholder="e.g.www.yourwebsite.com">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-6">
                                    <div class="form-group">
                                        <label for="website">Map</label>
                                        <input type="text" name="school_map_url" class="form-control" id="website" placeholder="https://www.google.com/maps/@11.0231552,76.9523712,15z">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-6">
                                    <div class="form-group">
                                        <label for="address">Address</label>
                                        <textarea class="form-control" name="school_address" id="address" rows="1" style="height: 80px;"></textarea>
                                    </div>
                                </div>
                            </div><!-- /form-row -->
                        </div>
                        <div class="edit-school-inner">
                            <h4>Social Links</h4>
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
                            <div class="form-row">
                                <div class="col-lg-4 col-sm-6">
                                    <div class="form-group">
                                        <label for="school_category">Select Plan</label>
                                        <select class="form-control" name="school_category" id="exampleFormControlSelect1" required>
                                            <option value="" >--Select--</option>
                                            <option value="1">Platinum</option>
                                            <option value="2">Premium</option>
                                            <option value="3">Spectrum</option>
                                            <option value="4">Trial</option>
                                        </select>
                                    </div>
                                </div>


                                <div class="col-lg-4 col-sm-6">
                                    <div class="form-group">
                                        <label for="status">Status</label>
                                        <select class="form-control" name="school_status" id="exampleFormControlSelect1" required>
                                            <option value="" >--select--</option>
                                            <option value="0">Hold</option>
                                            <option value="1">Approve</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="edit-school-inner">
                            <!-- <button class="btn btn-danger">CANCEL</button> -->
                            <button class="btn btn-primary btn-save buy_now formsubmit float-right" id="formsubmit">SUBMIT</button>
                            <a href="<?php echo base_url('schools/admin')?>" class=""><button type="button" class="btn btn-danger">CANCEL</button></a>
                        </div>
                    <!-- </form> -->
                </div><!-- /listing-section -->
            </div><!-- /container -->
        </div><!-- /dashboard-content -->
    </div>
        <!-- Optional JavaScript -->
    <div class="clearfix"></div>


    <style>
        .noclick  {
            pointer-events: none;
        }
    </style>
    <div id="summer_class" class="hide">
        <div class="">
            <div class="">
                <div class="section-title mb-3">
                    <h3>Enter Activity Class Details</h3>
                    <!-- <span>(Platinum Package)</span> -->
                </div><!-- /section-title -->
                <hr class="mb-3">

                <div class="listing-section">
                    <!-- <form action="<?php echo base_url() ?>schools/admin/insert_class" id="form2" method="post" enctype="multipart/form-data"> -->
                    <div class="edit-school-inner">
                        <div class="form-row">
                            <div class="col-lg-3 col-sm-6" style="display:none">
                                <div class="form-group">
                                    <label for="user_id">user id</label>
                                    <input type="text" class="form-control user_id" id="user_id" name="user_id" value="">
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6">
                                <div class="form-group">
                                    <label for="institutename">Institute Name</label>
                                    <input type="text" class="form-control" id="institutename" placeholder="e.g Haunuz dance school" name="institutename" required>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6">
                                <div class="form-group">
                                    <label for="type">Institute Type</label>
                                    <select class="form-control" id="type" name="type" required>
                                        <option  value=""  >--Select Type--</option>
                                        <?php
                                        $this->db->select('*');
                                        $this->db->from('institute_categories');
                                        $category = $this->db->get();
                                        foreach ($category->result() as $categorys) {
                                            ?>
                                            <option value="<?php echo $categorys->category_name; ?>"><?php echo $categorys->category_name; ?></option>
                                        <?php } ?>
                                    </select>                          
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6">
                                <div class="form-group">
                                    <label for="city">City</label>
                                    <select class="form-control" id="exampleFormControlSelect1" name="city" required>
                                        <option  value="">--Select City--</option>
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
                                    <label for="text">Area</label>
                                    <input type="text" class="form-control" id="text" name="area" placeholder="e.g Nallampalayam" required>
                                </div>
                            </div>
                        </div><!-- /form-row -->
                    </div>
                    <div class="edit-school-inner">
                        <div class="form-row mt-3">
                            <div class="col-lg-6 col-sm-6 file-img-upload">
                                <label for="inputGroupFile" style="margin-bottom: 0px;">Add Banner Images</label>
                                <small style="display: block;font-weight: 300;" class="mb-3">You can add 3 banner images in Platinum package.</small>
                                <div class="input-group mb-3">
                                    <div class="custom-file">
                                        <input type="file" accept="image/x-png,image/gif,image/jpeg,image/jpg,image/X-PNG,image/GIF,image/JPEG,image/JPG" class="custom-file-input" id="inputGroupFile02" name="banner1" >
                                        <label class="custom-file-label" for="inputGroupFile02" aria-describedby="inputGroupFileAddon02">Choose file</label>
                                    </div>
                                </div><!-- /input-group -->
                                <div class="input-group mb-3">
                                    <div class="custom-file">
                                        <input type="file" accept="image/x-png,image/gif,image/jpeg,image/jpg,image/X-PNG,image/GIF,image/JPEG,image/JPG" class="custom-file-input" id="inputGroupFile03" name="banner2" >
                                        <label class="custom-file-label" for="inputGroupFile03" aria-describedby="inputGroupFileAddon02">Choose file</label>
                                    </div>
                                </div><!-- /input-group -->
                                <div class="input-group mb-3">
                                    <div class="custom-file">
                                        <input type="file" accept="image/x-png,image/gif,image/jpeg,image/jpg,image/X-PNG,image/GIF,image/JPEG,image/JPG" class="custom-file-input" id="inputGroupFile04" name="banner3" >
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
                                <label for="Images">Banner Image Sample</label>
                                <div class="object-fit" style="width: 100%;height: 252px;">
                                    <img src="<?php echo base_url("assets/front/images/"); ?>dashboard/1st-banner.jpg" class="w-100 rounded" alt="Images" style="width: 100%;height: 252px;object-fit: cover;">	
                                </div>
                            </div>
                        </div><!-- /form-row -->
                    </div>
                    <div class="edit-school-inner">

                        <h4 class="mt-3 mb-2">Additional Info</h4>
                        <p class="mb-3">Only 6 additional infos are displayed.</p>
                        <hr class="mb-4">
                        <div class="form-row mt-3">
                            <div class="col-lg-4 col-sm-6">
                                <div class="form-group">
                                    <label for="founded">Founded</label>
                                    <input type="text" class="form-control" id="founded" name="founded" placeholder="e.g 1980" >
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6">
                                <div class="form-group">
                                    <label for="special">Special</label>
                                    <input type="text" class="form-control" id="special" name="special" placeholder="e.g French class" >
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6">
                                <div class="form-group">
                                    <label for="students">No.of Students</label>
                                    <input type="text" class="form-control" id="students" name="students" placeholder="e.g 2005" >
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6">
                                <div class="form-group">
                                    <label for="events">Events</label>
                                    <input type="text" class="form-control" id="events" name="events" placeholder="e.g Annual Day celebration" >
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6">
                                <div class="form-group">
                                    <label for="achievements">Achievements</label>
                                    <input type="text" class="form-control" id="achievements" name="achievements" placeholder="e.g First in Sports" >
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6">
                                <div class="form-group">
                                    <label for="teachers">No.of Teachers</label>
                                    <input type="text" class="form-control" id="teachers" name="teachers" placeholder="e.g 55" >
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6">
                                <div class="form-group">
                                    <label for="branches">Branches</label>
                                    <input type="text" class="form-control" id="branches" name="branches" placeholder="e.g Coimbatore" >
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6">
                                <div class="form-group">
                                    <label for="languages">Languages</label>
                                    <input type="text" class="form-control" id="languages" name="languages" placeholder="e.g Hindi, Spoken English" >
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6">
                                <label for="customRadioInline1" class="pt-4 mb-0">Personal Trainer</label>
                                <div class="form-group">
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="customRadioInline1" value="yes" name="customRadioInline1" class="custom-control-input">
                                        <label class="custom-control-label mt-0" for="customRadioInline1">Yes</label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="customRadioInline2" value="no" name="customRadioInline1" class="custom-control-input">
                                        <label class="custom-control-label mt-0" for="customRadioInline2">No</label>
                                    </div>
                                </div>
                            </div>
                        </div><!--form-row -->
                    </div>
                    <div class="edit-school-inner">

                        <h4 class="mt-4 mb-2">About</h4>
                        <hr class="mb-3">
                        <div class="form-row">
                            <div class="col-lg-6 col-sm-6">
                                <label for="inputGroupFile01">About Image</label>
                                <div class="input-group mb-3">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" accept="image/x-png,image/gif,image/jpeg,image/jpg,image/X-PNG,image/GIF,image/JPEG,image/JPG" id="inputGroupFile01" name="aboutimage" aria-describedby="aboutimage" >
                                        <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-6">
                                <div class="form-group">
                                    <label for="aboutdesc">About Description</label>
                                    <textarea class="form-control" name="aboutdesc" id="aboutdesc" rows="1" ></textarea>
                                </div>
                            </div>
                        </div><!-- /form-row -->
                    </div>
                    <div class="edit-school-inner">

                        <h4 class="mt-4 mb-3">Institute Categories</h4>
                        <hr class="mb-4">
                        <div class="form-row" id="insmore">
                            <div class="col-lg-3 col-sm-6">
                                <div class="form-group">
                                    <label for="categoryname[]">Category Name</label>
                                    <input type="text" class="form-control" id="categoryname[]" name="categoryname[]" placeholder="e.g Sports" >
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6">
                                <label for="categoryimage[]">Category Image</label>
                                <div class=" mb-3">
                                    <div class="">
                                        <input type="file" class=""  accept="image/x-png,image/gif,image/jpeg,image/jpg,image/X-PNG,image/GIF,image/JPEG,image/JPG" id="categoryimage[]" name="categoryimage[]" aria-describedby="categoryimage[]" >
                                        <!-- <label class="" for="">Choose file</label> -->
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6">
                                <div class="form-group">
                                    <label for="categorydesc[]">Category Description</label>
                                    <textarea class="form-control" id="categorydesc[]" name="categorydesc[]" rows="1" ></textarea>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6">
                                <div class="form-group">
                                    <label for="addmore" style="visibility: hidden;display: block;">Add More</label>
                                    <a class="btn btn-primary addmore-show" id="addmore" name="addmore">Add More</a>
                                </div>
                            </div>
                        </div><!-- /form-row -->
                    </div>
                    <div class="edit-school-inner">

                        <h3 class="mt-4 mb-3">Gallery Images</h3>
                        <hr class="mb-4">
                        <p class="mt-2">Add Gallery Images (jpg and png images only acceptable!).</p>
                        <div class="input_fields_wrap mt-3">
                            <div class="form-row">
                                <div class="col-lg-4 col-sm-6">
                                    <div class="input-group mb-3">
                                        <input type="file" class="mytext1[]" id="mytext1[]" aria-describedby="inputGroupFile01" accept="image/x-png,image/gif,image/jpeg,image/jpg,image/X-PNG,image/GIF,image/JPEG,image/JPG" name="mytext[]" >
                                    </div>
                                </div>
                                <div class="col-lg-2 col-sm-6">
                                    <button type="button" class="add_field_button btn btn-primary btn-block">Add More</button>
                                </div>
                            </div><!-- /form-row -->
                        </div><!-- /input_fields_wrap -->
                    </div>
                    <div class="edit-school-inner">

                        <h3 class="mt-4 mb-3">News & Events</h3>
                        <hr class="mb-4">

                        <div class="form-row" >
                            <div class="col-lg-6 col-sm-6">
                                <label for="inputGroupFile01">News Banner Image</label>
                                <div class="input-group mb-3">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" accept="image/x-png,image/gif,image/jpeg,image/jpg,image/X-PNG,image/GIF,image/JPEG,image/JPG" id="inputGroupFile01" name ="newsbanner" aria-describedby="inputGroupFile01" >
                                        <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6"></div>
                        </div><!-- /form-row -->

                        <div class="form-row mt-3" id="newsmore">
                            <div class="col-lg-4 col-sm-6">
                                <div class="form-group">
                                    <label for="newsheading[]">News Heading</label>
                                    <input type="text" class="form-control" id="newsheading[]" name="newsheading[]" placeholder="e.g Salsa Dance" >
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-6">
                                <div class="form-group">
                                    <label for="newsdesc[]">News Description</label>
                                    <textarea class="form-control" id="newsdesc[]" name="newsdesc[]" rows="1" ></textarea>
                                </div>
                            </div>
                            <div class="col-lg-2 col-sm-6">
                                <div class="form-group">
                                    <label for="newsadd" style="visibility: hidden;">Add More</label>
                                    <a class="btn btn-primary addmore-show2 btn-block" id="newsadd">Add More</a>
                                </div>
                            </div>
                        </div><!-- /form-row -->
                    </div>
                    <div class="edit-school-inner">

                        <h3 class="mt-5 mb-3">Location</h3>
                        <hr class="mb-4">
                        <div class="form-row">
                            <div class="col-lg-3 col-sm-6">
                                <div class="form-group">
                                    <label for="phone">Phone Number</label>
                                    <input type="text" class="form-control" id="phone" name="phone" placeholder="e.g +91 9876543210" >
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="e.g admin@gmail.com" >
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6">
                                <div class="form-group">
                                    <label for="website">Website</label>
                                    <input type="text" class="form-control" id="website" name="website" placeholder="e.g www.yourwebsite.com" >
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6">
                                <div class="form-group">
                                    <label for="timing">Our Timings</label>
                                    <input type="text" class="form-control" id="timing" name="timing" placeholder="e.g 10:00 am - 8:00 pm" >
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6">
                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <textarea class="form-control" id="address" name="address" rows="1" placeholder="e.g Enter your address" style="height: 80px;" ></textarea>
                                </div>
                            </div>
                        </div><!-- /form-row -->
                        <div class="form-row">
                            <div class="col-lg-4 col-sm-6">
                                <div class="form-group">
                                    <label for="plan">Select Plan</label>
                                    <select class="form-control" name="position_id" id="exampleFormControlSelect1" required>
                                        <option value="" >--Select--</option>
                                        <option value="1" >Platinum</option>
                                        <option value="2">Premium</option>
                                        <option value="3">Spectrum</option>
                                        <option value="4">Trial</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6">
                                <div class="form-group">
                                    <label for="city">Status</label>
                                    <select class="form-control" name="status" id="exampleFormControlSelect1" required>
                                        <option value="" >--select--</option>
                                        <option value="0">Hold</option>
                                        <option value="1">Approve</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="edit-school-inner">
                        <button class="btn btn-primary btn-save buy_now formsubmit float-right" id="formsubmit1">SUBMIT</button>
                        <a href="<?php echo base_url('schools/admin/institute')?>"><button type="button" class="btn btn-danger">CANCEL</button></a>
                    </div>
                </div><!-- /listing-section -->
            </div><!-- /container -->
        </div><!-- /dashboard-content -->
    </div>
</form>




<script>
// $("#addmore").click(function () {
//   $("#actmore").append('<div class="form-row mt-3" id="actmore"><div class="col-lg-3 col-sm-6 form-group"><input type="text" class="form-control" id="activity" name="activity" placeholder="Sports"></div><div class="col-lg-7 col-sm-6"><div class="input-group mb-3 custom-file"><input type="file" class="" id="activityimage" name="activityimage" accept="image/x-png,image/gif,image/jpeg" id="" aria-describedby=""></div></div><div class="col-lg-2 col-sm-6 form-group"><a class="btn btn-primary addmore-show btn-block add_field_button1" id="addmore">Add More</a><a href="#" class="btn btn-danger">Remove</a></div></div>');
// });

    $(document).ready(function () {

        $('.hide').hide();
    // $('#school').show();
    $('#category').change(function () {
        $('.hide').hide();
        $('#'+$(this).val()).show();
    
    // if ($("#category").val() == 'school') {
    //     $("#school input").attr("disabled", false);
    //     $("#summer_class input").attr("disabled", true);
    // }
    // if ($("#category").val() == 'summer_class') {
    //     $("#school input").attr("disabled", true);
    //     $("#summer_class input").attr("disabled", false);
    // }
    })
    // $(".hide :input").attr("disabled", true);
    
//categories add more
        var max_fields = 50; //maximum input boxes allowed
        var activity = $("#insmore"); //Fields wrapper
        var act_button = $("#addmore"); //Add button ID

        var x = 1; //initlal text box count
        $(act_button).click(function (e) { //on add input button click
            e.preventDefault();
            if (x < max_fields) { //max input box allowed
                x++; //text box increment
                $(activity).append('<div class="form-row mx-0 w-100" name="insmore"><div class="col-lg-3 col-sm-6"><div class="form-group"><input type="text" class="form-control" id="" name="categoryname[]" placeholder="Sports"></div></div><div class="col-lg-3 col-sm-6"><div class="input-group mb-3"><div class="custom-file"><input type="file" class="" accept="image/x-png,image/gif,image/jpeg,image/jpg,image/X-PNG,image/GIF,image/JPEG,image/JPG" id="" name="categoryimage[]" aria-describedby=""></div></div></div><div class="col-lg-3 col-sm-6"><div class="form-group"><textarea class="form-control" id="" name="categorydesc[]" rows=""></textarea></div></div><div class="col-lg-3 col-sm-6 remove_field"><a href="#" class="btn btn-danger ">Remove</a></div></div></div>'); //add input box
            }
        });

        $(activity).on("click", ".remove_field", function (e) { //user click on remove text
            e.preventDefault();
            $(this).parent('div').remove();
            x--;
        })

//newsheading add more
        var max_fields = 50; //maximum input boxes allowed
        var news = $("#newsmore"); //Fields wrapper
        var news_button = $("#newsadd"); //Add button ID

        var x = 1; //initlal text box count
        $(news_button).click(function (e) { //on add input button click
            e.preventDefault();
            if (x < max_fields) { //max input box allowed
                x++; //text box increment
                $(news).append('<div class="form-row w-100 mx-0" id="newsmore"><div class="col-lg-4 col-sm-6"><div class="form-group"><input type="text" class="form-control" id="" name="newsheading[]" placeholder="Salsa Dance"></div></div><div class="col-lg-6 col-sm-6"><div class="form-group"><textarea class="form-control" id="" name="newsdesc[]" rows=""></textarea></div></div><div class="form-group"></div><div class="col-lg-2 col-sm-6  remove_field1"><a href="#" class="btn btn-danger btn-block">Remove</a></div></div>'); //add input box 
            }
        });

        $(news).on("click", ".remove_field1", function (e) { //user click on remove text
            e.preventDefault();
            $(this).parent('div').remove();
            x--;
        })

// var max_fields      = 50; //maximum input boxes allowed
// var wrapper         = $(".input_fields_wrap"); //Fields wrapper
// var add_button      = $(".add_field_button"); //Add button ID

// var x = 1; //initlal text box count
// $(add_button).click(function(e){ //on add input button click
//     e.preventDefault();
//     if(x < max_fields){ //max input box allowed
//         x++; //text box increment
//         $(wrapper).append('<div><div class="form-row"><div class="col-lg-4 col-sm-6"><div class="input-group mb-3"><input type="file" accept="image/x-png,image/gif,image/jpeg" name="mytext1[]"/></div></div><a href="#" class="remove_field2">Remove</a></div></div>'); //add input box
//     }
// });

// $(wrapper).on("click",".remove_field2", function(e){ //user click on remove text
//     e.preventDefault(); $(this).parent('div').remove(); x--;
// })



    });








    function myFunctionp(conf) {
        if (conf) {
            var x = document.getElementById("password");
        } else {
            var x = document.getElementById("confirm_password");
        }

        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }
    //Preloader
    $(window).on("load", function () {
        $('#preloader').fadeOut('slow', function () {
            $(this).remove();
        });
    });

    $(document).ready(function () {
        $(".formsubmit").on('click',function (event) {
            if($("#category").val() == 'school') {
                $("#signupschool").validate({
                    rules: {
                        name: "required",
                        adminphone: "required",
                    password: {
                    minlength: 5
                },
                confirm_password: {
                    minlength: 5,
                    equalTo: "#password"
                },
                    schoolname: "required",
                    schoolboard: "required",
                    school_city: "required",
                    school_area: "required",
                    pincode: "required",
                    level: "required",
                    school_phone: "required",
                    school_email: "required",
                    school_category: "required",
                    school_status: "required",
                },
                messages: {
                    schoolname: "this field is required"
                },
                errorElement: 'div',
                errorLabelContainer: '.errorTxt',
                errorPlacement: function (error, element) {
                    if (element.attr("name") == "terms")
                        element.parents('.custom-checkbox').append(error);
                    else
                        element.parents('.form-group').append(error);
                }
                });
            }
            if($("#category").val() == 'summer_class'){
                $("#signupschool").validate({
                    rules: {
                        name: "required",
                        adminphone: "required",
                        password: {
                            minlength: 5
                        },
                        confirm_password: {
                            minlength: 5,
                            equalTo: "#password"
                        },
                        institutename: "required",
                        type: "required",
                        city: "required",
                        area: "required",
                        phone: "required",
                        email: "required",
                        address: "required",
                        position_id: "required",
                        status: "required",
                    },
                    messages: {
                        schoolname: "this field is required"
                    },
                errorElement: 'div',
                errorLabelContainer: '.errorTxt',
                errorPlacement: function (error, element) {
                    if (element.attr("name") == "terms")
                        element.parents('.custom-checkbox').append(error);
                    else
                        element.parents('.form-group').append(error);
                }
                });
            }

            
        });
        $(".formsubmit").on('click',function (e) {
            $.ajax({
                    type: "POST",
                    processData: false, // Important!
                    contentType: false,
                    cache: false,
                    data: {usermail:$("#useremail").val()},
                    url: "<?php echo base_url("schools/admin/email_exist") ?>",
                    dataType: "json",
                    success: function (data) {
                        if (data.status == "error") {
                            sweetAlert("error", data.message.title, data.message.text, true);
                        }
                    }
            });
        });


        // $(".buy_now").on('click',function (event) {
        //     event.preventDefault();
        //     // $("#btnsubmit").prop("disabled", true);
        //     if ($("#signupschool").valid()) {
        //         // $("#btnsubmit").prop("disabled", false);
        //         // var form = $('#signupschool')[0];
        //         // var data = new FormData(form);
        //         // var data = $('#signupschool').serialize();
        //         var form = $('#signupschool')[0];
        //         var data = new FormData(form);
        //         $.ajax({
        //             type: "POST",
        //             processData: false, // Important!
        //             contentType: false,
        //             cache: false,
        //             data: data,
        //             url: "<?php echo base_url("schools/admin/admin_insert") ?>",
        //             dataType: "json",
        //             success: function (data) {
        //                 if (data.status == "error") {
        //                     sweetAlert("error", data.message.title, data.message.text, true);
        //                 } else {
        //                     if($('#category').val() == "school"){
        //                     $("#user_id").val(data.data.user_id);
        //                         $("#form1").submit();
        //                     } else {
        //                     $(".user_id").val(data.data.user_id);
        //                         $("#form2").submit();
        //                     }
        //                     // $("#mobileshort").text(data.data.mobile);
        //                     // $("#contact_email").val(data.data.contact_email);
        //                     // $("#otp").val(data.data.otp);
        //                     // $('#exampleModalCenter').modal('show');
        //                 }
        //             }
        //         });
        //     } 
        //     else {
        //         $("#signupschool").valid();
        //         $(".buy_now").prop("disabled", false);
        //         return false;
        //     }
        // });

        function sweetAlert(icon, title, text, button) {
            swal({
                title: title,
                text: text,
                icon: icon,
                buttons: button
            });
        }

        // $("#otpform").validate({
        //     rules: {

        //         otp: {
        //             minlength: 4,
        //             required: true
        //         }
        //     },
        //     messages: {
        //         confirm_password: "Password not matching"
        //     },
        //     errorElement: 'div',
        //     errorLabelContainer: '.errorTxt',
        //     errorPlacement: function (error, element) {
        //         element.parents('.form-group').append(error);
        //     }
        // });
    });
</script>
<script src="<?php echo base_url("assets/front/"); ?>js/dashboard.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js" integrity="sha512-37T7leoNS06R80c8Ulq7cdCDU5MNQBwlYoy1TX/WUsLFC2eYNqtKlV0QjH7r8JpG/S0GUMZwebnVFLPd6SU5yg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
