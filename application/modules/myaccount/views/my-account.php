<style>
body{
    overflow-x: hidden;
}
</style>
<?php
//defined('BASEPATH') OR exit('No direct script access allowed');
// echo $this->session->userdata('school'); 
$email = $this->session->userdata('school');
// $user_id = base64_decode($_GET['id']);
$user_id = $this->session->userdata('user_id');
if ($user_id) {   
    $this->db->select('*');
    $this->db->from('user_register');
    $this->db->where("id", $user_id);
    $user = $this->db->get();

    foreach ($user->result() as $users) {
        $email = $users->email;
    }
}
$this->db->select('*')->where('email =', $email);
$this->db->from('user_register');
$user = $this->db->get();

if ($user->num_rows() > 0) {
    foreach ($user->result() as $users) {
        $username = $users->name;
        $userid = $users->id;
        $address = $users->address;
        $phone = $users->phone;
        $state = $users->state;
        $country = $users->country;
        $pincode = $users->pincode;
        $image = $users->image;
        $cityid = $users->city_id;
        $ip = $users->ip;

        // echo $image;
        // exit();

        $this->db->select('*')->where('id =', $cityid);
        $this->db->from('cities');
        $city = $this->db->get();
        foreach ($city->result() as $cities) {
            $city = $cities->city_name;
        }
    }
}
?>
<!-- <div class="dashboard-menu">
        <div class="container">
                <ul class="list-inline">
                        <li class="list-inline-item noclick"><a href="#" class="active"><i class="lnr lnr-user"></i> My Account</a></li>
<?php if ($address == NULL) { ?>

                                <li class="list-inline-item noclick"><a href="<?php echo base_url() ?>package"><i class="lnr lnr-gift"></i> Package Details</a></li>
    <?php
} else {
    ?>
                                <li class="list-inline-item"><a href="<?php echo base_url() ?>package?id=<?php echo base64_encode($userid); ?> "><i class="lnr lnr-gift"></i> Package Details</a></li>
    <?php
}
?>
                        <li class="list-inline-item">
                                <a href="" data-toggle="modal" data-target="#exampleModalCenter1"><i class="lnr lnr-exit"></i> Logout</a>
                        </li>
                </ul>
        </div>
</div> -->

<!-- Modal -->
<!-- <div class="log-out-modal">
        <div class="modal fade" id="exampleModalCenter1" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                        </button>
                                <h2 class="mb-3">Are you sure want to logout?</h2>
                                <ul class="list-inline">
                                        <li class="list-inline-item">
                                                <button type="button" class="btn btn-secondary">YES</button>
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">NO</button>
                                        </li>
                                </ul>
                </div>
                </div>
        </div>
</div> -->

