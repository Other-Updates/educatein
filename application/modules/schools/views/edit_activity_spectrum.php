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
$this->db->from('institute_details');
$this->db->where("id", $userid);
$institute = $this->db->get()->result_array();

foreach ($user->result() as $users) {
    $username = $users->name;
    $userid = $users->id;
}

// print_r($institute);exit;
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
            <?php if($institute[0]['position_id'] == 3){ ?>
            <span>(Spectrum Package)</span> 
            <?php } ?>
            <?php if($institute[0]['position_id'] == 4){ ?>
                <span>(Trial Package)</span> 
            <?php } ?>
           
        </div><!-- /section-title -->
        <hr>

        <div class="listing-section mat-30">
            <form action="<?php echo base_url() ?>institute_listing_third/insert" method="post" enctype="multipart/form-data">
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
                                <option value="">--Select Type--</option>
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
                            <label for="description">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="" style="height: 80px;" ></textarea>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-6"></div>
                </div><!-- /form-row -->

                <div class="form-row">
                    <div class="col-lg-6 col-sm-6 file-img-upload">
                        <label for="banner">Add Banner Image</label>
                        <input type="file" id="file-upload" name="banner" accept="image/x-png,image/gif,image/jpeg"  />
                        <label for="file-upload" class="file-upload" style="display: block;">
                            <img src="<?php echo base_url("assets/front/images/");?>dashboard/add-img.png" width="70px" alt="add-img">
                            <p>Upload Images</p>
                            <span>Images with format of jpg & png are acceptable.</span>
                        </label>
                        <div id="file-upload-filename"></div>
                    </div><!-- /file-img-upload -->

                    <div class="col-lg-4">
                        <label for="3rd-banner">Banner Image Sample</label>
                        <div class="object-fit" style="width: 100%;height: 180px;">
                            <img src="<?php echo base_url("assets/front/images/");?>dashboard/3rd-banner.jpg" class="w-100 rounded" alt="3rd-banner" style="width: 100%;height: 180px;object-fit: cover;">	
                        </div>
                    </div>
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
                            <a class="btn btn-primary addmore-show btn-block" id="catadd">Add More</a>
                        </div>
                    </div>
                </div><!-- /form-row -->

                <div class="form-row mt-3">
                    <div class="col-lg-4 col-sm-6">
                        <div class="form-group">
                            <label for="founded">Founded</label>
                            <input type="text" class="form-control" id="founded" name="founded" placeholder="e.g 1980" >
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <div class="form-group">
                            <label for="branches">Branches</label>
                            <input type="text" class="form-control" id="branches" name="branches" placeholder="e.g Kovai" >
                        </div>
                    </div>
                </div><!-- /form-row -->

                <div class="form-row">
                    <div class="col-lg-4 col-sm-6">
                        <div class="form-group">
                            <label for="propname">Proprietor Name</label>
                            <input type="text" class="form-control" id="propname" name="propname" placeholder="e.g Dance,sports,events" >
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <div class="form-group">
                            <label for="special">Specials In</label>
                            <input type="text" class="form-control" id="special" name="special" placeholder="e.g Library,hostel" >
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <div class="form-group">
                            <label for="address">Address</label>
                            <input type="text" class="form-control" id="address" name="address" placeholder="e.g 123 Main street,nallampalayam" >
                        </div>
                    </div>
                </div><!-- /form-row -->

                <div class="form-row">
                    <div class="col-lg-4 col-sm-6">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" id="email" name="email" placeholder="e.g admin@gmail.com" >
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
                            <label for="website">Website</label>
                            <input type="text" class="form-control" id="website" name="website" placeholder="e.g www.yoursite.com" >
                        </div>
                    </div>
                </div><!-- /form-row -->

                <h3 class="mt-4">Gallery Images</h3>
                <p class="mt-2">Add Gallery Images (jpg and png images only acceptable!).</p>
                <div class="input_fields_wrap mt-3">
                    <div class="form-row">
                        <div class="col-lg-4 col-sm-6">
                            <div class="input-group mb-3">
                                <input type="file" class="" id="mytext[]" aria-describedby="mytext[]" accept="image/x-png,image/gif,image/jpeg" name="mytext[]" >
                            </div>
                        </div>
                        <div class="col-lg-2 col-sm-6">
                            <button class="add_field_button btn btn-primary btn-block">Add More</button>
                        </div>
                    </div><!-- /form-row -->
                </div><!-- /input_fields_wrap -->

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
                $(activity).append('<div class="form-row w-100 mx-0" id="catmore"><div class="col-lg-4 col-sm-6"><div class="form-group"><input type="text" class="form-control" id="" name="categoryheading[]" placeholder="Salsa Dance"></div></div>	<div class="col-lg-6 col-sm-6"><div class="form-group"><textarea class="form-control" id="" name="categorydesc[]" rows=""></textarea></div></div><div class="col-lg-2 col-sm-6 remove_field"><a href="#" class="btn btn-danger btn-block">Remove</a></div></div>'); //add input box
            }
        });

        $(activity).on("click", ".remove_field", function (e) { //user click on remove text
            e.preventDefault();
            $(this).parent('div').remove();
            x--;
        })
    });
</script>
