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
<div class="new-signin-section">
    <div class="container-fluid p-0">
        <div class="row no-gutters">
            <div class="col-lg-4 col-sm-12">
                <div class="new-signin-left">
                    <a href="<?php echo base_url(); ?>">
                        <img src="<?php echo base_url("assets/front/"); ?>images/dashboard/logo-white.png" class="w-100" alt="">	
                    </a>
                    <img src="<?php echo base_url("assets/front/"); ?>images/dashboard/child.png" class="w-100 my-5" alt="">
                    <h2 class="text-white mb-2">Welcome!</h2>
                    <p>Edugate-in is to inter-connect schools, parents and education community on a single platform to create mutual benefit.</p>
                </div><!-- /new-signin-left -->
            </div>
            <div class="col-lg-8 col-sm-12">
                <div class="new-signin-right">
                    <h1 class="display-4 mb-2">Sign Up</h1>
                    <p>Create a new account to access various of services.</p>
                    <div class="row">
                        <div class="col-lg-9">
                            <form action="#" method="post"   id="signupschool" autocomplete="off">
                                <div class="row">
                                    <div class="col-lg-6 col-sm-6">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="name" name="name" placeholder=" " required>
                                            <label>First Name</label>
                                        </div>	
                                    </div>
                                    <div class="col-lg-6 col-sm-6">
                                        <div class="form-group">
                                            <input class="form-control" type="text" placeholder=" " name="lastname" id="lastname">
                                            <label>Last Name</label>
                                        </div>	
                                    </div>
                                    <div class="col-lg-6 col-sm-6">
                                        <div class="form-group">
                                            <input type="email" class="form-control" id="useremail" name="useremail" placeholder=" " required>
                                            <label>E-mail</label>
                                        </div>	
                                    </div>
                                    <div class="col-lg-6 col-sm-6">
                                        <div class="form-group">
                                            <input type="number" step="any"  class="form-control" id="phone" name="phone" maxlength="10" placeholder=" " required>
                                            <label>Mobile Number</label>
                                        </div>	
                                    </div>
                                    <div class="col-lg-6 col-sm-6">
                                        <div class="form-group">
                                            <input type="password" class="form-control" id="password" name="password" placeholder=" " required>
                                            <label>Password</label>    
                                        </div>	
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" onclick="myFunctionp(true)" id="showpass" name="showpass" >
                                            <label class="custom-control-label mt-2" for="showpass"> Show Password</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-sm-6">
                                        <div class="form-group">
                                            <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder=" " required>
                                            <label>Confirm Password</label>  
                                        </div>	
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" onclick="myFunctionp(false)" id="showpass2" name="showpass2" >
                                            <label class="custom-control-label mt-2" for="showpass2"> Show Confirm Password</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-sm-6">
                                        <div class="form-group">  
                                            <select class="floating-select" id="category" name="category" required>
                                                <option value=""> </option>
                                                <option value="school">School</option>
                                                <option value="summer class">Activity Classes</option>
                                            </select>
                                            <label for="category">Select Category</label>
                                        </div>	
                                    </div>
                                </div><!-- /form-row -->

                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="terms" name="terms" required>
                                    <label class="custom-control-label mt-2" for="terms">I Agree with <a href="<?php echo base_url() ?>terms-and-conditions" target="_blank">Terms & Conditions</a></label>
                                </div>

                                <div class="form-group">
                                    <input type="hidden" class="form-control" id="ip" name="ip" aria-describedby="emailHelp" value="<?php echo $_SERVER['REMOTE_ADDR']; ?>">
                                </div>

                                <button type="submit" id="btnsubmit" class="btn btn-primary mb-4">SIGN UP</button>
                            </form>

                            <p>Already Have an account? <a href="<?php echo base_url() ?>signin" class="text-pink"><u>SIGN IN</u></a></p>
                        </div>
                    </div><!-- /row -->

                    <p class="new-signin-copyright">&copy; 2021 Edugatein.com All Rights Reserved.</p>
                </div><!-- /new-signin-right -->
            </div>
        </div><!-- /row -->
    </div><!-- /container-fluid -->