<div class="student-dashboard-body">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 mab-30">
                <div class="student-dashboard-sidebar sticky-sidebar shadow-lg">
                    <div class="text-center">
                        <div class="student-profile-img">

                            <?php
                            if ($image != NULL) {
                                ?>
                                <img src="<?php echo base_url(); ?>images/myaccount/<?php echo $image ?>" class="mb-3 rounded-circle" alt="">
                                <?php
                            } else {
                                ?>
                                <img src="<?php echo base_url("assets/front/"); ?>images/dashboard/profile-img.png" class="mb-3 rounded-circle" alt="">
                                <?php
                            }
                            ?>
                        </div><!-- /student-profile-img -->
                        <h5 class="mt-2"><?php echo $username; ?></h5>
                    </div>
                    <hr class="my-3">

                    <ul class="list-group">
                        <li class="list-group-item noclick">
                            <a href="<?php echo base_url() ?>my-account" style="color:#d12881;"><i class="lnr lnr-user"></i> My Account</a>
                        </li>
                        <?php if ($address == NULL) { ?>

                            <li class="list-group-item">
                                <a href="<?php echo base_url() ?>package?id=<?php echo base64_encode($userid); ?>"><i class="lnr lnr-gift"></i> Package Details</a>
                            </li>
                        <?php } else { ?>

                            <li class="list-group-item">
                                <a href="<?php echo base_url() ?>package?id=<?php echo base64_encode($userid); ?>"><i class="lnr lnr-gift"></i> Package Details</a>
                            </li>
                        <?php } ?>

                        <li class="list-group-item">
                            <a href="<?php echo base_url() ?>plan-details?id=<?php echo base64_encode($userid); ?>"><i class="lnr lnr-license"></i> &nbsp;Plan Details</a>
                        </li>

                        <li class="list-group-item">
                            <a href="<?php echo base_url("logout") ?>" class="logout"><i class="lnr lnr-exit"></i> Logout</a>
                        </li>
                    </ul>
                </div><!-- /student-dashboard-sidebar -->
            </div><!-- /col-lg-3 -->

            <?php
            $this->db->select('*')->where('user_id =', $userid);
            $this->db->where('is_active =','1');
            $this->db->where('deleted_at =', NULL);
            $this->db->from('school_details');
            $school = $this->db->get();

            $this->db->select('*')->where('user_id =', $userid);
            $this->db->where('is_active =','1');
            $this->db->where('deleted_at =', NULL);
            $this->db->from('institute_details');
            $institute = $this->db->get();
            ?>

            <div class="col-lg-9 pl-8">
                <div class="plan-expiry-notification mt-3">
                    <div class="modal-body text-center col-lg-12 pl-8" style="margin-left:300px">
                        <a href="<?php echo base_url(); ?>schoolfirst?id=<?php echo base64_encode($userid); ?>"><button class="btn btn-pink">ADD SCHOOL</button></a>
                        <a href="<?php echo base_url(); ?>institutefirst?id=<?php echo base64_encode($userid); ?>"><button class="btn btn-primary">ACTIVITY CLASS</button></a>
                    </div>
                    <?php
                    //school expiry alert
                    if ($school->num_rows() > 0) {
                        foreach ($school->result() as $schools) {
                            $valitity = $schools->valitity;

                            $activate = new DateTime($schools->activated_at);
                            $act_date = $activate->getTimestamp();
                            $date = new DateTime();
                            $cur_date = $date->getTimestamp();

                            $spend = round($cur_date / (60 * 60 * 24) - $act_date / (60 * 60 * 24));
                            $remain = $valitity - $spend;
                            if ($valitity == "" || $remain <= 0) {
                                ?>
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <!-- <h5 class="alert-heading mb-2">Plan Expired!</h5> -->
                                    <p style="font-weight: 300;">Your premium plan for <strong><?php echo $schools->slug; ?></strong> is expired. To get more service, upgrade your plan again.</p>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <?php
                            } 
                            // elseif ($remain <= 5 ) {
                                ?>
                                <!-- <div class="alert alert-warning alert-dismissible fade show" role="alert"> -->
                                    <!-- <h5 class="alert-heading mb-2">Plan Expiring Soon!</h5> -->
                                    <!-- <p style="font-weight: 300;">Your premium plan for <strong><?php //echo $schools->slug; ?></strong> will expires in <?php //echo $remain; ?> days. If you wish to receive our service without any interruption please upgrade your plan again.</p>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div> -->
                                <?php
                            // }

                            // exit();
                        }
                    }

