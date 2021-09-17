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
    .error{
        color: #D8000C;
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
            <span>(Platinum Package)</span>
        </div><!-- /section-title -->
        <hr class="mb-3">

        <div class="listing-section">
            <form action="<?php echo base_url() ?>institute_listing_first/insert" method="post" id="platinum" enctype="multipart/form-data">
                <div class="form-row">
                    <div class="col-lg-3 col-sm-6" style="display:none">
                        <div class="form-group">
                            <label for="user_id">user id</label>
                            <input type="text" class="form-control" id="user_id" name="user_id" value="<?php echo $userid; ?>"  placeholder="e.g PSG Matriculation" required>
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
                            <button class="add_field_button btn btn-primary btn-block">Add More</button>
                        </div>
                    </div><!-- /form-row -->
                </div><!-- /input_fields_wrap -->

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
                    <div class="col-lg-3 col-sm-6">
                        <div class="form-group">
                            <label for="map_url">Map</label>
                            <input type="text" class="form-control" id="map_url" style="width:650px" name="map_url" placeholder="google.maps" >
                        </div>
                    </div>
                </div><!-- /form-row -->
                <button type="submit" class="btn btn-primary btn-save" id="formsubmit">SUBMIT</button>
            </form>
        </div><!-- /listing-section -->
    </div><!-- /container -->
</div><!-- /dashboard-content -->


<script>
// $("#addmore").click(function () {
//   $("#actmore").append('<div class="form-row mt-3" id="actmore"><div class="col-lg-3 col-sm-6 form-group"><input type="text" class="form-control" id="activity" name="activity" placeholder="Sports"></div><div class="col-lg-7 col-sm-6"><div class="input-group mb-3 custom-file"><input type="file" class="" id="activityimage" name="activityimage" accept="image/x-png,image/gif,image/jpeg" id="" aria-describedby=""></div></div><div class="col-lg-2 col-sm-6 form-group"><a class="btn btn-primary addmore-show btn-block add_field_button1" id="addmore">Add More</a><a href="#" class="btn btn-danger">Remove</a></div></div>');
// });


    $(document).ready(function () {
        $("#formsubmit").on('click',function (event) {
            $("#platinum").validate({
                rules: {
                        institutename: "required",
                        type: "required",
                        banner1: "required",
                        city: "required",
                        area: "required",
                        phone: "required",
                        email: "required",
                        address: "required",
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
        });
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
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js" integrity="sha512-37T7leoNS06R80c8Ulq7cdCDU5MNQBwlYoy1TX/WUsLFC2eYNqtKlV0QjH7r8JpG/S0GUMZwebnVFLPd6SU5yg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> 


