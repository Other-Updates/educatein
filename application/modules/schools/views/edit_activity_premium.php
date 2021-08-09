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

<div class="dashboard-content">
    <div class="container">
        <div class="section-title mb-3">
            <h1>Enter your details</h1>
            <span>(Premium Package)</span>
        </div><!-- /section-title -->
        <hr>

        <div class="listing-section mat-30">
            <form action="<?php echo base_url() ?>institute_listing_second/insert" method="post" enctype="multipart/form-data">
                <div class="form-row">
                    <div class="col-lg-3 col-sm-6" style="display:none">
                        <div class="form-group">
                            <label for="user_id">user id</label>
                            <input type="text" class="form-control" id="user_id" name="user_id" value="<?php echo $userid; ?>" placeholder="e.g PSG Matriculation" required>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="form-group">
                            <label for="institutename">Institute Name</label>
                            <input type="text" class="form-control" id="institutename" name="institutename" placeholder="e.g Haunuz dance school" required>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="form-group">
                            <label for="type">Institute Type</label>
                            <select class="form-control" id="type" name="type" required>
                                <option  value="">--Select Type--</option>
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
                            <label for="area">Area</label>
                            <input type="text" class="form-control" id="area" name="area" placeholder="e.g Nallampalayam" required>
                        </div>
                    </div>

                </div><!-- /form-row -->

                <div class="form-row mt-3">
                    <div class="col-lg-6 col-sm-6">
                        <div class="form-group">
                            <label for="description">About Description</label>
                            <textarea class="form-control" id="description" rows="1" name="description" style="height: 80px;" ></textarea>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6"></div>
                </div><!-- /form-row -->

                <div class="form-row">
                    <div class="col-lg-6 col-sm-6 file-img-upload">
                        <label for="banner">Add Banner Image</label>
                        <input type="file" id="file-upload" name="banner" accept="image/x-png,image/gif,image/jpeg"  />
                        <label for="file-upload" class="file-upload" style="display: block;">
                            <img src="<?php echo base_url("assets/front/images/"); ?>dashboard/add-img.png" width="70px" alt="Images">
                            <p>Upload Images</p>
                            <span>Images with format of jpg & png are acceptable.</span>
                        </label>
                        <div id="file-upload-filename"></div>
                    </div><!-- /file-img-upload -->

                    <div class="col-lg-4">
                        <label for="Sample">Banner Image Sample</label>
                        <div class="object-fit" style="width: 100%;height: 180px;">
                            <img src="<?php echo base_url("assets/front/images/"); ?>dashboard/1st-banner.jpg" class="w-100 rounded" alt="" style="width: 100%;height: 180px;object-fit: cover;">	
                        </div>
                    </div>
                </div><!-- /form-row -->

                <div class="form-row">
                    <div class="col-lg-6">
                        <div class="alert alert-primary mt-3 mab-30" role="alert">
                            <p class="image-note">Choose your banner images in high quality to attract more peoples.</p>
                        </div>
                    </div>
                    <div class="col-lg-6"></div>
                </div>

                <h2 class="mt-4 mb-2">Dance Classes</h2>
                <hr class="mb-4">
                <div class="form-row">
                    <div class="col-lg-6 col-sm-6 file-img-upload">
                        <label for="categorybanner">Add Category Banner Image</label>
                        <div class="input-group mb-3">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" accept="image/x-png,image/gif,image/jpeg" id="inputGroupFile01" name="categorybanner" aria-describedby="categorybanner" >
                                <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                            </div>
                        </div>
                    </div><!-- /file-img-upload -->

                    <div class="col-lg-6"></div>
                </div><!-- /form-row -->

                <div class="form-row mt-3" id="catmore">
                    <div class="col-lg-4 col-sm-6">
                        <div class="form-group">
                            <label for="categoryheading[]">Category Heading</label>
                            <input type="text" class="form-control" id="categoryheading[]" name="categoryheading[]" placeholder="e.g Salsa Dance" >
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6">
                        <div class="form-group">
                            <label for="categorydesc[]">Category Description</label>
                            <textarea class="form-control" id="categorydesc[]" name="categorydesc[]" rows="1" ></textarea>
                        </div>
                    </div>
                    <div class="col-lg-2 col-sm-6">
                        <div class="form-group">
                            <label for="catadd" style="visibility: hidden;">Add More</label>
                            <a class="btn btn-primary addmore-show btn-block" id="catadd" >Add More</a>
                        </div>
                    </div>
                </div><!-- /form-row -->


                <h3 class="mt-4 mb-3">News & Events</h3>
                <hr class="mb-4">
                <div class="form-row mt-3" id="newsmore">
                    <div class="col-lg-4 col-sm-6">
                        <div class="form-group">
                            <label for="news[]">News Heading</label>
                            <input type="text" class="form-control" id="news[]" name="news[]" placeholder="e.g Salsa Dance" >
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
                            <a class="btn btn-primary addmore-show1 btn-block" id="newsadd" >Add More</a>
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
                                <input type="file" class="" id="" aria-describedby="mytext[]" accept="image/x-png,image/gif,image/jpeg" name="mytext[]" >
                            </div>
                        </div>
                        <div class="col-lg-2 col-sm-6">
                            <button class="add_field_button btn btn-primary btn-block">Add More</button>
                        </div>
                    </div><!-- /form-row -->
                </div><!-- /input_fields_wrap -->

                <h3 class="mt-4 mb-3">Location</h3>
                <hr class="mb-4">
                <div class="form-row">
                    <div class="col-lg-4 col-sm-6">
                        <div class="form-group">
                            <label for="address">Address</label>
                            <textarea class="form-control" id="address" rows="1" name="address" placeholder="e.g Your address" ></textarea>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <div class="form-group">
                            <label for="phone">Phone Number</label>
                            <input type="text" class="form-control" id="phone" name="phone" placeholder="e.g 9876543210" >
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" id="email" name="email" placeholder="e.g www.yoursite.com" >
                        </div>
                    </div>
                </div><!-- /form-row -->


                <button class="btn btn-primary btn-save">Submit</button>
            </form>
        </div><!-- /listing-section -->
    </div><!-- /container -->