//institute expiry alert
                    if ($institute->num_rows() > 0) {
                        foreach ($institute->result() as $institutes) {
                            $valitity = $institutes->valitity;

                            $activate = new DateTime($institutes->activated_at);
                            $act_date = $activate->getTimestamp();
                            $date = new DateTime();
                            $cur_date = $date->getTimestamp();

                            $spend = round($cur_date / (60 * 60 * 24) - $act_date / (60 * 60 * 24));
                            $remain = $valitity - $spend;

                            if ($valitity == "" || $remain <= 0) {
                                ?>
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <!-- <h5 class="alert-heading mb-2">Plan Expired!</h5> -->
                                    <p style="font-weight: 300;">Your premium plan for <strong><?php echo $institutes->slug; ?></strong> is expired. To get more service, upgrade your plan again.</p>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <?php
                            } 
                            // elseif ($remain <= 5) {
                                ?>
                                <!-- <div class="alert alert-warning alert-dismissible fade show" role="alert"> -->
                                    <!-- <h5 class="alert-heading mb-2">Plan Expiring Soon!</h5> -->
                                    <!-- <p style="font-weight: 300;">Your premium plan for <strong><?php echo $institutes->slug; ?></strong> will expires in <?php echo $remain; ?> days. If you wish to receive our service without any interruption please upgrade your plan again.</p>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div> -->
                                <?php
                            // }

                            // exit();
                        }
                    }
                    ?>


                </div><!-- /plan-expiry-notification -->

                <!-- <div class="section-title mab-30">
                        <h2 class="mb-2">My Account</h2>
                        <p style="font-weight: 500;">In order to access some features of the service, you will <br> have to fill out your account details.</p>
                        <hr class="mt-3">
                </div> -->


                <?php if ($ip == NULL) { ?>

                    <h3 class="mb-3">Personal Information</h3>
                    <form class="" enctype="multipart/form-data" name="Form" onsubmit="return validateForm()" method="post" >
                        <div class="form-row">
                            <div class="col-lg-4 col-sm-6">
                                <div class="form-group">
                                    <!-- <label for="">Address Line 1</label> -->
                                    <input type="text" class="form-control" id="address" name="address" <?php if(!empty($users->address)){ ?> value="<?php echo $address ?>" <?php } ?> placeholder="Enter your address" required>

                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6" style="display:none">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="useremail" name="useremail" value="<?php echo $email; ?>" required>             
                                </div>
                            </div>
                            <?php
                            $this->db->select('*')->where('is_active', 1);
                            $this->db->from('cities');
                            $city = $this->db->get();

                            $this->db->select('*')->where('id',$users->city_id);
                            $this->db->from('cities');
                            $city_name = $this->db->get()->result_array();

                            ?>

                            <div class="col-lg-4 col-sm-6">
                                <div class="form-group">
                                    <!-- <label for="">City</label> -->
                                    <select class="form-control" id="city" name="city" required>
                                        <option value="">--Select City--</option>
                                        <?php
                                        foreach ($city->result() as $cities) {
                                            ?>

                                            <option value="<?php echo $cities->id; ?>"<?php if($cities->id == $users->city_id){ echo "selected"; }?>><?php echo $cities->city_name; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6">
                                <div class="form-group">
                                    <!-- <label for="">Pincode</label> -->
                                    <input type="text" class="form-control" id="pincode" <?php if(!empty($users->pincode)){ ?> value="<?php echo $users->pincode ?>" <?php } ?> name="pincode" placeholder="Pincode" >
                                </div>
                            </div>

                            <div class="col-lg-4 col-sm-6">
                                <div class="form-group">
                                    <!-- <label for="">State</label> -->
                                    <input type="text" class="form-control" id="state" name="state" <?php if(!empty($users->state)){ ?> value="<?php echo $users->state ?>" <?php } ?> placeholder="State">
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6">
                                <div class="form-group">
                                    <!-- <label for="">Country</label> -->
                                    <input type="text" class="form-control" id="country" name="country" <?php if(!empty($users->country)){ ?> value="<?php echo $users->country ?>" <?php } ?> placeholder="Country">
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <!-- <label for="inputEmail4">Profile Image</label> -->
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" accept="image/png,image/gif,image/jpeg" id="inputGroupFile01" name="image" aria-describedby="inputGroupFileAddon01">
                                    <label class="custom-file-label" for="inputGroupFile01">Profile Image</label>
                                </div>
                                <!-- <small id="emailHelp" class="form-text text-muted mt-3" style="font-weight: 300;">Perfect Image file size 150px x 150px.</small> -->
                            </div>
                        </div><!-- /form-row -->
                        <button type="submit" class="btn btn-primary btn-save mt-2" data-toggle="modal" data-target="#personalinfo-save">SAVE</button>
                    </form>

                    <div class="password-settings mt-4">
                        <h3 class="mb-3">Password Settings</h3>
                        <form action="<?php echo base_url() ?>my-account/changepassword" method="post" onsubmit="changepassword()">
                            <div class="form-row">
                                <div class="col-lg-4 col-sm-6">
                                    <!-- <label for="">Current Password</label> -->
                                    <div class="form-group input-group">
                                        <input type="password" class="form-control" id="password" name="currentpassword" placeholder="Current Password" required>
                                        <!-- <div class="input-group-append">
                                            <span class="input-group-text" id="show-password"><i class="fa fa-eye"></i></span>
                                        </div> -->
                                    </div>
                                </div>

                                <div class="col-lg-4 col-sm-6">
                                    <div class="form-group">
                                        <!-- <label for="">New Password</label> -->
                                        <input type="password" class="form-control" id="newpassword1" name="newpassword1" placeholder="New Password" required>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-6">
                                    <div class="form-group">
                                        <!-- <label for="">Confirm Password</label> -->
                                        <input type="password" class="form-control" id="newpassword2" name="newpassword2" placeholder="Confirm Password" required>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-6" style="display:none">
                                    <div class="form-group">
                                        <label for="">email</label>
                                        <input type="email" class="form-control" id="newemail" name="newemail" value="<?php echo $email ?>">
                                    </div>
                                </div>

                            </div><!-- /form-row -->
                            <button type="submit" class="btn btn-primary btn_save mt-2">SAVE</button>
                        </form>
                    </div><!-- /personal-info-section -->

                <?php } else { ?>

                    <div class="your-info mab-50">
                        <!-- <h3 class="mb-3">Personal Information</h3> -->
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="your-info-widget">
                                    <p class="lead">User Name</p>
                                    <p><?php echo $username; ?></p>	
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="your-info-widget">
                                    <p class="lead">Your Email</p>
                                    <p><?php echo $email; ?></p>	
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="your-info-widget">
                                    <p class="lead">Phone Number</p>
                                    <p><?php echo $phone; ?></p>	
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="your-info-widget">
                                    <p class="lead">Address</p>
                                    <p><?php echo $address; ?></p>	
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="your-info-widget">
                                    <p class="lead">City</p>
                                    <p><?php echo $city; ?></p>	
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="your-info-widget">
                                    <p class="lead">Pincode</p>
                                    <p><?php echo $pincode; ?></p>	
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="your-info-widget">
                                    <p class="lead">State</p>
                                    <p><?php echo $state; ?></p>	
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="your-info-widget">
                                    <p class="lead">Country</p>
                                    <p><?php echo $country; ?></p>	
                                </div>
                            </div>
                            <div class="col-lg-4">
                            <a href="<?php echo base_url() ?>myaccount/edit/<?php echo base64_encode($user_id) ?>"><button type="button" class="btn btn-info">Edit</button></a>
                                <!-- <div class="your-info-widget">
                                    <p class="lead"></p>
                                    <p></p>	
                                </div> -->
                            </div>
                        </div><!-- /row -->
                    </div><!-- /your-info -->

                    <div class="password-settings">
                        <h3 class="mb-3">Password Settings</h3>
                        <form action="<?php echo base_url() ?>my-account/changepassword" method="post" onsubmit="changepassword()">
                            <div class="form-row">
                                <div class="col-lg-4 col-sm-6">
                                    <label for="">Current Password</label>
                                    <div class="form-group input-group">
                                        <input type="password" class="form-control" id="password" name="currentpassword" placeholder="******" required>
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="show-password"><i class="fa fa-eye"></i></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-4 col-sm-6">
                                    <div class="form-group">
                                        <label for="">New Password</label>
                                        <input type="password" class="form-control" id="newpassword1" name="newpassword1" placeholder="UxsdfEds0" required>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-6">
                                    <div class="form-group">
                                        <label for="">Confirm Password</label>
                                        <input type="password" class="form-control" id="newpassword2" name="newpassword2" placeholder="UxsdfEds0" required>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-6" style="display:none">
                                    <div class="form-group">
                                        <label for="">email</label>
                                        <input type="email" class="form-control" id="newemail" name="newemail" value="<?php echo $email ?>">
                                    </div>
                                </div>

                            </div><!-- /form-row -->
                            <button type="submit" class="btn btn-primary btn_save mt-2">SAVE</button>
                        </form>
                    </div><!-- /personal-info-section -->

                <?php } ?>
            </div><!-- /col-lg-9 -->
        </div><!-- /row -->
    </div><!-- /container-fluid -->
</div><!-- /student-dashboard-body -->


<!-- <div class="dashboard-content"> -->
<!-- <div class="container"> -->
<!-- <div class="section-title text-center mab-30">
        <h1 class="mb-2">My Account</h1>
        <p>In order to access some features of the service, you will <br> have to fill out your account details.</p>
</div> -->
<!-- /section-title -->

<!-- <div class="profile-image-section mab-30">
        <div class="media">
                <div class="media-left">
                        <div class="object-fit" style="width: 140px;height: 140px;">


                        </div>
                </div>

                <div class="media-body">
                        <h2><?php echo $username; ?></h2>
                        <p><?php echo $email; ?> </p>
                </div>
        </div>
        
</div> -->
<!-- /profile-image-section -->
<!-- <hr class="mab-30"> -->
<!-- <div class="plan-details mab-50">
        <h3 class="mb-2">Plan Details</h3>
        <p>SPECTRUM PACKAGE (90 DAYS + 10 Days)</p>
        <span>(Kindergarten Schools)</span>
        <button type="button" class="btn btn-primary btn-save1 mt-3" data-toggle="modal" data-target="#exampleModalCenter2">UPGRADE YOUR PACKAGE</button>
        
        <div class="modal upgrade-modal fade" id="exampleModalCenter2" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog" role="document">
                <div class="modal-content">
                        <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalCenterTitle">Upgrade your Package</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true"><i class="lnr lnr-cross"></i></span>
                                </button>
                        </div>
                                <div class="modal-body p-4">
                                <h5 class="mb-2">To upgrade premium membership please send the following details by mail.</h5>
                                <ul class="mb-2">
                                        <li>Current Plan</li>
                                        <li>School Details</li>
                                        <li>Upgrade Plan</li>
                                </ul>
                                <p class="lead mb-2">Send email to <a href="mailto:support@edugatein.com">support@edugatein.com</a></p>
                                <p class="mb-3"><b>Note:</b> Your information will be added on website within 48 hours and intimated to you via email.</p>
                                <p>Toll Free Number: <a href="tel:1800120235600"><i class="fa fa-phone"></i> 1800-120-235600</a></p>
                        </div>
                </div>
                </div>
        </div>
</div> -->
<!-- </div> -->
<!-- /container -->
<!-- </div> -->
<!-- /dashboard-content -->
<!-- Modal -->
<!-- <div class="modal fade" id="personalinfo-save" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Package Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-center">
      <a href="<?php echo base_url(); ?>schoolfirst?id=<?php echo base64_encode($userid); ?>"><button class="btn btn-pink">ADD SCHOOL</button></a>
      <a href="<?php echo base_url(); ?>institutefirst?id=<?php echo base64_encode($userid); ?>"><button class="btn btn-primary">ACTIVITY CLASS</button></a>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div> -->

<style>
    .password-settings .input-group-text {
        background-color: #fff;
        color: #7d7d7d;
        border-color: #ced4da;
        box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.04);
        cursor: pointer;
    }
