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

$school_id = $institute[0]['id'];
?>

<style>
    .noclick  {
        pointer-events: none;
    }
</style>

<div class="dashboard-content">
    <div class="container-fluid">
        <div class="section-title mb-3">
            <h1><?php echo ucfirst($institute[0]['institute_name']); ?>
            <!-- <span>(Platinum Package)</span></h1>   -->
            <div class="status-btn">
                <?php if(empty($institute[0]['status'])){ ?>
                <button class="btn btn-warning" title="Hold" disabled ><i class="bi bi-hourglass-bottom"></i> Holded</button>
                <a href="<?php echo base_url() ?>schools/admin/approve_class/<?php echo base64_encode($school_id); ?>"><button class="btn btn-success" title="Approved"> Approve</button></a>
                <a href="<?php echo base_url() ?>schools/admin/reject_class/<?php echo base64_encode($school_id); ?>"><button class="btn btn-danger" title="Rejected">Reject</button></a>
                <?php } ?>
                <?php if($institute[0]['status'] == 2){ ?>
                <a href="<?php echo base_url() ?>schools/admin/hold_class/<?php echo base64_encode($school_id); ?>"><button class="btn btn-warning" title="Hold">Hold</button></a>
                <a href="<?php echo base_url() ?>schools/admin/approve_class/<?php echo base64_encode($school_id); ?>"><button class="btn btn-success" title="Approved">Approve</button></a>
                <button class="btn btn-danger" title="Rejected" disabled ><i class="bi bi-x-circle"></i> Rejected</button>
                <?php } ?>
                <?php if($institute[0]['status']== 1){ ?>
                <a href="<?php echo base_url() ?>schools/admin/hold_class/<?php echo base64_encode($school_id); ?>"><button class="btn btn-warning" title="Hold">Hold</button></a>
                <button class="btn btn-success" title="Approved" disabled ><i class="bi bi-check2-square"></i> Approved </button>
                <a href="<?php echo base_url() ?>schools/admin/reject_class/<?php echo base64_encode($school_id); ?>"><button class="btn btn-danger" title="Rejected">Reject</button></a>
                <?php } ?>
            </div>          
        </div>

        <div class="listing-section  mat-30">
            <form action="<?php echo base_url() ?>institute_listing_first/insert" method="post" enctype="multipart/form-data">
            <div class="edit-school-inner">
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
                            <input type="text" class="form-control" id="institutename" placeholder="e.g Haunuz dance school" value="<?php echo $institute[0]['institute_name']; ?>" name="institutename" readonly required>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="form-group">
                            <label for="type">Institute Type</label>
                            <input type="text" class="form-control" id="type" name="type" value="<?php echo $categories[0]['category_name'];?>" readonly >
                            <!-- <select class="form-control" id="type" name="type" readonly required disabled>
                                <option  value=""  >--Select Type--</option>
                                <?php
                                $this->db->select('*');
                                $this->db->from('institute_categories');
                                $category = $this->db->get();
                                foreach ($category->result() as $categorys) {
                                    ?><label> </label>
                                    <option value="<?php echo $categorys->category_name; ?>"<?php if($categorys->category_name == $categories[0]['category_name']){echo "selected";}?> ><?php echo $categorys->category_name; ?></option>
                                <?php } ?>
                            </select>                           -->
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="form-group">
                            <label for="city">City</label>
                            <input type="text" class="form-control" name="city" id="exampleFormControlSelect1" value="<?php echo $city1[0]['city_name'];?>" readonly >
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="form-group">
                            <label for="text">Area</label>
                            <input type="text" class="form-control" id="text" name="area" value="<?php echo $area[0]['area_name']; ?>" readonly placeholder="e.g Nallampalayam" required>
                        </div>
                    </div>
                </div><!-- /form-row -->
            </div>
            <div class="edit-school-inner">
                <!-- <h4 class="mb-2">Banner Image</h4>
                <p class="mb-3">You can add 3 banner images in Platinum package.</p> -->
                <!-- <hr class="mb-4"> -->
                
                                    <div class="row">
                    <div class="col-lg-12">
                        <label for="Images">Images</label>
                        <!-- <label for="Images">Banner Image Sample</label> -->
                        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                    <?php for($i=0;$i<(count($inst_img) + count($category_img));$i++){ ?>
                                        <li data-target="#carouselExampleIndicators" data-slide-to="<?php echo $i ?>" class="<?php if($i==0){echo 'active';} ?>"></li>
                                    <?php } ?>
                                </ol>
                            <div class="carousel-inner">
                                <?php $activeslide = true; ?>

                                <?php foreach($inst_img as $key=>$image){ ?>
                                    <div class="carousel-item <?php if($activeslide){echo 'active';$activeslide = false;} ?> ">
                                    <img class="d-block w-100" src="<?php echo base_url("/laravel/public/"); ?><?php echo $image['image'] ?> " alt="<?php echo $key ?> slide">
                                    </div>
                                <?php } ?>
                                <?php foreach($category_img as $key=>$image){ ?>
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
                        <!-- <div class="object-fit" style="width: 100%;height: 252px;">
                            <img src="<?php echo base_url("assets/front/images/"); ?>dashboard/1st-banner.jpg" class="w-100 rounded" alt="Images" style="width: 100%;height: 252px;object-fit: cover;">	
                        </div> -->
                    </div>
                                    </div>
                </div><!-- /form-row -->
            </div>
            <div class="edit-school-inner">

                <h4 class="mb-2">Additional Info</h4>
                <!-- <p class="mb-3">Only 6 additional infos are displayed.</p> -->
                <hr class="mb-4">
                <div class="form-row mt-3">
                    <div class="col-lg-4 col-sm-6">
                        <div class="form-group">
                            <label for="founded">Founded</label>
                            <input type="text" class="form-control" id="founded" value="<?php echo $founded[0]['content']; ?>"name="founded" readonly placeholder="e.g 1980" >
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <div class="form-group">
                            <label for="special">Special</label>
                            <input type="text" class="form-control" id="special" name="special" value="<?php echo $special[0]['content']; ?>" readonly placeholder="e.g French class" >
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <div class="form-group">
                            <label for="students">No.of Students</label>
                            <input type="text" class="form-control" id="students" value="<?php echo $students[0]['content']; ?>"name="students" readonly placeholder="e.g 2005" >
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <div class="form-group">
                            <label for="events">Events</label>
                            <input type="text" class="form-control" id="events" name="events" value="<?php echo $events[0]['content']; ?>" readonly placeholder="e.g Annual Day celebration" >
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <div class="form-group">
                            <label for="achievements">Achievements</label>
                            <input type="text" class="form-control" id="achievements" name="achievements" value="<?php echo $achievements[0]['content']; ?>" readonly placeholder="e.g First in Sports" >
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <div class="form-group">
                            <label for="teachers">No.of Teachers</label>
                            <input type="text" class="form-control" id="teachers" name="teachers" value="<?php echo $teachers[0]['content']; ?>" readonly placeholder="e.g 55" >
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <div class="form-group">
                            <label for="branches">Branches</label>
                            <input type="text" class="form-control" id="branches" name="branches" value="<?php echo $branches[0]['content']; ?>" readonly placeholder="e.g Coimbatore" >
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <div class="form-group">
                            <label for="languages">Languages</label>
                            <input type="text" class="form-control" id="languages" name="languages" value="<?php echo $language[0]['content']; ?>" readonly placeholder="e.g Hindi, Spoken English" >
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6">
                        <label for="customRadioInline1" class="pt-4 mb-0">Personal Trainer</label>
                        <div class="form-group">
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="customRadioInline1" value="yes" <?php if(!empty($trainer[0]['content'])){echo "checked";} ?> name="customRadioInline1" class="custom-control-input" disabled>
                                <label class="custom-control-label mt-0" for="customRadioInline1">Yes</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="customRadioInline2" value="no" name="customRadioInline1" <?php if(empty($trainer[0]['content'])){echo "checked";} ?> class="custom-control-input" disabled>
                                <label class="custom-control-label mt-0" for="customRadioInline2">No</label>
                            </div>
                        </div>
                    </div>
                </div><!--form-row -->
            </div>
            <div class="edit-school-inner">

                <h4 class="mb-2">About</h4>
                <hr class="mb-3">
                <div class="form-row">
                    <div class="col-lg-12 col-sm-12">
                        <div class="form-group">
                            <label for="aboutdesc">About Description</label>
                            <textarea class="form-control" name="aboutdesc" id="aboutdesc"rows="1" style="height: 130px;" readonly><?php echo $institute[0]['about']; ?></textarea>
                        </div>
                    </div>
                </div><!-- /form-row -->
            </div>
            <?php if(isset($inst_category[0])){ ?>
            <div class="edit-school-inner">
                    <h4 class="mb-3">Institute Categories</h4>
                    <hr class="mb-4">
                    <?php foreach($inst_category as $key=>$category){ ?>
                        <div class="form-row" id="insmore">
                            <div class="col-lg-3 col-sm-6">
                                <div class="form-group">
                                    <?php if($key==0){ ?><label for="categoryname[]">Category Name</label><?php } ?>
                                    <input type="hidden" name="program_id[]" id="program_id[]" value="<?php echo $category['id']; ?>">
                                    <input type="text" class="form-control" id="categoryname[]" name="categoryname[]" value="<?php echo $category['program_name'] ?>" placeholder="e.g Sports" readonly>
                                </div>
                            </div>
                            <div class="col-lg-9 col-sm-6">
                                <div class="form-group">
                                <?php if($key==0){ ?><label for="categorydesc[]">Category Description</label><?php } ?>
                                    <textarea class="form-control" id="categorydesc[]" name="categorydesc[]" rows="1" readonly><?php echo $category['about']; ?></textarea>
                                </div>
                            </div>
                            
                        </div><!-- /form-row -->
                    <?php } ?>
                    <?php }?>
            <!-- <div class="edit-school-inner">

                <h4 class="mb-3">Gallery Images</h4>
                <hr class="mb-4">
                <p class="mt-2">Add Gallery Images (jpg and png images only acceptable!).</p>
                <div class="input_fields_wrap mt-3">
                    <div class="form-row">
                        <div class="col-lg-4 col-sm-6">
                            <div class="input-group mb-3">
                                <input type="file" class="mytext1[]" id="mytext1[]" aria-describedby="inputGroupFile01" accept="image/x-png,image/gif,image/jpeg,image/jpg,image/X-PNG,image/GIF,image/JPEG,image/JPG" name="mytext1[]" >
                            </div>
                        </div>
                        <div class="col-lg-2 col-sm-6">
                            <input type="buton" class="add_field_button btn btn-primary btn-block" value="Add More">
                        </div>
                    </div>
                </div> -->
            </div>
            <div class="edit-school-inner">

                <h4 class="mb-3">News & Events</h4>
                <hr class="mb-4">

                <!-- <div class="form-row" >
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
                </div> -->
                <!-- /form-row -->
                <?php foreach($news as $key=>$news1){ ?>
                    <div class="form-row mt-3" id="newsmore">
                        <div class="col-lg-3 col-sm-6">
                            <div class="form-group">
                                <?php if($key == 0){ ?><label for="newsheading[]">News Heading</label><?php } ?>
                                <input type="text" class="form-control" id="newsheading[]" name="newsheading[]" value="<?php echo $news1['news']; ?>" readonly placeholder="e.g Salsa Dance" >
                            </div>
                        </div>
                        <div class="col-lg-9 col-sm-6">
                            <div class="form-group">
                            <?php if($key == 0){ ?><label for="newsdesc[]">News Description</label><?php } ?>
                                <textarea class="form-control" id="newsdesc[]" name="newsdesc[]"  rows="1" readonly ><?php echo $news1['news_brief']; ?></textarea>
                            </div>
                        </div>
                    </div>
                <?php } ?><!-- /form-row -->
            </div>
            <div class="edit-school-inner">

                <h4 class="mb-3">Location</h4>
                <hr class="mb-4">
                <div class="form-row">
                    <div class="col-lg-3 col-sm-6">
                        <div class="form-group">
                            <label for="phone">Phone Number</label>
                            <input type="text" class="form-control" id="phone" name="phone" value="<?php echo $institute[0]['mobile']; ?>" placeholder="e.g +91 9876543210" readonly>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?php echo $institute[0]['email']; ?>" placeholder="e.g admin@gmail.com" readonly>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="form-group">
                            <label for="website">Website</label>
                            <input type="text" class="form-control" id="website" name="website" value="<?php echo $institute[0]['website_url']; ?>" placeholder="e.g www.yourwebsite.com" readonly>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="form-group">
                            <label for="timing">Our Timings</label>
                            <input type="text" class="form-control" id="timing" name="timing" value="<?php echo $institute[0]['timings']; ?>" placeholder="e.g 10:00 am - 8:00 pm" readonly>
                        </div>
                    </div>
                    <div class="col-lg-9 col-sm-6">
                        <div class="form-group">
                            <label for="address">Address</label>
                            <textarea class="form-control" id="address" name="address" rows="1" placeholder="e.g Enter your address" style="height: 80px;" readonly><?php echo $institute[0]['address']; ?></textarea>
                        </div>
                    </div>
                </div><!-- /form-row -->
            </div>
            <div class="edit-school-inner">
            <a href="<?php echo base_url('schools/admin/institute')?>"><button type="button" class="btn btn-danger">BACK</button></a>
            </div>
            </form>
        </div><!-- /listing-section -->
    </div><!-- /container -->
</div><!-- /dashboard-content -->


<script>
// $("#addmore").click(function () {
//   $("#actmore").append('<div class="form-row mt-3" id="actmore"><div class="col-lg-3 col-sm-6 form-group"><input type="text" class="form-control" id="activity" name="activity" placeholder="Sports"></div><div class="col-lg-7 col-sm-6"><div class="input-group mb-3 custom-file"><input type="file" class="" id="activityimage" name="activityimage" accept="image/x-png,image/gif,image/jpeg" id="" aria-describedby=""></div></div><div class="col-lg-2 col-sm-6 form-group"><a class="btn btn-primary addmore-show btn-block add_field_button1" id="addmore">Add More</a><a href="#" class="btn btn-danger">Remove</a></div></div>');
// });


    $(document).ready(function () {
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
<script src="<?php echo base_url("assets/front/"); ?>js/dashboard.js"></script>