</div><!-- /new-signin-section -->

<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body p-5">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h3 class="modal-title mb-3" id="exampleModalCenterTitle">Enter One Time Password</h3>
                <p class="mb-2">One Time Password (OTP) has been sent to your mobile ******<span id="mobileshort"></span>, please enter the same here to login.</p>

                <form action="<?php echo base_url() ?>signupschool/otp" method="post" class="mt-3" id="otpform">
                    <input type="hidden" value="" name="contact_email" id="contact_email" >
                    <div class="form-group">
                        <input type="text" value="" class="form-control" name="otp" id="otp" aria-describedby="emailHelp" placeholder="OTP">
                    </div> 
                    <button type="submit"  class="btn btn-primary btn-block" id="btn-submit">Submit</button>
                </form>
            </div><!-- /modal-body -->
        </div><!-- /modal-content -->
    </div>
</div>

<!-- Optional JavaScript -->

<script type="text/javascript">
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
        $("#signupschool").validate({
            rules: {
                name: "required",
                phone: "required",
                password: {
                    minlength: 5
                },
                confirm_password: {
                    minlength: 5,
                    equalTo: "#password"
                },
                terms: "required"
            },
            messages: {
                confirm_password: "Password not matching"
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
        $("#signupschool").submit(function () {
            event.preventDefault();
            $("#btnsubmit").prop("disabled", true);
            if ($("#signupschool").valid()) {
                $("#btnsubmit").prop("disabled", false);
                var form = $('#signupschool')[0];
                var data = new FormData(form);
                $.ajax({
                    type: "POST",
                    processData: false, // Important!
                    contentType: false,
                    cache: false,
                    url: "<?php echo base_url("signupschool/insert") ?>",
                    data: data,
                    dataType: "json",
                    success: function (data) {
                        if (data.status == "error") {
                            sweetAlert("error", data.message.title, data.message.text, true);
                        } else {
                            $("#mobileshort").text(data.data.mobile);
                            $("#contact_email").val(data.data.contact_email);
                            $("#otp").val(data.data.otp);
                            $('#exampleModalCenter').modal('show');
                        }
                    }
                });
            } else {
                $("#signupschool").valid();
                $("#btnsubmit").prop("disabled", false);
                return false;
            }
        });

        function sweetAlert(icon, title, text, button) {
            swal({
                title: title,
                text: text,
                icon: icon,
                buttons: button
            });
        }

        $("#otpform").validate({
            rules: {

                otp: {
                    minlength: 4,
                    required: true
                }
            },
            messages: {
                confirm_password: "Password not matching"
            },
            errorElement: 'div',
            errorLabelContainer: '.errorTxt',
            errorPlacement: function (error, element) {
                element.parents('.form-group').append(error);
            }
        });
        $("#otpform").submit(function () {
            event.preventDefault();
            $("#btn-submit").prop("disabled", true);
            if ($("#otpform").valid()) {
                $("#btn-submit").prop("disabled", false);
                var form = $('#otpform')[0];
                var data = new FormData(form);
                $.ajax({
                    type: "POST",
                    processData: false, // Important!
                    contentType: false,
                    cache: false,
                    url: "<?php echo base_url("signupschool/otp") ?>",
                    data: data,
                    dataType: "json",
                    success: function (data) {
                        if (data.status == "error") {
                            $("#mobileshort").text(data.mobile);
//                            $('#exampleModalCenter').modal('show');
                            sweetAlert("error", data.message.title, data.message.text, true);
                        } else {
                            sweetAlert("success", data.message.title, data.message.text, false);
                            location.href = data.redirect_url;;
                        }
                    }
                });
            } else {
                $("#otpform").valid();
                $("#btn-submit").prop("disabled", false);
                return false;
            }
        });
    });
</script>