</style>
<script>
    $(window).on("load", function () {
        $('#preloader').fadeOut('slow', function () {
            $(this).remove();
        });
    });
    $(document).ready(function () {
        $("#show-password").click(function () {
            var input = $("#password");
            if (input.attr("type") === "password") {
                input.attr("type", "text");
            } else {
                input.attr("type", "password")
            }
        });
    });


    function changepassword() {

        var newpassword1 = document.getElementById("newpassword1").value;
        var newpassword2 = document.getElementById("newpassword2").value;

        if (newpassword1 != newpassword2)
        {
            alert("Your Password is Not Matching");
            event.preventDefault();
        }

    }

    // $('a.logout').click(function () {
    //     // return confirm('Are you sure want to logout....!!!')
    //     swal({
    //     title: "Are you sure?",
    //     text: "You will not be able to recover this imaginary file!",
    //     type: "warning",
    //     showCancelButton: true,
    //     confirmButtonColor: "#DD6B55",
    //     confirmButtonText: "Yes, delete it!",
    //     closeOnConfirm: false
    // }, function (isConfirm) {
    //     if (!isConfirm) return;
    //     $.ajax({
    //         url: "<?php echo base_url() ?>logout",
    //         // type: "POST",
    //         // data: {
    //         //     id: 5
    //         // },
    //         dataType: "html",
    //         success: function () {
    //             swal("Done!", "It was succesfully deleted!", "success");
    //         },
    //         error: function (xhr, ajaxOptions, thrownError) {
    //             swal("Error deleting!", "Please try again", "error");
    //         }
    //     });
    // });
    // })
    $("a.logout").on("click", function(e) {
			e.preventDefault();
		swal({
			title: 'Log Out?',
			type: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'OK',
			closeOnConfirm: true,
			closeOnCancel: true
		}).then((result) => { 
			if (result==true) { 
                window.location.href = "<?php echo base_url("logout") ?>";
			} 
		}) 
	})   
    $('.btn-save').click(function(e){
        e.preventDefault();
        validateForm();
        
    });
    function validateForm() {
    var address = $("#address").val();
    var useremail = $("#useremail").val();
    var city = $("#city").val();
    var pincode = $("#pincode").val();
    var state = $("#state").val();
    var country = $("#country").val();
    if ((address == null || address == "")  || (city == null || city == "") || (pincode == null || pincode == "") || (state == null || state == "") || (country == null || country == "")) {
        swal({
            title: "Please Fill All Required Field",
            type: "failure"
        })
      return false;
    }
    var image = [];
    var formdata = new FormData();
    formdata.append('address',$('#address').val());
    formdata.append('useremail',$('#useremail').val());
    formdata.append('city',$('#city').val());
    formdata.append('pincode',$('#pincode').val());
    formdata.append('state',$('#state').val());
    formdata.append('country',$('#country').val());
    var imageData = $('#inputGroupFile01')[0].files;
    if(imageData.length > 0){
        image = $('#inputGroupFile01')[0].files[0];
    }
    formdata.append('image',image);
    $.ajax({
        url:'<?php echo base_url() ?>my-account/update',
        //data:{address:$('#address').val(),useremail:$('#useremail').val(),city:$('#city').val(),pincode:$('#pincode').val(),state:$('#state').val(),country:$('#country').val(),image: $('#inputGroupFile01')[0].files[0]},  // pass data 
        data:formdata,
        processData: false,
        contentType: false,
        type:"post",
        success:function(data){
            data = JSON.parse(data);
            if(data.status == 'success'){
                swal({
                    title: "Registered Successfully!",
                    type: "success"
                }).then(function() {
                     window.location = "<?php echo base_url() ?>myaccount?id=<?php echo base64_encode($userid); ?>";
                });
            }           
        }
    });
  }