</div><!-- /dashboard-content -->




<script>
    $(document).ready(function () {
        //categories add more
        var max_fields = 50; //maximum input boxes allowed
        var activity = $("#catmore"); //Fields wrapper
        var act_button = $("#catadd"); //Add button ID

        var x = 1; //initlal text box count
        $(act_button).click(function (e) { //on add input button click
            e.preventDefault();
            if (x < max_fields) { //max input box allowed
                x++; //text box increment
                $(activity).append('<div class="form-row w-100 mx-0" id="catmore"><div class="col-lg-4 col-sm-6"><div class="form-group"><input type="text" class="form-control" id="" name="categoryheading" placeholder="Salsa Dance"></div></div><div class="col-lg-6 col-sm-6"><div class="form-group"><textarea class="form-control" id="" name="categorydesc" rows=""></textarea></div></div><div class="col-lg-2 col-sm-6 remove_field"><a href="#" class="btn btn-danger btn-block">Remove</a></div>'); //add input box
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
                $(news).append('<div class="form-row w-100 mx-0" id="newsmore"><div class="col-lg-4 col-sm-6"><div class="form-group"><input type="text" class="form-control" id="" name="news[]" placeholder="Salsa Dance"></div></div><div class="col-lg-6 col-sm-6"><div class="form-group"><textarea class="form-control" id="" name="newsdesc[]" rows=""></textarea></div></div><div class="col-lg-2 col-sm-6 remove_field1"><a href="#" class="btn btn-danger btn-block">Remove</a></div></div>'); //add input box 
            }
        });

        $(news).on("click", ".remove_field1", function (e) { //user click on remove text
            e.preventDefault();
            $(this).parent('div').remove();
            x--;
        })


    });

</script>