</script>

<style>
    .noclick  {
        pointer-events: none;
    }
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<svg id="deco-clouds" xmlns="http://www.w3.org/2000/svg" version="1.1" style="background-color: #f4f6f8;" height="100" viewBox="0 0 100 100" preserveAspectRatio="none">
        <path d="M-5 100 Q 0 20 5 100 Z
          M0 100 Q 5 0 10 100 M5 100 Q 10 30 15 100 M10 100 Q 15 10 20 100 M15 100 Q 20 30 25 100
          M20 100 Q 25 -10 30 100 M25 100 Q 30 10 35 100 M30 100 Q 35 30 40 100 M35 100 Q 40 10 45 100
          M40 100 Q 45 50 50 100 M45 100 Q 50 20 55 100 M50 100 Q 55 40 60 100 M55 100 Q 60 60 65 100
          M60 100 Q 65 50 70 100 M65 100 Q 70 20 75 100 M70 100 Q 75 45 80 100 M75 100 Q 80 30 85 100
          M80 100 Q 85 20 90 100 M85 100 Q 90 50 95 100 M90 100 Q 95 25 100 100 M95 100 Q 100 15 105 100 Z">
       	</path>
    </svg>

	<footer>
		<div class="container">
			<div class="row">
				<div class="col-lg-4 mab-30 text-center">
					<div class="footer-heading mab-30">
			            <h4>Subscribe Newsletter</h4>
			            <small>We will send updates once a week.</small>
		          	</div><!-- /footer-heading -->

		          	<form action="<?php echo base_url(); ?>abouts/newsletter" class="form-inline" method="post">
		              	<div class="input-group w-100">
		                	<input type="email" name="email" class="form-control" id="inlineFormInputGroupUsername2" placeholder="Enter your email*" required>
		                	<div class="input-group-prepend">
		                    	<div class="input-group-text">
		                  			<button type="submit" class="fa fa-send-o"></button>
		                  		</div><!-- /input-group-text -->
		                	</div><!-- /input-group-prepend -->
		              	</div><!-- /input-group -->
		          	</form><!-- /Newsletter -->
				</div>

				<div class="col-lg-4 mab-30 text-center">
					<div class="footer-heading mab-30">
			            <h4>Edugatein</h4>
			            <small>We make your school in 1st Place...</small>
		          	</div><!-- /footer-heading -->

		          	<ul class="social-icons list-unstyled list-inline"> 
				      	<li><a href="https://www.facebook.com/edugatein" target="_blank"><i class="fa fa-facebook"></i></a></li> 
				      	<li><a href="https://twitter.com/edugatein" target="_blank"><i class="fa fa-twitter"></i></a></li>
				      	<li><a href="https://www.linkedin.com/company/edugatein/" target="_blank"><i class="fa fa-linkedin"></i></a></li>
				      	<li><a href="https://www.youtube.com/channel/UCyatNY2QIPJgj5Id4QMQeig?view_as=subscriber" target="_blank"><i class="fa fa-youtube-play"></i></a></li>
				      	<li><a href="https://www.instagram.com/edugatein/" target="_blank"><i class="fa fa-instagram"></i></a></li>
				  	</ul>
				</div>

				<div class="col-lg-4 mab-30 text-center">
					<div class="footer-heading mab-30">
			            <h4>Help Center</h4>
		          	</div><!-- /footer-heading -->

		          	<ul class="list-unstyled help-center">
			            <li><i class="fa fa-fw fa-envelope"></i> <a href="mailto:support@edugatein.com">support@edugatein.com</a></li>
			            <li><i class="fa fa-fw fa-phone"></i> <a href="tel:1800120235600">1800-120-235600</a></li>
		          	</ul>
				</div>
			</div><!-- /row -->

			<hr style="border-color: #fff;opacity: .1;">

			<div class="copyright">
				<div class="container">
					<div class="row">
						<div class="col-lg-6 col-sm-6">
							<p>&copy; 2019 <b>Edugatein.</b> All Rights Reserved.</p>
						</div>

						<div class="col-lg-6 col-sm-6 text-right">
							<ul class="list-inline">
								<li class="list-inline-item"><a href="#">Privacy Policy</a></li>
								<li class="list-inline-item"><a href="<?php echo base_url(); ?>terms-and-conditions">Terms & Conditions</a></li>
							</ul>
						</div>
					</div><!-- /row -->
				</div><!-- /contaienr -->
			</div><!-- /copytight -->
		</div><!-- /container -->
	</footer>

    <!-- Core JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url("assets/front/"); ?>js/dashboard.js"></script>
    <script src="<?php echo base_url("assets/front/"); ?>js/jquery.stickit.js"></script>
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>